import { NextResponse } from "next/server";
import { isAdminAuthenticated } from "@/lib/admin-auth";
import { getSiteContent, saveSiteContent } from "@/lib/content";
import type { SiteContent } from "@/lib/content-types";
import { revalidatePath } from "next/cache";

export async function GET() {
  if (!(await isAdminAuthenticated())) {
    return NextResponse.json({ error: "Unauthorized" }, { status: 401 });
  }
  const content = await getSiteContent();
  return NextResponse.json(content);
}

export async function PUT(request: Request) {
  if (!(await isAdminAuthenticated())) {
    return NextResponse.json({ error: "Unauthorized" }, { status: 401 });
  }

  const content = (await request.json().catch(() => null)) as SiteContent | null;
  if (!content?.site?.name) {
    return NextResponse.json({ error: "Invalid content" }, { status: 400 });
  }

  await saveSiteContent(content);
  revalidatePath("/", "layout");
  return NextResponse.json({ ok: true });
}
