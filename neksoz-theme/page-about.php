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
                <div class="hero__badge">Neksoz</div>
                <h1 class="hero__title" style="font-family: var(--font-display);">
                    <span class="text-gradient">Архитектура финансовой</span><br>устойчивости бизнеса
                </h1>
                <p class="hero__desc" style="max-width: 700px;">
                    Стратегический партнер и экспертный хаб, трансформирующий опыт в аудите и праве в реальную ценность для локального и международного бизнеса в Таджикистане.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary">Обсудить проект</a>
            </div>
        </div>
    </section>

    <!-- ═══════════ EDITORIAL CONTENT ═══════════ -->
    <div class="editorial-content" style="padding-bottom: 60px;">
        <div class="editorial-main">
            <h2 style="font-family: var(--font-display); color: #2c3e50; font-weight: 700;">Наш фундамент: Опыт, проверенный временем</h2>
            <p style="font-size: 1.1rem; line-height: 1.8; color: var(--nk-gray-700);">
                Компания <strong>ООО «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП»</strong> была основана в <strong>2016 году</strong>. В основе нашего создания стояла группа экспертов высшего звена из сфер налогового консультирования, банковского сектора и международного аудита. 
            </p>
            <p style="font-size: 1.1rem; line-height: 1.8; color: var(--nk-gray-700);">
                За 10 лет работы на рынке Таджикистана мы прошли путь от амбициозной команды до признанного лидера в области бухгалтерского консалтинга. Мы не просто «ведем учет» — мы выстраиваем прозрачные и устойчивые бизнес-модели, которые позволяют нашим клиентам уверенно масштабироваться.
            </p>

            <div class="simple-card" style="margin-top: 50px; background: rgba(0, 13, 51, 0.02); border: 1px solid rgba(0, 13, 51, 0.05); border-radius: 16px; padding: 40px;">
                <h3 style="font-family: var(--font-display); color: #2c3e50; margin-bottom: 20px; font-weight: 700;">Наша специализация: Масштаб без границ</h3>
                <p style="margin-bottom: 24px; color: var(--nk-gray-700);">
                    Мы обеспечиваем экспертную поддержку на всех этапах жизненного цикла бизнеса: от регистрации стартапа до аудита транснациональных корпораций.
                </p>
                <ul style="list-style: none; padding: 0; display: grid; gap: 16px; margin-bottom: 30px;">
                    <li style="display: flex; gap: 12px; align-items: flex-start;">
                        <svg style="color: var(--nk-red); flex-shrink: 0; margin-top: 3px;" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span style="color: var(--nk-gray-900);"><strong>Локальная экспертиза:</strong> Глубокое знание налогового кодекса и законодательства РТ.</span>
                    </li>
                    <li style="display: flex; gap: 12px; align-items: flex-start;">
                        <svg style="color: var(--nk-red); flex-shrink: 0; margin-top: 3px;" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span style="color: var(--nk-gray-900);"><strong>Международные стандарты:</strong> Ведение учета согласно МСФО (IFRS) для иностранных компаний.</span>
                    </li>
                    <li style="display: flex; gap: 12px; align-items: flex-start;">
                        <svg style="color: var(--nk-red); flex-shrink: 0; margin-top: 3px;" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span style="color: var(--nk-gray-900);"><strong>Любая сложность:</strong> Работа с предприятиями всех правовых форм собственности.</span>
                    </li>
                </ul>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <span style="font-size: 13px; font-weight: 500; padding: 6px 14px; background: white; border-radius: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); color: #2c3e50;">Ритейл</span>
                    <span style="font-size: 13px; font-weight: 500; padding: 6px 14px; background: white; border-radius: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); color: #2c3e50;">Производство</span>
                    <span style="font-size: 13px; font-weight: 500; padding: 6px 14px; background: white; border-radius: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); color: #2c3e50;">IT & Fintech</span>
                    <span style="font-size: 13px; font-weight: 500; padding: 6px 14px; background: white; border-radius: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); color: #2c3e50;">НКО и Фонды</span>
                </div>
            </div>
            
            <h2 style="font-family: var(--font-display); color: #2c3e50; margin-top: 60px; font-weight: 700;">Миссия: Кодекс «Нексоз»</h2>
            <p style="font-size: 1.15rem; margin-bottom: 40px; padding-left: 24px; border-left: 4px solid var(--nk-red); font-style: italic; color: var(--nk-gray-900);">
                "Создавать безупречную почву для роста бизнеса, внедряя культуру правильного учета и финансовой прозрачности."
            </p>
        </div>

        <aside class="editorial-sidebar">
            <div class="simple-card" style="position: sticky; top: 120px; background: white; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 30px 60px rgba(0,13,51,0.05);">
                <h4 style="font-family: var(--font-display); color: #2c3e50; margin-bottom: 24px; font-weight: 700;">Наши принципы</h4>
                <ul class="footer__list">
                    <li style="margin-bottom: 24px;">
                        <strong style="color: var(--nk-red); display: block; font-size: 16px; margin-bottom: 8px;">01. Доверие через результат</strong>
                        <p style="font-size: 0.95rem; color: var(--nk-gray-600); line-height: 1.5; margin: 0;">Мы не просим доверия — мы зарабатываем его качеством каждой сданной декларации и чистотой каждого аудиторского заключения.</p>
                    </li>
                    <li style="margin-bottom: 24px;">
                        <strong style="color: var(--nk-red); display: block; font-size: 16px; margin-bottom: 8px;">02. Решения вместо отчетов</strong>
                        <p style="font-size: 0.95rem; color: var(--nk-gray-600); line-height: 1.5; margin: 0;">Мы не просто констатируем факты, мы анализируем риски и предлагаем эффективные сценарии выхода из сложных финансовых и юридических ситуаций.</p>
                    </li>
                    <li>
                        <strong style="color: var(--nk-red); display: block; font-size: 16px; margin-bottom: 8px;">03. Культура дедлайнов</strong>
                        <p style="font-size: 0.95rem; color: var(--nk-gray-600); line-height: 1.5; margin: 0;">В мире финансов время — это деньги. Мы гарантируем строжайшее соблюдение сроков, беря на себя полную ответственность за результат.</p>
                    </li>
                </ul>
            </div>
        </aside>
    </div>

    <!-- ═══════════ SECTION: WHY US (STATS) ═══════════ -->
    <section class="section" style="background: var(--nk-gray-50); border-top: 1px solid rgba(0,0,0,0.05); padding: 80px 0;">
        <div class="container fade-up">
            <div class="section__header section__header--center" style="margin-bottom: 50px;">
                <h2 class="section__title" style="font-family: var(--font-display); color: #2c3e50;">Почему выбирают нас?</h2>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 30px; text-align: center;">
                <!-- Stat 1 -->
                <div style="background: white; padding: 40px 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                    <div style="font-size: 48px; font-weight: 800; color: var(--nk-red); font-family: var(--font-display); line-height: 1;">10<span style="font-size: 24px;">лет</span></div>
                    <div style="margin-top: 16px; font-size: 16px; font-weight: 600; color: var(--nk-gray-900);">Безупречность</div>
                    <p style="margin-top: 8px; font-size: 14px; color: var(--nk-gray-500); line-height: 1.5;">безупречной репутации на рынке консалтинга.</p>
                </div>
                <!-- Stat 2 -->
                <div style="background: white; padding: 40px 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                    <div style="font-size: 48px; font-weight: 800; color: var(--nk-red); font-family: var(--font-display); line-height: 1;">100<span style="font-size: 32px;">+</span></div>
                    <div style="margin-top: 16px; font-size: 16px; font-weight: 600; color: var(--nk-gray-900);">Клиентов</div>
                    <p style="margin-top: 8px; font-size: 14px; color: var(--nk-gray-500); line-height: 1.5;">постоянных корпоративных клиентов.</p>
                </div>
                <!-- Stat 3 -->
                <div style="background: white; padding: 40px 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                    <div style="font-size: 48px; font-weight: 800; color: var(--nk-red); font-family: var(--font-display); line-height: 1;">МСФО</div>
                    <div style="margin-top: 16px; font-size: 16px; font-weight: 600; color: var(--nk-gray-900);">Квалификация</div>
                    <p style="margin-top: 8px; font-size: 14px; color: var(--nk-gray-500); line-height: 1.5;">Экспертиза в национальных и международных стандартах.</p>
                </div>
                <!-- Stat 4 -->
                <div style="background: white; padding: 40px 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                    <div style="font-size: 48px; font-weight: 800; color: var(--nk-red); font-family: var(--font-display); line-height: 1;">100<span style="font-size: 32px;">%</span></div>
                    <div style="margin-top: 16px; font-size: 16px; font-weight: 600; color: var(--nk-gray-900);">Прозрачность</div>
                    <p style="margin-top: 8px; font-size: 14px; color: var(--nk-gray-500); line-height: 1.5;">ответственности за точность финансовой отчетности.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════ FINAL CTA (GLASSMORPHISM) ═══════════ -->
    <section class="cta-crystal" style="padding: 100px 0; position: relative;">
        <!-- Glowing Orbs inside section container -->
        <div class="cta-crystal__glow cta-crystal__glow--blue" style="width: 500px; height: 500px; top: -100px; right: -100px; opacity: 0.15;"></div>
        <div class="cta-crystal__glow cta-crystal__glow--red" style="width: 400px; height: 400px; bottom: -50px; left: -100px; opacity: 0.15;"></div>

        <div class="container fade-up" style="position: relative; z-index: 2;">
            <div style="background: rgba(255, 255, 255, 0.8); border: 1px solid rgba(0, 13, 51, 0.05); border-radius: 32px; padding: 80px 40px; text-align: center; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.06); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);">
                <h2 style="font-family: var(--font-display); font-size: 42px; color: #2c3e50; font-weight: 800; margin-bottom: 24px; letter-spacing: -0.02em;">Готовы вывести бизнес на новый уровень прозрачности?</h2>
                <p style="font-size: 18px; color: var(--nk-gray-600); max-width: 600px; margin: 0 auto 40px; line-height: 1.6;">
                    Доверьте финансовый и юридический фундамент экспертам Neksoz. Мы обеспечим вам комфорт, безопасность и ясность в каждой цифре.
                </p>
                <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary" style="padding: 18px 40px; font-size: 16px;">Записаться на встречу с экспертом</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
