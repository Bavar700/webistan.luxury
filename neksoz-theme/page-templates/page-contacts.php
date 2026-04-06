<?php
/**
 * Template Name: ÐšÐ¾Ð½Ñ‚Ð°ÐºÑ‚Ñ‹
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
            <span class="section-label" style="color: rgba(255,255,255,0.5);"><?php esc_html_e( 'Ð¡Ð²ÑÐ¶Ð¸Ñ‚ÐµÑÑŒ Ñ Ð½Ð°Ð¼Ð¸', 'neksoz' ); ?></span>
            <h1 style="color: #fff;"><?php esc_html_e( 'ÐšÐ¾Ð½Ñ‚Ð°ÐºÑ‚Ñ‹', 'neksoz' ); ?></h1>
            <p style="color: rgba(255,255,255,0.7); max-width: 600px;">
                <?php esc_html_e( 'ÐœÑ‹ Ð²ÑÐµÐ³Ð´Ð° Ð½Ð° ÑÐ²ÑÐ·Ð¸. ÐžÑÑ‚Ð°Ð²ÑŒÑ‚Ðµ Ð·Ð°ÑÐ²ÐºÑƒ Ð¸Ð»Ð¸ Ð¿Ñ€Ð¸ÐµÐ·Ð¶Ð°Ð¹Ñ‚Ðµ Ðº Ð½Ð°Ð¼ Ð² Ð¾Ñ„Ð¸Ñ â€” Ð¼Ñ‹ Ð±ÑƒÐ´ÐµÐ¼ Ñ€Ð°Ð´Ñ‹ Ð’Ð°Ñ Ð²Ð¸Ð´ÐµÑ‚ÑŒ.', 'neksoz' ); ?>
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="nk-section">
        <div class="nk-container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start;">

                <!-- Contact Form -->
                <div>
                    <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;"><?php esc_html_e( 'ÐÐ°Ð¿Ð¸ÑˆÐ¸Ñ‚Ðµ Ð½Ð°Ð¼', 'neksoz' ); ?></h2>
                    <p style="margin-bottom: 2rem; color: var(--nk-text-muted);"><?php esc_html_e( 'Ð—Ð°Ð¿Ð¾Ð»Ð½Ð¸Ñ‚Ðµ Ñ„Ð¾Ñ€Ð¼Ñƒ Ð¸ Ð¼Ñ‹ ÑÐ²ÑÐ¶ÐµÐ¼ÑÑ Ñ Ð’Ð°Ð¼Ð¸ Ð² Ñ‚ÐµÑ‡ÐµÐ½Ð¸Ðµ Ñ€Ð°Ð±Ð¾Ñ‡ÐµÐ³Ð¾ Ð´Ð½Ñ.', 'neksoz' ); ?></p>

                    <form id="neksoz-contact-form" class="nk-form" novalidate>
                        <div class="nk-form__group">
                            <label for="nk-name" class="nk-form__label"><?php esc_html_e( 'Ð’Ð°ÑˆÐµ Ð¸Ð¼Ñ *', 'neksoz' ); ?></label>
                            <input type="text" id="nk-name" name="name" class="nk-form__input" placeholder="<?php esc_attr_e( 'Ð˜Ð²Ð°Ð½ Ð˜Ð²Ð°Ð½Ð¾Ð²', 'neksoz' ); ?>" required>
                        </div>

                        <div class="nk-form__group">
                            <label for="nk-email" class="nk-form__label"><?php esc_html_e( 'Email *', 'neksoz' ); ?></label>
                            <input type="email" id="nk-email" name="email" class="nk-form__input" placeholder="<?php esc_attr_e( 'example@company.com', 'neksoz' ); ?>" required>
                        </div>

                        <div class="nk-form__group">
                            <label for="nk-phone" class="nk-form__label"><?php esc_html_e( 'Ð¢ÐµÐ»ÐµÑ„Ð¾Ð½', 'neksoz' ); ?></label>
                            <input type="tel" id="nk-phone" name="phone" class="nk-form__input" placeholder="+992 (___) __-__-__">
                        </div>

                        <div class="nk-form__group">
                            <label for="nk-message" class="nk-form__label"><?php esc_html_e( 'Ð¡Ð¾Ð¾Ð±Ñ‰ÐµÐ½Ð¸Ðµ *', 'neksoz' ); ?></label>
                            <textarea id="nk-message" name="message" class="nk-form__textarea" placeholder="<?php esc_attr_e( 'ÐžÐ¿Ð¸ÑˆÐ¸Ñ‚Ðµ Ð’Ð°Ñˆ Ð²Ð¾Ð¿Ñ€Ð¾Ñ Ð¸Ð»Ð¸ Ð·Ð°Ð´Ð°Ñ‡Ñƒ...', 'neksoz' ); ?>" required></textarea>
                        </div>

                        <div id="nk-form-status" style="margin-bottom: 1rem; display: none;"></div>

                        <button type="submit" class="nk-btn nk-btn--primary" style="width: 100%; justify-content: center;">
                            <?php esc_html_e( 'ÐžÑ‚Ð¿Ñ€Ð°Ð²Ð¸Ñ‚ÑŒ Ð·Ð°ÑÐ²ÐºÑƒ', 'neksoz' ); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </button>
                    </form>
                </div>

                <!-- Contact Info + Map -->
                <div>
                    <h2 style="font-size: 1.5rem; margin-bottom: 2rem;"><?php esc_html_e( 'ÐšÐ¾Ð½Ñ‚Ð°ÐºÑ‚Ð½Ð°Ñ Ð¸Ð½Ñ„Ð¾Ñ€Ð¼Ð°Ñ†Ð¸Ñ', 'neksoz' ); ?></h2>

                    <div class="nk-contact-info">
                        <div class="nk-contact-info__item">
                            <div class="nk-contact-info__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <div class="nk-contact-info__label"><?php esc_html_e( 'ÐÐ´Ñ€ÐµÑ Ð¾Ñ„Ð¸ÑÐ°', 'neksoz' ); ?></div>
                                <div class="nk-contact-info__value"><?php esc_html_e( 'Ð³. Ð”ÑƒÑˆÐ°Ð½Ð±Ðµ, Ð¿Ñ€Ð¾ÑÐ¿ÐµÐºÑ‚ Ð ÑƒÐ´Ð°ÐºÐ¸ 55 3-ÑÑ‚Ð°Ð¶', 'neksoz' ); ?></div>
                            </div>
                        </div>

                        <div class="nk-contact-info__item">
                            <div class="nk-contact-info__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div>
                                <div class="nk-contact-info__label"><?php esc_html_e( 'Ð¢ÐµÐ»ÐµÑ„Ð¾Ð½', 'neksoz' ); ?></div>
                                <div class="nk-contact-info__value"><a href="tel:+992985641010">(+992) 985 64-10-10</a></div>
                            </div>
                        </div>

                        <div class="nk-contact-info__item">
                            <div class="nk-contact-info__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            </div>
                            <div>
                                <div class="nk-contact-info__label"><?php esc_html_e( 'Email', 'neksoz' ); ?></div>
                                <div class="nk-contact-info__value"><a href="mailto:info@neksoz.tj">info@neksoz.tj</a></div>
                            </div>
                        </div>

                        <div class="nk-contact-info__item">
                            <div class="nk-contact-info__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div>
                                <div class="nk-contact-info__label"><?php esc_html_e( 'Ð ÐµÐ¶Ð¸Ð¼ Ñ€Ð°Ð±Ð¾Ñ‚Ñ‹', 'neksoz' ); ?></div>
                                <div class="nk-contact-info__value"><?php esc_html_e( 'ÐŸÐ½ â€” ÐŸÑ‚: 8:00 â€” 17:00', 'neksoz' ); ?></div>
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
                            title="<?php esc_attr_e( 'Ð Ð°ÑÐ¿Ð¾Ð»Ð¾Ð¶ÐµÐ½Ð¸Ðµ Ð¾Ñ„Ð¸ÑÐ° NEKSOZ Ð½Ð° ÐºÐ°Ñ€Ñ‚Ðµ', 'neksoz' ); ?>">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
