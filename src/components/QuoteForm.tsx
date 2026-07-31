"use client";

import { FormEvent, useState } from "react";

const serviceOptions = [
  "Lawn Care",
  "Snow Removal",
  "Property Maintenance",
  "Seasonal Contract",
  "Not sure yet",
];

export function QuoteForm({
  phone,
  phoneHref,
}: {
  phone?: string;
  phoneHref?: string;
} = {}) {
  const [submitted, setSubmitted] = useState(false);

  function onSubmit(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();
    setSubmitted(true);
  }

  if (submitted) {
    return (
      <div className="rounded-2xl border border-line bg-white p-8 text-center shadow-sm">
        <p className="font-display text-2xl font-bold text-brand">
          Thanks — we got your request.
        </p>
        <p className="mt-3 text-ink-muted">
          A team member will follow up shortly.
          {phone && phoneHref ? (
            <>
              {" "}
              For faster service, call{" "}
              <a href={phoneHref} className="font-semibold text-brand">
                {phone}
              </a>
              .
            </>
          ) : null}
        </p>
      </div>
    );
  }

  return (
    <form
      onSubmit={onSubmit}
      className="rounded-2xl border border-line bg-white p-6 shadow-sm md:p-8"
      noValidate
    >
      <div className="grid gap-5 sm:grid-cols-2">
        <label className="block text-sm">
          <span className="mb-1.5 block font-medium text-ink">Full name</span>
          <input
            required
            name="name"
            type="text"
            autoComplete="name"
            className="w-full rounded-lg border border-line bg-canvas-deep px-3 py-2.5 outline-none ring-brand focus:ring-2"
          />
        </label>
        <label className="block text-sm">
          <span className="mb-1.5 block font-medium text-ink">Phone</span>
          <input
            required
            name="phone"
            type="tel"
            autoComplete="tel"
            className="w-full rounded-lg border border-line bg-canvas-deep px-3 py-2.5 outline-none ring-brand focus:ring-2"
          />
        </label>
        <label className="block text-sm sm:col-span-2">
          <span className="mb-1.5 block font-medium text-ink">Email</span>
          <input
            required
            name="email"
            type="email"
            autoComplete="email"
            className="w-full rounded-lg border border-line bg-canvas-deep px-3 py-2.5 outline-none ring-brand focus:ring-2"
          />
        </label>
        <label className="block text-sm sm:col-span-2">
          <span className="mb-1.5 block font-medium text-ink">Service needed</span>
          <select
            name="service"
            className="w-full rounded-lg border border-line bg-canvas-deep px-3 py-2.5 outline-none ring-brand focus:ring-2"
            defaultValue="Lawn Care"
          >
            {serviceOptions.map((option) => (
              <option key={option} value={option}>
                {option}
              </option>
            ))}
          </select>
        </label>
        <label className="block text-sm sm:col-span-2">
          <span className="mb-1.5 block font-medium text-ink">
            Property address / city
          </span>
          <input
            required
            name="address"
            type="text"
            autoComplete="street-address"
            className="w-full rounded-lg border border-line bg-canvas-deep px-3 py-2.5 outline-none ring-brand focus:ring-2"
          />
        </label>
        <label className="block text-sm sm:col-span-2">
          <span className="mb-1.5 block font-medium text-ink">
            Tell us about your property
          </span>
          <textarea
            name="message"
            rows={4}
            className="w-full resize-y rounded-lg border border-line bg-canvas-deep px-3 py-2.5 outline-none ring-brand focus:ring-2"
          />
        </label>
      </div>
      <button type="submit" className="btn-primary mt-6 w-full sm:w-auto">
        Request Your Free Quote
      </button>
    </form>
  );
}
