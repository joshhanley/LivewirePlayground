<div class="relative w-full h-screen p-4 flex flex-col  items-center bg-gray-100">
    <div class="flex space-x-4">
        {{-- Put livewire component blade content here or reference another livewire component --}}
        <div>
            <form>

                {{-- example of custom checkbox using Livewire V1.x method (no @entangle) --}}
                <div
                    wire:model="no_entangle"
                    x-data="{ checked: $wire.get('no_entangle') }"
                    @click="
                        checked = ! checked;
                        $dispatch('input', checked);
                    "
                    class="flex items-center h-6"
                >
                    <input
                        type="checkbox"
                        x-bind="checked"
                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                    />
                    <div class="ml-3 text-sm font-medium text-gray-700">
                            No Entangle
                            (
                                Livewire value =  {{ $no_entangle ? 'true' : 'false' }},
                                Alpine value =  <span x-text="checked ? 'true' : 'false'"></span>
                            )
                    </div>
                </div>

                {{-- example of custom checkbox using Livewire V2.x method (*with* @entangle) --}}
                <div
                    x-data="{ checked: @entangle('with_entangle') }"
                    @click="checked = ! checked"
                    class="flex items-center h-6"
                >
                    <input
                        type="checkbox"
                        x-bind="checked"
                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                    />
                    <div class="ml-3 text-sm font-medium text-gray-700">
                            With Entangle
                            (
                                Livewire value =  {{ $with_entangle ? 'true' : 'false' }},
                                Alpine value =  <span x-text="checked ? 'true' : 'false'"></span>
                            )
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@once
    @push('styles')
        {{-- Put any custom styles or library styles needed for this component here --}}

    @endpush

    @push('scripts')
        {{-- Put any custom scripts or library scripts needed for this component here --}}

    @endpush
@endonce
