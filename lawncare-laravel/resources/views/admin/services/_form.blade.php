@php
    $offerings = old('offerings', $details['detail_offerings'] ?? []);
    $features = old('features', $details['detail_features'] ?? []);
    $featuresText = old(
        'features_text',
        implode("\n", $service['features'] ?? [])
    );
@endphp

<div class="blog-form">
    <section class="admin-panel blog-form__panel">
        <div class="admin-panel__head">
            <h2 class="admin-panel__title">Homepage service card</h2>
            <p class="admin-panel__desc">Title, summary, bullet points, and card image shown on the homepage.</p>
        </div>

        <div class="admin-grid admin-grid--2">
            <label class="admin-field">
                <span>Title <span class="admin-required">*</span></span>
                <input type="text" name="title" value="{{ old('title', $service['title'] ?? '') }}" required>
                @error('title') <small class="admin-error">{{ $message }}</small> @enderror
            </label>

            <label class="admin-field admin-field--wide">
                <span>Short description <span class="admin-required">*</span></span>
                <textarea name="short" rows="3" required>{{ old('short', $service['short'] ?? '') }}</textarea>
                @error('short') <small class="admin-error">{{ $message }}</small> @enderror
            </label>

            @include('admin.blogs.posts._media-field', [
                'name' => 'image',
                'value' => old('image', $service['image'] ?? ''),
                'label' => 'Service image (homepage card + page hero)',
                'required' => true,
            ])

            <label class="admin-field admin-field--wide">
                <span>Feature bullets</span>
                <textarea name="features_text" rows="5" placeholder="One feature per line">{{ $featuresText }}</textarea>
                <small class="admin-help">Shown as bullet points on the homepage service card.</small>
            </label>
        </div>
    </section>

    <section class="admin-panel blog-form__panel">
        <div class="admin-panel__head">
            <h2 class="admin-panel__title">Service page hero</h2>
            <p class="admin-panel__desc">Intro text and hero media at the top of the service detail page.</p>
        </div>

        <div class="admin-grid admin-grid--2">
            <label class="admin-field admin-field--wide">
                <span>Intro heading</span>
                <textarea name="intro_heading" rows="3">{{ old('intro_heading', $details['intro_heading'] ?? '') }}</textarea>
            </label>

            <label class="admin-field">
                <span>Hero video URL</span>
                <input type="text" name="video" value="{{ old('video', $details['video'] ?? '') }}" placeholder="Optional MP4 URL">
                <small class="admin-help">If set, the video replaces the hero image on the service page.</small>
            </label>

            <label class="admin-field admin-field--wide">
                <span>Offerings intro</span>
                <textarea name="offerings_lead" rows="2">{{ old('offerings_lead', $details['offerings_lead'] ?? '') }}</textarea>
                <small class="admin-help">Optional lead paragraph above the offerings grid.</small>
            </label>
        </div>
    </section>

    <section class="admin-panel blog-form__panel">
        <div class="admin-panel__head">
            <h2 class="admin-panel__title">Service offerings</h2>
            <p class="admin-panel__desc">Photo, title, and text for each offering block on the service page.</p>
        </div>

        <div id="service-offerings" class="blog-subitems" data-repeat-list="offerings">
            @foreach ($offerings as $index => $offering)
                @include('admin.services._item-block', [
                    'prefix' => 'offerings',
                    'label' => 'Offering',
                    'index' => $index,
                    'item' => $offering,
                ])
            @endforeach
        </div>

        <button type="button" class="admin-btn admin-btn--ghost" data-add-item="offerings">Add offering</button>
    </section>

    <section class="admin-panel blog-form__panel">
        <div class="admin-panel__head">
            <h2 class="admin-panel__title">Service features</h2>
            <p class="admin-panel__desc">Optional feature blocks shown below the offerings section.</p>
        </div>

        <div id="service-features" class="blog-subitems" data-repeat-list="features">
            @foreach ($features as $index => $feature)
                @include('admin.services._item-block', [
                    'prefix' => 'features',
                    'label' => 'Feature',
                    'index' => $index,
                    'item' => $feature,
                ])
            @endforeach
        </div>

        <button type="button" class="admin-btn admin-btn--ghost" data-add-item="features">Add feature</button>
    </section>
</div>

<template id="service-item-template-offerings">
    @include('admin.services._item-block', [
        'prefix' => 'offerings',
        'label' => 'Offering',
        'index' => '__INDEX__',
        'item' => ['title' => '', 'body' => '', 'image' => ''],
    ])
</template>

<template id="service-item-template-features">
    @include('admin.services._item-block', [
        'prefix' => 'features',
        'label' => 'Feature',
        'index' => '__INDEX__',
        'item' => ['title' => '', 'body' => '', 'image' => ''],
    ])
</template>
