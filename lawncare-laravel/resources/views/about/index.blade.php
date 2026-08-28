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
                            <span class="harmone-about-page-timeline__year">({{ $item['year'] }})</span>
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

    {{-- Team --}}
    <section class="harmone-about-page-team" data-reveal-group>
        <div class="harmone-about-page-team__inner">
            <header class="harmone-about-page-team__header">
                <div class="harmone-about-badge harmone-about-reveal" data-about-reveal="slide-left">
                    <img src="{{ $section_icon }}" alt="" width="24" height="24" aria-hidden>
                    <span>{{ $about_page['team_badge'] }}</span>
                </div>
                <h2 class="harmone-about-page-team__title harmone-about-reveal" data-about-reveal="fade-up">{{ $about_page['team_title'] }}</h2>
            </header>
            <div class="harmone-about-page-team__grid">
                @foreach ($about_team as $member)
                    <article class="harmone-about-page-team-card harmone-about-reveal" data-about-reveal="team"
                        data-reveal-delay="{{ $loop->index * 140 }}">
                        <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" loading="lazy">
                        <div class="harmone-about-page-team-card__body">
                            <h3 class="harmone-about-page-team-card__name">{{ $member['name'] }}</h3>
                            <p class="harmone-about-page-team-card__role">{{ $member['role'] }}</p>
                        </div>
                    </article>
                @endforeach
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
