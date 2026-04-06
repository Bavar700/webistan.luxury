<?php
/**
 * Template Name: Ð£ÑÐ»ÑƒÐ³Ð°: Ð£ÑÐ»ÑƒÐ³Ð¸ ÑÐµÐºÑ€ÐµÑ‚Ð°Ñ€Ð¸Ð°Ñ‚Ð°
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
                <h1 style="color: #fff; margin-bottom: 1rem; font-size: 2.5rem; line-height: 1.2;"><?php esc_html_e( 'Ð£ÑÐ»ÑƒÐ³Ð¸ ÑÐµÐºÑ€ÐµÑ‚Ð°Ñ€Ð¸Ð°Ñ‚Ð° Ð¸ Ñ€ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ñ Ð½ÐµÑ€ÐµÐ·Ð¸Ð´ÐµÐ½Ñ‚Ð¾Ð²', 'neksoz' ); ?></h1>
            </div>
        </div>
    </section>

    <section class="nk-section">
        <div class="nk-container">
            <div style="display: grid; grid-template-columns: 1fr 340px; gap: 4rem; align-items: start;">

                <article class="nk-content page-content fade-up is-visible">
                    <h2 style="margin-top: 0; margin-bottom: 1.5rem; color: var(--nk-text);">ÐšÐ¾Ð¼Ð¿Ð»ÐµÐºÑÐ½Ð°Ñ Ð¿Ð¾Ð´Ð´ÐµÑ€Ð¶ÐºÐ° Ð±Ð¸Ð·Ð½ÐµÑÐ° Ð¸ Ð¸Ð½Ð¾ÑÑ‚Ñ€Ð°Ð½Ð½Ñ‹Ñ… ÑÐ¿ÐµÑ†Ð¸Ð°Ð»Ð¸ÑÑ‚Ð¾Ð²</h2>
                    
                    <h3 style="margin-top: 2rem; margin-bottom: 1rem; color: var(--nk-text);"><strong>1. ÐŸÐ¾Ð¼Ð¾Ñ‰ÑŒ Ð¸Ð½Ð¾ÑÑ‚Ñ€Ð°Ð½Ð½Ñ‹Ð¼ Ð³Ñ€Ð°Ð¶Ð´Ð°Ð½Ð°Ð¼ Ð² Ð¿Ð¾Ð»ÑƒÑ‡ÐµÐ½Ð¸Ð¸ Ð’Ð¸Ð· Ð¸ Ð¿Ð°ÐºÐµÑ‚Ð° Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð¾Ð²</strong></h3>
                    <ul style="list-style: none; padding: 0; margin-bottom: 2.5rem;">
                        <?php 
                        $sec_tasks = array(
                            'ÐŸÐ¾Ð»ÑƒÑ‡ÐµÐ½Ð¸Ðµ Ð›Ð¸Ñ†ÐµÐ½Ð·Ð¸Ð¸ Ð½Ð° Ð¿Ñ€Ð¸Ð²Ð»ÐµÑ‡ÐµÐ½Ð¸Ðµ Ð¸Ð½Ð¾ÑÑ‚Ñ€Ð°Ð½Ð½Ñ‹Ñ… Ð³Ñ€Ð°Ð¶Ð´Ð°Ð½ Ð² ÐœÐ¸Ð³Ñ€Ð°Ñ†Ð¸Ð¾Ð½Ð½Ð¾Ð¹ ÑÐ»ÑƒÐ¶Ð±Ðµ ÐœÐ¢ÐœÐ—Ð Ð Ð¢;',
                            'ÐŸÑ€Ð¸Ð³Ð»Ð°ÑˆÐµÐ½Ð¸Ðµ Ð¸ Ð¿Ñ€Ð¾Ð´Ð»ÐµÐ½Ð¸Ðµ Ð²Ð¸Ð· (Ð²Ð¸Ð´Ñ‹ Ðœ, Ðš, Ðž-2) Ð´Ð»Ñ Ð¸Ð½Ð¾ÑÑ‚Ñ€Ð°Ð½Ð½Ñ‹Ñ… ÑÐ¾Ñ‚Ñ€ÑƒÐ´Ð½Ð¸ÐºÐ¾Ð² Ð¿Ñ€ÐµÐ´Ð¿Ñ€Ð¸ÑÑ‚Ð¸Ð¹;',
                            'Ð ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ñ, Ð¿Ñ€Ð¾Ð´Ð»ÐµÐ½Ð¸Ðµ Ñ€ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ð¸ Ð² ÐžÐ’Ð˜Ð -Ðµ, Ð¿ÐµÑ€ÐµÑ€ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ñ Ð²Ð¸Ð·Ñ‹ Ð¿Ñ€Ð¸ Ð¿ÐµÑ€ÐµÐµÐ·Ð´Ðµ;',
                            'Ð¡Ð±Ð¾Ñ€ Ð½ÐµÐ¾Ð±Ñ…Ð¾Ð´Ð¸Ð¼Ñ‹Ñ… Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð¾Ð² Ð´Ð»Ñ Ð·Ð°Ð¿Ñ€Ð¾ÑÐ° Ð½Ð° Ð¿Ð¾Ð»ÑƒÑ‡ÐµÐ½Ð¸Ðµ Ñ€Ð°Ð·Ñ€ÐµÑˆÐµÐ½Ð¸Ñ Ð½Ð° Ñ€Ð°Ð±Ð¾Ñ‚Ñƒ (Ðœ Ð²Ð¸Ð·Ð°);',
                            'Ð—Ð°Ð¿Ñ€Ð¾Ñ Ð½Ð° Ð¿Ð¾Ð»ÑƒÑ‡ÐµÐ½Ð¸Ðµ ÐºÐ°Ñ€Ñ‚Ñ‹ Ñ Ð”Ð¸Ð¿ÑÐµÑ€Ð²Ð¸ÑÐ° (Ðš Ð²Ð¸Ð·Ð°).'
                        );
                        foreach($sec_tasks as $t) {
                            echo '<li style="margin-bottom: 0.8rem; padding-left: 1.5rem; position: relative; color: var(--nk-text-secondary);">
                                    <span style="position: absolute; left: 0; top: 0.4rem; width: 6px; height: 6px; background: var(--nk-accent); border-radius: 50%;"></span>
                                    ' . esc_html($t) . '
                                  </li>';
                        }
                        ?>
                    </ul>

                    <div style="display: grid; gap: 1.5rem; margin-top: 2rem;">
                        <div style="background: var(--nk-bg-alt); padding: 2rem; border-radius: 12px; border-left: 4px solid var(--nk-accent); transition: transform 0.3s;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <h3 style="margin-top: 0; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 12px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 50%; font-size: 0.9rem;">2</span>
                                ÐÑƒÑ‚ÑÐ¾Ñ€ÑÐ¸Ð½Ð³ ÑÐµÐºÑ€ÐµÑ‚Ð°Ñ€ÑÐºÐ¸Ñ… ÑƒÑÐ»ÑƒÐ³
                            </h3>
                            <p style="margin: 0; color: var(--nk-text-secondary); padding-left: 44px;">ÐŸÑ€Ð¾Ñ„ÐµÑÑÐ¸Ð¾Ð½Ð°Ð»ÑŒÐ½Ð¾Ðµ Ð²ÐµÐ´ÐµÐ½Ð¸Ðµ Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð¾Ð¾Ð±Ð¾Ñ€Ð¾Ñ‚Ð°, Ð¾Ð±Ñ€Ð°Ð±Ð¾Ñ‚ÐºÐ° ÐºÐ¾Ñ€Ñ€ÐµÑÐ¿Ð¾Ð½Ð´ÐµÐ½Ñ†Ð¸Ð¸ Ð¸ Ð¾Ñ€Ð³Ð°Ð½Ð¸Ð·Ð°Ñ†Ð¸Ñ Ð¾Ñ„Ð¸ÑÐ½Ð¾Ð¹ Ñ€Ð°Ð±Ð¾Ñ‚Ñ‹ Ð±ÐµÐ· Ð½ÐµÐ¾Ð±Ñ…Ð¾Ð´Ð¸Ð¼Ð¾ÑÑ‚Ð¸ Ð½Ð°Ð¹Ð¼Ð° ÑˆÑ‚Ð°Ñ‚Ð½Ð¾Ð³Ð¾ ÑÐ¾Ñ‚Ñ€ÑƒÐ´Ð½Ð¸ÐºÐ°.</p>
                        </div>

                        <div style="background: var(--nk-bg-alt); padding: 2rem; border-radius: 12px; border-left: 4px solid var(--nk-accent); transition: transform 0.3s;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <h3 style="margin-top: 0; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 12px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 50%; font-size: 0.9rem;">3</span>
                                ÐŸÐµÑ€ÐµÐ²Ð¾Ð´ ÑŽÑ€Ð¸Ð´Ð¸Ñ‡ÐµÑÐºÐ¸Ñ… Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð¾Ð²
                            </h3>
                            <p style="margin: 0; color: var(--nk-text-secondary); padding-left: 44px;">Ð¢Ð¾Ñ‡Ð½Ñ‹Ð¹ Ð¸ ÑŽÑ€Ð¸Ð´Ð¸Ñ‡ÐµÑÐºÐ¸ Ð³Ñ€Ð°Ð¼Ð¾Ñ‚Ð½Ñ‹Ð¹ Ð¿ÐµÑ€ÐµÐ²Ð¾Ð´ Ð´Ð¾Ð³Ð¾Ð²Ð¾Ñ€Ð¾Ð², ÑƒÑÑ‚Ð°Ð²Ð¾Ð² Ð¸ Ð¸Ð½Ñ‹Ñ… ÐºÐ¾Ñ€Ð¿Ð¾Ñ€Ð°Ñ‚Ð¸Ð²Ð½Ñ‹Ñ… Ð´Ð¾ÐºÑƒÐ¼ÐµÐ½Ñ‚Ð¾Ð².</p>
                        </div>
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
