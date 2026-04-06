<?php
/**
 * Archive Template — Neksoz.Luxury
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Archive Header -->
    <section class="nk-section--dark" style="padding: 60px 0;">
        <div class="nk-container">
            <span class="section-label" style="color: rgba(255,255,255,0.5);"><?php esc_html_e( 'Архив', 'neksoz' ); ?></span>
            <h1 style="color: #fff;"><?php the_archive_title(); ?></h1>
            <?php the_archive_description( '<p style="color: rgba(255,255,255,0.7); max-width: 600px;">', '</p>' ); ?>
        </div>
    </section>

    <!-- Archive Content -->
    <section class="nk-section">
        <div class="nk-container">

            <?php if ( have_posts() ) : ?>

                <div class="nk-grid nk-grid--3">
                    <?php
                    while ( have_posts() ) :
                        the_post();

                        if ( 'neksoz_service' === get_post_type() ) :
                            get_template_part( 'template-parts/content', 'service-card' );
                        else :
                            get_template_part( 'template-parts/content', 'news-card' );
                        endif;
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
                    <p><?php esc_html_e( 'Записей не найдено.', 'neksoz' ); ?></p>
                </div>

            <?php endif; ?>

        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
