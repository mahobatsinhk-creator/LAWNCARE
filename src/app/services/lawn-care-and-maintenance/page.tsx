import type { Metadata } from "next";
import { ServicePageView } from "@/components/ServicePageView";
import { getSiteContent } from "@/lib/content";

export async function generateMetadata(): Promise<Metadata> {
  const { lawnPage } = await getSiteContent();
  return {
    title: lawnPage.title,
    description: lawnPage.metaDescription,
    alternates: { canonical: `/services/${lawnPage.slug}` },
  };
}

export default async function LawnCarePage() {
  const { lawnPage, site } = await getSiteContent();
  return <ServicePageView data={lawnPage} site={site} />;
}
