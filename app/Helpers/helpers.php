<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

if (!function_exists('deleteFile')) {
    function deleteFile(string $path): void
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}

if (!function_exists('diffForHumans')) {
    function diffForHumans($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
}

if (!function_exists('generateErrorResponse')) {

    // Common response structure for errors
    function generateErrorResponse($msg, $errors = null)
    {
        return response()->json([
            'success' => false,
            'msg' => $msg,
            'errors' => $errors
        ]);
    }
}


if (!function_exists('sanitizeText')) {
    function sanitizeText(?string $text): ?string
    {
        return $text ? htmlspecialchars($text, ENT_QUOTES, 'UTF-8') : null;
    }
}



if (!function_exists('replyJsonResponse')) {
    function replyJsonResponse($reply)
    { 
        return [
            'is_owner' => Auth::id() === $reply->user_id,
            'reply_text' => sanitizeText($reply->reply_text),
            'reply_image' => sanitizeText($reply->reply_image),
            'slug_id' => $reply->slug_id,
            'created_at' => Carbon::parse($reply->created_at)->diffForHumans(),
            'user' => [
                'name' => sanitizeText($reply->user->name),
                'username' => sanitizeText($reply->user->username),
                'cover_image' => $reply->user_cover_image,
                'is_private' => $reply->user->is_private(),
            ],
            'reply_show_route' => route('replies.show', $reply->slug_id),
        ];
    }
}