import type { MetadataRoute } from "next";
import { getSiteContent } from "@/lib/content";

export default async function robots(): Promise<MetadataRoute.Robots> {
  const { site } = await getSiteContent();
  return {
    rules: [
      {
        userAgent: "*",
        allow: "/",
        disallow: ["/admin", "/api/admin"],
      },
    ],
    sitemap: `${site.url}/sitemap.xml`,
    host: site.url,
  };
}
