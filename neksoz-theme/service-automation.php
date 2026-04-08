<?php
/**
 * Template Name: Автоматизация бизнес-процессов
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
                <span class="text-gradient">Автоматизация</span><br>бизнес-процессов
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                Переводим управление в быструю и точную цифровую среду.<br>
                <strong>Меньше рутины — больше результата.</strong>
            </p>
            <div class="hero__actions fade-up is-visible fade-up-delay-3">
                <a href="#contacts" class="btn btn--primary">Автоматизировать <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
                <a href="<?php echo home_url('/services'); ?>" class="btn btn--outline-light">← Все услуги</a>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 80px; align-items: start;">
            <div class="fade-up is-visible">
                <div class="section__label">Решения</div>
                <h2 class="section__title section__title--huge">Что мы<br><span class="text-gradient">автоматизируем</span></h2>
                <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 40px;">
                    <?php $solutions = [
                        ['icon' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>', 'title' => 'Документооборот', 'text' => 'Электронный документооборот, согласование и архивирование документов'],
                        ['icon' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>', 'title' => 'Бухгалтерия', 'text' => 'Автоматизация бухгалтерского и налогового учёта на базе 1С и ERP'],
                        ['icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>', 'title' => 'Кадровый учёт', 'text' => 'HR-системы: от табеля до расчёта зарплат и управления отпусками'],
                        ['icon' => '<rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/>', 'title' => 'CRM-системы', 'text' => 'Внедрение CRM для управления клиентской базой и воронкой продаж'],
                        ['icon' => '<path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/>', 'title' => 'Отчётность', 'text' => 'Автоматическое формирование управленческих и бухгалтерских отчётов'],
                        ['icon' => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09"/>', 'title' => 'Интеграции', 'text' => 'Интеграция различных систем между собой для единого информационного пространства'],
                    ]; foreach ($solutions as $sol): ?>
                    <div class="service-card" style="padding: 26px 22px;">
                        <div class="service-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><?php echo $sol['icon']; ?></svg></div>
                        <h3 class="service-card__title" style="font-size: 1rem;"><?php echo $sol['title']; ?></h3>
                        <p class="service-card__text" style="font-size: 0.85rem;"><?php echo $sol['text']; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="fade-up is-visible fade-up-delay-1" style="position: sticky; top: 100px;">
                <div style="background: linear-gradient(135deg, #f8faff 0%, white 100%); border: 1px solid var(--nk-gray-100); border-radius: 20px; padding: 36px 32px; margin-bottom: 16px;">
                    <h4 style="font-size: 0.85rem; font-weight: 800; color: var(--nk-gray-900); margin-bottom: 16px; text-transform: uppercase; letter-spacing: 0.08em;">Этапы внедрения:</h4>
                    <div style="display: flex; flex-direction: column; gap: 0;">
                        <?php $stages = ['Аудит текущих процессов', 'Проектирование решения', 'Настройка и тестирование', 'Обучение сотрудников', 'Запуск и поддержка'];
                        foreach ($stages as $i => $stage): ?>
                        <div style="display: flex; gap: 16px; align-items: stretch;">
                            <div style="display: flex; flex-direction: column; align-items: center;">
                                <div style="width: 32px; height: 32px; background: <?php echo $i % 2 == 0 ? 'var(--nk-blue)' : 'var(--nk-red)'; ?>; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 0.75rem; flex-shrink: 0;"><?php echo $i+1; ?></div>
                                <?php if ($i < 4): ?><div style="width: 2px; flex: 1; background: var(--nk-gray-100); margin: 4px 0;"></div><?php endif; ?>
                            </div>
                            <div style="padding: 5px 0 20px;"><span style="color: var(--nk-gray-700); font-size: 0.9rem;"><?php echo $stage; ?></span></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a href="#contacts" class="btn btn--primary" style="width: 100%; justify-content: center; margin-top: 20px;">Начать проект →</a>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div class="service-card" style="padding: 20px; text-align: center;">
                        <div style="font-size: 1.6rem; font-weight: 900; color: var(--nk-blue); line-height: 1; margin-bottom: 4px;">−70%</div>
                        <p style="font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); font-weight: 700; margin: 0;">Рутинной работы</p>
                    </div>
                    <div class="service-card service-card--alt" style="padding: 20px; text-align: center;">
                        <div style="font-size: 1.6rem; font-weight: 900; color: var(--nk-red); line-height: 1; margin-bottom: 4px;">+40%</div>
                        <p style="font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); font-weight: 700; margin: 0;">Скорость обработки</p>
                    </div>
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
            <h2 class="cta-crystal__title"><span class="text-gradient">Автоматизируйте</span><br>бизнес сегодня</h2>
            <p class="cta-crystal__text">Освободите команду от рутины. Получите бесплатную консультацию по автоматизации ваших процессов.</p>
            <div class="cta-crystal__status"><span class="cta-crystal__status-dot"></span>Мы онлайн • Ответ в течение 15 минут</div>
        </div>
        <div class="cta-crystal__form-wrapper fade-up is-visible">
            <form action="#" class="cta-crystal__form">
                <div class="cta-crystal__field"><input type="text" placeholder=" " required id="au-name"><label for="au-name">Ваше имя</label></div>
                <div class="cta-crystal__field"><input type="tel" placeholder=" " required id="au-phone"><label for="au-phone">Телефон (+992)</label></div>
                <div class="cta-crystal__field"><textarea placeholder=" " id="au-msg" rows="3"></textarea><label for="au-msg">Что нужно автоматизировать?</label></div>
                <button type="submit" class="btn btn--primary" style="width:100%; justify-content:center;">Начать проект <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></button>
            </form>
        </div>
    </div></div>
</section>
</main>
<?php get_footer(); ?>
