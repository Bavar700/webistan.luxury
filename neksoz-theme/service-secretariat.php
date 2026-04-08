<?php
/**
 * Template Name: Услуги секретариата
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
                <div class="hero__badge">Административный отдел</div>
                <h1 class="hero__title">
                    <span class="text-gradient">Секретариат</span><br>и визовая поддержка
                </h1>
                <p class="hero__desc">
                    Делегирование администрирования документации и регистрации иностранных сотрудников профессионалам.
                </p>
            </div>
            
            <div class="hero__actions--right">
                <a href="#lead-form" class="cta-crystal__btn" style="padding: 18px 50px; font-size: 13px;">
                    <span>Оформить документы</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ═══════════ 2-COLUMN CARD GRID ═══════════ -->
    <section class="section">
        <div class="container">
            <div class="section__header section__header--center" style="margin-bottom: 60px;">
                <div class="section__label">Миграционный комплаенс</div>
                <h2 class="section__title">Легальность и мобильность штата</h2>
                <p class="section__subtitle">Мы берем на себя всю бюрократию, чтобы ваши специалисты могли работать без лишних пауз.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(2, 1fr); gap: 40px;">
                
                <!-- CARD 1: В каких случаях вам нужна эта услуга? -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    </div>
                    <h3 class="service-card__title">Когда нужна <br>поддержка?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Привлечение иностранных специалистов</li>
                            <li>Оформление рабочих виз (тип M)</li>
                            <li>Продление регистрации в ОВИР</li>
                            <li>Работа с Дипсервисом (тип K)</li>
                            <li>Требуется перевод юр. документов</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 2: Что входит в услугу -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <h3 class="service-card__title">Что входит <br>в услугу?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Лицензии на привлечение граждан (МТМЗН)</li>
                            <li>Оформление приглашений и разрешений</li>
                            <li>Продление виз (типы M, K, O-2)</li>
                            <li>Получение карт от Дипсервиса</li>
                            <li>Профессиональный перевод документов</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 3: Как мы работаем -->
                <div class="service-card service-card--alt" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    </div>
                    <h3 class="service-card__title">Как мы <br>работаем?</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Определение типа виз и списка документов</li>
                            <li>Проверка бумаг на соответствие закону</li>
                            <li>Подача документов в гос. органы</li>
                            <li>Взаимодействие с миграционной службой</li>
                            <li>Передача готовых разрешений клиенту</li>
                        </ul>
                    </div>
                </div>

                <!-- CARD 4: Что вы получаете в итоге -->
                <div class="service-card" style="height: 100%;">
                    <div class="service-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3 class="service-card__title">Результат для <br>вашего бизнеса</h3>
                    <div class="service-card__tasks">
                        <ul class="service-card__list">
                            <li>Легальный статус всех иностранных спецов</li>
                            <li>Отсутствие проблем с законодательством</li>
                            <li>Снятие нагрузки с руководства компании</li>
                            <li>Быстрые сроки оформления пропусков</li>
                            <li>Корректно переведенная документация</li>
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
                <div class="section__label">Визовая оценка</div>
                <h2 class="section__title">Бесплатная консультация</h2>
                <p class="section__subtitle" style="margin-bottom: 0;">Оставьте заявку на предварительную миграционную оценку. Мы свяжемся с вами в течение 30 минут.</p>
            </div>

            <div class="cta-crystal__form-box" style="background: var(--nk-white); padding: 60px; border-radius: 32px; box-shadow: 0 40px 100px rgba(0, 13, 51, 0.08); border: 1px solid var(--nk-gray-50);">
                <form class="cta-crystal__form" action="#" method="POST" style="display: grid; gap: 24px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div class="cta-crystal__field">
                            <input type="text" placeholder=" " required id="ss-name">
                            <label for="ss-name">Ваше имя</label>
                        </div>
                        <div class="cta-crystal__field">
                            <input type="tel" placeholder=" " required id="ss-phone">
                            <label for="ss-phone">Телефон (+992)</label>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " id="ss-company">
                        <label for="ss-company">Название компании (опционально)</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn" style="width: 100%; justify-content: center; height: 64px; margin-top: 10px;">
                        <span>Получить визу</span>
                    </button>
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
