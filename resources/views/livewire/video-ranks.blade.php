<div class="rounded bg-stone-800 shadow-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-stone-700">
        <h3 class="text-white font-semibold text-xl">Previous Ranks</h3>
    </div>

    <div class="px-4 w-full overflow-x-auto">
        <table class="w-full">
            <thead>
            <tr class="text-red-500 border-b border-stone-700">
                <th class="text-left py-2 px-2">Rank</th>
                <th class="text-left py-2 px-2">Keyword</th>
                <th class="text-left py-2 px-2">Location</th>
                <th class="text-right py-2 px-2">Fetched At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ranks as $rank)
                <tr class="text-white border-b border-stone-700 last-of-type:border-transparent">
                    <td class="text-left font-semibold py-2 px-2">{{ $rank->rank }}</td>
                    <td class="text-left font-semibold py-2 px-2">{{ $video->keyword }}</td>
                    <td class="text-left font-semibold py-2 px-2">United States</td>
                    <td class="text-right font-semibold py-2 px-2">{{ $rank->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
