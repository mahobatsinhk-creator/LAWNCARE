@extends('admin.layouts.app')

@section('heading', 'Edit Service')
@section('subheading', $service['title'] ?? $slug)

@section('content')
    <form
        method="POST"
        action="{{ route('admin.services.update', $slug) }}"
        class="blog-form-shell"
        data-service-form
        data-upload-url="{{ route('admin.media.upload') }}"
        data-csrf="{{ csrf_token() }}"
    >
        @csrf
        @method('PUT')

        <div class="admin-toolbar admin-toolbar--split">
            <a href="{{ route('admin.services.index') }}" class="admin-link">← Back to services</a>
            <div class="admin-toolbar__group">
                @if (! empty($service['href']))
                    <a href="{{ $service['href'] }}" class="admin-link" target="_blank" rel="noopener">View page</a>
                @endif
                <button type="submit" class="admin-btn admin-btn--primary">Save changes</button>
            </div>
        </div>

        @include('admin.services._form', [
            'service' => $service,
            'details' => $details,
        ])

        <div class="admin-form-actions">
            <button type="submit" class="admin-btn admin-btn--primary">Save changes</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="/assets/admin/service-editor.js?v=2"></script>
@endpush
