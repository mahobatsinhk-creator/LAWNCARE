<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaUploadController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'file' => ['required', 'file', 'max:51200', 'mimes:jpg,jpeg,png,gif,webp,svg,mp4,webm,mov'],
        ]);

        $path = $validated['file']->store('media', 'public');

        return response()->json([
            'url' => Storage::disk('public')->url($path),
        ]);
    }
}
