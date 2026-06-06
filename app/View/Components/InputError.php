<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputError extends Component
{
    public $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function render()
    {
        return view('components.input-error');
    }
}