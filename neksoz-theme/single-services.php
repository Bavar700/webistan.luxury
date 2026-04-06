<?php
/**
 * The template for displaying all single services
 *
 * @package Nexoz
 */

get_header();
?>

<main id="primary" class="site-main mt-40 mb-32">

    <?php
    while ( have_posts() ) :
        the_post();
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-7xl mx-auto px-6' ); ?>>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-24">
            
            <!-- Main Content Area -->
            <div class="lg:col-span-8">
                <!-- Meta information / Label -->
                <div class="flex items-center gap-4 mb-8">
                    <div class="h-px w-8 bg-navy opacity-30"></div>
                    <span class="text-xs font-black uppercase tracking-[0.3em] text-accent-blue">Ð’Ð°ÑˆÐ° Ð£ÑÐ»ÑƒÐ³Ð°</span>
                </div>

                <!-- Title and Breadcrumb Logic -->
                <h1 class="text-5xl md:text-7xl font-black text-navy leading-[1.1] mb-12 tracking-tight">
                    <?php the_title(); ?>
                </h1>

                <!-- Featured Image -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="mb-16 rounded-sm overflow-hidden shadow-2xl shadow-navy/5 border border-slate-100">
                        <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto object-cover grayscale opacity-90' ) ); ?>
                    </div>
                <?php endif; ?>

                <!-- Content -->
                <div class="prose prose-slate prose-xl max-w-none text-slate-600 font-medium leading-relaxed mb-24 prose-headings:text-navy prose-strong:text-navy prose-strong:font-black">
                    <?php the_content(); ?>
                </div>

                <!-- Service-Specific Call to Action -->
                <div class="bg-navy p-12 md:p-20 rounded-sm text-white relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-12">
                    <div class="absolute inset-0 bg-white/5 opacity-10 pointer-events-none"></div>
                    <div class="max-w-lg relative z-10">
                        <h2 class="text-3xl font-black mb-6">Ð“Ð¾Ñ‚Ð¾Ð²Ñ‹ Ð¾Ð±ÑÑƒÐ´Ð¸Ñ‚ÑŒ ÑÑ‚Ñƒ Ð·Ð°Ð´Ð°Ñ‡Ñƒ?</h2>
                        <p class="text-white/70 text-lg font-semibold leading-relaxed">
                            ÐžÑÑ‚Ð°Ð²ÑŒÑ‚Ðµ Ð·Ð°ÑÐ²ÐºÑƒ, Ð¸ Ð½Ð°ÑˆÐ¸ ÑÐºÑÐ¿ÐµÑ€Ñ‚Ñ‹ Ð¿Ñ€Ð¾Ð²ÐµÐ´ÑƒÑ‚ Ð¿ÐµÑ€Ð²Ð¸Ñ‡Ð½ÑƒÑŽ Ð±ÐµÑÐ¿Ð»Ð°Ñ‚Ð½ÑƒÑŽ Ð´Ð¸Ð°Ð³Ð½Ð¾ÑÑ‚Ð¸ÐºÑƒ ÑÑ‚Ð¾Ð¹ ÑÑ„ÐµÑ€Ñ‹ Ð² Ð²Ð°ÑˆÐµÐ¼ Ð±Ð¸Ð·Ð½ÐµÑÐµ.
                        </p>
                    </div>
                    <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="relative z-10 bg-white text-navy px-10 py-5 rounded-sm font-black text-xs uppercase tracking-widest hover:bg-slate-100 transition-colors shrink-0">
                        ÐžÑÑ‚Ð°Ð²Ð¸Ñ‚ÑŒ Ð·Ð°ÑÐ²ÐºÑƒ
                    </a>
                </div>
            </div>

            <!-- Sidebar Area -->
            <aside class="lg:col-span-4 flex flex-col gap-12 sticky top-40 h-fit">
                <!-- Related Services -->
                <div class="bg-white p-12 border border-slate-100 rounded-sm space-y-10 group">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-navy border-b border-navy/10 pb-6">Ð”Ñ€ÑƒÐ³Ð¸Ðµ Ñ€ÐµÑˆÐµÐ½Ð¸Ñ Ð´Ð»Ñ Ð’Ð°Ñ</h4>
                    <div class="flex flex-col gap-8">
                        <?php
                        $other_services = new WP_Query( array(
                            'post_type'      => 'services',
                            'posts_per_page' => 3,
                            'post__not_in'   => array( get_the_ID() )
                        ) );

                        if ( $other_services->have_posts() ) :
                            while ( $other_services->have_posts() ) : $other_services->the_post();
                        ?>
                            <a href="<?php the_permalink(); ?>" class="flex flex-col gap-3 group/item">
                                <h5 class="text-lg font-black text-navy leading-tight group-hover/item:text-accent-blue transition-colors"><?php the_title(); ?></h5>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 group-hover/item:text-navy transition-colors">Ð¡Ð¼Ð¾Ñ‚Ñ€ÐµÑ‚ÑŒ Ð´ÐµÑ‚Ð°Ð»Ð¸</p>
                            </a>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="bg-slate-50 p-12 border border-slate-200 rounded-sm italic">
                    <p class="text-slate-500 font-medium leading-relaxed">
                        ÐœÑ‹ Ñ€Ð°Ð±Ð¾Ñ‚Ð°ÐµÐ¼ Ñ ÐºÐ¾Ð¼Ð¿Ð°Ð½Ð¸ÑÐ¼Ð¸ Ð»ÑŽÐ±Ð¾Ð³Ð¾ Ð¼Ð°ÑÑˆÑ‚Ð°Ð±Ð°: Ð¾Ñ‚ Ð¿ÐµÑ€ÑÐ¿ÐµÐºÑ‚Ð¸Ð²Ð½Ñ‹Ñ… ÑÑ‚Ð°Ñ€Ñ‚Ð°Ð¿Ð¾Ð² Ð´Ð¾ ÐºÑ€ÑƒÐ¿Ð½Ñ‹Ñ… Ð¿Ñ€Ð¾Ð¼Ñ‹ÑˆÐ»ÐµÐ½Ð½Ñ‹Ñ… Ð³Ñ€ÑƒÐ¿Ð¿ Ð² Ð¢Ð°Ð´Ð¶Ð¸ÐºÐ¸ÑÑ‚Ð°Ð½Ðµ Ð¸ Ð¡ÐÐ“.
                    </p>
                </div>
            </aside>
            
        </div>
    </article>

    <?php endwhile; ?>

</main><!-- #primary -->

<?php get_footer(); ?>
