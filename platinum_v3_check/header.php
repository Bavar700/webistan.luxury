<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
    <style>
        /* Extra Impressive logic if needed */
        .bk-header { transition: all 0.4s ease; }
        .bk-header.scrolled { height: 75px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); }
    </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header: Nexoz Impressive Business -->
<header class="bk-header fixed top-4 left-4 right-4 z-[1000] flex items-center bg-white shadow-2xl shadow-blue-900/10 rounded-2xl border border-slate-100 h-24 transition-all duration-500">
    <div class="container mx-auto px-8 w-full grid grid-cols-3 items-center">
        
        <!-- LEFT: Navigation -->
        <nav class="hidden lg:flex justify-start">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'flex gap-8 text-[10px] font-black tracking-[0.25em] text-nk-dark uppercase items-center hover:text-nk-blue transition-all',
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>

        <!-- CENTER: Logo -->
        <div class="flex justify-center">
            <div class="scale-90 transition-transform hover:scale-95 duration-300">
                <?php nexoz_the_logo(); ?>
            </div>
        </div>

        <!-- RIGHT: Contacts & Socials -->
        <div class="flex items-center justify-end gap-6">
            <!-- Social Unified Style -->
            <div class="hidden xl:flex items-center gap-3">
                <!-- Phone -->
                <a href="tel:+992985641010" class="nk-social-btn text-nk-blue bg-blue-50 border-blue-100 hover:bg-nk-blue hover:text-white" title="Call Us">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </a>
                <!-- Telegram -->
                <a href="https://t.me/is_tajikistan" target="_blank" class="nk-social-btn text-nk-blue bg-blue-50 border-blue-100 hover:bg-nk-blue hover:text-white" title="Telegram">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.14-.25.25-.51.25l.21-3.04 5.53-4.99c.24-.22-.05-.34-.37-.14l-6.84 4.30-2.94-.92c-.64-.20-.65-.64.13-.94l11.5-4.43c.53-.20.99.11.83.94z"/></svg>
                </a>
                <!-- WhatsApp -->
                <a href="https://wa.me/992985641010" target="_blank" class="nk-social-btn text-green-600 bg-green-50 border-green-100 hover:bg-green-600 hover:text-white" title="WhatsApp">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12a11.934 11.934 0 0 0 3.224 8.134L1.75 22.5l2.434-2.366A11.934 11.934 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.844a9.835 9.835 0 0 1-5.02-1.378l-.36-.214-3.714 3.606 3.654-3.548-.223-.374a9.835 9.835 0 0 1-1.378-5.02c0-5.42 4.414-9.834 9.834-9.834 5.42 0 9.834 4.414 9.834 9.834 0 5.42-4.414 9.834-9.834 9.834z"/></svg>
                </a>
            </div>
            
            <!-- Call Mobile -->
            <a href="tel:+992985641010" class="btn-wow bg-nk-red text-white py-4 px-8 text-[10px] tracking-widest flex items-center gap-3 hover:bg-nk-dark transition-all">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span class="hidden sm:block">Позвонить</span>
            </a>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="lg:hidden col-start-3 flex justify-end text-nk-dark">
            <div class="p-4 bg-slate-50 rounded-lg">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            </div>
        </button>
    </div>
</header>

<div class="h-[140px]"></div> <!-- Precision Spacer for Floating Header -->
