<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Main extends Component
{
    protected $users;

    protected $listeners = [
        'user-added' => '$refresh',
    ];

    public function mount()
    {
        $this->users = User::orderBy('id')->get();
    }
    
    public function hydrate()
    {
        sleep(1);

        $this->users = User::orderBy('id')->get();
    }
    
    public function render()
    {
        return view('livewire.main');
    }
}
