<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Services\ZapierWebhook;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request, ZapierWebhook $zapier): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:80'],
            'last_name' => ['required', 'string', 'max:80'],
            'company' => ['nullable', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'marketing_email' => ['nullable', 'boolean'],
            'phone' => ['required', 'string', 'max:40'],
            'marketing_sms' => ['nullable', 'boolean'],
            'street' => ['required', 'string', 'max:190'],
            'unit' => ['nullable', 'string', 'max:80'],
            'city' => ['required', 'string', 'max:80'],
            'province' => ['required', 'string', 'max:8'],
            'postal_code' => ['required', 'string', 'max:16'],
            'service' => ['required', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $validated['marketing_email'] = $request->boolean('marketing_email');
        $validated['marketing_sms'] = $request->boolean('marketing_sms');

        $lead = Lead::create($validated);

        $zapier->send($zapier->payloadFor('quote', [
            'name' => $lead->full_name,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'company' => $validated['company'] ?? '',
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => trim(implode(', ', array_filter([
                $validated['street'],
                $validated['unit'] ?? null,
                $validated['city'],
                $validated['province'],
                $validated['postal_code'],
            ]))),
            'street' => $validated['street'],
            'unit' => $validated['unit'] ?? '',
            'city' => $validated['city'],
            'province' => $validated['province'],
            'postal_code' => $validated['postal_code'],
            'service' => $validated['service'],
            'message' => $validated['message'],
            'marketing_email' => $validated['marketing_email'],
            'marketing_sms' => $validated['marketing_sms'],
        ]));

        return response()->json(['message' => 'Quote request received.']);
    }
}
