<?php
/**
 * Template Name: News (EN)
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
                <div class="hero__badge">Press Center</div>
                <h1 class="hero__title">
                    Main<br>
                    <span class="text-gradient">News & Events</span><br>
                    <span style="color: var(--nk-blue);">NEKSOZ</span>
                </h1>
                <p class="hero__desc">
                    Latest changes in legislation, company events, and expert opinions.
                </p>
            </div>
        </div>
    </section>

    <div class="container" style="padding: 100px 0;">
        <div class="news-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 40px;">
            
            <!-- News Item 1 -->
            <article class="simple-card" style="display: flex; flex-direction: column; height: 100%;">
                <div class="news-meta" style="color: var(--nk-red); font-size: 0.8rem; font-weight: bold; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;">
                    April 03, 2024 • Legal Audit
                </div>
                <h3 style="margin-bottom: 20px;">Changes in Property and Land Tax Calculations</h3>
                <p style="color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6; flex-grow: 1;">
                    According to Art. 175 and Art. 402 of the Tax Code, taxes directly depend on cadastral value. We analyze how to contest an incorrect assessment and reduce the burden...
                </p>
                <div style="margin-top: 25px;">
                    <a href="#" class="btn btn--ghost btn--small">Read More</a>
                </div>
            </article>

            <!-- News Item 2 -->
            <article class="simple-card" style="display: flex; flex-direction: column; height: 100%;">
                <div class="news-meta" style="color: var(--nk-red); font-size: 0.8rem; font-weight: bold; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;">
                    March 28, 2024 • Case Study
                </div>
                <h3 style="margin-bottom: 20px;">Bankruptcy and Enterprise Liquidation Procedures</h3>
                <p style="color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6; flex-grow: 1;">
                    The NEKSOZ team brings together legal experts. Our experience shows that competent document preparation at the start of liquidation saves months of work...
                </p>
                <div style="margin-top: 25px;">
                    <a href="#" class="btn btn--ghost btn--small">Read More</a>
                </div>
            </article>

            <!-- News Item 3 -->
            <article class="simple-card" style="display: flex; flex-direction: column; height: 100%;">
                <div class="news-meta" style="color: var(--nk-red); font-size: 0.8rem; font-weight: bold; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;">
                    March 15, 2024 • Events
                </div>
                <h3 style="margin-bottom: 20px;">Outcomes of the Economic Forum in Dushanbe</h3>
                <p style="color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6; flex-grow: 1;">
                    Discussing new development vectors for the investment climate. Our activity in the intellectual sphere requires constant synchronization with the market...
                </p>
                <div style="margin-top: 25px;">
                    <a href="#" class="btn btn--ghost btn--small">Read More</a>
                </div>
            </article>

        </div>
    </div>

</main>

<?php get_footer(); ?>
