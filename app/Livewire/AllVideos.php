<?php

namespace App\Livewire;

use App\Models\Category;
use Cookie;
use Livewire\Component;

class AllVideos extends Component
{
    public Category $category;
    public $videos = [];
    public string $layout = 'grid';

    /**
     * Change the layout of how videos are displayed
     * @param string $layout
     * @return void
     */
    public function changeLayout(string $layout): void
    {
        $this->layout = $layout;

        /**
         * Set the layout as a cookie for 30 days
         */
        Cookie::queue('videos_layout', $layout, 43200);
    }

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->videos = $category->videos()->latest()->get();
        $this->layout = Cookie::get('videos_layout', 'grid');
    }

    public function render()
    {
        return view('livewire.all-videos');
    }
}
