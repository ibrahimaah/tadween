<?php

namespace App\Constants;

final class WithdrawType
{
    const TRANSFER = 'transfer';
    const SEND_GIFT = 'send_gift'; 

    /**
     * Get all available visibility options.
     *
     * @return string[]
     */
    public static function getAll(): array
    {
        return [
            self::TRANSFER,
            self::SEND_GIFT, 
        ];
    }
}
