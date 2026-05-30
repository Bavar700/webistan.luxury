<?php 
if (function_exists('nk_get_current_lang') && nk_get_current_lang() === 'tj') {
    get_template_part('front-page', 'tj');
    return;
}
get_header(); 
?>
<main id='primary' class='site-main'>
<section class="hero">
    <div class="hero__geo"></div>
    <div class="hero__grid-pattern"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>

    <div class="container hero__container" style="position:relative;z-index:2;">
        <div class="hero__content">
            <div class="hero__badge">Business consulting</div>
            <h1 class="hero__title" style="white-space: nowrap; min-height: 1.9em; display: flex; align-items: center;">We&nbsp;will&nbsp;<em>solve&nbsp;it!</em></h1>
            <p class="hero__desc">
                Professional audit, tax planning, and legal business support. <strong>Reliability and expertise</strong> for your success.
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
            <div class="service-card fade-up" style="padding: 70px 30px !important; min-height: auto !important; position: relative !important; overflow: hidden !important; display: flex; flex-direction: column; align-items: center; text-align: center; justify-content: center;">
                <div class="service-card__title" style="font-size: 4rem !important; margin-bottom: 15px !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">500<em style="font-style: normal !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.1em !important; font-size: 0.75rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; line-height: 1.3 !important;">Satisfied Clients</p>
            </div>
            <!-- 2 -->
            <div class="service-card fade-up fade-up-delay-1" style="padding: 70px 30px !important; min-height: auto !important; position: relative !important; overflow: hidden !important; display: flex; flex-direction: column; align-items: center; text-align: center; justify-content: center;">
                <div class="service-card__title" style="font-size: 4rem !important; margin-bottom: 15px !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;"><?php echo (date('Y') - 2016); ?><em style="font-style: normal !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.1em !important; font-size: 0.75rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; line-height: 1.3 !important;">Years on the Market</p>
            </div>
            <!-- 3 -->
            <div class="service-card fade-up fade-up-delay-2" style="padding: 70px 30px !important; min-height: auto !important; position: relative !important; overflow: hidden !important; display: flex; flex-direction: column; align-items: center; text-align: center; justify-content: center;">
                <div class="service-card__title" style="font-size: 4rem !important; margin-bottom: 15px !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">50<em style="font-style: normal !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.1em !important; font-size: 0.75rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; line-height: 1.3 !important;">Qualified Experts</p>
            </div>
            <!-- 4 -->
            <div class="service-card fade-up fade-up-delay-3" style="padding: 70px 30px !important; min-height: auto !important; position: relative !important; overflow: hidden !important; display: flex; flex-direction: column; align-items: center; text-align: center; justify-content: center;">
                <div class="service-card__title" style="font-size: 4rem !important; margin-bottom: 15px !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">1200<em style="font-style: normal !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.1em !important; font-size: 0.75rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; line-height: 1.3 !important;">Successful Projects</p>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════ SERVICES ═══════════ -->
<section id="services" class="section section--gray">
    <div class="container">
        <div class="section__header section__header--center">
            <div class="section__label">Directions</div>
            <h2 class="section__title section__title--huge"><span class="text-gradient">Comprehensive solutions</span><br>for Your Business</h2>
            <p class="section__subtitle section__subtitle--free">Each service is adapted to individual client needs and provides maximum <br><strong>protection of Your Interests</strong>.</p>
        </div>

        <div class="services-grid">
            <!-- 1. Financial Audit -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </div>
                    <h3 class="service-card__title">Financial Audit</h3>
                </div>
                <p class="service-card__text">You receive an independent review of reporting that confirms business transparency and identifies hidden financial risks.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our tasks:</span>
                    <ul class="service-card__list">
                        <li>Evaluating the level of accounting organization and control systems</li>
                        <li>Checking the accuracy and legality of accounting records</li>
                        <li>Prospective analysis of future business events</li>
                        <li>Identifying reserves for the growth of financial resources</li>
                        <li>Confirming the reliability of reports and conducting tax audits</li>
                    </ul>
                </div>
                <a href="<?php echo nk_link('/service-audit-en?lang=en', 'en'); ?>" class="service-card__link">Read More →</a>
            </div>

            <!-- 2. Financial Accounting Restoration -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                    </div>
                    <h3 class="service-card__title">Financial Accounting Restoration</h3>
                </div>
                <p class="service-card__text">We will bring your neglected documentation into full order, eliminating errors and protecting you from claims by state bodies.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our tasks:</span>
                    <ul class="service-card__list">
                        <li>Restoring accounting records and closing past gaps</li>
                        <li>Legal consulting in the financial sector</li>
                        <li>Systematizing and processing primary documentation</li>
                        <li>Reconciliation with counterparties and the tax office to prevent fines</li>
                    </ul>
                </div>
                <a href="<?php echo nk_link('/service-restore-en?lang=en', 'en'); ?>" class="service-card__link">Read More →</a>
            </div>

            <!-- 3. Legal Consultations -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="service-card__title">Legal Consultations</h3>
                </div>
                <p class="service-card__text">You ensure the legal security of your company and reliable protection of interests in any contracts and disputes.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our tasks:</span>
                    <ul class="service-card__list">
                        <li>Registration and re-registration of legal entities</li>
                        <li>Supporting and formatting real estate transactions</li>
                        <li>Representing interests in all judicial instances</li>
                        <li>Legal assistance and expertise for corporate contracts</li>
                    </ul>
                </div>
                <a href="<?php echo nk_link('/service-legal-en?lang=en', 'en'); ?>" class="service-card__link">Read More →</a>
            </div>

            <!-- 4. Financial and HR Accounting -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="service-card__title">Financial and HR Accounting</h3>
                </div>
                <p class="service-card__text">We take on all accounting and HR routines, guaranteeing the absence of fines and stable staff performance.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our tasks:</span>
                    <ul class="service-card__list">
                        <li>Accounting in 1C and payroll calculation</li>
                        <li>Opening accounts and maintaining cash discipline</li>
                        <li>Submitting all types of reporting under IFRS standards</li>
                        <li>Comprehensive HR administration and time tracking</li>
                        <li>Executing vacations, business trips, and job descriptions</li>
                    </ul>
                </div>
                <a href="<?php echo nk_link('/service-accounting-en?lang=en', 'en'); ?>" class="service-card__link">Read More →</a>
            </div>

            <!-- 5. Secretariat Services -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <h3 class="service-card__title">Secretariat Services</h3>
                </div>
                <p class="service-card__text">You delegate documentation and call administration to professionals, freeing your time for strategic tasks.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our tasks:</span>
                    <ul class="service-card__list">
                        <li>Licensing for the employment of foreign citizens</li>
                        <li>Issuing invitations, permits, and visas (M, K, O-2)</li>
                        <li>Registration with OVIR and issuing Dipservice cards</li>
                        <li>Secretarial outsourcing and legal translation services</li>
                    </ul>
                </div>
                <a href="<?php echo nk_link('/service-secretariat-en?lang=en', 'en'); ?>" class="service-card__link">Read More →</a>
            </div>

            <!-- 6. Business Consulting -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                    </div>
                    <h3 class="service-card__title">Business Consulting</h3>
                </div>
                <p class="service-card__text">You receive expert support in finding new growth points and developing an effective growth model for your enterprise.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our tasks:</span>
                    <ul class="service-card__list">
                        <li>Building strategic management systems</li>
                        <li>In-depth audit and optimization of business processes</li>
                        <li>Financial planning and the development of growth models</li>
                    </ul>
                </div>
                <a href="<?php echo nk_link('/service-consulting-en?lang=en', 'en'); ?>" class="service-card__link">Read More →</a>
            </div>

            <!-- 7. Tax Consultations -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h3 class="service-card__title">Tax Consultations</h3>
                </div>
                <p class="service-card__text">We help legally optimize your tax burden and minimize risks ahead of regulatory audits.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our tasks:</span>
                    <ul class="service-card__list">
                        <li>Professional consultations (Legal entities and individuals)</li>
                        <li>Development of a safe tax policy</li>
                        <li>Representation of interests in tax disputes</li>
                    </ul>
                </div>
                <a href="<?php echo nk_link('/service-tax-en?lang=en', 'en'); ?>" class="service-card__link">Read More →</a>
            </div>

            <!-- 8. Management Accounting -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/></svg>
                    </div>
                    <h3 class="service-card__title">Management Accounting</h3>
                </div>
                <p class="service-card__text">You gain full financial transparency and accurate data for decision-making that actually increases your net profit.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our tasks:</span>
                    <ul class="service-card__list">
                        <li>Implementation of Cash Flow, P&L, and balance sheet reports</li>
                        <li>Calculating profitability by business segments and projects</li>
                        <li>Cash flow planning and calendar setup</li>
                        <li>Visualization of financial indicators for owners</li>
                    </ul>
                </div>
                <a href="<?php echo nk_link('/service-management-en?lang=en', 'en'); ?>" class="service-card__link">Read More →</a>
            </div>

            <!-- 9. Business Process Automation -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    </div>
                    <h3 class="service-card__title">Business Process Automation</h3>
                </div>
                <p class="service-card__text">You free your team from routine tasks and eliminate human error by transitioning management into a fast and accurate digital environment.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our tasks:</span>
                    <ul class="service-card__list">
                        <li>Implementing and configuring 1C accounting systems</li>
                        <li>Integration of CRM, Bitrix24, and management systems</li>
                        <li>Configuring accounting links with Client-Bank</li>
                        <li>Digitization of archives and electronic document management</li>
                    </ul>
                </div>
                <a href="<?php echo nk_link('/service-automation-en?lang=en', 'en'); ?>" class="service-card__link">Read More →</a>
            </div>

            <!-- 10. Business Plans and Feasibility Studies -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/><path d="M9 14h6"/><path d="M9 18h6"/><path d="M9 10h6"/></svg>
                    </div>
                    <h3 class="service-card__title">Business Plans and Feasibility Studies</h3>
                </div>
                <p class="service-card__text">You receive a detailed and well-founded financial document that proves your project's ROI and helps secure investments or bank loans.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Our tasks:</span>
                    <ul class="service-card__list">
                        <li>In-depth analysis of the market, competitive environment, and audience</li>
                        <li>Developing a comprehensive financial model (revenues, expenses, break-even point)</li>
                        <li>Drafting feasibility studies considering Tajikistan's legislation and taxation</li>
                        <li>Preparing presentation materials (Pitch Deck) for project advocacy</li>
                        <li>Supporting and defending the business plan during investor negotiations</li>
                    </ul>
                </div>
                <a href="<?php echo nk_link('/service-business-plan-en?lang=en', 'en'); ?>" class="service-card__link">Read More →</a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ ABOUT ═══════════ -->
<section id="about" class="about section">
    <!-- Geometric Background mirroring Hero -->
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    <div class="container">
    <div class="ceo-editorial fade-up is-visible">
            <div class="section__label section__label--on-dark">About the Company</div>
            <h2 class="section__title section__title--huge section__title--on-dark">
                <span class="text-gradient">Reliable partner</span><br>for Your Business
            </h2>
            <p class="ceo-editorial__intro">
                NEKSOZ-BUSINESS CONSULTING GROUP LLC — founded in 2016. Since then, we have evolved from a specialized firm into a <strong>powerful consulting hub</strong>, ensuring business resilience and security at every stage of growth.
            </p>
            <div class="ceo-editorial__quote-card">
                <blockquote class="ceo-editorial__quote-text">
                    Our mission is to transform complex business processes into a transparent and profitable system. We work for your results and guarantee the highest level of protection for your interests.
                </blockquote>
                <div class="ceo-editorial__author">
                    <div class="ceo-editorial__circle-frame">
                        <img src="<?php echo get_template_directory_uri(); ?>/ceo.jpg" alt="Zoir Salimov" class="ceo-editorial__avatar">
                    </div>
                    <div class="cea-editorial__author-info">
                        <div class="ceo-editorial__author-name">Zoir Salimov</div>
                        <div class="ceo-editorial__author-title">CEO, NEKSOZ</div>
                    </div>
                    <div class="ceo-editorial__signature">Zoir Salimov</div>
                    <div class="ceo-editorial__footer">
                        <a href="#" class="ceo-editorial__team-link">
                            Meet our team of experts
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Closing container -->
</section>

<!-- ═══════════ CTA — CRYSTAL ELEGANCE EDITION ═══════════ -->
<section id="contacts" class="cta-crystal">
    <!-- Animated Mesh Glows -->
    <div class="cta-crystal__glow cta-crystal__glow--blue"></div>
    <div class="cta-crystal__glow cta-crystal__glow--red"></div>
    
    <div class="container">
        <div class="cta-crystal__grid">
            
            <!-- Left Side: Soft Modern Persuasion -->
            <div class="cta-crystal__content fade-up is-visible">
                <div class="section__label">Quick Connect</div>
                <h2 class="cta-crystal__title"><span class="text-gradient">Ready to scale</span><br>Your Success?</h2>
                <p class="cta-crystal__text">Submit a request today, and we will develop a personalized strategy for the growth and security of your business.</p>
                <div class="cta-crystal__status">
                    <span class="cta-crystal__status-dot"></span>
                    We are online • Response within 15 minutes
                </div>
            </div>

            <!-- Right Side: Crystal Tech Form -->
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
                    <div class="cta-crystal__field nx-dropdown">
                        <input type="text" placeholder=" " required id="f-service-input" class="nx-dropdown__trigger" readonly>
                        <label for="f-service-input">Select Service Direction <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px; display: inline-block; vertical-align: middle;"><path d="m6 9 6 6 6-6"/></svg></label>
                        
                        <div class="nx-dropdown__panel">
                            <div class="nx-dropdown__option">Legal Support</div>
                            <div class="nx-dropdown__option">Tax Consulting</div>
                            <div class="nx-dropdown__option">Audit & Accounting</div>
                            <div class="nx-dropdown__option">Business Automation</div>
                            <div class="nx-dropdown__option">HR Consulting</div>
                            <div class="nx-dropdown__option">Investment Consulting</div>
                            <div class="nx-dropdown__option">Marketing Strategies</div>
                            <div class="nx-dropdown__option">Business Planning</div>
                            <div class="nx-dropdown__option">Process Optimization</div>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <textarea placeholder=" " id="f-msg" rows="3"></textarea>
                        <label for="f-msg">Details of your request</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn">
                        <span>Submit Request</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                    <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        By clicking the button, you agree with the <a href="<?php echo nk_link('/privacy-policy?lang=en', 'en'); ?>" style="color: var(--nk-blue); text-decoration: underline;">Privacy Policy</a>
                    </p>
                    <p class="cta-crystal__secure">🛡️ Secure Connection (SSL 256-bit)</p>
                    <div id="nk-form-status" style="margin-top: 15px; display: none;"></div>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const drp = document.querySelector('.nx-dropdown');
                        const trigger = drp.querySelector('.nx-dropdown__trigger');
                        const options = drp.querySelectorAll('.nx-dropdown__option');

                        trigger.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            drp.classList.toggle('is-open');
                        });

                        options.forEach(opt => {
                            opt.addEventListener('click', function(e) {
                                e.stopPropagation();
                                trigger.value = this.innerText;
                                drp.classList.remove('is-open');
                                // Trigger CSS pseudo-classes
                                trigger.classList.add('has-value');
                                trigger.focus();
                                trigger.blur();
                            });
                        });

                        document.addEventListener('click', function(e) {
                            if (!drp.contains(e.target)) {
                                drp.classList.remove('is-open');
                            }
                        });
                    });
                </script>
            </div>

        </div>
    </div>
</section>
</main>
<?php get_footer(); ?>



