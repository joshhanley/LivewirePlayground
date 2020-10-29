<div class="relative w-full h-screen p-4 flex flex-col  items-center bg-gray-100">
    <div class="flex flex-col space-y-4">

        <x-autocomplete2
                wire:model.debounce.300ms="userInput"
                :results="$this->users"
                result-component="user-item"
                item-selected-method="selectUser"
                inline
            />

            <div class="flex flex-col space-y-4">
                <div>
                <span class="font-bold">User</span>
                <ul>
                    <li>{{ $user->name }}</li>
                </ul>
            </div>
                <div>
                    <span class="font-bold">Users Filtered</span>
                    <ul>
                        @foreach($users as $user)
                        <li>{{ $user->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <span class="font-bold">Users All</span>
                    <ul>
                        @foreach($allUsers as $user)
                        <li>{{ $user->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
    </div>
</div>
