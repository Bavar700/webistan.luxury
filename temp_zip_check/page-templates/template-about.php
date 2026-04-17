<?php
/**
 * Template Name: About Company
 *
 * @package Neksoz
 */

get_header();
?>

	<main id="primary" class="site-main">
        <!-- Page Hero -->
        <section class="relative py-40 bg-bg-dark overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-20">
                <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="About Neksoz">
                <div class="absolute inset-0 bg-gradient-to-b from-bg-dark via-bg-dark/80 to-bg-dark"></div>
            </div>
            <div class="container relative z-10 text-center">
                <div class="inline-block mb-8 animate-reveal">
                    <span class="text-neksoz-red font-extrabold uppercase tracking-[0.4em] text-[0.65rem] flex items-center justify-center">
                        <span class="w-12 h-[2px] bg-neksoz-red mr-4"></span>
                        Наша История
                        <span class="w-12 h-[2px] bg-neksoz-red ml-4"></span>
                    </span>
                </div>
                <h1 class="text-6xl md:text-8xl font-heading font-black text-white uppercase tracking-tighter mb-10 animate-reveal delay-100">
                    О Компании<span class="text-neksoz-red">.</span>
                </h1>
                <p class="text-2xl text-gray-400 font-serif italic max-w-3xl mx-auto animate-reveal delay-200">
                    Фундаментальные знания, проверенные временем решения и безупречная репутация с 2016 года.
                </p>
            </div>
        </section>

		<section class="section-padding bg-white">
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-24 items-start">
                    <!-- Content -->
                    <div class="lg:col-span-8 space-y-16 animate-reveal delay-300">
                        <div class="prose prose-2xl text-text-main font-serif italic leading-relaxed max-w-none">
                            <p class="text-3xl border-l-4 border-neksoz-red pl-12 py-4">
                                Наша компания ООО «НЕКСОЗ-БИЗНЕС КОНСАЛТИНГ ГРУП» была создана в 2016 году экспертами в сфере налогообложения, финансового учёта и банковского дела.
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 text-lg text-text-muted leading-relaxed">
                            <p>
                                Благодаря многолетнему опыту и доверию клиентов, компания зарекомендовала себя как достойный игрок на национальном рынке, нацеленный на достижение конкретных результатов в сфере бухгалтерских и консалтинговых услуг.
                            </p>
                            <p>
                                Мы объединяем глубокую академическую базу и практический опыт, что позволяет нам решать задачи любой сложности — от рутинного учета до комплексного аудита крупных холдингов.
                            </p>
                        </div>

                        <!-- Philosophy Block -->
                        <div class="bg-bg-dark p-20 relative overflow-hidden group">
                            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 -rotate-45 translate-x-32 -translate-y-32 group-hover:scale-110 transition-transform duration-1000"></div>
                            <h3 class="text-xs font-heading font-extrabold text-neksoz-red uppercase tracking-[0.4em] mb-12">Миссия & Цель</h3>
                            <p class="text-4xl md:text-5xl font-heading font-black text-white uppercase leading-tight">
                                Предоставление почвы для <span class="text-neksoz-red">развития</span>, комфорта и безупречного учёта.
                            </p>
                        </div>
                    </div>

                    <!-- Sidebar / Principles -->
                    <aside class="lg:col-span-4 space-y-12 animate-reveal delay-400">
                        <div class="premium-card !p-12">
                            <h3 class="text-xs font-heading font-extrabold text-neksoz-blue uppercase tracking-[0.3em] mb-12">Принципы работы</h3>
                            <div class="space-y-12">
                                <div class="group">
                                    <div class="flex items-center mb-6">
                                        <span class="text-4xl font-heading font-black text-gray-100 group-hover:text-neksoz-red/20 transition-colors mr-6">01</span>
                                        <h4 class="text-lg font-heading font-black text-neksoz-blue uppercase">Доверяй, но проверяй</h4>
                                    </div>
                                    <p class="text-text-muted font-serif italic pl-16">Строим прозрачные отношения на основе измеримых результатов.</p>
                                </div>
                                <div class="group">
                                    <div class="flex items-center mb-6">
                                        <span class="text-4xl font-heading font-black text-gray-100 group-hover:text-neksoz-red/20 transition-colors mr-6">02</span>
                                        <h4 class="text-lg font-heading font-black text-neksoz-blue uppercase">Будем решать!</h4>
                                    </div>
                                    <p class="text-text-muted font-serif italic pl-16">Мы не ищем оправданий — мы предлагаем эффективные решения.</p>
                                </div>
                                <div class="group">
                                    <div class="flex items-center mb-6">
                                        <span class="text-4xl font-heading font-black text-gray-100 group-hover:text-neksoz-red/20 transition-colors mr-6">03</span>
                                        <h4 class="text-lg font-heading font-black text-neksoz-blue uppercase">Интеллект</h4>
                                    </div>
                                    <p class="text-text-muted font-serif italic pl-16">Интеллектуальная собственность — наш главный актив.</p>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
	</main>

<?php
get_footer();
