<?php

namespace App\Livewire;

use App\Models\Video;
use Livewire\Component;

class VideoRow extends Component
{
    public Video $video;

    public function mount(Video $video)
    {
        $this->video = $video;
    }

    public function render()
    {
        return view('livewire.video-row');
    }
}
