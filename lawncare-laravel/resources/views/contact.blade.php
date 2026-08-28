@extends('layouts.app')

@section('title', 'Contact — ' . $site['name'])

@section('content')
    <section class="harmone-contact-hero" data-reveal-group>
        <div class="harmone-contact-hero__band">
            <div class="harmone-contact-hero__inner">
                <div class="harmone-contact-hero__stack">
                    <div class="harmone-contact-hero__intro">
                        <div class="harmone-contact-hero__badge harmone-reveal" data-reveal="slide-left">
                            <img src="{{ $contact_badge_icon }}" alt="" width="24" height="24" aria-hidden>
                            <span>{{ $contact['hero_badge'] }}</span>
                        </div>
                        <h1 class="harmone-contact-hero__title">
                            @foreach (preg_split('/\s+/', trim($contact['hero_title'])) as $index => $word)
                                <span class="harmone-reveal-word" style="--word-index: {{ $index }}">{{ $word }} </span>
                            @endforeach
                        </h1>
                    </div>

                    <div class="harmone-contact-cards">
                        @foreach ($contact['cards'] as $card)
                            <article
                                class="harmone-contact-card"
                                data-contact-reveal="{{ $loop->first ? 'from-right' : 'from-left' }}"
                                style="--contact-reveal-index: {{ $loop->index }}"
                            >
                                <div class="harmone-contact-card__head">
                                    <div class="harmone-contact-card__icon">
                                        <img src="{{ $card['icon'] }}" alt="" width="45" height="45" aria-hidden>
                                    </div>
                                    <div class="harmone-contact-card__intro">
                                        <h2 class="harmone-contact-card__title">{{ $card['title'] }}</h2>
                                        <p class="harmone-contact-card__text">{{ $card['text'] }}</p>
                                    </div>
                                </div>
                                <div class="harmone-contact-card__contacts">
                                    @foreach ($card['items'] as $item)
                                        <div class="harmone-contact-card__item">
                                            <p class="harmone-contact-card__label">{{ $item['label'] }}:</p>
                                            <p class="harmone-contact-card__value">
                                                <a href="{{ $item['href'] }}"
                                                    @if (str_starts_with($item['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif>{{ $item['value'] }}</a>
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="harmone-contact-hero__art" aria-hidden>
                <img src="{{ $contact['hero_image'] }}" alt="">
            </div>
        </div>
    </section>

    <section id="quote" class="harmone-contact-form-section" data-reveal-group>
        <div class="harmone-contact-form-section__inner">
            <div class="harmone-contact-form-section__image harmone-reveal" data-reveal="slide-in">
                <img src="{{ $contact['form_image'] }}" alt="Seasonal lawn care and property maintenance">
            </div>
            <div class="harmone-contact-form-section__content harmone-reveal" data-reveal="fade-up"
                data-reveal-delay="120">
                <h2 class="harmone-contact-form-section__title">{{ $contact['form_title'] }}</h2>
                <p class="harmone-contact-form-section__text">{{ $contact['form_text'] }}</p>
                <div class="harmone-contact-form-wrap">
                    @include('partials.harmone-contact-form')
                </div>
            </div>
        </div>
    </section>

    <section class="harmone-contact-faq section-shell bg-page" data-reveal-group>
        <div class="section-inner">
            <header class="harmone-contact-faq__header">
                <div class="harmone-about-badge harmone-reveal" data-reveal="slide-left">
                    <img src="{{ $section_icon }}" alt="" width="24" height="24" aria-hidden>
                    <span>{{ $contact['faq_badge'] }}</span>
                </div>
                <h2 class="harmone-contact-faq__title harmone-reveal" data-reveal="fade-up">{{ $contact['faq_title'] }}</h2>
            </header>
            <div class="harmone-contact-faq__list">
                @foreach ($home_faqs as $faq)
                    <details class="group harmone-faq-card px-5 py-4 harmone-reveal" data-reveal="fade-up"
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
        </div>
    </section>
@endsection
