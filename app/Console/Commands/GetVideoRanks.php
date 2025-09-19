<?php

namespace App\Console\Commands;

use App\Jobs\GetVideoRank;
use App\Models\Video;
use Illuminate\Console\Command;

class GetVideoRanks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-video-ranks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the ranks for all videos';

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
         * Dispatch job for fetching each video's rank
         */
        foreach ($videos as $video) {
            GetVideoRank::dispatch($video);
        }
    }
}
