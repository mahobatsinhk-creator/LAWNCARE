@extends('admin.layouts.app')

@section('heading', 'Services')
@section('subheading', 'Manage the services shown on your website.')

@section('content')
    <div class="admin-panel">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Slug</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $service['title'] }}</td>
                            <td>{{ $service['slug'] ?? '—' }}</td>
                            <td>{{ $service['offerings_count'] ?? 0 }} offerings / {{ $service['features_count'] ?? 0 }} features</td>
                            <td>
                                @if ($service['coming_soon'] ?? false)
                                    <span class="admin-badge admin-badge--contacted">Coming soon</span>
                                @else
                                    <span class="admin-badge admin-badge--new">Live</span>
                                @endif
                            </td>
                            <td>
                                @if (! empty($service['slug']))
                                    <a href="{{ route('admin.services.edit', $service['slug']) }}" class="admin-link">Edit</a>
                                @endif
                                @if (! empty($service['href']))
                                    @if (! empty($service['slug']))
                                        <span aria-hidden="true"> · </span>
                                    @endif
                                    <a href="{{ $service['href'] }}" target="_blank" rel="noopener">View page</a>
                                @endif
                                @if (empty($service['slug']) && empty($service['href']))
                                    —
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
