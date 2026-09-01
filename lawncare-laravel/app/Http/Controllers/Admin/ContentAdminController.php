<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use App\Support\SiteContentFields;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ContentAdminController extends Controller
{
    public function index(): View
    {
        $sections = collect(SiteContent::sectionLabels())->map(function (string $title, string $key) {
            return [
                'key' => $key,
                'title' => $title,
                'description' => SiteContentFields::pageDescription($key),
                'sections' => SiteContentFields::groupCount($key),
                'icon' => match ($key) {
                    'global' => 'settings',
                    'home' => 'home',
                    'about' => 'info',
                    'services' => 'briefcase',
                    'contact' => 'mail',
                    'quote' => 'calendar',
                    'footer' => 'layout',
                    default => 'file',
                },
            ];
        })->values()->all();

        return view('admin.content.index', compact('sections'));
    }

    public function edit(string $section): View
    {
        abort_unless(isset(SiteContent::sectionLabels()[$section]), 404);

        return view('admin.content.edit', [
            'section' => $section,
            'title' => SiteContent::sectionLabels()[$section],
            'pageDescription' => SiteContentFields::pageDescription($section),
            'groups' => SiteContentFields::groupsFor($section),
            'content' => SiteContent::getFormData($section),
        ]);
    }

    public function update(Request $request, string $section): RedirectResponse
    {
        abort_unless(isset(SiteContent::sectionLabels()[$section]), 404);

        $fields = $request->input('fields', []);
        $saved = [];

        foreach (SiteContentFields::allFieldsFor($section) as $key => $field) {
            if (! array_key_exists($key, $fields)) {
                continue;
            }

            $raw = $fields[$key];

            if ($field['type'] === 'json') {
                $decoded = json_decode(is_string($raw) ? $raw : json_encode($raw), true);

                if (! is_array($decoded)) {
                    throw ValidationException::withMessages([
                        "fields.{$key}" => 'Must be valid JSON.',
                    ]);
                }

                $saved[$key] = $decoded;
                continue;
            }

            $saved[$key] = trim((string) $raw);
        }

        SiteContent::saveFormData($section, $saved);

        return redirect()
            ->route('admin.content.edit', $section)
            ->with('success', 'Content updated successfully.');
    }
}
