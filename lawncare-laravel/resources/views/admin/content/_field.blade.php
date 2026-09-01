@php
    $fieldId = 'field-' . $section . '-' . $field['key'];
    $inputName = 'fields[' . $field['key'] . ']';
    $oldKey = 'fields.' . $field['key'];
    $type = $field['type'] ?? 'text';
    $value = old($oldKey, $content[$field['key']] ?? '');
    $isJson = $type === 'json' || is_array($value);
    $displayValue = $isJson
        ? json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        : (string) $value;
    $isLong = $type === 'textarea' || ($type === 'text' && strlen($displayValue) > 120);
    $isMedia = in_array($type, ['image', 'video'], true);
@endphp

<div class="admin-editor-field @if($isMedia) admin-editor-field--media @endif">
    <label for="{{ $fieldId }}">{{ $field['label'] }}</label>

    @if ($isJson)
        <textarea id="{{ $fieldId }}" name="{{ $inputName }}" rows="12" class="admin-code" placeholder="Valid JSON">{{ $displayValue }}</textarea>
        <small class="admin-help">Edit structured content as JSON (images, videos, lists).</small>
    @elseif ($isMedia)
        <div class="admin-media-field">
            <input
                id="{{ $fieldId }}"
                type="text"
                name="{{ $inputName }}"
                value="{{ $displayValue }}"
                class="admin-media-field__url"
                data-media-url
                placeholder="Paste URL or upload a file"
            >
            <div class="admin-media-field__actions">
                <label class="admin-btn admin-btn--ghost admin-media-field__upload">
                    Upload {{ $type }}
                    <input type="file" hidden data-media-upload accept="{{ $type === 'video' ? 'video/*' : 'image/*' }}">
                </label>
            </div>
            <div class="admin-media-field__preview" data-media-preview data-media-type="{{ $type }}">
                @if ($displayValue !== '')
                    @if ($type === 'video')
                        <video src="{{ $displayValue }}" controls muted playsinline></video>
                    @else
                        <img src="{{ $displayValue }}" alt="">
                    @endif
                @endif
            </div>
        </div>
    @elseif ($isLong)
        <textarea id="{{ $fieldId }}" name="{{ $inputName }}" rows="4">{{ $displayValue }}</textarea>
    @else
        <input id="{{ $fieldId }}" type="text" name="{{ $inputName }}" value="{{ $displayValue }}">
    @endif

    @error($oldKey)
        <small class="admin-error">{{ $message }}</small>
    @enderror
</div>
