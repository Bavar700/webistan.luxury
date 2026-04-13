<?php
/**
 * Template Name: Ахбор
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
                <div class="hero__badge">Маркази матбуот</div>
                <h1 class="hero__title">
                    Муҳимтарин<br>
                    ахбор ва рӯйдодҳо<br>
                    <span class="text-gradient">дар Neksoz</span>
                </h1>
                <p class="hero__desc">
                    Тағйироти ҷорӣ дар қонунгузорӣ, рӯйдодҳои ширкат ва назари коршиносон.
                </p>
            </div>
        </div>
    </section>

    <!-- ═══════════ NEWS LIST — EDITORIAL DESIGN ═══════════ -->
    <div class="section section--gray" style="padding: 120px 0;">
        <div class="container">
            <!-- Section Header -->
            <div class="section__header" style="margin-bottom: 60px;">
                <div class="section__label">Бойгонии нашрияҳо</div>
                <h2 class="section__title">Хроникаи пешрафт ва назари коршиносон</h2>
            </div>

            <div class="news-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 50px;">
                
                <!-- Item 1: Law/Audit -->
                <article class="service-card fade-up is-visible" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: 30px; right: 30px; opacity: 0.1; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="news-meta" style="color: var(--nk-red); font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        03 Апрели соли 2024 • Аудити ҳуқуқӣ
                    </div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 20px; font-weight: 800; line-height: 1.3;">Тағйирот дар ҳисобкунии андоз аз амвол ва замин</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Мутобиқи м. 175 ва 402 Кодекси андоз, андозҳо бевосита ба арзиши кадастрӣ вобастаанд. Мо баррасӣ мекунем, ки чӣ тавр баҳодиҳии нодурустро рад намуда, сарбориро коҳиш додан мумкин аст...
                    </p>
                    <div style="margin-top: auto;">
                        <a href="#" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Пурра хондан</a>
                    </div>
                </article>

                <!-- Item 2: Business/Liquidation -->
                <article class="service-card service-card--alt fade-up is-visible fade-up-delay-1" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: 30px; right: 30px; opacity: 0.2; color: var(--nk-white);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    </div>
                    <div class="news-meta" style="color: var(--nk-white); opacity: 0.8; font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        28 Марти соли 2024 • Таҳлили парвандаҳо
                    </div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 20px; font-weight: 800; line-height: 1.3;">Тартиби муфлисшавӣ ва барҳамдиҳии корхонаҳо</h3>
                    <p style="color: rgba(255,255,255,0.7); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Дастаи Neksoz коршиносони соҳаи ҳуқуқро муттаҳид месозад. Таҷрибаи мо нишон медиҳад, ки омодасозии дурусти ҳуҷҷатҳо дар оғози барҳамдиҳӣ моҳҳои зиёди корро сарфа мекунад...
                    </p>
                    <div style="margin-top: auto;">
                        <a href="#" class="btn btn--outline-light btn--small" style="padding: 12px 24px; font-size: 12px;">Пурра хондан</a>
                    </div>
                </article>

                <!-- Item 3: Forum/Globe -->
                <article class="service-card fade-up is-visible fade-up-delay-2" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: 30px; right: 30px; opacity: 0.1; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <div class="news-meta" style="color: var(--nk-red); font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        15 Марти соли 2024 • Чорабиниҳо
                    </div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 20px; font-weight: 800; line-height: 1.3;">Натиҷаҳои форуми иқтисодӣ дар Душанбе</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Мо самтҳои нави рушди фазои сармоягузориро баррасӣ мекунем. Фаъолияти мо дар соҳаи зеҳнӣ ҳамоҳангсозии доимиро бо бозор талаб мекунад...
                    </p>
                    <div style="margin-top: auto;">
                        <a href="#" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Пурра хондан</a>
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

