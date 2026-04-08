<?php
/**
 * Template Name: Контакты
 */
get_header();
?>

<main class="site-main">

    <!-- ═══════════ CINEMATIC HERO ═══════════ -->
    <section class="hero hero--internal">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container" style="position:relative;z-index:2;">
            <div class="hero__content">
                <div class="hero__badge">Обратная связь</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Мы всегда</span><br>на связи
                </h1>
                <p class="hero__desc">
                    Свяжитесь с нами любым удобным способом или оставьте заявку — мы ответим в течение часа.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="tel:+992446000000" class="btn btn--primary">Позвонить нам</a>
            </div>
        </div>
    </section>

    <div class="editorial-content">
        <div class="editorial-main">
            <h2>Офис в Душанбе</h2>
            <div class="simple-card" style="background: var(--nk-gray-50); padding: 40px;">
                <div style="margin-bottom: 30px;">
                    <h4 style="color: var(--nk-red); margin-bottom: 10px;">Адрес</h4>
                    <p style="font-size: 1.25rem; font-weight: 600; color: var(--nk-gray-900);">
                        г. Душанбе, проспект Рудаки 55, 3-й этаж
                    </p>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px;">
                    <div>
                        <h4 style="color: var(--nk-red); margin-bottom: 10px;">Телефон</h4>
                        <a href="tel:+992985641010" style="font-size: 1.25rem; font-weight: 700; color: var(--nk-gray-900);">
                            (+992) 985 64-10-10
                        </a>
                    </div>
                    <div>
                        <h4 style="color: var(--nk-red); margin-bottom: 10px;">Email</h4>
                        <a href="mailto:info@neksoz.tj" style="font-size: 1.25rem; font-weight: 700; color: var(--nk-gray-900);">
                            info@neksoz.tj
                        </a>
                    </div>
                </div>
            </div>

            <h2 style="margin-top: 60px;">Задать вопрос эксперту</h2>
            <p>Используйте форму ниже для отправки запроса. Наш дежурный консультант свяжется с вами в течение рабочего часа.</p>
            
            <form action="#" class="simple-card" style="margin-top: 30px; display: grid; gap: 20px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <input type="text" placeholder="Ваше имя" style="width: 100%; padding: 15px; border: 1px solid var(--nk-gray-200); border-radius: 8px;">
                    <input type="tel" placeholder="Ваш телефон" style="width: 100%; padding: 15px; border: 1px solid var(--nk-gray-200); border-radius: 8px;">
                </div>
                <textarea placeholder="Ваше сообщение или вопрос" rows="5" style="width: 100%; padding: 15px; border: 1px solid var(--nk-gray-200); border-radius: 8px;"></textarea>
                <button type="submit" class="btn btn--primary" style="width: fit-content;">Отправить запрос</button>
            </form>
        </div>

        <aside class="editorial-sidebar">
            <div class="simple-card" style="background: var(--nk-grad-brand); color: white; border: none;">
                <h4 style="color: white;">Режим работы</h4>
                <ul style="margin-top: 20px; list-style: none; padding: 0;">
                    <li style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Пн – Пт</span>
                        <strong>09:00 – 18:00</strong>
                    </li>
                    <li style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Суббота</span>
                        <strong>10:00 – 14:00</strong>
                    </li>
                    <li style="display: flex; justify-content: space-between; color: rgba(255,255,255,0.6);">
                        <span>Воскресенье</span>
                        <span>Выходной</span>
                    </li>
                </ul>
            </div>
        </aside>
    </div>

</main>

<?php get_footer(); ?>
