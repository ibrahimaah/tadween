<?php

namespace App\Exceptions;

use Exception;

class PostNotFoundException extends Exception
{
    public function __construct($slug)
    {
        parent::__construct("Post not found for slug: {$slug}");
    }
}
