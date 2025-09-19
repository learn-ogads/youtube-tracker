<?php

namespace App\Actions\YouTube\Search;

class GetVideoRank
{
    public static function execute(string $shortcode, string $keyword): ?int
    {
        /**
         * Keep track of the next page with the YouTube search API
         */
        $next_page_token = null;

        /**
         * Keep track of the video position
         */
        $video_position = 1;

        /**
         * Loop through up to 5 pages of videos
         */
        for ($i = 0; $i <= 5; $i++) {
            /**
             * Search the keyword
             */
            $response = SearchKeyword::execute($keyword, $next_page_token);

            /**
             * Update the next page
             */
            $next_page_token = $response['nextPageToken'];

            /**
             * Loop through all videos and attempt to find a match with the videoId and shortcode
             */
            foreach ($response['items'] as $video) {

                /**
                 * If the videoId matches the shortcode then we have our video rank
                 */
                if (array_key_exists('videoId', $video['id'])) {
                    if ($video['id']['videoId'] === $shortcode) {
                        return $video_position;
                    }
                }

                $video_position++;
            }
        }

        return null;
    }
}
