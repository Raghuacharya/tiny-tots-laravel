<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     */

    public $alerts = [];
    public $message;
    public $type;

    public function __construct($message = null, $type = null)
    {
        $this->message = $message;
        $this->type = $type;

        // Map of session keys to Bootstrap classes
        $types = [
            'success' => 'success',
            'error' => 'error',
            'warning' => 'warning',
            'info' => 'info',
            'login_error' => 'danger',
        ];

        foreach ($types as $key => $bootstrapType) {
            if (session($key)) {
                $this->alerts[] = [
                    'type' => $bootstrapType,
                    'message' => session($key),
                ];
            }
        }

        // Handle validation errors
        if (session()->has('errors')) {
            $errors = session('errors')->all();
            if (!empty($errors)) {
                $this->alerts[] = [
                    'type' => 'error',
                    'message' => implode('<br>', $errors),
                ];
            }
        }

        // Add direct message if passed
        if ($this->message) {
            $this->alerts[] = [
                'type' => $this->type, // or pass type dynamically if needed
                'message' => $this->message,
            ];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
