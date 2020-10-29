<div class="relative w-full h-screen p-4 flex flex-col  items-center bg-gray-100">
    <div class="flex flex space-x-4">

        <div wire:key="1">
            <x-autocomplete2
                    wire:model.debounce.300ms="userInput"
                    wire:selectitem.stop.prevent="selectUser"
                    :results="$this->users"
                    input-property="userInput"
                    results-property="users"
                    item-selected-method="selectUser"
                    result-component="user-item"
                    inline
                />

            <div class="flex flex-col space-y-4">
                <div>
                    <span class="font-bold">User</span>
                    <ul>
                        <li>Input:{{ $userInput }}</li>
                        <li>{{ $user->name }}</li>
                    </ul>
                </div>

                <div>
                    <span class="font-bold">Users Filtered</span>
                    <ul>
                        <li>Count:{{ count($users) }}</li>
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

        <div wire:key="2">
            <x-autocomplete2
                    wire:model.debounce.300ms="userInput2"
                    :results="$this->users2"
                    input-property="userInput2"
                    results-property="users2"
                    item-selected-method="selectUser2"
                    result-component="user-item"
                    inline
                />

            <div class="flex flex-col space-y-4">
                <div>
                    <span class="font-bold">User</span>
                    <ul>
                        <li>{{ $user2->name }}</li>
                    </ul>
                </div>

                <div>
                    <span class="font-bold">Users Filtered</span>
                    <ul>
                        @foreach($users2 as $user2)
                        <li>{{ $user2->name }}</li>
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
</div>
