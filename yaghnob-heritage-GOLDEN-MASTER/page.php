<?php
/**
 * The template for displaying all single pages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
?>

<main class="flex-grow bg-white">
	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<!-- Title Section -->
		<div class="relative bg-ivory/95 border-b border-gray-100 py-16 sm:py-24">
			<div class="absolute inset-0 bg-ivory/95 backdrop-blur-[1px]"></div>
			<div class="relative z-10 mx-auto max-w-3xl px-6 text-center">
				
				<!-- Meta -->
				<div class="flex flex-wrap justify-center gap-4 text-xs font-bold uppercase tracking-widest text-gray-500 mb-6" data-aos="fade-up">
					<span class="text-primary hover:text-gray-900 transition-colors">
						<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
					</span>
				</div>

				<!-- Title -->
				<h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-medium text-gray-900 leading-tight" data-aos="fade-up" data-aos-delay="100">
					<?php the_title(); ?>
				</h1>

				<div class="w-24 h-1 bg-[#9A6735] mx-auto mb-8 opacity-60" data-aos="fade-up" data-aos-delay="150"></div>

			</div>
		</div>

		<!-- Content Section -->
		<div class="py-16 sm:py-24">
			<div class="mx-auto max-w-4xl px-6">
				
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="mb-12 rounded-2xl overflow-hidden shadow-sm aspect-[21/9] w-full" data-aos="fade-up" data-aos-delay="200">
						<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover' ) ); ?>
					</div>
				<?php endif; ?>

				<article class="prose lg:prose-lg prose-headings:font-serif prose-headings:font-medium prose-p:font-light prose-a:text-primary hover:prose-a:text-gray-900 transition-colors mx-auto text-gray-600">
					<?php the_content(); ?>
				</article>

			</div>
		</div>

		<?php
	endwhile;
	?>
</main>

<?php
get_footer();
