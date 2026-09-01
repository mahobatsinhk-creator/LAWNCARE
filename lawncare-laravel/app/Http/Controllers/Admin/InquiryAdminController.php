<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryAdminController extends Controller
{
    public function index(): View
    {
        $inquiries = ContactInquiry::latest()->paginate(15);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(ContactInquiry $inquiry): View
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function updateStatus(Request $request, ContactInquiry $inquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,contacted,closed'],
        ]);

        $inquiry->update($validated);

        return back()->with('success', 'Inquiry status updated.');
    }
}
