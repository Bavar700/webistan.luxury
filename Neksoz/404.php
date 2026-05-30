<?php get_header(); global $current_lang;  ?>

<main class="site-main">
    <section class="hero hero--internal" style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        
        <div class="container" style="position:relative; z-index:10; text-align:center;">
            <div class="fade-up">
                <span class="section__label" style="margin: 0 auto 20px;">Error 404</span>
                <h1 class="hero__title" style="font-size: 5rem; margin-bottom: 20px;">
                    <span class="text-gradient">Страница</span> не найдена
                </h1>
                <p class="hero__desc" style="max-width: 600px; margin: 0 auto 40px; font-size: 1.2rem;">
                    Возможно, она была удалена или вы ошиблись адресом. <br>
                    Но мы всегда готовы помочь вам найти нужный путь.
                </p>
                <div class="hero__actions" style="justify-content: center;">
                    <?php $current_lang = function_exists('nk_get_current_lang') ? nk_get_current_lang() : 'ru'; ?>
                    <a href="<?php echo nk_link('/', $current_lang); ?>" class="btn btn--primary">
                        <?php 
                        if($current_lang === 'tj') echo 'Ба асосӣ';
                        elseif($current_lang === 'en') echo 'Back Home';
                        else echo 'На главную';
                        ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
