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
                <div class="hero__badge">История и видение</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Ваш стратегический</span><br>бизнес-партнер
                </h1>
                <p class="hero__desc">
                    Neksoz — экспертный хаб, объединивший опыт в аудите и праве для создания новой ценности вашего бизнеса.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary">Начать проект</a>
            </div>
        </div>
    </section>

    <!-- ═══════════ EDITORIAL CONTENT ═══════════ -->
    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Профессиональный фундамент бизнеса</h2>
            <p>
                Наша компания <strong>ООО «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП»</strong> была создана в 2016 году экспертами, обладающими глубоким практическим опытом в сфере налогообложения, финансового учёта, банковского дела и аудита. 
            </p>
            <p>
                Благодаря непоколебимому доверию клиентов и нацеленности на результат, мы зарекомендовали себя как достойный игрок на национальном рынке Таджикистана. Наша прозрачная бизнес-модель и опыт сплочённой команды позволяют нам не только эффективно решать текущие задачи, но и уверенно смотреть в будущее, покоряя новые горизонты бухгалтерского консалтинга.
            </p>

            <div class="simple-card" style="margin-top: 50px; background: var(--nk-gray-50);">
                <h4>Наша специализация</h4>
                <p>
                    ООО «НЕКСОЗ БКГ» предоставляет высококачественные бухгалтерские и консалтинговые услуги как таджикским, так и иностранным компаниям на территории Республики Таджикистан. Мы работаем с предприятиями любой правовой формы, беря на себя ответственность за решение задач любого уровня сложности на различных этапах жизненного цикла бизнеса.
                </p>
            </div>

            <div class="feature-list">
                <div class="feature-item">Доверяй, но проверяй</div>
                <div class="feature-item">Есть проблема? Мы решим!</div>
                <div class="feature-item">Полная обязательность</div>
                <div class="feature-item">Прозрачная модель бизнеса</div>
            </div>
            
            <h2>Миссия и Цели</h2>
            <p>
                Миссия Neksoz проста и понятна: мы создаем почву для стабильного развития вашего бизнеса, обеспечивая комфорт, удобство и абсолютную правильность учёта согласно международным и национальным стандартам.
            </p>
        </div>

        <aside class="editorial-sidebar">
            <div class="simple-card">
                <h4>Основные Принципы</h4>
                <ul class="footer__list" style="margin-top: 20px;">
                    <li style="margin-bottom: 15px;">
                        <strong style="color: var(--nk-red);">01. Доверие:</strong>
                        <p style="font-size: 0.9rem; color: var(--nk-gray-600);">Мы строим отношения на основе взаимного доверия, подкрепленного реальными результатами.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <strong style="color: var(--nk-red);">02. Решение:</strong>
                        <p style="font-size: 0.9rem; color: var(--nk-gray-600);">Мы анализируем ситуацию и предлагаем максимально эффективные варианты выхода из сложных ситуаций.</p>
                    </li>
                    <li style="margin-bottom: 15px;">
                        <strong style="color: var(--nk-red);">03. Сроки:</strong>
                        <p style="font-size: 0.9rem; color: var(--nk-gray-600);">Neksoz исполняет все взятые на себя обязательства качественно и строго в установленный срок.</p>
                    </li>
                </ul>
            </div>
        </aside>
    </div>

</main>

<?php get_footer(); ?>
