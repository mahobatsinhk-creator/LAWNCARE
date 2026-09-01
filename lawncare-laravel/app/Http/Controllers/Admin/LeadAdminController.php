<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeadAdminController extends Controller
{
    public function index(): View
    {
        $leads = Lead::latest()->paginate(15);

        return view('admin.leads.index', compact('leads'));
    }

    public function show(Lead $lead): View
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function updateStatus(Request $request, Lead $lead): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,contacted,closed'],
        ]);

        $lead->update($validated);

        return back()->with('success', 'Lead status updated.');
    }
}
