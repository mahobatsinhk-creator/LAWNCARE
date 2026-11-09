@extends('layouts.app')

@section('title', 'Privacy Policy — ' . $site['name'])
@section('meta_description', 'Privacy Policy for Lawn Care and Snow Removal Experts Ltd. Learn how we collect, use, and protect your personal information.')
@section('canonical', url('/privacy-policy'))

@section('content')
    <section class="legal-page section-shell bg-page">
        <div class="section-inner legal-page__inner">
            <header class="legal-page__header">
                <p class="legal-page__eyebrow">Legal</p>
                <h1 class="legal-page__title">Privacy Policy</h1>
                <p class="legal-page__updated">Last updated: {{ date('F j, Y') }}</p>
            </header>

            <div class="legal-page__content">
                <p>
                    This Privacy Policy explains how <strong>{{ $site['name'] }}</strong> (“we”, “us”, or “our”)
                    collects, uses, and protects personal information when you visit
                    <a href="{{ $site['url'] }}">{{ parse_url($site['url'], PHP_URL_HOST) }}</a>,
                    request a quote, contact us, or use our lawn care and snow removal services.
                </p>

                <h2>1. Information We Collect</h2>
                <p>We may collect the following information:</p>
                <ul>
                    <li><strong>Contact details</strong> — name, email address, phone number, and mailing or service address</li>
                    <li><strong>Service details</strong> — property information, service preferences, and scheduling notes</li>
                    <li><strong>Quote and inquiry information</strong> — messages you send through our contact or quote forms</li>
                    <li><strong>Technical information</strong> — IP address, browser type, device information, and pages visited (through analytics tools where enabled)</li>
                    <li><strong>Payment or billing information</strong> — if collected for invoicing, only as needed to complete a transaction</li>
                </ul>

                <h2>2. How We Use Your Information</h2>
                <p>We use personal information to:</p>
                <ul>
                    <li>Respond to quote requests, inquiries, and customer service messages</li>
                    <li>Schedule, provide, and improve our services</li>
                    <li>Send service updates, confirmations, invoices, and related communications</li>
                    <li>Operate, maintain, and improve our website</li>
                    <li>Comply with legal and regulatory obligations</li>
                </ul>

                <h2>3. Sharing of Information</h2>
                <p>
                    We do not sell your personal information. We may share information with trusted service providers
                    who help us operate our business (for example, scheduling, payment, email, hosting, or analytics tools),
                    and only as needed for those purposes. We may also disclose information when required by law
                    or to protect our rights, customers, or property.
                </p>

                <h2>4. Cookies and Analytics</h2>
                <p>
                    Our website may use cookies or similar technologies and analytics tools (such as Google Analytics)
                    to understand how visitors use the site and to improve performance. You can control cookies through
                    your browser settings. Disabling cookies may affect some site features.
                </p>

                <h2>5. Data Retention</h2>
                <p>
                    We keep personal information only as long as needed for the purposes described in this policy,
                    including service delivery, recordkeeping, and legal requirements, after which it may be securely
                    deleted or anonymized.
                </p>

                <h2>6. Security</h2>
                <p>
                    We take reasonable administrative, technical, and organizational measures to protect personal
                    information against unauthorized access, loss, misuse, or disclosure. No method of transmission
                    or storage is completely secure.
                </p>

                <h2>7. Your Choices and Rights</h2>
                <p>
                    Depending on applicable Alberta and Canadian privacy laws, you may request access to,
                    correction of, or deletion of your personal information, subject to legal exceptions.
                    To make a request, contact us using the details below.
                </p>

                <h2>8. Children’s Privacy</h2>
                <p>
                    Our services and website are intended for adults and property owners or authorized contacts.
                    We do not knowingly collect personal information from children.
                </p>

                <h2>9. Third-Party Links</h2>
                <p>
                    Our website may link to third-party sites or tools (including client portals or social media).
                    We are not responsible for the privacy practices of those third parties.
                </p>

                <h2>10. Changes to This Policy</h2>
                <p>
                    We may update this Privacy Policy from time to time. The “Last updated” date at the top of this
                    page will be revised when changes are posted.
                </p>

                <h2>11. Contact Us</h2>
                <p>If you have questions about this Privacy Policy or your personal information, contact:</p>
                <ul>
                    <li><strong>{{ $site['name'] }}</strong></li>
                    <li>Email: <a href="mailto:{{ $site['email'] }}">{{ $site['email'] }}</a></li>
                    <li>Phone: <a href="{{ $site['phone_href'] }}">{{ $site['phone'] }}</a></li>
                    <li>
                        Address: PO Box 3683, {{ $site['address']['city'] }},
                        {{ $site['address']['region'] }} {{ $site['address']['postal_code'] }}
                    </li>
                </ul>

                <p class="legal-page__related">
                    See also our <a href="{{ route('legal.terms') }}">Terms and Conditions</a>.
                </p>
            </div>
        </div>
    </section>
@endsection
