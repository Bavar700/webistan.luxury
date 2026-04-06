<?php
/**
 * Template Name: Вакансии
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Page Header -->
    <section class="nk-section--dark" style="padding: 60px 0;">
        <div class="nk-container">
            <span class="section-label" style="color: rgba(255,255,255,0.5);"><?php esc_html_e( 'Карьера в NEKSOZ', 'neksoz' ); ?></span>
            <h1 style="color: #fff;"><?php esc_html_e( 'Вакансии', 'neksoz' ); ?></h1>
            <p style="color: rgba(255,255,255,0.7); max-width: 600px;">
                <?php esc_html_e( 'Присоединяйтесь к команде профессионалов. Мы всегда ищем талантливых специалистов, готовых расти вместе с нами.', 'neksoz' ); ?>
            </p>
        </div>
    </section>

    <!-- Vacancies -->
    <section class="nk-section">
        <div class="nk-container" style="max-width: 800px;">

            <!-- Vacancy 1 -->
            <div class="nk-accordion nk-fade-in">
                <button class="nk-accordion__header" type="button" aria-expanded="false">
                    <span><?php esc_html_e( 'Аудитор (старший)', 'neksoz' ); ?></span>
                    <span class="nk-accordion__icon">▼</span>
                </button>
                <div class="nk-accordion__body">
                    <div class="nk-accordion__content">
                        <p><strong><?php esc_html_e( 'Требования:', 'neksoz' ); ?></strong></p>
                        <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                            <li><?php esc_html_e( 'Высшее экономическое или финансовое образование', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Опыт работы в аудите от 3 лет', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Знание МСФО и национальных стандартов', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Аналитическое мышление, внимательность к деталям', 'neksoz' ); ?></li>
                        </ul>
                        <p><strong><?php esc_html_e( 'Мы предлагаем:', 'neksoz' ); ?></strong></p>
                        <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                            <li><?php esc_html_e( 'Конкурентную заработную плату', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Обучение и профессиональный рост', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Работу с крупными клиентами', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Дружный коллектив профессионалов', 'neksoz' ); ?></li>
                        </ul>
                        <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="nk-btn nk-btn--dark" style="margin-top: 0.5rem;">
                            <?php esc_html_e( 'Откликнуться', 'neksoz' ); ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Vacancy 2 -->
            <div class="nk-accordion nk-fade-in">
                <button class="nk-accordion__header" type="button" aria-expanded="false">
                    <span><?php esc_html_e( 'Бухгалтер', 'neksoz' ); ?></span>
                    <span class="nk-accordion__icon">▼</span>
                </button>
                <div class="nk-accordion__body">
                    <div class="nk-accordion__content">
                        <p><strong><?php esc_html_e( 'Требования:', 'neksoz' ); ?></strong></p>
                        <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                            <li><?php esc_html_e( 'Высшее или среднее специальное экономическое образование', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Опыт ведения бухгалтерского учёта от 1 года', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Знание 1С и налогового законодательства', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Ответственность и пунктуальность', 'neksoz' ); ?></li>
                        </ul>
                        <p><strong><?php esc_html_e( 'Мы предлагаем:', 'neksoz' ); ?></strong></p>
                        <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                            <li><?php esc_html_e( 'Стабильную оплату и соц. пакет', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Гибкий график', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Возможность профессионального развития', 'neksoz' ); ?></li>
                        </ul>
                        <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="nk-btn nk-btn--dark" style="margin-top: 0.5rem;">
                            <?php esc_html_e( 'Откликнуться', 'neksoz' ); ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Vacancy 3 -->
            <div class="nk-accordion nk-fade-in">
                <button class="nk-accordion__header" type="button" aria-expanded="false">
                    <span><?php esc_html_e( 'Юрист (корпоративное право)', 'neksoz' ); ?></span>
                    <span class="nk-accordion__icon">▼</span>
                </button>
                <div class="nk-accordion__body">
                    <div class="nk-accordion__content">
                        <p><strong><?php esc_html_e( 'Требования:', 'neksoz' ); ?></strong></p>
                        <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                            <li><?php esc_html_e( 'Высшее юридическое образование', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Опыт работы в корпоративном праве от 2 лет', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Знание гражданского и хозяйственного законодательства', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Навыки ведения переговоров', 'neksoz' ); ?></li>
                        </ul>
                        <p><strong><?php esc_html_e( 'Мы предлагаем:', 'neksoz' ); ?></strong></p>
                        <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                            <li><?php esc_html_e( 'Работу с интересными проектами', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Карьерный рост до партнёра', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Достойное вознаграждение', 'neksoz' ); ?></li>
                        </ul>
                        <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="nk-btn nk-btn--dark" style="margin-top: 0.5rem;">
                            <?php esc_html_e( 'Откликнуться', 'neksoz' ); ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Vacancy 4 -->
            <div class="nk-accordion nk-fade-in">
                <button class="nk-accordion__header" type="button" aria-expanded="false">
                    <span><?php esc_html_e( 'Налоговый консультант', 'neksoz' ); ?></span>
                    <span class="nk-accordion__icon">▼</span>
                </button>
                <div class="nk-accordion__body">
                    <div class="nk-accordion__content">
                        <p><strong><?php esc_html_e( 'Требования:', 'neksoz' ); ?></strong></p>
                        <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                            <li><?php esc_html_e( 'Высшее экономическое или юридическое образование', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Глубокое знание Налогового кодекса РТ', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Опыт налогового консультирования от 2 лет', 'neksoz' ); ?></li>
                        </ul>
                        <p><strong><?php esc_html_e( 'Мы предлагаем:', 'neksoz' ); ?></strong></p>
                        <ul style="list-style: disc; padding-left: 1.5rem; margin-bottom: 1rem;">
                            <li><?php esc_html_e( 'Профессиональное развитие и сертификацию', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Работу в ведущей консалтинговой группе', 'neksoz' ); ?></li>
                            <li><?php esc_html_e( 'Конкурентную компенсацию', 'neksoz' ); ?></li>
                        </ul>
                        <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="nk-btn nk-btn--dark" style="margin-top: 0.5rem;">
                            <?php esc_html_e( 'Откликнуться', 'neksoz' ); ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Open Application -->
            <div style="margin-top: 3rem; padding: 2.5rem; background: var(--nk-bg-alt); border-radius: var(--nk-card-radius); text-align: center;">
                <h3><?php esc_html_e( 'Не нашли подходящую вакансию?', 'neksoz' ); ?></h3>
                <p style="color: var(--nk-text-muted); margin-bottom: 1.5rem;">
                    <?php esc_html_e( 'Отправьте нам Ваше резюме — мы рассмотрим его при появлении подходящей позиции.', 'neksoz' ); ?>
                </p>
                <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="nk-btn nk-btn--gradient">
                    <?php esc_html_e( 'Отправить резюме', 'neksoz' ); ?>
                </a>
            </div>

        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
