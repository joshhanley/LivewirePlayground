@props([
    'results',
    'result-component',
    'initial-count',
    'input-changed-event',
    'results-changed-event',
    'item-selected-event'
])
<div
    x-data="autocomplete()"
    x-init="init()"
    x-on:click.away="showDropdown = false"
    x-on:{{ $inputChangedEvent }}.window="search = event.detail.value"
    x-on:{{ $resultsChangedEvent }}.window="countResults = event.detail.count"
    {{ $attributes }}
>
    <div class="flex flex-col">
        <input
            x-on:focus="show()"
            x-on:keydown.tab="cancel()"
            x-on:keydown.escape.prevent="cancel(); event.target.blur()"
            x-on:keydown.enter.stop.prevent="selectItem($dispatch); event.target.blur()"
            x-on:keydown.arrow-up.prevent="focusPrevious()"
            x-on:keydown.arrow-down.prevent="focusNext()"
            x-on:keydown.home.prevent="focusFirst()"
            x-on:keydown.end.prevent="focusLast()"
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
        <div class="overflow-y-auto relative max-h-96 border border-cool-gray-300 rounded shadow-sm bg-white lg:overflow-y-visible lg:max-h-none lg:border-0 lg:rounded-none lg:bg-transparent lg:shadow-none">
            <div wire:loading.class.remove="hidden" class="hidden absolute inset-0 flex items-center justify-center">
                <div class="absolute inset-0 bg-gray-500 opacity-25"></div>
                <svg class="animate-spin h-4 w-4 text-cool-gray-700 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <div>
                @foreach($results as $key => $result)
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
</div>

@once
<script>
    function autocomplete(config) {
        return {
            search: '',
            focusIndex: null,
            showDropdown: false,
            countResults: {{ count($results) }},

            init() {
                this.$watch('search', () => this.clearFocus())
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

            hasNoResults() {
                return this.countResults <= 0
            },

            hasNoFocus() {
                return this.focusIndex == null
            },

            focusIsAtStart() {
                return this.focusIndex == 0
            },

            focusIsAtEnd() {
                return this.focusIndex >= this.countResults - 1
            },

            focusFirst() {
                this.focusIndex = 0
            },

            focusLast() {
                this.focusIndex = this.countResults - 1
            },

            focusPrevious() {
                if(this.hasNoResults()) return this.clearFocus()

                if(this.hasNoFocus()) return

                if(this.focusIsAtStart()) return this.clearFocus();

                this.focusIndex--
            },

            focusNext() {
                if(this.hasNoResults()) return this.clearFocus()

                if(this.hasNoFocus()) return this.focusFirst()

                if(this.focusIsAtEnd()) return

                this.focusIndex++
            },

            selectItem($dispatch) {
                $dispatch('{{ $itemSelectedEvent }}', { 'index': this.focusIndex });

                this.hide()
                this.clearFocus()
            }
        }
    }
</script>
@endonce
