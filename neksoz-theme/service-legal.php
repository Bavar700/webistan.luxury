<?php
/**
 * Template Name: Юридические консультации
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
                <span class="text-gradient">Юридические</span><br>консультации
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                Комплексный подход к вашему вопросу, своевременная правовая помощь,<br>
                <strong>представление интересов во всех судебных инстанциях</strong>.
            </p>
            <div class="hero__actions fade-up is-visible fade-up-delay-3">
                <a href="#contacts" class="btn btn--primary">Получить консультацию <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
                <a href="<?php echo home_url('/services'); ?>" class="btn btn--outline-light">← Все услуги</a>
            </div>
        </div>
    </div>
</section>

<section class="section section--gray">
    <div class="container">
        <div class="section__header section__header--center fade-up is-visible">
            <div class="section__label">Направления</div>
            <h2 class="section__title section__title--huge">Что мы<br><span class="text-gradient">предлагаем</span></h2>
        </div>
        <div class="services-grid" style="grid-template-columns: repeat(3, 1fr);">
            <?php $legal = [
                ['icon' => '<path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11M20 10v11M8 14v3M12 14v3M16 14v3"/>', 'title' => 'Корпоративное право', 'text' => 'Регистрация, реорганизация и ликвидация юридических лиц. Разработка уставных документов.', 'alt' => false],
                ['icon' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>', 'title' => 'Договорное право', 'text' => 'Составление, экспертиза и сопровождение договоров всех видов. Защита ваших интересов.', 'alt' => true],
                ['icon' => '<circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/>', 'title' => 'Трудовое право', 'text' => 'Защита прав работников и работодателей. Разрешение трудовых споров.', 'alt' => false],
                ['icon' => '<rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/>', 'title' => 'Арбитражные споры', 'text' => 'Представление интересов в арбитражных судах. Подготовка исковых заявлений и жалоб.', 'alt' => true],
                ['icon' => '<path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>', 'title' => 'Правовая экспертиза', 'text' => 'Правовой анализ документов и сделок, выявление рисков и разработка рекомендаций.', 'alt' => false],
                ['icon' => '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>', 'title' => 'Банкротство', 'text' => 'Сопровождение процедур банкротства и ликвидации. Защита интересов кредиторов и должников.', 'alt' => true],
            ]; foreach ($legal as $svc): ?>
            <div class="service-card <?php echo $svc['alt'] ? 'service-card--alt' : ''; ?> fade-up is-visible">
                <div class="service-card__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><?php echo $svc['icon']; ?></svg></div>
                <h3 class="service-card__title"><?php echo $svc['title']; ?></h3>
                <p class="service-card__text"><?php echo $svc['text']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div class="fade-up is-visible">
                <div class="section__label">Наши преимущества</div>
                <h2 class="section__title section__title--huge">Почему<br><span class="text-gradient">выбирают нас</span></h2>
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <?php $advantages = [
                        ['num' => '01', 'title' => 'Опытные юристы', 'text' => 'Наши юристы имеют многолетний опыт в различных областях права и сложнейших судебных делах.'],
                        ['num' => '02', 'title' => 'Индивидуальный подход', 'text' => 'Каждое дело уникально — мы разрабатываем стратегию под конкретную ситуацию клиента.'],
                        ['num' => '03', 'title' => 'Конфиденциальность', 'text' => 'Полная защита информации клиента. Адвокатская тайна гарантирована законом.'],
                    ]; foreach ($advantages as $adv): ?>
                    <div style="display: flex; gap: 20px; align-items: flex-start;">
                        <div style="width: 48px; height: 48px; min-width: 48px; background: var(--nk-gray-50); border: 1px solid var(--nk-gray-100); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: 900; color: var(--nk-blue);"><?php echo $adv['num']; ?></div>
                        <div>
                            <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--nk-gray-900); margin-bottom: 6px;"><?php echo $adv['title']; ?></h3>
                            <p style="margin: 0; color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6;"><?php echo $adv['text']; ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="fade-up is-visible fade-up-delay-1">
                <div style="background: linear-gradient(135deg, #f8faff 0%, white 100%); border: 1px solid var(--nk-gray-100); border-radius: 20px; padding: 44px 40px;">
                    <blockquote style="font-size: 1.15rem; font-style: italic; color: var(--nk-gray-800); line-height: 1.7; margin: 0 0 20px; font-weight: 600;">
                        «Комплексный подход к вашему вопросу, своевременная правовая помощь, представление интересов во всех судебных инстанциях.»
                    </blockquote>
                    <p style="font-size: 0.8rem; color: var(--nk-gray-500); font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; margin: 0 0 28px;">— Команда юристов NEKSOZ</p>
                    <a href="#contacts" class="btn btn--primary" style="width: 100%; justify-content: center;">Записаться на консультацию →</a>
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
            <h2 class="cta-crystal__title"><span class="text-gradient">Защитите свои</span><br>права сегодня</h2>
            <p class="cta-crystal__text">Получите профессиональную юридическую консультацию. Первый звонок — бесплатно.</p>
            <div class="cta-crystal__status"><span class="cta-crystal__status-dot"></span>Мы онлайн • Ответ в течение 15 минут</div>
        </div>
        <div class="cta-crystal__form-wrapper fade-up is-visible">
            <form action="#" class="cta-crystal__form">
                <div class="cta-crystal__field"><input type="text" placeholder=" " required id="l-name"><label for="l-name">Ваше имя</label></div>
                <div class="cta-crystal__field"><input type="tel" placeholder=" " required id="l-phone"><label for="l-phone">Телефон (+992)</label></div>
                <div class="cta-crystal__field"><textarea placeholder=" " id="l-msg" rows="3"></textarea><label for="l-msg">Опишите ситуацию</label></div>
                <button type="submit" class="btn btn--primary" style="width:100%; justify-content:center;">Отправить запрос <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></button>
            </form>
        </div>
    </div></div>
</section>
</main>
<?php get_footer(); ?>
