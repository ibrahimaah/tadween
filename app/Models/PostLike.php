<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    //عندما يعجب شخص ما  بمنشور المستخدم
    protected static function booted()
    {
        static::created(function ($like) {
            // إرسال إشعار لصاحب المنشور
            Notification::create([
                'user_id' => $like->post->user_id, // صاحب المنشور الذي سيستلم الإشعار
                'notifier_id' => $like->user_id, // الشخص الذي قام بالإعجاب
                'notifiable_type' => Post::class,
                'notifiable_id' => $like->post_id,
                'type' => 'new_like',
            ]);
        });
    }
    
}
