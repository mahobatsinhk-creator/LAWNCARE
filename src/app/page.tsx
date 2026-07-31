import Image from "next/image";
import Link from "next/link";
import { JsonLd } from "@/components/JsonLd";
import { QuoteForm } from "@/components/QuoteForm";
import { getSiteContent } from "@/lib/content";
import { faqPageSchema } from "@/lib/schema";

export default async function HomePage() {
  const {
    site,
    home,
    whyUs,
    homeServices,
    serviceAreas,
    promiseText,
    homeFaqs,
  } = await getSiteContent();

  return (
    <>
      <JsonLd data={faqPageSchema(homeFaqs)} />

      <section className="relative min-h-[72vh] overflow-hidden md:min-h-[78vh]">
        <Image
          src={site.heroImage}
          alt="Uploaded image"
          fill
          priority
          className="object-cover"
          sizes="100vw"
        />
        <div className="absolute inset-0 bg-black/40" aria-hidden />
        <div className="relative mx-auto flex min-h-[72vh] max-w-[720px] flex-col items-center justify-center px-5 pb-20 pt-16 text-center md:min-h-[78vh] md:px-8 md:pb-28">
          <h1
            className="animate-rise font-display text-[36px] font-bold uppercase leading-[1.2] text-white md:text-[44px]"
            style={{ color: "#ffffff" }}
          >
            {site.tagline}
          </h1>
          <p className="animate-rise-delay mt-5 max-w-2xl text-base font-normal leading-relaxed text-white md:text-lg">
            {home.heroSubtitle}
          </p>
          <Link href="/contact" className="btn-light animate-rise-delay mt-8">
            {home.heroCta}
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
        <div className="grid items-center gap-10 lg:grid-cols-2 lg:gap-14">
          <div>
            <span className="badge">{home.whyUsBadge}</span>
            <h2 className="mt-4 text-3xl font-bold text-heading md:text-4xl">
              {home.whyUsTitle}
            </h2>
            <ul className="mt-8 space-y-5">
              {whyUs.map((item) => (
                <li key={item.title} className="grid grid-cols-[auto_1fr] items-start gap-3">
                  <span
                    className="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-steel text-[11px] text-white"
                    aria-hidden
                  >
                    ✓
                  </span>
                  <div>
                    <h3 className="text-lg font-bold text-heading">{item.title}</h3>
                    <p className="mt-1 text-base leading-relaxed text-ink-muted">
                      {item.text}
                    </p>
                  </div>
                </li>
              ))}
            </ul>
          </div>
          <div className="relative aspect-[3/4] max-h-[520px] overflow-hidden rounded-2xl sm:aspect-[4/3]">
            <Image
              src={site.whyUsImage}
              alt="Uploaded image"
              fill
              className="object-cover"
              sizes="(max-width:1024px) 100vw, 50vw"
            />
          </div>
        </div>
      </section>

      <section className="bg-canvas-deep px-5 py-16 md:px-8 md:py-24">
        <div className="mx-auto max-w-6xl">
          <span className="badge">{home.servicesBadge}</span>
          <h2 className="mt-4 font-display text-3xl font-bold md:text-4xl">
            {home.servicesTitle}
          </h2>
          <div className="mt-10 grid gap-6 sm:grid-cols-2">
            {homeServices.map((service) => {
              const body = (
                <>
                  <div className="relative aspect-[16/10] overflow-hidden">
                    <Image
                      src={service.image}
                      alt="Uploaded image"
                      fill
                      className="object-cover transition duration-500 group-hover:scale-105"
                      sizes="(max-width:768px) 100vw, 50vw"
                    />
                  </div>
                  <div className="p-5">
                    <p className="text-sm leading-relaxed text-ink-muted">
                      {service.short}
                    </p>
                    <h3 className="mt-3 font-display text-xl font-semibold text-steel">
                      {service.title}
                    </h3>
                  </div>
                </>
              );

              if (!service.href) {
                return (
                  <div
                    key={service.title}
                    className="overflow-hidden rounded-2xl border border-line bg-white"
                  >
                    {body}
                  </div>
                );
              }

              return (
                <Link
                  key={service.title}
                  href={service.href}
                  className="group block overflow-hidden rounded-2xl border border-line bg-white transition hover:shadow-md"
                >
                  {body}
                </Link>
              );
            })}
          </div>
        </div>
      </section>

      <section className="relative overflow-hidden px-5 py-20 md:px-8 md:py-24">
        <Image
          src={site.ctaImage}
          alt="Person shoveling snow on a sunlit path at dawn, with snow-covered houses and trees lining the street."
          fill
          className="object-cover"
          sizes="100vw"
        />
        <div className="absolute inset-0 bg-steel/85" aria-hidden />
        <div className="relative mx-auto max-w-3xl text-center text-white">
          <h2
            className="font-display text-3xl font-bold md:text-4xl"
            style={{ color: "#ffffff" }}
          >
            {home.midCtaTitle}
          </h2>
          <p className="mt-4 text-base font-normal text-white/90 md:text-lg">
            {home.midCtaText}
          </p>
          <Link href="/contact" className="btn-light mt-8">
            {home.midCtaButton}
          </Link>
        </div>
      </section>

      <section className="mx-auto max-w-6xl px-5 py-16 md:px-8 md:py-24">
        <span className="badge">{home.areasBadge}</span>
        <h2 className="mt-4 max-w-3xl font-display text-3xl font-bold md:text-4xl">
          {home.areasTitle}
        </h2>
        <ul className="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-4">
          {serviceAreas.map((area) => (
            <li key={area}>
              <h4 className="rounded-xl border border-line bg-canvas-deep px-4 py-5 text-center font-display text-lg font-semibold text-steel">
                {area}
              </h4>
            </li>
          ))}
        </ul>
        <div className="mt-10 text-center">
          <Link
            href="/services/lawn-care-and-maintenance"
            className="btn-primary"
          >
            {home.areasCta}
          </Link>
        </div>
      </section>

      <section className="border-y border-line bg-canvas-deep px-5 py-16 md:px-8 md:py-20">
        <div className="mx-auto grid max-w-6xl items-center gap-10 lg:grid-cols-2">
          <div>
            <h2 className="font-display text-3xl font-bold md:text-4xl">
              {home.promiseTitle}
            </h2>
            <p className="mt-4 text-base leading-relaxed text-ink-muted md:text-lg">
              {promiseText}
            </p>
          </div>
          <div className="relative aspect-square overflow-hidden rounded-2xl">
            <Image
              src={site.promiseImage}
              alt="Uploaded image"
              fill
              className="object-cover"
              sizes="(max-width:1024px) 100vw, 50vw"
            />
          </div>
        </div>
      </section>

      <section className="mx-auto max-w-6xl px-5 py-16 md:px-8 md:py-24">
        <span className="badge">{home.faqsBadge}</span>
        <h2 className="mt-4 font-display text-3xl font-bold md:text-4xl">
          {home.faqsTitle}
        </h2>
        <h4 className="mt-3 font-normal text-ink-muted">{home.faqsSubtitle}</h4>
        <div className="mt-10 space-y-3">
          {homeFaqs.map((faq) => (
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
              {home.quoteTitle}
            </h2>
            <p className="mt-4 text-ink-muted">{home.quoteText}</p>
            <p className="mt-6 text-sm text-ink-muted">
              Call{" "}
              <a href={site.phoneHref} className="font-semibold text-brand">
                {site.phone}
              </a>{" "}
              or email{" "}
              <a
                href={`mailto:${site.email}`}
                className="break-all font-semibold text-brand"
              >
                {site.email}
              </a>
              .
            </p>
          </div>
          <QuoteForm phone={site.phone} phoneHref={site.phoneHref} />
        </div>
      </section>
    </>
  );
}
