import Image from "next/image";
import { HeroEmailCapture } from "@/components/home/HeroEmailCapture";
import type { SiteContent } from "@/lib/content-types";

type HeroSectionProps = {
  site: SiteContent["site"];
  subtitle: string;
};

export function HeroSection({ site, subtitle }: HeroSectionProps) {
  return (
    <section className="hero-harmone relative min-h-[100svh] overflow-hidden">
      <Image
        src={site.heroImage}
        alt="Professional lawn care service"
        fill
        priority
        className="object-cover object-center"
        sizes="100vw"
      />
      <div className="hero-harmone-overlay absolute inset-0" aria-hidden />

      <div className="relative flex min-h-[100svh] flex-col items-center justify-end px-5 pb-16 pt-28 text-center md:px-8 md:pb-20 md:pt-32">
        <h1 className="hero-display animate-rise">{site.tagline}</h1>
        <p className="hero-subtitle animate-rise-delay mt-5 max-w-xl text-base leading-relaxed text-white/95 md:text-lg">
          {subtitle}
        </p>
        <HeroEmailCapture />
      </div>
    </section>
  );
}
