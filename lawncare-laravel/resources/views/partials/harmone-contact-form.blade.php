<form data-quote-form class="harmone-contact-form" novalidate>
    <div class="harmone-contact-form__grid">
        <label class="harmone-contact-field">
            <span class="harmone-contact-field__label">Name</span>
            <input required name="name" type="text" autocomplete="name">
        </label>
        <label class="harmone-contact-field">
            <span class="harmone-contact-field__label">Email Address</span>
            <input required name="email" type="email" autocomplete="email">
        </label>
        <label class="harmone-contact-field">
            <span class="harmone-contact-field__label">Phone Number</span>
            <input required name="phone" type="tel" autocomplete="tel">
        </label>
        <label class="harmone-contact-field">
            <span class="harmone-contact-field__label">Project Location</span>
            <input required name="address" type="text" autocomplete="address-level2">
        </label>
        <label class="harmone-contact-field harmone-contact-field--full">
            <span class="harmone-contact-field__label">Select a service</span>
            <select name="service">
                @foreach ($service_links as $link)
                    <option value="{{ $link['label'] }}">{{ $link['label'] }}</option>
                @endforeach
                <option>Not sure yet</option>
            </select>
        </label>
        <label class="harmone-contact-field harmone-contact-field--full">
            <span class="harmone-contact-field__label">Tell Us Your Needs</span>
            <textarea name="message" rows="4"></textarea>
        </label>
    </div>
    <button type="submit" class="harmone-contact-submit">{{ $contact['submit_label'] }}</button>
</form>
<div data-quote-thanks class="hidden harmone-contact-thanks">
    <p class="harmone-contact-thanks__title">Thanks — we got your message.</p>
    <p class="harmone-contact-thanks__text">A team member will follow up shortly. For faster service, call
        <a href="{{ $site['phone_href'] }}">{{ $site['phone'] }}</a>.
    </p>
</div>
