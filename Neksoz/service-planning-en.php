<?php
/**
 * Template Name: Service: Planning (EN)
 */
get_header(); global $current_lang; 
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
                <h1 class="hero__title">
                    Strategic <span class="text-gradient">Business Planning</span> <span class="text-gradient">NEKSOZ</span>
                </h1>
                <p class="hero__desc">
                    Development of viable strategies and financial models for confident business launch and scaling.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Order a Plan</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Investment Foundation</div>
                <h2 class="section__title">Your Idea in Numbers and Facts</h2>
                <p class="section__subtitle">We create documents that convince the most demanding lenders and investors.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20"/><path d="m17 5-5 5-5-5"/><path d="m17 19-5-5-5 5"/></svg>
                    </div>
                    <h3 class="service-card__title">When is a business plan needed?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Attracting investments or a loan</li>
                            <li>Evaluating an idea before project launch</li>
                            <li>Obtaining benefits or state grants</li>
                            <li>Defending a strategy before shareholders</li>
                            <li>Scaling an existing business</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                    </div>
                    <h3 class="service-card__title">What is included in the service?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Market, competitor, and audience analysis</li>
                            <li>Development of a detailed financial model</li>
                            <li>Preparation of FS according to standards</li>
                            <li>Preparation of Pitch Deck for investors</li>
                            <li>Defense of the plan before financial institutions</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                    </div>
                    <h3 class="service-card__title">How do we work?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Collection and systematization of input data</li>
                            <li>Mathematical profit modeling</li>
                            <li>Writing the descriptive part according to standards</li>
                            <li>Adjusting to bank requirements</li>
                            <li>Final coordination and printing</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 4 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 class="service-card__title">Result for your business</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>A document that increases chances for capital</li>
                            <li>Clear understanding of all risks and deadlines</li>
                            <li>Ready-made action plan for launch</li>
                            <li>Professional financial model</li>
                            <li>Justification of payback for partners</li>
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
                <div class="section__label">Invest Audit</div>
                <h2 class="section__title">Free Express Consultation</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Leave a request for a preliminary assessment of your project. We will contact you within 30 minutes.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="pl-name">
                            <label for="pl-name">Your Name</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="pl-phone">
                            <label for="pl-phone">Phone (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="pl-company">
                        <label for="pl-company">Company Name (Optional)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Get Plan</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
                    <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        By clicking the button, you agree to the <a href="<?php echo nk_link('/privacy-policy', 'en'); ?>" style="color: var(--nk-blue); text-decoration: underline;">Privacy Policy</a>
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

