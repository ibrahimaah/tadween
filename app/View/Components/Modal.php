<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public string $id;
    public string $title;
    public string $message;
    public string $confirmButtonId;

    public function __construct(
        $id = '', 
        $title = '', 
        $message = '', 
        $confirmButtonId = ''
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->message = $message;
        $this->confirmButtonId = $confirmButtonId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
