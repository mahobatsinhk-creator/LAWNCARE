@switch($icon)
    @case('snow')
        <svg viewBox="0 0 24 24" width="28" height="28" fill="none" aria-hidden="true">
            <path d="M12 3v18M8.5 6.5 12 3l3.5 3.5M8.5 17.5 12 21l3.5-3.5M4 12h16M6.5 8.5 3 12l3.5 3.5M17.5 8.5 21 12l-3.5 3.5"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    @break

    @case('junk')
        <svg viewBox="0 0 24 24" width="28" height="28" fill="none" aria-hidden="true">
            <path d="M4 7h16M9 7V5h6v2M8 7l1 12h6l1-12" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    @break

    @case('cleanup')
        <svg viewBox="0 0 24 24" width="28" height="28" fill="none" aria-hidden="true">
            <path d="M6 20h12M8 20V8l4-3 4 3v12M10 12h4" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    @break

    @default
        <svg viewBox="0 0 24 24" width="28" height="28" fill="none" aria-hidden="true">
            <path d="M12 21c4-3.5 6-6.8 6-10a6 6 0 1 0-12 0c0 3.2 2 6.5 6 10Z" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M12 11v.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        </svg>
@endswitch
