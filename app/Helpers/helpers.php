<?php

use Carbon\Carbon;

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
            'code' => false,
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