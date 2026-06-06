<?php

namespace App\Livewire\Pages\Auth\Exam;

use Livewire\Component;

class Examcode extends Component
{
    public $exam_code = '';
    public $joinError = '';
    public function render()
    {
        return view('livewire.pages.auth.exam.examcode');
    }
}
