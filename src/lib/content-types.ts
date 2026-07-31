export type FaqItem = {
  question: string;
  answer: string;
};

export type BenefitItem = {
  title: string;
  text: string;
};

export type HomeService = {
  title: string;
  short: string;
  href: string | null;
  image: string;
  comingSoon?: boolean;
};

export type ServicePageContent = {
  slug: string;
  title: string;
  heroTitle?: string;
  metaDescription: string;
  heroImage: string;
  heroText: string;
  heroCta: string;
  featuresBadge: string;
  featuresTitle: string;
  featuresImage: string;
  benefits: BenefitItem[];
  gallery: string[];
  ctaTitle: string;
  ctaText: string;
  ctaButton: string;
  faqTitle: string;
  faqIntro: string;
  faqs: FaqItem[];
  quoteTitle: string;
};

export type SiteContent = {
  site: {
    name: string;
    shortName: string;
    tagline: string;
    description: string;
    url: string;
    phone: string;
    phoneHref: string;
    email: string;
    clientLogin: string;
    address: {
      line1: string;
      city: string;
      region: string;
      postalCode: string;
      country: string;
    };
    logo: string;
    heroImage: string;
    whyUsImage: string;
    ctaImage: string;
    promiseImage: string;
  };
  home: {
    heroSubtitle: string;
    heroCta: string;
    whyUsBadge: string;
    whyUsTitle: string;
    servicesBadge: string;
    servicesTitle: string;
    midCtaTitle: string;
    midCtaText: string;
    midCtaButton: string;
    areasBadge: string;
    areasTitle: string;
    areasCta: string;
    promiseTitle: string;
    faqsBadge: string;
    faqsTitle: string;
    faqsSubtitle: string;
    quoteTitle: string;
    quoteText: string;
  };
  whyUs: BenefitItem[];
  homeServices: HomeService[];
  serviceAreas: string[];
  promiseText: string;
  homeFaqs: FaqItem[];
  about: {
    badge: string;
    storyBadge: string;
    storyTitle: string;
    storyExtra: string;
    ctaLabel: string;
  };
  snowPage: ServicePageContent;
  lawnPage: ServicePageContent;
  propertyPage: ServicePageContent;
};
