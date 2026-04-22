<?php
/**
 * Template Name: Team (EN)
 */
get_header();
?>

<style>
/* ── Team Layout ─────────────────────────────────────── */
.team-container {
    padding: 100px 0;
    max-width: 1400px;
    margin: 0 auto;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

@media (max-width: 1024px) {
    .team-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .team-grid { grid-template-columns: 1fr; }
}

/* ── Team Card: Platinum V3 ─────────────────────────── */
.expert-card {
    background: var(--nk-white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 1px solid var(--nk-gray-100);
    transition: all 0.5s var(--ease);
    display: flex;
    flex-direction: column;
    position: relative;
}

.expert-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 40px 90px rgba(0, 13, 51, 0.12);
    border-color: rgba(227, 6, 19, 0.2);
}

.expert-card__visual {
    position: relative;
    aspect-ratio: 4/5;
    overflow: hidden;
    background: var(--nk-gray-50);
}

.expert-card__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s var(--ease);
    filter: grayscale(10%);
}

.expert-card__img--top {
    object-position: top center;
}

.expert-card:hover .expert-card__img {
    transform: scale(1.05);
    filter: grayscale(0%);
}


.expert-card__body {
    padding: 35px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.expert-card__role {
    font-family: var(--font-display);
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: var(--nk-red);
    margin-bottom: 12px;
}

.expert-card__name {
    font-family: var(--font-display);
    font-size: 24px;
    font-weight: 900;
    color: var(--nk-gray-900);
    line-height: 1.25;
    margin-bottom: 15px;
    letter-spacing: -0.02em;
}

.expert-card__regalia {
    font-size: 12px;
    font-weight: 700;
    color: var(--nk-blue);
    background: rgba(0, 68, 204, 0.06);
    padding: 6px 12px;
    border-radius: 6px;
    display: inline-block;
    margin-bottom: 20px;
    letter-spacing: 0.05em;
}

.expert-card__meta {
    margin-top: auto;
    padding-top: 20px;
    border-top: 1px solid var(--nk-gray-50);
}

.expert-card__info-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 13px;
}

.expert-card__label {
    color: var(--nk-gray-400);
    font-weight: 500;
}

.expert-card__value {
    color: var(--nk-gray-900);
    font-weight: 700;
    text-align: right;
}

.expert-card__spec {
    font-size: 14px;
    line-height: 1.5;
    color: var(--nk-gray-600);
    margin-bottom: 20px;
    font-weight: 400;
}

/* ── HR Block ───────────────────────────────────────── */
.hr-block {
    background: var(--nk-white);
    border-radius: var(--radius-xl);
    padding: 80px;
    margin-top: 120px;
    border: 1px solid var(--nk-gray-100);
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 60px;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.hr-block::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 100%;
    background: linear-gradient(90deg, transparent 0%, rgba(0, 68, 204, 0.02) 100%);
    pointer-events: none;
}

@media (max-width: 1024px) {
    .hr-block { grid-template-columns: 1fr; padding: 40px; text-align: center; }
    .hr-block .btn { margin: 0 auto; }
}

.hr-block__title {
    font-family: var(--font-display);
    font-size: 36px;
    font-weight: 900;
    color: var(--nk-gray-900);
    margin-bottom: 20px;
}

.hr-block__text {
    font-size: 18px;
    color: var(--nk-gray-600);
    line-height: 1.6;
    max-width: 600px;
}
</style>

<main class="site-main">

    <!-- ═══════════ PHILOSOPHY HERO ═══════════ -->
    <section class="hero hero--internal">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container">
            <div class="hero__content" style="max-width: 900px;">
                <div class="hero__badge">Neksoz Team</div>
                <h1 class="hero__title" style="white-space: nowrap;">
                    Philosophy of expertise and <span class="text-gradient">intellect</span>
                </h1>
                <p class="hero__desc" style="max-width: 750px; color: rgba(255,255,255,0.85); font-size: 1.1rem;">
                    «Behind every figure in a report and every line in a contract lies the intellect of our experts. We have brought together professionals from various fields — from banking to tax law — so you receive comprehensive protection for your business from all sides».
                </p>
            </div>
            
            <div class="hero__actions--right">
                <div style="font-family: var(--font-display); font-size: 80px; font-weight: 900; color: rgba(255,255,255,0.05); line-height: 1; text-transform: uppercase;">
                    Intellect
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════ EXPERTS GRID ═══════════ -->
    <section class="section section--gray">
        <div class="container team-container">

            <!-- Transition Block -->
            <div class="section__header section__header--center fade-up" style="max-width: 800px; margin: 0 auto 80px;">
                <div class="section__label">Competencies</div>
                <h2 class="section__title">Mastery, Confirmed by Years of Practice</h2>
                <p class="section__subtitle" style="font-size: 1.2rem; color: var(--nk-gray-600);">
                    We don't just consult — we dive into the specifics of your business, ensuring legal clarity and financial stability at every stage of development.
                </p>
            </div>
            
            <div class="team-grid">

                <!-- Expert 1 -->
                <div class="expert-card fade-up">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-3.jpg" alt="Salimov Zoir Muminovich" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Director / Founder</div>
                        <h3 class="expert-card__name">Salimov Zoir Muminovich</h3>
                        <div class="expert-card__regalia">ACCA, CAP/CIPA</div>
                        <p class="expert-card__spec">Strategic management, audit, and tax planning for international business.</p>
                        
                        <div class="expert-card__meta">
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">Experience:</span>
                                <span class="expert-card__value">15+ years</span>
                            </div>
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">Education:</span>
                                <span class="expert-card__value">TNU, Economics</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expert 2 -->
                <div class="expert-card fade-up" style="animation-delay: 0.1s;">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-1.jpg" alt="Fathuddinzoda Dilovar Karomat" class="expert-card__img expert-card__img--top">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Senior Lawyer</div>
                        <h3 class="expert-card__name">Fathuddinzoda Dilovar Karomat</h3>
                        <div class="expert-card__regalia">LLM, Lawyer of the Year</div>
                        <p class="expert-card__spec">Corporate law, arbitration practice, and legal support for investment projects.</p>
                        
                        <div class="expert-card__meta">
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">Experience:</span>
                                <span class="expert-card__value">14 years</span>
                            </div>
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">Education:</span>
                                <span class="expert-card__value">SIU, Master of Laws</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expert 3 -->
                <div class="expert-card fade-up" style="animation-delay: 0.2s;">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-2.jpg" alt="Shirinov Rustam Sukhrobovich" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Senior Accountant</div>
                        <h3 class="expert-card__name">Shirinov Rustam Sukhrobovich</h3>
                        <div class="expert-card__regalia">CAP, Certified Accountant</div>
                        <p class="expert-card__spec">Complex accounting and tax management, preparation of financial statements, and auditing.</p>
                        
                        <div class="expert-card__meta">
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">Experience:</span>
                                <span class="expert-card__value">8 years</span>
                            </div>
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">Education:</span>
                                <span class="expert-card__value">TNU, Accounting</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expert 4 -->
                <div class="expert-card fade-up">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-5.jpg" alt="Kurbonov Shokhrukh Kamoluddinovich" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Senior Accountant</div>
                        <h3 class="expert-card__name">Kurbonov Shokhrukh Kamoluddinovich</h3>
                        <div class="expert-card__regalia">CAP, Certified Accountant</div>
                        <p class="expert-card__spec">Comprehensive accounting support, automation in 1C, and tax consulting.</p>
                        
                        <div class="expert-card__meta">
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">Experience:</span>
                                <span class="expert-card__value">10 years</span>
                            </div>
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">Education:</span>
                                <span class="expert-card__value">TAA, Finance and Credit</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expert 5 -->
                <div class="expert-card fade-up" style="animation-delay: 0.1s;">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-4.jpg" alt="Livengood Justin Reg" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Business Development Manager</div>
                        <h3 class="expert-card__name">Livengood Justin Reg</h3>
                        <div class="expert-card__regalia">MBA, Global Strategy</div>
                        <p class="expert-card__spec">Business scaling, identifying new partnerships, and expanding the company into international consulting markets.</p>
                        
                        <div class="expert-card__meta">
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">Experience:</span>
                                <span class="expert-card__value">20+ years</span>
                            </div>
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">Education:</span>
                                <span class="expert-card__value">State Univ, MBA</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- HR Block -->
            <div class="hr-block fade-up">
                <div class="hr-block__content">
                    <h2 class="hr-block__title">Want to join the team?</h2>
                    <p class="hr-block__text">We are always happy to welcome talented accountants, auditors, and lawyers who share our values and strive for professional growth. If you are ready to solve complex tasks and create value for business — let's join paths.</p>
                </div>
                <div class="hr-block__actions">
                    <a href="<?php echo home_url('/vacancies?lang=en'); ?>" class="btn btn--primary" style="width: 100%;">
                        <span>Submit CV</span>
                        <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-up').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.8s var(--ease)';
        observer.observe(el);
    });
});
</script>

<?php get_footer(); ?>
