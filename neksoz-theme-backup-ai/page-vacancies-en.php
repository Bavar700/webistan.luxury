<?php
/**
 * Template Name: Vacancies (EN)
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
                <div class="hero__badge">Join Our Team</div>
                <h1 class="hero__title">
                    Build Your<br>
                    <span class="text-gradient">Career with</span><br>
                    <span style="color: var(--nk-blue);">NEKSOZ</span>
                </h1>
                <p class="hero__desc">
                    We are looking for ambitious professionals ready to grow with us and solve complex challenges for our clients.
                </p>
            </div>
        </div>
    </section>

    <!-- ═══════════ VACANCIES SECTION ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 80px;">
                <div class="section__label">Careers</div>
                <h2 class="section__title">Open Positions</h2>
                <p class="section__subtitle">We offer competitive conditions, continuous training, and participation in the region's largest consulting projects.</p>
            </div>

            <div style="display:grid; grid-template-columns: 1fr; gap:30px; max-width: 900px; margin: 0 auto 80px;">
                
                <!-- Vacancy 1 -->
                <div class="service-card is-visible" style="padding: 40px; min-height: auto;">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 25px;">
                        <div>
                            <div style="color: var(--nk-blue); font-weight: 800; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 8px;">Audit Department</div>
                            <h3 class="service-card__title" style="font-size: 1.5rem; margin-bottom: 0;">Senior Auditor</h3>
                        </div>
                        <div style="background: rgba(0, 68, 204, 0.05); color: var(--nk-blue); padding: 6px 16px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;">Full-time</div>
                    </div>
                    <p class="service-card__text" style="margin-bottom: 25px;">Requirement: Higher education in finance/economics, knowledge of IFRS, experience in the field for 3+ years. ACCA/CPA certification is an advantage.</p>
                    <a href="mailto:info@neksoz.tj" class="btn btn--primary btn--small">Apply Now</a>
                </div>

                <!-- Vacancy 2 -->
                <div class="service-card service-card--alt is-visible" style="padding: 40px; min-height: auto;">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 25px;">
                        <div>
                            <div style="color: var(--nk-red); font-weight: 800; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 8px;">Accounting & HR</div>
                            <h3 class="service-card__title" style="font-size: 1.5rem; margin-bottom: 0;">Accountant / Financial Consultant</h3>
                        </div>
                        <div style="background: rgba(227, 6, 19, 0.05); color: var(--nk-red); padding: 6px 16px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;">Full-time</div>
                    </div>
                    <p class="service-card__text" style="margin-bottom: 25px;">Requirement: Knowledge of Tajikistan Tax Code, experience with 1C:8.3, ability to work with large volumes of data and multiple clients.</p>
                    <a href="mailto:info@neksoz.tj" class="btn btn--primary btn--small" style="background: var(--nk-red) !important; color: white !important;">Apply Now</a>
                </div>

            </div>

            <!-- Talent Pool -->
            <div style="background: var(--nk-gray-50); padding: 60px; border-radius: 32px; text-align: center; border: 1px solid var(--nk-gray-100);">
                <h3 class="section__title" style="font-size: 1.75rem; margin-bottom: 20px;">Didn't find a suitable position?</h3>
                <p class="section__subtitle" style="margin-bottom: 30px;">Send us your CV anyway at <a href="mailto:info@neksoz.tj" style="color: var(--nk-blue); font-weight: bold;">info@neksoz.tj</a>. We are always looking for talented experts to join our talent pool.</p>
                <div style="display: flex; justify-content: center; gap: 20px;">
                    <span style="font-size: 0.9rem; color: var(--nk-gray-500);">#consulting</span>
                    <span style="font-size: 0.9rem; color: var(--nk-gray-500);">#audit</span>
                    <span style="font-size: 0.9rem; color: var(--nk-gray-500);">#legal</span>
                    <span style="font-size: 0.9rem; color: var(--nk-gray-500);">#finance</span>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
