<?php
/**
 * Template Name: Library Page
 * Description: A custom template for the digital library and resources.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

// Resources Data
$resources = array(
	array(
		'title' => 'Map of Yaghnob Valley Settlements',
		'author' => yaghnob_tr('author_project'),
		'year' => '2024',
		'type' => 'res_type_map',
		'lang' => 'res_lang_tg_ru',
		'file' => 'map_yaghnob_valley.jpg',
		'desc' => 'Detailed map showing all major Yaghnobi settlements, rivers, and mountain passes.',
		'image' => 'map_yaghnob_valley.jpg',
		'format' => 'JPG',
	),
	array(
		'title' => 'Yaghnobi-English-Tajik Lexicon',
		'author' => 'A.L. Kromov',
		'year' => '1960',
		'type' => 'res_type_book',
		'lang' => 'res_lang_yai',
		'file' => 'yaghnobi_english_tajik_lexicon.pdf',
		'desc' => 'A foundational lexicographic work on the Yaghnobi language.',
		'format' => 'PDF',
	),
	array(
		'title' => 'Yaghnobi: A Contact Language',
		'author' => 'L. NovÃ¡k',
		'year' => '2018',
		'type' => 'res_type_article',
		'lang' => 'library_lang_en',
		'file' => 'yaghnobi_language_contact_novak_2018.pdf',
		'desc' => 'Analysis of Yaghnobi language contact and evolution.',
		'format' => 'PDF',
	),
	array(
		'title' => 'Field Report: Yaghnob Valley Expedition',
		'author' => yaghnob_tr('author_project'),
		'year' => '2023',
		'type' => 'res_type_report',
		'lang' => 'library_lang_en',
		'file' => 'yaghnob_expedition_report_2023.pdf',
		'desc' => 'Findings from the recent linguistic and ethnographic expedition.',
		'format' => 'PDF',
	),
	array(
		'title' => 'Yaghnobi Oral History Collection',
		'author' => yaghnob_tr('author_project'),
		'year' => '2020-2023',
		'type' => 'res_type_audio',
		'lang' => 'res_lang_yai',
		'file' => 'yaghnobi_oral_history_samples.zip',
		'desc' => 'A collection of recorded interviews and storytelling sessions.',
		'format' => 'ZIP',
	),
	array(
		'title' => 'Yaghnobi Grammar',
		'author' => 'A.L. Khromov',
		'year' => '1972',
		'type' => 'res_type_book',
		'lang' => 'res_lang_ru',
		'file' => 'yaghnobi_grammar_khromov_1972.txt',
		'desc' => 'Detailed grammatical description of the Yaghnobi language.',
		'format' => 'TXT',
	),
	array(
		'title' => 'Basic Yaghnobi Phrases',
		'author' => yaghnob_tr('author_project'),
		'year' => '2024',
		'type' => 'res_type_interactive',
		'lang' => 'res_lang_yai',
		'file' => 'yaghnobi_phrases_app.zip',
		'desc' => 'Interactive flashcards for learning basic Yaghnobi phrases.',
		'format' => 'HTML',
	),
);

// Calculate Counts
$counts = array(
	'all' => count($resources),
	'res_type_book' => 0,
	'res_type_article' => 0,
	'res_type_map' => 0,
	'res_type_report' => 0,
	'res_type_audio' => 0,
	'res_type_interactive' => 0,
);

foreach ($resources as &$res) {
	// Calculate real file size
	$file_path = get_template_directory() . '/assets/library/' . $res['file'];
	if (file_exists($file_path)) {
		$bytes = filesize($file_path);
		if ($bytes >= 1048576) {
			$res['size'] = number_format($bytes / 1048576, 1) . ' MB';
		} elseif ($bytes >= 1024) {
			$res['size'] = number_format($bytes / 1024, 1) . ' KB';
		} else {
			$res['size'] = $bytes . ' B';
		}
	} else {
		$res['size'] = 'â€”';
	}

	// Count types
	if (isset($counts[$res['type']])) {
		$counts[$res['type']]++;
	}
}
unset($res);
?>

<main class="flex-grow bg-ivory min-h-screen">
	
	<!-- Hero Section -->
	<div class="relative bg-ivory pt-16 pb-12 sm:pt-24 sm:pb-16">
		<div class="absolute inset-0 bg-ivory/50 backdrop-blur-[1px]"></div>
		<div class="relative z-10 mx-auto max-w-4xl px-6 text-center">
			
			<span class="inline-block py-1 px-3 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-widest uppercase mb-6" data-aos="fade-up">
				<?php echo yaghnob_tr('library_label'); ?>
			</span>

			<h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif font-medium text-gray-900 leading-tight mb-6" data-aos="fade-up" data-aos-delay="100">
				<?php echo yaghnob_tr('library_title'); ?>
			</h1>
			
			<div class="w-24 h-1 bg-[#9A6735] mx-auto mb-8 opacity-60" data-aos="fade-up" data-aos-delay="150"></div>

			<p class="text-lg text-gray-600 mb-0 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
				<?php echo yaghnob_tr('library_desc'); ?>
			</p>

		</div>
	</div>

	<!-- Content Section -->
	<div class="py-12 sm:py-16">
		<div class="mx-auto max-w-7xl px-6 lg:px-8">
			
			<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
				
				<!-- Sidebar Filters -->
				<div class="hidden lg:block lg:col-span-1 space-y-8">
					<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-32">
						<h3 class="text-sm font-bold uppercase tracking-wider text-gray-900 mb-4 border-b border-gray-100 pb-2"><?php echo yaghnob_tr('library_categories_title'); ?></h3>
						
						<nav class="space-y-1">
							<a href="#" class="flex items-center justify-between px-3 py-2 text-sm font-medium text-primary bg-primary/5 rounded-md group transition-colors">
								<span><?php echo yaghnob_tr('library_cat_all'); ?></span>
								<span class="bg-white text-gray-600 py-0.5 px-2 rounded-full text-xs border border-gray-100"><?php echo $counts['all']; ?></span>
							</a>
							<a href="#" class="flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-primary rounded-md group transition-colors">
								<span><?php echo yaghnob_tr('library_cat_books'); ?></span>
								<span class="bg-gray-50 text-gray-500 group-hover:bg-white py-0.5 px-2 rounded-full text-xs border border-gray-100 transition-colors"><?php echo $counts['res_type_book']; ?></span>
							</a>
							<a href="#" class="flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-primary rounded-md group transition-colors">
								<span><?php echo yaghnob_tr('library_cat_papers'); ?></span>
								<span class="bg-gray-50 text-gray-500 group-hover:bg-white py-0.5 px-2 rounded-full text-xs border border-gray-100 transition-colors"><?php echo $counts['res_type_article']; ?></span>
							</a>
							<a href="#" class="flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-primary rounded-md group transition-colors">
								<span><?php echo yaghnob_tr('library_cat_maps'); ?></span>
								<span class="bg-gray-50 text-gray-500 group-hover:bg-white py-0.5 px-2 rounded-full text-xs border border-gray-100 transition-colors"><?php echo $counts['res_type_map']; ?></span>
							</a>
							<a href="#" class="flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-primary rounded-md group transition-colors">
								<span><?php echo yaghnob_tr('library_cat_reports'); ?></span>
								<span class="bg-gray-50 text-gray-500 group-hover:bg-white py-0.5 px-2 rounded-full text-xs border border-gray-100 transition-colors"><?php echo $counts['res_type_report']; ?></span>
							</a>
							<a href="#" class="flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-primary rounded-md group transition-colors">
								<span><?php echo yaghnob_tr('library_cat_audio'); ?></span>
								<span class="bg-gray-50 text-gray-500 group-hover:bg-white py-0.5 px-2 rounded-full text-xs border border-gray-100 transition-colors"><?php echo $counts['res_type_audio']; ?></span>
							</a>
							<a href="#" class="flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-primary rounded-md group transition-colors">
								<span><?php echo yaghnob_tr('library_cat_interactive'); ?></span>
								<span class="bg-gray-50 text-gray-500 group-hover:bg-white py-0.5 px-2 rounded-full text-xs border border-gray-100 transition-colors"><?php echo $counts['res_type_interactive']; ?></span>
							</a>
						</nav>

						<div class="mt-8">
							<h3 class="text-sm font-bold uppercase tracking-wider text-gray-900 mb-4 border-b border-gray-100 pb-2"><?php echo yaghnob_tr('library_lang_title'); ?></h3>
							<div class="space-y-2">
								<label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer hover:text-primary transition-colors">
									<input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary/50">
									<span><?php echo yaghnob_tr('library_lang_en'); ?></span>
								</label>
								<label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer hover:text-primary transition-colors">
									<input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary/50">
									<span><?php echo yaghnob_tr('library_lang_ru'); ?></span>
								</label>
								<label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer hover:text-primary transition-colors">
									<input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary/50">
									<span><?php echo yaghnob_tr('library_lang_tg'); ?></span>
								</label>
								<label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer hover:text-primary transition-colors">
									<input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary/50">
									<span><?php echo yaghnob_tr('library_lang_de'); ?></span>
								</label>
							</div>
						</div>

					</div>
				</div>

				<!-- Resources Grid -->
				<div class="lg:col-span-3">
					
					<!-- Search & Sort -->
					<div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
						<div class="relative w-full sm:max-w-xs">
							<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
								<svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
								</svg>
							</div>
							<input type="search" class="block w-full pl-10 pr-3 py-2 bg-white border border-gray-200 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-primary/50 focus:border-primary/50 shadow-sm" placeholder="<?php echo yaghnob_tr('library_search_placeholder'); ?>">
						</div>
						
						<div class="flex items-center gap-2 w-full sm:w-auto">
							<span class="text-xs font-medium text-gray-500 whitespace-nowrap"><?php echo yaghnob_tr('library_sort_by'); ?></span>
							<select class="block w-full pl-3 pr-8 py-2 text-sm bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary/50 focus:border-primary/50 shadow-sm">
								<option><?php echo yaghnob_tr('library_sort_newest'); ?></option>
								<option><?php echo yaghnob_tr('library_sort_oldest'); ?></option>
								<option><?php echo yaghnob_tr('library_sort_title'); ?></option>
								<option><?php echo yaghnob_tr('library_sort_popularity'); ?></option>
							</select>
						</div>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
						<?php
						foreach ( $resources as $resource ) :
							?>
							<article class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group flex flex-col" data-aos="fade-up">
								<div class="h-48 bg-gray-100 relative overflow-hidden flex items-center justify-center">
									<!-- Placeholder Cover -->
									<?php 
									$file_local_path = get_template_directory() . '/assets/library/' . $resource['file'];
									// Check if file exists and is a valid image
									if ( strpos($resource['type'], 'map') !== false && file_exists($file_local_path) && @getimagesize($file_local_path) ) : 
									?>
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/library/' . $resource['file'] ); ?>" class="w-full h-full object-cover" alt="<?php echo esc_attr( $resource['title'] ); ?>">
									<?php else : ?>
										<div class="text-gray-300">
											<svg class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
											</svg>
										</div>
									<?php endif; ?>
									
									<div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded text-xs font-bold uppercase tracking-wide text-gray-600 shadow-sm">
										<?php echo yaghnob_tr( $resource['type'] ); ?>
									</div>
								</div>
								
								<div class="p-6 flex flex-col flex-grow">
									<div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
										<span><?php echo esc_html( $resource['year'] ); ?></span>
										<span>&bull;</span>
										<span><?php echo yaghnob_tr( $resource['lang'] ); ?></span>
									</div>
									
									<h3 class="text-xl font-serif font-bold text-gray-900 mb-2 group-hover:text-primary transition-colors line-clamp-2">
										<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/library/' . $resource['file'] ); ?>" download><?php echo esc_html( $resource['title'] ); ?></a>
									</h3>
									
									<p class="text-sm text-gray-600 mb-4 flex-grow">
										<?php echo yaghnob_tr('res_by_author'); ?> <?php echo esc_html( $resource['author'] ); ?>
									</p>
									
									<div class="flex items-center justify-between pt-4 border-t border-gray-50 mt-auto">
										<div class="flex items-center gap-2">
											<span class="px-2 py-1 rounded bg-gray-100 text-xs font-bold text-gray-600">
												<?php echo esc_html( $resource['format'] ); ?>
											</span>
											<span class="text-xs text-gray-400">
												<?php echo esc_html( $resource['size'] ); ?>
											</span>
										</div>
										
										<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/library/' . $resource['file'] ); ?>" download class="text-sm font-bold text-primary hover:text-primary/80 transition-colors flex items-center gap-1">
											<?php echo yaghnob_tr('library_download'); ?>
											<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
											</svg>
										</a>
									</div>
								</div>
							</article>
							<?php
						endforeach;
						?>
					</div>

					<!-- Pagination -->
					<div class="mt-12 flex justify-center" id="load-more-container" style="display: none;">
						<button id="load-more-btn" class="bg-white border border-gray-200 text-gray-600 px-6 py-2 rounded-full text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm">
							<?php echo yaghnob_tr('library_load_more'); ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const items = document.querySelectorAll('article[data-aos="fade-up"]');
	const loadMoreBtn = document.getElementById('load-more-btn');
	const loadMoreContainer = document.getElementById('load-more-container');
	const itemsPerPage = 4;
	let visibleItems = itemsPerPage;

	// Initial state
	if (items.length > itemsPerPage) {
		loadMoreContainer.style.display = 'flex';
		items.forEach((item, index) => {
			if (index >= itemsPerPage) {
				item.style.display = 'none';
			}
		});
	}

	// Click handler
	loadMoreBtn.addEventListener('click', function() {
		const nextItems = visibleItems + itemsPerPage;
		
		items.forEach((item, index) => {
			if (index < nextItems) {
				item.style.display = 'flex'; // Restore flex display
			}
		});

		visibleItems = nextItems;

		if (visibleItems >= items.length) {
			loadMoreContainer.style.display = 'none';
		}
	});
});
</script>

<?php
get_footer();
