import Image from "next/image";
import Link from "next/link";
import type { SiteContent } from "@/lib/content-types";

const quickLinks = [
  { href: "/", label: "Home" },
  { href: "/about", label: "About" },
  {
    href: "/services/lawn-care-and-maintenance",
    label: "Lawn Care and Maintenance",
  },
  { href: "/services/snow-removal-services", label: "Snow Removal Services" },
  {
    href: "/services/property-cleanup-and-maintenance",
    label: "Property Cleanup and Maintenance",
  },
  { href: "/contact", label: "Contact" },
];

export function Footer({ site }: { site: SiteContent["site"] }) {
  return (
    <footer className="footer-grass-full relative mt-auto overflow-hidden text-white">
      <Image
        src={site.heroImage}
        alt=""
        fill
        className="object-cover object-center"
        sizes="100vw"
        aria-hidden
      />
      <div
        className="absolute inset-0 bg-gradient-to-b from-brand/55 via-steel-dark/75 to-steel-dark/92"
        aria-hidden
      />

      <div className="relative z-[1]">
        <div className="mx-auto grid max-w-6xl gap-10 px-5 pb-12 pt-16 md:grid-cols-3 md:px-8 md:pt-20">
          <div>
            <div className="flex items-center gap-3">
              <Image
                src={site.logo}
                alt={`${site.name} logo`}
                width={120}
                height={120}
                quality={100}
                className="h-20 w-20 rounded-full object-contain bg-white shadow-sm"
              />
              <h3
                className="font-display text-lg font-bold leading-snug"
                style={{ color: "#ffffff" }}
              >
                {site.name}
              </h3>
            </div>
          </div>

          <div>
            <h4 className="text-sm font-semibold uppercase tracking-[0.12em] text-white/70">
              Contact
            </h4>
            <ul className="mt-4 space-y-2 text-sm text-white/95">
              <li>
                <a href={site.phoneHref} className="hover:underline">
                  {site.phone}
                </a>
              </li>
              <li>
                <a
                  href={`mailto:${site.email}`}
                  className="break-all hover:underline"
                >
                  {site.email}
                </a>
              </li>
              <li>
                {site.address.line1}
                <br />
                {site.address.city}, {site.address.region} {site.address.postalCode}
              </li>
              <li>
                <a
                  href={site.clientLogin}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="hover:underline"
                >
                  Client Login
                </a>
              </li>
            </ul>
          </div>

          <div>
            <h4 className="text-sm font-semibold uppercase tracking-[0.12em] text-white/70">
              Quick Links
            </h4>
            <ul className="mt-4 space-y-2 text-sm">
              {quickLinks.map((link) => (
                <li key={link.href}>
                  <Link href={link.href} className="hover:underline">
                    {link.label}
                  </Link>
                </li>
              ))}
            </ul>
          </div>
        </div>

        <div className="relative z-[1] border-t border-white/15 px-5 py-5 md:px-8">
          <div className="mx-auto flex max-w-6xl flex-col items-center justify-between gap-3 text-center text-xs text-white/65 sm:flex-row sm:text-left">
            <p>
              © {new Date().getFullYear()} {site.name}. All rights reserved.
            </p>
            <a
              href="https://getjobber.com/"
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center gap-2 text-white/65 hover:text-white/90"
            >
              <span>Powered by</span>
              <Image
                src="https://cdn.jobber.com/yr/logos/v1/logo_jobber_full-white.svg"
                alt="Jobber"
                width={72}
                height={16}
                className="h-4 w-auto opacity-90"
              />
            </a>
          </div>
        </div>
      </div>
    </footer>
  );
}
