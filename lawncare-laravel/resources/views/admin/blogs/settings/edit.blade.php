@extends('admin.layouts.app')

@section('heading', 'Blog Page Settings')
@section('subheading', 'Edit the blogs listing page hero content.')

@section('content')
    <div class="admin-panel">
        <a href="{{ route('admin.blogs.index') }}" class="admin-link" style="display:inline-block;margin-bottom:18px;">← Blogs modules</a>

        <form method="POST" action="{{ route('admin.blogs.settings.update') }}">
            @csrf
            @method('PUT')

            <label class="admin-field">
                <span>Badge</span>
                <input type="text" name="badge" value="{{ old('badge', $settings->badge) }}" required>
                @error('badge') <small class="admin-error">{{ $message }}</small> @enderror
            </label>

            <label class="admin-field">
                <span>Page title</span>
                <input type="text" name="title" value="{{ old('title', $settings->title) }}" required>
                @error('title') <small class="admin-error">{{ $message }}</small> @enderror
            </label>

            <label class="admin-field">
                <span>Hero image URL</span>
                <input type="text" name="hero_image" value="{{ old('hero_image', $settings->hero_image) }}" required>
                @error('hero_image') <small class="admin-error">{{ $message }}</small> @enderror
            </label>

            <div class="admin-form-actions">
                <button type="submit" class="admin-btn admin-btn--primary">Save settings</button>
            </div>
        </form>
    </div>
@endsection
