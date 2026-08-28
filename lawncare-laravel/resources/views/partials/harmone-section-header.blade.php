@props([
    'badge',
    'title' => null,
    'subtitle' => null,
    'ctaHref' => null,
    'ctaLabel' => null,
    'ctaClass' => 'harmone-btn-secondary',
    'layout' => 'stack',
    'align' => 'left',
    'theme' => 'light',
])

<header @class([
    'harmone-section-header',
    'harmone-section-header--split' => $layout === 'split',
    'harmone-section-header--center' => $align === 'center',
    'harmone-section-header--dark' => $theme === 'dark',
])>
    <div class="harmone-section-header__copy">
        <div class="harmone-section-header__badge harmone-about-badge">
            <img src="{{ $section_icon }}" alt="" width="24" height="24" aria-hidden>
            <span>{{ $badge }}</span>
        </div>
        @if ($title)
            <h2 class="harmone-section-header__title harmone-about-headline">{{ $title }}</h2>
        @endif
        @if ($subtitle)
            <p class="harmone-section-header__subtitle">{{ $subtitle }}</p>
        @endif
    </div>
    @if ($ctaHref && $ctaLabel)
        <a href="{{ $ctaHref }}" @class([$ctaClass, 'harmone-section-header__cta'])>{{ $ctaLabel }}</a>
    @endif
    {{ $slot ?? '' }}
</header>
