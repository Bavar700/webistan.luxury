<?php
/**
 * Sidebar â€” Neksoz.Luxury
 *
 * @package Neksoz
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>

<aside id="secondary" class="nk-sidebar" role="complementary">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
