<?php get_header(); ?>
<main id='primary' class='site-main'>
<section class="hero">
    <div class="hero__geo"></div>
    <div class="hero__grid-pattern"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>

    <div class="container hero__container" style="position:relative;z-index:2;">
        <div class="hero__content">
            <div class="hero__badge">Консалтинги тиҷоратӣ</div>
            <h1 class="hero__title">
                Ҳал<br><em>мекунем!</em>
            </h1>
            <p class="hero__desc">
                Аудити касбӣ, банақшагирии андоз ва мушоияти ҳуқуқии тиҷорат. <strong>Эътимоднокӣ ва коршиносӣ</strong> барои муваффақияти Шумо.
            </p>
        </div>
        <div class="hero__actions--right" style="margin-top: 60px !important;">
            <a href="#services" class="btn btn--primary btn-animated">
                Хидматрасониҳои мо
                <svg class="btn__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
            <a href="#contacts" class="btn btn--outline-light btn-animated-light">Тамос бо мо</a>
        </div>
    </div>

</section>

<!-- ═══════════ STATS RIBBON (RESTYLED TO MATCH SERVICES) ═══════════ -->
<section class="section section--gray stats-ribbon-block" style="padding-top: 80px; padding-bottom: 0;">
    <div class="container">
        <div style="display: flex; justify-content: flex-end; margin-bottom: 50px;">
            <div class="section__label" style="margin-bottom: 0;">Таҷрибаи мо</div>
        </div>
        <div class="services-grid" style="grid-template-columns: repeat(4, 1fr); gap: 20px;">
            <!-- 1 -->
            <div class="service-card fade-up" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon stat-icon">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">500<em style="font-style: normal !important;">+</em></div>
                <p class="service-card__text"
                    style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 14px !important; line-height: 1.4 !important; text-align: center !important; max-width: 160px !important; margin: 0 auto !important; color: var(--nk-gray-500) !important; white-space: normal !important;">
                    Мизоҷони қаноатманд</p>
            </div>
            <!-- 2 -->
            <div class="service-card fade-up fade-up-delay-1" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon stat-icon">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;"><?php echo (date('Y') - 2016); ?><em style="font-style: normal !important;">+</em></div>
                <p class="service-card__text"
                    style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 14px !important; line-height: 1.4 !important; text-align: center !important; max-width: 160px !important; margin: 0 auto !important; color: var(--nk-gray-500) !important; white-space: normal !important;">
                    Сол дар хидмат</p>
            </div>
            <!-- 3 -->
            <div class="service-card fade-up fade-up-delay-2" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon stat-icon">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">50<em style="font-style: normal !important;">+</em></div>
                <p class="service-card__text"
                    style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 14px !important; line-height: 1.4 !important; text-align: center !important; max-width: 160px !important; margin: 0 auto !important; color: var(--nk-gray-500) !important; white-space: normal !important;">
                    Коршиносони лаёқатманд</p>
            </div>
            <!-- 4 -->
            <div class="service-card fade-up fade-up-delay-3" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon stat-icon">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">1200<em style="font-style: normal !important;">+</em></div>
                <p class="service-card__text"
                    style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 14px !important; line-height: 1.4 !important; text-align: center !important; max-width: 160px !important; margin: 0 auto !important; color: var(--nk-gray-500) !important; white-space: normal !important;">
                    Лоиҳаҳои муваффақ</p>
            </div>

        </div>
    </div>
</section>


<!-- ═══════════ SERVICES ═══════════ -->
<section id="services" class="section section--gray">
    <div class="container">
        <div class="section__header section__header--center">
            <div class="section__label">Самтҳо</div>
            <h2 class="section__title section__title--huge"><span class="text-gradient">Роҳҳалҳои маҷмӯӣ</span><br>барои тиҷорати шумо</h2>
            <p class="section__subtitle section__subtitle--free">Ҳар як хизматрасонӣ ба талаботи инфиродии мизоҷ мутобиқ карда мешавад <br> ва <strong>ҳифзи ҳадди аксари манфиатҳои Шуморо</strong> таъмин менамояд.</p>
        </div>

        <div class="services-grid">
            <!-- 1. Аудит финансовой деятельности -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </div>
                    <h3 class="service-card__title">Аудити фаъолияти молиявӣ</h3>
                </div>
                <p class="service-card__text">Шумо санҷиши мустақили гузоришотро ба даст меоред, ки шаффофияти тиҷоратро тасдиқ намуда, хатарҳои пинҳонии молиявиро ошкор месозад.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Вазифаҳои мо:</span>
                    <ul class="service-card__list">
                        <li>Арзёбии сатҳи ташкили баҳисобгирии муҳосибӣ ва низомҳои назорат</li>
                        <li>Санҷиши дурустӣ ва қонунмандии сабтҳои муҳосибӣ</li>
                        <li>Таҳлили дурнамои рӯйдодҳои ояндаи фаъолият</li>
                        <li>Ошкор намудани захираҳо барои афзоиши манбаъҳои молиявӣ</li>
                        <li>Тасдиқи саҳеҳии гузоришот ва аудити андоз</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-audit-tj?lang=tj'); ?>" class="service-card__link">Муфассал →</a>
            </div>

            <!-- 2. Восстановление финансового учета -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                    </div>
                    <h3 class="service-card__title">Барқарорсозии баҳисобгирии молиявӣ</h3>
                </div>
                <p class="service-card__text">Мо санадҳои номураттаби Шуморо ба тартиби комил дароварда, иштибоҳҳоро рафъ месозем ва Шуморо аз даъвоҳои мақомоти давлатӣ эмин нигоҳ медорем.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Вазифаҳои мо:</span>
                    <ul class="service-card__list">
                        <li>Барқарорсозии баҳисобгирӣ ва рафъи норасоиҳои давраҳои гузашта</li>
                        <li>Машварати ҳуқуқӣ дар бахши молия</li>
                        <li>Мураттабсозӣ ва бақайдгирии санадҳои ибтидоӣ</li>
                        <li>Муқоисаи ҳисобҳо бо шарикони тиҷоратӣ ва мақомоти андоз ҷиҳати пешгирии ҷаримаҳо</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-restore-tj?lang=tj'); ?>" class="service-card__link">Муфассал →</a>
            </div>

            <!-- 3. Юридические консультации -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="service-card__title">Машваратҳои ҳуқуқӣ</h3>
                </div>
                <p class="service-card__text">Шумо амнияти ҳуқуқии ширкати худро таъмин намуда, манфиатҳоятонро дар ҳама гуна шартномаҳо ва баҳсҳо ба таври эътимоднок ҳифз менамоед.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Вазифаҳои мо:</span>
                    <ul class="service-card__list">
                        <li>Бақайдгирӣ ва бақайдгирии дубораи шахсони ҳуқуқӣ</li>
                        <li>Мушоият ва барасмиятдарории аҳдҳои амволи ғайриманқул</li>
                        <li>Намояндагӣ аз манфиатҳо дар тамоми мақомоти судӣ</li>
                        <li>Кумаки ҳуқуқӣ ва ташхиси қарордодҳои корпоративӣ</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-legal-tj?lang=tj'); ?>" class="service-card__link">Муфассал →</a>
            </div>

            <!-- 4. Ведение финансового и кадрового учета -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="service-card__title">Пешбурди баҳисобгирии молиявӣ ва кадрӣ</h3>
                </div>
                <p class="service-card__text">Мо тамоми корҳои рӯзмарраи муҳосибот ва кадрҳоро ба дӯш гирифта, ба Шумо набудани ҷаримаҳо ва фаъолияти мунтазами ҳайати кормандонро кафолат медиҳем.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Вазифаҳои мо:</span>
                    <ul class="service-card__list">
                        <li>Пешбурди баҳисобгирии муҳосибӣ дар 1С ва ҳисобкунии музди меҳнат</li>
                        <li>Ифтитоҳи суратҳисобҳо ва пешбурди интизоми хазинавӣ</li>
                        <li>Супоридани ҳамаи намудҳои гузоришот тибқи меъёрҳои СБҲМ (МСФО)</li>
                        <li>Коргузории пурраи кадрӣ ва баҳисобгирии вақти корӣ</li>
                        <li>Барасмиятдарории рухсатиҳо, сафарҳои корӣ ва дастурамалҳои мансабӣ</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-accounting-tj?lang=tj'); ?>" class="service-card__link">Муфассал →</a>
            </div>

            <!-- 5. Услуги секретариата -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <h3 class="service-card__title">Хизматрасониҳои котибот</h3>
                </div>
                <p class="service-card__text">Шумо идораи санадҳо ва тамосҳои телефониро ба мутахассисон вогузор намуда, вақти худро барои ҳалли вазифаҳои роҳбурдӣ озод менамоед.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Вазифаҳои мо:</span>
                    <ul class="service-card__list">
                        <li>Гирифтани иҷозатнома барои ҷалби шаҳрвандони хориҷӣ</li>
                        <li>Омодасозии даъватномаҳо, иҷозатномаҳо ва раводидҳо (М, К, О-2)</li>
                        <li>Бақайдгирӣ дар ХШБ (ОВИР) ва барасмиятдарории кортҳои Дипсервис</li>
                        <li>Берунсипорӣ (аутсорсинг)-и хизматрасониҳои котибот ва тарҷумаи ҳуқуқӣ</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-secretariat-tj?lang=tj'); ?>" class="service-card__link">Муфассал →</a>
            </div>

            <!-- 6. Бизнес-консультации -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                    </div>
                    <h3 class="service-card__title">Машваратҳои тиҷоратӣ</h3>
                </div>
                <p class="service-card__text">Шумо дар дарёфти нуқтаҳои нави рушд ва таҳияи намунаи (модели) самараноки рушди корхонаи худ дастгирии коршиносиро ба даст меоред.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Вазифаҳои мо:</span>
                    <ul class="service-card__list">
                        <li>Бунёди низомҳои идоракунии роҳбурдӣ</li>
                        <li>Аудити амиқ ва беҳсозии равандҳои тиҷоратӣ</li>
                        <li>Банақшагирии молиявӣ ва таҳияи моделҳои рушд</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-consulting-tj?lang=tj'); ?>" class="service-card__link">Муфассал →</a>
            </div>

            <!-- 7. Налоговые консультации -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h3 class="service-card__title">Машваратҳои андозӣ</h3>
                </div>
                <p class="service-card__text">Мо ба Шумо барои ба таври қонунӣ муносиб гардонидани сарбории андоз ва ба ҳадди ақал расонидани хатарҳо пеш аз ташрифи мақомоти назоратӣ кумак мерасонем.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Вазифаҳои мо:</span>
                    <ul class="service-card__list">
                        <li>Машваратҳои касбӣ (барои шахсони ҳуқуқӣ ва воқеӣ)</li>
                        <li>Таҳияи сиёсати бехатари андоз</li>
                        <li>Намояндагӣ аз манфиатҳо дар баҳсҳои андозӣ</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-tax-tj?lang=tj'); ?>" class="service-card__link">Муфассал →</a>
            </div>

            <!-- 8. Управленческий учет -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/></svg>
                    </div>
                    <h3 class="service-card__title">Баҳисобгирии идоракунӣ</h3>
                </div>
                <p class="service-card__text">Шумо шаффофияти пурраи молиявӣ ва маълумоти саҳеҳро барои қабули қарорҳое ба даст меоред, ки фоидаи софи Шуморо ба таври воқеӣ афзоиш медиҳанд.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Вазифаҳои мо:</span>
                    <ul class="service-card__list">
                        <li>Ҷорӣ намудани гузоришҳои гардиши маблағҳои пуллӣ (Cash Flow), фоида ва зиён (P&L) ва тавозун</li>
                        <li>Ҳисобкунии даромаднокӣ аз рӯи самтҳо ва лоиҳаҳо</li>
                        <li>Банақшагирии хазинавӣ ва танзими тақвимҳо</li>
                        <li>Аёниятсозии нишондиҳандаҳои молиявӣ барои моликон</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-management-tj?lang=tj'); ?>" class="service-card__link">Муфассал →</a>
            </div>

            <!-- 9. Автоматизация бизнес-процессов -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    </div>
                    <h3 class="service-card__title">Худкорсозии равандҳои тиҷоратӣ</h3>
                </div>
                <p class="service-card__text">Шумо гурӯҳи кории худро аз корҳои якнавохт озод намуда, иштибоҳҳои омили инсониро истисно мекунед ва идоракуниро ба муҳити рақамии зуд ва саҳеҳ интиқол медиҳед.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Вазифаҳои мо:</span>
                    <ul class="service-card__list">
                        <li>Ҷорӣ кардан ва танзими низомҳои баҳисобгирии 1С</li>
                        <li>Ҳамгироии (интегратсияи) CRM, Bitrix24 ва низомҳои идоракунӣ</li>
                        <li>Танзими пайвастагиҳои баҳисобгирӣ бо «Миштарии бонк» (Клиент-банк)</li>
                        <li>Рақамикунонии бойгониҳо ва гардиши электронии санадҳо</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-automation-tj?lang=tj'); ?>" class="service-card__link">Муфассал →</a>
            </div>

            <!-- 10. Разработка бизнес-планов и ТЭО -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__header">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/><path d="M9 14h6"/><path d="M9 18h6"/><path d="M9 10h6"/></svg>
                    </div>
                    <h3 class="service-card__title">Таҳияи нақшаҳои тиҷоратӣ ва АТИ-и лоиҳаҳо</h3>
                </div>
                <p class="service-card__text">Шумо санади муфассал ва асоснокшудаи молиявиро ба даст меоред, ки баргардонидани хароҷоти лоиҳаатонро исбот намуда, барои ба таври кафолатнок ҷалб кардани сармоя ё қарзҳои бонкӣ кумак мерасонад.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Вазифаҳои мо:</span>
                    <ul class="service-card__list">
                        <li>Гузаронидани таҳлили амиқи бозор, муҳити рақобатӣ ва аудитория</li>
                        <li>Таҳияи модели муфассали молиявӣ (даромад, хароҷот, нуқтаи безарарӣ)</li>
                        <li>Таҳияи АТИ (Асосноккунии техникию иқтисодӣ) тибқи талаботи ҶТ</li>
                        <li>Омодасозии маводи рӯнамоӣ (Pitch Deck) барои ҳимояи лоиҳа</li>
                        <li>Мушоият ва ҳимояи нақшаи тиҷоратӣ дар гуфтушунидҳо бо сармоягузорон</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-business-plan-tj?lang=tj'); ?>" class="service-card__link">Муфассал →</a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ ABOUT ═══════════ -->
<section id="about" class="about section">
    <!-- Geometric Background mirroring Hero -->
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    
        <div class="ceo-editorial fade-up is-visible">
            <div class="section__label section__label--on-dark">Дар бораи ширкат</div>
            <h2 class="section__title section__title--huge section__title--on-dark">
                <span class="text-gradient">Шарики боэътимоди шумо</span><br>дар тиҷорат
            </h2>
            <p class="ceo-editorial__intro">
                ҶДММ «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП» — соли 2016 таъсис ёфтааст. Дар ин муддат мо аз як ширкати дорои тахассуси маҳдуд ба <strong>як маркази тавонои машваратӣ</strong> таҳаввул ёфта, устуворӣ ва амнияти тиҷоратро дар ҳар марҳилаи рушд таъмин менамоем.
            </p>
            <div class="ceo-editorial__quote-card">
                <blockquote class="ceo-editorial__quote-text">
                    Рисолати мо — ба низоми шаффоф ва даромаднок табдил додани равандҳои мураккаби тиҷоратӣ мебошад. Мо барои натиҷаи Шумо фаъолият менамоем ва ҳифзи манфиатҳои Шуморо дар сатҳи олӣ таъмин мекунем.
                </blockquote>
                <div class="ceo-editorial__author">
                    <div class="ceo-editorial__circle-frame">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ceo.jpg" alt="Зоир Салимов" class="ceo-editorial__avatar">
                    </div>
                    <div class="cea-editorial__author-info">
                        <div class="ceo-editorial__author-name">Зоир Салимов</div>
                        <div class="ceo-editorial__author-title">Директори генералӣ, NEKSOZ</div>
                    </div>
                    <div class="ceo-editorial__signature">Zoir Salimov</div>
                    <div class="ceo-editorial__footer">
                        <a href="<?php echo home_url('/team'); ?>" class="ceo-editorial__team-link">
                            Бо дастаи коршиносони мо шинос шавед
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Closing container -->
</section>

<!-- ═══════════ CTA — CRYSTAL ELEGANCE EDITION ═══════════ -->
<section id="contacts" class="cta-crystal">
    <!-- Animated Mesh Glows -->
    <div class="cta-crystal__glow cta-crystal__glow--blue"></div>
    <div class="cta-crystal__glow cta-crystal__glow--red"></div>
    
    <div class="container">
        <div class="cta-crystal__grid">
            
            <!-- Left Side: Soft Modern Persuasion -->
            <div class="cta-crystal__content fade-up is-visible">
                <div class="section__label">Тамоси фаврӣ</div>
                <h2 class="cta-crystal__title"><span class="text-gradient">Оё барои густариши</span><br>муваффақияти<br>худ омодаед?</h2>
                <p class="cta-crystal__text">Ҳамин имрӯз дархост гузоред ва мо барои Шумо роҳбурди инфиродии рушд ва таъмини амнияти тиҷорататонро таҳия менамоем.</p>
                <div class="cta-crystal__status">
                    <span class="cta-crystal__status-dot"></span>
                    Мо онлайн ҳастем • Посух дар давоми 15 дақиқа
                </div>
            </div>

            <!-- Right Side: Crystal Tech Form -->
            <div class="cta-crystal__form-wrapper fade-up is-visible">
                <form action="#" class="cta-crystal__form">
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " required id="f-name">
                        <label for="f-name">Номи шумо</label>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="tel" placeholder=" " required id="f-phone">
                        <label for="f-phone">Телефон (+992)</label>
                    </div>
                    <div class="cta-crystal__field nx-dropdown">
                        <input type="text" placeholder=" " required id="f-service-input" class="nx-dropdown__trigger" readonly>
                        <label for="f-service-input">Самтро интихоб кунед <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px; display: inline-block; vertical-align: middle;"><path d="m6 9 6 6 6-6"/></svg></label>
                        
                        <div class="nx-dropdown__panel">
                            <div class="nx-dropdown__option">Дастгирии ҳуқуқӣ</div>
                            <div class="nx-dropdown__option">Машварати андозӣ</div>
                            <div class="nx-dropdown__option">Аудит ва ҳисобдорӣ</div>
                            <div class="nx-dropdown__option">Автоматикунонии тиҷорат</div>
                            <div class="nx-dropdown__option">Консалтинги тиҷоратӣ</div>
                            <div class="nx-dropdown__option">Баҳисобгирии идоракунӣ</div>
                            <div class="nx-dropdown__option">Барқарорсозии баҳисобгирӣ</div>
                            <div class="nx-dropdown__option">Хидматрасонии котиботӣ</div>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <textarea placeholder=" " id="f-msg" rows="3"></textarea>
                        <label for="f-msg">Мӯҳтавои дархости шумо</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn">
                        <span>Ирсоли дархост</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                    <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        Бо пахш кардани тугма, шумо ба <a href="<?php echo home_url('/privacy-policy'); ?>" style="color: var(--nk-blue); text-decoration: underline;">Сиёсати махфият</a> розӣ мешавед.
                    </p>
                    <p class="cta-crystal__secure">🛡️ Пайвасти ҳифзшуда (SSL 256-bit)</p>
                    <div id="nk-form-status" style="margin-top: 15px; display: none;"></div>
                </form>

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
