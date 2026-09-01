@extends('layouts.app')

@section('title', $service['title'] . ' — ' . $site['name'])

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

        <div class="greenly-service-detail__back-wrap" data-reveal-group>
            <div class="greenly-service-detail__inner">
                <a href="{{ route('services.index') }}" class="greenly-service-detail__back harmone-reveal"
                    data-reveal="fade-up">
                    &larr; {{ $service_detail_page['back_label'] }}
                </a>
            </div>
        </div>
    </article>
@endsection
