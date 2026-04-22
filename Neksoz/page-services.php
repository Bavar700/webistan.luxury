<?php
/**
 * Template Name: Услуги
 */
if (function_exists('nk_get_current_lang') && nk_get_current_lang() === 'tj') {
    get_template_part('page', 'services-tj');
    return;
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
                <div class="hero__badge">Полный спектр решений</div>
                <h1 class="hero__title">
                    Комплексные услуги для <span class="text-gradient">роста вашего бизнеса</span>
                </h1>
                <p class="hero__desc">
                    Мы предлагаем экспертную поддержку на каждом этапе жизненного цикла компании — от регистрации до масштабирования.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary">Консультация</a>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="section section--gray">
        <div class="container">
            <div class="services-grid">
                <!-- 1. Аудит -->
                <div class="service-card fade-up">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </div>
                    <h3 class="service-card__title">Аудит финансовой деятельности</h3></div>
                    <p class="service-card__text">Вы получаете независимую проверку отчетности, которая подтверждает прозрачность бизнеса и выявляет скрытые финансовые риски.</p>
                    <a href="<?php echo home_url('/service-audit'); ?>" class="service-card__link">Подробнее →</a>
                </div>

                <!-- 2. Восстановление -->
                <div class="service-card fade-up fade-up-delay-1">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                    </div>
                    <h3 class="service-card__title">Восстановление финансового учета</h3></div>
                    <p class="service-card__text">Мы приведем вашу запущенную документацию в полный порядок, устранив ошибки и защитив вас от претензий госорганов.</p>
                    <a href="<?php echo home_url('/service-restore'); ?>" class="service-card__link">Подробнее →</a>
                </div>

                <!-- 3. Юридические -->
                <div class="service-card fade-up fade-up-delay-2">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="service-card__title">Юридические консультации</h3></div>
                    <p class="service-card__text">Вы обеспечиваете правовую безопасность своей компании и надежную защиту интересов в любых договорах и спорах.</p>
                    <a href="<?php echo home_url('/service-legal'); ?>" class="service-card__link">Подробнее →</a>
                </div>

                <!-- 4. Ведение учета -->
                <div class="service-card fade-up">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="service-card__title">Ведение финансового и кадрового учета</h3></div>
                    <p class="service-card__text">Мы берем на себя всю рутину по бухгалтерии и кадрам, гарантируя вам отсутствие штрафов и стабильную работу штата.</p>
                    <a href="<?php echo home_url('/service-accounting'); ?>" class="service-card__link">Подробнее →</a>
                </div>

                <!-- 5. Секретариат -->
                <div class="service-card fade-up fade-up-delay-1">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <h3 class="service-card__title">Услуги секретариата</h3></div>
                    <p class="service-card__text">Вы делегируете администрирование документации и звонков профессионалам, освобождая свое время для решения стратегических задач.</p>
                    <a href="<?php echo home_url('/service-secretariat'); ?>" class="service-card__link">Подробнее →</a>
                </div>

                <!-- 6. Бизнес-консультации -->
                <div class="service-card fade-up fade-up-delay-2">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                    </div>
                    <h3 class="service-card__title">Бизнес-консультации</h3></div>
                    <p class="service-card__text">Вы получаете экспертную поддержку в поиске новых точек роста и разработке эффективной модели развития вашего предприятия.</p>
                    <a href="<?php echo home_url('/service-consulting'); ?>" class="service-card__link">Подробнее →</a>
                </div>

                <!-- 7. Налоговые -->
                <div class="service-card fade-up">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h3 class="service-card__title">Налоговые консультации</h3></div>
                    <p class="service-card__text">Мы помогаем вам законно оптимизировать налоговую нагрузку и минимизировать риски перед визитами контролирующих органов.</p>
                    <a href="<?php echo home_url('/service-tax'); ?>" class="service-card__link">Подробнее →</a>
                </div>

                <!-- 8. Управленческий учет -->
                <div class="service-card fade-up fade-up-delay-1">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/></svg>
                    </div>
                    <h3 class="service-card__title">Управленческий учет</h3></div>
                    <p class="service-card__text">Вы получаете полную финансовую прозрачность и точные данные для принятия решений, которые реально увеличивают вашу прибыль.</p>
                    <a href="<?php echo home_url('/service-management'); ?>" class="service-card__link">Подробнее →</a>
                </div>

                <!-- 9. Автоматизация -->
                <div class="service-card fade-up fade-up-delay-2">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    </div>
                    <h3 class="service-card__title">Автоматизация бизнес-процессов</h3></div>
                    <p class="service-card__text">Вы освобождаете команду от рутины и исключаете ошибки, переводя управление в быструю и точную цифровую среду.</p>
                    <a href="<?php echo home_url('/service-automation'); ?>" class="service-card__link">Подробнее →</a>
                </div>

                <!-- 10. Бизнес-планы -->
                <div class="service-card fade-up">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/><path d="M9 14h6"/><path d="M9 18h6"/><path d="M9 10h6"/></svg>
                    </div>
                    <h3 class="service-card__title">Разработка бизнес-планов и ТЭО</h3></div>
                    <p class="service-card__text">Вы получаете детальный финансовый документ, который доказывает окупаемость вашего проекта и помогает привлечь инвестиции.</p>
                    <a href="<?php echo home_url('/service-business-plan'); ?>" class="service-card__link">Подробнее →</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
