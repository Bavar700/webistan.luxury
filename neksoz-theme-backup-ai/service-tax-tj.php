<?php
/**
 * Template Name: Услуга: Налоги
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
                <h1 class="hero__title">
                    Машваратҳои андозии<br>
                    <span class="text-gradient">коршиносон барои</span><br>
                    <span style="color: var(--nk-blue);">тиҷорат</span>
                </h1>
                <p class="hero__desc">
                    Беҳтарсозии қонунии сарбории андоз ва коҳиш додани хавфҳо пеш аз ташрифи мақомоти назоратӣ.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Коҳиш додани хавфҳо</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Амнияти андозӣ</div>
                <h2 class="section__title">Роҳи қонунии шумо ба сарфаҷӯӣ</h2>
                <p class="section__subtitle">Мо барои дуруст супоридани андозҳо кумак мекунем, изофапардохтҳоро пешгирӣ намуда ва аз даъвоҳои Кумитаи андоз муҳофизат менамоем.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1: В каких случаях вам нужна эта услуга? -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h3 class="service-card__title">Кай машваратҳо <br>лозим аст?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Шумо фикр мекунед, ки андозро зиёд месупоред</li>
                            <li>Омодагӣ ба санҷиши андоз лозим аст</li>
                            <li>Баҳси мураккаб бо нозирот ба миён омад</li>
                            <li>Муомилот бо хавфҳои калон ба нақша гирифта шудааст</li>
                            <li>Ҳисоби оқибатҳои лоиҳаҳои нав лозим аст</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2: Что входит в услугу -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <h3 class="service-card__title">Хидматрасонӣ чӣ <br>чизҳоро дар бар мегирад?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Машваратҳои андозӣ (ШҲ ва ШВ)</li>
                            <li>Таҳияи сиёсати самараноки андозӣ</li>
                            <li>Санҷиши риояи қонунгузорӣ</li>
                            <li>Намояндагӣ дар баҳсҳои андозӣ</li>
                            <li>Беҳтарсозии пардохтҳои андоз дар доираи қонун</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3: Как мы работаем -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                    <h3 class="service-card__title">Мо чӣ гуна <br>кор мекунем?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Таҳлили амиқи модели андозии ҷорӣ</li>
                            <li>Ҷустуҷӯи роҳҳои қонунии коҳиш додани сарборӣ</li>
                            <li>Бартараф кардани хатогиҳое, ки диққатро ҷалб мекунанд</li>
                            <li>Ҳифзи манфиатҳои мизоҷ дар муассисаҳо</li>
                            <li>Ҳамроҳии пурра ҳангоми санҷишҳо</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 4: Что вы получаете в итоге -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <h3 class="service-card__title">Натиҷа барои <br>тиҷорати шумо</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Коҳиш ёфтани пардохтҳои андоз (қонунӣ)</li>
                            <li>Амният пеш аз санҷишҳои давлатӣ</li>
                            <li>Боварӣ ба ҳар як сомонии пардохтҳо</li>
                            <li>Набудани бандкунӣ ва даъвоҳои Кумитаи андоз</li>
                            <li>Таърихи тозаи қарзӣ ва андозӣ</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Lead Form Section -->
    <section id="lead-form" class="section section--gray" style="border-top: 1px solid var(--nk-gray-100); padding-top: 40px; padding-bottom: 80px;">
        <div class="container" style="max-width: 800px;">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Аудити андозӣ</div>
                <h2 class="section__title">Баҳодиҳии экспресси ройгон</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Барои таҳлили пешакии сарбории андоз дархост гузоред. Мо бо шумо дар давоми 30 дақиқа тамос хоҳем гирифт.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="tc-name">
                            <label for="tc-name">Номи шумо</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="tc-phone">
                            <label for="tc-phone">Телефон (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="tc-company">
                        <label for="tc-company">Номи ширкат (ихтиёрӣ)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Оғози оптимизатсия</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
                    <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        Бо пахш кардани тугма, шумо ба <a href="<?php echo home_url('/privacy-policy'); ?>" style="color: var(--nk-blue); text-decoration: underline;">Сиёсати махфият розӣ мешавед</a>
                    </p>
                    <p class="cta-crystal__secure" style="text-align: center; margin-top: 20px; font-size: 13px; color: var(--nk-gray-500); opacity: 0.8; width: 100%;">
                        🛡️ Пайвасти ҳифзшуда (SSL 256-bit)
                    </p>
                </form>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

