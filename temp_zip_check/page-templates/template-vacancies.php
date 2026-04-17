<?php
/**
 * Template Name: Vacancies
 *
 * @package Neksoz
 */

get_header();
?>

	<main id="primary" class="site-main">
        <!-- Page Hero -->
        <section class="relative py-40 bg-bg-dark overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-20">
                <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="Careers at Neksoz">
                <div class="absolute inset-0 bg-gradient-to-b from-bg-dark via-bg-dark/80 to-bg-dark"></div>
            </div>
            <div class="container relative z-10 text-center">
                <div class="inline-block mb-8 animate-reveal">
                    <span class="text-neksoz-red font-extrabold uppercase tracking-[0.4em] text-[0.65rem] flex items-center justify-center">
                        <span class="w-12 h-[2px] bg-neksoz-red mr-4"></span>
                        Карьера в Neksoz
                        <span class="w-12 h-[2px] bg-neksoz-red ml-4"></span>
                    </span>
                </div>
                <h1 class="text-6xl md:text-8xl font-heading font-black text-white uppercase tracking-tighter mb-10 animate-reveal delay-100">
                    Вакансии<span class="text-neksoz-red">.</span>
                </h1>
                <p class="text-2xl text-gray-400 font-serif italic max-w-3xl mx-auto animate-reveal delay-200">
                    Мы ищем таланты, готовые развиваться в интеллектуальной среде и решать задачи национального масштаба.
                </p>
            </div>
        </section>

		<section class="section-padding bg-bg-light">
            <div class="container">
                <div class="max-w-5xl mx-auto space-y-12">
                    <!-- Vacancy Item -->
                    <div class="premium-card group animate-reveal delay-300">
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-12 gap-8">
                            <div>
                                <span class="text-[0.6rem] font-black text-neksoz-red uppercase tracking-[0.4em] mb-4 block">Департамент Аудита</span>
                                <h3 class="text-3xl md:text-4xl font-heading font-black text-neksoz-blue uppercase group-hover:text-neksoz-red transition-colors duration-500">Старший Аудитор</h3>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="inline-block border border-gray-100 px-6 py-2 text-[0.6rem] font-black uppercase tracking-widest text-gray-400">Полная занятость</span>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12 border-t border-gray-50 pt-12">
                            <div>
                                <h4 class="text-xs font-heading font-extrabold text-neksoz-blue uppercase tracking-widest mb-6">Требования</h4>
                                <ul class="space-y-4 text-text-muted font-serif italic text-lg">
                                    <li>— Опыт в аудите от 5 лет</li>
                                    <li>— Знание МСФО и НСБУ</li>
                                    <li>— Высшее профильное образование</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="text-xs font-heading font-extrabold text-neksoz-blue uppercase tracking-widest mb-6">Мы предлагаем</h4>
                                <ul class="space-y-4 text-text-muted font-serif italic text-lg">
                                    <li>— Конкурентная заработная плата</li>
                                    <li>— Офис в центре города</li>
                                    <li>— Профессиональный рост</li>
                                </ul>
                            </div>
                        </div>

                        <div class="flex justify-end pt-8 border-t border-gray-50">
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn-premium">Откликнуться</a>
                        </div>
                    </div>

                    <!-- Placeholder for no vacancies -->
                    <div class="py-24 text-center border-2 border-dashed border-gray-200 animate-reveal delay-400">
                        <div class="text-gray-400 font-serif italic text-2xl mb-8">Другие позиции в данный момент закрыты</div>
                        <p class="text-text-muted max-w-lg mx-auto mb-12">
                            Если вы считаете, что ваши знания будут полезны нашей команде, отправьте резюме на почту <a href="mailto:hr@neksoz.tj" class="text-neksoz-red font-bold underline">hr@neksoz.tj</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
	</main>

<?php
get_footer();
