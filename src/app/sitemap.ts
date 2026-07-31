import type { MetadataRoute } from "next";
import { getSiteContent } from "@/lib/content";

export default async function sitemap(): Promise<MetadataRoute.Sitemap> {
  const { site } = await getSiteContent();
  const routes = [
    "",
    "/about",
    "/services/snow-removal-services",
    "/services/lawn-care-and-maintenance",
    "/services/property-cleanup-and-maintenance",
    "/contact",
    "/faq",
  ];

  return routes.map((path) => ({
    url: `${site.url}${path || "/"}`,
    lastModified: new Date(),
    changeFrequency: "weekly" as const,
    priority: path === "" ? 1 : 0.8,
  }));
}
