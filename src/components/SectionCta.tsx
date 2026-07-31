import Link from "next/link";

type Props = {
  eyebrow?: string;
  title: string;
  text: string;
  primaryHref?: string;
  primaryLabel?: string;
  secondaryHref?: string;
  secondaryLabel?: string;
};

export function SectionCta({
  title,
  text,
  primaryHref = "/contact",
  primaryLabel = "Get a Quote Today",
  secondaryHref,
  secondaryLabel,
}: Props) {
  return (
    <section className="bg-steel px-5 py-16 text-white md:px-8 md:py-20">
      <div className="mx-auto max-w-3xl text-center">
        <h2 className="font-display text-3xl font-bold text-white md:text-4xl">
          {title}
        </h2>
        <p className="mx-auto mt-4 max-w-2xl text-base leading-relaxed text-white/85 md:text-lg">
          {text}
        </p>
        <div className="mt-8 flex flex-wrap items-center justify-center gap-3">
          <Link href={primaryHref} className="btn-light">
            {primaryLabel}
          </Link>
          {secondaryHref && secondaryLabel ? (
            <Link
              href={secondaryHref}
              className="inline-flex rounded-lg border border-white/40 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10"
            >
              {secondaryLabel}
            </Link>
          ) : null}
        </div>
      </div>
    </section>
  );
}
