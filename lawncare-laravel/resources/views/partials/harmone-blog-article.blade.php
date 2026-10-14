@php
    $tocItems = [];
    foreach ($post['sections'] ?? [] as $section) {
        if (($section['type'] ?? '') === 'heading' && ! empty($section['text'])) {
            $tocItems[] = [
                'id' => \Illuminate\Support\Str::slug($section['text']),
                'text' => $section['text'],
            ];
        }
    }
@endphp

@if (! empty($post['show_toc']) && count($tocItems) > 2)
    <nav class="harmone-blog-detail__toc harmone-reveal" data-reveal="fade-up" aria-label="Table of contents">
        <p class="harmone-blog-detail__toc-title">In this article</p>
        <ol class="harmone-blog-detail__toc-list">
            @foreach ($tocItems as $item)
                <li><a href="#{{ $item['id'] }}">{{ $item['text'] }}</a></li>
            @endforeach
        </ol>
    </nav>
@endif

@foreach ($post['sections'] ?? [] as $section)
    @switch($section['type'])
        @case('heading')
            @php $headingId = \Illuminate\Support\Str::slug($section['text'] ?? ''); @endphp
            <h2 id="{{ $headingId }}" class="harmone-blog-detail__heading harmone-reveal" data-reveal="fade-up">{{ $section['text'] }}</h2>
            @break

        @case('paragraph')
            <div class="harmone-blog-detail__paragraph harmone-reveal" data-reveal="fade-up">{!! $section['text'] !!}</div>
            @break

        @case('cards')
            <div class="harmone-blog-detail__cards harmone-reveal" data-reveal="fade-up">
                @foreach ($section['items'] as $card)
                    <article class="harmone-blog-detail__card">
                        <h3 class="harmone-blog-detail__card-title">{{ $card['title'] }}</h3>
                        <p class="harmone-blog-detail__card-text">{{ $card['text'] }}</p>
                    </article>
                @endforeach
            </div>
            @break

        @case('image')
            <figure class="harmone-blog-detail__figure harmone-reveal" data-reveal="slide-in">
                <img src="{{ $section['src'] }}" alt="{{ $section['alt'] ?? '' }}" loading="lazy">
            </figure>
            @break

        @case('list')
            <div class="harmone-blog-detail__list-wrap harmone-reveal" data-reveal="fade-up">
                @if (! empty($section['title']))
                    <h3 class="harmone-blog-detail__list-title">{{ $section['title'] }}</h3>
                @endif
                <ul class="harmone-blog-detail__list">
                    @foreach ($section['items'] as $item)
                        <li>
                            <strong>{{ $item['title'] }}</strong>
                            @if (($item['body'] ?? '') !== '')
                                <span>{{ $item['body'] }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            @break
    @endswitch
@endforeach
