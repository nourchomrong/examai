<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;

class Joinexam extends Component
{
    public $exam_code = '';
    public $joinError = '';
    public function render()
    {
        return view('livewire.pages.auth.joinexam')
          ->layout('components.layouts.auth', [
                'title' => 'Join Exam',
                'showLoader' => false,
            ]);
    }
}
