<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $something = 'something';

    public function changeSomething()
    {
        $this->something = 'other thing';
    }

    public function render()
    {
        return view('livewire.main')
            ->layout('layouts.app', ['title' => 'Main component title']);
    }
}
