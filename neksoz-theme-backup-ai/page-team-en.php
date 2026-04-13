<?php
/**
 * Template Name: Team (EN)
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
                <div class="hero__badge">Our Assets</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Professional Team</span><br>
                    <span style="color: var(--nk-blue);">of Experts</span>
                </h1>
                <p class="hero__desc">
                    We take pride in our specialists, whose experience and knowledge formed the foundation of NEKSOZ's success and reliability.
                </p>
            </div>
        </div>
    </section>

    <!-- ═══════════ TEAM GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 80px;">
                <div class="section__label">Expertise & Experience</div>
                <h2 class="section__title">Leaders of Our Directions</h2>
                <p class="section__subtitle">Meet the team that ensures the high standards of our consulting services.</p>
            </div>

            <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:60px;">
                
                <!-- CEO -->
                <div class="team-card fade-up">
                    <div style="display:grid; grid-template-columns: 240px 1fr; gap:40px; align-items: start;">
                        <div style="position:relative;">
                            <div style="background: var(--nk-gray-50); border-radius: 20px; aspect-ratio: 4/5; overflow: hidden; border: 1px solid var(--nk-gray-100);">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ceo.jpg" alt="Zoir Salimov" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        <div>
                            <div style="color: var(--nk-blue); font-weight: 800; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 12px;">Management</div>
                            <h3 class="service-card__title" style="font-size: 1.75rem; margin-bottom: 8px;">Zoir Salimov</h3>
                            <div style="color: var(--nk-gray-500); font-weight: 600; font-size: 0.95rem; margin-bottom: 25px;">General Director, NEKSOZ</div>
                            <p class="service-card__text" style="font-size: 0.95rem; line-height: 1.7; color: var(--nk-gray-600); margin-bottom: 20px;">
                                Specialist with extensive experience in taxation, financial accounting, banking, and auditing. Under his leadership, the company became a key partner for many large enterprises in the region.
                            </p>
                            <div style="display:flex; gap:15px;">
                                <a href="mailto:zoir_salimov@mail.ru" class="footer__link" style="display:flex; align-items:center; gap:8px;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                    zoir_salimov@mail.ru
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specialist 1 placeholder -->
                <div class="team-card fade-up fade-up-delay-1">
                    <div style="display:grid; grid-template-columns: 240px 1fr; gap:40px; align-items: start;">
                        <div style="background: var(--nk-gray-50); border-radius: 20px; aspect-ratio: 4/5; overflow: hidden; border: 1px solid var(--nk-gray-100); display: flex; align-items: center; justify-content: center;">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--nk-gray-200)" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <div>
                            <div style="color: var(--nk-red); font-weight: 800; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 12px;">Audit & Analysis</div>
                            <h3 class="service-card__title" style="font-size: 1.75rem; margin-bottom: 8px;">Leading Experts</h3>
                            <div style="color: var(--nk-gray-500); font-weight: 600; font-size: 0.95rem; margin-bottom: 25px;">Our Specialized Team</div>
                            <p class="service-card__text" style="font-size: 0.95rem; line-height: 1.7; color: var(--nk-gray-600);">
                                NEKSOZ brings together more than 50 qualified experts in audit, law, and business automation. Each team member undergoes regular certification and has practical experience in various economy sectors.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
