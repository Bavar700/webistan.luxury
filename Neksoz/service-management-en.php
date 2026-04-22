<?php
/**
 * Template Name: Service: Management (EN)
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
                <div class="hero__badge">Management Department</div>
                <h1 class="hero__title">
                    <span style="white-space: nowrap;">Transparent management</span><br>
                    <span class="text-gradient" style="white-space: nowrap;">business accounting</span>
                </h1>
                <p class="hero__desc">
                    Complete financial transparency and accurate data for decision-making aimed at increasing profits.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Implement accounting</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Financial Intelligence</div>
                <h2 class="section__title">Your business in the mirror of numbers</h2>
                <p class="section__subtitle">We turn dry reports into a powerful tool for managing resources and profits.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                    </div>
                    <h3 class="service-card__title">When is monitoring <br>needed?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Accounting reports do not show the whole picture</li>
                            <li>Frequent cash gaps (no money despite profit)</li>
                            <li>It is unclear which projects are actually unprofitable</li>
                            <li>Real-time expense control is needed</li>
                            <li>A justified development forecast is required</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
                    </div>
                    <h3 class="service-card__title">What does the service <br>include?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Implementation of Cash Flow, P&L, and Balance Sheet</li>
                            <li>Customizing reports to business specifics</li>
                            <li>Calculation of profitability for directions and services</li>
                            <li>Cash planning and payment calendar</li>
                            <li>Analysis of "Plan vs. Fact" deviations</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M3 20h18L12 4z"/></svg>
                    </div>
                    <h3 class="service-card__title">How do we <br>work?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Audit of the financial data collection structure</li>
                            <li>Designing the target reporting system</li>
                            <li>Automating data collection (1C, Excel, CRM)</li>
                            <li>Training managers to read reports</li>
                            <li>Regular support and updates</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 4 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 class="service-card__title">Results for <br>your business</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Monthly "health" picture in numbers</li>
                            <li>Tool for accurate profit forecasting</li>
                            <li>Management based on facts, not intuition</li>
                            <li>Elimination of cash gaps forever</li>
                            <li>Increased investment attractiveness</li>
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
                <div class="section__label">Financial Audit</div>
                <h2 class="section__title">Free express diagnostics</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Leave a request for a preliminary analysis of your accounting system.<br>We will contact you within 30 minutes.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="sm-name">
                            <label for="sm-name">Your Name</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="sm-phone">
                            <label for="sm-phone">Phone (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="sm-company">
                        <label for="sm-company">Company Name (Optional)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Set up accounting</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
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
