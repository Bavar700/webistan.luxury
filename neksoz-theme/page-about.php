<?php
/**
 * Template Name: О нас
 * Template Post Type: page
 *
 * @package Neksoz
 */

get_header();
?>

<main id="primary" class="site-main">

<!-- ═══════════ PAGE HERO ═══════════ -->
<section class="hero" style="min-height: 55vh; display: flex; align-items: center;">
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    <div class="container hero__inner" style="position: relative; z-index: 2;">
        <div class="hero__content">
            <div class="hero__badge fade-up is-visible">О компании</div>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1">
                <span class="text-gradient">Ваш стратегический</span><br>бизнес-партнёр
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                ООО «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП» — основана в 2016 году.<br>
                Мы эволюционировали из узкопрофильной фирмы в <strong>мощный консалтинговый хаб</strong> Таджикистана.
            </p>
        </div>
    </div>
</section>

<!-- ═══════════ WHO WE ARE ═══════════ -->
<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center;">
            <div class="fade-up is-visible">
                <div class="section__label">О нас</div>
                <h2 class="section__title section__title--huge">
                    <span class="text-gradient">18 лет</span><br>на страже вашего бизнеса
                </h2>
                <p style="font-size: 1.1rem; color: var(--nk-gray-600); line-height: 1.8; margin-bottom: 1.5rem;">
                    Наша компания была создана человеком, уже имеющим глубокий опыт в сфере налогообложения, финансового учёта и банковского дела. Благодаря профессионализму и доверию клиентов, компания зарегистрировала себя как достойный игрок на национальном рынке.
                </p>
                <p style="font-size: 1.1rem; color: var(--nk-gray-600); line-height: 1.8; margin-bottom: 2rem;">
                    ООО «НЕКСОЗ БКГ» предоставляет качественные бухгалтерские услуги как таджикским, так и иностранным компаниям на территории Таджикистана в разных отраслях, любой правовой юридической формы.
                </p>
                <a href="#contacts" class="btn btn--primary">
                    Бесплатная консультация
                    <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="fade-up is-visible fade-up-delay-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="service-card" style="text-align: center; padding: 40px 20px;">
                    <div style="font-size: 3rem; font-weight: 900; color: var(--nk-blue); line-height: 1; margin-bottom: 10px;">500<span style="color: var(--nk-red);">+</span></div>
                    <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); font-weight: 700; margin: 0;">Клиентов</p>
                </div>
                <div class="service-card service-card--alt" style="text-align: center; padding: 40px 20px;">
                    <div style="font-size: 3rem; font-weight: 900; color: var(--nk-red); line-height: 1; margin-bottom: 10px;">18<span style="color: var(--nk-blue);">+</span></div>
                    <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); font-weight: 700; margin: 0;">Лет опыта</p>
                </div>
                <div class="service-card service-card--alt" style="text-align: center; padding: 40px 20px;">
                    <div style="font-size: 3rem; font-weight: 900; color: var(--nk-red); line-height: 1; margin-bottom: 10px;">50<span style="color: var(--nk-blue);">+</span></div>
                    <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); font-weight: 700; margin: 0;">Экспертов</p>
                </div>
                <div class="service-card" style="text-align: center; padding: 40px 20px;">
                    <div style="font-size: 3rem; font-weight: 900; color: var(--nk-blue); line-height: 1; margin-bottom: 10px;">1200<span style="color: var(--nk-red);">+</span></div>
                    <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); font-weight: 700; margin: 0;">Проектов</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ MISSION & PRINCIPLES ═══════════ -->
<section class="section section--gray">
    <div class="container">
        <div class="section__header section__header--center fade-up is-visible">
            <div class="section__label">Наша миссия</div>
            <h2 class="section__title section__title--huge"><span class="text-gradient">Цель компании</span></h2>
            <p class="section__subtitle section__subtitle--free">
                Цель и миссия компании проста и понятна как 2×2. Она заключается в предоставлении почвы развития,<br>
                <strong>комфорта и правильности учёта</strong> Заказчика согласно следующим принципам:
            </p>
        </div>
        <div class="services-grid" style="grid-template-columns: repeat(3, 1fr);">
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="service-card__title">Доверяй, но проверяй</h3>
                <p class="service-card__text">«НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП» строит отношения с клиентами на основе взаимного доверия, которое подкреплено и проверено результатами предоставленных услуг.</p>
            </div>
            <div class="service-card service-card--alt fade-up is-visible fade-up-delay-1">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                </div>
                <h3 class="service-card__title">Есть проблемы? Решим!</h3>
                <p class="service-card__text">На каждом этапе бизнеса есть задачи. «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП» анализирует ситуацию и предлагает удобный и эффективный вариант решения любых бизнес-проблем.</p>
            </div>
            <div class="service-card fade-up is-visible fade-up-delay-2">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="service-card__title">Обязательность</h3>
                <p class="service-card__text">«НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП» исполняет все взятые на себя обязательства качественно и в срок. Это не просто слова — это наш стандарт работы с каждым клиентом.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ CEO EDITORIAL ═══════════ -->
<section id="about" class="about section">
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    <div class="ceo-editorial fade-up is-visible">
        <div class="section__label section__label--on-dark">Руководство</div>
        <h2 class="section__title section__title--huge section__title--on-dark">
            <span class="text-gradient">Ваш стратегический</span><br>бизнес-партнер
        </h2>
        <p class="ceo-editorial__intro">
            ООО «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП» — основана в 2016 году. За это время мы эволюционировали из узкопрофильной фирмы в <strong>мощный консалтинговый хаб</strong>, обеспечивая устойчивость и безопасность бизнеса на каждом этапе роста.
        </p>
        <div class="ceo-editorial__quote-card">
            <blockquote class="ceo-editorial__quote-text">
                Наша миссия — превратить сложные бизнес-процессы в прозрачную и прибыльную систему. Мы работаем на ваш результат и обеспечиваем защиту Ваших интересов на высшем уровне.
            </blockquote>
            <div class="ceo-editorial__author">
                <div class="ceo-editorial__circle-frame">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ceo.jpg" alt="Зоир Салимов" class="ceo-editorial__avatar">
                </div>
                <div class="cea-editorial__author-info">
                    <div class="ceo-editorial__author-name">Зоир Салимов</div>
                    <div class="ceo-editorial__author-title">Генеральный директор, NEKSOZ</div>
                </div>
                <div class="ceo-editorial__signature">Zoir Salimov</div>
                <div class="ceo-editorial__footer">
                    <a href="#contacts" class="ceo-editorial__team-link">
                        Связаться с нами
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ CTA ═══════════ -->
<section id="contacts" class="cta-crystal">
    <div class="cta-crystal__glow cta-crystal__glow--blue"></div>
    <div class="cta-crystal__glow cta-crystal__glow--red"></div>
    <div class="container">
        <div class="cta-crystal__grid">
            <div class="cta-crystal__content fade-up is-visible">
                <div class="section__label">Быстрая связь</div>
                <h2 class="cta-crystal__title"><span class="text-gradient">Готовы начать</span><br>сотрудничество?</h2>
                <p class="cta-crystal__text">Оставьте заявку сегодня, и мы разработаем для вас персональную стратегию развития и защиты вашего бизнеса.</p>
                <div class="cta-crystal__status">
                    <span class="cta-crystal__status-dot"></span>
                    Мы онлайн • Ответ в течение 15 минут
                </div>
            </div>
            <div class="cta-crystal__form-wrapper fade-up is-visible">
                <form action="#" class="cta-crystal__form">
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " required id="about-name">
                        <label for="about-name">Ваше имя</label>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="tel" placeholder=" " required id="about-phone">
                        <label for="about-phone">Телефон (+992)</label>
                    </div>
                    <div class="cta-crystal__field">
                        <textarea placeholder=" " id="about-msg" rows="3"></textarea>
                        <label for="about-msg">Сообщение</label>
                    </div>
                    <button type="submit" class="btn btn--primary" style="width: 100%; justify-content: center;">
                        Отправить заявку
                        <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>
