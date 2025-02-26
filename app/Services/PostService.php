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

class PostService
{
    use CacheClearable;
    public function get_posts()
    {
        try 
        {
            $this->clear_posts_cache(); // remove this line later

            $cacheKey = 'posts_page_' . request('page', 1);

            $my_followings = Follow::where(['follower_id' => Auth::id(),'is_pending' => false])->get(['following_id', 'created_at']);
            

            $followingIds_arr = $my_followings->pluck('following_id')->toArray();
            // Log::info(gettype($followingIds_arr));
            $posts = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($my_followings, $followingIds_arr) 
            {
                //users who i follow (them)


                // $followingIds_arr = $my_followings->pluck('following_id');

                return Post::with(['user', 'userPostLike', 'poll', 'postLikes'])->withCount(['replies', 'postLikes'])
                    //منشورات الاشخاص الذين أتابعهم
                    ->where(function ($query) use ($my_followings) 
                    {
                        foreach ($my_followings as $follow) 
                        {
                            $query->orWhere(function ($q) use ($follow) {
                                $q->where('user_id', $follow->following_id)
                                    ->where('created_at', '>', $follow->created_at);
                            });
                        }
                    })
                    // Get posts that my followings have liked
                    ->orWhereHas('postLikes', function ($query) use ($followingIds_arr) {
                        $query->whereIn('user_id', $followingIds_arr)
                              ->orWhere('user_id', Auth::id());// Also include posts I have liked
                    })
                    // Ensure posts belong to users who have public profiles or private but followed
                    ->whereHas('user', function ($query) use ($followingIds_arr) 
                    {
                        $query->where('account_privacy', AccountPrivacy::PUBLIC)
                              ->orWhere(function ($q) use ($followingIds_arr){
                                $q->where('account_privacy', AccountPrivacy::PRIVATE)->whereIn('id', $followingIds_arr);
                            }); 
                    })
                    ->orWhere('user_id', Auth::id()) // Include your own posts
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
            });
            // Log::info($posts);

            // Add a "liked by" phrase for posts liked by my followings
            foreach ($posts as $post) 
            {
                $likedByFollowings = $post->postLikes->filter(function ($post_like) use ($followingIds_arr) 
                {
                    return in_array($post_like->user_id, $followingIds_arr);
                });
                
                // If post is liked by someone I follow, add phrase
                if ($likedByFollowings->isNotEmpty()) 
                {
                    $post->likedByPhrase = __('messages.like_post', [
                        'user' => $likedByFollowings->map(function ($like) {
                            $name = $like->user->name;
                            $username = $like->user->username;
                            return "<a href='" . route('profile', ['username' => $username]) . "' class='text-orange-color text-decoration-none' target='_blank'>$name</a>";
                        })->join(', ')
                    ]);
                    
                    
                } 
                else 
                {
                    $post->likedByPhrase = ''; // No phrase if no followings liked it
                }
            }


            return ['code' => 1, 'data' => $posts];
        } catch (Exception $ex) {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
}
