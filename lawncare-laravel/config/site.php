<?php

$cdn = 'https://d13cw1lxlociqy.cloudfront.net';
$harmone = '/assets/harmone/images';
$leapfly = '/assets/leapfly/images';
$greenly = '/assets/greenly/images';

return [
    'site' => [
        'name' => 'Lawn Care and Snow Removal Experts',
        'tagline' => 'ALL SEASONS, ONE CREW.',
        'description' => 'Lawn Care and Snow Removal Experts offers year-round lawn care and snow removal services in Spruce Grove, Alberta. We provide efficient, professional snow plowing, ice melt application, fall cleanup, and lawn maintenance for residential and commercial properties.',
        'url' => 'https://lawncareandsnowremovalexperts.com',
        'phone' => '(587) 879-5296',
        'phone_href' => 'tel:+15878795296',
        'email' => 'lawncareandsnowremovalexperts@gmail.com',
        'client_login' => 'https://clienthub.getjobber.com/client_hubs/edb6c02e-ba68-43b7-a255-ff4f0a73c524/login/new?source=share_login',
        'quote_url' => '/get-quote',
        'quote_label' => 'Get Quote',
        'address' => [
            'line1' => 'PO Box 3683 Po Main 360 Saskatchewan Ave',
            'city' => 'Spruce Grove',
            'region' => 'Alberta',
            'postal_code' => 'T7X 3A9',
        ],
        'logo' => '/assets/site/logo-header.png',
        'hero_video' => 'https://framerusercontent.com/assets/BbBrpYmkGRxDlha1JE84gb3ri0.mp4',
        'hero_image' => "{$cdn}/h3h6bqgb3739myylkbjh0rbm3yjj",
        'why_us_image' => '/assets/site/why-us-lawn-mower.png?v=whyus2026b',
        'cta_image' => "{$cdn}/epx4owlg1s9ypo0cqnmz1lde0u87",
        'promise_image' => "{$cdn}/ayylkpoa4i1f13zj8lduror8y6aw",
        'process_video' => 'https://framerusercontent.com/assets/MdOrsoktbl13lzdTePdGnGBVZDk.mp4',
        'process_side_image' => "{$harmone}/tfZ57gTKoyUYhYJGGuFrAnhOo83b2.png",
    ],

    'nav_links' => [
        ['href' => '/', 'label' => 'Home'],
        ['href' => '/about', 'label' => 'About'],
        ['href' => '/blogs', 'label' => 'Blogs'],
        ['href' => '/contact', 'label' => 'Contact'],
    ],

    'service_links' => [
        ['href' => '/services/snow-removal-services', 'label' => 'Snow Removal Services'],
        ['href' => '/services/lawn-care-and-maintenance', 'label' => 'Lawn Care and Maintenance'],
        ['href' => '/services/spring-fall-clean-up', 'label' => 'Spring & Fall Clean-Up'],
        ['href' => '/services/property-cleanup-and-maintenance', 'label' => 'Property Clean-Up & Hauling'],
    ],

    'page_links' => [
        ['href' => '#faqs', 'label' => 'FAQ'],
        ['href' => '/contact', 'label' => 'Contact'],
        ['href' => '/about', 'label' => 'About'],
    ],

    'home' => [
        'hero_subtitle' => 'Keep your property looking its best in every season with reliable, professional service you can count on.',
        'hero_cta' => 'Schedule Your Service Today',
        'why_us_badge' => 'Why Us',
        'why_us_title' => 'Why Choose Us',
        'services_badge' => 'Our Services',
        'services_title' => 'What We Offer',
        'mid_cta_title' => 'Keep Your Property Safe Year-Round',
        'mid_cta_text' => 'Ready to keep your property safe, beautiful, and stress-free all year long? Contact us today for a free quote!',
        'mid_cta_button' => 'Get a Quote Today',
        'areas_badge' => 'Where We Serve',
        'areas_title' => 'Serving Spruce Grove and Surrounding Alberta Communities',
        'areas_cta' => 'Schedule Your Lawn Care',
        'promise_title' => 'Our Promise',
        'about_badge' => 'Who We Are',
        'about_title' => 'From Lawn Care to Snow Removal, We Keep Your Property Safe, Beautiful, and Well-Maintained Through Every Season.',
        'about_stat' => '8+',
        'about_stat_label' => 'Communities Served Across Alberta',
        'about_trust_line' => 'Serving Spruce Grove and surrounding Alberta communities',
        'faqs_badge' => 'FAQs',
        'faqs_title' => 'FAQs',
        'faqs_subtitle' => "Common Questions for Your Property's Needs",
        'quote_title' => 'Get Your Service Quote Today!',
        'quote_text' => "Tell us about your property and we'll follow up with a clear quote.",
        'projects_badge' => 'Our Work',
        'projects_title' => 'Year-Round Property Care in Action',
        'testimonials_badge' => 'Clients Testimonials',
        'testimonials_title' => 'Landscapes That Leave Impressions',
        'client_stories_badge' => 'Client Stories',
        'client_stories_title' => 'What Homeowners Say',
        'process_badge' => 'Our Process',
        'process_title' => 'Simple Steps From Quote to Year-Round Care',
        'blogs_badge' => 'Our Blogs',
        'blogs_cta' => 'View All Blogs',
    ],

    'services_page' => [
        'badge' => 'What We Do',
        'title' => 'Outdoor Spaces, Done Right.',
        'subtitle' => 'From routine lawn care to winter snow removal, we create and maintain outdoor spaces built around your property and every season.',
    ],

    'service_detail_page' => [
        'back_label' => 'Back to Home',
        'cta_title' => 'Transform Your Property',
        'cta_title_em' => 'With Experts',
        'cta_subtitle' => 'Relax and enjoy a safer, healthier property—expertly maintained to match your needs in Spruce Grove and surrounding areas.',
        'cta_button' => 'Get A Free Quote',
        'cta_image' => 'https://framerusercontent.com/images/J8E2LdpN3pGmtT3FDmNG5kO5cc818c4.png',
    ],

    'service_details' => [
        'snow-removal-services' => [
            'intro_heading' => 'Reliable snow removal for Spruce Grove homeowners who need safe, accessible driveways and walkways all winter long.',
            'hero_image' => '/assets/services/snow-removal/snow-removal-card.jpg?v=snow2026d',
            'video' => null,
            'detail_offerings' => [
                [
                    'title' => 'Driveway Clearing',
                    'body' => 'We clear snow from residential driveways after every storm so you can leave and return home safely. Our crew removes packed snow and restores full vehicle access quickly.',
                    'image' => '/assets/services/snow-removal/driveway-clearing.jpg?v=snow2026d',
                ],
                [
                    'title' => 'Walkway & Sidewalk Clearing',
                    'body' => 'Front steps, sidewalks, and side entrances are cleared with care to keep daily foot traffic safe. We focus on the paths your family uses most.',
                    'image' => '/assets/services/snow-removal/walkway-sidewalk-clearing.jpg?v=snow2026f',
                ],
                [
                    'title' => 'Manual Ice Chipping',
                    'body' => 'When ice builds up on steps, landings, or walkways, we manually chip and remove it to reduce slip hazards that snow clearing alone cannot fix.',
                    'image' => '/assets/services/snow-removal/manual-ice-chipping.jpg?v=snow2026f',
                ],
                [
                    'title' => 'Walkway Safety Maintenance',
                    'body' => 'We monitor high-traffic areas throughout the winter and maintain safe access with follow-up clearing, ice treatment, and attention to detail after each snowfall.',
                    'image' => '/assets/services/snow-removal/walkway-safety-maintenance.jpg?v=snow2026f',
                ],
            ],
            'detail_features' => [
                ['title' => 'Ice Melt Application', 'body' => 'Targeted ice melt helps reduce slippery surfaces on steps, walkways, and high-traffic areas around your home.', 'image' => '/assets/services/snow-removal/ice-melt-application.jpg?v=snow2026f'],
                ['title' => 'Prompt Storm Response', 'body' => 'Our crew responds after snowfall events to restore access quickly and keep your property functional.', 'image' => '/assets/services/snow-removal/prompt-storm-response.jpg?v=snow2026d'],
                ['title' => 'Residential Snow Service', 'body' => 'We focus on residential properties across Spruce Grove, Edmonton, Stony Plain, and nearby communities.', 'image' => '/assets/services/snow-removal/residential-snow-service.jpg?v=snow2026d'],
            ],
        ],
        'lawn-care-and-maintenance' => [
            'intro_heading' => 'Professional lawn services designed to keep your property healthy, clean, and well maintained throughout the growing season.',
            'hero_image' => '/assets/services/lawn-care/lawn-care-card.jpg?v=lawn2026e',
            'video' => null,
            'offerings_lead' => 'Our lawn care program covers the essential services your yard needs to stay lush, green, and well groomed from spring through fall.',
            'detail_offerings' => [
                [
                    'title' => 'Lawn Mowing and Trimming',
                    'body' => 'Regular mowing at the proper height, with trimming around beds, fences, and obstacles for a clean, finished look every visit.',
                    'image' => '/assets/services/lawn-care/lawn-mowing-trimming.jpg?v=lawn2026e',
                ],
                [
                    'title' => 'Lawn Edging',
                    'body' => 'Crisp edging along sidewalks, driveways, and landscape borders gives your lawn a polished, professionally maintained appearance.',
                    'image' => '/assets/services/lawn-care/lawn-edging.jpg?v=lawn2026e',
                ],
                [
                    'title' => 'Fertilizer Application',
                    'body' => 'Seasonal fertilizer treatments nourish your turf and support strong, healthy growth throughout the growing season.',
                    'image' => '/assets/services/lawn-care/fertilizer-application.jpg?v=lawn2026e',
                ],
                [
                    'title' => 'Aeration',
                    'body' => 'Core aeration reduces soil compaction and improves water, air, and nutrient flow to grass roots for a healthier lawn.',
                    'image' => '/assets/services/lawn-care/aeration.jpg?v=lawn2026f',
                ],
                [
                    'title' => 'Power Raking',
                    'body' => 'Power raking removes dead thatch buildup so your lawn can breathe and green up more effectively each spring.',
                    'image' => '/assets/services/lawn-care/power-raking.jpg?v=lawn2026f',
                ],
                [
                    'title' => 'Overseeding',
                    'body' => 'Overseeding fills thin or bare areas with fresh grass seed to create a thicker, more resilient lawn over time.',
                    'image' => '/assets/services/lawn-care/overseeding.jpg?v=lawn2026f',
                ],
                [
                    'title' => 'Lawn Patch Restoration',
                    'body' => 'Targeted patch repair restores damaged or worn sections of turf back to a healthy, even surface you can enjoy.',
                    'image' => '/assets/services/lawn-care/lawn-patch-restoration.jpg?v=lawn2026f',
                ],
            ],
            'detail_features' => [],
        ],
        'property-cleanup-and-maintenance' => [
            'intro_heading' => 'Property clean-up and hauling that restores order to your yard and protects your landscape investment.',
            'hero_image' => '/assets/services/property-cleanup/property-cleanup-card.jpg?v=cleanup2026g',
            'video' => null,
            'offerings_lead' => 'From seasonal yard clean-ups to full property clear-outs, we handle the heavy work so your outdoor spaces stay tidy and usable.',
            'detail_offerings' => [
                [
                    'title' => 'Yard Clean-Up',
                    'body' => 'Thorough yard clean-up removes leaves, branches, clippings, and seasonal buildup from lawns, beds, and walkways.',
                    'image' => '/assets/services/property-cleanup/yard-clean-up.jpg?v=cleanup2026g',
                ],
                [
                    'title' => 'Property Debris Removal',
                    'body' => 'We haul away accumulated yard debris and outdoor waste so your property stays clear, safe, and ready to enjoy.',
                    'image' => '/assets/services/property-cleanup/property-debris-removal.jpg?v=cleanup2026g',
                ],
                [
                    'title' => 'Estate and Bulk Item Removal',
                    'body' => 'Large or bulky items are removed efficiently with the equipment and crew needed to handle heavier residential clean-ups.',
                    'image' => '/assets/services/property-cleanup/estate-bulk-item-removal.jpg?v=cleanup2026g',
                ],
                [
                    'title' => 'Property Clear-Out Services',
                    'body' => 'Full property clear-outs restore order to cluttered yards, garages, and outdoor areas with complete removal and tidy results.',
                    'image' => '/assets/services/property-cleanup/property-clear-out.jpg?v=cleanup2026g',
                ],
                [
                    'title' => 'Site Clean-Up and Disposal',
                    'body' => 'We finish every job with responsible disposal and a clean site, leaving your property organized and ready for the next season.',
                    'image' => '/assets/services/property-cleanup/site-cleanup-disposal.jpg?v=cleanup2026g',
                ],
            ],
            'detail_features' => [],
        ],
        'spring-fall-clean-up' => [
            'intro_heading' => 'Seasonal yard maintenance that prepares your property for changing weather and keeps your landscape looking its best.',
            'hero_image' => '/assets/services/spring-fall-clean-up/spring-fall-cleanup-card.jpg?v=seasonal2026f',
            'video' => null,
            'offerings_lead' => 'Spring and fall clean-ups that refresh your yard, clear debris, and prepare your landscape for the season ahead.',
            'detail_offerings' => [
                [
                    'title' => 'Leaf Removal',
                    'body' => 'Fall leaf cleanup keeps lawns healthy and prevents smothering, mold, and slippery surfaces.',
                    'image' => '/assets/services/spring-fall-clean-up/leaf-removal.jpg?v=seasonal2026f',
                ],
                [
                    'title' => 'Yard Debris Removal',
                    'body' => 'We clear sticks, branches, and accumulated debris from beds, lawns, and walkways.',
                    'image' => '/assets/services/spring-fall-clean-up/yard-debris-removal.jpg?v=seasonal2026f',
                ],
                [
                    'title' => 'Bed and Hedge Blowouts',
                    'body' => 'Landscape beds and hedges are cleaned out so plants can breathe and grow properly.',
                    'image' => '/assets/services/spring-fall-clean-up/bed-hedge-blowouts.jpg?v=seasonal2026f',
                ],
                [
                    'title' => 'Light Tree Pruning',
                    'body' => 'Targeted pruning removes dead or overgrown branches to improve shape and safety.',
                    'image' => '/assets/services/spring-fall-clean-up/light-tree-pruning.jpg?v=seasonal2026f',
                ],
                [
                    'title' => 'Garden and Landscape Clean-Up',
                    'body' => 'Garden areas are refreshed with careful cleanup that respects your existing plantings.',
                    'image' => '/assets/services/spring-fall-clean-up/garden-landscape-cleanup.jpg?v=seasonal2026f',
                ],
                [
                    'title' => 'Seasonal Yard Preparation',
                    'body' => 'Spring and fall visits set your property up for the season ahead—whether growth or dormancy.',
                    'image' => '/assets/services/spring-fall-clean-up/seasonal-yard-preparation.jpg?v=seasonal2026f',
                ],
            ],
            'detail_features' => [],
        ],
    ],

    'why_us' => [
        ['title' => 'Experienced Team', 'text' => 'Skilled professionals with years of experience in lawn care, property maintenance, and snow removal.'],
        ['title' => 'Year-Round Service', 'text' => 'One dependable team handles your property\'s seasonal needs from spring through winter.'],
        ['title' => 'Reliable and Professional', 'text' => 'We arrive on time, complete every job thoroughly, and pay attention to the details.'],
        ['title' => 'Customized Solutions', 'text' => 'Every service plan is tailored to your property, priorities, and maintenance needs.'],
    ],

    'home_services' => [
        [
            'slug' => 'snow-removal-services',
            'title' => 'Snow Removal Services',
            'short' => 'Comprehensive snow maintenance and ice melt solutions to keep your property safe this winter.',
            'features' => ['Driveway and walkway clearing', 'Ice melt application', 'Reliable seasonal contracts'],
            'href' => '/services/snow-removal-services',
            'image' => '/assets/services/snow-removal/snow-removal-card.jpg?v=snow2026d',
            'coming_soon' => false,
            'reverse' => false,
            'icon' => 'snow',
        ],
        [
            'slug' => 'lawn-care-and-maintenance',
            'title' => 'Lawn Care and Maintenance',
            'short' => 'Seasonal lawn care including fertilization, manual weed control, and one-time mowing services.',
            'features' => ['Fertilization and weed control', 'Mowing, edging, and trimming', 'Healthy lawns year-round'],
            'href' => '/services/lawn-care-and-maintenance',
            'image' => '/assets/services/lawn-care/lawn-care-card.jpg?v=lawn2026e',
            'coming_soon' => false,
            'reverse' => true,
            'icon' => 'lawn',
        ],
        [
            'slug' => 'junk-removal',
            'title' => 'COMING SOON - Junk Removal',
            'short' => 'Reclaim your space with our professional junk removal services. We handle the heavy lifting and responsible disposal of unwanted items, making cleanup easy and stress-free.',
            'features' => ['Full-service junk removal', 'Responsible disposal', 'Stress-free cleanup'],
            'href' => null,
            'image' => "{$cdn}/jkdbrhz3dra5d6i1csy89shl7p67",
            'coming_soon' => true,
            'reverse' => false,
            'icon' => 'junk',
        ],
        [
            'slug' => 'property-cleanup-and-maintenance',
            'title' => 'Property Clean-Up & Hauling',
            'short' => 'Property cleanup and maintenance services to maintain your property\'s beauty year-round.',
            'features' => ['Fall and spring cleanups', 'Year-round maintenance', 'Protect your landscape investment'],
            'href' => '/services/property-cleanup-and-maintenance',
            'image' => '/assets/services/property-cleanup/property-cleanup-card.jpg?v=cleanup2026g',
            'coming_soon' => false,
            'reverse' => true,
            'icon' => 'cleanup',
        ],
        [
            'slug' => 'spring-fall-clean-up',
            'title' => 'Spring & Fall Clean-Up',
            'short' => 'Seasonal yard maintenance that prepares your property for changing weather and keeps your landscape looking its best.',
            'features' => [
                'Leaf removal',
                'Yard debris removal',
                'Bed and hedge blowouts',
                'Light tree pruning',
                'Garden and landscape clean-up',
                'Seasonal yard preparation',
            ],
            'href' => '/services/spring-fall-clean-up',
            'image' => '/assets/services/spring-fall-clean-up/spring-fall-cleanup-card.jpg?v=seasonal2026f',
            'coming_soon' => false,
            'reverse' => false,
            'icon' => 'cleanup',
        ],
    ],

    'service_areas' => ['Spruce Grove', 'Edmonton', 'St. Albert', 'Stony Plain', 'Leduc', 'Acheson', 'Beaumont', 'Sherwood Park'],

    'service_area_coordinates' => [
        ['name' => 'Spruce Grove', 'lat' => 53.545, 'lng' => -113.901],
        ['name' => 'Edmonton', 'lat' => 53.546, 'lng' => -113.494],
        ['name' => 'St. Albert', 'lat' => 53.630, 'lng' => -113.626],
        ['name' => 'Stony Plain', 'lat' => 53.526, 'lng' => -114.007],
        ['name' => 'Leduc', 'lat' => 53.259, 'lng' => -113.549],
        ['name' => 'Acheson', 'lat' => 53.560, 'lng' => -113.765],
        ['name' => 'Beaumont', 'lat' => 53.358, 'lng' => -113.415],
        ['name' => 'Sherwood Park', 'lat' => 53.517, 'lng' => -113.319],
    ],

    'promise_text' => 'At Lawn Care and Snow Removal Experts, we provide all-season property care with one dedicated crew. From spring and summer lawn maintenance to fall cleanups and winter snow removal, we handle it all. Our team is committed to reliability, efficiency, and expert service, ensuring every property we care for is safe, beautiful, and well-maintained. We serve residential clients, delivering tailored solutions that fit your needs and keep your property looking its best year-round. One crew. Every season. Experts you can trust.',

    'home_faqs' => [
        ['question' => 'Do you offer snow removal services for both residential and commercial?', 'answer' => 'We provide lawn care and summer property maintenance services for both residential and commercial clients. Currently, our snow removal services are available exclusively for residential properties.'],
        ['question' => 'What lawn care services do you provide during the warmer months?', 'answer' => 'Our lawn care services include fertilization, manual weed control, lawn maintenance, and seasonal maintenance to keep your lawn healthy and attractive. We provide these services for both residential and commercial properties.'],
        ['question' => 'Can I schedule seasonal snow removal contracts?', 'answer' => 'Yes, we offer seasonal snow removal contracts for residential properties to ensure your home stays safe and accessible throughout the winter months with no hassle.'],
        ['question' => 'What services do you offer?', 'answer' => 'We provide lawn care and summer property maintenance for residential and commercial clients, including mowing, fertilizing, aeration, fall cleanups, edging, and seasonal maintenance. Snow removal — including snow blowing, shoveling, and ice control — is available for residential properties only. Junk removal is coming soon.'],
        ['question' => 'Are you available year-round?', 'answer' => 'Yes! We provide all-season lawn care and property maintenance for residential and commercial clients, plus residential snow removal, keeping your property maintained and safe from spring through winter.'],
    ],

    'process_steps' => [
        [
            'number' => '001',
            'title' => 'Receive a Quote',
            'text' => 'We provide a detailed estimate based on our inspection findings.',
            'image' => "{$greenly}/fRlBp2rgkdUxaqEsVKVfHm9EjV0ee3b.png",
        ],
        [
            'number' => '002',
            'title' => 'Schedule the Service',
            'text' => 'Choose a convenient date and time for the service to be performed.',
            'image' => "{$greenly}/iT4hsPMr0H4lXPwO1yEATT2W4K0b07d.png",
        ],
        [
            'number' => '003',
            'title' => 'Service Completion',
            'text' => 'Our team carries out the service with professionalism and care.',
            'image' => "{$greenly}/tocwLtO1YySV9jJpG2DJoiiUXkb07d.png",
        ],
        [
            'number' => '004',
            'title' => 'Follow-Up Support',
            'text' => 'We offer after-service support to ensure you\'re happy with the results.',
            'image' => "{$greenly}/wMU2iRxtpQDkOfxuUucFEcXInuIb07d.png",
        ],
    ],

    'projects' => [
        ['title' => 'Winter Snow Removal', 'text' => 'Driveways, walkways, and entrances cleared promptly so your property stays safe all season.', 'image' => '/assets/services/snow-removal/driveway-clearing.jpg?v=snow2026d'],
        ['title' => 'Seasonal Lawn Care', 'text' => 'Mowing, edging, and maintenance that keep your lawn healthy and looking its best.', 'image' => '/assets/services/lawn-care/lawn-mowing-trimming.jpg?v=lawn2026e'],
        ['title' => 'Property Cleanup', 'text' => 'Fall cleanups and year-round maintenance to protect your landscape investment.', 'image' => '/assets/services/property-cleanup/yard-clean-up.png?v=projects2026'],
    ],

    'testimonials' => [
        [
            'quote' => 'Lawn Care and Snow Removal Experts completely transformed how our property looks through every season. The team was professional, attentive, and every detail exceeded our expectations. We couldn\'t be happier with the results and outstanding service.',
            'name' => 'Emma Richardson',
            'role' => 'Homeowner, Spruce Grove',
            'avatar' => "{$harmone}/qw9m0Dx5iJwgFoHfQyqIqGi8jmE94c6.png",
            'variant' => 'light',
        ],
        [
            'quote' => 'From the first consultation to every seasonal visit, everything was handled with exceptional care. Our property looks stunning year-round, and we\'ve received countless compliments from friends, neighbors, and visiting family alike.',
            'name' => 'Olivia Walker',
            'role' => 'Homeowner, Stony Plain',
            'variant' => 'dark',
        ],
        [
            'quote' => 'Their snow removal is always prompt after every storm, and our lawn has never looked better in the summer. One crew handles everything, and they are reliable, friendly, and easy to work with all year long.',
            'name' => 'James Carter',
            'role' => 'Homeowner, Edmonton',
            'avatar' => "{$harmone}/Kh3OntkbMrblFHELEfarYpmAASsb01f.png",
            'variant' => 'light',
        ],
    ],

    'testimonials_feature_image' => "{$harmone}/3d21XnfoPR8jrMIKINIdEXte09f6d.png",
    'testimonials_leaf_image' => "{$harmone}/8BJXl69b1DAudWHnrwXTxLbm8A4e1c.png",

    'client_stories' => [
        [
            'quote' => 'Our yard looks completely different now. The team was professional, on time, and the final result exceeded what we expected.',
            'name' => 'William Taylor',
            'before' => "{$leapfly}/laI3TD82M3nNsQk0yFyCZMB7ZMU40a7.png",
            'after' => "{$leapfly}/dMQKdsyrcB1ory3sXKtWmXpyMo40a7.png",
        ],
        [
            'quote' => 'From the first consultation to the final cleanup, everything was easy, organized, and handled with real attention to detail.',
            'name' => 'Ava Moore',
            'before' => "{$leapfly}/hg09L6JYKr0mrcckQlFMrhQLAg40a7.png",
            'after' => "{$leapfly}/E6WiwZf2jfPeP6CGmbCFQpkI8i440a7.png",
        ],
        [
            'quote' => 'They transformed our outdoor space beautifully and kept us informed throughout the entire project. We couldn\'t be happier.',
            'name' => 'John Carter',
            'before' => "{$leapfly}/JHdKAcPav4rpsyHGrwHqiPXkiJo40a7.png",
            'after' => "{$leapfly}/mwce0pVayWmcjfBjibCir8RQn840a7.png",
        ],
        [
            'quote' => 'Reliable service, quality workmanship, and a clean finish. Our lawn and garden have never looked this good.',
            'name' => 'Michael Brooks',
            'before' => "{$leapfly}/TePPDNFpPav7lwvfvCG5hP45bw40a7.png",
            'after' => "{$leapfly}/BeEA4seD41wLn1B5pnrqFyAKI8w40a7.png",
        ],
    ],

    'about_photos' => [
        "{$cdn}/4s6ub6cjcrzxtjtbn48kmnh1h16r",
        "{$cdn}/h3h6bqgb3739myylkbjh0rbm3yjj",
        "{$cdn}/85k140zf931idm3jubrt7hqx33ex",
        "{$cdn}/f5bh6dqidppknuqjc7pv0p8evpuy",
        "{$cdn}/epx4owlg1s9ypo0cqnmz1lde0u87",
    ],

    'keyword_tags' => ['Year-round service', 'Snow removal', 'Lawn care', 'Property cleanup'],

    'about_feature_image' => '/assets/site/snow-feature.png?v=snow2026',

    'about_avatar_stack' => [
        ['src' => "{$cdn}/4s6ub6cjcrzxtjtbn48kmnh1h16r", 'class' => 'avatar-1'],
        ['src' => "{$cdn}/h3h6bqgb3739myylkbjh0rbm3yjj", 'class' => 'avatar-2'],
        ['src' => "{$cdn}/85k140zf931idm3jubrt7hqx33ex", 'class' => 'avatar-3'],
        ['src' => "{$cdn}/epx4owlg1s9ypo0cqnmz1lde0u87", 'class' => 'avatar-5'],
    ],

    'client_avatars' => [
        'https://framerusercontent.com/images/AiMr2BLGLlJlp00bEYjUP4cF3BM.svg?width=60&height=60',
        'https://framerusercontent.com/images/Yz9qBnhHTg6GDtBTL3wKxNtBeqQ.svg?width=60&height=60',
        'https://framerusercontent.com/images/Np0HZklFtFUIPjkohW6I2Om13c.svg?width=60&height=60',
        'https://framerusercontent.com/images/Bd22UKu9tuLfnAZdsUJlqNNWpcg.svg?width=45&height=45',
    ],

    'section_icon' => 'https://framerusercontent.com/images/oorLYiyKAaXwcgfMhD8EkxR9ZT4.svg?width=24&height=24',
    'badge_icon' => 'https://framerusercontent.com/images/UJ2Jsj4CDcgmUz0qfixGQSZsp0s.svg?width=18&height=18',
    'blog_arrow_icon' => 'https://framerusercontent.com/images/zQHUjEo7Unequ5WSTnAnz8k58.svg?width=25&height=25',

    'about_page' => [
        'hero_title' => 'ALL SEASONS, ONE CREW.',
        'hero_image' => '/assets/site/about-hero-user.jpg?v=user2026',
        'founder_badge' => 'From Our Founder',
        'founder_quote' => 'We help homeowners keep their properties safe, beautiful, and well-maintained through every season with reliable lawn care, property cleanup, and snow removal.',
        'founder_name' => 'Lawn Care and Snow Removal Experts',
        'founder_role' => 'Spruce Grove, Alberta',
        'founder_image' => "{$harmone}/wpbsOhrM61kLwoUUMryh0ThmMh07995.png",
        'stats_badge' => 'Our Stats',
        'stats_title' => 'Numbers That Reflect Our Passion',
        'stats_cta' => 'Get Quote',
        'stats_cta_href' => '/get-quote',
        'stats_decor' => "{$harmone}/HjFE0k09aumATbaplUA1vVO2ZYa09e.png",
        'story_badge' => 'Our Story',
        'story_title' => 'Our Journey Is Rooted in Quality, Reliability, and a Passion for Year-Round Property Care',
        'story_image' => "{$harmone}/aV5lvl3cgprTGJ3Z6r2YH2Rj0EQ7835.png",
        'story_cta' => 'Get Quote',
        'team_badge' => 'Our Team Section',
        'team_title' => 'Experts Who Bring Ideas to Life',
        'faq_badge' => 'Frequently Asked Question',
        'faq_title' => 'What Clients Often Ask',
        'faq_cta_title' => 'Not Sure Where to Start?',
        'faq_cta_text' => 'We\'re here to guide you through every step, from your first idea to a beautifully maintained property.',
        'faq_cta_button' => 'Contact Us',
        'cta_badge' => 'Get Started',
        'cta_title' => 'Let\'s Create Your Dream Landscape',
        'cta_button' => 'Contact Us Today',
        'cta_bg_primary' => "{$harmone}/eV8qujmBooDc26rEtIpX1m2G5M7278.png",
        'cta_bg_secondary' => "{$harmone}/cEzebRWPX0YtfvMYFXdKbKptCIs7278.png",
    ],

    'about_stats' => [
        ['value' => '500+', 'label' => 'Properties Served', 'text' => 'Delivering dependable lawn care, cleanup, and snow removal with thoughtful planning and expert service.'],
        ['value' => '15+', 'label' => 'Years Experience', 'text' => 'Providing trusted property care expertise and keeping outdoor spaces safe and beautiful through every season.'],
        ['value' => '1200+', 'label' => 'Happy Clients', 'text' => 'Earning the trust of homeowners through exceptional service, reliable care, and consistent results.'],
        ['value' => '98%', 'label' => 'Client Satisfaction', 'text' => 'Consistently exceeding expectations with personalized solutions and a commitment to quality.'],
    ],

    'about_timeline' => [
        ['year' => '2012', 'icon' => 'founding', 'title' => 'Where It All Began', 'text' => 'Our team was founded with a vision to provide reliable, all-season property care for Alberta homeowners.'],
        ['year' => '2017', 'icon' => 'growth', 'title' => 'Growing Together', 'text' => 'Expanded our services and team to deliver exceptional lawn care and snow removal across the region.'],
        ['year' => '2024', 'icon' => 'future', 'title' => 'Shaping the Future', 'text' => 'Continuing to serve Spruce Grove and surrounding communities with one dedicated crew for every season.'],
    ],

    'about_team' => [
        ['name' => 'James Bennett', 'role' => 'Operations Manager', 'image' => "{$harmone}/lS8fSGre6IIYCWjeIBff95bmA6a6e.png"],
        ['name' => 'Emma Collins', 'role' => 'Lawn Care Specialist', 'image' => "{$harmone}/Kh3OntkbMrblFHELEfarYpmAASsb01f.png"],
        ['name' => 'Oliver Hughes', 'role' => 'Snow Removal Lead', 'image' => "{$harmone}/uSCd3VV3VTgbCYDbL9KPzpXZTo0b01f.png"],
    ],

    'about_faqs' => [
        ['question' => 'Do you offer snow removal services for both residential and commercial?', 'answer' => 'We provide lawn care and summer property maintenance services for both residential and commercial clients. Currently, our snow removal services are available exclusively for residential properties.'],
        ['question' => 'What services do you offer?', 'answer' => 'We provide lawn care and summer property maintenance for residential and commercial clients, including mowing, fertilizing, aeration, fall cleanups, edging, and seasonal maintenance. Snow removal — including snow blowing, shoveling, and ice control — is available for residential properties only. Junk removal is coming soon.'],
        ['question' => 'What lawn care services do you provide during the warmer months?', 'answer' => 'Our lawn care services include fertilization, manual weed control, lawn maintenance, and seasonal maintenance to keep your lawn healthy and attractive. We provide these services for both residential and commercial properties.'],
        ['question' => 'Can I schedule seasonal snow removal contracts?', 'answer' => 'Yes, we offer seasonal snow removal contracts for residential properties to ensure your home stays safe and accessible throughout the winter months with no hassle.'],
        ['question' => 'How do I request a consultation or quote?', 'answer' => 'You can request a quote through our website, call us at (587) 879-5296, or email our team. We will review your property needs and follow up with a clear estimate and next steps.'],
    ],

    'blogs_page' => [
        'badge' => 'Our Blogs',
        'title' => 'Lawn Care and Snow Removal Tips',
        'hero_image' => '/assets/site/blogs-hero-custom.jpg?v=bloghero2026c',
    ],

    'blog_posts' => [
        [
            'slug' => 'fall-cleanup-edmonton',
            'previous_slug' => 'fall-cleanup-edmonton-prepare-winter',
            'title' => 'Fall Cleanup in Edmonton: Prepare Your Lawn for Winter',
            'author' => 'Lawn Care and Snow Removal Experts',
            'date' => 'September 22, 2026',
            'image' => '/assets/services/spring-fall-clean-up/fall-cleanup-edmonton.jpg?v=fallblog2026k',
        ],
        [
            'slug' => 'fall-cleanup-dos-and-donts-edmonton',
            'title' => 'The Do\'s and Don\'ts of Fall Cleanup in Edmonton',
            'author' => 'Lawn Care and Snow Removal Experts',
            'date' => 'October 6, 2026',
            'image' => '/assets/services/spring-fall-clean-up/fall-cleanup-dos-donts-edmonton.jpg?v=fallblog2seo',
        ],
        [
            'slug' => 'spring-lawn-cleanup-guide',
            'title' => 'Your Spring Lawn Clean-Up Checklist for Edmonton\'s Short Growing Season',
            'author' => 'Lawn Care and Snow Removal Experts',
            'date' => 'March 18, 2025',
            'image' => "{$harmone}/DaESr6wYDxsifUf6z721LznHQeEffb3.png?v=blogtopics2026",
        ],
        [
            'slug' => 'pro-tips-regular-lawn-maintenance',
            'title' => '7 Pro Tips for a Healthier Lawn in Edmonton\'s Climate',
            'author' => 'Lawn Care and Snow Removal Experts',
            'date' => 'April 22, 2025',
            'image' => "{$harmone}/eW46cLJR4pk9p8HZgiCoj2s2cd51e.png?v=blogtopics2026",
        ],
        [
            'slug' => 'junk-removal-guide',
            'title' => 'Junk Removal in Edmonton: What to Know Before You Haul It Yourself',
            'author' => 'Lawn Care and Snow Removal Experts',
            'date' => 'May 30, 2025',
            'image' => "{$harmone}/LRaag5i2gBTSGKrdYZ48WjZnwDY5b18.png?v=blogtopics2026",
        ],
        [
            'slug' => 'fall-lawn-cleanup-guide',
            'title' => 'Fall Lawn Clean-Up in Edmonton: The Work That Pays Off Next Spring',
            'author' => 'Lawn Care and Snow Removal Experts',
            'date' => 'August 28, 2025',
            'image' => "{$harmone}/N3EH2aYxztDfWWLXB6YULO3bzpEd51e.png?v=blogtopics2026",
        ],
        [
            'slug' => 'snow-removal-guide',
            'title' => 'Snow Removal in Edmonton: What Actually Keeps Your Property Safe and Compliant',
            'author' => 'Lawn Care and Snow Removal Experts',
            'date' => 'October 8, 2025',
            'image' => "{$harmone}/kah8B3dDQ5Vowbe1nFgXhVA5Pw5c3e.png?v=blogtopics2026",
        ],
        [
            'slug' => 'ice-management-guide',
            'title' => 'Ice Management in Edmonton: Why It\'s a Different Job Than Snow Removal',
            'author' => 'Lawn Care and Snow Removal Experts',
            'date' => 'November 3, 2025',
            'image' => '/assets/services/snow-removal/ice-melt-application.jpg?v=icemgmt2026a',
        ],
    ],

    'quote_page' => [
        'title' => 'Get Your Quote',
        'intro' => 'Tell us about your property and the services you need. We will follow up with a clear quote for lawn care, cleanup, or snow removal.',
        'step_contact' => 'Contact information',
        'step_service' => 'Service details',
        'step_review' => 'Review & submit',
        'submit_label' => 'Submit quote request',
        'thanks_title' => 'Thanks — your quote request was sent.',
        'thanks_text' => 'A team member will follow up shortly. For faster service, call us directly.',
        'sms_disclosure' => 'By providing your phone number, you agree to receive transactional text messages about your service request from Lawn Care and Snow Removal Experts. Message frequency varies. Message and data rates may apply. Reply STOP to opt out of non-marketing texts.',
    ],

    'provinces' => [
        'AB' => 'Alberta',
        'BC' => 'British Columbia',
        'MB' => 'Manitoba',
        'NB' => 'New Brunswick',
        'NL' => 'Newfoundland and Labrador',
        'NS' => 'Nova Scotia',
        'NT' => 'Northwest Territories',
        'NU' => 'Nunavut',
        'ON' => 'Ontario',
        'PE' => 'Prince Edward Island',
        'QC' => 'Quebec',
        'SK' => 'Saskatchewan',
        'YT' => 'Yukon',
    ],

    'contact_badge_icon' => 'https://framerusercontent.com/images/UJ2Jsj4CDcgmUz0qfixGQSZsp0s.svg?width=18&height=18',

    'contact' => [
        'hero_badge' => 'Get In Touch',
        'hero_title' => "Let's Keep Your Property Safe Year-Round",
        'hero_image' => "{$harmone}/HjFE0k09aumATbaplUA1vVO2ZYa09e.png",
        'form_image' => '/assets/site/why-us-lawn-care.jpg?v=contact2026b',
        'form_title' => 'Get Your Service Quote Today!',
        'form_text' => 'Enter your name, email, phone number, and property location, choose a service, and tell us what you need. We will follow up with a clear quote for lawn care, cleanup, or snow removal.',
        'submit_label' => 'Get my quote',
        'faq_badge' => 'Frequently Asked Question',
        'faq_title' => 'What Clients Often Ask',
        'cta_badge' => 'Get Started',
        'cta_title' => 'Ready for Reliable Year-Round Property Care?',
        'cta_text' => 'Contact Lawn Care and Snow Removal Experts today for professional lawn care, seasonal cleanup, and snow removal in Spruce Grove and surrounding areas.',
        'cta_button' => 'Get a Quote Today',
        'cards' => [
            [
                'title' => 'Email Assistance',
                'text' => 'Connect with our team for lawn care advice, snow removal questions, seasonal contracts, or quote requests.',
                'icon' => 'https://framerusercontent.com/images/OlBsVKAKy3uJ7IiyRBo8yi0n7yo.svg?width=45&height=45',
                'items' => [
                    ['label' => 'General Inquiries', 'value' => 'lawncareandsnowremovalexperts@gmail.com', 'href' => 'mailto:lawncareandsnowremovalexperts@gmail.com'],
                    ['label' => 'Client Login', 'value' => 'Book & manage service online', 'href' => 'https://clienthub.getjobber.com/client_hubs/edb6c02e-ba68-43b7-a255-ff4f0a73c524/login/new?source=share_login'],
                ],
            ],
            [
                'title' => 'Call Our Team',
                'text' => 'Speak with our team for quick guidance, seasonal snow contracts, lawn care scheduling, or service support.',
                'icon' => 'https://framerusercontent.com/images/O8EySYm5Dtj6ls8HCVA12CEZDN8.svg?width=45&height=45',
                'items' => [
                    ['label' => 'Phone', 'value' => '(587) 879-5296', 'href' => 'tel:+15878795296'],
                    ['label' => 'Mailing Address', 'value' => 'PO Box 3683, Spruce Grove, AB T7X 3A9', 'href' => 'https://maps.google.com/?q=Spruce+Grove+Alberta'],
                ],
            ],
        ],
    ],

    'footer' => [
        'brand_short' => 'Experts Ltd.',
        'cta_badge' => 'Get Started',
        'cta_title' => "Let's Keep Your Property Safe Year-Round",
        'cta_button' => 'Contact Us Today',
        'cta_href' => '/contact',
        'newsletter_label' => 'Newsletter',
        'newsletter_placeholder' => 'Enter email address',
        'main_pages_label' => 'Main Pages',
        'more_pages_label' => 'More Pages',
        'services_label' => 'Services',
        'contact_label' => 'Contact',
        'cta_bg_primary' => "{$harmone}/eV8qujmBooDc26rEtIpX1m2G5M7278.png",
        'cta_bg_secondary' => "{$harmone}/cEzebRWPX0YtfvMYFXdKbKptCIs7278.png",
    ],

    'footer_main_links' => [
        ['href' => '/', 'label' => 'Home'],
        ['href' => '/about', 'label' => 'About'],
        ['href' => '/#services', 'label' => 'Services'],
        ['href' => '/contact', 'label' => 'Contact'],
    ],

    'footer_more_links' => [
        ['href' => '/blogs', 'label' => 'Blogs'],
        ['href' => '#faqs', 'label' => 'FAQ'],
        ['href' => '#areas', 'label' => 'Service Areas'],
        [
            'href' => 'https://clienthub.getjobber.com/client_hubs/edb6c02e-ba68-43b7-a255-ff4f0a73c524/login/new?source=share_login',
            'label' => 'Client Login',
            'external' => true,
        ],
    ],

    'footer_contact_links' => [
        ['href' => 'tel:+15878795296', 'label' => '(587) 879-5296'],
        ['href' => 'mailto:lawncareandsnowremovalexperts@gmail.com', 'label' => 'lawncareandsnowremovalexperts@gmail.com'],
        ['href' => '/get-quote', 'label' => 'Get a Quote'],
        [
            'href' => 'https://maps.google.com/?q=PO+Box+3683+Spruce+Grove+AB+T7X+3A9',
            'label' => 'PO Box 3683, Spruce Grove, AB T7X 3A9',
            'external' => true,
        ],
    ],

    'social_links' => [
        ['label' => 'Facebook', 'href' => '#', 'network' => 'facebook'],
        ['label' => 'Instagram', 'href' => '#', 'network' => 'instagram'],
        [
            'label' => 'Google Maps',
            'href' => 'https://maps.google.com/?q=PO+Box+3683+Spruce+Grove+AB+T7X+3A9',
            'network' => 'google',
            'external' => true,
        ],
    ],
];
