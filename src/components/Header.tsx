"use client";

import Image from "next/image";
import Link from "next/link";
import { useEffect, useRef, useState } from "react";
import type { HomeService, SiteContent } from "@/lib/content-types";

type SiteInfo = SiteContent["site"];

export function Header({
  site,
  homeServices,
}: {
  site: SiteInfo;
  homeServices: HomeService[];
}) {
  const [menuOpen, setMenuOpen] = useState(false);
  const [servicesOpen, setServicesOpen] = useState(false);
  const servicesRef = useRef<HTMLDivElement>(null);

  const serviceLinks = homeServices
    .filter((s) => s.href)
    .map((s) => ({ href: s.href as string, label: s.title }));

  useEffect(() => {
    function onDocClick(event: MouseEvent) {
      if (
        servicesRef.current &&
        !servicesRef.current.contains(event.target as Node)
      ) {
        setServicesOpen(false);
      }
    }
    document.addEventListener("mousedown", onDocClick);
    return () => document.removeEventListener("mousedown", onDocClick);
  }, []);

  return (
    <header className="sticky top-0 z-50 border-b border-line bg-white">
      <div className="mx-auto flex min-h-[110px] max-w-6xl items-center justify-between gap-4 px-4 py-3 md:min-h-[120px] md:px-8">
        <div className="flex min-w-0 items-center gap-5 md:gap-8">
          <Link href="/" className="shrink-0" aria-label={site.name}>
            <Image
              src={site.logo}
              alt={`${site.name} logo`}
              width={160}
              height={160}
              quality={100}
              sizes="110px"
              className="h-[88px] w-[88px] rounded-full object-contain shadow-sm ring-1 ring-black/5 md:h-[110px] md:w-[110px]"
              priority
            />
          </Link>

          <nav className="hidden items-center gap-6 lg:flex" aria-label="Primary">
            <Link
              href="/"
              className="text-base font-normal text-heading hover:text-brand"
            >
              Home
            </Link>
            <Link
              href="/about"
              className="text-base font-normal text-heading hover:text-brand"
            >
              About
            </Link>
            <div className="relative" ref={servicesRef}>
              <button
                type="button"
                className="inline-flex items-center gap-1.5 text-base font-normal text-heading hover:text-brand"
                aria-expanded={servicesOpen}
                onClick={() => setServicesOpen((v) => !v)}
              >
                Services
                <svg width="12" height="12" viewBox="0 0 12 12" aria-hidden>
                  <path
                    d="M2.5 4.5L6 8l3.5-3.5"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="1.5"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                  />
                </svg>
              </button>
              {servicesOpen ? (
                <div className="absolute left-0 top-full z-50 mt-3 min-w-[280px] rounded-lg border border-line bg-white py-2 shadow-lg">
                  {serviceLinks.map((link) => (
                    <Link
                      key={link.href}
                      href={link.href}
                      className="block px-4 py-2.5 text-sm text-heading hover:bg-canvas-deep"
                      onClick={() => setServicesOpen(false)}
                    >
                      {link.label}
                    </Link>
                  ))}
                </div>
              ) : null}
            </div>
            <Link
              href="/contact"
              className="text-base font-normal text-heading hover:text-brand"
            >
              Contact
            </Link>
          </nav>
        </div>

        <div className="flex items-center gap-2 sm:gap-3">
          <a
            href={site.phoneHref}
            className="hidden items-center gap-2 text-base font-normal text-heading md:inline-flex"
          >
            <PhoneIcon />
            {site.phone}
          </a>
          <a
            href={site.clientLogin}
            target="_blank"
            rel="noopener noreferrer"
            className="btn-outline hidden sm:inline-flex"
          >
            Client Login
          </a>
          <Link href="/contact" className="btn-primary">
            Get a Quote
          </Link>
          <button
            type="button"
            className="inline-flex h-10 w-10 items-center justify-center rounded-md border border-line text-heading lg:hidden"
            aria-expanded={menuOpen}
            aria-label={menuOpen ? "Close menu" : "Open menu"}
            onClick={() => setMenuOpen((v) => !v)}
          >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden>
              {menuOpen ? (
                <path
                  d="M6 6l12 12M18 6L6 18"
                  stroke="currentColor"
                  strokeWidth="2"
                  strokeLinecap="round"
                />
              ) : (
                <path
                  d="M4 7h16M4 12h16M4 17h16"
                  stroke="currentColor"
                  strokeWidth="2"
                  strokeLinecap="round"
                />
              )}
            </svg>
          </button>
        </div>
      </div>

      {menuOpen ? (
        <nav className="border-t border-line bg-white px-4 py-4 lg:hidden" aria-label="Mobile">
          <ul className="space-y-3">
            <li>
              <Link href="/" className="block text-base" onClick={() => setMenuOpen(false)}>
                Home
              </Link>
            </li>
            <li>
              <Link href="/about" className="block text-base" onClick={() => setMenuOpen(false)}>
                About
              </Link>
            </li>
            {serviceLinks.map((link) => (
              <li key={link.href}>
                <Link
                  href={link.href}
                  className="block text-base"
                  onClick={() => setMenuOpen(false)}
                >
                  {link.label}
                </Link>
              </li>
            ))}
            <li>
              <Link
                href="/contact"
                className="block text-base"
                onClick={() => setMenuOpen(false)}
              >
                Contact
              </Link>
            </li>
            <li>
              <a href={site.phoneHref} className="block text-base">
                {site.phone}
              </a>
            </li>
            <li>
              <a
                href={site.clientLogin}
                target="_blank"
                rel="noopener noreferrer"
                className="block text-base"
              >
                Client Login
              </a>
            </li>
          </ul>
        </nav>
      ) : null}
    </header>
  );
}

function PhoneIcon() {
  return (
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden>
      <path
        d="M6.6 10.8c1.6 3.1 3.5 5 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"
        fill="currentColor"
      />
    </svg>
  );
}
