<div class="relative w-full h-screen p-4 flex flex-col  items-center bg-gray-100">
    <div class="flex space-x-4">
        {{-- Put livewire component blade content here or reference another livewire component --}}
        <div class="p-4 w-96 border border-gray-500">
            <h1 class="font-bold text-xl">Parent List</h1>
            <div>
                @foreach ($this->users as $user)
                    <div wire:key="user-{{ $user->id }}">{{ $user->name }}</div>
                @endforeach
            </div>
        </div>

        <livewire:sample />
    </div>
</div>
