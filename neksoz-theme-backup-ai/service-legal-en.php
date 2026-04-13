<?php
/**
 * Template Name: Service: Legal Consulting (EN)
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
                <div class="hero__badge">Legal Department</div>
                <h1 class="hero__title">
                    Registration &<br>
                    <span class="text-gradient">Legal Support for</span><br>
                    <span style="color: var(--nk-blue);">Your Business</span>
                </h1>
                <p class="hero__desc">
                    Comprehensive legal support, from initial company registration to resolving the most complex legal challenges facing your business.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#contacts" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Consult an Expert</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ CONTENT BLOCK ═══════════ -->
    <section class="section">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 340px; gap: 80px; align-items: start;">

                <!-- Main Content -->
                <article class="page-content fade-up is-visible">
                    <h2 class="section__title" style="text-align: left; margin-bottom: 30px;">Legal Consultations & Transactions</h2>
                    <p class="section__subtitle" style="text-align: left; margin-bottom: 60px;">We provide full legal coverage for your operations, ensuring compliance and risk mitigation in the Tajikistan market.</p>

                    <div style="display: grid; gap: 30px;">
                        <!-- Registration -->
                        <div class="service-card service-card--alt" style="padding: 40px; min-height: auto;">
                            <h3 class="service-card__title" style="font-size: 1.5rem; margin-bottom: 15px; display: flex; align-items: center; gap: 15px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(0, 68, 204, 0.1); color: var(--nk-blue); border-radius: 50%; font-size: 1rem;">1</span>
                                Registration & Re-registration
                            </h3>
                            <p class="service-card__text" style="color: var(--nk-gray-600);">Full support for registering or re-registering companies with competent authorities, ensuring all constituent documents perfectly align with legislative requirements.</p>
                        </div>

                        <!-- Real Estate -->
                        <div class="service-card" style="padding: 40px; min-height: auto;">
                            <h3 class="service-card__title" style="font-size: 1.5rem; margin-bottom: 15px; display: flex; align-items: center; gap: 15px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(227, 6, 19, 0.1); color: var(--nk-red); border-radius: 50%; font-size: 1rem;">2</span>
                                Real Estate Transactions
                            </h3>
                            <p class="service-card__text" style="color: var(--nk-gray-600);">End-to-end legal support for real estate deals: title searches, due diligence, contract drafting, and right of ownership registration.</p>
                        </div>

                        <!-- Courts -->
                        <div class="service-card service-card--alt" style="padding: 40px; min-height: auto;">
                            <h3 class="service-card__title" style="font-size: 1.5rem; margin-bottom: 15px; display: flex; align-items: center; gap: 15px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(0, 68, 204, 0.1); color: var(--nk-blue); border-radius: 50%; font-size: 1rem;">3</span>
                                Judicial Representation
                            </h3>
                            <p class="service-card__text" style="color: var(--nk-gray-600);">Professional representation of your interests in all judicial authorities, protecting your company's rights in various legal disputes.</p>
                        </div>
                    </div>
                </article>

                <!-- Sidebar -->
                <aside class="fade-up is-visible fade-up-delay-1" style="position: sticky; top: 120px;">
                    <div style="background: var(--nk-white); padding: 40px; border-radius: 24px; box-shadow: 0 30px 60px rgba(0, 13, 51, 0.05); border: 1px solid var(--nk-gray-100);">
                        <h4 class="service-card__title" style="font-size: 1.1rem; margin-bottom: 25px;">Our Disciplines</h4>
                        <ul style="list-style: none; padding: 0; margin: 0; display: grid; gap: 15px;">
                            <li><a href="<?php echo home_url('/service-audit'); ?>" class="footer__link">Financial Audit</a></li>
                            <li><a href="<?php echo home_url('/service-accounting'); ?>" class="footer__link">Accounting & HR</a></li>
                            <li><a href="<?php echo home_url('/service-tax'); ?>" class="footer__link">Tax Consulting</a></li>
                            <li><a href="<?php echo home_url('/service-automation'); ?>" class="footer__link">IT Automation</a></li>
                        </ul>
                        <div style="margin-top: 40px; padding-top: 30px; border-top: 1px solid var(--nk-gray-50);">
                            <a href="<?php echo home_url('/services'); ?>" class="btn btn--primary" style="width: 100%; justify-content: center;">All Services</a>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
