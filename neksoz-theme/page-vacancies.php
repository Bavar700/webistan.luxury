<?php
/**
 * Template Name: Вакансии
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
                <div class="hero__badge">Карьера в Neksoz</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Станьте частью</span><br>команды
                </h1>
                <p class="hero__desc">
                    Мы ищем профессионалов, готовых расти вместе с нами и создавать лучшие финансовые решения.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="mailto:hr@neksoz.com" class="btn btn--primary">Отправить резюме</a>
            </div>
        </div>
    </section>

    <!-- Vacancies List... -->
    <div class="editorial-content">
        <div class="editorial-main">
            <!-- Accordions remain -->
        </div>
    </div>

</main>

<?php get_footer(); ?>
