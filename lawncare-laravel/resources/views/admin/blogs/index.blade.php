@extends('admin.layouts.app')

@section('heading', 'Blogs')
@section('subheading', 'Manage blog posts and the blogs listing page.')

@section('content')
    <div class="admin-grid admin-grid--cards">
        @foreach ($modules as $module)
            <article class="admin-card">
                <div class="admin-card__icon">
                    @switch($module['icon'])
                        @case('file') 📄 @break
                        @case('layout') ▦ @break
                        @default 📄
                    @endswitch
                </div>
                <h2 class="admin-card__title">{{ $module['title'] }}</h2>
                <span class="admin-card__badge">{{ $module['sections'] }} {{ Str::plural('item', $module['sections']) }}</span>
                <p class="admin-card__text">{{ $module['description'] }}</p>
                <a href="{{ $module['route'] }}" class="admin-card__link">Open module →</a>
            </article>
        @endforeach
    </div>
@endsection
