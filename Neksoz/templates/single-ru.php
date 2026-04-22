<?php
/**
 * Isolated Russian Single Post Template
 */
?>
<main id="primary" class="site-main">

<?php while ( have_posts() ) : the_post(); ?>

<!-- ═══════════ CINEMATIC POST HERO ═══════════ -->
<section class="hero hero--internal" style="min-height: 55vh; display: flex; align-items: center; padding: 100px 0;">
    <div class="hero__geo"></div>
    <div class="hero__grid-pattern"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>

    <div class="container hero__container" style="position:relative;z-index:2;">
        <div class="hero__content" style="max-width: 1000px;">
            <div class="hero-status-tag fade-up is-visible">
                <span class="lip-lip-dot"></span>
                МАТЕРИАЛ
            </div>
            <?php 
                // Global Recognized Titles
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

                $display_title = get_the_title();
                $ru_map = [
                    'Changes in Property and Land Tax Calculation' => 'Изменения в расчете налога на имущество и землю',
                    'Bankruptcy and Corporate Liquidation Procedures' => 'Процедуры банкротства и ликвидации предприятий',
                    'Outcomes of the Economic Forum in Dushanbe' => 'Итоги экономического форума в Душанбе'
                ];
                if (isset($ru_map[$display_title])) $display_title = $ru_map[$display_title];

                // Strict Two-Line Rule for RU (Balanced)
                $wrap_map_ru = [
                    'Изменения в расчете налога на имущество и землю' => 'Изменения в расчете<br>налога на имущество и землю',
                    'Процедуры банкротства и ликвидации предприятий' => 'Процедуры банкротства<br>и ликвидации предприятий',
                    'Итоги экономического форума в Душанбе' => 'Итоги экономического<br>форума в Душанбе'
                ];
                if (isset($wrap_map_ru[$display_title])) $display_title = $wrap_map_ru[$display_title];
            ?>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1" style="line-height: 1.2; margin-bottom: 30px; font-size: clamp(2rem, 4vw, 3rem);">
                <span class="text-gradient"><?php echo rtrim(mb_convert_case($display_title, MB_CASE_TITLE, "UTF-8"), '.'); ?></span>
            </h1>
            <div class="fade-up is-visible fade-up-delay-2" style="color: var(--nk-gray-400); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; display: flex; align-items: center; gap: 20px;">
                <span style="border-bottom: 2px solid var(--nk-red); padding-bottom: 4px; color: #a0a0a0;">
                    <?php echo rtrim(get_the_date('j F, Y'), '.'); ?>
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

                    <div class="post-content" style="line-height: 1.95; color: var(--nk-gray-700); font-size: 1.15rem; font-family: var(--font-body);">
                        <?php 
                        $content = get_the_content();
                        $is_outsourcing = (stripos(get_the_title(), 'Аутсорсинг') !== false || stripos(get_the_title(), 'Outsourcing') !== false);
                        if ($is_outsourcing && strlen(strip_tags($content)) < 300) {
                            echo 'Аутсорсинговая деятельность как инструмент оптимизации хозяйственной деятельности предприятий в условиях рыночной экономики.<br><br>Современная модель экономической деятельности и выход на более прогрессивную эволюционную ступень развития требует от Республики Таджикистан принятия важных мер в области имплементации новых стратегически обдуманных инструментов управления хозяйственной деятельности отечественных предприятий. Стоит признать тот факт, что представители отечественных бизнес структур на сегодняшний день сталкиваются с явлениями, находящимися вне зоны контроля этих самых предприятий и деструктивное влияние которых отрицательно сказывается на их прагматичном векторе развития.<br><br>Отсутствие знаний в некоторых областях со стороны менеджмента предприятий заставляют последних содержать персонал, который непосредственно участвует в бизнес-процессе. Под данным персоналом мы позиционируем сотрудников по введению финансового и хозяйственного учета предприятий, ведь ни для кого не секрет, что введение хозяйственного учета требует определенных знаний, которыми в большинстве случаев не владеют собственники бизнеса. Ссылаясь на закономерность эмпирического опыта видно, что базовыми навыками необходимыми для реализации бизнес инициатив являются – знание самого производственного процесса и навыки продаж, т.к. в отсутствие озвученных знаний достижение предпринимательских целей сложно реализуема.<br><br>Введение учета признается обременительным составляющим даже при владении данными навыками. Данные тезис опирается на необоснованность распределения временных ресурсов, ведь основная задача малых и средних предприятий, в особенности в начале их формирования заключается в поддержании темпов ускоренного товарооборота и генерировании денежных средств.<br><br>Таким образом, хотелось бы подчеркнуть, что в странах с развитой экономикой, где единица временных ресурсов имеет достаточно высокую цену, предприятиями активно используются достижения такого инструмента как консалтинга «аутсорсинг». Аутсорсинг представляет собой элемент использования привлеченных или (наемных) ресурсов, включая человеческих (персонал). На сегодняшний день спектр реализации услуг аутсорсинга, как одного из элементов бизнес-услуг, разнообразен, начиная от услуг технического персонала до услуг маркетинговой индустрии.<br><br>При использовании аутсорсинга организация на базе двухстороннего соглашения передает определённый вид услуг или функции производственной предпринимательской деятельности другой компании. В сравнении с традиционным видом услуг, который основывается на разовой, или эпизодической плоскости, а также имеющий ограниченный временной диапазон, при аутсорсинге передаются функции по профессиональной поддержке бесперебойной работы отдельных подразделений в рамках долгосрочного соглашения.<br><br>Значительная часть экономистов признает, что использование аутсорсинга в области введения бухгалтерского учета является рациональным для малых и средних предприятий, которые не могут позволить себе штат сотрудников в этой области и, приоритетная задача которых заключается в управлении самим бизнес-процессом, а не погружением в процесс ведения отчетности.<br><br>Согласно данным аналитического ресурса «STATISTA» в 2019 году мировой рынок аутсорсинга составил 92,5 млрд. долл. США. Дополнительно к рациональному использованию времени, снижение некоторых расходов, в частности налогов и накладных расходов, является причиной, ссылаясь на которую, предприятия используют данный инструмент рынка.<br><br>За последние три десятилетия аутсорсинг стал неотъемлемой частью управления бизнесом. В 2020 году он полностью обогнал некоторые крупнейшие отрасли в мире. По данным исследований 78% компаний во всем мире положительно относятся к своим партнерам по аутсорсингу. 83% финансовых компаний и учреждений передают или планируют передать ряд функций другим компаниям. Около 24% малых предприятий используют аутсорсинг для повышения эффективности всей работы. Почти 54% всех компаний мира пользуются услугами аутсорсинга.<br><br>Что касается Республики Таджикистан, то здесь, к сожалению, отсутствует какая-либо статистика относительного рынка аутсорсинга. Таким образом, 31,1% компаний предоставляют аутсорсинг по налогам и бухгалтерскому учету, что является вполне обоснованным явлением.<br><br>Целесообразность использования инструмента «аутсорсинг» заключается в его приемлемости и практичности в стремлении снизить финансовые издержки на содержание штата. Использование данного инструмента существенно снижает дополнительные издержки на содержание сотрудника с опытом. Согласно результатам диссертационного исследования, использование консалтинга и аутсорсинга дало следующие результаты: снижение операционных затрат на 6,7%, административных — на 3,0%, снижение времени на подготовку отчетов на 6,7%, рост продуктивности на 24,7%.<br><br>На рынке Таджикистана функционирует компания ООО «НЕКСОЗ бизнес консалтинг групп» — динамично развивающаяся компания, специализирующаяся на бухгалтерском учете и налогообложении. Компания была основана в 2016 году усилиями Салимова Зоира, имеющего опыт в банковской и налоговой системах, а также в сфере аудиторской деятельности.<br><br>Компания опирается на опыт своих сотрудников, командную работу и взаимовыручку. Благодаря гибкому подходу в работе компания сотрудничает с предприятиями из разных отраслей. ООО «НЕКСОЗ бизнес консалтинг групп» вносит существенный вклад в развитии предприятий путем введения финансовой отчетности, проведением аудита, работой с проверяющими органами.<br><br>Если вы владелец бизнеса или руководитель НПО и намерены оптимизировать процесс функционирования хозяйственной деятельности, компания ООО «НЕКСОЗ бизнес консалтинг групп» готова взять на себя и выполнить на профессиональном уровне возложенные обязательства. Миссия компании — содействие в оптимизации бизнес-процессов и достижении успехов наших партнеров.';
                        } else {
                            the_content(); 
                        }
                        ?>
                    </div>

                    <div style="margin-top: 70px; padding-top: 40px; border-top: 1px solid rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
                        <a href="<?php echo nk_link('/news?lang=ru', $current_lang); ?>" class="btn btn--primary btn-animated" style="padding: 14px 28px; font-size: 11px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; transform: scaleX(-1);"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            Ко всем новостям
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
                                        'terms'    => ['tj', 'en'],
                                        'operator' => 'NOT IN',
                                    ]
                                ]
                            ]);
                            $news_ids = wp_list_pluck($all_posts, 'ID');
                            
                            $current_index = array_search($current_id, $news_ids);
                            $prev_news = ($current_index !== false && isset($news_ids[$current_index + 1])) ? $news_ids[$current_index + 1] : null;
                            $next_news = ($current_index !== false && $current_index > 0) ? $news_ids[$current_index - 1] : null;

                            if ($prev_news) echo '<a href="'.add_query_arg('lang', 'ru', get_permalink($prev_news)).'" class="nav-elite-btn">←</a>';
                            if ($next_news) echo '<a href="'.add_query_arg('lang', 'ru', get_permalink($next_news)).'" class="nav-elite-btn">→</a>';
                            ?>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <aside style="position: sticky; top: 120px;">
                <div class="service-card" style="padding: 40px; border-radius: 24px; border: 1px solid rgba(0,0,0,0.03); margin-bottom: 35px; background: #ffffff;">
                    <h4 class="text-gradient" style="font-size: 0.95rem; font-weight: 900; margin-bottom: 10px; text-transform: uppercase;">Другие публикации</h4>
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
                                    'terms'    => ['tj', 'en'],
                                    'operator' => 'NOT IN',
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
                            <a href="<?php echo add_query_arg('lang', 'ru', get_permalink()); ?>" style="display: block; font-size: 1rem; font-weight: 700; color: var(--nk-gray-800); text-decoration: none; line-height: 1.4; transition: 0.3s;" class="sidebar-news-link">
                                <?php echo $cur_title; ?>
                            </a>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>

                <div class="service-card shadow-lg" style="padding: 45px 35px; border-radius: 28px; background: linear-gradient(135deg, #E30613 0%, #0044CC 100%) !important; border: none !important; position: relative; overflow: hidden; box-shadow: 0 40px 100px rgba(0,0,0,0.15); display: block; width: 100%;">
                    <!-- Decorative bottom light -->
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #ffffff 0%, rgba(255,255,255,0.2) 100%); opacity: 0.3;"></div>
                    
                    <h4 style="font-size: 1.25rem; font-weight: 900; color: #ffffff; margin-bottom: 20px;">Нужна помощь эксперта?</h4>
                    <p style="font-size: 0.95rem; color: rgba(255,255,255,0.9); margin-bottom: 25px;">Наши специалисты готовы ответить на ваши вопросы в области аудита и права.</p>
                    
                    <!-- GRADIENT LINE UNDER TEXT -->
                    <div style="height: 3px; width: 60px; background: linear-gradient(90deg, #ffffff 0%, rgba(255,255,255,0.4) 100%); margin-bottom: 30px; border-radius: 2px;"></div>
                    
                    <a href="<?php echo nk_link('/contacts?lang=ru', $current_lang); ?>" class="btn btn--primary btn-animated" style="background: transparent !important; color: #ffffff !important; border: 1px solid rgba(255,255,255,0.4) !important; padding: 16px 30px; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; width: auto; font-size: 11px;">
                        Связаться с нами
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


