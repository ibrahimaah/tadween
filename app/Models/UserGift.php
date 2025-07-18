<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGift extends Model
{
    use SoftDeletes;
    protected $fillable = ['sender_id','receiver_id','gift_id','price','msg','is_hidden','visibility'];

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


 
