<?php

namespace App\Http\Controllers;

use App\Helpers\TextHelper;
use App\Models\AccountPrivacy;
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
        $can_not_see_followers = ($current_user->isBlockedBy($user)) || (($user->account_privacy == 'private') && (!$is_following));
        $can_not_see_followings = $can_not_see_followers;

        // إعداد البيانات المراد عرضها
        $data = [
            'is_owner' => Auth::id() === $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'background_image' => $user->profile->background_image ?? asset('img/logo.png'),
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
            'can_not_see_followings' => $can_not_see_followings
        ];
        return view('profile.profile', ['data' => $data]);
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
        $maxLength = 200;
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => __('profile.profile_user_not_found')
            ], 200);
        }

        $posts = Post::whereHas('replies', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->with([
                'user',
                'userPostLike',
                'poll',
                'replies' => function ($query) {
                    $query->where('user_id', auth()->id())->with('user');
                },
            ])
            ->withCount(['replies', 'postLikes'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    

        $postsData = $posts->map(function ($post) use ($maxLength) {
            $postData = [
                'slug_id' => $post->slug_id,
                'text' => $post->text ? TextHelper::processMentions(htmlspecialchars($post->text, ENT_QUOTES, 'UTF-8')) : null,
                'image' => $post->image ? json_decode($post->image) : null,
                'created_at' => $post->created_at->diffForHumans(),
                'comments_count' => $post->replies_count,
                'post_likes_count' => $post->post_likes_count,
                'is_post_liked' => $post->userPostLike !== null,
                'likedByPhrase' => $post->likedByPhrase ?? null,
                'is_owner' => auth()->check() && auth()->id() === $post->user_id,
                'post_type' => $post->post_type,
                'poll' => $post->poll ? [
                    'expires_at' => $post->poll->expires_at->format('Y-m-d H:i:s'),
                    'options' => collect([
                        ['option_text' => $post->poll->option1_text, 'votes' => $post->poll->option1_votes],
                        ['option_text' => $post->poll->option2_text, 'votes' => $post->poll->option2_votes],
                        ['option_text' => $post->poll->option3_text, 'votes' => $post->poll->option3_votes],
                        ['option_text' => $post->poll->option4_text, 'votes' => $post->poll->option4_votes],
                    ])->filter(fn($o) => !is_null($o['option_text']))->values(),
                ] : null,
                'user' => [
                    'id' => $post->user->id,
                    'name' => htmlspecialchars($post->user->name),
                    'username' => htmlspecialchars($post->user->username),
                    'cover_image' => optional($post->user->profile)->cover_image,
                    'is_private' => $post->user->account_privacy == AccountPrivacy::PRIVATE,
                ],
                'reposts_count' => $post->reposts_count,
                'replies' => $post->replies->map(function ($reply) {
                    return [
                        'text' => TextHelper::processMentions(htmlspecialchars($reply->reply_text)),
                        'created_at' => $reply->created_at->diffForHumans(),
                        'user' => [
                            'name' => htmlspecialchars($reply->user->name),
                            'username' => htmlspecialchars($reply->user->username),
                            'cover_image' => optional($reply->user->profile)->cover_image,
                        ]
                    ];
                })
            ];

            return $postData;
        });

        return response()->json([
            'success' => true,
            'posts' => $postsData,
            'next_page' => $posts->currentPage() < $posts->lastPage() ? $posts->currentPage() + 1 : null
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
