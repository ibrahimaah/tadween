<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\PostLike;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    public function store(Request $request)
    {
        // التحقق من تسجيل الدخول
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => __('home.unauthenticated'),
            ], 200); // استجابة غير مصرح بها
        }

        $request->validate([
            'slug_id' => 'required|exists:posts,slug_id',
        ]);

        // الحصول على المنشور بناءً على `slug_id`
        $post = Post::where('slug_id', $request->slug_id)->first();

        // التحقق إذا كان المستخدم قد أعجب بالمنشور مسبقًا
        $like = PostLike::where('user_id', Auth::id())
            ->where('post_id', $post->id)
            ->first();

        if ($like) {
            // إذا كان الإعجاب موجودًا، قم بحذفه (إلغاء الإعجاب)
            $like->delete();
            $likeCount = PostLike::where('post_id', $post->id)->count();
            return response()->json([
                'success' => true,
                'message' => __('home.post_like_removed_successfully'),
                'post_like_count' => $likeCount,
                'is_post_like' => false
            ], 200);
        } else {
            // إذا لم يكن موجودًا، قم بإضافته (إعجاب)
            PostLike::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id,
            ]);
            $likeCount = PostLike::where('post_id', $post->id)->count();

            return response()->json([
                'success' => true,
                'message' => __('home.post_like_successfully'),
                'post_like_count' => $likeCount,
                'is_post_like' => true
            ], 200);
        }
    }

}
