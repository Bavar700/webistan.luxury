<?php
/**
 * Template Name: Service: Business Automation (EN)
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
                <div class="hero__badge">Department of IT & Automation</div>
                <h1 class="hero__title">
                    Intelligent<br>
                    <span class="text-gradient">Business Process</span><br>
                    <span style="color: var(--nk-blue);">Automation</span>
                </h1>
                <p class="hero__desc">
                    Freeing your team from routine tasks, eliminating human error, and migrating management to a fast, accurate digital environment.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Get a Consultation</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Digital Transformation</div>
                <h2 class="section__title">Speed and Precision of Digital Choice</h2>
                <p class="section__subtitle">We don't just implement software; we create a seamless ecosystem for your business growth.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1: When do you need automation? -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    </div>
                    <h3 class="service-card__title">When is <br>Automation Needed?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Manual reporting takes too much time</li>
                            <li>Frequent errors in financial data or orders</li>
                            <li>Lack of centralized control over multiple units</li>
                            <li>Difficulties with document search and storage</li>
                            <li>Requirement for transparency in staff performance</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2: What is included in the service -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    </div>
                    <h3 class="service-card__title">What's in the <br>Service?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Implementation & setup of 1C systems</li>
                            <li>CRM & Bitrix24 integration strategies</li>
                            <li>Integration with Client-Bank systems</li>
                            <li>Digitization of archives & paperless flow</li>
                            <li>Automated management reporting dashboards</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3: How we work -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                    <h3 class="service-card__title">How We <br>Work?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Full audit of existing business processes</li>
                            <li>Selection of optimal hardware & software</li>
                            <li>Development of technical specifications</li>
                            <li>System deployment and staff training</li>
                            <li>Ongoing technical support and updates</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 4: Result for business -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
                    </div>
                    <h3 class="service-card__title">Result for <br>Your Business</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Reduced operational costs & staff time</li>
                            <li>Absolute transparency of all processes</li>
                            <li>Real-time data for decision making</li>
                            <li>Zero tolerance for human calculation errors</li>
                            <li>Higher scalability of your business model</li>
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
                <div class="section__label">Automation Consultation</div>
                <h2 class="section__title">Digital Audit Request</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Leave a request for a preliminary audit of your business processes. We will contact you within 30 minutes.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="ac-name">
                            <label for="ac-name">Your Name</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="ac-phone">
                            <label for="ac-phone">Phone (+992)</label>
                        </div>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Request Audit</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
                </form>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
