<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Gift extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'price',
    ];

    // Accessor for icon URL (optional but useful)
    public function getIconUrlAttribute()
    {
        return $this->getFirstMediaUrl('icon');
    }

    public function userGifts()
    {
        return $this->hasMany(UserGift::class);
    }
}

