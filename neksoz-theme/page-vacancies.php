<?php
/**
 * Template Name: Вакансии
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
                <div class="hero__badge">Карьера в Neksoz</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Станьте частью</span><br>команды
                </h1>
                <p class="hero__desc">
                    Мы ищем профессионалов, готовых расти вместе с нами и создавать лучшие финансовые решения.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="mailto:hr@neksoz.com" class="btn btn--primary">Отправить резюме</a>
            </div>
        </div>
    </section>

    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Открытые вакансии</h2>
            
            <div class="vacancy-card simple-card" style="margin-bottom: 30px;">
                <h3 style="color: var(--nk-red);">Помощник бухгалтера</h3>
                <p>Мы ищем человека, настроенного на быстрое обучение, максимально внимательного и скрупулезного в работе. Если вы любите цифры и не боитесь больших объемов информации — мы будем рады знакомству.</p>
                
                <h4 style="margin-top:20px;">Что нужно делать:</h4>
                <ul style="list-style: disc; padding-left: 20px; margin-top: 10px; color: var(--nk-gray-600);">
                    <li>Работа с первичной бухгалтерской документацией</li>
                    <li>Обработка платежей и работа в Клиент-Банке</li>
                    <li>Ведение кассы и контроль операций</li>
                    <li>Работа в 1С, CRM и Bitrix24</li>
                    <li>Систематизация и архивация документов</li>
                </ul>

                <h4 style="margin-top:20px;">Мы предлагаем:</h4>
                <ul style="list-style: disc; padding-left: 20px; margin-top: 10px; color: var(--nk-gray-600);">
                    <li>Поэтапное обучение до уровня самостоятельного бухгалтера</li>
                    <li>Профессиональное развитие в команде экспертов</li>
                    <li>График работы: 08:00 — 17:00</li>
                    <li>Зарплата обсуждается индивидуально по результатам собеседования</li>
                </ul>
            </div>

            <div class="simple-card" style="background: var(--nk-gray-50); margin-top: 40px;">
                <h4>Не нашли подходящую вакансию?</h4>
                <p>Отправьте свое резюме на <a href="mailto:info@neksoz.tj" style="color: var(--nk-red); font-weight: bold;">info@neksoz.tj</a>. Мы всегда в поиске талантливых аудиторов, юристов и консультантов.</p>
            </div>
        </div>

        <aside class="editorial-sidebar">
            <div class="simple-card" style="border-left: 4px solid var(--nk-red);">
                <h4>Почему Neksoz?</h4>
                <p style="font-size: 0.9rem; color: var(--nk-gray-600); margin-bottom: 15px;">Мы ценим интеллект и профессионализм. Наша команда — это люди, объединенные общей целью.</p>
                <ul style="list-style: none; padding: 0; font-size: 0.9rem;">
                    <li style="padding: 8px 0; border-bottom: 1px solid var(--nk-gray-100);">✓ Современный офис в центре</li>
                    <li style="padding: 8px 0; border-bottom: 1px solid var(--nk-gray-100);">✓ Карьерный лифт</li>
                    <li style="padding: 8px 0; border-bottom: 1px solid var(--nk-gray-100);">✓ Обучение за счет компании</li>
                    <li style="padding: 8px 0;">✓ Дружный коллектив</li>
                </ul>
            </div>
        </aside>
    </div>

</main>

<?php get_footer(); ?>
