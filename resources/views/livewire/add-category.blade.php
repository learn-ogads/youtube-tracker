<div>
    <div class="rounded bg-stone-800 shadow-lg overflow-hidden">
        <div class="px-3 py-4 border-b border-stone-700">
            <h3 class="text-white font-semibold">Add Category</h3>
        </div>
        <div class="px-3 py-4">
            <form wire:submit.prevent="save">
                <div class="flex items-center w-full">
                    <input type="text" wire:model="name" class="w-full bg-stone-900 rounded-l py-2 px-3 text-stone-400" placeholder="Enter a category name for videos..." minlength="2" maxlength="255">
                    <button type="submit" class="px-8 py-2 bg-red-500 hover:bg-red-700 transition-all duration-200 rounded-r font-semibold text-white cursor-pointer disabled:pointer-not-allowed disabled:opacity-60">
                        Save
                    </button>
                </div>
                @error('name')
                <p class="text-xs text-red-500 mt-2">
                    {{ $message }}
                </p>
                @enderror
            </form>
        </div>
    </div>
</div>
