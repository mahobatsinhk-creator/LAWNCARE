@extends('admin.layouts.app')

@section('heading', 'Lead Details')
@section('subheading', $lead->full_name . ' — submitted ' . $lead->created_at->format('M j, Y g:i A'))

@section('content')
    <div class="admin-panel">
        <form method="POST" action="{{ route('admin.leads.status', $lead) }}" style="margin-bottom: 18px;">
            @csrf
            @method('PATCH')
            <label class="admin-field" style="max-width: 240px;">
                <span>Status</span>
                <select name="status" onchange="this.form.submit()">
                    <option value="new" @selected($lead->status === 'new')>New</option>
                    <option value="contacted" @selected($lead->status === 'contacted')>Contacted</option>
                    <option value="closed" @selected($lead->status === 'closed')>Closed</option>
                </select>
            </label>
        </form>

        <div class="admin-detail-grid">
            <div class="admin-detail-item"><span>First Name</span><strong>{{ $lead->first_name }}</strong></div>
            <div class="admin-detail-item"><span>Last Name</span><strong>{{ $lead->last_name }}</strong></div>
            <div class="admin-detail-item"><span>Company</span><strong>{{ $lead->company ?: '—' }}</strong></div>
            <div class="admin-detail-item"><span>Email</span><strong>{{ $lead->email }}</strong></div>
            <div class="admin-detail-item"><span>Phone</span><strong>{{ $lead->phone }}</strong></div>
            <div class="admin-detail-item"><span>Service</span><strong>{{ $lead->service }}</strong></div>
            <div class="admin-detail-item"><span>Street</span><strong>{{ $lead->street }}</strong></div>
            <div class="admin-detail-item"><span>Unit</span><strong>{{ $lead->unit ?: '—' }}</strong></div>
            <div class="admin-detail-item"><span>City</span><strong>{{ $lead->city }}</strong></div>
            <div class="admin-detail-item"><span>Province</span><strong>{{ $lead->province }}</strong></div>
            <div class="admin-detail-item"><span>Postal Code</span><strong>{{ $lead->postal_code }}</strong></div>
            <div class="admin-detail-item"><span>Marketing Email</span><strong>{{ $lead->marketing_email ? 'Yes' : 'No' }}</strong></div>
            <div class="admin-detail-item"><span>Marketing SMS</span><strong>{{ $lead->marketing_sms ? 'Yes' : 'No' }}</strong></div>
            <div class="admin-detail-item" style="grid-column: 1 / -1;">
                <span>Project Details</span>
                <p>{{ $lead->message }}</p>
            </div>
        </div>

        <a href="{{ route('admin.leads.index') }}" class="admin-card__link" style="margin-top: 18px; display: inline-block;">← Back to Leads</a>
    </div>
@endsection
