<?php
if (function_exists('nk_get_current_lang')) {
    $lang = nk_get_current_lang();
    if ($lang === 'tj' && !get_query_var('is_footer_tj')) {
        set_query_var('is_footer_tj', true);
        get_template_part('footer', 'tj');
        return;
    }
    if ($lang === 'en' && !get_query_var('is_footer_en')) {
        set_query_var('is_footer_en', true);
        get_template_part('footer', 'en');
        return;
    }
}
?>
<!-- ═══════════ FOOTER — CINEMATIC HERITAGE ═══════════ -->
<footer class="footer-platinum">
    <!-- Geometric Heritage mirroring Hero -->
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    
    <div class="container" style="position:relative; z-index:10;">
        <div class="footer-minimal">
            <!-- Part 1: Logo Centerpiece -->
            <div class="footer-minimal__logo fade-up">
                <img src='<?php echo get_template_directory_uri(); ?>/assets/images/logo.png' alt="NEKSOZ" class="footer-minimal__logo-img">
            </div>

            <!-- Part 2: Icon-Rich Main Nav Hub -->
            <nav class="footer-minimal__nav footer-nav--icons fade-up">
                <a href="<?php echo home_url('/'); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Главная
                </a>
                <a href="<?php echo home_url('/services'); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20"/><path d="m17 7-5 5-5-5"/><path d="m17 13-5 5-5-5"/></svg>
                    Услуги
                </a>
                <a href="<?php echo home_url('/team'); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Команда
                </a>
                <a href="<?php echo home_url('/news'); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8l-6 6v12a2 2 0 0 0 2 2z"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6v4h4"/></svg>
                    Новости
                </a>
                <a href="<?php echo home_url('/contacts'); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 17a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9.5C2 7 4 5 6.5 5H18c2.2 0 4 1.8 4 4v8Z"/><path d="m22 7-10 7L2 7"/></svg>
                    Связь
                </a>
                <a href="javascript:void(0)" id="openFooterMap">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    Карта
                </a>
            </nav>

            <!-- Part 3: Social Hub (Full Suite) -->
            <div class="footer-platinum__social-hub fade-up" style="margin: 30px 0 0 0;">
                <div class="footer-platinum__socials">
                    <a href="https://t.me/neksoz" class="footer-platinum__social-btn" title="Telegram">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                    </a>
                    <a href="https://wa.me/992446000000" class="footer-platinum__social-btn" title="WhatsApp">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 10h.01"/><path d="M12 10h.01"/><path d="M16 10h.01"/></svg>
                    </a>
                    <a href="#" class="footer-platinum__social-btn" title="X (Twitter)">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 4l11.733 16h4.267l-11.733-16zM4 20l6.768-6.768M13.232 10.768L20 4"/></svg>
                    </a>
                    <a href="tel:+992446000000" class="footer-platinum__social-btn" title="Позвонить">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </a>
                    <a href="mailto:info@neksoz.com" class="footer-platinum__social-btn" title="E-mail">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Final Compliance -->
    <div class="container" style="position:relative; z-index:10;">
        <div class="footer-platinum__bottom">
            <p>&copy; <?php echo date('Y'); ?> NEKSOZ. Все права защищены.</p>
            <div class="footer-platinum__legal">
                <a href="<?php echo home_url('/privacy-policy'); ?>">Конфиденциальность</a>
                <a href="<?php echo home_url('/terms'); ?>">Условия</a>
            </div>
        </div>
    </div>
</footer>

<!-- Modern Map Modal (Premium Experience) -->
<div class="map-modal" id="footerMapModal">
    <div class="map-modal__overlay" id="closeFooterMapBg"></div>
    <div class="map-modal__container">
        <button class="map-modal__close" id="closeFooterMapBtn">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
        <div class="map-modal__content">
            <!-- Red Accent Custom Marker -->
            <div class="map-modal__marker">
                <svg class="map-modal__marker-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/></svg>
                <div class="map-modal__marker-pulse"></div>
            </div>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3119.2635489025816!2d68.7844!3d38.5737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38b5d1645e05494d%3A0xc66517a264d1f56!2sRudaki%20Ave%2042%2C%20Dushanbe!5e0!3m2!1sen!2stj!4v1712465000000!5m2!1sen!2stj" 
                width="100%" height="100%" style="border:0; filter: grayscale(1) invert(0.9) contrast(1.2);" allowfullscreen="" loading="lazy"></iframe>
            <div class="map-modal__card">
                <strong>Наш офис:</strong>
                <span>Таджикистан, Душанбе, пр-т Рудаки 42</span>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════ SERVICE REQUEST MODAL ═══════════ -->
<div class="modal" id="requestModal">
    <div class="modal__overlay" id="closeRequestBg"></div>
    <div class="modal__container">
        <button class="modal__close" id="closeRequestBtn">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
        <div class="modal__content" style="padding: 0;">
            <div class="cta-crystal__grid">
                <!-- Left Side: Persuasion (without label) -->
                <div class="cta-crystal__content">
                    <h3 class="cta-crystal__title"><span class="text-gradient">Готовы масштабировать</span><br>свой успех?</h3>
                    <p class="cta-crystal__text">Оставьте заявку сегодня, и мы разработаем для вас персональную стратегию развития вашего бизнеса.</p>
                </div>

                <!-- Right Side: Form -->
                <div class="cta-crystal__form-wrapper">
                    <form action="#" class="cta-crystal__form">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="m-f-name">
                            <label for="m-f-name">Ваше имя</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="m-f-phone">
                            <label for="m-f-phone">Телефон (+992)</label>
                        </div>
                        <div class="cta-crystal__field nx-dropdown" id="modalDropdown">
                            <input type="text" placeholder=" " required id="m-f-service-input" class="nx-dropdown__trigger" readonly>
                            <label for="m-f-service-input">Выбрать направление <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px; display: inline-block; vertical-align: middle;"><path d="m6 9 6 6 6-6"/></svg></label>
                            <div class="nx-dropdown__panel">
                                <div class="nx-dropdown__option" data-val="legal">Юридическое сопровождение</div>
                                <div class="nx-dropdown__option" data-val="tax">Налоговое консультирование</div>
                                <div class="nx-dropdown__option" data-val="audit">Аудит и бух. учет</div>
                                <div class="nx-dropdown__option" data-val="accounting">Бухгалтерский учет</div>
                                <div class="nx-dropdown__option" data-val="automation">Автоматизация бизнеса</div>
                                <div class="nx-dropdown__option" data-val="consulting">Бизнес-консалтинг</div>
                                <div class="nx-dropdown__option" data-val="secretariat">Услуги секретариата</div>
                                <div class="nx-dropdown__option" data-val="restore">Восстановление учета</div>
                                <div class="nx-dropdown__option" data-val="management">Управленческий учет</div>
                            </div>
                        </div>
                        <div class="cta-crystal__field">
                            <textarea placeholder=" " id="m-f-msg" rows="3"></textarea>
                            <label for="m-f-msg">Суть вашего запроса</label>
                        </div>
                        <button type="submit" class="cta-crystal__btn">
                            <span>Отправить заявку</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </button>
                        <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 15px; line-height: 1.4; opacity: 0.8; width: 100%;">
                            Нажимая кнопку, вы соглашаетесь с <a href="<?php echo home_url('/privacy-policy'); ?>" style="color: var(--nk-blue); text-decoration: underline;">Политикой конфиденциальности</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Map Modal
    const mapTrigger = document.getElementById('openFooterMap');
    const mapModal = document.getElementById('footerMapModal');
    const closeMapBtn = document.getElementById('closeFooterMapBtn');
    const closeMapBg = document.getElementById('closeFooterMapBg');

    if (mapTrigger && mapModal) {
        mapTrigger.addEventListener('click', (e) => {
            e.preventDefault();
            mapModal.classList.add('is-active');
        });
        [closeMapBtn, closeMapBg].forEach(el => {
            el.addEventListener('click', () => mapModal.classList.remove('is-active'));
        });
    }

    // Modal Dropdown Logic
    const drp = document.getElementById('modalDropdown');
    if (drp) {
        const trigger = drp.querySelector('.nx-dropdown__trigger');
        const options = drp.querySelectorAll('.nx-dropdown__option');

        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            drp.classList.toggle('is-open');
        });

        options.forEach(opt => {
            opt.addEventListener('click', function(e) {
                e.stopPropagation();
                trigger.value = this.innerText;
                drp.classList.remove('is-open');
                trigger.classList.add('has-value');
            });
        });

        document.addEventListener('click', function(e) {
            if (!drp.contains(e.target)) {
                drp.classList.remove('is-open');
            }
        });
    }

    // Request Modal Global Controller
    const requestModal = document.getElementById('requestModal');
    const closeRequestBtn = document.getElementById('closeRequestBtn');
    const closeRequestBg = document.getElementById('closeRequestBg');

    window.openRequestModal = function(serviceSlug = '') {
        if (requestModal) {
            const trigger = requestModal.querySelector('.nx-dropdown__trigger');
            if (serviceSlug && trigger) {
                const opt = requestModal.querySelector('.nx-dropdown__option[data-val="' + serviceSlug + '"]');
                if (opt) {
                    trigger.value = opt.innerText;
                    trigger.classList.add('has-value');
                }
            }
            requestModal.classList.add('is-active');
        }
    };

    [closeRequestBtn, closeRequestBg].forEach(el => {
        if (el) el.addEventListener('click', () => requestModal.classList.remove('is-active'));
    });

    // Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { rootMargin: '0px 0px -40px 0px', threshold: 0.1 });

    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
});
</script>

<?php wp_footer(); ?>
</body>
</html>