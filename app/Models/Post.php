<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'text',
        'image',
        'slug_id',
        'post_type',
    ];

    // Define the relationship with the User model (assuming posts have a user)
    public function poll()
    {
        return $this->hasOne(Poll::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function postLikes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function userPostLike()
    {
        return $this->hasOne(PostLike::class)->where('user_id', Auth::id());
    }


}

