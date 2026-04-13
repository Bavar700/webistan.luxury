<?php
/**
 * Template Name: Бухгалтерские услуги
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
                <h1 class="hero__title">Хизматрасонии<br><em>муҳосибӣ</em></h1>
                <p class="hero__desc">
                    Ба коршиносон пурра вогузор кардани муҳосибот ва маъмурияти кадрӣ барои коҳиш додани хавфҳо ва хароҷот.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Гирифтани машварат</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Устувории амалиётӣ</div>
                <h2 class="section__title">Баҳисобгирии бекамукост бе хароҷоти зиёдатӣ</h2>
                <p class="section__subtitle">Мо масъулияти рақамҳоро ба дӯш мегирем, то шумо тавонед ба рушд диққат диҳед.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1: В каких случаях вам нужна эта услуга? -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="service-card__title">Кай аутсорсинг <br>лозим аст?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Нигоҳ доштани муҳосиботи штатӣ қимат аст</li>
                            <li>Кафолати набудани ҷарима лозим аст</li>
                            <li>Баҳисобгирӣ тибқи стандартҳои МСФО лозим аст</li>
                            <li>Ивазшавии зиёди кадрҳо дар ширкат</li>
                            <li>Душвориҳо бо гардиши ҳуҷҷатҳои кадрӣ</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2: Что входит в услугу -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h14a2 2 0 0 0 2-2V7.5L14.5 2H6a2 2 0 0 0-2 2v4"/><polyline points="14 2 14 8 20 8"/><path d="M3 15h6"/><path d="M3 19h6"/></svg>
                    </div>
                    <h3 class="service-card__title">Хидматрасонӣ чӣ <br>чизҳоро дар бар мегирад?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Баҳисобгирии молиявӣ ва ҳисоб кардани маош</li>
                            <li>Супоридани ҳама намуди ҳисобот (Кумитаи андоз, фондҳо)</li>
                            <li>Барасмиятдарории қабул ва аз кор озод кардан (КМ ҶТ)</li>
                            <li>Пешбурди дафтарчаҳои меҳнатӣ ва штат</li>
                            <li>Баҳисобгирии вақти корӣ ва рухсатӣ</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3: Как мы работаем -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4"/><path d="m16.2 7.8 2.9-2.9"/><path d="M18 12h4"/><path d="m16.2 16.2 2.9 2.9"/><path d="M12 18v4"/><path d="m7.8 16.2-2.9 2.9"/><path d="M6 12H2"/><path d="m7.8 7.8-2.9-2.9"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                    <h3 class="service-card__title">Мо чӣ гуна <br>кор мекунем?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Танзим ва интегратсия ба базаҳои шумо</li>
                            <li>Коркарди ҳармоҳаи тамоми ҳуҷҷатҳои ибтидоӣ</li>
                            <li>Назорати андозҳо ва пардохтҳо ба штат</li>
                            <li>Дар вақташ супоридани ҳама намуди ҳисобот</li>
                            <li>Ҳисоботи ҳармоҳа оид ба кори анҷомшуда</li>
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
                            <li>Сарфаҷӯӣ дар нигоҳдории мутахассисони штатӣ</li>
                            <li>Кафолати саривақт супоридани ҳисоботҳо</li>
                            <li>Тартиботи беҳтарини кадрӣ дар ширкат</li>
                            <li>Набудани даъвоҳо аз мақомоти давлатӣ</li>
                            <li>Арзиши аслии шаффофи кормандон</li>
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
                <div class="section__label">Таҳлили баҳисобгирӣ</div>
                <h2 class="section__title">Баҳодиҳии экспресси ройгон</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Барои ҳисоби пешакии арзиши аутсорсинг дархост гузоред. Мо бо шумо дар давоми 30 дақиқа тамос хоҳем гирифт.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="ac-name">
                            <label for="ac-name">Номи шумо</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="ac-phone">
                            <label for="ac-phone">Телефон (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="ac-company">
                        <label for="ac-company">Номи ширкат (ихтиёрӣ)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Дархости ҳисоб</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
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

