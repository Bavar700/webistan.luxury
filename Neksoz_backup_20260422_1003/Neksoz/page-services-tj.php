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
                <div class="hero__badge">Маҷмӯи пурраи ҳалли масъалаҳо</div>
                <h1 class="hero__title">
                    Хидматрасониҳои<br>
                    <span class="text-gradient">муҷаҳҳаз барои рушди</span><br>
                    <span style="color: var(--nk-blue);">тиҷорати шумо</span>
                </h1>
                <p class="hero__desc">
                    Мо дастгирии коршиносиро дар ҳар як марҳилаи давраи ҳаётии ширкат пешниҳод менамоем — аз бақайдгирӣ то рушд.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary">Машварат</a>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="section section--gray">
        <div class="container">
            <div class="services-grid">
                <!-- 1. Аудит -->
                <div class="service-card fade-up">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </div>
                    <h3 class="service-card__title">Аудити фаъолияти молиявӣ</h3></div></div>
                    <p class="service-card__text">Шумо санҷиши мустақили ҳисоботро ба даст меоред, ки шаффофияти тиҷоратро тасдиқ намуда, хавфҳои молиявии пинҳоншударо ошкор мекунад.</p>
                    <a href="<?php echo home_url('/service-audit'); ?>" class="service-card__link">Муфассал →</a>
                </div>

                <!-- 2. Восстановление -->
                <div class="service-card fade-up fade-up-delay-1">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                    </div>
                    <h3 class="service-card__title">Барқарорсозии баҳисобгирии молиявӣ</h3></div></div>
                    <p class="service-card__text">Мо ҳуҷҷатҳои бетартиби шуморо ба низом дароварда, хатогиҳоро бартараф ва шуморо аз даъвоҳои мақомоти давлатӣ муҳофизат мекунем.</p>
                    <a href="<?php echo home_url('/service-restore'); ?>" class="service-card__link">Муфассал →</a>
                </div>

                <!-- 3. Юридические -->
                <div class="service-card fade-up fade-up-delay-2">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="service-card__title">Дастгирии ҳуқуқӣ</h3></div></div>
                    <p class="service-card__text">Шумо амнияти ҳуқуқии ширкати худро таъмин намуда, манфиатҳоятонро дар ҳама гуна шартномаҳо ва баҳсҳо ҳифз мекунед.</p>
                    <a href="<?php echo home_url('/service-legal'); ?>" class="service-card__link">Муфассал →</a>
                </div>

                <!-- 4. Ведение учета -->
                <div class="service-card fade-up">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="service-card__title">Пешбурди баҳисобгирии молиявӣ ва кадрӣ</h3></div></div>
                    <p class="service-card__text">Мо тамоми корҳои муқаррариро оид ба ҳисобдорӣ ва кадрҳо ба дӯши худ мегирем ва барои шумо набудани ҷарима ва фаъолияти мӯътадили кормандонро кафолат медиҳем.</p>
                    <a href="<?php echo home_url('/service-accounting'); ?>" class="service-card__link">Муфассал →</a>
                </div>

                <!-- 5. Секретариат -->
                <div class="service-card fade-up fade-up-delay-1">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <h3 class="service-card__title">Хидматрасониҳо секретариата</h3></div></div>
                    <p class="service-card__text">Шумо идоракунии ҳуҷҷатҳо ва зангҳоро ба мутахассисон вогузор карда, вақти худро барои ҳалли вазифаҳои стратегӣ озод мекунед.</p>
                    <a href="<?php echo home_url('/service-secretariat'); ?>" class="service-card__link">Муфассал →</a>
                </div>

                <!-- 6. Машваратҳои тиҷоратӣ -->
                <div class="service-card fade-up fade-up-delay-2">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                    </div>
                    <h3 class="service-card__title">Машваратҳои тиҷоратӣ</h3></div></div>
                    <p class="service-card__text">Шумо дар ҷустуҷӯи нуқтаҳои нави рушд ва таҳияи модели самараноки рушди корхонаи худ дастгирии касбӣ мегиред.</p>
                    <a href="<?php echo home_url('/service-consulting'); ?>" class="service-card__link">Муфассал →</a>
                </div>

                <!-- 7. Налоговые -->
                <div class="service-card fade-up">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h3 class="service-card__title">Машваратҳои андозӣ</h3></div></div>
                    <p class="service-card__text">Мо ба шумо кӯмак мекунем, ки сарбории андозро қонунӣ коҳиш диҳед ва хавфҳоро пеш аз тафтиши мақомоти назоратӣ кам кунед.</p>
                    <a href="<?php echo home_url('/service-tax'); ?>" class="service-card__link">Муфассал →</a>
                </div>

                <!-- 8. Баҳисобгирии идоракунӣ -->
                <div class="service-card fade-up fade-up-delay-1">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/></svg>
                    </div>
                    <h3 class="service-card__title">Баҳисобгирии идоракунӣ</h3></div></div>
                    <p class="service-card__text">Шумо шаффофияти пурраи молиявӣ ва маълумоти дақиқро барои қабули қарорҳое ба даст меоред, ки фоидаи софи шуморо воқеан зиёд мекунанд.</p>
                    <a href="<?php echo home_url('/service-management'); ?>" class="service-card__link">Муфассал →</a>
                </div>

                <!-- 9. Автоматизация -->
                <div class="service-card fade-up fade-up-delay-2">
                    <div class="service-card__header"><div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    </div>
                    <h3 class="service-card__title">Автоматикунонии равандҳои тиҷоратӣ</h3></div></div>
                    <p class="service-card__text">Шумо дастаро аз корҳои муқаррарӣ озод карда, хатогиҳои омили инсониро аз байн мебаред ва идоракуниро ба муҳити рақамии зуд ва дақиқ интиқол медиҳед.</p>
                    <a href="<?php echo home_url('/service-automation'); ?>" class="service-card__link">Муфассал →</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

