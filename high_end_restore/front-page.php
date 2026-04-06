<?php
/**
 * Шаблон главной страницы (Front Page) - High-End Academic
 *
 * @package Academy
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- HERO: Guaranteed Centering Design -->
    <section class="hero-editorial border-b border-slate-100" style="position: relative; overflow: hidden; background: none;">
        <!-- The background image as a separate element to force absolute centering -->
        <div class="hero-bg-wrapper" style="position: absolute; inset: 0; z-index: 0;">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/manuscript.jpg" 
                 style="width: 100%; height: 100%; object-fit: cover; object-position: center top; display: block;" 
                 alt="Manuscript Background">
        </div>
        <div class="overlay" style="position: absolute; inset: 0; background: rgba(255,255,255,0.78); z-index: 1;"></div>
        
        <div class="container relative z-10 mx-auto px-6">
            <div class="hero-editorial-grid animate-fade-in text-center py-24">
                <span class="pre-title text-gold font-bold uppercase tracking-[0.3em] text-[10px] mb-6 block"><?php echo academy_t('Scientific Archive & Cultural Heritage'); ?></span>
                
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-ink mb-8 leading-tight">
                    <?php echo academy_t('Preserving the Living'); ?>
                    <span class="heritage-focus italic text-gold"><?php echo academy_t('Sogdian Heritage'); ?></span>
                    <?php echo academy_t('in the Heart of Yaghnob'); ?>
                </h1>

                <p class="text-slate-600 text-lg max-w-2xl mx-auto mb-12 leading-relaxed">
                    <?php echo academy_t('Our mission is the systematic documentation and preservation of the Yaghnobi language and its ancestral connections to the Sogdian civilization.'); ?>
                </p>

                <div class="actions flex justify-center gap-6">
                    <a href="#archives" class="bg-ink text-white px-10 py-5 font-bold uppercase tracking-widest text-[10px] hover:bg-gold transition-all"><?php echo academy_t('Enter Archive'); ?></a>
                    <a href="<?php echo home_url('/about'); ?>" class="border-2 border-ink text-ink px-10 py-5 font-bold uppercase tracking-widest text-[10px] hover:bg-ink hover:text-white transition-all"><?php echo academy_t('About Project'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- ARCHIVES: Museum Style Grid -->
    <section id="archives" class="section bg-slate-50 py-32">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                
                <!-- Collection 1 -->
                <div class="archive-card bg-white p-12 border border-slate-100 shadow-sm hover:shadow-xl transition-all flex flex-col">
                    <span class="label text-gold font-bold uppercase tracking-[0.2em] text-[10px] mb-8 block">Collection I</span>
                    <h3 class="text-2xl font-serif font-bold mb-6"><?php echo academy_t('Oral Histories'); ?></h3>
                    <p class="text-slate-600 text-sm mb-12 flex-grow"><?php echo academy_t('A growing library of high-fidelity field recordings documenting family chronicles, traditional songs, and ancestral rituals.'); ?></p>
                    <a href="#" class="text-ink font-bold text-[10px] uppercase tracking-widest hover:text-gold border-b-2 border-gold pb-1 w-fit"><?php echo academy_t('Explore Archive'); ?> &rarr;</a>
                </div>

                <!-- Collection 2 -->
                <div class="archive-card bg-white p-12 border border-slate-100 shadow-sm hover:shadow-xl transition-all flex flex-col">
                    <span class="label text-gold font-bold uppercase tracking-[0.2em] text-[10px] mb-8 block">Collection II</span>
                    <h3 class="text-2xl font-serif font-bold mb-6"><?php echo academy_t('Linguistic Corpus'); ?></h3>
                    <p class="text-slate-600 text-sm mb-12 flex-grow"><?php echo academy_t('Comparative analysis of Yaghnobi and East Old Iranian dialects, including a full phonetic database.'); ?></p>
                    <a href="#" class="text-ink font-bold text-[10px] uppercase tracking-widest hover:text-gold border-b-2 border-gold pb-1 w-fit"><?php echo academy_t('View Documentation'); ?> &rarr;</a>
                </div>

                <!-- Collection 3 -->
                <div class="archive-card bg-white p-12 border border-slate-100 shadow-sm hover:shadow-xl transition-all flex flex-col">
                    <span class="label text-gold font-bold uppercase tracking-[0.2em] text-[10px] mb-8 block">Collection III</span>
                    <h3 class="text-2xl font-serif font-bold mb-6"><?php echo academy_t('Field Mapping'); ?></h3>
                    <p class="text-slate-600 text-sm mb-12 flex-grow"><?php echo academy_t('Topographical and historical mapping of Yaghnobi settlements, migration routes, and sacred geography.'); ?></p>
                    <a href="#" class="text-ink font-bold text-[10px] uppercase tracking-widest hover:text-gold border-b-2 border-gold pb-1 w-fit"><?php echo academy_t('Browse Maps'); ?> &rarr;</a>
                </div>

            </div>
        </div>
    </section>

    <!-- MISSION: Typographic Statement -->
    <section class="section py-40 bg-white">
        <div class="container text-center max-w-4xl mx-auto px-6">
            <div class="mb-16">
                <svg class="w-12 h-12 text-gold opacity-30 mx-auto" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C14.9124 8 14.017 7.10457 14.017 6V5C14.017 3.34315 15.3602 2 17.017 2H18.017C19.6739 2 21.017 3.34315 21.017 5V15C21.017 18.3137 18.3308 21 15.017 21H14.017ZM3 21L3 18C3 16.8954 3.89543 16 5 16H8C8.55228 16 9 15.5523 9 15V9C9 8.44772 8.55228 8 8 8H5C3.89543 8 3 7.10457 3 6V5C3 3.34315 4.34315 2 6 2H7C8.65685 2 10 3.34315 10 5V15C10 18.3137 7.31371 21 4 21H3Z" />
                </svg>
            </div>
            <p class="text-3xl md:text-5xl font-serif italic text-ink leading-relaxed mb-16">
                <?php echo academy_t('"The preservation of the Yaghnobi language is not just a scientific necessity, but a moral imperative to safeguard the last living link to the ancient Sogdian civilization."'); ?>
            </p>
            <div class="flex items-center justify-center gap-4">
                <div class="w-12 h-[1px] bg-gold opacity-30"></div>
                <p class="font-bold text-[10px] uppercase tracking-[0.4em] text-gold">Academy Director</p>
                <div class="w-12 h-[1px] bg-gold opacity-30"></div>
            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php get_footer(); ?>
