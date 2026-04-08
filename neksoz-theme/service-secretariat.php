<?php
/**
 * Template Name: Услуги секретариата
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
                <div class="hero__badge">Администрирование</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Секретарская</span><br>поддержка
                </h1>
                <p class="hero__desc">
                    Профессиональное управление документооборотом и секретарское обслуживание для вашего офиса.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="javascript:void(0)" onclick="openRequestModal('secretariat')" class="btn btn--primary">Заказать услугу</a>
            </div>
        </div>
    </section>

    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Поддержка нерезидентов и секретарский аутсорсинг</h2>
            <p>
                Neksoz обеспечивает полное административное сопровождение деятельности иностранных граждан и компаний в Таджикистане. Мы берем на себя все вопросы по <strong>визовой поддержке</strong> и легализации документов, позволяя вам сосредоточиться на бизнес-целях.
            </p>

            <div class="simple-card" style="margin-top: 40px; background: var(--nk-gray-50);">
                <h4>Визовая поддержка и регистрация:</h4>
                <ul class="footer__list" style="margin-top: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <li>Получение лицензий на привлечение ИГ</li>
                    <li>Приглашение и продление виз (М, К, О-2)</li>
                    <li>Регистрация в ОВИР</li>
                    <li>Разрешение на работу</li>
                    <li>Карты Дипсервиса (К виза)</li>
                    <li>Перевод юридических документов</li>
                </ul>
            </div>

            <h2 style="margin-top: 50px;">Аутсорсинг секретарских услуг</h2>
            <p>Мы предлагаем профессиональное управление вашим офисным документооборотом, обеспечивая соблюдение всех стандартов делопроизводства.</p>
            
            <div class="feature-list">
                <div class="feature-item">Прием и обработка корреспонденции</div>
                <div class="feature-item">Организация встреч и совещаний</div>
                <div class="feature-item">Перевод и нотариальное заверение</div>
                <div class="feature-item">Архивное хранение документов</div>
            </div>
        </div>

        <aside class="editorial-sidebar">
            <div class="simple-card">
                <h4>Бизнес-помощник</h4>
                <p>Нужна срочная административная поддержка или сопровождение бизнеса?</p>
                <button onclick="openRequestModal('secretariat')" class="cta-crystal__btn">
                    <span>Запросить поддержку</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
                <p class="cta-crystal__secure">🛡️ Ваш бизнес в надежных руках</p>
            </div>
        </aside>
    </div>

</main>

<?php get_footer(); ?>
