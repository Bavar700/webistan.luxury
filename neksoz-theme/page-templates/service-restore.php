<?php
/**
 * Template Name: Услуга: Восстановление фин. учета
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="nk-section--dark" style="padding: 60px 0; background: linear-gradient(135deg, var(--nk-primary-dark) 0%, var(--nk-primary) 100%);">
        <div class="nk-container">
            <div style="max-width: 100% !important;">
                <span class="section-label" style="color: rgba(255,255,255,0.6);"><?php esc_html_e( 'Направление', 'neksoz' ); ?></span>
                <h1 style="color: #fff; margin-bottom: 1rem; font-size: 2.5rem; line-height: 1.2;"><?php esc_html_e( 'Восстановление финансового учета', 'neksoz' ); ?></h1>
            </div>
        </div>
    </section>

    <section class="nk-section">
        <div class="nk-container">
            <div style="display: grid; grid-template-columns: 1fr 340px; gap: 4rem; align-items: start;">

                <article class="nk-content page-content fade-up is-visible">
                    <div style="background: var(--nk-bg-alt); padding: 3rem; border-radius: 12px; text-align: center; border: 1px solid var(--nk-border);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--nk-accent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 1rem;"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
                        <h2 style="margin-top: 0; margin-bottom: 1rem; color: var(--nk-text);">Восстановление финансового учета и юридическая консультация в сфере финансовой деятельности</h2>
                        <p style="font-size: 1.1rem; color: var(--nk-text-secondary); line-height: 1.6; margin: 0 auto; max-width: 100% !important;">Мы поможем привести вашу бухгалтерскую базу и документацию в полное соответствие с законодательством и подготовим всё необходимое для успешного прохождения проверок.</p>
                    </div>
                </article>

                <aside class="nk-sidebar fade-up is-visible fade-up-delay-1" style="position: sticky; top: 100px;">
                    <div style="background: var(--nk-bg-alt); padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem; border: 1px solid var(--nk-border);">
                        <h4 style="font-size: 1.1rem; margin-bottom: 1rem; color: var(--nk-text);"><?php esc_html_e( 'Все направления', 'neksoz' ); ?></h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: 0.6rem;"><a href="<?php echo esc_url(home_url('/')); ?>" style="font-size: 0.95rem; font-weight: 500; color: var(--nk-text-secondary); transition: 0.3s;">К списку услуг</a></li>
                        </ul>
                    </div>
                </aside>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
