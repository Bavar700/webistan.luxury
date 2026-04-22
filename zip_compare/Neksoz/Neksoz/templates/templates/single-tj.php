<?php
/**
 * Isolated Tajik Single Post Template
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
            <div class="hero__badge fade-up is-visible" style="letter-spacing: 0.2em; font-size: 10px;">МАВОД</div>
            <?php
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
            // Specific Wrap for this long title
            if ($display_title === 'Равандҳои муфлисшавӣ ва барҳамдиҳии корхонаҳо') {
                $display_title = 'Равандҳои муфлисшавӣ<br>ва барҳамдиҳии корхонаҳо';
            }
            ?>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1" style="max-width: 700px; line-height: 1.15; margin-bottom: 30px; font-size: clamp(2rem, 4.5vw, 3.8rem);">
                <span class="text-gradient"><?php echo $display_title; ?></span>
            </h1>
            <div class="fade-up is-visible fade-up-delay-2" style="color: var(--nk-gray-400); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; display: flex; align-items: center; gap: 20px;">
                <span style="border-bottom: 2px solid var(--nk-red); padding-bottom: 4px; color: #a0a0a0;">
                    <?php 
                        $date = str_replace(['April'], ['апрели'], get_the_date('d F, Y'));
                        echo rtrim($date, '.'); 
                    ?>
                </span>
                <span style="width: 5px; height: 5px; background: var(--nk-red); border-radius: 50%;"></span>
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
                        <?php the_content(); ?>
                    </div>

                    <div style="margin-top: 70px; padding-top: 40px; border-top: 1px solid rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center;">
                        <a href="<?php echo home_url('/news-tj?lang=tj'); ?>" class="btn btn--primary btn-animated" style="padding: 14px 28px; font-size: 11px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; transform: scaleX(-1);"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            Бозгашт ба ҳамаи хабарҳо
                        </a>
                        
                        <div style="display: flex; gap: 15px;">
                            <?php
                            $prev = get_previous_post();
                            $next = get_next_post();
                            if ($prev) echo '<a href="'.get_permalink($prev).'?lang=tj" class="nav-elite-btn">←</a>';
                            if ($next) echo '<a href="'.get_permalink($next).'?lang=tj" class="nav-elite-btn">→</a>';
                            ?>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <aside style="position: sticky; top: 120px;">
                <div class="service-card" style="padding: 40px; border-radius: 24px; border: 1px solid rgba(0,0,0,0.03); margin-bottom: 35px; background: #ffffff;">
                    <h4 class="text-gradient" style="font-size: 0.95rem; font-weight: 900; margin-bottom: 30px; text-transform: uppercase;">Нашрияҳои охирин</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 25px;">
                        <?php
                        $recent = new WP_Query(['posts_per_page' => 4, 'post__not_in' => [get_the_ID(), 1]]);
                        while ($recent->have_posts()) : $recent->the_post();
                            $cur_title = get_the_title();
                            if (isset($tj_titles[$cur_title])) $cur_title = $tj_titles[$cur_title];
                        ?>
                        <li>
                            <a href="<?php echo add_query_arg('lang', 'tj', get_permalink()); ?>" style="display: block; font-size: 1rem; font-weight: 700; color: var(--nk-gray-800); text-decoration: none; line-height: 1.4; transition: 0.3s;" class="sidebar-news-link">
                                <?php echo $cur_title; ?>
                            </a>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>

                <div class="service-card shadow-lg" style="padding: 45px 35px; border-radius: 28px; background: linear-gradient(135deg, #E30613 0%, #0044CC 100%); border: none; position: relative; overflow: hidden; box-shadow: 0 40px 100px rgba(0,0,0,0.15);">
                    <h4 style="font-size: 1.25rem; font-weight: 900; color: #ffffff; margin-bottom: 20px;">Кӯмаки коршинос лозим аст?</h4>
                    <p style="font-size: 0.95rem; color: rgba(255,255,255,0.9); margin-bottom: 35px;">Мутахассисони мо омодаанд ба саволҳои Шумо дар соҳаи аудит ва ҳуқуқ посух диҳанд.</p>
                    <a href="<?php echo home_url('/contacts?lang=tj'); ?>" class="cta-elite-btn-white">Тамос бо мо</a>
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
.cta-elite-btn-white {
    display: inline-flex;
    align-items: center;
    background: #ffffff;
    color: var(--nk-blue);
    padding: 16px 30px;
    border-radius: 14px;
    font-size: 11px;
    font-weight: 900;
    text-transform: uppercase;
    text-decoration: none;
    transition: 0.3s;
}
.cta-elite-btn-white:hover { transform: translateY(-3px); color: var(--nk-red); }
.sidebar-news-link:hover { color: var(--nk-blue) !important; transform: translateX(5px); }
</style>
