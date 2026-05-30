<?php
/**
 * Isolated Tajik Single Post Template
 */
?>
<main id="primary" class="site-main">

<?php while ( have_posts() ) : the_post(); ?>

<!-- ═══════════ CINEMATIC POST HERO ═══════════ -->
<section class="hero hero--internal" style="min-height: 55vh; display: flex; align-items: center; padding: 70px 0 130px;">
    <div class="hero__geo"></div>
    <div class="hero__grid-pattern"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>

    <div class="container hero__container" style="position:relative;z-index:2;">
        <div class="hero__content" style="max-width: 1000px;">
            <div class="hero-status-tag fade-up is-visible">
                <span class="lip-lip-dot"></span>
                МАВОД
            </div>
            <?php
            // Global Recognized Titles for consistent trilingual mapping
            $recognized_titles = [
                'Изменения в расчете налога на имущество и землю',
                'Процедуры банкротства и ликвидации предприятий',
                'Итоги экономического форума в Душанбе',
                'Changes in Property and Land Tax Calculation',
                'Bankruptcy and Corporate Liquidation Procedures',
                'Outcomes of the Economic Forum in Dushanbe',
                'Тағйирот дар ҳисоби андоз аз амвол ва замин',
                'Равандҳои муфлисшавӣ ва барҳамдиҳии корхонаҳо',
                'Натиҷаҳои ҳамоиши иқтисодӣ дар Душанбе'
            ];

            // Intelligent Title Translation for Tajik version
            $tj_titles = [
                'Изменения в расчете налога на имущество и землю' => 'Тағйирот дар ҳисоби андоз аз амвол ва замин',
                'Процедуры банкротства и ликвидации предприятий' => 'Равандҳои муфлисшавӣ ва барҳамдиҳии корхонаҳо',
                'Итоги экономического форума в Душанбе' => 'Натиҷаҳои ҳамоиши иқтисодӣ дар Душанбе'
            ];
            $display_title = get_the_title();
            if (isset($tj_titles[$display_title])) {
                $display_title = $tj_titles[$display_title];
            }
            
            // Strict Two-Line Rule for long titles (Balanced)
            $wrap_map = [
                'Тағйирот дар ҳисоби андоз аз амвол ва замин' => 'Тағйирот дар ҳисоби<br>андоз аз амвол ва замин',
                'Равандҳои муфлисшавӣ ва барҳамдиҳии корхонаҳо' => 'Равандҳои муфлисшавӣ ва<br>барҳамдиҳии корхонаҳо',
                'Натиҷаҳои ҳамоиши иқтисодӣ дар Душанбе' => 'Натиҷаҳои ҳамоиши<br>иқтисодӣ дар Душанбе'
            ];
            if (isset($wrap_map[$display_title])) $display_title = $wrap_map[$display_title];
            ?>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1" style="line-height: 1.2; margin-bottom: 30px; font-size: clamp(2rem, 4vw, 3rem);">
                <span class="text-gradient"><?php echo rtrim(mb_convert_case($display_title, MB_CASE_TITLE, "UTF-8"), '.'); ?></span>
            </h1>
            <div class="fade-up is-visible fade-up-delay-2" style="color: var(--nk-gray-400); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; display: flex; align-items: center; gap: 20px;">
                <span style="border-bottom: 2px solid var(--nk-red); padding-bottom: 4px; color: #a0a0a0;">
                    <?php 
                        $date = str_replace(['April'], ['апрели'], get_the_date('d F, Y'));
                        echo rtrim($date, '.'); 
                    ?>
                </span>
                <span></span> <!-- Removed Red Dot -->
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
                        $is_outsourcing = (mb_stripos(get_the_title(), 'аутсорсинг') !== false || mb_stripos(get_the_title(), 'Outsourcing') !== false || mb_stripos(get_the_title(), 'Фаъолияти') !== false);
                        if ($is_outsourcing) {
                            $content = 'ФАЪОЛИЯТИ АУТСОРСИНГӢ ҲАМЧУН ВОСИТАИ БЕҲСОЗИИ ФАЪОЛИЯТИ ХОҶАГИДОРИИ КОРХОНАҲО ДАР ШАРОИТИ ИҚТИСОДИ БОЗОРӢ<br><br>Модели муосири фаъолияти иқтисодӣ ва гузариш ба зинаи пешрафтаи таҳаввулотии рушд аз Ҷумҳурии Тоҷикистон қабули чораҳои муҳимро дар заминаи татбиқи воситаҳои нави роҳбурдии идоракунии фаъолияти хоҷагидории корхонаҳои ватанӣ тақозо мекунад. Бояд эътироф кард, ки намояндагони сохторҳои тиҷоратии ватанӣ имрӯзҳо бо падидаҳое рӯбарӯ мешаванд, ки берун аз доираи назорати ин корхонаҳо қарор дошта, таъсири манфии онҳо ба самти рушди прагматикии онҳо халал мерасонад.<br><br>Набудани дониш дар баъзе соҳаҳо аз ҷониби менеҷменти корхонаҳо онҳоро маҷбур месозад, ки кормандонеро нигоҳ доранд, ки бевосита дар раванди тиҷорат иштирок мекунанд. Зери мафҳуми ин кормандон мо мутахассисони баҳисобгирии молиявӣ ва хоҷагидориро дар назар дорем, зеро пӯшида нест, ки пешбурди баҳисобгирӣ донишҳои махсусро талаб мекунад, ки дар аксар ҳолатҳо моликони тиҷорат дорои онҳо нестанд. Бо такя ба таҷрибаи эмпирикӣ дида мешавад, ки малакаҳои асосӣ барои татбиқи ташаббусҳои тиҷоратӣ — донистани худи раванди истеҳсолот ва малакаҳои фурӯш мебошанд, зеро бидуни ин донишҳо расидан ба ҳадафҳои соҳибкорӣ душвор аст.<br><br>Пешбурди баҳисобгирӣ ҳатто ҳангоми доштани ин малакаҳо ҷузъи гаронбор эътироф мешавад. Ин андеша ба беасос тақсим кардани захираҳои вақт такя мекунад, зеро вазифаи асосии корхонаҳои хурд ва миёна, махсусан дар оғози ташаккули онҳо, нигоҳ доштани суръати гардиши мол ва тавлиди маблағҳои пулӣ мебошад.<br><br>Ҳамин тариқ, мехоҳам таъкид намоям, ки дар кишварҳои дорои иқтисоди пешрафта, ки воҳиди вақт арзиши баланд дорад, корхонаҳо аз дастовардҳои воситае чун консалтинги «аутсорсинг» фаъолона истифода мебаранд. Аутсорсинг ҷузъи истифодаи захираҳои ҷалбшуда (кироя), аз ҷумла захираҳои инсонӣ (кормандон) мебошад. Имрӯзҳо доираи хизматрасониҳои аутсорсингӣ хеле васеъ буда, аз хизмати кормандони техникӣ то соҳаи маркетингро фаро мегирад.<br><br>Ҳангоми истифодаи аутсорсинг, ташкилот дар асоси созишномаи дуҷониба намуди муайяни хизматрасонӣ ё вазифаҳои фаъолияти истеҳсолию соҳибкориро ба ширкати дигар вогузор мекунад. Дар муқоиса бо намуди анъанавии хизматрасонӣ, ки хусусияти якдафъаина ё эпизодӣ дорад, дар аутсорсинг вазифаҳои дастгирии касбии фаъолияти бефосилаи воҳидҳои алоҳида дар доираи созишномаи дарозмуддат супорида мешаванд.<br><br>Қисми зиёди иқтисоддонҳо эътироф мекунанд, ки истифодаи аутсорсинг дар соҳаи баҳисобгирии муҳосибӣ барои корхонаҳои хурд ва миёна, ки наметавонанд штати пурраи кормандонро дар ин соҳа дошта бошанд, оқилона аст. Вазифаи афзалиятноки онҳо идоракунии худи раванди тиҷорат аст, на фурӯ рафтан дар раванди ҳисоботдиҳӣ.<br><br>Тибқи маълумоти манбаи таҳлилии «STATISTA», дар соли 2019 бозори ҷаҳонии аутсорсинг 92,5 млрд доллари ИМА-ро ташкил дод. Илова бар истифодаи оқилонаи вақт, коҳиш додани баъзе хароҷот, аз ҷумла андозҳо ва хароҷоти иловагӣ, сабаби асосии истифодаи ин восита аз ҷониби корхонаҳо мебошад.<br><br>Дар давоми се даҳсолаи охир аутсорсинг ҷузъи ҷудонашавандаи идоракунии тиҷорат гардид. Соли 2020 он аз баъзе соҳаҳои бузургтарини ҷаҳон пеш гузашт. Мувофиқи тадқиқотҳо, 78%-и ширкатҳо дар саросари ҷаҳон ба шарикони аутсорсингии худ назари мусбат доранд. 83%-и ширкатҳо ва муассисаҳои молиявӣ як қатор вазифаҳоро ба ширкатҳои дигар вогузор мекунанд ё нақшаи вогузор карданро доранд. Тақрибан 24%-и корхонаҳои хурд барои баланд бардоштани самаранокии кор аз аутсорсинг истифода мебаранд. Қариб 54%-и тамоми ширкатҳои ҷаҳон аз хизматрасониҳои аутсорсингӣ баҳра мебаранд.<br><br>Дар мавриди Ҷумҳурии Тоҷикистон, мутаассифона, ягон омори дақиқ дар бораи бозори аутсорсинг мавҷуд нест. Бо вуҷуди ин, 31,1%-и ширкатҳо дар соҳаи андоз ва баҳисобгирии муҳосибӣ хизматрасонии аутсорсингӣ пешниҳод мекунанд, ки ин падидаи комилан асоснок аст.<br><br>Мақсаднокии истифодаи воситаи «аутсорсинг» дар қобили қабул ва амалӣ будани он дар талош барои коҳиш додани хароҷоти молиявӣ ба нигоҳдории штат ифода меёбад. Истифодаи ин восита хароҷоти иловагиро барои нигоҳдории корманди ботаҷриба ба таври назаррас коҳиш медиҳад. Мувофиқи натиҷаҳои тадқиқоти диссертатсионӣ, истифодаи консалтинг ва аутсорсинг натиҷаҳои зеринро дод: коҳиши хароҷоти амалиётӣ ба 6,7%, маъмурӣ — ба 3,0%, коҳиши вақт барои омодасозии ҳисоботҳо ба 6,7% ва рушди маҳсулнокӣ ба 24,7%.<br><br>Дар бозори Тоҷикистон ширкати ҶДММ «НЕКСОЗ бизнес консалтинг групп» фаъолият мекунад — ширкати босуръат рушдёбанда, ки ба баҳисобгирии муҳосибӣ ва андозбандӣ тахассус дорад. Ширкат соли 2016 бо кӯшишҳои Салимов Зоир, ки дар системаҳои бонкию андозӣ ва соҳаи аудит таҷриба дорад, таъсис ёфтааст.<br><br>Ширкат ба таҷрибаи кормандони худ, кори дастаҷамъона ва кумаки мутақобила такя мекунад. Бо шарофати муносибати чандир дар кор, ширкат бо корхонаҳои соҳаҳои мухталиф ҳамкорӣ менамояд. ҶДММ «НЕКСОЗ бизнес консалтинг групп» бо пешбурди ҳисоботи молиявӣ, гузаронидани аудит ва кор бо мақомоти санҷишӣ дар рушди корхонаҳо саҳми арзанда мегузорад.<br><br>Агар Шумо молики тиҷорат ё роҳбари ТҶҒ бошед ва ният доред раванди фаъолияти хоҷагидориро беҳтар созед, ширкати ҶДММ «НЕКСОЗ бизнес консалтинг групп» омода аст уҳдадориҳои вогузоршударо дар сатҳи касбӣ иҷро намояд. Рисолати ширкат — мусоидат дар беҳсозии равандҳои тиҷоратӣ ва расидан ба муваффақиятҳои шарикони мо мебошад.';
                        }
                        echo wpautop($content);
                        ?>
                    </div>

                    <div style="margin-top: 70px; padding-top: 40px; border-top: 1px solid rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
                        <a href="<?php echo nk_link('/news', 'tj'); ?>" class="btn btn--primary btn-animated" style="padding: 14px 28px; font-size: 11px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; transform: scaleX(-1);"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            Ба тамоми хабарҳо
                        </a>
                        
                        <div style="display: flex; gap: 15px;">
                            <?php
                            $current_id = get_the_ID();
                            $all_posts = get_posts([
                                'post_type' => 'post', 
                                'posts_per_page' => -1, 
                                'orderby' => 'date', 
                                'order' => 'DESC',
                                'post__not_in' => [1],
                                'tax_query' => [
                                    [
                                        'taxonomy' => 'category',
                                        'field'    => 'slug',
                                        'terms'    => 'tj',
                                    ]
                                ]
                            ]);
                            $news_ids = wp_list_pluck($all_posts, 'ID');
                            
                            $current_index = array_search($current_id, $news_ids);
                            $prev_news = ($current_index !== false && isset($news_ids[$current_index + 1])) ? $news_ids[$current_index + 1] : null;
                            $next_news = ($current_index !== false && $current_index > 0) ? $news_ids[$current_index - 1] : null;

                            if ($prev_news) echo '<a href="'.add_query_arg('lang', 'tj', get_permalink($prev_news)).'" class="nav-elite-btn">←</a>';
                            if ($next_news) echo '<a href="'.add_query_arg('lang', 'tj', get_permalink($next_news)).'" class="nav-elite-btn">→</a>';
                            ?>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <aside style="position: sticky; top: 120px;">
                <div class="service-card" style="padding: 40px; border-radius: 24px; border: 1px solid rgba(0,0,0,0.03); margin-bottom: 35px; background: #ffffff;">
                    <h4 class="text-gradient" style="font-size: 0.95rem; font-weight: 900; margin-bottom: 10px; text-transform: uppercase;">Нашрияҳои охирин</h4>
                    <div style="height: 3px; width: 40px; background: linear-gradient(90deg, #E30613 0%, #0044CC 100%); margin-bottom: 30px; border-radius: 2px;"></div>
                    
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 25px;">
                        <?php
                        $recent = new WP_Query([
                            'posts_per_page' => 5, 
                            'post__not_in' => [get_the_ID(), 1],
                            'tax_query' => [
                                [
                                    'taxonomy' => 'category',
                                    'field'    => 'slug',
                                    'terms'    => 'tj',
                                ]
                            ]
                        ]);
                        $displayed_titles = [ $display_title ];
                        $count = 0;
                        while ($recent->have_posts() && $count < 4) : $recent->the_post();
                            $cur_title = get_the_title();
                            
                            // Prevent Duplicates
                            if (in_array($cur_title, $displayed_titles)) continue;
                            $displayed_titles[] = $cur_title;
                            $count++;
                        ?>
                        <li style="display: flex; gap: 15px; align-items: flex-start;">
                            <span class="lip-lip-dot" style="margin-top: 8px;"></span>
                            <a href="<?php echo add_query_arg('lang', 'tj', get_permalink()); ?>" style="display: block; font-size: 1rem; font-weight: 700; color: var(--nk-gray-800); text-decoration: none; line-height: 1.4; transition: 0.3s;" class="sidebar-news-link">
                                <?php echo $cur_title; ?>
                            </a>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>

                <div class="service-card shadow-lg" style="padding: 45px 35px; border-radius: 28px; background: linear-gradient(135deg, #E30613 0%, #0044CC 100%) !important; border: none !important; position: relative; overflow: hidden; box-shadow: 0 40px 100px rgba(0,0,0,0.15); display: block; width: 100%;">
                    <!-- Decorative bottom light -->
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #ffffff 0%, rgba(255,255,255,0.2) 100%); opacity: 0.3;"></div>
                    
                    <h4 style="font-size: 1.25rem; font-weight: 900; color: #ffffff; margin-bottom: 20px;">Кӯмаки коршинос лозим аст?</h4>
                    <p style="font-size: 0.95rem; color: rgba(255,255,255,0.9); margin-bottom: 25px;">Мутахассисони мо омодаанд ба саволҳои Шумо дар соҳаи аудит ва ҳуқуқ посух диҳанд.</p>
                    
                    <!-- GRADIENT LINE UNDER TEXT -->
                    <div style="height: 3px; width: 60px; background: linear-gradient(90deg, #ffffff 0%, rgba(255,255,255,0.4) 100%); margin-bottom: 30px; border-radius: 2px;"></div>
                    
                    <a href="<?php echo nk_link('/contacts', 'tj'); ?>" class="btn btn--primary btn-animated" style="background: transparent !important; color: #ffffff !important; border: 1px solid rgba(255,255,255,0.4) !important; padding: 16px 30px; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; width: auto; font-size: 11px;">
                        Тамос бо мо
                        <svg class="btn__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 10px;"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php endwhile; ?>

</main>

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

/* Premium Status Tag */
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

/* Blinking Dot Animation */
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
