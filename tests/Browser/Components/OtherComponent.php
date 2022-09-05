<?php

namespace Tests\Browser\Components;

use Livewire\Component;

class OtherComponent extends Component
{
    public function mount()
    {
        ray('mountOther');
    }

    public function hydrate()
    {
        ray('hydrateOther');
    }

    public function render()
    {
        return <<< 'HTML'
            <div>
                Other!

                <div>
                </div>

                <button wire:click="$refresh">Refresh Other</button>
            </div>
        HTML;
    }
}
