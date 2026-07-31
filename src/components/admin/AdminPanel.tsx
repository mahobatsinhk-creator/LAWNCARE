"use client";

import { useEffect, useState, type FormEvent } from "react";
import type {
  BenefitItem,
  FaqItem,
  HomeService,
  ServicePageContent,
  SiteContent,
} from "@/lib/content-types";

type Tab =
  | "business"
  | "home"
  | "whyUs"
  | "services"
  | "areas"
  | "faqs"
  | "about"
  | "snow"
  | "lawn"
  | "property";

const TABS: { id: Tab; label: string }[] = [
  { id: "business", label: "Business" },
  { id: "home", label: "Homepage" },
  { id: "whyUs", label: "Why Us" },
  { id: "services", label: "Service cards" },
  { id: "areas", label: "Areas" },
  { id: "faqs", label: "Home FAQs" },
  { id: "about", label: "About" },
  { id: "snow", label: "Snow page" },
  { id: "lawn", label: "Lawn page" },
  { id: "property", label: "Property page" },
];

function Field({
  label,
  value,
  onChange,
  multiline,
}: {
  label: string;
  value: string;
  onChange: (v: string) => void;
  multiline?: boolean;
}) {
  return (
    <label className="block space-y-1.5">
      <span className="text-xs font-semibold uppercase tracking-wide text-slate-500">
        {label}
      </span>
      {multiline ? (
        <textarea
          value={value}
          onChange={(e) => onChange(e.target.value)}
          rows={4}
          className="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 outline-none focus:border-emerald-600"
        />
      ) : (
        <input
          type="text"
          value={value}
          onChange={(e) => onChange(e.target.value)}
          className="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 outline-none focus:border-emerald-600"
        />
      )}
    </label>
  );
}

function FaqEditor({
  items,
  onChange,
}: {
  items: FaqItem[];
  onChange: (items: FaqItem[]) => void;
}) {
  return (
    <div className="space-y-4">
      {items.map((item, index) => (
        <div
          key={index}
          className="space-y-3 rounded-xl border border-slate-200 bg-slate-50 p-4"
        >
          <div className="flex items-center justify-between">
            <p className="text-sm font-semibold text-slate-700">FAQ {index + 1}</p>
            <button
              type="button"
              className="text-xs font-semibold text-red-600"
              onClick={() => onChange(items.filter((_, i) => i !== index))}
            >
              Remove
            </button>
          </div>
          <Field
            label="Question"
            value={item.question}
            onChange={(question) =>
              onChange(items.map((f, i) => (i === index ? { ...f, question } : f)))
            }
          />
          <Field
            label="Answer"
            value={item.answer}
            multiline
            onChange={(answer) =>
              onChange(items.map((f, i) => (i === index ? { ...f, answer } : f)))
            }
          />
        </div>
      ))}
      <button
        type="button"
        className="rounded-lg border border-slate-300 px-3 py-2 text-sm font-semibold text-slate-700"
        onClick={() => onChange([...items, { question: "", answer: "" }])}
      >
        Add FAQ
      </button>
    </div>
  );
}

function BenefitEditor({
  items,
  onChange,
}: {
  items: BenefitItem[];
  onChange: (items: BenefitItem[]) => void;
}) {
  return (
    <div className="space-y-4">
      {items.map((item, index) => (
        <div
          key={index}
          className="space-y-3 rounded-xl border border-slate-200 bg-slate-50 p-4"
        >
          <div className="flex items-center justify-between">
            <p className="text-sm font-semibold text-slate-700">Item {index + 1}</p>
            <button
              type="button"
              className="text-xs font-semibold text-red-600"
              onClick={() => onChange(items.filter((_, i) => i !== index))}
            >
              Remove
            </button>
          </div>
          <Field
            label="Title"
            value={item.title}
            onChange={(title) =>
              onChange(items.map((f, i) => (i === index ? { ...f, title } : f)))
            }
          />
          <Field
            label="Text"
            value={item.text}
            multiline
            onChange={(text) =>
              onChange(items.map((f, i) => (i === index ? { ...f, text } : f)))
            }
          />
        </div>
      ))}
      <button
        type="button"
        className="rounded-lg border border-slate-300 px-3 py-2 text-sm font-semibold text-slate-700"
        onClick={() => onChange([...items, { title: "", text: "" }])}
      >
        Add item
      </button>
    </div>
  );
}

function ServicePageEditor({
  data,
  onChange,
}: {
  data: ServicePageContent;
  onChange: (data: ServicePageContent) => void;
}) {
  return (
    <div className="space-y-4">
      <div className="grid gap-4 md:grid-cols-2">
        <Field label="Title" value={data.title} onChange={(title) => onChange({ ...data, title })} />
        <Field
          label="Hero title (optional)"
          value={data.heroTitle ?? ""}
          onChange={(heroTitle) => onChange({ ...data, heroTitle })}
        />
        <Field label="Slug" value={data.slug} onChange={(slug) => onChange({ ...data, slug })} />
        <Field
          label="Hero CTA"
          value={data.heroCta}
          onChange={(heroCta) => onChange({ ...data, heroCta })}
        />
      </div>
      <Field
        label="Meta description"
        value={data.metaDescription}
        multiline
        onChange={(metaDescription) => onChange({ ...data, metaDescription })}
      />
      <Field
        label="Hero text"
        value={data.heroText}
        multiline
        onChange={(heroText) => onChange({ ...data, heroText })}
      />
      <Field
        label="Hero image URL"
        value={data.heroImage}
        onChange={(heroImage) => onChange({ ...data, heroImage })}
      />
      <div className="grid gap-4 md:grid-cols-2">
        <Field
          label="Features badge"
          value={data.featuresBadge}
          onChange={(featuresBadge) => onChange({ ...data, featuresBadge })}
        />
        <Field
          label="Features title"
          value={data.featuresTitle}
          onChange={(featuresTitle) => onChange({ ...data, featuresTitle })}
        />
      </div>
      <Field
        label="Features image URL"
        value={data.featuresImage}
        onChange={(featuresImage) => onChange({ ...data, featuresImage })}
      />
      <div>
        <p className="mb-3 text-sm font-semibold text-slate-800">Benefits</p>
        <BenefitEditor
          items={data.benefits}
          onChange={(benefits) => onChange({ ...data, benefits })}
        />
      </div>
      <div>
        <p className="mb-3 text-sm font-semibold text-slate-800">Gallery image URLs</p>
        <div className="space-y-2">
          {data.gallery.map((url, index) => (
            <div key={index} className="flex gap-2">
              <input
                value={url}
                onChange={(e) => {
                  const gallery = [...data.gallery];
                  gallery[index] = e.target.value;
                  onChange({ ...data, gallery });
                }}
                className="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"
              />
              <button
                type="button"
                className="text-xs font-semibold text-red-600"
                onClick={() =>
                  onChange({
                    ...data,
                    gallery: data.gallery.filter((_, i) => i !== index),
                  })
                }
              >
                Remove
              </button>
            </div>
          ))}
          <button
            type="button"
            className="rounded-lg border border-slate-300 px-3 py-2 text-sm font-semibold"
            onClick={() => onChange({ ...data, gallery: [...data.gallery, ""] })}
          >
            Add image URL
          </button>
        </div>
      </div>
      <Field
        label="CTA title"
        value={data.ctaTitle}
        onChange={(ctaTitle) => onChange({ ...data, ctaTitle })}
      />
      <Field
        label="CTA text"
        value={data.ctaText}
        multiline
        onChange={(ctaText) => onChange({ ...data, ctaText })}
      />
      <Field
        label="CTA button"
        value={data.ctaButton}
        onChange={(ctaButton) => onChange({ ...data, ctaButton })}
      />
      <Field
        label="FAQ title"
        value={data.faqTitle}
        onChange={(faqTitle) => onChange({ ...data, faqTitle })}
      />
      <Field
        label="FAQ intro"
        value={data.faqIntro}
        onChange={(faqIntro) => onChange({ ...data, faqIntro })}
      />
      <FaqEditor items={data.faqs} onChange={(faqs) => onChange({ ...data, faqs })} />
      <Field
        label="Quote section title"
        value={data.quoteTitle}
        onChange={(quoteTitle) => onChange({ ...data, quoteTitle })}
      />
    </div>
  );
}

export function AdminPanel({
  initialContent,
  initiallyAuthed,
}: {
  initialContent: SiteContent;
  initiallyAuthed: boolean;
}) {
  const [authed, setAuthed] = useState(initiallyAuthed);
  const [password, setPassword] = useState("");
  const [content, setContent] = useState(initialContent);
  const [tab, setTab] = useState<Tab>("business");
  const [status, setStatus] = useState<string | null>(null);
  const [saving, setSaving] = useState(false);
  const [loggingIn, setLoggingIn] = useState(false);

  useEffect(() => {
    if (!authed) return;
    fetch("/api/admin/content")
      .then((r) => (r.ok ? r.json() : null))
      .then((data) => {
        if (data) setContent(data);
      })
      .catch(() => undefined);
  }, [authed]);

  async function onLogin(e: FormEvent) {
    e.preventDefault();
    setLoggingIn(true);
    setStatus(null);
    const res = await fetch("/api/admin/login", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ password }),
    });
    setLoggingIn(false);
    if (!res.ok) {
      setStatus("Wrong password.");
      return;
    }
    setAuthed(true);
    setPassword("");
    setStatus(null);
  }

  async function onLogout() {
    await fetch("/api/admin/logout", { method: "POST" });
    setAuthed(false);
  }

  async function onSave() {
    setSaving(true);
    setStatus(null);
    const res = await fetch("/api/admin/content", {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(content),
    });
    setSaving(false);
    if (!res.ok) {
      setStatus("Save failed. Check you are logged in.");
      return;
    }
    setStatus("Saved. Public site will show the new content.");
  }

  if (!authed) {
    return (
      <div className="mx-auto flex min-h-screen max-w-md flex-col justify-center px-5">
        <h1 className="font-display text-3xl font-bold text-slate-900">Admin login</h1>
        <p className="mt-2 text-sm text-slate-600">
          Edit business details, homepage copy, FAQs, and service pages.
        </p>
        <form onSubmit={onLogin} className="mt-8 space-y-4">
          <label className="block space-y-1.5">
            <span className="text-xs font-semibold uppercase tracking-wide text-slate-500">
              Password
            </span>
            <input
              type="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              className="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 outline-none focus:border-emerald-600"
              autoComplete="current-password"
            />
          </label>
          <button
            type="submit"
            disabled={loggingIn}
            className="w-full rounded-lg bg-emerald-700 px-4 py-3 text-sm font-semibold text-white disabled:opacity-60"
          >
            {loggingIn ? "Signing in…" : "Sign in"}
          </button>
          {status ? <p className="text-sm text-red-600">{status}</p> : null}
        </form>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-slate-100 text-slate-900">
      <header className="sticky top-0 z-10 border-b border-slate-200 bg-white">
        <div className="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-3 px-5 py-4">
          <div>
            <h1 className="font-display text-xl font-bold">Content admin</h1>
            <p className="text-xs text-slate-500">Changes save to content/site-content.json</p>
          </div>
          <div className="flex items-center gap-2">
            <a
              href="/"
              target="_blank"
              rel="noreferrer"
              className="rounded-lg border border-slate-300 px-3 py-2 text-sm font-semibold"
            >
              View site
            </a>
            <button
              type="button"
              onClick={onSave}
              disabled={saving}
              className="rounded-lg bg-emerald-700 px-4 py-2 text-sm font-semibold text-white disabled:opacity-60"
            >
              {saving ? "Saving…" : "Save all"}
            </button>
            <button
              type="button"
              onClick={onLogout}
              className="rounded-lg px-3 py-2 text-sm font-semibold text-slate-600"
            >
              Log out
            </button>
          </div>
        </div>
        <div className="mx-auto flex max-w-6xl gap-1 overflow-x-auto px-5 pb-3">
          {TABS.map((t) => (
            <button
              key={t.id}
              type="button"
              onClick={() => setTab(t.id)}
              className={`whitespace-nowrap rounded-full px-3 py-1.5 text-xs font-semibold ${
                tab === t.id
                  ? "bg-emerald-700 text-white"
                  : "bg-slate-200 text-slate-700"
              }`}
            >
              {t.label}
            </button>
          ))}
        </div>
      </header>

      <main className="mx-auto max-w-6xl px-5 py-8">
        {status ? (
          <p className="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {status}
          </p>
        ) : null}

        {tab === "business" ? (
          <div className="grid gap-4 md:grid-cols-2">
            <Field
              label="Business name"
              value={content.site.name}
              onChange={(name) =>
                setContent({ ...content, site: { ...content.site, name, shortName: name } })
              }
            />
            <Field
              label="Tagline"
              value={content.site.tagline}
              onChange={(tagline) =>
                setContent({ ...content, site: { ...content.site, tagline } })
              }
            />
            <Field
              label="Phone"
              value={content.site.phone}
              onChange={(phone) =>
                setContent({ ...content, site: { ...content.site, phone } })
              }
            />
            <Field
              label="Phone link (tel:)"
              value={content.site.phoneHref}
              onChange={(phoneHref) =>
                setContent({ ...content, site: { ...content.site, phoneHref } })
              }
            />
            <Field
              label="Email"
              value={content.site.email}
              onChange={(email) =>
                setContent({ ...content, site: { ...content.site, email } })
              }
            />
            <Field
              label="Website URL"
              value={content.site.url}
              onChange={(url) => setContent({ ...content, site: { ...content.site, url } })}
            />
            <Field
              label="Client login URL"
              value={content.site.clientLogin}
              onChange={(clientLogin) =>
                setContent({ ...content, site: { ...content.site, clientLogin } })
              }
            />
            <Field
              label="Address line"
              value={content.site.address.line1}
              onChange={(line1) =>
                setContent({
                  ...content,
                  site: { ...content.site, address: { ...content.site.address, line1 } },
                })
              }
            />
            <Field
              label="City"
              value={content.site.address.city}
              onChange={(city) =>
                setContent({
                  ...content,
                  site: { ...content.site, address: { ...content.site.address, city } },
                })
              }
            />
            <Field
              label="Region"
              value={content.site.address.region}
              onChange={(region) =>
                setContent({
                  ...content,
                  site: { ...content.site, address: { ...content.site.address, region } },
                })
              }
            />
            <Field
              label="Postal code"
              value={content.site.address.postalCode}
              onChange={(postalCode) =>
                setContent({
                  ...content,
                  site: {
                    ...content.site,
                    address: { ...content.site.address, postalCode },
                  },
                })
              }
            />
            <Field
              label="SEO description"
              value={content.site.description}
              multiline
              onChange={(description) =>
                setContent({ ...content, site: { ...content.site, description } })
              }
            />
            <Field
              label="Logo URL"
              value={content.site.logo}
              onChange={(logo) =>
                setContent({ ...content, site: { ...content.site, logo } })
              }
            />
            <Field
              label="Hero image URL"
              value={content.site.heroImage}
              onChange={(heroImage) =>
                setContent({ ...content, site: { ...content.site, heroImage } })
              }
            />
            <Field
              label="Why Us image URL"
              value={content.site.whyUsImage}
              onChange={(whyUsImage) =>
                setContent({ ...content, site: { ...content.site, whyUsImage } })
              }
            />
            <Field
              label="Mid CTA image URL"
              value={content.site.ctaImage}
              onChange={(ctaImage) =>
                setContent({ ...content, site: { ...content.site, ctaImage } })
              }
            />
            <Field
              label="Promise image URL"
              value={content.site.promiseImage}
              onChange={(promiseImage) =>
                setContent({ ...content, site: { ...content.site, promiseImage } })
              }
            />
          </div>
        ) : null}

        {tab === "home" ? (
          <div className="grid gap-4 md:grid-cols-2">
            {(
              [
                ["heroSubtitle", "Hero subtitle", true],
                ["heroCta", "Hero CTA", false],
                ["whyUsBadge", "Why Us badge", false],
                ["whyUsTitle", "Why Us title", false],
                ["servicesBadge", "Services badge", false],
                ["servicesTitle", "Services title", false],
                ["midCtaTitle", "Mid CTA title", false],
                ["midCtaText", "Mid CTA text", true],
                ["midCtaButton", "Mid CTA button", false],
                ["areasBadge", "Areas badge", false],
                ["areasTitle", "Areas title", false],
                ["areasCta", "Areas CTA", false],
                ["promiseTitle", "Promise title", false],
                ["faqsBadge", "FAQs badge", false],
                ["faqsTitle", "FAQs title", false],
                ["faqsSubtitle", "FAQs subtitle", false],
                ["quoteTitle", "Quote title", false],
                ["quoteText", "Quote text", true],
              ] as const
            ).map(([key, label, multiline]) => (
              <Field
                key={key}
                label={label}
                value={content.home[key]}
                multiline={multiline}
                onChange={(value) =>
                  setContent({ ...content, home: { ...content.home, [key]: value } })
                }
              />
            ))}
            <div className="md:col-span-2">
              <Field
                label="Promise body text"
                value={content.promiseText}
                multiline
                onChange={(promiseText) => setContent({ ...content, promiseText })}
              />
            </div>
          </div>
        ) : null}

        {tab === "whyUs" ? (
          <BenefitEditor
            items={content.whyUs}
            onChange={(whyUs) => setContent({ ...content, whyUs })}
          />
        ) : null}

        {tab === "services" ? (
          <div className="space-y-4">
            {content.homeServices.map((service, index) => (
              <div
                key={index}
                className="space-y-3 rounded-xl border border-slate-200 bg-white p-4"
              >
                <div className="flex justify-between">
                  <p className="text-sm font-semibold">Card {index + 1}</p>
                  <button
                    type="button"
                    className="text-xs font-semibold text-red-600"
                    onClick={() =>
                      setContent({
                        ...content,
                        homeServices: content.homeServices.filter((_, i) => i !== index),
                      })
                    }
                  >
                    Remove
                  </button>
                </div>
                <Field
                  label="Title"
                  value={service.title}
                  onChange={(title) => {
                    const homeServices = [...content.homeServices];
                    homeServices[index] = { ...service, title };
                    setContent({ ...content, homeServices });
                  }}
                />
                <Field
                  label="Short description"
                  value={service.short}
                  multiline
                  onChange={(short) => {
                    const homeServices = [...content.homeServices];
                    homeServices[index] = { ...service, short };
                    setContent({ ...content, homeServices });
                  }}
                />
                <Field
                  label="Link (empty = no link)"
                  value={service.href ?? ""}
                  onChange={(href) => {
                    const homeServices = [...content.homeServices];
                    homeServices[index] = {
                      ...service,
                      href: href.trim() ? href : null,
                    };
                    setContent({ ...content, homeServices });
                  }}
                />
                <Field
                  label="Image URL"
                  value={service.image}
                  onChange={(image) => {
                    const homeServices = [...content.homeServices];
                    homeServices[index] = { ...service, image };
                    setContent({ ...content, homeServices });
                  }}
                />
                <label className="flex items-center gap-2 text-sm">
                  <input
                    type="checkbox"
                    checked={Boolean(service.comingSoon)}
                    onChange={(e) => {
                      const homeServices: HomeService[] = [...content.homeServices];
                      homeServices[index] = {
                        ...service,
                        comingSoon: e.target.checked,
                      };
                      setContent({ ...content, homeServices });
                    }}
                  />
                  Coming soon
                </label>
              </div>
            ))}
            <button
              type="button"
              className="rounded-lg border border-slate-300 px-3 py-2 text-sm font-semibold"
              onClick={() =>
                setContent({
                  ...content,
                  homeServices: [
                    ...content.homeServices,
                    { title: "", short: "", href: null, image: "" },
                  ],
                })
              }
            >
              Add service card
            </button>
          </div>
        ) : null}

        {tab === "areas" ? (
          <div className="space-y-3">
            {content.serviceAreas.map((area, index) => (
              <div key={index} className="flex gap-2">
                <input
                  value={area}
                  onChange={(e) => {
                    const serviceAreas = [...content.serviceAreas];
                    serviceAreas[index] = e.target.value;
                    setContent({ ...content, serviceAreas });
                  }}
                  className="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"
                />
                <button
                  type="button"
                  className="text-xs font-semibold text-red-600"
                  onClick={() =>
                    setContent({
                      ...content,
                      serviceAreas: content.serviceAreas.filter((_, i) => i !== index),
                    })
                  }
                >
                  Remove
                </button>
              </div>
            ))}
            <button
              type="button"
              className="rounded-lg border border-slate-300 px-3 py-2 text-sm font-semibold"
              onClick={() =>
                setContent({
                  ...content,
                  serviceAreas: [...content.serviceAreas, ""],
                })
              }
            >
              Add area
            </button>
          </div>
        ) : null}

        {tab === "faqs" ? (
          <FaqEditor
            items={content.homeFaqs}
            onChange={(homeFaqs) => setContent({ ...content, homeFaqs })}
          />
        ) : null}

        {tab === "about" ? (
          <div className="grid gap-4 md:grid-cols-2">
            <Field
              label="Badge"
              value={content.about.badge}
              onChange={(badge) =>
                setContent({ ...content, about: { ...content.about, badge } })
              }
            />
            <Field
              label="Story badge"
              value={content.about.storyBadge}
              onChange={(storyBadge) =>
                setContent({ ...content, about: { ...content.about, storyBadge } })
              }
            />
            <Field
              label="Story title"
              value={content.about.storyTitle}
              onChange={(storyTitle) =>
                setContent({ ...content, about: { ...content.about, storyTitle } })
              }
            />
            <Field
              label="CTA label"
              value={content.about.ctaLabel}
              onChange={(ctaLabel) =>
                setContent({ ...content, about: { ...content.about, ctaLabel } })
              }
            />
            <div className="md:col-span-2">
              <Field
                label="Extra story text (use {city} for city name)"
                value={content.about.storyExtra}
                multiline
                onChange={(storyExtra) =>
                  setContent({ ...content, about: { ...content.about, storyExtra } })
                }
              />
            </div>
          </div>
        ) : null}

        {tab === "snow" ? (
          <ServicePageEditor
            data={content.snowPage}
            onChange={(snowPage) => setContent({ ...content, snowPage })}
          />
        ) : null}
        {tab === "lawn" ? (
          <ServicePageEditor
            data={content.lawnPage}
            onChange={(lawnPage) => setContent({ ...content, lawnPage })}
          />
        ) : null}
        {tab === "property" ? (
          <ServicePageEditor
            data={content.propertyPage}
            onChange={(propertyPage) => setContent({ ...content, propertyPage })}
          />
        ) : null}
      </main>
    </div>
  );
}
