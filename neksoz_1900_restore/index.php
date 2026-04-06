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
    <section class="section">
        <div class="nk-container">
            <header class="section__header" style="text-align: center; margin-bottom: 80px;">
                <span class="section-label"><?php esc_html_e( 'Бизнес-аналитика', 'neksoz' ); ?></span>
                <h1 class="section-title" style="margin: 0 auto 24px;"><?php esc_html_e( 'Пресс-центр', 'neksoz' ); ?></h1>
                <p class="section-desc" style="margin: 0 auto;"><?php esc_html_e( 'Актуальные изменения в законодательстве, обзоры рынков и новости консалтинговой группы.', 'neksoz' ); ?></p>
            </header>

            <?php if ( have_posts() ) : ?>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 32px;">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/content', 'news-card' );
                    endwhile;
                    ?>
                </div>

                <div style="margin-top: 80px; text-align: center;">
                    <?php
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '←',
                        'next_text' => '→',
                    ) );
                    ?>
                </div>
            <?php else : ?>
                <div style="text-align: center; color: var(--text-secondary);">
                    <p><?php esc_html_e( 'Здесь скоро появятся важные публикации.', 'neksoz' ); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main><!-- #primary -->

<?php get_footer(); ?>
