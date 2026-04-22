<?php
/**
 * Template Name: Новости (RU)
 */
get_header();

// Helper function to get link by post title (Russian Only)
function nk_get_link_by_title_ru($title) {
    $post = get_page_by_title($title, OBJECT, 'post');
    if ($post) {
        return add_query_arg('lang', 'ru', get_permalink($post->ID));
    }
    return '#'; 
}
?>

<main class="site-main">
    
    <svg width="0" height="0" style="position: absolute;">
        <defs>
            <linearGradient id="brandGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#E30613" />
                <stop offset="100%" stop-color="#0044CC" />
            </linearGradient>
        </defs>
    </svg>

    <section class="hero hero--internal">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container" style="position:relative;z-index:2;">
            <div class="hero__content" style="max-width: 1200px;">
                <div class="hero__badge">Пресс-центр</div>
                <h1 class="hero__title" style="max-width: none; line-height: 1.1; white-space: nowrap;">
                    Новости и события компании
                </h1>
                <p class="hero__desc" style="max-width: 700px;">
                    Свежие изменения в законодательстве, корпоративные новости и экспертные статьи.
                </p>
            </div>
        </div>
    </section>

    <div class="section section--gray" style="padding: 120px 0;">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Архив публикаций</div>
                <h2 class="section__title">Лента событий<br>и аналитические материалы</h2>
            </div>

            <div class="news-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 50px;">
                
                <article class="service-card fade-up is-visible" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div class="news-card__icon" style="position: absolute; top: 30px; right: 30px; opacity: 0.15; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="news-meta" style="color: #000000; font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        03 апреля 2024 • Юридический аудит
                    </div>
                    <h3 class="news-card__title" style="font-size: 1.5rem; margin-top: 35px; margin-bottom: 20px; font-weight: 800; line-height: 1.3; font-family: var(--font-display); color: var(--nk-gray-900);">Изменения в расчете налога на имущество и землю</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Согласно ст. 175 и 402 Налогового кодекса, налоги напрямую зависят от кадастровой стоимости...
                    </p>
                    <div style="margin-top: auto; display: flex; justify-content: flex-end;">
                        <a href="<?php echo nk_get_link_by_title_ru('Изменения в расчете налога на имущество и землю'); ?>" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Читать полностью</a>
                    </div>
                </article>

                <article class="service-card fade-up is-visible fade-up-delay-1" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div class="news-card__icon" style="position: absolute; top: 30px; right: 30px; opacity: 0.15; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    </div>
                    <div class="news-meta" style="color: #000000; font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        28 марта 2024 • Разбор кейсов
                    </div>
                    <h3 class="news-card__title" style="font-size: 1.5rem; margin-top: 35px; margin-bottom: 20px; font-weight: 800; line-height: 1.3; font-family: var(--font-display); color: var(--nk-gray-900);">Процедуры банкротства и ликвидации предприятий</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Команда NEKSOZ объединяет экспертов в области права...
                    </p>
                    <div style="margin-top: auto; display: flex; justify-content: flex-end;">
                        <a href="<?php echo nk_get_link_by_title_ru('Процедуры банкротства и ликвидации предприятий'); ?>" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Читать полностью</a>
                    </div>
                </article>

                <article class="service-card fade-up is-visible fade-up-delay-2" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div class="news-card__icon" style="position: absolute; top: 30px; right: 30px; opacity: 0.15; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <div class="news-meta" style="color: #000000; font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        15 марта 2024 • Мероприятия
                    </div>
                    <h3 class="news-card__title" style="font-size: 1.5rem; margin-top: 35px; margin-bottom: 20px; font-weight: 800; line-height: 1.3; font-family: var(--font-display); color: var(--nk-gray-900);">Итоги экономического форума в Душанбе</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Обсуждаем новые векторы развития инвестиционного климата...
                    </p>
                    <div style="margin-top: auto; display: flex; justify-content: flex-end;">
                        <a href="<?php echo nk_get_link_by_title_ru('Итоги экономического форума в Душанбе'); ?>" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Читать полностью</a>
                    </div>
                </article>

            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
