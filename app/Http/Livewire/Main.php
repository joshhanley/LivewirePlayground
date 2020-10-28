<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $inputValue;
    public $showDropdown = false;
    public $selectedItem;

    public $results = [
        ['id' => 1, 'value' =>'aa'],
        ['id' => 2, 'value' =>'aaa'],
        ['id' => 3, 'value' =>'aaaa'],
        ['id' => 4, 'value' =>'aaaaa'],
        ['id' => 5, 'value' =>'aaaaaa'],
        ['id' => 6, 'value' =>'aaaaaaa'],
        ['id' => 7, 'value' =>'aaaaaaaa'],
        ['id' => 8, 'value' =>'aaaaaaaaa'],
        ['id' => 9, 'value' =>'aaaaaaaaaa'],
        ['id' => 10, 'value' =>'aaaaaaaaaaa']
    ];

    public $filteredResults = [];

    protected $listeners = ['selectItem'];

    public function selectIndex($index)
    {
        $this->selectedItem = $this->filteredResults[$index]['value'] ?? null;
    }

    public function mount()
    {
        $this->limitResults();
    }

    public function limitResults()
    {
        if (is_null($this->inputValue) || $this->inputValue == '') {
            $this->filteredResults = $this->results;
        } else {
            $this->filteredResults = array_values(array_filter($this->results, function ($resultValue) {
                return strpos($resultValue['value'], $this->inputValue) !== false;
            }));
        }

        $this->dispatchBrowserEvent('results-change', ['count' => count($this->filteredResults)]);
    }

    public function updatedInputValue()
    {
        $this->limitResults();
    }

    public function render()
    {
        return view('livewire.main');
    }
}
