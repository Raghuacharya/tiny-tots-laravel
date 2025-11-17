<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmModal extends Component
{
    public $id;
    public $message;
    public $action;
    public $method;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $message = null, $action = '#', $method = 'POST')
    {
        $this->id = $id;
        $this->message = $message ?? 'Are you sure you want to perform this action?';
        $this->action = $action;
        $this->method = strtoupper($method);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.confirm-modal');
    }
}
