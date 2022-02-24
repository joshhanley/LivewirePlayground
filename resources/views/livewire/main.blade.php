<div>

    @if ($show)
        <ul>
            @foreach ($this->modelARows as $row)
                <li wire:key="model-a-{{ $row->id }}">{{ $row->id }}</li>
            @endforeach
        </ul>

        <div>
            {{ $this->modelARows->links() }}
        </div>
    @else
        <ul>
            @foreach ($this->modelBRows as $row)
                <li wire:key="model-b-{{ $row->id }}">{{ $row->id }}</li>
            @endforeach
        </ul>

        <div>
            {{ $this->modelBRows->links() }}
        </div>
    @endif

    <button wire:click="action">Test</button>

</div>
