<?php
/**
 * Template Name: Услуга: Юридические консультации
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Hero Banner -->
    <section class="nk-section--dark" style="padding: 60px 0; background: linear-gradient(135deg, var(--nk-primary-dark) 0%, var(--nk-primary) 100%);">
        <div class="nk-container">
            <div style="max-width: 100% !important;">
                <span class="section-label" style="color: rgba(255,255,255,0.6);"><?php esc_html_e( 'Направление', 'Neksoz' ); ?></span>
                <h1 style="color: #fff; margin-bottom: 1rem; font-size: 2.5rem; line-height: 1.2;"><?php esc_html_e( 'Регистрация и юридическое сопровождение', 'Neksoz' ); ?></h1>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="nk-section">
        <div class="nk-container">
            <div style="display: grid; grid-template-columns: 1fr 340px; gap: 4rem; align-items: start;">

                <!-- Main Content -->
                <article class="nk-content page-content fade-up is-visible">
                    
                    <h2 style="margin-top: 0; margin-bottom: 1.5rem; color: var(--nk-text);">Юридические консультации и сделки</h2>
                    <p style="font-size: 1.1rem; color: var(--nk-text-secondary); line-height: 1.8; margin-bottom: 2.5rem;">Мы обеспечиваем полное правовое сопровождение вашего бизнеса, от регистрации до решения сложнейших юридических задач.</p>

                    <div style="display: grid; gap: 1.5rem;">
                        <div style="background: var(--nk-bg-alt); padding: 2rem; border-radius: 12px; border-left: 4px solid var(--nk-accent); transition: transform 0.3s;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <h3 style="margin-top: 0; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 12px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 50%; font-size: 0.9rem;">1</span>
                                Регистрация и перерегистрация
                            </h3>
                            <p style="margin: 0; color: var(--nk-text-secondary); padding-left: 44px;">Регистрация и перерегистрация компании в компетентных органах, обеспечение соответствия всех учредительных документов требованиям законодательства.</p>
                        </div>

                        <div style="background: var(--nk-bg-alt); padding: 2rem; border-radius: 12px; border-left: 4px solid var(--nk-accent); transition: transform 0.3s;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <h3 style="margin-top: 0; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 12px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 50%; font-size: 0.9rem;">2</span>
                                Сделки с недвижимостью
                            </h3>
                            <p style="margin: 0; color: var(--nk-text-secondary); padding-left: 44px;">Полное юридическое сопровождение сделок с недвижимостью: проверка чистоты объектов, подготовка договоров и регистрация прав.</p>
                        </div>
                    </div>

                </article>

                <!-- Sidebar -->
                <aside class="nk-sidebar fade-up is-visible fade-up-delay-1" style="position: sticky; top: 100px;">
                    <div style="background: var(--nk-bg-alt); padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem; border: 1px solid var(--nk-border);">
                        <h4 style="font-size: 1.1rem; margin-bottom: 1rem; color: var(--nk-text);"><?php esc_html_e( 'Все направления', 'Neksoz' ); ?></h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: 0.6rem;"><a href="<?php echo esc_url(home_url('/')); ?>" style="font-size: 0.95rem; font-weight: 500; color: var(--nk-text-secondary); transition: 0.3s;">К списку услуг</a></li>
                        </ul>
                    </div>
                </aside>

            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
