<?php
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
                <div class="hero__badge">Стратегия роста</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Бизнес</span><br>консалтинг
                </h1>
                <p class="hero__desc">
                    Экспертная помощь в разработке стратегий развития и повышении эффективности вашей компании.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="javascript:void(0)" onclick="openRequestModal('consulting')" class="btn btn--primary">Заказать аудит</a>
            </div>
        </div>
    </section>

    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Профессиональные консультации для руководителей</h2>
            <p>
                Бизнес-консалтинг в Neksoz — это не просто советы, а конкретные инструменты для трансформации вашего бизнеса. Мы помогаем владельцам и топ-менеджерам увидеть скрытые возможности и устранить барьеры, препятствующие росту эффективности.
            </p>

            <div class="simple-card" style="margin-top: 40px; background: var(--nk-gray-50);">
                <h4>Наши компетенции:</h4>
                <ul class="footer__list" style="margin-top: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <li>Стратегическое управление</li>
                    <li>Оптимизация бизнес-процессов</li>
                    <li>Финансовое планирование</li>
                    <li>Бюджетирование и контроль</li>
                    <li>Реорганизация структуры</li>
                    <li>Кризис-менеджмент</li>
                    <li>Управление инвестициями</li>
                    <li>Маркетинговые исследования</li>
                </ul>
            </div>

            <h2 style="margin-top: 50px;">Стратегическое развитие</h2>
            <p>Мы разрабатываем дорожные карты развития, которые позволяют компаниям не просто выживать, а доминировать на рынке Таджикистана и за его пределами.</p>
            
            <div class="feature-list">
                <div class="feature-item">Диагностика системы управления</div>
                <div class="feature-item">Разработка KPI и систем мотивации</div>
                <div class="feature-item">Поиск новых ниш и рынков сбыта</div>
                <div class="feature-item">Автоматизация принятия решений</div>
            </div>
        </div>

        <aside class="editorial-sidebar">
            <div class="simple-card">
                <h4>Бизнес-поддержка</h4>
                <p>Нужна экспертная стратегия развития или срочное решение кризисной ситуации?</p>
                <button onclick="openRequestModal('consulting')" class="cta-crystal__btn">
                    <span>Связаться с экспертом</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
                <p class="cta-crystal__secure">🛡️ Стратегический партнер вашего успеха</p>
            </div>
        </aside>
    </div>

</main>

<?php get_footer(); ?>
