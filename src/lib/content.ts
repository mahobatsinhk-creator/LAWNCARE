import { promises as fs } from "fs";
import path from "path";
import { unstable_noStore as noStore } from "next/cache";
import { defaultSiteContent } from "@/lib/site";
import type { SiteContent } from "@/lib/content-types";

const CONTENT_DIR = path.join(process.cwd(), "content");
const CONTENT_FILE = path.join(CONTENT_DIR, "site-content.json");

function deepMerge<T extends Record<string, unknown>>(
  base: T,
  override: Partial<T>,
): T {
  const out = { ...base };
  for (const key of Object.keys(override) as (keyof T)[]) {
    const value = override[key];
    if (
      value &&
      typeof value === "object" &&
      !Array.isArray(value) &&
      typeof base[key] === "object" &&
      base[key] !== null &&
      !Array.isArray(base[key])
    ) {
      out[key] = deepMerge(
        base[key] as Record<string, unknown>,
        value as Record<string, unknown>,
      ) as T[keyof T];
    } else if (value !== undefined) {
      out[key] = value as T[keyof T];
    }
  }
  return out;
}

export async function getSiteContent(): Promise<SiteContent> {
  noStore();
  try {
    const raw = await fs.readFile(CONTENT_FILE, "utf8");
    const parsed = JSON.parse(raw) as Partial<SiteContent>;
    return deepMerge(
      structuredClone(defaultSiteContent) as unknown as Record<string, unknown>,
      parsed as Record<string, unknown>,
    ) as unknown as SiteContent;
  } catch {
    return structuredClone(defaultSiteContent);
  }
}

export async function saveSiteContent(content: SiteContent): Promise<void> {
  await fs.mkdir(CONTENT_DIR, { recursive: true });
  await fs.writeFile(CONTENT_FILE, JSON.stringify(content, null, 2), "utf8");
}

export function getContentFilePath() {
  return CONTENT_FILE;
}
