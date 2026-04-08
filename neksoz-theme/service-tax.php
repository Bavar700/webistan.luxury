<?php
/**
 * Template Name: Налоговые консультации
 * Template Post Type: page
 * @package Neksoz
 */
get_header();
?>
<main id="primary" class="site-main">

<section class="hero" style="min-height: 55vh; display: flex; align-items: center;">
    <div class="hero__geo"></div><div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div><div class="hero__grid-pattern"></div>
    <div class="container hero__inner" style="position: relative; z-index: 2;">
        <div class="hero__content">
            <div class="hero__badge fade-up is-visible">Наши услуги</div>
            <h1 class="hero__title fade-up is-visible fade-up-delay-1">
                <span class="text-gradient">Налоговые</span><br>консультации
            </h1>
            <p class="hero__subtitle fade-up is-visible fade-up-delay-2">
                Законная оптимизация налоговой нагрузки и минимизация рисков<br>перед <strong>визитами контролирующих органов</strong>.
            </p>
            <div class="hero__actions fade-up is-visible fade-up-delay-3">
                <a href="#contacts" class="btn btn--primary">Получить консультацию <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
                <a href="<?php echo home_url('/services'); ?>" class="btn btn--outline-light">← Все услуги</a>
            </div>
        </div>
    </div>
</section>

<section class="section section--gray">
    <div class="container">
        <div class="section__header section__header--center fade-up is-visible">
            <div class="section__label">Направления</div>
            <h2 class="section__title section__title--huge">Что входит<br><span class="text-gradient">в услугу?</span></h2>
        </div>
        <div class="services-grid" style="grid-template-columns: repeat(3, 1fr);">
            <?php $services = [
                ['icon' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>', 'title' => 'Налоговое планирование', 'text' => 'Разработка оптимальной системы налогообложения под специфику вашего бизнеса.', 'alt' => false],
                ['icon' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>', 'title' => 'Налоговая оптимизация', 'text' => 'Законные методы снижения налоговой нагрузки без риска санкций от контролирующих органов.', 'alt' => true],
                ['icon' => '<path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>', 'title' => 'Защита при проверках', 'text' => 'Подготовка к налоговым проверкам. Сопровождение и защита интересов компании.', 'alt' => false],
                ['icon' => '<path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/>', 'title' => 'Подготовка деклараций', 'text' => 'Правильное заполнение и своевременная подача налоговых деклараций всех форм.', 'alt' => true],
                ['icon' => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>', 'title' => 'Сопровождение споров', 'text' => 'Представление интересов в налоговых спорах и в судебных инстанциях.', 'alt' => false],
                ['icon' => '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>', 'title' => 'Налоговый мониторинг', 'text' => 'Постоянный контроль за изменениями налогового законодательства и своевременная адаптация.', 'alt' => true],
            ]; foreach ($services as $svc): ?>
            <div class="service-card <?php echo $svc['alt'] ? 'service-card--alt' : ''; ?> fade-up is-visible">
                <div class="service-card__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><?php echo $svc['icon']; ?></svg></div>
                <h3 class="service-card__title"><?php echo $svc['title']; ?></h3>
                <p class="service-card__text"><?php echo $svc['text']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div class="fade-up is-visible">
                <div class="section__label">Наш подход</div>
                <h2 class="section__title section__title--huge">Работаем<br><span class="text-gradient">на результат</span></h2>
                <p style="color: var(--nk-gray-600); font-size: 1.05rem; line-height: 1.8; margin-bottom: 24px;">
                    Мы не просто консультируем — мы берём на себя ответственность за налоговую чистоту вашего бизнеса. Наши специалисты следят за изменениями законодательства и своевременно информируют вас.
                </p>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <?php foreach ([['18+', 'лет опыта', 'blue'], ['500+', 'клиентов', 'red'], ['0', 'штрафов', 'blue'], ['100%', 'законно', 'red']] as $stat): ?>
                    <div class="service-card <?php echo $stat[2] === 'red' ? 'service-card--alt' : ''; ?>" style="padding: 24px; text-align: center;">
                        <div style="font-size: 2rem; font-weight: 900; color: var(--nk-<?php echo $stat[2]; ?>); line-height: 1; margin-bottom: 6px;"><?php echo $stat[0]; ?></div>
                        <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--nk-gray-500); font-weight: 700; margin: 0;"><?php echo $stat[1]; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="fade-up is-visible fade-up-delay-1">
                <div style="background: linear-gradient(135deg, #f8faff 0%, white 100%); border: 1px solid var(--nk-gray-100); border-radius: 20px; padding: 44px 40px;">
                    <blockquote style="font-size: 1.15rem; font-style: italic; color: var(--nk-gray-800); line-height: 1.7; margin: 0 0 28px; font-weight: 600;">
                        «Мы помогаем законно оптимизировать налоговую нагрузку и минимизировать риски перед контролирующими органами.»
                    </blockquote>
                    <a href="#contacts" class="btn btn--primary" style="width: 100%; justify-content: center;">Получить консультацию →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contacts" class="cta-crystal">
    <div class="cta-crystal__glow cta-crystal__glow--blue"></div><div class="cta-crystal__glow cta-crystal__glow--red"></div>
    <div class="container"><div class="cta-crystal__grid">
        <div class="cta-crystal__content fade-up is-visible">
            <div class="section__label">Быстрая связь</div>
            <h2 class="cta-crystal__title"><span class="text-gradient">Оптимизируйте</span><br>налоги законно</h2>
            <p class="cta-crystal__text">Получите профессиональную налоговую консультацию. Защитите бизнес от штрафов и претензий.</p>
            <div class="cta-crystal__status"><span class="cta-crystal__status-dot"></span>Мы онлайн • Ответ в течение 15 минут</div>
        </div>
        <div class="cta-crystal__form-wrapper fade-up is-visible">
            <form action="#" class="cta-crystal__form">
                <div class="cta-crystal__field"><input type="text" placeholder=" " required id="t-name"><label for="t-name">Ваше имя</label></div>
                <div class="cta-crystal__field"><input type="tel" placeholder=" " required id="t-phone"><label for="t-phone">Телефон (+992)</label></div>
                <div class="cta-crystal__field"><textarea placeholder=" " id="t-msg" rows="3"></textarea><label for="t-msg">Ваш вопрос</label></div>
                <button type="submit" class="btn btn--primary" style="width:100%; justify-content:center;">Задать вопрос <svg class="btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></button>
            </form>
        </div>
    </div></div>
</section>
</main>
<?php get_footer(); ?>
