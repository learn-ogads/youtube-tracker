<div class="rounded bg-stone-800 shadow-lg overflow-hidden">
    <div class="px-3 py-4 border-b border-stone-700">
        <h3 class="text-white font-semibold line-clamp-1">{{ $video->title }}</h3>
    </div>
    <div class="px-3 py-4">
        <img src="{{ $video->thumbnail }}" alt="Video thumbnail" class="rounded w-full" draggable="false">

        {{-- Video Status --}}
        @if($video->status === 'inactive')
            <p class="text-red-500 mt-3">
                Video Status: {{ $video->status }}
            </p>
        @else
            <p class="text-emerald-500 mt-3">
                Video Status: {{ $video->status }}
            </p>
        @endif

        <div class="flex flex-col gap-4 mt-3">
            <div class="text-white font-semibold flex items-center gap-x-2">
                <x-lucide-eye class="w-4 h-4 text-blue-400" />
                {{ number_format($video->latestStatistics()->views) }} views
            </div>
            <div class="text-white font-semibold flex items-center gap-x-2">
                <x-lucide-thumbs-up class="w-4 h-4 text-green-400" />
                {{ number_format($video->latestStatistics()->likes) }} likes
            </div>
            <div class="text-white font-semibold flex items-center gap-x-2">
                <x-lucide-heart class="w-4 h-4 text-red-400" />
                {{ number_format($video->latestStatistics()->favorites) }} favorites
            </div>
            <div class="text-white font-semibold flex items-center gap-x-2">
                <x-lucide-message-circle class="w-4 h-4 text-yellow-400" />
                {{ number_format($video->latestStatistics()->comments) }} comments
            </div>
            <div class="text-white font-semibold flex items-center gap-x-2">
                <x-lucide-line-chart class="w-4 h-4 text-yellow-400" />
                @if(!is_null($video->mostRecentRank()))
                    @if($video->mostRecentRank()->rank)
                        Rank #{{ $video->mostRecentRank()->rank }} for {{ $video->keyword }}
                    @else
                        Video is not ranked
                    @endif
                @else
                    Not tracking the rank for this video
                @endif
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('videos.show', ['id' => $video->id]) }}" class="flex items-center justify-center text-white bg-red-500 w-full py-2 rounded font-semibold hover:opacity-60 transition-all duration-200">
                View More
            </a>
        </div>
    </div>
</div>
