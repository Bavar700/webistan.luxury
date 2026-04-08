<?php
/**
 * Template Name: Юридические услуги
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
                <div class="hero__badge">Департамент права</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Юридическая</span><br>защита
                </h1>
                <p class="hero__desc">
                    Надежная защита интересов компании и минимизация рисков в рамках законодательства Таджикистана.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="javascript:void(0)" onclick="openRequestModal('legal')" class="btn btn--primary">Консультация</a>
            </div>
        </div>
    </section>

    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Комплексная правовая защита бизнеса</h2>
            <p>
                В современных реалиях юридическая грамотность — это не просто преимущество, а необходимое условие выживания компании. Юристы Neksoz обеспечивают <strong>своевременную правовую помощь</strong> и представляют ваши интересы во всех компетентных органах и судебных инстанциях.
            </p>

            <div class="simple-card" style="margin-top: 40px; background: var(--nk-gray-50);">
                <h4>Направления деятельности:</h4>
                <ul class="footer__list" style="margin-top: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <li>Регистрация юридических лиц</li>
                    <li>Перерегистрация компаний</li>
                    <li>Сделки с недвижимостью</li>
                    <li>Банкротство и ликвидация</li>
                    <li>Представительство в судах</li>
                    <li>Разработка сложных договоров</li>
                    <li>Трудовые споры</li>
                    <li>Лицензирование деятельности</li>
                </ul>
            </div>

            <h2 style="margin-top: 50px;">Регистрация и перерегистрация</h2>
            <p>Мы берем на себя все бюрократические процессы, гарантируя правильность оформления документов и соблюдение всех сроков в компетентных органах.</p>
            
            <div class="feature-list">
                <div class="feature-item">Полный пакет документов под ключ</div>
                <div class="feature-item">Взаимодействие с государственными органами</div>
                <div class="feature-item">Правовой аудит учредительных документов</div>
                <div class="feature-item">Консультации по выбору формы собственности</div>
            </div>
        </div>

        <aside class="editorial-sidebar">
            <div class="simple-card">
                <h4>Экстренная помощь</h4>
                <p>Нужна срочная юридическая консультация или защита профессионалов?</p>
                <button onclick="openRequestModal('legal')" class="cta-crystal__btn">
                    <span>Вызвать юриста</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
                <p class="cta-crystal__secure">🛡️ Экстренная линия 24/7</p>
            </div>
        </aside>
    </div>

</main>

<?php get_footer(); ?>
