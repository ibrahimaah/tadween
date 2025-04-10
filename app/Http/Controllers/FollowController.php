<?php

namespace App\Http\Controllers;

use App\Models\AccountPrivacy;
use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;
use App\Services\FollowService;
use App\Traits\ErrorResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class FollowController extends Controller
{
    use ErrorResponse;

    public function __construct(private FollowService $followService){}

    

    public function getFollowers()
    {
        return view('follow.followers');
    }

    public function getFollowings()
    {
        return view('follow.followings');
    }

    //Follow Or Cancel Follow
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userName' => 'required|exists:users,username',
        ]);

        if ($validator->fails()) 
        {
            return response()->json([
                'success' => false,
                'message' => __('validation.failed'), // Customize this message as needed
                'errors' => $validator->errors(),
            ], 422);
        }

        $res_handle_follow_request = $this->followService->handle_follow_request($request->userName);
        
        if ($res_handle_follow_request['code'] == 0) 
        {
            return response()->json([
                'success' => false,
                'message' => $res_handle_follow_request['msg']
            ], 200);
        }

        return response()->json($res_handle_follow_request['data'] , 200);
    }
    
    private function handleFollowRequest($user)
    {
        if ($user->account_privacy == 'private') 
        {
            return __('follows.user_follow_request_successfully');
        }
        
        return __('follows.user_follow_successfully');
    }
    
    private function getFollowButtonText($isFollowing,$is_follower, $user)
    {
        return $isFollowing ? __('follows.user_follow') : ((($user->account_privacy == 'private') && (!$is_follower)) ? __('follows.pending') : __('follows.user_cancel_follow'));
    }
    

    
    //Fetch Followers By UserName
    public function loadFollowers(String $username)
    {
        // Fetch the user by username
        $user = User::where('username', $username)->first();

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => __('follows.user_not_found'),
            ], 200);
        }

        /** @var \App\Models\User $current_user */
        $current_user = Auth::user();

        // Get followers while excluding users who blocked the current user
        $followersQuery = Follow::where('following_id', $user->id)
            ->where('is_pending', false)
            ->whereHas('follower', function ($query) use ($current_user) {
                $query->whereDoesntHave('blockedUsers', function ($blockQuery) use ($current_user) {
                    $blockQuery->where('blocked_user_id', $current_user->id);
                });
            })
            ->with('follower');

        $followers = $followersQuery->paginate(10);

        $followsData = $followers->map(function ($follower) use ($current_user) {
            $followerUser = $follower->follower;

            $user_name = $followerUser->name ? htmlspecialchars($followerUser->name, ENT_QUOTES, 'UTF-8') : null;
            $user_username = $followerUser->username ? htmlspecialchars($followerUser->username, ENT_QUOTES, 'UTF-8') : null;
            $user_cover_image = $followerUser->profile->cover_image ? htmlspecialchars($followerUser->profile->cover_image, ENT_QUOTES, 'UTF-8') : null;
            $user_bio = $followerUser->profile->bio ? htmlspecialchars($followerUser->profile->bio, ENT_QUOTES, 'UTF-8') : null;

            $is_following_follower = Auth::check() && Auth::user()->following->contains($followerUser->id);
            $is_blocked_by_current_user = $followerUser->isBlockedBy($current_user);
            $is_same_as_current_user = $current_user->id == $followerUser->id ? true : false;

            return [
                'name' => $user_name,
                'username' => $user_username,
                'cover_image' => $user_cover_image,
                'user_bio' => $user_bio,
                'follower_btn_text' => $is_following_follower ? __('follows.user_cancel_follow') : __('profile.user_follow'),
                'is_following' => $is_following_follower,
                'is_private' => $followerUser->account_privacy == AccountPrivacy::PRIVATE ? true : false,
                'is_blocked_by_current_user' => $is_blocked_by_current_user,
                'blocked_btn_txt' => __('follows.blocked'),
                'is_same_as_current_user' => $is_same_as_current_user
            ];
        });

        // Return the data as JSON
        return response()->json([
            'success' => true,
            'follows' => $followsData,
            'next_page' => $followers->hasMorePages() ? $followers->currentPage() + 1 : null,
        ]);

    }

    //Fetch Followings By UserName
    public function loadFollowings(String $username)
    {
        // Fetch the user by username
        $user = User::where('username', $username)->first();
        /** @var \App\Models\User $current_user */
        $current_user = Auth::user();
        // Check if the user exists
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => __('follows.user_not_found'),
            ], 200);
        }
        
        // Load the followings with the followings user data
        // $followings = Follow::where('follower_id', $user->id)->where('is_pending',false)
        // ->with('following')
        // ->paginate(10);

        $followings = Follow::where('follower_id', $user->id)
                                ->where('is_pending', false)
                                ->whereHas('following', function ($query) use ($current_user) {
                                    $query->whereDoesntHave('blockedUsers', function ($blockQuery) use ($current_user) {
                                        $blockQuery->where('blocked_user_id', $current_user->id);
                                    });
                                })
                                ->with('following')
                                ->paginate(10);


        // Map the followings to include followings details
        $followingsData = $followings->map(function ($following) use($current_user) {
            $followingUser = $following->following;
            
            $user_name = $followingUser->name ? htmlspecialchars($followingUser->name, ENT_QUOTES, 'UTF-8') : null;
            $user_username = $followingUser->username ? htmlspecialchars($followingUser->username, ENT_QUOTES, 'UTF-8') : null;
            $user_cover_image = $followingUser->profile->cover_image ? htmlspecialchars($followingUser->profile->cover_image, ENT_QUOTES, 'UTF-8') : null;
            $user_bio = $followingUser->profile->bio ? htmlspecialchars($followingUser->profile->bio, ENT_QUOTES, 'UTF-8') : null;

            // التحقق إذا كان المستخدم الحالي يتابع هذا المتابع
            $is_following_follower = Auth::check() && Auth::user()->following->contains($followingUser->id);
            $is_blocked_by_current_user = $followingUser->isBlockedBy($current_user);
            $is_same_as_current_user = $current_user->id == $followingUser->id ? true : false;
            

            return [
                'name' => $user_name,
                'username' => $user_username,
                'cover_image' => $user_cover_image,
                'user_bio' => $user_bio,
                'follower_btn_text' => $is_following_follower ? __('follows.user_cancel_follow') : __('follows.user_follow'),
                'is_following' => $is_following_follower, // إضافة حالة المتابعة
                'is_private' => $followingUser->account_privacy == AccountPrivacy::PRIVATE ? true : false,
                'is_blocked_by_current_user' => $is_blocked_by_current_user,
                'blocked_btn_txt' => __('follows.blocked'),
                'is_same_as_current_user' => $is_same_as_current_user
            ];
        });

        // Return the data as JSON
        return response()->json([
            'success' => true,
            'follows' => $followingsData,
            'next_page' => $followings->hasMorePages() ? $followings->currentPage() + 1 : null,
        ]);
    }

    public function follow_up_requests()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->is_private()) 
        {
            return redirect()->route('home');
        }


        $res_get_follow_up_requests = $this->followService->get_follow_up_requests(Auth::id());
        if($res_get_follow_up_requests['code'] == 0)
        {
            dd($res_get_follow_up_requests['msg']);
        }
        else 
        {
            return view('follow_up_requests.index', ['pendingRequests' => $res_get_follow_up_requests['data']]);
        }
        
    }

    public function approveFollowRequest($id)
    {
        $res_approve_follow_request = $this->followService->approve_follow_request($id);

        if ($res_approve_follow_request['code'] !== 1) 
        {
            return $this->get_error_response($res_approve_follow_request['msg']);
        }

        return response()->json([
            'code' => 1,
            'data' => true,
            'msg' => __('follow_up_requests.request_approved'),
        ]);
    }

    
    public function denyFollowRequest($id)
    {
        $res_deny_follow_request = $this->followService->deny_follow_request($id);

        if ($res_deny_follow_request['code'] == 0) 
        {
            return $this->get_error_response($res_deny_follow_request['msg']);
        }
        
        return response()->json([
            'code' => 1,
            'data' => true,
            'msg' => __('follow_up_requests.request_denied'),
        ]);
 
    }

    


}
