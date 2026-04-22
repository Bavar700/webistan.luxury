<?php
/**
 * Template Name: News (EN)
 */
get_header();

// Helper function to get link by post title (English Only)
function nk_get_link_by_title_en($title) {
    $post = get_page_by_title($title, OBJECT, 'post');
    if ($post) {
        return add_query_arg('lang', 'en', get_permalink($post->ID));
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

    <!-- ═══════════ CINEMATIC HERO ═══════════ -->
    <section class="hero hero--internal">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container" style="position:relative;z-index:2;">
            <div class="hero__content" style="max-width: 1200px;">
                <div class="hero__badge">Press Center</div>
                <h1 class="hero__title" style="line-height: 1.1;">
                    Core News and Events
                </h1>
                <p class="hero__desc" style="max-width: 700px;">
                    Fresh legislative changes, corporate events, and expert insights.
                </p>
            </div>
        </div>
    </section>

    <!-- ═══════════ NEWS LIST — ENGLISH VERSION ═══════════ -->
    <div class="section section--gray" style="padding: 120px 0;">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Publication Archive</div>
                <h2 class="section__title">Growth Chronicle and Expert Perspectives</h2>
            </div>

            <div class="videos-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px; margin-bottom: 80px;">
                <div class="featured-video-block fade-up is-visible" style="border-radius: 32px; overflow: hidden; box-shadow: 0 40px 100px rgba(0,0,0,0.1); position: relative; background: #000;">
                    <div style="padding-bottom: 56.25%; position: relative; height: 0;">
                        <iframe 
                            src="https://www.youtube.com/embed/kO88cGrNZec" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div style="padding: 30px 40px; background: #fff; border-top: 1px solid rgba(0,0,0,0.05);">
                        <h3 class="news-card__title" style="font-size: 1.25rem; font-weight: 800; font-family: var(--font-display); color: var(--nk-gray-900); margin: 0;">Business in Tajikistan — NEKSOZ BCG</h3>
                    </div>
                </div>

                <div class="featured-video-block fade-up is-visible" style="border-radius: 32px; overflow: hidden; box-shadow: 0 40px 100px rgba(0,0,0,0.1); position: relative; background: #000;">
                    <div style="padding-bottom: 56.25%; position: relative; height: 0;">
                        <iframe 
                            src="https://www.youtube.com/embed/oRzE5kI2sLA" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div style="padding: 30px 40px; background: #fff; border-top: 1px solid rgba(0,0,0,0.05);">
                        <h3 class="news-card__title" style="font-size: 1.25rem; font-weight: 800; font-family: var(--font-display); color: var(--nk-gray-900); margin: 0;">Business in Tajikistan 2 — NEKSOZ BCG</h3>
                    </div>
                </div>
            </div>

            <div class="news-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 50px;">
                
                <article class="service-card fade-up is-visible" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div class="news-card__icon" style="position: absolute; top: 30px; right: 30px; opacity: 0.15; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div class="news-meta" style="color: #000000; font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        April 22, 2024 • Expert Insight
                    </div>
                    <h3 class="news-card__title text-gradient" style="font-size: 1.5rem; margin-top: 35px; margin-bottom: 20px; font-weight: 800; line-height: 1.3; font-family: var(--font-display);">Outsourcing Activity</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Outsourcing activity as a tool for optimizing the economic activities of enterprises in a market economy...
                    </p>
                    <div style="margin-top: auto; display: flex; justify-content: flex-end;">
                        <a href="<?php echo nk_get_link_by_title_en('OUTSOURCING ACTIVITY'); ?>" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Read full article</a>
                    </div>
                </article>

                <article class="service-card fade-up is-visible" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div class="news-card__icon" style="position: absolute; top: 30px; right: 30px; opacity: 0.15; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="news-meta" style="color: #000000; font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        April 03, 2024 • Legal Audit
                    </div>
                    <h3 class="news-card__title text-gradient" style="font-size: 1.5rem; margin-top: 35px; margin-bottom: 20px; font-weight: 800; line-height: 1.3; font-family: var(--font-display);">Changes in Property and Land Tax Calculation</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        According to Articles 175 and 402 of the Tax Code, taxes depend directly on cadastral value...
                    </p>
                    <div style="margin-top: auto; display: flex; justify-content: flex-end;">
                        <a href="<?php echo nk_get_link_by_title_en('Changes in Property and Land Tax Calculation'); ?>" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Read more</a>
                    </div>
                </article>

                <article class="service-card fade-up is-visible fade-up-delay-1" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div class="news-card__icon" style="position: absolute; top: 30px; right: 30px; opacity: 0.15; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    </div>
                    <div class="news-meta" style="color: #000000; font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        March 28, 2024 • Case Analysis
                    </div>
                    <h3 class="news-card__title text-gradient" style="font-size: 1.5rem; margin-top: 35px; margin-bottom: 20px; font-weight: 800; line-height: 1.3; font-family: var(--font-display);">Bankruptcy and Corporate Liquidation Procedures</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        The NEKSOZ team brings together legal experts. Our experience shows that professional document preparation...
                    </p>
                    <div style="margin-top: auto; display: flex; justify-content: flex-end;">
                        <a href="<?php echo nk_get_link_by_title_en('Bankruptcy and Corporate Liquidation Procedures'); ?>" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Read more</a>
                    </div>
                </article>

                <article class="service-card fade-up is-visible fade-up-delay-2" style="padding: 40px; display: flex; flex-direction: column; height: 100%; border-radius: 24px; position: relative; overflow: hidden;">
                    <div class="news-card__icon" style="position: absolute; top: 30px; right: 30px; opacity: 0.15; color: var(--nk-blue);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <div class="news-meta" style="color: #000000; font-size: 11px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; font-family: var(--font-display);">
                        March 15, 2024 • Events
                    </div>
                    <h3 class="news-card__title text-gradient" style="font-size: 1.5rem; margin-top: 35px; margin-bottom: 20px; font-weight: 800; line-height: 1.3; font-family: var(--font-display);">Outcomes of the Economic Forum in Dushanbe</h3>
                    <p style="color: var(--nk-gray-600); font-size: 1rem; line-height: 1.7; flex-grow: 1; margin-bottom: 30px;">
                        Discussing new vectors of investment climate development. Our intellectual property activities...
                    </p>
                    <div style="margin-top: auto; display: flex; justify-content: flex-end;">
                        <a href="<?php echo nk_get_link_by_title_en('Outcomes of the Economic Forum in Dushanbe'); ?>" class="btn btn--primary btn--small" style="padding: 12px 24px; font-size: 12px;">Read more</a>
                    </div>
                </article>

            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
