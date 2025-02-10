<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PollVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'poll_id',
        'option_selected',
    ];

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع الاستبيان
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
