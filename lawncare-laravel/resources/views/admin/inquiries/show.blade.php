@extends('admin.layouts.app')

@section('heading', 'Contact Inquiry Details')
@section('subheading', $inquiry->name . ' — submitted ' . $inquiry->created_at->format('M j, Y g:i A'))

@section('content')
    <div class="admin-panel">
        <form method="POST" action="{{ route('admin.inquiries.status', $inquiry) }}" style="margin-bottom: 18px;">
            @csrf
            @method('PATCH')
            <label class="admin-field" style="max-width: 240px;">
                <span>Status</span>
                <select name="status" onchange="this.form.submit()">
                    <option value="new" @selected($inquiry->status === 'new')>New</option>
                    <option value="contacted" @selected($inquiry->status === 'contacted')>Contacted</option>
                    <option value="closed" @selected($inquiry->status === 'closed')>Closed</option>
                </select>
            </label>
        </form>

        <div class="admin-detail-grid">
            <div class="admin-detail-item"><span>Name</span><strong>{{ $inquiry->name }}</strong></div>
            <div class="admin-detail-item"><span>Email</span><strong>{{ $inquiry->email }}</strong></div>
            <div class="admin-detail-item"><span>Phone</span><strong>{{ $inquiry->phone }}</strong></div>
            <div class="admin-detail-item"><span>Service</span><strong>{{ $inquiry->service }}</strong></div>
            <div class="admin-detail-item"><span>Address</span><strong>{{ $inquiry->address }}</strong></div>
            <div class="admin-detail-item" style="grid-column: 1 / -1;">
                <span>Message</span>
                <p>{{ $inquiry->message ?: '—' }}</p>
            </div>
        </div>

        <a href="{{ route('admin.inquiries.index') }}" class="admin-card__link" style="margin-top: 18px; display: inline-block;">← Back to Contact Inquiry</a>
    </div>
@endsection
