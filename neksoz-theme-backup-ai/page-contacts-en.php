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
                    <span class="text-gradient">Operational Support</span><br>
                    <span style="color: var(--nk-blue);">For Your Business</span>
                </h1>
                <p class="hero__desc">
                    We are always open for cooperation. Contact us for professional consultation or visit our office in Dushanbe.
                </p>
            </div>
        </div>
    </section>

    <!-- ═══════════ CONTACT CARDS ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Communication Channels</div>
                <h2 class="section__title">Contact Information</h2>
                <p class="section__subtitle">Direct communication with our team for quick resolution of your challenges.</p>
            </div>

            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:30px; margin-bottom: 80px;">
                <!-- Phone -->
                <div class="service-card is-visible" style="text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 50px 30px; min-height: auto;">
                    <div class="service-card__icon" style="margin: 0 0 25px 0;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <h3 class="service-card__title" style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); margin-bottom: 15px;">Phone</h3>
                    <div style="font-size: 1.25rem; font-weight: 800; color: var(--nk-gray-900);">+992 44 600 00 07</div>
                    <div style="font-size: 1.25rem; font-weight: 800; color: var(--nk-gray-900); margin-top: 5px;">+992 90 770 00 07</div>
                </div>

                <!-- Email -->
                <div class="service-card service-card--alt is-visible" style="text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 50px 30px; min-height: auto;">
                    <div class="service-card__icon" style="margin: 0 0 25px 0;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <h3 class="service-card__title" style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); margin-bottom: 15px;">Email</h3>
                    <div style="font-size: 1.25rem; font-weight: 800; color: var(--nk-gray-900);">info@neksoz.tj</div>
                    <div style="font-size: 1.25rem; font-weight: 800; color: var(--nk-gray-900); margin-top: 5px;">zoir_salimov@mail.ru</div>
                </div>

                <!-- Address -->
                <div class="service-card is-visible" style="text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 50px 30px; min-height: auto;">
                    <div class="service-card__icon" style="margin: 0 0 25px 0;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <h3 class="service-card__title" style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); margin-bottom: 15px;">Office</h3>
                    <div style="font-size: 0.95rem; font-weight: 500; color: var(--nk-gray-900); line-height: 1.5;">Dushanbe, Tajikistan<br>str. Shotemur, 31 (entrance from park)</div>
                </div>
            </div>

            <!-- ═══════════ FORM & MAP ═══════════ -->
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:60px; align-items: start;">
                <!-- Form -->
                <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 50px; border-radius: 24px; box-shadow: 0 30px 60px rgba(0, 13, 51, 0.05); border: 1px solid var(--nk-gray-50);">
                    <h2 class="section__title" style="text-align: left; font-size: 2rem; margin-bottom: 10px;">Send a Message</h2>
                    <p class="section__subtitle" style="text-align: left; margin-bottom: 40px;">Leave your details and our specialist will contact you shortly.</p>
                    <form class="cta-crystal__form">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="c-name">
                            <label for="c-name">Your Name</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="c-phone">
                            <label for="c-phone">Phone (+992)</label>
                        </div>
                        <div class="cta-crystal__field">
                            <textarea placeholder=" " id="c-msg" style="min-height: 120px; padding-top: 15px;"></textarea>
                            <label for="c-msg">Message (optional)</label>
                        </div>
                        <button type="submit" class="cta-crystal__btn"><span>Send Message</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
                    </form>
                </div>

                <!-- Map Placeholder -->
                <div style="background: var(--nk-gray-50); border-radius: 24px; height: 100%; min-height: 500px; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative; border: 1px solid var(--nk-gray-100);">
                    <div style="text-align: center; z-index: 2;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--nk-blue)" stroke-width="1.5" style="margin-bottom: 20px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <div style="font-weight: 800; color: var(--nk-gray-900); font-size: 1.1rem;">Map Loading...</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
