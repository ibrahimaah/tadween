<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReplyComponenet extends Component
{
    public $reply;
    public $replyShowRoute;

    public function __construct($reply,$replyShowRoute = '#')
    {
        $this->reply = $reply; 
        $this->replyShowRoute = $replyShowRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reply-componenet');
    }
}
