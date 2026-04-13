<?php
/**
 * Template Name: Service: Business Consulting (EN)
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
                <div class="hero__badge">Consulting Department</div>
                <h1 class="hero__title">
                    Professional<br>
                    <span class="text-gradient">Business & Strategy</span><br>
                    <span style="color: var(--nk-blue);">Consulting</span>
                </h1>
                <p class="hero__desc">
                    Comprehensive audit of business processes and development of growth strategies to increase operational efficiency and net profit.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Start Diagnostic</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Strategic Partnership</div>
                <h2 class="section__title">Unlocking Your Business Potential</h2>
                <p class="section__subtitle">We help transform stagnation into growth through deep analysis and actionable intelligence.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1: When is consulting needed? -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h3 class="service-card__title">When is <br>Consulting Needed?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Business is "stuck" and growth paths are unclear</li>
                            <li>Internal processes have become chaotic</li>
                            <li>Planned launch of a new business direction</li>
                            <li>Requirement for order in financial planning</li>
                            <li>Facing major corporate reorganization</li>
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
                            <li>Developing a management strategy system</li>
                            <li>Deep audit and process optimization</li>
                            <li>Financial planning and budgeting</li>
                            <li>Consultations on asset restructuring</li>
                            <li>Developing KPIs and motivation systems</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3: How we work -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    </div>
                    <h3 class="service-card__title">How We <br>Work?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Diagnostics and current performance analysis</li>
                            <li>Identifying "bottlenecks" and profit leaks</li>
                            <li>Creating a step-by-step change plan</li>
                            <li>Implementing new management tools</li>
                            <li>Support during the implementation phase</li>
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
                            <li>Clear development vector for 3-5 years</li>
                            <li>Optimized company structure</li>
                            <li>Increased operational efficiency</li>
                            <li>Growth in net profit and turnover</li>
                            <li>Staff where everyone is in the right place</li>
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
                <div class="section__label">Business Diagnostic</div>
                <h2 class="section__title">Free Expert Consultation</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Leave a request for a preliminary audit of your business processes. We will contact you within 30 minutes.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="bc-name">
                            <label for="bc-name">Your Name</label>
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
                    <button type="submit" class="cta-crystal__btn"><span>Start Diagnostic</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
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
