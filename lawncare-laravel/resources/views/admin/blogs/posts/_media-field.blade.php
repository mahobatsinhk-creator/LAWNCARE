@php
    $inputId = $id ?? ('media-' . uniqid());
    $inputName = $name;
    $value = old($name, $value ?? '');
    $labelText = $label ?? 'Image';
    $required = $required ?? false;
@endphp

<label class="admin-field admin-media-field" for="{{ $inputId }}">
    <span>{{ $labelText }} @if($required)<span class="admin-required">*</span>@endif</span>
    <input
        id="{{ $inputId }}"
        type="text"
        name="{{ $inputName }}"
        value="{{ $value }}"
        class="admin-media-field__url"
        data-media-url
        @if($required) required @endif
        placeholder="Paste URL or upload an image"
    >
    <div class="admin-media-field__actions">
        <label class="admin-btn admin-btn--ghost admin-media-field__upload">
            Upload image
            <input type="file" hidden data-media-upload accept="image/*">
        </label>
    </div>
    <div class="admin-media-field__preview" data-media-preview data-media-type="image">
        @if ($value !== '')
            <img src="{{ $value }}" alt="">
        @endif
    </div>
    @error($name)
        <small class="admin-error">{{ $message }}</small>
    @enderror
</label>
