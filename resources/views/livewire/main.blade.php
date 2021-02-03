<div class="relative w-full h-screen p-4 flex flex-col  items-center bg-gray-100">
    <div class="flex space-x-4">
        {{-- Put livewire component blade content here or reference another livewire component --}}
        <button wire:click="$refresh" class="border border-gray-600 rounded px-4 py-2">Refresh Server</button>
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
