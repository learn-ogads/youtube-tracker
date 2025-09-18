<?php

namespace App\Livewire;

use App\Models\Video;
use Livewire\Component;

class VideoRanksChart extends Component
{
    public array $labels = [];
    public array $totals = [];
    public int $count;

    public function mount(Video $video): void
    {
        $video_chart = new \App\Helpers\Charts\VideoRanksChart(14);
        $data = $video_chart->create($video, 14);
        $this->labels = $data->labels->toArray();
        $this->totals = $data->totals->toArray();
        $this->count = $data->count;
    }

    public function render()
    {
        return view('livewire.video-ranks-chart');
    }
}
