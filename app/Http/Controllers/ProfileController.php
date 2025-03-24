<?php

namespace App\Http\Controllers;

use App\Helpers\TextHelper;
use App\Models\AccountPrivacy;
use App\Models\User;
use App\Models\Post;
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
        if (!$user) 
        {
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
        if ($is_following) 
        {
            $follow_btn_status_text = __('profile.user_cancel_follow');
        } 
        elseif ($is_pending) 
        {
            $follow_btn_status_text = __('follows.pending');
        } 
        else 
        {
            $follow_btn_status_text = __('profile.user_follow');
        }


        // $is_profile_locked = ($user->account_privacy == 'private') && (!$is_following || $is_pending) && (Auth::id() !== $user->id) && (!$is_follower);
        $is_profile_locked = ($user->account_privacy == 'private') && (!$is_following || $is_pending) && (Auth::id() !== $user->id);
        
        

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
            'registered_since' => __('profile.registered_since'). ' ' . Carbon::parse($user->created_at)->translatedFormat('F - Y'),
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
        ]; 
        return view('profile.profile', ['data' => $data]);
    }

    // عرض المنشورات الخاصة بالمستخدم
    public function getPostsByUsername(String $username)
    {
        $maxLength = 200; // الحد الأقصى لطول النص الذي سيتم عرضه

        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => __('profile.profile_user_not_found')
            ], 200);
        }

        // استرجاع المنشورات مع بيانات المستخدم والإعجابات
        $posts = Post::where('user_id', $user->id)->with(['user', 'userPostLike', 'poll']) // تضمين علاقة الإعجاب للمستخدم الحالي
        ->withCount('replies')
                    ->withCount('postLikes')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        // تعديل البيانات التي سيتم إرجاعها
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

        // إرجاع النتيجة كـ JSON
        return response()->json([
            'success' => true,
            'posts' => $postsData,
            'next_page' => $posts->hasMorePages() ? $posts->currentPage() + 1 : null,
        ]);
    }

    // عرض المنشورات التي تحتوي على ردود
    public function getRepliesByUsername(String $username)
    {
        $maxLength = 200; // الحد الأقصى لطول النص الذي سيتم عرضه
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => __('profile.profile_user_not_found')
            ], 200);
        }

        $posts = Post::where('user_id', $user->id)->whereHas('replies')->with(['user', 'userPostLike', 'poll']) // تضمين علاقة الإعجاب للمستخدم الحالي
        ->withCount('replies')
                    ->withCount('postLikes')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        // تعديل البيانات التي سيتم إرجاعها
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
                    'is_private' => $is_private,
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

        // إرجاع النتيجة كـ JSON
        return response()->json([
            'success' => true,
            'posts' => $postsData,
            'next_page' => $posts->hasMorePages() ? $posts->currentPage() + 1 : null,
        ]);
    }

    // عرض المنشورات التي تحتوي على وسائط
    public function getMediaPostsByUsername(String $username)
    {
        $maxLength = 200; // الحد الأقصى لطول النص الذي سيتم عرضه

        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => __('profile.profile_user_not_found')
            ], 200);
        }

            $posts = Post::where('user_id', $user->id)->whereNotNull('image')->with(['user', 'userPostLike']) // تضمين علاقة الإعجاب للمستخدم الحالي
            ->withCount('replies')
                        ->withCount('postLikes')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
    
            // تعديل البيانات التي سيتم إرجاعها
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
                return [
                    'is_owner' => Auth::id() === $post->user_id,
                    'slug_id' => $post->slug_id,
    
                    'user' => [
                        'name' => $user_name,
                        'username' => $user_username,
                        'cover_image' => $user_cover_image,
                        'is_private' => $is_private,
                    ],
                    
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
    
            // إرجاع النتيجة كـ JSON
            return response()->json([
                'success' => true,
                'posts' => $postsData,
                'next_page' => $posts->hasMorePages() ? $posts->currentPage() + 1 : null,
            ]);
    }

    // عرض المنشورات التي أُعجب بها المستخدم
    public function getLikedPostsByUsername(String $username)
    {
        $maxLength = 200; // الحد الأقصى لطول النص الذي سيتم عرضه
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => __('profile.profile_user_not_found')
            ], 200);
        }

        $posts = Post::where('user_id', $user->id)->whereHas('userPostLike')->with(['user', 'userPostLike', 'poll']) // تضمين علاقة الإعجاب للمستخدم الحالي
        ->withCount('replies')
                    ->withCount('postLikes')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        // تعديل البيانات التي سيتم إرجاعها
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
                    'is_private' => $is_private ,
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

        // إرجاع النتيجة كـ JSON
        return response()->json([
            'success' => true,
            'posts' => $postsData,
            'next_page' => $posts->hasMorePages() ? $posts->currentPage() + 1 : null,
        ]);
    }
}
