<?php

namespace App\Livewire;

use App\Actions\YouTube\ParseVideoId;
use App\Actions\YouTube\Search\GetVideoRank;
use App\Actions\YouTube\Videos\GetAllDetails;
use App\Models\Category;
use App\Models\Video;
use App\Models\VideoRank;
use App\Models\VideoStatistic;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Redirect;

class AddVideo extends Component
{
    #[Validate(['required', 'string', 'url', 'active_url'])]
    public string $url = '';

    #[Validate(['nullable', 'string', 'min:2', 'max:255'])]
    public string $keyword = '';

    public Category $category;

    public function save()
    {
        $this->validate();

        /**
         * Get the video ID
         */
        $video_id = ParseVideoId::execute($this->url);

        /**
         * If the ID is null, throw an error
         */
        if (is_null($video_id)) {
            $this->addError('url', 'Failed to parse the ID for the YouTube URL');
            return;
        }

        /**
         * Fetch the video details
         */
        $response = GetAllDetails::execute($video_id);

        if (empty($response['items'])) {
            $this->addError('url', 'Failed to fetch the video details. Is the video active?');
            return;
        }

        /**
         * Narrow down to the video details
         */
        $details = $response['items'][0];

        /**
         * If a keyword was provided, fetch the current rank for the video
         */
        $video_rank = null;
        if (!empty($this->keyword)) {
            $video_rank = GetVideoRank::execute($video_id, $this->keyword);
        }

        /**
         * Create the video
         */
        $video = Video::create([
            'thumbnail' => $details['snippet']['thumbnails']['high']['url'],
            'title' => $details['snippet']['title'],
            'url' => $this->url,
            'shortcode' => $video_id,
            'status' => $details['status']['uploadStatus'],
            'keyword' => $this->keyword,
            'category_id' => $this->category->id,
        ]);

        /**
         * Create the video statistics
         */
        VideoStatistic::create([
            'video_id' => $video->id,
            'views' => $details['statistics']['viewCount'] ?? 0,
            'likes' => $details['statistics']['likeCount'] ?? 0,
            'favorites' => $details['statistics']['favoriteCount'] ?? 0,
            'comments' => $details['statistics']['commentCount'] ?? 0,
        ]);

        /**
         * If we have a video rank, create it
         */
        if (!is_null($video_rank)) {
            VideoRank::create([
                'video_id' => $video->id,
                'rank' => $video_rank,
            ]);
        }

        return Redirect::route('categories.show', ['category' => $this->category])->with('flash.success', 'Added a video to track successfully');
    }

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.add-video');
    }
}
