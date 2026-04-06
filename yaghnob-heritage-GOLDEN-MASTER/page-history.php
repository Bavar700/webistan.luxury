<?php
/**
 * Template Name: History Page
 * Description: A custom template for the History section with a detailed timeline.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
?>

<main class="flex-grow bg-[#FDFBF7] min-h-screen">
	
	<!-- Hero Section -->
	<div class="relative pt-24 pb-20 sm:pt-32 sm:pb-24 overflow-hidden">
		<!-- Background decorative elements -->
		<div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 opacity-30 pointer-events-none">
			<div class="absolute top-20 left-10 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
			<div class="absolute bottom-10 right-10 w-80 h-80 bg-orange-100/20 rounded-full blur-3xl"></div>
		</div>

		<div class="relative z-10 mx-auto max-w-4xl px-6 text-center">
			<span class="inline-block py-1.5 px-4 rounded-full bg-[#9A6735]/10 text-[#9A6735] text-xs font-bold tracking-[0.2em] uppercase mb-8" data-aos="fade-up">
				<?php echo yaghnob_tr('history_chronicle_label'); ?>
			</span>

			<h1 class="text-5xl sm:text-6xl lg:text-7xl font-serif font-medium text-gray-900 leading-none mb-8" data-aos="fade-up" data-aos-delay="100">
				<?php echo yaghnob_tr('history_page_title'); ?>
			</h1>
			
			<div class="w-24 h-1 bg-[#9A6735] mx-auto mb-8 opacity-60" data-aos="fade-up" data-aos-delay="150"></div>

			<p class="text-xl text-gray-600 font-light leading-relaxed max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
				<?php echo yaghnob_tr('history_intro_text'); ?>
			</p>
		</div>
	</div>

	<!-- Introduction Text -->
	<div class="max-w-3xl mx-auto px-6 mb-24 text-center">
		<p class="text-lg text-gray-700 leading-loose font-serif italic border-l-4 border-[#9A6735] pl-6 py-2 text-left bg-white/50 rounded-r-lg shadow-sm">
			<?php echo yaghnob_tr('history_quote'); ?>
		</p>
	</div>

	<!-- Timeline Section -->
	<div class="relative max-w-5xl mx-auto px-6 pb-32">
		<!-- Vertical Line -->
		<div class="absolute left-6 md:left-1/2 top-0 bottom-0 w-px bg-gray-200 transform md:-translate-x-1/2"></div>

		<!-- Era 1: Ancient Sogdiana -->
		<div class="relative z-10 mb-20 md:mb-32 group" data-aos="fade-up">
			<div class="flex flex-col md:flex-row items-center">
				<div class="flex-1 w-full md:w-1/2 md:pr-12 md:text-right mb-8 md:mb-0">
					<span class="text-[#D4AF37] font-bold tracking-widest text-sm uppercase mb-2 block"><?php echo yaghnob_tr('history_era1_date'); ?></span>
					<h2 class="text-3xl font-serif text-gray-900 mb-4"><?php echo yaghnob_tr('history_era1_title'); ?></h2>
					<p class="text-gray-600 leading-relaxed">
						<?php echo yaghnob_tr('history_era1_desc'); ?>
					</p>
				</div>
				<div class="relative flex-shrink-0 w-12 h-12 bg-white border-4 border-[#D4AF37] rounded-full z-10 flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
					<div class="w-3 h-3 bg-[#D4AF37] rounded-full"></div>
				</div>
				<div class="flex-1 w-full md:w-1/2 md:pl-12">
					<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
						<p class="text-sm text-gray-500 italic mb-2"><?php echo yaghnob_tr('history_highlights'); ?>:</p>
						<ul class="space-y-2 text-gray-700 text-sm">
							<li class="flex items-start gap-2"><span class="text-[#D4AF37] mt-1">â€¢</span> <?php echo yaghnob_tr('history_era1_pt1'); ?></li>
							<li class="flex items-start gap-2"><span class="text-[#D4AF37] mt-1">â€¢</span> <?php echo yaghnob_tr('history_era1_pt2'); ?></li>
							<li class="flex items-start gap-2"><span class="text-[#D4AF37] mt-1">â€¢</span> <?php echo yaghnob_tr('history_era1_pt3'); ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Era 2: The Arab Conquest -->
		<div class="relative z-10 mb-20 md:mb-32 group" data-aos="fade-up">
			<div class="flex flex-col md:flex-row-reverse items-center">
				<div class="flex-1 w-full md:w-1/2 md:pl-12 md:text-left mb-8 md:mb-0">
					<span class="text-[#9A6735] font-bold tracking-widest text-sm uppercase mb-2 block"><?php echo yaghnob_tr('history_era2_date'); ?></span>
					<h2 class="text-3xl font-serif text-gray-900 mb-4"><?php echo yaghnob_tr('history_era2_title'); ?></h2>
					<p class="text-gray-600 leading-relaxed">
						<?php echo yaghnob_tr('history_era2_desc'); ?>
					</p>
				</div>
				<div class="relative flex-shrink-0 w-12 h-12 bg-white border-4 border-[#9A6735] rounded-full z-10 flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
					<div class="w-3 h-3 bg-[#9A6735] rounded-full"></div>
				</div>
				<div class="flex-1 w-full md:w-1/2 md:pr-12 md:text-right">
					<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
						<p class="text-sm text-gray-500 italic mb-2"><?php echo yaghnob_tr('history_turning_point'); ?>:</p>
						<p class="text-gray-700 text-sm">
							<?php echo yaghnob_tr('history_era2_point'); ?>
						</p>
					</div>
				</div>
			</div>
		</div>

		<!-- Era 3: Centuries of Isolation -->
		<div class="relative z-10 mb-20 md:mb-32 group" data-aos="fade-up">
			<div class="flex flex-col md:flex-row items-center">
				<div class="flex-1 w-full md:w-1/2 md:pr-12 md:text-right mb-8 md:mb-0">
					<span class="text-[#9A6735] font-bold tracking-widest text-sm uppercase mb-2 block"><?php echo yaghnob_tr('history_era3_date'); ?></span>
					<h2 class="text-3xl font-serif text-gray-900 mb-4"><?php echo yaghnob_tr('history_era3_title'); ?></h2>
					<p class="text-gray-600 leading-relaxed">
						<?php echo yaghnob_tr('history_era3_desc'); ?>
					</p>
				</div>
				<div class="relative flex-shrink-0 w-12 h-12 bg-white border-4 border-[#9A6735] rounded-full z-10 flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
					<div class="w-3 h-3 bg-[#9A6735] rounded-full"></div>
				</div>
				<div class="flex-1 w-full md:w-1/2 md:pl-12">
					<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
						<blockquote class="text-gray-600 italic border-l-2 border-gray-300 pl-4 text-sm">
							"<?php echo yaghnob_tr('history_era3_quote'); ?>"
						</blockquote>
					</div>
				</div>
			</div>
		</div>

		<!-- Era 4: The Soviet Tragedy -->
		<div class="relative z-10 mb-20 md:mb-32 group" data-aos="fade-up">
			<div class="flex flex-col md:flex-row-reverse items-center">
				<div class="flex-1 w-full md:w-1/2 md:pl-12 md:text-left mb-8 md:mb-0">
					<span class="text-red-700 font-bold tracking-widest text-sm uppercase mb-2 block"><?php echo yaghnob_tr('history_era4_date'); ?></span>
					<h2 class="text-3xl font-serif text-gray-900 mb-4"><?php echo yaghnob_tr('history_era4_title'); ?></h2>
					<p class="text-gray-600 leading-relaxed">
						<?php echo yaghnob_tr('history_era4_desc'); ?>
					</p>
				</div>
				<div class="relative flex-shrink-0 w-12 h-12 bg-white border-4 border-red-700 rounded-full z-10 flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
					<div class="w-3 h-3 bg-red-700 rounded-full"></div>
				</div>
				<div class="flex-1 w-full md:w-1/2 md:pr-12 md:text-right">
					<div class="bg-red-50 p-6 rounded-lg border border-red-100 hover:shadow-md transition-shadow">
						<p class="text-sm text-red-800 font-bold mb-2"><?php echo yaghnob_tr('history_impact'); ?>:</p>
						<p class="text-gray-700 text-sm">
							<?php echo yaghnob_tr('history_era4_impact'); ?>
						</p>
					</div>
				</div>
			</div>
		</div>

		<!-- Era 5: The Return & Present -->
		<div class="relative z-10 group" data-aos="fade-up">
			<div class="flex flex-col md:flex-row items-center">
				<div class="flex-1 w-full md:w-1/2 md:pr-12 md:text-right mb-8 md:mb-0">
					<span class="text-[#15803d] font-bold tracking-widest text-sm uppercase mb-2 block"><?php echo yaghnob_tr('history_era5_date'); ?></span>
					<h2 class="text-3xl font-serif text-gray-900 mb-4"><?php echo yaghnob_tr('history_era5_title'); ?></h2>
					<p class="text-gray-600 leading-relaxed">
						<?php echo yaghnob_tr('history_era5_desc'); ?>
					</p>
				</div>
				<div class="relative flex-shrink-0 w-12 h-12 bg-white border-4 border-[#15803d] rounded-full z-10 flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
					<div class="w-3 h-3 bg-[#15803d] rounded-full"></div>
				</div>
				<div class="flex-1 w-full md:w-1/2 md:pl-12">
					<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
						<p class="text-sm text-gray-500 italic mb-2"><?php echo yaghnob_tr('history_current_status'); ?>:</p>
						<p class="text-gray-700 text-sm">
							<?php echo yaghnob_tr('history_era5_status'); ?>
						</p>
					</div>
				</div>
			</div>
		</div>

	</div>
	
	<!-- Footer Call to Action (Redesigned) -->
	<!-- LOCKED: This block design is finalized. DO NOT MODIFY WITHOUT EXPLICIT USER PERMISSION. -->
	<div class="pt-72 pb-24 relative overflow-hidden -mt-72">
		<!-- Background Elements -->
		<!-- Extended gradient for seamless blending with previous #FDFBF7 section -->
		<div class="absolute inset-0 bg-gradient-to-b from-[#FDFBF7] via-[#FDFBF7]/90 to-[#FDFCFB]"></div>
		
		<!-- Real Mountain Background (More visible & Atmospheric) -->
		<div class="absolute inset-0 bg-[url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/gallery-valley-landscape.jpg' ); ?>')] bg-cover bg-fixed bg-center bg-no-repeat opacity-[0.15] grayscale pointer-events-none mix-blend-multiply"></div>
		
		<!-- Blurred Top Gradient Mask for completely invisible transition -->
		<div class="absolute top-0 inset-x-0 h-96 bg-gradient-to-b from-[#FDFBF7] via-[#FDFBF7] to-transparent pointer-events-none backdrop-blur-sm"></div>
		
		<!-- Bottom Fade -->
		<div class="absolute bottom-0 inset-x-0 h-32 bg-gradient-to-t from-[#FDFCFB] to-transparent pointer-events-none"></div>


		<div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 pt-24">
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
				<!-- Text Content -->
				<div data-aos="fade-right">
					<span class="inline-block py-1 px-3 rounded-full bg-[#9A6735]/10 text-[#9A6735] text-[10px] font-bold tracking-[0.2em] uppercase mb-6">
						<?php echo yaghnob_tr('explore_archive'); ?>
					</span>
					
					<h3 class="text-4xl md:text-5xl font-serif text-[#2F2F2F] mb-6 leading-tight">
						<?php echo yaghnob_tr('history_cta_title'); ?>
					</h3>
					
					<p class="text-gray-600 mb-10 font-light text-lg leading-relaxed max-w-xl">
						<?php echo yaghnob_tr('history_cta_desc'); ?>
					</p>
					
					<a href="<?php echo esc_url( home_url( '/ethnography/' ) ); ?>" class="group inline-flex items-center gap-3 px-8 py-4 bg-[#9A6735] text-white rounded-full hover:bg-[#8B5D30] transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
						<span class="uppercase text-xs tracking-widest font-bold"><?php echo yaghnob_tr('history_cta_btn'); ?></span>
						<i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
					</a>
				</div>

				<!-- Visual Collage -->
				<div class="relative hidden md:block" data-aos="fade-left">
					<div class="grid grid-cols-2 gap-6">
						<div class="space-y-6 transform translate-y-12">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/gallery-traditional-dance.jpg' ); ?>" 
								 class="w-full h-64 object-cover rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-500" alt="Traditional Dance">
							<div class="p-6 bg-white rounded-2xl shadow-lg border border-gray-50">
								<p class="font-serif text-lg text-[#2F2F2F] italic">"<?php echo yaghnob_tr('history_era3_quote'); ?>"</p>
							</div>
						</div>
						<div class="space-y-6">
							 <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/gallery-village-terraces.jpg' ); ?>" 
								 class="w-full h-80 object-cover rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-500" alt="Mountain Village">
							 <a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="block w-full h-40 bg-[#2c3e50] rounded-2xl p-6 flex items-center justify-center relative overflow-hidden group cursor-pointer hover:shadow-lg transition-all">
								 <div class="absolute inset-0 bg-[url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/sogdian-manuscript-2.jpg' ); ?>')] bg-cover opacity-30 group-hover:opacity-40 transition-opacity duration-500 grayscale sepia-[0.3]"></div>
								 <span class="relative z-10 text-white font-serif text-xl"><?php echo yaghnob_tr('view_gallery'); ?></span>
							 </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</main>

<?php
get_footer();
