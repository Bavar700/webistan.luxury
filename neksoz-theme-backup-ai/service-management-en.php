<?php
/**
 * Template Name: Service: Management Accounting (EN)
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
                <div class="hero__badge">Management Consulting</div>
                <h1 class="hero__title">
                    Digital<br>
                    <span class="text-gradient">Management &</span><br>
                    <span style="color: var(--nk-blue);">Financial Insight</span>
                </h1>
                <p class="hero__desc">
                    Get full financial transparency and accurate data to make decisions that realistically increase your net profit.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Setup Your Accounting</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Data-Driven Growth</div>
                <h2 class="section__title">Managing by Facts, Not Intuition</h2>
                <p class="section__subtitle">We build an reporting ecosystem that shows exactly where your money is and how it grows.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1: When do you need monitoring? -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                    </div>
                    <h3 class="service-card__title">When is <br>Monitoring Needed?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Accounting reports don't give the full picture</li>
                            <li>Frequent cash gaps (no cash despite profit)</li>
                            <li>Unclear which projects are actually loss-making</li>
                            <li>Requirement for real-time cost control</li>
                            <li>Need for a robust development forecast</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2: What is included in the service -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
                    </div>
                    <h3 class="service-card__title">What's in the <br>Service?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Implementing Cash Flow, P&L, and Balance Sheet</li>
                            <li>Tailoring reports to your specific business niche</li>
                            <li>Calculating profitability of departments/services</li>
                            <li>Cash planning and payment calendar setup</li>
                            <li>"Plan vs Fact" deviation analysis</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3: How we work -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M3 20h18L12 4z"/></svg>
                    </div>
                    <h3 class="service-card__title">How We <br>Work?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Audit of financial info gathering structure</li>
                            <li>Designing the target reporting system</li>
                            <li>Data collection automation (1C, Excel, CRM)</li>
                            <li>Training managers to interpret reports</li>
                            <li>Regular maintenance and updates</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 4: Result for business -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 class="service-card__title">Result for <br>Your Business</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Monthly "health" snapshot in numbers</li>
                            <li>Tool for accurate profit forecasting</li>
                            <li>Fact-based management (zero guesswork)</li>
                            <li>Permanent elimination of cash gaps</li>
                            <li>Enhanced investment attractiveness</li>
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
                <div class="section__label">Financial Diagnostic</div>
                <h2 class="section__title">Free Express Assessment</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Leave a request for a preliminary analysis of your accounting system. We will contact you within 30 minutes.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="sm-name">
                            <label for="sm-name">Your Name</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="ac-phone">
                            <label for="ac-phone">Phone (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="ac-company">
                        <label for="ac-company">Company Name (optional)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Set Up My Accounting</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
                    <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        By clicking, you agree to the <a href="<?php echo home_url('/privacy-policy'); ?>" style="color: var(--nk-blue); text-decoration: underline;">Privacy Policy</a>
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
