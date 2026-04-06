<footer class="pt-24 pb-12 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-20">
            <!-- Brand -->
            <div>
                <div class="mb-8"><?php nexoz_the_logo(); ?></div>
                <p class="text-sm text-bk-text-soft font-medium leading-relaxed">
                    Ваш стратегический партнер в аудите и консалтинге. Мы берем на себя ответственность за стабильный рост Вашего бизнеса.
                </p>
            </div>

            <!-- Links -->
            <div class="md:ml-auto">
                <h4 class="text-bk-text-main font-bold text-xs uppercase tracking-widest mb-10">Компания</h4>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'flex flex-col gap-3 text-sm font-semibold text-bk-text-soft',
                    'fallback_cb'    => false,
                ) );
                ?>
            </div>

            <!-- Services -->
            <div class="md:ml-auto">
                <h4 class="text-bk-text-main font-bold text-xs uppercase tracking-widest mb-10">Наши услуги</h4>
                <div class="flex flex-col gap-3 text-sm font-semibold text-bk-text-soft">
                    <a href="#" class="hover:text-bk-blue transition-all">• Обязательный аудит</a>
                    <a href="#" class="hover:text-bk-blue transition-all">• Налоговое право</a>
                    <a href="#" class="hover:text-bk-blue transition-all">• Регистрация ООО/АО</a>
                </div>
            </div>

            <!-- Contacts -->
            <div class="md:ml-auto">
                <h4 class="text-bk-text-main font-bold text-xs uppercase tracking-widest mb-10">Контакты</h4>
                <div class="space-y-6">
                    <a href="tel:+992985641010" class="block text-2xl font-black text-bk-blue">+992 985 64 10 10</a>
                    <p class="text-sm text-bk-text-soft font-medium">г. Душанбе, пр. Рудаки 55, <br>офис "Neksoz"</p>
                </div>
            </div>
        </div>

        <div class="pt-12 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center text-[10px] font-bold uppercase tracking-widest text-slate-400 gap-8">
            <div>
                © <?php echo date('Y'); ?> Nexoz Consulting Group. Все права защищены.
            </div>
            <div class="flex gap-10">
                <a href="https://webistan.luxury" target="_blank" class="hover:text-bk-blue">Designed by Webistan</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
