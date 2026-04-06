�(<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Premium Academic Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Inter:wght@100..900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (Structural Utilities Only) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ink': '#0f172a',
                        'gold': '#92400e',
                    },
                    fontFamily: {
                        'serif': ['Lora', 'serif'],
                        'sans': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col pt-[80px]"> <!-- Standard Offset Adjusted -->
    
    <header id="masthead" class="site-header">
        <div class="container header-inner">
            <div class="site-branding">
                <svg class="brand-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <!-- Modern "Heritage Peak" (Y + Mountain) -->
                    <path d="M12 22V12M12 12L4 4M12 12L20 4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 20L12 6L22 20" stroke-linecap="round" stroke-linejoin="round" opacity="0.4"/>
                </svg>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title">
                    Yaghnob Heritage
                </a>
            </div>

            <nav id="site-navigation" class="main-navigation hidden lg:block">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'wp_page_menu',
                    'show_home'      => false, // Avoid duplicate Home link in fallback
                ));
                ?>
            </nav>

            <div class="header-actions flex items-center gap-6">
                <span class="header-separator text-slate-300 opacity-50">|</span>
                <div class="lang-switch">
                    <?php $current_lang = academy_get_lang(); ?>
                    <a href="?lang=en" class="<?php echo ($current_lang === 'en') ? 'active' : ''; ?>">EN</a>
                    <a href="?lang=tj" class="<?php echo ($current_lang === 'tj') ? 'active' : ''; ?>">TJ</a>
                    <a href="?lang=yg" class="<?php echo ($current_lang === 'yg') ? 'active' : ''; ?>">YG</a>
                </div>
                
                <button class="menu-toggle lg:hidden text-ink" onclick="document.getElementById('mobile-overlay').classList.toggle('hidden')">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Clean Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 z-[2000] bg-white hidden flex flex-col p-10 lg:hidden">
        <div class="flex justify-between items-center mb-16">
            <span class="font-serif font-bold text-xl uppercase">Contents</span>
            <button onclick="document.getElementById('mobile-overlay').classList.add('hidden')">
                <svg class="w-8 h-8 text-ink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <nav class="flex flex-col gap-8 text-4xl font-serif font-bold italic">
            <?php 
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'flex flex-col gap-6',
            ));
            ?>
        </nav>
    </div>

    <div id="content" class="site-content flex-grow">

    <script>
        // Handle Header Scroll Class
        window.addEventListener('scroll', () => {
            const masthead = document.getElementById('masthead');
            if (window.scrollY > 40) {
                masthead.classList.add('is-scrolled');
            } else {
                masthead.classList.remove('is-scrolled');
            }
        });
    </script>
� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08��*cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08��*cascade08�� *cascade08��*cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��( *cascade082Ffile:///c:/xampp/htdocs/wordpress/wp-content/themes/academy/header.php
