<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BlogSetting;
use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-headings-capitalization-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$home = config('site.home', []);

SiteContent::saveFormData('home', [
    'about_badge' => $home['about_badge'] ?? null,
    'about_title' => $home['about_title'] ?? null,
    'about_stat_label' => $home['about_stat_label'] ?? null,
    'mid_cta_title' => $home['mid_cta_title'] ?? null,
    'projects_title' => $home['projects_title'] ?? null,
    'projects' => config('site.projects', []),
    'testimonials_badge' => $home['testimonials_badge'] ?? null,
    'testimonials_title' => $home['testimonials_title'] ?? null,
    'process_title' => $home['process_title'] ?? null,
    'blogs_badge' => $home['blogs_badge'] ?? null,
    'blogs_cta' => $home['blogs_cta'] ?? null,
    'faqs_subtitle' => $home['faqs_subtitle'] ?? null,
]);

$aboutPage = config('site.about_page', []);

SiteContent::saveFormData('about', array_merge($aboutPage, [
    'about_stats' => config('site.about_stats', []),
    'about_timeline' => config('site.about_timeline', []),
]));

$contact = config('site.contact', []);

SiteContent::saveFormData('contact', [
    'hero_title' => $contact['hero_title'] ?? null,
    'faq_badge' => $contact['faq_badge'] ?? null,
    'faq_title' => $contact['faq_title'] ?? null,
    'cta_badge' => $contact['cta_badge'] ?? null,
    'cta_title' => $contact['cta_title'] ?? null,
    'cards' => $contact['cards'] ?? [],
]);

SiteContent::saveFormData('footer', config('site.footer', []));

$servicesRecord = SiteContent::query()->where('section', 'services')->first();
$servicesData = $servicesRecord->data ?? [];

SiteContent::saveFormData('services', array_merge($servicesData, [
    'detail_cta_title_em' => config('site.service_detail_page.cta_title_em'),
    'service_details' => config('site.service_details', []),
]));

$blogsPage = config('site.blogs_page', []);
$blogSetting = BlogSetting::query()->find(1);

BlogSetting::query()->updateOrCreate(
    ['id' => 1],
    [
        'badge' => $blogsPage['badge'] ?? 'Our Blogs',
        'title' => $blogsPage['title'] ?? 'Lawn Care and Snow Removal Tips',
        'hero_image' => $blogSetting->hero_image ?? ($blogsPage['hero_image'] ?? '/assets/site/blogs-hero-2026.jpg'),
    ],
);

echo "Updated heading capitalization across home, about, contact, footer, services, and blogs.\n";
echo 'Delete update-headings-capitalization.php now.' . PHP_EOL;
