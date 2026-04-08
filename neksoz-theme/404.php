<?php
/**
 * 404 Error Template — Neksoz.Luxury
 */
get_header();
?>

<main id="primary" class="site-main">

<section class="hero hero--internal" style="padding: 200px 0;">
    <div class="hero__geo"></div>
    <div class="hero__grid-pattern"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    
    <div class="container hero__container" style="position: relative; z-index: 2; align-items: center; justify-content: center; text-align: center; flex-direction: column;">
        <div class="hero__content" style="max-width: 800px; margin: 0 auto;">
            <div class="hero__badge">Страница не найдена</div>
            <h1 class="hero__title">
                <span class="text-gradient">Ошибка 404</span>
            </h1>
            <p class="hero__desc" style="margin: 0 auto 40px;">
                К сожалению, страница была перемещена или никогда не существовала.<br>
                Попробуйте вернуться на главную.
            </p>
            <div style="display: flex; gap: 20px; justify-content: center;">
                <a href="<?php echo home_url('/'); ?>" class="btn btn--primary">На главную</a>
            </div>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>
