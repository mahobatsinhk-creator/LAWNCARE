import type { Metadata } from "next";
import Image from "next/image";
import Link from "next/link";
import { JsonLd } from "@/components/JsonLd";
import { QuoteForm } from "@/components/QuoteForm";
import { getSiteContent } from "@/lib/content";
import { breadcrumbSchema } from "@/lib/schema";

export async function generateMetadata(): Promise<Metadata> {
  const { site } = await getSiteContent();
  return {
    title: "Contact",
    description: `Contact ${site.name} for a free lawn care or snow removal quote in Spruce Grove and surrounding Alberta communities. Call ${site.phone} or email ${site.email}.`,
    alternates: { canonical: "/contact" },
  };
}

export default async function ContactPage() {
  const { site, home } = await getSiteContent();

  return (
    <>
      <JsonLd
        data={breadcrumbSchema(
          [
            { name: "Home", path: "/" },
            { name: "Contact", path: "/contact" },
          ],
          site,
        )}
      />

      <section className="relative min-h-[36vh] overflow-hidden">
        <Image
          src={site.ctaImage}
          alt={`Contact ${site.name}`}
          fill
          priority
          className="object-cover"
          sizes="100vw"
        />
        <div className="absolute inset-0 bg-steel/80" aria-hidden />
        <div className="relative mx-auto flex min-h-[36vh] max-w-6xl flex-col justify-end px-5 pb-14 md:px-8">
          <span className="badge w-fit">Contact</span>
          <h1
            className="mt-4 font-display text-4xl font-bold md:text-5xl"
            style={{ color: "#ffffff" }}
          >
            {home.quoteTitle}
          </h1>
          <p className="mt-4 max-w-2xl text-base text-white/90 md:text-lg">
            {home.midCtaText}
          </p>
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

      <section className="mx-auto grid max-w-6xl gap-12 px-5 py-16 md:px-8 md:py-24 lg:grid-cols-[1fr_1.2fr]">
        <div>
          <h2 className="font-display text-2xl font-bold text-heading">
            Talk with our crew
          </h2>
          <p className="mt-3 text-ink-muted">
            Prefer to call or email? Reach us directly — or send a quote request
            using the form.
          </p>
          <dl className="mt-8 space-y-5 text-sm">
            <div>
              <dt className="font-semibold uppercase tracking-[0.12em] text-steel">
                Phone
              </dt>
              <dd className="mt-1 text-lg">
                <a href={site.phoneHref} className="text-brand hover:underline">
                  {site.phone}
                </a>
              </dd>
            </div>
            <div>
              <dt className="font-semibold uppercase tracking-[0.12em] text-steel">
                Email
              </dt>
              <dd className="mt-1 text-base">
                <a
                  href={`mailto:${site.email}`}
                  className="break-all text-brand hover:underline"
                >
                  {site.email}
                </a>
              </dd>
            </div>
            <div>
              <dt className="font-semibold uppercase tracking-[0.12em] text-steel">
                Address
              </dt>
              <dd className="mt-1 text-base text-ink">
                {site.address.line1}
                <br />
                {site.address.city}, {site.address.region} {site.address.postalCode}
              </dd>
            </div>
            <div>
              <dt className="font-semibold uppercase tracking-[0.12em] text-steel">
                Client Login
              </dt>
              <dd className="mt-1 text-base">
                <a
                  href={site.clientLogin}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="text-brand hover:underline"
                >
                  Existing clients sign in here
                </a>
              </dd>
            </div>
          </dl>
          <p className="mt-8 text-sm text-ink-muted">
            Looking for services? Browse{" "}
            <Link
              href="/services/lawn-care-and-maintenance"
              className="font-semibold text-brand hover:underline"
            >
              lawn care
            </Link>
            ,{" "}
            <Link
              href="/services/snow-removal-services"
              className="font-semibold text-brand hover:underline"
            >
              snow removal
            </Link>
            , or learn more{" "}
            <Link href="/about" className="font-semibold text-brand hover:underline">
              about us
            </Link>
            .
          </p>
        </div>
        <QuoteForm phone={site.phone} phoneHref={site.phoneHref} />
      </section>
    </>
  );
}
