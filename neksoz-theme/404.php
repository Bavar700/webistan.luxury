<?php
/**
 * 404 Error Template — Neksoz.Luxury
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

<section class="hero" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center;">
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    
    <div class="container hero__inner" style="position: relative; z-index: 2;">
        <div class="hero__content" style="max-width: 700px; margin: 0 auto;">
            <div style="font-size: 10rem; font-weight: 900; line-height: 1; color: rgba(255,255,255,0.05); position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: -1;">404</div>
            <div class="hero__badge fade-up is-visible">Страница не найдена</div>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1">
                <span class="text-gradient">Ошибка 404</span>
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2" style="margin: 0 auto 40px;">
                К сожалению, страница, которую вы ищете, была перемещена или никогда не существовала.<br>
                Попробуйте вернуться на главную или воспользоваться навигацией.
            </p>
            <div class="hero__actions fade-up is-visible fade-up-delay-3" style="justify-content: center;">
                <a href="<?php echo home_url('/'); ?>" class="btn btn--primary">На главную страницу</a>
                <a href="<?php echo home_url('/services'); ?>" class="btn btn--outline-light">Наши услуги</a>
            </div>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>
