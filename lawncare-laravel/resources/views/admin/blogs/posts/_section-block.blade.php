@php
    $type = $section['type'] ?? 'paragraph';
    $labels = [
        'heading' => 'Heading',
        'paragraph' => 'Text block',
        'image' => 'Image block',
        'cards' => 'Info cards',
        'list' => 'Bullet list',
    ];
@endphp

<article class="blog-block" data-block data-type="{{ $type }}">
    <div class="blog-block__toolbar">
        <span class="blog-block__label">{{ $labels[$type] ?? ucfirst($type) }}</span>
        <div class="blog-block__actions">
            <button type="button" class="admin-btn admin-btn--ghost blog-block__move" data-move="up" title="Move up">↑</button>
            <button type="button" class="admin-btn admin-btn--ghost blog-block__move" data-move="down" title="Move down">↓</button>
            <button type="button" class="admin-btn admin-btn--ghost blog-block__remove" data-remove-block title="Remove block">Remove</button>
        </div>
    </div>

    <input type="hidden" name="sections[{{ $index }}][type]" value="{{ $type }}">

    @if ($type === 'heading')
        <label class="admin-field">
            <span>Section heading</span>
            <input type="text" name="sections[{{ $index }}][text]" value="{{ $section['text'] ?? '' }}" placeholder="Enter a heading">
        </label>
    @elseif ($type === 'paragraph')
        <label class="admin-field">
            <span>Body text</span>
            <div class="blog-quill-wrap">
                <div class="blog-quill" data-quill></div>
                <textarea name="sections[{{ $index }}][text]" hidden data-quill-input>{{ $section['text'] ?? '' }}</textarea>
            </div>
        </label>
    @elseif ($type === 'image')
        <div class="admin-grid" style="grid-template-columns: 1fr; gap: 14px;">
            <label class="admin-field admin-media-field">
                <span>Image</span>
                <input
                    type="text"
                    name="sections[{{ $index }}][src]"
                    value="{{ $section['src'] ?? '' }}"
                    class="admin-media-field__url"
                    data-media-url
                    placeholder="Paste URL or upload an image"
                >
                <div class="admin-media-field__actions">
                    <label class="admin-btn admin-btn--ghost admin-media-field__upload">
                        Upload image
                        <input type="file" hidden data-media-upload accept="image/*">
                    </label>
                </div>
                <div class="admin-media-field__preview" data-media-preview data-media-type="image">
                    @if (! empty($section['src']))
                        <img src="{{ $section['src'] }}" alt="">
                    @endif
                </div>
            </label>
            <label class="admin-field">
                <span>Alt text</span>
                <input type="text" name="sections[{{ $index }}][alt]" value="{{ $section['alt'] ?? '' }}" placeholder="Describe the image">
            </label>
        </div>
    @elseif ($type === 'cards')
        <div class="blog-subitems" data-subitems="cards">
            @foreach ($section['items'] ?? [['title' => '', 'text' => '']] as $itemIndex => $item)
                <div class="blog-subitem" data-subitem>
                    <label class="admin-field">
                        <span>Card title</span>
                        <input type="text" name="sections[{{ $index }}][items][{{ $itemIndex }}][title]" value="{{ $item['title'] ?? '' }}">
                    </label>
                    <label class="admin-field">
                        <span>Card text</span>
                        <textarea name="sections[{{ $index }}][items][{{ $itemIndex }}][text]" rows="3">{{ $item['text'] ?? '' }}</textarea>
                    </label>
                    <button type="button" class="admin-link admin-link--danger" data-remove-subitem>Remove card</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="admin-btn admin-btn--ghost" data-add-subitem="cards">Add card</button>
    @elseif ($type === 'list')
        <label class="admin-field">
            <span>List title (optional)</span>
            <input type="text" name="sections[{{ $index }}][title]" value="{{ $section['title'] ?? '' }}">
        </label>
        <div class="blog-subitems" data-subitems="list">
            @foreach ($section['items'] ?? [['title' => '', 'body' => '']] as $itemIndex => $item)
                <div class="blog-subitem" data-subitem>
                    <label class="admin-field">
                        <span>Item title</span>
                        <input type="text" name="sections[{{ $index }}][items][{{ $itemIndex }}][title]" value="{{ $item['title'] ?? '' }}">
                    </label>
                    <label class="admin-field">
                        <span>Item description</span>
                        <textarea name="sections[{{ $index }}][items][{{ $itemIndex }}][body]" rows="2">{{ $item['body'] ?? '' }}</textarea>
                    </label>
                    <button type="button" class="admin-link admin-link--danger" data-remove-subitem>Remove item</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="admin-btn admin-btn--ghost" data-add-subitem="list">Add list item</button>
    @endif
</article>
