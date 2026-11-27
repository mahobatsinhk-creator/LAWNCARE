@extends('layouts.app')

@section('title', $service['seo_title'] ?? (($service['page_title'] ?? $service['title']).' — '.$site['name']))
@section('meta_description', $service['seo_description'] ?? $site['description'])
@section('meta_keywords', $service['seo_keywords'] ?? '')
@section('canonical', url('/services/'.$service['slug']))
@section('og_image', url($service['hero_image'] ?? $service['image'] ?? ($site['logo'] ?? '/assets/site/logo-header.png')))

@push('head')
@include('partials.faq-jsonld', ['faqs' => $service['faqs'] ?? []])
@endpush

@section('content')
    <article class="greenly-service-detail">
        @include('partials.greenly-service-hero', ['service' => $service])

        <section class="greenly-service-detail__intro" data-reveal-group>
            <div class="greenly-service-detail__inner">
                <h2 class="greenly-service-detail__intro-heading harmone-reveal" data-reveal="fade-up">
                    {{ $service['intro_heading'] }}
                </h2>
            </div>
        </section>

        @include('partials.greenly-service-offerings', ['service' => $service])

        @include('partials.greenly-service-features', ['service' => $service])

        @if (! empty($service['faqs']))
            <section class="section-shell bg-page" data-reveal-group>
                <div class="section-inner">
                    @include('partials.harmone-section-header', [
                        'badge' => 'FAQs',
                        'title' => 'Frequently Asked Questions',
                    ])
                    @include('partials.harmone-faq-accordion', [
                        'faqs' => $service['faqs'],
                        'openFirst' => true,
                    ])
                </div>
            </section>
        @endif

        <div class="greenly-service-detail__back-wrap" data-reveal-group>
            <div class="greenly-service-detail__inner">
                <a href="/#services" class="greenly-service-detail__back harmone-reveal"
                    data-reveal="fade-up">
                    &larr; {{ $service_detail_page['back_label'] }}
                </a>
            </div>
        </div>
    </article>
@endsection
