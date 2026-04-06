<?php
/**
 * The main template file
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
?>

<main class="flex-grow bg-white">
	<?php if ( have_posts() ) : ?>
		<!-- Hero Section -->
		<div class="relative isolate h-screen w-full flex items-center justify-center bg-cover bg-no-repeat overflow-hidden" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg.jpg'); background-size: cover; background-position: center top;">
			<div class="absolute inset-0 bg-ivory/80"></div>
			<div data-aos="fade-in" data-aos-duration="1500" class="relative z-10 mx-auto max-w-7xl px-6 w-full flex flex-col items-center justify-center h-full pb-32">
				
				<!-- Top Description -->
				<div class="max-w-2xl mx-auto text-center mb-10 mt-16" data-aos="fade-up" data-aos-delay="300">
					<p class="font-serif text-lg sm:text-xl leading-relaxed text-gray-900" style="text-wrap: balance;">
						<?php echo tr('hero_subtitle'); ?>
					</p>
				</div>

				<!-- Main Title Block -->
				<div class="relative text-center mb-6 mix-blend-multiply max-w-6xl z-20 pt-0">
					<h1 class="flex flex-col items-center leading-none">
						<span class="block font-serif font-bold text-base sm:text-lg tracking-[0.3em] text-primary uppercase mb-2 sm:mb-4" data-aos="fade-up" data-aos-delay="500">
							<?php echo tr('hero_title_prefix'); ?>
						</span>
						<div class="flex flex-col items-center">
							<span class="block font-serif font-medium text-[10vw] sm:text-[6rem] lg:text-[8rem] tracking-tighter text-gray-900 uppercase -mt-1 sm:-mt-2" style="line-height: 0.85;" data-aos="zoom-in" data-aos-delay="700">
								<?php echo tr('hero_title_main'); ?>
							</span>
							<span class="block font-serif font-normal text-[4vw] sm:text-[2rem] lg:text-[3rem] tracking-[0.2em] text-primary uppercase mt-[3px] sm:mt-[1px]" style="line-height: 1;" data-aos="fade-up" data-aos-delay="900">
								<?php echo tr('hero_title_suffix'); ?>
							</span>
						</div>
					</h1>
				</div>

				<div class="w-24 h-1 bg-[#9A6735] mx-auto mb-8 opacity-60" data-aos="fade-up" data-aos-delay="1000"></div>

				<!-- Bottom Description -->
				<div class="max-w-xl mx-auto text-center mt-6 sm:mt-8" data-aos="fade-up" data-aos-delay="1100">
					<p class="font-sans text-base text-gray-900">
						<?php echo tr('hero_desc'); ?>
					</p>
				</div>

				<!-- Action Buttons -->
				<div class="mt-10 flex flex-wrap justify-center gap-12 sm:gap-20" data-aos="fade-up" data-aos-delay="1300">
					
					<!-- Primary Action -->
					<a href="<?php echo esc_url( home_url( '/corpus/' ) ); ?>" class="group relative inline-flex items-center gap-3 py-2">
						<span class="text-xs font-bold uppercase tracking-[0.2em] text-gray-900 group-hover:text-primary transition-colors duration-300"><?php echo tr('explore_archive'); ?></span>
						<i data-lucide="arrow-right" class="w-4 h-4 text-gray-400 group-hover:text-primary group-hover:translate-x-1 transition-all duration-300"></i>
						<span class="absolute bottom-0 left-0 w-full h-px bg-gray-200 group-hover:bg-primary transition-colors duration-300"></span>
					</a>

					<!-- Secondary Action -->
					<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="group relative inline-flex items-center gap-3 py-2">
						<span class="text-xs font-bold uppercase tracking-[0.2em] text-gray-900 group-hover:text-primary transition-colors duration-300"><?php echo tr('view_gallery'); ?></span>
						<i data-lucide="image" class="w-4 h-4 text-gray-400 group-hover:text-primary group-hover:scale-110 transition-all duration-300"></i>
						<span class="absolute bottom-0 left-0 w-full h-px bg-gray-200 group-hover:bg-primary transition-colors duration-300"></span>
					</a>
				</div>

				<!-- Bottom Metadata (Preserved) -->
				<div class="absolute bottom-8 left-0 right-0 flex flex-wrap justify-center gap-4 sm:gap-8 text-[10px] font-sans font-bold text-gray-500 uppercase tracking-widest" data-aos="fade-in" data-aos-delay="1400">
					<span class="flex items-center gap-2"><div class="w-1.5 h-1.5 rounded-full bg-primary"></div> <?php echo tr('iso_code'); ?></span>
					<span class="hidden sm:inline text-gray-400">•</span>
					<span class="flex items-center gap-2"><div class="w-1.5 h-1.5 rounded-full bg-primary"></div> <?php echo tr('region'); ?></span>
					<span class="hidden sm:inline text-gray-400">•</span>
					<span class="flex items-center gap-2"><div class="w-1.5 h-1.5 rounded-full bg-primary"></div> <?php echo tr('status'); ?></span>
				</div>
			</div>
		</div>

		<!-- 3 Main Accent Blocks -->
		<div class="py-24 sm:py-32 bg-white">
			<div class="mx-auto max-w-7xl px-6 lg:px-8">
				<div class="mx-auto max-w-2xl lg:max-w-none">
					<div class="grid grid-cols-1 gap-y-16 lg:grid-cols-3 lg:gap-x-8">
						
						<!-- Block 1: Language -->
						<div data-aos="fade-up" class="relative flex flex-col group p-8 rounded-3xl bg-ivory hover:bg-white hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] transition-all duration-500 border border-gray-50 hover:border-gray-100">
							<div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-sm border border-gray-100 group-hover:scale-110 transition-transform duration-500">
								<i data-lucide="book-open" class="h-6 w-6 text-gray-900 group-hover:text-primary transition-colors"></i>
							</div>
							<h3 class="text-2xl font-serif font-medium text-gray-900 group-hover:text-primary transition-colors">
								<a href="<?php echo esc_url( home_url( '/grammar/' ) ); ?>"><?php echo tr('card_language_title'); ?></a>
							</h3>
							<p class="mt-4 text-[15px] leading-7 text-gray-500 flex-auto font-light">
								<?php echo tr('card_language_desc'); ?>
							</p>
							<div class="mt-8 pt-6 border-t border-gray-100">
								<a href="<?php echo esc_url( home_url( '/grammar/' ) ); ?>" class="text-xs font-bold tracking-widest uppercase text-gray-900 hover:text-primary transition-colors flex items-center gap-2">
									<?php echo tr('card_language_link'); ?> <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
								</a>
							</div>
						</div>

						<!-- Block 2: Archives -->
						<div data-aos="fade-up" data-aos-delay="200" class="relative flex flex-col group p-8 rounded-3xl bg-ivory hover:bg-white hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] transition-all duration-500 border border-gray-50 hover:border-gray-100">
							<div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-sm border border-gray-100 group-hover:scale-110 transition-transform duration-500">
								<i data-lucide="archive" class="h-6 w-6 text-gray-900 group-hover:text-primary transition-colors"></i>
							</div>
							<h3 class="text-2xl font-serif font-medium text-gray-900 group-hover:text-primary transition-colors">
								<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>"><?php echo tr('card_archives_title'); ?></a>
							</h3>
							<p class="mt-4 text-[15px] leading-7 text-gray-500 flex-auto font-light">
								<?php echo tr('card_archives_desc'); ?>
							</p>
							<div class="mt-8 pt-6 border-t border-gray-100">
								<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="text-xs font-bold tracking-widest uppercase text-gray-900 hover:text-primary transition-colors flex items-center gap-2">
									<?php echo tr('card_archives_link'); ?> <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
								</a>
							</div>
						</div>

						<!-- Block 3: Library -->
						<div data-aos="fade-up" data-aos-delay="400" class="relative flex flex-col group p-8 rounded-3xl bg-ivory hover:bg-white hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] transition-all duration-500 border border-gray-50 hover:border-gray-100">
							<div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-sm border border-gray-100 group-hover:scale-110 transition-transform duration-500">
								<i data-lucide="library" class="h-6 w-6 text-gray-900 group-hover:text-primary transition-colors"></i>
							</div>
							<h3 class="text-2xl font-serif font-medium text-gray-900 group-hover:text-primary transition-colors">
								<a href="<?php echo esc_url( home_url( '/library/' ) ); ?>"><?php echo tr('card_library_title'); ?></a>
							</h3>
							<p class="mt-4 text-[15px] leading-7 text-gray-500 flex-auto font-light">
								<?php echo tr('card_library_desc'); ?>
							</p>
							<div class="mt-8 pt-6 border-t border-gray-100">
								<a href="<?php echo esc_url( home_url( '/library/' ) ); ?>" class="text-xs font-bold tracking-widest uppercase text-gray-900 hover:text-primary transition-colors flex items-center gap-2">
									<?php echo tr('card_library_link'); ?> <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
								</a>
							</div>
						</div>

					</div>
					
				</div>
			</div>
		</div>

		<!-- Recent Updates / Blog Loop -->
		<div class="bg-ivory py-24 sm:py-32">
			<div class="mx-auto max-w-7xl px-6 lg:px-8">
				<div class="mx-auto max-w-2xl text-center mb-16">
					<h2 class="text-3xl font-serif font-bold tracking-tight text-gray-900 sm:text-4xl"><?php echo tr('updates_title'); ?></h2>
					<p class="mt-2 text-lg leading-8 text-gray-600"><?php echo tr('updates_desc'); ?></p>
				</div>
				
				<div class="mx-auto grid max-w-2xl grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none">
					<?php
					while ( have_posts() ) : the_post();
						?>
						<article data-aos="fade-up" <?php post_class( 'flex flex-col items-start justify-start bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 h-auto border border-gray-100' ); ?>>
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
										<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
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
			</div>
		</div>
	<?php endif; ?>

</main>

<?php
get_footer();
