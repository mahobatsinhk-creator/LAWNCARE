"use client";

import Link from "next/link";
import { useRouter } from "next/navigation";
import { FormEvent, useState } from "react";

export function HeroEmailCapture() {
  const router = useRouter();
  const [email, setEmail] = useState("");

  function handleSubmit(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();
    const trimmed = email.trim();
    if (trimmed) {
      router.push(`/contact?email=${encodeURIComponent(trimmed)}`);
      return;
    }
    router.push("/contact");
  }

  return (
    <div className="hero-cta-row animate-rise-delay">
      <form className="hero-email-form" onSubmit={handleSubmit}>
        <input
          type="email"
          name="email"
          value={email}
          onChange={(event) => setEmail(event.target.value)}
          placeholder="Enter email address"
          className="hero-email-input"
          aria-label="Email address"
        />
        <button type="submit" className="hero-email-submit" aria-label="Submit email">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden>
            <path
              d="M5 12h14M13 6l6 6-6 6"
              stroke="currentColor"
              strokeWidth="2"
              strokeLinecap="round"
              strokeLinejoin="round"
            />
          </svg>
        </button>
      </form>
      <Link href="#services" className="hero-services-btn">
        View services
      </Link>
    </div>
  );
}
