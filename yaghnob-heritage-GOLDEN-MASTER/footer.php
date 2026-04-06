<?php
/**
 * Footer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<footer class="mt-auto bg-[#1c1917] border-t-4 border-primary relative overflow-hidden">
	<!-- Petroglyph Background Elements -->
	<div class="absolute inset-0 overflow-hidden pointer-events-none select-none">
		<!-- Petroglyph 1: Top Left (Corner) -->
		<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/petroglyph-1.svg' ); ?>" 
			 class="absolute -top-12 -left-12 w-64 h-64 invert opacity-[0.05] transform -rotate-12" alt="" loading="lazy">

		<!-- Petroglyph 1: Bottom Right (Corner) -->
		<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/petroglyph-1.svg' ); ?>" 
			 class="absolute -bottom-12 -right-12 w-80 h-80 invert opacity-[0.05] transform rotate-6 scale-x-[-1]" alt="" loading="lazy">

		 <!-- Petroglyph 1: Bottom Center-Right (Edge) -->
		<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/petroglyph-1.svg' ); ?>" 
			 class="absolute bottom-0 right-1/3 w-32 h-32 invert opacity-[0.05] transform -rotate-12" alt="" loading="lazy">
	</div>

	<div class="relative z-10 mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8">
		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 border-b border-gray-700 pb-8 text-gray-300">
				<?php dynamic_sidebar( 'footer-1' ); ?>
			</div>
		<?php endif; ?>
		<div class="flex flex-col items-center justify-center space-y-6">
			<!-- Social Icons -->
			<div class="flex space-x-6 order-1">
				<!-- Facebook -->
				<a href="#" class="text-gray-400 hover:text-primary transition-colors">
					<span class="sr-only">Facebook</span>
					<svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
						<path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
					</svg>
				</a>

				<!-- Twitter / X -->
				<a href="#" class="text-gray-400 hover:text-primary transition-colors">
					<span class="sr-only">Twitter</span>
					<svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
						<path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
					</svg>
				</a>

				<!-- YouTube -->
				<a href="#" class="text-gray-400 hover:text-primary transition-colors">
					<span class="sr-only">YouTube</span>
					<svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
						<path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd" />
					</svg>
				</a>
			</div>

			<!-- Copyright Text -->
			<div class="text-center order-2">
				<p class="text-sm text-gray-400">
					<?php echo yaghnob_tr('footer_project_name'); ?> - <?php echo date('Y'); ?>. <?php echo yaghnob_tr('footer_tagline'); ?>
				</p>
				<p class="text-xs text-gray-500 mt-2">
					<?php echo yaghnob_tr('footer_developed_by'); ?> <span class="text-gray-400 hover:text-primary transition-colors cursor-default">Webistan Luxury</span>
				</p>
			</div>
		</div>
	</div>
</footer>

<!-- AOS Animation Script -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
	// Initialize AOS
	AOS.init({
		duration: 1000,
		once: true,
		offset: 100
	});

	// Initialize Lucide Icons
	lucide.createIcons();
</script>

<?php wp_footer(); ?>
</body>
</html>
