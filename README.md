# Lawn Care and Snow Removal Experts

Exact marketing site clone of [lawncareandsnowremovalexperts.com](https://lawncareandsnowremovalexperts.com/) — same layout, copy, images, and service routes.

## Develop

```bash
npm install
npm run dev
```

Open [http://127.0.0.1:3000](http://127.0.0.1:3000).

## Routes

- `/`
- `/about`
- `/services/snow-removal-services`
- `/services/lawn-care-and-maintenance`
- `/services/property-cleanup-and-maintenance`
- `/contact`
- `/faq`
- `/admin` — password-protected content editor

## Admin panel

1. Open [http://127.0.0.1:3000/admin](http://127.0.0.1:3000/admin)
2. Sign in with the password from `.env.local` (`ADMIN_PASSWORD`, default `admin123`)
3. Edit Business, Homepage, FAQs, Areas, and service pages, then **Save all**

Saved content is written to `content/site-content.json` and shown on the public site immediately.
