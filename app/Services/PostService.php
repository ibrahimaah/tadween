<?php

namespace App\Services;

use App\Models\Follow;
use App\Models\Post; 
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostService
{
    public function get_home_page_posts()
    {
        try 
        { 
            
            $cacheKey = 'posts_page_' . request('page', 1);
        
            $posts = Cache::remember($cacheKey, now()->addMinutes(10), function () 
            {
                $followings = Follow::where('follower_id', Auth::id())
                                    ->where('is_pending',false)
                                    ->get(['following_id', 'created_at']);
                
                return Post::with(['user', 'userPostLike', 'poll'])
                            ->withCount(['replies', 'postLikes'])
                            ->where(function ($query) use ($followings) 
                            {
                                foreach ($followings as $follow) 
                                {
                                    $query->orWhere(function ($q) use ($follow) {
                                        $q->where('user_id', $follow->following_id)
                                        ->where('created_at', '>', $follow->created_at);
                                    });
                                }
                            })
                            ->orWhereHas('postLikes', function ($query) 
                            {
                                $query->where('user_id', Auth::id());
                            })
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
            });

             
            return ['code' => 1, 'data' => $posts];
            
            
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

 

    
  
}
