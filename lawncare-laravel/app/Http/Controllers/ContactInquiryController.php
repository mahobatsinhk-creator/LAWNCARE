<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactInquiryController extends Controller
{
    public function store(Request $request): JsonResponse
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

        return response()->json(['message' => 'Inquiry received.']);
    }
}
