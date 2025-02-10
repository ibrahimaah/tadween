<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.index');
    }

    public function loadNotifications()
    {
        // التحقق من تسجيل الدخول
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => __('notifications.unauthenticated'),
            ], 200);
        }

        $notifications = Notification::with(['sender'])->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // تعديل البيانات التي سيتم إرجاعها
        $notificationsData = $notifications->map(function ($notification) {
            $senderName = optional($notification->sender)->name ?? __('notifications.unknown_user');

            // تحديد النص بناءً على نوع الإشعار
            $message = match ($notification->type) {
                'mention' => __('notifications.mention', ['sender' => $senderName]),
                'new_like' => __('notifications.new_like', ['sender' => $senderName]),
                'new_reply' => __('notifications.new_reply', ['sender' => $senderName]),
                'new_follow' => __('notifications.new_follow', ['sender' => $senderName]),
                default => __('notifications.default_message', ['sender' => $senderName]),
            };

            return [
                'id' => $notification->id,
                'notifiable_id' => $notification->notifiable_id,
                'notifiable_type' => $notification->notifiable_type,
                'type' => $notification->type,
                'is_read' => $notification->is_read,
                'created_at' => $notification->created_at->diffForHumans(),
                'sender' => [
                    'name' => $senderName,
                ],
                'message' => $message, // ✅ تم إضافة الرسالة هنا
            ];
        });

        return response()->json([
            'success' => true,
            'notificationsData' => $notificationsData,
            'next_page' => $notifications->hasMorePages() ? $notifications->currentPage() + 1 : null,
        ]);
    }

    public function readNotification(String $id)
    {
        // التحقق من تسجيل الدخول
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $notification = Notification::findOrFail($id); // جلب الإشعار باستخدام الـ ID الممرر عبر الرابط

        if ($notification->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        // وضع الإشعار كمقروء
        $notification->update(['is_read' => true]);

        // توجيه المستخدم إلى المنشور إذا كان نوع الإشعار "اعجاب او تعليق او اشارة"
        if ($notification->notifiable_type === Post::class) {
            $post = Post::findOrFail($notification->notifiable_id); // العثور على المستخدم بواسطة الـ ID
            return redirect()->route('posts.show', ['slug_id' => $post->slug_id]);
        }

        // التوجيهات عند المتابعة)
        if ($notification->notifiable_type === User::class) {
            $user = User::findOrFail($notification->notifier_id); // العثور على المستخدم بواسطة الـ ID
            return redirect()->route('profile', ['username' => $user->username]); // استخدام اسم المستخدم
        }

        return redirect()->route('notifications.index');
    }
}
