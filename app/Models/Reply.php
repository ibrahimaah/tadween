<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'parent_id',
        'reply_text',
        'reply_image',
        'slug_id',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // In Reply.php model
    public function parent()
    {
        return $this->belongsTo(Reply::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Reply::class, 'parent_id');
    }
    //عندما يرد شخص ما على منشور المستخدم
    protected static function booted()
    {
        static::created(function ($reply) {
            // إرسال إشعار لصاحب المنشور
            Notification::create([
                'user_id' => $reply->post->user_id, // صاحب المنشور
                'notifier_id' => $reply->user_id, // الشخص الذي قام بالرد
                'notifiable_type' => Post::class,
                'notifiable_id' => $reply->post_id,
                'type' => 'new_reply',
            ]);
        });
    }

}
