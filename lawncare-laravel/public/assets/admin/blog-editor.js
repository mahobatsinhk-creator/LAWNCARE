(() => {
    const root = document.getElementById('blog-sections');
    const form = document.querySelector('[data-blog-form]');

    if (!root || !form) {
        return;
    }

    const uploadUrl = root.dataset.uploadUrl;
    const csrfToken = root.dataset.csrf;
    const quillInstances = new WeakMap();

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
            input.addEventListener('change', () => {
                const wrapper = input.closest('.admin-media-field');
                updatePreview(wrapper, input.value.trim());
            });
        });
    }

    function initQuill(block) {
        const editor = block.querySelector('[data-quill]');
        const input = block.querySelector('[data-quill-input]');

        if (!editor || !input || typeof Quill === 'undefined' || quillInstances.has(editor)) {
            return;
        }

        const quill = new Quill(editor, {
            theme: 'snow',
            placeholder: 'Write your paragraph here...',
            modules: {
                toolbar: [
                    [{ header: [2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link'],
                    ['clean'],
                ],
            },
        });

        if (input.value.trim() !== '') {
            quill.root.innerHTML = input.value;
        }

        quill.on('text-change', () => {
            input.value = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
        });

        quillInstances.set(editor, quill);
    }

    function syncQuillFields() {
        root.querySelectorAll('[data-block]').forEach((block) => {
            const editor = block.querySelector('[data-quill]');
            const input = block.querySelector('[data-quill-input]');
            const quill = editor ? quillInstances.get(editor) : null;

            if (quill && input) {
                input.value = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
            }
        });
    }

    function reindexBlocks() {
        root.querySelectorAll('[data-block]').forEach((block, index) => {
            block.querySelectorAll('[name^="sections["]').forEach((field) => {
                field.name = field.name.replace(/sections\[\d+\]/, `sections[${index}]`);
            });
        });
    }

    function initBlock(block) {
        bindMediaField(block);
        initQuill(block);

        block.querySelectorAll('[data-remove-subitem]').forEach((button) => {
            if (button.dataset.bound) {
                return;
            }

            button.dataset.bound = '1';
            button.addEventListener('click', () => {
                const subitem = button.closest('[data-subitem]');
                const container = button.closest('[data-subitems]');
                const items = container?.querySelectorAll('[data-subitem]') ?? [];

                if (items.length <= 1) {
                    subitem?.querySelectorAll('input, textarea').forEach((field) => {
                        field.value = '';
                    });
                    return;
                }

                subitem?.remove();
            });
        });

        block.querySelectorAll('[data-add-subitem]').forEach((button) => {
            if (button.dataset.bound) {
                return;
            }

            button.dataset.bound = '1';
            button.addEventListener('click', () => {
                const type = button.dataset.addSubitem;
                const container = button.previousElementSibling;
                const blockIndex = Array.from(root.querySelectorAll('[data-block]')).indexOf(block);
                const itemIndex = container.querySelectorAll('[data-subitem]').length;
                const item = document.createElement('div');
                item.className = 'blog-subitem';
                item.dataset.subitem = '';

                if (type === 'cards') {
                    item.innerHTML = `
                        <label class="admin-field">
                            <span>Card title</span>
                            <input type="text" name="sections[${blockIndex}][items][${itemIndex}][title]">
                        </label>
                        <label class="admin-field">
                            <span>Card text</span>
                            <textarea name="sections[${blockIndex}][items][${itemIndex}][text]" rows="3"></textarea>
                        </label>
                        <button type="button" class="admin-link admin-link--danger" data-remove-subitem>Remove card</button>
                    `;
                } else {
                    item.innerHTML = `
                        <label class="admin-field">
                            <span>Item title</span>
                            <input type="text" name="sections[${blockIndex}][items][${itemIndex}][title]">
                        </label>
                        <label class="admin-field">
                            <span>Item description</span>
                            <textarea name="sections[${blockIndex}][items][${itemIndex}][body]" rows="2"></textarea>
                        </label>
                        <button type="button" class="admin-link admin-link--danger" data-remove-subitem>Remove item</button>
                    `;
                }

                container.appendChild(item);
                initBlock(block);
            });
        });
    }

    function addBlock(type) {
        const template = document.getElementById(`blog-block-template-${type}`);
        if (!template) {
            return;
        }

        const index = root.querySelectorAll('[data-block]').length;
        const html = template.innerHTML.replaceAll('__INDEX__', String(index));
        const wrapper = document.createElement('div');
        wrapper.innerHTML = html.trim();
        const block = wrapper.firstElementChild;
        root.appendChild(block);
        initBlock(block);
        block.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    root.querySelectorAll('[data-block]').forEach(initBlock);
    bindMediaField(form);

    document.querySelectorAll('[data-add-block]').forEach((button) => {
        button.addEventListener('click', () => addBlock(button.dataset.addBlock));
    });

    root.addEventListener('click', (event) => {
        const target = event.target;
        if (!(target instanceof HTMLElement)) {
            return;
        }

        const block = target.closest('[data-block]');
        if (!block) {
            return;
        }

        if (target.matches('[data-remove-block]')) {
            if (root.querySelectorAll('[data-block]').length <= 1) {
                alert('Keep at least one content block.');
                return;
            }

            block.remove();
            reindexBlocks();
            return;
        }

        if (target.matches('[data-move]')) {
            const direction = target.dataset.move;
            const blocks = Array.from(root.querySelectorAll('[data-block]'));
            const currentIndex = blocks.indexOf(block);

            if (direction === 'up' && currentIndex > 0) {
                root.insertBefore(block, blocks[currentIndex - 1]);
            }

            if (direction === 'down' && currentIndex < blocks.length - 1) {
                root.insertBefore(blocks[currentIndex + 1], block);
            }

            reindexBlocks();
        }
    });

    form.addEventListener('submit', () => {
        syncQuillFields();
        reindexBlocks();
    });
})();
