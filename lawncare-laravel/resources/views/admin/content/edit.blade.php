@extends('admin.layouts.app')

@section('heading', $title)
@section('subheading', $pageDescription)

@section('content')
    <form method="POST" action="{{ route('admin.content.update', $section) }}" class="admin-editor">
        @csrf
        @method('PUT')

        <div class="admin-editor__toolbar">
            <a href="{{ route('admin.content.index') }}" class="admin-btn admin-btn--ghost">← Back</a>
            <button type="submit" class="admin-btn admin-btn--primary">Save changes</button>
        </div>

        <div class="admin-editor-layout">
            <aside class="admin-editor-nav" aria-label="Page sections">
                @foreach ($groups as $index => $group)
                    <button
                        type="button"
                        class="admin-editor-nav__item @if($index === 0) is-active @endif"
                        data-panel-target="panel-{{ $group['id'] }}"
                    >
                        <span class="admin-editor-nav__title">{{ $group['title'] }}</span>
                        <span class="admin-editor-nav__meta">{{ $group['description'] }}</span>
                    </button>
                @endforeach
            </aside>

            <div class="admin-editor-panels">
                @foreach ($groups as $index => $group)
                    <section
                        id="panel-{{ $group['id'] }}"
                        class="admin-editor-panel @if($index === 0) is-active @endif"
                        @if($index !== 0) hidden @endif
                    >
                        <div class="admin-editor-panel__head">
                            <h2>{{ $group['title'] }}</h2>
                            <p>{{ $group['description'] }}</p>
                        </div>

                        <div class="admin-editor-panel__grid">
                            @foreach ($group['fields'] as $field)
                                @include('admin.content._field', [
                                    'section' => $section,
                                    'field' => $field,
                                    'content' => $content,
                                ])
                            @endforeach
                        </div>
                    </section>
                @endforeach
            </div>
        </div>

        <div class="admin-editor__footer">
            <button type="submit" class="admin-btn admin-btn--primary">Save changes</button>
        </div>
    </form>

    <script>
        const navItems = document.querySelectorAll('.admin-editor-nav__item');
        const panels = document.querySelectorAll('.admin-editor-panel');

        navItems.forEach((item) => {
            item.addEventListener('click', () => {
                const targetId = item.getAttribute('data-panel-target');

                navItems.forEach((nav) => nav.classList.remove('is-active'));
                panels.forEach((panel) => {
                    panel.classList.remove('is-active');
                    panel.hidden = true;
                });

                item.classList.add('is-active');
                const panel = document.getElementById(targetId);
                if (panel) {
                    panel.classList.add('is-active');
                    panel.hidden = false;
                }
            });
        });
    </script>

    <script>
        const uploadUrl = @json(route('admin.media.upload'));
        const csrfToken = @json(csrf_token());

        function updatePreview(wrapper, url, type) {
            const preview = wrapper.querySelector('[data-media-preview]');
            if (!preview || !url) {
                if (preview) preview.innerHTML = '';
                return;
            }

            if (type === 'video') {
                preview.innerHTML = `<video src="${url}" controls muted playsinline></video>`;
            } else {
                preview.innerHTML = `<img src="${url}" alt="">`;
            }
        }

        document.querySelectorAll('[data-media-upload]').forEach((input) => {
            input.addEventListener('change', async () => {
                const file = input.files?.[0];
                if (!file) return;

                const wrapper = input.closest('.admin-media-field');
                const urlInput = wrapper.querySelector('[data-media-url]');
                const type = wrapper.querySelector('[data-media-preview]')?.dataset.mediaType || 'image';
                const formData = new FormData();
                formData.append('file', file);
                formData.append('_token', csrfToken);

                input.disabled = true;

                try {
                    const response = await fetch(uploadUrl, {
                        method: 'POST',
                        body: formData,
                        headers: { 'Accept': 'application/json' },
                    });

                    const payload = await response.json();
                    if (!response.ok) throw new Error(payload.message || 'Upload failed');

                    urlInput.value = payload.url;
                    updatePreview(wrapper, payload.url, type);
                } catch (error) {
                    alert(error.message || 'Upload failed');
                } finally {
                    input.disabled = false;
                    input.value = '';
                }
            });
        });

        document.querySelectorAll('[data-media-url]').forEach((input) => {
            input.addEventListener('change', () => {
                const wrapper = input.closest('.admin-media-field');
                const type = wrapper.querySelector('[data-media-preview]')?.dataset.mediaType || 'image';
                updatePreview(wrapper, input.value.trim(), type);
            });
        });
    </script>
@endsection
