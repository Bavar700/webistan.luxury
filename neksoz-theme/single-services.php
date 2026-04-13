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
                    <span class="text-xs font-black uppercase tracking-[0.3em] text-accent-blue">Ваша Услуга</span>
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
                        <h2 class="text-3xl font-black mb-6">Готовы обсудить эту задачу?</h2>
                        <p class="text-white/70 text-lg font-semibold leading-relaxed">
                            Оставьте заявку, и наши эксперты проведут первичную бесплатную диагностику этой сферы в вашем бизнесе.
                        </p>
                    </div>
                    <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="relative z-10 bg-white text-navy px-10 py-5 rounded-sm font-black text-xs uppercase tracking-widest hover:bg-slate-100 transition-colors shrink-0">
                        Оставить заявку
                    </a>
                </div>
            </div>

            <!-- Sidebar Area -->
            <aside class="lg:col-span-4 flex flex-col gap-12 sticky top-40 h-fit">
                <!-- Related Services -->
                <div class="bg-white p-12 border border-slate-100 rounded-sm space-y-10 group">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-navy border-b border-navy/10 pb-6">Другие решения для Вас</h4>
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
                                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 group-hover/item:text-navy transition-colors">Смотреть детали</p>
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
                        Мы работаем с компаниями любого масштаба: от перспективных стартапов до крупных промышленных групп в Таджикистане и СНГ.
                    </p>
                </div>
            </aside>
            
        </div>
    </article>

    <?php endwhile; ?>

</main><!-- #primary -->

<?php get_footer(); ?>
