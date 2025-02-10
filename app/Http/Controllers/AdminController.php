<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post; // تأكد من وجود نموذج Post في التطبيق
use App\Models\UserProfile;
use Carbon\Carbon; // قد تستخدمه لحساب المستخدمين المتصلين الآن
use Illuminate\Support\Str;
class AdminController extends Controller
{
    // عرض الإحصائيات
    public function dashboard()
    {
        if (Auth::check() && Auth::user()->role != 'admin') {
            return redirect()->route('home')->with('error', __('dashboard.not_authorized'));
        }
        $totalUsers = User::count();
        $totalPosts = Post::count();
        // حساب عدد الصور في المشاركات (نفترض أن العمود image يحتوي على مسار الصورة)
        $totalPostImages = Post::whereNotNull('image')->count();

        // حساب عدد صور الغلاف في ملفات تعريف المستخدمين
        $totalProfileCoverImages = UserProfile::whereNotNull('cover_image')->count();

        // حساب عدد صور الخلفية في ملفات تعريف المستخدمين
        $totalProfileBackgroundImages = UserProfile::whereNotNull('background_image')->count();

        // إجمالي الصور يشمل صور المشاركات وصور ملفات التعريف (الغلاف والخلفية)
        $totalImages = $totalPostImages + $totalProfileCoverImages + $totalProfileBackgroundImages;

        
        // هنا نفترض أن المستخدمين الذين قاموا بتحديث نشاطهم خلال 5 دقائق يُعتبرون متصلين
        $onlineUsers = User::where('last_activity', '>=', Carbon::now()->subMinutes(5))->count();
        
        return view('admin.dashboard', compact('totalUsers', 'totalPosts', 'totalPostImages', 'totalProfileCoverImages', 'totalProfileBackgroundImages', 'totalImages', 'onlineUsers'));
    }

    // عرض المستخدمين
    public function users()
    {
        if (Auth::check() && Auth::user()->role != 'admin') {
            return redirect()->route('home')->with('error', __('dashboard.not_authorized'));
        }
        $users = User::simplePaginate(20);
        return view('admin.users', compact('users'));
    }

    public function showRegisterForm()
    {
        if (Auth::check() && Auth::user()->role != 'admin') {
            return redirect()->route('home')->with('error', __('dashboard.not_authorized'));
        }
        return view('admin_auth.register');
    }

    public function register(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users|regex:/^[a-zA-Z]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'accepted',
        ]);

        // إنشاء المستخدم
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'is_ban' => 'no',
            'account_privacy' => 'public',
            'terms_accepted' => true,
            'remember_token' => Str::random(60), // تعيين remember_token افتراضيًا
        ]);

        // إعادة التوجيه إلى الصفحة الرئيسية مع رسالة نجاح
        return redirect()->route('admin.users')->with('success', __('dashboard.add_admin_success'));
    }

    //Update Ban User
    public function updateBanUser($id)
    {
        // التأكد أن المستخدم الحالي هو أدمن
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.users')->with('error', __('dashboard.not_authorized'));
        }
        // البحث عن المستخدم باستخدام الـ id المرسل
        $user = User::findOrFail($id);

        // تغيير حالة الحظر: إذا كانت 'yes' تصبح 'no' والعكس صحيح
        $user->is_ban = $user->is_ban === 'yes' ? 'no' : 'yes';
        
        // حفظ التغييرات
        $user->save();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', __('dashboard.ban_status_updated_successfully'));
    }

    //Update User Role
    public function updateUserRole(Request $request, $id)
    {
        // التأكد أن المستخدم الحالي هو أدمن
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.users')->with('error', __('dashboard.not_authorized'));
        }
        // التحقق من صحة المدخلات
        $request->validate([
            'role' => 'required|in:admin,supervisor,user',
        ]);

        // البحث عن المستخدم باستخدام الـ id المرسل
        $user = User::findOrFail($id);

        // تحديث صلاحية المستخدم
        $user->role = $request->role;
        $user->save();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', __('dashboard.user_role_updated_successfully'));
    }

    
    //Delete My Account User
    public function deleteUser($id)
    {
        // التأكد أن المستخدم الحالي هو أدمن
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.users')->with('error', __('dashboard.not_authorized'));
        }

        $user = User::findOrFail($id);

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Collect all related files to delete
            $userProfile = $user->profile;
            $posts = $user->posts;
            $replies = $user->replies;
            
            // حذف صور ملف المستخدم
            if ($userProfile) {
                if ($userProfile->background_image) {
                    $bgImagePath = public_path($userProfile->background_image);
                    if (file_exists($bgImagePath)) {
                        unlink($bgImagePath);
                    }
                }

                if ($userProfile->cover_image) {
                    $coverImagePath = public_path($userProfile->cover_image);
                    if (file_exists($coverImagePath)) {
                        unlink($coverImagePath);
                    }
                }
            }

            // حذف صور المنشورات
            foreach ($posts as $post) {
                if ($post->image) {
                    $postImagePath = public_path($post->image);
                    if (file_exists($postImagePath)) {
                        unlink($postImagePath);
                    }
                }
            }

            // حذف صور الردود
            foreach ($replies as $reply) {
                if ($reply->reply_image) {
                    $replyImagePath = public_path($reply->reply_image);
                    if (file_exists($replyImagePath)) {
                        unlink($replyImagePath);
                    }
                }
            }

            // Delete the user's account
            $user->delete();
            // Commit the transaction
            DB::commit();
    
            return redirect()->route('admin.users')->with('success', __('dashboard.delete_account_success'));

        } catch (\Exception $e) {
            return redirect()->route('admin.users')->with('error', __('dashboard.unexpected_error'));
        }
    }
    
    // عرض المنشورات
    public function posts()
    {
        if (Auth::check() && Auth::user()->role != 'admin') {
            return redirect()->route('home')->with('error', __('dashboard.not_authorized'));
        }
        $posts = Post::with(['user:id,name'])->simplePaginate(20);
        return view('admin.posts', compact('posts'));
    }
    
    // حذف منشور
    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        // حذف الصورة المرتبطة بالمنشور إذا كانت موجودة
        if ($post->image) {
            $postImagePath = public_path($post->image);
            if (file_exists($postImagePath)) {
                unlink($postImagePath);
            }
        }

        // حذف الصور المرتبطة بالردود
        foreach ($post->replies as $reply) {
            if ($reply->reply_image) {
                $replyImagePath = public_path($reply->reply_image);
                if (file_exists($replyImagePath)) {
                    unlink($replyImagePath);
                }
            }
        }

        // حذف الردود المرتبطة
        $post->replies()->delete();
        $post->delete();
        return redirect()->route('admin.posts')->with('success', __('dashboard.post_deleted_successfully'));
    }
    
    
}
