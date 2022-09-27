<?php

namespace Tests\Feature;

use App\Http\Livewire\Main;
use Glhd\Dawn\RunsBrowserTests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class SampleTest extends TestCase
{
    use RefreshDatabase;
    use RunsBrowserTests;

    public function testExample()
    {
        Route::get('/livewire2-dusk/{component}', function ($component) {
            $class = urldecode($component);

            return app()->call(new $class());
        })->middleware('web');
        
        $class = Main::class;
        $queryString = '';
        $url = '/livewire2-dusk/'.urlencode($class).$queryString;

        $this->openBrowser()
            ->visit($url)
            ->assertSeeIn('body', 'App')
            ;
    }
}
