document.addEventListener('DOMContentLoaded', () => {
    initHeader();
    initForms();
    initScrollReveal();
    initContactCardReveal();
    initBlogScaleIn();
    initAboutPageScroll();
    initServiceCards();
    initImageCompareSliders();
    initQuoteWizard();
    initServiceAreasMap();
});

function initHeader() {
    const header = document.getElementById('site-header');
    if (!header) return;

    const logo = document.getElementById('header-logo');

    function setScrolled(scrolled) {
        header.dataset.scrolled = scrolled ? 'true' : 'false';

        if (logo) {
            logo.classList.toggle('is-scrolled', scrolled);
        }
    }

    let closeMobileMenu = null;

    function onScroll() {
        const forceSolid = header.dataset.headerSolid === 'true';
        setScrolled(forceSolid || window.scrollY > 24);
        closeMobileMenu?.();
    }

    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });

    initServicesDropdown();
    closeMobileMenu = initMobileMenu();
}

function initMobileMenu() {
    const menuBtn = document.getElementById('header-menu-btn');
    const mobileNav = document.getElementById('header-mobile-nav');
    const backdrop = document.getElementById('header-mobile-backdrop');
    const servicesToggle = document.getElementById('mobile-services-toggle');
    const servicesSubmenu = document.getElementById('mobile-services-submenu');
    if (!menuBtn || !mobileNav) return null;

    const setServicesOpen = (open) => {
        if (!servicesToggle || !servicesSubmenu) return;

        servicesToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        servicesSubmenu.hidden = !open;
    };

    const setOpen = (open) => {
        menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
        menuBtn.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        mobileNav.classList.toggle('is-open', open);
        mobileNav.hidden = !open;
        if (backdrop) {
            backdrop.hidden = !open;
            backdrop.setAttribute('aria-hidden', open ? 'false' : 'true');
        }
        document.body.classList.toggle('site-header-menu-open', open);

        if (!open) {
            setServicesOpen(false);
        }
    };

    menuBtn.addEventListener('click', () => {
        setOpen(menuBtn.getAttribute('aria-expanded') !== 'true');
    });

    backdrop?.addEventListener('click', () => setOpen(false));

    servicesToggle?.addEventListener('click', () => {
        setServicesOpen(servicesToggle.getAttribute('aria-expanded') !== 'true');
    });

    mobileNav.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setOpen(false));
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            setOpen(false);
        }
    });

    return () => {
        if (menuBtn.getAttribute('aria-expanded') === 'true') {
            setOpen(false);
        }
    };
}

function initServicesDropdown() {
    const servicesDropdown = document.getElementById('services-dropdown');
    const servicesMenu = document.getElementById('services-menu');
    if (!servicesDropdown || !servicesMenu) return;

    let closeTimer;

    const openMenu = () => {
        window.clearTimeout(closeTimer);
        servicesDropdown.classList.add('is-open');
    };

    const closeMenu = () => {
        closeTimer = window.setTimeout(() => {
            servicesDropdown.classList.remove('is-open');
        }, 180);
    };

    servicesDropdown.addEventListener('mouseenter', openMenu);
    servicesDropdown.addEventListener('mouseleave', closeMenu);
    servicesDropdown.addEventListener('focusin', openMenu);
    servicesDropdown.addEventListener('focusout', (event) => {
        if (servicesDropdown.contains(event.relatedTarget)) return;
        closeMenu();
    });
}

function postJsonForm(url, formData) {
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    return fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token || '',
            Accept: 'application/json',
        },
        body: formData,
    }).then(async (response) => {
        if (!response.ok) {
            const data = await response.json().catch(() => ({}));
            throw new Error(data.message || 'Unable to submit form.');
        }

        return response.json();
    });
}

function initForms() {
    document.querySelectorAll('[data-hero-email], [data-footer-email]').forEach((form) => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const input = form.querySelector('input[type="email"]');
            const email = input?.value?.trim();
            const useContact = form.matches('[data-footer-email]');

            if (useContact) {
                window.location.href = email
                    ? `/get-quote?email=${encodeURIComponent(email)}`
                    : '/get-quote';
                return;
            }

            window.location.href = email ? `/get-quote?email=${encodeURIComponent(email)}` : '/get-quote';
        });
    });

    document.querySelectorAll('[data-quote-form]').forEach((form) => {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const thanks = form.parentElement?.querySelector('[data-quote-thanks]');
            const submitButton = form.querySelector('[type="submit"]');

            submitButton?.setAttribute('disabled', 'disabled');

            try {
                await postJsonForm('/contact/inquiry', new FormData(form));
                form.classList.add('hidden');
                thanks?.classList.remove('hidden');
            } catch (error) {
                window.alert(error.message || 'Unable to submit your inquiry. Please try again.');
                submitButton?.removeAttribute('disabled');
            }
        });
    });
}

function initScrollReveal() {
    const revealItems = document.querySelectorAll('.harmone-reveal, .harmone-reveal-word');
    if (!revealItems.length) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        revealItems.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    if (typeof CSS !== 'undefined' && CSS.supports('animation-timeline: view()')) {
        document.documentElement.classList.add('harmone-scroll-reveal');
        revealItems.forEach((el) => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight * 0.92 && rect.bottom > 0) {
                el.classList.add('is-visible');
            }
        });
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                const group = entry.target;
                const items = group.matches('[data-reveal-group]')
                    ? [
                          ...group.querySelectorAll('.harmone-reveal'),
                          ...group.querySelectorAll('.harmone-reveal-word'),
                      ]
                    : [group];

                items.forEach((item, index) => {
                    const extraDelay = Number(item.dataset.revealDelay || 0);
                    const delay = extraDelay + index * 90;

                    window.setTimeout(() => {
                        item.classList.add('is-visible');
                    }, delay);
                });

                observer.unobserve(group);
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -6% 0px' },
    );

    document.querySelectorAll('[data-reveal-group]').forEach((group) => {
        observer.observe(group);
    });
}

function initContactCardReveal() {
    const cards = document.querySelectorAll('[data-contact-reveal]');
    if (!cards.length) return;

    const show = (card) => card.classList.add('is-visible');

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        cards.forEach(show);
        return;
    }

    if (typeof CSS !== 'undefined' && CSS.supports('animation-timeline: view()')) {
        document.documentElement.classList.add('harmone-contact-scroll');
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                const card = entry.target;
                const delay = Number(card.style.getPropertyValue('--contact-reveal-index') || 0) * 120;

                window.setTimeout(() => show(card), delay);
                observer.unobserve(card);
            });
        },
        { threshold: 0.08, rootMargin: '0px 0px -5% 0px' },
    );

    cards.forEach((card) => observer.observe(card));
}

function initBlogScaleIn() {
    const cards = document.querySelectorAll('[data-blog-scale-in]');
    if (!cards.length) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        cards.forEach((card) => card.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        },
        { threshold: 0.2, rootMargin: '0px 0px -8% 0px' },
    );

    cards.forEach((card) => observer.observe(card));
}

function initServiceCards() {
    const cards = document.querySelectorAll('.leapfly-service-card[data-animate], .leapfly-service-row[data-animate]');
    if (!cards.length) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        cards.forEach((card) => card.classList.add('is-visible'));
        return;
    }

    if (typeof CSS !== 'undefined' && CSS.supports('animation-timeline: view()')) {
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        },
        { threshold: 0.15, rootMargin: '0px 0px -8% 0px' },
    );

    cards.forEach((card) => observer.observe(card));
}

function initAboutPageScroll() {
    const hero = document.querySelector('[data-about-hero]');
    if (!hero) return;

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    initAboutWordReveal(reducedMotion);
    initAboutScrollReveals(reducedMotion);
    initAboutHeroParallax(reducedMotion);
    initAboutStoryEffects(reducedMotion);
}

function initAboutWordReveal(reducedMotion) {
    document.querySelectorAll('[data-word-reveal]').forEach((block) => {
        const text = block.textContent.trim();
        const words = text.split(/\s+/);

        block.innerHTML = words
            .map((word) => `<span class="harmone-about-word">${word}</span>`)
            .join(' ');

        if (reducedMotion) {
            block.querySelectorAll('.harmone-about-word').forEach((word) => word.classList.add('is-visible'));
            return;
        }

        const spans = block.querySelectorAll('.harmone-about-word');
        const reveal = () => {
            spans.forEach((span, index) => {
                window.setTimeout(() => span.classList.add('is-visible'), index * 60);
            });
        };

        if (block.closest('[data-about-hero]')) {
            window.requestAnimationFrame(reveal);
            return;
        }

        const observer = new IntersectionObserver(
            (entries) => {
                if (!entries.some((entry) => entry.isIntersecting)) return;
                reveal();
                observer.disconnect();
            },
            { threshold: 0.2, rootMargin: '0px 0px -8% 0px' },
        );

        observer.observe(block);
    });
}

function initAboutScrollReveals(reducedMotion) {
    const items = document.querySelectorAll('[data-about-reveal]');
    if (!items.length) return;

    if (reducedMotion) {
        items.forEach((item) => item.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                const item = entry.target;
                const delay = Number(item.dataset.revealDelay || 0);

                window.setTimeout(() => item.classList.add('is-visible'), delay);
                observer.unobserve(item);
            });
        },
        { threshold: 0.15, rootMargin: '0px 0px -10% 0px' },
    );

    items.forEach((item) => observer.observe(item));
}

function initAboutHeroParallax(reducedMotion) {
    const hero = document.querySelector('[data-about-hero]');
    const parallax = document.querySelector('[data-about-parallax]');
    if (!hero || !parallax || reducedMotion) return;

    const update = () => {
        const rect = hero.getBoundingClientRect();
        const progress = Math.min(1, Math.max(0, -rect.top / Math.max(rect.height, 1)));
        parallax.style.transform = `translate3d(0, ${progress * rect.height * 0.35}px, 0) scale(1.08)`;
    };

    update();
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update, { passive: true });
}

function initAboutStoryEffects(reducedMotion) {
    const story = document.querySelector('[data-about-story]');
    const imageFrame = document.querySelector('[data-about-story-image]');
    if (!story || !imageFrame) return;

    if (reducedMotion) {
        imageFrame.style.transform = 'none';
        return;
    }

    const update = () => {
        const rect = story.getBoundingClientRect();
        const viewport = window.innerHeight;
        const start = viewport * 0.85;
        const end = viewport * 0.15;
        const progress = Math.min(1, Math.max(0, (start - rect.top) / Math.max(start - end, 1)));
        const scale = 1.25 - progress * 0.25;

        imageFrame.style.transform = `perspective(1200px) scale(${scale})`;
    };

    update();
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update, { passive: true });
}

function initImageCompareSliders() {
    document.querySelectorAll('[data-image-compare]').forEach((root) => {
        const track = root.querySelector('[data-compare-track]');
        const slider = root.querySelector('[role="slider"]');
        const after = root.querySelector('[data-compare-after]');
        const line = root.querySelector('[data-compare-line]');
        const handle = root.querySelector('[data-compare-handle]');

        if (!track || !after || !line || !handle) return;

        let position = 50;
        let dragging = false;
        let activePointerId = null;

        function setPosition(next) {
            position = Math.min(100, Math.max(0, next));
            const rightInset = 100 - position;

            after.style.clipPath = `inset(0 ${rightInset}% 0 0)`;
            line.style.left = `${position}%`;
            handle.style.left = `${position}%`;
            slider?.setAttribute('aria-valuenow', String(Math.round(position)));
        }

        function pointerPercent(event) {
            const rect = track.getBoundingClientRect();
            const clientX = event.clientX ?? event.touches?.[0]?.clientX ?? 0;

            return ((clientX - rect.left) / rect.width) * 100;
        }

        function startDrag(event) {
            if (event.pointerType === 'mouse' && event.button !== 0) return;

            dragging = true;
            activePointerId = event.pointerId;
            track.classList.add('is-dragging');
            track.setPointerCapture?.(event.pointerId);
            setPosition(pointerPercent(event));
        }

        function moveDrag(event) {
            if (!dragging || (activePointerId !== null && event.pointerId !== activePointerId)) return;

            event.preventDefault();
            setPosition(pointerPercent(event));
        }

        function stopDrag(event) {
            if (activePointerId !== null && event.pointerId !== activePointerId) return;

            dragging = false;
            activePointerId = null;
            track.classList.remove('is-dragging');
            track.releasePointerCapture?.(event.pointerId);
        }

        track.addEventListener('pointerdown', startDrag);
        track.addEventListener('pointermove', moveDrag);
        track.addEventListener('pointerup', stopDrag);
        track.addEventListener('pointercancel', stopDrag);

        slider?.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowLeft') {
                event.preventDefault();
                setPosition(position - 2);
            }

            if (event.key === 'ArrowRight') {
                event.preventDefault();
                setPosition(position + 2);
            }
        });

        setPosition(position);
    });
}

function initQuoteWizard() {
    const form = document.querySelector('[data-quote-wizard]');
    if (!form) return;

    const steps = [...form.querySelectorAll('[data-quote-step]')];
    const progressBars = [...form.querySelectorAll('[data-quote-progress]')];
    const review = form.parentElement?.querySelector('[data-quote-review]');
    const thanks = form.parentElement?.querySelector('[data-quote-thanks]');
    let currentStep = 1;

    const phoneInput = form.querySelector('[data-phone-mask]');
    if (phoneInput) {
        phoneInput.addEventListener('input', () => {
            const digits = phoneInput.value.replace(/\D/g, '').slice(0, 10);
            let formatted = '';

            if (digits.length > 0) {
                formatted = `(${digits.slice(0, 3)}`;
            }
            if (digits.length >= 4) {
                formatted += `) ${digits.slice(3, 6)}`;
            }
            if (digits.length >= 7) {
                formatted += `-${digits.slice(6, 10)}`;
            }

            phoneInput.value = formatted;
        });
    }

    const showStep = (step) => {
        currentStep = step;

        steps.forEach((fieldset) => {
            const active = Number(fieldset.dataset.quoteStep) === step;
            fieldset.hidden = !active;
            fieldset.classList.toggle('is-active', active);
        });

        progressBars.forEach((bar) => {
            const index = Number(bar.dataset.quoteProgress);
            bar.classList.toggle('is-active', index === step);
            bar.classList.toggle('is-complete', index < step);
        });

        if (step === 3) {
            renderReview();
        }

        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    const validateStep = (step) => {
        const fieldset = steps.find((item) => Number(item.dataset.quoteStep) === step);
        if (!fieldset) return true;

        const fields = [...fieldset.querySelectorAll('input, select, textarea')].filter(
            (field) => !field.disabled && field.type !== 'checkbox',
        );

        for (const field of fields) {
            if (!field.checkValidity()) {
                field.reportValidity();
                field.focus();
                return false;
            }
        }

        return true;
    };

    const renderReview = () => {
        if (!review) return;

        const data = new FormData(form);
        const labels = {
            first_name: 'First name',
            last_name: 'Last name',
            company: 'Company name',
            email: 'Email',
            phone: 'Phone',
            street: 'Street address',
            unit: 'Unit',
            city: 'City',
            province: 'Province',
            postal_code: 'Postal Code',
            service: 'Service',
            message: 'Project details',
        };

        review.innerHTML = Object.entries(labels)
            .map(([name, label]) => {
                let value = data.get(name);
                if (!value) return '';

                if (name === 'province') {
                    const option = form.querySelector(`select[name="province"] option[value="${value}"]`);
                    value = option?.textContent || value;
                }

                return `
                    <div class="harmone-quote-review__item">
                        <span class="harmone-quote-review__label">${label}</span>
                        <div class="harmone-quote-review__value">${String(value).replace(/</g, '&lt;')}</div>
                    </div>
                `;
            })
            .filter(Boolean)
            .join('');
    };

    form.querySelectorAll('[data-quote-next]').forEach((button) => {
        button.addEventListener('click', () => {
            if (!validateStep(currentStep)) return;
            showStep(Math.min(currentStep + 1, steps.length));
        });
    });

    form.querySelectorAll('[data-quote-back]').forEach((button) => {
        button.addEventListener('click', () => {
            showStep(Math.max(currentStep - 1, 1));
        });
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (!validateStep(currentStep)) return;

        const submitButton = form.querySelector('[type="submit"]');
        submitButton?.setAttribute('disabled', 'disabled');

        const formData = new FormData(form);
        formData.set('marketing_email', form.querySelector('[name="marketing_email"]')?.checked ? '1' : '0');
        formData.set('marketing_sms', form.querySelector('[name="marketing_sms"]')?.checked ? '1' : '0');

        try {
            await postJsonForm('/get-quote', formData);
            form.classList.add('hidden');
            thanks?.classList.remove('hidden');
        } catch (error) {
            window.alert(error.message || 'Unable to submit your quote request. Please try again.');
            submitButton?.removeAttribute('disabled');
        }
    });
}

async function initServiceAreasMap() {
    const mapEl = document.getElementById('service-areas-map');
    if (!mapEl) return;

    let areas = [];

    try {
        areas = JSON.parse(mapEl.dataset.areas || '[]');
    } catch {
        return;
    }

    if (!Array.isArray(areas) || areas.length === 0) return;

    const [{ default: L }] = await Promise.all([
        import('leaflet'),
        import('leaflet/dist/leaflet.css'),
    ]);

    const map = L.map(mapEl, {
        scrollWheelZoom: false,
        zoomControl: true,
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 18,
    }).addTo(map);

    const bounds = L.latLngBounds([]);
    const markers = [];

    areas.forEach((area, index) => {
        if (!area?.name || area.lat == null || area.lng == null) return;

        const marker = L.marker([area.lat, area.lng], {
            icon: L.divIcon({
                className: 'harmone-areas-map-marker-wrap',
                html: `<span class="harmone-areas-map-marker" aria-hidden="true">${index + 1}</span>`,
                iconSize: [28, 28],
                iconAnchor: [14, 14],
                popupAnchor: [0, -16],
            }),
        }).addTo(map);

        marker.bindPopup(area.name, { className: 'harmone-areas-map-popup' });
        bounds.extend([area.lat, area.lng]);
        markers.push({ marker, name: area.name });
    });

    if (bounds.isValid()) {
        map.fitBounds(bounds, { padding: [32, 32], maxZoom: 11 });
    }

    document.querySelectorAll('#areas .harmone-area-pill').forEach((pill, index) => {
        pill.style.cursor = 'pointer';

        pill.addEventListener('click', () => {
            const target = markers[index];
            if (!target) return;

            map.setView(target.marker.getLatLng(), 12, { animate: true });
            target.marker.openPopup();
        });
    });

    requestAnimationFrame(() => map.invalidateSize());
    window.addEventListener('resize', () => map.invalidateSize(), { passive: true });
}
