<?php get_header(); ?>
<main id='primary' class='site-main'>
<section class="hero">
    <div class="hero__geo"></div>
    <div class="hero__grid-pattern"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>

    <div class="container hero__container" style="position:relative;z-index:2;">
        <div class="hero__content">
            <div class="hero__badge">Business Consulting</div>
            <h1 class="hero__title">
                We Deliver<br><em>Results!</em>
            </h1>
            <p class="hero__desc">
                Professional audit, tax planning, and legal support for business. <strong>Reliability and expertise</strong> for your success.
            </p>
        </div>
        <div class="hero__actions--right">
            <a href="#services" class="btn btn--primary btn-animated">
                Our Services
                <svg class="btn__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
            <a href="#contacts" class="btn btn--outline-light btn-animated-light">Contact Us</a>
        </div>
    </div>

</section>

<!-- ═══════════ STATS RIBBON (RESTYLED TO MATCH SERVICES) ═══════════ -->
<section class="section section--gray stats-ribbon-block" style="padding-top: 80px; padding-bottom: 0;">
    <div class="container">
        <div style="display: flex; justify-content: flex-end; margin-bottom: 50px;">
            <div class="section__label" style="margin-bottom: 0;">Our Experience</div>
        </div>
        <div class="services-grid" style="grid-template-columns: repeat(4, 1fr); gap: 20px;">
            <!-- 1 -->
            <div class="service-card fade-up" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon stat-icon">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; color: var(--nk-blue) !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">500<em style="color: var(--nk-red) !important; font-style: normal !important; -webkit-text-fill-color: var(--nk-red) !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 0.55rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; white-space: nowrap !important;">Happy clients</p>
            </div>
            <!-- 2 -->
            <div class="service-card service-card--alt fade-up fade-up-delay-1" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon stat-icon">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; color: var(--nk-red) !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;"><?php echo (date('Y') - 2016); ?><em style="color: var(--nk-blue) !important; font-style: normal !important; -webkit-text-fill-color: var(--nk-blue) !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 0.55rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; white-space: nowrap !important;">Years on market</p>
            </div>
            <!-- 3 -->
            <div class="service-card fade-up fade-up-delay-2" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon stat-icon">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; color: var(--nk-blue) !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">50<em style="color: var(--nk-red) !important; font-style: normal !important; -webkit-text-fill-color: var(--nk-red) !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 0.55rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; white-space: nowrap !important;">Qualified experts</p>
            </div>
            <!-- 4 -->
            <div class="service-card service-card--alt fade-up fade-up-delay-3" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon stat-icon">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; color: var(--nk-red) !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">1200<em style="color: var(--nk-blue) !important; font-style: normal !important; -webkit-text-fill-color: var(--nk-blue) !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 0.55rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; white-space: nowrap !important;">Successful projects</p>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════ SERVICES ═══════════ -->
<section id="services" class="section section--gray">
    <div class="container">
        <div class="section__header section__header--center">
            <div class="section__label">Specializations</div>
            <h2 class="section__title section__title--huge"><span class="text-gradient">Comprehensive Solutions</span><br>for Your Business</h2>
            <p class="section__subtitle section__subtitle--free">Each service is tailored to the individual needs of the client and ensures the maximum <br><strong>protection of your interests</strong>.</p>
        </div>

        <div class="services-grid">
            <!-- 1. Audit financial activity -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                </div>
                <h3 class="service-card__title">Financial Activity Audit</h3>
                <p class="service-card__text">You get an independent verification of financial statements that confirms business transparency and identifies hidden financial risks.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our Tasks:</span>
                    <ul class="service-card__list">
                        <li>Assessment of accounting organization and control systems</li>
                        <li>Verification of the correctness and legality of records</li>
                        <li>Prospective analysis of future events and trends</li>
                        <li>Identification of reserves for financial resource growth</li>
                        <li>Confirmation of reporting reliability and tax audit</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-audit'); ?>" class="service-card__link">More Details →</a>
            </div>

            <!-- 2. Restoration of financial accounting -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                </div>
                <h3 class="service-card__title">Restoration of Financial Accounting</h3>
                <p class="service-card__text">We bring your disordered records to perfect order, eliminate errors, and protect you from claims from government authorities.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our Tasks:</span>
                    <ul class="service-card__list">
                        <li>Restoration of accounting for past periods</li>
                        <li>Legal consultation in the financial sector</li>
                        <li>Organization and registration of primary documents</li>
                        <li>Reconciliation with partners and tax authorities</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-restore'); ?>" class="service-card__link">More Details →</a>
            </div>

            <!-- 3. Legal consultations -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="service-card__title">Legal Consultations</h3>
                <p class="service-card__text">You ensure the legal security of your company and reliably protect your interests in all contracts and disputes.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our Tasks:</span>
                    <ul class="service-card__list">
                        <li>Registration and re-registration of legal entities</li>
                        <li>Support for real estate transaction formalization</li>
                        <li>Representation in all judicial authorities</li>
                        <li>Legal assistance and corporate contract expertise</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-legal'); ?>" class="service-card__link">More Details →</a>
            </div>

            <!-- 4. Financial and human resource accounting -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 class="service-card__title">Accounting & HR Outsourcing</h3>
                <p class="service-card__text">We take over all accounting and personnel routines, guaranteeing absence of fines and stable operation of your team.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our Tasks:</span>
                    <ul class="service-card__list">
                        <li>Accounting in 1C and payroll calculation</li>
                        <li>Opening bank accounts and cash discipline</li>
                        <li>Submission of all reports according to IFRS</li>
                        <li>Full HR administration and working time tracking</li>
                        <li>Rest and business trip formalization, job descriptions</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-accounting'); ?>" class="service-card__link">More Details →</a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ ABOUT ═══════════ -->
<section id="about" class="about section">
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    
    <div class="container">
        <div class="ceo-editorial fade-up is-visible">
            <div class="section__label section__label--on-dark">About Company</div>
            <h2 class="section__title section__title--huge section__title--on-dark">
                <span class="text-gradient">Strategic Partner</span><br>in Your Business
            </h2>
            <p class="ceo-editorial__intro">
                LLC "NEKSOZ-BUSINESS CONSULTING GROUP" — founded in 2016. Since then, we have evolved from a highly specialized firm into a <strong>powerful consulting hub</strong>, ensuring stability and safety at every stage of business growth.
            </p>
            <div class="ceo-editorial__quote-card">
                <blockquote class="ceo-editorial__quote-text">
                    Our mission is to transform complex business processes into a transparent and profitable system. We work for your result and ensure top-level protection of your interests.
                </blockquote>
                <div class="ceo-editorial__author">
                    <div class="ceo-editorial__circle-frame">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ceo.jpg" alt="Zoir Salimov" class="ceo-editorial__avatar">
                    </div>
                    <div class="cea-editorial__author-info">
                        <div class="ceo-editorial__author-name">Zoir Salimov</div>
                        <div class="ceo-editorial__author-title">General Director, NEKSOZ</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ CONTACTS ═══════════ -->
<section id="contacts" class="cta-crystal">
    <div class="cta-crystal__glow cta-crystal__glow--blue"></div>
    <div class="cta-crystal__glow cta-crystal__glow--red"></div>
    
    <div class="container">
        <div class="cta-crystal__grid">
            <div class="cta-crystal__content fade-up is-visible">
                <div class="section__label">Instant Contact</div>
                <h2 class="cta-crystal__title"><span class="text-gradient">Ready to Scale</span><br>Your Success?</h2>
                <p class="cta-crystal__text">Leave a request today and we will develop an individual strategy for growth and ensuring your business safety.</p>
                <div class="cta-crystal__status">
                    <span class="cta-crystal__status-dot"></span>
                    We are online • Response within 15 minutes
                </div>
            </div>

            <div class="cta-crystal__form-wrapper fade-up is-visible">
                <form action="#" class="cta-crystal__form">
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " required id="f-name">
                        <label for="f-name">Your Name</label>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="tel" placeholder=" " required id="f-phone">
                        <label for="f-phone">Phone (+992)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn">
                        <span>Send Request</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                    <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        By clicking the button, you agree to the <a href="<?php echo home_url('/privacy-policy'); ?>" style="color: var(--nk-blue); text-decoration: underline;">Privacy Policy</a>.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
</main>
<?php get_footer(); ?>
