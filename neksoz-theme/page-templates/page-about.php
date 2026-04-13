<?php
/**
 * Template Name: О Нас
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Page Header -->
    <section class="nk-page-header uk-flex uk-flex-middle" style="min-height: 40vh; background: var(--nk-primary-dark); position: relative; overflow: hidden; padding: 60px 0;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.05; background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="nk-container uk-position-relative uk-position-z-index">
            <h1 class="fade-up is-visible" style="color: #fff; font-size: 3.5rem; margin-bottom: 1rem;"><?php esc_html_e('О компании', 'Neksoz'); ?></h1>
            <p class="fade-up is-visible fade-up-delay-1" style="color: rgba(255,255,255,0.7); font-size: 1.2rem; max-width: 100% !important;">
                ООО «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП»
            </p>
        </div>
    </section>

    <!-- Company History -->
    <section class="nk-section" style="padding-bottom: 2rem;">
        <div class="nk-container">
            <div class="fade-up is-visible">
                <p style="font-size: 1.15rem; color: var(--nk-text-secondary); line-height: 1.8; margin-bottom: 1.5rem;">Наша компания <strong>ООО «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП»</strong> была создана в 2016 году специалистом, имеющим глубокий опыт в сфере налогообложения, финансового учёта, банковского дела, а также аудита. Благодаря профессионализму и доверию клиентов, компания зарекомендовала себя как достойный игрок на национальном рынке, нацеленный на результат и достижение корпоративных целей Заказчика.</p>
                <p style="font-size: 1.15rem; color: var(--nk-text-secondary); line-height: 1.8; margin-bottom: 2.5rem;">Прозрачная бизнес-модель, оптимальная ценовая политика и опыт сплочённой команды позволяют нам покорять новые горизонты и уверенно смотреть в будущее.</p>
                
                <div style="background: var(--nk-bg-alt); padding: 2.5rem; border-radius: 12px; border-left: 4px solid var(--nk-primary); margin-bottom: 3rem;">
                    <p style="font-size: 1.15rem; color: var(--nk-text); line-height: 1.8; margin: 0;">Мы предоставляем качественные бухгалтерские и консалтинговые услуги как отечественным, так и иностранным компаниям на территории Таджикистана, в различных отраслях и любых правовых формах. Мы берем на себя ответственность за решение задач любой сложности на различных этапах существования бизнеса, подбирая оптимальный вариант в соответствии с требованиями клиента.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Goals -->
    <section class="nk-section" style="background: var(--nk-bg-alt); padding-top: 4rem; padding-bottom: 5rem;">
        <div class="nk-container">
            <div style="max-width: 100% !important; margin: 0 auto; text-align: center; margin-bottom: 4rem;" class="fade-up is-visible">
                <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: var(--nk-text);">Цель компании</h2>
                <p style="font-size: 1.2rem; color: var(--nk-text-secondary);">Цель и миссия компании проста и понятна как 2х2. Она заключается в предоставлении почвы для развития, комфорта и правильности учёта Заказчика согласно следующим принципам:</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                
                <!-- Principle 1 -->
                <div class="nk-service-card fade-up is-visible fade-up-delay-1" style="background: var(--nk-bg); padding: 2.5rem; border-radius: 12px; border: 1px solid var(--nk-border); text-align: center;">
                    <div style="width: 60px; height: 60px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; font-size: 1.5rem; font-weight: bold;">1</div>
                    <h3 style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--nk-text);">Доверяй, но проверяй</h3>
                    <p style="color: var(--nk-text-secondary); line-height: 1.6; margin: 0;">Мы строим отношения с клиентами на основе взаимного доверия, которое подкреплено и проверено результатами качественно предоставленных услуг.</p>
                </div>

                <!-- Principle 2 -->
                <div class="nk-service-card fade-up is-visible fade-up-delay-2" style="background: var(--nk-bg); padding: 2.5rem; border-radius: 12px; border: 1px solid var(--nk-border); text-align: center;">
                    <div style="width: 60px; height: 60px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; font-size: 1.5rem; font-weight: bold;">2</div>
                    <h3 style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--nk-text);">Есть проблемы? Решим!</h3>
                    <p style="color: var(--nk-text-secondary); line-height: 1.6; margin: 0;">На каждом этапе бизнеса возникают задачи. Мы анализируем ситуацию и предлагаем самый удобный и эффективный вариант решения проблем.</p>
                </div>

                <!-- Principle 3 -->
                <div class="nk-service-card fade-up is-visible fade-up-delay-3" style="background: var(--nk-bg); padding: 2.5rem; border-radius: 12px; border: 1px solid var(--nk-border); text-align: center;">
                    <div style="width: 60px; height: 60px; background: rgba(59, 130, 246, 0.1); color: var(--nk-accent); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; font-size: 1.5rem; font-weight: bold;">3</div>
                    <h3 style="font-size: 1.3rem; margin-bottom: 1rem; color: var(--nk-text);">Обязательность</h3>
                    <p style="color: var(--nk-text-secondary); line-height: 1.6; margin: 0;">«НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП» всегда исполняет все взятые на себя обязательства качественно и строго в установленные сроки.</p>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
