<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.register');
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
            'role' => 'user',
            'is_ban' => 'no',
            'account_privacy' => 'public',
            'terms_accepted' => true,
            'remember_token' => Str::random(60), // تعيين remember_token افتراضيًا
        ]);

        // dd($user);
        // تسجيل الدخول مباشرة بعد إنشاء الحساب
        Auth::login($user);

        // إعادة التوجيه إلى الصفحة الرئيسية مع رسالة نجاح
        return redirect()->route('home')->with('success', __('auth.login_success'));
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Determine if login is an email or username
        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Find user by email or username
        $user = User::withTrashed()->where($field, $credentials['login'])->first();

        if (!$user) {
            return back()->withErrors([
                'login' => __('auth.invalid_username_or_email'), // Custom error for invalid username/email
            ])->withInput();
        }

        // Check password separately
        if (!Auth::attempt([$field => $credentials['login'], 'password' => $credentials['password']])) {
            return back()->withErrors([
                'password' => __('auth.invalid_password'), // Custom error for wrong password
            ])->withInput();
        }

         // If the user was soft-deleted, restore them
        if ($user->trashed()) 
        {
            $user->restore();
            $user->is_scheduled_for_deletion = false;
            $user->save();
        }
        // Regenerate session and redirect if login is successful
        $request->session()->regenerate();
        return redirect()->intended('/');
    }


    
    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

    // Show forgot password form
    public function showForgotPasswordForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.forgot-password');
    }

    // Handle sending reset link
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // Show reset password form
    public function showResetPasswordForm($token)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.reset-password', ['token' => $token]);
    }

    // Handle reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }


}