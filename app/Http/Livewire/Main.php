<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\User;
use Livewire\Component;

class Main extends Component
{
    public function usersWithAverageQuery() {
    $averageQuery = Item::query()
        ->selectRaw("AVG(amount) as item_average")
        ->whereColumn('user_id', 'users.id');

    return User::query()
        ->select()
        ->selectSub($averageQuery, 'item_average')
        ->orderBy('item_average', 'desc');
    }
    public function render()
    {
        return view('livewire.main', [
            'users' => $this->usersWithAverageQuery()->paginate(3)
            ]);
    }
}
