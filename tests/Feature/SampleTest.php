<?php

namespace Tests\Feature;

use App\Http\Livewire\Main;
use Glhd\Dawn\RunsBrowserTests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SampleTest extends TestCase
{
    use RefreshDatabase;
    use RunsBrowserTests;

    public function testExample()
    {
        $class = Main::class;
        $queryString = '';
        $url = '/livewire-dusk/'.urlencode($class).$queryString;

        $this->openBrowser()
            ->visit($url)
            ->waitForLivewireToLoad()
            ->assertSeeIn('body', 'App')
            ;
    }
}
