<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;

class Main extends Component
{
    public $users;
    public $users2;
    public $genericItems = [1,2,3,4,5,6,7,8];
    public $groupedItems = [];

    public $user;
    public $user2;
    public $genericItem;
    public $groupedItem;

    public $userInput;
    public $userInput2;
    public $genericItemInput;
    public $groupedItemInput;

    public $allUsers;
    public $groupedItemsAll = [
        'first' => [1,2,3],
        'second' => [4,15,16],
        'third' => [7,8,111]
    ];

    public function mount()
    {
        $this->allUsers = User::all();
        // $this->user = new User();
        // $this->userInput = $this->user->name;
        $this->getUsers();


        // $this->user2 = new User();
        // $this->userInput2 = $this->user2->name;
        $this->getUsers2();

        $this->getGroupedItems();
    }

    public function getUsers()
    {
        $this->users = User::where('name', 'LIKE', "%{$this->userInput}%")->get();
    }

    public function getUsers2()
    {
        $this->users2 = User::where('name', 'LIKE', "%{$this->userInput2}%")->get();
    }

    public function getGenericItems()
    {
    }

    public function getGroupedItems()
    {
        if ($this->groupedItemInput) {
            return $this->groupedItems = collect($this->groupedItemsAll)
                ->mapWithKeys(function ($item, $key) {
                    $results = collect($item)
                        ->filter(function ($value) {
                            return Str::contains($value, $this->groupedItemInput);
                        })
                        ->values()
                        ->toArray();

                    return [$key => $results];
                })
                ->toArray();
        }

        $this->groupedItems = $this->groupedItemsAll;
    }

    public function selectUser($focusIndex)
    {
        $this->user = $this->users[$focusIndex] ?? null;
        $this->userInput = $this->user->name ?? null;
        $this->getUsers();
    }

    public function selectUser2($focusIndex)
    {
        $this->user2 = $this->users2[$focusIndex] ?? null;
        $this->userInput2 = $this->user2->name ?? null;
        $this->getUsers2();
    }

    public function selectGenericItem($focusIndex)
    {
        $this->genericItem = $this->genericItems[$focusIndex] ?? null;
        $this->genericItemInput = $this->genericItem;
    }

    public function selectGroupedItem($focusIndex)
    {
        $this->groupedItem = Arr::flatten($this->groupedItems, 1)[$focusIndex] ?? null;
        $this->groupedItemInput = $this->groupedItem;

        $this->getGroupedItems();
    }

    public function clearUser()
    {
        $this->user = null;
        $this->userInput = null;
        $this->getUsers();
    }

    public function clearUser2()
    {
        $this->user2 = null;
        $this->userInput2 = null;
        $this->getUsers2();
    }

    public function clearGenericItem()
    {
        $this->genericItem = null;
        $this->genericItemInput = $this->genericItem;
    }

    public function clearGroupedItem()
    {
        $this->groupedItem = null;
        $this->groupedItemInput = $this->groupedItem;

        $this->getGroupedItems();
    }

    public function updatedUserInput()
    {
        $this->getUsers();
    }

    public function updatedUserInput2()
    {
        $this->getUsers2();
    }

    public function updatedGroupedItemInput()
    {
        $this->getGroupedItems();
    }

    public function render()
    {
        return view('livewire.main');
    }
}
