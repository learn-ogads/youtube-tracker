<div>
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-white font-bold text-xl lg:text-2xl">All Videos</h3>

        <div class="bg-stone-800 p-2 rounded flex items-center gap-x-2">
            <div class="{{ $layout === 'grid' ? 'bg-stone-700' : 'bg-transparent' }} p-1 rounded cursor-pointer" wire:click="changeLayout('grid')">
                <x-lucide-grid class="text-white h-4 w-4" />
            </div>
            <div class="{{ $layout === 'table' ? 'bg-stone-700' : 'bg-transparent' }} p-1 rounded cursor-pointer" wire:click="changeLayout('table')">
                <x-lucide-table class="text-white h-4 w-4" />
            </div>
        </div>
    </div>
    @if($layout === 'grid')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($videos as $video)
                <livewire:video-card :video="$video" />
            @endforeach
        </div>
    @else
        <div class="w-full overflow-x-auto">
            <table class="w-full min-w-[500px]">
                <thead>
                <tr class="text-white">
                    <th class="text-left pb-3 pr-8 min-w-[200px]">Video</th>
                    <th class="text-left pb-3 pr-8">Status</th>
                    <th class="text-left pb-3 pr-8">Views</th>
                    <th class="text-left pb-3 pr-8">Likes</th>
                    <th class="text-left pb-3 pr-8">Favorites</th>
                    <th class="text-left pb-3 pr-8">Comments</th>
                    <th class="flex justify-end pb-3">
                        <x-lucide-eye class="w-4 h-4" />
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($videos as $video)
                    <livewire:video-row :video="$video" />
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
