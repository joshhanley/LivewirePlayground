<div x-data="{
        search: '',
        focusIndex: null,
        showDropdown: false,
        totalResults: $wire.filteredResults.length,

        previousFocus() {
            if(this.focusIndex <= 0 || this.focusIndex == null) return this.focusIndex = null

            this.focusIndex--
        },
        nextFocus() {
            if(this.totalResults <= 0) return this.focusIndex = null

            if(this.focusIndex == null && this.totalResults > 0) return this.focusIndex = 0

            this.focusIndex++

            if(this.focusIndex >= this.totalResults) this.focusIndex = this.totalResults - 1
        },
        resetFocus() {
            console.log('focus reset')
            this.focusIndex = null
        },
        selectItem($dispatch) {
            console.log('dispatch select item')
            $dispatch('select-item', this.focusIndex);
            {{-- this.$wire.selectIndex(this.focusIndex) --}}
        }
    }"
    x-init="$watch('search', (value) => {
        resetFocus()
        {{-- $wire.set('inputValue', value) --}}
    })"
    x-on:results-change.window="totalResults = event.detail.count"
    x-on:click.away="showDropdown = false"
    {{ $attributes }}
>
    <div class="flex">
        <input
            x-on:focus="showDropdown = true"
            x-on:keydown.arrow-up.prevent="previousFocus()"
            x-on:keydown.arrow-down.prevent="nextFocus()"
            x-on:keydown.enter.prevent="selectItem($dispatch)"
            x-model="search"
            class="w-full px-2 rounded border border-cool-gray-500"
            type="text"
            name="search"
            placeholder="Search"
            autocomplete="off" />

        <div>
            Focus:<span x-text="focusIndex"></span>
            Total:<span x-text="totalResults"></span>
            Selected Item:<span>{{ $this->selectedItem }}</span>
        </div>
    </div>

    <div x-show="showDropdown && totalResults"
        class="w-full p-2 overflow-y-hidden text-sm rounded border border-cool-gray-300 bg-cool-gray-50 shadow-inner lg:absolute lg:p-0 lg:overflow-y-auto lg:max-h-96  lg:left-2 lg:mt-2 lg:w-56 lg:z-20 lg:border-cool-gray-400 lg:bg-white lg:shadow-lg"
        x-cloak
    >
        <div class="overflow-y-auto max-h-96 border border-cool-gray-300 rounded shadow-sm bg-white lg:overflow-y-visible lg:max-h-none lg:border-0 lg:rounded-none lg:bg-transparent lg:shadow-none">
            @foreach($this->filteredResults as $key => $result)
                <div
                    :class="{ 'bg-blue-500' : focusIndex == {{ $key }}}"
                    class="px-2"
                    wire:key="{{ $key.'-'.$result['id'] }}"
                >
                    <span>{{ $result['value'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
