import type { Metadata } from "next";
import { ServicePageView } from "@/components/ServicePageView";
import { getSiteContent } from "@/lib/content";

export async function generateMetadata(): Promise<Metadata> {
  const { propertyPage } = await getSiteContent();
  return {
    title: propertyPage.title,
    description: propertyPage.metaDescription,
    alternates: { canonical: `/services/${propertyPage.slug}` },
  };
}

export default async function PropertyCleanupPage() {
  const { propertyPage, site } = await getSiteContent();
  return <ServicePageView data={propertyPage} site={site} />;
}
