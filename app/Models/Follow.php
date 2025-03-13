<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['follower_id', 'following_id','is_pending'];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'following_id');
    }

    //عندما اتابع شخص ما يرسل اشعار له
    protected static function booted()
    {
        static::created(function ($follow) {
            // إرسال إشعار لصاحب الحساب
            Notification::create([
                'user_id' => $follow->following_id, // صاحب الحساب الذي سيستلم الإشعار
                'notifier_id' => $follow->follower_id, // الشخص الذي قام بالمتابعة
                'notifiable_type' => User::class,
                'notifiable_id' => $follow->following_id,
                'type' => 'new_follow',
            ]);
        });
    }


    public static function getFollowings($user_id)
    {
        return self::where(['follower_id' => $user_id, 'is_pending' => false])->get(); 
    }
}
