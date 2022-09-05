<?php

namespace Tests\Browser\Components;

use Livewire\Component;

class SampleComponent extends Component
{
    public function mount()
    {
        ray('mountSample');
    }

    public function hydrate()
    {
        ray('hydrateSample');
    }

    public function render()
    {
        return <<< 'HTML'
            <div>
                Sample!

                <div>
                    <livewire:tests.browser.components.other-component />
                </div>

                <button wire:click="$refresh">Refresh Sample</button>
            </div>
        HTML;
    }
}
