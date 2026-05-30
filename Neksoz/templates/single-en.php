<?php
/**
 * Isolated English Single Post Template
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
                MATERIAL
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

            // Intelligent Title Translation for English version
            $en_titles = [
                'Изменения в расчете налога на имущество и землю' => 'Changes in Property and Land Tax Calculation',
                'Процедуры банкротства и ликвидации предприятий' => 'Bankruptcy and Corporate Liquidation Procedures',
                'Итоги экономического форума в Душанбе' => 'Outcomes of the Economic Forum in Dushanbe',
                'Тағйирот дар ҳисоби андоз аз амвол ва замин' => 'Changes in Property and Land Tax Calculation',
                'Равандҳои муфлисшавӣ ва барҳамдиҳии корхонаҳо' => 'Bankruptcy and Corporate Liquidation Procedures',
                'Натиҷаҳои ҳамоиши иқтисодӣ дар Душанбе' => 'Outcomes of the Economic Forum in Dushanbe'
            ];
            $display_title = get_the_title();
            if (isset($en_titles[$display_title])) {
                $display_title = $en_titles[$display_title];
            }
            
            // Strict Two-Line Rule for EN (Balanced)
            $wrap_map_en = [
                'Changes in Property and Land Tax Calculation' => 'Changes in Property and<br>Land Tax Calculation',
                'Bankruptcy and Corporate Liquidation Procedures' => 'Bankruptcy and Corporate<br>Liquidation Procedures',
                'Outcomes of the Economic Forum in Dushanbe' => 'Outcomes of the Economic<br>Forum in Dushanbe'
            ];
            if (isset($wrap_map_en[$display_title])) $display_title = $wrap_map_en[$display_title];
            ?>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1" style="line-height: 1.2; margin-bottom: 30px; font-size: clamp(2rem, 4vw, 3rem);">
                <span class="text-gradient"><?php echo rtrim(mb_convert_case($display_title, MB_CASE_TITLE, "UTF-8"), '.'); ?></span>
            </h1>
            <div class="fade-up is-visible fade-up-delay-2" style="color: var(--nk-gray-400); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; display: flex; align-items: center; gap: 20px;">
                <span style="border-bottom: 2px solid var(--nk-red); padding-bottom: 4px; color: #a0a0a0;">
                    <?php echo rtrim(get_the_date('F d, Y'), '.'); ?>
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
                        $is_outsourcing = (mb_stripos(get_the_title(), 'outsourcing') !== false || mb_stripos(get_the_title(), 'аутсорсинг') !== false || mb_stripos(get_the_title(), 'Фаъолияти') !== false);
                        if ($is_outsourcing) {
                            $content = 'OUTSOURCING ACTIVITY AS A TOOL FOR OPTIMIZING THE ECONOMIC OPERATIONS OF ENTERPRISES IN A MARKET ECONOMY<br><br>The modern model of economic activity and the transition to a more progressive evolutionary stage of development require the Republic of Tajikistan to take significant measures in implementing new strategically considered management tools for the economic activities of domestic enterprises. It must be acknowledged that representatives of domestic business structures today face phenomena beyond their control, the destructive influence of which negatively affects their pragmatic vector of development.<br><br>The lack of specialized knowledge among enterprise management forces them to maintain staff directly involved in support business processes. By this staff, we mean employees responsible for financial and economic accounting, as it is no secret that accounting requires specific expertise that business owners often do not possess. Referring to empirical experience, the core skills necessary for implementing business initiatives are knowledge of the production process itself and sales skills; without these, achieving entrepreneurial goals is difficult to realize.<br><br>Maintaining accounting is recognized as a burdensome component even when possessing these skills. This thesis is based on the inefficiency of time resource allocation, as the primary task of small and medium-sized enterprises (SMEs), especially during their initial formation, is to maintain rapid turnover and generate cash flow.<br><br>Thus, it should be emphasized that in developed economies, where a unit of time has a high value, enterprises actively utilize the advantages of "outsourcing" consulting. Outsourcing represents the use of external or hired resources, including human resources (staff). Today, the spectrum of outsourcing services as an element of business services is diverse, ranging from technical personnel to the marketing industry.<br><br>When using outsourcing, an organization, based on a bilateral agreement, transfers a specific type of service or function of production/entrepreneurial activity to another company. Compared to traditional services based on a one-time or episodic basis with a limited timeframe, outsourcing involves transferring professional support functions for the uninterrupted operation of individual departments under a long-term agreement.<br><br>A significant number of economists agree that using outsourcing for accounting is rational for small and medium enterprises that cannot afford a full staff in this field and whose priority is managing the business process itself rather than being immersed in reporting.<br><br>According to data from the "STATISTA" analytical resource, the global outsourcing market in 2019 amounted to 92.5 billion USD. In addition to rational time management, reducing certain costs—specifically taxes and overheads—is a primary reason why enterprises utilize this market tool.<br><br>Over the past three decades, outsourcing has become an integral part of business management. In 2020, it completely overtook some of the largest industries in the world. Research shows that 78% of companies worldwide feel positive about their outsourcing partners. 83% of financial companies and institutions outsource or plan to outsource a range of functions. About 24% of small businesses use outsourcing to improve overall operational efficiency. Nearly 54% of all companies globally use outsourcing services.<br><br>As for the Republic of Tajikistan, unfortunately, there is a lack of specific statistics regarding the local outsourcing market. However, 31.1% of companies provide tax and accounting outsourcing, which is a well-founded phenomenon.<br><br>The expediency of using outsourcing lies in its acceptability and practicality in the quest to reduce financial costs for maintaining staff. Using this tool significantly reduces additional costs for maintaining experienced employees. According to dissertation research results, the use of consulting and outsourcing yielded the following results: a 6.7% reduction in operating costs, a 3.0% reduction in administrative costs, a 6.7% reduction in report preparation time, and a 24.7% increase in productivity.<br><br>Operating in the Tajik market is "NEKSOZ Business Consulting Group" LLC—a dynamically developing company specializing in accounting and taxation. The company was founded in 2016 through the efforts of Zoir Salimov, who has extensive experience in the banking and tax systems, as well as in auditing.<br><br>The company relies on the expertise of its employees, teamwork, and mutual support. Thanks to a flexible approach, the company collaborates with enterprises across various industries. "NEKSOZ Business Consulting Group" LLC makes a significant contribution to the development of enterprises by handling financial reporting, conducting audits, and interacting with regulatory authorities.<br><br>If you are a business owner or an NGO leader and intend to optimize your economic operations, "NEKSOZ Business Consulting Group" LLC is ready to undertake and professionally fulfill these obligations. The company\'s mission is to assist in optimizing business processes and ensuring the success of our partners.';
                        }
                        echo wpautop($content);
                        ?>
                    </div>

                    <div style="margin-top: 70px; padding-top: 40px; border-top: 1px solid rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
                        <a href="<?php echo nk_link('/news', 'en'); ?>" class="btn btn--primary btn-animated" style="padding: 14px 28px; font-size: 11px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; transform: scaleX(-1);"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            Back to all news
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
                                        'terms'    => 'en',
                                    ]
                                ]
                            ]);
                            $news_ids = wp_list_pluck($all_posts, 'ID');
                            
                            $current_index = array_search($current_id, $news_ids);
                            $prev_news = ($current_index !== false && isset($news_ids[$current_index + 1])) ? $news_ids[$current_index + 1] : null;
                            $next_news = ($current_index !== false && $current_index > 0) ? $news_ids[$current_index - 1] : null;

                            if ($prev_news) echo '<a href="'.add_query_arg('lang', 'en', get_permalink($prev_news)).'" class="nav-elite-btn">←</a>';
                            if ($next_news) echo '<a href="'.add_query_arg('lang', 'en', get_permalink($next_news)).'" class="nav-elite-btn">→</a>';
                            ?>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <aside style="position: sticky; top: 120px;">
                <div class="service-card" style="padding: 40px; border-radius: 24px; border: 1px solid rgba(0,0,0,0.03); margin-bottom: 35px; background: #ffffff;">
                    <h4 class="text-gradient" style="font-size: 0.95rem; font-weight: 900; margin-bottom: 10px; text-transform: uppercase;">Latest Publications</h4>
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
                                    'terms'    => 'en',
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
                            <a href="<?php echo add_query_arg('lang', 'en', get_permalink()); ?>" style="display: block; font-size: 1rem; font-weight: 700; color: var(--nk-gray-800); text-decoration: none; line-height: 1.4; transition: 0.3s;" class="sidebar-news-link">
                                <?php echo $cur_title; ?>
                            </a>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>

                <div class="service-card shadow-lg" style="padding: 45px 35px; border-radius: 28px; background: linear-gradient(135deg, #E30613 0%, #0044CC 100%) !important; border: none !important; position: relative; overflow: hidden; box-shadow: 0 40px 100px rgba(0,0,0,0.15); display: block; width: 100%;">
                    <!-- Decorative bottom light -->
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #ffffff 0%, rgba(255,255,255,0.2) 100%); opacity: 0.3;"></div>
                    
                    <h4 style="font-size: 1.25rem; font-weight: 900; color: #ffffff; margin-bottom: 20px;">Need expert help?</h4>
                    <p style="font-size: 0.95rem; color: rgba(255,255,255,0.9); margin-bottom: 25px;">Our specialists are ready to answer your questions in auditing and law.</p>
                    
                    <!-- GRADIENT LINE UNDER TEXT -->
                    <div style="height: 3px; width: 60px; background: linear-gradient(90deg, #ffffff 0%, rgba(255,255,255,0.4) 100%); margin-bottom: 30px; border-radius: 2px;"></div>
                    
                    <a href="<?php echo nk_link('/contacts', 'en'); ?>" class="btn btn--primary btn-animated" style="background: transparent !important; color: #ffffff !important; border: 1px solid rgba(255,255,255,0.4) !important; padding: 16px 30px; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; width: auto; font-size: 11px;">
                        Contact us
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
