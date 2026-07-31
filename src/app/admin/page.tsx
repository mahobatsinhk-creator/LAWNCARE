import { AdminPanel } from "@/components/admin/AdminPanel";
import { isAdminAuthenticated } from "@/lib/admin-auth";
import { getSiteContent } from "@/lib/content";

export const metadata = {
  title: "Admin",
  robots: { index: false, follow: false },
};

export default async function AdminPage() {
  const [content, authed] = await Promise.all([
    getSiteContent(),
    isAdminAuthenticated(),
  ]);

  return <AdminPanel initialContent={content} initiallyAuthed={authed} />;
}
