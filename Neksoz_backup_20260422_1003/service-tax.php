<?php
/**
 * Template Name: Service: Tax (RU)
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
                <div class="hero__badge"><?php echo get_field('hero_badge') ?: 'Департамент налогов'; ?></div>
                <h1 class="hero__title">
                    <?php echo get_field('hero_title') ?: 'Экспертные налоговые<br><span class="text-gradient">консультации бизнеса</span>'; ?>
                </h1>
                <p class="hero__desc">
                    <?php echo get_field('hero_desc') ?: 'Законная оптимизация налоговой нагрузки и минимизация рисков перед визитами контролирующих органов.'; ?>
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="btn btn--primary" style="padding: 16px 36px; font-size: 11px;">
                    <span><?php echo get_field('hero_button_text') ?: 'Снизить риски'; ?></span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label"><?php echo get_field('section_label') ?: 'Налоговая безопасность'; ?></div>
                <h2 class="section__title"><?php echo get_field('section_title') ?: 'Ваш законный путь к экономии'; ?></h2>
                <p class="section__subtitle"><?php echo get_field('section_subtitle') ?: 'Мы помогаем платить налоги правильно, исключая переплаты и защищая от претензий фискальных органов.'; ?></p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <?php 
                $cards = get_field('service_cards');
                if($cards): 
                    foreach($cards as $card): 
                ?>
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <?php echo $card['icon_svg'] ?: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>'; ?>
                    </div>
                    <h3 class="service-card__title"><?php echo $card['title']; ?></h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <?php 
                            $tasks = $card['tasks'];
                            if($tasks):
                                foreach($tasks as $task):
                            ?>
                            <li><?php echo $task['task_item']; ?></li>
                            <?php endforeach; endif; ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; else: ?>
                <!-- Fallback to static if no ACF (Placeholder logic) -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h3 class="service-card__title">Когда нужны консультации?</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Вы считаете, что переплачиваете налоги</li>
                            <li>Нужна подготовка к налоговой проверке</li>
                            <li>Возник сложный спор с инспекцией</li>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__header"><div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <h3 class="service-card__title">Результат для вашего бизнеса</h3></div>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Снижение налоговых выплат (законно)</li>
                            <li>Безопасность перед гос. проверками</li>
                            <li>Уверенность в каждом сомони отчислений</li>
                            <li>Отсутствие блокировок и претензий властей</li>
                            <li>Чистая кредитная и налоговая история</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Lead Form Section -->
    <section id="lead-form" class="section section--gray" style="border-top: 1px solid var(--nk-gray-100); padding-top: 40px; padding-bottom: 80px;">
        <div class="container" style="max-width: 800px;">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Налоговый аудит</div>
                <h2 class="section__title">Бесплатная экспресс-оценка</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Оставьте заявку на предварительный анализ налоговой нагрузки.<br>Мы свяжемся с вами в течение 30 минут.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="tc-name">
                            <label for="tc-name">Ваше имя</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="tc-phone">
                            <label for="tc-phone">Телефон (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="tc-company">
                        <label for="tc-company">Название компании (опционально)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn"><span>Начать оптимизацию</span><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
                    <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        Нажимая кнопку, вы соглашаетесь с <a href="<?php echo home_url('/privacy-policy'); ?>" style="color: var(--nk-blue); text-decoration: underline;">Политикой конфиденциальности</a>
                    </p>
                    <p class="cta-crystal__secure" style="text-align: center; margin-top: 20px; font-size: 13px; color: var(--nk-gray-500); opacity: 0.8; width: 100%;">
                        🛡️ Защищённое соединение (SSL 256-bit)
                    </p>
                </form>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
