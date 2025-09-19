<x-layouts.app>
    <x-container class="pb-20 pt-10">
        {{-- Go back button --}}
        <div class="mb-10 flex items-center justify-between">
            <a href="{{ url()->previous() }}" class="bg-red-500 px-8 py-2 rounded text-white hover:opacity-60 transition-all duration-200 ease-in-out font-semibold inline-block">
                <div class="flex items-center gap-x-2">
                    <x-lucide-arrow-left class="w-4 h-4" /> Go Back
                </div>
            </a>

            <form method="post" action="{{ route('videos.destroy', ['id' => $video->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 px-8 py-2 rounded text-white hover:opacity-60 transition-all duration-200 ease-in-out font-semibold inline-block cursor-pointer">
                    <div class="flex items-center gap-x-2">
                        <x-lucide-trash class="w-4 h-4" /> Delete
                    </div>
                </button>
            </form>
        </div>

        {{-- Latest Statistics --}}
        <h3 class="text-white font-semibold text-xl mb-3">Latest Statistics</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-10">
            <div class="rounded bg-stone-800 shadow-lg overflow-hidden text-center p-4">
                <div class="text-white font-semibold flex items-center justify-center gap-x-2 mb-1">
                    <x-lucide-eye class="w-5 h-5 text-blue-400" />
                </div>
                <div class="text-white text-lg font-bold">{{ number_format($first_video_statistics->views) }}</div>
                <div class="text-stone-300 text-sm">Views</div>
            </div>

            <div class="rounded bg-stone-800 shadow-lg overflow-hidden text-center p-4">
                <div class="text-white font-semibold flex items-center justify-center gap-x-2 mb-1">
                    <x-lucide-thumbs-up class="w-5 h-5 text-emerald-400" />
                </div>
                <div class="text-white text-lg font-bold">{{ number_format($first_video_statistics->likes) }}</div>
                <div class="text-stone-300 text-sm">Likes</div>
            </div>

            <div class="rounded bg-stone-800 shadow-lg overflow-hidden text-center p-4">
                <div class="text-white font-semibold flex items-center justify-center gap-x-2 mb-1">
                    <x-lucide-heart class="w-5 h-5 text-red-400" />
                </div>
                <div class="text-white text-lg font-bold">{{ number_format($first_video_statistics->favorites) }}</div>
                <div class="text-stone-300 text-sm">Favorites</div>
            </div>

            <div class="rounded bg-stone-800 shadow-lg overflow-hidden text-center p-4">
                <div class="text-white font-semibold flex items-center justify-center gap-x-2 mb-1">
                    <x-lucide-message-circle class="w-5 h-5 text-yellow-400" />
                </div>
                <div class="text-white text-lg font-bold">{{ number_format($first_video_statistics->comments) }}</div>
                <div class="text-stone-300 text-sm">Comments</div>
            </div>

            <div class="rounded bg-stone-800 shadow-lg overflow-hidden text-center p-4 col-span-2">
                <div class="text-white font-semibold flex items-center justify-center gap-x-2 mb-1">
                    <x-lucide-line-chart class="w-5 h-5 text-yellow-400" />
                </div>
                @empty($video->mostRecentRank())
                    No rank found
                @else
                    @empty($video->mostRecentRank()->rank)
                        <div class="text-white text-lg font-bold">
                            Video is not ranked
                        </div>
                    @else
                        <div class="text-white text-lg font-bold">{{ $video->mostRecentRank()->rank }}</div>
                    @endempty
                @endempty
                <div class="text-stone-300 text-sm">Current Rank</div>
            </div>
        </div>

        {{-- Video Title & Latest Statistics --}}
        <div class="rounded bg-stone-800 shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-stone-700">
                <h3 class="text-white font-semibold text-xl">{{ $video->title }}</h3>
            </div>
            <div class="p-6">
                <!-- Video Thumbnail -->
                <div class="mb-6">
                    <img src="{{ $video->thumbnail }}" alt="Video thumbnail" class="rounded w-full max-w-2xl mx-auto" draggable="false">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <livewire:video-chart :video="$video" />
            <livewire:video-ranks-chart :video="$video" />
        </div>

        <div class="mt-10">
            <livewire:video-ranks :video="$video" />
        </div>

        <div class="rounded bg-stone-800 shadow-lg overflow-hidden mt-10">
            <div class="px-6 py-4 border-b border-stone-700">
                <h3 class="text-white font-semibold text-xl">Recent Stats</h3>
            </div>

            <div class="px-4 w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                    <tr class="text-red-500 border-b border-stone-700">
                        <th class="text-left py-2 px-2">Views</th>
                        <th class="text-left py-2 px-2">Likes</th>
                        <th class="text-left py-2 px-2">Favorites</th>
                        <th class="text-left py-2 px-2">Comments</th>
                        <th class="text-right py-2 px-2">Fetched At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($statistics as $stats)
                        <tr class="text-white border-b border-stone-700 last-of-type:border-transparent">
                            <td class="font-semibold py-2 px-2 text-left">{{ number_format($stats->views) }}</td>
                            <td class="font-semibold py-2 px-2 text-left">{{ number_format($stats->likes) }}</td>
                            <td class="font-semibold py-2 px-2 text-left">{{ number_format($stats->favorites) }}</td>
                            <td class="font-semibold py-2 px-2 text-left">{{ number_format($stats->comments) }}</td>
                            <td class="font-semibold py-2 px-2 text-right">{{ $stats->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @if($statistics->hasPages())
                <div class="px-4 py-4">
                    {{ $statistics->links() }}
                </div>
            @endif
        </div>
    </x-container>
</x-layouts.app>
