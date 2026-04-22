<?php
/**
 * Template Name: Terms V3
 */
if (function_exists('nk_get_current_lang')) {
    $lang = nk_get_current_lang();
    if ($lang === 'tj') { get_template_part('page-terms', 'tj'); return; }
    if ($lang === 'en') { get_template_part('page-terms', 'en'); return; }
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
                <h1 class="hero__title">Условия<br><span class="text-gradient">Использования</span></h1>
            </div>
        </div>
    </section>

    <div class="container legal-page">
        <article class="legal-content fade-up">
            <h2>1. Общие условия</h2>
            <p>Использование материалов и сервисов Сайта регулируется нормами действующего законодательства Республики Таджикистан.</p>
            <p>Настоящее Соглашение является публичной офертой. Получая доступ к материалам Сайта, Пользователь считается присоединившимся к настоящему Соглашению.</p>

            <h2>2. Обязательства Пользователя</h2>
            <p>Пользователь соглашается не предпринимать действий, которые могут рассматриваться как нарушающие законодательство РТ или нормы международного права, в том числе в сфере интеллектуальной собственности, авторских и/или смежных правах, а также любых действий, которые приводят или могут привести к нарушению нормальной работы Сайта и сервисов Сайта.</p>
            <p>Использование материалов Сайта без согласия правообладателей не допускается.</p>

            <h2>3. Прочие условия</h2>
            <p>Все возможные споры, вытекающие из настоящего Соглашения или связанные с ним, подлежат разрешению в соответствии с действующим законодательством Республики Таджикистан.</p>
            <p>Ничто в Соглашении не может пониматься как установление между Пользователем и Администрацией Сайта агентских отношений, отношений товарищества, отношений по совместной деятельности, отношений личного найма, либо каких-то иных отношений, прямо не предусмотренных Соглашением.</p>
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
