import type { Metadata } from "next";
import { Open_Sans, Poppins } from "next/font/google";
import { JsonLd } from "@/components/JsonLd";
import { SiteShell } from "@/components/SiteShell";
import { getSiteContent } from "@/lib/content";
import { localBusinessSchema } from "@/lib/schema";
import "./globals.css";

const display = Poppins({
  variable: "--font-display",
  subsets: ["latin"],
  weight: ["500", "600", "700"],
});

const sans = Open_Sans({
  variable: "--font-sans",
  subsets: ["latin"],
  weight: ["400", "500", "600", "700"],
});

export async function generateMetadata(): Promise<Metadata> {
  const { site } = await getSiteContent();
  return {
    metadataBase: new URL(site.url),
    title: {
      default: `${site.name}: reliable snow removal and lawn care in Spruce Grove`,
      template: `%s | ${site.name}`,
    },
    description: site.description,
    keywords: [
      "year-round lawn care and snow removal",
      "reliable local snow removal crew",
      "residential and commercial snow care",
      "snow removal Spruce Grove",
      "driveway snow plowing",
      "sidewalk ice melt application",
      "fall cleanup Spruce Grove",
      "weed control Alberta",
      "fertilization services",
      "seasonal snow removal contracts",
      "Spruce Grove",
      "Alberta",
      "Edmonton",
      "St. Albert",
      "Stony Plain",
      "Leduc",
      "Acheson",
    ],
    alternates: { canonical: "/" },
    openGraph: {
      type: "website",
      locale: "en_CA",
      url: site.url,
      siteName: site.name,
      title: `${site.name}: reliable snow removal and lawn care in Spruce Grove`,
      description: site.description,
      images: [{ url: "/opengraph-image", width: 1200, height: 630 }],
    },
    twitter: {
      card: "summary_large_image",
      title: `${site.name}: reliable snow removal and lawn care in Spruce Grove`,
      description: site.description,
      images: ["/opengraph-image"],
    },
    robots: { index: true, follow: true },
  };
}

export default async function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  const content = await getSiteContent();

  return (
    <html lang="en-CA" className={`${display.variable} ${sans.variable} h-full`}>
      <body className="flex min-h-full flex-col bg-canvas text-ink antialiased">
        <JsonLd
          data={localBusinessSchema(content.site, content.serviceAreas)}
        />
        <SiteShell content={content}>{children}</SiteShell>
      </body>
    </html>
  );
}
