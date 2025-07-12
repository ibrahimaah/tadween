<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Prunable;
// use Illuminate\Database\Eloquent\Builder;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;

class User extends Authenticatable implements Wallet
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,SoftDeletes,HasWallet;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'role',
        'email',
        'password',
        'terms_accepted',
        'remember_token',
        'account_privacy',
        'last_activity',
        'is_scheduled_for_deletion'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public function prunable(): Builder
    // {
    //     return static::where('deletion_scheduled_at', '>=', now());
    // }

    /**
     * Prepare the model for pruning.
     */
    // protected function pruning(): void
    // {
    //     info("Pruning User : {$this->id}");
    // }


    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Generic function to retrieve followers or following users with a pending status filter.
     *
     * @param string $type 'following' or 'followers'
     * @param bool $pending True for pending requests, false for confirmed follows
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows($type, $pending)
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            $type === 'following' ? 'follower_id' : 'following_id',
            $type === 'following' ? 'following_id' : 'follower_id'
        )
            ->withPivot('is_pending')
            ->withTimestamps()
            ->wherePivot('is_pending', $pending);
    }

    /**
     * Get the users that the current user follows (confirmed follows only).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function following()
    {
        return $this->follows('following', false);
    }

    /**
     * Get the users that the current user has sent follow requests to (pending requests).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pendingFollowing()
    {
        return $this->follows('following', true);
    }

    /**
     * Get the users who follow the current user (confirmed followers only).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->follows('followers', false);
    }

    /**
     * Get the users who have sent follow requests to the current user (pending followers).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pendingFollowers()
    {
        return $this->follows('followers', true);
    }

    /**
     * Check if the current user is following a specific user (only confirmed follows).
     *
     * @param User $user The user to check
     * @return bool True if following, false otherwise
     */
    public function isFollowing(User $user)
    {
        return $this->following()
            ->wherePivot('following_id', $user->id)
            ->exists();
    }

    public function isFollower(User $user)
    {
        return $this->followers()
            ->wherePivot('follower_id', $user->id)
            ->exists();
    }

    /**
     * Check if the current user has a pending follow request for a specific user.
     *
     * @param User $user The user to check
     * @return bool True if a pending follow request exists, false otherwise
     */
    public function hasPendingFollowRequest(User $user)
    {
        return $this->pendingFollowing()
            ->wherePivot('following_id', $user->id)
            ->exists();
    }


    public function acceptAllFollowRequests()
    {
        $followers = Follow::where('following_id', $this->id)->where('is_pending', true)->pluck('follower_id');
        Follow::whereIn('follower_id', $followers)->update(['is_pending' => false]);
    }



    protected static function booted()
    {
        static::created(function ($user) {
            // قم بإنشاء سجل فارغ في جدول profiles لهذا المستخدم
            $user->profile()->create();
        });
    }


    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function is_private()
    {
        return $this->account_privacy == AccountPrivacy::PRIVATE;
    }



    ///////////////////////////////////////////////////////////////////////
    /**
     * Blocked Users
    */


    public function blockedUsers()
    {
        return $this->belongsToMany(User::class, 'blocked_users', 'user_id', 'blocked_user_id')->withTimestamps();
    }
    public function blockedByUsers()
    {
        return $this->belongsToMany(User::class, 'blocked_users', 'blocked_user_id', 'user_id')->withTimestamps();
    }
    public function isBlockedBy(User $user): bool
    {
        return $this->blockedByUsers()->where('user_id', $user->id)->exists();
    }
    public function hasBlocked(User $user): bool
    {
        return $this->blockedUsers()->where('blocked_user_id', $user->id)->exists();
    }
    public function getBlockedUsersIds(): array
    {
        return $this->blockedUsers()->pluck('blocked_user_id')->toArray();
    }
    public function unblock(User $user): bool
    {
        if (!$this->hasBlocked($user)) {
            return false; // User is not blocked
        }

        $this->blockedUsers()->detach($user->id);
        return true; // Successfully unblocked
    }


    //////////////////////////////////////////////////////////////////////
    //Gifts

    public function sentGifts()
    {
        return $this->hasMany(UserGift::class, 'sender_id');
    }

    public function receivedGifts()
    {
        return $this->hasMany(UserGift::class, 'receiver_id')->orderBy('created_at','DESC');
    }

    //////////////////////////////////////////////////////////////////////
}
