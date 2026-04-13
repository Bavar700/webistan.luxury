<?php
/**
 * Template Name: Services Archive (EN)
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
                <div class="hero__badge">Full Spectrum</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Comprehensive Services</span><br>
                    <span style="color: var(--nk-blue);">for Your Business</span>
                </h1>
                <p class="hero__desc">
                    Professional solutions in auditing, accounting, legal support, and business consulting in Tajikistan.
                </p>
            </div>
        </div>
    </section>

    <!-- ═══════════ SERVICES GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 80px;">
                <div class="section__label">Expert Directions</div>
                <h2 class="section__title">Our Value Proposition</h2>
                <p class="section__subtitle">We provide a high-level service ecosystem to ensure your business stability and growth.</p>
            </div>

            <div class="services-grid">
                <!-- 1. Audit -->
                <div class="service-card fade-up">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <h3 class="service-card__title">Professional Audit</h3>
                    <p class="service-card__text">You get an objective assessment of your financial state, identifying risks and increasing the attractiveness for investors.</p>
                    <a href="<?php echo home_url('/service-audit'); ?>" class="service-card__link">Read More →</a>
                </div>

                <!-- 2. Restoration -->
                <div class="service-card service-card--alt fade-up fade-up-delay-1">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 4v6h-6"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                    </div>
                    <h3 class="service-card__title">Accounting Restoration</h3>
                    <p class="service-card__text">We restore order to your accounting records for any period, eliminating errors and risks of fines from authorities.</p>
                    <a href="<?php echo home_url('/service-restore'); ?>" class="service-card__link">Read More →</a>
                </div>

                <!-- 3. Legal -->
                <div class="service-card fade-up fade-up-delay-2">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="service-card__title">Legal Consultations</h3>
                    <p class="service-card__text">Ensure legal security for your company and reliable protection of interests in all contracts and disputes.</p>
                    <a href="<?php echo home_url('/service-legal'); ?>" class="service-card__link">Read More →</a>
                </div>

                <!-- 4. Accounting -->
                <div class="service-card service-card--alt fade-up">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="service-card__title">Accounting & HR</h3>
                    <p class="service-card__text">We handle the routine of bookkeeping and payroll, guaranteeing an absence of fines and stable staff operations.</p>
                    <a href="<?php echo home_url('/service-accounting'); ?>" class="service-card__link">Read More →</a>
                </div>

                <!-- 5. Secretariat -->
                <div class="service-card fade-up fade-up-delay-1">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <h3 class="service-card__title">Secretariat Services</h3>
                    <p class="service-card__text">Delegate document administration and calls to professionals, freeing your time for strategic tasks.</p>
                    <a href="<?php echo home_url('/service-secretariat'); ?>" class="service-card__link">Read More →</a>
                </div>

                <!-- 6. Consulting -->
                <div class="service-card service-card--alt fade-up fade-up-delay-2">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                    </div>
                    <h3 class="service-card__title">Business Consulting</h3>
                    <p class="service-card__text">Get expert support in finding new growth points and developing an effective model for your enterprise.</p>
                    <a href="<?php echo home_url('/service-consulting'); ?>" class="service-card__link">Read More →</a>
                </div>

                <!-- 7. Tax -->
                <div class="service-card fade-up">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h3 class="service-card__title">Tax Consultations</h3>
                    <p class="service-card__text">We help you legally optimize the tax burden and minimize risks before regulatory body visits.</p>
                    <a href="<?php echo home_url('/service-tax'); ?>" class="service-card__link">Read More →</a>
                </div>

                <!-- 8. Management -->
                <div class="service-card service-card--alt fade-up fade-up-delay-1">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/></svg>
                    </div>
                    <h3 class="service-card__title">Management Accounting</h3>
                    <p class="service-card__text">Get full financial transparency and accurate data for decision-making that actually increases your profit.</p>
                    <a href="<?php echo home_url('/service-management'); ?>" class="service-card__link">Read More →</a>
                </div>

                <!-- 9. Automation -->
                <div class="service-card fade-up fade-up-delay-2">
                    <div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    </div>
                    <h3 class="service-card__title">Business Automation</h3>
                    <p class="service-card__text">Free your team from routine and eliminate errors by moving management to a fast and accurate digital environment.</p>
                    <a href="<?php echo home_url('/service-automation'); ?>" class="service-card__link">Read More →</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
