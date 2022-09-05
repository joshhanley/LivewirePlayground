<?php

namespace Tests\Browser\Components;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Livewire\Component;
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
                // ->tinker()
                ->assertSee('Sample!');
        });
    }
}
