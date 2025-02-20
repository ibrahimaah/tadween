<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;
use App\Services\FollowService;
use App\Traits\ErrorResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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
        // التحقق من تسجيل الدخول
        if (!Auth::check()) 
        {
            return response()->json([
                'success' => false,
                'message' => __('follows.unauthenticated'),
            ], 200); // استجابة غير مصرح بها
        }
    
        $request->validate([
            'userName' => 'required|exists:users,username',
        ]);
    
        $user = User::where('username', $request->userName)->first();
    
        // منع المستخدم من متابعة نفسه
        if (Auth::id() === $user->id) 
        {
            return response()->json([
                'success' => false,
                'message' => __('follows.user_cannot_follow_self'),
            ], 200); // رسالة خطأ إذا حاول المستخدم متابعة نفسه
        }
    
        // التحقق إذا كان المستخدم قد تابع المستخدم مسبقًا
        $follow = Follow::where([
            'follower_id' => Auth::id(),
            'following_id' => $user->id
        ]);
    
        $isFollowing = $follow->exists();
        $message = $isFollowing ? __('follows.user_follow_removed_successfully') : $this->handleFollowRequest($user);
    
        if ($isFollowing) {
            $follow->delete();
        } else {
            $follow->create([
                'follower_id' => Auth::id(),
                'following_id' => $user->id,
                'is_pending' => $user->account_privacy == 'private',
            ]);
        }
    
        Cache::forget('posts_page_' . request('page', 1));
    
        return response()->json([
            'success' => true,
            'follow_text_btn' => $this->getFollowButtonText($isFollowing, $user),
            'message' => $message,
            'is_user_follow' => !$isFollowing,
            'followers_count' => $user->followers()->count(),
            'following_count' => Auth::user()->following()->count(),
        ], 200);
    }
    
    private function handleFollowRequest($user)
    {
        if ($user->account_privacy == 'private') 
        {
            return __('follows.user_follow_request_successfully');
        }
        
        return __('follows.user_follow_successfully');
    }
    
    private function getFollowButtonText($isFollowing, $user)
    {
        return $isFollowing ? __('follows.user_follow') : ($user->account_privacy == 'private' ? __('follows.pending') : __('follows.user_cancel_follow'));
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

        // Load the followers with the follower's user data
        $followers = Follow::where('following_id', $user->id)
        ->with('follower')
        ->paginate(10);

        // Map the followers to include follower details
        $followsData = $followers->map(function ($follower) {
            $followerUser = $follower->follower;
            
            $user_name = $followerUser->name ? htmlspecialchars($followerUser->name, ENT_QUOTES, 'UTF-8') : null;
            $user_username = $followerUser->username ? htmlspecialchars($followerUser->username, ENT_QUOTES, 'UTF-8') : null;
            $user_cover_image = $followerUser->profile->cover_image ? htmlspecialchars($followerUser->profile->cover_image, ENT_QUOTES, 'UTF-8') : null;
            $user_bio = $followerUser->profile->bio ? htmlspecialchars($followerUser->profile->bio, ENT_QUOTES, 'UTF-8') : null;

            // التحقق إذا كان المستخدم الحالي يتابع هذا المتابع
            $is_following_follower = Auth::check() && Auth::user()->following->contains($followerUser->id);

            return [
                'name' => $user_name,
                'username' => $user_username,
                'cover_image' => $user_cover_image,
                'user_bio' => $user_bio,
                'follower_btn_text' => $is_following_follower ? __('follows.user_cancel_follow') : __('profile.user_follow'),
                'is_following' => $is_following_follower, // إضافة حالة المتابعة
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

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => __('follows.user_not_found'),
            ], 200);
        }
        
        // Load the followings with the followings user data
        $followings = Follow::where('follower_id', $user->id)
        ->with('following')
        ->paginate(10);

        // Map the followings to include followings details
        $followingsData = $followings->map(function ($following) {
            $followingUser = $following->following;
            
            $user_name = $followingUser->name ? htmlspecialchars($followingUser->name, ENT_QUOTES, 'UTF-8') : null;
            $user_username = $followingUser->username ? htmlspecialchars($followingUser->username, ENT_QUOTES, 'UTF-8') : null;
            $user_cover_image = $followingUser->profile->cover_image ? htmlspecialchars($followingUser->profile->cover_image, ENT_QUOTES, 'UTF-8') : null;
            $user_bio = $followingUser->profile->bio ? htmlspecialchars($followingUser->profile->bio, ENT_QUOTES, 'UTF-8') : null;

            // التحقق إذا كان المستخدم الحالي يتابع هذا المتابع
            $is_following_follower = Auth::check() && Auth::user()->following->contains($followingUser->id);

            return [
                'name' => $user_name,
                'username' => $user_username,
                'cover_image' => $user_cover_image,
                'user_bio' => $user_bio,
                'follower_btn_text' => $is_following_follower ? __('follows.user_cancel_follow') : __('follows.user_follow'),
                'is_following' => $is_following_follower, // إضافة حالة المتابعة
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
        $user = Auth::user();
        if (!$user->is_private()) 
        {
            abort(403);
        }
        // Get all pending follow requests where the current user is the 'following' user
        $pendingRequests = Follow::where('following_id', $user->id)
                                ->where('is_pending', true)
                                ->with('follower') // Assuming 'follower' is a relationship defined on the Follow model
                                ->orderBy('created_at','DESC')
                                ->get();

        return view('follow_up_requests.index', compact('pendingRequests'));
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
