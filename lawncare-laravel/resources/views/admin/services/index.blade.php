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
                        <th>Features</th>
                        <th>Status</th>
                        <th>Page</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $service['title'] }}</td>
                            <td>{{ $service['slug'] ?? '—' }}</td>
                            <td>{{ count($service['features'] ?? []) }} listed / {{ $service['detail_features_count'] ?? 0 }} detail</td>
                            <td>
                                @if ($service['coming_soon'] ?? false)
                                    <span class="admin-badge admin-badge--contacted">Coming soon</span>
                                @else
                                    <span class="admin-badge admin-badge--new">Live</span>
                                @endif
                            </td>
                            <td>
                                @if (! empty($service['href']))
                                    <a href="{{ $service['href'] }}" target="_blank" rel="noopener">View page</a>
                                @else
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
