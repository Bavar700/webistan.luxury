<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Neksoz_Luxury
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'glass-card' ); ?>>
	<header class="entry-header mb-5 text-center">
		<?php the_title( '<h1 class="entry-title display-4 fw-bold text-primary">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail mb-5 rounded overflow-hidden shadow">
			<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid w-100' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Страницы:', 'neksoz' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer mt-5 pt-3 border-top">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Редактировать <span class="screen-reader-text">%s</span>', 'neksoz' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link text-muted small">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->

	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
