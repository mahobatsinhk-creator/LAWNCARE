<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('services.index', config('site'));
    }

    public function show(string $slug): View
    {
        $service = collect(config('site.home_services'))
            ->first(fn (array $item): bool => ($item['slug'] ?? null) === $slug);

        abort_unless($service && ! ($service['coming_soon'] ?? false), 404);

        $details = config("site.service_details.{$slug}", []);

        return view('services.show', array_merge(config('site'), [
            'service' => array_merge($service, $details),
        ]));
    }
}
