@extends('admin.layouts.app')

@section('heading', 'Leads')
@section('subheading', 'Quote requests submitted from the Get Quote page.')

@section('content')
    <div class="admin-panel">
        @if ($leads->isEmpty())
            <div class="admin-empty">No leads yet.</div>
        @else
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Service</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leads as $lead)
                            <tr>
                                <td><a href="{{ route('admin.leads.show', $lead) }}">{{ $lead->full_name }}</a></td>
                                <td>{{ $lead->email }}</td>
                                <td>{{ $lead->phone }}</td>
                                <td>{{ $lead->service }}</td>
                                <td>{{ $lead->city }}</td>
                                <td><span class="admin-badge admin-badge--{{ $lead->status }}">{{ ucfirst($lead->status) }}</span></td>
                                <td>{{ $lead->created_at->format('M j, Y g:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 16px;">{{ $leads->links() }}</div>
        @endif
    </div>
@endsection
