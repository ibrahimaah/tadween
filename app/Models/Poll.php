<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'expires_at',
        'option1_text',
        'option2_text',
        'option3_text',
        'option4_text',
        'option1_votes',
        'option2_votes',
        'option3_votes',
        'option4_votes'
    ];
    
    // إضافة الكاست لتحويل expires_at إلى datetime (Carbon)
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    // علاقة المنشور
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Accessor لإرجاع الخيارات كمصفوفة
    public function getOptionsAttribute()
    {
        return [
            ['text' => $this->option1_text, 'votes' => $this->option1_votes],
            ['text' => $this->option2_text, 'votes' => $this->option2_votes],
            ['text' => $this->option3_text, 'votes' => $this->option3_votes],
            ['text' => $this->option4_text, 'votes' => $this->option4_votes],
        ];
    }
}
