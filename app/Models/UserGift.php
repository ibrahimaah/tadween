<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGift extends Model
{
    protected $fillable = ['sender_id','receiver_id','gift_id','visibility'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function gift()
    {
        return $this->belongsTo(Gift::class);
    }
}


 
