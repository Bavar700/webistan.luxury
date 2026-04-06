<?php
/**
 * Template Name: Услуги
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Page Header -->
    <section class="nk-section--dark" style="padding: 60px 0;">
        <div class="nk-container">
            <span class="section-label" style="color: rgba(255,255,255,0.5);"><?php esc_html_e( 'Что мы предлагаем', 'neksoz' ); ?></span>
            <h1 style="color: #fff;"><?php esc_html_e( 'Наши услуги', 'neksoz' ); ?></h1>
            <p style="color: rgba(255,255,255,0.7); max-width: 600px;">
                <?php esc_html_e( 'Полный спектр консалтинговых услуг для Вашего бизнеса. Каждая услуга адаптируется под индивидуальные потребности клиента.', 'neksoz' ); ?>
            </p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="nk-section">
        <div class="nk-container">

            <?php
            $services = new WP_Query( array(
                'post_type'      => 'neksoz_service',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ) );

            if ( $services->have_posts() ) :
            ?>
                <div class="nk-grid nk-grid--3">
                    <?php
                    $i = 0;
                    while ( $services->have_posts() ) : $services->the_post();
                        set_query_var( 'card_index', $i );
                        get_template_part( 'template-parts/content', 'service-card' );
                        $i++;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php else : ?>
                <!-- Fallback: static services -->
                <div class="nk-grid nk-grid--3">

                    <div class="nk-service-card nk-fade-in">
                        <div class="nk-service-card__icon"><?php echo neksoz_service_icon( 'audit' ); ?></div>
                        <h3 class="nk-service-card__title"><?php esc_html_e( 'Аудит', 'neksoz' ); ?></h3>
                        <p class="nk-service-card__excerpt"><?php esc_html_e( 'Обязательный и инициативный аудит. Проверка финансовой отчётности по национальным и международным стандартам. Заключения, признаваемые банками и инвесторами.', 'neksoz' ); ?></p>
                    </div>

                    <div class="nk-service-card nk-service-card--red nk-fade-in">
                        <div class="nk-service-card__icon"><?php echo neksoz_service_icon( 'tax' ); ?></div>
                        <h3 class="nk-service-card__title"><?php esc_html_e( 'Налогообложение', 'neksoz' ); ?></h3>
                        <p class="nk-service-card__excerpt"><?php esc_html_e( 'Налоговое планирование и оптимизация. Подготовка и сдача налоговой отчётности. Представительство в налоговых органах. Налоговые проверки.', 'neksoz' ); ?></p>
                    </div>

                    <div class="nk-service-card nk-fade-in">
                        <div class="nk-service-card__icon"><?php echo neksoz_service_icon( 'legal' ); ?></div>
                        <h3 class="nk-service-card__title"><?php esc_html_e( 'Юридические услуги', 'neksoz' ); ?></h3>
                        <p class="nk-service-card__excerpt"><?php esc_html_e( 'Регистрация и ликвидация предприятий, лицензирование, договорная работа, арбитраж и судебное представительство.', 'neksoz' ); ?></p>
                    </div>

                    <div class="nk-service-card nk-service-card--red nk-fade-in">
                        <div class="nk-service-card__icon"><?php echo neksoz_service_icon( 'accounting' ); ?></div>
                        <h3 class="nk-service-card__title"><?php esc_html_e( 'Бухгалтерский учёт', 'neksoz' ); ?></h3>
                        <p class="nk-service-card__excerpt"><?php esc_html_e( 'Полное ведение бухгалтерского учёта. Аутсорсинг бухгалтерии. Постановка учёта с нуля. Подготовка финансовой отчётности.', 'neksoz' ); ?></p>
                    </div>

                    <div class="nk-service-card nk-fade-in">
                        <div class="nk-service-card__icon"><?php echo neksoz_service_icon( 'restore' ); ?></div>
                        <h3 class="nk-service-card__title"><?php esc_html_e( 'Восстановление учёта', 'neksoz' ); ?></h3>
                        <p class="nk-service-card__excerpt"><?php esc_html_e( 'Восстановление утраченного или запущенного бухгалтерского учёта. Приведение документации в соответствие с нормативами.', 'neksoz' ); ?></p>
                    </div>

                    <div class="nk-service-card nk-service-card--red nk-fade-in">
                        <div class="nk-service-card__icon"><?php echo neksoz_service_icon( 'consulting' ); ?></div>
                        <h3 class="nk-service-card__title"><?php esc_html_e( 'Бизнес-консалтинг', 'neksoz' ); ?></h3>
                        <p class="nk-service-card__excerpt"><?php esc_html_e( 'Стратегическое планирование, финансовый анализ, оптимизация бизнес-процессов, оценка инвестиционных проектов.', 'neksoz' ); ?></p>
                    </div>

                </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- CTA -->
    <section class="nk-section nk-section--alt" style="text-align: center;">
        <div class="nk-container">
            <div style="max-width: 600px; margin: 0 auto;">
                <h2><?php esc_html_e( 'Не нашли нужную услугу?', 'neksoz' ); ?></h2>
                <p><?php esc_html_e( 'Свяжитесь с нами — мы подберём индивидуальное решение для Вашего бизнеса.', 'neksoz' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="nk-btn nk-btn--primary">
                    <?php esc_html_e( 'Связаться с нами', 'neksoz' ); ?>
                </a>
            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
