<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Main extends Component
{
    public $users;

    public $user;

    public $userInput;

    public $allUsers;

    public function mount()
    {
        $this->allUsers = User::all();
        $this->user = new User();
        $this->user->name = "test";
        $this->userInput = $this->user->name;
    }

    public function selectUser($focusIndex)
    {
        $this->user = $this->users[$focusIndex] ?? new User();
        $this->userInput = $this->user->name;
    }

    public function render()
    {
        $this->users = User::where('name', 'LIKE', "%{$this->userInput}%")->get();
        return view('livewire.main');
    }
}
