<div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($categories as $category)
            <livewire:category-card :category="$category" />
        @endforeach
    </div>
</div>
