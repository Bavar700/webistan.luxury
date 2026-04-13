<?php
/**
 * Template Name: Баҳисобгирии идоракунӣ
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
                <h1 class="hero__title">Менеҷменти<br><em>молиявӣ</em></h1>
                <p class="hero__desc">
                    Шаффофияти пурраи молиявӣ ва маълумоти дақиқ барои қабули қарорҳое, ки ба афзоиши фоида нигаронида шудаанд.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Ҷорӣ кардани баҳисобгирӣ</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Зеҳни молиявӣ</div>
                <h2 class="section__title">Тиҷорати шумо дар оинаи рақамҳо</h2>
                <p class="section__subtitle">Мо ҳисоботҳои хушкро ба як абзори пурқудрати идоракунии захираҳо ва фоида табдил медиҳем.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1: В каких случаях вам нужна эта услуга? -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                    </div>
                    <h3 class="service-card__title">Кай мониторинг <br>лозим аст?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Ҳисоботҳои муҳосибӣ манзараи пурраро намедиҳанд</li>
                            <li>Норасоии зуд-зуди хазинавӣ (ҳангоми фоида пул нест)</li>
                            <li>Номаълум аст, ки кадом лоиҳаҳо дар амал зиёноваранд</li>
                            <li>Назорати хароҷот дар вақти воқеӣ лозим аст</li>
                            <li>Дурнамои асосноки рушд лозим аст</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2: Что входит в услугу -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
                    </div>
                    <h3 class="service-card__title">Хидматрасонӣ чӣ <br>чизҳоро дар бар мегирад?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Ҷорӣ кардани Cash Flow, P&L ва Тавозун</li>
                            <li>Танзими ҳисобот мувофиқи хусусияти тиҷорат</li>
                            <li>Ҳисоби даромаднокии самтҳо ва хидматҳо</li>
                            <li>Банақшагирии хазинавӣ ва тақвими пардохт</li>
                            <li>Таҳлили инҳирофоти "Нақша - Далел"</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3: Как мы работаем -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M3 20h18L12 4z"/></svg>
                    </div>
                    <h3 class="service-card__title">Мо чӣ гуна <br>кор мекунем?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Аудити сохтори ҷамъоварии маълумоти молиявӣ</li>
                            <li>Лоиҳакашии системаи мақсадноки ҳисоботҳо</li>
                            <li>Автоматикунонии ҷамъоварии маълумот (1С, Excel, CRM)</li>
                            <li>Омӯзиши роҳбарон барои хондани ҳисоботҳо</li>
                            <li>Ҳамроҳии мунтазам ва навсозӣ</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 4: Что вы получаете в итоге -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 class="service-card__title">Натиҷа барои <br>тиҷорати шумо</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Манзараи ҳармоҳаи "саломатӣ" дар рақамҳо</li>
                            <li>Абзори пешгӯии дақиқи фоида</li>
                            <li>Идоракунӣ дар асоси далелҳо, на интуитсия</li>
                            <li>Бартараф кардани норасоии хазинавӣ барои ҳамеша</li>
                            <li>Баланд бардоштани ҷолибияти сармоягузорӣ</li>
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
                <div class="section__label">Ауксиони молиявӣ</div>
                <h2 class="section__title">Ташхиси экспресси ройгон</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Барои таҳлили пешакии системаи баҳисобгирии шумо дархост гузоред. Мо бо шумо дар давоми 30 дақиқа тамос хоҳем гирифт.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="sm-name">
                            <label for="sm-name">Номи шумо</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="sm-phone">
                            <label for="sm-phone">Телефон (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="sm-company">
                        <label for="sm-company">Номи ширкат (ихтиёрӣ)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Танзими баҳисобгирӣ</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
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

