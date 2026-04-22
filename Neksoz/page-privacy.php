<?php
/**
 * Template Name: Privacy V3
 */
if (function_exists('nk_get_current_lang')) {
    $lang = nk_get_current_lang();
    if ($lang === 'tj') { get_template_part('page-privacy', 'tj'); return; }
    if ($lang === 'en') { get_template_part('page-privacy', 'en'); return; }
}
get_header();
?>

<style>
/* ── Legal Page Layout ────────────────────────────────── */
.legal-page {
    padding: 100px 0;
    max-width: 900px;
    margin: 0 auto;
}

.legal-content {
    background: var(--nk-white);
    padding: 80px;
    border-radius: var(--radius-xl);
    border: 1px solid var(--nk-gray-100);
    box-shadow: 0 40px 100px rgba(0, 13, 51, 0.04);
}

@media (max-width: 768px) {
    .legal-content { padding: 40px 20px; }
}

.legal-content h2 {
    font-family: var(--font-display);
    font-size: 28px;
    font-weight: 900;
    color: var(--nk-gray-900);
    margin: 60px 0 30px;
    letter-spacing: -0.01em;
}

.legal-content h2:first-child { margin-top: 0; }

.legal-content p {
    font-size: 16px;
    line-height: 1.8;
    color: var(--nk-gray-600);
    margin-bottom: 25px;
}

.legal-content ul {
    margin-bottom: 30px;
    padding-left: 20px;
}

.legal-content li {
    font-size: 16px;
    line-height: 1.8;
    color: var(--nk-gray-600);
    margin-bottom: 15px;
    position: relative;
}
</style>

<main class="site-main">

    <!-- ═══════════ LEGAL HERO ═══════════ -->
    <section class="hero hero--internal" style="min-height: 40vh !important; padding-top: 140px !important;">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container">
            <div class="hero__content">
                <div class="hero__badge">Правовая информация</div>
                <h1 class="hero__title">Политика<br><span class="text-gradient">Конфиденциальности</span></h1>
            </div>
        </div>
    </section>

    <div class="container legal-page">
        <article class="legal-content fade-up">
            <h2>1. Общие положения</h2>
            <p>Настоящая политика обработки персональных данных составлена в соответствии с требованиями Закона Республики Таджикистан «О защите персональных данных» и определяет порядок обработки персональных данных и меры по обеспечению безопасности персональных данных ООО «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП» (далее — Оператор).</p>
            <p>Оператор ставит своей важнейшей целью и условием осуществления своей деятельности соблюдение прав и свобод человека и гражданина при обработке его персональных данных, в том числе защиты прав на неприкосновенность частной жизни, личную и семейную тайну.</p>

            <h2>2. Основные понятия, используемые в Политике</h2>
            <p>Автоматизированная обработка персональных данных — обработка персональных данных с помощью средств вычислительной техники. Блокирование персональных данных — временное прекращение обработки персональных данных (за исключением случаев, если обработка необходима для уточнения персональных данных).</p>

            <h2>3. Оператор может обрабатывать следующие персональные данные Пользователя</h2>
            <ul>
                <li>Фамилия, имя, отчество;</li>
                <li>Электронный адрес;</li>
                <li>Номера телефонов;</li>
                <li>Также на сайте происходит сбор и обработка обезличенных данных о посетителях (в т.ч. файлов «cookie») с помощью сервисов интернет-статистики.</li>
            </ul>

            <h2>4. Цели обработки персональных данных</h2>
            <p>Цель обработки персональных данных Пользователя — информирование Пользователя посредством отправки электронных писем; предоставление доступа Пользователю к сервисам, информации и/или материалам, содержащимся на веб-сайте.</p>
            <p>Также Оператор имеет право направлять Пользователю уведомления о новых продуктах и услугах, специальных предложениях и различных событиях. Пользователь всегда может отказаться от получения информационных сообщений, направив Оператору письмо на адрес info@neksoz.com.</p>

            <h2>5. Заключительные положения</h2>
            <p>Пользователь может получить любые разъяснения по интересующим вопросам, касающимся обработки его персональных данных, обратившись к Оператору с помощью электронной почты info@neksoz.com.</p>
            <p>В данном документе будут отражены любые изменения политики обработки персональных данных Оператором. Политика действует бессрочно до замены ее новой версией.</p>
        </article>
    </div>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
});
</script>

<?php get_footer(); ?>
