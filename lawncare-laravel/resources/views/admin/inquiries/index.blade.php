@extends('admin.layouts.app')

@section('heading', 'Contact Inquiry')
@section('subheading', 'Messages submitted from the contact page form.')

@section('content')
    <div class="admin-panel">
        @if ($inquiries->isEmpty())
            <div class="admin-empty">No contact inquiries yet.</div>
        @else
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inquiries as $inquiry)
                            <tr>
                                <td><a href="{{ route('admin.inquiries.show', $inquiry) }}">{{ $inquiry->name }}</a></td>
                                <td>{{ $inquiry->email }}</td>
                                <td>{{ $inquiry->phone }}</td>
                                <td>{{ $inquiry->service }}</td>
                                <td><span class="admin-badge admin-badge--{{ $inquiry->status }}">{{ ucfirst($inquiry->status) }}</span></td>
                                <td>{{ $inquiry->created_at->format('M j, Y g:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 16px;">{{ $inquiries->links() }}</div>
        @endif
    </div>
@endsection
