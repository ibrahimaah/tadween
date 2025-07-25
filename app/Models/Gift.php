<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
class Gift extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'price',
    ];

    protected $appends = ['icon_url'];

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

