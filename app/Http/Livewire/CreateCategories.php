<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Section;
use App\Models\Category;

class CreateCategories extends Component
{
    public $section;
    public $category;
    public $category_name;
    public $category_can_skip;
    public $category_skip_text;
    public $category_has_tip;
    public $category_tip_text;

    protected $listeners = ['categoryAdded' => 'render' ];


    public function render()
    {
        return view('livewire.create-categories');
    }
    public function createCategory()
    {

         Category::create([
            'name' => $this->category_name,
            'order' => "1",
            'section_id' => $this->section->id,
            'can_skip' => $this->category_can_skip,
            'skip_text' => $this->category_skip_text,
            'has_tip' => $this->category_has_tip,
            'tip_text' => $this->category_tip_text,
       ]);

       $this->emitSelf('categoryAdded');

    }

}
