@props([
    'name' => null,
    'placeholder' => '',
    'selectAction',
    'clearAction',
    'selectOnTab' => true,
    'listItemComponent' => null,
    'resultsProperty',
    'inline' => null,
    'grouped' => null,
    'delete' => null,
])
{{-- TODO - JH 30/10/2020: Return to selected on escape/tab, add grouped footer --}}
<div
    x-data="autocomplete({
        'selectAction': '{{ $selectAction }}',
        'clearAction': '{{ $clearAction }}',
        'selectOnTab': {{ $selectOnTab ? 'true' : 'false' }},
        'results': @entangle($resultsProperty),
        'isGrouped': {{ $grouped ? 'true' : 'false' }}
    })"
    x-init="init()"
    x-on:click.away="close()"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
    class="w-56 relative"
>
    <div>
        Show:<span x-text="showDropdown ? 'true' : 'false'"></span>
        Shift:<span x-text="shiftIsPressed ? 'true' : 'false'"></span>
        Focus:<span x-text="focusIndex"></span>
        Total:<span x-text="totalResults()"></span>
    </div>

    <div class="flex flex-col">
        <div class="relative">
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
                class="w-full px-2 rounded border border-cool-gray-500 {{ $this->{$attributes->wire('model')} ? 'bg-gray-300' : null }}"
                type="text"
                name="{{ $name ?? $attributes->wire('model')->value }}"
                placeholder="{{ $placeholder }}"
                autocomplete="off"
                @if($this->{$attributes->wire('model')})
                disabled
                @endif
            />

            <div>
                @if($this->{$attributes->wire('model')})
                <div x-on:click="clearItem()" class="absolute right-0 inset-y-0 flex items-center">
                    @if($delete)
                        {{ $delete }}
                    @else
                        <div class="pr-2">
                            <svg class="h-5 w-5 text-gray-700 fill-current transition-transform ease-in-out duration-100 transform hover:scale-105 hover:text-black" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    <div
        x-show="showDropdown && hasResults()"
        class="{{ $inline ? 'block relative' : 'absolute z-20'}} w-full h-56 overflow-y-hidden text-sm rounded border border-cool-gray-500 bg-white shadow-lg"
        x-transition:enter="transition ease-out duration-100 origin-top"
        x-transition:enter-start="transform opacity-0 scale-y-90"
        x-transition:enter-end="transform opacity-100 scale-y-100"
        x-transition:leave="transition ease-in duration-75 origin-top"
        x-transition:leave-start="transform opacity-100 scale-y-100"
        x-transition:leave-end="transform opacity-0 scale-y-90"
        x-cloak
    >
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
            class="h-full overflow-y-auto"
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

@once
<script>
    function autocomplete(config) {
        return {
            selectAction: config.selectAction,
            clearAction: config.clearAction,
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
            },

            clearItem() {
                this.$wire.call(this.clearAction)
            }
        }
    }
</script>
@endonce
