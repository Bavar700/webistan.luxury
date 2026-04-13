<?php
/**
 * Template Name: Юридические услуги
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
                    Қарорҳои маҷмӯии<br>
                    <span class="text-gradient">ҳуқуқии</span><br>
                    <span style="color: var(--nk-blue);">тиҷорат</span>
                </h1>
                <p class="hero__desc">
                    Ҳифзи боэътимоди ҳуқуқии манфиатҳои шумо, ҳамроҳии муомилот ва коҳиш додани хавфҳои ҳуқуқӣ.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Ҳифзи тиҷорат</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Мутобиқати ҳуқуқӣ (Комплаенс)</div>
                <h2 class="section__title">Сипари шумо дар майдони ҳуқуқӣ</h2>
                <p class="section__subtitle">Мо хавфҳоро дар ҷое кам мекунем, ки дигарон танҳо душвориҳоро мебинанд.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1: В каких случаях вам нужна эта услуга? -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                    </div>
                    <h3 class="service-card__title">Кай машваратҳо <br>лозим аст?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Кушодан ё бақайдгирии дубораи тиҷорат</li>
                            <li>Муомилоти мураккаб бо амволи ғайриманқул</li>
                            <li>Ҳифзи манфиатҳо дар баҳсҳои судӣ</li>
                            <li>Санҷиши контрагентҳо ва шартномаҳо</li>
                            <li>Мавҷудияти "хатарҳои пинҳонӣ" дар санадҳо</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2: Что входит в услугу -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="service-card__title">Хидматрасонӣ чӣ <br>чизҳоро дар бар мегирад?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Бақайдгирии шахсони ҳуқуқӣ</li>
                            <li>Ҳамроҳии муомилот бо амволи ғайриманқул</li>
                            <li>Намояндагӣ дар мақомоти судӣ</li>
                            <li>Кумаки ҳуқуқӣ ва низомномаҳои дохилӣ</li>
                            <li>Таҳлили шартномаҳои тиҷоратӣ</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3: Как мы работаем -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <h3 class="service-card__title">Мо чӣ гуна <br>кор мекунем?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Таҳлили ҳуқуқии вазъият ё ҳуҷҷат</li>
                            <li>Таҳияи стратегияи ҳифзи манфиатҳо</li>
                            <li>Омода кардани даъвоҳо, шикоятҳо ва тағйирот</li>
                            <li>Намояндагӣ дар мақомот ва гуфтушунидҳо</li>
                            <li>Супоридани қарор ё санади омода</li>
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
                            <li>Коҳиш додани хавфҳои ҳуқуқии муомилот</li>
                            <li>Дороиҳо ва ҳуқуқҳои қонунӣ барасмиятдаровардашуда</li>
                            <li>Ҳифзи касбӣ дар майдони ҳуқуқӣ</li>
                            <li>Паст кардани фишори маъмурӣ</li>
                            <li>Боварӣ ба ҳар як ҳуҷҷат</li>
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
                <div class="section__label">Таҳлили ҳуқуқӣ</div>
                <h2 class="section__title">Баҳодиҳии экспресси ройгон</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Барои баҳодиҳии пешакии ҳуқуқӣ дархост гузоред. Мо бо шумо дар давоми 30 дақиқа тамос хоҳем гирифт.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="sl-name">
                            <label for="sl-name">Номи шумо</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="sl-phone">
                            <label for="sl-phone">Телефон (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="sl-company">
                        <label for="sl-company">Номи ширкат (ихтиёрӣ)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Гирифтани ҳимоя</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
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

