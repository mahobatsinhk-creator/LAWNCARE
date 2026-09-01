@php
    $sections = old('sections', $post->sections ?? []);
    if ($sections === []) {
        $sections = [
            ['type' => 'heading', 'text' => ''],
            ['type' => 'paragraph', 'text' => ''],
        ];
    }
@endphp

<div class="blog-form">
    <section class="admin-panel blog-form__panel">
        <div class="admin-panel__head">
            <h2 class="admin-panel__title">Post details</h2>
            <p class="admin-panel__desc">Title, author, publish date, and visibility.</p>
        </div>

        <div class="admin-grid admin-grid--2">
            <label class="admin-field">
                <span>Title <span class="admin-required">*</span></span>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
                @error('title') <small class="admin-error">{{ $message }}</small> @enderror
            </label>

            <label class="admin-field">
                <span>URL slug</span>
                <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" placeholder="Auto-generated from title if empty">
                @error('slug') <small class="admin-error">{{ $message }}</small> @enderror
            </label>

            <label class="admin-field">
                <span>Author <span class="admin-required">*</span></span>
                <input type="text" name="author" value="{{ old('author', $post->author) }}" required>
                @error('author') <small class="admin-error">{{ $message }}</small> @enderror
            </label>

            <label class="admin-field">
                <span>Published date <span class="admin-required">*</span></span>
                <input type="date" name="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d')) }}" required>
                @error('published_at') <small class="admin-error">{{ $message }}</small> @enderror
            </label>

            <label class="admin-field">
                <span>Reading time</span>
                <input type="text" name="reading_time" value="{{ old('reading_time', $post->reading_time) }}" placeholder="8 min read">
                @error('reading_time') <small class="admin-error">{{ $message }}</small> @enderror
            </label>

            <label class="admin-field">
                <span>Sort order</span>
                <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $post->sort_order ?? 0) }}">
                @error('sort_order') <small class="admin-error">{{ $message }}</small> @enderror
            </label>

            <label class="admin-check admin-check--wide">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $post->is_published ?? true))>
                <span>Published on website</span>
            </label>
        </div>
    </section>

    <section class="admin-panel blog-form__panel">
        <div class="admin-panel__head">
            <h2 class="admin-panel__title">Featured image</h2>
            <p class="admin-panel__desc">Shown on the blog list and at the top of the article.</p>
        </div>

        @include('admin.blogs.posts._media-field', [
            'name' => 'image',
            'value' => old('image', $post->image),
            'label' => 'Featured image',
            'required' => true,
        ])
    </section>

    <section class="admin-panel blog-form__panel">
        <div class="admin-panel__head">
            <h2 class="admin-panel__title">Author profile</h2>
            <p class="admin-panel__desc">Optional author photo and short bio.</p>
        </div>

        <div class="admin-grid admin-grid--2">
            @include('admin.blogs.posts._media-field', [
                'name' => 'author_avatar',
                'value' => old('author_avatar', $post->author_avatar),
                'label' => 'Author photo',
            ])

            <label class="admin-field">
                <span>Bio name</span>
                <input type="text" name="author_bio_name" value="{{ old('author_bio_name', data_get($post->author_bio, 'name')) }}">
            </label>

            <label class="admin-field">
                <span>Bio role</span>
                <input type="text" name="author_bio_role" value="{{ old('author_bio_role', data_get($post->author_bio, 'role')) }}">
            </label>

            @include('admin.blogs.posts._media-field', [
                'name' => 'author_bio_image',
                'value' => old('author_bio_image', data_get($post->author_bio, 'image')),
                'label' => 'Bio image',
            ])

            <label class="admin-field admin-field--wide">
                <span>Bio text</span>
                <textarea name="author_bio_text" rows="4">{{ old('author_bio_text', data_get($post->author_bio, 'text')) }}</textarea>
            </label>
        </div>
    </section>

    <section class="admin-panel blog-form__panel">
        <div class="admin-panel__head">
            <h2 class="admin-panel__title">Pull quote</h2>
            <p class="admin-panel__desc">Optional highlighted quote shown beside the article.</p>
        </div>

        <div class="admin-grid admin-grid--1">
            <label class="admin-field">
                <span>Quote text</span>
                <textarea name="quote_text" rows="3">{{ old('quote_text', data_get($post->quote, 'text')) }}</textarea>
            </label>
            <div class="admin-grid admin-grid--2">
                <label class="admin-field">
                    <span>Quote author</span>
                    <input type="text" name="quote_author" value="{{ old('quote_author', data_get($post->quote, 'author')) }}">
                </label>
                <label class="admin-field">
                    <span>Quote role</span>
                    <input type="text" name="quote_role" value="{{ old('quote_role', data_get($post->quote, 'role')) }}">
                </label>
            </div>
        </div>
    </section>

    <section class="admin-panel blog-form__panel">
        <div class="admin-panel__head">
            <h2 class="admin-panel__title">Article content</h2>
            <p class="admin-panel__desc">Build your article with headings, rich text, and images. Add blocks in any order.</p>
        </div>

        <div
            id="blog-sections"
            class="blog-sections"
            data-upload-url="{{ route('admin.media.upload') }}"
            data-csrf="{{ csrf_token() }}"
        >
            @foreach ($sections as $index => $section)
                @include('admin.blogs.posts._section-block', [
                    'index' => $index,
                    'section' => $section,
                ])
            @endforeach
        </div>

        <div class="blog-sections__add">
            <span class="blog-sections__add-label">Add content block</span>
            <div class="blog-sections__add-buttons">
                <button type="button" class="admin-btn admin-btn--ghost" data-add-block="heading">Heading</button>
                <button type="button" class="admin-btn admin-btn--ghost" data-add-block="paragraph">Text</button>
                <button type="button" class="admin-btn admin-btn--ghost" data-add-block="image">Image</button>
            </div>
        </div>

        @error('sections') <small class="admin-error">{{ $message }}</small> @enderror
    </section>
</div>

<template id="blog-block-template-heading">
    @include('admin.blogs.posts._section-block', [
        'index' => '__INDEX__',
        'section' => ['type' => 'heading', 'text' => ''],
    ])
</template>

<template id="blog-block-template-paragraph">
    @include('admin.blogs.posts._section-block', [
        'index' => '__INDEX__',
        'section' => ['type' => 'paragraph', 'text' => ''],
    ])
</template>

<template id="blog-block-template-image">
    @include('admin.blogs.posts._section-block', [
        'index' => '__INDEX__',
        'section' => ['type' => 'image', 'src' => '', 'alt' => ''],
    ])
</template>

<template id="blog-block-template-cards">
    @include('admin.blogs.posts._section-block', [
        'index' => '__INDEX__',
        'section' => ['type' => 'cards', 'items' => [['title' => '', 'text' => '']]],
    ])
</template>

<template id="blog-block-template-list">
    @include('admin.blogs.posts._section-block', [
        'index' => '__INDEX__',
        'section' => ['type' => 'list', 'title' => '', 'items' => [['title' => '', 'body' => '']]],
    ])
</template>
