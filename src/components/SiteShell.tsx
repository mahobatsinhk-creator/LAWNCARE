"use client";

import { usePathname } from "next/navigation";
import { Footer } from "@/components/Footer";
import { Header } from "@/components/Header";
import type { SiteContent } from "@/lib/content-types";

export function SiteShell({
  children,
  content,
}: {
  children: React.ReactNode;
  content: SiteContent;
}) {
  const pathname = usePathname();
  const isAdmin = pathname.startsWith("/admin");

  if (isAdmin) {
    return <>{children}</>;
  }

  const isHome = pathname === "/";

  return (
    <>
      <Header
        site={content.site}
        homeServices={content.homeServices}
        overlay={isHome}
      />
      <main className="flex-1">{children}</main>
      <Footer site={content.site} />
    </>
  );
}
