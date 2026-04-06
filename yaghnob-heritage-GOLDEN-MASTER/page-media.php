<?php
/**
 * Template Name: Media Page
 * Description: A custom template for the Media section.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
?>

<main class="flex-grow bg-ivory min-h-screen">
	
	<!-- Hero Section -->
	<div class="relative bg-ivory border-b border-gray-100 pt-16 pb-12 sm:pt-24 sm:pb-16">
		<div class="absolute inset-0 bg-ivory/50 backdrop-blur-[1px]"></div>
		<div class="relative z-10 mx-auto max-w-4xl px-6 text-center">
			
			<span class="inline-block py-1 px-3 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-widest uppercase mb-6" data-aos="fade-up">
				<?php echo yaghnob_tr('media_archive'); ?>
			</span>

			<h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif font-medium text-gray-900 leading-tight mb-6" data-aos="fade-up" data-aos-delay="100">
				<?php echo yaghnob_tr('media_title'); ?>
			</h1>
			
			<div class="w-24 h-1 bg-[#9A6735] mx-auto mb-8 opacity-60" data-aos="fade-up" data-aos-delay="150"></div>

			<p class="text-lg text-gray-600 mb-0 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
				<?php echo yaghnob_tr('media_desc'); ?>
			</p>

		</div>
	</div>

	<!-- Content Section -->
	<div class="py-16 sm:py-24">
		<div class="mx-auto max-w-4xl px-6">
			
			<div class="prose prose-lg prose-headings:font-serif prose-headings:font-medium prose-p:font-light prose-a:text-primary hover:prose-a:text-gray-900 transition-colors mx-auto text-gray-600">
				<p><?php echo yaghnob_tr('media_intro'); ?></p>
				
				<h3><?php echo yaghnob_tr('media_docs_title'); ?></h3>
				<p><?php echo yaghnob_tr('media_docs_content'); ?></p>

				<h3><?php echo yaghnob_tr('media_oral_title'); ?></h3>
				<p><?php echo yaghnob_tr('media_oral_content'); ?></p>

				<h3><?php echo yaghnob_tr('media_music_title'); ?></h3>
				<p><?php echo yaghnob_tr('media_music_content'); ?></p>

				<h3><?php echo yaghnob_tr('media_lang_title'); ?></h3>
				<p><?php echo yaghnob_tr('media_lang_content'); ?></p>
			</div>

		</div>
	</div>

</main>

<?php
get_footer();

