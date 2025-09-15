@props(['message' => ''])

<div
    x-cloak
    x-data="{show: false}"
    x-init="setTimeout(() => { show = true }, 200);setTimeout(() => { show = false }, 4000)"
    class="fixed z-[1000] flex items-center w-full max-w-xs p-4 bg-white rounded-lg shadow top-5 right-5 transition-all duration-700"
    :class="{'translate-x-[150%]': !show, 'translate-x-0': show}"
    role="alert"
>
    <div
        class="inline-flex items-center justify-center rounded-lg text-emerald-500"
    >
        <x-lucide-check class="w-5 h-5" />
    </div>
    <div class="ml-3 text-sm font-normal text-[#2F3136]">{{ $message }}</div>
    <button
        type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8"
        x-on:click="show = false"
        aria-label="Close"
    >
        <x-lucide-x class="w-3 h-3" />
    </button>
</div>
