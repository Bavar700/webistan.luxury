<?php
/**
 * Single Post / Service Template â€” Neksoz.Luxury
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php while ( have_posts() ) : the_post(); ?>

    <!-- Hero Banner -->
    <section class="nk-section--dark" style="padding: 60px 0;">
        <div class="nk-container">
            <div style="max-width: 100% !important;">
                <?php if ( 'neksoz_service' === get_post_type() ) : ?>
                    <span class="section-label" style="color: rgba(255,255,255,0.5);"><?php esc_html_e( 'Ð£ÑÐ»ÑƒÐ³Ð¸', 'neksoz' ); ?></span>
                <?php else : ?>
                    <span class="section-label" style="color: rgba(255,255,255,0.5);"><?php esc_html_e( 'ÐÐ¾Ð²Ð¾ÑÑ‚Ð¸', 'neksoz' ); ?></span>
                <?php endif; ?>

                <h1 style="color: #fff; margin-bottom: 1rem;"><?php the_title(); ?></h1>

                <?php if ( 'post' === get_post_type() ) : ?>
                    <div style="display: flex; align-items: center; gap: 1rem; color: rgba(255,255,255,0.6); font-size: 0.85rem;">
                        <time datetime="<?php echo get_the_date( 'c' ); ?>">
                            <?php echo get_the_date(); ?>
                        </time>
                        <span>&bull;</span>
                        <span><?php the_author(); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="nk-section">
        <div class="nk-container">
            <div style="display: grid; grid-template-columns: 1fr 320px; gap: 4rem; align-items: start;">

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div style="margin-bottom: 2rem; border-radius: var(--nk-card-radius); overflow: hidden;">
                            <?php the_post_thumbnail( 'neksoz-featured', array( 'style' => 'width:100%; height:auto; display:block;' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="nk-content">
                        <?php the_content(); ?>
                    </div>

                    <?php if ( 'post' === get_post_type() ) : ?>
                        <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--nk-border);">
                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                <?php
                                $tags = get_the_tags();
                                if ( $tags ) :
                                    foreach ( $tags as $tag ) :
                                ?>
                                    <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
                                       style="display: inline-block; padding: 0.3rem 0.8rem; background: var(--nk-bg-alt); border-radius: 6px; font-size: 0.8rem; font-weight: 500; color: var(--nk-text-secondary);">
                                        #<?php echo esc_html( $tag->name ); ?>
                                    </a>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Post Navigation -->
                    <div style="margin-top: 3rem; display: flex; justify-content: space-between; gap: 2rem;">
                        <div>
                            <?php
                            $prev = get_previous_post();
                            if ( $prev ) :
                            ?>
                                <span style="display: block; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-text-muted); margin-bottom: 0.25rem;">
                                    <?php esc_html_e( 'â† ÐŸÑ€ÐµÐ´Ñ‹Ð´ÑƒÑ‰Ð°Ñ', 'neksoz' ); ?>
                                </span>
                                <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" style="font-weight: 600; color: var(--nk-primary);">
                                    <?php echo esc_html( $prev->post_title ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div style="text-align: right;">
                            <?php
                            $next = get_next_post();
                            if ( $next ) :
                            ?>
                                <span style="display: block; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-text-muted); margin-bottom: 0.25rem;">
                                    <?php esc_html_e( 'Ð¡Ð»ÐµÐ´ÑƒÑŽÑ‰Ð°Ñ â†’', 'neksoz' ); ?>
                                </span>
                                <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" style="font-weight: 600; color: var(--nk-primary);">
                                    <?php echo esc_html( $next->post_title ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                </article>

                <!-- Sidebar -->
                <aside class="nk-sidebar" style="position: sticky; top: 100px;">
                    <?php if ( 'neksoz_service' === get_post_type() ) : ?>
                        <!-- Other Services -->
                        <div style="background: var(--nk-bg-alt); padding: 1.5rem; border-radius: var(--nk-card-radius);">
                            <h4 style="font-size: 1rem; margin-bottom: 1rem;"><?php esc_html_e( 'Ð”Ñ€ÑƒÐ³Ð¸Ðµ ÑƒÑÐ»ÑƒÐ³Ð¸', 'neksoz' ); ?></h4>
                            <?php
                            $related = new WP_Query( array(
                                'post_type'      => 'neksoz_service',
                                'posts_per_page' => 5,
                                'post__not_in'   => array( get_the_ID() ),
                            ) );

                            if ( $related->have_posts() ) :
                                echo '<ul style="list-style: none; padding: 0;">';
                                while ( $related->have_posts() ) : $related->the_post();
                                    echo '<li style="margin-bottom: 0.6rem;"><a href="' . esc_url( get_permalink() ) . '" style="font-size: 0.9rem; font-weight: 500; color: var(--nk-text-secondary);">' . esc_html( get_the_title() ) . '</a></li>';
                                endwhile;
                                echo '</ul>';
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    <?php else : ?>
                        <?php get_sidebar(); ?>
                    <?php endif; ?>

                    <!-- CTA -->
                    <div style="margin-top: 2rem; padding: 2rem; background: var(--nk-primary-dark); border-radius: var(--nk-card-radius); text-align: center;">
                        <h4 style="color: #fff; font-size: 1rem; margin-bottom: 0.75rem;"><?php esc_html_e( 'ÐÑƒÐ¶Ð½Ð° ÐºÐ¾Ð½ÑÑƒÐ»ÑŒÑ‚Ð°Ñ†Ð¸Ñ?', 'neksoz' ); ?></h4>
                        <p style="color: rgba(255,255,255,0.65); font-size: 0.85rem; margin-bottom: 1.25rem;"><?php esc_html_e( 'ÐÐ°ÑˆÐ¸ ÑÐºÑÐ¿ÐµÑ€Ñ‚Ñ‹ Ð³Ð¾Ñ‚Ð¾Ð²Ñ‹ Ð¿Ð¾Ð¼Ð¾Ñ‡ÑŒ Ð’Ð°Ð¼.', 'neksoz' ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="nk-btn nk-btn--gradient" style="width: 100%; justify-content: center;">
                            <?php esc_html_e( 'Ð¡Ð²ÑÐ·Ð°Ñ‚ÑŒÑÑ', 'neksoz' ); ?>
                        </a>
                    </div>
                </aside>

            </div>
        </div>
    </section>

    <?php endwhile; ?>

</main><!-- #primary -->

<?php get_footer(); ?>
