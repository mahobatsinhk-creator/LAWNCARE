<?php

namespace App\Support;

class SiteContentFields
{
    public static function pageDescription(string $section): string
    {
        return match ($section) {
            'global' => 'Logo, contact info, hero media, and shared site settings.',
            'home' => 'Landing page text, images, videos, services, projects, and FAQs.',
            'about' => 'About page copy, images, stats, team, and FAQs.',
            'services' => 'Services listing page hero and intro.',
            'contact' => 'Contact page hero, form, cards, and CTA.',
            'quote' => 'Get Quote wizard labels and thank-you message.',
            'footer' => 'Footer CTA, labels, and background images.',
            default => 'Edit page content.',
        };
    }

    public static function groupsFor(string $section): array
    {
        return match ($section) {
            'global' => self::globalGroups(),
            'home' => self::homeGroups(),
            'about' => self::aboutGroups(),
            'services' => self::servicesGroups(),
            'contact' => self::contactGroups(),
            'quote' => self::quoteGroups(),
            'footer' => self::footerGroups(),
            default => [],
        };
    }

    public static function groupCount(string $section): int
    {
        return count(self::groupsFor($section));
    }

    public static function allFieldsFor(string $section): array
    {
        $fields = [];

        foreach (self::groupsFor($section) as $group) {
            foreach ($group['fields'] as $field) {
                $fields[$field['key']] = $field;
            }
        }

        return $fields;
    }

    public static function find(string $section, string $key): ?array
    {
        return self::allFieldsFor($section)[$key] ?? null;
    }

    private static function field(string $key, string $path, string $label, string $type = 'text'): array
    {
        return compact('key', 'path', 'label', 'type');
    }

    private static function group(string $id, string $title, string $description, array $fields): array
    {
        return compact('id', 'title', 'description', 'fields');
    }

    private static function globalGroups(): array
    {
        return [
            self::group('brand', 'Brand & Contact', 'Company name, tagline, and contact details.', [
                self::field('name', 'site.name', 'Site name'),
                self::field('tagline', 'site.tagline', 'Tagline / hero headline'),
                self::field('description', 'site.description', 'Site description', 'textarea'),
                self::field('phone', 'site.phone', 'Phone number'),
                self::field('phone_href', 'site.phone_href', 'Phone link (tel:)'),
                self::field('email', 'site.email', 'Email address'),
                self::field('url', 'site.url', 'Website URL'),
            ]),
            self::group('actions', 'Buttons & Links', 'Primary CTAs and client login.', [
                self::field('quote_url', 'site.quote_url', 'Quote button URL'),
                self::field('quote_label', 'site.quote_label', 'Quote button label'),
                self::field('client_login', 'site.client_login', 'Client login URL'),
            ]),
            self::group('media', 'Shared Media', 'Logo and reusable image/video assets.', [
                self::field('logo', 'site.logo', 'Logo image', 'image'),
                self::field('hero_video', 'site.hero_video', 'Default hero video', 'video'),
                self::field('hero_image', 'site.hero_image', 'Default hero poster image', 'image'),
                self::field('why_us_image', 'site.why_us_image', 'Why us section image', 'image'),
                self::field('cta_image', 'site.cta_image', 'CTA block image', 'image'),
                self::field('promise_image', 'site.promise_image', 'Promise / areas image', 'image'),
                self::field('process_video', 'site.process_video', 'Process section video', 'video'),
                self::field('process_side_image', 'site.process_side_image', 'Process side image', 'image'),
            ]),
            self::group('address', 'Mailing Address', 'Business address JSON.', [
                self::field('address', 'site.address', 'Address (JSON)', 'json'),
            ]),
        ];
    }

    private static function homeGroups(): array
    {
        return [
            self::group('hero', 'Hero Section', 'Top banner headline, copy, video, and poster image.', [
                self::field('hero_subtitle', 'home.hero_subtitle', 'Subtitle', 'textarea'),
                self::field('hero_cta', 'home.hero_cta', 'Button label'),
                self::field('hero_video', 'site.hero_video', 'Background video', 'video'),
                self::field('hero_image', 'site.hero_image', 'Video poster image', 'image'),
            ]),
            self::group('about-preview', 'About Preview', 'About block with feature image and promise card.', [
                self::field('about_badge', 'home.about_badge', 'Badge'),
                self::field('about_title', 'home.about_title', 'Title', 'textarea'),
                self::field('about_stat', 'home.about_stat', 'Stat value'),
                self::field('about_stat_label', 'home.about_stat_label', 'Stat label'),
                self::field('about_trust_line', 'home.about_trust_line', 'Trust line'),
                self::field('promise_title', 'home.promise_title', 'Promise label'),
                self::field('promise_text', 'promise_text', 'Promise text', 'textarea'),
                self::field('about_feature_image', 'about_feature_image', 'Feature image', 'image'),
            ]),
            self::group('services', 'Services Section', 'Services headings and service cards with images/videos.', [
                self::field('services_badge', 'home.services_badge', 'Badge'),
                self::field('services_title', 'home.services_title', 'Title'),
                self::field('home_services', 'home_services', 'Service cards (JSON)', 'json'),
            ]),
            self::group('process', 'Process Section', 'Process video, side image, and steps.', [
                self::field('process_badge', 'home.process_badge', 'Badge'),
                self::field('process_title', 'home.process_title', 'Title'),
                self::field('process_video', 'site.process_video', 'Process video', 'video'),
                self::field('process_side_image', 'site.process_side_image', 'Side image', 'image'),
                self::field('process_steps', 'process_steps', 'Process steps (JSON)', 'json'),
            ]),
            self::group('why-us', 'Why Us Section', 'Benefits list and side image.', [
                self::field('why_us_badge', 'home.why_us_badge', 'Badge'),
                self::field('why_us_title', 'home.why_us_title', 'Title'),
                self::field('why_us_image', 'site.why_us_image', 'Section image', 'image'),
                self::field('why_us', 'why_us', 'Why us items (JSON)', 'json'),
            ]),
            self::group('projects', 'Projects Section', 'Project cards with images.', [
                self::field('projects_badge', 'home.projects_badge', 'Badge'),
                self::field('projects_title', 'home.projects_title', 'Title'),
                self::field('projects', 'projects', 'Projects (JSON)', 'json'),
            ]),
            self::group('client-stories', 'Client Stories', 'Before/after comparison stories.', [
                self::field('client_stories_badge', 'home.client_stories_badge', 'Badge'),
                self::field('client_stories_title', 'home.client_stories_title', 'Title'),
                self::field('client_stories', 'client_stories', 'Client stories (JSON)', 'json'),
            ]),
            self::group('testimonials', 'Testimonials', 'Testimonial quotes and images.', [
                self::field('testimonials_badge', 'home.testimonials_badge', 'Badge'),
                self::field('testimonials_title', 'home.testimonials_title', 'Title'),
                self::field('testimonials_feature_image', 'testimonials_feature_image', 'Feature image', 'image'),
                self::field('testimonials_leaf_image', 'testimonials_leaf_image', 'Leaf decor image', 'image'),
                self::field('testimonials', 'testimonials', 'Testimonials (JSON)', 'json'),
            ]),
            self::group('areas', 'Service Areas', 'Service area list and side image.', [
                self::field('areas_badge', 'home.areas_badge', 'Badge'),
                self::field('areas_title', 'home.areas_title', 'Title'),
                self::field('areas_cta', 'home.areas_cta', 'Button label'),
                self::field('promise_image', 'site.promise_image', 'Side image', 'image'),
                self::field('service_areas', 'service_areas', 'Service areas list (JSON)', 'json'),
            ]),
            self::group('faqs', 'FAQs Section', 'FAQ headings and questions.', [
                self::field('faqs_badge', 'home.faqs_badge', 'Badge'),
                self::field('faqs_title', 'home.faqs_title', 'Title'),
                self::field('faqs_subtitle', 'home.faqs_subtitle', 'Subtitle'),
                self::field('home_faqs', 'home_faqs', 'FAQs (JSON)', 'json'),
            ]),
            self::group('mid-cta', 'Mid-page CTA', 'Middle call-to-action block.', [
                self::field('mid_cta_title', 'home.mid_cta_title', 'Title'),
                self::field('mid_cta_text', 'home.mid_cta_text', 'Description', 'textarea'),
                self::field('mid_cta_button', 'home.mid_cta_button', 'Button label'),
                self::field('cta_image', 'site.cta_image', 'CTA image', 'image'),
            ]),
            self::group('quote', 'Quote Form Section', 'Inline quote form headings.', [
                self::field('quote_title', 'home.quote_title', 'Title'),
                self::field('quote_text', 'home.quote_text', 'Description', 'textarea'),
            ]),
            self::group('blogs', 'Blogs Teaser', 'Latest blogs section labels.', [
                self::field('blogs_badge', 'home.blogs_badge', 'Badge'),
                self::field('blogs_cta', 'home.blogs_cta', 'View all link label'),
            ]),
        ];
    }

    private static function aboutGroups(): array
    {
        return [
            self::group('hero', 'Hero Section', 'About page banner.', [
                self::field('hero_title', 'about_page.hero_title', 'Title'),
                self::field('hero_image', 'about_page.hero_image', 'Hero image', 'image'),
            ]),
            self::group('founder', 'Founder Section', 'Founder quote and photo.', [
                self::field('founder_badge', 'about_page.founder_badge', 'Badge'),
                self::field('founder_quote', 'about_page.founder_quote', 'Quote', 'textarea'),
                self::field('founder_name', 'about_page.founder_name', 'Name'),
                self::field('founder_role', 'about_page.founder_role', 'Role / location'),
                self::field('founder_image', 'about_page.founder_image', 'Founder image', 'image'),
            ]),
            self::group('stats', 'Stats Section', 'Stats block copy and decor image.', [
                self::field('stats_badge', 'about_page.stats_badge', 'Badge'),
                self::field('stats_title', 'about_page.stats_title', 'Title'),
                self::field('stats_cta', 'about_page.stats_cta', 'Button label'),
                self::field('stats_cta_href', 'about_page.stats_cta_href', 'Button URL'),
                self::field('stats_decor', 'about_page.stats_decor', 'Decor image', 'image'),
                self::field('about_stats', 'about_stats', 'Stats items (JSON)', 'json'),
            ]),
            self::group('story', 'Story Section', 'Company story and image.', [
                self::field('story_badge', 'about_page.story_badge', 'Badge'),
                self::field('story_title', 'about_page.story_title', 'Title', 'textarea'),
                self::field('story_image', 'about_page.story_image', 'Story image', 'image'),
                self::field('story_cta', 'about_page.story_cta', 'Button label'),
                self::field('about_timeline', 'about_timeline', 'Timeline (JSON)', 'json'),
            ]),
            self::group('team', 'Team Section', 'Team headings and members.', [
                self::field('team_badge', 'about_page.team_badge', 'Badge'),
                self::field('team_title', 'about_page.team_title', 'Title'),
                self::field('about_team', 'about_team', 'Team members (JSON)', 'json'),
            ]),
            self::group('faq', 'FAQ Section', 'FAQ headings, CTA, and questions.', [
                self::field('faq_badge', 'about_page.faq_badge', 'Badge'),
                self::field('faq_title', 'about_page.faq_title', 'Title'),
                self::field('faq_cta_title', 'about_page.faq_cta_title', 'CTA title'),
                self::field('faq_cta_text', 'about_page.faq_cta_text', 'CTA text', 'textarea'),
                self::field('faq_cta_button', 'about_page.faq_cta_button', 'CTA button'),
                self::field('about_faqs', 'about_faqs', 'FAQs (JSON)', 'json'),
            ]),
            self::group('cta', 'Bottom CTA', 'Final call-to-action backgrounds.', [
                self::field('cta_badge', 'about_page.cta_badge', 'Badge'),
                self::field('cta_title', 'about_page.cta_title', 'Title'),
                self::field('cta_button', 'about_page.cta_button', 'Button label'),
                self::field('cta_bg_primary', 'about_page.cta_bg_primary', 'Background image 1', 'image'),
                self::field('cta_bg_secondary', 'about_page.cta_bg_secondary', 'Background image 2', 'image'),
            ]),
        ];
    }

    private static function servicesGroups(): array
    {
        return [
            self::group('hero', 'Page Hero', 'Services listing intro.', [
                self::field('badge', 'services_page.badge', 'Badge'),
                self::field('title', 'services_page.title', 'Title'),
                self::field('subtitle', 'services_page.subtitle', 'Subtitle', 'textarea'),
            ]),
            self::group('detail-labels', 'Service Detail Labels', 'Shared labels on service detail pages.', [
                self::field('detail_back_label', 'service_detail_page.back_label', 'Back link label'),
                self::field('detail_cta_title', 'service_detail_page.cta_title', 'CTA title'),
                self::field('detail_cta_title_em', 'service_detail_page.cta_title_em', 'CTA title emphasis'),
                self::field('detail_cta_subtitle', 'service_detail_page.cta_subtitle', 'CTA subtitle', 'textarea'),
                self::field('detail_cta_button', 'service_detail_page.cta_button', 'CTA button'),
                self::field('detail_cta_image', 'service_detail_page.cta_image', 'CTA image', 'image'),
            ]),
            self::group('service-details', 'Service Detail Content', 'Per-service images and features (JSON).', [
                self::field('service_details', 'service_details', 'Service details (JSON)', 'json'),
            ]),
        ];
    }

    private static function contactGroups(): array
    {
        return [
            self::group('hero', 'Hero Section', 'Contact page banner.', [
                self::field('hero_badge', 'contact.hero_badge', 'Badge'),
                self::field('hero_title', 'contact.hero_title', 'Title'),
                self::field('hero_image', 'contact.hero_image', 'Hero image', 'image'),
            ]),
            self::group('form', 'Contact Form', 'Form image and copy.', [
                self::field('form_image', 'contact.form_image', 'Form side image', 'image'),
                self::field('form_title', 'contact.form_title', 'Form title'),
                self::field('form_text', 'contact.form_text', 'Form description', 'textarea'),
                self::field('submit_label', 'contact.submit_label', 'Submit button'),
            ]),
            self::group('cards', 'Contact Cards', 'Email and phone cards (JSON).', [
                self::field('cards', 'contact.cards', 'Contact cards (JSON)', 'json'),
            ]),
            self::group('faq', 'FAQ Section', 'FAQ block headings.', [
                self::field('faq_badge', 'contact.faq_badge', 'Badge'),
                self::field('faq_title', 'contact.faq_title', 'Title'),
                self::field('home_faqs', 'home_faqs', 'FAQs (JSON)', 'json'),
            ]),
            self::group('cta', 'Bottom CTA', 'Final contact call-to-action.', [
                self::field('cta_badge', 'contact.cta_badge', 'Badge'),
                self::field('cta_title', 'contact.cta_title', 'Title'),
                self::field('cta_text', 'contact.cta_text', 'Description', 'textarea'),
                self::field('cta_button', 'contact.cta_button', 'Button label'),
            ]),
        ];
    }

    private static function quoteGroups(): array
    {
        return [
            self::group('intro', 'Page Intro', 'Quote page title and introduction.', [
                self::field('title', 'quote_page.title', 'Page title'),
                self::field('intro', 'quote_page.intro', 'Introduction', 'textarea'),
            ]),
            self::group('steps', 'Wizard Steps', 'Multi-step form labels.', [
                self::field('step_contact', 'quote_page.step_contact', 'Step 1 label'),
                self::field('step_service', 'quote_page.step_service', 'Step 2 label'),
                self::field('step_review', 'quote_page.step_review', 'Step 3 label'),
                self::field('submit_label', 'quote_page.submit_label', 'Submit button'),
            ]),
            self::group('thanks', 'Thank You Message', 'Shown after submission.', [
                self::field('thanks_title', 'quote_page.thanks_title', 'Title'),
                self::field('thanks_text', 'quote_page.thanks_text', 'Message', 'textarea'),
            ]),
            self::group('legal', 'SMS Disclosure', 'Phone opt-in legal text.', [
                self::field('sms_disclosure', 'quote_page.sms_disclosure', 'Disclosure text', 'textarea'),
            ]),
        ];
    }

    private static function footerGroups(): array
    {
        return [
            self::group('cta', 'Footer CTA', 'Large footer call-to-action.', [
                self::field('brand_short', 'footer.brand_short', 'Brand short name'),
                self::field('cta_badge', 'footer.cta_badge', 'Badge'),
                self::field('cta_title', 'footer.cta_title', 'Title'),
                self::field('cta_button', 'footer.cta_button', 'Button label'),
                self::field('cta_href', 'footer.cta_href', 'Button URL'),
            ]),
            self::group('labels', 'Section Labels', 'Footer column headings.', [
                self::field('newsletter_label', 'footer.newsletter_label', 'Newsletter label'),
                self::field('newsletter_placeholder', 'footer.newsletter_placeholder', 'Newsletter placeholder'),
                self::field('main_pages_label', 'footer.main_pages_label', 'Main pages label'),
                self::field('more_pages_label', 'footer.more_pages_label', 'More pages label'),
                self::field('services_label', 'footer.services_label', 'Services label'),
                self::field('contact_label', 'footer.contact_label', 'Contact label'),
            ]),
            self::group('background', 'Background Images', 'Footer decorative backgrounds.', [
                self::field('cta_bg_primary', 'footer.cta_bg_primary', 'Background image 1', 'image'),
                self::field('cta_bg_secondary', 'footer.cta_bg_secondary', 'Background image 2', 'image'),
            ]),
            self::group('links', 'Footer Links', 'Footer link groups (JSON).', [
                self::field('footer_main_links', 'footer_main_links', 'Main links (JSON)', 'json'),
                self::field('footer_more_links', 'footer_more_links', 'More links (JSON)', 'json'),
                self::field('footer_contact_links', 'footer_contact_links', 'Contact links (JSON)', 'json'),
            ]),
        ];
    }
}
