<tr>
    <td class="text-left pb-3">
        <span class="flex items-center gap-x-2 text-white font-semibold">
            <img src="{{ $video->thumbnail }}" alt="Video thumbnail" class="w-20 h-20 rounded object-cover">
            {{ $video->title }}
        </span>
    </td>
    <td class="pr-8 {{ $video->status === 'inactive' ? 'text-red-500' : 'text-emerald-500' }}">
        {{ $video->status }}
    </td>
    <td class="text-blue-400">
        {{ number_format($video->latestStatistics()->views) }}
    </td>
    <td class="text-emerald-500">
        {{ number_format($video->latestStatistics()->likes) }}
    </td>
    <td class="text-red-500">
        {{ number_format($video->latestStatistics()->favorites) }}
    </td>
    <td class="text-yellow-400">
        {{ number_format($video->latestStatistics()->comments) }}
    </td>
    <td class="text-yellow-400">
        @empty($video->mostRecentRank())
            Unable to find rank
        @else
            #{{ $video->mostRecentRank()->rank }} for {{ $video->keyword }}
        @endempty
    </td>
    <td>
        <a href="{{ route('videos.show', ['id' => $video->id]) }}" class="flex items-center justify-center text-white bg-red-500 py-2 rounded font-semibold hover:opacity-60 transition-all duration-200 min-w-[100px]">
            View More
        </a>
    </td>
</tr>
