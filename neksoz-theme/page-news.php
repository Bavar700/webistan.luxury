<?php
/**
 * Template Name: Новости
 */
get_header();
?>

<main class="site-main">

    <!-- ═══════════ CINEMATIC HERO ═══════════ -->
    <section class="hero hero--internal">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container" style="position:relative;z-index:2;">
            <div class="hero__content">
                <div class="hero__badge">Пресс-центр</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Новости и</span><br>аналитика
                </h1>
                <p class="hero__desc">
                    Актуальные события компании и экспертные обзоры финансового рынка Таджикистана.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary">Подписаться</a>
            </div>
        </div>
    </section>

    <!-- News Feed... -->
    <div class="editorial-content">
        <div class="editorial-main">
            <!-- Loop remains -->
        </div>
    </div>

</main>

<?php get_footer(); ?>
