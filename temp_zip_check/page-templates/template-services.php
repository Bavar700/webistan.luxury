<?php
/**
 * Template Name: Services List
 *
 * @package Neksoz
 */

get_header();
?>

	<main id="primary" class="site-main">
        <!-- Page Hero -->
        <section class="relative py-40 bg-bg-dark overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-20">
                <img src="https://images.unsplash.com/photo-1454165833767-0266b19677c8?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="Neksoz Services">
                <div class="absolute inset-0 bg-gradient-to-b from-bg-dark via-bg-dark/80 to-bg-dark"></div>
            </div>
            <div class="container relative z-10 text-center">
                <div class="inline-block mb-8 animate-reveal">
                    <span class="text-neksoz-red font-extrabold uppercase tracking-[0.4em] text-[0.65rem] flex items-center justify-center">
                        <span class="w-12 h-[2px] bg-neksoz-red mr-4"></span>
                        Направления экспертизы
                        <span class="w-12 h-[2px] bg-neksoz-red ml-4"></span>
                    </span>
                </div>
                <h1 class="text-6xl md:text-8xl font-heading font-black text-white uppercase tracking-tighter mb-10 animate-reveal delay-100">
                    Наши Услуги<span class="text-neksoz-red">.</span>
                </h1>
                <p class="text-2xl text-gray-400 font-serif italic max-w-3xl mx-auto animate-reveal delay-200">
                    Комплексные интеллектуальные решения для обеспечения безопасности и роста вашего бизнеса.
                </p>
            </div>
        </section>

		<section class="section-padding bg-bg-light">
            <div class="container">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                    <?php
                    $services_query = new WP_Query(array('post_type' => 'services', 'posts_per_page' => -1));
                    if ($services_query->have_posts()) :
                        $count = 0;
                        while ($services_query->have_posts()) : $services_query->the_post();
                            $count++;
                            $delay = $count * 100;
                            ?>
                            <article class="premium-card group flex flex-col h-full animate-reveal delay-<?php echo $delay; ?>">
                                <div class="mb-12 relative">
                                    <span class="text-[4rem] font-heading font-black text-gray-50 absolute -top-8 -left-4 group-hover:text-neksoz-red/10 transition-colors duration-500">
                                        <?php echo str_pad($count, 2, '0', STR_PAD_LEFT); ?>
                                    </span>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="relative z-10 w-20 h-20 overflow-hidden mb-6 border border-gray-100">
                                            <?php the_post_thumbnail('thumbnail', array('class' => 'w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700')); ?>
                                        </div>
                                    <?php else : ?>
                                        <div class="relative z-10 text-neksoz-red">
                                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <h3 class="text-2xl font-heading font-black text-neksoz-blue mb-6 leading-tight uppercase group-hover:text-neksoz-red transition-colors duration-500">
                                    <?php the_title(); ?>
                                </h3>
                                
                                <div class="text-text-muted text-lg font-serif italic mb-10 line-clamp-4 leading-relaxed flex-grow">
                                    <?php the_excerpt(); ?>
                                </div>

                                <div class="mt-auto pt-10 border-t border-gray-50">
                                    <a href="<?php the_permalink(); ?>" class="group/link flex items-center text-[0.65rem] font-black uppercase tracking-[0.3em] text-neksoz-blue hover:text-neksoz-red transition-colors">
                                        Детали услуги
                                        <span class="ml-4 w-10 h-[1px] bg-neksoz-blue group-hover/link:bg-neksoz-red group-hover/link:w-16 transition-all duration-500"></span>
                                    </a>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p class="col-span-full text-center text-gray-400 py-24 font-serif italic text-2xl">Портфель услуг формируется. Пожалуйста, свяжитесь с нами для консультации.</p>';
                    endif;
                    ?>
                </div>
            </div>
        </section>
	</main>

<?php
get_footer();
