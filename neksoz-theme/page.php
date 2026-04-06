<?php
/**
 * The template for displaying all pages
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

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto px-6' ); ?>>
        
        <header class="mb-16">
            <div class="flex items-center gap-4 mb-8">
                <div class="h-px w-8 bg-navy opacity-30"></div>
                <span class="text-xs font-black uppercase tracking-[0.3em] text-accent-blue">Ð˜Ð½Ñ„Ð¾Ñ€Ð¼Ð°Ñ†Ð¸Ð¾Ð½Ð½Ñ‹Ð¹ Ñ€Ð°Ð·Ð´ÐµÐ»</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-navy leading-[1.1] tracking-tight">
                <?php the_title(); ?>
            </h1>
        </header>

        <div class="prose prose-slate prose-xl max-w-none text-slate-600 font-medium leading-relaxed prose-headings:text-navy prose-strong:text-navy prose-strong:font-black">
            <?php the_content(); ?>
        </div>

    </article>

    <?php endwhile; ?>

</main><!-- #primary -->

<?php get_footer(); ?>
