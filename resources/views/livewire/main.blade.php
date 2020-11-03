<div class="relative w-full h-screen p-4 flex flex-col  items-center bg-gray-100">
    <div class="flex space-x-4">
        {{-- Put livewire component blade content here or reference another livewire component --}}
        <div x-data="{
                step: @entangle('step'),
            }">
            <ul class="block">
                <li class="inline-block border border-gray-500 p-1 rounded shadow bg-white hover:bg-gray-300"><a href="#" @click.prevent="step = 1">1</a></li>
                <li class="inline-block border border-gray-500 p-1 rounded shadow bg-white hover:bg-gray-300"><a href="#" @click.prevent="step = 2">2</a></li>
                <li class="inline-block border border-gray-500 p-1 rounded shadow bg-white hover:bg-gray-300"><a href="#" @click.prevent="step = 3">3</a></li>
            </ul>

            <div class="border border-gray-500 p-4 rounded">
                <div x-show="step == 1">Step 1</div>
                <div x-show="step == 2">Step 2</div>
                <div x-show="step == 3">Step 3</div>
            </div>
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
