/**
 * Karman Studios — main.js
 * Modules: mobile nav, header scroll, scroll-to-top, animate-on-scroll,
 *          accordion (FAQ), gallery filters, media modal, trailer embed,
 *          newsletter form, counter animation.
 */

( function () {
    'use strict';

    // ─── UTILS ───────────────────────────────────────────────────────────────

    function $(sel, ctx) { return (ctx || document).querySelector(sel); }
    function $$(sel, ctx) { return Array.from((ctx || document).querySelectorAll(sel)); }


    // ─── MOBILE NAVIGATION ───────────────────────────────────────────────────

    function initMobileNav() {
        const btn      = $('#hamburger');
        const nav      = $('#mobile-nav');
        const overlay  = $('#mobile-overlay');
        const closeBtn = $('#mobile-close');

        if (!btn || !nav) return;

        function openNav() {
            nav.classList.add('open');
            nav.setAttribute('aria-hidden', 'false');
            btn.classList.add('open');
            btn.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }

        function closeNav() {
            nav.classList.remove('open');
            nav.setAttribute('aria-hidden', 'true');
            btn.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }

        btn.addEventListener('click', openNav);
        if (closeBtn)  closeBtn.addEventListener('click', closeNav);
        if (overlay)   overlay.addEventListener('click', closeNav);

        // Close on nav link click
        $$('.mobile-nav__panel a', nav).forEach(function (a) {
            a.addEventListener('click', closeNav);
        });

        // Close on ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && nav.classList.contains('open')) closeNav();
        });
    }


    // ─── HEADER SCROLL ───────────────────────────────────────────────────────

    function initHeaderScroll() {
        const header = $('#header');
        if (!header) return;

        var ticking = false;

        function update() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            ticking = false;
        }

        window.addEventListener('scroll', function () {
            if (!ticking) {
                requestAnimationFrame(update);
                ticking = true;
            }
        }, { passive: true });
    }


    // ─── SCROLL TO TOP ───────────────────────────────────────────────────────

    function initScrollTop() {
        const btn = $('#scrollTop');
        if (!btn) return;

        window.addEventListener('scroll', function () {
            if (window.scrollY > 400) {
                btn.classList.add('visible');
            } else {
                btn.classList.remove('visible');
            }
        }, { passive: true });

        btn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }


    // ─── ANIMATE ON SCROLL (IntersectionObserver) ────────────────────────────

    function initAnimations() {
        var els = $$('.animate-on-scroll');
        if (!els.length || !('IntersectionObserver' in window)) {
            // Fallback: show all
            els.forEach(function (el) { el.classList.add('animated'); });
            return;
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        els.forEach(function (el) { observer.observe(el); });
    }


    // ─── ACCORDION (FAQ) ─────────────────────────────────────────────────────

    function initAccordion() {
        var items = $$('.accordion-item');
        if (!items.length) return;

        items.forEach(function (item) {
            var trigger = item.querySelector('.accordion-item__trigger');
            var content = item.querySelector('.accordion-item__content');
            var icon    = item.querySelector('.accordion-item__icon');

            if (!trigger || !content) return;

            trigger.addEventListener('click', function () {
                var isOpen = item.classList.contains('open');

                // Close all other items (accordion behavior)
                items.forEach(function (other) {
                    if (other !== item) {
                        other.classList.remove('open');
                        var ot = other.querySelector('.accordion-item__trigger');
                        var oc = other.querySelector('.accordion-item__content');
                        if (ot) ot.setAttribute('aria-expanded', 'false');
                        if (oc) oc.setAttribute('aria-hidden', 'true');
                    }
                });

                // Toggle current
                item.classList.toggle('open', !isOpen);
                trigger.setAttribute('aria-expanded', String(!isOpen));
                content.setAttribute('aria-hidden', String(isOpen));
            });
        });
    }


    // ─── MEDIA MODAL (lightbox galería) ──────────────────────────────────────

    function initMediaModal() {
        var overlay  = $('#ksModal');
        var closeBtn = $('#ksModalClose');
        var content  = $('#ksModalContent');
        var caption  = $('#ksModalCaption');

        if (!overlay) return;

        function openModal(src, type, cap) {
            content.innerHTML = '';

            if (type === 'video') {
                var iframe = document.createElement('iframe');
                iframe.src            = src;
                iframe.allowFullscreen = true;
                iframe.allow           = 'autoplay; encrypted-media; picture-in-picture';
                content.appendChild(iframe);
            } else {
                var img  = document.createElement('img');
                img.src  = src;
                img.alt  = cap || '';
                content.appendChild(img);
            }

            caption.textContent = cap || '';
            overlay.classList.add('open');
            overlay.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            closeBtn.focus();
        }

        function closeModal() {
            overlay.classList.remove('open');
            overlay.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            // Stop video
            content.innerHTML = '';
        }

        // Bind gallery cards
        function bindCards() {
            $$('.gallery-card').forEach(function (card) {
                card.addEventListener('click', function () {
                    var src  = card.dataset.src;
                    var type = card.dataset.type;
                    var cap  = card.dataset.caption;
                    if (src) openModal(src, type, cap);
                });

                // Keyboard accessibility
                card.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        card.click();
                    }
                });
            });
        }

        closeBtn.addEventListener('click', closeModal);

        // Close on backdrop click
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeModal();
        });

        // Close on ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && overlay.classList.contains('open')) closeModal();
        });

        bindCards();
    }


    // ─── GALLERY FILTERS ─────────────────────────────────────────────────────

    function initGalleryFilters() {
        var filterBar = $('#galeriaFilters');
        var grid      = $('#galeriaGrid');
        if (!filterBar || !grid) return;

        var btns  = $$('.filter-btn', filterBar);
        var cards = $$('.gallery-card', grid);

        btns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var filter = btn.dataset.filter;

                // Update active button
                btns.forEach(function (b) { b.classList.remove('active'); });
                btn.classList.add('active');

                // Filter cards
                cards.forEach(function (card) {
                    var typeMatch = (filter === 'all') || (card.dataset.type === filter);
                    var catMatch  = (filter === 'all') || (card.dataset.cats && card.dataset.cats.indexOf(filter) !== -1);
                    var visible   = typeMatch || catMatch;
                    card.style.display = visible ? '' : 'none';
                });
            });
        });
    }


    // ─── FAQ CATEGORY FILTERS ────────────────────────────────────────────────

    function initFaqFilters() {
        var filterBar = $('#faqFilters');
        if (!filterBar) return;

        var btns   = $$('.filter-btn', filterBar);
        var groups = $$('.faq-category-group');

        btns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var filter = btn.dataset.faqFilter;

                btns.forEach(function (b) { b.classList.remove('active'); });
                btn.classList.add('active');

                groups.forEach(function (g) {
                    if (filter === 'all' || g.dataset.faqCat === filter) {
                        g.style.display = '';
                    } else {
                        g.style.display = 'none';
                    }
                });
            });
        });
    }


    // ─── TRAILER EMBED ───────────────────────────────────────────────────────

    function initTrailer() {
        var thumbnail = $('#trailerThumbnail');
        var playBtn   = $('#trailerPlayBtn');

        if (!thumbnail || !playBtn) return;

        var embedUrl = thumbnail.dataset.embed;
        if (!embedUrl) return;

        playBtn.addEventListener('click', function () {
            var iframe        = document.createElement('iframe');
            iframe.src        = embedUrl;
            iframe.allowFullscreen = true;
            iframe.allow      = 'autoplay; encrypted-media; picture-in-picture';
            iframe.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;border:none;';

            // Replace thumbnail content with iframe
            thumbnail.style.position = 'relative';
            thumbnail.innerHTML = '';
            thumbnail.appendChild(iframe);
        });
    }


    // ─── NEWSLETTER FORM ─────────────────────────────────────────────────────

    function initNewsletter() {
        var form    = $('#newsletterForm');
        var success = $('#newsletterSuccess');
        if (!form || !success) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var email = form.querySelector('input[type="email"]').value.trim();
            if (!email) return;

            // Simulated success — integrate with MailChimp / Brevo / etc. via AJAX
            form.style.display = 'none';
            success.classList.add('visible');
        });
    }


    // ─── COUNTER ANIMATION ───────────────────────────────────────────────────

    function animateCounter(el) {
        var target   = parseInt(el.dataset.target, 10) || 0;
        var duration = 1800;
        var start    = null;

        function step(timestamp) {
            if (!start) start = timestamp;
            var progress = Math.min((timestamp - start) / duration, 1);
            var eased    = 1 - Math.pow(1 - progress, 3); // ease-out cubic
            el.textContent = Math.round(eased * target).toLocaleString();
            if (progress < 1) requestAnimationFrame(step);
        }

        requestAnimationFrame(step);
    }

    function initCounters() {
        var counters = $$('[data-target]');
        if (!counters.length || !('IntersectionObserver' in window)) return;

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(function (el) { observer.observe(el); });
    }


    // ─── CONTACT FORM (native fallback) ──────────────────────────────────────

    function initContactForm() {
        var form = $('#contactFormNative');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            // Placeholder: show a simple confirmation
            form.innerHTML = '<p style="color:var(--color-gold);font-size:1.1rem;padding:2rem 0;">¡Gracias por tu mensaje! Te responderemos pronto.</p>';
        });
    }


    // ─── BOOT ────────────────────────────────────────────────────────────────

    document.addEventListener('DOMContentLoaded', function () {
        initMobileNav();
        initHeaderScroll();
        initScrollTop();
        initAnimations();
        initAccordion();
        initMediaModal();
        initGalleryFilters();
        initFaqFilters();
        initTrailer();
        initNewsletter();
        initCounters();
        initContactForm();
    });

} )();
