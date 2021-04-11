<div class="relative w-full h-screen p-4 flex flex-col  items-center bg-gray-100">
    <div class="flex flex-col space-y-4">
        {{-- Put livewire component blade content here or reference another livewire component --}}
        <table>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Item Average</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->item_average }}</td>
                </tr>
            @endforeach
        </table>
        {{ $users->links() }}
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
