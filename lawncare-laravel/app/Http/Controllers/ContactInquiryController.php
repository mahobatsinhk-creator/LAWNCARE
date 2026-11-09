<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use App\Services\ZapierWebhook;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactInquiryController extends Controller
{
    public function store(Request $request, ZapierWebhook $zapier): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:190'],
            'service' => ['required', 'string', 'max:120'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        ContactInquiry::create($validated);

        $zapier->send($zapier->payloadFor('contact', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'service' => $validated['service'],
            'message' => $validated['message'] ?? '',
        ]));

        return response()->json(['message' => 'Inquiry received.']);
    }
}
