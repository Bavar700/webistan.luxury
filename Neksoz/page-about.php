<?php
/**
 * Template Name: О нас
 */
if (function_exists('nk_get_current_lang') && nk_get_current_lang() === 'tj') {
    get_template_part('page', 'about-tj');
    return;
}
get_header();
?>

<style>
/* ── Flat About Cards ──────────────────────────── */
.about-card {
    background: var(--nk-white);
    padding: 40px;
    border-radius: 20px;
    border: 1px solid rgba(0, 13, 51, 0.05);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
    height: 100%;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 13, 51, 0.015);
}
.about-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(0, 13, 51, 0.06);
    border-color: rgba(0, 68, 204, 0.15);
}

.about-card__header {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 24px;
}

.about-card__icon {
    width: 60px;
    height: 60px;
    background: rgba(0, 13, 51, 0.03);
    border-radius: 16px;
    color: var(--nk-gray-400);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(0, 13, 51, 0.04);
    position: relative;
    overflow: hidden;
    transition: all 0.4s var(--ease);
    flex-shrink: 0;
}
.about-card__icon::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--nk-grad-brand);
    border-radius: 16px;
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 1;
}
.about-card__icon svg {
    width: 28px;
    height: 28px;
    stroke: currentColor;
    stroke-width: 2;
    fill: none;
    position: relative;
    z-index: 2;
    transition: transform 0.4s var(--ease);
}
.about-card:hover .about-card__icon::before { opacity: 1; }
.about-card:hover .about-card__icon svg {
    color: #ffffff;
    transform: scale(1.1);
}
.about-card__title {
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--nk-gray-900);
    line-height: 1.1;
    margin: 0;
    margin-top: 10px;
}
.about-card__body {
    color: var(--nk-gray-600);
    line-height: 1.7;
    font-size: 15px;
    flex: 1;
}
.about-card__list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    gap: 10px;
}
.about-card__list li {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    color: var(--nk-gray-700);
    font-size: 14px;
    line-height: 1.5;
}
.about-card__list li::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--nk-red);
    flex-shrink: 0;
    margin-top: 6px;
}
.about-tags {
    display: flex;
    gap: 6px;
    flex-wrap: nowrap;
    margin-top: 4px;
    overflow: visible;
}
.about-tag {
    font-size: 9px;
    font-weight: 800;
    padding: 2px 8px;
    background: rgba(239,68,68,0.07);
    border-radius: 20px;
    color: var(--nk-red);
    letter-spacing: 0.05em;
    text-transform: uppercase;
    white-space: nowrap;
}

/* ── Stats cards ─────────────────────────────────── */
.about-stat {
    background: #fff;
    border: 1px solid rgba(0,13,51,0.07);
    border-radius: 20px;
    padding: 40px 24px;
    text-align: center;
    transition: transform 0.32s ease, box-shadow 0.32s ease, border-color 0.32s ease;
}
.about-stat:hover {
    transform: translateY(-6px);
    box-shadow: 0 24px 60px rgba(0,13,51,0.10);
    border-color: rgba(0,68,204,0.18);
}
.about-stat__num {
    font-size: 52px;
    font-weight: 900;
    line-height: 1;
    letter-spacing: -0.03em;
    color: var(--nk-blue);
    font-family: var(--font-display);
}
.about-stat__num em {
    color: var(--nk-red);
    font-style: normal;
}
.about-stat__label {
    margin-top: 14px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--nk-gray-400);
}
</style>

<main class="site-main">

    <!-- ═══════════ CINEMATIC HERO ═══════════ -->
    <section class="hero hero--internal">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container" style="position:relative;z-index:2;">
            <div class="hero__content">
                <div class="hero__badge">О компании</div>
                <h1 class="hero__title">
                    Ваш успех — наша миссия
                </h1>
                <p class="hero__desc" style="max-width: 650px;">
                    Стратегический партнер и экспертный хаб, трансформирующий опыт в аудите и праве в реальную ценность для локального и международного бизнеса в Таджикистане.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/team'); ?>" class="btn btn--primary btn-animated" style="padding: 12px 28px; font-size: 11px;">
                    Наша команда
                    <svg class="btn__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ SECTION: ИСТОРИЯ ═══════════ -->
    <section class="section" style="padding-top: 80px; padding-bottom: 80px;">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Основана в 2016 году</div>
                <h2 class="section__title">Наш фундамент: Опыт,<br>проверенный временем</h2>
                <p class="section__subtitle">За <?php echo (date('Y') - 2016); ?> лет работы на рынке Таджикистана мы прошли путь от амбициозной команды до<br>признанного лидера в области бухгалтерского консалтинга в Таджикистане.</p>
            </div>

            <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:30px;">

                <!-- Card 1: История -->
                <div class="about-card fade-up">
                    <div class="about-card__header">
                        <div class="about-card__icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        </div>
                        <h3 class="about-card__title">Компания основана в 2016 году</h3>
                    </div>
                    <p class="about-card__body">ООО «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП» была создана в <strong>2016 году</strong> экспертами, уже имеющими значительный опыт в сфере налогообложения, финансового учёта, банковского дела и аудита.</p>
                    <p class="about-card__body" style="margin-top:-4px;">Мы не просто «ведем учет» — мы выстраиваем прозрачные и устойчивые бизнес-модели, которые позволяют нашим клиентам уверенно масштабироваться.</p>
                </div>

                <!-- Card 2: Специализация -->
                <div class="about-card fade-up fade-up-delay-1">
                    <div class="about-card__header">
                        <div class="about-card__icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        </div>
                        <h3 class="about-card__title">Специализация: Масштаб без границ</h3>
                    </div>
                    <p class="about-card__body" style="margin-bottom: 20px; font-weight: 500; font-size: 14px; line-height: 1.6; color: var(--nk-blue);">
                        Экспертная поддержка на всех уровнях — от стартапа до<br>транснациональной корпорации.
                    </p>
                    <ul class="about-card__list" style="gap: 14px;">
                        <li>
                            <div><strong>Локальная экспертиза:</strong><br><span style="color: var(--nk-gray-500); font-size: 13px;">Налоговый кодекс и законодательство РТ</span></div>
                        </li>
                        <li>
                            <div><strong>Глобальный охват:</strong><br><span style="color: var(--nk-gray-500); font-size: 13px;">Стандарты МСФО (IFRS) для международного бизнеса</span></div>
                        </li>
                        <li>
                            <div><strong>Любая сложность:</strong><br><span style="color: var(--nk-gray-500); font-size: 13px;">Работа с предприятиями всех правовых форм</span></div>
                        </li>
                    </ul>
                    <div class="about-tags" style="margin-top: auto; padding-top: 25px; gap: 8px; flex-wrap: wrap;">
                        <span class="about-tag" style="font-size: 8px; padding: 2px 6px;">Ритейл</span>
                        <span class="about-tag" style="font-size: 8px; padding: 2px 6px;">Производство</span>
                        <span class="about-tag" style="font-size: 8px; padding: 2px 6px;">IT & Fintech</span>
                        <span class="about-tag" style="font-size: 8px; padding: 2px 6px;">НКО и Фонды</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════ SECTION: МИССИЯ И ПРИНЦИПЫ ═══════════ -->
    <section class="section section--gray" style="padding-top: 80px; padding-bottom: 80px; border-top: 1px solid rgba(0,0,0,0.04);">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Кодекс NEKSOZ</div>
                <h2 class="section__title">Миссия и принципы</h2>
                <p class="section__subtitle">"Наша миссия — превратить сложные бизнес-процессы в прозрачную и прибыльную систему.<br>Мы работаем на ваш результат и обеспечиваем защиту Ваших интересов на высшем уровне."</p>
            </div>

            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:30px;">

                <!-- Принцип 01 -->
                <div class="about-card fade-up">
                    <div class="about-card__header">
                        <div class="about-card__icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <h3 class="about-card__title">Доверие через результат</h3>
                    </div>
                    <p class="about-card__body">Мы не просим доверия — мы зарабатываем его качеством каждой сданной декларации и чистотой каждого аудиторского заключения.</p>
                </div>

                <!-- Принцип 02 -->
                <div class="about-card fade-up fade-up-delay-1">
                    <div class="about-card__header">
                        <div class="about-card__icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                        </div>
                        <h3 class="about-card__title">Решения вместо отчетов</h3>
                    </div>
                    <p class="about-card__body">Мы не просто констатируем факты — мы анализируем риски и предлагаем эффективные сценарии выхода из сложных финансовых и юридических ситуаций.</p>
                </div>

                <!-- Принцип 03 -->
                <div class="about-card fade-up fade-up-delay-2">
                    <div class="about-card__header">
                        <div class="about-card__icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <h3 class="about-card__title">Культура дедлайнов</h3>
                    </div>
                    <p class="about-card__body">В мире финансов время — это деньги. Мы гарантируем строжайшее соблюдение сроков, беря на себя полную ответственность за результат.</p>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
