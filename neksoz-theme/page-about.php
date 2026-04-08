<?php
/**
 * Template Name: О нас
 */
get_header();
?>

<main class="site-main">

    <!-- ═══════════ CINEMATIC HERO ═══════════ -->
    <section class="hero hero--internal">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container" style="position:relative;z-index:2;">
            <div class="hero__content">
                <div class="hero__badge">О компании</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Архитектура финансовой</span><br>устойчивости бизнеса
                </h1>
                <p class="hero__desc">
                    Стратегический партнер и экспертный хаб, трансформирующий опыт в аудите и праве в реальную ценность для локального и международного бизнеса в Таджикистане.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts'); ?>" class="cta-crystal__btn" style="padding: 18px 50px; font-size: 13px;">
                    <span>Обсудить проект</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ SECTION 1: ИСТОРИЯ ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">С 2016 года</div>
                <h2 class="section__title">Наш фундамент: Опыт, проверенный временем</h2>
                <p class="section__subtitle">За 10 лет мы прошли путь от амбициозной команды до признанного лидера в области бухгалтерского консалтинга в Таджикистане.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">

                <!-- Card 1: Основание -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h3 class="service-card__title">Компания основана<br>в 2016 году</h3>
                    <div class="service-card__tasks">
                        <p style="color: var(--nk-gray-600); line-height: 1.7; margin-bottom: 20px;">ООО «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП» была создана группой экспертов высшего звена из сфер налогового консультирования, банковского сектора и международного аудита.</p>
                        <p style="color: var(--nk-gray-600); line-height: 1.7;">Мы не просто «ведем учет» — мы выстраиваем прозрачные и устойчивые бизнес-модели, которые позволяют нашим клиентам уверенно масштабироваться.</p>
                    </div>
                </div>

                <!-- Card 2: Специализация -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <h3 class="service-card__title">Специализация:<br>Масштаб без границ</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li><strong>Локальная экспертиза:</strong> Глубокое знание налогового кодекса и законодательства РТ</li>
                            <li><strong>Международные стандарты:</strong> Ведение учета согласно МСФО (IFRS) для иностранных компаний</li>
                            <li><strong>Любая сложность:</strong> Работа с предприятиями всех правовых форм собственности</li>
                            <li>От регистрации стартапа до аудита транснациональных корпораций</li>
                        </ul>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-top: 20px;">
                            <span style="font-size: 12px; font-weight: 600; padding: 5px 12px; background: rgba(239,68,68,0.08); border-radius: 20px; color: var(--nk-red);">Ритейл</span>
                            <span style="font-size: 12px; font-weight: 600; padding: 5px 12px; background: rgba(239,68,68,0.08); border-radius: 20px; color: var(--nk-red);">Производство</span>
                            <span style="font-size: 12px; font-weight: 600; padding: 5px 12px; background: rgba(239,68,68,0.08); border-radius: 20px; color: var(--nk-red);">IT & Fintech</span>
                            <span style="font-size: 12px; font-weight: 600; padding: 5px 12px; background: rgba(239,68,68,0.08); border-radius: 20px; color: var(--nk-red);">НКО и Фонды</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════ SECTION 2: МИССИЯ И ПРИНЦИПЫ ═══════════ -->
    <section class="section" style="background: var(--nk-gray-50); border-top: 1px solid rgba(0,0,0,0.04);">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Кодекс Neksoz</div>
                <h2 class="section__title">Миссия и ценности</h2>
                <p class="section__subtitle">"Создавать безупречную почву для роста бизнеса, внедряя культуру правильного учета и финансовой прозрачности."</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(3, 1fr); gap: 30px;">

                <!-- Принцип 01 -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="service-card__title">01. Доверие<br>через результат</h3>
                    <div class="service-card__tasks">
                        <p style="color: var(--nk-gray-600); line-height: 1.7;">Мы не просим доверия — мы зарабатываем его качеством каждой сданной декларации и чистотой каждого аудиторского заключения.</p>
                    </div>
                </div>

                <!-- Принцип 02 -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    </div>
                    <h3 class="service-card__title">02. Решения<br>вместо отчетов</h3>
                    <div class="service-card__tasks">
                        <p style="color: var(--nk-gray-600); line-height: 1.7;">Мы не просто констатируем факты — мы анализируем риски и предлагаем эффективные сценарии выхода из сложных финансовых и юридических ситуаций.</p>
                    </div>
                </div>

                <!-- Принцип 03 -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h3 class="service-card__title">03. Культура<br>дедлайнов</h3>
                    <div class="service-card__tasks">
                        <p style="color: var(--nk-gray-600); line-height: 1.7;">В мире финансов время — это деньги. Мы гарантируем строжайшее соблюдение сроков, беря на себя полную ответственность за результат.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════ SECTION 3: ЦИФРЫ И ФАКТЫ ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Цифры и факты</div>
                <h2 class="section__title">Почему выбирают нас?</h2>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(4, 1fr); gap: 30px;">

                <!-- Stat 1 -->
                <div class="service-card service-card--alt" style="text-align: center; padding: 40px 20px;">
                    <div style="width: 64px; height: 64px; background: var(--nk-grad-brand); border-radius: 18px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 10px 30px rgba(239,68,68,0.25);">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                    <div style="font-size: 48px; font-weight: 800; color: var(--nk-red); line-height: 1; font-family: var(--font-display);">10<span style="font-size: 22px;">лет</span></div>
                    <div style="margin-top: 12px; font-size: 16px; font-weight: 600; color: var(--nk-gray-900);">На рынке</div>
                    <p style="margin-top: 8px; font-size: 14px; color: var(--nk-gray-500); line-height: 1.5;">безупречной репутации в консалтинге</p>
                </div>

                <!-- Stat 2 -->
                <div class="service-card service-card--alt" style="text-align: center; padding: 40px 20px;">
                    <div style="width: 64px; height: 64px; background: var(--nk-grad-brand); border-radius: 18px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 10px 30px rgba(239,68,68,0.25);">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div style="font-size: 48px; font-weight: 800; color: var(--nk-red); line-height: 1; font-family: var(--font-display);">100<span style="font-size: 32px;">+</span></div>
                    <div style="margin-top: 12px; font-size: 16px; font-weight: 600; color: var(--nk-gray-900);">Клиентов</div>
                    <p style="margin-top: 8px; font-size: 14px; color: var(--nk-gray-500); line-height: 1.5;">постоянных корпоративных партнеров</p>
                </div>

                <!-- Stat 3 -->
                <div class="service-card service-card--alt" style="text-align: center; padding: 40px 20px;">
                    <div style="width: 64px; height: 64px; background: var(--nk-grad-brand); border-radius: 18px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 10px 30px rgba(239,68,68,0.25);">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    </div>
                    <div style="font-size: 40px; font-weight: 800; color: var(--nk-red); line-height: 1; font-family: var(--font-display);">МСФО</div>
                    <div style="margin-top: 12px; font-size: 16px; font-weight: 600; color: var(--nk-gray-900);">Квалификация</div>
                    <p style="margin-top: 8px; font-size: 14px; color: var(--nk-gray-500); line-height: 1.5;">национальные и международные стандарты</p>
                </div>

                <!-- Stat 4 -->
                <div class="service-card service-card--alt" style="text-align: center; padding: 40px 20px;">
                    <div style="width: 64px; height: 64px; background: var(--nk-grad-brand); border-radius: 18px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 10px 30px rgba(239,68,68,0.25);">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/><polyline points="9 12 11 14 15 10"/></svg>
                    </div>
                    <div style="font-size: 48px; font-weight: 800; color: var(--nk-red); line-height: 1; font-family: var(--font-display);">100<span style="font-size: 32px;">%</span></div>
                    <div style="margin-top: 12px; font-size: 16px; font-weight: 600; color: var(--nk-gray-900);">Прозрачность</div>
                    <p style="margin-top: 8px; font-size: 14px; color: var(--nk-gray-500); line-height: 1.5;">ответственности за точность отчетности</p>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════ FINAL CTA (GLASSMORPHISM) ═══════════ -->
    <section class="cta-crystal" style="padding: 100px 0; position: relative;">
        <div class="cta-crystal__glow cta-crystal__glow--blue"></div>
        <div class="cta-crystal__glow cta-crystal__glow--red"></div>

        <div class="container fade-up" style="position: relative; z-index: 2;">
            <div style="background: rgba(255, 255, 255, 0.8); border: 1px solid rgba(0, 13, 51, 0.05); border-radius: 32px; padding: 80px 40px; text-align: center; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.06); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);">
                <div class="section__label" style="margin-bottom: 20px;">Следующий шаг</div>
                <h2 class="section__title" style="font-size: 42px; color: var(--nk-gray-900); margin-bottom: 24px;">Готовы вывести бизнес на новый уровень прозрачности?</h2>
                <p style="font-size: 18px; color: var(--nk-gray-600); max-width: 600px; margin: 0 auto 40px; line-height: 1.6;">
                    Доверьте финансовый и юридический фундамент экспертам Neksoz. Мы обеспечим вам комфорт, безопасность и ясность в каждой цифре.
                </p>
                <a href="<?php echo home_url('/contacts'); ?>" class="cta-crystal__btn" style="padding: 18px 50px; font-size: 15px;">
                    <span>Записаться на встречу с экспертом</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
