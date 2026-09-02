"use client";

import Image from "next/image";
import Link from "next/link";
import { useEffect, useRef, useState } from "react";
import type { HomeService, SiteContent } from "@/lib/content-types";

type SiteInfo = SiteContent["site"];

export function Header({
  site,
  homeServices,
  overlay = false,
}: {
  site: SiteInfo;
  homeServices: HomeService[];
  overlay?: boolean;
}) {
  const [menuOpen, setMenuOpen] = useState(false);
  const [servicesOpen, setServicesOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const servicesRef = useRef<HTMLDivElement>(null);

  const transparent = overlay && !scrolled;
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

  useEffect(() => {
    if (!overlay) {
      setScrolled(false);
      return;
    }

    function onScroll() {
      setScrolled(window.scrollY > 48);
    }

    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, [overlay]);

  useEffect(() => {
    setMenuOpen(false);
    setServicesOpen(false);
  }, [overlay, scrolled]);

  const navLinkClass = transparent
    ? "text-white/95 hover:text-white"
    : "text-heading hover:text-brand";
  const phoneClass = transparent
    ? "text-white/95 hover:text-white"
    : "text-heading hover:text-brand";
  const menuButtonClass = transparent
    ? "border-white/30 text-white"
    : "border-line text-heading";

  return (
    <header
      className={`left-0 right-0 top-0 z-50 transition-colors duration-300 ${
        overlay ? "fixed" : "sticky"
      } ${
        transparent
          ? "border-b border-transparent bg-transparent"
          : "border-b border-line bg-white/95 backdrop-blur-md"
      }`}
    >
      <div className="mx-auto flex h-[72px] max-w-[1460px] items-center justify-between gap-4 px-5 md:h-[80px] md:px-8 lg:px-10">
        <Link
          href="/"
          className="flex min-w-0 shrink-0 items-center gap-3"
          aria-label={site.name}
        >
          <Image
            src={site.logo}
            alt={`${site.name} logo`}
            width={80}
            height={80}
            quality={100}
            sizes="40px"
            className="h-9 w-9 rounded-full object-contain md:h-10 md:w-10"
            priority
          />
          <span
            className={`hidden max-w-[180px] truncate text-sm font-medium tracking-tight sm:block md:max-w-[220px] md:text-base ${
              transparent ? "text-white" : "text-heading"
            }`}
          >
            {site.shortName}
          </span>
        </Link>

        <nav
          className="absolute left-1/2 hidden -translate-x-1/2 items-center gap-7 lg:flex"
          aria-label="Primary"
        >
          <Link href="/" className={`text-sm font-medium ${navLinkClass}`}>
            Home
          </Link>
          <Link href="/about" className={`text-sm font-medium ${navLinkClass}`}>
            About
          </Link>
          <Link href="/contact" className={`text-sm font-medium ${navLinkClass}`}>
            Contact
          </Link>
          <div className="relative" ref={servicesRef}>
            <button
              type="button"
              className={`inline-flex items-center gap-1 text-sm font-medium ${navLinkClass}`}
              aria-expanded={servicesOpen}
              onClick={() => setServicesOpen((value) => !value)}
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
              <div className="absolute left-1/2 top-full z-50 mt-3 min-w-[280px] -translate-x-1/2 rounded-xl border border-line bg-white py-2 shadow-xl">
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
          <Link href="/faq" className={`text-sm font-medium ${navLinkClass}`}>
            FAQ
          </Link>
        </nav>

        <div className="flex items-center gap-2 sm:gap-3">
          <a
            href={site.phoneHref}
            className={`hidden items-center gap-2 text-sm font-medium md:inline-flex ${phoneClass}`}
          >
            <PhoneIcon />
            {site.phone}
          </a>
          <Link href="/contact" className="btn-book-now">
            Book now
          </Link>
          <button
            type="button"
            className={`inline-flex h-10 w-10 items-center justify-center rounded-full border lg:hidden ${menuButtonClass}`}
            aria-expanded={menuOpen}
            aria-label={menuOpen ? "Close menu" : "Open menu"}
            onClick={() => setMenuOpen((value) => !value)}
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
        <nav
          className={`border-t px-5 py-4 lg:hidden ${
            transparent
              ? "border-white/15 bg-black/80 backdrop-blur-md"
              : "border-line bg-white"
          }`}
          aria-label="Mobile"
        >
          <ul className="space-y-3">
            {[
              { href: "/", label: "Home" },
              { href: "/about", label: "About" },
              { href: "/contact", label: "Contact" },
              { href: "/faq", label: "FAQ" },
            ].map((link) => (
              <li key={link.href}>
                <Link
                  href={link.href}
                  className={`block text-base ${transparent ? "text-white" : "text-heading"}`}
                  onClick={() => setMenuOpen(false)}
                >
                  {link.label}
                </Link>
              </li>
            ))}
            {serviceLinks.map((link) => (
              <li key={link.href}>
                <Link
                  href={link.href}
                  className={`block text-base ${transparent ? "text-white/90" : "text-heading"}`}
                  onClick={() => setMenuOpen(false)}
                >
                  {link.label}
                </Link>
              </li>
            ))}
            <li>
              <a
                href={site.phoneHref}
                className={`block text-base ${transparent ? "text-white" : "text-heading"}`}
              >
                {site.phone}
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
