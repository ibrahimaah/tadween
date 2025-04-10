<?php

namespace App\Services;

use App\Models\AccountPrivacy;
use App\Models\Follow;
use App\Models\Post;
use App\Traits\CacheClearable;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PostService
{
    use CacheClearable;

    private function formatLikedByPosts($posts, $followingIds_arr)
    {
        $formattedPosts = collect();

        foreach ($posts as $post) {
            $likedByFollowingsAndMe = $post->postLikes->filter(function ($post_like) use ($followingIds_arr) {
                return in_array($post_like->user_id, $followingIds_arr);
            });

            if ($likedByFollowingsAndMe->isNotEmpty()) {
                foreach ($likedByFollowingsAndMe as $like) {

                    $name = $like->user->name;
                    $username = $like->user->username;

                    // Clone the post to avoid modifying the original reference
                    $clonedPost = clone $post;
                    if ($like->user->id !== Auth::id()) {
                        $clonedPost->likedByPhrase = __('messages.like_post', [
                            'user' => "<a href='" . route('profile', ['username' => $username]) . "' class='text-orange-color text-decoration-none' target='_blank'>$name</a>"
                        ]);
                    }
                    ////////////////////////////////////////////////
                    // the following code is wrong but it is neccessary for sorting
                    $clonedPost->ordered_date = $like->created_at;
                    ///////////////////////////////////////////
                    $formattedPosts->push($clonedPost);
                }
            } else {
                // If no followings liked the post, keep it as is
                $post->likedByPhrase = '';
                $formattedPosts->push($post);
            }
        }

        return $formattedPosts;
    }

    private function paginateCollection($items, $perPage)
    {
        $page = request()->get('page', 1);
        $total = $items->count();

        $pagedData = $items->forPage($page, $perPage);
        // Log::info('pagedData: '.$pagedData);
        return new LengthAwarePaginator($pagedData, $total, $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }

    //DONE
    private function filterPostsByFollowings($query, $my_followings)
    {
        // foreach ($my_followings as $follow) {
        //     $query->orWhere(function ($q) use ($follow) {
        //         $q->where('user_id', $follow->following_id)
        //             ->where('created_at', '>', $follow->created_at);
        //     });
        // }

        $query->where(function ($q) use ($my_followings) {
            foreach ($my_followings as $follow) {
                $q->orWhere(function ($subQuery) use ($follow) {
                    $subQuery->where('user_id', $follow->following_id)
                        ->where('created_at', '>', $follow->updated_at); // Ensure the like happened after following
                });
            }
        });
    }



    private function filterPostsByLikes($query, $my_followings)
    {
        $query->where(function ($q) use ($my_followings) 
        {
            foreach ($my_followings as $follow) 
            {
                // Check if the follow request is accepted (i.e., is_pending is false)
                if (!$follow->is_pending) 
                {
                    $q->orWhere(function ($subQuery) use ($follow) {

                        // Ensure the like is after the follow request is accepted
                        $subQuery->where('user_id', $follow->following_id)
                            ->where('created_at', '>', function ($query) use ($follow) {
                                $query->select('updated_at')
                                    ->from('follows')
                                    ->whereColumn('following_id', 'posts.user_id') // Ensure it's the post owner's approval date
                                    ->where('follower_id', $follow->follower_id)
                                    ->latest() // Get the most recent approval
                                    ->limit(1);
                            });
                    });

                    // Likes from the current user

                    // $q->orWhere(function ($subQuery) use ($follow) 
                    // {
                    //     // Ensure it's the current user liking
                    //     $subQuery->where('user_id', Auth::id())
                    //         ->where('created_at', '>', $follow->updated_at); // Like after follow
                    // });
                }
            }
        });
    }




    // private function filterByAccountPrivacy($query, $followingIds_arr)
    // {
    //     $query->where('account_privacy', AccountPrivacy::PUBLIC)
    //         ->orWhere(function ($q) use ($followingIds_arr) {
    //             $q->where('account_privacy', AccountPrivacy::PRIVATE)->whereIn('id', $followingIds_arr);
    //         });
    // }
    // private function filterByAccountPrivacy($query, $followingIds_arr)
    // {
    //     $query->whereIn('id', $followingIds_arr) // Only include users I follow
    //         ->where(function ($q) {
    //             $q->where('account_privacy', AccountPrivacy::PUBLIC) // Public accounts in followings
    //                 ->orWhere('account_privacy', AccountPrivacy::PRIVATE); // Private accounts in followings
    //         });
    // }
    private function filterByAccountPrivacy($query, $followingIds_arr)
    {
        $query->where('account_privacy', AccountPrivacy::PUBLIC) 
              ->orWhere(function ($q) use ($followingIds_arr){
                $q->where('account_privacy', AccountPrivacy::PRIVATE)->whereIn('id', $followingIds_arr);
            });  
    }




    private function fetchPosts($my_followings, $followingIds_arr)
    {
        /*****************************************************************/
        $postsFromFollowings = Post::with(['user', 'userPostLike', 'poll', 'postLikes'])
            ->withCount(['replies', 'postLikes'])
            ->where(function ($query) use ($my_followings) {
                $this->filterPostsByFollowings($query, $my_followings);
            })
            // ->whereHas('user', function ($query) use ($followingIds_arr) {
            //     $this->filterByAccountPrivacy($query, $followingIds_arr);
            // })
            ->orWhere('user_id', Auth::id()) // Include own posts 
            ->get();

        // Add the is_liked property to each post
        $postsFromFollowings->each(function ($post) {
            $post->ordered_date = $post->created_at;
        });
        /*****************************************************************/


        $postsFromFollowings = collect();

        $postsFromLikes = Post::with(['user', 'userPostLike', 'poll', 'postLikes'])
            ->withCount(['replies', 'postLikes'])
            ->whereHas('postLikes', function ($query) use ($my_followings) {
                $this->filterPostsByLikes($query, $my_followings);
            })
            // ->whereHas('user', function ($query) use ($followingIds_arr) {
            //     $this->filterByAccountPrivacy($query, $followingIds_arr);
            // })
            ->get();

        info($postsFromLikes);



        // $postsFromLikes = collect();

        return [
            'followings' => $postsFromFollowings,
            'likes' => $postsFromLikes,
        ];
    }


    public function get_posts()
    {
        try {
            $this->clear_posts_cache(); // remove this line later

            $cacheKey = 'posts_page_' . request('page', 1);
            $my_followings = Follow::where(['follower_id' => Auth::id(), 'is_pending' => false])->get();
            $followingIds_arr = $my_followings->pluck('following_id')->toArray();

            $postsData = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($my_followings, $followingIds_arr) {
                return $this->fetchPosts($my_followings, $followingIds_arr);
            });

            $postsFromFollowings = $postsData['followings'];
            // info($postsFromFollowings);
            $postsFromLikes = $postsData['likes'];

            // info($postsFromLikes->count());

            // Apply formatLikedByPosts ONLY to posts from likes
            $formattedLikedPosts = $this->formatLikedByPosts($postsFromLikes, $followingIds_arr);


            // Merge posts from followings and formatted liked posts 
            // $mergedPosts = collect($formattedLikedPosts)->merge($postsFromFollowings);

            $mergedPosts = collect($postsFromFollowings)->merge($formattedLikedPosts);
            // info('-------------------------');
            // info($mergedPosts);
            // Sort the merged posts by the 'created_at' field in descending order (latest first)
            $sortedPosts = $mergedPosts->sortByDesc(function ($post) {
                return $post->ordered_date;
            })->values();


            // Paginate the sorted posts
            $paginatedPosts = $this->paginateCollection($sortedPosts, 10);


            return ['code' => 1, 'data' => $paginatedPosts];
        } catch (Exception $ex) {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
}
