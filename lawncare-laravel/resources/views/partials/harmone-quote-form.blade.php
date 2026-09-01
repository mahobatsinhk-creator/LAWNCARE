<form data-quote-wizard class="harmone-quote-form" novalidate>
    <div class="harmone-quote-form__progress" aria-hidden>
        <span class="harmone-quote-form__progress-bar is-active" data-quote-progress="1"></span>
        <span class="harmone-quote-form__progress-bar" data-quote-progress="2"></span>
        <span class="harmone-quote-form__progress-bar" data-quote-progress="3"></span>
    </div>

    <fieldset class="harmone-quote-form__step is-active" data-quote-step="1">
        <legend class="harmone-quote-form__step-title">{{ $quote_page['step_contact'] }}</legend>

        <div class="harmone-quote-form__row harmone-quote-form__row--2">
            <label class="harmone-quote-field">
                <span class="harmone-quote-field__label">First name</span>
                <input required name="first_name" type="text" autocomplete="given-name">
            </label>
            <label class="harmone-quote-field">
                <span class="harmone-quote-field__label">Last name</span>
                <input required name="last_name" type="text" autocomplete="family-name">
            </label>
        </div>

        <label class="harmone-quote-field">
            <span class="harmone-quote-field__label">Company name</span>
            <input name="company" type="text" autocomplete="organization">
        </label>

        <label class="harmone-quote-field">
            <span class="harmone-quote-field__label">Email</span>
            <input required name="email" type="email" autocomplete="email" value="{{ request('email') }}">
        </label>

        <label class="harmone-quote-check">
            <input type="checkbox" name="marketing_email" value="yes">
            <span>I'd like to receive marketing emails from {{ $site['name'] }}. Unsubscribe at any time.</span>
        </label>

        <label class="harmone-quote-field">
            <span class="harmone-quote-field__label">Phone</span>
            <input required name="phone" type="tel" autocomplete="tel" placeholder="(___) ___-____" data-phone-mask>
        </label>

        <p class="harmone-quote-form__disclosure">{{ $quote_page['sms_disclosure'] }}</p>

        <label class="harmone-quote-check">
            <input type="checkbox" name="marketing_sms" value="yes">
            <span>I also agree to receive marketing SMS from {{ $site['name'] }}. Reply STOP MKT to opt out of marketing SMS.</span>
        </label>

        <label class="harmone-quote-field">
            <span class="harmone-quote-field__label">Street address</span>
            <input required name="street" type="text" autocomplete="address-line1">
        </label>

        <label class="harmone-quote-field">
            <span class="harmone-quote-field__label">Unit, apartment, suite, etc. (optional)</span>
            <input name="unit" type="text" autocomplete="address-line2">
        </label>

        <div class="harmone-quote-form__row harmone-quote-form__row--3">
            <label class="harmone-quote-field">
                <span class="harmone-quote-field__label">City</span>
                <input required name="city" type="text" autocomplete="address-level2" value="{{ $site['address']['city'] }}">
            </label>
            <label class="harmone-quote-field">
                <span class="harmone-quote-field__label">Province</span>
                <select required name="province" autocomplete="address-level1">
                    <option value="">Select</option>
                    @foreach ($provinces as $code => $label)
                        <option value="{{ $code }}" @selected($code === 'AB')>{{ $label }}</option>
                    @endforeach
                </select>
            </label>
            <label class="harmone-quote-field">
                <span class="harmone-quote-field__label">Postal Code</span>
                <input required name="postal_code" type="text" autocomplete="postal-code" value="{{ $site['address']['postal_code'] }}">
            </label>
        </div>

        <div class="harmone-quote-form__actions">
            <button type="button" class="harmone-quote-btn harmone-quote-btn--primary" data-quote-next>Continue</button>
        </div>
    </fieldset>

    <fieldset class="harmone-quote-form__step" data-quote-step="2" hidden>
        <legend class="harmone-quote-form__step-title">{{ $quote_page['step_service'] }}</legend>

        <label class="harmone-quote-field">
            <span class="harmone-quote-field__label">Select a service</span>
            <select required name="service">
                <option value="">Select</option>
                @foreach ($service_links as $link)
                    <option value="{{ $link['label'] }}">{{ $link['label'] }}</option>
                @endforeach
                <option value="Not sure yet">Not sure yet</option>
            </select>
        </label>

        <label class="harmone-quote-field">
            <span class="harmone-quote-field__label">Tell us about your property and what you need</span>
            <textarea required name="message" rows="5" placeholder="Share details about lawn size, snow routes, cleanup needs, timing, or anything else that helps us quote accurately."></textarea>
        </label>

        <div class="harmone-quote-form__actions harmone-quote-form__actions--split">
            <button type="button" class="harmone-quote-btn harmone-quote-btn--secondary" data-quote-back>Back</button>
            <button type="button" class="harmone-quote-btn harmone-quote-btn--primary" data-quote-next>Continue</button>
        </div>
    </fieldset>

    <fieldset class="harmone-quote-form__step" data-quote-step="3" hidden>
        <legend class="harmone-quote-form__step-title">{{ $quote_page['step_review'] }}</legend>

        <div class="harmone-quote-review" data-quote-review></div>

        <div class="harmone-quote-form__actions harmone-quote-form__actions--split">
            <button type="button" class="harmone-quote-btn harmone-quote-btn--secondary" data-quote-back>Back</button>
            <button type="submit" class="harmone-quote-btn harmone-quote-btn--primary">{{ $quote_page['submit_label'] }}</button>
        </div>
    </fieldset>
</form>

<div data-quote-thanks class="hidden harmone-quote-thanks">
    <h2 class="harmone-quote-thanks__title">{{ $quote_page['thanks_title'] }}</h2>
    <p class="harmone-quote-thanks__text">
        {{ $quote_page['thanks_text'] }}
        <a href="{{ $site['phone_href'] }}">{{ $site['phone'] }}</a>.
    </p>
</div>
