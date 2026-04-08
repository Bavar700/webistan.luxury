<?php
/**
 * Template Name: Услуга: Аудит
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
                <div class="hero__badge">Департамент аудита</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Финансовый</span><br>аудит
                </h1>
                <p class="hero__desc">
                    Профессиональное подтверждение достоверности финансовой отчетности в соответствии с МСФО.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary">Заказать аудит</a>
            </div>
        </div>
    </section>

    <!-- Editorial... -->
    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Обеспечьте прозрачность бизнеса</h2>
        </div>
    </div>

</main>

<?php get_footer(); ?>
