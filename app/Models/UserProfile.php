<?php

namespace App\Models;

 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'background_image',
        'cover_image',
        'bio',
        'gender',
        'country',
        'city',
    ];

    // تحويل الحقل إلى تاريخ
    protected $casts = [
        'date_of_birth' => 'date',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCoverImageOrLogoAttribute()
    { 
        return asset($this->user->profile->cover_image) ?? asset('img/user.jpg');
    }

}
