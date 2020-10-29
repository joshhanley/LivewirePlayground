<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Main extends Component
{
    public $users;
    public $users2;

    public $user;
    public $user2;

    public $userInput;
    public $userInput2;

    public $allUsers;

    public function mount()
    {
        $this->allUsers = User::all();
        $this->user = new User();
        $this->user->name = "test";
        $this->userInput = $this->user->name;


        $this->user2 = new User();
        $this->user2->name = "test2";
        $this->userInput2 = $this->user2->name;
    }

    public function selectUser($focusIndex)
    {
        $this->user = $this->users[$focusIndex] ?? new User();
        $this->userInput = $this->user->name;
    }

    public function selectUser2($focusIndex)
    {
        $this->user2 = $this->users2[$focusIndex] ?? new User();
        $this->userInput2 = $this->user2->name;
    }

    public function render()
    {
        $this->users = User::where('name', 'LIKE', "%{$this->userInput}%")->get();
        $this->users2 = User::where('name', 'LIKE', "%{$this->userInput2}%")->get();

        return view('livewire.main');
    }
}
