<?php

namespace App\Services;

use App\Models\AccountPrivacy;
use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use App\Traits\CacheClearable;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Enums\Role;  
use Illuminate\Support\Facades\Hash;
use App\Helpers\TextHelper; 
use Carbon\Carbon;
class PostService
{
    use CacheClearable;

    //have liked after accept follow request
    private $final_followings = [];

    private function formatLikedByPosts($posts)
    {
        // info($posts->count());
        /** @var \App\Models\User $current_user */
        $current_user = Auth::user();
        $formattedPosts = collect();

        foreach ($posts as $post) 
        {
            /////////////////////////////////////////////////////////////////////////////////////////////
            /**  Remove posts related to blocked users **/
            if($current_user->hasBlocked($post->user))
            {
                continue;
            }
            /////////////////////////////////////////////////////////////////////////////////////////////
            
            // $likedByFollowings = $post->postLikes->filter(function ($post_like) use ($followingIds_arr) 
            // {
            //     return (in_array($post_like->user_id, $this->final_followings));
            // });

            $likedByFollowingsAndMe = $post->postLikes->filter(function ($post_like) {
                return (in_array($post_like->user_id, $this->final_followings) || $post_like->user_id == Auth::id());
            });

            $groupedLikes = $likedByFollowingsAndMe->groupBy('post_id');

            // Filter likes, removing the auth user's like if there are other users who liked the same post
            $filteredLikes = $groupedLikes->map(function ($likes) {
                if ($likes->count() > 1) {
                    return $likes->reject(fn($like) => $like->user_id == Auth::id());
                }
                return $likes;
            })->flatten();


            // info( $filteredLikes);
            // info($this->following_ids_arr);
            // info('f '.$likedByFollowingsAndMe->count());

            if ($filteredLikes->isNotEmpty()) 
            {
                // info($likedByFollowingsAndMe);
                foreach ($filteredLikes as $like) 
                {
                    
                
////////////////////////////////////////////////////////////////////////////////////                                    
                    
                   if($post->user->account_privacy == AccountPrivacy::PRIVATE)
                   {

                        $owner_post_been_liked_follow_date = DB::table('follows')
                                    ->where('following_id', $post->user_id)
                                    ->where('follower_id',Auth::id())
                                    ->value('updated_at');

                          //if owner one of my followings           
                        if($owner_post_been_liked_follow_date)
                        {
                            //info('follow date : '.$owner_post_been_liked_follow_date);
                            //info("**********************************");
                            //info('like date : '.$like->created_at);
                            if ($owner_post_been_liked_follow_date > $like->created_at)
                            {
                                continue;
                            }
                        }
                   }
////////////////////////////////////////////////////////////////////////////////////

                    //we are in post_likes table
                    $name = $like->user->name;
                    $username = $like->user->username;
                    $user_id = $like->user->id;

                    

                    

                    // Clone the post to avoid modifying the original reference
                    $clonedPost = clone $post;

                    if ($user_id !== Auth::id()) {
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

   

    

    private function filterPostsByCurrentUserLikes($query, $my_followings,$followingIds_arr)
    {
        if ($my_followings->isNotEmpty()) 
        {
            $query->where(function ($q) use ($my_followings,$followingIds_arr) {
                foreach ($my_followings as $follow) 
                {
                    $follow_date = DB::table('follows')
                                    ->where('following_id', $follow->following_id)
                                    ->where('follower_id', Auth::id())
                                    ->value('updated_at');

                    $q->orWhere(function ($subQuery) use ($follow, $follow_date) 
                    {
                        $subQuery->where('user_id', Auth::id())
                            ->where('created_at', '>', $follow_date);
                    })
                    ->whereHas('post.user', function($qu) use ($followingIds_arr) 
                    {
                        $qu->where('account_privacy', 'public')
                           ->orWhere(function($query) use ($followingIds_arr) 
                            {
                               $query->where('account_privacy', 'private')
                                     ->whereIn('user_id', $followingIds_arr);
                            });
                    });
                    
                }
            });
        }  
        else {
            $query->whereRaw('1 = 0');
        }
    }


    //DONE
    private function filterPostsByFollowings($query, $my_followings)
    {
        $query->where(function ($q) use ($my_followings) {
            foreach ($my_followings as $follow) {
                $q->orWhere(function ($subQuery) use ($follow) {
                    $subQuery->where('user_id', $follow->following_id)
                        ->where('created_at', '>', $follow->updated_at); // Ensure the like happened after following
                });
            }
        });
    }


    private function filterPostsByLikes($query, $my_followings,$followingIds_arr)
    {
        if ($my_followings->isNotEmpty()) {
            $query->where(function ($q) use ($my_followings,$followingIds_arr) {
                foreach ($my_followings as $follow) 
                {
                    $follow_date = DB::table('follows')
                        ->where('following_id', $follow->following_id)
                        ->where('follower_id', $follow->follower_id)
                        ->value('updated_at');
 

                    $q->orWhere(function ($subQuery) use ($follow, $follow_date) 
                    {
                        $subQuery->where('user_id', $follow->following_id)
                            ->where('created_at', '>', $follow_date);
                    })
                    ->whereHas('post.user', function($qu) use ($followingIds_arr) 
                    {
                        $qu->where('account_privacy', 'public')
                           ->orWhere(function($query) use ($followingIds_arr) 
                            {
                               $query->where('account_privacy', 'private')
                                     ->whereIn('id', $followingIds_arr);
                            });
                    });
                    
                }

                //we just need those followings to apply last filter on them (formatLikedByPosts)
                $data = json_decode($q->get(), true);
                $this->final_followings = array_column($data, 'user_id');
                // info($this->final_followings);

                // Ensure the post owner has 'public' privacy or the owner is one of the followings if private
               
            });
        } else {
            $query->whereRaw('1 = 0');
        }
    }

 


    private function get_posts_from_followings_likes($my_followings,$followingIds_arr)
    {
        $postsFromLikes = Post::with(['user', 'userPostLike', 'poll', 'postLikes'])
        ->withCount(['replies', 'postLikes'])

        ->whereHas('postLikes', function ($query) use ($my_followings,$followingIds_arr) {
            $this->filterPostsByLikes($query, $my_followings,$followingIds_arr);
        }) 
        ->get();

   
        return $postsFromLikes;
    }

    private function get_posts_from_current_user_likes($my_followings,$followingIds_arr)
    {
        $authUserId = Auth::id();

        $postsFromCurrentUserLikes = Post::with(['user', 'userPostLike', 'poll', 'postLikes'])
            ->withCount(['replies', 'postLikes'])
            ->whereHas('postLikes', function ($query) use ($my_followings,$followingIds_arr) {
                $this->filterPostsByCurrentUserLikes($query, $my_followings,$followingIds_arr);
            })
            ->get();


        $postsFromCurrentUserLikes->each(function ($post) use ($authUserId) {
            $latestLike = $post->postLikes()->where('user_id', $authUserId)->latest('created_at')->first();
            $post->ordered_date = $latestLike ? $latestLike->created_at : null;
        });

        return $postsFromCurrentUserLikes;
    }

    private function get_posts_from_current_user_and_his_followings($my_followings, $followingIds_arr)
    {
        $posts_From_Current_User_And_His_Followings = Post::with(['user', 'userPostLike', 'poll', 'postLikes'])
            ->withCount(['replies', 'postLikes'])
            ->where(function ($query) use ($my_followings) {
                $this->filterPostsByFollowings($query, $my_followings);
            })
            ->orWhere('user_id', Auth::id()) // Include own posts 
            ->get();

        // Add the is_liked property to each post
        if ($posts_From_Current_User_And_His_Followings->isNotEmpty()) {
            $posts_From_Current_User_And_His_Followings->each(function ($post) {
                $post->ordered_date = $post->created_at;
            });
        }

        return $posts_From_Current_User_And_His_Followings;
    }

    private function fetchPosts()
    {
        $my_followings = Follow::getFollowings(Auth::id());
        $followingIds_arr = $my_followings->isNotEmpty() ? $my_followings->pluck('following_id')->toArray() : [];

        $posts_From_Current_User_And_His_Followings = $this->get_posts_from_current_user_and_his_followings($my_followings, $followingIds_arr);

        $posts_From_Current_User_Likes = $this->get_posts_from_current_user_likes($my_followings, $followingIds_arr);

        $postsFromLikes = $this->get_posts_from_followings_likes($my_followings,$followingIds_arr);

        // $posts_From_Current_User_And_His_Followings = collect();
        // $posts_From_Current_User_Likes = collect();
        // $postsFromLikes = collect();

        return [
            'followings' => $posts_From_Current_User_And_His_Followings,
            'current_user_likes' => $posts_From_Current_User_Likes,
            'user_followings_likes' => $postsFromLikes,
        ];
    }


    public function get_posts()
    {
        try {
            $this->clear_posts_cache(); // remove this line later

            $cacheKey = 'posts_page_' . request('page', 1);


            $postsData = Cache::remember($cacheKey, now()->addMinutes(10), function () {
                return $this->fetchPosts();
            });

            $postsFromFollowings = $postsData['followings'];
            $current_user_likes = $postsData['current_user_likes'];
            $postsFromLikes = $postsData['user_followings_likes'];

            /////////////////////////////////////////////////////////////////////////////////////////////
            /**  Remove posts related to blocked users **/
            /** @var \App\Models\User $current_user */
            $current_user = Auth::user();

            $current_user_likes = $current_user_likes->reject(function ($post) use ($current_user) 
            { 
                return in_array($post->user_id, $current_user->getBlockedUsersIds());
            });
            /////////////////////////////////////////////////////////////////////////////////////////////
            $formattedLikedPosts = $this->formatLikedByPosts($postsFromLikes);

            $mergedPosts = collect($postsFromFollowings)
                ->merge($formattedLikedPosts)
                ->merge($current_user_likes);

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


    public function formatePosts($posts)
    {
        try 
        { 
            $maxLength = 200; // الحد الأقصى لطول النص الذي سيتم عرضه
            $postsData = $posts->map(function ($post) use ($maxLength) {
                $post_text = $post->text ? htmlspecialchars($post->text, ENT_QUOTES, 'UTF-8') : null;
                if ($post_text) {
                    $post_text = TextHelper::processMentions($post_text);
                }
                $post_image = $post->image ?json_decode( $post->image) : null;
                $user_name = $post->user->name ? htmlspecialchars($post->user->name, ENT_QUOTES, 'UTF-8') : null;
                $user_username = $post->user->username ? htmlspecialchars($post->user->username, ENT_QUOTES, 'UTF-8') : null;
                $user_cover_image = $post->user->profile->cover_image ? htmlspecialchars($post->user->profile->cover_image, ENT_QUOTES, 'UTF-8') : null;
                $is_private = $post->user->account_privacy == AccountPrivacy::PRIVATE ? true : false;
    
                $pollData = null;
                if ($post->poll) {
                    $pollData = [
                        'expires_at' => $post->poll->expires_at->format('Y-m-d H:i:s'),
                        'options' => [
                            [
                                'option_text' => $post->poll->option1_text,
                                'votes'       => $post->poll->option1_votes,
                            ],
                            [
                                'option_text' => $post->poll->option2_text,
                                'votes'       => $post->poll->option2_votes,
                            ],
                            [
                                'option_text' => $post->poll->option3_text,
                                'votes'       => $post->poll->option3_votes,
                            ],
                            [
                                'option_text' => $post->poll->option4_text,
                                'votes'       => $post->poll->option4_votes,
                            ],
                        ],
                    ];
                }
                
                return [
                    'is_owner' => Auth::id() === $post->user_id,
                    'slug_id' => $post->slug_id,
    
                    'user' => [
                        'name' => $user_name,
                        'username' => $user_username,
                        'cover_image' => $user_cover_image,
                        'is_private' => $is_private
                    ],
                    'poll' => $pollData,
                    'post_type' => $post->post_type,
                    'text' => mb_strlen($post_text) > $maxLength
                        ? mb_substr($post_text, 0, $maxLength) . '...'
                        : $post_text,
                    'image' => $post_image,
                    'created_at' => Carbon::parse($post->created_at)->diffForHumans(),
                    'comments_count' => $post->replies_count ?? 0,
                    'reposts_count' => $post->reposts_count ?? 0,
                    'post_likes_count' => $post->post_likes_count  ?? 0,
                    // إضافة حالة الإعجاب
                    'is_post_liked' => $post->userPostLike !== null,
    
                ];
            });

            return ['code' => 1, 'data' => $postsData];
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }


    public function getPostsByUserId($user_id)
    {
        try 
        {
            $posts = Post::where('user_id', $user_id)
                         ->with(['user', 'userPostLike', 'poll']) // تضمين علاقة الإعجاب للمستخدم الحالي
                         ->withCount('replies')
                         ->withCount('postLikes')
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);

            return ['code' => 1, 'data' => $posts];
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }

    public function getMediaPostsByUsername($username)
    {
        try 
        {
            $res_getUserByUsername = (new UserService)->getUserByUsername($username);

            if($res_getUserByUsername['code'] == 0)
            {
                throw new Exception($res_getUserByUsername['msg']);
            }
           
            $user = $res_getUserByUsername['data'];

            $posts = Post::where('user_id', $user->id)
                         ->whereNotNull('image')
                         ->where('image', '!=', json_encode([]))
                         ->with(['user', 'userPostLike']) // تضمين علاقة الإعجاب للمستخدم الحالي
                         ->withCount('replies')
                         ->withCount('postLikes')
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);

            $res_formatePosts = $this->formatePosts($posts);

            if($res_formatePosts['code'] == 0)
            {
                throw new Exception($res_formatePosts['msg']);
            }

            return ['code' => 1, 
                    'data' => $res_formatePosts['data'],
                    'next_page' => $posts->hasMorePages() ? $posts->currentPage() + 1 : null]; 

        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }
    public function getLikedPostsByUsername(String $username)
    {
        try 
        {
            $res_getUserByUsername = (new UserService)->getUserByUsername($username);

            if($res_getUserByUsername['code'] == 0)
            {
                throw new Exception($res_getUserByUsername['msg']);
            }
           
            $user = $res_getUserByUsername['data'];

            $likedPostIds = DB::table('post_likes')
                              ->where('user_id', $user->id)
                              ->pluck('post_id');

            $posts = Post::whereIn('id', $likedPostIds)
                ->with(['user', 'userPostLike', 'poll'])
                ->withCount(['replies', 'postLikes'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $res_formatePosts = $this->formatePosts($posts);

            if($res_formatePosts['code'] ==0)
            {
                throw new Exception($res_formatePosts['msg']);
            }

            return ['code' => 1, 
                    'data' => $res_formatePosts['data'],
                    'next_page' => $posts->hasMorePages() ? $posts->currentPage() + 1 : null]; 

        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }
    public function getPostsByUsername($username)
    {
        try 
        {
            $res_getUserByUsername = (new UserService)->getUserByUsername($username);

            if($res_getUserByUsername['code'] == 0)
            {
                throw new Exception($res_getUserByUsername['msg']);
            }
           
            $user = $res_getUserByUsername['data'];

            $res_getPostsByUserId = $this->getPostsByUserId($user->id);

            if($res_getPostsByUserId['code'] == 0)
            {
                throw new Exception($res_getPostsByUserId['msg']);
            }

            $posts = $res_getPostsByUserId['data'];

            $res_formatePosts = $this->formatePosts($posts);

            if($res_formatePosts['code'] ==0)
            {
                throw new Exception($res_formatePosts['msg']);
            }

            return ['code' => 1, 
                    'data' => $res_formatePosts['data'],
                    'next_page' => $posts->hasMorePages() ? $posts->currentPage() + 1 : null]; 
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }
}
