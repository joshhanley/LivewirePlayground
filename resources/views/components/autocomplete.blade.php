@props(['result-component', 'input-changed', 'results-changed'])
<div x-data="autocomplete({'inputChanged': '{{ $inputChanged }}', 'resultsChanged': '{{ $resultsChanged }}'})"
    x-init="init()"
    x-on:click.away="showDropdown = false"
    {{ $attributes }}
>
    <div class="flex">
        <input
            x-on:focus="show()"
            x-on:blur="cancel()"
            x-on:keydown.arrow-up.prevent="previousFocus()"
            x-on:keydown.arrow-down.prevent="nextFocus()"
            x-on:keydown.escape.prevent="cancel(); event.target.blur()"
            x-on:keydown.enter.stop.prevent="selectItem($dispatch); event.target.blur()"
            x-model="search"
            class="w-full px-2 rounded border border-cool-gray-500"
            type="text"
            name="search"
            placeholder="Search"
            autocomplete="off" />

        <div>
            Focus:<span x-text="focusIndex"></span>
            Total:<span x-text="countResults"></span>
        </div>
    </div>

    <div x-show="showDropdown && countResults"
        class="w-full p-2 overflow-y-hidden text-sm rounded border border-cool-gray-300 bg-cool-gray-50 shadow-inner lg:absolute lg:p-0 lg:overflow-y-auto lg:max-h-96  lg:left-2 lg:mt-2 lg:w-56 lg:z-20 lg:border-cool-gray-400 lg:bg-white lg:shadow-lg"
        x-cloak
    >
        <div class="overflow-y-auto max-h-96 border border-cool-gray-300 rounded shadow-sm bg-white lg:overflow-y-visible lg:max-h-none lg:border-0 lg:rounded-none lg:bg-transparent lg:shadow-none">
            @foreach($this->filteredResults as $key => $result)
                <div
                    :class="{ 'bg-blue-500' : focusIndex == {{ $key }}}"
                    class="px-2"
                    wire:key="{{ $key }}"
                    x-on:mouseenter="focusIndex = {{ $key }}"
                    x-on:mouseenter="focusIndex = null"
                    x-on:click="selectItem($dispatch)"
                >
                    <x-dynamic-component :component="$resultComponent" :model="$result" />
                </div>
            @endforeach
        </div>
    </div>
</div>

@once
<script>
    function autocomplete(config) {
        return {
            search: '',
            focusIndex: null,
            showDropdown: false,
            countResults: 0,
            inputChanged: config.inputChanged,
            resultsChanged: config.resultsChanged,

            init() {
                this.$watch('search', () => this.clearFocus())

                this.countResults = this.$wire.filteredResults.length

                window.addEventListener(this.inputChanged, event => {
                    this.search = event.detail.value
                })

                window.addEventListener(this.resultsChanged, event => {
                    this.countResults = event.detail.count
                })
            },

            show() {
                this.showDropdown = true
            },

            hide() {
                this.showDropdown = false
            },

            cancel() {
                this.hide()
                this.clearFocus();
            },

            clearFocus() {
                this.focusIndex = null;
            },

            previousFocus() {
                if(this.focusIndex <= 0 || this.focusIndex == null) return this.clearFocus()

                this.focusIndex--
            },

            nextFocus() {
                if(this.countResults <= 0) return this.clearFocus()

                if(this.focusIndex == null && this.countResults > 0) return this.focusIndex = 0

                this.focusIndex++

                if(this.focusIndex >= this.countResults) this.focusIndex = this.countResults - 1
            },

            selectItem($dispatch) {
                $dispatch('select-item', { 'index': this.focusIndex });

                this.hide()
                this.clearFocus()
            }
        }
    }
</script>
@endonce
