@php
    $taglineParts = array_map('trim', explode(',', $site['tagline'], 2));
    $taglineLineOne = rtrim($taglineParts[0] ?? $site['tagline'], '.');
    $taglineLineTwo = $taglineParts[1] ?? '';
@endphp

<header id="site-header" class="site-header"
    data-header-solid="{{ request()->is('/') ? 'false' : 'true' }}">
    <div class="site-header__grain" aria-hidden></div>
    <div id="header-inner" class="site-header__inner">
        <a href="/" class="header-logo-link shrink-0" aria-label="{{ $site['name'] }}">
            <img id="header-logo" src="/assets/site/logo-header.png?v=group121" alt="{{ $site['name'] }} logo"
                class="header-logo site-logo transition-all duration-300">
        </a>

        <nav class="site-header__nav" aria-label="Primary">
            @foreach ($nav_links as $link)
                <a href="{{ $link['href'] }}" class="header-nav-link">{{ $link['label'] }}</a>

                @if ($link['href'] === '/')
                    <div id="services-dropdown" class="services-dropdown relative inline-flex items-center">
                        <span class="services-dropdown__trigger inline-flex items-center">
                            <a href="{{ route('services.index') }}" class="header-nav-link">Services</a>
                            <svg class="services-dropdown__chevron" width="16" height="16" viewBox="0 0 14 14" aria-hidden>
                                <path d="M3 5.5 7 9.5 11 5.5" fill="transparent" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <div id="services-menu"
                            class="services-dropdown__menu absolute left-1/2 top-full min-w-[260px] -translate-x-1/2 rounded-2xl border border-black/8 bg-white p-2 shadow-xl">
                            @foreach ($service_links as $serviceLink)
                                <a href="{{ $serviceLink['href'] }}"
                                    class="block rounded-xl px-4 py-2.5 text-sm text-[var(--color-text-dark)] transition hover:bg-[var(--color-bg-snow)] hover:text-[var(--link)]">{{ $serviceLink['label'] }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </nav>

        <div class="site-header__actions">
            <a href="{{ $site['phone_href'] }}" class="header-nav-link header-phone-link hidden md:inline-flex">
                <span class="header-phone-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden>
                        <path
                            d="M6.6 10.8c1.6 3.1 3.5 5 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z" />
                    </svg>
                </span>
                {{ $site['phone'] }}
            </a>
            <a href="{{ $site['quote_url'] }}" id="header-book-btn" class="harmone-book-btn">{{ $site['quote_label'] }}</a>
            <button type="button" id="header-menu-btn" class="header-menu-btn" aria-expanded="false"
                aria-controls="header-mobile-nav" aria-label="Open menu">
                <svg class="header-menu-btn__icon" data-icon-menu width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden>
                    <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
        </div>
    </div>

    <div id="header-mobile-backdrop" class="site-header__backdrop" hidden aria-hidden="true"></div>

    <nav id="header-mobile-nav" class="site-header__mobile" aria-label="Mobile" hidden>
        <div class="site-header__mobile-panel">
            <ul class="site-header__mobile-list">
                @foreach ($nav_links as $link)
                    <li>
                        <a href="{{ $link['href'] }}" class="site-header__mobile-link">{{ $link['label'] }}</a>
                    </li>

                    @if ($link['href'] === '/')
                        <li class="site-header__mobile-item site-header__mobile-item--services">
                            <button type="button" id="mobile-services-toggle"
                                class="site-header__mobile-link site-header__mobile-toggle" aria-expanded="false"
                                aria-controls="mobile-services-submenu">
                                <span>Services</span>
                                <svg class="site-header__mobile-chevron" width="16" height="16" viewBox="0 0 14 14" aria-hidden>
                                    <path d="M3 5.5 7 9.5 11 5.5" fill="transparent" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <ul id="mobile-services-submenu" class="site-header__mobile-sublist" hidden>
                                @foreach ($service_links as $serviceLink)
                                    <li>
                                        <a href="{{ $serviceLink['href'] }}"
                                            class="site-header__mobile-link site-header__mobile-link--service">{{ $serviceLink['label'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>

            <div class="site-header__mobile-footer">
                <a href="{{ $site['phone_href'] }}" class="site-header__mobile-phone">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden>
                        <path
                            d="M6.6 10.8c1.6 3.1 3.5 5 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z" />
                    </svg>
                    {{ $site['phone'] }}
                </a>
                <a href="{{ $site['quote_url'] }}" class="harmone-book-btn site-header__mobile-cta">{{ $site['quote_label'] }}</a>
            </div>
        </div>
    </nav>
</header>
