<?php
/**
 * Template Name: Управленческий учет
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
                <div class="hero__badge">Управление данными</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Финансовый</span><br>учет
                </h1>
                <p class="hero__desc">
                    Внедрение систем сбора и анализа данных для принятия обоснованных управленческих решений.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="javascript:void(0)" onclick="openRequestModal('management')" class="btn btn--primary">Заказать систему</a>
            </div>
        </div>
    </section>

    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Управленческий учет: Инструменты для стратегии</h2>
            <p>
                В отличие от бухгалтерского учета, ориентированного на внешних пользователей и фискальные органы, <strong>управленческий учет</strong> создается специально для руководителей. Это система, которая дает ответы на вопросы: «Где мы теряем деньги?», «Какое направление наиболее прибыльно?» и «Сколько ресурсов у нас будет через месяц?».
            </p>

            <div class="simple-card" style="margin-top: 40px; background: var(--nk-gray-50);">
                <h4>Что мы внедряем:</h4>
                <ul class="footer__list" style="margin-top: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <li>Система бюджетирования (BDG)</li>
                    <li>Отчет о прибылях и убытках (P&L)</li>
                    <li>Отчет о движении денежных средств (Cash Flow)</li>
                    <li>Учет затрат и калькуляция себестоимости</li>
                    <li>Анализ маржинальности продуктов</li>
                    <li>Управление оборотным капиталом</li>
                </ul>
            </div>

            <h2 style="margin-top: 50px;">Визуализация и контроль</h2>
            <p>Мы настраиваем автоматизированные панели управления, которые в реальном времени показывают состояние вашего бизнеса без необходимости вникать в тысячи проводок.</p>
            
            <div class="feature-list">
                <div class="feature-item">Прогнозирование кассовых разрывов</div>
                <div class="feature-item">План-фактный анализ отклонений</div>
                <div class="feature-item">Расчет точки безубыточности</div>
                <div class="feature-item">Оптимизация налоговых потоков внутри холдинга</div>
            </div>
        </div>

        <aside class="editorial-sidebar">
            <div class="simple-card">
                <h4>Антикризис</h4>
                <p>Нужна срочная оптимизация бизнес-процессов или управленческий аудит?</p>
                <button onclick="openRequestModal('management')" class="cta-crystal__btn">
                    <span>Связаться с экспертом</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
                <p class="cta-crystal__secure">🛡️ Управленческая защита 24/7</p>
            </div>
        </aside>
    </div>

</main>

<?php get_footer(); ?>
