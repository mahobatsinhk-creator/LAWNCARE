@php
    /** @var array<int, array{question?: string, answer?: string}> $faqs */
    $faqs = $faqs ?? [];
    $openFirst = $openFirst ?? true;
    $listClass = $listClass ?? 'space-y-3';
@endphp
@if (count($faqs) > 0)
    <div class="{{ $listClass }}">
        @foreach ($faqs as $faq)
            <details class="group harmone-faq-card px-5 py-4"
                @if ($openFirst && $loop->first) open @endif>
                <summary class="cursor-pointer list-none font-medium marker:content-none md:text-lg">
                    <span class="flex items-start justify-between gap-4 text-heading">
                        <span>
                            @if (! empty($showQuestionLabel))
                                <span class="mb-1 block text-xs font-medium uppercase tracking-[0.14em] text-body">Question</span>
                            @endif
                            {{ $faq['question'] }}
                        </span>
                        <span class="mt-0.5 shrink-0 text-[var(--link)] transition group-open:rotate-45" aria-hidden="true">+</span>
                    </span>
                </summary>
                <p class="mt-3 max-w-3xl text-sm leading-relaxed text-body">{{ $faq['answer'] }}</p>
            </details>
        @endforeach
    </div>
@endif
