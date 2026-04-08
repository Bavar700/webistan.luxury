<?php
/**
 * Template Name: Восстановление финансового учета
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
                <div class="hero__badge">Кризис-менеджмент</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Восстановление</span><br>учета
                </h1>
                <p class="hero__desc">
                    Приведение запущенной документации в порядок и защита вашего бизнеса от претензий госорганов.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary">Начать процесс</a>
            </div>
        </div>
    </section>

    <!-- Editorial... -->
    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Наведение порядка в финансах</h2>
        </div>
    </div>

</main>

<?php get_footer(); ?>
