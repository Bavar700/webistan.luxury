<?php
/**
 * Template Name: Бизнес консалтинг
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
                    Машваратҳои тиҷоратии<br>
                    <span class="text-gradient">коршиносон</span><br>
                    <span style="color: var(--nk-blue);">барои рушд</span>
                </h1>
                <p class="hero__desc">
                    Дастгирии стратегӣ дар ҷустуҷӯи нуқтаҳои рушд ва таҳияи моделҳои муассири рушди корхонаи шумо.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Муҳокимаи лоиҳа</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Самти рушд</div>
                <h2 class="section__title">Аз бетартибӣ ба фоидаи идорашаванда</h2>
                <p class="section__subtitle">Мо барои дидани имкониятҳои пинҳонӣ ва табдил додани онҳо ба натиҷаҳои мушаххаси молиявӣ кумак мекунем.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1: В каких случаях вам нужна эта услуга? -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h3 class="service-card__title">Кай машваратҳо <br>лозим аст?</h3></div></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Тиҷорат "як ҷо истодааст" ва роҳҳои рушд нест</li>
                            <li>Равандҳои дохилӣ бетартиб шуданд</li>
                            <li>Оғози самти нав ба нақша гирифта шудааст</li>
                            <li>Тартибот дар банақшагирии молиявӣ лозим аст</li>
                            <li>Азнавташкилдиҳии калон дар пеш аст</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2: Что входит в услугу -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
                    </div>
                    <h3 class="service-card__title">Хидматрасонӣ чӣ <br>чизҳоро дар бар мегирад?</h3></div></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Таҳияи системаи стратегияи идоракунӣ</li>
                            <li>Аудити амиқ ва беҳтарсозии равандҳо</li>
                            <li>Банақшагирии молиявӣ ва буҷет</li>
                            <li>Машваратҳо оид ба таҷдиди дороиҳо</li>
                            <li>Таҳияи KPI ва системаҳои ҳавасмандкунӣ</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3: Как мы работаем -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    </div>
                    <h3 class="service-card__title">Мо чӣ гуна <br>кор мекунем?</h3></div></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Ташхис ва таҳлили нишондиҳандаҳои ҷорӣ</li>
                            <li>Ҷустуҷӯи "нуқтаҳои заиф" ва талафоти фоида</li>
                            <li>Эҷоди нақшаи марҳилавии тағйирот</li>
                            <li>Ҷорӣ намудани абзорҳои нави идоракунӣ</li>
                            <li>Ҳамроҳӣ дар марҳилаи татбиқ</li>
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
                            <li>Самти фаҳмои рушд барои 3-5 сол</li>
                            <li>Сохтори беҳтаршудаи ширкат</li>
                            <li>Баланд бардоштани самаранокии амалиётӣ</li>
                            <li>Афзоиши фоидаи соф ва гардиш</li>
                            <li>Штате, ки дар он ҳар кас дар ҷойи худ аст</li>
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
                <div class="section__label">Ташхиси тиҷорат</div>
                <h2 class="section__title">Машварати ройгон</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Барои аудити пешакии равандҳои тиҷоратӣ дархост гузоред. Мо бо шумо дар давоми 30 дақиқа тамос хоҳем гирифт.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="bc-name">
                            <label for="bc-name">Номи шумо</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="bc-phone">
                            <label for="bc-phone">Телефон (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="bc-company">
                        <label for="bc-company">Номи ширкат (ихтиёрӣ)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Оғози ташхис</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
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

