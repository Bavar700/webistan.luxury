<?php
/**
 * Template Name: ÐšÐ¾Ð¼Ð°Ð½Ð´Ð° V3
 */
get_header();
?>

<style>
/* â”€â”€ Team Layout â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
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

/* â”€â”€ Team Card: Platinum V3 â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
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

/* â”€â”€ HR Block â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
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

    <!-- â•â•â•â•â•â•â•â•â•â•â• PHILOSOPHY HERO â•â•â•â•â•â•â•â•â•â•â• -->
    <section class="hero hero--internal">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container">
            <div class="hero__content" style="max-width: 900px;">
                <div class="hero__badge">ÐšÐ¾Ð¼Ð°Ð½Ð´Ð° Neksoz</div>
                <h1 class="hero__title">Наша<br><em>команда</em></h1>
                <p class="hero__desc" style="max-width: 750px; color: rgba(255,255,255,0.85); font-size: 1.1rem;">
                    Â«Ð—Ð° ÐºÐ°Ð¶Ð´Ð¾Ð¹ Ñ†Ð¸Ñ„Ñ€Ð¾Ð¹ Ð² Ð¾Ñ‚Ñ‡ÐµÑ‚Ðµ Ð¸ ÐºÐ°Ð¶Ð´Ð¾Ð¹ ÑÑ‚Ñ€Ð¾Ñ‡ÐºÐ¾Ð¹ Ð² Ð´Ð¾Ð³Ð¾Ð²Ð¾Ñ€Ðµ ÑÑ‚Ð¾Ð¸Ñ‚ Ð¸Ð½Ñ‚ÐµÐ»Ð»ÐµÐºÑ‚ Ð½Ð°ÑˆÐ¸Ñ… ÑÐºÑÐ¿ÐµÑ€Ñ‚Ð¾Ð². ÐœÑ‹ Ð¾Ð±ÑŠÐµÐ´Ð¸Ð½Ð¸Ð»Ð¸ Ð¿Ñ€Ð¾Ñ„ÐµÑÑÐ¸Ð¾Ð½Ð°Ð»Ð¾Ð² Ð¸Ð· Ñ€Ð°Ð·Ð½Ñ‹Ñ… Ð¾Ñ‚Ñ€Ð°ÑÐ»ÐµÐ¹ â€” Ð¾Ñ‚ Ð±Ð°Ð½ÐºÐ¾Ð²ÑÐºÐ¾Ð³Ð¾ Ð´ÐµÐ»Ð° Ð´Ð¾ Ð½Ð°Ð»Ð¾Ð³Ð¾Ð²Ð¾Ð³Ð¾ Ð¿Ñ€Ð°Ð²Ð° â€” Ñ‡Ñ‚Ð¾Ð±Ñ‹ Ð²Ñ‹ Ð¿Ð¾Ð»ÑƒÑ‡Ð°Ð»Ð¸ ÐºÐ¾Ð¼Ð¿Ð»ÐµÐºÑÐ½ÑƒÑŽ Ð·Ð°Ñ‰Ð¸Ñ‚Ñƒ Ð²Ð°ÑˆÐµÐ³Ð¾ Ð±Ð¸Ð·Ð½ÐµÑÐ° ÑÐ¾ Ð²ÑÐµÑ… ÑÑ‚Ð¾Ñ€Ð¾Ð½Â».
                </p>
            </div>
            
            <div class="hero__actions--right">
                <div style="font-family: var(--font-display); font-size: 80px; font-weight: 900; color: rgba(255,255,255,0.05); line-height: 1; text-transform: uppercase;">
                    Intellect
                </div>
            </div>
        </div>
    </section>

    <!-- â•â•â•â•â•â•â•â•â•â•â• EXPERTS GRID â•â•â•â•â•â•â•â•â•â•â• -->
    <section class="section section--gray">
        <div class="container team-container">

            <!-- Transition Block -->
            <div class="section__header section__header--center fade-up" style="max-width: 800px; margin: 0 auto 80px;">
                <div class="section__label">ÐšÐ¾Ð¼Ð¿ÐµÑ‚ÐµÐ½Ñ†Ð¸Ð¸</div>
                <h2 class="section__title">ÐœÐ°ÑÑ‚ÐµÑ€ÑÑ‚Ð²Ð¾, Ð¿Ð¾Ð´Ñ‚Ð²ÐµÑ€Ð¶Ð´ÐµÐ½Ð½Ð¾Ðµ Ð³Ð¾Ð´Ð°Ð¼Ð¸ Ð¿Ñ€Ð°ÐºÑ‚Ð¸ÐºÐ¸</h2>
                <p class="section__subtitle" style="font-size: 1.2rem; color: var(--nk-gray-600);">
                    ÐœÑ‹ Ð½Ðµ Ð¿Ñ€Ð¾ÑÑ‚Ð¾ ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð¸Ñ€ÑƒÐµÐ¼ â€” Ð¼Ñ‹ Ð¿Ð¾Ð³Ñ€ÑƒÐ¶Ð°ÐµÐ¼ÑÑ Ð² ÑÐ¿ÐµÑ†Ð¸Ñ„Ð¸ÐºÑƒ Ð²Ð°ÑˆÐµÐ³Ð¾ Ð±Ð¸Ð·Ð½ÐµÑÐ°, Ð¾Ð±ÐµÑÐ¿ÐµÑ‡Ð¸Ð²Ð°Ñ ÑŽÑ€Ð¸Ð´Ð¸Ñ‡ÐµÑÐºÑƒÑŽ Ñ‡Ð¸ÑÑ‚Ð¾Ñ‚Ñƒ Ð¸ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²ÑƒÑŽ ÑƒÑÑ‚Ð¾Ð¹Ñ‡Ð¸Ð²Ð¾ÑÑ‚ÑŒ Ð½Ð° ÐºÐ°Ð¶Ð´Ð¾Ð¼ ÑÑ‚Ð°Ð¿Ðµ&nbsp;Ñ€Ð°Ð·Ð²Ð¸Ñ‚Ð¸Ñ.
                </p>
            </div>
            
            <div class="team-grid">

                <!-- Expert 1 -->
                <div class="expert-card fade-up">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-3.jpg" alt="Ð¡Ð°Ð»Ð¸Ð¼Ð¾Ð² Ð—Ð¾Ð¸Ñ€ ÐœÑƒÐ¼Ð¸Ð½Ð¾Ð²Ð¸Ñ‡" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Ð”Ð¸Ñ€ÐµÐºÑ‚Ð¾Ñ€ / ÐžÑÐ½Ð¾Ð²Ð°Ñ‚ÐµÐ»ÑŒ</div>
                        <h3 class="expert-card__name">Ð¡Ð°Ð»Ð¸Ð¼Ð¾Ð² Ð—Ð¾Ð¸Ñ€ ÐœÑƒÐ¼Ð¸Ð½Ð¾Ð²Ð¸Ñ‡</h3>
                        <div class="expert-card__regalia">ACCA, CAP/CIPA</div>
                        <p class="expert-card__spec">Ð¡Ñ‚Ñ€Ð°Ñ‚ÐµÐ³Ð¸Ñ‡ÐµÑÐºÐ¾Ðµ ÑƒÐ¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ, Ð°ÑƒÐ´Ð¸Ñ‚ Ð¸ Ð½Ð°Ð»Ð¾Ð³Ð¾Ð²Ð¾Ðµ Ð¿Ð»Ð°Ð½Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ðµ Ð´Ð»Ñ Ð¼ÐµÐ¶Ð´ÑƒÐ½Ð°Ñ€Ð¾Ð´Ð½Ð¾Ð³Ð¾ Ð±Ð¸Ð·Ð½ÐµÑÐ°.</p>
                        
                        <div class="expert-card__meta">
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">ÐžÐ¿Ñ‹Ñ‚:</span>
                                <span class="expert-card__value">15+ Ð»ÐµÑ‚</span>
                            </div>
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">ÐžÐ±Ñ€Ð°Ð·Ð¾Ð²Ð°Ð½Ð¸Ðµ:</span>
                                <span class="expert-card__value">Ð¢ÐÐ£, Ð­ÐºÐ¾Ð½Ð¾Ð¼Ð¸ÐºÐ°</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expert 2 -->
                <div class="expert-card fade-up" style="animation-delay: 0.1s;">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-1.jpg" alt="Ð¤Ð°Ñ‚Ñ…ÑƒÐ´Ð´Ð¸Ð½Ð·Ð¾Ð´Ð° Ð”Ð¸Ð»Ð¾Ð²Ð°Ñ€ ÐšÐ°Ñ€Ð¾Ð¼Ð°Ñ‚" class="expert-card__img expert-card__img--top">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Ð¡Ñ‚Ð°Ñ€ÑˆÐ¸Ð¹ ÑŽÑ€Ð¸ÑÑ‚</div>
                        <h3 class="expert-card__name">Ð¤Ð°Ñ‚Ñ…ÑƒÐ´Ð´Ð¸Ð½Ð·Ð¾Ð´Ð° Ð”Ð¸Ð»Ð¾Ð²Ð°Ñ€ ÐšÐ°Ñ€Ð¾Ð¼Ð°Ñ‚</h3>
                        <div class="expert-card__regalia">LLM, Ð®Ñ€Ð¸ÑÑ‚ Ð³Ð¾Ð´Ð°</div>
                        <p class="expert-card__spec">ÐšÐ¾Ñ€Ð¿Ð¾Ñ€Ð°Ñ‚Ð¸Ð²Ð½Ð¾Ðµ Ð¿Ñ€Ð°Ð²Ð¾, Ð°Ñ€Ð±Ð¸Ñ‚Ñ€Ð°Ð¶Ð½Ð°Ñ Ð¿Ñ€Ð°ÐºÑ‚Ð¸ÐºÐ° Ð¸ Ð¿Ñ€Ð°Ð²Ð¾Ð²Ð¾Ðµ ÑÐ¾Ð¿Ñ€Ð¾Ð²Ð¾Ð¶Ð´ÐµÐ½Ð¸Ðµ Ð¸Ð½Ð²ÐµÑÑ‚Ð¸Ñ†Ð¸Ð¾Ð½Ð½Ñ‹Ñ… Ð¿Ñ€Ð¾ÐµÐºÑ‚Ð¾Ð².</p>
                        
                        <div class="expert-card__meta">
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">ÐžÐ¿Ñ‹Ñ‚:</span>
                                <span class="expert-card__value">14 Ð»ÐµÑ‚</span>
                            </div>
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">ÐžÐ±Ñ€Ð°Ð·Ð¾Ð²Ð°Ð½Ð¸Ðµ:</span>
                                <span class="expert-card__value">Ð“Ð®Ð£, ÐœÐ°Ð³Ð¸ÑÑ‚Ñ€ Ð¿Ñ€Ð°Ð²Ð°</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expert 3 -->
                <div class="expert-card fade-up" style="animation-delay: 0.2s;">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-2.jpg" alt="Ð¨Ð¸Ñ€Ð¸Ð½Ð¾Ð² Ð ÑƒÑÑ‚Ð°Ð¼ Ð¡ÑƒÑ…Ñ€Ð¾Ð±Ð¾Ð²Ð¸Ñ‡" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Ð’ÐµÐ´ÑƒÑ‰Ð¸Ð¹ Ð±ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€</div>
                        <h3 class="expert-card__name">Ð¨Ð¸Ñ€Ð¸Ð½Ð¾Ð² Ð ÑƒÑÑ‚Ð°Ð¼ Ð¡ÑƒÑ…Ñ€Ð¾Ð±Ð¾Ð²Ð¸Ñ‡</h3>
                        <div class="expert-card__regalia">CAP, Ð¡ÐµÑ€Ñ‚Ð¸Ñ„. Ð‘ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€</div>
                        <p class="expert-card__spec">Ð’ÐµÐ´ÐµÐ½Ð¸Ðµ ÑÐ»Ð¾Ð¶Ð½Ð¾Ð³Ð¾ Ð±ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€ÑÐºÐ¾Ð³Ð¾ Ð¸ Ð½Ð°Ð»Ð¾Ð³Ð¾Ð²Ð¾Ð³Ð¾ ÑƒÑ‡ÐµÑ‚Ð°, Ð¿Ð¾Ð´Ð³Ð¾Ñ‚Ð¾Ð²ÐºÐ° Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ð¾Ð¹ Ð¾Ñ‚Ñ‡ÐµÑ‚Ð½Ð¾ÑÑ‚Ð¸ Ð¸ Ð°ÑƒÐ´Ð¸Ñ‚.</p>
                        
                        <div class="expert-card__meta">
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">ÐžÐ¿Ñ‹Ñ‚:</span>
                                <span class="expert-card__value">8 Ð»ÐµÑ‚</span>
                            </div>
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">ÐžÐ±Ñ€Ð°Ð·Ð¾Ð²Ð°Ð½Ð¸Ðµ:</span>
                                <span class="expert-card__value">Ð¢ÐÐ£, Ð‘ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€ÑÐºÐ¸Ð¹ ÑƒÑ‡ÐµÑ‚</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expert 4 -->
                <div class="expert-card fade-up">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-5.jpg" alt="ÐšÑƒÑ€Ð±Ð¾Ð½Ð¾Ð² Ð¨Ð¾Ñ…Ñ€ÑƒÑ… ÐšÐ°Ð¼Ð¾Ð»ÑƒÐ´Ð´Ð¸Ð½Ð¾Ð²Ð¸Ñ‡" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Ð’ÐµÐ´ÑƒÑ‰Ð¸Ð¹ Ð±ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€</div>
                        <h3 class="expert-card__name">ÐšÑƒÑ€Ð±Ð¾Ð½Ð¾Ð² Ð¨Ð¾Ñ…Ñ€ÑƒÑ… ÐšÐ°Ð¼Ð¾Ð»ÑƒÐ´Ð´Ð¸Ð½Ð¾Ð²Ð¸Ñ‡</h3>
                        <div class="expert-card__regalia">CAP, Ð¡ÐµÑ€Ñ‚Ð¸Ñ„. Ð‘ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€</div>
                        <p class="expert-card__spec">ÐšÐ¾Ð¼Ð¿Ð»ÐµÐºÑÐ½Ð¾Ðµ Ð±ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€ÑÐºÐ¾Ðµ ÑÐ¾Ð¿Ñ€Ð¾Ð²Ð¾Ð¶Ð´ÐµÐ½Ð¸Ðµ, Ð°Ð²Ñ‚Ð¾Ð¼Ð°Ñ‚Ð¸Ð·Ð°Ñ†Ð¸Ñ ÑƒÑ‡ÐµÑ‚Ð° Ð² 1Ð¡ Ð¸ Ð½Ð°Ð»Ð¾Ð³Ð¾Ð²Ð¾Ðµ ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ðµ.</p>
                        
                        <div class="expert-card__meta">
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">ÐžÐ¿Ñ‹Ñ‚:</span>
                                <span class="expert-card__value">10 Ð»ÐµÑ‚</span>
                            </div>
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">ÐžÐ±Ñ€Ð°Ð·Ð¾Ð²Ð°Ð½Ð¸Ðµ:</span>
                                <span class="expert-card__value">Ð”ÐÐ¢, Ð¤Ð¸Ð½Ð°Ð½ÑÑ‹ Ð¸ ÐºÑ€ÐµÐ´Ð¸Ñ‚</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expert 5 -->
                <div class="expert-card fade-up" style="animation-delay: 0.1s;">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-4.jpg" alt="Ð›Ð¸Ð²ÐµÐ½Ð³ÑƒÐ´ Ð”Ð¶Ð°ÑÑ‚Ð¸Ð½ Ð ÐµÐ³" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">ÐœÐµÐ½ÐµÐ´Ð¶ÐµÑ€ Ð¿Ð¾ Ñ€Ð°Ð·Ð²Ð¸Ñ‚Ð¸ÑŽ Ð±Ð¸Ð·Ð½ÐµÑÐ°</div>
                        <h3 class="expert-card__name">Ð›Ð¸Ð²ÐµÐ½Ð³ÑƒÐ´ Ð”Ð¶Ð°ÑÑ‚Ð¸Ð½ Ð ÐµÐ³</h3>
                        <div class="expert-card__regalia">MBA, Global Strategy</div>
                        <p class="expert-card__spec">ÐœÐ°ÑÑˆÑ‚Ð°Ð±Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ðµ Ð±Ð¸Ð·Ð½ÐµÑÐ°, Ð¿Ð¾Ð¸ÑÐº Ð½Ð¾Ð²Ñ‹Ñ… Ð¿Ð°Ñ€Ñ‚Ð½ÐµÑ€ÑÑ‚Ð² Ð¸ Ð²Ñ‹Ð²Ð¾Ð´ ÐºÐ¾Ð¼Ð¿Ð°Ð½Ð¸Ð¸ Ð½Ð° Ð¼ÐµÐ¶Ð´ÑƒÐ½Ð°Ñ€Ð¾Ð´Ð½Ñ‹Ðµ Ñ€Ñ‹Ð½ÐºÐ¸ ÐºÐ¾Ð½ÑÐ°Ð»Ñ‚Ð¸Ð½Ð³Ð°.</p>
                        
                        <div class="expert-card__meta">
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">ÐžÐ¿Ñ‹Ñ‚:</span>
                                <span class="expert-card__value">20+ Ð»ÐµÑ‚</span>
                            </div>
                            <div class="expert-card__info-row">
                                <span class="expert-card__label">ÐžÐ±Ñ€Ð°Ð·Ð¾Ð²Ð°Ð½Ð¸Ðµ:</span>
                                <span class="expert-card__value">State Univ, MBA</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- HR Block -->
            <div class="hr-block fade-up">
                <div class="hr-block__content">
                    <h2 class="hr-block__title">Ð¥Ð¾Ñ‚Ð¸Ñ‚Ðµ ÑÑ‚Ð°Ñ‚ÑŒ Ñ‡Ð°ÑÑ‚ÑŒÑŽ ÐºÐ¾Ð¼Ð°Ð½Ð´Ñ‹?</h2>
                    <p class="hr-block__text">ÐœÑ‹ Ð²ÑÐµÐ³Ð´Ð° Ñ€Ð°Ð´Ñ‹ Ñ‚Ð°Ð»Ð°Ð½Ñ‚Ð»Ð¸Ð²Ñ‹Ð¼ Ð±ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€Ð°Ð¼, Ð°ÑƒÐ´Ð¸Ñ‚Ð¾Ñ€Ð°Ð¼ Ð¸ ÑŽÑ€Ð¸ÑÑ‚Ð°Ð¼, ÐºÐ¾Ñ‚Ð¾Ñ€Ñ‹Ðµ Ñ€Ð°Ð·Ð´ÐµÐ»ÑÑŽÑ‚ Ð½Ð°ÑˆÐ¸ Ñ†ÐµÐ½Ð½Ð¾ÑÑ‚Ð¸ Ð¸ ÑÑ‚Ñ€ÐµÐ¼ÑÑ‚ÑÑ Ðº Ð¿Ñ€Ð¾Ñ„ÐµÑÑÐ¸Ð¾Ð½Ð°Ð»ÑŒÐ½Ð¾Ð¼Ñƒ Ñ€Ð¾ÑÑ‚Ñƒ. Ð•ÑÐ»Ð¸ Ð²Ñ‹ Ð³Ð¾Ñ‚Ð¾Ð²Ñ‹ Ñ€ÐµÑˆÐ°Ñ‚ÑŒ ÑÐ»Ð¾Ð¶Ð½Ñ‹Ðµ Ð·Ð°Ð´Ð°Ñ‡Ð¸ Ð¸ ÑÐ¾Ð·Ð´Ð°Ð²Ð°Ñ‚ÑŒ Ñ†ÐµÐ½Ð½Ð¾ÑÑ‚ÑŒ Ð´Ð»Ñ Ð±Ð¸Ð·Ð½ÐµÑÐ° â€” Ð½Ð°Ð¼ Ð¿Ð¾ Ð¿ÑƒÑ‚Ð¸.</p>
                </div>
                <div class="hr-block__actions">
                    <a href="<?php echo home_url('/vacancies'); ?>" class="btn btn--primary" style="width: 100%;">
                        <span>ÐžÑ‚Ð¿Ñ€Ð°Ð²Ð¸Ñ‚ÑŒ Ñ€ÐµÐ·ÑŽÐ¼Ðµ</span>
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

