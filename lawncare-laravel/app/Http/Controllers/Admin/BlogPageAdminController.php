<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogPageAdminController extends Controller
{
    public function edit(): View
    {
        $settings = BlogSetting::current();

        return view('admin.blogs.settings.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'badge' => ['required', 'string', 'max:120'],
            'title' => ['required', 'string', 'max:255'],
            'hero_image' => ['required', 'string', 'max:500'],
        ]);

        BlogSetting::current()->update($validated);

        return redirect()
            ->route('admin.blogs.settings.edit')
            ->with('success', 'Blog page settings saved.');
    }
}
