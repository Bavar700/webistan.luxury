<?php
/**
 * Template Name: Даста V3
 */
get_header(); global $current_lang; 
?>

<style>
/* ── Team Layout ─────────────────────────────────────── */
.team-container {
    padding: 100px 0;
    max-width: 1400px;
    margin: 0 auto;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

@media (max-width: 1024px) {
    .team-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .team-grid { grid-template-columns: 1fr; }
}

/* ── Team Card: Platinum V3 ────────────────────────────── */
.expert-card {
    background: var(--nk-white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 1px solid var(--nk-gray-100);
    transition: all 0.5s var(--ease);
    display: flex;
    flex-direction: column;
    position: relative;
}

.expert-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 40px 90px rgba(0, 13, 51, 0.12);
    border-color: rgba(227, 6, 19, 0.2);
}

.expert-card__visual {
    position: relative;
    aspect-ratio: 4/5;
    overflow: hidden;
    background: var(--nk-gray-50);
}

.expert-card__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s var(--ease);
    filter: grayscale(10%);
}

.expert-card__img--top {
    object-position: top center;
}

.expert-card:hover .expert-card__img {
    transform: scale(1.05);
    filter: grayscale(0%);
}


.expert-card__body {
    padding: 35px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.expert-card__role {
    font-family: var(--font-display);
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: var(--nk-red);
    margin-bottom: 12px;
}

.expert-card__name {
    font-family: var(--font-display);
    font-size: 24px;
    font-weight: 900;
    color: var(--nk-gray-900);
    line-height: 1.25;
    margin-bottom: 15px;
    letter-spacing: -0.02em;
}

.expert-card__regalia {
    font-size: 12px;
    font-weight: 700;
    color: var(--nk-blue);
    background: rgba(0, 68, 204, 0.06);
    padding: 6px 12px;
    border-radius: 6px;
    display: inline-block;
    margin-bottom: 20px;
    letter-spacing: 0.05em;
}

.expert-card__meta {
    margin-top: auto;
    padding-top: 20px;
    border-top: 1px solid var(--nk-gray-50);
}

.expert-card__info-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 13px;
}

.expert-card__label {
    color: var(--nk-gray-400);
    font-weight: 500;
}

.expert-card__value {
    color: var(--nk-gray-900);
    font-weight: 700;
    text-align: right;
}

.expert-card__spec {
    font-size: 14px;
    line-height: 1.5;
    color: var(--nk-gray-600);
    margin-bottom: 20px;
    font-weight: 400;
}

/* ── HR Block ────────────────────────────────────────── */
.hr-block {
    background: var(--nk-white);
    border-radius: var(--radius-xl);
    padding: 80px;
    margin-top: 120px;
    border: 1px solid var(--nk-gray-100);
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 60px;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.hr-block::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 100%;
    background: linear-gradient(90deg, transparent 0%, rgba(0, 68, 204, 0.02) 100%);
    pointer-events: none;
}

@media (max-width: 1024px) {
    .hr-block { grid-template-columns: 1fr; padding: 40px; text-align: center; }
    .hr-block .btn { margin: 0 auto; }
}

.hr-block__title {
    font-family: var(--font-display);
    font-size: 36px;
    font-weight: 900;
    color: var(--nk-gray-900);
    margin-bottom: 20px;
}

.hr-block__text {
    font-size: 18px;
    color: var(--nk-gray-600);
    line-height: 1.6;
    max-width: 600px;
}
</style>

<main class="site-main">

    <!-- ═══════════ PHILOSOPHY HERO ═══════════ -->
    <section class="hero hero--internal">
        <div class="hero__geo"></div>
        <div class="hero__grid-pattern"></div>
        <div class="hero__accent-line"></div>
        <div class="hero__accent-line-2"></div>

        <div class="container hero__container">
            <div class="hero__content" style="max-width: 900px;">
                <div class="hero__badge">Дастаи Neksoz</div>
                <h1 class="hero__title">
                    <span style="white-space: nowrap;">Фалсафаи касбият</span><br>
                    <span class="text-gradient" style="white-space: nowrap;">ва зеҳн</span>
                </h1>
                <p class="hero__desc" style="max-width: 750px; color: rgba(255,255,255,0.85); font-size: 1.1rem;">
                    «Дар паси ҳар як рақами ҳисобот ва ҳар як сатри шартнома зеҳни коршиносони мо пинҳон аст. Мо мутахассисонро аз соҳаҳои гуногун — аз кори бонкӣ то ҳуқуқи андоз — муттаҳид кардем, то шумо ҳимояи ҳамаҷонибаи тиҷорати худро аз ҳама ҷонибҳо ба даст оред».
                </p>
            </div>
            
            <div class="hero__actions--right">
                <div style="font-family: var(--font-display); font-size: 80px; font-weight: 900; color: rgba(255,255,255,0.05); line-height: 1; text-transform: uppercase;">
                    Intellect
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════ EXPERTS GRID ═══════════ -->
    <section class="section section--gray">
        <div class="container team-container">

            <!-- Transition Block -->
            <div class="section__header section__header--center fade-up" style="max-width: 800px; margin: 0 auto 80px;">
                <div class="section__label">Салоҳиятҳо</div>
                <h2 class="section__title">Маҳорате, ки бо солҳои таҷриба тасдиқ шудааст</h2>
                <p class="section__subtitle" style="font-size: 1.2rem; color: var(--nk-gray-600);">
                    Мо на танҳо машварат медиҳем — мо ба мушаххасоти тиҷорати шумо шинос шуда, тозагии ҳуқуқӣ ва устувории молиявиро дар ҳар як марҳилаи&nbsp;рушд таъмин мекунем.
                </p>
            </div>
            
            <div class="team-grid">

                <!-- Expert 1 -->
                <div class="expert-card fade-up">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/team-3.jpg" alt="Салимов Зоир Муминович" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Директор / Муассис</div>
                        <h3 class="expert-card__name">Салимов Зоир Муминович</h3>
                        <p class="expert-card__spec">Идоракунии стратегӣ, аудит ва нақшагирии андоз барои тиҷорати байналмилалӣ.</p>
                        
                    </div>
                </div>

                <!-- Expert 2 -->
                <div class="expert-card fade-up" style="animation-delay: 0.1s;">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/team-1.jpg" alt="Фатхуддинзода Диловар Каромат" class="expert-card__img expert-card__img--top">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Ҳуқуқшиноси калон</div>
                        <h3 class="expert-card__name">Фатхуддинзода Диловар Каромат</h3>
                        <p class="expert-card__spec">Ҳуқуқи корпоративӣ, амалияи арбитражӣ ва дастгирии ҳуқуқии лоиҳаҳои сармоягузорӣ.</p>
                        
                    </div>
                </div>

                <!-- Expert 3 -->
                <div class="expert-card fade-up" style="animation-delay: 0.2s;">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/team-2.jpg" alt="Ширинов Рустам Суҳробович" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Муҳосиб-аудитори пешбар</div>
                        <h3 class="expert-card__name">Ширинов Рустам Суҳробович</h3>
                        <p class="expert-card__spec">Пешбурди баҳисобгирии мураккаби молиявӣ ва андозӣ, омодасозии ҳисоботи молиявӣ ва аудит.</p>
                        
                    </div>
                </div>

                <!-- Expert 4 -->
                <div class="expert-card fade-up">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/team-5.jpg" alt="Қурбонов Шоҳрух Камолуддинович" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Муҳосиб-аудитори пешбар</div>
                        <h3 class="expert-card__name">Қурбонов Шоҳрух Камолуддинович</h3>
                        <p class="expert-card__spec">Дастгирии маҷмӯии молиявӣ, автоматикунонии баҳисобгирӣ дар 1С ва машварати андозӣ.</p>
                        
                    </div>
                </div>

                <!-- Expert 5 -->
                <div class="expert-card fade-up" style="animation-delay: 0.1s;">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/team-4.jpg" alt="Ливенгуд Джастин Рег" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Менеҷер оид ба рушди тиҷорат</div>
                        <h3 class="expert-card__name">Ливенгуд Джастин Рег</h3>
                        <p class="expert-card__spec">Густариши тиҷорат, ҷустуҷӯи шарикии нав ва баровардани ширкат ба бозорҳои байналмилалии консалтинг.</p>
                        
                    </div>
                </div>

                <!-- Expert 6 -->
                <div class="expert-card fade-up" style="animation-delay: 0.2s;">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/team-6.jpg" alt="Шералиева Замира Шонқулиевна" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Менеҷери кадрҳо</div>
                        <h3 class="expert-card__name">Шералиева Замира Шонқулиевна</h3>
                        <p class="expert-card__spec">Идоракунии захираҳои инсонӣ, интихоби коршиносони баландихтисос ва рушди фарҳанги корпоративӣ.</p>
                        
                    </div>
                </div>

                <!-- Expert 7 -->
                <div class="expert-card fade-up" style="animation-delay: 0.3s;">
                    <div class="expert-card__visual">
                        <img src="<?php echo get_template_directory_uri(); ?>/team-nozanin-final.jpg" alt="Шамсова Нозанин Қаюмҷоновна" class="expert-card__img">
                    </div>
                    <div class="expert-card__body">
                        <div class="expert-card__role">Сармуҳосиб, аудитори калон</div>
                        <h3 class="expert-card__name">Шамсова Нозанин Қаюмҷоновна</h3>
                        <p class="expert-card__spec">Пешбурди давраи пурраи ҳисоби муҳосибӣ ва гузаронидани аудити маҷмӯӣ барои таъмини шаффофияти молиявӣ.</p>
                        
                    </div>
                </div>

            </div>

            <!-- HR Block -->
            <div class="hr-block fade-up">
                <div class="hr-block__content">
                    <h2 class="hr-block__title">Мехоҳед узви даста шавед?</h2>
                    <p class="hr-block__text">Мо ҳамеша аз муҳосибон, аудиторон ва ҳуқуқшиносони боистеъдод, ки арзишҳои моро қабул доранд ва барои рушди касбӣ талош меварзанд, хушҳолем. Агар шумо барои ҳалли вазифаҳои мураккаб ва эҷоди арзиш барои тиҷорат омода бошед — мо ба шумо ниёз дорем.</p>
                </div>
                <div class="hr-block__actions">
                    <a href="<?php echo nk_link('/vacancies', 'tj'); ?>" class="btn btn--primary" style="width: 100%;">
                        <span>Резюме фиристед</span>
                        <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-up').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.8s var(--ease)';
        observer.observe(el);
    });
});
</script>

<?php get_footer(); ?>




