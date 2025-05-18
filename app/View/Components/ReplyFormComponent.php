<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReplyFormComponent extends Component
{
    public $formId;
    public $action;
    public $postSlugId;
    // public $model;
    public $parentId;
    
    public function __construct(
        $postSlugId,
        // $model,
        $formId = "replyForm",
        $action = null,
        $parentId = null
    ) {
        $this->formId = $formId;
        $this->action = $action ?? route('reply.store'); // set default if null
        $this->postSlugId = $postSlugId;
        // $this->model = $model;
        $this->parentId = $parentId;
    }
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reply-form-component');
    }
}
