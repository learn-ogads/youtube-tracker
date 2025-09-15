<header class="sticky top-0 w-full bg-stone-800 py-4 px-4 shadow-lg z-50">
    <x-container>
        <a href="{{ route('home') }}" class="flex items-center gap-x-2 hover:opacity-60 transition-all duration-200">
            <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="" class="w-10 h-10">
            <span class="text-red-500 font-bold hidden lg:block">{{ config('app.name') }}</span>
        </a>
    </x-container>
</header>
