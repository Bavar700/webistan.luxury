<?php
/**
 * 404 Error Template — Neksoz.Luxury
 */
get_header();
?>

<main id="primary" class="site-main">

<section class="hero hero--internal" style="min-height: 80vh; display: flex; align-items: center; background: var(--nk-grad-hero);">
    <div class="hero__geo"></div>
    <div class="hero__grid-pattern"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    
    <div class="container" style="position: relative; z-index: 2; text-align: center;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 25vw; font-weight: 900; color: rgba(255,255,255,0.03); z-index: -1; pointer-events: none; font-family: var(--font-display);">404</div>
        
        <div class="hero__badge" style="margin-bottom: 24px;">Ошибка доступа</div>
        <h1 class="hero__title" style="font-size: clamp(3rem, 8vw, 6rem); margin-bottom: 24px;">
            <span class="text-gradient">Страница не</span><br>найдена
        </h1>
        <p class="hero__desc" style="margin: 0 auto 48px; max-width: 600px; color: rgba(255,255,255,0.6);">
            К сожалению, запрашиваемый ресурс был перемещен или никогда не существовал в нашей системе координат.
        </p>
        
        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
            <a href="<?php echo home_url('/'); ?>" class="btn btn--primary">Вернуться на главную</a>
            <a href="<?php echo home_url('/services'); ?>" class="btn btn--outline-light">Наши услуги</a>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>
