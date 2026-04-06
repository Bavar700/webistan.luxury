<?php
/**
 * Template Name: Услуга: Бизнес консультации
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
                <span class="section-label" style="color: rgba(255,255,255,0.6);"><?php esc_html_e( 'Направление', 'neksoz' ); ?></span>
                <h1 style="color: #fff; margin-bottom: 1rem; font-size: 2.5rem; line-height: 1.2;"><?php esc_html_e( 'Бизнес-консультации', 'neksoz' ); ?></h1>
            </div>
        </div>
    </section>

    <section class="nk-section">
        <div class="nk-container">
            <div style="display: grid; grid-template-columns: 1fr 340px; gap: 4rem; align-items: start;">

                <article class="nk-content page-content fade-up is-visible">
                    <h2 style="margin-top: 0; margin-bottom: 1.5rem; color: var(--nk-text);">Профессиональные консультации владельцам и руководителям</h2>
                    <p style="font-size: 1.1rem; color: var(--nk-text-secondary); line-height: 1.8; margin-bottom: 2.5rem;">Накопленный нами опыт позволяет предлагать работающие решения для повышения эффективности вашего бизнеса на любом этапе.</p>

                    <div style="display: grid; gap: 1.5rem;">
                        <div style="background: var(--nk-bg-alt); padding: 2rem; border-radius: 12px; border-left: 4px solid var(--nk-accent); transition: transform 0.3s;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <h3 style="margin-top: 0; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 12px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 50%; font-size: 0.9rem;">1</span>
                                Стратегическое управление
                            </h3>
                            <p style="margin: 0; color: var(--nk-text-secondary); padding-left: 44px;">Разработка долгосрочных целей и планов, анализ рынка и выработка стратегий конкурентного преимущества.</p>
                        </div>

                        <div style="background: var(--nk-bg-alt); padding: 2rem; border-radius: 12px; border-left: 4px solid var(--nk-accent); transition: transform 0.3s;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <h3 style="margin-top: 0; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 12px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 50%; font-size: 0.9rem;">2</span>
                                Оптимизация бизнес-процессов
                            </h3>
                            <p style="margin: 0; color: var(--nk-text-secondary); padding-left: 44px;">Аудит текущих процессов, выявление «узких мест» и внедрение решений для снижения издержек и повышения скорости работы.</p>
                        </div>

                        <div style="background: var(--nk-bg-alt); padding: 2rem; border-radius: 12px; border-left: 4px solid var(--nk-accent); transition: transform 0.3s;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <h3 style="margin-top: 0; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 12px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 50%; font-size: 0.9rem;">3</span>
                                Финансовое планирование и бюджетирование
                            </h3>
                            <p style="margin: 0; color: var(--nk-text-secondary); padding-left: 44px;">Построение эффективной системы распределения финансовых ресурсов и внедрение управленческого учета.</p>
                        </div>
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
