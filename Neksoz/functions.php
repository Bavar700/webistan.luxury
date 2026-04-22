<?php
/**
 * Nexoz Corporate Theme Functions
 * Registered by Senior WordPress Developer / UI/UX Designer
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* 1. Theme Setup */
function nexoz_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'nexoz' ),
        'footer'  => __( 'Footer Menu', 'nexoz' ),
    ) );
}
add_action( 'after_setup_theme', 'nexoz_setup' );

/* 2. Enqueue Scripts & Styles */
function nexoz_scripts() {
    // Tailwind CSS CDN (Script for JIT)
    wp_enqueue_script( 'tailwind', 'https://cdn.tailwindcss.com', array(), null, false );
    
    // Google Fonts: Montserrat, Noto Serif (Standard for high-end editorial and universal support)
    wp_enqueue_style( 'nexoz-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Inter:wght@300;400;500;600;700;800;900&family=Mr+Dafoe&display=swap', array(), null );
    
    // Main Style (Minified)
    wp_enqueue_style( 'nexoz-main', get_template_directory_uri() . '/style.min.css', array('nexoz-fonts'), '1.0.3' );
    
    // Main JavaScript (Minified)
    wp_enqueue_script( 'nexoz-main-js', get_template_directory_uri() . '/main.min.js', array('jquery'), '1.0.3', true );

    // Localize
    wp_localize_script( 'nexoz-main-js', 'neksozAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'neksoz_nonce' )
    ));

    // DISABLE ADMIN BAR to prevent design shifts
    add_filter('show_admin_bar', '__return_false');
    
    // Tailwind Config (Inline)
    wp_add_inline_script( 'tailwind', "
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#001F3F',
                        ivory: '#FDFCFB',
                        'accent-red': '#E30613',
                        'accent-blue': '#0044CC',
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                        serif: ['Noto Serif', 'serif'],
                    }
                }
            }
        }
    ", 'before' );
}
add_action( 'wp_enqueue_scripts', 'nexoz_scripts' );

/* 3. Register Custom Post Types */
function nexoz_register_cpts() {
    // Services
    register_post_type( 'nk_service', array(
        'labels' => array(
            'name' => 'Услуги',
            'singular_name' => 'Услуга'
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'service-item'),
        'menu_icon' => 'dashicons-briefcase',
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest' => true,
    ));

    // Cases
    register_post_type( 'cases', array(
        'labels' => array(
            'name' => 'Кейсы',
            'singular_name' => 'Кейс'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-analytics',
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest' => true,
    ));
}
add_action( 'init', 'nexoz_register_cpts' );

/* 4. Helper: Logo */
function nexoz_the_logo() {
    $logo_url = get_template_directory_uri() . '/assets/images/logo.png';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="flex items-center">';
    echo '<img src="' . esc_url( $logo_url ) . '" alt="Нексоз" class="h-10 w-auto">';
    echo '</a>';
}

/* 5. Automatic Page Setup (Auto-fix for 404s) */
function nexoz_auto_create_pages() {
    $pages = array(
        'service-audit'      => array('title' => 'Аудит финансовой деятельности', 'template' => 'service-audit.php'),
        'service-restore'    => array('title' => 'Восстановление финансового учета', 'template' => 'service-restore.php'),
        'service-legal'      => array('title' => 'Юридические консультации', 'template' => 'service-legal.php'),
        'service-accounting'   => array('title' => 'Ведение финансового учета', 'template' => 'service-accounting.php'),
        'service-secretariat' => array('title' => 'Услуги секретариата', 'template' => 'service-secretariat.php'),
        'service-consulting'  => array('title' => 'Бизнес-консультации', 'template' => 'service-consulting.php'),
        'service-tax'         => array('title' => 'Налоговые консультации', 'template' => 'service-tax.php'),
        'service-management'  => array('title' => 'Управленческий учет', 'template' => 'service-management.php'),
        'service-automation'  => array('title' => 'Автоматизация бизнес-процессов', 'template' => 'service-automation.php'),
        'about'               => array('title' => 'О компании', 'template' => 'page-about.php'),
        'services'            => array('title' => 'Наши услуги', 'template' => 'page-services.php'),
        'contacts'            => array('title' => 'Контакты', 'template' => 'page-contacts.php'),
        'vacancies'           => array('title' => 'Вакансии', 'template' => 'page-vacancies.php'),
        'vacancies-tj'        => array('title' => 'Ҷойҳои корӣ', 'template' => 'page-vacancies-tj.php'),
        'vacancies-en'        => array('title' => 'Vacancies', 'template' => 'page-vacancies-en.php'),
        'news'                => array('title' => 'Новости', 'template' => 'page-news.php'),
        'news-tj'             => array('title' => 'Ахбор', 'template' => 'page-news-tj.php'),
        'news-en'             => array('title' => 'News', 'template' => 'page-news-en.php'),
        'about-tj'            => array('title' => 'Дар бораи мо', 'template' => 'page-about-tj.php'),
        'about-en'            => array('title' => 'About Us', 'template' => 'page-about-en.php'),
        'services-tj'         => array('title' => 'Хидматрасониҳо', 'template' => 'page-services-tj.php'),
        'services-en'         => array('title' => 'Services', 'template' => 'page-services-en.php'),
        'contacts-tj'         => array('title' => 'Тамос', 'template' => 'page-contacts-tj.php'),
        'contacts-en'         => array('title' => 'Contacts', 'template' => 'page-contacts-en.php'),
        'team'                => array('title' => 'Команда', 'template' => 'page-team.php'),
        'team-tj'             => array('title' => 'Дастаи мо', 'template' => 'page-team-tj.php'),
        'team-en'             => array('title' => 'Our Team', 'template' => 'page-team-en.php'),
        'privacy-policy'      => array('title' => 'Политика конфиденциальности', 'template' => 'page-privacy.php'),
        'privacy-policy-tj'   => array('title' => 'Сиёсати махфият', 'template' => 'page-privacy-tj.php'),
        'privacy-policy-en'   => array('title' => 'Privacy Policy', 'template' => 'page-privacy-en.php'),
        'terms'               => array('title' => 'Условия использования', 'template' => 'page-terms.php'),
        'terms-tj'            => array('title' => 'Шартҳои истифода', 'template' => 'page-terms-tj.php'),
        'terms-en'            => array('title' => 'Terms of Use', 'template' => 'page-terms-en.php'),
        
        // Tajik Services
        'service-audit-tj'    => array('title' => 'Аудити фаъолияти молиявӣ', 'template' => 'service-audit-tj.php'),
        'service-restore-tj'  => array('title' => 'Барқарорсозии баҳисобгирии молиявӣ', 'template' => 'service-restore-tj.php'),
        'service-legal-tj'    => array('title' => 'Дастгирии ҳуқуқӣ', 'template' => 'service-legal-tj.php'),
        'service-accounting-tj' => array('title' => 'Пешбурди баҳисобгирии молиявӣ ва кадрӣ', 'template' => 'service-accounting-tj.php'),
        'service-secretariat-tj' => array('title' => 'Хидматрасониҳои секретариат', 'template' => 'service-secretariat-tj.php'),
        'service-consulting-tj' => array('title' => 'Машваратҳои тиҷоратӣ', 'template' => 'service-consulting-tj.php'),
        'service-tax-tj'      => array('title' => 'Машваратҳои андозӣ', 'template' => 'service-tax-tj.php'),
        'service-management-tj' => array('title' => 'Баҳисобгирии идоракунӣ', 'template' => 'service-management-tj.php'),
        'service-automation-tj' => array('title' => 'Автоматикунонии равандҳои тиҷоратӣ', 'template' => 'service-automation-tj.php'),
        'service-planning-tj' => array('title' => 'Бақайдгирии тиҷорат', 'template' => 'service-planning-tj.php'), 
        
        // English Services
        'service-audit-en'    => array('title' => 'Financial Audit', 'template' => 'service-audit-en.php'),
        'service-restore-en'  => array('title' => 'Accounting Restoration', 'template' => 'service-restore-en.php'),
        'service-legal-en'    => array('title' => 'Legal Consultations', 'template' => 'service-legal-en.php'),
        'service-accounting-en' => array('title' => 'Financial & HR Accounting', 'template' => 'service-accounting-en.php'),
        'service-secretariat-en' => array('title' => 'Secretariat Services', 'template' => 'service-secretariat-en.php'),
        'service-consulting-en' => array('title' => 'Business Consulting', 'template' => 'service-consulting-en.php'),
        'service-tax-en'      => array('title' => 'Tax Consultations', 'template' => 'service-tax-en.php'),
        'service-management-en' => array('title' => 'Management Accounting', 'template' => 'service-management-en.php'),
        'service-automation-en' => array('title' => 'Business Automation', 'template' => 'service-automation-en.php'),
        'service-planning-en' => array('title' => 'Business Planning', 'template' => 'service-planning-en.php'),
        'service-business-plan' => array('title' => 'Разработка бизнес-планов и ТЭО', 'template' => 'service-business-plan.php'),
        'service-business-plan-tj' => array('title' => 'Таҳияи бизнес-план ва АТЭ', 'template' => 'service-business-plan-tj.php'),
        'service-business-plan-en' => array('title' => 'Business Planning & FS', 'template' => 'service-business-plan-en.php'),
    );

    $created_any = false;
    foreach ($pages as $slug => $data) {
        $page_check = get_page_by_path($slug);
        if (!isset($page_check->ID)) {
            $page_id = wp_insert_post(array(
                'post_type'   => 'page',
                'post_title'  => $data['title'],
                'post_name'   => $slug,
                'post_status' => 'publish',
                'post_author' => 1,
            ));
            if ($page_id) {
                update_post_meta($page_id, '_wp_page_template', $data['template']);
                $created_any = true;
            }
        } else {
            // Ensure template is correct even if page exists
            update_post_meta($page_check->ID, '_wp_page_template', $data['template']);
        }
    }
    
    if ($created_any || !get_option('nk_flush_v4')) {
        flush_rewrite_rules();
        update_option('nk_flush_v4', true);
    }

    // Auto-create Category 'tj'
    if (!get_category_by_slug('tj')) {
        wp_insert_term('Тоҷикӣ', 'category', array('slug' => 'tj'));
    }
    if (!get_category_by_slug('en')) {
        wp_insert_term('English', 'category', array('slug' => 'en'));
    }

    // Auto-create news posts for links to work
    $posts_to_ensure = [
        ['title' => 'Тағйирот дар ҳисоби андоз аз амвол ва замин', 'cat' => 'tj'],
        ['title' => 'Равандҳои муфлисшавӣ ва барҳамдиҳии корхонаҳо', 'cat' => 'tj'],
        ['title' => 'Натиҷаҳои ҳамоиши иқтисодӣ дар Душанбе', 'cat' => 'tj'],
        ['title' => 'ФАЪОЛИЯТИ АУТСОРСИНГӢ', 'cat' => 'tj'],
        ['title' => 'Изменения в расчете налога на имущество и землю', 'cat' => ''],
        ['title' => 'Процедуры банкротства и ликвидации предприятий', 'cat' => ''],
        ['title' => 'Итоги экономического форума в Душанбе', 'cat' => ''],
        ['title' => 'АУТСОРСИНГОВАЯ ДЕЯТЕЛЬНОСТЬ', 'cat' => ''],
        ['title' => 'Changes in Property and Land Tax Calculation', 'cat' => 'en'],
        ['title' => 'Bankruptcy and Corporate Liquidation Procedures', 'cat' => 'en'],
        ['title' => 'Outcomes of the Economic Forum in Dushanbe', 'cat' => 'en'],
        ['title' => 'OUTSOURCING ACTIVITY', 'cat' => 'en']
    ];

    foreach ($posts_to_ensure as $p) {
        if (!get_page_by_title($p['title'], OBJECT, 'post')) {
            $post_content = 'Ин маводи хабарӣ ба таври худкор барои низоми сезабона сохта шудааст.';
            
            // Handle specific content for Outsourcing Post (Full Text)
            if (stripos($p['title'], 'АУТСОРСИНГОВАЯ ДЕЯТЕЛЬНОСТЬ') !== false) {
                $post_content = 'АУТСОРСИНГОВАЯ ДЕЯТЕЛЬНОСТЬ КАК ИНСТРУМЕНТ ОПТИМИЗАЦИИ ХОЗЯЙСТВЕННОЙ ДЕЯТЕЛЬНОСТИ ПРЕДПРИЯТИЙ В УСЛОВИЯХ РЫНОЧНОЙ ЭКОНОМИКИ. <br><br>Современная модель экономической деятельности и выход на более прогрессивную эволюционную ступень развития требует от Республики Таджикистан принятия важных мер в области имплементации новых стратегически обдуманных инструментов управления хозяйственной деятельности отечественных предприятий. Стоит признать тот факт, что представители отечественных бизнес структур на сегодняшний день сталкиваются с явлениями, находящимися вне зоны контроля этих самых предприятий и деструктивное влияние которых отрицательно сказывается на их прагматичном векторе развития. <br><br>Отсутствие знаний в некоторых областях со стороны менеджмента предприятий заставляют последних содержать персонал, который непосредственно участвует в бизнес-процессе. Под данным персоналом мы позиционируем сотрудников по введению финансового и хозяйственного учета предприятий, ведь ни для кого не секрет, что введение хозяйственного учета требует определенных знаний, которыми в большинстве случаев не владеют собственники бизнеса. Ссылаясь на закономерность эмпирического опыта видно, что базовыми навыками необходимыми для реализации бизнес инициатив являются – знание самого производственного процесса и навыки продаж, т.к. в отсутствие озвученных знаний достижение предпринимательских целей сложно реализуема. <br><br>Введение учета признается обременительным составляющим даже при владении данными навыками. Данные тезис опирается на необоснованность распределения временных ресурсов, ведь основная задача малых и средних предприятий, в особенности в начале их формирования заключается в поддержании темпов ускоренного товарооборота и генерировании денежных средств. <br><br>Таким образом, хотелось бы подчеркнуть, что в странах с развитой экономикой, где единица временных ресурсов имеет достаточно высокую цену, предприятиями активно используются достижения такого инструмента как консалтинга «аутсорсинг». Аутсорсинг представляет собой элемент использования привлеченных или (наемных) ресурсов, включая человеческих (персонал). На сегодняшний день спектр реализации услуг аутсорсинга, как одного из элементов бизнес-услуг, разнообразен, начиная от услуг технического персонала до услуг маркетинговой индустрии. <br><br>При использовании аутсорсинга организация на базе двухстороннего соглашения передает определённый вид услуг или функции производственной предпринимательской деятельности другой компании. В сравнении с традиционным видом услуг, который основывается на разовой, или эпизодической плоскости, а также имеющий ограниченный временной диапазон, при аутсорсинге передаются функции по профессиональной поддержке бесперебойной работы отдельных подразделений в рамках долгосрочного соглашения. <br><br>Значительная часть экономистов признает, что использование аутсорсинга в области введения бухгалтерского учета является рациональным для малых и средних предприятий, которые не могут позволить себе штат сотрудников в этой области и, приоритетная задача которых заключается в управлении самим бизнес-процессом, а не погружением в процесс ведения отчетности. Согласно данным аналитического ресурса «STATISTA» в 2019 году мировой рынок аутсорсинга составил 92,5 млрд. долл. США. <br><br>Дополнительно к рациональному использованию времени, снижение некоторых расходов, в частности налогов и накладных расходов, является причиной, ссылаясь на которую, предприятия используют данный инструмент рынка. Аутсорсинг в области управления бизнесом, введение бухгалтерского учета и ИТ признаются самыми востребованными видами услуг аутсорсинга во всем мире. За последние три десятилетия аутсорсинг стал неотъемлемой частью управления бизнесом. В 2020 году он полностью обогнал некоторые крупнейшие отрасли в мире. <br><br>Около 24% малых предприятий используют аутсорсинг для повышения эффективности всей работы. Данная система помогает сэкономить деньги владельцам малого бизнеса, а также позаботиться о результате всей работы в целом. Чаще всего предприятия обращаются, когда дело доходит до бухгалтерского учета и ИТ. Почти 54% всех компаний мира пользуются услугами аутсорсинга, такая система работы дает возможность больше сосредоточиться на прибыли и бизнесе в целом. <br><br>Что касается Республики Таджикистан, то здесь, к сожалению, отсутствует какая-либо статистика относительного рынка аутсорсинга. Было проведено исследование относительно основных видов аутсорсинга востребованных в нашей стране. Таким образом, 31,1% компаний, предоставляют аутсорсинг по налогам и бухгалтерскому учету, что является вполне обоснованным явлением. <br><br>Целесообразность использования инструмента «аутсорсинг» заключается в его приемлемости и практичности в дополнении в стремлении снизить финансовые издержки на содержание штата. Использование исследуемого инструмента существенно снижает дополнительные издержки на содержание сотрудника с опытом, т.к. на практике такие сотрудники обременяют фонд оплаты труда предприятия. <br><br>Одним из лидеров рынка в области предоставления услуг аутсорсинга, специализирующихся на бухгалтерском учете и налогообложении, является компания ООО «НЕКСОЗ бизнес консалтинг групп». Компания была основана в 2016 году усилиями Салимова Зоира, имеющего богатый опыт в банковской и налоговой системах, а также в сфере аудиторской деятельности. <br><br>ООО «НЕКСОЗ бизнес консалтинг групп» вносит существенный вклад в развитии предприятий путем введения финансовой отчетности, проведением аудита, работой с проверяющими органами. Если вы владелец бизнеса или руководитель НПО и намерены оптимизировать процесс функционирования хозяйственной деятельности, компания ООО «НЕКСОЗ бизнес консалтинг групп» готова выполнить возложенные обязательства на профессиональном уровне.';
            } elseif (stripos($p['title'], 'ФАЪОЛИЯТИ АУТСОРСИНГӢ') !== false) {
                $post_content = 'ФАЪОЛИЯТИ АУТСОРСИНГӢ ҲАМЧУН ВОСИТАИ ОПТИМИЗАТСИЯИ ФАЪОЛИЯТИ ХОҶАГИДОРИИ КОРХОНАҲО ДАР ШАРОИТИ ИҚТИСОДИ БОЗОРӢ. <br><br>Модели муосири фаъолияти иқтисодӣ ва гузариш ба зинаи пешрафтаи эволютсионии рушд аз Ҷумҳурии Тоҷикистон андешидани чораҳои муҳимро дар самти татбиқи воситаҳои нави стратегии идоракунии фаъолияти хоҷагидории корхонаҳои ватанӣ талаб мекунад. <br><br>Набудани дониш дар баъзе соҳаҳо аз ҷониби менеҷменти корхонаҳо онҳоро водор мекунад, ки кормандони зиёдеро нигоҳ доранд. Аутсорсинг имкон медиҳад, ки функсияҳои дастгирии касбӣ дар доираи созишномаи дарозмуддат ба ширкати дигар супорида шаванд. Истифодаи аутсорсинг дар соҳаи баҳисобгирии муҳосибӣ барои корхонаҳои хурду миёна оқилона эътироф шудааст. <br><br>Ширкати «НЕКСОЗ бизнес консалтинг групп» яке аз пешвоёни бозор дар соҳаи хизматрасонии аутсорсинг мебошад. Ширкат соли 2016 аз ҷониби Салимов Зоир таъсис ёфта, дорои таҷрибаи бой дар низоми бонкӣ, андоз ва аудит мебошад. <br><br>Агар шумо соҳиби тиҷорат бошед ва ният доред, ки раванди фаъолияти хоҷагидории худро оптимизатсия кунед, ширкати «НЕКСОЗ» омода аст, ки уҳдадориҳои худро дар сатҳи касбӣ иҷро намояд.';
            } elseif (stripos($p['title'], 'OUTSOURCING ACTIVITY') !== false) {
                $post_content = 'OUTSOURCING ACTIVITY AS A TOOL FOR OPTIMIZING THE ECONOMIC ACTIVITIES OF ENTERPRISES IN A MARKET ECONOMY. <br><br>The modern model of economic activity and the transition to a more progressive evolutionary stage of development requires the Republic of Tajikistan to take important measures in the implementation of new strategically thought-out tools for managing the economic activities of domestic enterprises. <br><br>Outsourcing represents an element of using attracted or (hired) resources, including human resources (personnel). Today, the range of outsourcing services is diverse, starting from technical personnel services to the marketing industry. When using outsourcing, an organization transfers a certain type of services or functions to another company based on a bilateral agreement. <br><br>NEKSOZ Business Consulting Group is a dynamically developing company with positive experience and sufficient knowledge in areas necessary for domestic business. The company was founded in 2016 by Zoir Salimov, who had experience in various economic sectors such as the banking and tax systems, as well as auditing. <br><br>If you are a business owner or head of an NGO and intend to reach high results by optimizing the functioning of economic activity, NEKSOZ BCG is ready to perform its obligations at a professional level.';
            }

            $pid = wp_insert_post(array(
                'post_title' => $p['title'],
                'post_content' => $post_content,
                'post_status' => 'publish',
                'post_type' => 'post'
            ));
            if ($pid && $p['cat'] != '') {
                $cid = get_category_by_slug($p['cat']);
                if ($cid) wp_set_post_categories($pid, array($cid->term_id));
            }
        }
    }
}
add_action('init', 'nexoz_auto_create_pages');

function nk_get_current_lang() {
    if (isset($_GET["lang"])) {
        return sanitize_text_field($_GET["lang"]);
    }
    return "ru"; 
}

function nk_link($path, $lang) {
    if ($path === '/' || $path === '') {
        return home_url('/?lang=' . $lang);
    }
    
    $clean_slug = trim($path, '/');
    // Remove existing lang suffix if any
    $base_slug = preg_replace('/-(tj|en)$/', '', $clean_slug);
    
    $target_slug = $base_slug;
    if ($lang === 'tj') $target_slug .= '-tj';
    elseif ($lang === 'en') $target_slug .= '-en';
    
    return home_url('/' . $target_slug . '/?lang=' . $lang);
}

function nk_get_switcher_link($lang, $current_slug) {
    // Guard: empty slug → homepage
    if (empty($current_slug)) {
        return add_query_arg('lang', $lang, home_url('/'));
    }

    // ── Single post (news/blog) ──────────────────────────────────────────────
    // On single posts the slug contains date paths like "2024/12/post-name"
    // which cannot be language-switched via slug suffix. Send to news archive.
    if (is_singular('post') || strpos($current_slug, '/') !== false) {
        $news_map = array(
            'ru' => 'news',
            'tj' => 'news-tj',
            'en' => 'news-en',
        );
        $archive_slug = isset($news_map[$lang]) ? $news_map[$lang] : 'news';
        return home_url('/' . $archive_slug . '/?lang=' . $lang);
    }

    // ── Single custom post type (nk_service, cases, etc.) ───────────────────
    // These would also have unknown URL structures — fall back to services list
    if (is_singular() && !is_page()) {
        $post_type = get_post_type();
        if ($post_type === 'nk_service' || $post_type === 'cases') {
            $services_map = array(
                'ru' => 'services',
                'tj' => 'services-tj',
                'en' => 'services-en',
            );
            $archive_slug = isset($services_map[$lang]) ? $services_map[$lang] : 'services';
            return home_url('/' . $archive_slug . '/?lang=' . $lang);
        }
        // Generic CPT fallback → homepage
        return add_query_arg('lang', $lang, home_url('/'));
    }

    // ── Standard page slug (most common case) ────────────────────────────────
    $base_slug = preg_replace('/-(tj|en)$/', '', $current_slug);

    $target_slug = $base_slug;
    if ($lang === 'tj') $target_slug .= '-tj';
    elseif ($lang === 'en') $target_slug .= '-en';

    return home_url('/' . $target_slug . '/?lang=' . $lang);
}

/**
 * CONTENT PROTECTION - Guest Mode Only
 * Protects text and assets from easy copying while excluding forms and providing bypass for Admins.
 */
function neksoz_content_protection() {
    if ( is_user_logged_in() ) return; // Bypass for logged-in admins
    ?>
    <style>
        /* CSS Protection */
        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Essential Exclusion: Form fields must remain interactive */
        input, textarea, select, .cta-crystal__field *, button {
            -webkit-user-select: text !important;
            -moz-user-select: text !important;
            -ms-user-select: text !important;
            user-select: text !important;
        }

        /* Image Drag Protection */
        img {
            -webkit-user-drag: none;
            user-drag: none;
            pointer-events: none; /* Disables standard right-click context for images */
        }
    </style>

    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());

        document.addEventListener('keydown', function(e) {
            // Block Ctrl (or Cmd) + C, A, S, U
            if ((e.ctrlKey || e.metaKey) && (e.keyCode === 67 || e.keyCode === 65 || e.keyCode === 83 || e.keyCode === 85)) {
                e.preventDefault();
                return false;
            }
            // Block F12
            if (e.keyCode === 123) {
                e.preventDefault();
                return false;
            }
            // Block Ctrl+Shift+I / J / C
            if (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74 || e.keyCode === 67)) {
                e.preventDefault();
                return false;
            }
        });

        // Prevent dragging on all images via JS as fallback
        window.addEventListener('load', function() {
            document.querySelectorAll('img').forEach(img => {
                img.setAttribute('draggable', 'false');
            });
        });
    </script>
    <?php
}
// add_action('wp_head', 'neksoz_content_protection', 99);

/**
 * DYNAMIC ENGINE - Polylang & Menu Registration
 */
function neksoz_dynamic_init() {
    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu (Header)', 'neksoz'),
        'footer'  => __('Footer Menu', 'neksoz'),
        'legal'   => __('Legal Menu (Footer)', 'neksoz')
    ));

    // Register Polylang Strings for UI elements
    if (function_exists('pll_register_string')) {
        pll_register_string('Neksoz Badge', 'PREMIUM CONSULTING', 'Neksoz UI');
        pll_register_string('Neksoz Badge 2', 'Neksoz Academy', 'Neksoz UI');
        pll_register_string('Neksoz CTA', 'Связаться с нами', 'Neksoz UI');
        pll_register_string('Neksoz Form Title', 'Оставьте заявку', 'Neksoz UI');
        pll_register_string('Neksoz Contact Phone', '+992 44 600 00 00', 'Neksoz Global');
        pll_register_string('Neksoz Contact Email', 'info@webistan.tj', 'Neksoz Global');
        pll_register_string('Neksoz Contact Address', 'Rudaki Ave 42, Dushanbe', 'Neksoz Global');
        pll_register_string('Neksoz Legal Rights', 'Все права защищены.', 'Neksoz Footer');
    }
}
add_action('init', 'neksoz_dynamic_init');

/**
 * 5. PERFORMANCE: Defer Non-Critical Scripts
 */
function neksoz_optimize_scripts($tag, $handle) {
    if (is_admin()) return $tag;
    if (in_array($handle, array('nexoz-main-js', 'jquery-core', 'tailwind'))) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'neksoz_optimize_scripts', 10, 2);

/**
 * 6. SECURITY: AJAX Lead Handler with Honeypot
 */
function neksoz_ajax_lead_handler() {
    // 1. Nonce Check
    check_ajax_referer('neksoz_nonce', 'nonce');

    // 2. Honeypot check (nk_hp) - If filled, it's a bot
    if (!empty($_POST['nk_hp'])) {
        wp_send_json_error('Spam detected.');
    }

    // 3. Sanitize Data
    $name    = sanitize_text_field($_POST['name']);
    $phone   = sanitize_text_field($_POST['phone']);
    $service = sanitize_text_field($_POST['service']);
    $message = sanitize_textarea_field($_POST['message']);

    // 4. Send Email
    $to = get_option('admin_email');
    $subject = 'Новая заявка: ' . $service;
    $body = "Имя: $name\nТелефон: $phone\nУслуга: $service\nСообщение: $message";
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    if (wp_mail($to, $subject, $body, $headers)) {
        wp_send_json_success('Спасибо! Ваша заявка отправлена.');
    } else {
        wp_send_json_error('Ошибка при отправке.');
    }
}
add_action('wp_ajax_send_lead', 'neksoz_ajax_lead_handler');
add_action('wp_ajax_nopriv_send_lead', 'neksoz_ajax_lead_handler');
