<?php
/**
 * Template Name: Хидматрасониҳо
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
                <div class="hero__badge">Маҷмӯи пурраи роҳҳалҳо</div>
                <h1 class="hero__title">
                    Хидматҳои маҷмӯӣ барои
                    <span class="text-gradient">рушди тиҷорати Шумо</span>
                </h1>
                <p class="hero__desc">
                    Мо дастгирии коршиносиро дар ҳар як марҳилаи давраи ҳаёти ширкат — аз бақайдгирӣ то густариш пешниҳод менамоем.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts?lang=tj'); ?>" class="btn btn--primary">Машварат</a>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="section section--gray">
        <div class="container">
            <div class="services-grid">
                <!-- 1. Аудит -->
                <div class="service-card fade-up">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </div>
                    <h3 class="service-card__title">Аудити молиявӣ</h3></div>
                    <p class="service-card__text">Шумо санҷиши мустақили гузоришотро ба даст меоред, ки шаффофияти тиҷоратро тасдиқ намуда, хатарҳои молиявии пинҳониро ошкор месозад.</p>
                    <a href="<?php echo home_url('/service-audit-tj?lang=tj'); ?>" class="service-card__link">Идомаи хониш →</a>
                </div>

                <!-- 2. Барқарорсозӣ -->
                <div class="service-card fade-up fade-up-delay-1">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                    </div>
                    <h3 class="service-card__title">Барқарорсозии баҳисобгирии молиявӣ</h3></div>
                    <p class="service-card__text">Мо санадҳои номураттаби Шуморо ба тартиби пурра дароварда, иштибоҳҳоро рафъ мекунем ва Шуморо аз даъвоҳои мақомоти давлатӣ ҳифз менамоем.</p>
                    <a href="<?php echo home_url('/service-restore-tj?lang=tj'); ?>" class="service-card__link">Идомаи хониш →</a>
                </div>

                <!-- 3. Ҳуқуқ -->
                <div class="service-card fade-up fade-up-delay-2">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="service-card__title">Машваратҳои ҳуқуқӣ</h3></div>
                    <p class="service-card__text">Шумо амнияти ҳуқуқии ширкати худро таъмин намуда, манфиатҳоятонро дар ҳама гуна қарордодҳо ва баҳсҳо ба таври боэътимод ҳифз мекунед.</p>
                    <a href="<?php echo home_url('/service-legal-tj?lang=tj'); ?>" class="service-card__link">Идомаи хониш →</a>
                </div>

                <!-- 4. Муҳосибот -->
                <div class="service-card fade-up">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="service-card__title">Баҳисобгирии молиявӣ ва кадрӣ</h3></div>
                    <p class="service-card__text">Мо тамоми корҳои якнавохти муҳосибӣ ва кадриро ба дӯш гирифта, набудани ҷаримаҳо ва фаъолияти устувори ҳайати кормандонро кафолат медиҳем.</p>
                    <a href="<?php echo home_url('/service-accounting-tj?lang=tj'); ?>" class="service-card__link">Идомаи хониш →</a>
                </div>

                <!-- 5. Котибот -->
                <div class="service-card fade-up fade-up-delay-1">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <h3 class="service-card__title">Хидматҳои котибот</h3></div>
                    <p class="service-card__text">Шумо идораи санадҳо ва тамосҳои телефониро ба мутахассисон вогузор намуда, вақти худро барои вазифаҳои роҳбурдӣ озод мекунед.</p>
                    <a href="<?php echo home_url('/service-secretariat-tj?lang=tj'); ?>" class="service-card__link">Идомаи хониш →</a>
                </div>

                <!-- 6. Консалтинг -->
                <div class="service-card fade-up fade-up-delay-2">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                    </div>
                    <h3 class="service-card__title">Машварати тиҷоратӣ</h3></div>
                    <p class="service-card__text">Шумо дар ёфтани нуқтаҳои нави рушд ва таҳияи модели самараноки рушди корхонаи худ дастгирии коршиносиро ба даст меоред.</p>
                    <a href="<?php echo home_url('/service-consulting-tj?lang=tj'); ?>" class="service-card__link">Идомаи хониш →</a>
                </div>

                <!-- 7. Андоз -->
                <div class="service-card fade-up">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h3 class="service-card__title">Машваратҳои андозӣ</h3></div>
                    <p class="service-card__text">Мо барои ба таври қонунӣ беҳсозӣ намудани сарбории андоз ва ба ҳадди ақал расонидани хатарҳо пеш аз санҷишҳои мақомоти назоратӣ кумак мерасонем.</p>
                    <a href="<?php echo home_url('/service-tax-tj?lang=tj'); ?>" class="service-card__link">Идомаи хониш →</a>
                </div>

                <!-- 8. Идоракунӣ -->
                <div class="service-card fade-up fade-up-delay-1">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/></svg>
                    </div>
                    <h3 class="service-card__title">Баҳисобгирии идоракунӣ</h3></div>
                    <p class="service-card__text">Шумо шаффофияти пурраи молиявӣ ва маълумоти дақиқро барои қабули қарорҳое ба даст меоред, ки воқеан фоидаи Шуморо зиёд мекунанд.</p>
                    <a href="<?php echo home_url('/service-management-tj?lang=tj'); ?>" class="service-card__link">Идомаи хониш →</a>
                </div>

                <!-- 9. Худкорсозӣ -->
                <div class="service-card fade-up fade-up-delay-2">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    </div>
                    <h3 class="service-card__title">Худкорсозии равандҳои тиҷоратӣ</h3></div>
                    <p class="service-card__text">Шумо бо гузаронидани идоракунӣ ба муҳити рақамии зуд ва дақиқ, гурӯҳи кории худро аз корҳои якнавохт озод намуда, иштибоҳҳои омили инсониро аз байн мебаред.</p>
                    <a href="<?php echo home_url('/service-automation-tj?lang=tj'); ?>" class="service-card__link">Идомаи хониш →</a>
                </div>

                <!-- 10. Банақшагирӣ -->
                <div class="service-card fade-up">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/><path d="M9 14h6"/><path d="M9 18h6"/><path d="M9 10h6"/></svg>
                    </div>
                    <h3 class="service-card__title">Нақшаҳои тиҷоратӣ ва АТИ</h3></div>
                    <p class="service-card__text">Шумо санади муфассали молиявиеро ба даст меоред, ки баргардонидани хароҷоти лоиҳаи Шуморо исбот намуда, барои боэътимод ҷалб кардани сармоя ё қарзҳои бонкӣ кумак мерасонад.</p>
                    <a href="<?php echo home_url('/service-business-plan-tj?lang=tj'); ?>" class="service-card__link">Идомаи хониш →</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
