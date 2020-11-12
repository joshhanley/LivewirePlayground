<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Template;
use App\Models\Section;


class CreateSections extends Component
{
    public $template;
    public $section_name;
    protected $listeners = ['sectionAdded' => 'render' ];



    public function render()
    {
        return view('livewire.create-sections');
    }

    public function createSection()
    {

        $section = Section::create([
            'name' => $this->section_name,
            'order' => "1",
            'template_id' => $this->template->id,
       ]);

      $this->emitSelf('sectionAdded');
    }
}
