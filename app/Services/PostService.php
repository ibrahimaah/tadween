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

class PostService
{
    use CacheClearable;

    private function formatLikedByPosts($posts, $followingIds_arr)
    {
        $formattedPosts = collect();

        foreach ($posts as $post) {
            $likedByFollowings = $post->postLikes->filter(function ($post_like) use ($followingIds_arr) {
                return in_array($post_like->user_id, $followingIds_arr);
            });

            if ($likedByFollowings->isNotEmpty()) {
                foreach ($likedByFollowings as $like) {
                    $name = $like->user->name;
                    $username = $like->user->username;

                    // Clone the post to avoid modifying the original reference
                    $clonedPost = clone $post;
                    $clonedPost->likedByPhrase = __('messages.like_post', [
                        'user' => "<a href='" . route('profile', ['username' => $username]) . "' class='text-orange-color text-decoration-none' target='_blank'>$name</a>"
                    ]);

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

        return new LengthAwarePaginator($pagedData, $total, $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }

    private function filterPostsByFollowings($query, $my_followings)
    {
        foreach ($my_followings as $follow) {
            $query->orWhere(function ($q) use ($follow) {
                $q->where('user_id', $follow->following_id)
                    ->where('created_at', '>', $follow->created_at);
            });
        }
    }

    private function filterPostsByLikes($query, $my_followings)
    {
        $query->where(function ($q) use ($my_followings) {
            foreach ($my_followings as $follow) {
                $q->orWhere(function ($subQuery) use ($follow) {
                    $subQuery->where('user_id', $follow->following_id)
                        ->where('created_at', '>', $follow->updated_at); // Ensure the like happened after following
                });
            }
        });

        $query->orWhere(function ($q) {
            $q->where('user_id', Auth::id()); // Include posts I have liked
        });
    }

    // private function filterByAccountPrivacy($query, $followingIds_arr)
    // {
    //     $query->where('account_privacy', AccountPrivacy::PUBLIC)
    //         ->orWhere(function ($q) use ($followingIds_arr) {
    //             $q->where('account_privacy', AccountPrivacy::PRIVATE)->whereIn('id', $followingIds_arr);
    //         });
    // }
    private function filterByAccountPrivacy($query, $followingIds_arr)
    {
        $query->whereIn('id', $followingIds_arr) // Only include users I follow
            ->where(function ($q) {
                $q->where('account_privacy', AccountPrivacy::PUBLIC) // Public accounts in followings
                    ->orWhere('account_privacy', AccountPrivacy::PRIVATE); // Private accounts in followings
            });
    }


    private function getPostOrderingQuery()
    {
        return 'GREATEST(posts.created_at, COALESCE((SELECT MAX(created_at) FROM post_likes WHERE post_likes.post_id = posts.id), posts.created_at)) DESC';
    }

    private function fetchPosts($my_followings, $followingIds_arr)
    {
        $postsFromFollowings = Post::with(['user', 'userPostLike', 'poll', 'postLikes'])
            ->withCount(['replies', 'postLikes'])
            ->where(function ($query) use ($my_followings) {
                $this->filterPostsByFollowings($query, $my_followings);
            })
            ->whereHas('user', function ($query) use ($followingIds_arr) {
                $this->filterByAccountPrivacy($query, $followingIds_arr);
            })
            ->orWhere('user_id', Auth::id()) // Include own posts
            ->orderByRaw($this->getPostOrderingQuery())
            ->get();

        $postsFromLikes = Post::with(['user', 'userPostLike', 'poll', 'postLikes'])
            ->withCount(['replies', 'postLikes'])
            ->whereHas('postLikes', function ($query) use ($my_followings) {
                $this->filterPostsByLikes($query, $my_followings);
            })
            ->whereHas('user', function ($query) use ($followingIds_arr) {
                $this->filterByAccountPrivacy($query, $followingIds_arr);
            })
            ->orderByRaw($this->getPostOrderingQuery())
            ->get();

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
            $postsFromLikes = $postsData['likes'];

            // Apply formatLikedByPosts ONLY to posts from likes
            $formattedLikedPosts = $this->formatLikedByPosts($postsFromLikes, $followingIds_arr);

            // Merge posts from followings and formatted liked posts
            $mergedPosts = collect($postsFromFollowings)->merge($formattedLikedPosts);

            // Paginate merged posts
            $paginatedPosts = $this->paginateCollection($mergedPosts, 10);

            return ['code' => 1, 'data' => $paginatedPosts];
        } catch (Exception $ex) {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
}
