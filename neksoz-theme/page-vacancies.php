<?php
/**
 * Template Name: Ð’Ð°ÐºÐ°Ð½ÑÐ¸Ð¸ V3
 */
get_header();
?>

<style>
/* â”€â”€ Vacancies Styles â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.vac-container {
    padding: 100px 0;
    max-width: 1200px;
    margin: 0 auto;
}

/* â”€â”€ Why Us Cards â”€â”€ */
.why-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-bottom: 120px;
}

@media (max-width: 1024px) {
    .why-cards { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .why-cards { grid-template-columns: 1fr; }
}

.why-card {
    background: var(--nk-white);
    padding: 50px 40px;
    border-radius: 20px;
    border: 1px solid rgba(0, 13, 51, 0.05);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 13, 51, 0.015);
    isolation: isolate;
}

.why-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(0, 13, 51, 0.06);
    border-color: rgba(0, 68, 204, 0.15);
}

.why-card__icon {
    width: 60px;
    height: 60px;
    margin-bottom: 28px;
    background: rgba(0, 13, 51, 0.03);
    border-radius: 16px;
    color: var(--nk-gray-400);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(0, 13, 51, 0.04);
    position: relative;
    overflow: hidden;
    transition: all 0.4s var(--ease);
}

.why-card__icon::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--nk-grad-brand);
    border-radius: 16px;
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 1;
}

.why-card__icon svg {
    width: 28px;
    height: 28px;
    stroke: currentColor;
    stroke-width: 2;
    fill: none;
    position: relative;
    z-index: 2;
    transition: transform 0.4s var(--ease);
}

.why-card:hover .why-card__icon {
    border-color: transparent;
    transform: translateY(-5px);
}

.why-card:hover .why-card__icon::before { opacity: 1; }

.why-card:hover .why-card__icon svg {
    color: #ffffff;
    transform: scale(1.1);
}

.why-card--alt .why-card__icon {
    color: var(--nk-gray-400);
    background: rgba(0, 13, 51, 0.03);
}

.why-card--alt:hover .why-card__icon {
}

.why-card__title {
    font-family: var(--font-display);
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 12px;
    color: var(--nk-gray-900);
}

.why-card__text {
    font-size: 15px;
    color: var(--nk-gray-600);
    line-height: 1.6;
}

/* â”€â”€ Accordion â”€â”€ */
.vac-accordion {
    margin-bottom: 120px;
}

.vac-item {
    background: var(--nk-white);
    border: 1px solid var(--nk-gray-100);
    border-radius: var(--radius-lg);
    margin-bottom: 16px;
    overflow: hidden;
    transition: all 0.3s var(--ease);
}

.vac-item--active {
    border-color: var(--nk-blue);
    box-shadow: 0 10px 30px rgba(0, 68, 204, 0.05);
}

.vac-header {
    padding: 30px 40px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    user-select: none;
}

.vac-header__title {
    font-family: var(--font-display);
    font-size: 20px;
    font-weight: 800;
    color: var(--nk-gray-900);
}

.vac-header__badge {
    font-size: 12px;
    font-weight: 700;
    color: var(--nk-red);
    background: rgba(227, 6, 19, 0.08);
    padding: 6px 14px;
    border-radius: 100px;
    margin-left: 20px;
}

.vac-header__icon {
    transition: transform 0.3s var(--ease);
    color: var(--nk-gray-400);
}

.vac-item--active .vac-header__icon {
    transform: rotate(180deg);
    color: var(--nk-blue);
}

.vac-content {
    padding: 0 40px 40px;
    display: none;
    border-top: 1px solid var(--nk-gray-50);
}

.vac-content__inner {
    padding-top: 30px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}

@media (max-width: 768px) {
    .vac-content__inner { grid-template-columns: 1fr; }
}

.vac-section-title {
    font-family: var(--font-display);
    font-size: 14px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--nk-blue);
    margin-bottom: 16px;
}

.vac-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.vac-list li {
    position: relative;
    padding-left: 24px;
    margin-bottom: 12px;
    font-size: 14px;
    color: var(--nk-gray-600);
}

.vac-list li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 8px;
    width: 6px;
    height: 6px;
    background: var(--nk-red);
    border-radius: 50%;
    box-shadow: 0 0 10px rgba(227,6,19,0.3);
}

/* â”€â”€ Recruitment Stages â”€â”€ */
.stages-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 120px;
}

@media (max-width: 1024px) {
    .stages-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 480px) {
    .stages-grid { grid-template-columns: 1fr; }
}

.stage-item {
    text-align: center;
    position: relative;
}

.stage-item__num {
    width: 60px;
    height: 60px;
    background: var(--nk-white);
    border: 1px solid var(--nk-gray-100);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-family: var(--font-display);
    font-size: 24px;
    font-weight: 900;
    color: var(--nk-blue);
    position: relative;
    z-index: 2;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.stage-item:hover .stage-item__num {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 68, 204, 0.3) !important;
}

.stage-item__title {
    font-family: var(--font-display);
    font-size: 16px;
    font-weight: 800;
    margin-bottom: 8px;
    color: var(--nk-gray-900);
}

.stage-item__text {
    font-size: 14px;
    color: var(--nk-gray-400);
    line-height: 1.5;
}

/* Arrow Connector */
.stage-item:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 30px;
    left: 50%;
    width: 100%;
    height: 1px;
    background: repeating-linear-gradient(90deg, var(--nk-gray-100), var(--nk-gray-100) 4px, transparent 4px, transparent 8px);
    z-index: 1;
}

@media (max-width: 1024px) {
    .stage-item::after { display: none; }
}

/* â”€â”€ Resume Form â”€â”€ */
.resume-section {
    background: var(--nk-grad-dark);
    padding: 100px 0;
    border-radius: var(--radius-xl) var(--radius-xl) 0 0;
    color: var(--nk-white);
}

.resume-form {
    max-width: 700px;
    margin: 0 auto;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 32px;
}

@media (max-width: 600px) {
    .form-grid { grid-template-columns: 1fr; }
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-family: var(--font-display);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(255,255,255,0.5);
}

.form-input {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius-md);
    padding: 14px 18px;
    color: var(--nk-white);
    font-family: var(--font-body);
    font-size: 15px;
    transition: all 0.3s var(--ease);
}

.form-input:focus {
    outline: none;
    background: rgba(255,255,255,0.08);
    border-color: var(--nk-blue-light);
    box-shadow: 0 0 0 4px rgba(17, 102, 255, 0.1);
}

.form-input::placeholder {
    color: rgba(255,255,255,0.2);
}

.file-upload {
    background: rgba(255,255,255,0.03);
    border: 1px dashed rgba(255,255,255,0.2);
    padding: 30px;
    border-radius: var(--radius-lg);
    text-align: center;
    cursor: pointer;
    transition: all 0.3s var(--ease);
}

.file-upload:hover {
    background: rgba(255,255,255,0.05);
    border-color: var(--nk-white);
}

.file-upload svg {
    color: var(--nk-gray-400);
    margin-bottom: 12px;
}

.file-upload div {
    font-size: 14px;
    color: var(--nk-gray-200);
}
</style>

<main class="site-main">

    <!-- â•â•â•â•â•â•â•â•â•â•â• HERO â•â•â•â•â•â•â•â•â•â•â• -->
    <section class="hero hero--internal">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container">
            <div class="hero__content" style="max-width: 850px;">
                <div class="hero__badge">ÐšÐ°Ñ€ÑŒÐµÑ€Ð° Ð² Neksoz</div>
                <h1 class="hero__title">Карьера<br><em>в Neksoz</em></h1>
                <p class="hero__desc" style="max-width: 550px; font-size: 1rem; opacity: 0.9;">
                    ÐœÑ‹ Ð¾Ð±ÑŠÐµÐ´Ð¸Ð½ÑÐµÐ¼ Ñ‚Ð°Ð»Ð°Ð½Ñ‚Ñ‹ Ð´Ð»Ñ ÑÐ¾Ð·Ð´Ð°Ð½Ð¸Ñ Ð¸Ð½Ñ‚ÐµÐ»Ð»ÐµÐºÑ‚ÑƒÐ°Ð»ÑŒÐ½Ñ‹Ñ… Ñ€ÐµÑˆÐµÐ½Ð¸Ð¹ Ð² ÑÑ„ÐµÑ€Ðµ Ð°ÑƒÐ´Ð¸Ñ‚Ð°, Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð² Ð¸ Ð¿Ñ€Ð°Ð²Ð°. Ð¡Ñ‚Ð°Ð½ÑŒÑ‚Ðµ Ñ‡Ð°ÑÑ‚ÑŒÑŽ ÐºÐ¾Ð¼Ð°Ð½Ð´Ñ‹, ÐºÐ¾Ñ‚Ð¾Ñ€Ð°Ñ Ð·Ð°Ð´Ð°ÐµÑ‚ ÑÑ‚Ð°Ð½Ð´Ð°Ñ€Ñ‚Ñ‹ ÐºÐ°Ñ‡ÐµÑÑ‚Ð²Ð° Ð² Ð¢Ð°Ð´Ð¶Ð¸ÐºÐ¸ÑÑ‚Ð°Ð½Ðµ.
                </p>
            </div>

            <div class="hero__actions--right">
                <a href="#vacancies" class="btn btn--primary btn-animated">
                    ÐžÑ‚ÐºÑ€Ñ‹Ñ‚Ñ‹Ðµ Ð²Ð°ÐºÐ°Ð½ÑÐ¸Ð¸
                    <svg class="btn__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>

            </div>
        </div>
    </section>

    <!-- â•â•â•â•â•â•â•â•â•â•â• WHY US â•â•â•â•â•â•â•â•â•â•â• -->
    <section class="section">
        <div class="container vac-container">
            <div class="section__header section__header--center fade-up" style="margin-bottom: 80px;">
                <div class="section__label">ÐŸÑ€ÐµÐ¸Ð¼ÑƒÑ‰ÐµÑÑ‚Ð²Ð°</div>
                <h2 class="section__title">ÐŸÐ¾Ñ‡ÐµÐ¼Ñƒ Ð²Ñ‹Ð±Ð¸Ñ€Ð°ÑŽÑ‚ Neksoz?</h2>
                <p class="section__subtitle" style="color:var(--nk-gray-400);">Ð˜Ð½Ð²ÐµÑÑ‚Ð¸Ñ†Ð¸Ð¸ Ð² Ð²Ð°Ñˆ Ð¸Ð½Ñ‚ÐµÐ»Ð»ÐµÐºÑ‚ Ð¸ ÐºÐ°Ñ€ÑŒÐµÑ€Ñƒ â€” Ð½Ð°Ñˆ Ð³Ð»Ð°Ð²Ð½Ñ‹Ð¹ Ð¿Ñ€Ð¸Ð¾Ñ€Ð¸Ñ‚ÐµÑ‚.</p>
            </div>

            <div class="why-cards">
                <!-- Info 1 -->
                <div class="why-card fade-up">
                    <div class="why-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 2v20m10-10H2"/></svg>
                    </div>
                    <h3 class="why-card__title">Ð­ÐºÑÐ¿ÐµÑ€Ñ‚Ð½Ð°Ñ ÑÑ€ÐµÐ´Ð°</h3>
                    <p class="why-card__text">Ð Ð°Ð±Ð¾Ñ‚Ð° Ð¿Ð»ÐµÑ‡Ð¾Ð¼ Ðº Ð¿Ð»ÐµÑ‡Ñƒ Ñ Ð°Ñ‚Ñ‚ÐµÑÑ‚Ð¾Ð²Ð°Ð½Ð½Ñ‹Ð¼Ð¸ Ð°ÑƒÐ´Ð¸Ñ‚Ð¾Ñ€Ð°Ð¼Ð¸ Ð¸ Ð²ÐµÐ´ÑƒÑ‰Ð¸Ð¼Ð¸ ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð°Ð½Ñ‚Ð°Ð¼Ð¸ Ñ€Ñ‹Ð½ÐºÐ° Ð Ð¢.</p>
                </div>
                <!-- Info 2 -->
                <div class="why-card fade-up" style="animation-delay: 0.1s;">
                    <div class="why-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <h3 class="why-card__title">ÐšÐ°Ñ€ÑŒÐµÑ€Ð½Ð°Ñ Ñ‚Ñ€Ð°ÐµÐºÑ‚Ð¾Ñ€Ð¸Ñ</h3>
                    <p class="why-card__text">ÐŸÐ¾Ð½ÑÑ‚Ð½Ñ‹Ð¹ Ð¸ Ð¿Ñ€Ð¾Ð·Ñ€Ð°Ñ‡Ð½Ñ‹Ð¹ Ð¿ÑƒÑ‚ÑŒ Ð¾Ñ‚ Ð°ÑÑÐ¸ÑÑ‚ÐµÐ½Ñ‚Ð° Ð´Ð¾ Ð²ÐµÐ´ÑƒÑ‰ÐµÐ³Ð¾ ÑÐºÑÐ¿ÐµÑ€Ñ‚Ð° Ð¸Ð»Ð¸ Ñ€ÑƒÐºÐ¾Ð²Ð¾Ð´Ð¸Ñ‚ÐµÐ»Ñ Ð½Ð°Ð¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¸Ñ.</p>
                </div>
                <!-- Info 3 -->
                <div class="why-card fade-up" style="animation-delay: 0.15s;">
                    <div class="why-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <h3 class="why-card__title">Ð˜Ð½Ð²ÐµÑÑ‚Ð¸Ñ†Ð¸Ð¸ Ð² Ð·Ð½Ð°Ð½Ð¸Ñ</h3>
                    <p class="why-card__text">ÐœÑ‹ Ð¾Ð¿Ð»Ð°Ñ‡Ð¸Ð²Ð°ÐµÐ¼ Ð¿Ñ€Ð¾Ñ„Ð¸Ð»ÑŒÐ½Ð¾Ðµ Ð¾Ð±ÑƒÑ‡ÐµÐ½Ð¸Ðµ Ð¸ Ð¼ÐµÐ¶Ð´ÑƒÐ½Ð°Ñ€Ð¾Ð´Ð½ÑƒÑŽ ÑÐµÑ€Ñ‚Ð¸Ñ„Ð¸ÐºÐ°Ñ†Ð¸ÑŽ Ð´Ð»Ñ Ð»ÑƒÑ‡ÑˆÐ¸Ñ… ÑÐ¾Ñ‚Ñ€ÑƒÐ´Ð½Ð¸ÐºÐ¾Ð².</p>
                </div>
                <!-- Info 4 -->
                <div class="why-card fade-up" style="animation-delay: 0.2s;">
                    <div class="why-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    </div>
                    <h3 class="why-card__title">Ð¢ÐµÑ…Ð½Ð¾Ð»Ð¾Ð³Ð¸Ñ‡Ð½Ð¾ÑÑ‚ÑŒ</h3>
                    <p class="why-card__text">Ð Ð°Ð±Ð¾Ñ‚Ð° Ð² ÑÐ¾Ð²Ñ€ÐµÐ¼ÐµÐ½Ð½Ñ‹Ñ… ÑÐ¸ÑÑ‚ÐµÐ¼Ð°Ñ… (1Ð¡, Bitrix24) Ð¸ Ð¸ÑÐ¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ð½Ð¸Ðµ Ð¿ÐµÑ€ÐµÐ´Ð¾Ð²Ñ‹Ñ… AI-Ð¸Ð½ÑÑ‚Ñ€ÑƒÐ¼ÐµÐ½Ñ‚Ð¾Ð².</p>
                </div>
                <!-- Info 5 -->
                <div class="why-card fade-up" style="animation-delay: 0.25s;">
                    <div class="why-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <h3 class="why-card__title">ÐžÑ„Ð¸Ñ ÐºÐ»Ð°ÑÑÐ° Â«ÐÂ»</h3>
                    <p class="why-card__text">ÐšÐ¾Ð¼Ñ„Ð¾Ñ€Ñ‚Ð½Ð¾Ðµ Ñ€Ð°Ð±Ð¾Ñ‡ÐµÐµ Ð¿Ñ€Ð¾ÑÑ‚Ñ€Ð°Ð½ÑÑ‚Ð²Ð¾ Ð² ÑÐ°Ð¼Ð¾Ð¼ ÑÐµÑ€Ð´Ñ†Ðµ ÑÑ‚Ð¾Ð»Ð¸Ñ†Ñ‹ (Ð¿Ñ€. Ð ÑƒÐ´Ð°ÐºÐ¸ 55).</p>
                </div>
            </div>

            <!-- â•â•â•â•â•â•â•â•â•â•â• VACANCIES â•â•â•â•â•â•â•â•â•â•â• -->
            <div id="vacancies" class="section__header fade-up">
                <div class="section__label">ÐÐºÑ‚ÑƒÐ°Ð»ÑŒÐ½Ð¾</div>
                <h2 class="section__title">ÐžÑ‚ÐºÑ€Ñ‹Ñ‚Ñ‹Ðµ Ð²Ð°ÐºÐ°Ð½ÑÐ¸Ð¸</h2>
            </div>

            <div class="vac-accordion fade-up">
                <!-- Item 1 -->
                <div class="vac-item">
                    <div class="vac-header">
                        <div style="display: flex; align-items: center;">
                            <span class="vac-header__title">ÐŸÐ¾Ð¼Ð¾Ñ‰Ð½Ð¸Ðº Ð±ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€Ð° (Junior Accountant)</span>
                            <span class="vac-header__badge">Full-time</span>
                        </div>
                        <svg class="vac-header__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                    </div>
                    <div class="vac-content">
                        <div class="vac-content__inner">
                            <div>
                                <h4 class="vac-section-title">Ðž Ð¿Ð¾Ð·Ð¸Ñ†Ð¸Ð¸</h4>
                                <p style="font-size: 15px; color: var(--nk-gray-600); margin-bottom: 24px;">ÐœÑ‹ Ð¸Ñ‰ÐµÐ¼ ÑÐ¿ÐµÑ†Ð¸Ð°Ð»Ð¸ÑÑ‚Ð°, Ð³Ð¾Ñ‚Ð¾Ð²Ð¾Ð³Ð¾ Ðº Ð¸Ð½Ñ‚ÐµÐ½ÑÐ¸Ð²Ð½Ð¾Ð¼Ñƒ Ð¾Ð±ÑƒÑ‡ÐµÐ½Ð¸ÑŽ Ð¸ ÑÑ‚Ñ€ÐµÐ¼ÑÑ‰ÐµÐ³Ð¾ÑÑ Ð¾ÑÐ²Ð¾Ð¸Ñ‚ÑŒ Ð²ÑÐµ Ñ‚Ð¾Ð½ÐºÐ¾ÑÑ‚Ð¸ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ð¾Ð³Ð¾ ÑƒÑ‡ÐµÑ‚Ð° Ð¿Ð¾Ð´ Ñ€ÑƒÐºÐ¾Ð²Ð¾Ð´ÑÑ‚Ð²Ð¾Ð¼ Ð½Ð°ÑÑ‚Ð°Ð²Ð½Ð¸ÐºÐ¾Ð².</p>
                                
                                <h4 class="vac-section-title">Ð’Ð°ÑˆÐ¸ Ð·Ð°Ð´Ð°Ñ‡Ð¸</h4>
                                <ul class="vac-list">
                                    <li>ÐžÐ±Ñ€Ð°Ð±Ð¾Ñ‚ÐºÐ° Ð¸ ÑÐ¸ÑÑ‚ÐµÐ¼Ð°Ñ‚Ð¸Ð·Ð°Ñ†Ð¸Ñ Ð¿ÐµÑ€Ð²Ð¸Ñ‡Ð½Ð¾Ð¹ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð°Ñ†Ð¸Ð¸</li>
                                    <li>Ð¡Ð¾Ð¿Ñ€Ð¾Ð²Ð¾Ð¶Ð´ÐµÐ½Ð¸Ðµ Ð¾Ð¿ÐµÑ€Ð°Ñ†Ð¸Ð¹ Ð² ÑÐ¸ÑÑ‚ÐµÐ¼Ðµ Â«ÐšÐ»Ð¸ÐµÐ½Ñ‚-Ð‘Ð°Ð½ÐºÂ»</li>
                                    <li>Ð’ÐµÐ´ÐµÐ½Ð¸Ðµ ÐºÐ°ÑÑÐ¾Ð²Ð¾Ð¹ Ð´Ð¸ÑÑ†Ð¸Ð¿Ð»Ð¸Ð½Ñ‹ Ð¸ ÐºÐ¾Ð½Ñ‚Ñ€Ð¾Ð»ÑŒ Ð¾Ð¿ÐµÑ€Ð°Ñ†Ð¸Ð¹</li>
                                    <li>Ð Ð°Ð±Ð¾Ñ‚Ð° Ð² 1Ð¡ 8.3 Ð¸ Ð²Ð½ÐµÑÐµÐ½Ð¸Ðµ Ð´Ð°Ð½Ð½Ñ‹Ñ… Ð² CRM-ÑÐ¸ÑÑ‚ÐµÐ¼Ñƒ</li>
                                    <li>ÐŸÐ¾Ð´Ð³Ð¾Ñ‚Ð¾Ð²ÐºÐ° Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð¾Ð² Ð´Ð»Ñ Ð°Ñ€Ñ…Ð¸Ð²Ð½Ð¾Ð³Ð¾ Ñ…Ñ€Ð°Ð½ÐµÐ½Ð¸Ñ</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="vac-section-title">ÐÐ°ÑˆÐ¸ Ð¾Ð¶Ð¸Ð´Ð°Ð½Ð¸Ñ</h4>
                                <ul class="vac-list">
                                    <li>Ð’Ñ‹ÑÑˆÐµÐµ Ð¸Ð»Ð¸ Ð½ÐµÐ¾ÐºÐ¾Ð½Ñ‡ÐµÐ½Ð½Ð¾Ðµ Ð¿Ñ€Ð¾Ñ„Ð¸Ð»ÑŒÐ½Ð¾Ðµ Ð¾Ð±Ñ€Ð°Ð·Ð¾Ð²Ð°Ð½Ð¸Ðµ (Ð­ÐºÐ¾Ð½Ð¾Ð¼Ð¸ÐºÐ°)</li>
                                    <li>Ð‘Ð°Ð·Ð¾Ð²Ñ‹Ðµ Ð·Ð½Ð°Ð½Ð¸Ñ Ð±ÑƒÑ…ÑƒÑ‡ÐµÑ‚Ð° Ð¸ Ð¶ÐµÐ»Ð°Ð½Ð¸Ðµ Ñ€Ð°Ð·Ð²Ð¸Ð²Ð°Ñ‚ÑŒÑÑ</li>
                                    <li>Ð’Ñ‹ÑÐ¾ÐºÐ°Ñ ÐºÐ¾Ð½Ñ†ÐµÐ½Ñ‚Ñ€Ð°Ñ†Ð¸Ñ Ð²Ð½Ð¸Ð¼Ð°Ð½Ð¸Ñ Ð¸ Ð»ÑŽÐ±Ð¾Ð²ÑŒ Ðº Ñ†Ð¸Ñ„Ñ€Ð°Ð¼</li>
                                    <li>Ð’Ð»Ð°Ð´ÐµÐ½Ð¸Ðµ Ñ€ÑƒÑÑÐºÐ¸Ð¼ Ð¸ Ñ‚Ð°Ð´Ð¶Ð¸ÐºÑÐºÐ¸Ð¼ ÑÐ·Ñ‹ÐºÐ°Ð¼Ð¸</li>
                                </ul>

                                <h4 class="vac-section-title" style="margin-top: 30px;">Ð£ÑÐ»Ð¾Ð²Ð¸Ñ</h4>
                                <ul class="vac-list">
                                    <li>Ð“Ñ€Ð°Ñ„Ð¸Ðº: 08:00 â€” 17:00 (5/2)</li>
                                    <li>ÐŸÐ¾ÑÑ‚Ð°Ð¿Ð½Ñ‹Ð¹ Ð²Ð²Ð¾Ð´ Ð² Ð¿Ñ€Ð¾Ñ„ÐµÑÑÐ¸ÑŽ</li>
                                    <li>ÐžÑ„Ð¸Ñ Ð² Ñ†ÐµÐ½Ñ‚Ñ€Ðµ Ð³Ð¾Ñ€Ð¾Ð´Ð°</li>
                                </ul>
                            </div>
                        </div>
                        <div style="margin-top: 40px; text-align: right;">
                            <a href="#apply" class="btn btn--blue" style="padding: 12px 28px; font-size: 11px;">ÐžÑ‚ÐºÐ»Ð¸ÐºÐ½ÑƒÑ‚ÑŒÑÑ Ð½Ð° Ð²Ð°ÐºÐ°Ð½ÑÐ¸ÑŽ</a>
                        </div>
                    </div>
                </div>

                <!-- Reserve Info -->
                <div class="simple-card fade-up" style="background: var(--nk-gray-50); border: 1px dashed var(--nk-gray-200); margin-top: 40px; text-align: center;">
                    <h4 style="font-family: var(--font-display); margin-bottom: 15px;">ÐÐµ Ð½Ð°ÑˆÐ»Ð¸ Ð¿Ð¾Ð´Ñ…Ð¾Ð´ÑÑ‰ÑƒÑŽ Ð²Ð°ÐºÐ°Ð½ÑÐ¸ÑŽ?</h4>
                    <p style="color: var(--nk-gray-600); max-width: 600px; margin: 0 auto 24px;">ÐœÑ‹ Ð²ÑÐµÐ³Ð´Ð° Ð·Ð°Ð¸Ð½Ñ‚ÐµÑ€ÐµÑÐ¾Ð²Ð°Ð½Ñ‹ Ð² ÑÐ¸Ð»ÑŒÐ½Ñ‹Ñ… Ð°ÑƒÐ´Ð¸Ñ‚Ð¾Ñ€Ð°Ñ…, ÑŽÑ€Ð¸ÑÑ‚Ð°Ñ… Ð¸ ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð°Ð½Ñ‚Ð°Ñ…. Ð•ÑÐ»Ð¸ Ð²Ñ‹ Ð¿Ñ€Ð¾Ñ„ÐµÑÑÐ¸Ð¾Ð½Ð°Ð» ÑÐ²Ð¾ÐµÐ³Ð¾ Ð´ÐµÐ»Ð° â€” Ð¾Ñ‚Ð¿Ñ€Ð°Ð²ÑŒÑ‚Ðµ Ñ€ÐµÐ·ÑŽÐ¼Ðµ, Ð¸ Ð¼Ñ‹ ÑÐ²ÑÐ¶ÐµÐ¼ÑÑ Ñ Ð²Ð°Ð¼Ð¸.</p>
                    <a href="mailto:info@Neksoz.tj" style="font-weight: 800; color: var(--nk-blue); text-decoration: underline;">info@Neksoz.tj</a>
                </div>
            </div>

            <!-- â•â•â•â•â•â•â•â•â•â•â• STEPS â•â•â•â•â•â•â•â•â•â•â• -->
            <div class="section__header section__header--center fade-up">
                <div class="section__label">ÐŸÑ€Ð¾Ñ†ÐµÑÑ</div>
                <h2 class="section__title">Ð­Ñ‚Ð°Ð¿Ñ‹ Ð¾Ñ‚Ð±Ð¾Ñ€Ð°</h2>
            </div>

            <div class="stages-grid fade-up">
                <div class="stage-item">
                    <div class="stage-item__num" style="background: var(--nk-grad-brand); color: white; border: none; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">1</div>
                    <h3 class="stage-item__title">Ð ÐµÐ·ÑŽÐ¼Ðµ</h3>
                    <p class="stage-item__text">Ð˜Ð·ÑƒÑ‡Ð°ÐµÐ¼ Ð²Ð°Ñˆ Ð¾Ð¿Ñ‹Ñ‚ Ð² Ñ‚ÐµÑ‡ÐµÐ½Ð¸Ðµ 2-3 Ð´Ð½ÐµÐ¹.</p>
                </div>
                <div class="stage-item">
                    <div class="stage-item__num" style="background: var(--nk-grad-brand); color: white; border: none; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">2</div>
                    <h3 class="stage-item__title">Ð¢ÐµÑÑ‚Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ðµ</h3>
                    <p class="stage-item__text">ÐšÐ¾Ñ€Ð¾Ñ‚ÐºÐ¾Ðµ Ð·Ð°Ð´Ð°Ð½Ð¸Ðµ Ð½Ð° Ð»Ð¾Ð³Ð¸ÐºÑƒ Ð¸Ð»Ð¸ Ð·Ð½Ð°Ð½Ð¸Ñ.</p>
                </div>
                <div class="stage-item">
                    <div class="stage-item__num" style="background: var(--nk-grad-brand); color: white; border: none; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">3</div>
                    <h3 class="stage-item__title">Ð˜Ð½Ñ‚ÐµÑ€Ð²ÑŒÑŽ</h3>
                    <p class="stage-item__text">Ð—Ð½Ð°ÐºÐ¾Ð¼ÑÑ‚Ð²Ð¾ Ñ HR Ð¸ Ñ€ÑƒÐºÐ¾Ð²Ð¾Ð´Ð¸Ñ‚ÐµÐ»ÐµÐ¼.</p>
                </div>
                <div class="stage-item">
                    <div class="stage-item__num" style="background: var(--nk-grad-brand); color: white; border: none; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">4</div>
                    <h3 class="stage-item__title">Welcome-day</h3>
                    <p class="stage-item__text">Ð”Ð¾Ð±Ñ€Ð¾ Ð¿Ð¾Ð¶Ð°Ð»Ð¾Ð²Ð°Ñ‚ÑŒ Ð² Neksoz!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- â•â•â•â•â•â•â•â•â•â•â• FORM SECTION (CRYSTAL STYLE) â•â•â•â•â•â•â•â•â•â•â• -->
    <section id="apply" class="section cta-crystal" style="padding: 120px 0; background: var(--nk-gray-50); position: relative; overflow: hidden;">
        <div class="cta-crystal__glow cta-crystal__glow--blue"></div>
        <div class="cta-crystal__glow cta-crystal__glow--red"></div>

        <div class="container fade-up" style="position: relative; z-index: 5;">
            <div class="section__header section__header--center">
                <div class="section__label">ÐÐ½ÐºÐµÑ‚Ð° ÐºÐ°Ð½Ð´Ð¸Ð´Ð°Ñ‚Ð°</div>
                <h2 class="section__title">ÐŸÑ€Ð¸ÑÐ¾ÐµÐ´Ð¸Ð½ÑÐ¹Ñ‚ÐµÑÑŒ Ðº ÐºÐ¾Ð¼Ð°Ð½Ð´Ðµ</h2>
                <p class="section__subtitle">Ð—Ð°Ð¿Ð¾Ð»Ð½Ð¸Ñ‚Ðµ Ð°Ð½ÐºÐµÑ‚Ñƒ Ð¸ Ð¿Ñ€Ð¸ÐºÑ€ÐµÐ¿Ð¸Ñ‚Ðµ Ð²Ð°ÑˆÐµ Ñ€ÐµÐ·ÑŽÐ¼Ðµ. ÐœÑ‹ ÑÐ²ÑÐ¶ÐµÐ¼ÑÑ Ñ Ð²Ð°Ð¼Ð¸ Ð´Ð»Ñ Ð½Ð°Ð·Ð½Ð°Ñ‡ÐµÐ½Ð¸Ñ Ð¸Ð½Ñ‚ÐµÑ€Ð²ÑŒÑŽ.</p>
            </div>

            <div style="max-width: 800px; margin: 0 auto; background: rgba(255, 255, 255, 0.8); border: 1px solid rgba(0, 13, 51, 0.05); border-radius: 32px; padding: 60px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.06); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);">
                <form action="#" class="cta-crystal__form">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="app-name">
                            <label for="app-name">Ð¤Ð˜Ðž</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="email" placeholder=" " required id="app-email">
                            <label for="app-email">Ð­Ð». Ð¿Ð¾Ñ‡Ñ‚Ð°</label>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="app-phone">
                            <label for="app-phone">ÐÐ¾Ð¼ÐµÑ€ Ñ‚ÐµÐ»ÐµÑ„Ð¾Ð½Ð°</label>
                        </div>
                        <div class="cta-crystal__field nx-dropdown" id="vacPositionDropdown">
                            <input type="text" placeholder=" " required id="app-position" class="nx-dropdown__trigger" readonly>
                            <label for="app-position">Ð–ÐµÐ»Ð°ÐµÐ¼Ð°Ñ Ð¿Ð¾Ð·Ð¸Ñ†Ð¸Ñ <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px; display: inline-block;"><path d="m6 9 6 6 6-6"/></svg></label>
                            <div class="nx-dropdown__panel">
                                <div class="nx-dropdown__option">ÐŸÐ¾Ð¼Ð¾Ñ‰Ð½Ð¸Ðº Ð±ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€Ð°</div>
                                <div class="nx-dropdown__option">ÐÑƒÐ´Ð¸Ñ‚Ð¾Ñ€</div>
                                <div class="nx-dropdown__option">Ð®Ñ€Ð¸ÑÑ‚</div>
                                <div class="nx-dropdown__option">Ð”Ñ€ÑƒÐ³Ð¾Ðµ</div>
                            </div>
                        </div>
                    </div>

                    <div class="cta-crystal__field" style="margin-bottom: 32px;">
                        <textarea placeholder=" " id="app-message" style="width: 100%; min-height: 100px; padding: 25px 30px; border: 2px solid var(--nk-gray-100); border-radius: 16px; background: transparent; transition: all 0.3s var(--ease);"></textarea>
                        <label for="app-message">Ð”Ð¾Ð¿Ð¾Ð»Ð½Ð¸Ñ‚ÐµÐ»ÑŒÐ½Ð°Ñ Ð¸Ð½Ñ„Ð¾Ñ€Ð¼Ð°Ñ†Ð¸Ñ / Ðž ÑÐµÐ±Ðµ</label>
                    </div>

                    <!-- Crystal File Upload -->
                    <div style="margin-bottom: 40px;">
                        <label style="display: block; font-family: var(--font-display); font-size: 14px; font-weight: 800; color: var(--nk-gray-900); margin-bottom: 16px;">Ð ÐµÐ·ÑŽÐ¼Ðµ (PDF / DOCX)</label>
                        <div class="file-upload" style="background: rgba(0, 13, 51, 0.02); border: 2px dashed var(--nk-gray-200); padding: 40px; border-radius: 20px; transition: all 0.3s var(--ease);">
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 12px; color: var(--nk-gray-400);">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4m4-10 5-5 5 5m-5-5v12"/></svg>
                                <span style="font-size: 14px; font-weight: 500;">ÐÐ°Ð¶Ð¼Ð¸Ñ‚Ðµ Ð´Ð»Ñ Ð²Ñ‹Ð±Ð¾Ñ€Ð° Ñ„Ð°Ð¹Ð»Ð° Ð¸Ð»Ð¸ Ð¿ÐµÑ€ÐµÑ‚Ð°Ñ‰Ð¸Ñ‚Ðµ ÐµÐ³Ð¾ ÑÑŽÐ´Ð°</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="cta-crystal__btn"><span>ÐžÑ‚Ð¿Ñ€Ð°Ð²Ð¸Ñ‚ÑŒ Ð¾Ñ‚ÐºÐ»Ð¸Ðº</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
                    
                    <p style="font-size: 11px; color: var(--nk-gray-400); text-align: center; margin-top: 24px; opacity: 0.7;">
                        ÐÐ°Ð¶Ð¸Ð¼Ð°Ñ Ð½Ð° ÐºÐ½Ð¾Ð¿ÐºÑƒ, Ð²Ñ‹ Ð´Ð°ÐµÑ‚Ðµ ÑÐ¾Ð³Ð»Ð°ÑÐ¸Ðµ Ð½Ð° Ð¾Ð±Ñ€Ð°Ð±Ð¾Ñ‚ÐºÑƒ Ð¿ÐµÑ€ÑÐ¾Ð½Ð°Ð»ÑŒÐ½Ñ‹Ñ… Ð´Ð°Ð½Ð½Ñ‹Ñ….
                    </p>
                </form>
            </div>
        </div>
    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Accordion Logic
    const accHeaders = document.querySelectorAll('.vac-header');
    accHeaders.forEach(header => {
        header.addEventListener('click', () => {
            const item = header.parentElement;
            const content = item.querySelector('.vac-content');
            const isActive = item.classList.contains('vac-item--active');
            
            if (isActive) {
                item.classList.remove('vac-item--active');
                content.style.display = 'none';
            } else {
                // Close others if you want, but user might want multiple open
                item.classList.add('vac-item--active');
                content.style.display = 'block';
            }
        });
    });

    // Dropdown Logic for Vacancies
    const drp = document.getElementById('vacPositionDropdown');
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

    // Fade-up observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    document.querySelectorAll('.fade-up').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.8s var(--ease)';
        observer.observe(el);
    });
});
</script>

<?php get_footer(); ?>

