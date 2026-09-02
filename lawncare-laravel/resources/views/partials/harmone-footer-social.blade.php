@if (! empty($social_links))
    <style>
        .harmone-footer-social {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .harmone-footer-social__link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            overflow: hidden;
            border-radius: 9999px;
            background: #fff;
            color: #1a1a17;
            line-height: 0;
            text-decoration: none;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .harmone-footer-social__icon {
            display: block;
            width: 20px !important;
            height: 20px !important;
            max-width: 20px;
            max-height: 20px;
            flex-shrink: 0;
        }

        .harmone-footer-social__link:hover {
            transform: scale(1.05);
            opacity: 0.92;
        }
    </style>

    <div class="harmone-footer-social" aria-label="Social links">
        @foreach ($social_links as $social)
            <a href="{{ $social['href'] }}" class="harmone-footer-social__link"
                aria-label="{{ $social['label'] }}"
                @if (! empty($social['external'])) target="_blank" rel="noopener noreferrer" @endif>
                @switch($social['network'])
                    @case('facebook')
                        <svg class="harmone-footer-social__icon" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" width="20" height="20" aria-hidden="true">
                            <path fill="currentColor"
                                d="M13.5 8.5V6.8c0-.7.6-1.3 1.3-1.3h1.7V3h-2.4c-2.5 0-4.6 2.1-4.6 4.6v.9H7v2.7h2.5V21h3.2v-9.8h2.8l.5-2.7H12.5z" />
                        </svg>
                        @break

                    @case('instagram')
                        <svg class="harmone-footer-social__icon" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" width="20" height="20" aria-hidden="true">
                            <path fill="currentColor"
                                d="M7 3h10a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4zm10 2H7a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2zm-5 3.8A4.2 4.2 0 1 0 16.2 12 4.2 4.2 0 0 0 12 8.8zm0 2a2.2 2.2 0 1 1 0 4.4 2.2 2.2 0 0 1 0-4.4zm4.8-3.3a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                        @break

                    @case('google')
                        <svg class="harmone-footer-social__icon" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" width="20" height="20" aria-hidden="true">
                            <path fill="currentColor"
                                d="M12 2C8.1 2 5 5.1 5 9c0 5.2 7 13 7 13s7-7.8 7-13c0-3.9-3.1-7-7-7zm0 9.8a2.8 2.8 0 1 1 0-5.6 2.8 2.8 0 0 1 0 5.6z" />
                        </svg>
                        @break
                @endswitch
            </a>
        @endforeach
    </div>
@endif
