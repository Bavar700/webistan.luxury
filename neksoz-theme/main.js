/**
 * Neksoz Theme — Main JavaScript
 *
 * Mobile menu, accordion, scroll effects, contact form AJAX, fade-in observer.
 *
 * @package Neksoz
 */

(function ($) {
    'use strict';
    console.log("Neksoz DEV: main.js loaded");

    /* ==========================================================================
       1. Mobile Menu Toggle
       ========================================================================== */

    const mobileToggle = document.querySelector('.nk-mobile-toggle');
    const navPanel = document.querySelector('.header__nav');

    if (mobileToggle && navPanel) {
        mobileToggle.addEventListener('click', function () {
            this.classList.toggle('is-active');
            navPanel.classList.toggle('is-open');

            const isOpen = navPanel.classList.contains('is-open');
            this.setAttribute('aria-expanded', isOpen);
            document.body.style.overflow = isOpen ? 'hidden' : '';
        });

        // Close on outside click
        document.addEventListener('click', function (e) {
            if (
                navPanel.classList.contains('is-open') &&
                !navPanel.contains(e.target) &&
                !mobileToggle.contains(e.target)
            ) {
                mobileToggle.classList.remove('is-active');
                navPanel.classList.remove('is-open');
                mobileToggle.setAttribute('aria-expanded', false);
                document.body.style.overflow = '';
            }
        });
    }

    /* ==========================================================================
       2. Header Shrink on Scroll
       ========================================================================== */

    const header = document.querySelector('.header');

    if (header) {
        let lastScrollY = 0;

        window.addEventListener('scroll', function () {
            const scrollY = window.scrollY;

            if (scrollY > 60) {
                header.classList.add('is-scrolled');
            } else {
                header.classList.remove('is-scrolled');
            }

            lastScrollY = scrollY;
        }, { passive: true });
    }

    /* ==========================================================================
       3. Accordion (Vacancies)
       ========================================================================== */

    const accordions = document.querySelectorAll('.nk-accordion__header');

    accordions.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const accordion = this.closest('.nk-accordion');
            const isOpen = accordion.classList.contains('is-open');

            // Optional: close all others
            document.querySelectorAll('.nk-accordion.is-open').forEach(function (open) {
                open.classList.remove('is-open');
                open.querySelector('.nk-accordion__header').setAttribute('aria-expanded', 'false');
            });

            if (!isOpen) {
                accordion.classList.add('is-open');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    /* ==========================================================================
       4. Smooth Scroll for Anchor Links
       ========================================================================== */

    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                const headerHeight = header ? header.offsetHeight : 0;
                const top = target.getBoundingClientRect().top + window.scrollY - headerHeight - 20;

                window.scrollTo({
                    top: top,
                    behavior: 'smooth',
                });
            }
        });
    });

    /* ==========================================================================
       5. Fade-In on Scroll (Intersection Observer)
       ========================================================================== */

    const fadeElements = document.querySelectorAll('.fade-up');

    if ('IntersectionObserver' in window && fadeElements.length > 0) {
        const observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                root: null,
                rootMargin: '0px 0px -40px 0px',
                threshold: 0.1,
            }
        );

        fadeElements.forEach(function (el) {
            observer.observe(el);
        });
    } else {
        // Fallback: show all
        fadeElements.forEach(function (el) {
            el.classList.add('is-visible');
        });
    }

    /* ==========================================================================
       6. Contact Form AJAX Submission
       ========================================================================== */

    const contactForm = document.getElementById('Neksoz-contact-form');

    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const statusEl = document.getElementById('nk-form-status');
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            // UI feedback
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span style="opacity: 0.7;">Отправка...</span>';
            statusEl.style.display = 'none';

            const formData = new FormData(contactForm);
            formData.append('action', 'Neksoz_contact');
            formData.append('nonce', NeksozAjax.nonce);

            fetch(NeksozAjax.ajaxurl, {
                method: 'POST',
                body: formData,
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    statusEl.style.display = 'block';

                    if (data.success) {
                        statusEl.innerHTML =
                            '<div style="padding: 1rem; background: #d4edda; color: #155724; border-radius: 8px; font-size: 0.9rem;">' +
                            data.data.message +
                            '</div>';
                        contactForm.reset();
                    } else {
                        statusEl.innerHTML =
                            '<div style="padding: 1rem; background: #f8d7da; color: #721c24; border-radius: 8px; font-size: 0.9rem;">' +
                            (data.data ? data.data.message : 'Ошибка отправки.') +
                            '</div>';
                    }
                })
                .catch(function () {
                    statusEl.style.display = 'block';
                    statusEl.innerHTML =
                        '<div style="padding: 1rem; background: #f8d7da; color: #721c24; border-radius: 8px; font-size: 0.9rem;">Ошибка сети. Попробуйте позже.</div>';
                })
                .finally(function () {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
        });
    }

    /* ==========================================================================
       7. Slick Slider Init (News Carousel)
       ========================================================================== */

    $(document).ready(function () {
        if ($('.nk-news-slider').length && typeof $.fn.slick === 'function') {
            // Only initialize slider if there are more than 3 items
            if ($('.nk-news-slider .nk-news-card').length > 3) {
                $('.nk-news-slider').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    dots: true,
                    arrows: false,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                            },
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                            },
                        },
                    ],
                });
            }
        }
    });

    /* ==========================================================================
       8. Custom Dropdown Menu (Crystal Form)
       ========================================================================== */
    // Native Select is being used for perfect compatibility.

})(jQuery);
