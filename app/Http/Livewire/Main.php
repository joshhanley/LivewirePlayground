<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $no_entangle;
    public $with_entangle;

    public function render()
    {
        return view('livewire.main');
    }
}
