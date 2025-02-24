<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
class ReplyController extends Controller
{
    //Add new reply on post
    public function store(Request $request)
    {
        // التحقق من تسجيل الدخول
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        try {
            // Validate the data
            $request->validate([
                'reply_text' => 'nullable|string|max:400',
                'reply_image' => 'nullable|image|mimes:jpeg,png,gif,webp,jpg|max:1024',
            ]);

            $post = Post::where('slug_id', $request->slug_id)->first();

            // Ensure the reply is not empty
            if (empty($request->reply_text) && !$request->hasFile('reply_image')) {
                return response()->json([
                    'success' => false,
                    'message' => __('home.post_reply_empty_error'),
                ], 200);
            }

            $imagePath = null;

            // تخزين الصورة إذا تم رفعها
            if ($request->hasFile('reply_image')) {
                $image = $request->file('reply_image');
                // تحديد اسم فريد لكل صورة لتجنب تكرار الأسماء
                $imageName = time() . '_' . uniqid('reply_', true) . '.' . $image->getClientOriginalExtension();

                // نقل الصورة إلى مجلد public/reply_image
                $image->move(public_path('replies_images'), $imageName);

                // إضافة المسار إلى المصفوفة
                $imagePath = 'replies_images/' . $imageName;
            }

            // Create the reply
            $reply = Reply::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id,
                'reply_text' => strip_tags($request->reply_text),
                'reply_image' => $imagePath,
                'slug_id' => Str::uuid(),
            ]);
        
            if ($reply) {
                // Load user data for the response
                $reply->load('user');
                // حساب عدد التعليقات الحالية للمنشور
                $comments_count = Reply::where('post_id', $post->id)->count();
                $reply_text = $reply->reply_text ? htmlspecialchars($reply->reply_text, ENT_QUOTES, 'UTF-8') : null;
                $reply_image = $reply->reply_image ? htmlspecialchars($reply->reply_image, ENT_QUOTES, 'UTF-8') : null;
                $user_name = $reply->user->name ? htmlspecialchars($reply->user->name, ENT_QUOTES, 'UTF-8') : null;
                $user_username = $reply->user->username ? htmlspecialchars($reply->user->username, ENT_QUOTES, 'UTF-8') : null;
                $user_cover_image = $reply->user->profile->cover_image ? htmlspecialchars($reply->user->profile->cover_image, ENT_QUOTES, 'UTF-8') : null;
                
                return response()->json([
                    'success' => true,
                    'message' => __('home.post_reply_success'),
                    'reply' => [
                        'is_owner' => Auth::id() === $reply->user_id,
                        'reply_text' => $reply_text,
                        'reply_image' => $reply_image,
                        'slug_id' => $reply->slug_id,
                        'comments_count' => $comments_count,
                        'created_at' => Carbon::parse($reply->created_at)->diffForHumans(),
                        'user' => [
                            'name' => $user_name,
                            'username' => $user_username,
                            'cover_image' => $user_cover_image,
                        ],
                    ],
                ], 200);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
            ], 200);
        } catch (\Exception $e) {
            // Handle unexpected exceptions
            return response()->json([
                'success' => false,
                'message' => __('home.unexpected_error'),
            ], 200);
        }
    }

    //Display All Replies On Post For Users
    public function loadReplies(Request $request)
    {
        $slugId = $request->input('slug_id');
        $post = Post::where('slug_id', $slugId)->firstOrFail();

        $replies = Reply::where('post_id', $post->id)
                        ->with('user')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        $repliesData = $replies->map(function ($reply) {
            $reply_text = $reply->reply_text ? htmlspecialchars($reply->reply_text, ENT_QUOTES, 'UTF-8') : null;
            $reply_image = $reply->reply_image ? htmlspecialchars($reply->reply_image, ENT_QUOTES, 'UTF-8') : null;
            $user_name = $reply->user->name ? htmlspecialchars($reply->user->name, ENT_QUOTES, 'UTF-8') : null;
            $user_username = $reply->user->username ? htmlspecialchars($reply->user->username, ENT_QUOTES, 'UTF-8') : null;
            $user_cover_image = $reply->user->profile->cover_image ? htmlspecialchars($reply->user->profile->cover_image, ENT_QUOTES, 'UTF-8') : null;
            
            return [
                'is_owner' => Auth::id() === $reply->user_id,
                'reply_text' => $reply_text,
                'reply_image' => $reply_image,
                'slug_id' => $reply->slug_id,
                'created_at' => Carbon::parse($reply->created_at)->diffForHumans(),
                'user' => [
                    'name' => $user_name,
                    'username' => $user_username,
                    'cover_image' => $user_cover_image,
                    'is_private' => $reply->user->is_private(),
                ],
            ];
        });

        return response()->json([
            'success' => true,
            'replies' => $repliesData,
            'next_page' => $replies->hasMorePages() ? $replies->currentPage() + 1 : null,
        ]);
    }

    //Delete Reply From Post
    public function destroy(Request $request)
    {
        try {

            // التحقق من تسجيل الدخول
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => __('home.unauthenticated'),
                ], 200); // استجابة غير مصرح بها
            }

            // البحث عن الرد باستخدام slug_id
            $reply = Reply::where('slug_id', $request->slug_id)->first();

            // التحقق من وجود الرد
            if (!$reply) {
                return response()->json([
                    'success' => false,
                    'message' => __('home.post_replies_not_found'),
                ], 200);
            }

            // التحقق من أن المستخدم الحالي هو صاحب الرد
            if ($reply->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => __('home.not_authorized_to_delete_reply'),
                ], 200); // استجابة غير مصرح بها
            }

            // حذف الصورة المرتبطة بالرد إذا كانت موجودة
            if ($reply->reply_image) {
                $imagePath = public_path($reply->reply_image); // تحديد المسار الكامل للصورة
            
                if (file_exists($imagePath)) {
                    unlink($imagePath); // حذف الصورة من المجلد مباشرة
                }
            }
            
            $post_id = $reply->post_id;

            $reply->delete();
            // حساب عدد التعليقات الحالية للمنشور
            $comments_count = Reply::where('post_id', $post_id)->count();

            // إرجاع استجابة ناجحة مع عدد التعليقات
            return response()->json([
                'success' => true,
                'slug_id' =>  $request->slug_id,
                'comments_count' => $comments_count,
                'message' => __('home.post_reply_deleted_successfully'),
            ], 200);

        } catch (\Exception $e) {
            // معالجة أي استثناء غير متوقع
            return response()->json([
                'success' => false,
                'message' => __('home.unexpected_error'),
            ], 200);
        }
    }

}
