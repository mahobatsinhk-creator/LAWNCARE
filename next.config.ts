import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  images: {
    remotePatterns: [
      {
        protocol: "https",
        hostname: "images.unsplash.com",
      },
      {
        protocol: "https",
        hostname: "d13cw1lxlociqy.cloudfront.net",
      },
      {
        protocol: "https",
        hostname: "cdn.jobber.com",
      },
    ],
  },
  async redirects() {
    return [
      {
        source: "/lawn-care",
        destination: "/services/lawn-care-and-maintenance",
        permanent: true,
      },
      {
        source: "/snow-removal",
        destination: "/services/snow-removal-services",
        permanent: true,
      },
      {
        source: "/property-maintenance",
        destination: "/services/property-cleanup-and-maintenance",
        permanent: true,
      },
    ];
  },
};

export default nextConfig;
