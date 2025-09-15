<?php

namespace App\Livewire;

use App\Exceptions\MaxDateRangeException;
use App\Helpers\Charts\VideoViewsChart;
use App\Models\Video;
use Livewire\Component;

class VideoChart extends Component
{
    public array $labels = [];
    public array $totals = [];
    public int $count;

    /**
     * @throws MaxDateRangeException
     */
    public function mount(Video $video): void
    {
        $video_chart = new VideoViewsChart(14);
        $data = $video_chart->create($video, 14);
        $this->labels = $data->labels->toArray();
        $this->totals = $data->totals->toArray();
        $this->count = $data->count;
    }

    public function render()
    {
        return view('livewire.video-chart');
    }
}
