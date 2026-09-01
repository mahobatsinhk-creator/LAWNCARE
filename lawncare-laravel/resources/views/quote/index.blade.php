@extends('layouts.app')

@section('title', $quote_page['title'] . ' — ' . $site['name'])

@section('content')
    <section class="harmone-quote-page">
        <div class="harmone-quote-page__inner">
            <header class="harmone-quote-page__header">
                <h1 class="harmone-quote-page__title">{{ $quote_page['title'] }}</h1>
                <p class="harmone-quote-page__intro">{{ $quote_page['intro'] }}</p>
            </header>

            <div class="harmone-quote-card">
                @include('partials.harmone-quote-form')
            </div>
        </div>
    </section>
@endsection
