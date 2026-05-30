<?php
/**
 * Template Name: service-automation
 */
if (function_exists('nk_get_current_lang')) {
    $lang = nk_get_current_lang();
    if ($lang === 'tj') { get_template_part('service-automation', 'tj'); return; }
    if ($lang === 'en') { get_template_part('service-automation', 'en'); return; }
}
get_header(); global $current_lang; 
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
                <div class="hero__badge">Департамент IT & Автоматизации</div>
                <h1 class="hero__title">
                    Цифровая автоматизация <span class="text-gradient">вашего бизнеса</span>
                </h1>
                <p class="hero__desc">
                    Внедрение современных IT-решений (1С, CRM, AI-инструменты) для исключения рутины и повышения точности управления.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Внедрить AI / CRM</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Цифровая эффективность</div>
                <h2 class="section__title">Технологии на службе вашего роста</h2>
                <p class="section__subtitle">Мы не просто ставим софт, мы выстраиваем систему, которая работает быстрее и точнее человека.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                    <h3 class="service-card__title">Когда нужна <br>автоматизация?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Много ручного ввода данных в таблицы</li>
                            <li>Теряются документы и задачи сотрудников</li>
                            <li>Сложно контролировать удаленные офисы</li>
                            <li>Информация передается медленно и с ошибками</li>
                            <li>Нужна прозрачная аналитика в 1 клик</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                    </div>
                    <h3 class="service-card__title">Что входит <br>в услугу?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Внедрение и настройка 1С (Бухгалтерия, УП)</li>
                            <li>Внедрение CRM и систем задач (Bitrix24)</li>
                            <li>Интеграция 1С с банками и порталами</li>
                            <li>Организация работы в облачных сервисах</li>
                            <li>Автоматизация складского и товарного учета</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    </div>
                    <h3 class="service-card__title">Как мы <br>работаем?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Обследование процессов для ускорения</li>
                            <li>Подбор ПО под бюджет и задачи бизнеса</li>
                            <li>Настройка софта и перенос базы данных</li>
                            <li>Обучение персонала работе в новых системах</li>
                            <li>Техническая поддержка и доработка</li>
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
                            <li>Ускорение работы сотрудников в 2-3 раза</li>
                            <li>Единая среда со статусом каждой задачи</li>
                            <li>Прозрачный контроль выполнения процессов</li>
                            <li>Минимизация ошибок человеческого фактора</li>
                            <li>Готовность к быстрому масштабированию</li>
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
                <div class="section__label">Тех аудит</div>
                <h2 class="section__title">Бесплатная экспресс-консультация</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Оставьте заявку на предварительный анализ ваших процессов.<br>Мы свяжемся с вами в течение 30 минут.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="au-name">
                            <label for="au-name">Ваше имя</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="au-phone">
                            <label for="au-phone">Телефон (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="au-company">
                        <label for="au-company">Название компании (опционально)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Внедрить решение</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
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



