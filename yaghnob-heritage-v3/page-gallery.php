<?php
/**
 * Template Name: Gallery Page
 * Description: A custom template for the visual archive gallery.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
?>

<main class="flex-grow bg-ivory min-h-screen">
	
	<!-- Hero Section -->
	<div class="relative bg-ivory pt-16 pb-12 sm:pt-24 sm:pb-16">
		<div class="absolute inset-0 bg-ivory/50 backdrop-blur-[1px]"></div>
		<div class="relative z-10 mx-auto max-w-4xl px-6 text-center">
			
			<span class="inline-block py-1 px-3 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-widest uppercase mb-6" data-aos="fade-up">
				<?php echo tr('gallery_visual_archive'); ?>
			</span>

			<h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif font-medium text-gray-900 leading-tight mb-6" data-aos="fade-up" data-aos-delay="100">
				<?php echo tr('gallery_page_title'); ?>
			</h1>
			
			<div class="w-24 h-1 bg-[#9A6735] mx-auto mb-8 opacity-60" data-aos="fade-up" data-aos-delay="150"></div>

			<p class="text-lg text-gray-600 mb-0 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
				<?php echo tr('gallery_page_desc'); ?>
			</p>

		</div>
	</div>

	<!-- Gallery Grid -->
	<div class="py-12 sm:py-16">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			
			<!-- Filters -->
			<div class="flex flex-wrap justify-center gap-2 mb-12" data-aos="fade-up">
				<button class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-primary text-white shadow-md transition-transform transform hover:scale-105" data-filter="all"><?php echo tr('gallery_filter_all'); ?></button>
				<button class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 hover:text-primary transition-colors" data-filter="Landscape"><?php echo tr('gallery_filter_landscape'); ?></button>
				<button class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 hover:text-primary transition-colors" data-filter="People"><?php echo tr('gallery_filter_people'); ?></button>
				<button class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 hover:text-primary transition-colors" data-filter="Culture"><?php echo tr('gallery_filter_culture'); ?></button>
				<button class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 hover:text-primary transition-colors" data-filter="Architecture"><?php echo tr('gallery_filter_architecture'); ?></button>
				<button class="filter-btn px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 hover:text-primary transition-colors" data-filter="Daily Life"><?php echo tr('gallery_filter_dailylife'); ?></button>
			</div>

			<div id="gallery-grid" class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
				<?php
				// Category Translations Map
				$cat_translations = array(
					'Landscape' => tr('gallery_filter_landscape'),
					'People' => tr('gallery_filter_people'),
					'Culture' => tr('gallery_filter_culture'),
					'Architecture' => tr('gallery_filter_architecture'),
					'Daily Life' => tr('gallery_filter_dailylife'),
				);

				// Gallery Images
				$images = array(
					array( 
						'file' => 'gallery-valley-landscape.jpg', 
						'title' => tr('gallery_img_valley_view'), 
						'cat' => 'Landscape',
						'desc' => tr('gallery_desc_valley_view')
					),
					array( 
						'file' => 'gallery-traditional-dastarkhon.jpg', 
						'title' => tr('gallery_img_dastarkhon'), 
						'cat' => 'Culture',
						'desc' => tr('gallery_desc_dastarkhon')
					),
					array( 
						'file' => 'gallery-women-traditional-dress.jpg', 
						'title' => tr('gallery_img_women_dress'), 
						'cat' => 'People',
						'desc' => tr('gallery_desc_women_dress')
					),
					array( 
						'file' => 'gallery-girls-mountains.jpg', 
						'title' => tr('gallery_img_children'), 
						'cat' => 'People',
						'desc' => tr('gallery_desc_children')
					),
					array( 
						'file' => 'gallery-boy-on-donkey.jpg', 
						'title' => tr('gallery_img_boy_donkey'), 
						'cat' => 'Daily Life',
						'desc' => tr('gallery_desc_boy_donkey')
					),
					array( 
						'file' => 'gallery-pasture-cows.jpg', 
						'title' => tr('gallery_img_pasture'), 
						'cat' => 'Landscape',
						'desc' => tr('gallery_desc_pasture')
					),
					array( 
						'file' => 'gallery-indoor-gathering.jpg', 
						'title' => tr('gallery_img_gathering'), 
						'cat' => 'People',
						'desc' => tr('gallery_desc_gathering')
					),
					array( 
						'file' => 'gallery-traditional-dance.jpg', 
						'title' => tr('gallery_img_dance'), 
						'cat' => 'Culture',
						'desc' => tr('gallery_desc_dance')
					),
					array( 
						'file' => 'gallery-festive-meal.jpg', 
						'title' => tr('gallery_img_meal'), 
						'cat' => 'Culture',
						'desc' => tr('gallery_desc_meal')
					),
					array( 
						'file' => 'gallery-celebration.jpg', 
						'title' => tr('gallery_img_celebration'), 
						'cat' => 'People',
						'desc' => tr('gallery_desc_celebration')
					),
					array( 
						'file' => 'gallery-people-walking.jpg', 
						'title' => tr('gallery_img_walking'), 
						'cat' => 'Daily Life',
						'desc' => tr('gallery_desc_walking')
					),
					array( 
						'file' => 'gallery-house-haystack.jpg', 
						'title' => tr('gallery_img_architecture'), 
						'cat' => 'Architecture',
						'desc' => tr('gallery_desc_architecture')
					),
					array( 
						'file' => 'gallery-mountain-house.jpg', 
						'title' => tr('gallery_img_dwelling'), 
						'cat' => 'Architecture',
						'desc' => tr('gallery_desc_dwelling')
					),
					array( 
						'file' => 'gallery-village-terraces.jpg', 
						'title' => tr('gallery_img_terraces'), 
						'cat' => 'Landscape',
						'desc' => tr('gallery_desc_terraces')
					),
					array( 
						'file' => 'gallery-spring-water.jpg', 
						'title' => tr('gallery_img_spring'), 
						'cat' => 'Landscape',
						'desc' => tr('gallery_desc_spring')
					),
					array( 
						'file' => 'gallery-sacred-spring.jpg', 
						'title' => tr('gallery_img_sacred'), 
						'cat' => 'Landscape',
						'desc' => tr('gallery_desc_sacred')
					),
					array( 
						'file' => 'gallery-mountain-livestock.jpg', 
						'title' => tr('gallery_img_livestock'), 
						'cat' => 'Daily Life',
						'desc' => tr('gallery_desc_livestock')
					),
					array( 
						'file' => 'gallery-ancient-ruins.jpg', 
						'title' => tr('gallery_img_ruins'), 
						'cat' => 'Architecture',
						'desc' => tr('gallery_desc_ruins')
					),
					array( 
						'file' => 'gallery-water-mill.jpg', 
						'title' => tr('gallery_img_mill'), 
						'cat' => 'Culture',
						'desc' => tr('gallery_desc_mill')
					),
				);

				foreach ( $images as $img ) :
					// Use hero-bg.jpg as a temporary fallback for landscapes if specific image is missing
					$fallback = ( strpos($img['cat'], 'Landscape') !== false ) ? 'hero-bg.jpg' : '';
					$image_url = yaghnob_get_image_url( $img['file'], $img['title'], $fallback );
					?>
					<a href="<?php echo esc_url( $image_url ); ?>" 
					   class="glightbox gallery-item block relative group rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 break-inside-avoid bg-gray-200 mb-6" 
					   data-category="<?php echo esc_attr($img['cat']); ?>" 
					   data-aos="fade-up"
					   data-gallery="gallery1"
					   data-title="<?php echo esc_attr( $img['title'] ); ?>"
					   data-description="<?php echo esc_attr( $img['desc'] ); ?>">
						<!-- Image -->
						<img src="<?php echo esc_url( $image_url ); ?>" 
							 alt="<?php echo esc_attr( $img['title'] ); ?>" 
							 class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700"
							 loading="lazy">
						
						<!-- Overlay -->
						<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
							<span class="text-xs font-bold text-[#FDFBF7] uppercase tracking-wider mb-1"><?php echo $cat_translations[$img['cat']] ?? $img['cat']; ?></span>
							<h3 class="text-white font-serif font-bold text-lg leading-tight mb-1"><?php echo $img['title']; ?></h3>
							<p class="text-gray-300 text-xs font-light line-clamp-2"><?php echo $img['desc']; ?></p>
						</div>
					</a>
				<?php endforeach; ?>
			</div>

			<!-- Pagination / Load More -->
			<div class="mt-16 flex justify-center">
				<button id="load-more-btn" class="bg-white border border-gray-200 text-gray-600 px-8 py-3 rounded-full text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm uppercase tracking-wide">
					<?php echo tr('view_more'); ?>
				</button>
			</div>

		</div>
	</div>

</main>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
	// Initialize GLightbox
	const lightbox = GLightbox({
		touchNavigation: true,
		loop: true,
		autoplayVideos: true,
		selector: '.glightbox'
	});
	const filterBtns = document.querySelectorAll('.filter-btn');
	const galleryItems = document.querySelectorAll('.gallery-item');
	const loadMoreBtn = document.getElementById('load-more-btn');
	let itemsShown = 9;
	const totalItems = galleryItems.length;

	// Initial State: Hide items beyond limit
	function updateVisibility() {
		// If a filter is active (not 'all'), show all matching items and hide button
		const activeBtn = document.querySelector('.filter-btn.bg-primary');
		const currentFilter = activeBtn ? activeBtn.getAttribute('data-filter') : 'all';

		if (currentFilter !== 'all') {
			galleryItems.forEach(item => {
				if (item.getAttribute('data-category') === currentFilter) {
					item.classList.remove('hidden');
					item.style.display = 'block'; // Ensure display block for columns
				} else {
					item.classList.add('hidden');
					item.style.display = 'none';
				}
			});
			if(loadMoreBtn) loadMoreBtn.style.display = 'none';
		} else {
			// 'all' filter active - respect pagination
			let count = 0;
			galleryItems.forEach((item, index) => {
				item.classList.remove('hidden');
				if (index < itemsShown) {
					item.style.display = 'block';
				} else {
					item.style.display = 'none';
				}
			});
			
			if (itemsShown >= totalItems && loadMoreBtn) {
				loadMoreBtn.style.display = 'none';
			} else if (loadMoreBtn) {
				loadMoreBtn.style.display = 'block';
			}
		}
		
		// Refresh AOS animations
		if (typeof AOS !== 'undefined') {
			setTimeout(() => AOS.refresh(), 100);
		}
	}

	// Initialize
	updateVisibility();

	// Filter Click Handler
	filterBtns.forEach(btn => {
		btn.addEventListener('click', function() {
			// Update button styles
			filterBtns.forEach(b => {
				b.classList.remove('bg-primary', 'text-white', 'shadow-md', 'transform', 'hover:scale-105');
				b.classList.add('bg-white', 'text-gray-600', 'border', 'border-gray-200', 'hover:bg-gray-50', 'hover:text-primary');
			});
			this.classList.remove('bg-white', 'text-gray-600', 'border', 'border-gray-200', 'hover:bg-gray-50', 'hover:text-primary');
			this.classList.add('bg-primary', 'text-white', 'shadow-md', 'transform', 'hover:scale-105');

			updateVisibility();
		});
	});

	// Load More Click Handler
	if (loadMoreBtn) {
		loadMoreBtn.addEventListener('click', function() {
			itemsShown += 6; // Show 6 more
			updateVisibility();
		});
	}
});
</script>

<?php
get_footer();
