<?php
/**
 * Template Name: Service: Consulting (EN)
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
                <div class="hero__badge">Consulting</div>
                <h1 class="hero__title">
                    <span style="white-space: nowrap;">Financial and management</span><br>
                    <span class="text-gradient" style="white-space: nowrap;">business consulting</span>
                </h1>
                <p class="hero__desc">
                    Strategic planning, cash flow optimization, and implementation of effective management systems for business scaling.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Request Consulting</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Strategic Growth</div>
                <h2 class="section__title">Expertise for Your Development</h2>
                <p class="section__subtitle">We help owners step out of daily operations and balance the company's finances.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
                    </div>
                    <h3 class="service-card__title">When is consulting <br>needed?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Business is not growing or profit is falling</li>
                            <li>Cash flow gaps and lack of working capital</li>
                            <li>Chaos in processes and management accounting</li>
                            <li>Owner is too immersed in routine</li>
                            <li>Need for an independent performance assessment</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 12l-4 4-4-4"/><path d="M12 8v8"/></svg>
                    </div>
                    <h3 class="service-card__title">What does the service <br>include?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Audit of the management system and finances</li>
                            <li>Implementation of management accounting (KPI)</li>
                            <li>Building a financial business model</li>
                            <li>Optimization of expenses and taxes</li>
                            <li>Development of a strategy for 1-3 years</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <h3 class="service-card__title">How do we <br>work?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>In-depth interviews and data analysis</li>
                            <li>Identifying bottlenecks in the company's workflow</li>
                            <li>Development of an improvement plan (Roadmap)</li>
                            <li>Step-by-step implementation of changes</li>
                            <li>Monitoring results and making adjustments</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 4 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 class="service-card__title">Results for <br>Your Business</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Growth in net profit and profitability</li>
                            <li>Transparent financial picture (P&L, CashFlow)</li>
                            <li>Systematic approach to team management</li>
                            <li>Owner stepping out of the operational process</li>
                            <li>Business resilience to crises</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Lead Form Section -->
    <section id="lead-form" class="section section--gray" style="border-top: 1px solid var(--nk-gray-100); padding-top: 40px; padding-bottom: 80px;">
        <div class="container" style="max-width: 800px;">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Expert Analysis</div>
                <h2 class="section__title">Free Express Consultation</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Leave a request for a preliminary analysis of your business.<br>We will contact you within 30 minutes.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="cn-name">
                            <label for="cn-name">Your Name</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="cn-phone">
                            <label for="cn-phone">Phone (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="cn-company">
                        <label for="cn-company">Company Name (Optional)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Request a Calculation</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
                    <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        By clicking the button, you agree to the <a href="<?php echo home_url('/privacy-policy?lang=en'); ?>" style="color: var(--nk-blue); text-decoration: underline;">Privacy Policy</a>
                    </p>
                    <p class="cta-crystal__secure" style="text-align: center; margin-top: 20px; font-size: 13px; color: var(--nk-gray-500); opacity: 0.8; width: 100%;">
                        🛡️ Secure Connection (SSL 256-bit)
                    </p>
                </form>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
