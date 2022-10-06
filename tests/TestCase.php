<?php

namespace Tests;

use Glhd\Dawn\Browser;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Route;
use Livewire\Macros\DuskBrowserMacros;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        Browser::mixin(new DuskBrowserMacros);

        Route::get('/livewire-dusk/{component}', function ($component) {
            $class = urldecode($component);

        return app()->call(new $class());
        })->middleware('web');
    }
}
