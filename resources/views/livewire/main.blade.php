<div class="relative w-full h-screen p-4 flex flex-col  items-center bg-gray-100">
    <div class="flex flex-col space-y-4">

        <x-autocomplete2
                wire:model.debounce.300ms="userInput"
                :results="$this->users"
                result-component="user-item"
                item-selected-event="user-selected"
                value=""
                inline
                wire:key="1"
            />

            <div>
                Users All
                <ul>
                    @foreach($allUsers as $user)
                    <li>{{ $user->name }}</li>
                    @endforeach
                </ul>
            </div>

        {{-- <div class="flex flex-col space-y-4" wire:key="1">
            <div>
                Selected Item:<span>{{ $this->selectedItem['value'] ?? null }}</span>
            </div>
            <div>
                Input Value:<span>{{ $this->inputValue ?? null }}</span>
            </div>
            <x-autocomplete
                wire:model.debounce.300ms="inputValue"
                wire:select-item="selectIndex"
                result-component="list-item"
                :initial-value="$this->inputValue"
                :results="$this->filteredResults"
                input-changed-event="input-change"
                results-changed-event="results-changed"
                item-selected-event="select-item"
                inline
                wire:key="1"
            />
        </div>

        <div class="flex flex-col space-y-4" wire:key="2">
            <div>
                Selected Item:<span>{{ $this->selectedItem2['value'] ?? null }}</span>
            </div>
            <div>
                Input Value:<span>{{ $this->inputValue2 ?? null }}</span>
            </div>
            <x-autocomplete
                wire:model.debounce.300ms="inputValue2"
                wire:select-item2="selectIndex2"
                result-component="list-item"
                :initial-value="$this->inputValue2"
                :results="$this->filteredResults2"
                input-changed-event="input-change2"
                results-changed-event="results-changed2"
                item-selected-event="select-item2"
                inline
                wire:key="2"
            />
            <input class="border border-gray-500" type="text" />
        </div>

        <div>
            {{ count($this->filteredResults) }}
            {{ count($this->filteredResults2) }}
        </div> --}}
    </div>
</div>
