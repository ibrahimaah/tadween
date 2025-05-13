<?php

namespace App\Services;


use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ReplyService
{
    public function store($reply_data)
    {
        try {
            $reply = Reply::create($reply_data);

            if (!$reply) {
                throw new Exception("can not store reply");
            }
            return ['code' => 1, 'data' => $reply];
        } catch (Exception $ex) {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

   public function getRepliesByPostId($post_id)
   {
        try 
        {
            $replies = Reply::where('post_id', $post_id)
                        ->with('user')
                        ->whereNull('parent_id')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
            
            return ['code' => 1 , 'data' => $replies];
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
   }
}
