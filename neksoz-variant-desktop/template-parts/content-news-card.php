<?php
/**
 * Template Part: News Card
 *
 * @package Neksoz
 */
?>

<article class="nk-news-card nk-fade-in">

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="nk-news-card__image-wrapper">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'neksoz-card', array( 'class' => 'nk-news-card__image' ) ); ?>
            </a>
        </div>
    <?php else : ?>
        <div class="nk-news-card__image-wrapper">
            <a href="<?php the_permalink(); ?>" style="display: block; height: 220px; background: var(--nk-gradient-blue); opacity: 0.12;"></a>
        </div>
    <?php endif; ?>

    <div class="nk-news-card__body">
        <time class="nk-news-card__date" datetime="<?php echo get_the_date( 'c' ); ?>">
            <?php echo get_the_date(); ?>
        </time>

        <h3 class="nk-news-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <?php if ( has_excerpt() || get_the_content() ) : ?>
            <p class="nk-news-card__excerpt">
                <?php echo esc_html( wp_trim_words( get_the_excerpt(), 18, '...' ) ); ?>
            </p>
        <?php endif; ?>
    </div>

</article>
