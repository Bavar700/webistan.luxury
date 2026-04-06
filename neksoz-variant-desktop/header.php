<?php
/**
 * Header Template — Neksoz.Luxury
 *
 * @package Neksoz
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="screen-reader-text" href="#primary"><?php esc_html_e( 'Перейти к содержимому', 'neksoz' ); ?></a>

<header id="masthead" class="header" role="banner">
    <div class="container header__inner">

        <!-- Branding -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo">
            <?php neksoz_the_logo(); ?>
        </a>

        <!-- Primary Navigation -->
        <nav id="site-navigation" class="header__nav" role="navigation" aria-label="<?php esc_attr_e( 'Главное меню', 'neksoz' ); ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => false,
                'depth'          => 2,
            ) );
            ?>
            <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="header__cta">
                <?php esc_html_e( 'Связаться', 'neksoz' ); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </nav>

        <!-- Mobile Toggle -->
        <button class="nk-mobile-toggle" aria-label="<?php esc_attr_e( 'Открыть меню', 'neksoz' ); ?>" aria-expanded="false" style="display:none;">
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>
</header><!-- #masthead -->

<div id="page" class="site">
