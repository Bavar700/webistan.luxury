<?php
/**
 * Template Name: Новости
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="nk-page-header uk-flex uk-flex-middle" style="min-height: 40vh; background: var(--nk-primary-dark); position: relative; overflow: hidden; padding: 60px 0;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.05; background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="nk-container uk-position-relative uk-position-z-index">
            <h1 class="fade-up is-visible" style="color: #fff; font-size: 3.5rem; margin-bottom: 1rem;"><?php esc_html_e('Новости', 'neksoz'); ?></h1>
            <p class="fade-up is-visible fade-up-delay-1" style="color: rgba(255,255,255,0.7); font-size: 1.2rem; max-width: 600px;">
                Актуальные события, экспертные статьи и новости компании
            </p>
        </div>
    </section>

    <section class="nk-section" style="padding-bottom: 6rem;">
        <div class="nk-container">
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem;">
                
                <?php
                // Query the latest news posts
                $news_query = new WP_Query( array(
                    'post_type'      => 'post',
                    'posts_per_page' => 9,
                    'post_status'    => 'publish',
                ) );

                if ( $news_query->have_posts() ) :
                    $delay = 1;
                    while ( $news_query->have_posts() ) : $news_query->the_post();
                        ?>
                        <article class="nk-service-card fade-up is-visible fade-up-delay-<?php echo esc_attr($delay); ?>" style="background: var(--nk-bg-alt); border-radius: 12px; border: 1px solid var(--nk-border); overflow: hidden; display: flex; flex-direction: column;">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" style="display: block; width: 100%; height: 200px; overflow: hidden;">
                                    <?php the_post_thumbnail( 'medium_large', array( 'style' => 'width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;' ) ); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 200px; background: rgba(59, 130, 246, 0.05); color: var(--nk-accent);">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                </a>
                            <?php endif; ?>
                            
                            <div style="padding: 2rem; flex-grow: 1; display: flex; flex-direction: column;">
                                <div style="font-size: 0.9rem; color: var(--nk-primary); font-weight: 500; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <?php echo get_the_date('d.m.Y'); ?>
                                </div>
                                <h2 style="font-size: 1.25rem; margin-bottom: 1rem; line-height: 1.4;">
                                    <a href="<?php the_permalink(); ?>" style="color: var(--nk-text); text-decoration: none;"><?php the_title(); ?></a>
                                </h2>
                                <p style="color: var(--nk-text-secondary); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1;">
                                    <?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
                                </p>
                                <a href="<?php the_permalink(); ?>" style="color: var(--nk-primary); font-weight: 500; display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
                                    Читать далее <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </article>
                        <?php
                        $delay = ($delay % 3) + 1; // 1, 2, 3 loop
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 0;">
                        <p style="color: var(--nk-text-secondary); font-size: 1.1rem;"><?php esc_html_e('Новостей пока нет. Следите за обновлениями!', 'neksoz'); ?></p>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
