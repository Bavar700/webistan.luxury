<?php
/**
 * Template Name: Service: Automation (EN)
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
                <div class="hero__badge">IT & Automation Department</div>
                <h1 class="hero__title">
                    Digital automation <span class="text-gradient">of your business</span>
                </h1>
                <p class="hero__desc">
                    Implementation of modern IT solutions (1C, CRM, AI tools) to eliminate routine and improve management accuracy.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Implement AI / CRM</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Digital Efficiency</div>
                <h2 class="section__title">Technologies Serving Your Growth</h2>
                <p class="section__subtitle">We don't just install software; we build a system<br>that works faster and more accurately than a human.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                    <h3 class="service-card__title">When is automation <br>needed?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>A lot of manual data entry into spreadsheets</li>
                            <li>Lost documents and employee tasks</li>
                            <li>Difficulty controlling remote offices</li>
                            <li>Information is transferred slowly and with errors</li>
                            <li>Need for transparent analytics in 1 click</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                    </div>
                    <h3 class="service-card__title">What does the service <br>include?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Implementation and configuration of 1C (Accounting, Enterprise Management)</li>
                            <li>Implementation of CRM and task systems (Bitrix24)</li>
                            <li>Integration of 1C with banks and portals</li>
                            <li>Organization of work in cloud services</li>
                            <li>Automation of warehouse and inventory accounting</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    </div>
                    <h3 class="service-card__title">How do we <br>work?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Process examination to accelerate workflows</li>
                            <li>Selection of software matching budget and business tasks</li>
                            <li>Software configuration and database migration</li>
                            <li>Staff training on working in new systems</li>
                            <li>Technical support and further development</li>
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
                            <li>Acceleration of employee work by 2-3 times</li>
                            <li>Unified environment showing the status of each task</li>
                            <li>Transparent control over process execution</li>
                            <li>Minimization of human error</li>
                            <li>Readiness for rapid scaling</li>
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
                <div class="section__label">Tech Audit</div>
                <h2 class="section__title">Free Express Consultation</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Leave a request for a preliminary analysis of your processes.<br>We will contact you within 30 minutes.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="au-name">
                            <label for="au-name">Your Name</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="au-phone">
                            <label for="au-phone">Phone (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="au-company">
                        <label for="au-company">Company Name (Optional)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Implement Solution</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
                    <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        By clicking the button, you agree to the <a href="<?php echo nk_link('/privacy-policy?lang=en', 'en'); ?>" style="color: var(--nk-blue); text-decoration: underline;">Privacy Policy</a>
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

