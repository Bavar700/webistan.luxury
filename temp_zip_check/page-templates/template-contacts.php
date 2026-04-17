<?php
/**
 * Template Name: Contacts
 *
 * @package Neksoz
 */

get_header();
?>

	<main id="primary" class="site-main">
        <!-- Page Hero -->
        <section class="relative py-40 bg-bg-dark overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-20">
                <img src="https://images.unsplash.com/photo-1423666639041-f56000c27a9a?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="Contact Neksoz">
                <div class="absolute inset-0 bg-gradient-to-b from-bg-dark via-bg-dark/80 to-bg-dark"></div>
            </div>
            <div class="container relative z-10 text-center">
                <div class="inline-block mb-8 animate-reveal">
                    <span class="text-neksoz-red font-extrabold uppercase tracking-[0.4em] text-[0.65rem] flex items-center justify-center">
                        <span class="w-12 h-[2px] bg-neksoz-red mr-4"></span>
                        Свяжитесь с нами
                        <span class="w-12 h-[2px] bg-neksoz-red ml-4"></span>
                    </span>
                </div>
                <h1 class="text-6xl md:text-8xl font-heading font-black text-white uppercase tracking-tighter mb-10 animate-reveal delay-100">
                    Контакты<span class="text-neksoz-red">.</span>
                </h1>
                <p class="text-2xl text-gray-400 font-serif italic max-w-3xl mx-auto animate-reveal delay-200">
                    Мы всегда готовы к открытому диалогу и решению сложнейших задач вашего бизнеса.
                </p>
            </div>
        </section>

		<section class="section-padding bg-white">
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-24 items-start">
                    <!-- Contact Form -->
                    <div class="lg:col-span-7 animate-reveal delay-300">
                        <div class="premium-card !p-16">
                            <h2 class="text-xs font-heading font-extrabold text-neksoz-blue uppercase tracking-[0.3em] mb-12">Отправить запрос</h2>
                            <form class="space-y-12">
                                <div class="relative group">
                                    <input type="text" class="w-full bg-transparent border-b-2 border-gray-100 py-4 outline-none focus:border-neksoz-red transition-all placeholder:uppercase placeholder:text-[0.6rem] placeholder:tracking-widest font-bold" placeholder="Ваше полное имя">
                                    <div class="absolute bottom-0 left-0 w-0 h-[2px] bg-neksoz-red group-focus-within:w-full transition-all duration-700"></div>
                                </div>
                                <div class="relative group">
                                    <input type="email" class="w-full bg-transparent border-b-2 border-gray-100 py-4 outline-none focus:border-neksoz-red transition-all placeholder:uppercase placeholder:text-[0.6rem] placeholder:tracking-widest font-bold" placeholder="E-mail адрес">
                                    <div class="absolute bottom-0 left-0 w-0 h-[2px] bg-neksoz-red group-focus-within:w-full transition-all duration-700"></div>
                                </div>
                                <div class="relative group">
                                    <textarea class="w-full bg-transparent border-b-2 border-gray-100 py-4 outline-none focus:border-neksoz-red transition-all placeholder:uppercase placeholder:text-[0.6rem] placeholder:tracking-widest font-bold h-40 resize-none" placeholder="Краткое описание вашей задачи"></textarea>
                                    <div class="absolute bottom-0 left-0 w-0 h-[2px] bg-neksoz-red group-focus-within:w-full transition-all duration-700"></div>
                                </div>
                                <button class="btn-premium w-full !text-center">Отправить сообщение</button>
                            </form>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="lg:col-span-5 space-y-12 animate-reveal delay-400">
                        <div class="space-y-16">
                            <div>
                                <h3 class="text-[0.65rem] font-black text-neksoz-red uppercase tracking-[0.4em] mb-8">Прямая связь</h3>
                                <ul class="space-y-12">
                                    <li class="group">
                                        <div class="text-[0.6rem] text-gray-400 font-extrabold uppercase tracking-widest mb-4">Горячая линия</div>
                                        <a href="tel:+992985641010" class="text-3xl md:text-4xl font-heading font-black text-neksoz-blue group-hover:text-neksoz-red transition-colors duration-500">(+992) 985 64-10-10</a>
                                    </li>
                                    <li class="group">
                                        <div class="text-[0.6rem] text-gray-400 font-extrabold uppercase tracking-widest mb-4">Для документов</div>
                                        <a href="mailto:info@neksoz.tj" class="text-3xl md:text-4xl font-heading font-black text-neksoz-blue group-hover:text-neksoz-red transition-colors duration-500">info@neksoz.tj</a>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h3 class="text-[0.65rem] font-black text-neksoz-red uppercase tracking-[0.4em] mb-8">Наш Офис</h3>
                                <div class="text-2xl font-serif italic text-text-main leading-relaxed">
                                    г. Душанбе, проспект Рудаки 55,<br>
                                    Бизнес-центр, 3-этаж
                                </div>
                            </div>

                            <div>
                                <h3 class="text-[0.65rem] font-black text-neksoz-red uppercase tracking-[0.4em] mb-8">График работы</h3>
                                <div class="flex items-center space-x-12">
                                    <div>
                                        <div class="text-[0.6rem] text-gray-400 font-extrabold uppercase tracking-widest mb-2">Пн — Пт</div>
                                        <div class="text-xl font-heading font-bold text-neksoz-blue uppercase">09:00 — 18:00</div>
                                    </div>
                                    <div class="w-[1px] h-12 bg-gray-100"></div>
                                    <div>
                                        <div class="text-[0.6rem] text-gray-400 font-extrabold uppercase tracking-widest mb-2">Сб — Вс</div>
                                        <div class="text-xl font-heading font-bold text-neksoz-blue uppercase">Выходной</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section: Полноэкранная -->
        <section class="h-[600px] relative overflow-hidden bg-bg-light">
            <div class="absolute inset-0 bg-neksoz-blue/10 pointer-events-none z-10"></div>
            <iframe class="w-full h-full grayscale brightness-50 contrast-125" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3119.5348877546!2d68.7831!3d38.5597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzg_MzMnMzUuMCJOIDY4XzQ2JzU5LjAiRQ!5e0!3m2!1sru!2stj!4v1635659352000" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </section>
	</main>

<?php
get_footer();
