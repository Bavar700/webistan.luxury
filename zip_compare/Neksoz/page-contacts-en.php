<?php
/**
 * Template Name: Contacts (EN)
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
                <div class="hero__badge">Get in Touch</div>
                <h1 class="hero__title">
                    Connect with<br>
                    Neksoz Experts
                </h1>
                <p class="hero__desc">
                    We are always available to discuss your business's strategic goals and offer effective financial and legal solutions.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="tel:+992985641010" class="btn btn--primary btn-animated">
                    Call Now
                    <svg class="btn__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ CONTACT GRID & FORM ═══════════ -->
    <section class="section cta-crystal" style="padding-top: 80px; padding-bottom: 120px;">
        <!-- Animated Mesh Glows -->
        <div class="cta-crystal__glow cta-crystal__glow--blue"></div>
        <div class="cta-crystal__glow cta-crystal__glow--red"></div>

        <div class="container fade-up">
            
            <!-- Section Header Above Columns -->
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Direct Contact</div>
                <h2 class="section__title">Open for Dialogue</h2>
                <p class="section__subtitle">Choose a convenient way to get in touch or leave a request for our consulting department.</p>
            </div>

            <div class="cta-crystal__grid" style="align-items: stretch; gap: 40px;">
                
                <!-- Left Side: Split Cards -->
                <div style="display: flex; flex-direction: column; gap: 30px; flex: 1; position: relative; z-index: 2;">
                    <style>
                        .contact-item {
                            display: flex; gap: 24px; align-items: flex-start;
                            padding: 24px 0;
                            border-bottom: 1px dashed var(--nk-gray-100);
                            transition: all 0.4s var(--ease);
                        }
                        .contact-item:last-child {
                            border-bottom: none;
                            padding-bottom: 0;
                        }
                        .contact-item:first-child {
                            padding-top: 0;
                        }
                        .contact-icon {
                            width: 52px;
                            height: 52px;
                            background: rgba(0, 13, 51, 0.03);
                            color: var(--nk-gray-400);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-radius: 14px;
                            border: 1px solid rgba(0, 13, 51, 0.04);
                            flex-shrink: 0;
                            position: relative;
                            overflow: hidden;
                            transition: all 0.4s var(--ease);
                        }
                        .contact-icon::before {
                            content: '';
                            position: absolute;
                            inset: 0;
                            background: var(--nk-grad-brand);
                            border-radius: 14px;
                            opacity: 0;
                            transition: opacity 0.4s ease;
                            z-index: 1;
                        }
                        .contact-icon svg {
                            width: 22px;
                            height: 22px;
                            stroke: currentColor;
                            stroke-width: 2;
                            fill: none;
                            position: relative;
                            z-index: 2;
                            transition: transform 0.4s var(--ease);
                        }
                        .contact-item:hover .contact-icon,
                        .social-icon-wrapper:hover .contact-icon {
                            border-color: transparent;
                            transform: translateY(-5px);
                        }
                        .contact-item:hover .contact-icon::before,
                        .social-icon-wrapper:hover .contact-icon::before { opacity: 1; }
                        .contact-item:hover .contact-icon svg,
                        .social-icon-wrapper:hover .contact-icon svg {
                            color: #ffffff;
                            transform: scale(1.1);
                        }
                        .social-icon-wrapper .contact-icon {
                            width: 44px; height: 44px;
                            border-radius: 10px;
                        }
                        .social-icon-wrapper .contact-icon::before { border-radius: 10px; }
                        
                        .contact-card {
                            background: var(--nk-white);
                            border: 1px solid var(--nk-gray-50);
                            border-radius: 32px;
                            border-radius: 32px;
                            padding: 50px;
                            box-shadow: 0 10px 30px rgba(0, 13, 51, 0.03);
                            transition: all 0.4s var(--ease);
                            display: flex;
                            flex-direction: column;
                            flex: 1;
                        }
                        .contact-card:hover {
                            box-shadow: 0 20px 50px rgba(0, 13, 51, 0.06);
                            border-color: rgba(0, 68, 204, 0.1);
                        }
                    </style>

                    <!-- Card 1: Basic Information -->
                    <div class="contact-card">
                        <h3 class="cta-crystal__title" style="font-size: 28px; margin-top: 0; margin-bottom: 24px; text-transform: none; color: var(--nk-gray-900);">Basic Information</h3>
                        <ul style="list-style: none; padding: 0;">
                            <li class="contact-item">
                                <div class="contact-icon">
                                    <svg viewBox="0 0 24 24"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                </div>
                                <div style="padding-top: 4px;">
                                    <strong style="display: block; color: var(--nk-gray-900); font-size: 16px; margin-bottom: 6px; font-weight: 600;">Address:</strong>
                                    <span style="color: var(--nk-gray-600); line-height: 1.6; font-size: 15px;">734000, Republic of Tajikistan,<br>Dushanbe, 55 Rudaki Avenue, 3rd Floor.</span>
                                </div>
                            </li>
                            <li class="contact-item">
                                <div class="contact-icon">
                                    <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </div>
                                <div style="padding-top: 4px;">
                                    <strong style="display: block; color: var(--nk-gray-900); font-size: 16px; margin-bottom: 6px; font-weight: 600;">Phone:</strong>
                                    <a href="tel:+992985641010" style="color: var(--nk-gray-900); text-decoration: none; font-size: 18px; font-weight: 500;">+992 985 64-10-10</a>
                                </div>
                            </li>
                            <li class="contact-item">
                                <div class="contact-icon">
                                    <svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                </div>
                                <div style="padding-top: 4px;">
                                    <strong style="display: block; color: var(--nk-gray-900); font-size: 16px; margin-bottom: 6px; font-weight: 600;">E-mail:</strong>
                                    <a href="mailto:info@neksoz.tj" style="color: var(--nk-blue); text-decoration: none; font-size: 16px; font-weight: 500;">info@neksoz.tj</a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Card 2: Working Hours -->
                    <div class="contact-card">
                        <h3 class="cta-crystal__title" style="font-size: 24px; margin-bottom: 16px; text-transform: none; color: var(--nk-gray-900);">Working Hours</h3>
                        <div style="background: rgba(0, 13, 51, 0.02); border: 1px solid rgba(0, 13, 51, 0.05); border-radius: 12px; padding: 24px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px dashed rgba(0, 13, 51, 0.1);">
                                <span style="color: var(--nk-gray-700);">Mon – Fri</span>
                                <strong style="color: var(--nk-gray-900);">09:00 – 18:00</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px dashed rgba(0, 13, 51, 0.1);">
                                <span style="color: var(--nk-gray-700);">Saturday</span>
                                <strong style="color: var(--nk-gray-900);">10:00 – 14:00</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: var(--nk-gray-700);">Sunday</span>
                                <span style="color: var(--nk-red); font-weight: 500;">Closed</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Contact Form -->
                <div style="background: rgba(255, 255, 255, 0.8); border: 1px solid rgba(0, 13, 51, 0.05); border-radius: 32px; padding: 50px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.06); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); flex: 1.2; position: relative; z-index: 2; display: flex; flex-direction: column; height: 100%;">
                    <h3 class="cta-crystal__title" style="font-size: 28px; margin-bottom: 12px; margin-top: 0;">Discuss Your Business?</h3>
                    <p style="color: var(--nk-gray-600); margin-bottom: 40px; font-size: 15px; line-height: 1.6;">Fill out the form below, and we will prepare a personalized proposal for you.</p>

                    <form action="#" class="cta-crystal__form">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="c-f-name">
                            <label for="c-f-name">Your Name</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="c-f-company">
                            <label for="c-f-company">Company Name</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="c-f-phone">
                            <label for="c-f-phone">Phone</label>
                        </div>
                        
                        <div class="cta-crystal__field nx-dropdown" id="contactServicesDropdown">
                            <input type="text" placeholder=" " required id="c-f-service-input" class="nx-dropdown__trigger" readonly>
                            <label for="c-f-service-input">Your Question / Service <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px; display: inline-block; vertical-align: middle;"><path d="m6 9 6 6 6-6"/></svg></label>
                            <div class="nx-dropdown__panel">
                                <div class="nx-dropdown__option" data-val="audit">Financial Audit</div>
                                <div class="nx-dropdown__option" data-val="restore">Accounting Restoration</div>
                                <div class="nx-dropdown__option" data-val="legal">Legal Consultations</div>
                                <div class="nx-dropdown__option" data-val="accounting">Financial & HR Accounting</div>
                                <div class="nx-dropdown__option" data-val="secretariat">Secretariat Services</div>
                                <div class="nx-dropdown__option" data-val="consulting">Business Consulting</div>
                                <div class="nx-dropdown__option" data-val="tax">Tax Consultations</div>
                                <div class="nx-dropdown__option" data-val="management">Management Accounting</div>
                                <div class="nx-dropdown__option" data-val="automation">Business Automation</div>
                                <div class="nx-dropdown__option" data-val="planning">Business Planning</div>
                                <div class="nx-dropdown__option" data-val="other">Other Question</div>
                            </div>
                        </div>

                        <button type="submit" class="cta-crystal__btn">
                            <span>Submit Request</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </button>

                        <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                            By clicking the button, you agree to our <a href="<?php echo home_url('/privacy-policy'); ?>" style="color: var(--nk-blue); text-decoration: underline;">Privacy Policy</a>
                        </p>
                        <p class="cta-crystal__secure">🛡️ Secure connection (SSL 256-bit)</p>
                    </form>
                </div>
            </div>

            <!-- Centered Social Icons Below Grid -->
            <div style="margin-top: 60px; text-align: center;">
                <span style="font-size: 16px; color: var(--nk-gray-600); font-weight: 500; display: block; margin-bottom: 20px;">We are on social media:</span>
                <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
                    <a href="https://t.me/neksoz" class="social-icon-wrapper" title="Telegram">
                        <div class="contact-icon"><svg viewBox="0 0 24 24"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg></div>
                    </a>
                    <a href="https://wa.me/992446000000" class="social-icon-wrapper" title="WhatsApp">
                        <div class="contact-icon"><svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 10h.01"/><path d="M12 10h.01"/><path d="M16 10h.01"/></svg></div>
                    </a>
                    <a href="#" class="social-icon-wrapper" title="X (Twitter)">
                        <div class="contact-icon"><svg viewBox="0 0 24 24"><path d="M4 4l11.733 16h4.267l-11.733-16zM4 20l6.768-6.768M13.232 10.768L20 4"/></svg></div>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- ═══════════ INTERACTIVE MAP ═══════════ -->
    <section class="section" style="padding: 0;">
        <div style="height: 500px; width: 100%; position: relative; background: var(--nk-gray-100);">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3119.2635489025816!2d68.7844!3d38.5737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38b5d1645e05494d%3A0xc66517a264d1f56!2sRudaki%20Ave%2042%2C%20Dushanbe!5e0!3m2!1sen!2stj!4v1712465000000!5m2!1sen!2stj" 
                width="100%" height="100%" style="border:0; filter: grayscale(1) invert(0.9) contrast(1.2);" allowfullscreen="" loading="lazy"></iframe>
            
            <!-- Red Accent Custom Marker Overlay -->
            <div class="map-modal__marker">
                <svg class="map-modal__marker-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/></svg>
                <div class="map-modal__marker-pulse"></div>
            </div>

            <div style="position: absolute; bottom: 40px; right: 40px; background: white; padding: 20px 30px; border-radius: 12px; box-shadow: 0 20px 40px rgba(0, 13, 51, 0.1); display: flex; align-items: center; gap: 16px;">
                <div style="width: 48px; height: 48px; background: var(--nk-grad-brand); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <div>
                    <h4 style="margin: 0 0 4px; font-size: 16px; color: var(--nk-gray-900);">Headquarters</h4>
                    <span style="font-size: 14px; color: var(--nk-gray-600);">55 Rudaki Avenue</span>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dropdown Logic for Contacts Page
    const drp = document.getElementById('contactServicesDropdown');
    if (drp) {
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
                trigger.classList.add('has-value');
            });
        });

        document.addEventListener('click', function(e) {
            if (!drp.contains(e.target)) {
                drp.classList.remove('is-open');
            }
        });
    }
});
</script>

<style>
@media (max-width: 991px) {
    .contacts-info { padding-right: 0 !important; }
}
</style>

<?php get_footer(); ?>
