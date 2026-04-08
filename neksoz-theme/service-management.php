<?php
/**
 * Template Name: Управленческий учет
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
                <div class="hero__badge">Управление данными</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Финансовый</span><br>учет
                </h1>
                <p class="hero__desc">
                    Внедрение систем сбора и анализа данных для принятия обоснованных управленческих решений.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary">Заказать систему</a>
            </div>
        </div>
    </section>

    <!-- Content... -->
    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Знать, а не догадываться</h2>
        </div>
    </div>

</main>

<?php get_footer(); ?>
