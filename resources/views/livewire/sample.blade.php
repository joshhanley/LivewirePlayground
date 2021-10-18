<div class="p-4 w-96 border border-gray-500">
    <h1 class="font-bold text-xl">Child List</h1>

    <div>
        @foreach ($this->users as $user)
            <div wire:key="user-{{ $user->id }}">{{ $user->name }}</div>
        @endforeach
    </div>

    <button type="button" wire:click="addUser" class="px-3 py-1 bg-white border border-gray-500 rounded">Add User</button>
</div>
