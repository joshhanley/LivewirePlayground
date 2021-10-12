<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sample extends Component
{
    public $showBlade = false;
    
    public function render()
    {
        return view('livewire.sample');
    }
}
