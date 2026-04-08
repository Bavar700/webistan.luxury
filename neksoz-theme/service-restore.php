<?php
/**
 * Template Name: Восстановление финансового учета
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
                <div class="hero__badge">Кризис-менеджмент</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Восстановление</span><br>учета
                </h1>
                <p class="hero__desc">
                    Приведение запущенной документации в порядок и защита вашего бизнеса от претензий госорганов.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="javascript:void(0)" onclick="openRequestModal('restore')" class="btn btn--primary">Начать процесс</a>
            </div>
        </div>
    </section>

    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Восстановление учета и финансовая защита</h2>
            <p>
                Запущенное состояние финансовой документации — это критический риск для существования бизнеса. Специалисты Neksoz проводят комплексное <strong>восстановление финансового учета</strong>, возвращая компанию в легитимное поле и создавая надежную базу для дальнейшего развития.
            </p>

            <div class="simple-card" style="margin-top: 40px; background: var(--nk-gray-50);">
                <h4>Процесс восстановления включает:</h4>
                <ul class="footer__list" style="margin-top: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <li>Инвентаризация текущих активов</li>
                    <li>Восстановление первичных документов</li>
                    <li>Корректировка налоговой отчетности</li>
                    <li>Сверка расчетов с контрагентами</li>
                    <li>Юридические консультации в сфере финансов</li>
                    <li>Подготовка к внешним проверкам</li>
                </ul>
            </div>

            <h2 style="margin-top: 50px;">Юридический консалтинг в финансах</h2>
            <p>Мы не только исправляем цифры, но и обеспечиваем юридическую чистоту финансовой деятельности компании, минимизируя последствия прошлых ошибок.</p>
            
            <div class="feature-list">
                <div class="feature-item">Защита интересов при налоговых претензиях</div>
                <div class="feature-item">Правовой анализ финансовых сделок</div>
                <div class="feature-item">Оптимизация долговых обязательств</div>
                <div class="feature-item">Разработка систем внутреннего комлпаенса</div>
            </div>
        </div>

        <aside class="editorial-sidebar">
            <div class="simple-card">
                <h4>Срочное восстановление</h4>
                <p>Ваш учет требует немедленного восстановления или исправления критических ошибок?</p>
                <button onclick="openRequestModal('restore')" class="cta-crystal__btn">
                    <span>Начать восстановление</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
                <p class="cta-crystal__secure">🛡️ Восстановление без потери данных</p>
            </div>
        </aside>
    </div>

</main>

<?php get_footer(); ?>
