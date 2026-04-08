<?php
/**
 * Template Name: Бухгалтерские услуги
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
                <div class="hero__badge">Департамент учета</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Бухгалтерское</span><br>сопровождение
                </h1>
                <p class="hero__desc">
                    Комплексное ведение учета на аутсорсинге — экономия на штате и уверенность в каждом отчете.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="javascript:void(0)" onclick="openRequestModal('accounting')" class="btn btn--primary">Заказать учет</a>
            </div>
        </div>
    </section>

    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Профессиональное ведение учета на базе Аутсорсинга</h2>
            <p>
                Мы обеспечиваем <strong>целостное и непрерывное отражение</strong> всех хозяйственных операций вашего предприятия. Передача бухгалтерии на аутсорсинг в Neksoz — это не просто аутсорс функций, а полноценное партнерство, направленное на финансовую стабильность вашего бизнеса.
            </p>

            <div class="simple-card" style="margin-top: 40px; background: var(--nk-gray-50);">
                <h4>Финансовый учет (1С):</h4>
                <ul class="footer__list" style="margin-top: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <li>Открытие и закрытие расчетных счетов</li>
                    <li>Постановка и ведение кассовой дисциплины</li>
                    <li>Составление кассовых отчетов</li>
                    <li>Ведение учета в 1С:Предприятие</li>
                    <li>Составление платежных поручений</li>
                    <li>Расчёт заработной платы</li>
                    <li>Сдача всех видов отчетности (МСФО)</li>
                    <li>Помощь в составлении договоров</li>
                </ul>
            </div>

            <h2 style="margin-top: 50px;">Кадровое делопроизводство</h2>
            <p>Мы берем на себя полное юридическое и административное сопровождение ваших сотрудников:</p>
            
            <div class="feature-list">
                <div class="feature-item">Оформление сотрудников (прием, перевод, увольнение)</div>
                <div class="feature-item">Штатное расписание и должностные инструкции</div>
                <div class="feature-item">Формирование графика отпусков и командировочных приказов</div>
                <div class="feature-item">Ведение трудовых книжек и учет рабочего времени</div>
            </div>
        </div>

        <aside class="editorial-sidebar">
            <div class="simple-card">
                <h4>Срочный учет</h4>
                <p>Проблемы с бухгалтерским учетом или кадровым делопроизводством?</p>
                <button onclick="openRequestModal('accounting')" class="cta-crystal__btn">
                    <span>Получить помощь</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
                <p class="cta-crystal__secure">🛡️ Ваш учет под нашей защитой</p>
            </div>
        </aside>
    </div>

</main>

<?php get_footer(); ?>
