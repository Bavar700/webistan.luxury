<?php
/**
 * Template Name: Услуга: Введение фин. учета и кадров
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
                <span class="section-label" style="color: rgba(255,255,255,0.6);"><?php esc_html_e( 'Направление', 'Neksoz' ); ?></span>
                <h1 style="color: #fff; margin-bottom: 1rem; font-size: 2.5rem; line-height: 1.2;"><?php esc_html_e( 'Введение финансового учета и учета кадров на основе аутсорсинга', 'Neksoz' ); ?></h1>
            </div>
        </div>
    </section>

    <section class="nk-section">
        <div class="nk-container">
            <div style="display: grid; grid-template-columns: 1fr 340px; gap: 4rem; align-items: start;">

                <article class="nk-content page-content fade-up is-visible">
                    <blockquote style="font-size: 1.15rem; color: var(--nk-primary); border-left: 4px solid var(--nk-accent); padding: 1.5rem 2rem; background: var(--nk-bg-alt); margin-bottom: 2.5rem; border-radius: 0 8px 8px 0; font-style: italic;">
                        <p style="margin: 0;"><strong>Целостное и непрерывное отражение хозяйственных операций.</strong> Мы берем на себя все заботы по ведению финансового и кадрового учета вашей компании.</p>
                    </blockquote>

                    <h3 style="margin-top: 2rem; margin-bottom: 1rem; color: var(--nk-text);"><strong>Финансовый учет</strong></h3>
                    <ul style="list-style: none; padding: 0; margin-bottom: 2.5rem;">
                        <?php 
                        $finance_tasks = array(
                            'Открытие и закрытие расчетного счета организации;',
                            'Постановка кассового аппарата, ведение кассовой дисциплины;',
                            'Помощь в составлении любых договоров;',
                            'Составление кассовых отчетов на основе первичной документации;',
                            'Ведение бухгалтерского учета в программе 1С;',
                            'Составление платежных поручений по налогам и запросам клиентов;',
                            'Расчёт заработной платы;',
                            'Составление и сдача всех видов отчетов (месячные, квартальные, годовые) в соответствии с МСФО;'
                        );
                        foreach($finance_tasks as $t) {
                            echo '<li style="margin-bottom: 0.8rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; top: 0.4rem; width: 6px; height: 6px; background: var(--nk-accent); border-radius: 50%;"></span>
                                    ' . esc_html($t) . '
                                  </li>';
                        }
                        ?>
                    </ul>

                    <h3 style="margin-top: 2rem; margin-bottom: 1rem; color: var(--nk-text);"><strong>Кадровое делопроизводство</strong></h3>
                    <div style="background: var(--nk-bg-alt); padding: 2rem; border-radius: 12px; border: 1px solid var(--nk-border);">
                        <ul style="margin: 0; padding-left: 1.2rem; color: var(--nk-text-secondary);">
                            <li style="margin-bottom: 0.8rem;">Оформление приема, перевода и увольнения работников согласно ТК РТ;</li>
                            <li style="margin-bottom: 0.8rem;">Составление штатного расписания и должностных инструкций;</li>
                            <li style="margin-bottom: 0.8rem;">Формирование графика отпусков;</li>
                            <li style="margin-bottom: 0.8rem;">Оформление командировок, отпусков по беременности и родам, по уходу за ребенком;</li>
                            <li style="margin-bottom: 0.8rem;">Учет использования рабочего времени;</li>
                            <li style="margin-bottom: 0.8rem;">Составление внутренних актов и положений;</li>
                            <li>Ведение трудовых книжек;</li>
                        </ul>
                    </div>
                </article>

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

</main>

<?php get_footer(); ?>
