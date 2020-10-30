<div class="relative w-full h-screen p-4 flex flex-col  items-center bg-gray-100">
    <div class="flex flex space-x-4">

        <div wire:key="1">
            <x-autocomplete
                    wire:model.debounce.300ms="userInput"
                    select-action="selectUser"
                    results-property="users"
                    list-item-component="user-item"
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
            <x-autocomplete
                    wire:model.debounce.300ms="userInput2"
                    select-action="selectUser2"
                    select-on-tab="false"
                    results-property="users2"
                    list-item-component="user-item"
                    inline
                />

            <div class="flex flex-col space-y-4">
                <div>
                    <span class="font-bold">User</span>
                    <ul>
                        <li>Input:{{ $userInput2 }}</li>
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

        <div wire:key="3">
            <x-autocomplete
                    wire:model.debounce.300ms="genericItemInput"
                    select-action="selectGenericItem"
                    results-property="genericItems"
                    inline
                />

            <div class="flex flex-col space-y-4">
                <div>
                    <span class="font-bold">Generic Item</span>
                    <ul>
                        <li>Input:{{ $genericItemInput }}</li>
                        <li>{{ $genericItem }}</li>
                    </ul>
                </div>

                <div>
                    <span class="font-bold">Generic Items Filtered</span>
                    <ul>
                        @foreach($genericItems as $genericItemLoop)
                        <li>{{ $genericItemLoop }}</li>
                        @endforeach
                    </ul>
                </div>
                </div>
            </div>
        </div>


    </div>
</div>
