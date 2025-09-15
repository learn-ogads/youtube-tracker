<?php

namespace App\Actions\YouTube\Videos;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class GetAllDetails
{
    /**
     * Retrieves a video resource and identifies several
     * resource parts that should be included in the API response
     * @throws RequestException
     * @throws ConnectionException
     */
    public static function execute(string $video_id): array
    {
        $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])
            ->get('https://www.googleapis.com/youtube/v3/videos', [
                'id' => $video_id,
                'key' => config('services.youtube.key'),
                'part' => 'snippet,contentDetails,statistics,status'
            ]);
        $response->throwIfServerError();
        $response->throwIfClientError();
        return $response->json();
    }
}
