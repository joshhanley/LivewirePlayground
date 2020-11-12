<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Template;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Template::firstOrCreate(['name' => 'Testing Template', 'description' => 'This template is for testing']);
        Section::create(['name' => 'Test Section', 'order' => '1', 'template_id' => 1]);
        Section::create(['name' => 'Test Section 2', 'order' => '2', 'template_id' => 1]);
    }
}
