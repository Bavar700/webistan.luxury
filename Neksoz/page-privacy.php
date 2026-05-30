<?php
/**
 * Template Name: Privacy V3
 */
if (function_exists('nk_get_current_lang')) {
    $lang = nk_get_current_lang();
    if ($lang === 'tj') { get_template_part('page-privacy', 'tj'); return; }
    if ($lang === 'en') { get_template_part('page-privacy', 'en'); return; }
}
get_header(); global $current_lang; 
?>

<main class="legal-page">
    <!-- ═══════════ CINEMATIC HERO ═══════════ -->
    <section class="hero hero--internal">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container" style="position:relative;z-index:2;">
            <div class="hero__content">
                <div class="hero__badge">Правовая информация</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Политика Конфиденциальности</span>
                </h1>
                <p class="hero__desc" style="max-width: 600px;">
                    Официальная информация о правилах использования сайта, обработке персональных данных и нашей ответственности.
                </p>
            </div>
            
            <div class="hero__actions--right">
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="legal-content" style="padding-top: 100px; padding-bottom: 120px;">
        <div class="nx-container">
            <div class="service-card" style="padding: 60px; max-width: 960px; margin: 0 auto; min-height: auto; cursor: default; transform: none; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.05);">
                
                <!-- Privacy Policy -->
                <article class="legal-block" style="margin-bottom: 80px;">
                    <h2 style="font-size: 28px; color: var(--nk-blue); margin-bottom: 32px; font-family: var(--font-display); border-bottom: 1px solid var(--nk-gray-200); padding-bottom: 20px;">
                        Политика Конфиденциальности
                    </h2>
                    <p style="font-size: 16px; line-height: 1.8; color: var(--nk-gray-800); margin-bottom: 40px;">
                        ООО «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП» (далее — «Компания») уделяет большое внимание защите ваших персональных данных. Данная Политика объясняет, как мы собираем, используем и защищаем информацию, которую вы предоставляете при использовании нашего сайта.
                    </p>

                    <div style="display: grid; gap: 40px;">
                        <div class="legal-section">
                            <h3 style="font-size: 18px; margin-bottom: 16px; color: var(--nk-gray-900);">1. Сбор Информации</h3>
                            <p style="margin-bottom: 20px; color: var(--nk-gray-600);">Мы собираем только те данные, которые необходимы для связи с вами и предоставления качественных консультаций:</p>
                            <ul style="list-style: none; padding: 0; display: grid; gap: 12px;">
                                <li style="padding-left: 24px; position: relative; color: var(--nk-gray-700);"><span style="color: var(--nk-blue); position: absolute; left: 0;">•</span> <strong>Имя:</strong> для персонализированного обращения.</li>
                                <li style="padding-left: 24px; position: relative; color: var(--nk-gray-700);"><span style="color: var(--nk-blue); position: absolute; left: 0;">•</span> <strong>Номер телефона:</strong> для оперативной связи и уточнения деталей запроса.</li>
                                <li style="padding-left: 24px; position: relative; color: var(--nk-gray-700);"><span style="color: var(--nk-blue); position: absolute; left: 0;">•</span> <strong>Название компании:</strong> для понимания специфики вашего бизнеса перед консультацией.</li>
                                <li style="padding-left: 24px; position: relative; color: var(--nk-gray-700);"><span style="color: var(--nk-blue); position: absolute; left: 0;">•</span> <strong>E-mail:</strong> для отправки коммерческих предложений и отчетов.</li>
                            </ul>
                        </div>

                        <div class="legal-section">
                            <h3 style="font-size: 18px; margin-bottom: 16px; color: var(--nk-gray-900);">2. Цели Использования Данных</h3>
                            <p style="color: var(--nk-gray-600); line-height: 1.7;">Ваша информация используется исключительно для предоставления профессиональных услуг (аудит, бухгалтерия, консалтинг), улучшения качества обслуживания и соблюдения законодательных требований Республики Таджикистан.</p>
                        </div>

                        <div class="legal-section">
                            <h3 style="font-size: 18px; margin-bottom: 16px; color: var(--nk-gray-900);">3. Защита Данных и Конфиденциальность</h3>
                            <p style="color: var(--nk-gray-600); line-height: 1.7;">Мы применяем современные технические и организационные меры безопасности. Доступ к персональной информации ограничен сотрудниками, непосредственно участвующими в предоставлении услуги, и все они связаны соглашениями о неразглашении (NDA).</p>
                        </div>

                        <div class="legal-section">
                            <h3 style="font-size: 18px; margin-bottom: 16px; color: var(--nk-gray-900);">4. Передача Третьим Лицам</h3>
                            <p style="color: var(--nk-gray-600); line-height: 1.7;">Мы не продаем и не передаем ваши данные третьим лицам для маркетинговых целей. Раскрытие информации возможно только в случаях, предусмотренных законом.</p>
                        </div>

                        <div class="legal-section">
                            <h3 style="font-size: 18px; margin-bottom: 16px; color: var(--nk-gray-900);">5. Ваши Права</h3>
                            <p style="color: var(--nk-gray-600); line-height: 1.7;">Вы имеете право в любое время запросить удаление ваших данных из нашей базы или изменить их, связавшись с нами по адресу: <a href="mailto:info@neksoz.tj" style="color: var(--nk-blue); font-weight: 500;">info@neksoz.tj</a>.</p>
                        </div>
                    </div>
                </article>

                <!-- Terms of Use -->
                <article class="legal-block">
                    <h2 style="font-size: 28px; color: var(--nk-blue); margin-bottom: 32px; font-family: var(--font-display); border-bottom: 1px solid var(--nk-gray-200); padding-bottom: 20px;">
                        Пользовательское Соглашение и Условия
                    </h2>
                    <p style="font-size: 16px; line-height: 1.8; color: var(--nk-gray-800); margin-bottom: 40px;">
                        Добро пожаловать на сайт компании "НЕКСОЗ". Используя наш ресурс, вы соглашаетесь со следующими условиями. Пожалуйста, внимательно ознакомьтесь с ними.
                    </p>

                    <div style="display: grid; gap: 40px;">
                        <div class="legal-section">
                            <h3 style="font-size: 18px; margin-bottom: 16px; color: var(--nk-gray-900);">1. Общие Положения</h3>
                            <p style="color: var(--nk-gray-600); line-height: 1.7;">Контент данного сайта носит информационный характер. Информация о наших услугах не является публичной офертой, а служит для ознакомления с компетенциями Компании.</p>
                        </div>

                        <div class="legal-section">
                            <h3 style="font-size: 18px; margin-bottom: 16px; color: var(--nk-gray-900);">2. Использование Материалов Сайта</h3>
                            <p style="color: var(--nk-gray-600); line-height: 1.7;">Весь контент является интеллектуальной собственностью ООО «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП». Любое копирование допускается только с письменного согласия или с активной ссылкой на первоисточник.</p>
                        </div>

                        <div class="legal-section">
                            <h3 style="font-size: 18px; margin-bottom: 16px; color: var(--nk-gray-900);">3. Ограничение Ответственности</h3>
                            <p style="color: var(--nk-gray-600); line-height: 1.7;">Компания не несет ответственности за решения, принятые пользователем на основе открытых статей без прямой консультации, а также за временные технические сбои в работе сайта.</p>
                        </div>

                        <div class="legal-section">
                            <h3 style="font-size: 18px; margin-bottom: 16px; color: var(--nk-gray-900);">4. Конфиденциальность Услуг</h3>
                            <p style="color: var(--nk-gray-600); line-height: 1.7;">Все детали взаимодействия в ходе сотрудничества регулируются отдельным Договором на оказание услуг со строгими условиями конфиденциальности.</p>
                        </div>

                        <div class="legal-section">
                            <h3 style="font-size: 18px; margin-bottom: 16px; color: var(--nk-gray-900);">5. Изменение Условий</h3>
                            <p style="color: var(--nk-gray-600); line-height: 1.7;">Компания оставляет за собой право обновлять данные Условия. Актуальная версия всегда доступна на этой странице.</p>
                        </div>
                    </div>
                </article>

            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>