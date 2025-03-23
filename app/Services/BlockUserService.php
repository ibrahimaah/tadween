<?php

namespace App\Services;

use App\Models\BlockedUser;
use App\Models\Follow;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlockUserService
{

    public function deleteFollowRecords($user_id, $blocked_user_id)
    {
        Follow::whereIn('follower_id', [$user_id, $blocked_user_id])
            ->whereIn('following_id', [$user_id, $blocked_user_id])
            ->delete();
    }


    public function block($blocked_user_id)
    {
        try 
        {
            DB::beginTransaction();
            /** @var \App\Models\User $user  */
            $user = Auth::user();
            
            $blocked_user = User::findOrFail($blocked_user_id);

            if ($blocked_user->hasBlocked($user)) 
            {
                throw new Exception("You can not block user , has already blocked you !!");
            }

            
            $this->deleteFollowRecords($user->id, $blocked_user->id);

            // Block a user
            $user->blockedUsers()->attach($blocked_user_id);
            
            // Check if the record was successfully created
            if ($user->hasBlocked($blocked_user)) 
            {
                DB::commit();
                // The record was successfully created
                return ['code' => 1, 'data' => true];
            } 
            else 
            {
                // The creation failed
                throw new Exception('can not block this user');
            }

        } catch (Exception $ex) 
        {
            DB::rollBack();
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    public function unblock($blocked_user_id)
    {
        try {
            /** @var \App\Models\User $user  */
            $user = Auth::user(); 
            $blocked_user = User::findOrFail($blocked_user_id);

            $is_success = $user->unblock($blocked_user);

            // Check if the record was successfully created
            if ($is_success) {
                // The record was successfully created
                return ['code' => 1, 'data' => true];
            } else {
                // The creation failed
                throw new Exception('can not unblock this user');
            }
        } catch (Exception $ex) {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
}
