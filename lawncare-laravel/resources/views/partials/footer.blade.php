@php
    $footerHref = function (string $href): string {
        if (str_starts_with($href, '#') && ! request()->is('/')) {
            return '/' . $href;
        }

        return $href;
    };
@endphp

<section class="harmone-footer-cta">
    <img src="{{ $footer['cta_bg_primary'] }}" alt="" class="harmone-footer-cta__bg harmone-footer-cta__bg--primary"
        aria-hidden>
    <img src="{{ $footer['cta_bg_secondary'] }}" alt=""
        class="harmone-footer-cta__bg harmone-footer-cta__bg--secondary" aria-hidden>
    <div class="harmone-footer-cta__grain" aria-hidden></div>
    <div class="harmone-footer-cta__shade" aria-hidden></div>
    <div class="harmone-footer-cta__inner">
        <div class="harmone-footer-cta__badge">
            <img src="{{ $badge_icon }}" alt="" width="18" height="18" aria-hidden>
            <span>{{ $footer['cta_badge'] }}</span>
        </div>
        <h2 class="harmone-footer-cta__title">{{ $footer['cta_title'] }}</h2>
        <a href="{{ $footer['cta_href'] }}" class="harmone-footer-cta__btn">{{ $footer['cta_button'] }}</a>
    </div>
</section>

<footer class="harmone-site-footer">
    <div class="harmone-footer-main">
        <div class="harmone-footer-main__inner">
            <div class="harmone-footer-brand">
                <a href="/" class="harmone-footer-brand__link" aria-label="{{ $site['name'] }}">
                    <img src="{{ $site['logo'] }}" alt="" class="harmone-footer-brand__logo" width="72" height="72"
                        loading="lazy">
                </a>
                <p class="harmone-footer-brand__text">{{ $site['description'] }}</p>

                <div class="harmone-footer-newsletter">
                    <label class="harmone-footer-newsletter__label"
                        for="footer-newsletter-email">{{ $footer['newsletter_label'] }}</label>
                    <form data-footer-email class="harmone-footer-email-form" novalidate>
                        <input id="footer-newsletter-email" type="email" class="harmone-footer-input"
                            placeholder="{{ $footer['newsletter_placeholder'] }}" aria-label="Email address">
                        <button type="submit" class="harmone-footer-email-btn" aria-label="Subscribe">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden>
                                <path d="M4 12 12 4M12 4H5M12 4v7" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="harmone-footer-nav-col harmone-footer-services">
                <h4 class="harmone-footer-nav__title">{{ $footer['services_label'] }}</h4>
                <ul class="harmone-footer-nav__list">
                    @foreach ($service_links as $link)
                        <li>
                            <a href="{{ $link['href'] }}">{{ $link['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="harmone-footer-nav-col harmone-footer-contact">
                <h4 class="harmone-footer-nav__title">{{ $footer['contact_label'] }}</h4>
                <ul class="harmone-footer-nav__list">
                    <li>
                        <a href="{{ $site['phone_href'] }}">{{ $site['phone'] }}</a>
                    </li>
                    <li>
                        <a href="mailto:{{ $site['email'] }}">{{ $site['email'] }}</a>
                    </li>
                    <li>
                        <a href="/get-quote">Get a quote</a>
                    </li>
                    <li>
                        <a href="https://maps.google.com/?q={{ urlencode('PO Box 3683, ' . $site['address']['city'] . ', AB ' . $site['address']['postal_code']) }}"
                            target="_blank" rel="noopener noreferrer">
                            PO Box 3683, {{ $site['address']['city'] }}, AB {{ $site['address']['postal_code'] }}
                        </a>
                    </li>
                </ul>

                <div class="harmone-footer-social" aria-label="Social links">
                    @foreach ($social_links as $social)
                        <a href="{{ $social['href'] }}" class="harmone-footer-social__link"
                            aria-label="{{ $social['label'] }}"
                            @if (! empty($social['external'])) target="_blank" rel="noopener noreferrer" @endif>
                            @switch($social['network'])
                                @case('facebook')
                                    <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden>
                                        <path fill="currentColor"
                                            d="M14 8.5V7.2c0-.7.5-1.2 1.2-1.2H17V3h-2.2C12.7 3 11 4.8 11 7v1.5H9v3h2V21h3v-10.5h2.6L17 8.5h-3z" />
                                    </svg>
                                    @break

                                @case('instagram')
                                    <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden>
                                        <path fill="currentColor"
                                            d="M7 3h10a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4zm5 4.8A4.2 4.2 0 1 0 16.2 12 4.2 4.2 0 0 0 12 7.8zm0 1.8a2.4 2.4 0 1 1-2.4 2.4A2.4 2.4 0 0 1 12 9.6zm4.65-2.45a1 1 0 1 0-1 1 1 1 0 0 0 1-1z" />
                                    </svg>
                                    @break

                                @case('google')
                                    <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden>
                                        <path fill="currentColor"
                                            d="M12 3a9 9 0 0 0-6.36 15.36l1.2-1.2A7 7 0 1 1 17 10.5h-7v2.5h9.1A9 9 0 0 0 12 3z" />
                                    </svg>
                                    @break
                            @endswitch
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="harmone-footer-bottom">
            <p class="harmone-footer-bottom__copy">&copy; {{ date('Y') }} {{ $site['name'] }}. All rights reserved.</p>
        </div>
    </div>
</footer>
