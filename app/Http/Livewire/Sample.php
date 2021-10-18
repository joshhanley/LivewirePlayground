<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Sample extends Component
{
    protected $users;

    public function mount()
    {
        $this->users = User::orderBy('id')->get();
    }
    
    public function hydrate()
    {
        $this->users = User::orderBy('id')->get();
    }

    public function addUser()
    {
        User::factory()->create();

        $this->users = User::orderBy('id')->get();

        $this->emit('user-added');
    }
    
    public function render()
    {
        return view('livewire.sample');
    }
}
