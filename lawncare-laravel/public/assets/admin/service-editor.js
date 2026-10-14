(() => {
    const form = document.querySelector('[data-service-form]');

    if (!form) {
        return;
    }

    const uploadUrl = form.dataset.uploadUrl;
    const csrfToken = form.dataset.csrf;

    function updatePreview(wrapper, url) {
        const preview = wrapper?.querySelector('[data-media-preview]');

        if (!preview) {
            return;
        }

        preview.innerHTML = url ? `<img src="${url}" alt="">` : '';
    }

    function bindMediaField(scope) {
        scope.querySelectorAll('[data-media-upload]').forEach((input) => {
            if (input.dataset.bound) {
                return;
            }

            input.dataset.bound = '1';
            input.addEventListener('change', async () => {
                const file = input.files?.[0];

                if (!file) {
                    return;
                }

                const wrapper = input.closest('.admin-media-field');
                const urlInput = wrapper?.querySelector('[data-media-url]');
                const formData = new FormData();
                formData.append('file', file);
                formData.append('_token', csrfToken);

                input.disabled = true;

                try {
                    const response = await fetch(uploadUrl, {
                        method: 'POST',
                        body: formData,
                        headers: { Accept: 'application/json' },
                    });
                    const payload = await response.json();

                    if (!response.ok) {
                        throw new Error(payload.message || 'Upload failed');
                    }

                    if (urlInput) {
                        urlInput.value = payload.url;
                        updatePreview(wrapper, payload.url);
                    }
                } catch (error) {
                    alert(error.message || 'Upload failed');
                } finally {
                    input.disabled = false;
                    input.value = '';
                }
            });
        });

        scope.querySelectorAll('[data-media-url]').forEach((input) => {
            if (input.dataset.bound) {
                return;
            }

            input.dataset.bound = '1';
            input.addEventListener('input', () => {
                const wrapper = input.closest('.admin-media-field');
                updatePreview(wrapper, input.value.trim());
            });
        });
    }

    function reindexList(list) {
        const prefix = list.dataset.repeatList;
        list.querySelectorAll('[data-repeat-item]').forEach((item, index) => {
            item.querySelectorAll('[name]').forEach((field) => {
                field.name = field.name.replace(
                    new RegExp(`^${prefix}\\[\\d+\\]`),
                    `${prefix}[${index}]`
                );
            });

            const label = item.querySelector('strong');
            if (label) {
                const base = prefix === 'features' ? 'Feature' : 'Offering';
                label.textContent = `${base} ${index + 1}`;
            }
        });
    }

    function addItem(prefix) {
        const list = document.querySelector(`[data-repeat-list="${prefix}"]`);
        const template = document.getElementById(`service-item-template-${prefix}`);

        if (!list || !template) {
            return;
        }

        const index = list.querySelectorAll('[data-repeat-item]').length;
        const html = template.innerHTML.replaceAll('__INDEX__', String(index));
        const wrapper = document.createElement('div');
        wrapper.innerHTML = html.trim();
        const item = wrapper.firstElementChild;
        list.appendChild(item);
        bindMediaField(item);
        reindexList(list);
    }

    bindMediaField(form);

    form.querySelectorAll('[data-media-url]').forEach((input) => {
        const wrapper = input.closest('.admin-media-field');
        updatePreview(wrapper, input.value.trim());
    });

    form.querySelectorAll('[data-add-item]').forEach((button) => {
        button.addEventListener('click', () => {
            addItem(button.dataset.addItem);
        });
    });

    form.querySelectorAll('[data-repeat-list]').forEach((list) => {
        list.addEventListener('click', (event) => {
            const removeButton = event.target.closest('[data-remove-item]');

            if (!removeButton) {
                return;
            }

            const item = removeButton.closest('[data-repeat-item]');
            item?.remove();
            reindexList(list);
        });
    });
})();
