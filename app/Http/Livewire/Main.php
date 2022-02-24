<?php

namespace App\Http\Livewire;

use App\Models\ModelA;
use App\Models\ModelB;
use Livewire\Component;
use Livewire\WithPagination;

class Main extends Component
{
    use WithPagination;

    public $show = true;
    public $queryString = ['show'];

    public function action(){
        $this->show = !$this->show;
    }
    
    public function getModelARowsProperty(){
        return ModelA::paginate(3, ['*'], 'modelAPagination'); 
    }

    public function getModelBRowsProperty(){
        return ModelB::paginate(3, ['*'], 'modelBPagination'); 
    }

    public function render()
    {
        return view('livewire.main');
    }
}
