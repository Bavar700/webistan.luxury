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
            <h1 class="hero__title fade-up is-visible fade-up-delay-1" style="max-width: 1100px; line-height: 1.1; margin-bottom: 30px; font-size: clamp(1.8rem, 4.2vw, 3.8rem); white-space: nowrap;">
                <span class="text-gradient" style="white-space: normal; display: block;"><?php echo $display_title; ?></span>
            </h1>
            <div class="fade-up is-visible fade-up-delay-2" style="color: var(--nk-gray-400); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; display: flex; align-items: center; gap: 20px;">
                <span style="border-bottom: 2px solid var(--nk-red); padding-bottom: 4px; color: #a0a0a0;">
                    <?php echo rtrim(get_the_date('j F, Y'), '.'); ?>
                </span>
                <span></span> <!-- Removed Red Dot -->
                <span><?php the_author(); ?></span>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ POST CONTENT ═══════════ -->
<section class="section section--gray" style="padding-top: 100px; padding-bottom: 120px;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 340px; gap: 70px; align-items: start;">
            
            <div class="fade-up is-visible">
                <article class="service-card" style="padding: 60px; border-radius: 32px; border: 1px solid rgba(0,0,0,0.03); background: #ffffff;">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div style="margin-bottom: 50px; border-radius: 20px; overflow: hidden; box-shadow: 0 30px 70px rgba(0,0,0,0.08);">
                            <?php the_post_thumbnail('full', ['style' => 'width: 100%; height: auto; display: block;']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content" style="line-height: 1.95; color: var(--nk-gray-700); font-size: 1.15rem; font-family: var(--font-body);">
                        <?php 
                        ob_start();
                        the_content();
                        $content = ob_get_clean();
                        $disclaimer = 'Ин маводи хабарӣ ба таври худкор барои низоми сезабона сохта шудааст.';
                        $replacement = 'Мы предлагаем профессиональные аудиторские и юридические услуги для роста вашего бизнеса.';
                        echo str_replace($disclaimer, $replacement, $content);
                        ?>
                    </div>

                    <div style="margin-top: 70px; padding-top: 40px; border-top: 1px solid rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
                        <a href="<?php echo home_url('/news?lang=ru'); ?>" class="btn btn--primary btn-animated" style="padding: 14px 28px; font-size: 11px;">
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
                    
                    <a href="<?php echo home_url('/contacts?lang=ru'); ?>" class="btn btn--primary btn-animated" style="background: transparent !important; color: #ffffff !important; border: 1px solid rgba(255,255,255,0.4) !important; padding: 16px 30px; border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; width: auto; font-size: 11px;">
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
