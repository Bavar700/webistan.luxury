<?php
/**
 * Footer Template — Neksoz.Luxury
 *
 * @package Neksoz
 */
?>

</div><!-- #page -->

<div class="footer-separator"></div>

<footer id="colophon" class="footer" role="contentinfo">
    <div class="container">

        <div class="footer__grid">

            <!-- Column 1: About -->
            <div>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo">
                    <img src="<?php echo esc_url( NEKSOZ_URI . '/assets/img/neksoz-logo.png' ); ?>" alt="NEKSOZ" style="height: 32px;">
                </a>
                <p class="footer__about-text">
                    <?php esc_html_e( 'Консалтинговая группа NEKSOZ — Ваш надёжный партнёр в сфере аудита, налогообложения и юридических услуг. Работаем для Вашего успеха.', 'neksoz' ); ?>
                </p>
            </div>

            <!-- Column 2: Services Links -->
            <div>
                <div class="footer__heading"><?php esc_html_e( 'Услуги', 'neksoz' ); ?></div>
                <ul class="footer__links">
                    <li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'Аудит', 'neksoz' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'Налогообложение', 'neksoz' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'Юридические услуги', 'neksoz' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'Бухгалтерский учёт', 'neksoz' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'Восстановление учёта', 'neksoz' ); ?></a></li>
                </ul>
            </div>

            <!-- Column 3: Company -->
            <div>
                <div class="footer__heading"><?php esc_html_e( 'Компания', 'neksoz' ); ?></div>
                <ul class="footer__links">
                    <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'О нас', 'neksoz' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/news' ) ); ?>"><?php esc_html_e( 'Новости', 'neksoz' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/vacancies' ) ); ?>"><?php esc_html_e( 'Вакансии', 'neksoz' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>"><?php esc_html_e( 'Контакты', 'neksoz' ); ?></a></li>
                </ul>
            </div>

            <!-- Column 4: Contacts -->
            <div>
                <div class="footer__heading"><?php esc_html_e( 'Контакты', 'neksoz' ); ?></div>
                
                <div class="footer__contact-item">
                    <div class="footer__contact-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div class="footer__contact-text">
                        <a href="tel:+992000000000">+992 (000) 00-00-00</a>
                    </div>
                </div>

                <div class="footer__contact-item">
                    <div class="footer__contact-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>
                    <div class="footer__contact-text">
                        <a href="mailto:info@neksoz.com">info@neksoz.com</a>
                    </div>
                </div>

                <div class="footer__contact-item">
                    <div class="footer__contact-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div class="footer__contact-text">
                        <?php esc_html_e( 'г. Душанбе, ул. Рудаки 42', 'neksoz' ); ?>
                    </div>
                </div>

            </div>

        </div><!-- .footer__grid -->

        <div class="footer__bottom">
            <span>&copy; <?php echo date( 'Y' ); ?> NEKSOZ. <?php esc_html_e( 'Все права защищены.', 'neksoz' ); ?></span>
            <span><?php esc_html_e( 'Разработано', 'neksoz' ); ?> <a href="https://webistan.luxury" target="_blank" rel="noopener">Webistan.Luxury</a></span>
        </div>

    </div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
