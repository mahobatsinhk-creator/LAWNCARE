<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ServiceAdminController extends Controller
{
    public function index(): View
    {
        $services = collect(config('site.home_services', []))
            ->map(function (array $service) {
                $slug = $service['slug'] ?? null;
                $details = $slug ? config("site.service_details.{$slug}", []) : [];

                return array_merge($service, [
                    'detail_features_count' => count($details['detail_features'] ?? []),
                ]);
            });

        return view('admin.services.index', compact('services'));
    }
}
