<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Main extends Component
{
    use AuthorizesRequests;

    public function mount()
    {
        $this->authorize('can-do-a-thing');
    }

    public function render()
    {
        return view('livewire.main');
    }
}
