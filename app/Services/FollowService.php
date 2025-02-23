<?php

namespace App\Services;

use App\Models\AccountPrivacy;
use App\Models\Follow;
use App\Models\User;
use App\Traits\CacheClearable;
use Exception;
use Illuminate\Support\Facades\Auth;

class FollowService
{
    use CacheClearable;

    public function handle_follow_request($username)
    {
        try 
        {
            if (!Auth::check()) 
            {
                throw new Exception(__('follows.unauthenticated'));
            }
          
            /** @var \App\Models\User $current_user */
            $current_user = Auth::user();
            $target_user = User::where('username', $username)->first(); // the user who current user want to follow

            // منع المستخدم من متابعة نفسه
            if ($current_user->id === $target_user->id) 
            {
                throw new Exception(__('follows.user_cannot_follow_self'));
            }
            
            $data = [];
            $is_already_following = $current_user->isFollowing($target_user);
            $has_already_sent_follow_request = $current_user->hasPendingFollowRequest($target_user);
            // $is_followed_by_target_user = $current_user->isFollower($target_user);

            if ($has_already_sent_follow_request || $is_already_following) 
            {
                Follow::where([
                    'follower_id' => $current_user->id,
                    'following_id' => $target_user->id
                ])->delete();
            
                $messageKey = $has_already_sent_follow_request 
                    ? 'follows.user_follow_request_removed_successfully' 
                    : 'follows.user_follow_removed_successfully';
            
                $data = [
                    'message' => __($messageKey),
                    'follow_text_btn' => __('follows.user_follow')
                ];
            }
            else
            {
                if($target_user->is_private())
                {
                    $follow = Follow::create([
                        'follower_id'  => $current_user->id,
                        'following_id' => $target_user->id,
                        // 'is_pending'   => $is_followed_by_target_user ? false : true
                        'is_pending'   => true
                    ]);

                    if (!$follow) 
                    {
                        throw new Exception("Can not add row to follows table");
                    }

                    // $data = [
                    //     'message' => $is_followed_by_target_user ? __('follows.user_follow_successfully') : __('follows.user_follow_request_successfully'),
                    //     'follow_text_btn' => $is_followed_by_target_user ? __('follows.user_cancel_follow') : __('follows.pending')
                    // ]; 
                     $data = [
                        'message' =>  __('follows.user_follow_request_successfully'),
                        'follow_text_btn' =>  __('follows.pending')
                    ]; 
                }
                else 
                {
                    $follow = Follow::create([
                        'follower_id'  => $current_user->id,
                        'following_id' => $target_user->id,
                        'is_pending'   => false
                    ]);

                    if (!$follow) 
                    {
                        throw new Exception("Can not add row to follows table");
                    }

                    $data = [
                        'message' => __('follows.user_follow_successfully'),
                        'follow_text_btn' => __('follows.user_cancel_follow')
                    ];
                }
            }
            $data+=[
                'followers_count' => $target_user->followers()->count(),
                'following_count' => $current_user->following()->count(),
                'success' => true,
            ];

            $this->clear_posts_cache();
            return ['code' => 1 , 'data' => $data];

        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }
    public function approve_follow_request($id)
    {
        try 
        {
            $request = Follow::findOrFail($id);
            $request->is_pending = false;
            if($request->save())
            {
                $this->clear_posts_cache();
                return ['code' => 1, 'data' => true];
            }
            else 
            {
                throw new Exception('Can not approve the request , something went wrong');
            }            
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    public function deny_follow_request($id)
    {
        try 
        {
            $request = Follow::findOrFail($id);  
            if($request->delete())
            {
                $this->clear_posts_cache();
                return ['code' => 1, 'data' => true];
            }
            else 
            {
                throw new Exception('Can not deny the request , something went wrong');
            }            
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    function get_follow_up_requests($user_id)
    {
        try 
        {
            $user = User::findOrFail($user_id);
             // Get all pending follow requests where the current user is the 'following' user
            $pendingRequests = Follow::where('following_id', $user->id)
                                     ->where('is_pending', true)
                                     ->with('follower') // Assuming 'follower' is a relationship defined on the Follow model
                                     ->orderBy('created_at','DESC')
                                     ->get();

            // Update is_seen for all pending requests
            Follow::where('following_id', $user->id)
                  ->where('is_pending', true)
                  ->where('is_seen', false)
                  ->update(['is_seen' => true]);

            return ['code' => 1, 'data' => $pendingRequests];


        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }
}
