<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;

class Main extends Component
{
    public function render()
    {
        return view('livewire.pages.auth.main')
            ->layout('components.layouts.auth', [
                'title' => 'Main',
                'showLoader' => true,
            ]);
    }
}
