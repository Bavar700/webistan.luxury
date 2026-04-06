<?php
/**
 * The template for displaying 404 pages (not found)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
?>

<main class="flex-grow bg-ivory flex flex-col items-center justify-center min-h-[60vh] relative overflow-hidden">
	<!-- Background Pattern/Texture (Optional) -->
	<div class="absolute inset-0 bg-ivory opacity-90"></div>
	
	<div class="relative z-10 text-center px-6 py-24">
		
		<!-- 404 Icon/Graphic could go here -->
		<div class="mb-8 text-primary/20" data-aos="fade-up">
			<svg class="w-32 h-32 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
			</svg>
		</div>

		<h1 class="text-6xl sm:text-8xl font-serif font-medium text-gray-900 mb-4" data-aos="fade-up" data-aos-delay="100">
			404
		</h1>
		
		<p class="text-xl text-gray-600 font-light mb-8 max-w-md mx-auto" data-aos="fade-up" data-aos-delay="200">
			<?php echo tr('page_not_found_text'); ?>
		</p>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block rounded-full bg-primary px-8 py-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-900 transition-colors duration-300" data-aos="fade-up" data-aos-delay="300">
			<?php echo tr('return_home'); ?>
		</a>

	</div>

</main>

<?php
get_footer();
