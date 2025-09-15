<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $video = Video::findOrFail($id);

        $statistics = $video->statistics()
            ->latest()
            ->simplePaginate(30);

        $first_video_stats = $statistics->first();

        return view('videos.show', [
            'video' => $video,
            'first_video_statistics' => $first_video_stats,
            'statistics' => $statistics,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $video = Video::findOrFail($id);

        $video->delete();

        return redirect(route('home'))->with('flash.success', 'Removed the video successfully');
    }
}
