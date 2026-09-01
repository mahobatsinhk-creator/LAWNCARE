@extends('admin.layouts.app')

@section('heading', 'Website Content')
@section('subheading', 'Choose a page section to edit and save content.')

@section('content')
    <div class="admin-grid admin-grid--cards">
        @foreach ($sections as $section)
            <article class="admin-card">
                <div class="admin-card__icon">
                    @switch($section['icon'])
                        @case('settings') ⚙ @break
                        @case('home') ⌂ @break
                        @case('info') i @break
                        @case('briefcase') ☰ @break
                        @case('mail') ✉ @break
                        @case('calendar') 📅 @break
                        @case('layout') ▦ @break
                        @default 📄
                    @endswitch
                </div>
                <h2 class="admin-card__title">{{ $section['title'] }}</h2>
                <span class="admin-card__badge">{{ $section['sections'] }} {{ Str::plural('section', $section['sections']) }}</span>
                <p class="admin-card__text">{{ $section['description'] }}</p>
                <a href="{{ route('admin.content.edit', $section['key']) }}" class="admin-card__link">Edit Content →</a>
            </article>
        @endforeach
    </div>
@endsection
