<div class="relative w-full h-screen p-4 flex flex-col  items-center bg-gray-100">
    <div class="flex space-x-4">

        <x-autocomplete wire:model="inputValue" wire:select-item="selectIndex">
            @foreach($this->filteredResults as $key => $result)
                <div
                    :class="{ 'bg-blue-500' : focusIndex == {{ $key }}}"
                    class="px-2"
                    wire:key="{{ $key.'-'.$result['id'] }}"
                >
                    <span>{{ $result['value'] }}</span>
                </div>
            @endforeach
        </x-autocomplete>
    </div>
</div>
