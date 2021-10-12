<div>
    Child

    <button type="button" wire:click="$toggle('showBlade')" class="border border-gray-500 rounded">Toggle Blade</button>
    <button type="button" wire:click="$refresh" class="border border-gray-500 rounded">Refresh Child</button>

    <div>
        @if($showBlade)
        <x-test />
        @endif
    </div>

    @once
        @push('scripts')
            <script>
                console.log('child')

            </script>
        @endpush
    @endonce
</div>
