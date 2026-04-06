<?php
/**
 * Template Name: Услуга: Налоговые консультации
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
            <div style="max-width: 800px;">
                <span class="section-label" style="color: rgba(255,255,255,0.6);"><?php esc_html_e( 'Направление', 'neksoz' ); ?></span>
                <h1 style="color: #fff; margin-bottom: 1rem; font-size: 2.5rem; line-height: 1.2;"><?php esc_html_e( 'Налоговые консультации и налогообложение', 'neksoz' ); ?></h1>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="nk-section">
        <div class="nk-container">
            <div style="display: grid; grid-template-columns: 1fr 340px; gap: 4rem; align-items: start;">

                <!-- Main Content -->
                <article class="nk-content page-content fade-up is-visible">
                    
                    <h2 style="margin-top: 0; margin-bottom: 1.5rem; color: var(--nk-text);">Налогообложение юридических и физических лиц</h2>
                    <p style="font-size: 1.1rem; color: var(--nk-text-secondary); line-height: 1.8; margin-bottom: 2rem;">Мы предоставляем квалифицированную помощь в вопросах налогообложения, помогая компаниям и физическим лицам соблюдать законодательство, минимизировать риски и оптимизировать налоговую нагрузку.</p>

                    <div style="display: grid; gap: 1.5rem;">
                        <div style="background: var(--nk-bg-alt); padding: 2rem; border-radius: 12px; border-left: 4px solid var(--nk-accent); transition: transform 0.3s; cursor: default;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <h3 style="margin-top: 0; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 12px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 50%; font-size: 0.9rem;">1</span>
                                Налоговые консультации
                            </h3>
                            <p style="margin: 0; color: var(--nk-text-secondary); padding-left: 44px;">Разъяснение норм налогового законодательства, оценка рисков при заключении сделок и консультирование по вопросам исчисления и уплаты налогов.</p>
                        </div>

                        <div style="background: var(--nk-bg-alt); padding: 2rem; border-radius: 12px; border-left: 4px solid var(--nk-accent); transition: transform 0.3s; cursor: default;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <h3 style="margin-top: 0; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 12px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 50%; font-size: 0.9rem;">2</span>
                                Разработка налоговой политики
                            </h3>
                            <p style="margin: 0; color: var(--nk-text-secondary); padding-left: 44px;">Создание эффективной и законной системы налогового планирования, адаптированной под специфику вашей деятельности для снижения расходов.</p>
                        </div>

                        <div style="background: var(--nk-bg-alt); padding: 2rem; border-radius: 12px; border-left: 4px solid var(--nk-accent); transition: transform 0.3s; cursor: default;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <h3 style="margin-top: 0; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 12px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 50%; font-size: 0.9rem;">3</span>
                                Решение налоговых споров
                            </h3>
                            <p style="margin: 0; color: var(--nk-text-secondary); padding-left: 44px;">Сопровождение налоговых проверок, досудебное урегулирование споров и защита ваших интересов в судебных инстанциях.</p>
                        </div>
                    </div>

                </article>

                <!-- Sidebar -->
                <aside class="nk-sidebar fade-up is-visible fade-up-delay-1" style="position: sticky; top: 100px;">
                    <!-- Menu of Services -->
                    <div style="background: var(--nk-bg-alt); padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem; border: 1px solid var(--nk-border);">
                        <h4 style="font-size: 1.1rem; margin-bottom: 1rem; color: var(--nk-text);"><?php esc_html_e( 'Все направления', 'neksoz' ); ?></h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: 0.6rem;"><a href="#" style="font-size: 0.95rem; font-weight: 500; color: var(--nk-text-secondary); transition: 0.3s;">Аудит финансовой деятельности</a></li>
                            <li style="margin-bottom: 0.6rem;">
                                <a href="#" style="font-size: 0.95rem; font-weight: 600; color: var(--nk-primary); display: flex; align-items: center; gap: 8px;">
                                    <span style="width: 4px; height: 4px; background: var(--nk-accent); border-radius: 50%;"></span>
                                    Налоговые консультации
                                </a>
                            </li>
                            <li style="margin-bottom: 0.6rem;"><a href="#" style="font-size: 0.95rem; font-weight: 500; color: var(--nk-text-secondary); transition: 0.3s;">Юридические консультации</a></li>
                            <li style="margin-bottom: 0.6rem;"><a href="#" style="font-size: 0.95rem; font-weight: 500; color: var(--nk-text-secondary); transition: 0.3s;">Введение финансового учета</a></li>
                            <li style="margin-bottom: 0.6rem;"><a href="#" style="font-size: 0.95rem; font-weight: 500; color: var(--nk-text-secondary); transition: 0.3s;">Восстановление учета</a></li>
                            <li style="margin-bottom: 0.6rem;"><a href="#" style="font-size: 0.95rem; font-weight: 500; color: var(--nk-text-secondary); transition: 0.3s;">Бизнес консультации</a></li>
                        </ul>
                    </div>

                    <!-- CTA -->
                    <div style="padding: 2rem; background: var(--nk-primary-dark); border-radius: 12px; text-align: center; position: relative; overflow: hidden;">
                        <div style="position: absolute; top: -30px; right: -30px; width: 100px; height: 100px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
                        <h4 style="color: #fff; font-size: 1.1rem; margin-bottom: 0.75rem; position: relative; z-index: 1;">Столкнулись с налоговыми трудностями?</h4>
                        <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-bottom: 1.5rem; position: relative; z-index: 1;">Свяжитесь с нами для защиты ваших законных интересов.</p>
                        <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="btn btn--primary" style="width: 100%; justify-content: center; position: relative; z-index: 1;">
                            Получить консультацию
                        </a>
                    </div>
                </aside>

            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
