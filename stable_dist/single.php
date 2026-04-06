<?php
/**
 * The template for displaying all single posts
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
		<div class="relative bg-ivory/95 border-b border-gray-100 py-24 sm:py-32">
			<div class="absolute inset-0 bg-ivory/95 backdrop-blur-[1px]"></div>
			<div class="relative z-10 mx-auto max-w-3xl px-6 text-center">
				
				<!-- Meta -->
				<div class="flex flex-wrap justify-center gap-4 text-xs font-bold uppercase tracking-widest text-gray-500 mb-6" data-aos="fade-up">
					<time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo yaghnob_get_localized_date(); ?></time>
					<?php
					$categories = get_the_category();
					if ( ! empty( $categories ) ) :
                        $cat_key = 'cat_' . strtolower( $categories[0]->slug );
                        $cat_name = tr( $cat_key );
                        if ( $cat_name === $cat_key ) {
                            $cat_name = $categories[0]->name;
                        }
						?>
						<span class="text-gray-300">•</span>
						<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="text-primary hover:text-gray-900 transition-colors">
							<?php echo esc_html( $cat_name ); ?>
						</a>
					<?php endif; ?>
				</div>

				<!-- Title -->
				<h1 class="text-4xl sm:text-5xl font-serif font-medium text-gray-900 leading-tight mb-8" data-aos="fade-up" data-aos-delay="100">
					<?php 
					if ( get_the_title() === 'Hello world!' ) {
						echo tr('hello_world_title');
					} else {
						the_title();
					}
					?>
				</h1>

			</div>
		</div>

		<!-- Content Section -->
		<div class="py-16 sm:py-24">
			<div class="mx-auto max-w-3xl px-6">
				
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="mb-12 rounded-2xl overflow-hidden shadow-sm" data-aos="fade-up" data-aos-delay="200">
						<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto object-cover' ) ); ?>
					</div>
				<?php endif; ?>

				<article class="prose lg:prose-lg prose-headings:font-serif prose-headings:font-medium prose-p:font-light prose-a:text-primary hover:prose-a:text-gray-900 transition-colors mx-auto text-gray-600">
					<?php 
					if ( get_the_title() === 'Hello world!' ) {
						echo '<p>' . tr('hello_world_content') . '</p>';
					} else {
						the_content();
					}
					?>
				</article>

				<!-- Social Share -->
				<div class="mt-16 pt-8 border-t border-gray-100">
					<div class="flex flex-col sm:flex-row items-center justify-between gap-6">
						<span class="text-xs font-bold uppercase tracking-widest text-gray-400"><?php echo tr('share_this'); ?></span>
						<div class="flex items-center gap-4">
							<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="p-3 rounded-full bg-ivory text-gray-600 hover:bg-black hover:text-white transition-all duration-300 group" aria-label="Share on X">
								<!-- X Logo -->
								<svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 h-5 fill-current">
									<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path>
								</svg>
							</a>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="p-3 rounded-full bg-ivory text-gray-600 hover:bg-[#1877F2] hover:text-white transition-all duration-300 group" aria-label="Share on Facebook">
								<i data-lucide="facebook" class="w-5 h-5"></i>
							</a>
							<?php 
							$youtube_url = get_post_meta( get_the_ID(), 'youtube_video_url', true );
							if ( $youtube_url ) : 
							?>
							<a href="<?php echo esc_url( $youtube_url ); ?>" target="_blank" rel="noopener noreferrer" class="p-3 rounded-full bg-ivory text-gray-600 hover:bg-[#FF0000] hover:text-white transition-all duration-300 group" aria-label="Watch on YouTube">
								<i data-lucide="youtube" class="w-5 h-5"></i>
							</a>
							<?php endif; ?>
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" class="p-3 rounded-full bg-ivory text-gray-600 hover:bg-[#0A66C2] hover:text-white transition-all duration-300 group" aria-label="Share on LinkedIn">
								<i data-lucide="linkedin" class="w-5 h-5"></i>
							</a>
							<button onclick="navigator.clipboard.writeText('<?php echo get_permalink(); ?>'); alert('<?php echo tr("link_copied"); ?>');" class="p-3 rounded-full bg-ivory text-gray-600 hover:bg-primary hover:text-white transition-all duration-300 group" aria-label="Copy Link">
								<i data-lucide="link" class="w-5 h-5"></i>
							</button>
						</div>
					</div>
				</div>

				<!-- Comments -->
				<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>

				<!-- Post Navigation -->
				<div class="mt-16 pt-10 border-t border-gray-100 flex justify-between gap-8">
					<div class="w-1/2">
						<?php previous_post_link( '%link', '<span class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">' . tr('pagination_previous') . '</span><span class="font-serif text-lg text-gray-900 hover:text-primary transition-colors line-clamp-2">%title</span>' ); ?>
					</div>
					<div class="w-1/2 text-right">
						<?php next_post_link( '%link', '<span class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">' . tr('pagination_next') . '</span><span class="font-serif text-lg text-gray-900 hover:text-primary transition-colors line-clamp-2">%title</span>' ); ?>
					</div>
				</div>

			</div>
		</div>

		<?php
	endwhile;
	?>
</main>

<?php
get_footer();
