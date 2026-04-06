<?php
/**
 * Шаблон архива для Resources (Библиотека)
 *
 * @package Academy
 */

get_header();
?>

<main id="primary" class="site-main archive-resources">

    <header class="page-header">
        <h1 class="page-title">
            <span class="archive-icon">📚</span>
            <?php _e('Библиотека ресурсов', 'academy'); ?>
        </h1>
        
        <?php
        $archive_description = get_the_archive_description();
        if ($archive_description) :
            ?>
            <div class="archive-description"><?php echo wp_kses_post(wpautop($archive_description)); ?></div>
        <?php endif; ?>
        
        <?php
        // Фильтр по категориям ресурсов
        $resource_categories = get_terms(array(
            'taxonomy' => 'resource_category',
            'hide_empty' => true,
        ));
        
        if (!empty($resource_categories) && !is_wp_error($resource_categories)) :
            ?>
            <div class="archive-filters">
                <span class="filter-label"><?php _e('Фильтр по категориям:', 'academy'); ?></span>
                <ul class="category-filter">
                    <li><a href="<?php echo get_post_type_archive_link('resources'); ?>" class="<?php echo !is_tax() ? 'active' : ''; ?>"><?php _e('Все', 'academy'); ?></a></li>
                    <?php foreach ($resource_categories as $category) : ?>
                        <li>
                            <a href="<?php echo get_term_link($category); ?>" class="<?php echo (is_tax('resource_category', $category->slug)) ? 'active' : ''; ?>">
                                <?php echo esc_html($category->name); ?> (<?php echo $category->count; ?>)
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </header><!-- .page-header -->

    <?php if (have_posts()) : ?>

        <div class="resources-grid">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('resource-item'); ?>>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="resource-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('academy-thumbnail', array('alt' => get_the_title())); ?>
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="resource-thumbnail placeholder">
                            <a href="<?php the_permalink(); ?>">
                                <span class="placeholder-icon">📄</span>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="resource-content">
                        <header class="entry-header">
                            <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                            
                            <div class="entry-meta">
                                <?php
                                $categories = get_the_terms(get_the_ID(), 'resource_category');
                                if ($categories && !is_wp_error($categories)) {
                                    echo '<span class="resource-category">';
                                    $category_names = array();
                                    foreach ($categories as $category) {
                                        $category_names[] = '<a href="' . get_term_link($category) . '">' . esc_html($category->name) . '</a>';
                                    }
                                    echo implode(', ', $category_names);
                                    echo '</span>';
                                }
                                
                                echo '<span class="resource-date">' . get_the_date() . '</span>';
                                ?>
                            </div>
                        </header><!-- .entry-header -->
                        
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div><!-- .entry-summary -->
                        
                        <footer class="entry-footer">
                            <a href="<?php the_permalink(); ?>" class="resource-link">
                                <?php _e('Подробнее', 'academy'); ?> &rarr;
                            </a>
                        </footer>
                    </div><!-- .resource-content -->
                    
                </article><!-- #post-<?php the_ID(); ?> -->
                
            <?php endwhile; ?>
        </div><!-- .resources-grid -->

        <?php
        the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => __('&laquo; Назад', 'academy'),
            'next_text' => __('Вперёд &raquo;', 'academy'),
        ));
        ?>

    <?php else : ?>

        <section class="no-results not-found">
            <header class="page-header">
                <h2 class="page-title"><?php _e('Ресурсы не найдены', 'academy'); ?></h2>
            </header>

            <div class="page-content">
                <p><?php _e('В библиотеке пока нет ресурсов. Загляните позже.', 'academy'); ?></p>
            </div>
        </section>

    <?php endif; ?>

</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
