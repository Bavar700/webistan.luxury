<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<!doctype html>
<html <?php language_attributes(); ?> class="h-full antialiased bg-white text-gray-900">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- Favicon -->
	<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon.svg' ); ?>" type="image/svg+xml" media="(prefers-color-scheme: light)">
	<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon-dark.svg' ); ?>" type="image/svg+xml" media="(prefers-color-scheme: dark)">
	<link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon.svg' ); ?>">
	<!-- Google Fonts: Inter & Spectral (with Cyrillic support) -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Spectral:ital,wght@0,300;0,400;0,500;0,600;1,400&subset=latin,cyrillic&display=swap" rel="stylesheet">
	<!-- AOS Animation CSS -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<!-- Lucide Icons -->
	<script src="https://unpkg.com/lucide@latest"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'flex flex-col min-h-full font-sans text-gray-600' ); ?>>
<?php wp_body_open(); ?>

<header class="sticky top-0 z-50 w-full transition-all duration-500 bg-white border-b border-gray-900/5">
	<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
		<div class="flex h-16 items-center justify-between">
			<!-- Logo -->
			<div class="flex-shrink-0">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 group">
						<!-- Three Peaks & Sun Logo -->
						<div class="relative w-12 h-12 flex items-center justify-center text-gray-900 group-hover:text-primary transition-colors duration-500">
							<svg class="w-full h-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
								<!-- The Three Peaks -->
								<path d="M2 18L7 11L11 16" stroke-width="1.6" />
								<path d="M11 16L15 6L19 16" stroke-width="1.6" />
								<path d="M19 16L22 11L26 18" stroke-width="1.6" />
								
								<!-- The Sun (Between Middle and Right Peak) -->
								<g class="text-primary" stroke="currentColor">
									<circle cx="20" cy="7" r="1.5" fill="currentColor" stroke="none" />
								</g>
							</svg>
						</div>
						<span class="font-display text-[22px] font-semibold tracking-wide text-gray-900 group-hover:text-primary transition-colors duration-300">
							<?php echo esc_html( yaghnob_tr('site_title') ); ?>
						</span>
					</a>
				<?php endif; ?>
			</div>
			
			<!-- Navigation -->
			<nav class="hidden md:flex h-full gap-1">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'menu_class'     => 'flex gap-1 h-full',
							'fallback_cb'    => false,
							'items_wrap'     => '%3$s',
						)
					);
				} else {
					// Hardcoded Yaghnob Heritage Menu Structure
					?>
					<div class="h-full flex items-center">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="px-3 py-2 text-xs font-bold uppercase tracking-wide text-gray-600 rounded-full hover:bg-[#FDFBF7] hover:text-primary transition-all duration-300"><?php echo yaghnob_tr('home'); ?></a>
					</div>
					
					<!-- CULTURE Dropdown -->
					<div class="relative group h-full flex items-center">
						<button class="flex items-center gap-1 px-3 py-2 text-xs font-bold uppercase tracking-wide text-gray-600 rounded-full hover:bg-[#FDFBF7] hover:text-primary transition-all duration-300 focus:outline-none group-hover:bg-[#FDFBF7] group-hover:text-primary">
							<?php echo yaghnob_tr('culture'); ?> <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-300 group-hover:rotate-180 opacity-50 group-hover:opacity-100"></i>
						</button>
						<div class="absolute left-1/2 -translate-x-1/2 top-full w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-out transform group-hover:translate-y-0 translate-y-2">
							<div class="bg-white border-t-0 border border-gray-100 shadow-lg overflow-hidden ring-1 ring-black/5">
								<a href="<?php echo esc_url( home_url( '/history/' ) ); ?>" class="group/item relative flex flex-col gap-0 px-5 py-2.5 hover:bg-[#FDFBF7] transition-all duration-200 border-b border-gray-50 last:border-0">
									<div class="flex items-center justify-between">
										<span class="font-bold text-xs uppercase tracking-wide text-gray-800 group-hover/item:text-primary transition-colors"><?php echo yaghnob_tr('history'); ?></span>
									</div>
									<span class="text-[10px] text-gray-500 group-hover/item:text-gray-600 transition-colors"><?php echo yaghnob_tr('history_desc'); ?></span>
								</a>
								<a href="<?php echo esc_url( home_url( '/ethnography/' ) ); ?>" class="group/item relative flex flex-col gap-0 px-5 py-2.5 hover:bg-[#FDFBF7] transition-all duration-200 border-b border-gray-50 last:border-0">
									<div class="flex items-center justify-between">
										<span class="font-bold text-xs uppercase tracking-wide text-gray-800 group-hover/item:text-primary transition-colors"><?php echo yaghnob_tr('ethnography'); ?></span>
									</div>
									<span class="text-[10px] text-gray-500 group-hover/item:text-gray-600 transition-colors"><?php echo yaghnob_tr('ethnography_desc'); ?></span>
								</a>
								<a href="<?php echo esc_url( home_url( '/folklore/' ) ); ?>" class="group/item relative flex flex-col gap-0 px-5 py-2.5 hover:bg-[#FDFBF7] transition-all duration-200 border-b border-gray-50 last:border-0">
									<div class="flex items-center justify-between">
										<span class="font-bold text-xs uppercase tracking-wide text-gray-800 group-hover/item:text-primary transition-colors"><?php echo yaghnob_tr('folklore'); ?></span>
									</div>
									<span class="text-[10px] text-gray-500 group-hover/item:text-gray-600 transition-colors"><?php echo yaghnob_tr('folklore_desc'); ?></span>
								</a>
							</div>
						</div>
					</div>



					<!-- LANGUAGE Dropdown -->
					<div class="relative group h-full flex items-center">
						<button class="flex items-center gap-1 px-3 py-2 text-xs font-bold uppercase tracking-wide text-gray-600 rounded-full hover:bg-[#FDFBF7] hover:text-primary transition-all duration-300 focus:outline-none group-hover:bg-[#FDFBF7] group-hover:text-primary">
							<?php echo yaghnob_tr('language'); ?> <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-300 group-hover:rotate-180 opacity-50 group-hover:opacity-100"></i>
						</button>
						<div class="absolute left-1/2 -translate-x-1/2 top-full w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-out transform group-hover:translate-y-0 translate-y-2">
							<div class="bg-white border-t-0 border border-gray-100 shadow-lg overflow-hidden ring-1 ring-black/5">
								<a href="<?php echo esc_url( home_url( '/grammar/' ) ); ?>" class="group/item relative flex flex-col gap-0 px-5 py-2.5 hover:bg-[#FDFBF7] transition-all duration-200 border-b border-gray-50 last:border-0">
									<div class="flex items-center justify-between">
										<span class="font-bold text-xs uppercase tracking-wide text-gray-800 group-hover/item:text-primary transition-colors"><?php echo yaghnob_tr('grammar'); ?></span>
									</div>
									<span class="text-[10px] text-gray-500 group-hover/item:text-gray-600 transition-colors"><?php echo yaghnob_tr('phonology_morphology'); ?></span>
								</a>
								<a href="<?php echo esc_url( home_url( '/corpus/' ) ); ?>" class="group/item relative flex flex-col gap-0 px-5 py-2.5 hover:bg-[#FDFBF7] transition-all duration-200 border-b border-gray-50 last:border-0">
									<div class="flex items-center justify-between">
										<span class="font-bold text-xs uppercase tracking-wide text-gray-800 group-hover/item:text-primary transition-colors"><?php echo yaghnob_tr('corpus'); ?></span>
									</div>
									<span class="text-[10px] text-gray-500 group-hover/item:text-gray-600 transition-colors"><?php echo yaghnob_tr('texts_transcriptions'); ?></span>
								</a>
								<a href="<?php echo esc_url( home_url( '/dialectology/' ) ); ?>" class="group/item relative flex flex-col gap-0 px-5 py-2.5 hover:bg-[#FDFBF7] transition-all duration-200 border-b border-gray-50 last:border-0">
									<div class="flex items-center justify-between">
										<span class="font-bold text-xs uppercase tracking-wide text-gray-800 group-hover/item:text-primary transition-colors"><?php echo yaghnob_tr('dialectology'); ?></span>
									</div>
									<span class="text-[10px] text-gray-500 group-hover/item:text-gray-600 transition-colors"><?php echo yaghnob_tr('regional_variations'); ?></span>
								</a>
							</div>
						</div>
					</div>

					<!-- RESOURCES Dropdown -->
					<div class="relative group h-full flex items-center">
						<button class="flex items-center gap-1 px-3 py-2 text-xs font-bold uppercase tracking-wide text-gray-600 rounded-full hover:bg-[#FDFBF7] hover:text-primary transition-all duration-300 focus:outline-none group-hover:bg-[#FDFBF7] group-hover:text-primary">
							<?php echo yaghnob_tr('resources'); ?> <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-300 group-hover:rotate-180 opacity-50 group-hover:opacity-100"></i>
						</button>
						<div class="absolute left-1/2 -translate-x-1/2 top-full w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-out transform group-hover:translate-y-0 translate-y-2">
							<div class="bg-white border-t-0 border border-gray-100 shadow-lg overflow-hidden ring-1 ring-black/5">
								<a href="<?php echo esc_url( home_url( '/library/' ) ); ?>" class="group/item relative flex flex-col gap-0 px-5 py-2.5 hover:bg-[#FDFBF7] transition-all duration-200 border-b border-gray-50 last:border-0">
									<div class="flex items-center justify-between">
										<span class="font-bold text-xs uppercase tracking-wide text-gray-800 group-hover/item:text-primary transition-colors"><?php echo yaghnob_tr('library'); ?></span>
									</div>
									<span class="text-[10px] text-gray-500 group-hover/item:text-gray-600 transition-colors"><?php echo yaghnob_tr('digital_pdfs'); ?></span>
								</a>
								<a href="<?php echo esc_url( home_url( '/reports/' ) ); ?>" class="group/item relative flex flex-col gap-0 px-5 py-2.5 hover:bg-[#FDFBF7] transition-all duration-200 border-b border-gray-50 last:border-0">
									<div class="flex items-center justify-between">
										<span class="font-bold text-xs uppercase tracking-wide text-gray-800 group-hover/item:text-primary transition-colors"><?php echo yaghnob_tr('reports'); ?></span>
									</div>
									<span class="text-[10px] text-gray-500 group-hover/item:text-gray-600 transition-colors"><?php echo yaghnob_tr('field_work_findings'); ?></span>
								</a>
							</div>
						</div>
					</div>

					<!-- ARCHIVE Dropdown -->
					<div class="relative group h-full flex items-center">
						<button class="flex items-center gap-1 px-3 py-2 text-xs font-bold uppercase tracking-wide text-gray-600 rounded-full hover:bg-[#FDFBF7] hover:text-primary transition-all duration-300 focus:outline-none group-hover:bg-[#FDFBF7] group-hover:text-primary">
							<?php echo yaghnob_tr('archive'); ?> <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-300 group-hover:rotate-180 opacity-50 group-hover:opacity-100"></i>
						</button>
						<div class="absolute right-0 top-full w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-out transform group-hover:translate-y-0 translate-y-2">
							<div class="bg-white border-t-0 border border-gray-100 shadow-lg overflow-hidden ring-1 ring-black/5">
								<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="group/item relative flex flex-col gap-0 px-5 py-2.5 hover:bg-[#FDFBF7] transition-all duration-200 border-b border-gray-50 last:border-0">
									<div class="flex items-center justify-between">
										<span class="font-bold text-xs uppercase tracking-wide text-gray-800 group-hover/item:text-primary transition-colors"><?php echo yaghnob_tr('gallery'); ?></span>
									</div>
									<span class="text-[10px] text-gray-500 group-hover/item:text-gray-600 transition-colors"><?php echo yaghnob_tr('photos_images'); ?></span>
								</a>
								<a href="<?php echo esc_url( home_url( '/media/' ) ); ?>" class="group/item relative flex flex-col gap-0 px-5 py-2.5 hover:bg-[#FDFBF7] transition-all duration-200 border-b border-gray-50 last:border-0">
									<div class="flex items-center justify-between">
										<span class="font-bold text-xs uppercase tracking-wide text-gray-800 group-hover/item:text-primary transition-colors"><?php echo yaghnob_tr('media'); ?></span>
									</div>
									<span class="text-[10px] text-gray-500 group-hover/item:text-gray-600 transition-colors"><?php echo yaghnob_tr('video_audio'); ?></span>
								</a>
							</div>
						</div>
					</div>

					<!-- ABOUT Dropdown -->
					<div class="relative group h-full flex items-center">
						<button class="flex items-center gap-1 px-3 py-2 text-xs font-bold uppercase tracking-wide text-gray-600 rounded-full hover:bg-[#FDFBF7] hover:text-primary transition-all duration-300 focus:outline-none group-hover:bg-[#FDFBF7] group-hover:text-primary">
							<?php echo yaghnob_tr('about'); ?> <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-300 group-hover:rotate-180 opacity-50 group-hover:opacity-100"></i>
						</button>
						<div class="absolute right-0 top-full w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-out transform group-hover:translate-y-0 translate-y-2">
							<div class="bg-white border-t-0 border border-gray-100 shadow-lg overflow-hidden ring-1 ring-black/5">
								<a href="<?php echo esc_url( home_url( '/mission/' ) ); ?>" class="group/item relative flex flex-col gap-0 px-5 py-2.5 hover:bg-[#FDFBF7] transition-all duration-200 border-b border-gray-50 last:border-0">
									<div class="flex items-center justify-between">
										<span class="font-bold text-xs uppercase tracking-wide text-gray-800 group-hover/item:text-primary transition-colors"><?php echo yaghnob_tr('mission'); ?></span>
									</div>
									<span class="text-[10px] text-gray-500 group-hover/item:text-gray-600 transition-colors"><?php echo yaghnob_tr('project_goals'); ?></span>
								</a>
								<a href="<?php echo esc_url( home_url( '/partners/' ) ); ?>" class="group/item relative flex flex-col gap-0 px-5 py-2.5 hover:bg-[#FDFBF7] transition-all duration-200 border-b border-gray-50 last:border-0">
									<div class="flex items-center justify-between">
										<span class="font-bold text-xs uppercase tracking-wide text-gray-800 group-hover/item:text-primary transition-colors"><?php echo yaghnob_tr('partners'); ?></span>
									</div>
									<span class="text-[10px] text-gray-500 group-hover/item:text-gray-600 transition-colors"><?php echo yaghnob_tr('academic_cooperation'); ?></span>
								</a>
								<a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="group/item relative flex flex-col gap-0 px-5 py-2.5 hover:bg-[#FDFBF7] transition-all duration-200 border-b border-gray-50 last:border-0">
									<div class="flex items-center justify-between">
										<span class="font-bold text-xs uppercase tracking-wide text-gray-800 group-hover/item:text-primary transition-colors"><?php echo yaghnob_tr('news'); ?></span>
									</div>
									<span class="text-[10px] text-gray-500 group-hover/item:text-gray-600 transition-colors"><?php echo yaghnob_tr('news_desc'); ?></span>
								</a>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</nav>

			<!-- CTA Button & Mobile Menu Toggle -->
			<div class="flex items-center gap-6">
				<!-- Language Switcher -->
				<div class="hidden md:flex items-center p-1 rounded-full">
					<?php $current_lang = function_exists('yaghnob_get_current_lang') ? yaghnob_get_current_lang() : 'en'; ?>
					<a href="?lang=en" class="px-3 py-1 rounded-full text-xs transition-all <?php echo $current_lang === 'en' ? 'bg-[#FDFBF7] shadow-sm font-bold text-gray-900' : 'font-medium text-gray-500 hover:bg-[#FDFBF7] hover:text-gray-900'; ?>">EN</a>
					<a href="?lang=tg" class="px-3 py-1 rounded-full text-xs transition-all <?php echo $current_lang === 'tg' ? 'bg-[#FDFBF7] shadow-sm font-bold text-gray-900' : 'font-medium text-gray-500 hover:bg-[#FDFBF7] hover:text-gray-900'; ?>">TJ</a>
					<a href="?lang=yai" class="px-3 py-1 rounded-full text-xs transition-all <?php echo $current_lang === 'yai' ? 'bg-[#FDFBF7] shadow-sm font-bold text-gray-900' : 'font-medium text-gray-500 hover:bg-[#FDFBF7] hover:text-gray-900'; ?>">YG</a>
				</div>

				<!-- Mobile menu button -->
				<button type="button" id="mobile-menu-button" class="md:hidden -m-2.5 inline-flex items-center justify-center rounded-lg p-2.5 text-gray-600 hover:bg-[#FDFBF7]">
					<span class="sr-only">Open main menu</span>
					<i data-lucide="menu" class="h-6 w-6"></i>
				</button>
			</div>
		</div>
	</div>

	<!-- Mobile menu, show/hide based on menu open state. -->
	<div id="mobile-menu" class="hidden relative z-50" role="dialog" aria-modal="true">
		<!-- Background backdrop, show/hide based on slide-over state. -->
		<div class="fixed inset-0 bg-[#FDFBF7]/90 backdrop-blur-sm"></div>
		<div class="fixed inset-0 z-50 flex flex-col p-6 bg-[#FDFBF7] overflow-y-auto">
			<div class="flex items-center justify-between mb-8">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="-m-1.5 p-1.5 text-2xl font-bold text-gray-900">
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				</a>
				<button type="button" id="close-mobile-menu" class="-m-2.5 rounded-md p-2.5 text-gray-700">
					<span class="sr-only">Close menu</span>
					<i data-lucide="x" class="h-6 w-6"></i>
				</button>
			</div>
			<div class="mt-6 flow-root">
				<div class="-my-6 divide-y divide-gray-500/10">
					<div class="space-y-6 py-6 flex flex-col">
						<?php
						if ( has_nav_menu( 'primary' ) ) {
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'container'      => false,
									'menu_class'     => 'space-y-4 flex flex-col', // Vertical stack
									'fallback_cb'    => false,
									'items_wrap'     => '%3$s',
								)
							);
						} else {
							// Hardcoded Yaghnob Heritage Mobile Menu Structure
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="-mx-3 block rounded-lg px-3 py-1 text-sm font-semibold leading-6 text-gray-900 hover:bg-[#FDFBF7]"><?php echo yaghnob_tr('home'); ?></a>
							
							<div class="space-y-0.5">
								<span class="-mx-3 block rounded-lg px-3 py-1 text-sm font-semibold leading-6 text-gray-500"><?php echo yaghnob_tr('culture'); ?></span>
								<div class="pl-4 space-y-0.5 border-l-2 border-gray-100 ml-1">
									<a href="<?php echo esc_url( home_url( '/history/' ) ); ?>" class="block rounded-md px-2 py-1 -ml-2 text-xs text-gray-600 hover:bg-[#FDFBF7] hover:text-primary transition-colors"><?php echo yaghnob_tr('history'); ?></a>
									<a href="<?php echo esc_url( home_url( '/ethnography/' ) ); ?>" class="block rounded-md px-2 py-1 -ml-2 text-xs text-gray-600 hover:bg-[#FDFBF7] hover:text-primary transition-colors"><?php echo yaghnob_tr('ethnography'); ?></a>
									<a href="<?php echo esc_url( home_url( '/folklore/' ) ); ?>" class="block rounded-md px-2 py-1 -ml-2 text-xs text-gray-600 hover:bg-[#FDFBF7] hover:text-primary transition-colors"><?php echo yaghnob_tr('folklore'); ?></a>
								</div>
							</div>

							<div class="space-y-0.5">
								<span class="-mx-3 block rounded-lg px-3 py-1 text-sm font-semibold leading-6 text-gray-500"><?php echo yaghnob_tr('language'); ?></span>
								<div class="pl-4 space-y-0.5 border-l-2 border-gray-100 ml-1">
									<a href="<?php echo esc_url( home_url( '/grammar/' ) ); ?>" class="block rounded-md px-2 py-1 -ml-2 text-xs text-gray-600 hover:bg-[#FDFBF7] hover:text-primary transition-colors"><?php echo yaghnob_tr('grammar'); ?></a>
									<a href="<?php echo esc_url( home_url( '/corpus/' ) ); ?>" class="block rounded-md px-2 py-1 -ml-2 text-xs text-gray-600 hover:bg-[#FDFBF7] hover:text-primary transition-colors"><?php echo yaghnob_tr('corpus'); ?></a>
									<a href="<?php echo esc_url( home_url( '/dialectology/' ) ); ?>" class="block rounded-md px-2 py-1 -ml-2 text-xs text-gray-600 hover:bg-[#FDFBF7] hover:text-primary transition-colors"><?php echo yaghnob_tr('dialectology'); ?></a>
								</div>
							</div>

							<div class="space-y-0.5">
								<span class="-mx-3 block rounded-lg px-3 py-1 text-sm font-semibold leading-6 text-gray-500"><?php echo yaghnob_tr('resources'); ?></span>
								<div class="pl-4 space-y-0.5 border-l-2 border-gray-100 ml-1">
									<a href="<?php echo esc_url( home_url( '/library/' ) ); ?>" class="block rounded-md px-2 py-1 -ml-2 text-xs text-gray-600 hover:bg-[#FDFBF7] hover:text-primary transition-colors"><?php echo yaghnob_tr('library'); ?></a>
									<a href="<?php echo esc_url( home_url( '/reports/' ) ); ?>" class="block rounded-md px-2 py-1 -ml-2 text-xs text-gray-600 hover:bg-[#FDFBF7] hover:text-primary transition-colors"><?php echo yaghnob_tr('reports'); ?></a>
								</div>
							</div>

							<div class="space-y-0.5">
								<span class="-mx-3 block rounded-lg px-3 py-1 text-sm font-semibold leading-6 text-gray-500"><?php echo yaghnob_tr('archive'); ?></span>
								<div class="pl-4 space-y-0.5 border-l-2 border-gray-100 ml-1">
									<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="block rounded-md px-2 py-1 -ml-2 text-xs text-gray-600 hover:bg-[#FDFBF7] hover:text-primary transition-colors"><?php echo yaghnob_tr('gallery'); ?></a>
									<a href="<?php echo esc_url( home_url( '/media/' ) ); ?>" class="block rounded-md px-2 py-1 -ml-2 text-xs text-gray-600 hover:bg-[#FDFBF7] hover:text-primary transition-colors"><?php echo yaghnob_tr('media'); ?></a>
								</div>
							</div>

							<div class="space-y-0.5">
								<span class="-mx-3 block rounded-lg px-3 py-1 text-sm font-semibold leading-6 text-gray-500"><?php echo yaghnob_tr('about'); ?></span>
								<div class="pl-4 space-y-0.5 border-l-2 border-gray-100 ml-1">
									<a href="<?php echo esc_url( home_url( '/mission/' ) ); ?>" class="block rounded-md px-2 py-1 -ml-2 text-xs text-gray-600 hover:bg-[#FDFBF7] hover:text-primary transition-colors"><?php echo yaghnob_tr('mission'); ?></a>
									<a href="<?php echo esc_url( home_url( '/partners/' ) ); ?>" class="block rounded-md px-2 py-1 -ml-2 text-xs text-gray-600 hover:bg-[#FDFBF7] hover:text-primary transition-colors"><?php echo yaghnob_tr('partners'); ?></a>
									<a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="block rounded-md px-2 py-1 -ml-2 text-xs text-gray-600 hover:bg-[#FDFBF7] hover:text-primary transition-colors"><?php echo yaghnob_tr('news'); ?></a>
								</div>
							</div>
							<?php
						}
						?>
						<!-- Mobile Language Switcher -->
						<div class="mt-4 w-full flex items-center justify-center gap-2 text-xs font-medium text-gray-500 border-t border-gray-100 pt-4">
							<?php $current_lang = function_exists('yaghnob_get_current_lang') ? yaghnob_get_current_lang() : 'en'; ?>
							<a href="?lang=en" class="px-3 py-1 rounded-full transition-all <?php echo $current_lang === 'en' ? 'bg-[#FDFBF7] shadow-sm font-bold text-gray-900' : 'hover:bg-[#FDFBF7] hover:text-gray-900'; ?>">EN</a>
							<a href="?lang=tg" class="px-3 py-1 rounded-full transition-all <?php echo $current_lang === 'tg' ? 'bg-[#FDFBF7] shadow-sm font-bold text-gray-900' : 'hover:bg-[#FDFBF7] hover:text-gray-900'; ?>">TJ</a>
							<a href="?lang=yai" class="px-3 py-1 rounded-full transition-all <?php echo $current_lang === 'yai' ? 'bg-[#FDFBF7] shadow-sm font-bold text-gray-900' : 'hover:bg-[#FDFBF7] hover:text-gray-900'; ?>">YG</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

