<?php
/**
 * Template Name: Partners Page
 * Description: A custom template for displaying partners and supporters.
 * 
 * =========================================================================
 * LOCKED DESIGN: DO NOT MODIFY WITHOUT EXPLICIT USER INSTRUCTION
 * This file's design has been finalized and approved by the user, including:
 * 1. The "Become a Partner" block (minimalist, no borders).
 * 2. The "Partners Grid" background (clean/white).
 * 3. Logo behaviors (TICRO brown filter, SIL Nexus color inversion).
 * Please do not make stylistic changes unless specifically requested.
 * =========================================================================
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
				<?php echo yaghnob_tr('partners_collab'); ?>
			</span>

			<h1 class="text-4xl sm:text-5xl lg:text-6xl font-serif font-medium text-gray-900 leading-tight mb-6" data-aos="fade-up" data-aos-delay="100">
				<?php echo yaghnob_tr('partners_our_partners'); ?>
			</h1>
			
			<div class="w-24 h-1 bg-[#9A6735] mx-auto mb-8 opacity-60" data-aos="fade-up" data-aos-delay="150"></div>

			<p class="text-lg text-gray-600 mb-0 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
				<?php echo yaghnob_tr('partners_intro'); ?>
			</p>

		</div>
	</div>

	<!-- Partners Grid -->
	<div class="py-16 sm:py-24">
		<div class="mx-auto max-w-7xl px-6 lg:px-8">
			
			<div class="grid grid-cols-2 gap-x-8 gap-y-12 sm:grid-cols-3 sm:gap-x-12 lg:grid-cols-4 lg:gap-x-12">
				<?php
				$partners = array(
					array( 'name' => yaghnob_tr('partner_academy') ),
					array( 
						'name' => 'TICRO',
						'logo' => get_template_directory_uri() . '/assets/images/logo-ticro.png',
						// Standard size, specific brown filter for hover
						// filter: brightness(0) saturate(100%) invert(39%) sepia(35%) saturate(836%) hue-rotate(349deg) brightness(97%) contrast(93%); matches #9A6735
						'logo_class' => 'h-full w-full object-contain p-4 transition-all duration-300 group-hover:[filter:brightness(0)_saturate(100%)_invert(39%)_sepia(35%)_saturate(836%)_hue-rotate(349deg)_brightness(97%)_contrast(93%)]'
					),
					array( 
						'name' => 'SIL Nexus',
						'logo' => get_template_directory_uri() . '/assets/images/logo-sil-nexus.svg',
						// BG: Blue circle -> Brown circle on hover
						'bg_class' => 'bg-gray-100 group-hover:bg-white bg-[radial-gradient(closest-side,#005eb8_78%,transparent_79%)] transition-all duration-500 group-hover:bg-[radial-gradient(closest-side,#9A6735_78%,transparent_79%)]',
						// Logo: Keep white (brightness-0 invert-1) on hover to contrast with brown bg
						'logo_class' => 'h-full w-full object-contain p-6 transition-all duration-300',
						// Text: Black -> Brown (#9A6735) on hover to match the circle
						'name_class' => 'text-lg font-serif font-bold text-gray-900 group-hover:!text-[#9A6735] transition-colors'
					),
					array( 'name' => yaghnob_tr('partner_foundation') ),
					array( 'name' => yaghnob_tr('partner_university') ),
					array( 'name' => yaghnob_tr('partner_heritage') ),
					array( 'name' => yaghnob_tr('partner_research') ),
					array( 'name' => yaghnob_tr('partner_archive') )
				);

				foreach ( $partners as $partner ) :
					$bg_class = isset( $partner['bg_class'] ) ? $partner['bg_class'] : 'bg-gray-100 group-hover:bg-white';
					$size_class = isset( $partner['size_class'] ) ? $partner['size_class'] : 'h-32 w-32';
					$logo_class = isset( $partner['logo_class'] ) ? $partner['logo_class'] : 'h-full w-full object-contain p-4';
					$name_class = isset( $partner['name_class'] ) ? $partner['name_class'] : 'text-lg font-serif font-bold text-gray-900 group-hover:text-primary transition-colors';
					?>
					<div class="col-span-1 flex flex-col items-center justify-center text-center group" data-aos="fade-up">
						<div class="<?php echo esc_attr( $size_class ); ?> <?php echo esc_attr( $bg_class ); ?> rounded-full flex items-center justify-center mb-6 group-hover:shadow-lg transition-all duration-300 border border-gray-50 overflow-hidden">
							<?php if ( ! empty( $partner['logo'] ) ) : ?>
								<img src="<?php echo esc_url( $partner['logo'] ); ?>" alt="<?php echo esc_attr( $partner['name'] ); ?>" class="<?php echo esc_attr( $logo_class ); ?>">
							<?php else : ?>
								<!-- Placeholder Logo (Book Icon) -->
								<svg class="h-12 w-12 text-gray-400 group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
								</svg>
							<?php endif; ?>
						</div>
						<?php if ( empty( $partner['hide_name'] ) ) : ?>
							<h3 class="<?php echo esc_attr( $name_class ); ?>"><?php echo esc_html( $partner['name'] ); ?></h3>
						<?php endif; ?>
						<p class="text-sm text-gray-500 mt-2"><?php echo yaghnob_tr('partners_strategic'); ?></p>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Call to Action -->
			<div class="mt-24 relative" data-aos="fade-up">
				<div class="relative px-6 py-16 sm:px-16 sm:py-24 lg:flex lg:items-center lg:justify-between lg:px-20">
					<div class="max-w-xl">
						<h2 class="text-3xl font-serif font-bold tracking-tight text-gray-900 sm:text-4xl">
							<?php echo yaghnob_tr('partners_join'); ?> <br>
							<span class="text-[#9A6735]"><?php echo yaghnob_tr('partners_cta_title'); ?></span>
						</h2>
						<p class="mt-6 text-lg leading-8 text-gray-600">
							<?php echo yaghnob_tr('partners_cta_desc'); ?>
						</p>
						<div class="mt-8 flex items-center gap-x-6">
							<button type="button" onclick="document.getElementById('contact-modal').classList.remove('hidden')" class="rounded-full bg-[#9A6735] px-8 py-3.5 text-sm font-semibold text-white shadow-lg hover:shadow-[#9A6735]/30 hover:bg-[#8A5A2B] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#9A6735] transition-all transform hover:scale-105 duration-300">
								<?php echo yaghnob_tr('contact_us'); ?>
							</button>
							<a href="<?php echo esc_url( home_url( '/mission/' ) ); ?>" class="text-sm font-semibold leading-6 text-gray-900 hover:text-[#9A6735] transition-colors">
								<?php echo yaghnob_tr('view_more'); ?> <span aria-hidden="true">â†’</span>
							</a>
						</div>
					</div>
					
					<!-- Decorative Icon/Illustration -->
					<div class="mt-10 lg:mt-0 lg:flex-shrink-0 lg:ml-10">
						<div class="relative h-48 w-48 sm:h-64 sm:w-64 rounded-full bg-gradient-to-tr from-[#9A6735]/20 to-[#7A522A]/20 p-2 shadow-2xl">
							<div class="h-full w-full rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center overflow-hidden relative border border-white/50">
								<div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&q=80&w=400')] bg-cover bg-center opacity-30 mix-blend-multiply"></div>
								<svg class="h-24 w-24 text-[#9A6735] relative z-10 drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
								</svg>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- Contact Modal -->
	<div id="contact-modal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
		<div class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm transition-opacity"></div>

		<div class="fixed inset-0 z-10 overflow-y-auto">
			<div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
				<div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 w-full max-w-4xl border border-gray-100">
					
					<div class="grid grid-cols-1 lg:grid-cols-5 h-full">
						<!-- Sidebar / Info Section -->
						<div class="bg-gray-50 px-8 py-10 lg:col-span-2 lg:px-10 lg:py-12 border-r border-gray-100 relative overflow-hidden flex flex-col justify-between">
							<!-- Decorative BG -->
							<div class="absolute inset-0 opacity-40">
								<svg class="absolute right-0 top-0 h-full w-full stroke-gray-200" aria-hidden="true">
									<defs>
										<pattern id="sidebar-grid" width="20" height="20" patternUnits="userSpaceOnUse">
											<path d="M0 20L20 0H10L0 10M20 20V10L10 20" stroke-width="1" fill="none"/>
										</pattern>
									</defs>
									<rect width="100%" height="100%" fill="url(#sidebar-grid)"/>
								</svg>
							</div>

							<div class="relative z-10">
								<h3 class="text-2xl font-serif font-semibold leading-7 text-gray-900" id="modal-title"><?php echo yaghnob_tr('contact_get_in_touch'); ?></h3>
								<p class="mt-4 text-base leading-6 text-gray-600">
									<?php echo yaghnob_tr('contact_intro'); ?>
								</p>
								
								<dl class="mt-8 space-y-6 text-sm leading-6 text-gray-600">
									<div class="flex gap-x-3">
										<svg class="h-6 w-5 flex-none text-[#9A6735]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
										</svg>
										<div>admin@yaghnob.com</div>
									</div>
									<div class="flex gap-x-3">
										<svg class="h-6 w-5 flex-none text-[#9A6735]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
											<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
										</svg>
										<div><?php echo yaghnob_tr('contact_location'); ?></div>
									</div>
								</dl>
							</div>
							
							<div class="relative z-10 mt-10">
								<div class="h-1 w-12 bg-[#9A6735] rounded-full"></div>
							</div>
						</div>

						<!-- Form Section -->
						<div class="px-8 py-10 lg:col-span-3 lg:px-12 lg:py-12 bg-white relative">
							<!-- Close Button -->
							<button type="button" onclick="document.getElementById('contact-modal').classList.add('hidden')" class="absolute top-6 right-6 rounded-full p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition-colors focus:outline-none z-20">
								<span class="sr-only"><?php echo yaghnob_tr('contact_close'); ?></span>
								<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
								</svg>
							</button>

							<form id="contact-form" class="space-y-6">
								<div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
									<div class="sm:col-span-1">
										<label for="name" class="block text-sm font-medium leading-6 text-gray-900"><?php echo yaghnob_tr('contact_name'); ?></label>
										<div class="mt-2">
											<input type="text" name="name" id="name" required class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#9A6735] sm:text-sm sm:leading-6 bg-white transition-colors">
										</div>
									</div>

									<div class="sm:col-span-1">
										<label for="email" class="block text-sm font-medium leading-6 text-gray-900"><?php echo yaghnob_tr('contact_email'); ?></label>
										<div class="mt-2">
											<input type="email" name="email" id="email" required class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#9A6735] sm:text-sm sm:leading-6 bg-white transition-colors">
										</div>
									</div>

									<div class="sm:col-span-2">
										<label for="message" class="block text-sm font-medium leading-6 text-gray-900"><?php echo yaghnob_tr('contact_message'); ?></label>
										<div class="mt-2">
											<textarea id="message" name="message" rows="3" required class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#9A6735] sm:text-sm sm:leading-6 bg-white transition-colors resize-none"></textarea>
										</div>
									</div>
								</div>

								<div id="form-message" class="hidden text-sm p-3 rounded-lg text-center"></div>

								<div class="flex items-center justify-end pt-2">
									<button type="button" onclick="submitContactForm()" class="rounded-full bg-[#9A6735] px-8 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#8A5A2B] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#9A6735] transition-all transform hover:scale-105 duration-200">
										<?php echo yaghnob_tr('contact_send'); ?>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
	function submitContactForm() {
		const form = document.getElementById('contact-form');
		const messageDiv = document.getElementById('form-message');
		const submitBtn = document.querySelector('button[onclick="submitContactForm()"]');
		
		const formData = new FormData(form);
		formData.append('action', 'yaghnob_contact_form');
		formData.append('nonce', '<?php echo wp_create_nonce('yaghnob_contact_nonce'); ?>');

		// Disable button and show loading state
		submitBtn.disabled = true;
		submitBtn.innerHTML = '<?php echo yaghnob_tr("contact_sending"); ?>';
		messageDiv.classList.add('hidden');

		fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
			method: 'POST',
			body: formData
		})
		.then(response => response.json())
		.then(data => {
			messageDiv.classList.remove('hidden');
			if (data.success) {
				messageDiv.className = 'text-sm p-2 rounded bg-green-50 text-green-700';
				messageDiv.textContent = data.data.message;
				form.reset();
				setTimeout(() => {
					document.getElementById('contact-modal').classList.add('hidden');
					messageDiv.classList.add('hidden');
				}, 3000);
			} else {
				messageDiv.className = 'text-sm p-2 rounded bg-red-50 text-red-700';
				messageDiv.textContent = data.data.message || '<?php echo yaghnob_tr("error_occurred"); ?>';
			}
		})
		.catch(error => {
			messageDiv.classList.remove('hidden');
			messageDiv.className = 'text-sm p-2 rounded bg-red-50 text-red-700';
			messageDiv.textContent = '<?php echo yaghnob_tr("network_error"); ?>';
			console.error('Error:', error);
		})
		.finally(() => {
			submitBtn.disabled = false;
			submitBtn.innerHTML = '<?php echo yaghnob_tr("contact_send"); ?>';
		});
	}
	</script>

</main>

<?php
get_footer();

