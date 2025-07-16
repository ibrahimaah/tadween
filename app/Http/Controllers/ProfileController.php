<?php

namespace App\Http\Controllers;

use App\Helpers\TextHelper;
use App\Models\AccountPrivacy;
use App\Models\Gift;
use App\Models\User;
use App\Models\Post;
use App\Services\PostService;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index(String $username)
    {
        // البحث عن المستخدم مع معلومات ملفه الشخصي وعدد المنشورات
        $user = User::with('profile')
            ->withCount('posts')
            ->withCount('followers')  // إضافة عداد المتابعين
            ->withCount('following')  // إضافة عداد المتابعين الذين يتابعهم
            ->where('username', $username)
            ->first();

        // التحقق إذا كان المستخدم موجودًا
        if (!$user) {
            return redirect()->route('home')->with('error', __('profile.profile_user_not_found'));
        }
        // Check follow status
        /** @var \App\Models\User $current_user */
        $current_user = Auth::user();
        $is_following = $current_user->isFollowing($user);
        $is_pending = $current_user->hasPendingFollowRequest($user);

        // $is_follower = $current_user->isFollower($user); 

        // Determine button text
        $follow_btn_status_text = '';
        if ($is_following) {
            $follow_btn_status_text = __('profile.user_cancel_follow');
        } elseif ($is_pending) {
            $follow_btn_status_text = __('follows.pending');
        } else {
            $follow_btn_status_text = __('profile.user_follow');
        }


        // $is_profile_locked = ($user->account_privacy == 'private') && (!$is_following || $is_pending) && (Auth::id() !== $user->id) && (!$is_follower);
        $is_profile_locked = ($user->account_privacy == 'private') && (!$is_following || $is_pending) && (Auth::id() !== $user->id);
        $can_not_see_followers = ($current_user->isBlockedBy($user)) || (($user->account_privacy == 'private') && (!$is_following) && ($current_user->id !== $user->id));
        $can_not_see_followings = $can_not_see_followers;
        $can_not_see_gifts = $can_not_see_followers;
        // dd((($user->account_privacy == 'private') && (!$is_following)));

        // إعداد البيانات المراد عرضها
        $data = [
            'is_owner' => Auth::id() === $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'user_id' => $user->id,
            // 'background_image' => $user->profile->background_image ?? asset('cover/logo.png'),
            'background_image' => $user->profile->background_image ?? null,
            'cover_image' => $user->profile->cover_image ?? asset('img/user.jpg'),
            'bio' => $user->profile->bio ?? null,
            'country' => $user->profile->country ?? null,
            'city' => $user->profile->city ?? null,
            'registered_since' => __('profile.registered_since') . ' ' . Carbon::parse($user->created_at)->translatedFormat('F - Y'),
            'post_count' => $user->posts_count,
            'follower_count' => $user->followers_count,
            'following_count' => $user->following_count,
            'is_following' => $is_following,
            'follow_btn_status_text' => $follow_btn_status_text,
            // 'is_public' => $user->account_privacy == 'public' ? true : false,
            'is_profile_locked' => $is_profile_locked,
            'is_private' => $user->account_privacy == AccountPrivacy::PRIVATE,
            'is_blocked' => $user->isBlockedBy($current_user),
            'is_been_blocked' => $current_user->isBlockedBy($user),
            'can_not_see_followers' => $can_not_see_followers,
            'can_not_see_followings' => $can_not_see_followings,
            'can_not_see_gifts' => $can_not_see_gifts,
            'received_gifts' => $user->receivedGifts()->count(),
        ];

        

        return view('profile.profile', compact('data'));
    }

    // عرض المنشورات الخاصة بالمستخدم
    public function getPostsByUsername(String $username)
    {
        $res_getPostsByUsername = (new PostService)->getPostsByUsername($username);

        if ($res_getPostsByUsername['code'] == 0) {
            return response()->json([
                'success' => false,
                'message' => $res_getPostsByUsername['msg']
            ], 200);
        }
        // إرجاع النتيجة كـ JSON
        return response()->json([
            'success' => true,
            'posts' => $res_getPostsByUsername['data'],
            'next_page' => $res_getPostsByUsername['next_page']
        ]);
    }

    // عرض المنشورات التي تحتوي على ردود
    public function getRepliesByUsername(String $username)
    {
        $res_getRepliesByUsername = (new PostService)->getRepliesByUsername($username);

        if ($res_getRepliesByUsername['code'] == 0) {
            return response()->json([
                'success' => false,
                'message' => $res_getRepliesByUsername['msg']
            ], 200);
        }
        // إرجاع النتيجة كـ JSON
        return response()->json([
            'success' => true,
            'posts' => $res_getRepliesByUsername['data'],
            'next_page' => $res_getRepliesByUsername['next_page']
        ]);

    }


    // عرض المنشورات التي تحتوي على وسائط
    public function getMediaPostsByUsername(String $username)
    {
        $res_getMediaPostsByUsername = (new PostService)->getMediaPostsByUsername($username);

        if ($res_getMediaPostsByUsername['code'] == 0) {
            return response()->json([
                'success' => false,
                'message' => $res_getMediaPostsByUsername['msg']
            ], 200);
        }
        // إرجاع النتيجة كـ JSON
        return response()->json([
            'success' => true,
            'posts' => $res_getMediaPostsByUsername['data'],
            'next_page' => $res_getMediaPostsByUsername['next_page']
        ]);
    }

    // عرض المنشورات التي أُعجب بها المستخدم
    public function getLikedPostsByUsername(String $username)
    {
        $res_getLikedPostsByUsername = (new PostService)->getLikedPostsByUsername($username);

        if ($res_getLikedPostsByUsername['code'] == 0) {
            return response()->json([
                'success' => false,
                'message' => $res_getLikedPostsByUsername['msg']
            ], 200);
        }
        // إرجاع النتيجة كـ JSON
        return response()->json([
            'success' => true,
            'posts' => $res_getLikedPostsByUsername['data'],
            'next_page' => $res_getLikedPostsByUsername['next_page']
        ]);
    }
}
