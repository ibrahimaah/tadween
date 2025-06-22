<?php

namespace App\Enums;

enum PaymentMethods: string
{
    case PAYPAL  = 'paypal';
    case CREDIT_OR_DEBIT_CARD  = 'Debit/Credit card';
    case CARD = 'card';

    // App\Enums\PaymentMethods.php (or a helper class)
    public static function getDescription(?string $method,$is_deposit_process=true): ?string
    {
        if(!$is_deposit_process)
        {
            return null;
        }
        return match ($method) {
            self::PAYPAL->value => __('wallet.deposit_via_paypal'),
            self::CREDIT_OR_DEBIT_CARD->value => __('wallet.deposit_via_credit_or_debit_card'),
            default => null,
        };
    }
}
