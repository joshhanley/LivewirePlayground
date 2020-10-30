@props([
    'name' => null,
    'placeholder' => '',
    'selectAction',
    'selectOnTab' => true,
    'listItemComponent' => null,
    'resultsProperty',
    'inline' => null,
    'grouped' => null,
])
{{-- TODO - JH 30/10/2020: Return to selected on escape/tab, highlight selected on focus --}}
<div
    x-data="autocomplete({
        'selectAction': '{{ $selectAction }}',
        'selectOnTab': {{ $selectOnTab ? 'true' : 'false' }},
        'results': @entangle($resultsProperty),
        'isGrouped': {{ $grouped ? 'true' : 'false' }}
    })"
    x-init="init()"
    x-on:click.away="close()"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
>
    <div class="flex flex-col">
        <input
            {{ $attributes->wire('model') }}
            x-on:focus="show()"
            x-on:keydown.tab="tab()"
            x-on:keydown.shift.window="shift(true)" {{-- Detect shift on window otherwise shift+tab from another field not recognised --}}
            x-on:keyup.shift.window="shift(false)" {{-- Detect shift on window otherwise shift+tab from another field not recognised --}}
            x-on:blur.window="shift(false)" {{-- Clear shift on window blur otherwise can't select --}}
            x-on:keydown.escape.prevent="close(); event.target.blur()"
            x-on:keydown.enter.stop.prevent="selectItem(); event.target.blur()"
            x-on:keydown.arrow-up.prevent="focusPrevious()"
            x-on:keydown.arrow-down.prevent="focusNext()"
            x-on:keydown.home.prevent="focusFirst()"
            x-on:keydown.end.prevent="focusLast()"
            x-on:input.debounce.300ms="clearFocus()"
            class=" w-56 px-2 rounded border border-cool-gray-500"
            type="text"
            name="{{ $name ?? $attributes->wire('model')->value }}"
            placeholder="{{ $placeholder }}"
            autocomplete="off"
            />

        <div>
            Show:<span x-text="showDropdown ? 'true' : 'false'"></span>
            Shift:<span x-text="shiftIsPressed ? 'true' : 'false'"></span>
            Focus:<span x-text="focusIndex"></span>
            Total:<span x-text="totalResults()"></span>
        </div>
    </div>

    <div
        x-show="showDropdown && hasResults()"
        class="w-full p-2 overflow-y-hidden text-sm rounded border border-cool-gray-300 bg-cool-gray-50 shadow-inner {{ $inline ? 'lg:block' : 'lg:absolute'}} lg:p-0 lg:overflow-y-auto lg:max-h-96  lg:left-2 lg:mt-2 lg:w-56 lg:z-20 lg:border-cool-gray-400 lg:bg-white lg:shadow-lg"
        x-transition:enter="transition ease-out duration-100 origin-top"
        x-transition:enter-start="transform opacity-0 scale-y-90"
        x-transition:enter-end="transform opacity-100 scale-y-100"
        x-transition:leave="transition ease-in duration-75 origin-top"
        x-transition:leave-start="transform opacity-100 scale-y-100"
        x-transition:leave-end="transform opacity-0 scale-y-90"
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
            <div
                x-on:mouseleave="focusIndex = null"
                x-on:click="selectItem()"
            >
                @if($grouped)
                    @php
                        $index = 0
                    @endphp

                    @foreach($this->$resultsProperty as $group => $results)
                        <div class="px-2 font-bold border-b border-gray-300">{{ $group }}</div>

                        @foreach($results as $key => $result)
                            <div
                                :class="{ 'bg-blue-500' : focusIndex == {{ $index }}}"
                                class="px-2"
                                x-on:mouseenter="focusIndex = {{ $index }}"
                            >
                                @if($listItemComponent)
                                    <x-dynamic-component :component="$listItemComponent" :model="$result" />
                                @else
                                    <div>{{ $result }}</div>
                                @endif
                            </div>
                            @php
                                $index++;
                            @endphp
                        @endforeach
                    @endforeach
                @else
                    @foreach($this->$resultsProperty as $key => $result)
                        <div
                            :class="{ 'bg-blue-500' : focusIndex == {{ $key }}}"
                            class="px-2"
                            x-on:mouseenter="focusIndex = {{ $key }}"
                        >
                            @if($listItemComponent)
                                <x-dynamic-component :component="$listItemComponent" :model="$result" />
                            @else
                                <div>{{ $result }}</div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@once
<script>
    function autocomplete(config) {
        return {
            selectAction: config.selectAction,
            selectOnTab: config.selectOnTab,
            results: config.results,
            isGrouped: config.isGrouped,
            focusIndex: null,
            showDropdown: false,
            shiftIsPressed: false,
            resultsCount: null,

            init() {
                this.$watch('results', () => this.clearResultsCount())
            },

            show() {
                this.showDropdown = true
            },

            hide() {
                this.showDropdown = false
            },

            tab() {
                if(this.shiftIsPressed) return this.close()

                if(this.selectOnTab) return this.selectItem()

                return this.close()
            },

            shift(isPressed) {
                this.shiftIsPressed = isPressed
            },

            close() {
                this.hide()
                this.clearFocus();
            },

            clearFocus() {
                this.focusIndex = null
            },

            hasResults() {
                return this.totalResults() > 0
            },

            hasNoResults() {
                return ! this.hasResults()
            },

            clearResultsCount() {
                this.resultsCount = null
            },

            totalResults() {
                if(this.resultsCount) return this.resultsCount //Use memoised count

                if (this.isGrouped) {
                    return this.resultsCount = this.totalGroupedResults()
                }

                return this.resultsCount = this.results.length
            },

            totalGroupedResults() {
                return Object.values(this.results).reduce((count, row) => count + row.length, 0)
            },

            hasFocus() {
                return this.focusIndex !== null
            },

            hasNoFocus() {
                return ! this.hasFocus()
            },

            focusIsAtStart() {
                return this.focusIndex == 0
            },

            focusIsAtEnd() {
                return this.focusIndex >= this.totalResults() - 1
            },

            focusFirst() {
                this.focusIndex = 0
            },

            focusLast() {
                this.focusIndex = this.totalResults() - 1
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

            selectItem() {
                if (this.hasFocus()) this.$wire.call(this.selectAction, this.focusIndex)

                this.close()
            }
        }
    }
</script>
@endonce
