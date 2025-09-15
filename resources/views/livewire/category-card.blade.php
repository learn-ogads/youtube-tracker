<a href="{{ route('categories.show', ['category' => $category]) }}" class="rounded bg-stone-800 shadow-lg overflow-hidden px-3 py-4 flex items-center justify-between hover:-translate-y-1 transition-all duration-200">
    <div class="flex items-center gap-x-2">
        <x-lucide-folder class="w-6 h-6 text-white" />
        <p class="text-white font-semibold">{{ $category->name }}</p>
    </div>

    <div class="text-red-500">
        {{ $category->videos()->count() }}
    </div>
</a>
