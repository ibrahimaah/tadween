<?php

use App\Enums\PaymentMethods;


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
    function getTransactionDescription($transaction)
    {
        $locale = app()->getLocale();
        
        $noteKey = 'transfer_note_' . $locale;

        if (!empty($transaction->meta[$noteKey])) {
            return $transaction->meta[$noteKey];
        }

        return PaymentMethods::getDescription($transaction->payment_method, true);
    }
}
