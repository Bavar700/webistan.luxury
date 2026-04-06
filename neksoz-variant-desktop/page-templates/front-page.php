<?php
/**
 * Template Name: Главная страница
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- ═══════════ HERO ═══════════ -->
    <section class="hero">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container" style="position:relative;z-index:2;">
            <div class="hero__content fade-up is-visible">
                <div class="hero__badge"><?php esc_html_e( 'Business Consulting Group', 'neksoz' ); ?></div>
                <h1 class="hero__title">
                    <?php esc_html_e( 'Будем', 'neksoz' ); ?><br>
                    <em><?php esc_html_e( 'решать!', 'neksoz' ); ?></em>
                </h1>
                <p class="hero__desc">
                    <?php esc_html_e( 'Профессиональный аудит, налоговое планирование и юридическое сопровождение бизнеса. Надёжность и экспертность для Вашего успеха.', 'neksoz' ); ?>
                </p>
                <div class="hero__actions">
                    <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="btn btn--primary">
                        <?php esc_html_e( 'Наши услуги', 'neksoz' ); ?>
                        <svg class="btn__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="btn btn--outline-light">
                        <?php esc_html_e( 'Связаться с нами', 'neksoz' ); ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="hero__stats fade-up is-visible fade-up-delay-1">
            <div class="container hero__stats-inner">
                <div class="hero__stat">
                    <div class="hero__stat-value">500<span>+</span></div>
                    <div class="hero__stat-label"><?php esc_html_e( 'Клиентов', 'neksoz' ); ?></div>
                </div>
                <div class="hero__stat-divider"></div>
                <div class="hero__stat">
                    <div class="hero__stat-value">18<span>+</span></div>
                    <div class="hero__stat-label"><?php esc_html_e( 'Лет опыта', 'neksoz' ); ?></div>
                </div>
                <div class="hero__stat-divider"></div>
                <div class="hero__stat">
                    <div class="hero__stat-value">50<span>+</span></div>
                    <div class="hero__stat-label"><?php esc_html_e( 'Экспертов', 'neksoz' ); ?></div>
                </div>
                <div class="hero__stat-divider"></div>
                <div class="hero__stat">
                    <div class="hero__stat-value">1200<span>+</span></div>
                    <div class="hero__stat-label"><?php esc_html_e( 'Проектов', 'neksoz' ); ?></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════ SERVICES ═══════════ -->
    <section id="services" class="section section--gray">
        <div class="container">
            <div class="section__header section__header--center fade-up is-visible">
                <div class="section__label"><?php esc_html_e( 'Направления', 'neksoz' ); ?></div>
                <h2 class="section__title"><?php esc_html_e( 'Комплексные решения', 'neksoz' ); ?><br><?php esc_html_e( 'для Вашего бизнеса', 'neksoz' ); ?></h2>
                <p class="section__subtitle"><?php esc_html_e( 'Каждая услуга адаптируется под индивидуальные потребности клиента и обеспечивает максимальную защиту Ваших интересов.', 'neksoz' ); ?></p>
            </div>

            <div class="services-grid">
                <!-- 1 -->
                <div class="service-card fade-up is-visible">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 14l2 2 4-4"/></svg>
                    </div>
                    <h3 class="service-card__title"><?php esc_html_e( 'Аудит', 'neksoz' ); ?></h3>
                    <p class="service-card__text"><?php esc_html_e( 'Независимая проверка финансовой отчётности. Объективность, точность и полное соответствие международным стандартам.', 'neksoz' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="service-card__link"><?php esc_html_e( 'Подробнее &rarr;', 'neksoz' ); ?></a>
                </div>
                <!-- 2 -->
                <div class="service-card service-card--alt fade-up is-visible fade-up-delay-1">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M7 15h0M2 9.5h20"/></svg>
                    </div>
                    <h3 class="service-card__title"><?php esc_html_e( 'Налогообложение', 'neksoz' ); ?></h3>
                    <p class="service-card__text"><?php esc_html_e( 'Оптимизация налоговой нагрузки, подготовка отчётности, представительство в налоговых органах.', 'neksoz' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="service-card__link"><?php esc_html_e( 'Подробнее &rarr;', 'neksoz' ); ?></a>
                </div>
                <!-- 3 -->
                <div class="service-card fade-up is-visible fade-up-delay-2">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="service-card__title"><?php esc_html_e( 'Юридические услуги', 'neksoz' ); ?></h3>
                    <p class="service-card__text"><?php esc_html_e( 'Правовое сопровождение: регистрация, лицензирование, договорная работа и защита интересов в суде.', 'neksoz' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="service-card__link"><?php esc_html_e( 'Подробнее &rarr;', 'neksoz' ); ?></a>
                </div>
                <!-- 4 -->
                <div class="service-card service-card--alt fade-up is-visible">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="8" y1="10" x2="16" y2="10"/><line x1="8" y1="14" x2="12" y2="14"/></svg>
                    </div>
                    <h3 class="service-card__title"><?php esc_html_e( 'Бухгалтерский учёт', 'neksoz' ); ?></h3>
                    <p class="service-card__text"><?php esc_html_e( 'Полное ведение бухгалтерии на аутсорсинге. Своевременная подготовка и сдача финансовой отчётности.', 'neksoz' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="service-card__link"><?php esc_html_e( 'Подробнее &rarr;', 'neksoz' ); ?></a>
                </div>
                <!-- 5 -->
                <div class="service-card fade-up is-visible fade-up-delay-1">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
                    </div>
                    <h3 class="service-card__title"><?php esc_html_e( 'Восстановление учёта', 'neksoz' ); ?></h3>
                    <p class="service-card__text"><?php esc_html_e( 'Восстановим утраченную документацию. Приведём бухгалтерию в полное соответствие с требованиями.', 'neksoz' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="service-card__link"><?php esc_html_e( 'Подробнее &rarr;', 'neksoz' ); ?></a>
                </div>
                <!-- 6 -->
                <div class="service-card service-card--alt fade-up is-visible fade-up-delay-2">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="service-card__title"><?php esc_html_e( 'Бизнес-консалтинг', 'neksoz' ); ?></h3>
                    <p class="service-card__text"><?php esc_html_e( 'Стратегическое планирование, финансовый анализ, оптимизация процессов и оценка инвестиций.', 'neksoz' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="service-card__link"><?php esc_html_e( 'Подробнее &rarr;', 'neksoz' ); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════ ABOUT ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="about-grid">
                <div class="about__content fade-up is-visible">
                    <div class="section__label"><?php esc_html_e( 'О компании', 'neksoz' ); ?></div>
                    <h2 class="section__title"><?php esc_html_e( 'Ваш надёжный партнёр', 'neksoz' ); ?><br><?php esc_html_e( 'в мире финансов', 'neksoz' ); ?></h2>
                    <p><?php esc_html_e( 'Консалтинговая группа NEKSOZ объединяет ведущих экспертов в области аудита, налогообложения, бухгалтерского учёта и юридического сопровождения.', 'neksoz' ); ?></p>
                    <p><?php esc_html_e( 'Мы помогаем бизнесу расти, обеспечивая полную прозрачность и соответствие законодательству. За годы работы мы заслужили доверие сотен компаний — от стартапов до крупных корпораций.', 'neksoz' ); ?></p>

                    <div class="trust-indicators">
                        <div class="trust-item">
                            <div class="trust-item__value trust-item__value--blue">500+</div>
                            <div class="trust-item__label"><?php esc_html_e( 'Клиентов', 'neksoz' ); ?></div>
                        </div>
                        <div class="trust-item">
                            <div class="trust-item__value trust-item__value--red">18+</div>
                            <div class="trust-item__label"><?php esc_html_e( 'Лет опыта', 'neksoz' ); ?></div>
                        </div>
                        <div class="trust-item">
                            <div class="trust-item__value trust-item__value--blue">50+</div>
                            <div class="trust-item__label"><?php esc_html_e( 'Экспертов', 'neksoz' ); ?></div>
                        </div>
                    </div>
                </div>

                <div class="quote-card fade-up is-visible fade-up-delay-1">
                    <div class="quote-card__mark">"</div>
                    <p class="quote-card__text">
                        <?php esc_html_e( 'Наша миссия — предоставить каждому клиенту уровень сервиса, который превосходит ожидания. Мы не просто решаем задачи — мы создаём фундамент для долгосрочного роста Вашего бизнеса.', 'neksoz' ); ?>
                    </p>
                    <div class="quote-card__author">
                        <div class="quote-card__author-line"></div>
                        <div class="quote-card__author-name"><?php esc_html_e( 'Руководство NEKSOZ', 'neksoz' ); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════ LATEST NEWS (WP LOOP) ═══════════ -->
    <section class="section section--gray">
        <div class="container">
            <div class="section__header section__header--center fade-up is-visible">
                <div class="section__label"><?php esc_html_e( 'Будьте в курсе', 'neksoz' ); ?></div>
                <h2 class="section__title"><?php esc_html_e( 'Последние новости', 'neksoz' ); ?></h2>
                <p class="section__subtitle"><?php esc_html_e( 'Актуальные изменения в законодательстве и события компании', 'neksoz' ); ?></p>
            </div>

            <?php
            $latest_posts = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
            ) );

            if ( $latest_posts->have_posts() ) :
            ?>
                <div class="services-grid fade-up is-visible">
                    <?php
                    while ( $latest_posts->have_posts() ) : $latest_posts->the_post();
                        // Instead of relying on a sub-template we haven't redesigned, let's output a sleek card inline
                        ?>
                        <div class="service-card" style="padding: 32px 24px;">
                            <div style="font-size: 13px; color: var(--nk-gray-400); margin-bottom: 12px; font-weight: 600;"><?php echo get_the_date(); ?></div>
                            <h3 class="service-card__title" style="font-size: 1.1rem; margin-bottom: 16px;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p class="service-card__text" style="font-size: 0.95rem;"><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="service-card__link btn--ghost" style="padding: 8px 16px; border-radius: 6px; font-size: 12px; border: 1.5px solid var(--nk-gray-100);"><?php esc_html_e( 'Читать', 'neksoz' ); ?> &rarr;</a>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php else : ?>
                <div style="text-align: center; color: var(--nk-gray-400);">
                    <p><?php esc_html_e( 'Новости появятся здесь совсем скоро. Следите за обновлениями!', 'neksoz' ); ?></p>
                </div>
            <?php endif; ?>

            <div style="text-align: center; margin-top: 48px;" class="fade-up is-visible fade-up-delay-1">
                <a href="<?php echo esc_url( home_url( '/news' ) ); ?>" class="btn btn--blue">
                    <?php esc_html_e( 'Все новости', 'neksoz' ); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ CTA ═══════════ -->
    <section id="contacts" class="cta">
        <div class="container fade-up is-visible">
            <h2 class="cta__title"><?php esc_html_e( 'Готовы начать?', 'neksoz' ); ?></h2>
            <p class="cta__text"><?php esc_html_e( 'Свяжитесь с нами для бесплатной консультации. Мы подберём оптимальное решение для Вашего бизнеса.', 'neksoz' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="btn btn--primary" style="padding: 16px 40px; font-size: 15px;">
                <?php esc_html_e( 'Получить консультацию', 'neksoz' ); ?>
                <svg class="btn__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
