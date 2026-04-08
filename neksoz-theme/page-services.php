<?php
/**
 * Template Name: Услуги
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

<!-- ═══════════ PAGE HERO ═══════════ -->
<section class="hero" style="min-height: 55vh; display: flex; align-items: center;">
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    <div class="container hero__inner" style="position: relative; z-index: 2;">
        <div class="hero__content">
            <div class="hero__badge fade-up is-visible">Наши услуги</div>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1">
                <span class="text-gradient">Комплексные решения</span><br>для вашего бизнеса
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                Каждая услуга адаптируется под индивидуальные потребности клиента<br>и обеспечивает <strong>максимальную защиту ваших интересов</strong>.
            </p>
        </div>
    </div>
</section>

<!-- ═══════════ SERVICES GRID ═══════════ -->
<section id="services" class="section section--gray">
    <div class="container">
        <div class="section__header section__header--center fade-up is-visible">
            <div class="section__label">Направления</div>
            <h2 class="section__title section__title--huge"><span class="text-gradient">Все услуги</span><br>компании NEKSOZ</h2>
        </div>

        <div class="services-grid">

            <!-- 1. Аудит -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                </div>
                <h3 class="service-card__title">Аудит финансовой деятельности</h3>
                <p class="service-card__text">Независимая проверка отчетности, которая подтверждает прозрачность бизнеса и выявляет скрытые финансовые риски. Аудит — это больше, чем проверка цифр.</p>
                <a href="<?php echo home_url('/audit'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 2. Восстановление учёта -->
            <div class="service-card service-card--alt fade-up is-visible fade-up-delay-1">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                </div>
                <h3 class="service-card__title">Восстановление финансового учета</h3>
                <p class="service-card__text">Мы приведем вашу запущенную документацию в полный порядок, устранив ошибки и защитив вас от претензий государственных органов.</p>
                <a href="<?php echo home_url('/restore'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 3. Юридические консультации -->
            <div class="service-card fade-up is-visible fade-up-delay-2">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="service-card__title">Юридические консультации</h3>
                <p class="service-card__text">Правовая безопасность компании и надежная защита интересов в любых договорах и спорах. Профессиональная юридическая поддержка бизнеса.</p>
                <a href="<?php echo home_url('/legal'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 4. Ведение учёта -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 class="service-card__title">Ведение финансового и кадрового учета</h3>
                <p class="service-card__text">Мы берем на себя всю рутину по бухгалтерии и кадрам, гарантируя отсутствие штрафов и стабильную работу штата вашей компании.</p>
                <a href="<?php echo home_url('/accounting'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 5. Услуги секретариата -->
            <div class="service-card fade-up is-visible fade-up-delay-1">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                </div>
                <h3 class="service-card__title">Услуги секретариата</h3>
                <p class="service-card__text">Вы делегируете администрирование документации и звонков профессионалам, освобождая своё время для решения стратегических задач.</p>
                <a href="<?php echo home_url('/secretariat'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 6. Бизнес-консультации -->
            <div class="service-card service-card--alt fade-up is-visible fade-up-delay-2">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                </div>
                <h3 class="service-card__title">Бизнес-консультации</h3>
                <p class="service-card__text">Экспертная поддержка в поиске новых точек роста и разработке эффективной модели развития вашего предприятия с прогнозируемым результатом.</p>
                <a href="<?php echo home_url('/consulting'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 7. Налоговые консультации -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <h3 class="service-card__title">Налоговые консультации</h3>
                <p class="service-card__text">Помогаем законно оптимизировать налоговую нагрузку и минимизировать риски перед визитами контролирующих органов. Защита от штрафов.</p>
                <a href="<?php echo home_url('/tax'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 8. Управленческий учёт -->
            <div class="service-card service-card--alt fade-up is-visible fade-up-delay-1">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/></svg>
                </div>
                <h3 class="service-card__title">Управленческий учет</h3>
                <p class="service-card__text">Полная финансовая прозрачность и точные данные для принятия решений, которые реально увеличивают вашу чистую прибыль.</p>
                <a href="<?php echo home_url('/management-accounting'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 9. Автоматизация -->
            <div class="service-card fade-up is-visible fade-up-delay-2">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9"/></svg>
                </div>
                <h3 class="service-card__title">Автоматизация бизнес-процессов</h3>
                <p class="service-card__text">Освобождаем команду от рутины и исключаем ошибки человеческого фактора, переводя управление в быструю и точную цифровую среду.</p>
                <a href="<?php echo home_url('/automation'); ?>" class="service-card__link">Подробнее →</a>
            </div>

        </div>
    </div>
</section>

<!-- ═══════════ WHY US ═══════════ -->
<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center;">
            <div class="fade-up is-visible">
                <div class="section__label">Почему мы</div>
                <h2 class="section__title section__title--huge">Почему выбирают<br><span class="text-gradient">NEKSOZ?</span></h2>
                <div style="display: flex; flex-direction: column; gap: 24px; margin-top: 2rem;">
                    <div style="display: flex; gap: 20px; align-items: flex-start;">
                        <div style="width: 48px; height: 48px; min-width: 48px; background: rgba(0,68,204,0.08); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--nk-blue)" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <div>
                            <h4 style="font-weight: 800; color: var(--nk-gray-900); margin-bottom: 6px; font-size: 1rem;">18+ лет опыта</h4>
                            <p style="color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6; margin: 0;">Глубокая экспертиза в налогообложении, финансовом учёте и консалтинге на рынке Таджикистана.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 20px; align-items: flex-start;">
                        <div style="width: 48px; height: 48px; min-width: 48px; background: rgba(227,6,19,0.06); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--nk-red)" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg>
                        </div>
                        <div>
                            <h4 style="font-weight: 800; color: var(--nk-gray-900); margin-bottom: 6px; font-size: 1rem;">50+ квалифицированных экспертов</h4>
                            <p style="color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6; margin: 0;">Команда профессионалов с узкой специализацией в каждом направлении.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 20px; align-items: flex-start;">
                        <div style="width: 48px; height: 48px; min-width: 48px; background: rgba(0,68,204,0.08); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--nk-blue)" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <div>
                            <h4 style="font-weight: 800; color: var(--nk-gray-900); margin-bottom: 6px; font-size: 1rem;">Юридическая защита</h4>
                            <p style="color: var(--nk-gray-600); font-size: 0.95rem; line-height: 1.6; margin: 0;">Полное юридическое сопровождение и защита интересов клиента на всех этапах.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fade-up is-visible fade-up-delay-2">
                <div style="background: linear-gradient(135deg, var(--nk-gray-50) 0%, white 100%); border: 1px solid var(--nk-gray-100); border-radius: 20px; padding: 50px 40px; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: -20px; right: -20px; width: 120px; height: 120px; background: radial-gradient(circle, rgba(0,68,204,0.08) 0%, transparent 70%); border-radius: 50%;"></div>
                    <blockquote style="font-size: 1.25rem; font-weight: 600; font-style: italic; color: var(--nk-gray-900); line-height: 1.7; margin: 0 0 30px; position: relative; z-index: 1;">
                        «Аудит — это больше, чем проверка цифр. Он обеспечивает создание фундамента для достижения будущих целей компании.»
                    </blockquote>
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="width: 52px; height: 52px; border-radius: 50%; overflow: hidden; border: 3px solid var(--nk-blue); flex-shrink: 0;">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ceo.jpg" alt="CEO" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div>
                            <div style="font-weight: 800; color: var(--nk-gray-900); font-size: 0.95rem;">Зоир Салимов</div>
                            <div style="color: var(--nk-gray-400); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.08em;">Генеральный директор</div>
                        </div>
                    </div>
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
                <div class="section__label">Быстрая связь</div>
                <h2 class="cta-crystal__title"><span class="text-gradient">Готовы масштабировать</span><br>свой успех?</h2>
                <p class="cta-crystal__text">Оставьте заявку сегодня, и мы разработаем для вас персональную стратегию развития и обеспечения безопасности вашего бизнеса.</p>
                <div class="cta-crystal__status">
                    <span class="cta-crystal__status-dot"></span>
                    Мы онлайн • Ответ в течение 15 минут
                </div>
            </div>
            <div class="cta-crystal__form-wrapper fade-up is-visible">
                <form action="#" class="cta-crystal__form">
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " required id="s-name">
                        <label for="s-name">Ваше имя</label>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="tel" placeholder=" " required id="s-phone">
                        <label for="s-phone">Телефон (+992)</label>
                    </div>
                    <div class="cta-crystal__field nx-dropdown">
                        <input type="text" placeholder=" " required id="s-service" class="nx-dropdown__trigger" readonly>
                        <label for="s-service">Выберите услугу</label>
                        <div class="nx-dropdown__list">
                            <div class="nx-dropdown__item" data-value="audit">Аудит финансовой деятельности</div>
                            <div class="nx-dropdown__item" data-value="restore">Восстановление учёта</div>
                            <div class="nx-dropdown__item" data-value="legal">Юридические консультации</div>
                            <div class="nx-dropdown__item" data-value="accounting">Ведение учёта</div>
                            <div class="nx-dropdown__item" data-value="tax">Налоговые консультации</div>
                            <div class="nx-dropdown__item" data-value="consulting">Бизнес-консультации</div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn--primary" style="width: 100%; justify-content: center;">
                        Отправить заявку
                        <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>
