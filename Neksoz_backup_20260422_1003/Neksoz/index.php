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

<!-- ═══════════ PAGE HERO ═══════════ -->
<section class="hero" style="min-height: 40vh; display: flex; align-items: center;">
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    <div class="container hero__inner" style="position: relative; z-index: 2;">
        <div class="hero__content">
            <div class="hero__badge fade-up is-visible">Блог</div>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1" style="font-size: clamp(2.5rem, 5vw, 4rem);">
                <span class="text-gradient">Архив новостей</span>
            </h1>
        </div>
    </div>
</section>

<!-- ═══════════ CONTENT ═══════════ -->
<section class="section section--gray">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="services-grid" style="grid-template-columns: repeat(3, 1fr);">
                <?php
                $delay = 0;
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article class="service-card fade-up is-visible <?php echo ($delay % 2 == 1) ? 'service-card--alt' : ''; ?>">
                        <div style="font-size: 0.7rem; font-weight: 800; color: var(--nk-blue); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 12px;">
                            <?php echo get_the_date('d F Y'); ?>
                        </div>
                        <h3 class="service-card__title" style="font-size: 1.25rem;">
                            <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <p class="service-card__text">
                            <?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
                        </p>
                        <a href="<?php the_permalink(); ?>" class="service-card__link">Читать далее →</a>
                    </article>
                    <?php
                    $delay++;
                endwhile;
                ?>
            </div>

            <div style="margin-top: 60px; display: flex; justify-content: center;">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '←',
                    'next_text' => '→',
                ) );
                ?>
            </div>
        <?php else : ?>
            <div style="text-align: center; padding: 100px 0;">
                <p style="color: var(--nk-gray-400);">К сожалению, материалов не найдено.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

</main>

<?php get_footer(); ?>
