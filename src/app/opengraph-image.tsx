import { ImageResponse } from "next/og";
import { getSiteContent } from "@/lib/content";

export const alt = "Lawn care and snow removal";
export const size = { width: 1200, height: 630 };
export const contentType = "image/png";

export default async function OgImage() {
  const { site } = await getSiteContent();

  return new ImageResponse(
    (
      <div
        style={{
          height: "100%",
          width: "100%",
          display: "flex",
          flexDirection: "column",
          justifyContent: "flex-end",
          padding: 72,
          background:
            "linear-gradient(135deg, #182b37 0%, #36627d 55%, #176941 100%)",
          color: "#ffffff",
        }}
      >
        <div style={{ fontSize: 48, fontWeight: 700, maxWidth: 900 }}>
          {site.name}
        </div>
        <div style={{ marginTop: 16, fontSize: 36, opacity: 0.95 }}>
          {site.tagline}
        </div>
        <div style={{ marginTop: 24, fontSize: 22, opacity: 0.8 }}>
          {site.address.city}, {site.address.region}
        </div>
      </div>
    ),
    { ...size },
  );
}
