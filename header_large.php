Ö&<!DOCTYPE html>
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
                <svg class="brand-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width: 28px; height: 28px; margin-right: 12px; color: var(--gold);">
                    <!-- Modern "Heritage Peak" (Y + Mountain) -->
                    <path d="M12 22V12M12 12L4 4M12 12L20 4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 20L12 6L22 20" stroke-linecap="round" stroke-linejoin="round" opacity="0.4"/>
                </svg>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title uppercase tracking-tight font-serif font-bold text-xl">
                    <?php echo academy_t('Yaghnob Heritage'); ?>
                </a>
            </div>

            <nav id="site-navigation" class="main-navigation hidden lg:block">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu flex gap-8 uppercase text-[10px] font-bold tracking-widest',
                    'container'      => false,
                    'fallback_cb'    => 'wp_page_menu',
                ));
                ?>
            </nav>

            <div class="header-actions flex items-center gap-6">
                <span class="header-separator text-slate-300 opacity-50">|</span>
                <div class="lang-switch flex gap-4 text-xs font-bold">
                    <?php $current_lang = academy_get_lang(); ?>
                    <a href="?lang=en" class="<?php echo ($current_lang === 'en') ? 'active' : 'text-slate-400'; ?>">EN</a>
                    <a href="?lang=tj" class="<?php echo ($current_lang === 'tj') ? 'active' : 'text-slate-400'; ?>">TJ</a>
                    <a href="?lang=yg" class="<?php echo ($current_lang === 'yg') ? 'active' : 'text-slate-400'; ?>">YG</a>
                </div>
                
                <button class="menu-toggle lg:hidden text-ink" onclick="document.getElementById('mobile-overlay').classList.toggle('hidden')">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Overlay -->
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
‡ *cascade08‡œ	*cascade08œ	Ò	 *cascade08Ò	
 *cascade08
«
*cascade08«
µ
*cascade08µ
¶
 *cascade08¶
·
 *cascade08·
Ù
*cascade08Ù
ß
 *cascade08ß
 *cascade08¥ *cascade08¥¯*cascade08¯±*cascade08±³ *cascade08³´ *cascade08´µ*cascade08µ¶ *cascade08¶· *cascade08·¸*cascade08¸¹ *cascade08¹» *cascade08»Ë *cascade08ËÌ *cascade08Ìæ *cascade08æø *cascade08øù *cascade08ùñ*cascade08ñ  *cascade08 § *cascade08§©*cascade08©« *cascade08«¬ *cascade08¬® *cascade08®¯ *cascade08¯°*cascade08°± *cascade08±ç*cascade08çè*cascade08èû *cascade08ûÿ *cascade08ÿ… *cascade08…ˆ*cascade08ˆ‰ *cascade08‰—*cascade08—˜ *cascade08˜™*cascade08™š *cascade08š› *cascade08›¢*cascade08¢£ *cascade08£¤*cascade08¤¥ *cascade08¥«*cascade08«Ñ *cascade08ÑÓ*cascade08Óå *cascade08åæ *cascade08æ• *cascade08•¥*cascade08¥© *cascade08©² *cascade08²µ*cascade08µ¹*cascade08¹º *cascade08ºÀ*cascade08ÀÐ *cascade08ÐÔ *cascade08ÔÕ *cascade08Õ×*cascade08×Û *cascade08ÛÜ*cascade08ÜÞ *cascade08Þß*cascade08ßà *cascade08à€ *cascade08€ *cascade08ƒ*cascade08ƒ„ *cascade08„…*cascade08…† *cascade08†‰*cascade08‰Š *cascade08Š*cascade08” *cascade08”­ *cascade08­± *cascade08±² *cascade08²ëëð *cascade08ðö*cascade08ö÷ *cascade08÷ú *cascade08úû *cascade08ûü *cascade08üý*cascade08ýÿ *cascade08ÿ€ *cascade08€‚*cascade08‚½*cascade08½¿ *cascade08¿¿*cascade08¿Õ *cascade08ÕÖ *cascade08ÖÙ *cascade08Ùç*cascade08çè *cascade08èì*cascade08ìí *cascade08íñ *cascade08ñ‡ *cascade08‡ˆ *cascade08ˆ—*cascade08—˜ *cascade08˜™ *cascade08™¨ *cascade08¨¨*cascade08
¨º º¿*cascade08
¿Í ÍÎ *cascade08ÎÏ *cascade08ÏÐ*cascade08ÐÑ *cascade08ÑÓ *cascade08ÓÞ *cascade08Þß *cascade08ßç*cascade08çé *cascade08éê*cascade08êõ *cascade08õö *cascade08öø*cascade08øú *cascade08úý*cascade08ýþ *cascade08þ *cascade08 *cascade08§*cascade08§© *cascade08©¼ *cascade08¼*cascade08¥ *cascade08¥Â*cascade08ÂÛ *cascade08
Û ¶ *cascade08¶Ý*cascade08ÝÞ *cascade08Þâ*cascade08âã *cascade08ãè *cascade08èö*cascade08öû *cascade08û³ *cascade08³Ú *cascade08ÚÜ*cascade08ÜÝ *cascade08Ýß*cascade08ßå *cascade08åó*cascade08óø *cascade08ø° *cascade08°× *cascade08×Ù*cascade08ÙÚ *cascade08ÚÜ*cascade08Üâ *cascade08âð*cascade08ðõ *cascade08õ£ *cascade08£¹*cascade08¹º *cascade08ºÔ *cascade08ÔÖ*cascade08Ö×*cascade08×Ý *cascade08ÝÞ *cascade08Þâ*cascade08âã *cascade08ãä*cascade08äå *cascade08åè*cascade08èé *cascade08éë*cascade08ëì *cascade08ìï*cascade08ïñ *cascade08ñõ*cascade08õö*cascade08öø *cascade08øû*cascade08ûü *cascade08üÿ*cascade08ÿ€*cascade08€‡*cascade08‡ˆ *cascade08ˆŽ*cascade08Ž *cascade08 *cascade08–*cascade08–— *cascade08—›*cascade08›  *cascade08 ¢*cascade08¢£*cascade08£¤ *cascade08¤¥*cascade08¥¦ *cascade08¦©*cascade08©« *cascade08«¬ *cascade08¬­ *cascade08­°*cascade08°² *cascade08²³*cascade08³µ *cascade08µ¶*cascade08¶· *cascade08·¹ *cascade08¹½*cascade08½Í *cascade08ÍÙ *cascade08Ùà*cascade08àë *cascade08ëì *cascade08ìú*cascade08úû *cascade08ûÿ*cascade08ÿ *cascade08š*cascade08šœ *cascade08œ¦*cascade08¦§ *cascade08§¯*cascade08¯° *cascade08°±*cascade08±² *cascade08²´*cascade08´µ *cascade08µÄ*cascade08ÄÅ *cascade08ÅÌ*cascade08ÌÍ *cascade08ÍÏ*cascade08ÏÐ *cascade08ÐÕ*cascade08ÕÖ *cascade08Öâ *cascade08âä*cascade08äå *cascade08åæ*cascade08æé *cascade08éê*cascade08êí *cascade08íò*cascade08òô *cascade08ôø*cascade08øý *cascade08ýþ *cascade08þ‡*cascade08‡• *cascade08•› *cascade08›œ *cascade08
œ ¡ *cascade08¡¢ *cascade08¢° *cascade08°³*cascade08³´ *cascade08´µ*cascade08µÂ *cascade08ÂÂ*cascade08ÂÄ*cascade08ÄÎ *cascade08ÎÑ*cascade08ÑÒ *cascade08ÒÔ*cascade08ÔÞ *cascade08Þû*cascade08ûƒ *cascade08ƒ„*cascade08„… *cascade08…ˆ*cascade08ˆ‰ *cascade08‰‘*cascade08‘š *cascade08š¢*cascade08¢£ *cascade08£¶*cascade08¶¹ *cascade08¹¾*cascade08¾À *cascade08ÀÁ *cascade08ÁÅ*cascade08ÅÆ *cascade08ÆÎ*cascade08ÎÏ *cascade08ÏÓ*cascade08ÓÔ *cascade08ÔØ*cascade08ØÙ *cascade08ÙÞ*cascade08Þé *cascade08éí*cascade08íî *cascade08îð*cascade08ðñ *cascade08ñö*cascade08öø *cascade08øù*cascade08ùú *cascade08úƒ *cascade08ƒ „  *cascade08„ ‡ *cascade08‡ ˆ  *cascade08ˆ ‰ *cascade08‰ Š  *cascade08Š  *cascade08 ‘  *cascade08‘ • *cascade08• —  *cascade08— ž *cascade08ž ¨  *cascade08¨ ° *cascade08° ±  *cascade08± ´ *cascade08´ µ  *cascade08µ » *cascade08» ½  *cascade08½ ¾ *cascade08¾ À  *cascade08À Æ *cascade08Æ Ç  *cascade08Ç Ê *cascade08Ê Ì  *cascade08Ì Í *cascade08Í Î  *cascade08Î Õ *cascade08Õ Ö  *cascade08Ö ï *cascade08ï þ  *cascade08þ !*cascade08!ƒ! *cascade08ƒ!…!*cascade08…!†! *cascade08†!!*cascade08!Ž! *cascade08Ž!!*cascade08!©! *cascade08©!´!*cascade08´!µ! *cascade08µ!À!*cascade08À!Â! *cascade08Â!Ã!*cascade08Ã!Å! *cascade08Å!Î!*cascade08Î!Ð! *cascade08Ð!Ò!*cascade08Ò!à! *cascade08à!è!*cascade08è!é! *cascade08é!ð!*cascade08ð!ñ! *cascade08ñ!ý!*cascade08ý!ÿ! *cascade08ÿ!‰"*cascade08‰"Š" *cascade08Š"Ž"*cascade08Ž"" *cascade08"–"*cascade08–"—" *cascade08—"˜"*cascade08˜"™" *cascade08™"ž"*cascade08ž" " *cascade08 "£"*cascade08£"¤" *cascade08¤"­"*cascade08­"¯" *cascade08¯"°"*cascade08°"±" *cascade08±"³"*cascade08³"´" *cascade08´"½"*cascade08½"À" *cascade08À"Ã"*cascade08Ã"Ä" *cascade08Ä"Å"*cascade08Å"Ç" *cascade08Ç"Ê"*cascade08Ê"Ë" *cascade08Ë"Ò"*cascade08Ò"Ó" *cascade08Ó"Õ"*cascade08Õ"Ö" *cascade08Ö"Û"*cascade08Û"Ü" *cascade08Ü"í"*cascade08í"î" *cascade08î"ï"*cascade08ï"ñ" *cascade08ñ"ò"*cascade08ò"ó" *cascade08ó"ö"*cascade08ö"÷" *cascade08÷"ý"*cascade08ý"þ" *cascade08þ"ƒ#*cascade08ƒ#„# *cascade08„#‰#*cascade08‰#Š# *cascade08Š##*cascade08#Ž# *cascade08Ž#¦#*cascade08¦#®# *cascade08®#°#*cascade08°#²# *cascade08²#»#*cascade08»#Å# *cascade08Å#Í#*cascade08Í#Õ# *cascade08Õ#×#*cascade08×#Ø# *cascade08Ø#Ú#*cascade08Ú#ß# *cascade08ß#ã#*cascade08ã#ä# *cascade08ä#è#*cascade08è#é# *cascade08é#ê#*cascade08ê#î# *cascade08î#ü#*cascade08ü#ý# *cascade08ý#„$*cascade08„$…$ *cascade08…$‘$*cascade08‘$’$ *cascade08’$›$*cascade08›$©$ *cascade08©$¯$*cascade08¯$½$ *cascade08½$Ñ$*cascade08Ñ$à$ *cascade08à$â$*cascade08â$ã$ *cascade08ã$ä$*cascade08ä$ç$ *cascade08ç$è$*cascade08è$é$ *cascade08é$ë$*cascade08ë$î$ *cascade08î$ï$*cascade08ï$ð$ *cascade08ð$÷$*cascade08÷$ù$ *cascade08ù$ý$*cascade08ý$% *cascade08%’%*cascade08’%“% *cascade08“%”%*cascade08”%–% *cascade08–%™%*cascade08™%š% *cascade08š%¢%*cascade08¢%£% *cascade08£%¤%*cascade08¤%¥% *cascade08¥%¸%*cascade08¸%¹% *cascade08¹%º%*cascade08º%¼% *cascade08¼%¾%*cascade08¾%Ã% *cascade08Ã%Ê%*cascade08Ê%Ì% *cascade08Ì%Ò%*cascade08Ò%Ó% *cascade08Ó%Ø%*cascade08Ø%Ù% *cascade08Ù%Ü%*cascade08Ü%Ý% *cascade08Ý%Þ%*cascade08Þ%à% *cascade08à%â%*cascade08â%ê% *cascade08ê%í%*cascade08í%õ% *cascade08õ%‰&*cascade08‰&‹& *cascade08‹&¬&*cascade08¬&­& *cascade08­&½&*cascade08½&¾& *cascade08¾&Ç&*cascade08Ç&È& *cascade08È&Ó&*cascade08Ó&Ö& *cascade0822file:///c:/Users/alaco/Academy_Webistan/header.php
