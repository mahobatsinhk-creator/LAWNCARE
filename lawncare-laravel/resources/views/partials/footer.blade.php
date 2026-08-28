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
                        <a href="{{ $footerHref('/contact') }}">Get a quote</a>
                    </li>
                    <li>
                        <a href="https://maps.google.com/?q={{ urlencode('PO Box 3683, ' . $site['address']['city'] . ', AB ' . $site['address']['postal_code']) }}"
                            target="_blank" rel="noopener noreferrer">
                            PO Box 3683, {{ $site['address']['city'] }}, AB {{ $site['address']['postal_code'] }}
                        </a>
                    </li>
                </ul>

                <div class="harmone-footer-social" aria-label="Social links">
                    <a href="#" class="harmone-footer-social__link" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden>
                            <path fill="currentColor"
                                d="M14 8.5V7.2c0-.7.5-1.2 1.2-1.2H17V3h-2.2C12.7 3 11 4.8 11 7v1.5H9v3h2V21h3v-10.5h2.6L17 8.5h-3z" />
                        </svg>
                    </a>
                    <a href="#" class="harmone-footer-social__link" aria-label="X">
                        <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden>
                            <path fill="currentColor"
                                d="M17.5 3h3.1l-6.8 7.8L21.5 21h-6.2l-4.8-6.2L4.8 21H1.7l7.3-8.4L2.5 3h6.3l4.4 5.7L17.5 3zm-1.1 16.2h1.7L7.9 4.7H6.1l10.3 14.5z" />
                        </svg>
                    </a>
                    <a href="#" class="harmone-footer-social__link" aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden>
                            <path fill="currentColor"
                                d="M6.5 8.7H3.6V21h2.9V8.7zM5 3a1.8 1.8 0 1 0 0 3.6A1.8 1.8 0 0 0 5 3zm4.2 5.7H6.3V21h2.9v-6.1c0-1.6.3-3.1 2.2-3.1 1.9 0 1.9 1.8 1.9 3.2V21H16V14c0-3.1-.7-5.5-4.3-5.5-1.7 0-2.9.9-3.4 1.8h-.1V8.7z" />
                        </svg>
                    </a>
                    <a href="#" class="harmone-footer-social__link" aria-label="YouTube">
                        <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden>
                            <path fill="currentColor"
                                d="M21.6 7.2a2.7 2.7 0 0 0-1.9-1.9C17.8 4.8 12 4.8 12 4.8s-5.8 0-7.7.5A2.7 2.7 0 0 0 2.4 7.2 28 28 0 0 0 2 12a28 28 0 0 0 .4 4.8 2.7 2.7 0 0 0 1.9 1.9c1.9.5 7.7.5 7.7.5s5.8 0 7.7-.5a2.7 2.7 0 0 0 1.9-1.9A28 28 0 0 0 22 12a28 28 0 0 0-.4-4.8zM10 15.5v-7l6.2 3.5L10 15.5z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="harmone-footer-bottom">
            <p class="harmone-footer-bottom__copy">&copy; {{ date('Y') }} {{ $site['name'] }}. All rights reserved.</p>
        </div>
    </div>
</footer>
