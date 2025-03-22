<?php

namespace App\Http\Controllers;

use App\Models\AccountPrivacy;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function index()
    {
        
        try {
            $user_id = Auth::id();
            
            // Retrieve the specific user with its user details
            $userProfile = User::with('profile')->where('id', $user_id)->first();
            
            // Check if the user exists
            if (!$userProfile) {
                return redirect()->back()->with('error', __('settings.user_not_found'));
            }
            if ($userProfile->profile != null) {
                $date_of_birth = $userProfile->profile->date_of_birth ? $userProfile->profile->date_of_birth->format('Y-m-d') : null;
            }

            $userData = [
                'name' => $userProfile->name,
                'username' => $userProfile->username,
                'email' => $userProfile->email,
                'account_privacy' => $userProfile->account_privacy,
                'bio' => optional($userProfile->profile)->bio ?? null,
                'gender' => optional($userProfile->profile)->gender ?? null,
                'country' => optional($userProfile->profile)->country ?? null,
                'city' => optional($userProfile->profile)->city ?? null,
                'date_of_birth' => $date_of_birth ?? null,
                'cover_image' => optional($userProfile->profile)->cover_image ?? null,
                'background_image' => optional($userProfile->profile)->background_image ?? null,
            ];
            // Pass the data to the view
            return view('settings.settings', ['userData' => $userData]);

        } catch (\Exception $e) {
            // Handle any unexpected errors
            return redirect()->back()->with('error', __('settings.unexpected_error'));
        }
    }

    /**
     * Update Personal information.
    */
    public function updatePersonalInformation(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        try {
            // Validate the incoming request
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[a-zA-Z]+$/',
                    Rule::unique('users', 'username')->ignore(Auth::id()),
                ],
                'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
                'password_old' => 'nullable|string|min:8',
                'password_new' => 'nullable|string|min:8',
                'account_privacy' => 'required|string|in:public,private',
            ]);

            // Get the currently authenticated user
            $user = User::find(Auth::id());
            // Check if the old password is correct before updating
            if ($request->password_old && !Hash::check($request->password_old, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => __('settings.password_old_invalid'),
                ], 200);  // Send an error if the old password is incorrect
            }

            $old_account_privacy = $user->account_privacy;
            // Update the user's information
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'account_privacy' => $request->account_privacy,
                'password' => $request->password_new ? Hash::make($request->password_new) : $user->password, // Only update password if provided
            ]);
            $new_account_privacy = $request->account_privacy;
            $has_been_public = false;
            if($old_account_privacy == AccountPrivacy::PRIVATE && $new_account_privacy == AccountPrivacy::PUBLIC)
            { 
                $user->acceptAllFollowRequests(); 
            }
            // Return a successful response
            return response()->json([
                'success' => true,
                'message' => __('settings.update_success'), 
            ], 200);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
            ], 200);
        } catch (\Exception $e) {
            // Handle any unexpected exceptions
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    /**
     * Update Profile information.
    */
    public function updateProfileInformation(Request $request)
    {
        // التأكد من أن المستخدم مسجل الدخول
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        try {
            // التحقق من صحة المدخلات
            $request->validate([
                'date_of_birth'      => 'nullable|date',
                'cover_image'        => 'nullable|file|image|max:2048', // الحد الأقصى 2MB
                'background_image'   => 'nullable|file|image|max:2048', // الحد الأقصى 2MB
                'bio'                => 'nullable|string|max:160',
                'gender'             => 'nullable|in:male,female',
                'country'            => 'nullable|string|max:30',
                'city'               => 'nullable|string|max:30',
            ]);

            // البحث عن بروفايل المستخدم الحالي
            $userProfile = UserProfile::where('user_id', Auth::id())->first();

            // تجهيز مصفوفة البيانات للتحديث أو الإنشاء
            $data = [
                'date_of_birth' => $request->date_of_birth,
                'bio'           => $request->bio,
                'gender'        => $request->gender,
                'country'       => $request->country,
                'city'          => $request->city,
            ];

            // معالجة تحميل صورة الغلاف
            if ($request->hasFile('cover_image')) {
                // إذا كان السجل موجوداً يتم حذف الصورة القديمة
                if ($userProfile && $userProfile->cover_image) {
                    $oldImagePath = public_path('cover_images/' . basename($userProfile->cover_image));  // تحديد المسار الكامل للصورة القديمة
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);  // حذف الصورة القديمة إذا كانت موجودة
                    }
                }

                // تخزين الصورة الجديدة مع تغيير الاسم
                $coverImage = $request->file('cover_image');
                $imageExtension = $coverImage->getClientOriginalExtension();  // الحصول على امتداد الصورة
                $imageName = time() . '_' . uniqid('cover_', true) . '.' . $imageExtension;

                $coverImage->move(public_path('cover_images'), $imageName);  // تخزين الصورة في المجلد
                $data['cover_image'] = 'cover_images/' . $imageName;  // حفظ المسار الجديد في قاعدة البيانات
            } else {
                // إذا كان السجل موجوداً يتم الاحتفاظ بالصورة القديمة
                $data['cover_image'] = $userProfile ? $userProfile->cover_image : null;
            }

            // معالجة تحميل صورة الخلفية
            if ($request->hasFile('background_image')) {
                // إذا كان السجل موجوداً يتم حذف الصورة القديمة
                if ($userProfile && $userProfile->background_image) {
                    $oldImagePath = public_path('background_images/' . basename($userProfile->background_image));  // تحديد المسار الكامل للصورة القديمة
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);  // حذف الصورة القديمة إذا كانت موجودة
                    }
                }

                // تخزين الصورة الجديدة مع تغيير الاسم
                $backgroundImage = $request->file('background_image');
                $imageExtension = $backgroundImage->getClientOriginalExtension();  // الحصول على امتداد الصورة
                $imageName = time() . '_' . uniqid('bg_', true) . '.' . $imageExtension;

                $backgroundImage->move(public_path('background_images'), $imageName);  // تخزين الصورة في المجلد
                $data['background_image'] = 'background_images/' . $imageName;  // حفظ المسار الجديد في قاعدة البيانات
            } else {
                // إذا كان السجل موجوداً يتم الاحتفاظ بالصورة القديمة
                $data['background_image'] = $userProfile ? $userProfile->background_image : null;
            }



            if ($userProfile) {
                // إذا كان السجل موجوداً، نقوم بتحديثه
                $userProfile->update($data);
            } else {
                // إذا لم يكن موجوداً، نقوم بإنشاء سجل جديد
                $data['user_id'] = Auth::id();
                UserProfile::create($data);
            }

            // إرجاع استجابة بنجاح العملية
            return response()->json([
                'success' => true,
                'message' => __('settings.update_success'),
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // إرجاع أخطاء التحقق من الصحة
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
            ], 200);
        } catch (\Exception $e) {
            // معالجة الأخطاء غير المتوقعة
            return response()->json([
                'success' => false,
                'message' => __('settings.unexpected_error'),
            ], 200);
        }
    }

    //Delete My Account User
    public function deleteMyAccount(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'account_password' => 'required',
        ]);
            
        $user = User::find(Auth::id());

        // Verify the password
        if (!Hash::check($request->account_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => __('settings.password_now_incorrect')
            ], 200);
        }

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Collect all related files to delete
            $userProfile = $user->profile;
            $posts = $user->posts;
            $replies = $user->replies;
            
            // Delete files for user profile
            if ($userProfile) {
                if ($userProfile->background_image) {
                    $backgroundImagePath = public_path('background_images/' . basename($userProfile->background_image));  // تحديد المسار الكامل للصورة
                    if (file_exists($backgroundImagePath)) {
                        unlink($backgroundImagePath);  // حذف الصورة إذا كانت موجودة
                    }
                }
                if ($userProfile->cover_image) {
                    $coverImagePath = public_path('cover_images/' . basename($userProfile->cover_image));  // تحديد المسار الكامل للصورة
                    if (file_exists($coverImagePath)) {
                        unlink($coverImagePath);  // حذف الصورة إذا كانت موجودة
                    }
                }
            }

            // Delete files for posts
            foreach ($posts as $post) {
                if ($post->image) {
                    $imagePath = public_path('posts/' . basename($post->image));  // تحديد المسار الكامل للصورة
                    if (file_exists($imagePath)) {
                        unlink($imagePath);  // حذف الصورة إذا كانت موجودة
                    }
                }
            }

            // Delete files for replies
            foreach ($replies as $reply) {
                if ($reply->reply_image) {
                    $replyImagePath = public_path('replies/' . basename($reply->reply_image));  // تحديد المسار الكامل للصورة
                    if (file_exists($replyImagePath)) {
                        unlink($replyImagePath);  // حذف الصورة إذا كانت موجودة
                    }
                }
            }


            // Log out the user before deleting the account
            Auth::logout();
    
            // Delete the user's account
            $user->delete();
            // Commit the transaction
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => __('settings.delete_account_success')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('settings.unexpected_error')
            ], 200);
        }
    }

    public function blockedUsers()
    {
        /** @var \App\Models\User $current_user */
        $current_user = Auth::user();
        $blockedUsers = $current_user->blockedUsers()->orderBy('created_at', 'desc')->get();
        return view('settings.blocked-users.index',compact('blockedUsers'));
    }
}
