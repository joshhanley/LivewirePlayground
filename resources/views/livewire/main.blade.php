<div class="relative w-full h-screen p-4 flex flex-col  items-center bg-gray-100">
    <div class="flex space-x-4">

        Selected Item:<span>{{ $this->selectedItem['value'] ?? null }}</span>
        Input Value:<span>{{ $this->inputValue ?? null }}</span>
        <x-autocomplete
            wire:model.debounce="inputValue"
            wire:select-item="selectIndex"
            result-component="list-item"
            input-changed="input-change"
            results-changed="results-change"
            item-selected="select-item" />
    </div>
</div>
