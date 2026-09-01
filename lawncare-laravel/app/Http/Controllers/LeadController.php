<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request): JsonResponse
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

        Lead::create($validated);

        return response()->json(['message' => 'Quote request received.']);
    }
}
