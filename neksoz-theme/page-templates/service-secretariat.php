<?php
/**
 * Template Name: Услуга: Услуги секретариата
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
                <h1 style="color: #fff; margin-bottom: 1rem; font-size: 2.5rem; line-height: 1.2;"><?php esc_html_e( 'Услуги секретариата и регистрация нерезидентов', 'neksoz' ); ?></h1>
            </div>
        </div>
    </section>

    <section class="nk-section">
        <div class="nk-container">
            <div style="display: grid; grid-template-columns: 1fr 340px; gap: 4rem; align-items: start;">

                <article class="nk-content page-content fade-up is-visible">
                    <h2 style="margin-top: 0; margin-bottom: 1.5rem; color: var(--nk-text);">Комплексная поддержка бизнеса и иностранных специалистов</h2>
                    
                    <h3 style="margin-top: 2rem; margin-bottom: 1rem; color: var(--nk-text);"><strong>1. Помощь иностранным гражданам в получении Виз и пакета документов</strong></h3>
                    <ul style="list-style: none; padding: 0; margin-bottom: 2.5rem;">
                        <?php 
                        $sec_tasks = array(
                            'Получение Лицензии на привлечение иностранных граждан в Миграционной службе МТМЗН РТ;',
                            'Приглашение и продление виз (виды М, К, О-2) для иностранных сотрудников предприятий;',
                            'Регистрация, продление регистрации в ОВИР-е, перерегистрация визы при переезде;',
                            'Сбор необходимых документов для запроса на получение разрешения на работу (М виза);',
                            'Запрос на получение карты с Дипсервиса (К виза).'
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
                                Аутсорсинг секретарских услуг
                            </h3>
                            <p style="margin: 0; color: var(--nk-text-secondary); padding-left: 44px;">Профессиональное ведение документооборота, обработка корреспонденции и организация офисной работы без необходимости найма штатного сотрудника.</p>
                        </div>

                        <div style="background: var(--nk-bg-alt); padding: 2rem; border-radius: 12px; border-left: 4px solid var(--nk-accent); transition: transform 0.3s;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'">
                            <h3 style="margin-top: 0; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 12px;">
                                <span style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 50%; font-size: 0.9rem;">3</span>
                                Перевод юридических документов
                            </h3>
                            <p style="margin: 0; color: var(--nk-text-secondary); padding-left: 44px;">Точный и юридически грамотный перевод договоров, уставов и иных корпоративных документов.</p>
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
