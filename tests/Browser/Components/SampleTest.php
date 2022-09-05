<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Tests\Browser\Components\SampleComponent;
use Tests\DuskTestCase;

class SampleTest extends DuskTestCase
{
    public function hasHeadlessDisabled()
    {
        return true;
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, SampleComponent::class)
                ->assertSee('Sample!');
        });
    }
}
