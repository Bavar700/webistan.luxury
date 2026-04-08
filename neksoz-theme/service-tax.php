<?php
/**
 * Template Name: Налоговые консультации
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
                <div class="hero__badge">Налоговая практика</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Налоговый</span><br>консалтинг
                </h1>
                <p class="hero__desc">
                    Комплексные решения по налоговому планированию и защите интересов при проверках.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="javascript:void(0)" onclick="openRequestModal('tax')" class="btn btn--primary">Консультация</a>
            </div>
        </div>
    </section>

    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Налоговая безопасность и оптимизация</h2>
            <p>
                Налоговое законодательство Таджикистана требует глубокой экспертизы и постоянного мониторинга изменений. В Neksoz мы помогаем компаниям выстроить эффективную <strong>налоговую политику</strong>, которая обеспечивает полную прозрачность перед законом при максимальном сохранении ресурсов бизнеса.
            </p>

            <div class="simple-card" style="margin-top: 40px; background: var(--nk-gray-50);">
                <h4>Наши налоговые услуги:</h4>
                <ul class="footer__list" style="margin-top: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <li>Налоговые консультации (ЮЛ и ФЛ)</li>
                    <li>Разработка учетной политики</li>
                    <li>Оценка налоговых рисков сделок</li>
                    <li>Решение налоговых споров</li>
                    <li>Сопровождение налоговых проверок</li>
                    <li>Международное налогообложение</li>
                </ul>
            </div>

            <h2 style="margin-top: 50px;">Защита ваших интересов</h2>
            <p>Мы представляем интересы клиентов в налоговых органах, обеспечивая правовую аргументацию каждой позиции и защищая компанию от неправомерных доначислений.</p>
            
            <div class="feature-list">
                <div class="feature-item">Досудебное урегулирование налоговых споров</div>
                <div class="feature-item">Обжалование актов проверок</div>
                <div class="feature-item">Методологическая поддержка бухгалтерии</div>
                <div class="feature-item">Планирование налоговой нагрузки</div>
            </div>
        </div>

        <aside class="editorial-sidebar">
            <div class="simple-card">
                <h4>Налоговая защита</h4>
                <p>Столкнулись с проверкой или нужна срочная оптимизация налогов?</p>
                <button onclick="openRequestModal('tax')" class="cta-crystal__btn">
                    <span>Связаться с экспертом</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
                <p class="cta-crystal__secure">🛡️ Конфиденциальный аудит 24/7</p>
            </div>
        </aside>
    </div>

</main>

<?php get_footer(); ?>
