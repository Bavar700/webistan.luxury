<?php
/**
 * Template Name: О нас
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
                <div class="hero__badge">История и видение</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Ваш стратегический</span><br>бизнес-партнер
                </h1>
                <p class="hero__desc">
                    Neksoz — экспертный хаб, объединивший опыт в аудите и праве для создания новой ценности вашего бизнеса.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary">Начать проект</a>
            </div>
        </div>
    </section>

    <!-- Content... -->
    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Профессионализм мирового уровня</h2>
            <p>Мы верим, что в современном мире успех бизнеса зависит от способности вовремя увидеть скрытые риски и возможности.</p>
        </div>
    </div>

</main>

<?php get_footer(); ?>
