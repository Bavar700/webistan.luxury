<?php
/**
 * Template Name: Услуги секретариата
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
                <span class="text-gradient">Услуги</span><br>секретариата
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                Секретарское сопровождение и регистрационные вопросы нерезидентов.<br>
                <strong>Визовая поддержка, перевод документов, аутсорсинг.</strong>
            </p>
            <div class="hero__actions fade-up is-visible fade-up-delay-3">
                <a href="#contacts" class="btn btn--primary">Заказать услугу <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
                <a href="<?php echo home_url('/services'); ?>" class="btn btn--outline-light">← Все услуги</a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ 3 DIRECTIONS ═══════════ -->
<section class="section">
    <div class="container">
        <div class="section__header section__header--center fade-up is-visible">
            <div class="section__label">Направления</div>
            <h2 class="section__title section__title--huge">Три ключевых<br><span class="text-gradient">направления</span></h2>
        </div>
        <div class="services-grid" style="grid-template-columns: repeat(3, 1fr);">
            <!-- Direction 1: Visa Support -->
            <div class="service-card fade-up is-visible" style="padding: 36px 28px;">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                <h3 class="service-card__title">Визовая поддержка</h3>
                <p class="service-card__text" style="margin-bottom: 20px;">Помощь иностранным гражданам в получении виз и полного пакета документов для работы в РТ.</p>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px;">
                    <?php $visa = [
                        'Получение лицензии на привлечение иностранных граждан в Миграционной службе МТМЗН РТ',
                        'Приглашение и продление виз (М, К, О-2) иностранным гражданам',
                        'Регистрация и продление регистрации в ОВИР',
                        'Сбор документов для разрешения на работу (М виза)',
                        'Запрос на карту Дипсервиса (К виза)',
                    ]; foreach ($visa as $v): ?>
                    <li style="display: flex; gap: 8px; align-items: flex-start;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--nk-blue)" stroke-width="3" style="min-width:14px; margin-top:3px;"><polyline points="20 6 9 17 4 12"/></svg>
                        <span style="color: var(--nk-gray-600); font-size: 0.82rem; line-height: 1.5;"><?php echo $v; ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Direction 2: Secretary Outsourcing -->
            <div class="service-card service-card--alt fade-up is-visible fade-up-delay-1" style="padding: 36px 28px;">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 class="service-card__title">Аутсорсинг секретарских услуг</h3>
                <p class="service-card__text" style="margin-bottom: 20px;">Полный цикл секретарского обслуживания вашей компании на аутсорсинге.</p>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px;">
                    <?php $sec = [
                        'Организация документооборота компании',
                        'Ведение деловой переписки и коммуникаций',
                        'Подготовка протоколов совещаний',
                        'Архивирование и хранение документации',
                        'Координация встреч и деловых визитов',
                    ]; foreach ($sec as $s): ?>
                    <li style="display: flex; gap: 8px; align-items: flex-start;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--nk-red)" stroke-width="3" style="min-width:14px; margin-top:3px;"><polyline points="20 6 9 17 4 12"/></svg>
                        <span style="color: var(--nk-gray-600); font-size: 0.82rem; line-height: 1.5;"><?php echo $s; ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Direction 3: Translation -->
            <div class="service-card fade-up is-visible fade-up-delay-2" style="padding: 36px 28px;">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 21V14a2 2 0 0 1 2-2h3"/><path d="M9 7h6l3 5"/><line x1="2" y1="7" x2="9" y2="7"/><line x1="5" y1="3" x2="5" y2="7"/><path d="m14 17 3-3 3 3"/><line x1="17" y1="14" x2="17" y2="21"/></svg>
                </div>
                <h3 class="service-card__title">Перевод юридических документов</h3>
                <p class="service-card__text" style="margin-bottom: 20px;">Точный и юридически грамотный перевод деловой документации.</p>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px;">
                    <?php $trans = [
                        'Перевод учредительных документов',
                        'Перевод договоров и контрактов',
                        'Нотариальное заверение переводов',
                        'Перевод финансовой и налоговой отчётности',
                        'Перевод судебных документов',
                    ]; foreach ($trans as $t): ?>
                    <li style="display: flex; gap: 8px; align-items: flex-start;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--nk-blue)" stroke-width="3" style="min-width:14px; margin-top:3px;"><polyline points="20 6 9 17 4 12"/></svg>
                        <span style="color: var(--nk-gray-600); font-size: 0.82rem; line-height: 1.5;"><?php echo $t; ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ WHY US ═══════════ -->
<section class="section section--gray">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div class="fade-up is-visible">
                <div class="section__label">Преимущества</div>
                <h2 class="section__title section__title--huge">Почему<br><span class="text-gradient">NEKSOZ</span></h2>
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <?php $adv = [
                        ['num' => '01', 'title' => 'Многолетний опыт', 'text' => 'Более 18 лет работы с иностранными компаниями и представительствами в Таджикистане.'],
                        ['num' => '02', 'title' => 'Знание законодательства', 'text' => 'Глубокое знание миграционного и корпоративного законодательства РТ.'],
                        ['num' => '03', 'title' => 'Под ключ', 'text' => 'Полный цикл оформления — от первого документа до получения готовых виз и разрешений.'],
                    ]; foreach ($adv as $a): ?>
                    <div style="display: flex; gap: 20px; align-items: flex-start;">
                        <div style="width: 48px; height: 48px; min-width: 48px; background: var(--nk-gray-50); border: 1px solid var(--nk-gray-100); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: 900; color: var(--nk-blue);"><?php echo $a['num']; ?></div>
                        <div>
                            <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--nk-gray-900); margin-bottom: 6px;"><?php echo $a['title']; ?></h3>
                            <p style="margin: 0; color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6;"><?php echo $a['text']; ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="fade-up is-visible fade-up-delay-1">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <?php foreach ([['50+', 'Компаний-нерезидентов', 'blue'], ['100%', 'Лицензий получено', 'red'], ['3', 'Языка перевода', 'blue'], ['18+', 'Лет опыта', 'red']] as $stat): ?>
                    <div class="service-card <?php echo $stat[2] === 'red' ? 'service-card--alt' : ''; ?>" style="padding: 28px; text-align: center;">
                        <div style="font-size: 2rem; font-weight: 900; color: var(--nk-<?php echo $stat[2]; ?>); line-height: 1; margin-bottom: 6px;"><?php echo $stat[0]; ?></div>
                        <p style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); font-weight: 700; margin: 0;"><?php echo $stat[1]; ?></p>
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
            <h2 class="cta-crystal__title"><span class="text-gradient">Оформим</span><br>всё за вас</h2>
            <p class="cta-crystal__text">Визы, регистрация, перевод документов — доверьте все вопросы команде NEKSOZ. Мы работаем быстро и точно.</p>
            <div class="cta-crystal__status"><span class="cta-crystal__status-dot"></span>Мы онлайн • Ответ в течение 15 минут</div>
        </div>
        <div class="cta-crystal__form-wrapper fade-up is-visible">
            <form action="#" class="cta-crystal__form">
                <div class="cta-crystal__field"><input type="text" placeholder=" " required id="s-name"><label for="s-name">Ваше имя</label></div>
                <div class="cta-crystal__field"><input type="tel" placeholder=" " required id="s-phone"><label for="s-phone">Телефон (+992)</label></div>
                <div class="cta-crystal__field nx-dropdown">
                    <input type="text" placeholder=" " required id="s-service" class="nx-dropdown__trigger" readonly>
                    <label for="s-service">Тип услуги</label>
                    <div class="nx-dropdown__list">
                        <div class="nx-dropdown__item" data-value="visa">Визовая поддержка</div>
                        <div class="nx-dropdown__item" data-value="secretary">Аутсорсинг секретарских услуг</div>
                        <div class="nx-dropdown__item" data-value="translation">Перевод документов</div>
                        <div class="nx-dropdown__item" data-value="other">Другое</div>
                    </div>
                </div>
                <div class="cta-crystal__field"><textarea placeholder=" " id="s-msg" rows="3"></textarea><label for="s-msg">Подробности</label></div>
                <button type="submit" class="btn btn--primary" style="width:100%; justify-content:center;">Отправить заявку <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></button>
            </form>
        </div>
    </div></div>
</section>
</main>
<?php get_footer(); ?>
