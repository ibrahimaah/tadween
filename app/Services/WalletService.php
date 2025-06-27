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
            $sender = User::findOrFail($sender_id);
            $receiver = User::findOrFail($receiver_id);
            $amount = $amount;

            DB::beginTransaction();

            if ($sender->balance < $amount) {
                throw new Exception('wallet.insufficient_funds');
            }

            // $transfer = $sender->transfer($receiver, $amount, [
            //     'transfer_note' => __('wallet.transfer_from') . ' @' . "<a class='text-reset text-decoration-none' href='" . route('profile', $sender->username) . "'>" . $sender->username . "</a> " 
            //         . __('wallet.transfer_to') . ' @' . "<a class='text-reset text-decoration-none' href='" . route('profile', $receiver->username) . "'>" . $receiver->username . "</a>",
            // ]);
            

            $transfer = $sender->transfer($receiver, $amount, [
                'transfer_note_en' => __('wallet.transfer_from', [], 'en') . ' @' .
                    "<a class='text-reset text-decoration-none' href='" . route('profile', $sender->username) . "'>" . $sender->username . "</a> " .
                    __('wallet.transfer_to', [], 'en') . ' @' .
                    "<a class='text-reset text-decoration-none' href='" . route('profile', $receiver->username) . "'>" . $receiver->username . "</a>",
            
                'transfer_note_ar' => __('wallet.transfer_from', [], 'ar') . ' @' .
                    "<a class='text-reset text-decoration-none' href='" . route('profile', $sender->username) . "'>" . $sender->username . "</a> " .
                    __('wallet.transfer_to', [], 'ar') . ' @' .
                    "<a class='text-reset text-decoration-none' href='" . route('profile', $receiver->username) . "'>" . $receiver->username . "</a>",
            ]);
            
            DB::commit();

            return ['code' => 1, 'data' => $transfer]; 
        } 
        catch (InsufficientFunds $e) 
        {
            DB::rollBack();
            return ['code' => 0,'msg' => __('wallet.insufficient_funds')]; 
        } 
        catch (Throwable $ex) {
            DB::rollBack();
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
}
