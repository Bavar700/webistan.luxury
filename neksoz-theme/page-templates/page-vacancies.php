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

    <section class="nk-page-header uk-flex uk-flex-middle" style="min-height: 40vh; background: var(--nk-primary-dark); position: relative; overflow: hidden; padding: 60px 0;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.05; background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="nk-container uk-position-relative uk-position-z-index">
            <h1 class="fade-up is-visible" style="color: #fff; font-size: 3.5rem; margin-bottom: 1rem;"><?php esc_html_e('Карьера', 'neksoz'); ?></h1>
            <p class="fade-up is-visible fade-up-delay-1" style="color: rgba(255,255,255,0.7); font-size: 1.2rem; max-width: 100% !important;">
                Станьте частью команды профессионалов
            </p>
        </div>
    </section>

    <section class="nk-section" style="padding-bottom: 6rem;">
        <div class="nk-container">
            
            <div class="fade-up is-visible" style="margin-bottom: 3rem;">
                <h2 style="font-size: 2rem; color: var(--nk-text); margin-bottom: 1rem;">Открытые вакансии</h2>
                <p style="color: var(--nk-text-secondary); font-size: 1.1rem;">Мы всегда находимся в поиске талантливых и целенаправленных специалистов.</p>
            </div>

            <!-- Vacancy Card -->
            <div class="nk-vacancy-card fade-up is-visible fade-up-delay-1" style="background: var(--nk-bg-alt); border-radius: 12px; border: 1px solid var(--nk-border); overflow: hidden;">
                <!-- Header -->
                <div style="padding: 2rem; border-bottom: 1px solid var(--nk-border); background: rgba(59, 130, 246, 0.02); display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
                    <div>
                        <h3 style="margin: 0 0 0.5rem 0; font-size: 1.5rem; color: var(--nk-text);">Помощник бухгалтера</h3>
                        <p style="margin: 0; color: var(--nk-text-secondary); font-size: 0.95rem;">Полная занятость, полный день • г. Душанбе</p>
                    </div>
                    <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="btn btn--primary">Откликнуться</a>
                </div>

                <!-- Body -->
                <div style="padding: 2.5rem 2rem;">
                    <p style="font-size: 1.05rem; line-height: 1.7; color: var(--nk-text-secondary); margin-bottom: 2rem;">Ищем помощника бухгалтера — человека, настроенного на быстрое обучение, максимально внимательного и скрупулезного в работе. Если вы не боитесь нового, легко поддаетесь обучению под руководством ведущего бухгалтера, можете справиться с большим количеством информации и любите цифры — то мы с радостью с вами познакомимся!</p>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem;">
                        
                        <div>
                            <h4 style="font-size: 1.15rem; color: var(--nk-text); margin-bottom: 1rem; display: flex; align-items: center; gap: 8px;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--nk-accent)" stroke-width="2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                Что нужно делать:
                            </h4>
                            <ul style="list-style: none; padding: 0; margin: 0; color: var(--nk-text-secondary);">
                                <li style="margin-bottom: 0.6rem; padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Работа с первичной документацией;</li>
                                <li style="margin-bottom: 0.6rem; padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Работа с платежами (клиент-банк, касса);</li>
                                <li style="margin-bottom: 0.6rem; padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Работа с поставщиками;</li>
                                <li style="margin-bottom: 0.6rem; padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Ведение кадровых документов;</li>
                                <li style="margin-bottom: 0.6rem; padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Расчет зарплаты, систематизация;</li>
                                <li style="margin-bottom: 0.6rem; padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Работа в 1С, CRM/Bitrix24 (изучение по ходу);</li>
                                <li style="margin-bottom: 0; padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Поручения ведущего бухгалтера.</li>
                            </ul>
                        </div>

                        <div>
                            <h4 style="font-size: 1.15rem; color: var(--nk-text); margin-bottom: 1rem; display: flex; align-items: center; gap: 8px;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--nk-accent)" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                Вы наш человек, если:
                            </h4>
                            <ul style="list-style: none; padding: 0; margin: 0; color: var(--nk-text-secondary);">
                                <li style="margin-bottom: 0.6rem; padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Знаете или готовы быстро разобраться в налогообложении ООО/СПД;</li>
                                <li style="margin-bottom: 0.6rem; padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Дружите с ПК, Google Docs, 1C 8, Клиент-банк;</li>
                                <li style="margin-bottom: 0.6rem; padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Исполнительны, внимательны и аккуратны;</li>
                                <li style="margin-bottom: 0; padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Готовы учиться и работать с большими объёмами информации.</li>
                            </ul>
                        </div>

                    </div>

                    <div style="margin-top: 3rem; background: var(--nk-bg); padding: 2rem; border-radius: 8px;">
                        <h4 style="font-size: 1.15rem; color: var(--nk-text); margin-bottom: 1rem; display: flex; align-items: center; gap: 8px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--nk-accent)" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            Мы предлагаем:
                        </h4>
                        <ul style="list-style: none; padding: 0; margin: 0; color: var(--nk-text-secondary); display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem;">
                            <li style="padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Обучение и рост от помощника до самостоятельного специалиста.</li>
                            <li style="padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Круг людей-единомышленников, у которых есть чему поучиться.</li>
                            <li style="padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>График работы: Пн-Пт, 08:00 — 17:00.</li>
                            <li style="padding-left: 1.2rem; position: relative;"><span style="position: absolute; left: 0; top: 0.5rem; width: 4px; height: 4px; background: var(--nk-primary); border-radius: 50%;"></span>Гибкая стартовая ЗП по итогам собеседования.</li>
                        </ul>
                    </div>

                    <div style="margin-top: 2rem; border-left: 4px solid var(--nk-accent); padding-left: 1.5rem;">
                        <p style="margin: 0; font-size: 0.95rem; color: var(--nk-text-secondary);"><strong>ОБРАЩЕНИЕ К ВАМ:</strong> Если вы дочитали вакансию до конца — это отлично. Если познакомились с нами через соцсети и можете себе объяснить, почему отправляете резюме именно нам — еще лучше! Ждем ваше резюме.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
