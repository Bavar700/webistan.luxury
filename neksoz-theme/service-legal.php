<?php
/**
 * Template Name: Юридические услуги
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
                <div class="hero__badge">Департамент права</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Юридическая</span><br>защита
                </h1>
                <p class="hero__desc">
                    Надежная защита интересов компании и минимизация рисков в рамках законодательства Таджикистана.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary">Консультация</a>
            </div>
        </div>
    </section>

    <!-- Content... -->
    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Правовое сопровождение</h2>
        </div>
    </div>

</main>

<?php get_footer(); ?>
