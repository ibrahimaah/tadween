<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'notifier_id',
        'notifiable_id',
        'notifiable_type',
        'message',
        'is_read'
    ];

    // علاقة الإشعار مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //لجلب بيانات المرسل  في الاشعارات
    public function sender()
    {
        return $this->belongsTo(User::class, 'notifier_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'notifiable_id');
    }

}
