<?php

namespace App\Http\Controllers;

use App\Support\SiteData;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $site = SiteData::all();
        $base = rtrim($site['site']['url'] ?? config('app.url'), '/');
        $now = now()->toAtomString();

        $urls = [
            ['loc' => $base.'/', 'changefreq' => 'weekly', 'priority' => '1.0', 'lastmod' => $now],
            ['loc' => $base.'/about', 'changefreq' => 'monthly', 'priority' => '0.7', 'lastmod' => $now],
            ['loc' => $base.'/blogs', 'changefreq' => 'weekly', 'priority' => '0.8', 'lastmod' => $now],
            ['loc' => $base.'/contact', 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => $now],
            ['loc' => $base.'/get-quote', 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => $now],
            ['loc' => $base.'/privacy-policy', 'changefreq' => 'yearly', 'priority' => '0.3', 'lastmod' => $now],
            ['loc' => $base.'/terms-and-conditions', 'changefreq' => 'yearly', 'priority' => '0.3', 'lastmod' => $now],
        ];

        foreach ($site['home_services'] ?? [] as $service) {
            if (! empty($service['coming_soon']) || empty($service['slug'])) {
                continue;
            }

            $urls[] = [
                'loc' => $base.'/services/'.$service['slug'],
                'changefreq' => 'monthly',
                'priority' => '0.9',
                'lastmod' => $now,
            ];
        }

        foreach ($site['blog_posts'] ?? [] as $post) {
            if (empty($post['slug'])) {
                continue;
            }

            $lastmod = $now;
            if (! empty($post['date'])) {
                try {
                    $lastmod = \Illuminate\Support\Carbon::parse($post['date'])->toAtomString();
                } catch (\Throwable) {
                    // keep fallback
                }
            }

            $urls[] = [
                'loc' => $base.'/blogs/'.$post['slug'],
                'changefreq' => 'monthly',
                'priority' => '0.7',
                'lastmod' => $lastmod,
            ];
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
