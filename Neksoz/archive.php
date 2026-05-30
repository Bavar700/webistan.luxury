<?php
/**
 * Archive Template — Neksoz.Luxury
 */
get_header(); global $current_lang; 
?>

<main id="primary" class="site-main">

<!-- ═══════════ CINEMATIC HERO ═══════════ -->
<section class="hero hero--internal">
    <div class="hero__geo"></div>
    <div class="hero__grid-pattern"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>

    <div class="container hero__container" style="position:relative;z-index:2;">
        <div class="hero__content">
            <div class="hero__badge">Архив записей</div>
            <h1 class="hero__title">
                <span class="text-gradient"><?php the_archive_title(); ?></span>
            </h1>
            <?php if ( get_the_archive_description() ) : ?>
                <p class="hero__desc">
                    <?php echo get_the_archive_description(); ?>
                </p>
            <?php endif; ?>
        </div>
        
        <div class="hero__actions--right">
            <a href="<?php echo nk_link('/', $current_lang); ?>" class="btn btn--primary">На главную</a>
        </div>
    </div>
</section>

<!-- Content... -->
<section class="section">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="services-grid">
                <!-- Loop -->
            </div>
        <?php endif; ?>
    </div>
</section>

</main>

<?php get_footer(); ?>


