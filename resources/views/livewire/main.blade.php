<div class="relative w-full h-screen p-4 flex flex-col  items-center bg-gray-100">
    <div class="flex flex-col space-y-4">

        <div>
            Selected Item:<span>{{ $this->selectedItem['value'] ?? null }}</span>
        </div>
        <div>
            Input Value:<span>{{ $this->inputValue ?? null }}</span>
        </div>
        <x-autocomplete
            wire:model.debounce="inputValue"
            wire:select-item="selectIndex"
            result-component="list-item"
            :results="$this->filteredResults"
            input-changed="input-change"
            results-changed="results-changed"
            item-selected="select-item" />
    </div>
</div>
