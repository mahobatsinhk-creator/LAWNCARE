<div class="harmone-project-card group h-full overflow-hidden p-0">
    <div class="relative aspect-[16/10] overflow-hidden">
        <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}"
            class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        @if ($service['coming_soon'])
            <span class="absolute left-4 top-4 rounded-full accent-dot px-3 py-1 text-xs font-medium">
                Coming soon
            </span>
        @endif
    </div>
    <div class="p-5">
        <h3 class="text-lg font-medium text-heading">{{ $service['title'] }}</h3>
        <p class="mt-2 text-sm leading-relaxed text-body">{{ $service['short'] }}</p>
        @if ($service['href'])
            <span class="harmone-btn-secondary mt-4 inline-flex text-sm">Learn more</span>
        @endif
    </div>
</div>
