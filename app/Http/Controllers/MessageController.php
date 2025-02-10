<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        return view('messages.index');
    }

    //Fetch chat Messages
    public function loadMessages(Request $request)
    {
        // التحقق من تسجيل الدخول
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => __('messages.unauthenticated'),
            ], 200);
        }
        $auth_id = Auth::id();
        $perPage = 10;
        $page = $request->input('page', 1);

        // جلب المستخدمين الذين لديهم رسائل معي باستخدام علاقة Eloquent
        $users = User::whereHas('sentMessages', function ($query) use ($auth_id) {
            $query->where('receiver_id', $auth_id);
        })->orWhereHas('receivedMessages', function ($query) use ($auth_id) {
            $query->where('sender_id', $auth_id);
        })->paginate($perPage, ['*'], 'page', $page);

        // تجهيز بيانات المستخدمين مع آخر رسالة لكل مستخدم
        $usersData = $users->map(function ($user) use ($auth_id) {
            // جلب آخر رسالة بين المستخدم الحالي والمستخدم الآخر
            $lastMessage = Message::where(function ($query) use ($auth_id, $user) {
                $query->where('sender_id', $auth_id)->where('receiver_id', $user->id);
            })->orWhere(function ($query) use ($auth_id, $user) {
                $query->where('sender_id', $user->id)->where('receiver_id', $auth_id);
            })->latest()->first();

            return [
                'name' => htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'),
                'username' => htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'),
                'cover_image' => $user->profile->cover_image ? htmlspecialchars($user->profile->cover_image, ENT_QUOTES, 'UTF-8') : null,
                'last_message' => $lastMessage ? $lastMessage->created_at->diffForHumans() : null,
                'last_message_timestamp' => $lastMessage ? $lastMessage->created_at->timestamp : 0, // إضافة التوقيت الرقمي للترتيب
            ];
        });

        // ترتيب المستخدمين بناءً على آخر رسالة تنازليًا
        $usersData = $usersData->sortByDesc('last_message_timestamp')->values();


        return response()->json([
            'success' => true,
            'messages' => $usersData,
            'next_page' => $users->hasMorePages() ? $page + 1 : null,
        ]);
    }


    public function chat($username)
    {
        return view('messages.chat', ['username' => $username]);
    }

    public function sendMessage(Request $request)
    {
        // التحقق من تسجيل الدخول
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => __('messages.unauthenticated'),
            ], 200);
        }
        $user = User::where('username', $request->receiver_id)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => __('messages.user_not_found'),
            ], 200);
        }

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'message' => $request->message,
        ]);

        return response()->json($message);
    }

    public function getMessages(Request $request, $receiver_username)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => __('messages.unauthenticated'),
            ], 200);
        }

        $receiver = User::where('username', $receiver_username)->first();
        if (!$receiver) {
            return response()->json(['error' => 'Receiver not found'], 404);
        }

        $lastMessageTime = $request->input('last_message_time');
        $firstMessageTime = $request->input('first_message_time');
        
        $limit = 10;

        if ($lastMessageTime) {
            //عرض الرسائل الجديدة كل 5 ثواني
            $query = Message::where(function ($query) use ($receiver, $lastMessageTime) {
                $query->where('sender_id', Auth::id())
                    ->where('receiver_id', $receiver->id)
                      ->where('created_at', '>', $lastMessageTime); // إضافة شرط الوقت هنا
            })->orWhere(function ($query) use ($receiver, $lastMessageTime) {
                $query->where('sender_id', $receiver->id)
                    ->where('receiver_id', Auth::id())
                      ->where('created_at', '>', $lastMessageTime); // إضافة شرط الوقت هنا
            });
            $query->orderBy('created_at', 'desc');
        } else if ($firstMessageTime) {
            //عرض الرسائل القديمة عند التمرير للاسفل
            $query = Message::where(function ($query) use ($receiver, $firstMessageTime) {
                $query->where('sender_id', Auth::id())
                    ->where('receiver_id', $receiver->id)
                      ->where('created_at', '<', $firstMessageTime); // إضافة شرط الوقت هنا
            })->orWhere(function ($query) use ($receiver, $firstMessageTime) {
                $query->where('sender_id', $receiver->id)
                    ->where('receiver_id', Auth::id())
                      ->where('created_at', '<', $firstMessageTime); // إضافة شرط الوقت هنا
            });
            $query->orderBy('created_at', 'desc')->limit($limit);
        } else {
            //عرض الرسائل عند فتح الصفحة لأول مرة
            $query = Message::where(function ($query) use ($receiver) {
                $query->where('sender_id', Auth::id())
                ->where('receiver_id', $receiver->id);
            })->orWhere(function ($query) use ($receiver) {
                $query->where('sender_id', $receiver->id)
                ->where('receiver_id', Auth::id());
            });
            $query->orderBy('created_at', 'desc')->limit($limit);
        }
        
        $messages = $query->get();
        
        $messagesData = $messages->map(function ($message) {
            return [
                'id' => $message->id,
                'message' => $message->message,
                'created_at' => $message->created_at->toDateTimeString(),
                'sender' => ['username' => User::find($message->sender_id)->username],
                'receiver' => ['username' => User::find($message->receiver_id)->username],
            ];
        });

        return response()->json([
            'firstMessageTime'=>$firstMessageTime,
            'lastMessageTime'=>$lastMessageTime,
            'success' => true,
            'messages' => $messagesData,
        ]);
    }
}
