<?php
/**
 * Template Name: Ахбор (TJ)
 */
get_header();

// Helper function to get link by post title (Tajik Only)
function nk_get_link_by_title_tj($title) {
    $post = get_page_by_title($title, OBJECT, 'post');
    if ($post) {
        return add_query_arg('lang', 'tj', get_permalink($post->ID));
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
            <div class="hero__content" style="max-width: 1000px;">
                <div class="hero__badge">Маркази матбуот</div>
                <h1 class="hero__title" style="max-width: 700px; line-height: 1.15; font-size: clamp(2.5rem, 5vw, 4rem);">
                    Хабарҳо ва<br>рӯйдодҳои асосӣ
                </h1>
                <p class="hero__desc" style="max-width: 700px;">
                    Тағйироти нави қонунгузорӣ, рӯйдодҳои ширкат<br>ва андешаҳои коршиносон.
                </p>
            </div>
        </div>
    </section>

    <div class="section section--gray" style="padding: 120px 0;">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Бойгонии нашрияҳо</div>
                <h2 class="section__title">Вақоеъномаи рушд<br>ва андешаҳои коршиносон</h2>
            </div>

            <div class="news-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 50px;">
                
                <article class="service-card fade-up is-visible" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div class="news-card__icon" style="position: absolute; top: 30px; right: 30px; opacity: 0.15; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="news-meta" style="color: #000000; font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        03 апрели 2024 • Аудити ҳуқуқӣ
                    </div>
                    <h3 class="text-gradient" style="font-size: 1.5rem; margin-top: 35px; margin-bottom: 20px; font-weight: 800; line-height: 1.3;">Тағйирот дар ҳисоби андоз аз амвол ва замин</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Тибқи моддаҳои 175 ва 402-и Кодекси андоз, андозҳо мустақиман ба арзиши кадастрӣ вобастаанд...
                    </p>
                    <div style="margin-top: auto; display: flex; justify-content: flex-end;">
                        <a href="<?php echo nk_get_link_by_title_tj('Тағйирот дар ҳисоби андоз аз амвол ва замин'); ?>" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Идомаи хониш</a>
                    </div>
                </article>

                <article class="service-card fade-up is-visible fade-up-delay-1" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div class="news-card__icon" style="position: absolute; top: 30px; right: 30px; opacity: 0.15; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    </div>
                    <div class="news-meta" style="color: #000000; font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        28 марти 2024 • Таҳлили қазияҳо
                    </div>
                    <h3 class="text-gradient" style="font-size: 1.5rem; margin-top: 35px; margin-bottom: 20px; font-weight: 800; line-height: 1.3;">Равандҳои муфлисшавӣ ва барҳамдиҳии корхонаҳо</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Ҳайати кории NEKSOZ коршиносони соҳаи ҳуқуқро муттаҳид месозад...
                    </p>
                    <div style="margin-top: auto; display: flex; justify-content: flex-end;">
                        <a href="<?php echo nk_get_link_by_title_tj('Равандҳои муфлисшавӣ ва барҳамдиҳии корхонаҳо'); ?>" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Идомаи хониш</a>
                    </div>
                </article>

                <article class="service-card fade-up is-visible fade-up-delay-2" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div class="news-card__icon" style="position: absolute; top: 30px; right: 30px; opacity: 0.15; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <div class="news-meta" style="color: #000000; font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        15 марти 2024 • Чорабиниҳо
                    </div>
                    <h3 class="text-gradient" style="font-size: 1.5rem; margin-top: 35px; margin-bottom: 20px; font-weight: 800; line-height: 1.3;">Натиҷаҳои ҳамоиши иқтисодӣ дар Душанбе</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Самтҳои нави рушди фазои сармоягузориро баррасӣ мекунем...
                    </p>
                    <div style="margin-top: auto; display: flex; justify-content: flex-end;">
                        <a href="<?php echo nk_get_link_by_title_tj('Натиҷаҳои ҳамоиши иқтисодӣ дар Душанбе'); ?>" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Идомаи хониш</a>
                    </div>
                </article>

            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
