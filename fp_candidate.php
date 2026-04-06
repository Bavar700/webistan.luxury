�/<?php
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
        
        <div class="container relative z-10">
            <div class="hero-editorial-grid animate-fade-in">
                <span class="pre-title"><?php echo academy_t('Scientific Archive & Cultural Heritage'); ?></span>
                
                <h1>
                    <?php echo academy_t('Preserving the Living'); ?>
                    <span class="heritage-focus"><?php echo academy_t('Sogdian Heritage'); ?></span>
                    <?php echo academy_t('in the Heart of Yaghnob'); ?>
                </h1>

                <p>
                    <?php echo academy_t('Our mission is the systematic documentation and preservation of the Yaghnobi language and its ancestral connections to the Sogdian civilization.'); ?>
                </p>

                <div class="actions">
                    <a href="#archives" class="btn"><?php echo academy_t('Enter Archive'); ?></a>
                    <a href="<?php echo home_url('/about'); ?>" class="btn btn-outline"><?php echo academy_t('About Project'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- ARCHIVES: Museum Style Grid -->
    <section id="archives" class="section bg-alt" style="padding: 80px 0;">
        <div class="container">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                
                <!-- Collection 1 -->
                <div class="archive-card">
                    <span class="label">Collection I</span>
                    <h3><?php echo academy_t(array('en' => 'Oral Histories', 'tj' => 'Таърихи шифоҳӣ', 'yg' => 'Oral Histories')); ?></h3>
                    <p class="text-sm mb-12 flex-grow">A growing library of high-fidelity field recordings documenting family chronicles, traditional songs, and ancestral rituals.</p>
                    <a href="#" class="text-ink font-bold text-[10px] uppercase tracking-widest hover:text-gold">Explore Archive &rarr;</a>
                </div>

                <!-- Collection 2 -->
                <div class="archive-card">
                    <span class="label">Collection II</span>
                    <h3><?php echo academy_t(array('en' => 'Linguistic Corpus', 'tj' => 'Корпуси забонӣ', 'yg' => 'Linguistic Corpus')); ?></h3>
                    <p class="text-sm mb-12 flex-grow">Comparative analysis of Yaghnobi and East Old Iranian dialects, including a full phonetic database.</p>
                    <a href="#" class="text-ink font-bold text-[10px] uppercase tracking-widest hover:text-gold">View Documentation &rarr;</a>
                </div>

                <!-- Collection 3 -->
                <div class="archive-card">
                    <span class="label">Collection III</span>
                    <h3><?php echo academy_t(array('en' => 'Field Mapping', 'tj' => 'Харитасозии водӣ', 'yg' => 'Field Mapping')); ?></h3>
                    <p class="text-sm mb-12 flex-grow">Topographical and historical mapping of Yaghnobi settlements, migration routes, and sacred geography.</p>
                    <a href="#" class="text-ink font-bold text-[10px] uppercase tracking-widest hover:text-gold">Browse Maps &rarr;</a>
                </div>

            </div>
        </div>
    </section>

    <!-- MISSION: Typographic Statement -->
    <section class="section">
        <div class="container text-center max-w-5xl mx-auto">
            <div class="mb-16">
                <svg class="w-12 h-12 text-gold opacity-20 mx-auto" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C14.9124 8 14.017 7.10457 14.017 6V5C14.017 3.34315 15.3602 2 17.017 2H18.017C19.6739 2 21.017 3.34315 21.017 5V15C21.017 18.3137 18.3308 21 15.017 21H14.017ZM3 21L3 18C3 16.8954 3.89543 16 5 16H8C8.55228 16 9 15.5523 9 15V9C9 8.44772 8.55228 8 8 8H5C3.89543 8 3 7.10457 3 6V5C3 3.34315 4.34315 2 6 2H7C8.65685 2 10 3.34315 10 5V15C10 18.3137 7.31371 21 4 21H3Z" />
                </svg>
            </div>
            <p class="italic-heritage text-3xl md:text-4xl leading-relaxed text-ink mb-12">
                "The preservation of the Yaghnobi language is not just a scientific necessity, but a moral imperative to safeguard the last living link to the ancient Sogdian civilization."
            </p>
            <div class="flex items-center justify-center gap-4">
                <div class="w-12 h-[1px] bg-gold opacity-30"></div>
                <p class="font-bold text-[10px] uppercase tracking-[0.4em] text-gold">Academy Director</p>
                <div class="w-12 h-[1px] bg-gold opacity-30"></div>
            </div>
        </div>
    </section>

</main><!-- #primary -->

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 1s ease forwards;
        opacity: 0;
    }
</style>

<?php
get_footer();
� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08��*cascade08�� *cascade08��*cascade08
�� �� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08
�� ��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08
�� ��*cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��	*cascade08�	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	 *cascade08�	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	 *cascade08�	�	 *cascade08�	�	 *cascade08�	�	 *cascade08�	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�
*cascade08�
�
 *cascade08�
�
 *cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
 *cascade08�
�
 *cascade08�
�
 *cascade08�
�
 *cascade08�
�
 *cascade08�
�
 *cascade08�
�
 *cascade08�
�*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08��*cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08��*cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��/ *cascade082Jfile:///c:/xampp/htdocs/wordpress/wp-content/themes/academy/front-page.php
