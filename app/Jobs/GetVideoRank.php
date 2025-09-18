<?php

namespace App\Jobs;

use App\Models\Video;
use App\Models\VideoRank;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GetVideoRank implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly Video $video
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /**
         * Fetch the videos rank
         */
        $response = \App\Actions\YouTube\Search\GetVideoRank::execute($this->video->shortcode, $this->video->keyword);

        /**
         * Create the video rank
         */
        VideoRank::create([
            'rank' => $response,
            'video_id' => $this->video->id,
        ]);
    }
}
