<?php
if (function_exists('nk_get_current_lang')) {
    $lang = nk_get_current_lang();
    if ($lang === 'tj') { get_template_part('front-page', 'tj'); return; }
    if ($lang === 'en') { get_template_part('front-page', 'en'); return; }
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
            <div class="hero__badge">Ð‘Ð¸Ð·Ð½ÐµÑ-ÐºÐ¾Ð½ÑÐ°Ð»Ñ‚Ð¸Ð½Ð³</div>
            <h1 class="hero__title">
                Ð‘ÑƒÐ´ÐµÐ¼<br><em>Ñ€ÐµÑˆÐ°Ñ‚ÑŒ!</em>
            </h1>
            <p class="hero__desc">
                ÐŸÑ€Ð¾Ñ„ÐµÑÑÐ¸Ð¾Ð½Ð°Ð»ÑŒÐ½Ñ‹Ð¹ Ð°ÑƒÐ´Ð¸Ñ‚, Ð½Ð°Ð»Ð¾Ð³Ð¾Ð²Ð¾Ðµ Ð¿Ð»Ð°Ð½Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ðµ Ð¸ ÑŽÑ€Ð¸Ð´Ð¸Ñ‡ÐµÑÐºÐ¾Ðµ ÑÐ¾Ð¿Ñ€Ð¾Ð²Ð¾Ð¶Ð´ÐµÐ½Ð¸Ðµ Ð±Ð¸Ð·Ð½ÐµÑÐ°. <strong>ÐÐ°Ð´Ñ‘Ð¶Ð½Ð¾ÑÑ‚ÑŒ Ð¸ ÑÐºÑÐ¿ÐµÑ€Ñ‚Ð½Ð¾ÑÑ‚ÑŒ</strong> Ð´Ð»Ñ Ð’Ð°ÑˆÐµÐ³Ð¾ ÑƒÑÐ¿ÐµÑ…Ð°.
            </p>
        </div>
        <div class="hero__actions--right">
            <a href="#services" class="btn btn--primary btn-animated">
                ÐÐ°ÑˆÐ¸ ÑƒÑÐ»ÑƒÐ³Ð¸
                <svg class="btn__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
            <a href="#contacts" class="btn btn--outline-light btn-animated-light">Ð¡Ð²ÑÐ·Ð°Ñ‚ÑŒÑÑ Ñ Ð½Ð°Ð¼Ð¸</a>
        </div>
    </div>

</section>

<!-- â•â•â•â•â•â•â•â•â•â•â• STATS RIBBON (RESTYLED TO MATCH SERVICES) â•â•â•â•â•â•â•â•â•â•â• -->
<section class="section section--gray stats-ribbon-block" style="padding-top: 80px; padding-bottom: 0;">
    <div class="container">
        <div style="display: flex; justify-content: flex-end; margin-bottom: 50px;">
            <div class="section__label" style="margin-bottom: 0;">ÐÐ°Ñˆ Ð¾Ð¿Ñ‹Ñ‚</div>
        </div>
        <div class="services-grid" style="grid-template-columns: repeat(4, 1fr); gap: 20px;">
            <!-- 1 -->
            <div class="service-card fade-up" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon stat-icon">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; color: var(--nk-blue) !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">500<em style="color: var(--nk-red) !important; font-style: normal !important; -webkit-text-fill-color: var(--nk-red) !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 0.55rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; white-space: nowrap !important;">Ð”Ð¾Ð²Ð¾Ð»ÑŒÐ½Ñ‹Ñ… ÐºÐ»Ð¸ÐµÐ½Ñ‚Ð¾Ð²</p>
            </div>
            <!-- 2 -->
            <div class="service-card service-card--alt fade-up fade-up-delay-1" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon stat-icon">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; color: var(--nk-red) !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;"><?php echo (date('Y') - 2016); ?><em style="color: var(--nk-blue) !important; font-style: normal !important; -webkit-text-fill-color: var(--nk-blue) !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 0.55rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; white-space: nowrap !important;">Ð›ÐµÑ‚ Ð½Ð° Ñ€Ñ‹Ð½ÐºÐµ</p>
            </div>
            <!-- 3 -->
            <div class="service-card fade-up fade-up-delay-2" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon stat-icon">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; color: var(--nk-blue) !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">50<em style="color: var(--nk-red) !important; font-style: normal !important; -webkit-text-fill-color: var(--nk-red) !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 0.55rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; white-space: nowrap !important;">ÐšÐ²Ð°Ð»Ð¸Ñ„Ð¸Ñ†Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð½Ñ‹Ñ… ÑÐºÑÐ¿ÐµÑ€Ñ‚Ð¾Ð²</p>
            </div>
            <!-- 4 -->
            <div class="service-card service-card--alt fade-up fade-up-delay-3" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon stat-icon">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; color: var(--nk-red) !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">1200<em style="color: var(--nk-blue) !important; font-style: normal !important; -webkit-text-fill-color: var(--nk-blue) !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 0.55rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; white-space: nowrap !important;">Ð£ÑÐ¿ÐµÑˆÐ½Ñ‹Ñ… Ð¿Ñ€Ð¾ÐµÐºÑ‚Ð¾Ð²</p>
            </div>
        </div>
    </div>
</section>


<!-- â•â•â•â•â•â•â•â•â•â•â• SERVICES â•â•â•â•â•â•â•â•â•â•â• -->
<section id="services" class="section section--gray">
    <div class="container">
        <div class="section__header section__header--center">
            <div class="section__label">ÐÐ°Ð¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¸Ñ</div>
            <h2 class="section__title section__title--huge"><span class="text-gradient">ÐšÐ¾Ð¼Ð¿Ð»ÐµÐºÑÐ½Ñ‹Ðµ Ñ€ÐµÑˆÐµÐ½Ð¸Ñ</span><br>Ð´Ð»Ñ Ð’Ð°ÑˆÐµÐ³Ð¾ Ð±Ð¸Ð·Ð½ÐµÑÐ°</h2>
            <p class="section__subtitle section__subtitle--free">ÐšÐ°Ð¶Ð´Ð°Ñ ÑƒÑÐ»ÑƒÐ³Ð° Ð°Ð´Ð°Ð¿Ñ‚Ð¸Ñ€ÑƒÐµÑ‚ÑÑ Ð¿Ð¾Ð´ Ð¸Ð½Ð´Ð¸Ð²Ð¸Ð´ÑƒÐ°Ð»ÑŒÐ½Ñ‹Ðµ Ð¿Ð¾Ñ‚Ñ€ÐµÐ±Ð½Ð¾ÑÑ‚Ð¸ ÐºÐ»Ð¸ÐµÐ½Ñ‚Ð° Ð¸ Ð¾Ð±ÐµÑÐ¿ÐµÑ‡Ð¸Ð²Ð°ÐµÑ‚ Ð¼Ð°ÐºÑÐ¸Ð¼Ð°Ð»ÑŒÐ½ÑƒÑŽ <br><strong>Ð·Ð°Ñ‰Ð¸Ñ‚Ñƒ Ð’Ð°ÑˆÐ¸Ñ… Ð¸Ð½Ñ‚ÐµÑ€ÐµÑÐ¾Ð²</strong>.</p>
        </div>

        <div class="services-grid">
            <!-- 1. ÐÑƒÐ´Ð¸Ñ‚ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ð¾Ð¹ Ð´ÐµÑÑ‚ÐµÐ»ÑŒÐ½Ð¾ÑÑ‚Ð¸ -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                </div>
                <h3 class="service-card__title">ÐÑƒÐ´Ð¸Ñ‚ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ð¾Ð¹ Ð´ÐµÑÑ‚ÐµÐ»ÑŒÐ½Ð¾ÑÑ‚Ð¸</h3>
                <p class="service-card__text">Ð’Ñ‹ Ð¿Ð¾Ð»ÑƒÑ‡Ð°ÐµÑ‚Ðµ Ð½ÐµÐ·Ð°Ð²Ð¸ÑÐ¸Ð¼ÑƒÑŽ Ð¿Ñ€Ð¾Ð²ÐµÑ€ÐºÑƒ Ð¾Ñ‚Ñ‡ÐµÑ‚Ð½Ð¾ÑÑ‚Ð¸, ÐºÐ¾Ñ‚Ð¾Ñ€Ð°Ñ Ð¿Ð¾Ð´Ñ‚Ð²ÐµÑ€Ð¶Ð´Ð°ÐµÑ‚ Ð¿Ñ€Ð¾Ð·Ñ€Ð°Ñ‡Ð½Ð¾ÑÑ‚ÑŒ Ð±Ð¸Ð·Ð½ÐµÑÐ° Ð¸ Ð²Ñ‹ÑÐ²Ð»ÑÐµÑ‚ ÑÐºÑ€Ñ‹Ñ‚Ñ‹Ðµ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ñ‹Ðµ Ñ€Ð¸ÑÐºÐ¸.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">ÐÐ°ÑˆÐ¸ Ð·Ð°Ð´Ð°Ñ‡Ð¸:</span>
                    <ul class="service-card__list">
                        <li>ÐžÑ†ÐµÐ½ÐºÐ° ÑƒÑ€Ð¾Ð²Ð½Ñ Ð¾Ñ€Ð³Ð°Ð½Ð¸Ð·Ð°Ñ†Ð¸Ð¸ Ð±ÑƒÑ…ÑƒÑ‡ÐµÑ‚Ð° Ð¸ ÑÐ¸ÑÑ‚ÐµÐ¼ ÐºÐ¾Ð½Ñ‚Ñ€Ð¾Ð»Ñ</li>
                        <li>ÐŸÑ€Ð¾Ð²ÐµÑ€ÐºÐ° Ð¿Ñ€Ð°Ð²Ð¸Ð»ÑŒÐ½Ð¾ÑÑ‚Ð¸ Ð¸ Ð·Ð°ÐºÐ¾Ð½Ð½Ð¾ÑÑ‚Ð¸ Ð±ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€ÑÐºÐ¸Ñ… Ð·Ð°Ð¿Ð¸ÑÐµÐ¹</li>
                        <li>ÐŸÐµÑ€ÑÐ¿ÐµÐºÑ‚Ð¸Ð²Ð½Ñ‹Ð¹ Ð°Ð½Ð°Ð»Ð¸Ð· Ð±ÑƒÐ´ÑƒÑ‰Ð¸Ñ… ÑÐ¾Ð±Ñ‹Ñ‚Ð¸Ð¹ Ð´ÐµÑÑ‚ÐµÐ»ÑŒÐ½Ð¾ÑÑ‚Ð¸</li>
                        <li>Ð’Ñ‹ÑÐ²Ð»ÐµÐ½Ð¸Ðµ Ñ€ÐµÐ·ÐµÑ€Ð²Ð¾Ð² Ð´Ð»Ñ Ñ€Ð¾ÑÑ‚Ð° Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ñ‹Ñ… Ñ€ÐµÑÑƒÑ€ÑÐ¾Ð²</li>
                        <li>ÐŸÐ¾Ð´Ñ‚Ð²ÐµÑ€Ð¶Ð´ÐµÐ½Ð¸Ðµ Ð´Ð¾ÑÑ‚Ð¾Ð²ÐµÑ€Ð½Ð¾ÑÑ‚Ð¸ Ð¾Ñ‚Ñ‡ÐµÑ‚Ð¾Ð² Ð¸ Ð½Ð°Ð»Ð¾Ð³Ð¾Ð²Ñ‹Ð¹ Ð°ÑƒÐ´Ð¸Ñ‚</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-audit'); ?>" class="service-card__link">ÐŸÐ¾Ð´Ñ€Ð¾Ð±Ð½ÐµÐµ â†’</a>
            </div>

            <!-- 2. Ð’Ð¾ÑÑÑ‚Ð°Ð½Ð¾Ð²Ð»ÐµÐ½Ð¸Ðµ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ð¾Ð³Ð¾ ÑƒÑ‡ÐµÑ‚Ð° -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                </div>
                <h3 class="service-card__title">Ð’Ð¾ÑÑÑ‚Ð°Ð½Ð¾Ð²Ð»ÐµÐ½Ð¸Ðµ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ð¾Ð³Ð¾ ÑƒÑ‡ÐµÑ‚Ð°</h3>
                <p class="service-card__text">ÐœÑ‹ Ð¿Ñ€Ð¸Ð²ÐµÐ´ÐµÐ¼ Ð²Ð°ÑˆÑƒ Ð·Ð°Ð¿ÑƒÑ‰ÐµÐ½Ð½ÑƒÑŽ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð°Ñ†Ð¸ÑŽ Ð² Ð¿Ð¾Ð»Ð½Ñ‹Ð¹ Ð¿Ð¾Ñ€ÑÐ´Ð¾Ðº, ÑƒÑÑ‚Ñ€Ð°Ð½Ð¸Ð² Ð¾ÑˆÐ¸Ð±ÐºÐ¸ Ð¸ Ð·Ð°Ñ‰Ð¸Ñ‚Ð¸Ð² Ð²Ð°Ñ Ð¾Ñ‚ Ð¿Ñ€ÐµÑ‚ÐµÐ½Ð·Ð¸Ð¹ Ð³Ð¾ÑÐ¾Ñ€Ð³Ð°Ð½Ð¾Ð².</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">ÐÐ°ÑˆÐ¸ Ð·Ð°Ð´Ð°Ñ‡Ð¸:</span>
                    <ul class="service-card__list">
                        <li>Ð’Ð¾ÑÑÑ‚Ð°Ð½Ð¾Ð²Ð»ÐµÐ½Ð¸Ðµ ÑƒÑ‡ÐµÑ‚Ð° Ð¸ Ð·Ð°ÐºÑ€Ñ‹Ñ‚Ð¸Ðµ Ð¿Ñ€Ð¾Ð±ÐµÐ»Ð¾Ð² Ð¿Ñ€Ð¾ÑˆÐ»Ð¾Ð³Ð¾</li>
                        <li>Ð®Ñ€Ð¸Ð´Ð¸Ñ‡ÐµÑÐºÐ°Ñ ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð°Ñ†Ð¸Ñ Ð² Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ð¾Ð¹ ÑÑ„ÐµÑ€Ðµ</li>
                        <li>Ð¡Ð¸ÑÑ‚ÐµÐ¼Ð°Ñ‚Ð¸Ð·Ð°Ñ†Ð¸Ñ Ð¸ Ð¿Ñ€Ð¾Ð²ÐµÐ´ÐµÐ½Ð¸Ðµ Ð¿ÐµÑ€Ð²Ð¸Ñ‡Ð½Ð¾Ð¹ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð°Ñ†Ð¸Ð¸</li>
                        <li>Ð¡Ð²ÐµÑ€ÐºÐ° Ñ ÐºÐ¾Ð½Ñ‚Ñ€Ð°Ð³ÐµÐ½Ñ‚Ð°Ð¼Ð¸ Ð¸ Ð½Ð°Ð»Ð¾Ð³Ð¾Ð²Ð¾Ð¹ Ð´Ð»Ñ Ð¸ÑÐºÐ»ÑŽÑ‡ÐµÐ½Ð¸Ñ ÑˆÑ‚Ñ€Ð°Ñ„Ð¾Ð²</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-restore'); ?>" class="service-card__link">ÐŸÐ¾Ð´Ñ€Ð¾Ð±Ð½ÐµÐµ â†’</a>
            </div>

            <!-- 3. Ð®Ñ€Ð¸Ð´Ð¸Ñ‡ÐµÑÐºÐ¸Ðµ ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð°Ñ†Ð¸Ð¸ -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="service-card__title">Ð®Ñ€Ð¸Ð´Ð¸Ñ‡ÐµÑÐºÐ¸Ðµ ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð°Ñ†Ð¸Ð¸</h3>
                <p class="service-card__text">Ð’Ñ‹ Ð¾Ð±ÐµÑÐ¿ÐµÑ‡Ð¸Ð²Ð°ÐµÑ‚Ðµ Ð¿Ñ€Ð°Ð²Ð¾Ð²ÑƒÑŽ Ð±ÐµÐ·Ð¾Ð¿Ð°ÑÐ½Ð¾ÑÑ‚ÑŒ ÑÐ²Ð¾ÐµÐ¹ ÐºÐ¾Ð¼Ð¿Ð°Ð½Ð¸Ð¸ Ð¸ Ð½Ð°Ð´ÐµÐ¶Ð½ÑƒÑŽ Ð·Ð°Ñ‰Ð¸Ñ‚Ñƒ Ð¸Ð½Ñ‚ÐµÑ€ÐµÑÐ¾Ð² Ð² Ð»ÑŽÐ±Ñ‹Ñ… Ð´Ð¾Ð³Ð¾Ð²Ð¾Ñ€Ð°Ñ… Ð¸ ÑÐ¿Ð¾Ñ€Ð°Ñ….</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">ÐÐ°ÑˆÐ¸ Ð·Ð°Ð´Ð°Ñ‡Ð¸:</span>
                    <ul class="service-card__list">
                        <li>Ð ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ñ Ð¸ Ð¿ÐµÑ€ÐµÑ€ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ñ ÑŽÑ€Ð¸Ð´Ð¸Ñ‡ÐµÑÐºÐ¸Ñ… Ð»Ð¸Ñ†</li>
                        <li>Ð¡Ð¾Ð¿Ñ€Ð¾Ð²Ð¾Ð¶Ð´ÐµÐ½Ð¸Ðµ Ð¸ Ð¾Ñ„Ð¾Ñ€Ð¼Ð»ÐµÐ½Ð¸Ðµ ÑÐ´ÐµÐ»Ð¾Ðº Ñ Ð½ÐµÐ´Ð²Ð¸Ð¶Ð¸Ð¼Ð¾ÑÑ‚ÑŒÑŽ</li>
                        <li>ÐŸÑ€ÐµÐ´ÑÑ‚Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ Ð¸Ð½Ñ‚ÐµÑ€ÐµÑÐ¾Ð² Ð²Ð¾ Ð²ÑÐµÑ… ÑÑƒÐ´ÐµÐ±Ð½Ñ‹Ñ… Ð¸Ð½ÑÑ‚Ð°Ð½Ñ†Ð¸ÑÑ…</li>
                        <li>ÐŸÑ€Ð°Ð²Ð¾Ð²Ð°Ñ Ð¿Ð¾Ð¼Ð¾Ñ‰ÑŒ Ð¸ ÑÐºÑÐ¿ÐµÑ€Ñ‚Ð¸Ð·Ð° ÐºÐ¾Ñ€Ð¿Ð¾Ñ€Ð°Ñ‚Ð¸Ð²Ð½Ñ‹Ñ… Ð´Ð¾Ð³Ð¾Ð²Ð¾Ñ€Ð¾Ð²</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-legal'); ?>" class="service-card__link">ÐŸÐ¾Ð´Ñ€Ð¾Ð±Ð½ÐµÐµ â†’</a>
            </div>

            <!-- 4. Ð’ÐµÐ´ÐµÐ½Ð¸Ðµ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ð¾Ð³Ð¾ Ð¸ ÐºÐ°Ð´Ñ€Ð¾Ð²Ð¾Ð³Ð¾ ÑƒÑ‡ÐµÑ‚Ð° -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 class="service-card__title">Ð’ÐµÐ´ÐµÐ½Ð¸Ðµ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ð¾Ð³Ð¾ Ð¸ ÐºÐ°Ð´Ñ€Ð¾Ð²Ð¾Ð³Ð¾ ÑƒÑ‡ÐµÑ‚Ð°</h3>
                <p class="service-card__text">ÐœÑ‹ Ð±ÐµÑ€ÐµÐ¼ Ð½Ð° ÑÐµÐ±Ñ Ð²ÑÑŽ Ñ€ÑƒÑ‚Ð¸Ð½Ñƒ Ð¿Ð¾ Ð±ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€Ð¸Ð¸ Ð¸ ÐºÐ°Ð´Ñ€Ð°Ð¼, Ð³Ð°Ñ€Ð°Ð½Ñ‚Ð¸Ñ€ÑƒÑ Ð²Ð°Ð¼ Ð¾Ñ‚ÑÑƒÑ‚ÑÑ‚Ð²Ð¸Ðµ ÑˆÑ‚Ñ€Ð°Ñ„Ð¾Ð² Ð¸ ÑÑ‚Ð°Ð±Ð¸Ð»ÑŒÐ½ÑƒÑŽ Ñ€Ð°Ð±Ð¾Ñ‚Ñƒ ÑˆÑ‚Ð°Ñ‚Ð°.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">ÐÐ°ÑˆÐ¸ Ð·Ð°Ð´Ð°Ñ‡Ð¸:</span>
                    <ul class="service-card__list">
                        <li>Ð’ÐµÐ´ÐµÐ½Ð¸Ðµ Ð±ÑƒÑ…ÑƒÑ‡ÐµÑ‚Ð° Ð² 1Ð¡ Ð¸ Ñ€Ð°ÑÑ‡ÐµÑ‚ Ð·Ð°Ñ€Ð°Ð±Ð¾Ñ‚Ð½Ð¾Ð¹ Ð¿Ð»Ð°Ñ‚Ñ‹</li>
                        <li>ÐžÑ‚ÐºÑ€Ñ‹Ñ‚Ð¸Ðµ ÑÑ‡ÐµÑ‚Ð¾Ð² Ð¸ Ð²ÐµÐ´ÐµÐ½Ð¸Ðµ ÐºÐ°ÑÑÐ¾Ð²Ð¾Ð¹ Ð´Ð¸ÑÑ†Ð¸Ð¿Ð»Ð¸Ð½Ñ‹</li>
                        <li>Ð¡Ð´Ð°Ñ‡Ð° Ð²ÑÐµÑ… Ð²Ð¸Ð´Ð¾Ð² Ð¾Ñ‚Ñ‡ÐµÑ‚Ð½Ð¾ÑÑ‚Ð¸ Ð¿Ð¾ ÑÑ‚Ð°Ð½Ð´Ð°Ñ€Ñ‚Ð°Ð¼ ÐœÐ¡Ð¤Ðž</li>
                        <li>ÐŸÐ¾Ð»Ð½Ð¾Ðµ ÐºÐ°Ð´Ñ€Ð¾Ð²Ð¾Ðµ Ð´ÐµÐ»Ð¾Ð¿Ñ€Ð¾Ð¸Ð·Ð²Ð¾Ð´ÑÑ‚Ð²Ð¾ Ð¸ ÑƒÑ‡ÐµÑ‚ Ð²Ñ€ÐµÐ¼ÐµÐ½Ð¸</li>
                        <li>ÐžÑ„Ð¾Ñ€Ð¼Ð»ÐµÐ½Ð¸Ðµ Ð¾Ñ‚Ð¿ÑƒÑÐºÐ¾Ð², ÐºÐ¾Ð¼Ð°Ð½Ð´Ð¸Ñ€Ð¾Ð²Ð¾Ðº Ð¸ Ð´Ð¾Ð»Ð¶Ð½Ð¾ÑÑ‚Ð½Ñ‹Ñ… Ð¸Ð½ÑÑ‚Ñ€ÑƒÐºÑ†Ð¸Ð¹</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-accounting'); ?>" class="service-card__link">ÐŸÐ¾Ð´Ñ€Ð¾Ð±Ð½ÐµÐµ â†’</a>
            </div>

            <!-- 5. Ð£ÑÐ»ÑƒÐ³Ð¸ ÑÐµÐºÑ€ÐµÑ‚Ð°Ñ€Ð¸Ð°Ñ‚Ð° -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <h3 class="service-card__title">Ð£ÑÐ»ÑƒÐ³Ð¸ ÑÐµÐºÑ€ÐµÑ‚Ð°Ñ€Ð¸Ð°Ñ‚Ð°</h3>
                <p class="service-card__text">Ð’Ñ‹ Ð´ÐµÐ»ÐµÐ³Ð¸Ñ€ÑƒÐµÑ‚Ðµ Ð°Ð´Ð¼Ð¸Ð½Ð¸ÑÑ‚Ñ€Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ðµ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð°Ñ†Ð¸Ð¸ Ð¸ Ð·Ð²Ð¾Ð½ÐºÐ¾Ð² Ð¿Ñ€Ð¾Ñ„ÐµÑÑÐ¸Ð¾Ð½Ð°Ð»Ð°Ð¼, Ð¾ÑÐ²Ð¾Ð±Ð¾Ð¶Ð´Ð°Ñ ÑÐ²Ð¾Ðµ Ð²Ñ€ÐµÐ¼Ñ Ð´Ð»Ñ Ñ€ÐµÑˆÐµÐ½Ð¸Ñ ÑÑ‚Ñ€Ð°Ñ‚ÐµÐ³Ð¸Ñ‡ÐµÑÐºÐ¸Ñ… Ð·Ð°Ð´Ð°Ñ‡.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">ÐÐ°ÑˆÐ¸ Ð·Ð°Ð´Ð°Ñ‡Ð¸:</span>
                    <ul class="service-card__list">
                        <li>Ð›Ð¸Ñ†ÐµÐ½Ð·Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ðµ Ð¿Ñ€Ð¸Ð²Ð»ÐµÑ‡ÐµÐ½Ð¸Ñ Ð¸Ð½Ð¾ÑÑ‚Ñ€Ð°Ð½Ð½Ñ‹Ñ… Ð³Ñ€Ð°Ð¶Ð´Ð°Ð½</li>
                        <li>ÐžÑ„Ð¾Ñ€Ð¼Ð»ÐµÐ½Ð¸Ðµ Ð¿Ñ€Ð¸Ð³Ð»Ð°ÑˆÐµÐ½Ð¸Ð¹, Ñ€Ð°Ð·Ñ€ÐµÑˆÐµÐ½Ð¸Ð¹ Ð¸ Ð²Ð¸Ð· (Ðœ, Ðš, Ðž-2)</li>
                        <li>Ð ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ñ Ð² ÐžÐ’Ð˜Ð  Ð¸ Ð¾Ñ„Ð¾Ñ€Ð¼Ð»ÐµÐ½Ð¸Ðµ ÐºÐ°Ñ€Ñ‚ Ð”Ð¸Ð¿ÑÐµÑ€Ð²Ð¸ÑÐ°</li>
                        <li>ÐÑƒÑ‚ÑÐ¾Ñ€ÑÐ¸Ð½Ð³ ÑÐµÐºÑ€ÐµÑ‚Ð°Ñ€ÑÐºÐ¸Ñ… ÑƒÑÐ»ÑƒÐ³ Ð¸ ÑŽÑ€Ð¸Ð´Ð¸Ñ‡ÐµÑÐºÐ¸Ð¹ Ð¿ÐµÑ€ÐµÐ²Ð¾Ð´</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-secretariat'); ?>" class="service-card__link">ÐŸÐ¾Ð´Ñ€Ð¾Ð±Ð½ÐµÐµ â†’</a>
            </div>

            <!-- 6. Ð‘Ð¸Ð·Ð½ÐµÑ-ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð°Ñ†Ð¸Ð¸ -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                </div>
                <h3 class="service-card__title">Ð‘Ð¸Ð·Ð½ÐµÑ-ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð°Ñ†Ð¸Ð¸</h3>
                <p class="service-card__text">Ð’Ñ‹ Ð¿Ð¾Ð»ÑƒÑ‡Ð°ÐµÑ‚Ðµ ÑÐºÑÐ¿ÐµÑ€Ñ‚Ð½ÑƒÑŽ Ð¿Ð¾Ð´Ð´ÐµÑ€Ð¶ÐºÑƒ Ð² Ð¿Ð¾Ð¸ÑÐºÐµ Ð½Ð¾Ð²Ñ‹Ñ… Ñ‚Ð¾Ñ‡ÐµÐº Ñ€Ð¾ÑÑ‚Ð° Ð¸ Ñ€Ð°Ð·Ñ€Ð°Ð±Ð¾Ñ‚ÐºÐµ ÑÑ„Ñ„ÐµÐºÑ‚Ð¸Ð²Ð½Ð¾Ð¹ Ð¼Ð¾Ð´ÐµÐ»Ð¸ Ñ€Ð°Ð·Ð²Ð¸Ñ‚Ð¸Ñ Ð²Ð°ÑˆÐµÐ³Ð¾ Ð¿Ñ€ÐµÐ´Ð¿Ñ€Ð¸ÑÑ‚Ð¸Ñ.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">ÐÐ°ÑˆÐ¸ Ð·Ð°Ð´Ð°Ñ‡Ð¸:</span>
                    <ul class="service-card__list">
                        <li>ÐŸÐ¾ÑÑ‚Ñ€Ð¾ÐµÐ½Ð¸Ðµ ÑÐ¸ÑÑ‚ÐµÐ¼ ÑÑ‚Ñ€Ð°Ñ‚ÐµÐ³Ð¸Ñ‡ÐµÑÐºÐ¾Ð³Ð¾ ÑƒÐ¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¸Ñ</li>
                        <li>Ð“Ð»ÑƒÐ±Ð¾ÐºÐ¸Ð¹ Ð°ÑƒÐ´Ð¸Ñ‚ Ð¸ Ð¾Ð¿Ñ‚Ð¸Ð¼Ð¸Ð·Ð°Ñ†Ð¸Ñ Ð±Ð¸Ð·Ð½ÐµÑ-Ð¿Ñ€Ð¾Ñ†ÐµÑÑÐ¾Ð²</li>
                        <li>Ð¤Ð¸Ð½. Ð¿Ð»Ð°Ð½Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ðµ Ð¸ Ñ€Ð°Ð·Ñ€Ð°Ð±Ð¾Ñ‚ÐºÐ° Ð¼Ð¾Ð´ÐµÐ»ÐµÐ¹ Ñ€Ð°Ð·Ð²Ð¸Ñ‚Ð¸Ñ</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-consulting'); ?>" class="service-card__link">ÐŸÐ¾Ð´Ñ€Ð¾Ð±Ð½ÐµÐµ â†’</a>
            </div>

            <!-- 7. ÐÐ°Ð»Ð¾Ð³Ð¾Ð²Ñ‹Ðµ ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð°Ñ†Ð¸Ð¸ -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <h3 class="service-card__title">ÐÐ°Ð»Ð¾Ð³Ð¾Ð²Ñ‹Ðµ ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð°Ñ†Ð¸Ð¸</h3>
                <p class="service-card__text">ÐœÑ‹ Ð¿Ð¾Ð¼Ð¾Ð³Ð°ÐµÐ¼ Ð²Ð°Ð¼ Ð·Ð°ÐºÐ¾Ð½Ð½Ð¾ Ð¾Ð¿Ñ‚Ð¸Ð¼Ð¸Ð·Ð¸Ñ€Ð¾Ð²Ð°Ñ‚ÑŒ Ð½Ð°Ð»Ð¾Ð³Ð¾Ð²ÑƒÑŽ Ð½Ð°Ð³Ñ€ÑƒÐ·ÐºÑƒ Ð¸ Ð¼Ð¸Ð½Ð¸Ð¼Ð¸Ð·Ð¸Ñ€Ð¾Ð²Ð°Ñ‚ÑŒ Ñ€Ð¸ÑÐºÐ¸ Ð¿ÐµÑ€ÐµÐ´ Ð²Ð¸Ð·Ð¸Ñ‚Ð°Ð¼Ð¸ ÐºÐ¾Ð½Ñ‚Ñ€Ð¾Ð»Ð¸Ñ€ÑƒÑŽÑ‰Ð¸Ñ… Ð¾Ñ€Ð³Ð°Ð½Ð¾Ð².</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">ÐÐ°ÑˆÐ¸ Ð·Ð°Ð´Ð°Ñ‡Ð¸:</span>
                    <ul class="service-card__list">
                        <li>ÐŸÑ€Ð¾Ñ„ÐµÑÑÐ¸Ð¾Ð½Ð°Ð»ÑŒÐ½Ñ‹Ðµ ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð°Ñ†Ð¸Ð¸ (Ð®Ð› Ð¸ Ð¤Ð›)</li>
                        <li>Ð Ð°Ð·Ñ€Ð°Ð±Ð¾Ñ‚ÐºÐ° Ð±ÐµÐ·Ð¾Ð¿Ð°ÑÐ½Ð¾Ð¹ Ð½Ð°Ð»Ð¾Ð³Ð¾Ð²Ð¾Ð¹ Ð¿Ð¾Ð»Ð¸Ñ‚Ð¸ÐºÐ¸</li>
                        <li>ÐŸÑ€ÐµÐ´ÑÑ‚Ð°Ð²Ð¸Ñ‚ÐµÐ»ÑŒÑÑ‚Ð²Ð¾ Ð¸Ð½Ñ‚ÐµÑ€ÐµÑÐ¾Ð² Ð² Ð½Ð°Ð»Ð¾Ð³Ð¾Ð²Ñ‹Ñ… ÑÐ¿Ð¾Ñ€Ð°Ñ…</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-tax'); ?>" class="service-card__link">ÐŸÐ¾Ð´Ñ€Ð¾Ð±Ð½ÐµÐµ â†’</a>
            </div>

            <!-- 8. Ð£Ð¿Ñ€Ð°Ð²Ð»ÐµÐ½Ñ‡ÐµÑÐºÐ¸Ð¹ ÑƒÑ‡ÐµÑ‚ -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/></svg>
                </div>
                <h3 class="service-card__title">Ð£Ð¿Ñ€Ð°Ð²Ð»ÐµÐ½Ñ‡ÐµÑÐºÐ¸Ð¹ ÑƒÑ‡ÐµÑ‚</h3>
                <p class="service-card__text">Ð’Ñ‹ Ð¿Ð¾Ð»ÑƒÑ‡Ð°ÐµÑ‚Ðµ Ð¿Ð¾Ð»Ð½ÑƒÑŽ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²ÑƒÑŽ Ð¿Ñ€Ð¾Ð·Ñ€Ð°Ñ‡Ð½Ð¾ÑÑ‚ÑŒ Ð¸ Ñ‚Ð¾Ñ‡Ð½Ñ‹Ðµ Ð´Ð°Ð½Ð½Ñ‹Ðµ Ð´Ð»Ñ Ð¿Ñ€Ð¸Ð½ÑÑ‚Ð¸Ñ Ñ€ÐµÑˆÐµÐ½Ð¸Ð¹, ÐºÐ¾Ñ‚Ð¾Ñ€Ñ‹Ðµ Ñ€ÐµÐ°Ð»ÑŒÐ½Ð¾ ÑƒÐ²ÐµÐ»Ð¸Ñ‡Ð¸Ð²Ð°ÑŽÑ‚ Ð²Ð°ÑˆÑƒ Ñ‡Ð¸ÑÑ‚ÑƒÑŽ Ð¿Ñ€Ð¸Ð±Ñ‹Ð»ÑŒ.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">ÐÐ°ÑˆÐ¸ Ð·Ð°Ð´Ð°Ñ‡Ð¸:</span>
                    <ul class="service-card__list">
                        <li>Ð’Ð½ÐµÐ´Ñ€ÐµÐ½Ð¸Ðµ Ð¾Ñ‚Ñ‡ÐµÑ‚Ð¾Ð² Cash Flow, P&L Ð¸ Ð±Ð°Ð»Ð°Ð½ÑÐ°</li>
                        <li>Ð Ð°ÑÑ‡ÐµÑ‚ Ñ€ÐµÐ½Ñ‚Ð°Ð±ÐµÐ»ÑŒÐ½Ð¾ÑÑ‚Ð¸ Ð¿Ð¾ Ð½Ð°Ð¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¸ÑÐ¼ Ð¸ Ð¿Ñ€Ð¾ÐµÐºÑ‚Ð°Ð¼</li>
                        <li>ÐšÐ°ÑÑÐ¾Ð²Ð¾Ðµ Ð¿Ð»Ð°Ð½Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ðµ Ð¸ Ð½Ð°ÑÑ‚Ñ€Ð¾Ð¹ÐºÐ° ÐºÐ°Ð»ÐµÐ½Ð´Ð°Ñ€ÐµÐ¹</li>
                        <li>Ð’Ð¸Ð·ÑƒÐ°Ð»Ð¸Ð·Ð°Ñ†Ð¸Ñ Ñ„Ð¸Ð½. Ð¿Ð¾ÐºÐ°Ð·Ð°Ñ‚ÐµÐ»ÐµÐ¹ Ð´Ð»Ñ ÑÐ¾Ð±ÑÑ‚Ð²ÐµÐ½Ð½Ð¸ÐºÐ¾Ð²</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-management'); ?>" class="service-card__link">ÐŸÐ¾Ð´Ñ€Ð¾Ð±Ð½ÐµÐµ â†’</a>
            </div>

            <!-- 9. ÐÐ²Ñ‚Ð¾Ð¼Ð°Ñ‚Ð¸Ð·Ð°Ñ†Ð¸Ñ Ð±Ð¸Ð·Ð½ÐµÑ-Ð¿Ñ€Ð¾Ñ†ÐµÑÑÐ¾Ð² -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                </div>
                <h3 class="service-card__title">ÐÐ²Ñ‚Ð¾Ð¼Ð°Ñ‚Ð¸Ð·Ð°Ñ†Ð¸Ñ Ð±Ð¸Ð·Ð½ÐµÑ-Ð¿Ñ€Ð¾Ñ†ÐµÑÑÐ¾Ð²</h3>
                <p class="service-card__text">Ð’Ñ‹ Ð¾ÑÐ²Ð¾Ð±Ð¾Ð¶Ð´Ð°ÐµÑ‚Ðµ ÐºÐ¾Ð¼Ð°Ð½Ð´Ñƒ Ð¾Ñ‚ Ñ€ÑƒÑ‚Ð¸Ð½Ñ‹ Ð¸ Ð¸ÑÐºÐ»ÑŽÑ‡Ð°ÐµÑ‚Ðµ Ð¾ÑˆÐ¸Ð±ÐºÐ¸ Ñ‡ÐµÐ»Ð¾Ð²ÐµÑ‡ÐµÑÐºÐ¾Ð³Ð¾ Ñ„Ð°ÐºÑ‚Ð¾Ñ€Ð°, Ð¿ÐµÑ€ÐµÐ²Ð¾Ð´Ñ ÑƒÐ¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ Ð² Ð±Ñ‹ÑÑ‚Ñ€ÑƒÑŽ Ð¸ Ñ‚Ð¾Ñ‡Ð½ÑƒÑŽ Ñ†Ð¸Ñ„Ñ€Ð¾Ð²ÑƒÑŽ ÑÑ€ÐµÐ´Ñƒ.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">ÐÐ°ÑˆÐ¸ Ð·Ð°Ð´Ð°Ñ‡Ð¸:</span>
                    <ul class="service-card__list">
                        <li>Ð’Ð½ÐµÐ´Ñ€ÐµÐ½Ð¸Ðµ Ð¸ Ð½Ð°ÑÑ‚Ñ€Ð¾Ð¹ÐºÐ° ÑÐ¸ÑÑ‚ÐµÐ¼ ÑƒÑ‡ÐµÑ‚Ð° 1Ð¡</li>
                        <li>Ð˜Ð½Ñ‚ÐµÐ³Ñ€Ð°Ñ†Ð¸Ñ CRM, Bitrix24 Ð¸ ÑÐ¸ÑÑ‚ÐµÐ¼ ÑƒÐ¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¸Ñ</li>
                        <li>ÐÐ°ÑÑ‚Ñ€Ð¾Ð¹ÐºÐ° ÑÐ²ÑÐ·Ð¾Ðº ÑƒÑ‡ÐµÑ‚Ð° Ñ ÐšÐ»Ð¸ÐµÐ½Ñ‚-Ð±Ð°Ð½ÐºÐ¾Ð¼</li>
                        <li>Ð¦Ð¸Ñ„Ñ€Ð¾Ð²Ð¸Ð·Ð°Ñ†Ð¸Ñ Ð°Ñ€Ñ…Ð¸Ð²Ð¾Ð² Ð¸ ÑÐ»ÐµÐºÑ‚Ñ€Ð¾Ð½Ð½Ñ‹Ð¹ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð¾Ð¾Ð±Ð¾Ñ€Ð¾Ñ‚</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-automation'); ?>" class="service-card__link">ÐŸÐ¾Ð´Ñ€Ð¾Ð±Ð½ÐµÐµ â†’</a>
            </div>

            <!-- 10. Ð Ð°Ð·Ñ€Ð°Ð±Ð¾Ñ‚ÐºÐ° Ð±Ð¸Ð·Ð½ÐµÑ-Ð¿Ð»Ð°Ð½Ð¾Ð² Ð¸ Ð¢Ð­Ðž -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/><path d="M9 14h6"/><path d="M9 18h6"/><path d="M9 10h6"/></svg>
                </div>
                <h3 class="service-card__title">Ð Ð°Ð·Ñ€Ð°Ð±Ð¾Ñ‚ÐºÐ° Ð±Ð¸Ð·Ð½ÐµÑ-Ð¿Ð»Ð°Ð½Ð¾Ð² Ð¸ Ð¢Ð­Ðž</h3>
                <p class="service-card__text">Ð’Ñ‹ Ð¿Ð¾Ð»ÑƒÑ‡Ð°ÐµÑ‚Ðµ Ð´ÐµÑ‚Ð°Ð»ÑŒÐ½Ñ‹Ð¹ Ð¸ Ð¾Ð±Ð¾ÑÐ½Ð¾Ð²Ð°Ð½Ð½Ñ‹Ð¹ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ñ‹Ð¹ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚, ÐºÐ¾Ñ‚Ð¾Ñ€Ñ‹Ð¹ Ð´Ð¾ÐºÐ°Ð·Ñ‹Ð²Ð°ÐµÑ‚ Ð¾ÐºÑƒÐ¿Ð°ÐµÐ¼Ð¾ÑÑ‚ÑŒ Ð²Ð°ÑˆÐµÐ³Ð¾ Ð¿Ñ€Ð¾ÐµÐºÑ‚Ð° Ð¸ Ð¿Ð¾Ð¼Ð¾Ð³Ð°ÐµÑ‚ Ð³Ð°Ñ€Ð°Ð½Ñ‚Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð½Ð¾ Ð¿Ñ€Ð¸Ð²Ð»ÐµÑ‡ÑŒ Ð¸Ð½Ð²ÐµÑÑ‚Ð¸Ñ†Ð¸Ð¸ Ð¸Ð»Ð¸ Ð±Ð°Ð½ÐºÐ¾Ð²ÑÐºÐ¸Ðµ ÐºÑ€ÐµÐ´Ð¸Ñ‚Ñ‹.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">ÐÐ°ÑˆÐ¸ Ð·Ð°Ð´Ð°Ñ‡Ð¸:</span>
                    <ul class="service-card__list">
                        <li>ÐŸÑ€Ð¾Ð²ÐµÐ´ÐµÐ½Ð¸Ðµ Ð³Ð»ÑƒÐ±Ð¾ÐºÐ¾Ð³Ð¾ Ð°Ð½Ð°Ð»Ð¸Ð·Ð° Ñ€Ñ‹Ð½ÐºÐ°, ÐºÐ¾Ð½ÐºÑƒÑ€ÐµÐ½Ñ‚Ð½Ð¾Ð¹ ÑÑ€ÐµÐ´Ñ‹ Ð¸ Ð°ÑƒÐ´Ð¸Ñ‚Ð¾Ñ€Ð¸Ð¸</li>
                        <li>Ð Ð°Ð·Ñ€Ð°Ð±Ð¾Ñ‚ÐºÐ° Ð¿Ð¾Ð´Ñ€Ð¾Ð±Ð½Ð¾Ð¹ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ð¾Ð¹ Ð¼Ð¾Ð´ÐµÐ»Ð¸ (Ð´Ð¾Ñ…Ð¾Ð´Ñ‹, Ñ€Ð°ÑÑ…Ð¾Ð´Ñ‹, Ñ‚Ð¾Ñ‡ÐºÐ° Ð±ÐµÐ·ÑƒÐ±Ñ‹Ñ‚Ð¾Ñ‡Ð½Ð¾ÑÑ‚Ð¸)</li>
                        <li>Ð¡Ð¾ÑÑ‚Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ Ð¢Ð­Ðž Ñ ÑƒÑ‡ÐµÑ‚Ð¾Ð¼ ÑÐ¿ÐµÑ†Ð¸Ñ„Ð¸ÐºÐ¸ Ð·Ð°ÐºÐ¾Ð½Ð¾Ð´Ð°Ñ‚ÐµÐ»ÑŒÑÑ‚Ð²Ð° Ð¸ Ð½Ð°Ð»Ð¾Ð³Ð¾Ð¾Ð±Ð»Ð¾Ð¶ÐµÐ½Ð¸Ñ Ð Ð¢</li>
                        <li>ÐŸÐ¾Ð´Ð³Ð¾Ñ‚Ð¾Ð²ÐºÐ° Ð¿Ñ€ÐµÐ·ÐµÐ½Ñ‚Ð°Ñ†Ð¸Ð¾Ð½Ð½Ñ‹Ñ… Ð¼Ð°Ñ‚ÐµÑ€Ð¸Ð°Ð»Ð¾Ð² (Pitch Deck) Ð´Ð»Ñ Ð·Ð°Ñ‰Ð¸Ñ‚Ñ‹ Ð¿Ñ€Ð¾ÐµÐºÑ‚Ð°</li>
                        <li>Ð¡Ð¾Ð¿Ñ€Ð¾Ð²Ð¾Ð¶Ð´ÐµÐ½Ð¸Ðµ Ð¸ Ð·Ð°Ñ‰Ð¸Ñ‚Ð° Ð±Ð¸Ð·Ð½ÐµÑ-Ð¿Ð»Ð°Ð½Ð° Ð½Ð° Ð¿ÐµÑ€ÐµÐ³Ð¾Ð²Ð¾Ñ€Ð°Ñ… Ñ Ð¸Ð½Ð²ÐµÑÑ‚Ð¾Ñ€Ð°Ð¼Ð¸</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-consulting'); ?>" class="service-card__link">ÐŸÐ¾Ð´Ñ€Ð¾Ð±Ð½ÐµÐµ â†’</a>
            </div>
        </div>
    </div>
</section>

<!-- â•â•â•â•â•â•â•â•â•â•â• ABOUT â•â•â•â•â•â•â•â•â•â•â• -->
<section id="about" class="about section">
    <!-- Geometric Background mirroring Hero -->
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    
    <div class="ceo-editorial fade-up is-visible">
            <div class="section__label section__label--on-dark">Ðž ÐºÐ¾Ð¼Ð¿Ð°Ð½Ð¸Ð¸</div>
            <h2 class="section__title section__title--huge section__title--on-dark">
                <span class="text-gradient">Ð’Ð°Ñˆ ÑÑ‚Ñ€Ð°Ñ‚ÐµÐ³Ð¸Ñ‡ÐµÑÐºÐ¸Ð¹ Ð¿Ð°Ñ€Ñ‚Ð½ÐµÑ€</span><br>Ð² Ð’Ð°ÑˆÐµÐ¼ Ð±Ð¸Ð·Ð½ÐµÑÐµ
            </h2>
            <p class="ceo-editorial__intro">
                ÐžÐžÐž Â«ÐÐ•ÐšÐ¡ÐžÐ—-Ð‘Ð˜Ð—ÐÐ•Ð¡ ÐšÐžÐÐ¡ÐÐ›Ð¢Ð˜ÐÐ“ Ð“Ð Ð£ÐŸÂ» â€” Ð¾ÑÐ½Ð¾Ð²Ð°Ð½Ð° Ð² 2016 Ð³Ð¾Ð´Ñƒ. Ð—Ð° ÑÑ‚Ð¾ Ð²Ñ€ÐµÐ¼Ñ Ð¼Ñ‹ ÑÐ²Ð¾Ð»ÑŽÑ†Ð¸Ð¾Ð½Ð¸Ñ€Ð¾Ð²Ð°Ð»Ð¸ Ð¸Ð· ÑƒÐ·ÐºÐ¾Ð¿Ñ€Ð¾Ñ„Ð¸Ð»ÑŒÐ½Ð¾Ð¹ Ñ„Ð¸Ñ€Ð¼Ñ‹ Ð² <strong>Ð¼Ð¾Ñ‰Ð½Ñ‹Ð¹ ÐºÐ¾Ð½ÑÐ°Ð»Ñ‚Ð¸Ð½Ð³Ð¾Ð²Ñ‹Ð¹ Ñ…Ð°Ð±</strong>, Ð¾Ð±ÐµÑÐ¿ÐµÑ‡Ð¸Ð²Ð°Ñ ÑƒÑÑ‚Ð¾Ð¹Ñ‡Ð¸Ð²Ð¾ÑÑ‚ÑŒ Ð¸ Ð±ÐµÐ·Ð¾Ð¿Ð°ÑÐ½Ð¾ÑÑ‚ÑŒ Ð±Ð¸Ð·Ð½ÐµÑÐ° Ð½Ð° ÐºÐ°Ð¶Ð´Ð¾Ð¼ ÑÑ‚Ð°Ð¿Ðµ Ñ€Ð¾ÑÑ‚Ð°.
            </p>
            <div class="ceo-editorial__quote-card">
                <blockquote class="ceo-editorial__quote-text">
                    ÐÐ°ÑˆÐ° Ð¼Ð¸ÑÑÐ¸Ñ â€” Ð¿Ñ€ÐµÐ²Ñ€Ð°Ñ‚Ð¸Ñ‚ÑŒ ÑÐ»Ð¾Ð¶Ð½Ñ‹Ðµ Ð±Ð¸Ð·Ð½ÐµÑ-Ð¿Ñ€Ð¾Ñ†ÐµÑÑÑ‹ Ð² Ð¿Ñ€Ð¾Ð·Ñ€Ð°Ñ‡Ð½ÑƒÑŽ Ð¸ Ð¿Ñ€Ð¸Ð±Ñ‹Ð»ÑŒÐ½ÑƒÑŽ ÑÐ¸ÑÑ‚ÐµÐ¼Ñƒ. ÐœÑ‹ Ñ€Ð°Ð±Ð¾Ñ‚Ð°ÐµÐ¼ Ð½Ð° Ð²Ð°Ñˆ Ñ€ÐµÐ·ÑƒÐ»ÑŒÑ‚Ð°Ñ‚ Ð¸ Ð¾Ð±ÐµÑÐ¿ÐµÑ‡Ð¸Ð²Ð°ÐµÐ¼ Ð·Ð°Ñ‰Ð¸Ñ‚Ñƒ Ð’Ð°ÑˆÐ¸Ñ… Ð¸Ð½Ñ‚ÐµÑ€ÐµÑÐ¾Ð² Ð½Ð° Ð²Ñ‹ÑÑˆÐµÐ¼ ÑƒÑ€Ð¾Ð²Ð½Ðµ.
                </blockquote>
                <div class="ceo-editorial__author">
                    <div class="ceo-editorial__circle-frame">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ceo.jpg" alt="Ð—Ð¾Ð¸Ñ€ Ð¡Ð°Ð»Ð¸Ð¼Ð¾Ð²" class="ceo-editorial__avatar">
                    </div>
                    <div class="cea-editorial__author-info">
                        <div class="ceo-editorial__author-name">Ð—Ð¾Ð¸Ñ€ Ð¡Ð°Ð»Ð¸Ð¼Ð¾Ð²</div>
                        <div class="ceo-editorial__author-title">Ð“ÐµÐ½ÐµÑ€Ð°Ð»ÑŒÐ½Ñ‹Ð¹ Ð´Ð¸Ñ€ÐµÐºÑ‚Ð¾Ñ€, NEKSOZ</div>
                    </div>
                    <div class="ceo-editorial__signature">Zoir Salimov</div>
                    <div class="ceo-editorial__footer">
                        <a href="#" class="ceo-editorial__team-link">
                            ÐŸÐ¾Ð·Ð½Ð°ÐºÐ¾Ð¼ÑŒÑ‚ÐµÑÑŒ Ñ Ð½Ð°ÑˆÐµÐ¹ ÑÐºÑÐ¿ÐµÑ€Ñ‚Ð½Ð¾Ð¹ ÐºÐ¾Ð¼Ð°Ð½Ð´Ð¾Ð¹
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Closing container -->
</section>

<!-- â•â•â•â•â•â•â•â•â•â•â• CTA â€” CRYSTAL ELEGANCE EDITION â•â•â•â•â•â•â•â•â•â•â• -->
<section id="contacts" class="cta-crystal">
    <!-- Animated Mesh Glows -->
    <div class="cta-crystal__glow cta-crystal__glow--blue"></div>
    <div class="cta-crystal__glow cta-crystal__glow--red"></div>
    
    <div class="container">
        <div class="cta-crystal__grid">
            
            <!-- Left Side: Soft Modern Persuasion -->
            <div class="cta-crystal__content fade-up is-visible">
                <div class="section__label">Ð‘Ñ‹ÑÑ‚Ñ€Ð°Ñ ÑÐ²ÑÐ·ÑŒ</div>
                <h2 class="cta-crystal__title"><span class="text-gradient">Ð“Ð¾Ñ‚Ð¾Ð²Ñ‹ Ð¼Ð°ÑÑˆÑ‚Ð°Ð±Ð¸Ñ€Ð¾Ð²Ð°Ñ‚ÑŒ</span><br>ÑÐ²Ð¾Ð¹ ÑƒÑÐ¿ÐµÑ…?</h2>
                <p class="cta-crystal__text">ÐžÑÑ‚Ð°Ð²ÑŒÑ‚Ðµ Ð·Ð°ÑÐ²ÐºÑƒ ÑÐµÐ³Ð¾Ð´Ð½Ñ, Ð¸ Ð¼Ñ‹ Ñ€Ð°Ð·Ñ€Ð°Ð±Ð¾Ñ‚Ð°ÐµÐ¼ Ð´Ð»Ñ Ð²Ð°Ñ Ð¿ÐµÑ€ÑÐ¾Ð½Ð°Ð»ÑŒÐ½ÑƒÑŽ ÑÑ‚Ñ€Ð°Ñ‚ÐµÐ³Ð¸ÑŽ Ñ€Ð°Ð·Ð²Ð¸Ñ‚Ð¸Ñ Ð¸ Ð¾Ð±ÐµÑÐ¿ÐµÑ‡ÐµÐ½Ð¸Ñ Ð±ÐµÐ·Ð¾Ð¿Ð°ÑÐ½Ð¾ÑÑ‚Ð¸ Ð²Ð°ÑˆÐµÐ³Ð¾ Ð±Ð¸Ð·Ð½ÐµÑÐ°.</p>
                <div class="cta-crystal__status">
                    <span class="cta-crystal__status-dot"></span>
                    ÐœÑ‹ Ð¾Ð½Ð»Ð°Ð¹Ð½ â€¢ ÐžÑ‚Ð²ÐµÑ‚ Ð² Ñ‚ÐµÑ‡ÐµÐ½Ð¸Ðµ 15 Ð¼Ð¸Ð½ÑƒÑ‚
                </div>
            </div>

            <!-- Right Side: Crystal Tech Form -->
            <div class="cta-crystal__form-wrapper fade-up is-visible">
                <form action="#" class="cta-crystal__form">
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " required id="f-name">
                        <label for="f-name">Ð’Ð°ÑˆÐµ Ð¸Ð¼Ñ</label>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="tel" placeholder=" " required id="f-phone">
                        <label for="f-phone">Ð¢ÐµÐ»ÐµÑ„Ð¾Ð½ (+992)</label>
                    </div>
                    <div class="cta-crystal__field nx-dropdown">
                        <input type="text" placeholder=" " required id="f-service-input" class="nx-dropdown__trigger" readonly>
                        <label for="f-service-input">Ð’Ñ‹Ð±Ñ€Ð°Ñ‚ÑŒ Ð½Ð°Ð¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px; display: inline-block; vertical-align: middle;"><path d="m6 9 6 6 6-6"/></svg></label>
                        
                        <div class="nx-dropdown__panel">
                            <div class="nx-dropdown__option">Ð®Ñ€Ð¸Ð´Ð¸Ñ‡ÐµÑÐºÐ¾Ðµ ÑÐ¾Ð¿Ñ€Ð¾Ð²Ð¾Ð¶Ð´ÐµÐ½Ð¸Ðµ</div>
                            <div class="nx-dropdown__option">ÐÐ°Ð»Ð¾Ð³Ð¾Ð²Ð¾Ðµ ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ðµ</div>
                            <div class="nx-dropdown__option">ÐÑƒÐ´Ð¸Ñ‚ Ð¸ Ð±ÑƒÑ…. ÑƒÑ‡ÐµÑ‚</div>
                            <div class="nx-dropdown__option">ÐÐ²Ñ‚Ð¾Ð¼Ð°Ñ‚Ð¸Ð·Ð°Ñ†Ð¸Ñ Ð±Ð¸Ð·Ð½ÐµÑÐ°</div>
                            <div class="nx-dropdown__option">HR-ÐºÐ¾Ð½ÑÐ°Ð»Ñ‚Ð¸Ð½Ð³</div>
                            <div class="nx-dropdown__option">Ð˜Ð½Ð²ÐµÑÑ‚Ð¸Ñ†Ð¸Ð¾Ð½Ð½Ñ‹Ð¹ ÐºÐ¾Ð½ÑÐ°Ð»Ñ‚Ð¸Ð½Ð³</div>
                            <div class="nx-dropdown__option">ÐœÐ°Ñ€ÐºÐµÑ‚Ð¸Ð½Ð³Ð¾Ð²Ñ‹Ðµ ÑÑ‚Ñ€Ð°Ñ‚ÐµÐ³Ð¸Ð¸</div>
                            <div class="nx-dropdown__option">Ð‘Ð¸Ð·Ð½ÐµÑ-Ð¿Ð»Ð°Ð½Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ðµ</div>
                            <div class="nx-dropdown__option">ÐžÐ¿Ñ‚Ð¸Ð¼Ð¸Ð·Ð°Ñ†Ð¸Ñ Ð¿Ñ€Ð¾Ñ†ÐµÑÑÐ¾Ð²</div>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <textarea placeholder=" " id="f-msg" rows="3"></textarea>
                        <label for="f-msg">Ð¡ÑƒÑ‚ÑŒ Ð²Ð°ÑˆÐµÐ³Ð¾ Ð·Ð°Ð¿Ñ€Ð¾ÑÐ°</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn">
                        <span>ÐžÑ‚Ð¿Ñ€Ð°Ð²Ð¸Ñ‚ÑŒ Ð·Ð°ÑÐ²ÐºÑƒ</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                    <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        ÐÐ°Ð¶Ð¸Ð¼Ð°Ñ ÐºÐ½Ð¾Ð¿ÐºÑƒ, Ð²Ñ‹ ÑÐ¾Ð³Ð»Ð°ÑˆÐ°ÐµÑ‚ÐµÑÑŒ Ñ <a href="<?php echo home_url('/privacy-policy'); ?>" style="color: var(--nk-blue); text-decoration: underline;">ÐŸÐ¾Ð»Ð¸Ñ‚Ð¸ÐºÐ¾Ð¹ ÐºÐ¾Ð½Ñ„Ð¸Ð´ÐµÐ½Ñ†Ð¸Ð°Ð»ÑŒÐ½Ð¾ÑÑ‚Ð¸</a>
                    </p>
                    <p class="cta-crystal__secure">ðŸ›¡ï¸ Ð—Ð°Ñ‰Ð¸Ñ‰Ñ‘Ð½Ð½Ð¾Ðµ ÑÐ¾ÐµÐ´Ð¸Ð½ÐµÐ½Ð¸Ðµ (SSL 256-bit)</p>
                    <div id="nk-form-status" style="margin-top: 15px; display: none;"></div>
                </form>

                <style>
                    .nx-dropdown { position: relative; }
                    .nx-dropdown__trigger { cursor: pointer !important; }
                    .nx-dropdown__panel {
                        position: absolute;
                        top: 100%;
                        left: 0;
                        width: 100%;
                        background: rgba(235, 238, 243, 0.98); /* Ð§ÑƒÑ‚ÑŒ Ñ‚ÐµÐ¼Ð½ÐµÐµ */
                        backdrop-filter: blur(25px);
                        -webkit-backdrop-filter: blur(25px);
                        border: none; /* Ð£Ð±Ñ€Ð°Ð» Ð±Ð¾Ñ€Ð´ÑŽÑ€ */
                        border-radius: 20px; /* Ð—Ð°ÐºÑ€ÑƒÐ³Ð»Ð¸Ð» ÑƒÐ³Ð»Ñ‹ */
                        box-shadow: 0 30px 60px rgba(0, 13, 51, 0.12);
                        opacity: 0;
                        visibility: hidden;
                        transform: translateY(-10px);
                        transition: all 0.3s var(--ease);
                        z-index: 1000;
                        max-height: 250px;
                        overflow-y: auto;
                        padding: 10px 0;
                        margin-top: 5px;
                    }
                    .nx-dropdown.is-open .nx-dropdown__panel {
                        opacity: 1;
                        visibility: visible;
                        transform: translateY(0);
                    }
                    .nx-dropdown__option {
                        padding: 14px 24px;
                        cursor: pointer;
                        font-size: 14px;
                        font-family: var(--font-display);
                        color: var(--nk-gray-900);
                        transition: all 0.2s ease;
                    }
                    .nx-dropdown__option:hover {
                        background: rgba(0, 68, 204, 0.08); /* Ð¡Ð²ÐµÑ‚Ð»Ð¾-ÑÐ¸Ð½Ð¸Ð¹ Ð°ÐºÑ†ÐµÐ½Ñ‚ */
                        color: var(--nk-blue);
                        padding-left: 30px;
                    }
                </style>
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