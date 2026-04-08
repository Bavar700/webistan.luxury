<?php
/**
 * Template Name: Услуги
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
                <div class="hero__badge">Полный спектр решений</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Комплексные услуги</span><br>для вашего бизнеса
                </h1>
                <p class="hero__desc">
                    Мы предлагаем экспертную поддержку на каждом этапе жизненного цикла компании — от регистрации до масштабирования.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary">Консультация</a>
            </div>
        </div>
    </section>

    <!-- Services Grid... -->
    <section class="section" style="background: var(--nk-gray-50);">
        <div class="container">
            <div class="services-grid">
                <!-- Cards remain same -->
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
