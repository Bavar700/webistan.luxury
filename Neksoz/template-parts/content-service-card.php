<?php
/**
 * Template Part: Service Card
 *
 * @package Neksoz
 */

$card_index = get_query_var('card_index', 0);
$is_red = ($card_index % 2 !== 0);
$icon_name = get_post_meta(get_the_ID(), 'neksoz_service_icon', true);
if (!$icon_name) {
    $icon_name = 'briefcase';
}
?>

<div class="nk-service-card<?php echo $is_red ? ' nk-service-card--red' : ''; ?> nk-fade-in">

    <div class="nk-service-card__icon">
        <?php echo neksoz_service_icon($icon_name); ?>
    </div>

    <h3 class="nk-service-card__title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h3>

    <?php if (has_excerpt()): ?>
        <p class="nk-service-card__excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
    <?php endif; ?>

    <a href="<?php the_permalink(); ?>" class="nk-service-card__link">
        <?php esc_html_e('ÐŸÐ¾Ð´Ñ€Ð¾Ð±Ð½ÐµÐµ', 'neksoz'); ?>
    </a>

</div>