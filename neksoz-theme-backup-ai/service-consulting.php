<?php
if (function_exists('nk_get_current_lang')) {
    $lang = nk_get_current_lang();
    if ($lang === 'tj') { get_template_part('service-consulting', 'tj'); return; }
    if ($lang === 'en') { get_template_part('service-consulting', 'en'); return; }
}

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
                    Экспертные<br>
                    <span class="text-gradient">бизнес-консультации</span><br>
                    <span style="color: var(--nk-blue);">для роста</span>
                </h1>
                <p class="hero__desc">
                    Стратегическая поддержка в поиске точек роста и разработке эффективных моделей развития вашего предприятия.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span>Обсудить проект</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Вектор роста</div>
                <h2 class="section__title">От хаоса к управляемой прибыли</h2>
                <p class="section__subtitle">Мы помогаем увидеть скрытые возможности и превратить их в конкретные финансовые результаты.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1: В каких случаях вам нужна эта услуга? -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h3 class="service-card__title">Когда нужны <br>консультации?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Бизнес "замер" и нет путей роста</li>
                            <li>Внутренние процессы стали хаотичными</li>
                            <li>Планируется запуск нового направления</li>
                            <li>Нужен порядок в фин. планировании</li>
                            <li>Предстоит крупная реорганизация</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2: Что входит в услугу -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
                    </div>
                    <h3 class="service-card__title">Что входит <br>в услугу?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Разработка системы стратегии управления</li>
                            <li>Глубокий аудит и оптимизация процессов</li>
                            <li>Финансовое планирование и бюджет</li>
                            <li>Консультации по реструктуризации активов</li>
                            <li>Разработка KPI и систем мотивации</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3: Как мы работаем -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    </div>
                    <h3 class="service-card__title">Как мы <br>работаем?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Диагностика и анализ текущих показателей</li>
                            <li>Поиск "узких мест" и потерь прибыли</li>
                            <li>Создание пошагового плана изменений</li>
                            <li>Внедрение новых инструментов управления</li>
                            <li>Сопровождение на этапе реализации</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 4: Что вы получаете в итоге -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 class="service-card__title">Результат для <br>вашего бизнеса</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Понятный вектор развития на 3-5 лет</li>
                            <li>Оптимизированная структура компании</li>
                            <li>Повышение операционной эффективности</li>
                            <li>Рост чистой прибыли и оборотов</li>
                            <li>Штат, где каждый на своем месте</li>
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
                <div class="section__label">Диагностика бизнеса</div>
                <h2 class="section__title">Бесплатная консультация</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Оставьте заявку на предварительный аудит бизнес-процессов. Мы свяжемся с вами в течение 30 минут.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="bc-name">
                            <label for="bc-name">Ваше имя</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="bc-phone">
                            <label for="bc-phone">Телефон (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="bc-company">
                        <label for="bc-company">Название компании (опционально)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Начать диагностику</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
                    <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        Нажимая кнопку, вы соглашаетесь с <a href="<?php
if (function_exists('nk_get_current_lang')) {
    $lang = nk_get_current_lang();
    if ($lang === 'tj') { get_template_part('service-consulting', 'tj'); return; }
    if ($lang === 'en') { get_template_part('service-consulting', 'en'); return; }
}
 echo home_url('/privacy-policy'); ?>" style="color: var(--nk-blue); text-decoration: underline;">Политикой конфиденциальности</a>
                    </p>
                    <p class="cta-crystal__secure" style="text-align: center; margin-top: 20px; font-size: 13px; color: var(--nk-gray-500); opacity: 0.8; width: 100%;">
                        🛡️ Защищённое соединение (SSL 256-bit)
                    </p>
                </form>
            </div>
        </div>
    </section>

</main>

<?php
if (function_exists('nk_get_current_lang')) {
    $lang = nk_get_current_lang();
    if ($lang === 'tj') { get_template_part('service-consulting', 'tj'); return; }
    if ($lang === 'en') { get_template_part('service-consulting', 'en'); return; }
}
 get_footer(); ?>
