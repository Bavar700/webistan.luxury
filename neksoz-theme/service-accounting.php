<?php
/**
 * Template Name: Ð£ÑÐ»ÑƒÐ³Ð°: Ð’Ð²ÐµÐ´ÐµÐ½Ð¸Ðµ Ñ„Ð¸Ð½. ÑƒÑ‡ÐµÑ‚Ð° Ð¸ ÐºÐ°Ð´Ñ€Ð¾Ð²
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="nk-section--dark" style="padding: 60px 0; background: linear-gradient(135deg, var(--nk-primary-dark) 0%, var(--nk-primary) 100%);">
        <div class="nk-container">
            <div style="max-width: 800px;">
                <span class="section-label" style="color: rgba(255,255,255,0.6);"><?php esc_html_e( 'ÐÐ°Ð¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ', 'neksoz' ); ?></span>
                <h1 style="color: #fff; margin-bottom: 1rem; font-size: 2.5rem; line-height: 1.2;"><?php esc_html_e( 'Ð’Ð²ÐµÐ´ÐµÐ½Ð¸Ðµ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ð¾Ð³Ð¾ ÑƒÑ‡ÐµÑ‚Ð° Ð¸ ÑƒÑ‡ÐµÑ‚Ð° ÐºÐ°Ð´Ñ€Ð¾Ð² Ð½Ð° Ð¾ÑÐ½Ð¾Ð²Ðµ Ð°ÑƒÑ‚ÑÐ¾Ñ€ÑÐ¸Ð½Ð³Ð°', 'neksoz' ); ?></h1>
            </div>
        </div>
    </section>

    <section class="nk-section">
        <div class="nk-container">
            <div style="display: grid; grid-template-columns: 1fr 340px; gap: 4rem; align-items: start;">

                <article class="nk-content page-content fade-up is-visible">
                    <blockquote style="font-size: 1.15rem; color: var(--nk-primary); border-left: 4px solid var(--nk-accent); padding: 1.5rem 2rem; background: var(--nk-bg-alt); margin-bottom: 2.5rem; border-radius: 0 8px 8px 0; font-style: italic;">
                        <p style="margin: 0;"><strong>Ð¦ÐµÐ»Ð¾ÑÑ‚Ð½Ð¾Ðµ Ð¸ Ð½ÐµÐ¿Ñ€ÐµÑ€Ñ‹Ð²Ð½Ð¾Ðµ Ð¾Ñ‚Ñ€Ð°Ð¶ÐµÐ½Ð¸Ðµ Ñ…Ð¾Ð·ÑÐ¹ÑÑ‚Ð²ÐµÐ½Ð½Ñ‹Ñ… Ð¾Ð¿ÐµÑ€Ð°Ñ†Ð¸Ð¹.</strong> ÐœÑ‹ Ð±ÐµÑ€ÐµÐ¼ Ð½Ð° ÑÐµÐ±Ñ Ð²ÑÐµ Ð·Ð°Ð±Ð¾Ñ‚Ñ‹ Ð¿Ð¾ Ð²ÐµÐ´ÐµÐ½Ð¸ÑŽ Ñ„Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ð¾Ð³Ð¾ Ð¸ ÐºÐ°Ð´Ñ€Ð¾Ð²Ð¾Ð³Ð¾ ÑƒÑ‡ÐµÑ‚Ð° Ð²Ð°ÑˆÐµÐ¹ ÐºÐ¾Ð¼Ð¿Ð°Ð½Ð¸Ð¸.</p>
                    </blockquote>

                    <h3 style="margin-top: 2rem; margin-bottom: 1rem; color: var(--nk-text);"><strong>Ð¤Ð¸Ð½Ð°Ð½ÑÐ¾Ð²Ñ‹Ð¹ ÑƒÑ‡ÐµÑ‚</strong></h3>
                    <ul style="list-style: none; padding: 0; margin-bottom: 2.5rem;">
                        <?php 
                        $finance_tasks = array(
                            'ÐžÑ‚ÐºÑ€Ñ‹Ñ‚Ð¸Ðµ Ð¸ Ð·Ð°ÐºÑ€Ñ‹Ñ‚Ð¸Ðµ Ñ€Ð°ÑÑ‡ÐµÑ‚Ð½Ð¾Ð³Ð¾ ÑÑ‡ÐµÑ‚Ð° Ð¾Ñ€Ð³Ð°Ð½Ð¸Ð·Ð°Ñ†Ð¸Ð¸;',
                            'ÐŸÐ¾ÑÑ‚Ð°Ð½Ð¾Ð²ÐºÐ° ÐºÐ°ÑÑÐ¾Ð²Ð¾Ð³Ð¾ Ð°Ð¿Ð¿Ð°Ñ€Ð°Ñ‚Ð°, Ð²ÐµÐ´ÐµÐ½Ð¸Ðµ ÐºÐ°ÑÑÐ¾Ð²Ð¾Ð¹ Ð´Ð¸ÑÑ†Ð¸Ð¿Ð»Ð¸Ð½Ñ‹;',
                            'ÐŸÐ¾Ð¼Ð¾Ñ‰ÑŒ Ð² ÑÐ¾ÑÑ‚Ð°Ð²Ð»ÐµÐ½Ð¸Ð¸ Ð»ÑŽÐ±Ñ‹Ñ… Ð´Ð¾Ð³Ð¾Ð²Ð¾Ñ€Ð¾Ð²;',
                            'Ð¡Ð¾ÑÑ‚Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ ÐºÐ°ÑÑÐ¾Ð²Ñ‹Ñ… Ð¾Ñ‚Ñ‡ÐµÑ‚Ð¾Ð² Ð½Ð° Ð¾ÑÐ½Ð¾Ð²Ðµ Ð¿ÐµÑ€Ð²Ð¸Ñ‡Ð½Ð¾Ð¹ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð°Ñ†Ð¸Ð¸;',
                            'Ð’ÐµÐ´ÐµÐ½Ð¸Ðµ Ð±ÑƒÑ…Ð³Ð°Ð»Ñ‚ÐµÑ€ÑÐºÐ¾Ð³Ð¾ ÑƒÑ‡ÐµÑ‚Ð° Ð² Ð¿Ñ€Ð¾Ð³Ñ€Ð°Ð¼Ð¼Ðµ 1Ð¡;',
                            'Ð¡Ð¾ÑÑ‚Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ Ð¿Ð»Ð°Ñ‚ÐµÐ¶Ð½Ñ‹Ñ… Ð¿Ð¾Ñ€ÑƒÑ‡ÐµÐ½Ð¸Ð¹ Ð¿Ð¾ Ð½Ð°Ð»Ð¾Ð³Ð°Ð¼ Ð¸ Ð·Ð°Ð¿Ñ€Ð¾ÑÐ°Ð¼ ÐºÐ»Ð¸ÐµÐ½Ñ‚Ð¾Ð²;',
                            'Ð Ð°ÑÑ‡Ñ‘Ñ‚ Ð·Ð°Ñ€Ð°Ð±Ð¾Ñ‚Ð½Ð¾Ð¹ Ð¿Ð»Ð°Ñ‚Ñ‹;',
                            'Ð¡Ð¾ÑÑ‚Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ Ð¸ ÑÐ´Ð°Ñ‡Ð° Ð²ÑÐµÑ… Ð²Ð¸Ð´Ð¾Ð² Ð¾Ñ‚Ñ‡ÐµÑ‚Ð¾Ð² (Ð¼ÐµÑÑÑ‡Ð½Ñ‹Ðµ, ÐºÐ²Ð°Ñ€Ñ‚Ð°Ð»ÑŒÐ½Ñ‹Ðµ, Ð³Ð¾Ð´Ð¾Ð²Ñ‹Ðµ) Ð² ÑÐ¾Ð¾Ñ‚Ð²ÐµÑ‚ÑÑ‚Ð²Ð¸Ð¸ Ñ ÐœÐ¡Ð¤Ðž;'
                        );
                        foreach($finance_tasks as $t) {
                            echo '<li style="margin-bottom: 0.8rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; top: 0.4rem; width: 6px; height: 6px; background: var(--nk-accent); border-radius: 50%;"></span>
                                    ' . esc_html($t) . '
                                  </li>';
                        }
                        ?>
                    </ul>

                    <h3 style="margin-top: 2rem; margin-bottom: 1rem; color: var(--nk-text);"><strong>ÐšÐ°Ð´Ñ€Ð¾Ð²Ð¾Ðµ Ð´ÐµÐ»Ð¾Ð¿Ñ€Ð¾Ð¸Ð·Ð²Ð¾Ð´ÑÑ‚Ð²Ð¾</strong></h3>
                    <div style="background: var(--nk-bg-alt); padding: 2rem; border-radius: 12px; border: 1px solid var(--nk-border);">
                        <ul style="margin: 0; padding-left: 1.2rem; color: var(--nk-text-secondary);">
                            <li style="margin-bottom: 0.8rem;">ÐžÑ„Ð¾Ñ€Ð¼Ð»ÐµÐ½Ð¸Ðµ Ð¿Ñ€Ð¸ÐµÐ¼Ð°, Ð¿ÐµÑ€ÐµÐ²Ð¾Ð´Ð° Ð¸ ÑƒÐ²Ð¾Ð»ÑŒÐ½ÐµÐ½Ð¸Ñ Ñ€Ð°Ð±Ð¾Ñ‚Ð½Ð¸ÐºÐ¾Ð² ÑÐ¾Ð³Ð»Ð°ÑÐ½Ð¾ Ð¢Ðš Ð Ð¢;</li>
                            <li style="margin-bottom: 0.8rem;">Ð¡Ð¾ÑÑ‚Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ ÑˆÑ‚Ð°Ñ‚Ð½Ð¾Ð³Ð¾ Ñ€Ð°ÑÐ¿Ð¸ÑÐ°Ð½Ð¸Ñ Ð¸ Ð´Ð¾Ð»Ð¶Ð½Ð¾ÑÑ‚Ð½Ñ‹Ñ… Ð¸Ð½ÑÑ‚Ñ€ÑƒÐºÑ†Ð¸Ð¹;</li>
                            <li style="margin-bottom: 0.8rem;">Ð¤Ð¾Ñ€Ð¼Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ðµ Ð³Ñ€Ð°Ñ„Ð¸ÐºÐ° Ð¾Ñ‚Ð¿ÑƒÑÐºÐ¾Ð²;</li>
                            <li style="margin-bottom: 0.8rem;">ÐžÑ„Ð¾Ñ€Ð¼Ð»ÐµÐ½Ð¸Ðµ ÐºÐ¾Ð¼Ð°Ð½Ð´Ð¸Ñ€Ð¾Ð²Ð¾Ðº, Ð¾Ñ‚Ð¿ÑƒÑÐºÐ¾Ð² Ð¿Ð¾ Ð±ÐµÑ€ÐµÐ¼ÐµÐ½Ð½Ð¾ÑÑ‚Ð¸ Ð¸ Ñ€Ð¾Ð´Ð°Ð¼, Ð¿Ð¾ ÑƒÑ…Ð¾Ð´Ñƒ Ð·Ð° Ñ€ÐµÐ±ÐµÐ½ÐºÐ¾Ð¼;</li>
                            <li style="margin-bottom: 0.8rem;">Ð£Ñ‡ÐµÑ‚ Ð¸ÑÐ¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ð½Ð¸Ñ Ñ€Ð°Ð±Ð¾Ñ‡ÐµÐ³Ð¾ Ð²Ñ€ÐµÐ¼ÐµÐ½Ð¸;</li>
                            <li style="margin-bottom: 0.8rem;">Ð¡Ð¾ÑÑ‚Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ Ð²Ð½ÑƒÑ‚Ñ€ÐµÐ½Ð½Ð¸Ñ… Ð°ÐºÑ‚Ð¾Ð² Ð¸ Ð¿Ð¾Ð»Ð¾Ð¶ÐµÐ½Ð¸Ð¹;</li>
                            <li>Ð’ÐµÐ´ÐµÐ½Ð¸Ðµ Ñ‚Ñ€ÑƒÐ´Ð¾Ð²Ñ‹Ñ… ÐºÐ½Ð¸Ð¶ÐµÐº;</li>
                        </ul>
                    </div>
                </article>

                <aside class="nk-sidebar fade-up is-visible fade-up-delay-1" style="position: sticky; top: 100px;">
                    <div style="background: var(--nk-bg-alt); padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem; border: 1px solid var(--nk-border);">
                        <h4 style="font-size: 1.1rem; margin-bottom: 1rem; color: var(--nk-text);"><?php esc_html_e( 'Ð’ÑÐµ Ð½Ð°Ð¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¸Ñ', 'neksoz' ); ?></h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: 0.6rem;"><a href="<?php echo esc_url(home_url('/')); ?>" style="font-size: 0.95rem; font-weight: 500; color: var(--nk-text-secondary); transition: 0.3s;">Ðš ÑÐ¿Ð¸ÑÐºÑƒ ÑƒÑÐ»ÑƒÐ³</a></li>
                        </ul>
                    </div>
                </aside>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>