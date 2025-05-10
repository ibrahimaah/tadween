<?php

namespace App\Models;

use App\Exceptions\PostNotFoundException;
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

    // 👇 Add this to make it appear in arrays / JSON
    protected $appends = ['user_profile_img', 'created_at_diff','first_image'];

    // 👇 Add the accessor
    public function getUserProfileImgAttribute()
    {
        return $this->user->profile->cover_image ?? asset('img/user.jpg');
    }

    public function getCreatedAtDiffAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getFirstImageAttribute()
    {
        // dd($this->image);
        $images = json_decode($this->image, true); 
        return isset($images[0]) ? asset($images[0]) : null;
    }

    public function getPollData()
    {
        if (!$this->poll) return null;

        return [
            'expires_at' => $this->poll->expires_at->format('Y-m-d H:i:s'),
            'options' => [
                ['option_text' => $this->poll->option1_text, 'votes' => $this->poll->option1_votes],
                ['option_text' => $this->poll->option2_text, 'votes' => $this->poll->option2_votes],
                ['option_text' => $this->poll->option3_text, 'votes' => $this->poll->option3_votes],
                ['option_text' => $this->poll->option4_text, 'votes' => $this->poll->option4_votes],
            ],
        ];
    }


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


    public static function findBySlugOrFail($slug)
    {
        $post = self::with(['user', 'userPostLike', 'poll'])
                    ->withCount('replies')
                    ->withCount('postLikes')
                    ->where('slug_id', $slug)
                    ->first();

        if (! $post) {
            throw new PostNotFoundException($slug);
        }

        return $post;
    }

    public function is_owner()
    {
        return Auth::id() === $this->user_id;
    }

    public function is_post_liked()
    {
        return $this->userPostLike !== null;
    }
    //asset('img/user.jpg')

}
