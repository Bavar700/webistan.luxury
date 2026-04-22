<?php
/**
 * Template Name: Ҷойҳои корӣ V3
 */
get_header();
?>

<style>
    /* ── Vacancies Styles ────────────────────────────────── */
    .vac-container {
        padding: 100px 0;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* ── Why Us Cards ── */
    .why-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-bottom: 120px;
    }

    @media (max-width: 1024px) {
        .why-cards {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .why-cards {
            grid-template-columns: 1fr;
        }
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
        width: 48px;
        height: 48px;
        margin-bottom: 28px;
        background: rgba(0, 13, 51, 0.03);
        border-radius: 12px;
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

    .why-card:hover .why-card__icon::before {
        opacity: 1;
    }

    .why-card:hover .why-card__icon svg {
        color: #ffffff;
        transform: scale(1.1);
    }

    .why-card--alt .why-card__icon {
        color: var(--nk-gray-400);
        background: rgba(0, 13, 51, 0.03);
    }

    .why-card--alt:hover .why-card__icon {}

    .why-card__header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
    }

    .why-card__title {
        font-family: var(--font-display);
        font-size: 1.25rem;
        font-weight: 800;
        margin: 0 !important;
        letter-spacing: -0.01em;
        line-height: 1.2;
        flex: 1;
    }

    .why-card__text {
        font-size: 15px;
        color: var(--nk-gray-600);
        line-height: 1.6;
    }

    /* ── Accordion ── */
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
        .vac-content__inner {
            grid-template-columns: 1fr;
        }
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
        box-shadow: 0 0 10px rgba(227, 6, 19, 0.3);
    }

    /* ── Recruitment Stages ── */
    .stages-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 60px;
    }

    @media (max-width: 1024px) {
        .stages-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .stages-grid {
            grid-template-columns: 1fr;
        }
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
        height: 2px;
        background: var(--nk-grad-brand);
        opacity: 0.4;
        z-index: 1;
    }

    @media (max-width: 1024px) {
        .stage-item::after {
            display: none;
        }
    }

    /* ── Resume Form ── */
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
        .form-grid {
            grid-template-columns: 1fr;
        }
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
        color: rgba(255, 255, 255, 0.5);
    }

    .form-input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--radius-md);
        padding: 14px 18px;
        color: var(--nk-white);
        font-family: var(--font-body);
        font-size: 15px;
        transition: all 0.3s var(--ease);
    }

    .form-input:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.08);
        border-color: var(--nk-blue-light);
        box-shadow: 0 0 0 4px rgba(17, 102, 255, 0.1);
    }

    .form-input::placeholder {
        color: rgba(255, 255, 255, 0.2);
    }

    .file-upload {
        background: rgba(255, 255, 255, 0.03);
        border: 1px dashed rgba(255, 255, 255, 0.2);
        padding: 30px;
        border-radius: var(--radius-lg);
        text-align: center;
        cursor: pointer;
        transition: all 0.3s var(--ease);
    }

    .file-upload:hover {
        background: rgba(255, 255, 255, 0.05);
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

    <!-- ═══════════ HERO ═══════════ -->
    <section class="hero hero--internal">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container">
            <div class="hero__content" style="flex-shrink: 0;">
                <div class="hero__badge">Фаъолият</div>
                <h1 class="hero__title">
                    Ба гурӯҳи кории <span class="text-gradient">Нексоз ҳамроҳ шавед</span>
                </h1>
                <p class="hero__desc" style="max-width: 480px; opacity: 0.9;">
                    Мо истеъдодҳоро барои эҷоди роҳҳалҳои зеҳнӣ муттаҳид месозем. Ба гурӯҳи кории мо, ки меъёрҳои
                    сифатро муайян менамояд, бипайвандед.
                </p>
            </div>

            <div class="hero__actions--right">
                <a href="#vacancies" class="btn btn--primary btn-animated">
                    Ҷойҳои кории холӣ
                    <svg class="btn__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                </a>

            </div>
        </div>
    </section>

    <!-- ═══════════ WHY US ═══════════ -->
    <section class="section">
        <div class="container vac-container">
            <div class="section__header section__header--center fade-up" style="margin-bottom: 80px;">
                <div class="section__label">Афзалиятҳо</div>
                <h2 class="section__title">Чаро Нексозро интихоб мекунанд?</h2>
                <p class="section__subtitle" style="color:var(--nk-gray-400);">Сармоягузорӣ ба зеҳн ва касбияти Шумо —
                    афзалияти асосии мост.</p>
            </div>

            <div class="why-cards">
                <!-- Info 1 -->
                <div class="why-card fade-up">
                    <div class="why-card__header">
                        <div class="why-card__icon" style="margin-bottom: 0;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 2v20m10-10H2" />
                            </svg>
                        </div>
                        <h3 class="why-card__title text-gradient">Муҳити коршиносӣ</h3>
                    </div>
                    <p class="why-card__text">Фаъолияти ҳамкорона бо аудиторҳои шаҳодатномадор ва мушовирони пешбари
                        бозори ҶТ.</p>
                </div>
                <!-- Info 2 -->
                <div class="why-card fade-up" style="animation-delay: 0.1s;">
                    <div class="why-card__header">
                        <div class="why-card__icon" style="margin-bottom: 0;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
                            </svg>
                        </div>
                        <h3 class="why-card__title text-gradient">Масири касбӣ</h3>
                    </div>
                    <p class="why-card__text">Масири фаҳмо ва шаффоф аз ёвар то коршиноси пешбар ё роҳбари самт.</p>
                </div>
                <!-- Info 3 -->
                <div class="why-card fade-up" style="animation-delay: 0.15s;">
                    <div class="why-card__header">
                        <div class="why-card__icon" style="margin-bottom: 0;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z" />
                            </svg>
                        </div>
                        <h3 class="why-card__title text-gradient">Сармоягузорӣ ба дониш</h3>
                    </div>
                    <p class="why-card__text">Мо ҳаққи омӯзиши тахассусӣ ва сертификатсияи байналмилалиро барои
                        кормандони беҳтарин пардохт менамоем.</p>
                </div>
                <!-- Info 4 -->
                <div class="why-card fade-up" style="animation-delay: 0.2s;">
                    <div class="why-card__header">
                        <div class="why-card__icon" style="margin-bottom: 0;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
                                <line x1="8" y1="21" x2="16" y2="21" />
                                <line x1="12" y1="17" x2="12" y2="21" />
                            </svg>
                        </div>
                        <h3 class="why-card__title text-gradient">Технологияҳои муосир</h3>
                    </div>
                    <p class="why-card__text">Кор дар низомҳои муосир (1С, Bitrix24) ва истифодаи абзорҳои пешрафтаи
                        ҳуши маснӯӣ (AI).</p>
                </div>
                <!-- Info 5 -->
                <div class="why-card fade-up" style="animation-delay: 0.25s;">
                    <div class="why-card__header">
                        <div class="why-card__icon" style="margin-bottom: 0;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 1 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                        </div>
                        <h3 class="why-card__title text-gradient">Дафтари кории дараҷаи «А»</h3>
                    </div>
                    <p class="why-card__text">Муҳити кории бароҳат дар маркази пойтахт (хиёбони Рӯдакӣ 55).</p>
                </div>
                <!-- Info 6 -->
                <div class="why-card fade-up" style="animation-delay: 0.3s;">
                    <div class="why-card__header">
                        <div class="why-card__icon" style="margin-bottom: 0;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg>
                        </div>
                        <h3 class="why-card__title text-gradient">Таҷрибаи ғанӣ</h3>
                    </div>
                    <p class="why-card__text">Мо касбиятро қадр мекунем. Фаъолият дар Нексоз — ин иштирок дар лоиҳаҳои
                        сатҳи миллӣ ва рушди пайваста мебошад.</p>
                </div>
            </div>

            <!-- ═══════════ VACANCIES ═══════════ -->
            <div id="vacancies" class="section__header fade-up">
                <div class="section__label">Муҳим</div>
                <h2 class="section__title">Ҷойҳои кории холӣ</h2>
            </div>

            <div class="vac-accordion fade-up">
                <!-- Item 1 -->
                <div class="vac-item">
                    <div class="vac-header">
                        <div style="display: flex; align-items: center;">
                            <span class="vac-header__title">Ёвари муҳосиб</span>
                            <span class="vac-header__badge">Шуғли пурра</span>
                        </div>
                        <svg class="vac-header__icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </div>
                    <div class="vac-content">
                        <div class="vac-content__inner">
                            <div>
                                <h4 class="vac-section-title">Дар бораи ҷойи кор</h4>
                                <p style="font-size: 15px; color: var(--nk-gray-600); margin-bottom: 24px;">Мо
                                    мутахассисеро меҷӯем, ки ба омӯзиши пуршиддат омода аст ва мехоҳад тамоми нозукиҳои
                                    баҳисобгирии молиявиро таҳти роҳбарии устодон аз худ намояд.</p>

                                <h4 class="vac-section-title">Вазифаҳои Шумо</h4>
                                <ul class="vac-list">
                                    <li>Коркард ва мураттабсозии санадҳои ибтидоӣ</li>
                                    <li>Дастгирии амалиётҳо дар низоми «Муштарии бонк»</li>
                                    <li>Пешбурди интизоми хазинавӣ ва назорати амалиётҳо</li>
                                    <li>Кор дар 1С 8.3 ва ворид намудани маълумот ба низоми CRM</li>
                                    <li>Омодасозии санадҳо барои ҳифзи бойгонӣ</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="vac-section-title">Талаботи мо</h4>
                                <ul class="vac-list">
                                    <li>Таҳсилоти олии пурра ё нопурраи тахассусӣ (Иқтисодиёт)</li>
                                    <li>Донишҳои ибтидоии баҳисобгирии муҳосибӣ ва хоҳиши рушд кардан</li>
                                    <li>Диққати баланд ва таваҷҷуҳ ба рақамҳо</li>
                                    <li>Донистани забонҳои русӣ ва тоҷикӣ</li>
                                </ul>

                                <h4 class="vac-section-title" style="margin-top: 30px;">Шароитҳои мо</h4>
                                <ul class="vac-list">
                                    <li>Реҷаи корӣ: 08:00 — 17:00 (5/2)</li>
                                    <li>Марҳила ба марҳила ворид шудан ба касб</li>
                                    <li>Дафтари корӣ дар маркази шаҳр</li>
                                </ul>
                            </div>
                        </div>
                        <div style="margin-top: 40px; text-align: right;">
                            <a href="#apply" class="btn btn--blue" style="padding: 12px 28px; font-size: 11px;">Ирсоли
                                дархост</a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Reserve Info -->
            <div class="simple-card fade-up"
                style="background: linear-gradient(135deg, var(--nk-blue) 0%, #000d33 100%); border: 1px solid rgba(255, 255, 255, 0.1); margin: 80px auto 0; text-align: center; padding: 60px; max-width: 100%; border-radius: 40px; position: relative; overflow: hidden; display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);">
                <h3
                    style="font-family: var(--font-display); font-size: clamp(1.5rem, 4vw, 2.2rem); font-weight: 800; margin-bottom: 20px; color: #ffffff; width: 100%; text-align: center; letter-spacing: -0.01em;">
                    Ҷойи кории муносибро пайдо накардед?</h3>
                <p
                    style="color: #bdc3c7; max-width: 700px; margin: 0 auto 32px; font-size: 17px; line-height: 1.6; text-align: center; font-weight: 400;">
                    Мо ҳамеша ба коршиносони қавӣ ҳавасманд ҳастем. Агар Шумо устоди касби худ бошед — ҳолномаи худро
                    ирсол намоед ва мо бо Шумо дар тамос хоҳем шуд.</p>
                <a href="#apply" class="btn btn--primary"
                    style="font-weight: 800; border-radius: 16px; padding: 16px 40px;">Гузоштани дархост →</a>
            </div>
        </div>
    </section>

    <!-- ═══════════ STEPS ═══════════ -->
    <section class="section section--gray" style="border-top: 1px solid var(--nk-gray-100);">
        <div class="container">
            <div class="section__header section__header--center fade-up">
                <div class="section__label">Раванд</div>
                <h2 class="section__title">Марҳилаҳои интихоб ба лоиҳа</h2>
            </div>

            <div class="stages-grid fade-up">
                <div class="stage-item">
                    <div class="stage-item__num"
                        style="background: var(--nk-grad-brand); color: white; border: none; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                        1</div>
                    <h3 class="stage-item__title">Ҳолнома</h3>
                    <p class="stage-item__text">Таҷрибаи Шуморо дар<br>давоми 2-3 рӯз меомӯзем.</p>
                </div>
                <div class="stage-item">
                    <div class="stage-item__num"
                        style="background: var(--nk-grad-brand); color: white; border: none; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                        2</div>
                    <h3 class="stage-item__title">Санҷиш</h3>
                    <p class="stage-item__text">Супориши кӯтоҳ барои<br>мантиқ ё дониши тахассусӣ.</p>
                </div>
                <div class="stage-item">
                    <div class="stage-item__num"
                        style="background: var(--nk-grad-brand); color: white; border: none; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                        3</div>
                    <h3 class="stage-item__title">Мусоҳиба</h3>
                    <p class="stage-item__text">Шиносоӣ бо мутахассиси<br>кадрҳо (HR) ва роҳбар.</p>
                </div>
                <div class="stage-item">
                    <div class="stage-item__num"
                        style="background: var(--nk-grad-brand); color: white; border: none; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                        4</div>
                    <h3 class="stage-item__title">Рӯзи ошноӣ</h3>
                    <p class="stage-item__text">Хуш омадед<br>ба Нексоз!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════ FORM SECTION ═══════════ -->
    <section id="apply" class="section cta-crystal"
        style="padding: 120px 0; background: var(--nk-gray-50); position: relative; overflow: hidden;">
        <div class="cta-crystal__glow cta-crystal__glow--blue"></div>
        <div class="cta-crystal__glow cta-crystal__glow--red"></div>

        <div class="container fade-up" style="position: relative; z-index: 5;">
            <div class="section__header section__header--center">
                <div class="section__label">Варақаи номзад</div>
                <h2 class="section__title">Ба гурӯҳи кории мо бипайвандед</h2>
                <p class="section__subtitle">Варақаро пур кунед ва ҳолномаи худро замима намоед.<br>Барои таъйини
                    мусоҳиба мо бо Шумо дар тамос хоҳем шуд.</p>
            </div>

            <div
                style="max-width: 800px; margin: 0 auto; background: rgba(255, 255, 255, 0.8); border: 1px solid rgba(0, 13, 51, 0.05); border-radius: 32px; padding: 60px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.06); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);">
                <form action="#" class="cta-crystal__form">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="app-name">
                            <label for="app-name">Ном ва насаб</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="email" placeholder=" " required id="app-email">
                            <label for="app-email">Почтаи электронӣ</label>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="app-phone">
                            <label for="app-phone">Рақами телефон</label>
                        </div>
                        <div class="cta-crystal__field nx-dropdown" id="vacPositionDropdown">
                            <input type="text" placeholder=" " required id="app-position" class="nx-dropdown__trigger"
                                readonly>
                            <label for="app-position">Вазифаи дилхоҳ <svg width="12" height="12" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round" style="margin-left: 4px; display: inline-block;">
                                    <path d="m6 9 6 6 6-6" />
                                </svg></label>
                            <div class="nx-dropdown__panel">
                                <div class="nx-dropdown__option">Ёрдамчии муҳосиб</div>
                                <div class="nx-dropdown__option">Аудитор</div>
                                <div class="nx-dropdown__option">Ҳуқуқшинос</div>
                                <div class="nx-dropdown__option">Дигар</div>
                            </div>
                        </div>
                    </div>

                    <div class="cta-crystal__field" style="margin-bottom: 32px;">
                        <textarea placeholder=" " id="app-message"
                            style="width: 100%; min-height: 100px; padding: 25px 30px; border: 2px solid var(--nk-gray-100); border-radius: 16px; background: transparent; transition: all 0.3s var(--ease);"></textarea>
                        <label for="app-message">Маълумоти иловагӣ / Дар бораи худ</label>
                    </div>

                    <!-- Crystal File Upload -->
                    <div style="margin-bottom: 40px;">
                        <label
                            style="display: block; font-family: var(--font-display); font-size: 14px; font-weight: 800; color: var(--nk-gray-900); margin-bottom: 16px;">Ҳолнома
                            (PDF / DOCX)</label>
                        <div class="file-upload"
                            style="background: rgba(0, 13, 51, 0.02); border: 2px dashed var(--nk-gray-200); padding: 40px; border-radius: 20px; transition: all 0.3s var(--ease);">
                            <div
                                style="display: flex; flex-direction: column; align-items: center; gap: 12px; color: var(--nk-gray-400);">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4m4-10 5-5 5 5m-5-5v12" />
                                </svg>
                                <span style="font-size: 14px; font-weight: 500;">Барои интихоби файл пахш кунед ё онро
                                    ба ин ҷо кашед</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="cta-crystal__btn"><span>Ирсоли дархост</span><svg width="18"
                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg></button>

                    <p
                        style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        Бо пахши тугма, Шумо ба <a href="<?php echo home_url('/privacy-policy'); ?>"
                            style="color: var(--nk-blue); text-decoration: underline;">Сиёсати махфият</a> розӣ мешавед
                    </p>
                    <p class="cta-crystal__secure">🛡️ Пайвасти бехатар (SSL 256-bit)</p>
                </form>
            </div>
        </div>
    </section>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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

            trigger.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                drp.classList.toggle('is-open');
            });

            options.forEach(opt => {
                opt.addEventListener('click', function (e) {
                    e.stopPropagation();
                    trigger.value = this.innerText;
                    drp.classList.remove('is-open');
                    trigger.classList.add('has-value');
                });
            });

            document.addEventListener('click', function (e) {
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
