<?php
/**
 * Template Name: Аудит финансовой деятельности
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

<!-- ═══════════ PAGE HERO ═══════════ -->
<section class="hero" style="min-height: 55vh; display: flex; align-items: center;">
    <div class="hero__geo"></div><div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div><div class="hero__grid-pattern"></div>
    <div class="container hero__inner" style="position: relative; z-index: 2;">
        <div class="hero__content">
            <div class="hero__badge fade-up is-visible">Наши услуги</div>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1">
                <span class="text-gradient">Аудит финансовой</span><br>деятельности компании
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                Аудит — это больше, чем проверка цифр. Он создаёт фундамент<br>для <strong>достижения будущих целей</strong> вашей компании.
            </p>
            <div class="hero__actions fade-up is-visible fade-up-delay-3">
                <a href="#contacts" class="btn btn--primary">Заказать аудит <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
                <a href="<?php echo home_url('/services'); ?>" class="btn btn--outline-light">← Все услуги</a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ INTRO ═══════════ -->
<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 80px; align-items: start;">
            <div class="fade-up is-visible">
                <div class="section__label">О услуге</div>
                <h2 class="section__title section__title--huge">Что такое<br><span class="text-gradient">аудит?</span></h2>
                <div style="background: var(--nk-gray-50); border-left: 4px solid var(--nk-blue); border-radius: 0 12px 12px 0; padding: 28px 32px; margin-bottom: 32px;">
                    <p style="font-size: 1.1rem; font-style: italic; color: var(--nk-gray-700); line-height: 1.7; margin: 0;">
                        «Аудит — это больше, чем проверка цифр. Он связан с подтверждением результатов, выявлением вопросов, требующих доработки, и обеспечивает создание фундамента для достижения будущих целей компании. NEKSOZ показывает, что, как и почему необходимо изменить, чтобы всегда действовать на опережение.»
                    </p>
                </div>
                <h3 style="font-size: 1.3rem; font-weight: 800; color: var(--nk-gray-900); margin-bottom: 20px;">Наши задачи:</h3>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <?php
                    $tasks = [
                        'Оценка уровня организации бухгалтерского учета и внутреннего контроля',
                        'Оценка правильности и законности совершения бухгалтерских записей',
                        'Оказание помощи управляющим органам путём выработки рекомендаций по устранению недостатков',
                        'Ориентирование организации на будущие события, которые могут повлиять на хозяйственную деятельность',
                        'Выявление резервов роста финансовых ресурсов организации',
                        'Проверка соблюдения действующего законодательства в области налогообложения',
                        'Подтверждение достоверных отчетов или констатация их недостоверности',
                    ];
                    foreach ($tasks as $i => $task): ?>
                    <div style="display: flex; gap: 16px; align-items: flex-start; padding: 16px 20px; background: <?php echo $i % 2 === 0 ? 'var(--nk-gray-50)' : 'white'; ?>; border: 1px solid var(--nk-gray-100); border-radius: 10px;">
                        <div style="width: 28px; height: 28px; min-width: 28px; background: var(--nk-blue); color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 900;"><?php echo $i + 1; ?></div>
                        <p style="margin: 0; color: var(--nk-gray-700); font-size: 0.95rem; line-height: 1.6; padding-top: 2px;"><?php echo $task; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="fade-up is-visible fade-up-delay-1" style="position: sticky; top: 100px;">
                <div style="background: var(--nk-gray-50); border: 1px solid var(--nk-gray-100); border-radius: 20px; padding: 36px 32px;">
                    <h4 style="font-size: 1rem; font-weight: 800; color: var(--nk-gray-900); margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.08em;">Мы ответим на вопросы:</h4>
                    <ul style="padding: 0; margin: 0; list-style: none; display: flex; flex-direction: column; gap: 12px;">
                        <?php $checks = [
                            'Соответствует ли отчетность всем требованиям?',
                            'Учтены ли все активы и пассивы?',
                            'Все ли категории правильно включены в отчётность?',
                            'Имеются ли основания для указанных сумм?',
                            'Все ли категории правильно оценены?',
                        ];
                        foreach ($checks as $check): ?>
                        <li style="display: flex; gap: 12px; align-items: flex-start;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--nk-blue)" stroke-width="2.5" style="min-width: 18px; margin-top: 2px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <span style="color: var(--nk-gray-700); font-size: 0.9rem; line-height: 1.5;"><?php echo $check; ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <div style="margin-top: 28px; padding-top: 24px; border-top: 1px solid var(--nk-gray-200);">
                        <a href="#contacts" class="btn btn--primary" style="width: 100%; justify-content: center;">Заказать аудит →</a>
                    </div>
                </div>
                <div class="service-card" style="margin-top: 16px; padding: 24px 28px; text-align: center;">
                    <div style="font-size: 2.5rem; font-weight: 900; color: var(--nk-blue); line-height: 1; margin-bottom: 8px;">1200<span style="color: var(--nk-red);">+</span></div>
                    <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); font-weight: 700; margin: 0;">Успешных аудитов</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ CTA ═══════════ -->
<section id="contacts" class="cta-crystal">
    <div class="cta-crystal__glow cta-crystal__glow--blue"></div>
    <div class="cta-crystal__glow cta-crystal__glow--red"></div>
    <div class="container">
        <div class="cta-crystal__grid">
            <div class="cta-crystal__content fade-up is-visible">
                <div class="section__label">Заказать аудит</div>
                <h2 class="cta-crystal__title"><span class="text-gradient">Защитите</span><br>свой бизнес сегодня</h2>
                <p class="cta-crystal__text">Получите профессиональный аудит финансовой деятельности вашей компании. Мы выявим риски до их наступления.</p>
                <div class="cta-crystal__status"><span class="cta-crystal__status-dot"></span>Мы онлайн • Ответ в течение 15 минут</div>
            </div>
            <div class="cta-crystal__form-wrapper fade-up is-visible">
                <form action="#" class="cta-crystal__form">
                    <div class="cta-crystal__field"><input type="text" placeholder=" " required id="a-name"><label for="a-name">Ваше имя</label></div>
                    <div class="cta-crystal__field"><input type="tel" placeholder=" " required id="a-phone"><label for="a-phone">Телефон (+992)</label></div>
                    <div class="cta-crystal__field"><textarea placeholder=" " id="a-msg" rows="3"></textarea><label for="a-msg">Расскажите о компании</label></div>
                    <button type="submit" class="btn btn--primary" style="width:100%; justify-content:center;">Заказать аудит <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></button>
                </form>
            </div>
        </div>
    </div>
</section>

</main>
<?php get_footer(); ?>
