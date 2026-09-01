@extends('admin.layouts.app')

@section('heading', 'Dashboard')
@section('subheading', 'Overview of leads, inquiries, and website activity.')

@section('content')
    <div class="admin-grid admin-grid--stats">
        <div class="admin-stat">
            <div class="admin-stat__label">Total Leads</div>
            <div class="admin-stat__value">{{ $stats['leads'] }}</div>
            <div class="admin-stat__meta">{{ $stats['new_leads'] }} new</div>
        </div>
        <div class="admin-stat">
            <div class="admin-stat__label">Contact Inquiries</div>
            <div class="admin-stat__value">{{ $stats['inquiries'] }}</div>
            <div class="admin-stat__meta">{{ $stats['new_inquiries'] }} new</div>
        </div>
        <div class="admin-stat">
            <div class="admin-stat__label">Services</div>
            <div class="admin-stat__value">{{ $stats['services'] }}</div>
            <div class="admin-stat__meta">Active on website</div>
        </div>
        <div class="admin-stat">
            <div class="admin-stat__label">Website Content</div>
            <div class="admin-stat__value">8</div>
            <div class="admin-stat__meta">Editable sections</div>
        </div>
    </div>

    <div class="admin-grid" style="grid-template-columns: repeat(2, minmax(0, 1fr)); margin-top: 18px;">
        <section class="admin-panel">
            <h2 class="admin-panel__title">Recent Leads</h2>
            @if ($recentLeads->isEmpty())
                <div class="admin-empty">No quote requests yet.</div>
            @else
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentLeads as $lead)
                                <tr>
                                    <td><a href="{{ route('admin.leads.show', $lead) }}">{{ $lead->full_name }}</a></td>
                                    <td>{{ $lead->service }}</td>
                                    <td><span class="admin-badge admin-badge--{{ $lead->status }}">{{ ucfirst($lead->status) }}</span></td>
                                    <td>{{ $lead->created_at->format('M j, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <section class="admin-panel">
            <h2 class="admin-panel__title">Recent Contact Inquiries</h2>
            @if ($recentInquiries->isEmpty())
                <div class="admin-empty">No contact inquiries yet.</div>
            @else
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentInquiries as $inquiry)
                                <tr>
                                    <td><a href="{{ route('admin.inquiries.show', $inquiry) }}">{{ $inquiry->name }}</a></td>
                                    <td>{{ $inquiry->service }}</td>
                                    <td><span class="admin-badge admin-badge--{{ $inquiry->status }}">{{ ucfirst($inquiry->status) }}</span></td>
                                    <td>{{ $inquiry->created_at->format('M j, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
@endsection
