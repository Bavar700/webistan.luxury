<?php
/**
 * Template Name: Восстановление финансового учета
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
                <span class="text-gradient">Восстановление</span><br>финансового учета
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                Приведём вашу запущенную документацию в полный порядок,<br>
                устраним ошибки и <strong>защитим от претензий госорганов</strong>.
            </p>
            <div class="hero__actions fade-up is-visible fade-up-delay-3">
                <a href="#contacts" class="btn btn--primary">Восстановить учёт <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
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
                <h2 class="section__title section__title--huge">Когда нужно<br><span class="text-gradient">восстановление?</span></h2>
                <p style="font-size: 1.05rem; color: var(--nk-gray-600); line-height: 1.8; margin-bottom: 32px;">
                    Если в вашей компании велось ненадлежащее ведение бухучёта, были утеряны документы или произошла смена бухгалтера — наши специалисты восстановят всю документацию в полном объёме и в строгом соответствии с законодательством.
                </p>
                <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 40px;">
                    <?php $cases = [
                        ['icon' => '<path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/>', 'title' => 'Утеря документов', 'text' => 'Восстановим первичную документацию и регистры учёта из имеющихся источников'],
                        ['icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>', 'title' => 'Смена бухгалтера', 'text' => 'Наведём порядок при передаче дел и восполним пробелы в учёте'],
                        ['icon' => '<path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/>', 'title' => 'Ошибки в отчётности', 'text' => 'Выявим и исправим систематические ошибки в бухгалтерской отчётности'],
                        ['icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>', 'title' => 'Налоговые проверки', 'text' => 'Подготовим документацию к визиту налоговых органов и минимизируем риски'],
                    ]; foreach ($cases as $case): ?>
                    <div class="service-card" style="padding: 28px 24px;">
                        <div class="service-card__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><?php echo $case['icon']; ?></svg></div>
                        <h3 class="service-card__title"><?php echo $case['title']; ?></h3>
                        <p class="service-card__text" style="font-size: 0.88rem;"><?php echo $case['text']; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <h3 style="font-size: 1.2rem; font-weight: 800; color: var(--nk-gray-900); margin-bottom: 16px;">Наш процесс:</h3>
                <div style="display: flex; flex-direction: column; gap: 2px;">
                    <?php $steps = ['Анализ текущего состояния документации', 'Сбор и систематизация первичных документов', 'Восстановление регистров бухгалтерского учёта', 'Формирование корректной отчётности', 'Сдача исправленной отчётности в контролирующие органы'];
                    foreach ($steps as $i => $step): ?>
                    <div style="display: flex; gap: 0; align-items: stretch;">
                        <div style="display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
                            <div style="width: 36px; height: 36px; background: <?php echo $i % 2 == 0 ? 'var(--nk-blue)' : 'var(--nk-red)'; ?>; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 0.8rem; flex-shrink: 0;"><?php echo $i+1; ?></div>
                            <?php if ($i < count($steps)-1): ?><div style="width: 2px; flex: 1; background: var(--nk-gray-100); margin: 4px 0;"></div><?php endif; ?>
                        </div>
                        <div style="padding: 8px 0 24px;"><p style="margin: 0; color: var(--nk-gray-700); font-size: 0.95rem; line-height: 1.6; padding-top: 6px;"><?php echo $step; ?></p></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="fade-up is-visible fade-up-delay-1" style="position: sticky; top: 100px;">
                <div class="service-card" style="padding: 36px 32px; margin-bottom: 16px;">
                    <div style="font-size: 2.5rem; font-weight: 900; color: var(--nk-blue); line-height: 1; margin-bottom: 8px; text-align: center;">100%<span style="color: var(--nk-red);">✓</span></div>
                    <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); font-weight: 700; margin: 0; text-align: center;">Гарантия соответствия законодательству</p>
                </div>
                <div style="background: var(--nk-gray-50); border: 1px solid var(--nk-gray-100); border-radius: 20px; padding: 32px 28px;">
                    <h4 style="font-size: 0.85rem; font-weight: 800; color: var(--nk-gray-900); margin-bottom: 16px; text-transform: uppercase; letter-spacing: 0.08em;">Что вы получаете:</h4>
                    <ul style="padding: 0; margin: 0 0 24px; list-style: none; display: flex; flex-direction: column; gap: 10px;">
                        <?php foreach (['Восстановленная первичная документация', 'Корректные налоговые декларации', 'Регистры бухгалтерского учёта', 'Акт о проведённой работе', 'Рекомендации по ведению учёта'] as $benefit): ?>
                        <li style="display: flex; gap: 10px;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--nk-blue)" stroke-width="2.5" style="min-width:16px; margin-top:3px;"><polyline points="20 6 9 17 4 12"/></svg><span style="color: var(--nk-gray-700); font-size: 0.9rem;"><?php echo $benefit; ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="#contacts" class="btn btn--primary" style="width: 100%; justify-content: center;">Заказать → </a>
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
            <h2 class="cta-crystal__title"><span class="text-gradient">Восстановим</span><br>учёт под ключ</h2>
            <p class="cta-crystal__text">Оставьте заявку — и наши специалисты возьмутся за восстановление вашей документации в кратчайшие сроки.</p>
            <div class="cta-crystal__status"><span class="cta-crystal__status-dot"></span>Мы онлайн • Ответ в течение 15 минут</div>
        </div>
        <div class="cta-crystal__form-wrapper fade-up is-visible">
            <form action="#" class="cta-crystal__form">
                <div class="cta-crystal__field"><input type="text" placeholder=" " required id="r-name"><label for="r-name">Ваше имя</label></div>
                <div class="cta-crystal__field"><input type="tel" placeholder=" " required id="r-phone"><label for="r-phone">Телефон (+992)</label></div>
                <div class="cta-crystal__field"><textarea placeholder=" " id="r-msg" rows="3"></textarea><label for="r-msg">Опишите ситуацию</label></div>
                <button type="submit" class="btn btn--primary" style="width:100%; justify-content:center;">Отправить заявку <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></button>
            </form>
        </div>
    </div></div>
</section>
</main>
<?php get_footer(); ?>
