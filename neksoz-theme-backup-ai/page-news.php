<?php
if (function_exists('nk_get_current_lang')) {
    $lang = nk_get_current_lang();
    if ($lang === 'tj') { get_template_part('page-news', 'tj'); return; }
    if ($lang === 'en') { get_template_part('page-news', 'en'); return; }
}

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
                    <span class="text-gradient">новости и события</span><br>
                    <span style="color: var(--nk-blue);">neksoz</span>
                </h1>
                <p class="hero__desc">
                    Актуальные изменения в законодательстве, события компании и экспертные мнения.
                </p>
            </div>
        </div>
    </section>

    <div class="container" style="padding: 100px 0;">
        <div class="news-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 40px;">
            
            <!-- News Item 1 -->
            <article class="simple-card" style="display: flex; flex-direction: column; height: 100%;">
                <div class="news-meta" style="color: var(--nk-red); font-size: 0.8rem; font-weight: bold; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;">
                    03 Апреля, 2024 • Правовой аудит
                </div>
                <h3 style="margin-bottom: 20px;">Изменения в расчете налога на имущество и землю</h3>
                <p style="color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6; flex-grow: 1;">
                    Согласно ст. 175 и ст. 402 Налогового Кодекса, налоги напрямую зависят от кадастровой стоимости. Разбираем, как оспорить неверную оценку и снизить нагрузку...
                </p>
                <div style="margin-top: 25px;">
                    <a href="#" class="btn btn--ghost btn--small">Читать полностью</a>
                </div>
            </article>

            <!-- News Item 2 -->
            <article class="simple-card" style="display: flex; flex-direction: column; height: 100%;">
                <div class="news-meta" style="color: var(--nk-red); font-size: 0.8rem; font-weight: bold; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;">
                    28 Марта, 2024 • Кейсинг
                </div>
                <h3 style="margin-bottom: 20px;">Процедуры банкротства и ликвидации предприятий</h3>
                <p style="color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6; flex-grow: 1;">
                    Коллектив Neksoz объединяет экспертов в области права. Наш опыт показывает, что грамотная подготовка документов на старте ликвидации экономит месяцы работы...
                </p>
                <div style="margin-top: 25px;">
                    <a href="#" class="btn btn--ghost btn--small">Читать полностью</a>
                </div>
            </article>

            <!-- News Item 3 -->
            <article class="simple-card" style="display: flex; flex-direction: column; height: 100%;">
                <div class="news-meta" style="color: var(--nk-red); font-size: 0.8rem; font-weight: bold; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;">
                    15 Марта, 2024 • Мероприятия
                </div>
                <h3 style="margin-bottom: 20px;">Итоги экономического форума в Душанбе</h3>
                <p style="color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6; flex-grow: 1;">
                    Обсуждаем новые векторы развития инвестиционного климата. Наша деятельность в интеллектуальной сфере требует постоянной синхронизации с рынком...
                </p>
                <div style="margin-top: 25px;">
                    <a href="#" class="btn btn--ghost btn--small">Читать полностью</a>
                </div>
            </article>

        </div>
    </div>

</main>

<?php
if (function_exists('nk_get_current_lang')) {
    $lang = nk_get_current_lang();
    if ($lang === 'tj') { get_template_part('page-news', 'tj'); return; }
    if ($lang === 'en') { get_template_part('page-news', 'en'); return; }
}
 get_footer(); ?>
