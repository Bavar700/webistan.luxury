<?php
/**
 * Index Template — Neksoz.Luxury
 * Default loop for displaying posts (news).
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="nk-section">
        <div class="nk-container">

            <div class="text-center mb-5">
                <span class="section-label"><?php esc_html_e( 'Блог', 'neksoz' ); ?></span>
                <h1 class="section-title"><?php esc_html_e( 'Новости и публикации', 'neksoz' ); ?></h1>
                <p class="section-subtitle"><?php esc_html_e( 'Актуальные изменения в законодательстве и новости компании', 'neksoz' ); ?></p>
            </div>

            <?php if ( have_posts() ) : ?>

                <div class="nk-grid nk-grid--3">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/content', 'news-card' );
                    endwhile;
                    ?>
                </div>

                <div class="nk-pagination">
                    <?php
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '&laquo;',
                        'next_text' => '&raquo;',
                    ) );
                    ?>
                </div>

            <?php else : ?>

                <div class="text-center" style="padding: 4rem 0;">
                    <p><?php esc_html_e( 'Публикаций пока нет. Следите за обновлениями!', 'neksoz' ); ?></p>
                </div>

            <?php endif; ?>

        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
