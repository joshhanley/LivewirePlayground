<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $step = 1;

    protected $queryString = ['step'];

    public function render()
    {
        return view('livewire.main');
    }
}
