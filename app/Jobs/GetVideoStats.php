<?php

namespace App\Jobs;

use App\Actions\YouTube\Videos\GetAllDetails;
use App\Models\Video;
use App\Models\VideoStatistic;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GetVideoStats implements ShouldQueue
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
         * Fetch the video details
         */
        $response = GetAllDetails::execute($this->video->shortcode);

        /**
         * If the video is removed or something went wrong, set the status to inactive
         */
        if (empty($response['items'])) {

            /**
             * Set the status to inactive
             */
            $this->video->status = 'inactive';
            $this->video->save();

            return;
        }

        /**
         * Set the video status
         */
        $this->video->status = $response['items'][0]['status']['uploadStatus'];
        $this->video->save();

        /**
         * Narrow down to the video statistics
         */
        $statistics = $response['items'][0]['statistics'];

        /**
         * Create the video statistics
         */
        VideoStatistic::create([
            'video_id' => $this->video->id,
            'views' => $statistics['viewCount'] ?? 0,
            'likes' => $statistics['likeCount'] ?? 0,
            'favorites' => $statistics['favoriteCount'] ?? 0,
            'comments' => $statistics['commentCount'] ?? 0,
        ]);
    }
}
