<?php
/**
 * Шаблон архива для Archive (Медиа-материалы)
 *
 * @package Academy
 */

get_header();
?>

<main id="primary" class="site-main archive-media">

    <header class="page-header">
        <h1 class="page-title">
            <span class="archive-icon">🎬</span>
            <?php _e('Архив медиа-материалов', 'academy'); ?>
        </h1>
        
        <?php
        $archive_description = get_the_archive_description();
        if ($archive_description) :
            ?>
            <div class="archive-description"><?php echo wp_kses_post(wpautop($archive_description)); ?></div>
        <?php endif; ?>
        
        <?php
        // Фильтр по типам материалов (Фото, Аудио, Видео)
        $media_types = get_terms(array(
            'taxonomy' => 'archive_category',
            'hide_empty' => true,
        ));
        
        if (!empty($media_types) && !is_wp_error($media_types)) :
            ?>
            <div class="archive-filters">
                <span class="filter-label"><?php _e('Тип материала:', 'academy'); ?></span>
                <ul class="media-type-filter">
                    <li><a href="<?php echo get_post_type_archive_link('archive'); ?>" class="<?php echo !is_tax() ? 'active' : ''; ?>"><?php _e('Все', 'academy'); ?></a></li>
                    <?php foreach ($media_types as $type) : ?>
                        <li>
                            <a href="<?php echo get_term_link($type); ?>" class="<?php echo (is_tax('archive_category', $type->slug)) ? 'active' : ''; ?>">
                                <?php
                                // Добавляем иконки для разных типов
                                $icon = '📁';
                                if (stripos($type->name, 'фото') !== false || stripos($type->name, 'photo') !== false) {
                                    $icon = '📷';
                                } elseif (stripos($type->name, 'аудио') !== false || stripos($type->name, 'audio') !== false) {
                                    $icon = '🎵';
                                } elseif (stripos($type->name, 'видео') !== false || stripos($type->name, 'video') !== false) {
                                    $icon = '🎥';
                                }
                                echo $icon . ' ';
                                echo esc_html($type->name);
                                ?> (<?php echo $type->count; ?>)
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </header><!-- .page-header -->

    <?php if (have_posts()) : ?>

        <div class="media-grid">
            <?php
            while (have_posts()) :
                the_post();
                
                // Определяем тип материала
                $media_categories = get_the_terms(get_the_ID(), 'archive_category');
                $media_type = 'default';
                $media_icon = '📁';
                
                if ($media_categories && !is_wp_error($media_categories)) {
                    $first_category = reset($media_categories);
                    $category_name = strtolower($first_category->name);
                    
                    if (stripos($category_name, 'фото') !== false || stripos($category_name, 'photo') !== false) {
                        $media_type = 'photo';
                        $media_icon = '📷';
                    } elseif (stripos($category_name, 'аудио') !== false || stripos($category_name, 'audio') !== false) {
                        $media_type = 'audio';
                        $media_icon = '🎵';
                    } elseif (stripos($category_name, 'видео') !== false || stripos($category_name, 'video') !== false) {
                        $media_type = 'video';
                        $media_icon = '🎥';
                    }
                }
                ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('media-item media-type-' . $media_type); ?>>
                    
                    <div class="media-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('academy-featured', array('alt' => get_the_title())); ?>
                                <span class="media-type-badge"><?php echo $media_icon; ?></span>
                            <?php else : ?>
                                <div class="placeholder-thumbnail">
                                    <span class="placeholder-icon"><?php echo $media_icon; ?></span>
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>
                    
                    <div class="media-content">
                        <header class="entry-header">
                            <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                            
                            <div class="entry-meta">
                                <?php
                                if ($media_categories && !is_wp_error($media_categories)) {
                                    echo '<span class="media-category">';
                                    $category_names = array();
                                    foreach ($media_categories as $category) {
                                        $category_names[] = '<a href="' . get_term_link($category) . '">' . esc_html($category->name) . '</a>';
                                    }
                                    echo implode(', ', $category_names);
                                    echo '</span>';
                                }
                                
                                echo '<span class="media-date">' . get_the_date() . '</span>';
                                ?>
                            </div>
                        </header><!-- .entry-header -->
                        
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div><!-- .entry-summary -->
                        
                        <footer class="entry-footer">
                            <a href="<?php the_permalink(); ?>" class="media-link">
                                <?php _e('Просмотреть', 'academy'); ?> &rarr;
                            </a>
                        </footer>
                    </div><!-- .media-content -->
                    
                </article><!-- #post-<?php the_ID(); ?> -->
                
            <?php endwhile; ?>
        </div><!-- .media-grid -->

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
                <h2 class="page-title"><?php _e('Материалы не найдены', 'academy'); ?></h2>
            </header>

            <div class="page-content">
                <p><?php _e('В архиве пока нет медиа-материалов. Загляните позже.', 'academy'); ?></p>
            </div>
        </section>

    <?php endif; ?>

</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
