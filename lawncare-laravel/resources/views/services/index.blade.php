@extends('layouts.app')

@section('title', 'Services — ' . $site['name'])

@section('content')
    <section id="services" class="leapfly-services-page">
        <div class="leapfly-services-page__inner">
            <header class="leapfly-services-page__header">
                <div class="leapfly-services-page__heading">
                    <span class="leapfly-services-page__badge">{{ $services_page['badge'] }}</span>
                    <h1 class="leapfly-services-page__title">{{ $services_page['title'] }}</h1>
                </div>
                <p class="leapfly-services-page__subtitle">{{ $services_page['subtitle'] }}</p>
            </header>

            <div class="leapfly-services-page__list">
                @foreach ($home_services as $service)
                    @include('partials.leapfly-service-row', compact('service'))
                @endforeach
            </div>
        </div>
    </section>
@endsection
