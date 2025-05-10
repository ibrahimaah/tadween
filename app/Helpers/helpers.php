<?php

if (!function_exists('deleteFile')) {
    function deleteFile(string $path): void
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
