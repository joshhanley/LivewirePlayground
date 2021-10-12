<div>
    Child

    <button type="button" wire:click="$refresh" class="border border-gray-500 rounded">Refresh Child</button>
    <x-test />

    @once
        @push('scripts')
            <script>
                console.log('child')

            </script>
        @endpush
    @endonce
</div>
