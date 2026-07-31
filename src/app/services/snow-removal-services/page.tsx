import type { Metadata } from "next";
import { ServicePageView } from "@/components/ServicePageView";
import { getSiteContent } from "@/lib/content";

export async function generateMetadata(): Promise<Metadata> {
  const { snowPage } = await getSiteContent();
  return {
    title: snowPage.title,
    description: snowPage.metaDescription,
    alternates: { canonical: `/services/${snowPage.slug}` },
  };
}

export default async function SnowRemovalServicesPage() {
  const { snowPage, site } = await getSiteContent();
  return <ServicePageView data={snowPage} site={site} />;
}
