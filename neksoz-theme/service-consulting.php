<?php
/**
 * Template Name: Бизнес консультации
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
                <span class="text-gradient">Бизнес</span><br>консультации
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                Стратегическое консультирование для роста вашего бизнеса.<br>
                <strong>Анализ, планирование, результат.</strong>
            </p>
            <div class="hero__actions fade-up is-visible fade-up-delay-3">
                <a href="#contacts" class="btn btn--primary">Заказать консультацию <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
                <a href="<?php echo home_url('/services'); ?>" class="btn btn--outline-light">← Все услуги</a>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 80px; align-items: start;">
            <div class="fade-up is-visible">
                <div class="section__label">О услуге</div>
                <h2 class="section__title section__title--huge">Что мы<br><span class="text-gradient">делаем</span></h2>
                <div style="background: var(--nk-gray-50); border-left: 4px solid var(--nk-blue); border-radius: 0 12px 12px 0; padding: 28px 32px; margin-bottom: 36px;">
                    <p style="font-size: 1.05rem; font-style: italic; color: var(--nk-gray-700); line-height: 1.7; margin: 0;">
                        «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП» анализирует ситуацию и предлагает удобный и эффективный вариант решения проблем бизнеса. Мы помогаем выстроить систему управления, которая работает на результат.
                    </p>
                </div>

                <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 40px;">
                    <?php $biz = [
                        ['icon' => '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>', 'title' => 'Стратегический анализ', 'text' => 'Глубокий анализ рынка, конкурентов и внутренних процессов компании'],
                        ['icon' => '<path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/>', 'title' => 'Финансовое моделирование', 'text' => 'Построение финансовых моделей для принятия стратегических решений'],
                        ['icon' => '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>', 'title' => 'Выход на рынок', 'text' => 'Подготовка бизнес-планов и стратегий выхода на новые рынки'],
                        ['icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>', 'title' => 'Оптимизация процессов', 'text' => 'Реинжиниринг бизнес-процессов для повышения эффективности'],
                        ['icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>', 'title' => 'Управление командой', 'text' => 'Формирование эффективной организационной структуры и системы мотивации'],
                        ['icon' => '<path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>', 'title' => 'Управление рисками', 'text' => 'Идентификация бизнес-рисков и разработка стратегий их минимизации'],
                    ]; foreach ($biz as $b): ?>
                    <div class="service-card" style="padding: 28px 24px;">
                        <div class="service-card__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><?php echo $b['icon']; ?></svg></div>
                        <h3 class="service-card__title"><?php echo $b['title']; ?></h3>
                        <p class="service-card__text" style="font-size: 0.88rem;"><?php echo $b['text']; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="fade-up is-visible fade-up-delay-1" style="position: sticky; top: 100px;">
                <div style="background: var(--nk-gray-50); border: 1px solid var(--nk-gray-100); border-radius: 20px; padding: 36px 32px; margin-bottom: 16px;">
                    <h4 style="font-size: 0.85rem; font-weight: 800; color: var(--nk-gray-900); margin-bottom: 16px; text-transform: uppercase; letter-spacing: 0.08em;">Наш подход:</h4>
                    <ul style="padding: 0; margin: 0 0 24px; list-style: none; display: flex; flex-direction: column; gap: 10px;">
                        <?php foreach (['Анализ текущей ситуации', 'Разработка стратегии', 'План внедрения', 'Сопровождение реализации', 'Контроль результатов'] as $s): ?>
                        <li style="display: flex; gap: 10px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--nk-blue)" stroke-width="2.5" style="min-width:16px; margin-top:3px;"><polyline points="20 6 9 17 4 12"/></svg>
                            <span style="color: var(--nk-gray-700); font-size: 0.9rem;"><?php echo $s; ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="#contacts" class="btn btn--primary" style="width: 100%; justify-content: center;">Заказать →</a>
                </div>
                <div class="service-card service-card--alt" style="padding: 24px 28px; text-align: center;">
                    <div style="font-size: 2.5rem; font-weight: 900; color: var(--nk-red); line-height: 1; margin-bottom: 8px;">300<span style="color: var(--nk-blue);">+</span></div>
                    <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); font-weight: 700; margin: 0;">Успешных бизнес-проектов</p>
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
            <h2 class="cta-crystal__title"><span class="text-gradient">Развивайте</span><br>бизнес с нами</h2>
            <p class="cta-crystal__text">Получите стратегическую консультацию от экспертов NEKSOZ. Мы поможем вашему бизнесу выйти на новый уровень.</p>
            <div class="cta-crystal__status"><span class="cta-crystal__status-dot"></span>Мы онлайн • Ответ в течение 15 минут</div>
        </div>
        <div class="cta-crystal__form-wrapper fade-up is-visible">
            <form action="#" class="cta-crystal__form">
                <div class="cta-crystal__field"><input type="text" placeholder=" " required id="b-name"><label for="b-name">Ваше имя</label></div>
                <div class="cta-crystal__field"><input type="tel" placeholder=" " required id="b-phone"><label for="b-phone">Телефон (+992)</label></div>
                <div class="cta-crystal__field"><textarea placeholder=" " id="b-msg" rows="3"></textarea><label for="b-msg">Расскажите о проекте</label></div>
                <button type="submit" class="btn btn--primary" style="width:100%; justify-content:center;">Заказать консультацию <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></button>
            </form>
        </div>
    </div></div>
</section>
</main>
<?php get_footer(); ?>
