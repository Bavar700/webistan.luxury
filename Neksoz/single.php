<?php
/**
 * Ultimate Single Post Template — Neksoz.Luxury
 * Self-contained for maximum compatibility with live servers.
 */

get_header();

if (have_posts()) : while (have_posts()) : the_post();

    // 1. Language Detection
    $current_lang = 'ru';
    if (isset($_GET['lang'])) {
        $current_lang = sanitize_text_field($_GET['lang']);
    } else {
        $post_id = get_the_ID();
        if (has_term('tj', 'category', $post_id)) $current_lang = 'tj';
        elseif (has_term('en', 'category', $post_id)) $current_lang = 'en';
    }

    // 2. Translation Map
    $lang_data = [
        'ru' => [
            'tag' => 'МАТЕРИАЛ',
            'news_link_text' => 'Ко всем новостям',
            'news_base_url' => '/news?lang=ru',
            'expert_help_title' => 'Нужна помощь эксперта?',
            'expert_help_text' => 'Наши специалисты готовы ответить на ваши вопросы в области аудита и права.',
            'expert_help_btn' => 'Связаться с нами',
            'expert_help_url' => '/contacts?lang=ru',
            'other_posts_title' => 'Другие публикации',
            'disclaimer_match' => 'Ин маводи хабарӣ ба таври худкор барои низоми сезабона сохта шудааст.',
            'disclaimer_replace' => 'Мы предлагаем профессиональные аудиторские и юридические услуги для роста вашего бизнеса.',
        ],
        'tj' => [
            'tag' => 'МАВОД',
            'news_link_text' => 'Ба ҳама хабарҳо',
            'news_base_url' => '/news-tj',
            'expert_help_title' => 'Ёрии коршинос лозим аст?',
            'expert_help_text' => 'Мутахассисони мо омодаанд ба саволҳои шумо дар соҳаи аудит ва ҳуқуқ ҷавоб диҳанд.',
            'expert_help_btn' => 'Бо мо тамос гиред',
            'expert_help_url' => '/contacts-tj',
            'other_posts_title' => 'Дигар нашрияҳо',
            'disclaimer_match' => 'Ин маводи хабарӣ ба таври худкор барои низоми сезабона сохта шудааст.',
            'disclaimer_replace' => 'Мо хидматҳои касбии аудиторӣ ва ҳуқуқиро барои рушди тиҷорати шумо пешниҳод менамоем.',
        ],
        'en' => [
            'tag' => 'ARTICLE',
            'news_link_text' => 'Back to News',
            'news_base_url' => '/news-en',
            'expert_help_title' => 'Need Expert Advice?',
            'expert_help_text' => 'Our specialists are ready to answer your questions in the field of audit and law.',
            'expert_help_btn' => 'Contact Us',
            'expert_help_url' => '/contacts-en',
            'other_posts_title' => 'Other Publications',
            'disclaimer_match' => 'Ин маводи хабарӣ ба таври худкор барои низоми сезабона сохта шудааст.',
            'disclaimer_replace' => 'We offer professional auditing and legal services for the growth of your business.',
        ]
    ];

    $d = $lang_data[$current_lang];

    $display_title = neksoz_clean_title_case(get_the_title());

    // 4. Specific Formatting Rules
    $wrap_map = [
        'Тағйирот дар ҳисоби андоз аз амвол ва замин' => 'Тағйирот дар ҳисоби андоз <br> аз амвол ва замин',
        'Натиҷаҳои ҳамоиши иқтисодӣ дар Душанбе' => 'Натиҷаҳои ҳамоиши иқтисодӣ <br> дар Душанбе',
        'Итоги экономического форума в Душанбе' => 'Итоги экономического <br> форума в Душанбе',
        'Bankruptcy and Corporate Liquidation Procedures' => 'Bankruptcy and Corporate <br> Liquidation Procedures',
        'Outcomes of the Economic Forum in Dushanbe' => 'Outcomes of the Economic <br> Forum in Dushanbe',
        'Изменения в расчете налога на имущество и землю' => 'Изменения в расчете <br> налога на имущество и землю',
        'Changes in Property and Land Tax Calculation' => 'Changes in Property <br> and Land Tax Calculation'
    ];

    if (isset($wrap_map[$display_title])) {
        $display_title = $wrap_map[$display_title];
    }

    // Remove period for Outsourcing titles
    if (stripos($display_title, 'Аутсорсинг') !== false || stripos($display_title, 'Outsourcing') !== false || stripos($display_title, 'Фаъолияти') !== false) {
        $display_title = rtrim($display_title, '.');
    }
?>

<main id="primary" class="site-main">

<!-- ═══════════ CINEMATIC POST HERO ═══════════ -->
<section class="hero hero--internal" style="min-height: 55vh; display: flex; align-items: center; padding: 70px 0 130px;">
    <div class="hero__geo"></div>
    <div class="hero__grid-pattern"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>

    <div class="container hero__container" style="position:relative;z-index:2;">
        <div class="hero__content" style="max-width: 1000px;">
            <div class="hero-status-tag">
                <span class="lip-lip-dot"></span>
                <?php echo $d['tag']; ?>
            </div>
            <h1 class="hero__title" style="line-height: 1.2; margin-bottom: 30px; font-weight: 900; color: #000; font-size: <?php echo (mb_strlen($display_title) > 60) ? 'clamp(1.5rem, 3vw, 2.1rem)' : 'clamp(2rem, 4vw, 3rem)'; ?>;">
                <span><?php echo $display_title; ?></span>
            </h1>
            <div style="color: var(--nk-gray-400); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; display: flex; align-items: center; gap: 20px;">
                <span style="border-bottom: 2px solid var(--nk-red); padding-bottom: 4px; color: #a0a0a0;">
                    <?php echo rtrim(get_the_date('j F, Y'), '.'); ?>
                </span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ POST CONTENT ═══════════ -->
<section class="section section--gray" style="padding-top: 100px; padding-bottom: 120px;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 340px; gap: 70px; align-items: start;">
            
            <div>
                <article class="service-card" style="padding: 60px; border-radius: 32px; border: 1px solid rgba(0,0,0,0.03); background: #ffffff;">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div style="margin-bottom: 50px; border-radius: 20px; overflow: hidden; box-shadow: 0 30px 70px rgba(0,0,0,0.08);">
                            <?php the_post_thumbnail('full', ['style' => 'width: 100%; height: auto; display: block;']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content" style="line-height: 1.95; color: var(--nk-gray-700); font-size: 1.15rem; font-family: var(--font-body); text-align: justify;">
                        <style>
                            .post-content p { text-indent: 40px !important; margin-bottom: 25px !important; }
                        </style>
                        <?php 
                        $content = get_the_content();
                        
                        // RESTORATION LOGIC: If it's the Outsourcing post, unconditionally inject full text (Zero-Drift)
                        $is_outsourcing = (mb_stripos(get_the_title(), 'Outsourcing') !== false || mb_stripos(get_the_title(), 'аутсорсинг') !== false || mb_stripos(get_the_title(), 'Фаъолияти') !== false);
                        if ($is_outsourcing) {
                            if ($current_lang === 'tj') {
                                $content = 'ФАЪОЛИЯТИ АУТСОРСИНГӢ ҲАМЧУН ВОСИТАИ БЕҲСОЗИИ ФАЪОЛИЯТИ ХОҶАГИДОРИИ КОРХОНАҲО ДАР ШАРОИТИ ИҚТИСОДИ БОЗОРӢ<br><br>Модели муосири фаъолияти иқтисодӣ ва гузариш ба зинаи пешрафтаи таҳаввулотии рушд аз Ҷумҳурии Тоҷикистон қабули чораҳои муҳимро дар заминаи татбиқи воситаҳои нави роҳбурдии идоракунии фаъолияти хоҷагидории корхонаҳои ватанӣ тақозо мекунад. Бояд эътироф кард, ки намояндагони сохторҳои тиҷоратии ватанӣ имрӯзҳо бо падидаҳое рӯбарӯ мешаванд, ки берун аз доираи назорати ин корхонаҳо қарор дошта, таъсири манфии онҳо ба самти рушди прагматикии онҳо халал мерасонад.<br><br>Набудани дониш дар баъзе соҳаҳо аз ҷониби менеҷменти корхонаҳо онҳоро маҷбур месозад, ки кормандонеро нигоҳ доранд, ки бевосита дар раванди тиҷорат иштирок мекунанд. Зери мафҳуми ин кормандон мо мутахассисони баҳисобгирии молиявӣ ва хоҷагидориро дар назар дорем, зеро пӯшида нест, ки пешбурди баҳисобгирӣ донишҳои махсусро талаб мекунад, ки дар аксар ҳолатҳо моликони тиҷорат дорои онҳо нестанд. Бо такя ба таҷрибаи эмпирикӣ дида мешавад, ки малакаҳои асосӣ барои татбиқи ташаббусҳои тиҷоратӣ — донистани худи раванди истеҳсолот ва малакаҳои фурӯш мебошанд, зеро бидуни ин донишҳо расидан ба ҳадафҳои соҳибкорӣ душвор аст.<br><br>Пешбурди баҳисобгирӣ ҳатто ҳангоми доштани ин малакаҳо ҷузъи гаронбор эътироф мешавад. Ин андеша ба беасос тақсим кардани захираҳои вақт такя мекунад, зеро вазифаи асосии корхонаҳои хурд ва миёна, махсусан дар оғози ташаккули онҳо, нигоҳ доштани суръати гардиши мол ва тавлиди маблағҳои пулӣ мебошад.<br><br>Ҳамин тариқ, мехоҳам таъкид намоям, ки дар кишварҳои дорои иқтисоди пешрафта, ки воҳиди вақт арзиши баланд дорад, корхонаҳо аз дастовардҳои воситае чун консалтинги «аутсорсинг» фаъолона истифода мебаранд. Аутсорсинг ҷузъи истифодаи захираҳои ҷалбшуда (кироя), аз ҷумла захираҳои инсонӣ (кормандон) мебошад. Имрӯзҳо доираи хизматрасониҳои аутсорсингӣ хеле васеъ буда, аз хизмати кормандони техникӣ то соҳаи маркетингро фаро мегирад.<br><br>Ҳангоми истифодаи аутсорсинг, ташкилот дар асоси созишномаи дуҷониба намуди муайяни хизматрасонӣ ё вазифаҳои фаъолияти истеҳсолию соҳибкориро ба ширкати дигар вогузор мекунад. Дар муқоиса бо намуди анъанавии хизматрасонӣ, ки хусусияти якдафъаина ё эпизодӣ дорад, дар аутсорсинг вазифаҳои дастгирии касбии фаъолияти бефосилаи воҳидҳои алоҳида дар доираи созишномаи дарозмуддат супорида мешаванд.<br><br>Қисми зиёди иқтисоддонҳо эътироф мекунанд, ки истифодаи аутсорсинг дар соҳаи баҳисобгирии муҳосибӣ барои корхонаҳои хурд ва миёна, ки наметавонанд штати пурраи кормандонро дар ин соҳа дошта бошанд, оқилона аст. Вазифаи афзалиятноки онҳо идоракунии худи раванди тиҷорат аст, на фурӯ рафтан дар раванди ҳисоботдиҳӣ.<br><br>Тибқи маълумоти манбаи таҳлилии «STATISTA», дар соли 2019 бозори ҷаҳонии аутсорсинг 92,5 млрд доллари ИМА-ро ташкил дод. Илова бар истифодаи оқилонаи вақт, коҳиш додани баъзе хароҷот, аз ҷумла андозҳо ва хароҷоти иловагӣ, сабаби асосии истифодаи ин восита аз ҷониби корхонаҳо мебошад.<br><br>Дар давоми се даҳсолаи охир аутсорсинг ҷузъи ҷудонашавандаи идоракунии тиҷорат гардид. Соли 2020 он аз баъзе соҳаҳои бузургтарини ҷаҳон пеш гузашт. Мувофиқи тадқиқотҳо, 78%-и ширкатҳо дар саросари ҷаҳон ба шарикони аутсорсингии худ назари мусбат доранд. 83%-и ширкатҳо ва муассисаҳои молиявӣ як қатор вазифаҳоро ба ширкатҳои дигар вогузор мекунанд ё нақшаи вогузор карданро доранд. Тақрибан 24%-и корхонаҳои хурд барои баланд бардоштани самаранокии кор аз аутсорсинг истифода мебаранд. Қариб 54%-и тамоми ширкатҳои ҷаҳон аз хизматрасониҳои аутсорсингӣ баҳра мебаранд.<br><br>Дар мавриди Ҷумҳурии Тоҷикистон, мутаассифона, ягон омори дақиқ дар бораи бозори аутсорсинг мавҷуд нест. Бо вуҷуди ин, 31,1%-и ширкатҳо дар соҳаи андоз ва баҳисобгирии муҳосибӣ хизматрасонии аутсорсингӣ пешниҳод мекунанд, ки ин падидаи комилан асоснок аст.<br><br>Мақсаднокии истифодаи воситаи «аутсорсинг» дар қобили қабул ва амалӣ будани он дар талош барои коҳиш додани хароҷоти молиявӣ ба нигоҳдории штат ифода меёбад. Истифодаи ин восита хароҷоти иловагиро барои нигоҳдории корманди ботаҷриба ба таври назаррас коҳиш медиҳад. Мувофиқи натиҷаҳои тадқиқоти диссертатсионӣ, истифодаи консалтинг ва аутсорсинг натиҷаҳои зеринро дод: коҳиши хароҷоти амалиётӣ ба 6,7%, маъмурӣ — ба 3,0%, коҳиши вақт барои омодасозии ҳисоботҳо ба 6,7% ва рушди маҳсулнокӣ ба 24,7%.<br><br>Дар бозори Тоҷикистон ширкати ҶДММ «НЕКСОЗ бизнес консалтинг групп» фаъолият мекунад — ширкати босуръат рушдёбанда, ки ба баҳисобгирии муҳосибӣ ва андозбандӣ тахассус дорад. Ширкат соли 2016 бо кӯшишҳои Салимов Зоир, ки дар системаҳои бонкию андозӣ ва соҳаи аудит таҷриба дорад, таъсис ёфтааст.<br><br>Ширкат ба таҷрибаи кормандони худ, кори дастаҷамъона ва кумаки мутақобила такя мекунад. Бо шарофати муносибати чандир дар кор, ширкат бо корхонаҳои соҳаҳои мухталиф ҳамкорӣ менамояд. ҶДММ «НЕКСОЗ бизнес консалтинг групп» бо пешбурди ҳисоботи молиявӣ, гузаронидани аудит ва кор бо мақомоти санҷишӣ дар рушди корхонаҳо саҳми арзанда мегузорад.<br><br>Агар Шумо молики тиҷорат ё роҳбари ТҶҒ бошед ва ният доред раванди фаъолияти хоҷагидориро беҳтар созед, ширкати ҶДММ «НЕКСОЗ бизнес консалтинг групп» омода аст уҳдадориҳои вогузоршударо дар сатҳи касбӣ иҷро намояд. Рисолати ширкат — мусоидат дар беҳсозии равандҳои тиҷоратӣ ва расидан ба муваффақиятҳои шарикони мо мебошад.';
                            } elseif ($current_lang === 'en') {
                                $content = 'OUTSOURCING ACTIVITY AS A TOOL FOR OPTIMIZING THE ECONOMIC OPERATIONS OF ENTERPRISES IN A MARKET ECONOMY<br><br>The modern model of economic activity and the transition to a more progressive evolutionary stage of development require the Republic of Tajikistan to take significant measures in implementing new strategically considered management tools for the economic activities of domestic enterprises. It must be acknowledged that representatives of domestic business structures today face phenomena beyond their control, the destructive influence of which negatively affects their pragmatic vector of development.<br><br>The lack of specialized knowledge among enterprise management forces them to maintain staff directly involved in support business processes. By this staff, we mean employees responsible for financial and economic accounting, as it is no secret that accounting requires specific expertise that business owners often do not possess. Referring to empirical experience, the core skills necessary for implementing business initiatives are knowledge of the production process itself and sales skills; without these, achieving entrepreneurial goals is difficult to realize.<br><br>Maintaining accounting is recognized as a burdensome component even when possessing these skills. This thesis is based on the inefficiency of time resource allocation, as the primary task of small and medium-sized enterprises (SMEs), especially during their initial formation, is to maintain rapid turnover and generate cash flow.<br><br>Thus, it should be emphasized that in developed economies, where a unit of time has a high value, enterprises actively utilize the advantages of "outsourcing" consulting. Outsourcing represents the use of external or hired resources, including human resources (staff). Today, the spectrum of outsourcing services as an element of business services is diverse, ranging from technical personnel to the marketing industry.<br><br>When using outsourcing, an organization, based on a bilateral agreement, transfers a specific type of service or function of production/entrepreneurial activity to another company. Compared to traditional services based on a one-time or episodic basis with a limited timeframe, outsourcing involves transferring professional support functions for the uninterrupted operation of individual departments under a long-term agreement.<br><br>A significant number of economists agree that using outsourcing for accounting is rational for small and medium enterprises that cannot afford a full staff in this field and whose priority is managing the business process itself rather than being immersed in reporting.<br><br>According to data from the "STATISTA" analytical resource, the global outsourcing market in 2019 amounted to 92.5 billion USD. In addition to rational time management, reducing certain costs—specifically taxes and overheads—is a primary reason why enterprises utilize this market tool.<br><br>Over the past three decades, outsourcing has become an integral part of business management. In 2020, it completely overtook some of the largest industries in the world. Research shows that 78% of companies worldwide feel positive about their outsourcing partners. 83% of financial companies and institutions outsource or plan to outsource a range of functions. About 24% of small businesses use outsourcing to improve overall operational efficiency. Nearly 54% of all companies globally use outsourcing services.<br><br>As for the Republic of Tajikistan, unfortunately, there is a lack of specific statistics regarding the local outsourcing market. However, 31.1% of companies provide tax and accounting outsourcing, which is a well-founded phenomenon.<br><br>The expediency of using outsourcing lies in its acceptability and practicality in the quest to reduce financial costs for maintaining staff. Using this tool significantly reduces additional costs for maintaining experienced employees. According to dissertation research results, the use of consulting and outsourcing yielded the following results: a 6.7% reduction in operating costs, a 3.0% reduction in administrative costs, a 6.7% reduction in report preparation time, and a 24.7% increase in productivity.<br><br>Operating in the Tajik market is "NEKSOZ Business Consulting Group" LLC—a dynamically developing company specializing in accounting and taxation. The company was founded in 2016 through the efforts of Zoir Salimov, who has extensive experience in the banking and tax systems, as well as in auditing.<br><br>The company relies on the expertise of its employees, teamwork, and mutual support. Thanks to a flexible approach, the company collaborates with enterprises across various industries. "NEKSOZ Business Consulting Group" LLC makes a significant contribution to the development of enterprises by handling financial reporting, conducting audits, and interacting with regulatory authorities.<br><br>If you are a business owner or an NGO leader and intend to optimize your economic operations, "NEKSOZ Business Consulting Group" LLC is ready to undertake and professionally fulfill these obligations. The company\'s mission is to assist in optimizing business processes and ensuring the success of our partners.';
                            } else {
                                $content = 'Аутсорсинговая деятельность как инструмент оптимизации хозяйственной деятельности предприятий в условиях рыночной экономики<br><br>Современная модель экономической деятельности и выход на более прогрессивную эволюционную ступень развития требует от Республики Таджикистан принятия важных мер в области имплементации новых стратегически обдуманных инструментов управления хозяйственной деятельности отечественных предприятий. Стоит признать тот факт, что представители отечественных бизнес структур на сегодняшний день сталкиваются с явлениями, находящимися вне зоны контроля этих самых предприятий и деструктивное влияние которых отрицательно сказывается на их прагматичном векторе развития.<br><br>Отсутствие знаний в некоторых областях со стороны менеджмента предприятий заставляют последних содержать персонал, который непосредственно участвует в бизнес-процессе. Под данным персоналом мы позиционируем сотрудников по введению финансового и хозяйственного учета предприятий, ведь ни для кого не секрет, что введение хозяйственного учета требует определенных знаний, которыми в большинстве случаев не владеют собственники бизнеса. Ссылаясь на закономерность эмпирического опыта видно, что базовыми навыками необходимыми для реализации бизнес инициатив являются – знание самого производственного процесса и навыки продаж, т.к. в отсутствие озвученных знаний достижение предпринимательских целей сложно реализуема.<br><br>Введение учета признается обременительным составляющим даже при владении данными навыками. Данные тезис опирается на необоснованность распределения временных ресурсов, ведь основная задача малых и средних предприятий, в особенности в начале их формирования заключается в поддержании темпов ускоренного товарооборота и генерировании денежных средств.<br><br>Таким образом, хотелось бы подчеркнуть, что в странах с развитой экономикой, где единица временных ресурсов имеет достаточно высокую цену, предприятиями активно используются достижения такого инструмента как консалтинга «аутсорсинг». Аутсорсинг представляет собой элемент использования привлеченных или (наемных) ресурсов, включая человеческих (персонал). На сегодняшний день спектр реализации услуг аутсорсинга, как одного из элементов бизнес-услуг, разнообразен, начиная от услуг технического персонала до услуг маркетинговой индустрии.<br><br>При использовании аутсорсинга организация на базе двухстороннего соглашения передает определённый вид услуг или функции производственной предпринимательской деятельности другой компании. В сравнении с традиционным видом услуг, который основывается на разовой, или эпизодической плоскости, а также имеющий ограниченный временной диапазон, при аутсорсинге передаются функции по профессиональной поддержке бесперебойной работы отдельных подразделений в рамках долгосрочного соглашения.<br><br>Значительная часть экономистов признает, что использование аутсорсинга в области введения бухгалтерского учета является рациональным для малых и средних предприятий, которые не могут позволить себе штат сотрудников в этой области и, приоритетная задача которых заключается в управлении самим бизнес-процессом, а не погружением в процесс ведения отчетности.<br><br>Согласно данным аналитического ресурса «STATISTA» в 2019 году мировой рынок аутсорсинга составил 92,5 млрд. долл. США. Дополнительно к рациональному использованию времени, снижение некоторых расходов, в частности налогов и накладных расходов, является причиной, ссылаясь на которую, предприятия используют данный инструмент рынка.<br><br>За последние три десятилетия аутсорсинг стал неотъемлемой частью управления бизнесом. В 2020 году он полностью обогнал некоторые крупнейшие отрасли в мире. По данным исследований 78% компаний во всем мире положительно относятся к своим партнерам по аутсорсингу. 83% финансовых компаний и учреждений передают или планируют передать ряд функций другим компаниям. Около 24% малых предприятий используют аутсорсинг для повышения эффективности всей работы. Почти 54% всех компаний мира пользуются услугами аутсорсинга.<br><br>Что касается Республики Таджикистан, то здесь, к сожалению, отсутствует какая-либо статистика относительного рынка аутсорсинга. Таким образом, 31,1% компаний предоставляют аутсорсинг по налогам и бухгалтерскому учету, что является вполне обоснованным явлением.<br><br>Целесообразность использования инструмента «аутсорсинг» заключается в его приемлемости и практичности в стремлении снизить финансовые издержки на содержание штата. Использование данного инструмента существенно снижает дополнительные издержки на содержание сотрудника с опытом. Согласно результатам диссертационного исследования, использование консалтинг и аутсорсинга дало следующие результаты: снижение операционных затрат на 6,7%, административных — на 3,0%, снижение времени на подготовку отчетов на 6,7%, рост продуктивности на 24,7%.<br><br>На рынке Таджикистана функционирует компания ООО «НЕКСОЗ бизнес консалтинг групп» — динамично развивающаяся компания, специализирующаяся на бухгалтерском учете и налогообложении. Компания была основана в 2016 году усилиями Салимов Зоира, имеющего опыт в банковской и налоговой системах, а также в сфере аудиторской деятельности.<br><br>Компания опирается на опыт своих сотрудников, командную работу и взаимовыручку. Благодаря гибкому подходу в работе компания сотрудничает с предприятиями из разных отраслей. ООО «НЕКСОЗ бизнес консалтинг групп» вносит существенный вклад в развитии предприятий путем введения финансовой отчетности, проведением аудита, работой с проверяющими органами.<br><br>Если вы владелец бизнеса или руководитель НПО и намерены оптимизировать процесс функционирования хозяйственной деятельности, компания ООО «НЕКСОЗ бизнес консалтинг групп» готова взять на себя и выполнить на профессиональном уровне возложенные обязательства. Миссия компании — содействие в оптимизации бизнес-процессов и достижении успехов наших партнеров.';
                            }
                        }
                        
                        // Ensure proper paragraphs and spacing
                        $content = wpautop($content);

                        echo str_replace($d['disclaimer_match'], $d['disclaimer_replace'], $content);
                        ?>
                    </div>

                    <div style="margin-top: 70px; padding-top: 40px; border-top: 1px solid rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
                        <a href="<?php echo home_url($d['news_base_url']); ?>" class="btn btn--primary btn-animated" style="padding: 14px 28px; font-size: 11px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; transform: scaleX(-1);"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            <?php echo $d['news_link_text']; ?>
                        </a>
                        
                        <div style="display: flex; gap: 15px;">
                            <?php
                            $current_id = get_the_ID();
                            // Keep in same category (RU/TJ/EN) to prevent mixing languages
                            $prev_news = get_previous_post(true, '', 'category');
                            $next_news = get_next_post(true, '', 'category');

                            // Bulletproof: Skip "Hello World" (ID 1) if it appears
                            if ($prev_news && $prev_news->ID == 1) $prev_news = null;
                            if ($next_news && $next_news->ID == 1) $next_news = null;

                            if ($prev_news) echo '<a href="'.add_query_arg('lang', $current_lang, get_permalink($prev_news)).'" class="nav-elite-btn">←</a>';
                            if ($next_news) echo '<a href="'.add_query_arg('lang', $current_lang, get_permalink($next_news)).'" class="nav-elite-btn">→</a>';
                            ?>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <aside style="position: sticky; top: 120px;">
                <div class="service-card" style="padding: 40px; border-radius: 24px; border: 1px solid rgba(0,0,0,0.03); margin-bottom: 35px; background: #ffffff;">
                    <h4 class="text-gradient" style="font-size: 0.95rem; font-weight: 900; margin-bottom: 10px; text-transform: uppercase;"><?php echo $d['other_posts_title']; ?></h4>
                    <div style="height: 3px; width: 40px; background: linear-gradient(90deg, #E30613 0%, #0044CC 100%); margin-bottom: 30px; border-radius: 2px;"></div>

                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 25px;">
                        <?php
                        $sidebar_args = [
                            'posts_per_page' => 5, 
                            'post__not_in' => [get_the_ID(), 1],
                        ];
                        if ($current_lang === 'tj') {
                            $sidebar_args['tax_query'] = [['taxonomy' => 'category', 'field' => 'slug', 'terms' => 'tj']];
                        } elseif ($current_lang === 'en') {
                            $sidebar_args['tax_query'] = [['taxonomy' => 'category', 'field' => 'slug', 'terms' => 'en']];
                        } else {
                            $sidebar_args['tax_query'] = [['taxonomy' => 'category', 'field' => 'slug', 'terms' => ['tj', 'en'], 'operator' => 'NOT IN']];
                        }
                        $recent = new WP_Query($sidebar_args);
                        while ($recent->have_posts()) : $recent->the_post();
                            $sidebar_title = get_the_title();
                        ?>
                        <li style="display: flex; gap: 15px; align-items: flex-start;">
                            <span class="lip-lip-dot" style="margin-top: 8px;"></span>
                            <a href="<?php echo add_query_arg('lang', $current_lang, get_permalink()); ?>" style="display: block; font-size: 1rem; font-weight: 700; color: var(--nk-gray-800); text-decoration: none; line-height: 1.4; transition: 0.3s;" class="sidebar-news-link">
                                <?php echo neksoz_clean_title_case($sidebar_title); ?>
                            </a>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>

                <div class="service-card shadow-lg" style="padding: 45px 35px; border-radius: 28px; background: linear-gradient(135deg, #E30613 0%, #0044CC 100%) !important; border: none !important; position: relative; overflow: hidden; box-shadow: 0 40px 100px rgba(0,0,0,0.15); display: block; width: 100%;">
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #ffffff 0%, rgba(255,255,255,0.2) 100%); opacity: 0.3;"></div>
                    <h4 style="font-size: 1.25rem; font-weight: 900; color: #ffffff; margin-bottom: 20px;"><?php echo $d['expert_help_title']; ?></h4>
                    <p style="font-size: 0.95rem; color: rgba(255,255,255,0.9); margin-bottom: 25px;"><?php echo $d['expert_help_text']; ?></p>
                    <div style="height: 3px; width: 60px; background: linear-gradient(90deg, #ffffff 0%, rgba(255,255,255,0.4) 100%); margin-bottom: 30px; border-radius: 2px;"></div>
                    <a href="<?php echo home_url($d['expert_help_url']); ?>" class="btn btn--primary btn-animated" style="background: transparent !important; color: #ffffff !important; border: 1px solid rgba(255,255,255,0.4) !important; padding: 16px 30px; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; width: auto; font-size: 11px;">
                        <?php echo $d['expert_help_btn']; ?>
                        <svg class="btn__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 10px;"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>

</main>

<?php endwhile; endif; ?>

<style>
.nav-elite-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background: var(--nk-blue);
    border-radius: 14px;
    color: #fff;
    font-size: 1.2rem;
    transition: 0.3s ease;
    text-decoration: none;
}
.nav-elite-btn:hover { background: var(--nk-red); transform: translateY(-3px); }
.sidebar-news-link:hover { color: var(--nk-blue) !important; transform: translateX(5px); }

.hero-status-tag {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 6px 16px;
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 100px;
    color: #ffffff;
    font-size: 10px;
    font-weight: 900;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    margin-bottom: 25px;
}

.lip-lip-dot {
    width: 6px; height: 6px; background: #E30613; border-radius: 50%;
    flex-shrink: 0;
    box-shadow: 0 0 0 0 rgba(227, 6, 19, 0.4);
    animation: lip-lip-pulse 2s infinite;
}
@keyframes lip-lip-pulse {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(227, 6, 19, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(227, 6, 19, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(227, 6, 19, 0); }
}
</style>

<?php get_footer(); ?>
