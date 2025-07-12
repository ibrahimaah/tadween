<?php

namespace App\Services;

use App\Models\User;
use Exception; 
use Illuminate\Support\Facades\DB; 
use Bavix\Wallet\Exceptions\InsufficientFunds;
use Throwable;

// use Bavix\Wallet\Interfaces\Wallet;

class WalletService
{
    public function deposit($user_id, float|int $amount, array $meta = []): array
    {
        try {
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

    public function transfer($sender_id,$receiver_id,$amount)
    {
        try 
        {
            if ($sender_id == $receiver_id) {
                throw new Exception(__('wallet.cannot_transfer_to_self'));
            }
            $sender = User::findOrFail($sender_id);
            $receiver = User::findOrFail($receiver_id); 

            DB::beginTransaction();

            
            if ($sender->balance < $amount) 
            {
                throw new Exception(__('wallet.insufficient_funds'));
            }
 
            $transfer = $sender->transfer($receiver, $amount, [
                'transfer_note_en' => __('wallet.transfer', [], 'en') . ' ' .__('wallet.transfer_to', [], 'en') . ' ' .
                    "<a class='text-orange-color text-reset text-decoration-none' href='" . route('profile', $receiver->username) . "'>" . $receiver->name . "</a>",
            
                'transfer_note_ar' => __('wallet.transfer', [], 'ar') . ' ' .__('wallet.transfer_to', [], 'ar') . ' ' .
                    "<a class='text-orange-color text-reset text-decoration-none' href='" . route('profile', $receiver->username) . "'>" . $receiver->name . "</a>",
            ]);
            
            
            DB::commit();

            return ['code' => 1, 'data' => $transfer]; 
        } 
        catch (Throwable $ex) {
            DB::rollBack();
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }


    public function getUserBalance($userId)
    {
        try 
        {
            $user = User::findOrFail($userId);
            $userBalance = $user->balance;
            return ['code' => 1, 'data' => $userBalance];
        }
        catch(Throwable $th)
        {
            return ['code' => 0, 'msg' => $th->getMessage()];
        }
    }
}
