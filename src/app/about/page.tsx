import type { Metadata } from "next";
import Image from "next/image";
import Link from "next/link";
import { JsonLd } from "@/components/JsonLd";
import { getSiteContent } from "@/lib/content";
import { breadcrumbSchema } from "@/lib/schema";

export async function generateMetadata(): Promise<Metadata> {
  const { site } = await getSiteContent();
  return {
    title: "About Us",
    description: `Learn about ${site.name} — a dedicated all-season crew providing reliable lawn care, snow removal, and property maintenance in Spruce Grove and surrounding Alberta communities.`,
    alternates: { canonical: "/about" },
  };
}

export default async function AboutPage() {
  const { site, about, promiseText, whyUs, serviceAreas, home } =
    await getSiteContent();
  const storyExtra = about.storyExtra.replace("{city}", site.address.city);

  return (
    <>
      <JsonLd
        data={breadcrumbSchema(
          [
            { name: "Home", path: "/" },
            { name: "About", path: "/about" },
          ],
          site,
        )}
      />

      <section className="relative min-h-[42vh] overflow-hidden">
        <Image
          src={site.heroImage}
          alt="Lawn care and snow removal crew serving Alberta"
          fill
          priority
          className="object-cover"
          sizes="100vw"
        />
        <div className="absolute inset-0 bg-black/45" aria-hidden />
        <div className="relative mx-auto flex min-h-[42vh] max-w-6xl flex-col justify-end px-5 pb-14 md:px-8">
          <span className="badge w-fit">{about.badge}</span>
          <h1
            className="mt-4 font-display text-4xl font-bold md:text-5xl"
            style={{ color: "#ffffff" }}
          >
            About {site.name}
          </h1>
          <p className="mt-4 max-w-2xl text-base text-white/90 md:text-lg">
            {site.tagline} One dedicated crew for spring, summer, fall, and winter.
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

      <section className="mx-auto grid max-w-6xl items-center gap-10 px-5 py-16 md:grid-cols-2 md:px-8 md:py-24">
        <div>
          <span className="badge">{about.storyBadge}</span>
          <h2 className="mt-4 font-display text-3xl font-bold text-heading md:text-4xl">
            {about.storyTitle}
          </h2>
          <p className="mt-4 text-base leading-relaxed text-ink-muted md:text-lg">
            {promiseText}
          </p>
          <p className="mt-4 text-base leading-relaxed text-ink-muted">
            {storyExtra}
          </p>
          <Link href="/contact" className="btn-primary mt-8">
            {about.ctaLabel}
          </Link>
        </div>
        <div className="relative aspect-[4/3] overflow-hidden rounded-2xl">
          <Image
            src={site.whyUsImage}
            alt="Professional property care in winter and summer"
            fill
            className="object-cover"
            sizes="(max-width:768px) 100vw, 50vw"
          />
        </div>
      </section>

      <section className="bg-canvas-deep px-5 py-16 md:px-8 md:py-24">
        <div className="mx-auto max-w-6xl">
          <span className="badge">{home.whyUsBadge}</span>
          <h2 className="mt-4 font-display text-3xl font-bold text-heading md:text-4xl">
            {home.whyUsTitle}
          </h2>
          <ul className="mt-10 grid gap-8 sm:grid-cols-2">
            {whyUs.map((item) => (
              <li key={item.title} className="grid grid-cols-[auto_1fr] gap-3">
                <span
                  className="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-steel text-[11px] text-white"
                  aria-hidden
                >
                  ✓
                </span>
                <div>
                  <h3 className="text-lg font-bold text-heading">{item.title}</h3>
                  <p className="mt-1 text-base text-ink-muted">{item.text}</p>
                </div>
              </li>
            ))}
          </ul>
        </div>
      </section>

      <section className="mx-auto max-w-6xl px-5 py-16 md:px-8 md:py-24">
        <span className="badge">{home.areasBadge}</span>
        <h2 className="mt-4 font-display text-3xl font-bold text-heading md:text-4xl">
          {home.areasTitle}
        </h2>
        <ul className="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-4">
          {serviceAreas.map((area) => (
            <li key={area}>
              <p className="rounded-xl border border-line bg-canvas-deep px-4 py-5 text-center font-display text-lg font-semibold text-steel">
                {area}
              </p>
            </li>
          ))}
        </ul>
        <div className="mt-10 flex flex-wrap gap-3">
          <Link href="/services/lawn-care-and-maintenance" className="btn-primary">
            Lawn Care
          </Link>
          <Link href="/services/snow-removal-services" className="btn-outline">
            Snow Removal
          </Link>
          <Link href="/contact" className="btn-outline">
            Contact Us
          </Link>
        </div>
      </section>
    </>
  );
}
