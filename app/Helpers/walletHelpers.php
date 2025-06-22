<?php

use App\Enums\PaymentMethods;


if (!function_exists('getTransactionDescription')) 
{
    function getTransactionDescription($transaction)
    {  
        if($transaction->type === 'withdraw' && !empty($transaction->meta['note']))
        {
            return $transaction->meta['note'];
        }
        else 
        {
            return PaymentMethods::getDescription($transaction->payment_method,true);
        }
        return null;
    }
}