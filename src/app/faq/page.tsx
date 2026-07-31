import type { Metadata } from "next";
import Link from "next/link";
import { JsonLd } from "@/components/JsonLd";
import { getSiteContent } from "@/lib/content";
import { breadcrumbSchema, faqPageSchema } from "@/lib/schema";

export async function generateMetadata(): Promise<Metadata> {
  const { home } = await getSiteContent();
  return {
    title: home.faqsTitle,
    description: home.faqsSubtitle,
    alternates: { canonical: "/faq" },
  };
}

export default async function FaqPage() {
  const { site, home, homeFaqs } = await getSiteContent();

  return (
    <>
      <JsonLd data={faqPageSchema(homeFaqs)} />
      <JsonLd
        data={breadcrumbSchema(
          [
            { name: "Home", path: "/" },
            { name: "FAQ", path: "/faq" },
          ],
          site,
        )}
      />

      <section className="bg-steel px-5 py-14 text-white md:px-8 md:py-20">
        <div className="mx-auto max-w-6xl">
          <h1 className="font-display text-4xl font-bold text-white md:text-5xl">
            {home.faqsTitle}
          </h1>
          <p className="mt-4 max-w-2xl text-white/85">{home.faqsSubtitle}</p>
        </div>
      </section>

      <section className="mx-auto max-w-3xl px-5 py-16 md:px-8 md:py-24">
        <div className="space-y-4">
          {homeFaqs.map((faq) => (
            <article
              key={faq.question}
              className="rounded-xl border border-line bg-white px-5 py-5"
            >
              <h2 className="font-display text-lg font-semibold md:text-xl">
                {faq.question}
              </h2>
              <p className="mt-3 leading-relaxed text-ink-muted">{faq.answer}</p>
            </article>
          ))}
        </div>
        <p className="mt-10 text-sm text-ink-muted">
          Still have a question?{" "}
          <Link href="/contact" className="font-semibold text-brand hover:underline">
            Contact us
          </Link>{" "}
          for a free quote.
        </p>
      </section>
    </>
  );
}
