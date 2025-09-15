<x-layouts.app>
    <x-container class="pt-10">
        {{-- Go back button --}}
        <div class="mb-10 flex items-center justify-between">
            <a href="{{ route('home') }}" class="bg-red-500 px-8 py-2 rounded text-white hover:opacity-60 transition-all duration-200 ease-in-out font-semibold inline-block">
                <div class="flex items-center gap-x-2">
                    <x-lucide-arrow-left class="w-4 h-4" /> Go Back
                </div>
            </a>

            {{-- Delete Category --}}
            <form method="post" action="{{ route('categories.destroy', ['category' => $category]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 px-8 py-2 rounded text-white hover:opacity-60 transition-all duration-200 ease-in-out font-semibold inline-block cursor-pointer">
                    <div class="flex items-center gap-x-2">
                        <x-lucide-trash class="w-4 h-4" /> Delete
                    </div>
                </button>
            </form>
        </div>

        <div class="flex items-center gap-x-3 mb-10">
            <x-lucide-folder class="w-8 h-8 text-white" />
            <h3 class="text-white font-bold text-xl lg:text-2xl">
                {{ $category->name }}
            </h3>
        </div>
    </x-container>

    <x-container class="mt-10">
        <livewire:add-video :category="$category" />
    </x-container>

    <x-container class="mt-10">
        <livewire:all-videos :category="$category" />
    </x-container>
</x-layouts.app>
