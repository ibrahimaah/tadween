<?php

use App\Constants\WithdrawType;
use App\Enums\PaymentMethods;
use Illuminate\Support\Facades\App;

// if (!function_exists('getTransactionDescription')) 
// {
//     function getTransactionDescription($transaction)
//     {  
//         if(!empty($transaction->meta['transfer_note']))
//         {
//             return $transaction->meta['transfer_note'];
//         }
//         else 
//         {
//             return PaymentMethods::getDescription($transaction->payment_method,true);
//         }
//         return null;
//     }
// }

if (!function_exists('getTransactionDescription')) 
{
    function getTransactionDescription($transaction): string
    {
        $locale = App::getLocale();

        $metaKeys = [
            WithdrawType::SEND_GIFT   => 'reason_' . $locale,
            WithdrawType::TRANSFER    => 'transfer_note_' . $locale,
        ];

        $key = $metaKeys[$transaction->withdraw_type] ?? null;

        if ($key && !empty($transaction->meta[$key])) {
            return $transaction->meta[$key];
        }

        return PaymentMethods::getDescription($transaction->payment_method, true);
    }

}
