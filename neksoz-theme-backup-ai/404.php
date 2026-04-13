<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
get_header(); ?>

<style>
.error-v3 {
    min-height: 100vh;
    background: var(--nk-grad-hero);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    color: var(--nk-white);
    padding-top: 77px;
}

.error-v3__geo {
    position: absolute;
    inset: 0;
    pointer-events: none;
    opacity: 0.15;
    background-image: 
        linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 50px 50px;
}

.error-v3__accent-orb {
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(227,6,19,0.1) 0%, transparent 70%);
    filter: blur(80px);
    z-index: 0;
}

.error-v3__content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 800px;
    padding: 0 40px;
}

.error-v3__number {
    font-family: var(--font-display);
    font-size: clamp(120px, 20vw, 240px);
    font-weight: 900;
    line-height: 1;
    margin-bottom: -20px;
    background: linear-gradient(180deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -0.05em;
    user-select: none;
}

.error-v3__title {
    font-family: var(--font-display);
    font-size: clamp(32px, 5vw, 56px);
    font-weight: 800;
    margin-bottom: 24px;
    letter-spacing: -0.02em;
}

.error-v3__text {
    font-size: 1.15rem;
    line-height: 1.6;
    color: rgba(255,255,255,0.6);
    margin-bottom: 48px;
    font-weight: 400;
}

/* Coordinates Crosshair Decoration */
.error-v3__crosshair {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100vw;
    height: 1px;
    background: rgba(255,255,255,0.05);
    transform: translate(-50%, -50%);
}
.error-v3__crosshair--v {
    width: 1px;
    height: 100vh;
}

</style>

<main class="error-v3">
    <!-- Geometric Matrix Background -->
    <div class="error-v3__geo"></div>
    <div class="error-v3__crosshair"></div>
    <div class="error-v3__crosshair error-v3__crosshair--v"></div>
    <div class="error-v3__accent-orb" style="top: 10%; right: -10%;"></div>
    <div class="error-v3__accent-orb" style="bottom: -10%; left: -10%; background: radial-gradient(circle, rgba(0,68,204,0.1) 0%, transparent 70%);"></div>

    <div class="error-v3__content fade-up" style="opacity: 1; transform: translateY(0);">
        <div class="error-v3__number">404</div>
        <h1 class="error-v3__title">Страница не найдена</h1>
        <p class="error-v3__text">
            К сожалению, запрашиваемый ресурс был перемещен или никогда не существовал в нашей системе координат.
        </p>
        
        <div style="display: flex; justify-content: center;">
            <a href="<?php echo home_url(); ?>" class="btn btn--primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="transform: rotate(180deg);"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                <span>Вернуться на главную</span>
            </a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
