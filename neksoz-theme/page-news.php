<?php
/**
 * Template Name: Новости
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
                <div class="hero__badge">Пресс-центр</div>
                <h1 class="hero__title">
                    Главные<br>
                    новости и события<br>
                    <span class="text-gradient">в Neksoz</span>
                </h1>
                <p class="hero__desc">
                    Актуальные изменения в законодательстве, события компании и экспертные мнения.
                </p>
            </div>
        </div>
    </section>

    <!-- ═══════════ NEWS LIST — EDITORIAL DESIGN ═══════════ -->
    <div class="section section--gray" style="padding: 120px 0;">
        <div class="container">
            <!-- Section Header -->
            <div class="section__header" style="margin-bottom: 60px;">
                <div class="section__label">Архив публикаций</div>
                <h2 class="section__title">Хроника прогресса и мнения экспертов</h2>
            </div>

            <div class="news-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 50px;">
                
                <!-- Item 1: Law/Audit -->
                <article class="service-card fade-up is-visible" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: 30px; right: 30px; opacity: 0.1; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="news-meta" style="color: var(--nk-red); font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        03 Апреля, 2024 • Правовой аудит
                    </div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 20px; font-weight: 800; line-height: 1.3;">Изменения в расчете налога на имущество и землю</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Согласно ст. 175 и ст. 402 Налогового Кодекса, налоги напрямую зависят от кадастровой стоимости. Разбираем, как оспорить неверную оценку и снизить нагрузку...
                    </p>
                    <div style="margin-top: auto;">
                        <a href="#" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Читать полностью</a>
                    </div>
                </article>

                <!-- Item 2: Business/Liquidation -->
                <article class="service-card service-card--alt fade-up is-visible fade-up-delay-1" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: 30px; right: 30px; opacity: 0.2; color: var(--nk-white);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    </div>
                    <div class="news-meta" style="color: var(--nk-white); opacity: 0.8; font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        28 Марта, 2024 • Кейсинг
                    </div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 20px; font-weight: 800; line-height: 1.3;">Процедуры банкротства и ликвидации предприятий</h3>
                    <p style="color: rgba(255,255,255,0.7); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Коллектив Neksoz объединяет экспертов в области права. Наш опыт показывает, что грамотная подготовка документов на старте ликвидации экономит месяцы работы...
                    </p>
                    <div style="margin-top: auto;">
                        <a href="#" class="btn btn--outline-light btn--small" style="padding: 12px 24px; font-size: 12px;">Читать полностью</a>
                    </div>
                </article>

                <!-- Item 3: Forum/Globe -->
                <article class="service-card fade-up is-visible fade-up-delay-2" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: 30px; right: 30px; opacity: 0.1; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <div class="news-meta" style="color: var(--nk-red); font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        15 Марта, 2024 • Мероприятия
                    </div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 20px; font-weight: 800; line-height: 1.3;">Итоги экономического форума в Душанбе</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Обсуждаем новые векторы развития инвестиционного климата. Наша деятельность в интеллектуальной сфере требует постоянной синхронизации с рынком...
                    </p>
                    <div style="margin-top: auto;">
                        <a href="#" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Читать полностью</a>
                    </div>
                </article>

            </div>
        </div>
    </div>

            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
