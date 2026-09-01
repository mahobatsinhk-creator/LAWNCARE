<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\Lead;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $services = collect(config('site.home_services', []))->where('coming_soon', false);

        return view('admin.dashboard', [
            'stats' => [
                'leads' => Lead::count(),
                'new_leads' => Lead::where('status', 'new')->count(),
                'inquiries' => ContactInquiry::count(),
                'new_inquiries' => ContactInquiry::where('status', 'new')->count(),
                'services' => $services->count(),
            ],
            'recentLeads' => Lead::latest()->limit(5)->get(),
            'recentInquiries' => ContactInquiry::latest()->limit(5)->get(),
        ]);
    }
}
