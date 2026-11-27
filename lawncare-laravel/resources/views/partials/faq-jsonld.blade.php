@php
    /** @var array<int, array{question?: string, answer?: string}> $faqs */
    $faqs = collect($faqs ?? [])
        ->filter(fn ($faq) => filled($faq['question'] ?? null) && filled($faq['answer'] ?? null))
        ->values()
        ->all();

    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(static function (array $faq): array {
            return [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ];
        }, $faqs),
    ];
@endphp
@if (count($faqs) > 0)
<script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
@endif
