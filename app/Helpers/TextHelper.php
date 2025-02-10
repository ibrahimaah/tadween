<?php

namespace App\Helpers;

use App\Models\User;

class TextHelper
{
    // Process usernames referenced using the function
    public static function processMentions(string $postText): string
    {
        $mentionedUsernames = [];
        preg_match_all('/@(\w+)/', $postText, $matches);
        $mentionedUsernames = array_unique($matches[1]);

        $existingUsers = User::whereIn('username', $mentionedUsernames)
            ->pluck('username')
            ->toArray();

        $processedText = preg_replace_callback(
            '/@(\w+)/',
            function ($matches) use ($existingUsers) {
                $username = htmlspecialchars($matches[1], ENT_QUOTES, 'UTF-8');
                if (in_array($username, $existingUsers)) {
                    $url = url("/$username");
                    return "<a href='$url' class='text-decoration-none text-orange-color'>@$username</a>";
                } else {
                    return "@$username";
                }
            },
            $postText
        );
        
        return $processedText;
    }
}
