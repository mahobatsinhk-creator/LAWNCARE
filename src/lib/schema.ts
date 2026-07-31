import type { SiteContent } from "@/lib/content-types";
import { siteConfig as defaultSite } from "@/lib/site";

type SiteInfo = SiteContent["site"];

export function localBusinessSchema(
  site: SiteInfo = defaultSite,
  areas: string[] = [],
) {
  return {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "@id": `${site.url}/#business`,
    name: site.name,
    description: site.description,
    url: site.url,
    telephone: site.phone,
    email: site.email,
    image: site.logo,
    address: {
      "@type": "PostalAddress",
      streetAddress: site.address.line1,
      addressLocality: site.address.city,
      addressRegion: "AB",
      postalCode: site.address.postalCode,
      addressCountry: site.address.country,
    },
    geo: {
      "@type": "GeoCoordinates",
      latitude: 53.545,
      longitude: -113.915,
    },
    areaServed: areas.length
      ? areas
      : [
          "Spruce Grove",
          "Edmonton",
          "St. Albert",
          "Stony Plain",
          "Leduc",
          "Acheson",
          "Beaumont",
          "Sherwood Park",
        ],
    priceRange: "$$",
  };
}

export function faqPageSchema(
  faqs: readonly { question: string; answer: string }[],
) {
  return {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    mainEntity: faqs.map((faq) => ({
      "@type": "Question",
      name: faq.question,
      acceptedAnswer: {
        "@type": "Answer",
        text: faq.answer,
      },
    })),
  };
}

export function serviceSchema(
  opts: {
    name: string;
    description: string;
    path: string;
  },
  site: SiteInfo = defaultSite,
) {
  return {
    "@context": "https://schema.org",
    "@type": "Service",
    name: opts.name,
    description: opts.description,
    url: `${site.url}${opts.path}`,
    provider: {
      "@type": "LocalBusiness",
      name: site.name,
      telephone: site.phone,
    },
    areaServed: "Alberta",
  };
}

export function breadcrumbSchema(
  items: { name: string; path: string }[],
  site: SiteInfo = defaultSite,
) {
  return {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    itemListElement: items.map((item, index) => ({
      "@type": "ListItem",
      position: index + 1,
      name: item.name,
      item: `${site.url}${item.path}`,
    })),
  };
}
