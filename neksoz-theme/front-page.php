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

<!-- ═══════════ STATS RIBBON (RESTYLED TO MATCH SERVICES) ═══════════ -->
<section class="section section--gray stats-ribbon-block" style="padding-top: 80px; padding-bottom: 0;">
    <div class="container">
        <div style="display: flex; justify-content: flex-end; margin-bottom: 50px;">
            <div class="section__label" style="margin-bottom: 0;">Наш опыт</div>
        </div>
        <div class="services-grid" style="grid-template-columns: repeat(4, 1fr); gap: 20px;">
            <!-- 1 -->
            <div class="service-card fade-up" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon" style="width: 52px !important; height: 52px !important; position: absolute !important; top: 30px !important; right: 30px !important; margin-bottom: 0 !important; opacity: 0.12 !important; background: transparent !important; color: var(--nk-blue) !important; border: none !important;">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; color: var(--nk-blue) !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">500<em style="color: var(--nk-red) !important; font-style: normal !important; -webkit-text-fill-color: var(--nk-red) !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 0.55rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; white-space: nowrap !important;">Довольных клиентов</p>
            </div>
            <!-- 2 -->
            <div class="service-card service-card--alt fade-up fade-up-delay-1" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon" style="width: 52px !important; height: 52px !important; position: absolute !important; top: 30px !important; right: 30px !important; margin-bottom: 0 !important; opacity: 0.12 !important; background: transparent !important; color: var(--nk-red) !important; border: none !important;">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; color: var(--nk-red) !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">18<em style="color: var(--nk-blue) !important; font-style: normal !important; -webkit-text-fill-color: var(--nk-blue) !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 0.55rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; white-space: nowrap !important;">Лет на рынке</p>
            </div>
            <!-- 3 -->
            <div class="service-card fade-up fade-up-delay-2" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon" style="width: 52px !important; height: 52px !important; position: absolute !important; top: 30px !important; right: 30px !important; margin-bottom: 0 !important; opacity: 0.12 !important; background: transparent !important; color: var(--nk-blue) !important; border: none !important;">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; color: var(--nk-blue) !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">50<em style="color: var(--nk-red) !important; font-style: normal !important; -webkit-text-fill-color: var(--nk-red) !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 0.55rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; white-space: nowrap !important;">Квалифицированных экспертов</p>
            </div>
            <!-- 4 -->
            <div class="service-card service-card--alt fade-up fade-up-delay-3" style="padding-top: 110px !important; padding-bottom: 80px !important; min-height: auto !important; position: relative !important; overflow: hidden !important;">
                <div class="service-card__icon" style="width: 52px !important; height: 52px !important; position: absolute !important; top: 30px !important; right: 30px !important; margin-bottom: 0 !important; opacity: 0.12 !important; background: transparent !important; color: var(--nk-red) !important; border: none !important;">
                    <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div class="service-card__title" style="font-size: 3.5rem !important; margin-bottom: 25px !important; color: var(--nk-red) !important; font-weight: 900 !important; line-height: 1 !important; letter-spacing: -0.02em !important;">1200<em style="color: var(--nk-blue) !important; font-style: normal !important; -webkit-text-fill-color: var(--nk-blue) !important;">+</em></div>
                <p class="service-card__text" style="font-weight: 800 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important; font-size: 0.55rem !important; margin-bottom: 0 !important; color: var(--nk-gray-500) !important; white-space: nowrap !important;">Успешных проектов</p>
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
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                </div>
                <h3 class="service-card__title">Аудит финансовой деятельности</h3>
                <p class="service-card__text">Вы получаете независимую проверку отчетности, которая подтверждает прозрачность бизнеса и выявляет скрытые финансовые риски.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Наши задачи:</span>
                    <ul class="service-card__list">
                        <li>Оценка уровня организации бухучета и систем контроля</li>
                        <li>Проверка правильности и законности бухгалтерских записей</li>
                        <li>Перспективный анализ будущих событий деятельности</li>
                        <li>Выявление резервов для роста финансовых ресурсов</li>
                        <li>Подтверждение достоверности отчетов и налоговый аудит</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-audit'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 2. Восстановление финансового учета -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                </div>
                <h3 class="service-card__title">Восстановление финансового учета</h3>
                <p class="service-card__text">Мы приведем вашу запущенную документацию в полный порядок, устранив ошибки и защитив вас от претензий госорганов.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Наши задачи:</span>
                    <ul class="service-card__list">
                        <li>Восстановление учета и закрытие пробелов прошлого</li>
                        <li>Юридическая консультация в финансовой сфере</li>
                        <li>Систематизация и проведение первичной документации</li>
                        <li>Сверка с контрагентами и налоговой для исключения штрафов</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-restore'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 3. Юридические консультации -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="service-card__title">Юридические консультации</h3>
                <p class="service-card__text">Вы обеспечиваете правовую безопасность своей компании и надежную защиту интересов в любых договорах и спорах.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Наши задачи:</span>
                    <ul class="service-card__list">
                        <li>Регистрация и перерегистрация юридических лиц</li>
                        <li>Сопровождение и оформление сделок с недвижимостью</li>
                        <li>Представление интересов во всех судебных инстанциях</li>
                        <li>Правовая помощь и экспертиза корпоративных договоров</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-legal'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 4. Ведение финансового и кадрового учета -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 class="service-card__title">Ведение финансового и кадрового учета</h3>
                <p class="service-card__text">Мы берем на себя всю рутину по бухгалтерии и кадрам, гарантируя вам отсутствие штрафов и стабильную работу штата.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Наши задачи:</span>
                    <ul class="service-card__list">
                        <li>Ведение бухучета в 1С и расчет заработной платы</li>
                        <li>Открытие счетов и ведение кассовой дисциплины</li>
                        <li>Сдача всех видов отчетности по стандартам МСФО</li>
                        <li>Полное кадровое делопроизводство и учет времени</li>
                        <li>Оформление отпусков, командировок и должностных инструкций</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-accounting'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 5. Услуги секретариата -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <h3 class="service-card__title">Услуги секретариата</h3>
                <p class="service-card__text">Вы делегируете администрирование документации и звонков профессионалам, освобождая свое время для решения стратегических задач.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Наши задачи:</span>
                    <ul class="service-card__list">
                        <li>Лицензирование привлечения иностранных граждан</li>
                        <li>Оформление приглашений, разрешений и виз (М, К, О-2)</li>
                        <li>Регистрация в ОВИР и оформление карт Дипсервиса</li>
                        <li>Аутсорсинг секретарских услуг и юридический перевод</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-secretariat'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 6. Бизнес-консультации -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                </div>
                <h3 class="service-card__title">Бизнес-консультации</h3>
                <p class="service-card__text">Вы получаете экспертную поддержку в поиске новых точек роста и разработке эффективной модели развития вашего предприятия.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Наши задачи:</span>
                    <ul class="service-card__list">
                        <li>Построение систем стратегического управления</li>
                        <li>Глубокий аудит и оптимизация бизнес-процессов</li>
                        <li>Фин. планирование и разработка моделей развития</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-consulting'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 7. Налоговые консультации -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <h3 class="service-card__title">Налоговые консультации</h3>
                <p class="service-card__text">Мы помогаем вам законно оптимизировать налоговую нагрузку и минимизировать риски перед визитами контролирующих органов.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Наши задачи:</span>
                    <ul class="service-card__list">
                        <li>Профессиональные консультации (ЮЛ и ФЛ)</li>
                        <li>Разработка безопасной налоговой политики</li>
                        <li>Представительство интересов в налоговых спорах</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-tax'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 8. Управленческий учет -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><rect x="7" y="14" width="4" height="7"/><rect x="15" y="5" width="4" height="16"/></svg>
                </div>
                <h3 class="service-card__title">Управленческий учет</h3>
                <p class="service-card__text">Вы получаете полную финансовую прозрачность и точные данные для принятия решений, которые реально увеличивают вашу чистую прибыль.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Наши задачи:</span>
                    <ul class="service-card__list">
                        <li>Внедрение отчетов Cash Flow, P&L и баланса</li>
                        <li>Расчет рентабельности по направлениям и проектам</li>
                        <li>Кассовое планирование и настройка календарей</li>
                        <li>Визуализация фин. показателей для собственников</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-management'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 9. Автоматизация бизнес-процессов -->
            <div class="service-card fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                </div>
                <h3 class="service-card__title">Автоматизация бизнес-процессов</h3>
                <p class="service-card__text">Вы освобождаете команду от рутины и исключаете ошибки человеческого фактора, переводя управление в быструю и точную цифровую среду.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Наши задачи:</span>
                    <ul class="service-card__list">
                        <li>Внедрение и настройка систем учета 1С</li>
                        <li>Интеграция CRM, Bitrix24 и систем управления</li>
                        <li>Настройка связок учета с Клиент-банком</li>
                        <li>Цифровизация архивов и электронный документооборот</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-automation'); ?>" class="service-card__link">Подробнее →</a>
            </div>

            <!-- 10. Разработка бизнес-планов и ТЭО -->
            <div class="service-card service-card--alt fade-up is-visible">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/><path d="M9 14h6"/><path d="M9 18h6"/><path d="M9 10h6"/></svg>
                </div>
                <h3 class="service-card__title">Разработка бизнес-планов и ТЭО</h3>
                <p class="service-card__text">Вы получаете детальный и обоснованный финансовый документ, который доказывает окупаемость вашего проекта и помогает гарантированно привлечь инвестиции или банковские кредиты.</p>
                <div class="service-card__tasks">
                    <span class="service-card__tasks-title">Наши задачи:</span>
                    <ul class="service-card__list">
                        <li>Проведение глубокого анализа рынка, конкурентной среды и аудитории</li>
                        <li>Разработка подробной финансовой модели (доходы, расходы, точка безубыточности)</li>
                        <li>Составление ТЭО с учетом специфики законодательства и налогообложения РТ</li>
                        <li>Подготовка презентационных материалов (Pitch Deck) для защиты проекта</li>
                        <li>Сопровождение и защита бизнес-плана на переговорах с инвесторами</li>
                    </ul>
                </div>
                <a href="<?php echo home_url('/service-consulting'); ?>" class="service-card__link">Подробнее →</a>
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
                    <div class="cta-crystal__field nx-dropdown">
                        <input type="text" placeholder=" " required id="f-service-input" class="nx-dropdown__trigger" readonly>
                        <label for="f-service-input">Выбрать направление <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px; display: inline-block; vertical-align: middle;"><path d="m6 9 6 6 6-6"/></svg></label>
                        
                        <div class="nx-dropdown__panel">
                            <div class="nx-dropdown__option">Юридическое сопровождение</div>
                            <div class="nx-dropdown__option">Налоговое консультирование</div>
                            <div class="nx-dropdown__option">Аудит и бух. учет</div>
                            <div class="nx-dropdown__option">Автоматизация бизнеса</div>
                            <div class="nx-dropdown__option">HR-консалтинг</div>
                            <div class="nx-dropdown__option">Инвестиционный консалтинг</div>
                            <div class="nx-dropdown__option">Маркетинговые стратегии</div>
                            <div class="nx-dropdown__option">Бизнес-планирование</div>
                            <div class="nx-dropdown__option">Оптимизация процессов</div>
                        </div>
                    </div>
                    <div class="cta-crystal__field">
                        <textarea placeholder=" " id="f-msg" rows="3"></textarea>
                        <label for="f-msg">Суть вашего запроса</label>
                    </div>
                    <button type="submit" class="cta-crystal__btn">
                        <span>Отправить заявку</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                    <p style="font-size: 11px; color: var(--nk-gray-500); text-align: center; margin-top: 20px; line-height: 1.4; opacity: 0.8; width: 100%;">
                        Нажимая кнопку, вы соглашаетесь с <a href="<?php echo home_url('/privacy-policy'); ?>" style="color: var(--nk-blue); text-decoration: underline;">Политикой конфиденциальности</a>
                    </p>
                    <p class="cta-crystal__secure">🛡️ Защищённое соединение (SSL 256-bit)</p>
                    <div id="nk-form-status" style="margin-top: 15px; display: none;"></div>
                </form>

                <style>
                    .nx-dropdown { position: relative; }
                    .nx-dropdown__trigger { cursor: pointer !important; }
                    .nx-dropdown__panel {
                        position: absolute;
                        top: 100%;
                        left: 0;
                        width: 100%;
                        background: rgba(235, 238, 243, 0.98); /* Чуть темнее */
                        backdrop-filter: blur(25px);
                        -webkit-backdrop-filter: blur(25px);
                        border: none; /* Убрал бордюр */
                        border-radius: 20px; /* Закруглил углы */
                        box-shadow: 0 30px 60px rgba(0, 13, 51, 0.12);
                        opacity: 0;
                        visibility: hidden;
                        transform: translateY(-10px);
                        transition: all 0.3s var(--ease);
                        z-index: 1000;
                        max-height: 250px;
                        overflow-y: auto;
                        padding: 10px 0;
                        margin-top: 5px;
                    }
                    .nx-dropdown.is-open .nx-dropdown__panel {
                        opacity: 1;
                        visibility: visible;
                        transform: translateY(0);
                    }
                    .nx-dropdown__option {
                        padding: 14px 24px;
                        cursor: pointer;
                        font-size: 14px;
                        font-family: var(--font-display);
                        color: var(--nk-gray-900);
                        transition: all 0.2s ease;
                    }
                    .nx-dropdown__option:hover {
                        background: rgba(0, 68, 204, 0.08); /* Светло-синий акцент */
                        color: var(--nk-blue);
                        padding-left: 30px;
                    }
                </style>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const drp = document.querySelector('.nx-dropdown');
                        const trigger = drp.querySelector('.nx-dropdown__trigger');
                        const options = drp.querySelectorAll('.nx-dropdown__option');

                        trigger.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            drp.classList.toggle('is-open');
                        });

                        options.forEach(opt => {
                            opt.addEventListener('click', function(e) {
                                e.stopPropagation();
                                trigger.value = this.innerText;
                                drp.classList.remove('is-open');
                                // Trigger CSS pseudo-classes
                                trigger.classList.add('has-value');
                                trigger.focus();
                                trigger.blur();
                            });
                        });

                        document.addEventListener('click', function(e) {
                            if (!drp.contains(e.target)) {
                                drp.classList.remove('is-open');
                            }
                        });
                    });
                </script>
            </div>

        </div>
    </div>
</section>
</main>
<?php get_footer(); ?>