<?php
/**
 * Single Template — Neksoz.Luxury
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

<?php while ( have_posts() ) : the_post(); ?>

<!-- ═══════════ PAGE HERO ═══════════ -->
<section class="hero" style="min-height: 45vh; display: flex; align-items: center;">
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    <div class="container hero__inner" style="position: relative; z-index: 2;">
        <div class="hero__content" style="max-width: 900px;">
            <div class="hero__badge fade-up is-visible">
                <?php echo get_post_type() === 'post' ? 'Новость' : 'Услуга'; ?>
            </div>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1" style="font-size: clamp(2.5rem, 5vw, 4rem);">
                <span class="text-gradient"><?php the_title(); ?></span>
            </h1>
            <?php if ( get_post_type() === 'post' ) : ?>
                <div class="fade-up is-visible fade-up-delay-2" style="color: rgba(255,255,255,0.6); font-weight: 500; font-size: 0.9rem; margin-top: 10px;">
                    <?php echo get_the_date('d F Y'); ?> • <?php the_author(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ═══════════ CONTENT ═══════════ -->
<section class="section section--gray">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 300px; gap: 60px; align-items: start;">
            
            <article class="service-card fade-up is-visible" style="padding: 50px;">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div style="margin-bottom: 30px; border-radius: 12px; overflow: hidden;">
                        <?php the_post_thumbnail('large', ['style' => 'width: 100%; height: auto; display: block;']); ?>
                    </div>
                <?php endif; ?>

                <div class="post-content" style="line-height: 1.8; color: var(--nk-gray-600); font-size: 1.05rem;">
                    <?php the_content(); ?>
                </div>

                <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid var(--nk-gray-100); display: flex; justify-content: space-between; align-items: center;">
                    <a href="<?php echo home_url('/news'); ?>" class="btn btn--outline-light" style="color: var(--nk-blue); border-color: var(--nk-blue);">← Назад к новостям</a>
                    <div style="display: flex; gap: 10px;">
                        <?php
                        $prev = get_previous_post();
                        $next = get_next_post();
                        if ($prev) echo '<a href="'.get_permalink($prev).'" class="btn btn--ghost" style="padding: 10px 15px;" title="Предыдущая">←</a>';
                        if ($next) echo '<a href="'.get_permalink($next).'" class="btn btn--ghost" style="padding: 10px 15px;" title="Следующая">→</a>';
                        ?>
                    </div>
                </div>
            </article>

            <aside style="position: sticky; top: 120px;">
                <div class="service-card" style="padding: 30px;">
                    <h4 style="font-size: 1.1rem; font-weight: 800; color: var(--nk-gray-900); margin-bottom: 20px; border-left: 3px solid var(--nk-red); padding-left: 15px;">Популярно</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 15px;">
                        <?php
                        $recent = new WP_Query(['posts_per_page' => 5, 'post__not_in' => [get_the_ID()]]);
                        while ($recent->have_posts()) : $recent->the_post();
                        ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" style="display: block; font-size: 0.9rem; font-weight: 600; color: var(--nk-gray-700); text-decoration: none; line-height: 1.4; transition: color 0.3s;" onmouseover="this.style.color='var(--nk-blue)'" onmouseout="this.style.color='var(--nk-gray-700)'"><?php the_title(); ?></a>
                            <span style="font-size: 0.75rem; color: var(--nk-gray-400);"><?php echo get_the_date('d.m.Y'); ?></span>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>

                <div class="service-card service-card--alt" style="padding: 30px; margin-top: 30px; text-align: center;">
                    <h4 style="font-size: 1.1rem; font-weight: 800; color: white; margin-bottom: 15px;">Нужна помощь?</h4>
                    <p style="font-size: 0.85rem; color: rgba(255,255,255,0.7); margin-bottom: 20px;">Наши эксперты проконсультируют вас по любому вопросу.</p>
                    <a href="<?php echo home_url('/contacts'); ?>" class="btn btn--primary" style="width: 100%; justify-content: center; padding: 12px 20px;">Связаться →</a>
                </div>
            </aside>

        </div>
    </div>
</section>

<?php endwhile; ?>

</main>

<?php get_footer(); ?>
