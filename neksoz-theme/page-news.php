<?php
/**
 * Template Name: Новости
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
            <div class="hero__badge fade-up is-visible">Пресс-центр</div>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1">
                <span class="text-gradient">Новости</span><br>и аналитика
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                Актуальные события компании, экспертные мнения<br>
                и важные изменения в <strong>законодательстве Таджикистана</strong>.
            </p>
        </div>
    </div>
</section>

<!-- ═══════════ NEWS GRID ═══════════ -->
<section class="section section--gray">
    <div class="container">
        <div class="section__header section__header--center fade-up is-visible">
            <div class="section__label">Последнее в блоге</div>
            <h2 class="section__title section__title--huge">Актуальные<br><span class="text-gradient">материалы</span></h2>
        </div>

        <div class="services-grid" style="grid-template-columns: repeat(3, 1fr);">
            
            <?php
            $news_query = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 9,
                'post_status'    => 'publish',
            ) );

            if ( $news_query->have_posts() ) :
                $delay = 0;
                while ( $news_query->have_posts() ) : $news_query->the_post();
                    ?>
                    <article class="service-card fade-up is-visible <?php echo ($delay % 2 == 1) ? 'service-card--alt' : ''; ?>">
                        <div style="font-size: 0.7rem; font-weight: 800; color: var(--nk-blue); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 12px;">
                            <?php echo get_the_date('d F Y'); ?>
                        </div>
                        <h3 class="service-card__title" style="font-size: 1.25rem;">
                            <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <p class="service-card__text">
                            <?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
                        </p>
                        <a href="<?php the_permalink(); ?>" class="service-card__link" style="margin-top: auto;">Читать статью →</a>
                    </article>
                    <?php
                    $delay++;
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 0;">
                    <div class="service-card" style="max-width: 500px; margin: 0 auto; padding: 40px;">
                        <p style="color: var(--nk-gray-500); font-size: 1.1rem; margin-bottom: 24px;">Новостей пока нет. Мы готовим для вас интересные материалы.</p>
                        <a href="<?php echo home_url('/'); ?>" class="btn btn--primary">Вернуться на главную</a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<!-- ═══════════ CTA ═══════════ -->
<section id="contacts" class="cta-crystal">
    <div class="cta-crystal__glow cta-crystal__glow--blue"></div>
    <div class="cta-crystal__glow cta-crystal__glow--red"></div>
    <div class="container">
        <div class="cta-crystal__grid">
            <div class="cta-crystal__content fade-up is-visible">
                <div class="section__label">Подписка</div>
                <h2 class="cta-crystal__title"><span class="text-gradient">Будьте в курсе</span><br>событий</h2>
                <p class="cta-crystal__text">Оставьте свой email, и мы будем присылать вам только самые важные новости и аналитические обзоры не чаще раза в месяц.</p>
                <div class="cta-crystal__status">
                    <span class="cta-crystal__status-dot"></span>
                    Уже 500+ подписчиков
                </div>
            </div>
            <div class="cta-crystal__form-wrapper fade-up is-visible">
                <form action="#" class="cta-crystal__form">
                    <div class="cta-crystal__field">
                        <input type="email" placeholder=" " required id="n-email">
                        <label for="n-email">Ваш Email</label>
                    </div>
                    <button type="submit" class="btn btn--primary" style="width: 100%; justify-content: center;">
                        Подписаться на новости
                        <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </button>
                    <p style="font-size: 0.75rem; color: var(--nk-gray-400); margin-top: 16px; text-align: center;">
                        Нажимая кнопку, вы соглашаетесь с политикой конфиденциальности.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>
