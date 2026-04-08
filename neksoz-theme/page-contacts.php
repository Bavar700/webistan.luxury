<?php
/**
 * Template Name: Контакты
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

<!-- ═══════════ PAGE HERO ═══════════ -->
<section class="hero" style="min-height: 50vh; display: flex; align-items: center;">
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    <div class="container hero__inner" style="position: relative; z-index: 2;">
        <div class="hero__content">
            <div class="hero__badge fade-up is-visible">Обратная связь</div>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1">
                <span class="text-gradient">Свяжитесь</span><br>с нами
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                Мы всегда готовы ответить на ваши вопросы.<br>
                Оставьте заявку и получите <strong>бесплатную консультацию</strong> в течение 15 минут.
            </p>
        </div>
    </div>
</section>

<!-- ═══════════ CONTACTS BLOCK ═══════════ -->
<section class="section section--gray">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: start;">

            <!-- Contact Info Cards -->
            <div class="fade-up is-visible">
                <div class="section__label">Наши контакты</div>
                <h2 class="section__title section__title--huge">Мы всегда<br><span class="text-gradient">на связи</span></h2>
                <p style="color: var(--nk-gray-600); font-size: 1.05rem; line-height: 1.7; margin-bottom: 40px;">
                    Наша деятельность осуществляется в интеллектуальной сфере, и главное в нашем бизнесе — это люди и их благополучие.
                </p>

                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <!-- Phone -->
                    <a href="tel:+99298564101" style="display: flex; align-items: center; gap: 20px; padding: 24px 28px; background: var(--nk-white); border: 1px solid var(--nk-gray-100); border-radius: 16px; text-decoration: none; transition: all 0.3s; box-shadow: 0 2px 8px rgba(0,0,0,0.04);" onmouseover="this.style.boxShadow='0 8px 32px rgba(0,68,204,0.12)'; this.style.borderColor='rgba(0,68,204,0.2)'" onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'; this.style.borderColor='var(--nk-gray-100)'">
                        <div style="width: 52px; height: 52px; min-width: 52px; background: rgba(0,68,204,0.08); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--nk-blue)" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.15 3.38 2 2 0 0 1 3.12 1h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21 16.92z"/></svg>
                        </div>
                        <div>
                            <div style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-400); font-weight: 700; margin-bottom: 4px;">Телефон</div>
                            <div style="font-size: 1.1rem; font-weight: 800; color: var(--nk-gray-900);">(+992) 985 64-10-10</div>
                        </div>
                    </a>

                    <!-- Email -->
                    <a href="mailto:info@neksoz.tj" style="display: flex; align-items: center; gap: 20px; padding: 24px 28px; background: var(--nk-white); border: 1px solid var(--nk-gray-100); border-radius: 16px; text-decoration: none; transition: all 0.3s; box-shadow: 0 2px 8px rgba(0,0,0,0.04);" onmouseover="this.style.boxShadow='0 8px 32px rgba(227,6,19,0.1)'; this.style.borderColor='rgba(227,6,19,0.15)'" onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)'; this.style.borderColor='var(--nk-gray-100)'">
                        <div style="width: 52px; height: 52px; min-width: 52px; background: rgba(227,6,19,0.06); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--nk-red)" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div>
                            <div style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-400); font-weight: 700; margin-bottom: 4px;">Email</div>
                            <div style="font-size: 1.1rem; font-weight: 800; color: var(--nk-gray-900);">info@neksoz.tj</div>
                        </div>
                    </a>

                    <!-- Address -->
                    <div style="display: flex; align-items: center; gap: 20px; padding: 24px 28px; background: var(--nk-white); border: 1px solid var(--nk-gray-100); border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <div style="width: 52px; height: 52px; min-width: 52px; background: rgba(0,68,204,0.08); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--nk-blue)" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <div style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-400); font-weight: 700; margin-bottom: 4px;">Адрес</div>
                            <div style="font-size: 1rem; font-weight: 800; color: var(--nk-gray-900);">г. Душанбе, проспект Рудаки 55<br><span style="font-size: 0.85rem; font-weight: 600; color: var(--nk-gray-500);">3-й этаж</span></div>
                        </div>
                    </div>

                    <!-- Hours -->
                    <div style="display: flex; align-items: center; gap: 20px; padding: 24px 28px; background: var(--nk-white); border: 1px solid var(--nk-gray-100); border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <div style="width: 52px; height: 52px; min-width: 52px; background: rgba(227,6,19,0.06); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--nk-red)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div>
                            <div style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-400); font-weight: 700; margin-bottom: 4px;">Режим работы</div>
                            <div style="font-size: 1rem; font-weight: 800; color: var(--nk-gray-900);">Пн–Пт: 9:00 — 18:00<br><span style="font-size: 0.85rem; font-weight: 600; color: var(--nk-gray-500);">Сб–Вс: выходной</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="fade-up is-visible fade-up-delay-1">
                <div style="background: var(--nk-white); border: 1px solid var(--nk-gray-100); border-radius: 24px; padding: 50px 44px; box-shadow: 0 8px 40px rgba(0,0,0,0.06);">
                    <div style="margin-bottom: 32px;">
                        <div class="cta-crystal__status" style="margin-bottom: 16px;">
                            <span class="cta-crystal__status-dot"></span>
                            Мы онлайн • Ответ в течение 15 минут
                        </div>
                        <h3 style="font-size: 1.6rem; font-weight: 900; color: var(--nk-gray-900); margin-bottom: 8px; letter-spacing: -0.02em;">Отправьте заявку</h3>
                        <p style="color: var(--nk-gray-500); font-size: 0.95rem; margin: 0;">Мы свяжемся с вами в ближайшее время</p>
                    </div>
                    <form action="#" class="cta-crystal__form">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="c-name">
                            <label for="c-name">Ваше имя</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="c-phone">
                            <label for="c-phone">Телефон (+992)</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="email" placeholder=" " id="c-email">
                            <label for="c-email">Email (необязательно)</label>
                        </div>
                        <div class="cta-crystal__field nx-dropdown">
                            <input type="text" placeholder=" " required id="c-service" class="nx-dropdown__trigger" readonly>
                            <label for="c-service">Выберите услугу</label>
                            <div class="nx-dropdown__list">
                                <div class="nx-dropdown__item" data-value="audit">Аудит финансовой деятельности</div>
                                <div class="nx-dropdown__item" data-value="restore">Восстановление учёта</div>
                                <div class="nx-dropdown__item" data-value="legal">Юридические консультации</div>
                                <div class="nx-dropdown__item" data-value="accounting">Ведение учёта</div>
                                <div class="nx-dropdown__item" data-value="tax">Налоговые консультации</div>
                                <div class="nx-dropdown__item" data-value="consulting">Бизнес-консультации</div>
                                <div class="nx-dropdown__item" data-value="other">Другое</div>
                            </div>
                        </div>
                        <div class="cta-crystal__field">
                            <textarea placeholder=" " id="c-msg" rows="3"></textarea>
                            <label for="c-msg">Сообщение</label>
                        </div>
                        <button type="submit" class="btn btn--primary" style="width: 100%; justify-content: center; margin-top: 8px;">
                            Отправить заявку
                            <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ MAP ═══════════ -->
<section class="section" style="padding-top: 0;">
    <div class="container">
        <div style="border-radius: 20px; overflow: hidden; box-shadow: 0 8px 40px rgba(0,0,0,0.1); height: 450px;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2995.9!2d68.7791!3d38.5598!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzjCsDMzJzM1LjMiTiA2OMKwNDYnNDQuNyJF!5e0!3m2!1sru!2stj!4v1000000000000!5m2!1sru!2stj"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>
