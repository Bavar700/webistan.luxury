<?php
/**
 * Template Name: Ðž Ð½Ð°Ñ
 */
get_header();
?>

<style>
/* â”€â”€ Flat About Cards â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.about-card {
    background: var(--nk-white);
    padding: 50px 40px;
    border-radius: 20px;
    border: 1px solid rgba(0, 13, 51, 0.05);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
    gap: 20px;
    height: 100%;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 13, 51, 0.015);
    isolation: isolate;
}
.about-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(0, 13, 51, 0.06);
    border-color: rgba(0, 68, 204, 0.15);
}
.about-card__num {
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--nk-red);
    margin-bottom: 4px;
}
.about-card__icon {
    width: 60px;
    height: 60px;
    margin-bottom: 8px;
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
.about-card__icon::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--nk-grad-brand);
    border-radius: 16px;
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 1;
}
.about-card__icon svg {
    width: 28px;
    height: 28px;
    stroke: currentColor;
    stroke-width: 2;
    fill: none;
    position: relative;
    z-index: 2;
    transition: transform 0.4s var(--ease);
}
.about-card:hover .about-card__icon {
    border-color: transparent;
    transform: translateY(-5px);
}
.about-card:hover .about-card__icon::before { opacity: 1; }
.about-card:hover .about-card__icon svg {
    color: #ffffff;
    transform: scale(1.1);
}
.about-card__title {
    font-size: 20px;
    font-weight: 700;
    color: var(--nk-gray-900);
    line-height: 1.3;
    margin: 0;
}
.about-card__body {
    color: var(--nk-gray-600);
    line-height: 1.7;
    font-size: 15px;
    flex: 1;
}
.about-card__list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    gap: 10px;
}
.about-card__list li {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    color: var(--nk-gray-700);
    font-size: 14px;
    line-height: 1.5;
}
.about-card__list li::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--nk-red);
    flex-shrink: 0;
    margin-top: 6px;
}
.about-tags {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: 4px;
}
.about-tag {
    font-size: 11px;
    font-weight: 700;
    padding: 4px 12px;
    background: rgba(239,68,68,0.07);
    border-radius: 20px;
    color: var(--nk-red);
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

/* â”€â”€ Stats cards â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.about-stat {
    background: #fff;
    border: 1px solid rgba(0,13,51,0.07);
    border-radius: 20px;
    padding: 40px 24px;
    text-align: center;
    transition: transform 0.32s ease, box-shadow 0.32s ease, border-color 0.32s ease;
}
.about-stat:hover {
    transform: translateY(-6px);
    box-shadow: 0 24px 60px rgba(0,13,51,0.10);
    border-color: rgba(0,68,204,0.18);
}
.about-stat__num {
    font-size: 52px;
    font-weight: 900;
    line-height: 1;
    letter-spacing: -0.03em;
    color: var(--nk-blue);
    font-family: var(--font-display);
}
.about-stat__num em {
    color: var(--nk-red);
    font-style: normal;
}
.about-stat__label {
    margin-top: 14px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--nk-gray-400);
}
</style>

<main class="site-main">

    <!-- â•â•â•â•â•â•â•â•â•â•â• CINEMATIC HERO â•â•â•â•â•â•â•â•â•â•â• -->
    <section class="hero hero--internal">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container" style="position:relative;z-index:2;">
            <div class="hero__content">
                <div class="hero__badge">Ðž ÐºÐ¾Ð¼Ð¿Ð°Ð½Ð¸Ð¸</div>
                <h1 class="hero__title">Успех<br><em>вашего бизнеса</em></h1>
                <p class="hero__desc">
                    Ð¡Ñ‚Ñ€Ð°Ñ‚ÐµÐ³Ð¸Ñ‡ÐµÑÐºÐ¸Ð¹ Ð¿Ð°Ñ€Ñ‚Ð½ÐµÑ€ Ð¸ ÑÐºÑÐ¿ÐµÑ€Ñ‚Ð½Ñ‹Ð¹ Ñ…Ð°Ð±, Ñ‚Ñ€Ð°Ð½ÑÑ„Ð¾Ñ€Ð¼Ð¸Ñ€ÑƒÑŽÑ‰Ð¸Ð¹ Ð¾Ð¿Ñ‹Ñ‚ Ð² Ð°ÑƒÐ´Ð¸Ñ‚Ðµ Ð¸ Ð¿Ñ€Ð°Ð²Ðµ Ð² Ñ€ÐµÐ°Ð»ÑŒÐ½ÑƒÑŽ Ñ†ÐµÐ½Ð½Ð¾ÑÑ‚ÑŒ Ð´Ð»Ñ Ð»Ð¾ÐºÐ°Ð»ÑŒÐ½Ð¾Ð³Ð¾ Ð¸ Ð¼ÐµÐ¶Ð´ÑƒÐ½Ð°Ñ€Ð¾Ð´Ð½Ð¾Ð³Ð¾ Ð±Ð¸Ð·Ð½ÐµÑÐ° Ð² Ð¢Ð°Ð´Ð¶Ð¸ÐºÐ¸ÑÑ‚Ð°Ð½Ðµ.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/team'); ?>" class="btn btn--primary btn-animated">
                    ÐŸÐ¾Ð·Ð½Ð°ÐºÐ¾Ð¼Ð¸Ñ‚ÑŒÑÑ Ñ ÐºÐ¾Ð¼Ð°Ð½Ð´Ð¾Ð¹
                    <svg class="btn__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- â•â•â•â•â•â•â•â•â•â•â• SECTION: Ð˜Ð¡Ð¢ÐžÐ Ð˜Ð¯ â•â•â•â•â•â•â•â•â•â•â• -->
    <section class="section" style="padding-top: 80px; padding-bottom: 80px;">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">ÐžÑÐ½Ð¾Ð²Ð°Ð½Ð° Ð² 2016 Ð³Ð¾Ð´Ñƒ</div>
                <h2 class="section__title">ÐÐ°Ñˆ Ñ„ÑƒÐ½Ð´Ð°Ð¼ÐµÐ½Ñ‚: ÐžÐ¿Ñ‹Ñ‚,<br>Ð¿Ñ€Ð¾Ð²ÐµÑ€ÐµÐ½Ð½Ñ‹Ð¹ Ð²Ñ€ÐµÐ¼ÐµÐ½ÐµÐ¼</h2>
                <p class="section__subtitle">Ð—Ð° <?php echo (date('Y') - 2016); ?> Ð»ÐµÑ‚ Ñ€Ð°Ð±Ð¾Ñ‚Ñ‹ Ð½Ð° Ñ€Ñ‹Ð½ÐºÐµ Ð¢Ð°Ð´Ð¶Ð¸ÐºÐ¸ÑÑ‚Ð°Ð½Ð° Ð¼Ñ‹ Ð¿Ñ€Ð¾ÑˆÐ»Ð¸ Ð¿ÑƒÑ‚ÑŒ Ð¾Ñ‚ Ð°Ð¼Ð±Ð¸Ñ†Ð¸Ð¾Ð·Ð½Ð¾Ð¹ ÐºÐ¾Ð¼Ð°Ð½Ð´Ñ‹ Ð´Ð¾ Ð¿Ñ€Ð¸Ð·Ð½Ð°Ð½Ð½Ð¾Ð³Ð¾ Ð»Ð¸Ð´ÐµÑ€Ð° Ð² Ð¾Ð±Ð»Ð°ÑÑ‚Ð¸ Ð±ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€ÑÐºÐ¾Ð³Ð¾ ÐºÐ¾Ð½ÑÐ°Ð»Ñ‚Ð¸Ð½Ð³Ð° Ð² Ð¢Ð°Ð´Ð¶Ð¸ÐºÐ¸ÑÑ‚Ð°Ð½Ðµ.</p>
            </div>

            <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:30px;">

                <!-- Card 1: Ð˜ÑÑ‚Ð¾Ñ€Ð¸Ñ -->
                <div class="about-card fade-up">
                    <div class="about-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h3 class="about-card__title">ÐšÐ¾Ð¼Ð¿Ð°Ð½Ð¸Ñ Ð¾ÑÐ½Ð¾Ð²Ð°Ð½Ð° Ð² 2016 Ð³Ð¾Ð´Ñƒ</h3>
                    <p class="about-card__body">ÐžÐžÐž Â«ÐÐ•ÐšÐ¡ÐžÐ—-Ð‘Ð˜Ð—ÐÐ•Ð¡ ÐšÐžÐÐ¡ÐÐ›Ð¢Ð˜ÐÐ“ Ð“Ð Ð£ÐŸÂ» Ð±Ñ‹Ð»Ð° ÑÐ¾Ð·Ð´Ð°Ð½Ð° Ð² <strong>2016 Ð³Ð¾Ð´Ñƒ</strong> ÑÐºÑÐ¿ÐµÑ€Ñ‚Ð°Ð¼Ð¸, ÑƒÐ¶Ðµ Ð¸Ð¼ÐµÑŽÑ‰Ð¸Ð¼Ð¸ Ð·Ð½Ð°Ñ‡Ð¸Ñ‚ÐµÐ»ÑŒÐ½Ñ‹Ð¹ Ð¾Ð¿Ñ‹Ñ‚ Ð² ÑÑ„ÐµÑ€Ðµ Ð½Ð°Ð»Ð¾Ð³Ð¾Ð¾Ð±Ð»Ð¾Ð¶ÐµÐ½Ð¸Ñ, Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ð¾Ð³Ð¾ ÑƒÑ‡Ñ‘Ñ‚Ð°, Ð±Ð°Ð½ÐºÐ¾Ð²ÑÐºÐ¾Ð³Ð¾ Ð´ÐµÐ»Ð° Ð¸ Ð°ÑƒÐ´Ð¸Ñ‚Ð°.</p></p>
                    <p class="about-card__body" style="margin-top:-4px;">ÐœÑ‹ Ð½Ðµ Ð¿Ñ€Ð¾ÑÑ‚Ð¾ Â«Ð²ÐµÐ´ÐµÐ¼ ÑƒÑ‡ÐµÑ‚Â» â€” Ð¼Ñ‹ Ð²Ñ‹ÑÑ‚Ñ€Ð°Ð¸Ð²Ð°ÐµÐ¼ Ð¿Ñ€Ð¾Ð·Ñ€Ð°Ñ‡Ð½Ñ‹Ðµ Ð¸ ÑƒÑÑ‚Ð¾Ð¹Ñ‡Ð¸Ð²Ñ‹Ðµ Ð±Ð¸Ð·Ð½ÐµÑ-Ð¼Ð¾Ð´ÐµÐ»Ð¸, ÐºÐ¾Ñ‚Ð¾Ñ€Ñ‹Ðµ Ð¿Ð¾Ð·Ð²Ð¾Ð»ÑÑŽÑ‚ Ð½Ð°ÑˆÐ¸Ð¼ ÐºÐ»Ð¸ÐµÐ½Ñ‚Ð°Ð¼ ÑƒÐ²ÐµÑ€ÐµÐ½Ð½Ð¾ Ð¼Ð°ÑÑˆÑ‚Ð°Ð±Ð¸Ñ€Ð¾Ð²Ð°Ñ‚ÑŒÑÑ.</p>
                </div>

                <!-- Card 2: Ð¡Ð¿ÐµÑ†Ð¸Ð°Ð»Ð¸Ð·Ð°Ñ†Ð¸Ñ -->
                <div class="about-card fade-up fade-up-delay-1">
                    <div class="about-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <h3 class="about-card__title">Ð¡Ð¿ÐµÑ†Ð¸Ð°Ð»Ð¸Ð·Ð°Ñ†Ð¸Ñ: ÐœÐ°ÑÑˆÑ‚Ð°Ð± Ð±ÐµÐ· Ð³Ñ€Ð°Ð½Ð¸Ñ†</h3>
                    <ul class="about-card__list">
                        <li><strong>Ð›Ð¾ÐºÐ°Ð»ÑŒÐ½Ð°Ñ ÑÐºÑÐ¿ÐµÑ€Ñ‚Ð¸Ð·Ð°:</strong> Ð“Ð»ÑƒÐ±Ð¾ÐºÐ¾Ðµ Ð·Ð½Ð°Ð½Ð¸Ðµ Ð½Ð°Ð»Ð¾Ð³Ð¾Ð²Ð¾Ð³Ð¾ ÐºÐ¾Ð´ÐµÐºÑÐ° Ð¸ Ð·Ð°ÐºÐ¾Ð½Ð¾Ð´Ð°Ñ‚ÐµÐ»ÑŒÑÑ‚Ð²Ð° Ð Ð¢</li>
                        <li><strong>ÐœÐµÐ¶Ð´ÑƒÐ½Ð°Ñ€Ð¾Ð´Ð½Ñ‹Ðµ ÑÑ‚Ð°Ð½Ð´Ð°Ñ€Ñ‚Ñ‹:</strong> Ð’ÐµÐ´ÐµÐ½Ð¸Ðµ ÑƒÑ‡ÐµÑ‚Ð° ÑÐ¾Ð³Ð»Ð°ÑÐ½Ð¾ ÐœÐ¡Ð¤Ðž (IFRS) Ð´Ð»Ñ Ð¸Ð½Ð¾ÑÑ‚Ñ€Ð°Ð½Ð½Ñ‹Ñ… ÐºÐ¾Ð¼Ð¿Ð°Ð½Ð¸Ð¹</li>
                        <li><strong>Ð›ÑŽÐ±Ð°Ñ ÑÐ»Ð¾Ð¶Ð½Ð¾ÑÑ‚ÑŒ:</strong> Ð Ð°Ð±Ð¾Ñ‚Ð° Ñ Ð¿Ñ€ÐµÐ´Ð¿Ñ€Ð¸ÑÑ‚Ð¸ÑÐ¼Ð¸ Ð²ÑÐµÑ… Ð¿Ñ€Ð°Ð²Ð¾Ð²Ñ‹Ñ… Ñ„Ð¾Ñ€Ð¼</li>
                        <li>ÐžÑ‚ Ñ€ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ð¸ ÑÑ‚Ð°Ñ€Ñ‚Ð°Ð¿Ð° Ð´Ð¾ Ð°ÑƒÐ´Ð¸Ñ‚Ð° Ñ‚Ñ€Ð°Ð½ÑÐ½Ð°Ñ†Ð¸Ð¾Ð½Ð°Ð»ÑŒÐ½Ñ‹Ñ… ÐºÐ¾Ñ€Ð¿Ð¾Ñ€Ð°Ñ†Ð¸Ð¹</li>
                    </ul>
                    <div class="about-tags">
                        <span class="about-tag">Ð Ð¸Ñ‚ÐµÐ¹Ð»</span>
                        <span class="about-tag">ÐŸÑ€Ð¾Ð¸Ð·Ð²Ð¾Ð´ÑÑ‚Ð²Ð¾</span>
                        <span class="about-tag">IT & Fintech</span>
                        <span class="about-tag">ÐÐšÐž Ð¸ Ð¤Ð¾Ð½Ð´Ñ‹</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- â•â•â•â•â•â•â•â•â•â•â• SECTION: ÐœÐ˜Ð¡Ð¡Ð˜Ð¯ Ð˜ ÐŸÐ Ð˜ÐÐ¦Ð˜ÐŸÐ« â•â•â•â•â•â•â•â•â•â•â• -->
    <section class="section section--gray" style="padding-top: 80px; padding-bottom: 80px; border-top: 1px solid rgba(0,0,0,0.04);">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">ÐšÐ¾Ð´ÐµÐºÑ Neksoz</div>
                <h2 class="section__title">ÐœÐ¸ÑÑÐ¸Ñ Ð¸ Ð¿Ñ€Ð¸Ð½Ñ†Ð¸Ð¿Ñ‹</h2>
                <p class="section__subtitle">"ÐÐ°ÑˆÐ° Ð¼Ð¸ÑÑÐ¸Ñ â€” Ð¿Ñ€ÐµÐ²Ñ€Ð°Ñ‚Ð¸Ñ‚ÑŒ ÑÐ»Ð¾Ð¶Ð½Ñ‹Ðµ Ð±Ð¸Ð·Ð½ÐµÑ-Ð¿Ñ€Ð¾Ñ†ÐµÑÑÑ‹ Ð² Ð¿Ñ€Ð¾Ð·Ñ€Ð°Ñ‡Ð½ÑƒÑŽ Ð¸ Ð¿Ñ€Ð¸Ð±Ñ‹Ð»ÑŒÐ½ÑƒÑŽ ÑÐ¸ÑÑ‚ÐµÐ¼Ñƒ. ÐœÑ‹ Ñ€Ð°Ð±Ð¾Ñ‚Ð°ÐµÐ¼ Ð½Ð° Ð²Ð°Ñˆ Ñ€ÐµÐ·ÑƒÐ»ÑŒÑ‚Ð°Ñ‚ Ð¸ Ð¾Ð±ÐµÑÐ¿ÐµÑ‡Ð¸Ð²Ð°ÐµÐ¼ Ð·Ð°Ñ‰Ð¸Ñ‚Ñƒ Ð’Ð°ÑˆÐ¸Ñ… Ð¸Ð½Ñ‚ÐµÑ€ÐµÑÐ¾Ð² Ð½Ð° Ð²Ñ‹ÑÑˆÐµÐ¼ ÑƒÑ€Ð¾Ð²Ð½Ðµ."</p>
            </div>

            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:30px;">

                <!-- ÐŸÑ€Ð¸Ð½Ñ†Ð¸Ð¿ 01 -->
                <div class="about-card fade-up">
                    <div class="about-card__num">01</div>
                    <div class="about-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="about-card__title">Ð”Ð¾Ð²ÐµÑ€Ð¸Ðµ Ñ‡ÐµÑ€ÐµÐ· Ñ€ÐµÐ·ÑƒÐ»ÑŒÑ‚Ð°Ñ‚</h3>
                    <p class="about-card__body">ÐœÑ‹ Ð½Ðµ Ð¿Ñ€Ð¾ÑÐ¸Ð¼ Ð´Ð¾Ð²ÐµÑ€Ð¸Ñ â€” Ð¼Ñ‹ Ð·Ð°Ñ€Ð°Ð±Ð°Ñ‚Ñ‹Ð²Ð°ÐµÐ¼ ÐµÐ³Ð¾ ÐºÐ°Ñ‡ÐµÑÑ‚Ð²Ð¾Ð¼ ÐºÐ°Ð¶Ð´Ð¾Ð¹ ÑÐ´Ð°Ð½Ð½Ð¾Ð¹ Ð´ÐµÐºÐ»Ð°Ñ€Ð°Ñ†Ð¸Ð¸ Ð¸ Ñ‡Ð¸ÑÑ‚Ð¾Ñ‚Ð¾Ð¹ ÐºÐ°Ð¶Ð´Ð¾Ð³Ð¾ Ð°ÑƒÐ´Ð¸Ñ‚Ð¾Ñ€ÑÐºÐ¾Ð³Ð¾ Ð·Ð°ÐºÐ»ÑŽÑ‡ÐµÐ½Ð¸Ñ.</p>
                </div>

                <!-- ÐŸÑ€Ð¸Ð½Ñ†Ð¸Ð¿ 02 -->
                <div class="about-card fade-up fade-up-delay-1">
                    <div class="about-card__num">02</div>
                    <div class="about-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    </div>
                    <h3 class="about-card__title">Ð ÐµÑˆÐµÐ½Ð¸Ñ Ð²Ð¼ÐµÑÑ‚Ð¾ Ð¾Ñ‚Ñ‡ÐµÑ‚Ð¾Ð²</h3>
                    <p class="about-card__body">ÐœÑ‹ Ð½Ðµ Ð¿Ñ€Ð¾ÑÑ‚Ð¾ ÐºÐ¾Ð½ÑÑ‚Ð°Ñ‚Ð¸Ñ€ÑƒÐµÐ¼ Ñ„Ð°ÐºÑ‚Ñ‹ â€” Ð¼Ñ‹ Ð°Ð½Ð°Ð»Ð¸Ð·Ð¸Ñ€ÑƒÐµÐ¼ Ñ€Ð¸ÑÐºÐ¸ Ð¸ Ð¿Ñ€ÐµÐ´Ð»Ð°Ð³Ð°ÐµÐ¼ ÑÑ„Ñ„ÐµÐºÑ‚Ð¸Ð²Ð½Ñ‹Ðµ ÑÑ†ÐµÐ½Ð°Ñ€Ð¸Ð¸ Ð²Ñ‹Ñ…Ð¾Ð´Ð° Ð¸Ð· ÑÐ»Ð¾Ð¶Ð½Ñ‹Ñ… Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ñ‹Ñ… Ð¸ ÑŽÑ€Ð¸Ð´Ð¸Ñ‡ÐµÑÐºÐ¸Ñ… ÑÐ¸Ñ‚ÑƒÐ°Ñ†Ð¸Ð¹.</p>
                </div>

                <!-- ÐŸÑ€Ð¸Ð½Ñ†Ð¸Ð¿ 03 -->
                <div class="about-card fade-up fade-up-delay-2">
                    <div class="about-card__num">03</div>
                    <div class="about-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h3 class="about-card__title">ÐšÑƒÐ»ÑŒÑ‚ÑƒÑ€Ð° Ð´ÐµÐ´Ð»Ð°Ð¹Ð½Ð¾Ð²</h3>
                    <p class="about-card__body">Ð’ Ð¼Ð¸Ñ€Ðµ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð² Ð²Ñ€ÐµÐ¼Ñ â€” ÑÑ‚Ð¾ Ð´ÐµÐ½ÑŒÐ³Ð¸. ÐœÑ‹ Ð³Ð°Ñ€Ð°Ð½Ñ‚Ð¸Ñ€ÑƒÐµÐ¼ ÑÑ‚Ñ€Ð¾Ð¶Ð°Ð¹ÑˆÐµÐµ ÑÐ¾Ð±Ð»ÑŽÐ´ÐµÐ½Ð¸Ðµ ÑÑ€Ð¾ÐºÐ¾Ð², Ð±ÐµÑ€Ñ Ð½Ð° ÑÐµÐ±Ñ Ð¿Ð¾Ð»Ð½ÑƒÑŽ Ð¾Ñ‚Ð²ÐµÑ‚ÑÑ‚Ð²ÐµÐ½Ð½Ð¾ÑÑ‚ÑŒ Ð·Ð° Ñ€ÐµÐ·ÑƒÐ»ÑŒÑ‚Ð°Ñ‚.</p>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

