<?php
/**
 * Template Part: News Card
 *
 * @package Neksoz
 */
?>

<article class="bento-card" style="padding: 32px;">
    <div style="font-size: 13px; font-weight: 600; color: var(--accent-blue); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 12px;">
        <?php echo get_the_date(); ?>
    </div>
    
    <h3 class="bento-card__title" style="font-size: 1.25rem; margin-bottom: 16px;">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h3>

    <div class="bento-card__desc" style="font-size: 0.95rem; margin-bottom: 24px; opacity: 0.8;">
        <?php echo esc_html( wp_trim_words( get_the_excerpt(), 20, '...' ) ); ?>
    </div>

    <a href="<?php the_permalink(); ?>" class="bento-card__link">
        <?php esc_html_e( 'Читать далее', 'Neksoz' ); ?> 
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
</article>
