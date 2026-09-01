@extends('layouts.app')

@section('content')
    {{-- Hero --}}
    @php
        $taglineParts = array_map('trim', explode(',', $site['tagline'], 2));
        $lineOne = rtrim($taglineParts[0] ?? $site['tagline'], '.');
        $lineTwo = $taglineParts[1] ?? '';
    @endphp
    <section class="relative min-h-[100svh] overflow-hidden">
        <video autoplay loop muted playsinline preload="auto" poster="{{ $site['hero_image'] }}"
            class="absolute inset-0 h-full w-full object-cover object-center" aria-hidden>
            <source src="{{ $site['hero_video'] }}" type="video/mp4">
        </video>
        <div class="harmone-hero-shade absolute inset-0" aria-hidden></div>
        <div
            class="relative z-10 flex min-h-[100svh] flex-col items-center justify-center px-5 pb-24 pt-36 text-center md:px-10 md:pb-28 md:pt-40">
            <h1 class="harmone-hero-title">
                <span class="block">{{ $lineOne }}</span>
                @if ($lineTwo)
                    <span class="block">{{ $lineTwo }}</span>
                @endif
            </h1>
            <p class="mt-5 max-w-[560px] text-[15px] leading-relaxed text-white/92 md:text-base">
                {{ $home['hero_subtitle'] }}</p>
            <div class="harmone-hero-actions">
                <form class="harmone-email-form" data-hero-email>
                    <input type="email" placeholder="Enter email address" class="harmone-email-input"
                        aria-label="Email address">
                    <button type="submit" class="harmone-book-btn h-10 w-10 shrink-0 rounded-full p-0"
                        aria-label="Submit">→</button>
                </form>
                <a href="{{ route('services.index') }}" class="harmone-services-btn">View services</a>
            </div>
        </div>
    </section>

    {{-- Brand ticker --}}
    <div class="border-b border-black/5 bg-page py-8 md:py-10">
        <div class="harmone-marquee overflow-hidden opacity-70">
            <div class="harmone-marquee-track flex w-max items-center gap-8 md:gap-12">
                @foreach (array_merge($service_areas, $service_areas) as $area)
                    <span
                        class="whitespace-nowrap px-6 text-sm font-medium uppercase tracking-[0.14em] text-body md:text-base">{{ $area }}</span>
                @endforeach
            </div>
        </div>
    </div>

    {{-- About (Harmone template) --}}
    <section id="about" class="harmone-about-section section-shell">
        <div class="harmone-about-container section-inner">
            <div class="harmone-about-content">
                <div class="harmone-about-intro harmone-section-header harmone-section-header--center" data-reveal-group>
                    <div class="harmone-section-header__copy">
                        <div class="harmone-about-badge harmone-reveal" data-reveal="slide-left">
                            <img src="{{ $section_icon }}" alt="" width="24" height="24" aria-hidden>
                            <span>{{ $home['about_badge'] }}</span>
                        </div>
                        <h2 class="harmone-about-headline harmone-section-header__title">
                            @foreach (preg_split('/\s+/', trim($home['about_title'])) as $index => $word)
                                <span class="harmone-reveal-word"
                                    style="--word-index: {{ $index }}">{{ $word }} </span>
                            @endforeach
                        </h2>
                    </div>
                    <div class="harmone-about-trust harmone-reveal" data-reveal="scale-in">
                        <p class="harmone-about-trust-line">{{ $home['about_trust_line'] }}</p>
                    </div>
                </div>

                <div class="harmone-about-feature" data-reveal-group>
                    <div class="harmone-about-media harmone-reveal" data-reveal="slide-in">
                        <img src="{{ $about_feature_image }}" alt="Snow removal service in Spruce Grove, Alberta"
                            class="harmone-about-media__photo"
                            fetchpriority="high"
                            loading="lazy" decoding="async">
                        <img src="/assets/site/logo-header.png?v=group121" alt=""
                            class="harmone-about-media__logo" width="80" height="80" loading="lazy" decoding="async"
                            aria-hidden="true">
                    </div>
                    <div class="harmone-about-card-shell harmone-reveal" data-reveal="fade-up" data-reveal-delay="180">
                        <div class="harmone-about-card">
                            <div class="harmone-about-card-top">
                                <div class="harmone-about-card-author">
                                    <div class="harmone-about-card-author-text">
                                        <p class="harmone-about-card-name">{{ $site['name'] }}</p>
                                        <p class="harmone-about-card-role">{{ $site['address']['city'] }},
                                            {{ $site['address']['region'] }}</p>
                                    </div>
                                    <img src="/assets/site/logo-header.png?v=group121" alt="" width="50" height="50"
                                        class="harmone-about-card-logo site-logo site-logo--sm" loading="lazy" decoding="async">
                                </div>
                                <div class="harmone-about-card-body">
                                    <p class="harmone-about-card-label">{{ $home['promise_title'] }}</p>
                                    <p class="harmone-about-card-text">{{ $promise_text }}</p>
                                </div>
                            </div>
                            <div class="harmone-about-stat">
                                <p class="harmone-about-stat-num">{{ $home['about_stat'] }}</p>
                                <p class="harmone-about-stat-label">{{ $home['about_stat_label'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Services --}}
    <section id="services" class="section-shell bg-page harmone-services-section">
        <div class="section-inner leapfly-services-section">
            @include('partials.harmone-section-header', [
                'badge' => $home['services_badge'],
                'title' => $home['services_title'],
                'ctaHref' => '/contact',
                'ctaLabel' => $home['hero_cta'],
                'layout' => 'split',
            ])
            <div class="leapfly-services-list" data-service-cards>
                @foreach ($home_services as $service)
                    @if (! $service['coming_soon'])
                        @include('partials.leapfly-service-card', compact('service'))
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section id="why-us" class="section-shell bg-page harmone-why-section" data-reveal-group>
        <div class="section-inner grid min-w-0 items-center gap-12 lg:grid-cols-2 lg:gap-16">
            <div class="min-w-0">
                @include('partials.harmone-section-header', [
                    'badge' => $home['why_us_badge'],
                    'title' => $home['why_us_title'],
                ])
                <ul class="mt-0">
                    @foreach ($why_us as $index => $item)
                        <li
                            class="harmone-why-item flex gap-4 py-6 harmone-reveal {{ $index < count($why_us) - 1 ? 'border-b border-dashed border-black/10' : '' }}"
                            data-reveal="fade-up" data-reveal-delay="{{ $index * 80 }}">
                            <span
                                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full accent-dot text-sm font-medium"
                                aria-hidden>✓</span>
                            <div>
                                <h3 class="text-lg font-medium text-heading">{{ $item['title'] }}</h3>
                                <p class="mt-2 text-sm leading-relaxed text-body">{{ $item['text'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="relative min-w-0 max-w-full overflow-hidden rounded-[20px] aspect-[4/5] harmone-reveal" data-reveal="slide-in">
                <img src="{{ $site['why_us_image'] }}" alt="Professional lawn care services"
                    class="h-full w-full object-cover" loading="lazy">
            </div>
        </div>
    </section>

    {{-- Projects --}}
    <section id="projects" class="section-shell bg-page">
        <div class="section-inner">
            @include('partials.harmone-section-header', [
                'badge' => $home['projects_badge'],
                'title' => $home['projects_title'],
            ])
            <div class="grid gap-6 lg:grid-cols-3">
                @foreach ($projects as $project)
                    <div class="harmone-project-card">
                        <div class="relative aspect-[4/3] overflow-hidden rounded-[20px]">
                            <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}"
                                class="h-full w-full object-cover">
                        </div>
                        <h3 class="mt-5 text-xl font-medium text-heading">{{ $project['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-body">{{ $project['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Client Stories (LeapFly before/after) --}}
    @include('partials.leapfly-client-stories')

    {{-- Service areas --}}
    <section id="areas" class="section-shell bg-page">
        <div class="section-inner grid min-w-0 items-center gap-12 lg:grid-cols-2">
            <div class="min-w-0">
                @include('partials.harmone-section-header', [
                    'badge' => $home['areas_badge'],
                    'title' => $home['areas_title'],
                ])
                <ul class="grid gap-3 sm:grid-cols-2">
                    @foreach ($service_areas as $area)
                        <li
                            class="flex items-center gap-3 harmone-area-pill px-4 py-3 text-sm font-medium text-heading">
                            <span
                                class="inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full accent-dot text-xs"
                                aria-hidden>✓</span>
                            {{ $area }}
                        </li>
                    @endforeach
                </ul>
                <a href="/contact" class="harmone-btn-primary">{{ $home['areas_cta'] }}</a>
            </div>
            <div class="harmone-areas-map-shell">
                <div id="service-areas-map" class="harmone-areas-map" role="region"
                    aria-label="Map of service areas in Alberta"
                    data-areas='@json($service_area_coordinates ?? [])'></div>
            </div>
        </div>
    </section>

    {{-- FAQs --}}
    <section id="faqs" class="section-shell bg-page">
        <div class="section-inner">
            @include('partials.harmone-section-header', [
                'badge' => $home['faqs_badge'],
                'title' => $home['faqs_title'],
                'subtitle' => $home['faqs_subtitle'],
            ])
            <div class="space-y-3">
                @foreach ($home_faqs as $faq)
                    <details class="group harmone-faq-card px-5 py-4">
                        <summary class="cursor-pointer list-none font-medium marker:content-none md:text-lg">
                            <span class="flex items-start justify-between gap-4 text-heading">
                                <span>
                                    <span
                                        class="mb-1 block text-xs font-medium uppercase tracking-[0.12em] text-body">Question</span>
                                    {{ $faq['question'] }}
                                </span>
                                <span class="mt-0.5 shrink-0 text-[var(--link)] transition group-open:rotate-45">+</span>
                            </span>
                        </summary>
                        <p class="mt-3 max-w-3xl text-sm leading-relaxed text-body">{{ $faq['answer'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.harmone-home-blogs')
@endsection
