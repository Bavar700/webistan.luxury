<?php
/**
 * Template Name: Вакансии
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

<!-- ═══════════ PAGE HERO ═══════════ -->
<section class="hero" style="min-height: 50vh; display: flex; align-items: center;">
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    <div class="container hero__inner" style="position: relative; z-index: 2;">
        <div class="hero__content">
            <div class="hero__badge fade-up is-visible">Карьера в NEKSOZ</div>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1">
                <span class="text-gradient">Вакансии</span><br>и возможности
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                Мы ищем талантливых специалистов, готовых расти вместе с нами.<br>
                Присоединяйтесь к <strong>команде профессионалов</strong> NEKSOZ.
            </p>
        </div>
    </div>
</section>

<!-- ═══════════ WHY JOIN US ═══════════ -->
<section class="section section--gray">
    <div class="container">
        <div class="section__header section__header--center fade-up is-visible">
            <div class="section__label">Почему NEKSOZ</div>
            <h2 class="section__title section__title--huge">Работа, которая<br><span class="text-gradient">вдохновляет</span></h2>
        </div>
        <div class="services-grid" style="grid-template-columns: repeat(3, 1fr);">
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </div>
                <h3 class="service-card__title">Профессиональный рост</h3>
                <p class="service-card__text">Мы инвестируем в развитие каждого сотрудника. Регулярные тренинги, семинары и доступ к лучшим отраслевым знаниям.</p>
            </div>
            <div class="service-card service-card--alt fade-up is-visible fade-up-delay-1">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 class="service-card__title">Дружная команда</h3>
                <p class="service-card__text">Сплочённый коллектив профессионалов, где каждый голос услышан. Открытая корпоративная культура и взаимная поддержка.</p>
            </div>
            <div class="service-card fade-up is-visible fade-up-delay-2">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <h3 class="service-card__title">Конкурентная зарплата</h3>
                <p class="service-card__text">Достойное вознаграждение, привязанное к результатам. Бонусы, премии и своевременная выплата без задержек.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ VACANCIES LIST ═══════════ -->
<section class="section">
    <div class="container">
        <div class="section__header fade-up is-visible">
            <div class="section__label">Открытые позиции</div>
            <h2 class="section__title section__title--huge">Текущие<br><span class="text-gradient">вакансии</span></h2>
        </div>

        <div style="display: flex; flex-direction: column; gap: 20px;" class="fade-up is-visible">

            <!-- Vacancy 1 -->
            <div style="background: var(--nk-gray-50); border: 1px solid var(--nk-gray-100); border-radius: 20px; padding: 36px 40px; display: grid; grid-template-columns: 1fr auto; gap: 24px; align-items: center; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 8px 32px rgba(0,68,204,0.1)'; this.style.borderColor='rgba(0,68,204,0.2)'; this.style.background='white'" onmouseout="this.style.boxShadow='none'; this.style.borderColor='var(--nk-gray-100)'; this.style.background='var(--nk-gray-50)'">
                <div>
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                        <span style="background: rgba(0,68,204,0.08); color: var(--nk-blue); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 100px;">Полная занятость</span>
                        <span style="background: rgba(0,180,0,0.08); color: #00a000; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 100px;">• Открыта</span>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 900; color: var(--nk-gray-900); margin-bottom: 10px; letter-spacing: -0.01em;">Главный бухгалтер</h3>
                    <p style="color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6; margin: 0;">Опыт работы от 5 лет. Знание налогового законодательства Таджикистана. Ответственность за ведение полного цикла бухгалтерского учёта.</p>
                </div>
                <a href="#apply" class="btn btn--primary" style="white-space: nowrap;">Откликнуться →</a>
            </div>

            <!-- Vacancy 2 -->
            <div style="background: var(--nk-gray-50); border: 1px solid var(--nk-gray-100); border-radius: 20px; padding: 36px 40px; display: grid; grid-template-columns: 1fr auto; gap: 24px; align-items: center; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 8px 32px rgba(0,68,204,0.1)'; this.style.borderColor='rgba(0,68,204,0.2)'; this.style.background='white'" onmouseout="this.style.boxShadow='none'; this.style.borderColor='var(--nk-gray-100)'; this.style.background='var(--nk-gray-50)'">
                <div>
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                        <span style="background: rgba(0,68,204,0.08); color: var(--nk-blue); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 100px;">Полная занятость</span>
                        <span style="background: rgba(0,180,0,0.08); color: #00a000; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 100px;">• Открыта</span>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 900; color: var(--nk-gray-900); margin-bottom: 10px; letter-spacing: -0.01em;">Аудитор</h3>
                    <p style="color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6; margin: 0;">Проведение финансовых проверок и аудита отчётности. Опыт от 3 лет. Знание МСФО и национальных стандартов бухгалтерского учёта.</p>
                </div>
                <a href="#apply" class="btn btn--primary" style="white-space: nowrap;">Откликнуться →</a>
            </div>

            <!-- Vacancy 3 -->
            <div style="background: var(--nk-gray-50); border: 1px solid var(--nk-gray-100); border-radius: 20px; padding: 36px 40px; display: grid; grid-template-columns: 1fr auto; gap: 24px; align-items: center; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 8px 32px rgba(0,68,204,0.1)'; this.style.borderColor='rgba(0,68,204,0.2)'; this.style.background='white'" onmouseout="this.style.boxShadow='none'; this.style.borderColor='var(--nk-gray-100)'; this.style.background='var(--nk-gray-50)'">
                <div>
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                        <span style="background: rgba(227,6,19,0.06); color: var(--nk-red); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 100px;">Частичная занятость</span>
                        <span style="background: rgba(0,180,0,0.08); color: #00a000; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 100px;">• Открыта</span>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 900; color: var(--nk-gray-900); margin-bottom: 10px; letter-spacing: -0.01em;">Юрист-консультант</h3>
                    <p style="color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6; margin: 0;">Правовое сопровождение бизнес-клиентов. Опыт в корпоративном праве от 2 лет. Знание гражданского и налогового законодательства.</p>
                </div>
                <a href="#apply" class="btn btn--primary" style="white-space: nowrap;">Откликнуться →</a>
            </div>

            <!-- Vacancy 4 -->
            <div style="background: var(--nk-gray-50); border: 1px solid var(--nk-gray-100); border-radius: 20px; padding: 36px 40px; display: grid; grid-template-columns: 1fr auto; gap: 24px; align-items: center; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 8px 32px rgba(0,68,204,0.1)'; this.style.borderColor='rgba(0,68,204,0.2)'; this.style.background='white'" onmouseout="this.style.boxShadow='none'; this.style.borderColor='var(--nk-gray-100)'; this.style.background='var(--nk-gray-50)'">
                <div>
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                        <span style="background: rgba(0,68,204,0.08); color: var(--nk-blue); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 100px;">Полная занятость</span>
                        <span style="background: rgba(0,180,0,0.08); color: #00a000; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; padding: 4px 12px; border-radius: 100px;">• Открыта</span>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 900; color: var(--nk-gray-900); margin-bottom: 10px; letter-spacing: -0.01em;">Налоговый консультант</h3>
                    <p style="color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6; margin: 0;">Консультирование клиентов по вопросам налогообложения. Оптимизация налоговой нагрузки. Опыт от 3 лет в налоговой сфере.</p>
                </div>
                <a href="#apply" class="btn btn--primary" style="white-space: nowrap;">Откликнуться →</a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ APPLY FORM ═══════════ -->
<section id="apply" class="cta-crystal">
    <div class="cta-crystal__glow cta-crystal__glow--blue"></div>
    <div class="cta-crystal__glow cta-crystal__glow--red"></div>
    <div class="container">
        <div class="cta-crystal__grid">
            <div class="cta-crystal__content fade-up is-visible">
                <div class="section__label">Присоединяйтесь</div>
                <h2 class="cta-crystal__title"><span class="text-gradient">Стать частью</span><br>команды NEKSOZ</h2>
                <p class="cta-crystal__text">Отправьте своё резюме и мы свяжемся с вами в ближайшее время. Мы всегда рады новым талантам.</p>
                <div class="cta-crystal__status">
                    <span class="cta-crystal__status-dot"></span>
                    Рассматриваем заявки ежедневно
                </div>
            </div>
            <div class="cta-crystal__form-wrapper fade-up is-visible">
                <form action="#" class="cta-crystal__form">
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " required id="v-name">
                        <label for="v-name">Ваше имя</label>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="tel" placeholder=" " required id="v-phone">
                        <label for="v-phone">Телефон (+992)</label>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="email" placeholder=" " required id="v-email">
                        <label for="v-email">Email</label>
                    </div>
                    <div class="cta-crystal__field nx-dropdown">
                        <input type="text" placeholder=" " required id="v-position" class="nx-dropdown__trigger" readonly>
                        <label for="v-position">Желаемая позиция</label>
                        <div class="nx-dropdown__list">
                            <div class="nx-dropdown__item" data-value="accountant">Главный бухгалтер</div>
                            <div class="nx-dropdown__item" data-value="auditor">Аудитор</div>
                            <div class="nx-dropdown__item" data-value="lawyer">Юрист-консультант</div>
                            <div class="nx-dropdown__item" data-value="tax">Налоговый консультант</div>
                            <div class="nx-dropdown__item" data-value="other">Другая позиция</div>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <textarea placeholder=" " id="v-about" rows="3"></textarea>
                        <label for="v-about">О себе / опыт работы</label>
                    </div>
                    <button type="submit" class="btn btn--primary" style="width: 100%; justify-content: center;">
                        Отправить резюме
                        <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>
