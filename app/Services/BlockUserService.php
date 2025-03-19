<?php

namespace App\Services;

use App\Models\BlockedUser;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class BlockUserService
{
    public function block($blocked_user_id)
    {
        try {
            /** @var \App\Models\User $user  */
            $user = Auth::user();

            $blockedUser = $user->blockedUsers()->create([
                'blocked_user_id' => $blocked_user_id
            ]);

            // Check if the record was successfully created
            if ($blockedUser) {
                // The record was successfully created
                return ['code' => 1, 'data' => $blockedUser];
            } else {
                // The creation failed
                throw new Exception('can not block this user');
            }
        } catch (Exception $ex) {
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
