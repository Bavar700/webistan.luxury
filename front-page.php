<?php
/**
 * Template Name: Главная страница (Impressive Excellence)
 *
 * @package Nexoz
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- HERO SECTION: IMPACT & PARALLAX -->
    <section class="hero-impressive" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/hero-1.png');">
        <div class="max-w-7xl mx-auto px-6 w-full hero-content">
            <div class="max-w-4xl">
                <div class="red-dots"><span></span><span></span><span></span></div>
                <span class="text-xs font-bold uppercase tracking-[0.4em] text-nk-blue/80 mb-8 block">Neksoz Business Consulting Group</span>
                <h1 class="text-mega text-white mb-10">
                    Трансформируем <br><span class="text-white opacity-40">бизнес</span>. <br><span class="text-nk-red">Гарантируем</span> результат.
                </h1>
                <p class="text-xl md:text-2xl text-white/70 font-medium mb-16 max-w-2xl leading-relaxed">
                    Профессиональный аудит и стратегический консалтинг. Мы создаем фундамент для Вашего уверенного роста в любой экономической среде.
                </p>
                <div class="flex flex-col sm:flex-row gap-8">
                    <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="btn-wow btn-wow-primary drop-shadow-2xl">
                        Создать стратегию
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="#services" class="btn-wow border border-white/20 text-white hover:bg-white hover:text-nk-dark backdrop-blur-sm">
                        Наши компетенции
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS: OVERLAPPING IMPACT -->
    <div class="stats-impressive">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
                <div class="group">
                    <div class="text-5xl font-black mb-2 flex justify-center items-baseline gap-1">200<span class="text-sm opacity-50">+</span></div>
                    <div class="text-[10px] font-black uppercase tracking-widest opacity-60">Проверок ежегодно</div>
                </div>
                <div class="group border-l border-white/10">
                    <div class="text-5xl font-black mb-2 flex justify-center items-baseline gap-1">1000<span class="text-sm opacity-50">+</span></div>
                    <div class="text-[10px] font-black uppercase tracking-widest opacity-60">Довольных клиентов</div>
                </div>
                <div class="group border-l border-white/10">
                    <div class="text-5xl font-black mb-2 flex justify-center items-baseline gap-1">18<span class="text-sm opacity-50">лет</span></div>
                    <div class="text-[10px] font-black uppercase tracking-widest opacity-60">На рынке Таджикистана</div>
                </div>
                <div class="group border-l border-white/10">
                    <div class="text-5xl font-black mb-2 flex justify-center items-baseline gap-1">400<span class="text-sm opacity-50">+</span></div>
                    <div class="text-[10px] font-black uppercase tracking-widest opacity-60">Успешных кейсов</div>
                </div>
            </div>
        </div>
    </div>

    <!-- SERVICES: INTERESTING WOW CARDS -->
    <section id="services" class="section-wow alt">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-24 gap-10">
                <div class="max-w-2xl">
                    <div class="red-dots"><span></span><span></span></div>
                    <h2 class="text-5xl md:text-6xl font-black text-nk-dark tracking-tighter">Сферы Нашей <br><span class="text-nk-blue">Экспертизы</span></h2>
                </div>
                <p class="text-lg text-slate-500 font-medium max-w-sm mb-4">Индивидуальные решения для каждой индустрии. Высокая точность, полная легитимность.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Audit -->
                <div class="card-wow group">
                    <div class="icon-box">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3>Аудит</h3>
                    <ul class="space-y-4 mb-12 text-slate-500 font-semibold text-sm">
                        <li class="flex items-center gap-3"><div class="w-1.5 h-1.5 bg-nk-red"></div> Обязательный аудит</li>
                        <li class="flex items-center gap-3"><div class="w-1.5 h-1.5 bg-nk-red"></div> Налоговый аудит</li>
                        <li class="flex items-center gap-3"><div class="w-1.5 h-1.5 bg-nk-red"></div> Инициативный</li>
                    </ul>
                    <a href="#" class="inline-flex items-center gap-4 text-xs font-black uppercase tracking-widest text-nk-blue group-hover:text-nk-red transition-all">
                        Получить решение
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <!-- Accounting -->
                <div class="card-wow group">
                    <div class="icon-box">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3>Бухгалтерия</h3>
                    <ul class="space-y-4 mb-12 text-slate-500 font-semibold text-sm">
                        <li class="flex items-center gap-3"><div class="w-1.5 h-1.5 bg-nk-red"></div> Аутсорсинг</li>
                        <li class="flex items-center gap-3"><div class="w-1.5 h-1.5 bg-nk-red"></div> Отчетность</li>
                        <li class="flex items-center gap-3"><div class="w-1.5 h-1.5 bg-nk-red"></div> Восстановление</li>
                    </ul>
                    <a href="#" class="inline-flex items-center gap-4 text-xs font-black uppercase tracking-widest text-nk-blue group-hover:text-nk-red transition-all">
                        Бесплатный расчет
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <!-- Legal -->
                <div class="card-wow group">
                    <div class="icon-box">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                    </div>
                    <h3>Юр. услуги</h3>
                    <ul class="space-y-4 mb-12 text-slate-500 font-semibold text-sm">
                        <li class="flex items-center gap-3"><div class="w-1.5 h-1.5 bg-nk-red"></div> Регистрация бизнеса</li>
                        <li class="flex items-center gap-3"><div class="w-1.5 h-1.5 bg-nk-red"></div> Сопровождение ВЭД</li>
                        <li class="flex items-center gap-3"><div class="w-1.5 h-1.5 bg-nk-red"></div> Налоговое право</li>
                    </ul>
                    <a href="#" class="inline-flex items-center gap-4 text-xs font-black uppercase tracking-widest text-nk-blue group-hover:text-nk-red transition-all">
                        Консультация
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <!-- Consulting -->
                <div class="card-wow group">
                    <div class="icon-box">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <h3>Консалтинг</h3>
                    <ul class="space-y-4 mb-12 text-slate-500 font-semibold text-sm">
                        <li class="flex items-center gap-3"><div class="w-1.5 h-1.5 bg-nk-red"></div> Снижение издержек</li>
                        <li class="flex items-center gap-3"><div class="w-1.5 h-1.5 bg-nk-red"></div> Рост прибыли</li>
                        <li class="flex items-center gap-3"><div class="w-1.5 h-1.5 bg-nk-red"></div> Господдержка</li>
                    </ul>
                    <a href="#" class="inline-flex items-center gap-4 text-xs font-black uppercase tracking-widest text-nk-blue group-hover:text-nk-red transition-all">
                        Заказать аудит
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CLIENTS: CRISP & REFINED -->
    <section class="section-wow bg-transparent overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-20 text-center">
                <span class="text-[11px] font-black uppercase tracking-[0.5em] text-nk-blue/40">Trusted by Global Leaders</span>
                <h2 class="text-4xl font-extrabold text-nk-dark mt-6">Нам доверяют лучшие</h2>
            </div>
            
            <div class="client-grid">
                <div class="client-item">SAMSUNG</div>
                <div class="client-item">TCELL</div>
                <div class="client-item">MEGAPHON</div>
                <div class="client-item">TOYOTA</div>
                <div class="client-item">ORIENBONK</div>
                <div class="client-item">DELOITTE</div>
            </div>

            <div class="mt-20 flex flex-wrap justify-center gap-x-12 gap-y-6 text-[10px] font-bold text-slate-300 uppercase tracking-widest border-t border-slate-50 pt-20">
                <span>• ОАО «ТАДЖИКТЕЛЕКОМ»</span>
                <span>• ЗАО «ИНДИГО»</span>
                <span>• ООО «ВАВИЛОН»</span>
                <span>• ХОЛДИНГ «АЛЬЯНС»</span>
                <span>• ООО «НЕКСОЗ-БИЗНЕС»</span>
            </div>
        </div>
    </section>

    <!-- FINAL CTA: POWERFUL REVEAL -->
    <section class="py-40 bg-nk-dark text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-nk-blue opacity-5"></div>
        <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
            <div class="red-dots justify-center mb-10"><span></span><span></span><span></span></div>
            <h2 class="text-5xl md:text-8xl font-black mb-12 tracking-tighter leading-none">Начните <span class="text-nk-blue">масштабировать</span> свой успех</h2>
            <p class="text-2xl text-white/50 font-medium mb-16 max-w-3xl mx-auto italic">
                «Мы не просто решаем проблемы. Мы создаем возможности там, где другие видят препятствия.»
            </p>
            <a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="btn-wow btn-wow-primary text-xl px-16 shadow-2xl shadow-nk-blue/30">
                Заказать бесплатную диагностику
            </a>
        </div>
    </section>

</main>

<?php get_footer(); ?>
