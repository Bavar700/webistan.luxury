<?php
/**
 * Template Name: Автоматизация
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
                <div class="hero__badge">IT & Digital</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Автоматизация</span><br>бизнеса
                </h1>
                <p class="hero__desc">
                    Внедрение IT-решений и 1С для цифровой трансформации учета и повышения скорости работы.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="javascript:void(0)" onclick="openRequestModal('automation')" class="btn btn--primary">Внедрить IT</a>
            </div>
        </div>
    </section>

    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Цифровая трансформация вашего учета</h2>
            <p>
                В эпоху цифровой экономики скорость принятия решений напрямую зависит от качества IT-инфраструктуры. Neksoz помогает компаниям перейти от бумажного хаоса к <strong>автоматизированным системам управления</strong>, которые исключают человеческий фактор и обеспечивают мгновенный доступ к финансовым показателям.
            </p>

            <div class="simple-card" style="margin-top: 40px; background: var(--nk-gray-50);">
                <h4>Направления автоматизации:</h4>
                <ul class="footer__list" style="margin-top: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <li>Внедрение и настройка 1С</li>
                    <li>Интеграция облачных решений</li>
                    <li>Автоматизация складского учета</li>
                    <li>CRM-системы для отделов продаж</li>
                    <li>Электронный документооборот</li>
                    <li>Настройка управленческих панелей (Dashboards)</li>
                </ul>
            </div>

            <h2 style="margin-top: 50px;">Преимущества внедрения</h2>
            <p>Мы не просто устанавливаем софт, а выстраиваем процессы. Результатом становится прозрачная система, где каждый цент находится под контролем.</p>
            
            <div class="feature-list">
                <div class="feature-item">Сокращение времени на рутинные операции на 40-60%</div>
                <div class="feature-item">Исключение дублирования данных и ошибок ввода</div>
                <div class="feature-item">Контроль дебиторской задолженности в реальном времени</div>
                <div class="feature-item">Безопасное хранение данных в облаке</div>
            </div>
        </div>

        <aside class="editorial-sidebar">
            <div class="simple-card">
                <h4>Служба внедрения</h4>
                <p>Нужна срочная автоматизация процессов или настройка 1С для вашего бизнеса?</p>
                <button onclick="openRequestModal('automation')" class="cta-crystal__btn">
                    <span>Запросить аудит</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
                <p class="cta-crystal__secure">🛡️ Технологическая мощь вашего бизнеса</p>
            </div>
        </aside>
    </div>

</main>

<?php get_footer(); ?>
