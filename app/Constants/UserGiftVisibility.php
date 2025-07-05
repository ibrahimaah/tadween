<?php

namespace App\Constants;

final class UserGiftVisibility
{
    const PUBLIC = 'public';
    const PRIVATE = 'private';
    const ANONYMOUS = 'anonymous';

    /**
     * Get all available visibility options.
     *
     * @return string[]
     */
    public static function getAll(): array
    {
        return [
            self::PUBLIC,
            self::PRIVATE,
            self::ANONYMOUS,
        ];
    }
}
