<?php

namespace App\Helpers\Charts;

use App\Data\ChartData;
use App\Exceptions\MaxDateRangeException;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class VideoViewsChart
{
    public function __construct(
        protected int $max_range = 14
    )
    {
    }

    /**
     * Will create the chart data for the specified days based on a video.
     * @throws MaxDateRangeException
     */
    public function create(Video $video, int $days): ChartData
    {
        /**
         * Check that the days do not exceed the max range
         */
        if ($days > $this->max_range) {
            throw new MaxDateRangeException('The provided date range for the chart is too large');
        }

        return $this->createData($video, $days);
    }

    protected function createData(Video $video, int $days): ChartData
    {
        /**
         * Create empty collections
         */
        $labels = Collection::empty();
        $totals = Collection::empty();

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels->push($date->format('M j'));

            /**
             * Get the highest stats for the day
             */
            $day_stats = $video->statistics()
                ->whereDate('created_at', $date->toDateString())
                ->orderBy('views', 'desc')
                ->first();

            /**
             * Use views as the main metric, default to 0 if no stats found
             */
            $totals->push($day_stats ? $day_stats->views : 0);
        }

        return ChartData::from([
            'labels' => $labels,
            'totals' => $totals,
            'count' => $totals->count(),
        ]);
    }
}
