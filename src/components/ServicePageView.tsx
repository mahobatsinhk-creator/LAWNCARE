import Image from "next/image";
import Link from "next/link";
import { JsonLd } from "@/components/JsonLd";
import { QuoteForm } from "@/components/QuoteForm";
import type { SiteContent } from "@/lib/content-types";
import { breadcrumbSchema, faqPageSchema, serviceSchema } from "@/lib/schema";
import { siteConfig as defaultSite } from "@/lib/site";

type Benefit = { title: string; text: string };
type Faq = { question: string; answer: string };

type ServicePageData = {
  slug: string;
  title: string;
  heroTitle?: string;
  heroImage: string;
  heroText: string;
  heroCta: string;
  featuresBadge: string;
  featuresTitle: string;
  featuresImage: string;
  benefits: readonly Benefit[];
  gallery: readonly string[];
  ctaTitle: string;
  ctaText: string;
  ctaButton: string;
  faqTitle: string;
  faqIntro: string;
  faqs: readonly Faq[];
  quoteTitle: string;
  metaDescription: string;
};

export function ServicePageView({
  data,
  site = defaultSite,
}: {
  data: ServicePageData;
  site?: SiteContent["site"];
}) {
  const path = `/services/${data.slug}`;
  const heading = data.heroTitle ?? data.title;

  return (
    <>
      <JsonLd
        data={serviceSchema(
          {
            name: data.title,
            description: data.metaDescription,
            path,
          },
          site,
        )}
      />
      <JsonLd data={faqPageSchema([...data.faqs])} />
      <JsonLd
        data={breadcrumbSchema(
          [
            { name: "Home", path: "/" },
            { name: data.title, path },
          ],
          site,
        )}
      />

      <section className="relative min-h-[60vh] overflow-hidden">
        <Image
          src={data.heroImage}
          alt="Uploaded image"
          fill
          priority
          className="object-cover"
          sizes="100vw"
        />
        <div className="absolute inset-0 bg-black/45" aria-hidden />
        <div className="relative mx-auto flex min-h-[60vh] max-w-[720px] flex-col items-center justify-center px-5 pb-20 pt-16 text-center md:px-8 md:pb-28">
          <h1
            className="font-display text-[36px] font-bold leading-[1.2] text-white md:text-[44px]"
            style={{ color: "#ffffff" }}
          >
            {heading}
          </h1>
          <p className="mt-5 max-w-2xl text-base font-normal leading-relaxed text-white md:text-lg">
            {data.heroText}
          </p>
          <Link href="/contact" className="btn-light mt-8">
            {data.heroCta}
          </Link>
        </div>
        <svg
          className="hero-wave"
          viewBox="0 0 1440 72"
          preserveAspectRatio="none"
          aria-hidden
        >
          <path
            fill="currentColor"
            d="M0,40 C180,70 360,10 540,28 C720,46 900,70 1080,48 C1260,26 1350,18 1440,30 L1440,72 L0,72 Z"
          />
        </svg>
      </section>

      <section className="mx-auto max-w-6xl px-5 py-16 md:px-8 md:py-24">
        <div className="grid items-start gap-10 lg:grid-cols-2 lg:gap-14">
          <div className="relative aspect-[4/3] overflow-hidden rounded-2xl">
            <Image
              src={data.featuresImage}
              alt="Uploaded image"
              fill
              className="object-cover"
              sizes="(max-width:1024px) 100vw, 50vw"
            />
          </div>
          <div>
            <span className="badge">{data.featuresBadge}</span>
            <h2 className="mt-4 font-display text-3xl font-bold md:text-4xl">
              {data.featuresTitle}
            </h2>
            <ul className="mt-8 space-y-6">
              {data.benefits.map((item) => (
                <li key={item.title}>
                  <h3 className="font-display text-lg font-semibold">
                    {item.title}
                  </h3>
                  <p className="mt-1 text-sm leading-relaxed text-ink-muted">
                    {item.text}
                  </p>
                </li>
              ))}
            </ul>
          </div>
        </div>
      </section>

      <section className="bg-canvas-deep px-5 py-16 md:px-8 md:py-20">
        <div className="mx-auto max-w-6xl">
          <span className="badge">Image Gallery</span>
          <h2 className="mt-4 font-display text-3xl font-bold">Our work</h2>
          <div className="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            {data.gallery.map((src) => (
              <div
                key={src}
                className="relative aspect-[4/3] overflow-hidden rounded-xl"
              >
                <Image
                  src={src}
                  alt="Our work"
                  fill
                  className="object-cover"
                  sizes="(max-width:768px) 100vw, 25vw"
                />
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="bg-steel px-5 py-16 text-white md:px-8 md:py-20">
        <div className="mx-auto max-w-3xl text-center">
          <h2
            className="font-display text-3xl font-bold md:text-4xl"
            style={{ color: "#ffffff" }}
          >
            {data.ctaTitle}
          </h2>
          <div className="mt-4 space-y-4 text-base font-normal text-white/90 md:text-lg">
            {data.ctaText.split(/\n\n+/).map((paragraph) => (
              <p key={paragraph.slice(0, 48)}>{paragraph}</p>
            ))}
          </div>
          <Link href="/contact" className="btn-light mt-8">
            {data.ctaButton}
          </Link>
        </div>
      </section>

      <section className="mx-auto max-w-6xl px-5 py-16 md:px-8 md:py-24">
        <span className="badge">FAQs</span>
        <h2 className="mt-4 font-display text-3xl font-bold md:text-4xl">
          {data.faqTitle}
        </h2>
        <h4 className="mt-3 font-normal text-ink-muted">{data.faqIntro}</h4>
        <div className="mt-10 space-y-3">
          {data.faqs.map((faq) => (
            <details
              key={faq.question}
              className="group rounded-xl border border-line bg-white px-5 py-4"
            >
              <summary className="cursor-pointer list-none font-display text-base font-semibold marker:content-none md:text-lg">
                <span className="flex items-start justify-between gap-4">
                  <span>
                    <span className="mb-1 block text-xs font-semibold uppercase tracking-wide text-steel">
                      Question
                    </span>
                    {faq.question}
                  </span>
                  <span className="mt-0.5 text-steel transition group-open:rotate-45">
                    +
                  </span>
                </span>
              </summary>
              <p className="mt-3 max-w-3xl text-sm leading-relaxed text-ink-muted">
                {faq.answer}
              </p>
            </details>
          ))}
        </div>
      </section>

      <section className="bg-canvas-deep px-5 py-16 md:px-8 md:py-24">
        <div className="mx-auto grid max-w-6xl gap-10 lg:grid-cols-2 lg:items-start">
          <div>
            <h2 className="font-display text-3xl font-bold md:text-4xl">
              {data.quoteTitle}
            </h2>
          </div>
          <QuoteForm phone={site.phone} phoneHref={site.phoneHref} />
        </div>
      </section>
    </>
  );
}
