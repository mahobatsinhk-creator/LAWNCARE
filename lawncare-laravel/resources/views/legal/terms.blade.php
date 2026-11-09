@extends('layouts.app')

@section('title', 'Terms and Conditions — ' . $site['name'])
@section('meta_description', 'Terms and Conditions for Lawn Care and Snow Removal Experts Ltd. services, quotes, scheduling, and website use.')
@section('canonical', url('/terms-and-conditions'))

@section('content')
    <section class="legal-page section-shell bg-page">
        <div class="section-inner legal-page__inner">
            <header class="legal-page__header">
                <p class="legal-page__eyebrow">Legal</p>
                <h1 class="legal-page__title">Terms and Conditions</h1>
                <p class="legal-page__updated">Last updated: {{ date('F j, Y') }}</p>
            </header>

            <div class="legal-page__content">
                <p>
                    These Terms and Conditions (“Terms”) govern your use of the website
                    <a href="{{ $site['url'] }}">{{ parse_url($site['url'], PHP_URL_HOST) }}</a>
                    and the lawn care, property cleanup, and snow removal services provided by
                    <strong>{{ $site['name'] }}</strong> (“we”, “us”, or “our”).
                    By requesting a quote, booking a service, or using this website, you agree to these Terms.
                </p>

                <h2>1. Services</h2>
                <p>
                    We provide seasonal and ongoing property services, which may include lawn care and maintenance,
                    spring and fall cleanup, property cleanup and hauling, and residential snow removal.
                    Service availability may vary by location, season, weather, and crew capacity.
                </p>

                <h2>2. Quotes and Estimates</h2>
                <p>
                    Quotes and estimates are based on the information you provide and our assessment of the property.
                    Final pricing may change if site conditions, scope of work, access, debris volume, snowfall amounts,
                    or other factors differ from the original quote. Significant changes will be discussed with you
                    where reasonably possible before additional work proceeds.
                </p>

                <h2>3. Scheduling and Access</h2>
                <p>
                    Service dates and times may be affected by weather, equipment issues, or scheduling demand.
                    You agree to provide reasonable access to the service area, including driveways, sidewalks,
                    gates, and other relevant areas. Please mark obstacles, irrigation heads, and sensitive areas
                    when possible. We are not responsible for delays or incomplete work caused by blocked access
                    or unsafe site conditions.
                </p>

                <h2>4. Weather and Seasonal Conditions</h2>
                <p>
                    Outdoor services depend on weather and ground conditions. Snow removal timing depends on storm
                    intensity, ongoing snowfall, and municipal priorities for surrounding routes. Lawn and cleanup
                    services may be postponed during extreme heat, frost, heavy rain, or other unsafe conditions.
                </p>

                <h2>5. Customer Responsibilities</h2>
                <ul>
                    <li>Provide accurate contact and property information</li>
                    <li>Secure pets and remove vehicles or obstacles from work areas when requested</li>
                    <li>Notify us of property damage concerns, special instructions, or restricted areas before service</li>
                    <li>Ensure someone authorized can approve changes to the scope of work when needed</li>
                </ul>

                <h2>6. Payment</h2>
                <p>
                    Payment terms will be stated on your quote, invoice, or service agreement. Unless otherwise agreed,
                    payment is due as indicated on the invoice. Late or unpaid balances may result in suspension of
                    future services and may be subject to reasonable collection steps.
                </p>

                <h2>7. Cancellations</h2>
                <p>
                    Please provide reasonable notice if you need to cancel or reschedule. Same-day cancellations,
                    no-access visits, or weather-related abort situations may still incur a service or trip charge
                    where work crews have already been dispatched.
                </p>

                <h2>8. Property Care and Limitations</h2>
                <p>
                    We take reasonable care while working on your property. However, normal wear, existing damage,
                    hidden hazards, unmarked objects, fragile landscaping, or conditions outside our control may
                    affect results. Please report any concerns promptly after service so we can review them.
                </p>

                <h2>9. Website Use</h2>
                <p>
                    Website content is provided for general information about our services. It is not a binding offer
                    unless confirmed in writing through a quote, invoice, or service agreement. You agree not to misuse
                    the website, attempt unauthorized access, or submit false or harmful information through forms.
                </p>

                <h2>10. Intellectual Property</h2>
                <p>
                    All website text, branding, logos, images, and design elements owned by us remain our property
                    and may not be copied or used without permission, except as allowed by law.
                </p>

                <h2>11. Limitation of Liability</h2>
                <p>
                    To the fullest extent permitted by applicable law, we are not liable for indirect, incidental,
                    special, or consequential damages arising from website use or service delays caused by weather,
                    access issues, or circumstances beyond our reasonable control. Our total liability for any claim
                    related to services is limited to the amount paid for the specific service giving rise to the claim.
                </p>

                <h2>12. Privacy</h2>
                <p>
                    Personal information is handled according to our
                    <a href="{{ route('legal.privacy') }}">Privacy Policy</a>.
                </p>

                <h2>13. Governing Law</h2>
                <p>
                    These Terms are governed by the laws of the Province of Alberta and the applicable laws of Canada.
                    Any disputes will be resolved in the courts of Alberta, unless otherwise required by law.
                </p>

                <h2>14. Changes to These Terms</h2>
                <p>
                    We may update these Terms from time to time. The updated version will be posted on this page with
                    a revised “Last updated” date. Continued use of the website or our services after changes are posted
                    constitutes acceptance of the updated Terms.
                </p>

                <h2>15. Contact Us</h2>
                <ul>
                    <li><strong>{{ $site['name'] }}</strong></li>
                    <li>Email: <a href="mailto:{{ $site['email'] }}">{{ $site['email'] }}</a></li>
                    <li>Phone: <a href="{{ $site['phone_href'] }}">{{ $site['phone'] }}</a></li>
                    <li>
                        Address: PO Box 3683, {{ $site['address']['city'] }},
                        {{ $site['address']['region'] }} {{ $site['address']['postal_code'] }}
                    </li>
                </ul>
            </div>
        </div>
    </section>
@endsection
