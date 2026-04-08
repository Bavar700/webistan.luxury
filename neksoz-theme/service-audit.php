<?php
/**
 * Template Name: Услуга: Аудит
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
                <div class="hero__badge">Департамент аудита</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Финансовый</span><br>аудит
                </h1>
                <p class="hero__desc">
                    Профессиональное подтверждение достоверности финансовой отчетности в соответствии с МСФО.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="javascript:void(0)" onclick="openRequestModal('audit')" class="btn btn--primary">Заказать аудит</a>
            </div>
        </div>
    </section>

    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Аудит — это фундамент будущего</h2>
            <p>
                В «Neksoz» мы понимаем, что аудит — это не просто формальная проверка цифр. Это стратегический инструмент подтверждения результатов и выявления зон роста. Мы показываем не только текущее положение дел, но и объясняем, <strong>что, как и почему необходимо изменить</strong>, чтобы ваш бизнес действовал на опережение.
            </p>

            <div class="simple-card" style="margin-top: 40px; background: var(--nk-gray-50);">
                <h4>Ключевые задачи аудита:</h4>
                <ul class="footer__list" style="margin-top: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <li>Оценка внутреннего контроля</li>
                    <li>Проверка законности записей</li>
                    <li>Рекомендации по устранению нарушений</li>
                    <li>Перспективный анализ рисков</li>
                    <li>Выявление резервов роста</li>
                    <li>Налоговый комплаенс</li>
                </ul>
            </div>

            <h2 style="margin-top: 50px;">Наши цели при проверке</h2>
            <p>Для достижения основной цели мы формируем экспертное мнение по следующим критическим вопросам:</p>
            
            <div class="feature-list">
                <div class="feature-item">Соответствие отчетности всем стандартам МСФО</div>
                <div class="feature-item">Полнота учета активов и пассивов</div>
                <div class="feature-item">Достоверность сумм и расчетов</div>
                <div class="feature-item">Отсутствие противоречивых сведений</div>
            </div>
        </div>

        <aside class="editorial-sidebar">
            <div class="simple-card">
                <h4>Аудит-контроль</h4>
                <p>Необходим срочный аудит финансовой деятельности или подготовка к проверке?</p>
                <button onclick="openRequestModal('audit')" class="cta-crystal__btn">
                    <span>Запросить аудит</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
                <p class="cta-crystal__secure">🛡️ Полная финансовая безопасность</p>
            </div>
        </aside>
    </div>

</main>

<?php get_footer(); ?>
