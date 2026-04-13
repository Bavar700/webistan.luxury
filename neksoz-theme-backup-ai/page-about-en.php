<?php
/**
 * Template Name: About (EN)
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
                <div class="hero__badge">Success Story</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Professional Expertise</span><br>
                    <span style="color: var(--nk-blue);">Since 2016</span>
                </h1>
                <p class="hero__desc">
                    LLC "NEKSOZ-BUSINESS CONSULTING GROUP" — a leader in the consulting market of Tajikistan, ensuring your business's financial and legal security.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/services'); ?>" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>View Our Services</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ SECTION: HISTORY ═══════════ -->
    <section class="section" style="padding-top: 80px; padding-bottom: 80px;">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Founded in 2016</div>
                <h2 class="section__title">Our Foundation: Experience<br>Proven by Time</h2>
                <p class="section__subtitle">Over <?php echo (date('Y') - 2016); ?> years of operation in the Tajikistan market, we have evolved from an ambitious team into a recognized leader in accounting consulting.</p>
            </div>

            <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:30px;">

                <!-- Card 1: History -->
                <div class="about-card fade-up">
                    <div class="about-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h3 class="about-card__title">Company Founded in 2016</h3>
                    <p class="about-card__body">LLC "NEKSOZ-BUSINESS CONSULTING GROUP" was established in <strong>2016</strong> by experts with significant prior experience in taxation, financial accounting, banking, and audit.</p>
                    <p class="about-card__body" style="margin-top:-4px;">We don't just "keep books" — we build transparent and sustainable business models that allow our clients to scale with confidence.</p>
                </div>

                <!-- Card 2: Specialization -->
                <div class="about-card fade-up fade-up-delay-1">
                    <div class="about-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <h3 class="about-card__title">Specialization: Scale Without Borders</h3>
                    <ul class="about-card__list">
                        <li><strong>Local Expertise:</strong> Deep knowledge of the Tax Code and legislation of the Republic of Tajikistan.</li>
                        <li><strong>International Standards:</strong> Accounting according to IFRS for international companies.</li>
                        <li><strong>Any Complexity:</strong> Working with enterprises of all legal forms.</li>
                        <li>From startup registration to audit of transnational corporations.</li>
                    </ul>
                    <div class="about-tags">
                        <span class="about-tag">Retail</span>
                        <span class="about-tag">Manufacturing</span>
                        <span class="about-tag">IT & Fintech</span>
                        <span class="about-tag">NGOs & Foundations</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════ SECTION: MISSION & PRINCIPLES ═══════════ -->
    <section class="section section--gray" style="padding-top: 80px; padding-bottom: 80px; border-top: 1px solid rgba(0,0,0,0.04);">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">The NEKSOZ Code</div>
                <h2 class="section__title">Mission & Principles</h2>
                <p class="section__subtitle">"Our mission is to transform complex business processes into a transparent and profitable system. We work for your result and ensure top-level protection of your interests."</p>
            </div>

            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:30px;">

                <!-- Principle 01 -->
                <div class="about-card fade-up">
                    <div class="about-card__num">01</div>
                    <div class="about-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="about-card__title">Trust Through Results</h3>
                    <p class="about-card__body">We don't ask for trust — we earn it with the quality of every submitted tax return and the clarity of every audit opinion.</p>
                </div>

                <!-- Principle 02 -->
                <div class="about-card fade-up fade-up-delay-1">
                    <div class="about-card__num">02</div>
                    <div class="about-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    </div>
                    <h3 class="about-card__title">Solutions, Not Reports</h3>
                    <p class="about-card__body">We don't just state facts — we analyze risks and propose effective exit scenarios for complex financial and legal situations.</p>
                </div>

                <!-- Principle 03 -->
                <div class="about-card fade-up fade-up-delay-2">
                    <div class="about-card__num">03</div>
                    <div class="about-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h3 class="about-card__title">Culture of Deadlines</h3>
                    <p class="about-card__body">In the world of finance, time is money. We guarantee strict adherence to deadlines, taking full responsibility for the result.</p>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
