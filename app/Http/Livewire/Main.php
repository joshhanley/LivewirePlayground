<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $show = false;

    public function render()
    {
        return view('livewire.main');
    }
}
