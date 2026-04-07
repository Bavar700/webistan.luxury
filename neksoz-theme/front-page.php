<?php get_header(); ?>
<main id='primary' class='site-main'>
<section class="hero">
    <div class="hero__geo"></div>
    <div class="hero__grid-pattern"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>

    <div class="container hero__container" style="position:relative;z-index:2;">
        <div class="hero__content">
            <div class="hero__badge">Бизнес-консалтинг</div>
            <h1 class="hero__title">
                Будем<br><em>решать!</em>
            </h1>
            <p class="hero__desc">
                Профессиональный аудит, налоговое планирование и юридическое сопровождение бизнеса. Надёжность и экспертность для Вашего успеха.
            </p>
        </div>
        <div class="hero__actions--right">
            <a href="#services" class="btn btn--primary btn-animated">
                Наши услуги
                <svg class="btn__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
            <a href="#contacts" class="btn btn--outline-light btn-animated-light">Связаться с нами</a>
        </div>
    </div>
</section>

<!-- ═══════════ STATS RIBBON ═══════════ -->
<section class="stats-ribbon">
    <div class="container">
        <div class="stats-ribbon__inner">
            <!-- 1 -->
            <div class="stats-card">
                <div class="stats-card__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <div class="stats-card__value">500<span>+</span></div>
                    <div class="stats-card__label">Клиентов</div>
                </div>
            </div>
            <!-- 2 -->
            <div class="stats-card">
                <div class="stats-card__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <div class="stats-card__value">18<span>+</span></div>
                    <div class="stats-card__label">Лет опыта</div>
                </div>
            </div>
            <!-- 3 -->
            <div class="stats-card">
                <div class="stats-card__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/></svg>
                </div>
                <div>
                    <div class="stats-card__value">50<span>+</span></div>
                    <div class="stats-card__label">Экспертов</div>
                </div>
            </div>
            <!-- 4 -->
            <div class="stats-card">
                <div class="stats-card__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div>
                    <div class="stats-card__value">1200<span>+</span></div>
                    <div class="stats-card__label">Проектов</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ SERVICES ═══════════ -->
<section id="services" class="section section--gray">
    <div class="container">
        <div class="section__header section__header--center">
            <div class="section__label">Направления</div>
            <h2 class="section__title section__title--huge"><span class="text-gradient">Комплексные решения</span><br>для Вашего бизнеса</h2>
            <p class="section__subtitle section__subtitle--free">Каждая услуга адаптируется под индивидуальные потребности клиента и обеспечивает максимальную <br><strong>защиту Ваших интересов</strong>.</p>
        </div>

        <div class="services-grid">
            <!-- 1. Аудит финансовой деятельности -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                </div>
                <h3 class="service-card__title">Аудит финансовой деятельности</h3>
                <p class="service-card__text">Вы получаете независимую проверку отчетности, которая подтверждает прозрачность бизнеса и выявляет скрытые финансовые риски.</p>
                <a href="#" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 2. Восстановление финансового учета -->
            <div class="service-card service-card--alt fade-up is-visible fade-up-delay-1">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                </div>
                <h3 class="service-card__title">Восстановление финансового учета</h3>
                <p class="service-card__text">Мы приведем вашу запущенную документацию в полный порядок, устранив ошибки и защитив вас от претензий госорганов.</p>
                <a href="#" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 3. Юридические консультации -->
            <div class="service-card fade-up is-visible fade-up-delay-2">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="service-card__title">Юридические консультации</h3>
                <p class="service-card__text">Вы обеспечиваете правовую безопасность своей компании и надежную защиту интересов в любых договорах и спорах.</p>
                <a href="#" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 4. Ведение финансового и кадрового учета -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 class="service-card__title">Ведение финансового и кадрового учета</h3>
                <p class="service-card__text">Мы берем на себя всю рутину по бухгалтерии и кадрам, гарантируя вам отсутствие штрафов и стабильную работу штата.</p>
                <a href="#" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 5. Услуги секретариата -->
            <div class="service-card fade-up is-visible fade-up-delay-1">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <h3 class="service-card__title">Услуги секретариата</h3>
                <p class="service-card__text">Вы делегируете администрирование документации и звонков профессионалам, освобождая свое время для решения стратегических задач.</p>
                <a href="#" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 6. Бизнес-консультации -->
            <div class="service-card service-card--alt fade-up is-visible fade-up-delay-2">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                </div>
                <h3 class="service-card__title">Бизнес-консультации</h3>
                <p class="service-card__text">Вы получаете экспертную поддержку в поиске новых точек роста и разработке эффективной модели развития вашего предприятия.</p>
                <a href="#" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 7. Налоговые консультации -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <h3 class="service-card__title">Налоговые консультации</h3>
                <p class="service-card__text">Мы помогаем вам законно оптимизировать налоговую нагрузку и минимизировать риски перед визитами контролирующих органов.</p>
                <a href="#" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 8. Управленческий учет -->
            <div class="service-card service-card--alt fade-up is-visible fade-up-delay-1">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/></svg>
                </div>
                <h3 class="service-card__title">Управленческий учет</h3>
                <p class="service-card__text">Вы получаете полную финансовую прозрачность и точные данные для принятия решений, которые реально увеличивают вашу чистую прибыль.</p>
                <a href="#" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 9. Автоматизация бизнес-процессов -->
            <div class="service-card fade-up is-visible fade-up-delay-2">
                <div class="service-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                </div>
                <h3 class="service-card__title">Автоматизация бизнес-процессов</h3>
                <p class="service-card__text">Вы освобождаете команду от рутины и исключаете ошибки человеческого фактора, переводя управление в быструю и точную цифровую среду.</p>
                <a href="#" class="service-card__link">Подробнее →</a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════ ABOUT ═══════════ -->
<section id="about" class="about section">
    <!-- Geometric Background mirroring Hero -->
    <div class="hero__geo"></div>
    <div class="hero__accent-line"></div>
    <div class="hero__accent-line-2"></div>
    <div class="hero__grid-pattern"></div>
    
    <div class="ceo-editorial fade-up is-visible">
            <div class="section__label section__label--on-dark">О компании</div>
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
                        <a href="#" class="ceo-editorial__team-link">
                            Познакомьтесь с нашей экспертной командой
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Closing container -->
</section>

<!-- ═══════════ CTA — CRYSTAL ELEGANCE EDITION ═══════════ -->
<section id="contacts" class="cta-crystal">
    <!-- Animated Mesh Glows -->
    <div class="cta-crystal__glow cta-crystal__glow--blue"></div>
    <div class="cta-crystal__glow cta-crystal__glow--red"></div>
    
    <div class="container">
        <div class="cta-crystal__grid">
            
            <!-- Left Side: Soft Modern Persuasion -->
            <div class="cta-crystal__content fade-up is-visible">
                <div class="section__label">Быстрая связь</div>
                <h2 class="cta-crystal__title"><span class="text-gradient">Готовы масштабировать</span><br>свой успех?</h2>
                <p class="cta-crystal__text">Оставьте заявку сегодня, и мы разработаем для вас персональную стратегию развития и обеспечения безопасности вашего бизнеса.</p>
                <div class="cta-crystal__status">
                    <span class="cta-crystal__status-dot"></span>
                    Мы онлайн • Ответ в течение 15 минут
                </div>
            </div>

            <!-- Right Side: Crystal Tech Form -->
            <div class="cta-crystal__form-wrapper fade-up is-visible">
                <form action="#" class="cta-crystal__form">
                    <div class="cta-crystal__field">
                        <input type="text" placeholder=" " required id="f-name">
                        <label for="f-name">Ваше имя</label>
                    </div>
                    <div class="cta-crystal__field">
                        <input type="tel" placeholder=" " required id="f-phone">
                        <label for="f-phone">Телефон (+992)</label>
                    </div>
                    <div class="cta-crystal__field">
                        <select required id="f-service">
                            <option value="" disabled selected>Выберите направление</option>
                            <option>Юридическое сопровождение</option>
                            <option>Налоговое консультирование</option>
                            <option>Аудит и бух. учет</option>
                            <option>Автоматизация бизнеса</option>
                            <option>HR-консалтинг</option>
                            <option>Инвестиционный консалтинг</option>
                            <option>Маркетинговые стратегии</option>
                            <option>Бизнес-планирование</option>
                            <option>Оптимизация процессов</option>
                        </select>
                    </div>
                    <div class="cta-crystal__field">
                        <textarea placeholder=" " id="f-msg" rows="3"></textarea>
                        <label for="f-msg">Суть вашего запроса</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn">
                        <span>Отправить заявку</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                    <p class="cta-crystal__secure">🛡️ Защищённое соединение (SSL 256-bit)</p>
                </form>
            </div>

        </div>
    </div>
</section>
</main>
<?php get_footer(); ?>