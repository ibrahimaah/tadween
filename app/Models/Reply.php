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

    protected $appends = ['user_cover_image', 'created_at_diff'];

    public function getUserCoverImageAttribute()
    {
        return asset(optional($this->user->profile)->cover_image ?? 'img/user.jpg');
    }

    public function getCreatedAtDiffAttribute()
    {
        return $this->created_at->diffForHumans();
    }
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

    // Recursive relationship loaders
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function allParents()
    {
        return $this->parent()->with('allParents');
    }

    // Flat children collector
    public function allChildrenFlat()
    {
        $all = collect();

        foreach ($this->children as $child) {
            $all->push($child);
            $all = $all->merge($child->allChildrenFlat());
        }

        return $all;
    }

    // Flat parents collector
    public function allParentsFlat()
    {
        $all = collect();

        if ($this->parent) {
            $all->push($this->parent);
            $all = $all->merge($this->parent->allParentsFlat());
        }

        return $all;
    }
}
