import type { SiteContent } from "@/lib/content-types";

const CDN = "https://d13cw1lxlociqy.cloudfront.net";

/** Default content used until an admin save creates content/site-content.json */
export const defaultSiteContent: SiteContent = {
  site: {
    name: "Lawn Care and Snow Removal Experts",
    shortName: "Lawn Care and Snow Removal Experts",
    tagline: "ALL SEASONS, ONE CREW.",
    description:
      "Lawn Care and Snow Removal Experts offers year-round lawn care and snow removal services in Spruce Grove, Alberta. We provide efficient, professional snow plowing, ice melt application, fall cleanup, and lawn maintenance for residential and commercial properties.",
    url: "https://lawncareandsnowremovalexperts.com",
    phone: "(587) 879-5296",
    phoneHref: "tel:+15878795296",
    email: "lawncareandsnowremovalexperts@gmail.com",
    clientLogin:
      "https://clienthub.getjobber.com/client_hubs/edb6c02e-ba68-43b7-a255-ff4f0a73c524/login/new?source=share_login",
    address: {
      line1: "PO Box 3683 Po Main 360 Saskatchewan Ave",
      city: "Spruce Grove",
      region: "Alberta",
      postalCode: "T7X 3A9",
      country: "CA",
    },
    logo: `${CDN}/72ivb81rb4njfskjy3ztlmqedsr7`,
    heroImage: `${CDN}/h3h6bqgb3739myylkbjh0rbm3yjj`,
    whyUsImage: `${CDN}/4s6ub6cjcrzxtjtbn48kmnh1h16r`,
    ctaImage: `${CDN}/epx4owlg1s9ypo0cqnmz1lde0u87`,
    promiseImage: `${CDN}/ayylkpoa4i1f13zj8lduror8y6aw`,
  },
  home: {
    heroSubtitle:
      "Keep your property looking its best—spring, summer, fall, and winter—with reliable, professional service you can trust.",
    heroCta: "Schedule Your Service Today",
    whyUsBadge: "Why Us",
    whyUsTitle: "Why Choose Us",
    servicesBadge: "Our Services",
    servicesTitle: "What We Offer",
    midCtaTitle: "Keep your property safe year-round",
    midCtaText:
      "Ready to keep your property safe, beautiful, and stress-free all year long? Contact us today for a free quote!",
    midCtaButton: "Get a Quote Today",
    areasBadge: "Where We Service",
    areasTitle: "Serving Spruce Grove and Surrounding Alberta communities",
    areasCta: "Schedule Your Lawn Care",
    promiseTitle: "Our Promise",
    faqsBadge: "FAQs",
    faqsTitle: "FAQs",
    faqsSubtitle: "Common Questions for your Property's Needs",
    quoteTitle: "Get Your Service Quote Today!",
    quoteText:
      "Tell us about your property and we'll follow up with a clear quote.",
  },
  whyUs: [
    {
      title: "Experienced Team:",
      text: "Years of expertise in lawn care and snow removal",
    },
    {
      title: "All-Season Service:",
      text: "One crew handles everything year-round",
    },
    {
      title: "Reliable & Professional:",
      text: "On time, thorough, and detail-oriented",
    },
    {
      title: "Tailored Solutions:",
      text: "Services customized to your property's needs",
    },
  ],
  homeServices: [
    {
      title: "Snow Removal Services",
      short:
        "Comprehensive snow maintenance and ice melt solutions to keep your property safe this winter.",
      href: "/services/snow-removal-services",
      image: `${CDN}/85k140zf931idm3jubrt7hqx33ex`,
    },
    {
      title: "Lawn Care and Maintenance",
      short:
        "Seasonal lawn care including fertilization, manual weed control, and one-time mowing services.",
      href: "/services/lawn-care-and-maintenance",
      image: `${CDN}/f5bh6dqidppknuqjc7pv0p8evpuy`,
    },
    {
      title: "COMING SOON - Junk Removal",
      short:
        "Reclaim your space with our professional junk removal services. We handle the heavy lifting and responsible disposal of unwanted items, making cleanup easy and stress-free.",
      href: null,
      image: `${CDN}/jkdbrhz3dra5d6i1csy89shl7p67`,
      comingSoon: true,
    },
    {
      title: "Property Maintenance and Clean Up",
      short:
        "Property cleanup and maintenance services to maintain your property's beauty year-round.",
      href: "/services/property-cleanup-and-maintenance",
      image: `${CDN}/ayylkpoa4i1f13zj8lduror8y6aw`,
    },
  ],
  serviceAreas: [
    "Spruce Grove",
    "Edmonton",
    "St. Albert",
    "Stony Plain",
    "Leduc",
    "Acheson",
    "Beaumont",
    "Sherwood Park",
  ],
  promiseText:
    "At Lawn Care and Snow Removal Experts, we provide all-season property care with one dedicated crew. From spring and summer lawn maintenance to fall cleanups and winter snow removal, we handle it all. Our team is committed to reliability, efficiency, and expert service, ensuring every property we care for is safe, beautiful, and well-maintained. We serve residential clients, delivering tailored solutions that fit your needs and keep your property looking its best year-round. One crew. Every season. Experts you can trust.",
  homeFaqs: [
    {
      question:
        "Do you offer snow removal services for both residential and commercial?",
      answer:
        "Currently, we provide snow removal services exclusively for residential clients; however, we are actively exploring opportunities to expand into commercial properties.",
    },
    {
      question: "What lawn care services do you provide during the warmer months?",
      answer:
        "Our lawn care services include fertilization, manual weed control, lawn maintenance and seasonal maintenance to keep your lawn healthy and attractive.",
    },
    {
      question: "Can I schedule seasonal snow removal contracts?",
      answer:
        "Yes, we offer seasonal snow removal contracts to ensure your property stays safe and accessible throughout the winter months with no hassle.",
    },
    {
      question: "What services do you offer?",
      answer:
        "We provide all-season lawn care, property maintenance, and snow removal for residential properties. Our services include mowing, fertilizing, aeration, fall cleanups, edging, snow blowing, shoveling, and ice control. We will soon be offering junk removal as well.",
    },
    {
      question: "Are you available year-round?",
      answer:
        "Yes! We provide all-season service, keeping your property maintained and safe from spring through winter.",
    },
  ],
  about: {
    badge: "About Us",
    storyBadge: "Our Story",
    storyTitle: "All seasons, one crew you can trust",
    storyExtra:
      "Based in {city}, Alberta, we serve homeowners across the capital region with clear communication, consistent schedules, and workmanship you can see from the curb.",
    ctaLabel: "Get a Quote",
  },
  snowPage: {
    slug: "snow-removal-services",
    title: "Snow Removal Services",
    metaDescription:
      "Reliable snow removal services in Stony Plain, Edmonton, and nearby communities. Keep your property safe and accessible all winter.",
    heroImage: `${CDN}/didvk6gippnf8moc80hz3ilwsk5l`,
    heroText:
      "Stay safe and worry-free all winter with Lawn Care and Snow Removal Experts. Our one dedicated crew provides fast, reliable, and professional snow removal for residential properties.",
    heroCta: "Get a Quote",
    featuresBadge: "Features",
    featuresTitle: "Benefits of Our Snow Removal Services",
    featuresImage: `${CDN}/vks0z2jzkx9onm5dyh13yxw2w0wa`,
    benefits: [
      {
        title: "Timely Snow Clearing",
        text: "We ensure prompt removal of snow to keep driveways, walkways, and parking areas clear and safe.",
      },
      {
        title: "Ice Management Solutions",
        text: "Our team applies effective ice melt products to prevent slips and falls on icy surfaces.",
      },
      {
        title: "Customized Winter Maintenance",
        text: "We tailor our snow removal plans to meet the unique needs of residential properties.",
      },
      {
        title: "Reliable Local Service",
        text: "As a trusted local crew, we provide dependable snow care you can count on throughout the winter season.",
      },
    ],
    gallery: [
      `${CDN}/h4whzdz0vvysnu3z78vhthh989lm`,
      `${CDN}/qa1xqn0pra1ced9kqzj1vgff9ob3`,
      `${CDN}/8k19tzfgzvsjmotz7o1xgl2tngwg`,
      `${CDN}/xa3mtmy3pnahsvee41onmj4oiher`,
      `${CDN}/dzvf4d2ncfmez15vz0df1ab11zaw`,
      `${CDN}/z2kp5qlpoa4gvhsfhuv5ohyrk5po`,
    ],
    ctaTitle: "Get Ready for Winter with Expert Snow Removal",
    ctaText:
      "Keep your home safe and accessible all winter long with our reliable residential snow removal services. We provide prompt snow clearing for driveways, sidewalks, and walkways, helping reduce slip hazards and giving you peace of mind after every snowfall. Whether you need seasonal service or snow removal after major storms, our team is committed to keeping your property clear and winter-ready.",
    ctaButton: "Free Winter Quote",
    faqTitle: "Frequently Asked Questions about Snow Removal",
    faqIntro: "Find answers to common questions about our winter services.",
    faqs: [
      {
        question: "What areas do you serve for snow removal?",
        answer:
          "We provide snow removal services in Stony Plain, Edmonton, St. Albert, Spruce Grove, Leduc, Acheson, and surrounding communities.",
      },
      {
        question: "How do you ensure timely snow clearing during heavy storms?",
        answer:
          "Our team monitors weather conditions closely and deploys promptly to keep your property safe during winter storms.",
      },
      {
        question: "Can I schedule one-time or seasonal snow removal services?",
        answer:
          "Yes, we offer both one-time snow clearing and seasonal contracts tailored to your needs.",
      },
      {
        question: "Do you offer ice melt application for sidewalks?",
        answer:
          "Absolutely. We provide sidewalk ice melt application to prevent slips and maintain safe walkways.",
      },
      {
        question:
          "Are your snow removal services suitable for both residential and commercial properties?",
        answer:
          "Currently, we provide snow removal services exclusively for residential clients; however, we are actively exploring opportunities to expand into commercial properties.",
      },
      {
        question: "Can you handle emergency snow removal situations?",
        answer:
          "Absolutely. Our team is equipped to respond promptly to emergency snow clearing requests.",
      },
    ],
    quoteTitle: "Get a Snow Removal Quote Today!",
  },
  lawnPage: {
    slug: "lawn-care-and-maintenance",
    title: "Lawn Care and Maintenance",
    heroTitle: "Lawn Care Services",
    metaDescription:
      "Professional lawn care and maintenance for residential and commercial properties in Alberta, including snow removal and seasonal upkeep.",
    heroImage: `${CDN}/q6p7atfkrqjnb3fwhqc8kepmgsf8`,
    heroText:
      "Keeping your property lush and accessible year-round with professional lawn and snow services.",
    heroCta: "Inquire Today!",
    featuresBadge: "Why Choose Us!",
    featuresTitle: "Why Choose Us!",
    featuresImage: `${CDN}/etd9k7nbg9vo8n0whz5eanux474m`,
    benefits: [
      {
        title: "Comprehensive Year-Round Care",
        text: "From spring fertilization to winter snow removal, we handle all aspects of lawn maintenance to keep your property beautiful and functional.",
      },
      {
        title: "Reliable Local Service",
        text: "Our experienced team provides dependable services for residential clients across Alberta.",
      },
      {
        title: "Customized Solutions",
        text: "We tailor our lawn care and snow removal plans to meet your specific needs and property requirements.",
      },
      {
        title: "Efficient & Safe Operations",
        text: "Using industry-leading equipment and techniques, we ensure quick turnaround times while prioritizing safety.",
      },
    ],
    gallery: [
      `${CDN}/mpicv29757185otfeodqpwlunr97`,
      `${CDN}/blx0cinf9qe5h560puy84ampjpny`,
      `${CDN}/t4dd6i1sv08ukv4zty5q94bc28w1`,
      `${CDN}/4adw5iy54fxdtwe8gx7xrpv0mrq1`,
      `${CDN}/50rp2xt3ct72hogyzzgz7iylccda`,
      `${CDN}/4dvkz61p31ju7conr0m6ofgjgbhz`,
      `${CDN}/tsqrmne1ojviqxxxoxlg5blwj6gx`,
      `${CDN}/t7sl2h4pyi27razwcq31ebgck3re`,
    ],
    ctaTitle: "Schedule Your Lawn Care Service Today!",
    ctaText:
      "We combine experience, attention to detail, and tailored solutions to meet the needs of residential properties. From regular maintenance to seasonal projects, we make it easy to have a healthy, beautiful lawn without the stress.",
    ctaButton: "Inquire Today!",
    faqTitle: "Frequently Asked Questions about Lawn & Snow Services",
    faqIntro:
      "Get answers to common questions about our comprehensive property care.",
    faqs: [
      {
        question: "What types of properties do you serve?",
        answer:
          "We provide lawn care and snow removal services for residential homes in Edmonton and surrounding areas",
      },
      {
        question: "How do you customize your lawn maintenance plans?",
        answer:
          "We assess each property's unique needs and develop tailored schedules and treatments to ensure optimal results.",
      },
      {
        question: "Do you offer seasonal contracts for snow removal?",
        answer:
          "Yes, we offer flexible seasonal snow removal contracts designed to keep your property safe during winter months.",
      },
      {
        question: "What areas do you serve in the Edmonton region?",
        answer:
          "We serve Edmonton, Stony Plain, St. Albert, Spruce Grove, Leduc, Acheson, and surrounding areas.",
      },
      {
        question: "How often should my lawn be mowed?",
        answer:
          "Most lawns require mowing once per week during the growing season. Depending on weather and growth rates, some properties may require bi-weekly service.",
      },
      {
        question: "What services are included with lawn maintenance?",
        answer:
          "Our standard lawn maintenance service includes mowing, trimming around obstacles and edges, blowing grass clippings from sidewalks and driveways, and a final quality inspection.",
      },
      {
        question: "Do I need to be home during services?",
        answer:
          "We value the opportunity to meet our clients; however, it is not necessary for you to be present during our service. As long as we have access to the areas requiring maintenance, we can efficiently complete the work in your absence.",
      },
    ],
    quoteTitle: "Get Your Free Quote Today!!!",
  },
  propertyPage: {
    slug: "property-cleanup-and-maintenance",
    title: "Property Cleanup and Maintenance",
    heroTitle: "Property Clean-Up & Maintenance",
    metaDescription:
      "Expert property cleanup and landscaping for residential and commercial clients in Stony Plain, Edmonton, and surrounding areas.",
    heroImage: `${CDN}/vsiqj0myjoyn2yra3kh27gzdb8cv`,
    heroText:
      "Transform your property year-round with our expert cleanup and property maintenance services.",
    heroCta: "Let's Get Started",
    featuresBadge: "Why Us",
    featuresTitle: "Why Choose Our Property Services",
    featuresImage: `${CDN}/p8zxanyz0yap2jx47nosfzcjd4r2`,
    benefits: [
      {
        title: "Comprehensive Property Care",
        text: "From spring cleanups to fall leaf removal, we handle all aspects of property maintenance to keep your landscape pristine.",
      },
      {
        title: "Customized Maintenance Solutions",
        text: "We tailor our services to match your property's unique style and your personal preferences.",
      },
      {
        title: "Reliable Year-Round Service",
        text: "Our team provides consistent lawn care and snow removal to ensure your property remains accessible and attractive throughout the seasons.",
      },
      {
        title: "Experienced Local Team",
        text: "With deep knowledge of the area, our crew delivers efficient and trustworthy service to residential clients.",
      },
    ],
    gallery: [
      `${CDN}/c2rkwmi2hfh3ntqb0orcnky3tcyu`,
      `${CDN}/gt2txfcgajtzt16m9clmz3025c30`,
      `${CDN}/yngia1dvxlqptmhg5l6jbzpx258g`,
      `${CDN}/ebjfvfptfhvoy8448tvorzacup4z`,
      `${CDN}/2sdkxymr8ixydcy0xskbkrt2y6ql`,
      `${CDN}/rprfviovgh1l9vt0dkxu5jd0pk5b`,
      `${CDN}/oa23m8wif080y3a9p00k3xi6w0j1`,
      `${CDN}/uvl8yu2nkbz88e4f9it211n9p80h`,
    ],
    ctaTitle: "Revitalize Your Property Today",
    ctaText:
      "Contact us now for expert cleanup and property maintenance services that make a difference.",
    ctaButton: "Talk to Our Experts",
    faqTitle: "Frequently Asked Questions about Property Cleanup & Maintenance",
    faqIntro: "Get answers to common questions about our services.",
    faqs: [
      {
        question: "What types of property cleanup do you offer?",
        answer:
          "We provide spring and fall cleanups, leaf removal, debris hauling, and general yard tidying to prepare your property for each season.",
      },
      {
        question: "Do you offer ongoing lawn maintenance services?",
        answer:
          "Yes. We provide regular lawn mowing, edging, fertilization, and weed control to keep your yard healthy and attractive.",
      },
      {
        question:
          "How does your snow removal service operate in the winter months?",
        answer:
          "Our team offers reliable snow plowing, sidewalk clearing, ice melt application, and seasonal contracts to keep your property safe during winter.",
      },
      {
        question:
          "Are your services available for both residential and commercial properties?",
        answer:
          "Currently, we provide snow removal services exclusively for residential clients; however, we are actively exploring opportunities to expand into commercial properties.",
      },
    ],
    quoteTitle: "Get an Estimate",
  },
};

/** Sync aliases for modules that still import named symbols (prefer getSiteContent). */
export const siteConfig = defaultSiteContent.site;
export const serviceAreas = defaultSiteContent.serviceAreas;
export const whyUs = defaultSiteContent.whyUs;
export const homeServices = defaultSiteContent.homeServices;
export const promiseText = defaultSiteContent.promiseText;
export const homeFaqs = defaultSiteContent.homeFaqs;
export const snowPage = defaultSiteContent.snowPage;
export const lawnPage = defaultSiteContent.lawnPage;
export const propertyPage = defaultSiteContent.propertyPage;
export const faqs = homeFaqs;
