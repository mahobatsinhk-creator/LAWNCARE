<section id="client-stories" class="leapfly-client-stories">
    <div class="leapfly-client-stories__inner">
        @include('partials.harmone-section-header', [
            'badge' => $home['client_stories_badge'],
            'title' => $home['client_stories_title'],
            'align' => 'center',
            'theme' => 'dark',
        ])

        <div class="leapfly-client-stories__list">
            @foreach ($client_stories as $index => $story)
                <div class="leapfly-story-card-wrap" style="--stack-index: {{ $index + 1 }}">
                    <article class="leapfly-story-card">
                        <div class="leapfly-story-card__compare" data-image-compare>
                            <div class="leapfly-compare" role="slider" tabindex="0" aria-valuemin="0"
                                aria-valuemax="100" aria-valuenow="50" aria-label="Image comparison slider">
                                <div class="leapfly-compare__track" data-compare-track>
                                    <div class="leapfly-compare__before"
                                        style="background-image: url('{{ $story['before'] }}')" aria-hidden="true">
                                    </div>
                                    <div class="leapfly-compare__after" data-compare-after
                                        style="background-image: url('{{ $story['after'] }}')" aria-hidden="true">
                                    </div>
                                    <div class="leapfly-compare__line" data-compare-line aria-hidden="true"></div>
                                    <div class="leapfly-compare__handle" data-compare-handle aria-hidden="true">
                                        <svg viewBox="0 0 32 24" width="24" height="24" fill="none"
                                            stroke="rgba(0, 0, 0, 0.8)" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round" aria-hidden="true">
                                            <polyline points="11,6 6,12 11,18" />
                                            <polyline points="21,6 26,12 21,18" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="leapfly-story-card__content">
                            <svg class="leapfly-story-card__quote-icon" viewBox="0 0 24 24" role="presentation"
                                aria-hidden="true">
                                <path
                                    d="M 7.125 7.5 L 0.75 7.5 C 0.336 7.5 0 7.164 0 6.75 L 0 0.75 C 0 0.336 0.336 0 0.75 0 L 6.375 0 C 6.789 0 7.125 0.336 7.125 0.75 Z"
                                    transform="translate(3 6)" />
                                <path
                                    d="M 7.125 7.5 L 0.75 7.5 C 0.336 7.5 0 7.164 0 6.75 L 0 0.75 C 0 0.336 0.336 0 0.75 0 L 6.375 0 C 6.789 0 7.125 0.336 7.125 0.75 Z"
                                    transform="translate(13.875 6)" />
                                <path
                                    d="M 7.125 7.5 L 0.75 7.5 C 0.336 7.5 0 7.164 0 6.75 L 0 0.75 C 0 0.336 0.336 0 0.75 0 L 6.375 0 C 6.789 0 7.125 0.336 7.125 0.75 L 7.125 9 C 7.125 11.071 5.446 12.75 3.375 12.75"
                                    fill="transparent" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" transform="translate(3 6)" />
                                <path
                                    d="M 7.125 7.5 L 0.75 7.5 C 0.336 7.5 0 7.164 0 6.75 L 0 0.75 C 0 0.336 0.336 0 0.75 0 L 6.375 0 C 6.789 0 7.125 0.336 7.125 0.75 L 7.125 9 C 7.125 11.071 5.446 12.75 3.375 12.75"
                                    fill="transparent" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" transform="translate(13.875 6)" />
                            </svg>

                            <blockquote class="leapfly-story-card__quote">{{ $story['quote'] }}</blockquote>
                            <p class="leapfly-story-card__author">- {{ $story['name'] }}</p>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
