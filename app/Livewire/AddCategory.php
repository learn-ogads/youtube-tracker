<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddCategory extends Component
{
    #[Validate(['required', 'string', 'min:2', 'max:255'])]
    public string $name = '';

    public function save()
    {
        $this->validate();

        Category::create([
            'name' => $this->name,
        ]);

        return Redirect::route('home')->with('flash.success', 'Added a category successfully');
    }

    public function render()
    {
        return view('livewire.add-category');
    }
}
