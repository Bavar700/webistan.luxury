<?php
/**
 * Template Name: Страница Услуг
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Page Header -->
    <section class="nk-page-header uk-flex uk-flex-middle" style="min-height: 40vh; background: var(--nk-primary-dark); position: relative; overflow: hidden; padding: 60px 0;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.05; background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="nk-container uk-position-relative uk-position-z-index">
            <h1 class="fade-up is-visible" style="color: #fff; font-size: 3rem; margin-bottom: 1rem;"><?php the_title(); ?></h1>
            <p class="fade-up is-visible fade-up-delay-1" style="color: rgba(255,255,255,0.7); font-size: 1.2rem; max-width: 600px;">
                Комплексные решения для вашего бизнеса. От аудита до полного юридического и финансового сопровождения.
            </p>
        </div>
    </section>

    <!-- Services Grid List -->
    <section class="nk-section" style="background: var(--nk-bg);">
        <div class="nk-container">
            <div class="uk-grid-column-medium uk-grid-row-large uk-child-width-1-3@m uk-child-width-1-2@s" uk-grid>

                <!-- Service 1: Audit -->
                <div class="fade-up is-visible fade-up-delay-1">
                    <a href="#" class="nk-service-card" style="display: block; background: var(--nk-bg-alt); padding: 2.5rem; border-radius: 12px; height: 100%; transition: all 0.3s ease; text-decoration: none; border: 1px solid var(--nk-border);">
                        <div class="nk-service-card__icon" style="background: rgba(59, 130, 246, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--nk-accent);">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                        </div>
                        <h3 class="nk-service-card__title" style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--nk-text);">Аудит финансовой деятельности</h3>
                        <p class="nk-service-card__desc" style="color: var(--nk-text-secondary); line-height: 1.6; margin-bottom: 2rem; font-size: 0.95rem;">Аудит — это больше, чем проверка цифр. Оценка внутреннего контроля, законности и перспективный анализ резервов.</p>
                        <span class="nk-service-card__link" style="color: var(--nk-primary); font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
                            Подробнее <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </span>
                    </a>
                </div>

                <!-- Service 2: Taxes -->
                <div class="fade-up is-visible fade-up-delay-2">
                    <a href="#" class="nk-service-card" style="display: block; background: var(--nk-bg-alt); padding: 2.5rem; border-radius: 12px; height: 100%; transition: all 0.3s ease; text-decoration: none; border: 1px solid var(--nk-border);">
                        <div class="nk-service-card__icon" style="background: rgba(59, 130, 246, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--nk-accent);">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        </div>
                        <h3 class="nk-service-card__title" style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--nk-text);">Налоговые консультации</h3>
                        <p class="nk-service-card__desc" style="color: var(--nk-text-secondary); line-height: 1.6; margin-bottom: 2rem; font-size: 0.95rem;">Разработка налоговой политики, решение налоговых споров и снижение рисков.</p>
                        <span class="nk-service-card__link" style="color: var(--nk-primary); font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
                            Подробнее <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </span>
                    </a>
                </div>

                <!-- Service 3: Legal -->
                <div class="fade-up is-visible fade-up-delay-3">
                    <a href="#" class="nk-service-card" style="display: block; background: var(--nk-bg-alt); padding: 2.5rem; border-radius: 12px; height: 100%; transition: all 0.3s ease; text-decoration: none; border: 1px solid var(--nk-border);">
                        <div class="nk-service-card__icon" style="background: rgba(59, 130, 246, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--nk-accent);">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <h3 class="nk-service-card__title" style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--nk-text);">Юридические консультации</h3>
                        <p class="nk-service-card__desc" style="color: var(--nk-text-secondary); line-height: 1.6; margin-bottom: 2rem; font-size: 0.95rem;">Регистрация и перерегистрация юридических лиц, а также юридическое сопровождение сделок с недвижимостью.</p>
                        <span class="nk-service-card__link" style="color: var(--nk-primary); font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
                            Подробнее <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </span>
                    </a>
                </div>

                <!-- Service 4: Accounting & HR -->
                <div class="fade-up is-visible fade-up-delay-1">
                    <a href="#" class="nk-service-card" style="display: block; background: var(--nk-bg-alt); padding: 2.5rem; border-radius: 12px; height: 100%; transition: all 0.3s ease; text-decoration: none; border: 1px solid var(--nk-border);">
                        <div class="nk-service-card__icon" style="background: rgba(59, 130, 246, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--nk-accent);">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </div>
                        <h3 class="nk-service-card__title" style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--nk-text);">Финансовый и кадровый учет</h3>
                        <p class="nk-service-card__desc" style="color: var(--nk-text-secondary); line-height: 1.6; margin-bottom: 2rem; font-size: 0.95rem;">Введение учета на основе аутсорсинга. Целостное отражение хозяйственных операций и делопроизводство.</p>
                        <span class="nk-service-card__link" style="color: var(--nk-primary); font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
                            Подробнее <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </span>
                    </a>
                </div>

                <!-- Service 5: Restore -->
                <div class="fade-up is-visible fade-up-delay-2">
                    <a href="#" class="nk-service-card" style="display: block; background: var(--nk-bg-alt); padding: 2.5rem; border-radius: 12px; height: 100%; transition: all 0.3s ease; text-decoration: none; border: 1px solid var(--nk-border);">
                        <div class="nk-service-card__icon" style="background: rgba(59, 130, 246, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--nk-accent);">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M8.5 15.5L14 10l6 6"/></svg>
                        </div>
                        <h3 class="nk-service-card__title" style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--nk-text);">Восстановление учёта</h3>
                        <p class="nk-service-card__desc" style="color: var(--nk-text-secondary); line-height: 1.6; margin-bottom: 2rem; font-size: 0.95rem;">Восстановление документов и юридическая консультация в сфере финансовой деятельности вашей организации.</p>
                        <span class="nk-service-card__link" style="color: var(--nk-primary); font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
                            Подробнее <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </span>
                    </a>
                </div>

                <!-- Service 6: Business -->
                <div class="fade-up is-visible fade-up-delay-3">
                    <a href="#" class="nk-service-card" style="display: block; background: var(--nk-bg-alt); padding: 2.5rem; border-radius: 12px; height: 100%; transition: all 0.3s ease; text-decoration: none; border: 1px solid var(--nk-border);">
                        <div class="nk-service-card__icon" style="background: rgba(59, 130, 246, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--nk-accent);">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                        </div>
                        <h3 class="nk-service-card__title" style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--nk-text);">Бизнес-консультации</h3>
                        <p class="nk-service-card__desc" style="color: var(--nk-text-secondary); line-height: 1.6; margin-bottom: 2rem; font-size: 0.95rem;">Профессиональные консультации владельцам: стратегическое управление и оптимизация процессов.</p>
                        <span class="nk-service-card__link" style="color: var(--nk-primary); font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
                            Подробнее <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </span>
                    </a>
                </div>

                <!-- Service 7: Secretariat (Optional but exists in HTML) -->
                <div class="fade-up is-visible fade-up-delay-1">
                    <a href="#" class="nk-service-card" style="display: block; background: var(--nk-bg-alt); padding: 2.5rem; border-radius: 12px; height: 100%; transition: all 0.3s ease; text-decoration: none; border: 1px solid var(--nk-border);">
                        <div class="nk-service-card__icon" style="background: rgba(59, 130, 246, 0.1); width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--nk-accent);">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        </div>
                        <h3 class="nk-service-card__title" style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--nk-text);">Услуги секретариата</h3>
                        <p class="nk-service-card__desc" style="color: var(--nk-text-secondary); line-height: 1.6; margin-bottom: 2rem; font-size: 0.95rem;">Аутсорсинг секретарских услуг, перевод документов и вопросы регистрации нерезидентов (визы).</p>
                        <span class="nk-service-card__link" style="color: var(--nk-primary); font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
                            Подробнее <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </span>
                    </a>
                </div>

            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
