<?php
/**
 * Template Name: Управленческий учёт
 * Template Post Type: page
 * @package Neksoz
 */
get_header();
?>
<main id="primary" class="site-main">

<section class="hero" style="min-height: 55vh; display: flex; align-items: center;">
    <div class="hero__geo"></div><div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div><div class="hero__grid-pattern"></div>
    <div class="container hero__inner" style="position: relative; z-index: 2;">
        <div class="hero__content">
            <div class="hero__badge fade-up is-visible">Наши услуги</div>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1">
                <span class="text-gradient">Управленческий</span><br>учёт
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                Полная финансовая прозрачность и точные данные для принятия решений,<br>
                которые <strong>реально увеличивают вашу чистую прибыль</strong>.
            </p>
            <div class="hero__actions fade-up is-visible fade-up-delay-3">
                <a href="#contacts" class="btn btn--primary">Подключить учёт <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
                <a href="<?php echo home_url('/services'); ?>" class="btn btn--outline-light">← Все услуги</a>
            </div>
        </div>
    </div>
</section>

<section class="section section--gray">
    <div class="container">
        <div class="section__header section__header--center fade-up is-visible">
            <div class="section__label">Что входит</div>
            <h2 class="section__title section__title--huge">Комплексный<br><span class="text-gradient">управленческий учёт</span></h2>
        </div>
        <div class="services-grid" style="grid-template-columns: repeat(3, 1fr);">
            <?php $items = [
                ['icon' => '<path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/>', 'title' => 'Бюджетирование', 'text' => 'Разработка системы бюджетов для контроля расходов и планирования доходов компании.', 'alt' => false],
                ['icon' => '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>', 'title' => 'Финансовый анализ', 'text' => 'Подготовка управленческих отчётов и анализ ключевых показателей эффективности (KPI).', 'alt' => true],
                ['icon' => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>', 'title' => 'Оперативная отчётность', 'text' => 'Ежедневные, еженедельные и ежемесячные отчёты для оперативного управления бизнесом.', 'alt' => false],
                ['icon' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>', 'title' => 'Учёт затрат', 'text' => 'Калькуляция себестоимости продукции и услуг. Контроль прямых и косвенных затрат.', 'alt' => true],
                ['icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>', 'title' => 'Контроль рентабельности', 'text' => 'Анализ рентабельности по продуктам, проектам и подразделениям для оптимизации бизнеса.', 'alt' => false],
                ['icon' => '<path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>', 'title' => 'Прогнозирование', 'text' => 'Финансовое моделирование и прогнозирование для стратегического планирования.', 'alt' => true],
            ]; foreach ($items as $item): ?>
            <div class="service-card <?php echo $item['alt'] ? 'service-card--alt' : ''; ?> fade-up is-visible">
                <div class="service-card__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><?php echo $item['icon']; ?></svg></div>
                <h3 class="service-card__title"><?php echo $item['title']; ?></h3>
                <p class="service-card__text"><?php echo $item['text']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div class="fade-up is-visible">
                <div class="section__label">Результат</div>
                <h2 class="section__title section__title--huge">Что вы<br><span class="text-gradient">получаете</span></h2>
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <?php $results = [
                        'Прозрачность всех финансовых потоков компании',
                        'Точные данные для быстрого принятия решений',
                        'Управление рентабельностью каждого направления',
                        'Система бюджетов с план-фактным анализом',
                        'Регулярная управленческая отчётность',
                    ]; foreach ($results as $r): ?>
                    <div style="display: flex; gap: 14px; align-items: center; padding: 14px 20px; background: var(--nk-gray-50); border: 1px solid var(--nk-gray-100); border-radius: 10px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--nk-blue)" stroke-width="2.5" style="min-width: 18px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span style="color: var(--nk-gray-700); font-size: 0.95rem;"><?php echo $r; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="fade-up is-visible fade-up-delay-1">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <?php foreach ([['360°', 'Обзор финансов', 'blue'], ['KPI', 'Мониторинг', 'red'], ['P&L', 'Отчётность', 'blue'], ['ROI', 'Анализ', 'red']] as $s): ?>
                    <div class="service-card <?php echo $s[2] === 'red' ? 'service-card--alt' : ''; ?>" style="padding: 28px; text-align: center;">
                        <div style="font-size: 1.8rem; font-weight: 900; color: var(--nk-<?php echo $s[2]; ?>); line-height: 1; margin-bottom: 6px;"><?php echo $s[0]; ?></div>
                        <p style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); font-weight: 700; margin: 0;"><?php echo $s[1]; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contacts" class="cta-crystal">
    <div class="cta-crystal__glow cta-crystal__glow--blue"></div><div class="cta-crystal__glow cta-crystal__glow--red"></div>
    <div class="container"><div class="cta-crystal__grid">
        <div class="cta-crystal__content fade-up is-visible">
            <div class="section__label">Быстрая связь</div>
            <h2 class="cta-crystal__title"><span class="text-gradient">Видьте цифры</span><br>как на ладони</h2>
            <p class="cta-crystal__text">Подключите управленческий учёт и получайте точные данные для управления бизнесом в реальном времени.</p>
            <div class="cta-crystal__status"><span class="cta-crystal__status-dot"></span>Мы онлайн • Ответ в течение 15 минут</div>
        </div>
        <div class="cta-crystal__form-wrapper fade-up is-visible">
            <form action="#" class="cta-crystal__form">
                <div class="cta-crystal__field"><input type="text" placeholder=" " required id="m-name"><label for="m-name">Ваше имя</label></div>
                <div class="cta-crystal__field"><input type="tel" placeholder=" " required id="m-phone"><label for="m-phone">Телефон (+992)</label></div>
                <div class="cta-crystal__field"><textarea placeholder=" " id="m-msg" rows="3"></textarea><label for="m-msg">Расскажите о бизнесе</label></div>
                <button type="submit" class="btn btn--primary" style="width:100%; justify-content:center;">Подключить учёт <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></button>
            </form>
        </div>
    </div></div>
</section>
</main>
<?php get_footer(); ?>
