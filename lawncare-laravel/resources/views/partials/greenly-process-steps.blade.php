<div class="greenly-process-steps mt-12" data-reveal-group>
    @foreach ($process_steps as $index => $step)
        <article @class([
            'greenly-process-step harmone-reveal',
            'greenly-process-step--primary' => $index === 0,
        ]) data-reveal="slide-in" data-reveal-delay="{{ $index * 80 }}">
            <div class="greenly-process-step__head">
                <span class="greenly-process-step__number">({{ $step['number'] }})</span>
                <h3 class="greenly-process-step__title">{{ $step['title'] }}</h3>
            </div>
            <div class="greenly-process-step__body">
                <div class="greenly-process-step__image">
                    <img src="{{ $step['image'] }}" alt="{{ $step['title'] }}" width="538" height="572"
                        loading="lazy" decoding="async">
                </div>
                <p class="greenly-process-step__text">{{ $step['text'] }}</p>
            </div>
        </article>
    @endforeach
</div>
