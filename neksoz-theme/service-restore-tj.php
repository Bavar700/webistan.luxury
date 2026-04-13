<?php
/**
 * Template Name: Барқарорсозии баҳисобгирии молиявӣ
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
                    Барқарорсозии пурраи<br>
                    <span class="text-gradient">баҳисобгирии</span><br>
                    <span style="color: var(--nk-blue);">тиҷорат</span>
                </h1>
                <p class="hero__desc">
                    Ба тартиб овардани ҳуҷҷатҳои беэътиношуда, бартараф кардани хатогиҳо ва ҳифз аз даъвоҳои мақомоти назоратӣ.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Барқарор кардани тартибот</span>
                    <svg width="20" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <!-- New Section Header -->
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Таҳлили ҳолат</div>
                <h2 class="section__title">Муносибати маҷмӯӣ ба барқарорсозӣ</h2>
                <p class="section__subtitle">Мо на танҳо хатогиҳоро ислоҳ мекунем, балки системаи боэътимоди молиявиро аз сифр месозем.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- ROW 1, CARD 1: В каких случаях вам нужна эта услуга? -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                    </div>
                    <h3 class="service-card__title">Кай ин хидматрасонӣ <br>лозим аст?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Муҳосиб иваз шуд, корҳо супорида нашуданд</li>
                            <li>Ҳуҷҷатҳои ибтидоӣ ё базаҳои 1С гум шудаанд</li>
                            <li>Санҷиши андоз наздик аст</li>
                            <li>Ҳисобҳо аз ҷониби мақомоти давлатӣ баста шудаанд</li>
                            <li>Баҳисобгирӣ зиёда аз 3 моҳ пеш бурда нашудааст</li>
                        </ul>
                    </div>
                </div>

                <!-- ROW 1, CARD 2: Что входит в услугу -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <h3 class="service-card__title">Тафсилоти <br>раванд</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li><strong>Аудити пешакӣ:</strong> арзёбии миқёси мушкилот</li>
                            <li><strong>Ҷамъоварии маълумот:</strong> дархостҳо ба бонкҳо ва контрагентҳо</li>
                            <li><strong>Вуруд ба база:</strong> барқарорсозии ҳамаи давраҳо</li>
                            <li><strong>Муқоиса бо Кумитаи андоз:</strong> бартараф кардани ҳамаи номувофиқатҳо</li>
                            <li><strong>Бардоштани ҳабс:</strong> боз кардани ҳисобҳои шумо</li>
                        </ul>
                    </div>
                </div>

                <!-- ROW 2, CARD 1: Как мы работаем -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <h3 class="service-card__title">Нақшаи марҳилавии <br>ҳамкорӣ</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Ба имзо расонидани шартнома ва NDA</li>
                            <li>Баҳодиҳии мухтасари ройгони ҳаҷм</li>
                            <li>Марҳилаи барқарорсозии фаъоли маълумот</li>
                            <li>Ҳифзи натиҷа дар назди мақомоти давлатӣ</li>
                            <li>Супоридани базаи тозаи 1С ва тавсияҳо</li>
                        </ul>
                    </div>
                </div>

                <!-- ROW 2, CARD 2: Что вы получаете в итоге -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 class="service-card__title">Натиҷа барои <br>тиҷорати шумо</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li><strong>Қонунияти пурра:</strong> тибқи қонунҳои ҶТ</li>
                            <li><strong>Хавфҳои сифр:</strong> набудани ҷаримаҳо ва пеняҳо</li>
                            <li><strong>Шаффофият:</strong> шумо фоидаи воқеиро мебинед</li>
                            <li><strong>Амният:</strong> ҳифз аз санҷишҳо</li>
                            <li><strong>Тартибот:</strong> бойгонии беҳтарини ҳуҷҷатҳо</li>
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
                <div class="section__label">Арзёбии хавфҳо</div>
                <h2 class="section__title">Баҳодиҳии экспресси ройгон</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Барои таҳлили пешакии ҳолати баҳисобгирии худ дархост гузоред. Мо бо шумо дар давоми 30 дақиқа тамос хоҳем гирифт.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="sr-name">
                            <label for="sr-name">Номи шумо</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="sr-phone">
                            <label for="sr-phone">Телефон (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="sr-company">
                        <label for="sr-company">Номи ширкат (ихтиёрӣ)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Арзёбии арзиш</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
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

