@extends('layouts.app')

@section('title', 'About — ' . $site['name'])

@section('content')
    {{-- Hero --}}
    <section class="harmone-about-page-hero" data-about-hero>
        <div class="harmone-about-page-hero__bg-wrap" data-about-parallax>
            <img src="{{ $about_page['hero_image'] }}" alt="" class="harmone-about-page-hero__bg" aria-hidden>
        </div>
        <div class="harmone-about-page-hero__shade" aria-hidden></div>
        <div class="harmone-about-page-hero__inner">
            <h1 class="harmone-about-page-hero__title" data-word-reveal>{{ $about_page['hero_title'] }}</h1>
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

    {{-- Story --}}
    <section class="harmone-about-page-story" data-about-story>
        <div class="harmone-about-page-story__inner">
            <div class="harmone-about-page-story__media" data-about-story-media>
                <div class="harmone-about-page-story__media-frame" data-about-story-image>
                    <img src="{{ $about_page['story_image'] }}" alt="Property care team at work" loading="lazy">
                </div>
            </div>
            <div class="harmone-about-page-story__content" data-reveal-group>
                <div class="harmone-about-badge harmone-about-reveal" data-about-reveal="slide-left">
                    <img src="{{ $section_icon }}" alt="" width="24" height="24" aria-hidden>
                    <span>{{ $about_page['story_badge'] }}</span>
                </div>
                <h2 class="harmone-about-page-story__title" data-word-reveal>{{ $about_page['story_title'] }}</h2>
                <ol class="harmone-about-page-timeline">
                    @foreach ($about_timeline as $item)
                        <li class="harmone-about-page-timeline__item harmone-about-reveal" data-about-reveal="scale-in"
                            data-reveal-delay="{{ $loop->index * 100 }}">
                            <span class="harmone-about-page-timeline__icon" aria-hidden="true">
                                @switch($item['icon'] ?? 'founding')
                                    @case('growth')
                                        <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden>
                                            <path fill="currentColor"
                                                d="M16 11c1.7 0 3-1.3 3-3s-1.3-3-3-3c-.8 0-1.5.3-2 .8C13.5 5.3 12.8 5 12 5s-1.5.3-2 .8c-.5-.5-1.2-.8-2-.8-1.7 0-3 1.3-3 3s1.3 3 3 3h8zm-8 2H6c-1.7 0-3 1.3-3 3v1h7v-4zm10 0h-2v4h7v-1c0-1.7-1.3-3-3-3z" />
                                        </svg>
                                        @break

                                    @case('future')
                                        <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden>
                                            <path fill="currentColor"
                                                d="M12 2a10 10 0 1 0 10 10h-2a8 8 0 1 1-8-8V2zm1 4v5.6l4.3 2.5-.9 1.6L11 12.3V6h2z" />
                                        </svg>
                                        @break

                                    @default
                                        <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden>
                                            <path fill="currentColor"
                                                d="M12 22c4.4-3.1 7-6.8 7-11 0-3.9-3.1-7-7-7S5 7.1 5 11c0 4.2 2.6 7.9 7 11zm0-9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 7.5 12 7.5s2.5 1.1 2.5 2.5S13.4 12.5 12 12.5z" />
                                        </svg>
                                @endswitch
                            </span>
                            <div>
                                <h3 class="harmone-about-page-timeline__heading">{{ $item['title'] }}</h3>
                                <p class="harmone-about-page-timeline__text">{{ $item['text'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
                <a href="/contact#quote" class="harmone-book-btn mt-8 inline-flex harmone-about-reveal" data-about-reveal="fade-up">{{ $about_page['story_cta'] }}</a>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="harmone-about-page-stats" data-reveal-group>
        <div class="harmone-about-page-stats__inner">
            <div class="harmone-about-page-stats__header">
                <div>
                    <span class="harmone-about-page-stats__badge harmone-about-reveal" data-about-reveal="slide-left">{{ $about_page['stats_badge'] }}</span>
                    <h2 class="harmone-about-page-stats__title harmone-about-reveal" data-about-reveal="fade-up">{{ $about_page['stats_title'] }}</h2>
                </div>
                <a href="{{ $about_page['stats_cta_href'] }}" class="harmone-btn-primary harmone-about-reveal" data-about-reveal="fade-up" data-reveal-delay="120">{{ $about_page['stats_cta'] }}</a>
            </div>
            <div class="harmone-about-page-stats__grid">
                @foreach ($about_stats as $stat)
                    <article class="harmone-about-page-stat-card harmone-about-reveal" data-about-reveal="stat"
                        data-reveal-delay="{{ $loop->index * 120 }}">
                        <p class="harmone-about-page-stat-card__value">{{ $stat['value'] }}</p>
                        <p class="harmone-about-page-stat-card__label">{{ $stat['label'] }}</p>
                        <p class="harmone-about-page-stat-card__text">{{ $stat['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Founder --}}
    <section class="harmone-about-page-founder" data-reveal-group>
        <div class="harmone-about-page-founder__inner">
            <div class="harmone-about-badge harmone-about-reveal" data-about-reveal="slide-left">
                <img src="{{ $section_icon }}" alt="" width="24" height="24" aria-hidden>
                <span>{{ $about_page['founder_badge'] }}</span>
            </div>
            <blockquote class="harmone-about-page-founder__quote" data-word-reveal>{{ $about_page['founder_quote'] }}</blockquote>
            <div class="harmone-about-page-founder__author harmone-about-reveal" data-about-reveal="fade-up">
                <img src="{{ $about_page['founder_image'] }}" alt="" width="80" height="80" loading="lazy">
                <div>
                    <p class="harmone-about-page-founder__name">{{ $about_page['founder_name'] }}</p>
                    <p class="harmone-about-page-founder__role">{{ $about_page['founder_role'] }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="harmone-about-page-faq" data-reveal-group>
        <div class="harmone-about-page-faq__inner">
            <header class="harmone-about-page-faq__header">
                <div class="harmone-about-badge harmone-about-reveal" data-about-reveal="slide-left">
                    <img src="{{ $section_icon }}" alt="" width="24" height="24" aria-hidden>
                    <span>{{ $about_page['faq_badge'] }}</span>
                </div>
                <h2 class="harmone-about-page-faq__title harmone-about-reveal" data-about-reveal="fade-up">{{ $about_page['faq_title'] }}</h2>
            </header>

            <div class="harmone-about-page-faq__layout">
                <div class="harmone-about-page-faq__list">
                    @foreach ($about_faqs as $faq)
                        <details class="group harmone-faq-card px-5 py-4 harmone-about-reveal" data-about-reveal="scale-in"
                            data-reveal-delay="{{ $loop->index * 80 }}" @if ($loop->first) open @endif>
                            <summary class="cursor-pointer list-none font-medium marker:content-none md:text-lg">
                                <span class="flex items-start justify-between gap-4 text-heading">
                                    <span>{{ $faq['question'] }}</span>
                                    <span class="mt-0.5 shrink-0 text-[var(--link)] transition group-open:rotate-45">+</span>
                                </span>
                            </summary>
                            <p class="mt-3 text-sm leading-relaxed text-body">{{ $faq['answer'] }}</p>
                        </details>
                    @endforeach
                </div>

                <aside class="harmone-about-page-faq__cta harmone-about-reveal" data-about-reveal="fade-up" data-reveal-delay="160">
                    <h3 class="harmone-about-page-faq__cta-title">{{ $about_page['faq_cta_title'] }}</h3>
                    <p class="harmone-about-page-faq__cta-text">{{ $about_page['faq_cta_text'] }}</p>
                    <a href="/contact#quote" class="harmone-btn-secondary">{{ $about_page['faq_cta_button'] }}</a>
                </aside>
            </div>
        </div>
    </section>
@endsection
