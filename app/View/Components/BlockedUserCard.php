<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlockedUserCard extends Component
{
    public $blockedUser;
    public $blockedUsername;

    public function __construct($blockedUser, $blockedUsername)
    {
        $this->blockedUser = $blockedUser;
        $this->blockedUsername = $blockedUsername;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blocked-user-card');
    }
}
