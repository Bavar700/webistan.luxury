<?php
/**
 * Page Template — Neksoz.Luxury
 * Generic page display.
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="nk-section">
        <div class="nk-container">

            <?php
            while ( have_posts() ) :
                the_post();
            ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="text-center mb-5">
                        <h1 class="section-title"><?php the_title(); ?></h1>
                    </div>

                    <div class="nk-content" style="max-width: 800px; margin: 0 auto;">
                        <?php the_content(); ?>
                    </div>

                </article>

            <?php endwhile; ?>

        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
