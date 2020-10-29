<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $inputValue;
    public $inputValue2;
    public $selectedItem;
    public $selectedItem2;

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

    public $results2 = [
        ['id' => 1, 'value' =>'bb'],
        ['id' => 2, 'value' =>'bbb'],
        ['id' => 3, 'value' =>'bbbb'],
        ['id' => 4, 'value' =>'bbbbb'],
        ['id' => 5, 'value' =>'bbbbbb'],
        ['id' => 6, 'value' =>'bbbbbbb'],
        ['id' => 7, 'value' =>'bbbbbbbb'],
        ['id' => 8, 'value' =>'bbbbbbbbb'],
        ['id' => 9, 'value' =>'bbbbbbbbbb'],
        ['id' => 10, 'value' =>'bbbbbbbbbbb']
    ];

    public function selectIndex($data)
    {
        if (isset($data['index'])) {
            $index = $data['index'];

            $this->selectedItem = $this->filteredResults[$index] ?? null;

            $this->inputValue = $this->selectedItem['value'];

            $this->dispatchBrowserEvent('input-change', ['value' => $this->inputValue]);
        }
    }

    public function getFilteredResultsProperty()
    {
        if (is_null($this->inputValue) || $this->inputValue == '') {
            $filteredResults = $this->results;
        } else {
            $filteredResults = array_values(array_filter($this->results, function ($resultValue) {
                return strpos($resultValue['value'], $this->inputValue) !== false;
            }));
        }

        $this->dispatchBrowserEvent('results-changed', ['count' => count($filteredResults)]);

        return $filteredResults;
    }

    public function selectIndex2($data)
    {
        if (isset($data['index'])) {
            $index = $data['index'];

            $this->selectedItem2 = $this->filteredResults2[$index] ?? null;

            $this->inputValue2 = $this->selectedItem2['value'];

            $this->dispatchBrowserEvent('input-change2', ['value' => $this->inputValue2]);
        }
    }

    public function getFilteredResults2Property()
    {
        if (is_null($this->inputValue2) || $this->inputValue2 == '') {
            $filteredResults2 = $this->results2;
        } else {
            $filteredResults2 = array_values(array_filter($this->results2, function ($resultValue) {
                return strpos($resultValue['value'], $this->inputValue2) !== false;
            }));
        }

        $this->dispatchBrowserEvent('results-changed2', ['count' => count($filteredResults2)]);

        return $filteredResults2;
    }

    public function render()
    {
        return view('livewire.main');
    }
}
