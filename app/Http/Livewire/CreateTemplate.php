<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;

class CreateTemplate extends Component
{
    public $template;

    protected $rules = [
        'template.name' => 'required|string',
        'template.description' => 'required|string',
        'template.is_shareable' => 'required|boolean',
    ];

    public function mount()
    {
        $this->template = Template::first();
    }

    public function render()
    {
        return view('livewire.create-template');
    }

    public function update()
    {
        $this->template->save();
    }
}
