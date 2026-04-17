<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Neksoz_Luxury
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-5 glass-card' ); ?>>
	<header class="entry-header mb-3">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title text-primary fw-bold">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="text-primary text-decoration-none">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta text-muted small">
				<?php
				printf(
					esc_html__( 'Опубликовано: %s', 'neksoz' ),
					get_the_date()
				);
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail mb-4 rounded overflow-hidden shadow-sm">
			<?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid w-100' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Читать далее<span class="screen-reader-text"> "%s"</span>', 'neksoz' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Страницы:', 'neksoz' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer mt-4 pt-3 border-top text-muted small">
		<?php
		$categories_list = get_the_category_list( esc_html__( ', ', 'neksoz' ) );
		if ( $categories_list ) {
			printf( '<span class="cat-links">' . esc_html__( 'Категория: %s', 'neksoz' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'neksoz' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links ms-3">' . esc_html__( 'Метки: %s', 'neksoz' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
