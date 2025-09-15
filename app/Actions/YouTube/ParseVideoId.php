<?php

namespace App\Actions\YouTube;

class ParseVideoId
{
    /**
     * Parse a YouTube video URL into its video ID.
     * @param string $url
     * @return string|null
     */
    public static function execute(string $url): ?string
    {
        $query_params = [];
        $parsed_url = parse_url($url);

        if (isset($parsed_url['query'])) {
            parse_str($parsed_url['query'], $query_params);
        }

        /**
         * Get the video ID from query parameters
         */
        if (isset($query_params['v'])) {
            return $query_params['v'];
        }

        /**
         * Handle short URLs (like youtu.be)
         */
        if (isset($parsed_url['path'])) {
            $path_parts = explode('/', trim($parsed_url['path'], '/'));
            if ($parsed_url['host'] === 'youtu.be' && count($path_parts) > 0) {
                return $path_parts[0];
            }
        }

        /**
         * Parse YouTube shorts
         */
        if (isset($parsed_url['path']) && str_contains($parsed_url['path'], '/shorts/')) {
            $split_path = explode('/shorts/', $parsed_url['path']);
            return $split_path[1];
        }

        return null;
    }
}
