<?php

namespace App\Http\Controllers;

use App\Support\SiteData;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('services.index', SiteData::all());
    }

    public function show(string $slug): View
    {
        $site = SiteData::all();
        $service = collect($site['home_services'] ?? [])
            ->first(fn (array $item): bool => ($item['slug'] ?? null) === $slug);

        abort_unless($service && ! ($service['coming_soon'] ?? false), 404);

        $details = $site['service_details'][$slug] ?? [];

        return view('services.show', array_merge($site, [
            'service' => array_merge($service, $details),
        ]));
    }
}
