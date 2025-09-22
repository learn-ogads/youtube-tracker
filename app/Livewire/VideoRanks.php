<?php

namespace App\Livewire;

use App\Models\Video;
use Illuminate\Support\Collection;
use Livewire\Component;

class VideoRanks extends Component
{
    public Video $video;
    public Collection $ranks;

    public function mount(Video $video)
    {
        $this->video = $video;
        $this->ranks = $video->ranks()->latest()->get();
    }

    public function render()
    {
        return view('livewire.video-ranks');
    }
}
