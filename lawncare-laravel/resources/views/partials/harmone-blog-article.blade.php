@foreach ($post['sections'] as $section)
    @switch($section['type'])
        @case('heading')
            <h2 class="harmone-blog-detail__heading harmone-reveal" data-reveal="fade-up">{{ $section['text'] }}</h2>
            @break

        @case('paragraph')
            <p class="harmone-blog-detail__paragraph harmone-reveal" data-reveal="fade-up">{{ $section['text'] }}</p>
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
                            <span>{{ $item['body'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            @break
    @endswitch
@endforeach
