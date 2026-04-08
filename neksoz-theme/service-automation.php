<?php
/**
 * Template Name: Автоматизация
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
                <div class="hero__badge">IT & Digital</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Автоматизация</span><br>бизнеса
                </h1>
                <p class="hero__desc">
                    Внедрение IT-решений и 1С для цифровой трансформации учета и повышения скорости работы.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary">Внедрить IT</a>
            </div>
        </div>
    </section>

    <!-- Content... -->
    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Цифровой фундамент</h2>
        </div>
    </div>

</main>

<?php get_footer(); ?>
