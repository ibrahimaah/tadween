<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Bavix\Wallet\Interfaces\Wallet;

class WalletService
{
    public function deposit($user_id, float|int $amount, array $meta = []): array
    {
        try 
        {
            $user = User::findOrFail($user_id);
            $transaction = $user->deposit($amount, $meta);

            if ($transaction) {
                return [
                    'code' => 1,
                    'msg' => __('wallet.deposit_success_msg'),
                    'data' => $transaction, 
                ];
            }

            return [
                'code' => 0,
                'msg' => __('wallet.deposit_error_msg'),
            ];
        } catch (Exception $ex) {
            return [
                'code' => 0,
                'msg' => $ex->getMessage(),
            ];
        }
    }
}
