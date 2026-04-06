<?php
/**
 * The template for displaying search results pages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
?>

<main class="flex-grow bg-white">
	
	<!-- Title Section -->
	<div class="relative bg-ivory/95 border-b border-gray-100 py-16 sm:py-24">
		<div class="absolute inset-0 bg-ivory/95 backdrop-blur-[1px]"></div>
		<div class="relative z-10 mx-auto max-w-7xl px-6 text-center">
			
			<!-- Meta -->
			<div class="flex flex-wrap justify-center gap-4 text-xs font-bold uppercase tracking-widest text-gray-500 mb-6" data-aos="fade-up">
				<span class="text-primary hover:text-gray-900 transition-colors">
					<?php echo tr('search_results'); ?>
				</span>
			</div>

			<!-- Title -->
			<h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-medium text-gray-900 leading-tight" data-aos="fade-up" data-aos-delay="100">
				<?php printf( tr('search_results_for'), '<span>' . get_search_query() . '</span>' ); ?>
			</h1>

		</div>
	</div>

	<!-- Content Section -->
	<div class="py-16 sm:py-24">
		<div class="mx-auto max-w-7xl px-6 lg:px-8">
			
			<?php if ( have_posts() ) : ?>
				<div class="mx-auto grid max-w-2xl grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article data-aos="fade-up" <?php post_class( 'flex flex-col items-start justify-start bg-ivory rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 h-auto border border-gray-50' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="w-full h-48 overflow-hidden">
									<?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transform hover:scale-105 transition-transform duration-500' ) ); ?>
								</div>
							<?php endif; ?>
							
							<div class="p-6 flex flex-col flex-auto">
								<div class="flex items-center gap-x-4 text-xs mb-4">
									<time datetime="<?php echo get_the_date( 'c' ); ?>" class="text-gray-500"><?php echo yaghnob_get_localized_date(); ?></time>
									<?php
									$categories = get_the_category();
									if ( ! empty( $categories ) ) :
										$cat_key = 'cat_' . strtolower( $categories[0]->slug );
										$cat_name = tr( $cat_key );
										if ( $cat_name === $cat_key ) {
											$cat_name = $categories[0]->name;
										}
										?>
										<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="relative z-10 rounded-full bg-white px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-50 border border-gray-100">
											<?php echo esc_html( $cat_name ); ?>
										</a>
									<?php endif; ?>
								</div>

								<h3 class="text-lg font-serif font-bold leading-6 text-gray-900 group-hover:text-primary transition-colors mb-2">
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h3>
								
								<div class="mt-2 line-clamp-3 text-sm leading-6 text-gray-600 flex-auto">
									<?php the_excerpt(); ?>
								</div>
							</div>
						</article>
						<?php
					endwhile;
					?>
				</div>

				<!-- Pagination -->
				<div class="mt-16 flex justify-center">
					<?php
					the_posts_pagination(
						array(
							'mid_size'  => 2,
							'prev_text' => tr('pagination_previous'),
							'next_text' => tr('pagination_next'),
							'class'     => 'flex gap-2',
						)
					);
					?>
				</div>

			<?php else : ?>

				<div class="text-center py-24">
					<h2 class="text-2xl font-serif font-medium text-gray-900 mb-4"><?php echo tr('no_results_found'); ?></h2>
					<p class="text-gray-600 mb-8"><?php echo tr('no_results_text'); ?></p>
					<?php get_search_form(); ?>
				</div>

			<?php endif; ?>

		</div>
	</div>

</main>

<?php
get_footer();
