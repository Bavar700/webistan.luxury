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

    <!-- Page Header -->
    <section class="nk-section--dark" style="padding: 60px 0;">
        <div class="nk-container">
            <span class="section-label" style="color: rgba(255,255,255,0.5);"><?php esc_html_e( 'Свяжитесь с нами', 'Neksoz' ); ?></span>
            <h1 style="color: #fff;"><?php esc_html_e( 'Контакты', 'Neksoz' ); ?></h1>
            <p style="color: rgba(255,255,255,0.7); max-width: 100% !important;">
                <?php esc_html_e( 'Мы всегда на связи. Оставьте заявку или приезжайте к нам в офис — мы будем рады Вас видеть.', 'Neksoz' ); ?>
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="nk-section">
        <div class="nk-container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start;">

                <!-- Contact Form -->
                <div>
                    <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;"><?php esc_html_e( 'Напишите нам', 'Neksoz' ); ?></h2>
                    <p style="margin-bottom: 2rem; color: var(--nk-text-muted);"><?php esc_html_e( 'Заполните форму и мы свяжемся с Вами в течение рабочего дня.', 'Neksoz' ); ?></p>

                    <form id="Neksoz-contact-form" class="nk-form" novalidate>
                        <div class="nk-form__group">
                            <label for="nk-name" class="nk-form__label"><?php esc_html_e( 'Ваше имя *', 'Neksoz' ); ?></label>
                            <input type="text" id="nk-name" name="name" class="nk-form__input" placeholder="<?php esc_attr_e( 'Иван Иванов', 'Neksoz' ); ?>" required>
                        </div>

                        <div class="nk-form__group">
                            <label for="nk-email" class="nk-form__label"><?php esc_html_e( 'Email *', 'Neksoz' ); ?></label>
                            <input type="email" id="nk-email" name="email" class="nk-form__input" placeholder="<?php esc_attr_e( 'example@company.com', 'Neksoz' ); ?>" required>
                        </div>

                        <div class="nk-form__group">
                            <label for="nk-phone" class="nk-form__label"><?php esc_html_e( 'Телефон', 'Neksoz' ); ?></label>
                            <input type="tel" id="nk-phone" name="phone" class="nk-form__input" placeholder="+992 (___) __-__-__">
                        </div>

                        <div class="nk-form__group">
                            <label for="nk-message" class="nk-form__label"><?php esc_html_e( 'Сообщение *', 'Neksoz' ); ?></label>
                            <textarea id="nk-message" name="message" class="nk-form__textarea" placeholder="<?php esc_attr_e( 'Опишите Ваш вопрос или задачу...', 'Neksoz' ); ?>" required></textarea>
                        </div>

                        <div id="nk-form-status" style="margin-bottom: 1rem; display: none;"></div>

                        <button type="submit" class="nk-btn nk-btn--primary" style="width: 100%; justify-content: center;">
                            <?php esc_html_e( 'Отправить заявку', 'Neksoz' ); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </button>
                    </form>
                </div>

                <!-- Contact Info + Map -->
                <div>
                    <h2 style="font-size: 1.5rem; margin-bottom: 2rem;"><?php esc_html_e( 'Контактная информация', 'Neksoz' ); ?></h2>

                    <div class="nk-contact-info">
                        <div class="nk-contact-info__item">
                            <div class="nk-contact-info__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <div class="nk-contact-info__label"><?php esc_html_e( 'Адрес офиса', 'Neksoz' ); ?></div>
                                <div class="nk-contact-info__value"><?php esc_html_e( 'г. Душанбе, проспект Рудаки 55 3-этаж', 'Neksoz' ); ?></div>
                            </div>
                        </div>

                        <div class="nk-contact-info__item">
                            <div class="nk-contact-info__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div>
                                <div class="nk-contact-info__label"><?php esc_html_e( 'Телефон', 'Neksoz' ); ?></div>
                                <div class="nk-contact-info__value"><a href="tel:+992985641010">(+992) 985 64-10-10</a></div>
                            </div>
                        </div>

                        <div class="nk-contact-info__item">
                            <div class="nk-contact-info__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            </div>
                            <div>
                                <div class="nk-contact-info__label"><?php esc_html_e( 'Email', 'Neksoz' ); ?></div>
                                <div class="nk-contact-info__value"><a href="mailto:info@Neksoz.tj">info@Neksoz.tj</a></div>
                            </div>
                        </div>

                        <div class="nk-contact-info__item">
                            <div class="nk-contact-info__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div>
                                <div class="nk-contact-info__label"><?php esc_html_e( 'Режим работы', 'Neksoz' ); ?></div>
                                <div class="nk-contact-info__value"><?php esc_html_e( 'Пн — Пт: 8:00 — 17:00', 'Neksoz' ); ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Google Maps -->
                    <div style="margin-top: 2rem;">
                        <iframe 
                            class="nk-map"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3100.5!2d68.7864!3d38.5598!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z0JTRg9GI0LDQvdCx0LU!5e0!3m2!1sru!2s!4v1"
                            width="100%" 
                            height="300" 
                            style="border:0; border-radius: var(--nk-card-radius);" 
                            allowfullscreen="" 
                            loading="lazy"
                            title="<?php esc_attr_e( 'Расположение офиса Neksoz на карте', 'Neksoz' ); ?>">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
