<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlockedUserController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Middleware\UpdateLastActivity;
use App\Models\Gift;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Http; 
///////////// Route For Change Language /////////////
Route::get('lang/{locale}', function ($locale, Request $request) {
    if (in_array($locale, ['en', 'ar'])) {
        Cookie::queue('locale', $locale, 60 * 24 * 365); // Store locale for 1 year
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');

 
Route::get('tmp',function(){
     $gift = Gift::find(1);
     dd($gift->getIconUrlAttribute());

});

// Route::get('/', [PostController::class, 'index'])->name('home')->middleware('auth');
////////////////////// Routes For Home ////////////////////
Route::middleware(['auth', UpdateLastActivity::class])->group(function () {
    // Posts
    Route::get('/', [PostController::class, 'index'])->name('home');
    // Route::get('load-homepage-posts', [PostController::class, 'loadHomePagePosts']);
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('vote', [PostController::class, 'storeVote']);
    Route::get('load-posts', [PostController::class, 'loadPosts']);
    Route::get('posts/{slug_id}', [PostController::class, 'detailsPost'])->name('posts.show');
    Route::delete('posts/{slug_id}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Post Likes
    Route::post('post-like', [PostLikeController::class, 'store'])->name('post.like.store');

    // Replies
    Route::post('replies', [ReplyController::class, 'store'])->name('reply.store');
    Route::get('load-replies', [ReplyController::class, 'loadReplies']);
    Route::delete('replies/{slug_id}', [ReplyController::class, 'destroy'])->name('replies.destroy');
    Route::get('replies/{slug_id}', [ReplyController::class, 'show'])->name('replies.show');


    Route::get('wallet',[WalletController::class,'index'])->name('wallet.index');
    Route::post('wallet-deposit',[WalletController::class,'deposit'])->name('wallet.deposit');
    Route::post('wallet-transfer',[WalletController::class,'transfer'])->name('wallet.transfer'); 
    Route::get('/wallet/paypal/success', [WalletController::class, 'paypalSuccess'])->name('wallet.paypal.success');
    Route::get('/wallet/paypal/cancel', [WalletController::class, 'paypalCancel'])->name('wallet.paypal.cancel'); 
    Route::get('/fetch-transactions-history', [WalletController::class, 'fetchTransactionsHistory'])->name('transactions.fetchTransactionsHistory');
    Route::get('get-user-balance/{userId}',[WalletController::class,'getUserBalance'])->name('wallet.get_user_balance');
    
    Route::get('gifts',[GiftController::class,'index'])->name('gifts.index');
    // Route::get('gifts',[GiftController::class,'received'])->name('gifts.received');
    // Route::get('gifts/{gift}/price',[GiftController::class,'getGiftById'])->name('gifts.getById');


    Route::post('send-gift',[GiftController::class,'send'])->name('gifts.send');
    Route::get('{username}/gifts', [GiftController::class, 'getUserGifts'])->name('profile.gifts.index');
    Route::post('gifts/{giftId}/{action}', [GiftController::class, 'handleAction'])
    ->whereIn('action', ['show', 'hide', 'delete'])
    ->name('gifts.handleAction');

    
    
});

// Static Pages
Route::view('terms', 'terms')->name('terms');
Route::view('privacy', 'privacy')->name('privacy');
Route::view('offline', 'offline')->name('offline');

////////////// Routes for Authentication ////////////////
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


////////////// Routes for Notification ////////////////
Route::middleware('auth')->group(function () {
    // Show all notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('load-notifications', [NotificationController::class, 'loadNotifications']);

    // Mark a notification as read and redirect based on its type
    Route::get('/notifications/{notification}', [NotificationController::class, 'readNotification'])->name('notifications.read');
});


////////////// Routes for Messages ////////////////
Route::middleware(['auth'])->group(function () {
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/load-messages', [MessageController::class, 'loadMessages']);

    Route::get('messages/{username}/chat', [MessageController::class, 'chat'])->name('messages.chat');
    Route::post('messages/store', [MessageController::class, 'sendMessage']);
    Route::get('messages/{receiver_username}', [MessageController::class, 'getMessages']);
});


////////////// Routes for Follow Up Requests ////////////////
Route::middleware(['auth'])->group(function () {
    Route::get('follow-up-requests', [FollowController::class, 'follow_up_requests'])->name('follow_up_requests'); 
    Route::post('/approve-follow-request/{id}', [FollowController::class, 'approveFollowRequest'])->name('approve_follow_request');
    Route::post('/deny-follow-request/{id}', [FollowController::class, 'denyFollowRequest'])->name('deny_follow_request');

    //     Route::post('/follow-request/approve/{id}', [FollowController::class, 'approveFollowRequest'])->name('approve_follow_request');
    // Route::post('/follow-request/deny/{id}', [FollowController::class, 'denyFollowRequest'])->name('deny_follow_request');


    ////////////// Routes for Settings ////////////////
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('settings');
        Route::post('/update_personal', [SettingController::class, 'updatePersonalInformation'])->name('settings.update.personal.information');
        Route::post('/update_profile', [SettingController::class, 'updateProfileInformation'])->name('settings.update.profile.information');
        Route::delete('/delete', [UserController::class, 'delete'])->name('settings.account.delete');
        Route::get('/blocked-users', [SettingController::class, 'blockedUsers'])->name('settings.blocked_users');

    });

    ////////////// Routes for Profile (Dynamic Username) ////////////////
    Route::get('{username}', [ProfileController::class, 'index'])
        ->name('profile');

    Route::get('{username}/posts', [ProfileController::class, 'getPostsByUsername']);
    Route::get('{username}/posts/replies', [ProfileController::class, 'getRepliesByUsername']);
    Route::get('{username}/posts/media', [ProfileController::class, 'getMediaPostsByUsername']);
    Route::get('{username}/posts/likes', [ProfileController::class, 'getLikedPostsByUsername']);

    ////////////// Routes for Follows ////////////////
    Route::post('follows', [FollowController::class, 'store'])->name('follows.store');
    Route::get('{username}/followers', [FollowController::class, 'getFollowers'])->name('followers.index');
    Route::get('{username}/followers/load-followers', [FollowController::class, 'loadFollowers']);
    Route::get('{username}/followings', [FollowController::class, 'getFollowings'])->name('followings.index');
    Route::get('{username}/followings/load-followings', [FollowController::class, 'loadFollowings']);


    Route::post('block-user',[BlockedUserController::class,'block'])->name('users.block');
    Route::post('unblock-user',[BlockedUserController::class,'unblock'])->name('users.unblock');
});

///////////////////////Admin Routes//////////////////////////
Route::prefix('admin')->group(function () {
    ////////////// Routes for Authentication ////////////////
    Route::get('register', [AdminController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('register', [AdminController::class, 'register']);
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // عرض المستخدمين
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::patch('/user/{id}/ban', [AdminController::class, 'updateBanUser'])->name('admin.updateBanUser');
    Route::patch('/user/{id}/role', [AdminController::class, 'updateUserRole'])->name('admin.updateUserRole');
    // عرض المنشورات
    Route::get('/all-posts', [AdminController::class, 'posts'])->name('admin.posts');
    // حذف منشور
    Route::delete('/all-posts/{id}', [AdminController::class, 'deletePost'])->name('admin.deletePost');
});
