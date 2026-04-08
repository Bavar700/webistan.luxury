<?php
/**
 * Template Name: Ведение финансового учета и кадров
 * Template Post Type: page
 * @package Neksoz
 */
get_header();
?>
<main id="primary" class="site-main">

<!-- ═══════════ HERO ═══════════ -->
<section class="hero" style="min-height: 55vh; display: flex; align-items: center;">
    <div class="hero__geo"></div><div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div><div class="hero__grid-pattern"></div>
    <div class="container hero__inner" style="position: relative; z-index: 2;">
        <div class="hero__content">
            <div class="hero__badge fade-up is-visible">Наши услуги</div>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1">
                <span class="text-gradient">Ведение финансового</span><br>учета и учета кадров
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                Целостное и непрерывное отражение хозяйственных операций.<br>
                Мы берём на себя <strong>все заботы по ведению финансового и кадрового учёта</strong>.
            </p>
            <div class="hero__actions fade-up is-visible fade-up-delay-3">
                <a href="#contacts" class="btn btn--primary">Подключить аутсорсинг <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
                <a href="<?php echo home_url('/services'); ?>" class="btn btn--outline-light">← Все услуги</a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ TWO COLUMNS ═══════════ -->
<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 80px; align-items: start;">
            <div class="fade-up is-visible">
                <!-- FINANCIAL ACCOUNTING -->
                <div class="section__label">Направление 1</div>
                <h2 class="section__title section__title--huge"><span class="text-gradient">Финансовый</span> учёт</h2>
                <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 48px;">
                    <?php $finance = [
                        'Открытие и закрытие расчётного счёта организации',
                        'Постановка кассового аппарата, ведение кассовой дисциплины',
                        'Помощь в составлении любых договоров',
                        'Составление кассовых отчётов на основе первичной документации',
                        'Ведение бухгалтерского учёта в программе 1С',
                        'Составление платёжных поручений по налогам и запросам клиентов',
                        'Расчёт заработной платы',
                        'Составление и сдача всех видов отчётов (месячные, квартальные, годовые) в соответствии с МСФО',
                    ];
                    foreach ($finance as $i => $item): ?>
                    <div style="display: flex; gap: 16px; align-items: flex-start; padding: 14px 20px; background: <?php echo $i % 2 === 0 ? 'var(--nk-gray-50)' : 'white'; ?>; border: 1px solid var(--nk-gray-100); border-radius: 10px;">
                        <div style="width: 28px; height: 28px; min-width: 28px; background: var(--nk-blue); color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 900;"><?php echo $i + 1; ?></div>
                        <p style="margin: 0; color: var(--nk-gray-700); font-size: 0.95rem; line-height: 1.6; padding-top: 3px;"><?php echo $item; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- HR / CADRE -->
                <div class="section__label">Направление 2</div>
                <h2 class="section__title section__title--huge"><span class="text-gradient">Кадровое</span> делопроизводство</h2>
                <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 16px;">
                    <?php $cadre = [
                        ['icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>', 'title' => 'Приём и увольнение', 'text' => 'Оформление приёма, перевода и увольнения работников согласно ТК РТ'],
                        ['icon' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>', 'title' => 'Штатное расписание', 'text' => 'Составление штатного расписания и должностных инструкций сотрудников'],
                        ['icon' => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>', 'title' => 'График отпусков', 'text' => 'Формирование графика отпусков, командировок и декретных отпусков'],
                        ['icon' => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>', 'title' => 'Учёт рабочего времени', 'text' => 'Учёт использования рабочего времени и составление внутренних актов'],
                        ['icon' => '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>', 'title' => 'Трудовые книжки', 'text' => 'Полное ведение трудовых книжек и кадровой документации'],
                        ['icon' => '<path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>', 'title' => 'Внутренние акты', 'text' => 'Составление положений, приказов и внутренних нормативных документов'],
                    ]; foreach ($cadre as $c): ?>
                    <div class="service-card" style="padding: 24px 22px;">
                        <div class="service-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><?php echo $c['icon']; ?></svg></div>
                        <h3 class="service-card__title" style="font-size: 1rem;"><?php echo $c['title']; ?></h3>
                        <p class="service-card__text" style="font-size: 0.85rem;"><?php echo $c['text']; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- SIDEBAR -->
            <div class="fade-up is-visible fade-up-delay-1" style="position: sticky; top: 100px;">
                <div style="background: linear-gradient(135deg, #f8faff 0%, white 100%); border: 1px solid var(--nk-gray-100); border-radius: 20px; padding: 36px 32px; margin-bottom: 16px;">
                    <blockquote style="font-size: 1.1rem; font-style: italic; color: var(--nk-gray-800); line-height: 1.7; margin: 0 0 24px; font-weight: 500; border-left: 4px solid var(--nk-blue); padding-left: 20px;">
                        «Мы берём на себя все заботы по ведению финансового и кадрового учёта вашей компании на основе аутсорсинга.»
                    </blockquote>
                    <a href="#contacts" class="btn btn--primary" style="width: 100%; justify-content: center;">Подключить аутсорсинг →</a>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <?php foreach ([['8+', 'Направлений учёта', 'blue'], ['1C', 'Бухгалтерия', 'red'], ['МСФО', 'Соответствие', 'blue'], ['24/7', 'Доступ', 'red']] as $s): ?>
                    <div class="service-card <?php echo $s[2] === 'red' ? 'service-card--alt' : ''; ?>" style="padding: 20px; text-align: center;">
                        <div style="font-size: 1.6rem; font-weight: 900; color: var(--nk-<?php echo $s[2]; ?>); line-height: 1; margin-bottom: 6px;"><?php echo $s[0]; ?></div>
                        <p style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); font-weight: 700; margin: 0;"><?php echo $s[1]; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ CTA ═══════════ -->
<section id="contacts" class="cta-crystal">
    <div class="cta-crystal__glow cta-crystal__glow--blue"></div><div class="cta-crystal__glow cta-crystal__glow--red"></div>
    <div class="container"><div class="cta-crystal__grid">
        <div class="cta-crystal__content fade-up is-visible">
            <div class="section__label">Быстрая связь</div>
            <h2 class="cta-crystal__title"><span class="text-gradient">Передайте учёт</span><br>профессионалам</h2>
            <p class="cta-crystal__text">Подключите аутсорсинг финансового и кадрового учёта. Мы возьмём на себя всю рутину, а вы сфокусируетесь на бизнесе.</p>
            <div class="cta-crystal__status"><span class="cta-crystal__status-dot"></span>Мы онлайн • Ответ в течение 15 минут</div>
        </div>
        <div class="cta-crystal__form-wrapper fade-up is-visible">
            <form action="#" class="cta-crystal__form">
                <div class="cta-crystal__field"><input type="text" placeholder=" " required id="ac-name"><label for="ac-name">Ваше имя</label></div>
                <div class="cta-crystal__field"><input type="tel" placeholder=" " required id="ac-phone"><label for="ac-phone">Телефон (+992)</label></div>
                <div class="cta-crystal__field"><textarea placeholder=" " id="ac-msg" rows="3"></textarea><label for="ac-msg">Расскажите о компании</label></div>
                <button type="submit" class="btn btn--primary" style="width:100%; justify-content:center;">Оставить заявку <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></button>
            </form>
        </div>
    </div></div>
</section>
</main>
<?php get_footer(); ?>
