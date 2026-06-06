<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;

class Register extends Component
{

    public $username = '';
    public $password = '';
    public $registerError = '';
    public function render()
    {
        return view('livewire.pages.auth.register')
            ->layout('components.layouts.auth', [
                'title' => 'Register',
                'showLoader' => false,
            ]);
    }
}
