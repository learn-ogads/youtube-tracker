<?php

namespace App\Actions\YouTube\Search;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class SearchKeyword
{
    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public static function execute(string $keyword, ?string $page_token = null)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])
            ->get('https://www.googleapis.com/youtube/v3/search', [
                'key' => config('services.youtube.key'),
                'part' => 'snippet',
                'q' => $keyword,
                'pageToken' => $page_token,
                'regionCode' => 'US'
            ]);
        $response->throwIfServerError();
        $response->throwIfClientError();
        return $response->json();
    }
}
