<div class="relative w-full h-screen p-4 flex flex-col  items-center bg-gray-100">
    <div class="flex flex-col space-y-4">
        <div>
            Parent
            <button type="button" wire:click="$toggle('show')" class="border border-gray-500 rounded">Toggle Child</button>
            <button type="button" wire:click="$refresh" class="border border-gray-500 rounded">Refresh Parent</button>
        </div>

        <div>
            @if ($show)
                <livewire:sample />
            @endif
        </div>
    </div>

    @once
        @push('scripts')
            <script>
                console.log('parent')

            </script>
        @endpush
    @endonce
</div>
