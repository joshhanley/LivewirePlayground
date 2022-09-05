<?php

namespace Tests;

use Laravel\Dusk\Browser;
use Livewire\Macros\DuskBrowserMacros;
use Tests\DuskTestCase;

abstract class DuskExtensionTestCase extends DuskTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Browser::mixin(new DuskBrowserMacros());
    }
}
