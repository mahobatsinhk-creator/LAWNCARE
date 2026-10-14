<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use App\Support\SiteData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceAdminController extends Controller
{
    public function index(): View
    {
        $site = SiteData::all();

        $services = collect($site['home_services'] ?? [])
            ->map(function (array $service) use ($site) {
                $slug = $service['slug'] ?? null;
                $details = $slug ? ($site['service_details'][$slug] ?? []) : [];

                return array_merge($service, [
                    'offerings_count' => count($details['detail_offerings'] ?? []),
                    'features_count' => count($details['detail_features'] ?? []),
                ]);
            });

        return view('admin.services.index', compact('services'));
    }

    public function edit(string $slug): View
    {
        $this->findService($slug);

        $site = SiteData::all();
        $service = collect($site['home_services'])->firstWhere('slug', $slug);
        $details = $site['service_details'][$slug] ?? [];

        return view('admin.services.edit', compact('slug', 'service', 'details'));
    }

    public function update(Request $request, string $slug): RedirectResponse
    {
        $this->findService($slug);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short' => ['required', 'string', 'max:1000'],
            'image' => ['required', 'string', 'max:500'],
            'features_text' => ['nullable', 'string', 'max:5000'],
            'intro_heading' => ['nullable', 'string', 'max:500'],
            'video' => ['nullable', 'string', 'max:500'],
            'offerings_lead' => ['nullable', 'string', 'max:1000'],
            'offerings' => ['nullable', 'array'],
            'offerings.*.title' => ['required', 'string', 'max:255'],
            'offerings.*.body' => ['nullable', 'string', 'max:2000'],
            'offerings.*.image' => ['nullable', 'string', 'max:500'],
            'features' => ['nullable', 'array'],
            'features.*.title' => ['required', 'string', 'max:255'],
            'features.*.body' => ['nullable', 'string', 'max:2000'],
            'features.*.image' => ['nullable', 'string', 'max:500'],
        ]);

        $site = SiteData::all();

        $homeServices = $site['home_services'] ?? [];
        foreach ($homeServices as $index => $service) {
            if (($service['slug'] ?? '') !== $slug) {
                continue;
            }

            $homeServices[$index]['title'] = $validated['title'];
            $homeServices[$index]['short'] = $validated['short'];
            $homeServices[$index]['image'] = $validated['image'];
            $homeServices[$index]['features'] = $this->parseFeatures($validated['features_text'] ?? '');
            break;
        }

        SiteContent::saveFormData('home', ['home_services' => $homeServices]);

        $serviceDetails = $site['service_details'] ?? [];
        $existing = $serviceDetails[$slug] ?? [];

        $serviceDetails[$slug] = array_merge($existing, [
            'intro_heading' => $validated['intro_heading'] ?? '',
            'hero_image' => $validated['image'],
            'video' => ($validated['video'] ?? '') !== '' ? $validated['video'] : null,
            'offerings_lead' => ($validated['offerings_lead'] ?? '') !== '' ? $validated['offerings_lead'] : null,
            'detail_offerings' => $this->normalizeItems($validated['offerings'] ?? []),
            'detail_features' => $this->normalizeItems($validated['features'] ?? []),
        ]);

        SiteContent::saveFormData('services', ['service_details' => $serviceDetails]);

        return redirect()
            ->route('admin.services.edit', $slug)
            ->with('success', 'Service updated.');
    }

    private function findService(string $slug): array
    {
        $service = collect(config('site.home_services', []))->firstWhere('slug', $slug);
        abort_if(! $service, 404);

        return $service;
    }

    private function parseFeatures(?string $text): array
    {
        return collect(preg_split('/\R/', $text ?? ''))
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    /**
     * @param  array<int, array<string, mixed>>|null  $items
     * @return array<int, array{title: string, body: string, image: string}>
     */
    private function normalizeItems(?array $items): array
    {
        return collect($items ?? [])
            ->map(fn (array $item) => [
                'title' => trim((string) ($item['title'] ?? '')),
                'body' => trim((string) ($item['body'] ?? '')),
                'image' => trim((string) ($item['image'] ?? '')),
            ])
            ->filter(fn (array $item) => $item['title'] !== '')
            ->values()
            ->all();
    }
}
