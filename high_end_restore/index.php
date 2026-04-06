<?php
/**
 * The template for displaying archive pages.
 */

get_header(); ?>

<main id="primary" class="site-main">

    <header class="page-header py-20 bg-slate-50 border-b border-slate-100">
        <div class="container">
            <span class="text-gold text-[10px] font-black uppercase tracking-[0.4em] mb-4 block">Archive Collection</span>
            <?php
            the_archive_title('<h1 class="text-5xl font-serif font-bold text-ink mb-4">', '</h1>');
            the_archive_description('<div class="archive-description text-slate-500 italic">', '</div>');
            ?>
        </div>
    </header>

    <div class="news-section py-24">
        <div class="container">
            <div class="news-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('group flex flex-col h-full'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail aspect-video overflow-hidden mb-8">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('academy-thumbnail', array('class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-110')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="post-content flex flex-col flex-grow">
                                <span class="text-gold text-[10px] font-black uppercase tracking-widest mb-4">
                                    <?php echo get_the_date(); ?>
                                </span>
                                <h2 class="text-2xl font-serif font-bold mb-4 group-hover:text-gold transition-colors">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="text-slate-600 text-sm leading-relaxed mb-8 flex-grow">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="text-[10px] font-bold uppercase tracking-widest border-b border-slate-100 w-fit pb-1 group-hover:border-gold transition-colors">
                                    Read Article →
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p><?php esc_html_e('No posts found.', 'academy'); ?></p>
                <?php endif; ?>
            </div>

            <div class="pagination mt-20 pt-10 border-t border-slate-100">
                <?php
                the_posts_pagination(array(
                    'prev_text' => '&larr; Previous',
                    'next_text' => 'Next &rarr;',
                ));
                ?>
            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
