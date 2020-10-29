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
        $this->userInput = $this->user->name;
        $this->getUsers();


        $this->user2 = new User();
        $this->userInput2 = $this->user2->name;
        $this->getUsers2();
    }

    public function getUsers()
    {
        $this->users = User::where('name', 'LIKE', "%{$this->userInput}%")->get();
    }

    public function getUsers2()
    {
        $this->users2 = User::where('name', 'LIKE', "%{$this->userInput2}%")->get();
    }

    public function selectUser($focusIndex)
    {
        $this->user = $this->users[$focusIndex] ?? new User();
        $this->userInput = $this->user->name;
        $this->getUsers();
    }

    public function selectUser2($focusIndex)
    {
        $this->user2 = $this->users2[$focusIndex] ?? new User();
        $this->userInput2 = $this->user2->name;
        $this->getUsers2();
    }

    public function updatedUserInput()
    {
        $this->getUsers();
    }

    public function updatedUserInput2()
    {
        $this->getUsers2();
    }

    public function render()
    {
        return view('livewire.main');
    }
}
