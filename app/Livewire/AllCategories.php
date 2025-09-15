<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class AllCategories extends Component
{
    public function render()
    {
        return view('livewire.all-categories', [
            'categories' => Category::all()
        ]);
    }
}
