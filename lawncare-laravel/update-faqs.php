<?php

declare(strict_types=1);

require __DIR__ . '/lawncare-app/vendor/autoload.php';

$app = require __DIR__ . '/lawncare-app/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\SiteContent;

header('Content-Type: text/plain; charset=utf-8');

const PATCH_KEY = 'lawncare-faqs-2026';

if (($_GET['key'] ?? '') !== PATCH_KEY) {
    http_response_code(403);
    exit("Forbidden\n");
}

$homeFaqs = [
    [
        'question' => 'Do you offer snow removal services for both residential and commercial?',
        'answer' => 'We provide lawn care and summer property maintenance services for both residential and commercial clients. Currently, our snow removal services are available exclusively for residential properties.',
    ],
    [
        'question' => 'What lawn care services do you provide during the warmer months?',
        'answer' => 'Our lawn care services include fertilization, manual weed control, lawn maintenance, and seasonal maintenance to keep your lawn healthy and attractive. We provide these services for both residential and commercial properties.',
    ],
    [
        'question' => 'Can I schedule seasonal snow removal contracts?',
        'answer' => 'Yes, we offer seasonal snow removal contracts for residential properties to ensure your home stays safe and accessible throughout the winter months with no hassle.',
    ],
    [
        'question' => 'What services do you offer?',
        'answer' => 'We provide lawn care and summer property maintenance for residential and commercial clients, including mowing, fertilizing, aeration, fall cleanups, edging, and seasonal maintenance. Snow removal — including snow blowing, shoveling, and ice control — is available for residential properties only. Junk removal is coming soon.',
    ],
    [
        'question' => 'Are you available year-round?',
        'answer' => 'Yes! We provide all-season lawn care and property maintenance for residential and commercial clients, plus residential snow removal, keeping your property maintained and safe from spring through winter.',
    ],
];

$aboutFaqs = [
    [
        'question' => 'Do you offer snow removal services for both residential and commercial?',
        'answer' => 'We provide lawn care and summer property maintenance services for both residential and commercial clients. Currently, our snow removal services are available exclusively for residential properties.',
    ],
    [
        'question' => 'What services do you offer?',
        'answer' => 'We provide lawn care and summer property maintenance for residential and commercial clients, including mowing, fertilizing, aeration, fall cleanups, edging, and seasonal maintenance. Snow removal — including snow blowing, shoveling, and ice control — is available for residential properties only. Junk removal is coming soon.',
    ],
    [
        'question' => 'What lawn care services do you provide during the warmer months?',
        'answer' => 'Our lawn care services include fertilization, manual weed control, lawn maintenance, and seasonal maintenance to keep your lawn healthy and attractive. We provide these services for both residential and commercial properties.',
    ],
    [
        'question' => 'Can I schedule seasonal snow removal contracts?',
        'answer' => 'Yes, we offer seasonal snow removal contracts for residential properties to ensure your home stays safe and accessible throughout the winter months with no hassle.',
    ],
    [
        'question' => 'How do I request a consultation or quote?',
        'answer' => 'You can request a quote through our website, call us at (587) 879-5296, or email our team. We will review your property needs and follow up with a clear estimate and next steps.',
    ],
];

SiteContent::saveFormData('home', ['home_faqs' => $homeFaqs]);
SiteContent::saveFormData('contact', ['home_faqs' => $homeFaqs]);
SiteContent::saveFormData('about', ['about_faqs' => $aboutFaqs]);

echo "Updated home and about FAQs.\n";
echo 'Delete update-faqs.php now.' . PHP_EOL;
