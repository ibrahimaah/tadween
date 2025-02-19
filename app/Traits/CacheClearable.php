<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait CacheClearable
{
    /**
     * Clear cache for posts page.
     *
     * @return void
     */
    private function clear_posts_cache()
    {
        Cache::forget('posts_page_' . request('page', 1));
    }
}
