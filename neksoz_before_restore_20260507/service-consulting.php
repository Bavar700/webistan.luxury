<?php
/**
 * Template Name: service-consulting
 */
if (function_exists('nk_get_current_lang')) {
    $lang = nk_get_current_lang();
    if ($lang === 'tj') { get_template_part('service-consulting', 'tj'); return; }
    if ($lang === 'en') { get_template_part('service-consulting', 'en'); return; }
}
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
                <div class="hero__badge">Консалтинг</div>
                <h1 class="hero__title">
                    <span style="white-space: nowrap;">Финансово-управленческий</span><br>
                    <span class="text-gradient" style="white-space: nowrap;">консалтинг бизнеса</span>
                </h1>
                <p class="hero__desc">
                    Стратегическое планирование, оптимизация денежных потоков и внедрение эффективных систем управления для масштабирования бизнеса.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Заказать консалтинг</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Стратегический рост</div>
                <h2 class="section__title">Экспертиза для вашего развития</h2>
                <p class="section__subtitle">Мы помогаем собственникам выйти из операционки и сбалансировать финансы компании.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
                    </div>
                    <h3 class="service-card__title">Когда нужен <br>консалтинг?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Бизнес не растет или прибыль падает</li>
                            <li>Кассовые разрывы и нехватка оборотки</li>
                            <li>Хаос в процессах и управленческом учете</li>
                            <li>Собственник слишком погружен в рутину</li>
                            <li>Нужна независимая оценка эффективности</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 12l-4 4-4-4"/><path d="M12 8v8"/></svg>
                    </div>
                    <h3 class="service-card__title">Что входит <br>в услугу?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Аудит системы управления и финансов</li>
                            <li>Внедрение управленческого учета (KPI)</li>
                            <li>Построение финансовой модели бизнеса</li>
                            <li>Оптимизация расходов и налогов</li>
                            <li>Разработка стратегии на 1-3 года</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <h3 class="service-card__title">Как мы <br>работаем?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Глубокое интервью и анализ данных</li>
                            <li>Поиск "узких мест" в работе компании</li>
                            <li>Разработка плана улучшений (Roadmap)</li>
                            <li>Пошаговое внедрение изменений</li>
                            <li>Контроль результатов и корректировка</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 4 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 class="service-card__title">Результат для <br>вашего бизнеса</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Рост чистой прибыли и рентабельности</li>
                            <li>Прозрачная картина финансов (P&L, CashFlow)</li>
                            <li>Системный подход к управлению командой</li>
                            <li>Выход собственника из операционного процесса</li>
                            <li>Устойчивость бизнеса к кризисам</li>
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
                <div class="section__label">Экспертный анализ</div>
                <h2 class="section__title">Бесплатная экспресс-консультация</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Оставьте заявку на предварительный анализ вашего бизнеса.<br>Мы свяжемся с вами в течение 30 минут.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="cn-name">
                            <label for="cn-name">Ваше имя</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="cn-phone">
                            <label for="cn-phone">Телефон (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="cn-company">
                        <label for="cn-company">Название компании (опционально)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Заказать расчет</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
                    <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        Нажимая кнопку, вы соглашаетесь с <a href="<?php echo nk_link('/privacy-policy', $current_lang); ?>" style="color: var(--nk-blue); text-decoration: underline;">Политикой конфиденциальности</a>
                    </p>
                    <p class="cta-crystal__secure" style="text-align: center; margin-top: 20px; font-size: 13px; color: var(--nk-gray-500); opacity: 0.8; width: 100%;">
                        🛡️ Защищённое соединение (SSL 256-bit)
                    </p>
                </form>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>



