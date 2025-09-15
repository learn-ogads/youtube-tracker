<?php

namespace App\Console\Commands;

use App\Models\Video;
use Illuminate\Console\Command;

class GetVideoStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-video-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the stats for all videos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /**
         * Get all videos
         */
        $videos = Video::all();

        /**
         * Dispatch job for fetching each video's stats'
         */
        foreach ($videos as $video) {
            \App\Jobs\GetVideoStats::dispatch($video);
        }
    }
}
