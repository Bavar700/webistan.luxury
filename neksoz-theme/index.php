<?php
/**
 * Index Template â€” Neksoz.Luxury
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
                <span class="section-label"><?php esc_html_e( 'Ð‘Ð¸Ð·Ð½ÐµÑ-Ð°Ð½Ð°Ð»Ð¸Ñ‚Ð¸ÐºÐ°', 'neksoz' ); ?></span>
                <h1 class="section-title" style="margin: 0 auto 24px;"><?php esc_html_e( 'ÐŸÑ€ÐµÑÑ-Ñ†ÐµÐ½Ñ‚Ñ€', 'neksoz' ); ?></h1>
                <p class="section-desc" style="margin: 0 auto;"><?php esc_html_e( 'ÐÐºÑ‚ÑƒÐ°Ð»ÑŒÐ½Ñ‹Ðµ Ð¸Ð·Ð¼ÐµÐ½ÐµÐ½Ð¸Ñ Ð² Ð·Ð°ÐºÐ¾Ð½Ð¾Ð´Ð°Ñ‚ÐµÐ»ÑŒÑÑ‚Ð²Ðµ, Ð¾Ð±Ð·Ð¾Ñ€Ñ‹ Ñ€Ñ‹Ð½ÐºÐ¾Ð² Ð¸ Ð½Ð¾Ð²Ð¾ÑÑ‚Ð¸ ÐºÐ¾Ð½ÑÐ°Ð»Ñ‚Ð¸Ð½Ð³Ð¾Ð²Ð¾Ð¹ Ð³Ñ€ÑƒÐ¿Ð¿Ñ‹.', 'neksoz' ); ?></p>
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
                        'prev_text' => 'â†',
                        'next_text' => 'â†’',
                    ) );
                    ?>
                </div>
            <?php else : ?>
                <div style="text-align: center; color: var(--text-secondary);">
                    <p><?php esc_html_e( 'Ð—Ð´ÐµÑÑŒ ÑÐºÐ¾Ñ€Ð¾ Ð¿Ð¾ÑÐ²ÑÑ‚ÑÑ Ð²Ð°Ð¶Ð½Ñ‹Ðµ Ð¿ÑƒÐ±Ð»Ð¸ÐºÐ°Ñ†Ð¸Ð¸.', 'neksoz' ); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main><!-- #primary -->

<?php get_footer(); ?>
