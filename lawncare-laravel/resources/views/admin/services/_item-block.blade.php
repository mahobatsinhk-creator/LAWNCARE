@php
    $prefix = $prefix ?? 'offerings';
    $label = $label ?? 'Item';
    $index = $index ?? 0;
    $item = $item ?? ['title' => '', 'body' => '', 'image' => ''];
@endphp

<div class="blog-subitem" data-repeat-item>
    <div class="admin-toolbar admin-toolbar--compact">
        <strong>{{ $label }} {{ is_numeric($index) ? ((int) $index + 1) : '' }}</strong>
        <button type="button" class="admin-btn admin-btn--ghost admin-btn--sm" data-remove-item>Remove</button>
    </div>

    <div class="admin-grid admin-grid--1">
        <label class="admin-field">
            <span>Title <span class="admin-required">*</span></span>
            <input
                type="text"
                name="{{ $prefix }}[{{ $index }}][title]"
                value="{{ old($prefix.'.'.$index.'.title', $item['title'] ?? '') }}"
                required
            >
        </label>

        <label class="admin-field">
            <span>Description</span>
            <textarea name="{{ $prefix }}[{{ $index }}][body]" rows="3">{{ old($prefix.'.'.$index.'.body', $item['body'] ?? '') }}</textarea>
        </label>

        @include('admin.blogs.posts._media-field', [
            'name' => $prefix.'['.$index.'][image]',
            'value' => old($prefix.'.'.$index.'.image', $item['image'] ?? ''),
            'label' => 'Photo',
        ])
    </div>
</div>
