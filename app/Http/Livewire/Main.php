<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Main extends Component
{
    public function doSomething($value)
    {
        dd('Do something ' . $value);
    }

    public function render()
    {
        return view('livewire.main');
    }
}
