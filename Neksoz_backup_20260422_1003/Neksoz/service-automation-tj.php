<?php
/**
 * Template Name: Автоматизация
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
                    Автоматикунонии<br>
                    <span class="text-gradient">рақамии</span><br>
                    <span style="color: var(--nk-blue);">тиҷорати шумо</span>
                </h1>
                <p class="hero__desc">
                    Ҷорӣ намудани қарорҳои муосири IT (1С, CRM, абзорҳои AI) барои бартараф кардани корҳои муқаррарӣ ва баланд бардоштани дақиқии идоракунӣ.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Ҷорӣ кардани AI / CRM</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Самаранокии рақамӣ</div>
                <h2 class="section__title">Технологияҳо дар хизмати рушди шумо</h2>
                <p class="section__subtitle">Мо на танҳо нармафзор насб мекунем, мо системаеро месозем, ки назар ба инсон зудтар ва дақиқтар кор мекунад.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1: В каких случаях вам нужна эта услуга? -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                    <h3 class="service-card__title">Кай автоматикунонӣ <br>лозим аст?</h3></div></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Вуруди зиёди дастии маълумот ба ҷадвалҳо</li>
                            <li>Ҳуҷҷатҳо ва вазифаҳои кормандон гум мешаванд</li>
                            <li>Назорати идораҳои фосилавӣ мушкил аст</li>
                            <li>Маълумот суст ва бо хатогиҳо интиқол меёбад</li>
                            <li>Таҳлилгарии шаффоф бо 1 пахш лозим аст</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2: Что входит в услугу -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                    </div>
                    <h3 class="service-card__title">Хидматрасонӣ чӣ <br>чизҳоро дар бар мегирад?</h3></div></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Ҷорӣ кардан ва танзими 1С (Муҳосибот, ИК)</li>
                            <li>Ҷорӣ кардани CRM ва системаҳои вазифаҳо (Bitrix24)</li>
                            <li>Муттаҳидсозии 1С бо бонкҳо ва порталҳо</li>
                            <li>Ташкили кор дар хидматҳои абрӣ</li>
                            <li>Автоматикунонии баҳисобгирии анбор ва молҳо</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3: Как мы работаем -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    </div>
                    <h3 class="service-card__title">Мо чӣ гуна <br>кор мекунем?</h3></div></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Тафтиши равандҳо барои суръат бахшидан</li>
                            <li>Интихоби нармафзор мувофиқи буҷети шумо</li>
                            <li>Танзими нармафзор ва интиқоли махзани маълумот</li>
                            <li>Омӯзиши коршиносон барои кор дар системаҳои нав</li>
                            <li>Дастгирии техникӣ ва такмилдиҳӣ</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 4: Что вы получаете в итоге -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 class="service-card__title">Натиҷа барои <br>тиҷорати шумо</h3></div></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Суръатбахшии кори кормандон 2-3 маротиба</li>
                            <li>Муҳити ягона бо вазъи ҳар як вазифа</li>
                            <li>Назорати шаффофи иҷрои равандҳо</li>
                            <li>Коҳиш додани хатогиҳои омили инсонӣ</li>
                            <li>Омодагӣ ба густариши босуръат</li>
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
                <div class="section__label">Аудити техникӣ</div>
                <h2 class="section__title">Машварати экспресси ройгон</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Барои таҳлили пешакии равандҳои худ дархост гузоред. Мо бо шумо дар давоми 30 дақиқа тамос хоҳем гирифт.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="au-name">
                            <label for="au-name">Номи шумо</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="au-phone">
                            <label for="au-phone">Телефон (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="au-company">
                        <label for="au-company">Номи ширкат (ихтиёрӣ)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Ҷорӣ намудани қарор</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
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

