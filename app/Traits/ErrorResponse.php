<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait ErrorResponse
{
    /**
     * Clear cache for posts page.
     *
     * @return void
     */
    private function get_error_response($msg)
    {
        return response()->json([
            'code' => 0,
            'msg' => $msg,
        ]);
    }
}
