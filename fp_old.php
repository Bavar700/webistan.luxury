�4<?php
/**
 * The template for displaying the front page.
 * (Premium Redesign: PINNED VERSION)
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- HERO SECTION: PINNED VERSION -->
    <section class="hero-section py-24 relative overflow-hidden bg-slate-950 border-b border-slate-900 min-h-[75vh] flex items-center">
        <!-- Manuscript Overlay -->
        <div class="absolute inset-0 opacity-10 pointer-events-none mix-blend-overlay"
            style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/manuscript.jpg'); background-size: cover; background-position: center;">
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <span class="hero-label inline-block px-4 py-2 rounded bg-gold/10 text-gold text-[10px] font-black tracking-[0.4em] mb-10 uppercase border border-gold/20 animate-fade-in-down">
                    <?php echo academy_t('Scientific Archive & Cultural Heritage'); ?>
                </span>
                
                <h1 class="text-white text-5xl md:text-7xl font-serif font-bold leading-tight mb-8 animate-fade-in">
                    <?php echo academy_t(array(
                        'en' => 'Preserving the Living <span class="italic text-gold">Sogdian</span> Heritage.',
                        'tj' => 'Ҳифзи мероси зиндаи <span class="italic text-gold">суғдӣ</span>.',
                        'yg' => 'Preserving the Living Sogdian Heritage.'
                    )); ?>
                </h1>
                
                <p class="text-slate-400 text-lg md:text-xl leading-relaxed mb-12 max-w-3xl mx-auto animate-fade-in" style="animation-delay: 0.2s;">
                    <?php echo academy_t('Our mission is the systematic documentation and preservation of the Yaghnobi language and its ancestral connections to the Sogdian civilization.'); ?>
                </p>
                
                <div class="flex flex-col sm:flex-row gap-6 justify-center animate-fade-in" style="animation-delay: 0.4s;">
                    <a href="#archives" class="bg-gold text-white px-10 py-5 font-bold uppercase tracking-widest text-[10px] hover:bg-white hover:text-ink transition-all">
                        <?php echo academy_t('Enter Archive'); ?>
                    </a>
                    <a href="#mission" class="border border-white/20 text-white px-10 py-5 font-bold uppercase tracking-widest text-[10px] hover:bg-white hover:text-ink transition-all">
                        <?php echo academy_t('About Project'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ARCHIVES GRID -->
    <section id="archives" class="py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-baseline mb-24 gap-8">
                <div class="max-w-2xl">
                    <h2 class="text-4xl font-serif font-bold text-ink mb-4"><?php echo academy_t('Core Research'); ?></h2>
                    <p class="text-slate-500 italic"><?php echo academy_t('Systematic digitization of the valley\'s unique linguistic and cultural strata.'); ?></p>
                </div>
                <a href="#" class="text-ink font-bold text-[10px] uppercase tracking-widest border-b-2 border-gold pb-1 hover:text-gold transition-colors">
                    <?php echo academy_t('View All Collections'); ?>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $collections = array(
                    array('title' => 'Oral Histories', 'label' => 'Collection I', 'text' => 'High-fidelity field recordings documenting family chronicles and ancestral rituals.'),
                    array('title' => 'Linguistic Corpus', 'label' => 'Collection II', 'text' => 'Comparative analysis of Yaghnobi and East Old Iranian dialects with phonetic database.'),
                    array('title' => 'Field Mapping', 'label' => 'Collection III', 'text' => 'Topographical and historical mapping of Yaghnobi settlements and sacred geography.'),
                    array('title' => 'Manuscript Archive', 'label' => 'Collection IV', 'text' => 'Digital preservation of ancient Sogdian scripts found in the valley.', 'featured' => true)
                );

                foreach ($collections as $c): ?>
                    <div class="group relative p-10 border border-slate-100 flex flex-col hover:border-gold transition-all <?php echo isset($c['featured']) ? 'bg-ink text-white shadow-2xl scale-[1.02] z-10' : 'bg-white'; ?>">
                        <span class="text-gold text-[10px] font-black uppercase tracking-widest mb-10"><?php echo $c['label']; ?></span>
                        <h3 class="text-2xl font-serif font-bold mb-4 <?php echo isset($c['featured']) ? 'text-white' : 'text-ink'; ?>"><?php echo academy_t($c['title']); ?></h3>
                        <p class="text-sm leading-relaxed mb-12 flex-grow <?php echo isset($c['featured']) ? 'text-slate-400' : 'text-slate-600'; ?>">
                            <?php echo academy_t($c['text']); ?>
                        </p>
                        <a href="#" class="font-bold text-[10px] uppercase tracking-widest border-b border-slate-100 w-fit pb-1 group-hover:border-gold transition-colors">
                            <?php echo academy_t('Explore Archive'); ?> →
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- MISSION STATEMENT -->
    <section id="mission" class="py-40 bg-slate-50 relative overflow-hidden">
        <div class="container mx-auto px-6 text-center max-w-4xl relative z-10">
            <div class="w-12 h-1 bg-gold mx-auto mb-16"></div>
            <p class="text-3xl md:text-5xl font-serif font-bold italic text-ink leading-tight mb-20">
                <?php echo academy_t("We do not just archive data; we safeguard the heartbeat of a civilization that has survived in these mountains since the fall of Panjakent."); ?>
            </p>
            <div class="flex items-center justify-center gap-4">
                <div class="w-10 h-[1px] bg-gold opacity-30"></div>
                <span class="text-gold font-black uppercase tracking-[0.4em] text-[10px]">Digital Heritage Foundation</span>
                <div class="w-10 h-[1px] bg-gold opacity-30"></div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?> *cascade08*cascade08 *cascade08*cascade08 *cascade08*cascade08 *cascade08 *cascade08   '*cascade08'( ()*cascade08)* *,*cascade08,- -2*cascade0823 34*cascade0845 56*cascade0867 78*cascade0889 9:*cascade08:? *cascade08?B*cascade08BC *cascade08CG*cascade08GH *cascade08HJ*cascade08JL *cascade08La*cascade08aw *cascade08wx*cascade08x� *cascade08
�� ��*cascade08
�� �� *cascade08��*cascade08�� *cascade08��*cascade08
�� ��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08
�� ��*cascade08�� *cascade08
�� �� *cascade08
�� �� *cascade08��*cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08���� *cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08���� *cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08
�� ��*cascade08
�� �� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08����*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� ��*cascade08
�� ��*cascade08
�� �� *cascade08��*cascade08�� *cascade08��*cascade08
�� ��*cascade08
�� �� *cascade08����*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08
�� �� *cascade08���� *cascade08���� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08���� *cascade08
�� ��*cascade08�� *cascade08���� *cascade08
�� ��*cascade08�� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08��*cascade08�� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��	*cascade08
�	�	 �	�	*cascade08
�	�	 �	�	 *cascade08�	�	*cascade08
�	�	 �	�	*cascade08
�	�	 �	�	*cascade08�	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	�	�	 *cascade08�	�	�	�	 *cascade08�	�	�	�	 *cascade08�	�	�	�	 *cascade08�	�	�	�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� �� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08
�� ��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� ��*cascade08
�� �� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� �� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� ��*cascade08�� *cascade08��*cascade08
�� �� *cascade08��*cascade08
�� �� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� ��*cascade08
�� �� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08��*cascade08����*cascade08�� *cascade08��*cascade08����*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� ��*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08
�� ��*cascade08�� *cascade08
�� ��*cascade08�� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� ��*cascade08
�� �� *cascade08��*cascade08�� *cascade08��*cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08����*cascade08�� *cascade08���� *cascade08
�� �� *cascade08���� *cascade08���� *cascade08
�� �� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� �� *cascade08���� *cascade08��*cascade08�� *cascade08
�� ��*cascade08�� *cascade08���� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08
�� ��*cascade08
�� �� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08��*cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� �� *cascade08���� *cascade08���� *cascade08
�� �� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� �� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� �� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� �� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� ��*cascade08
�� ��*cascade08
�� �� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08���� *cascade08���� *cascade08����*cascade08�� *cascade08��*cascade08
�� �� *cascade08
�� ��*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08
�� �� *cascade08���� *cascade08����*cascade08�� *cascade08��*cascade08�� *cascade08
�� ��*cascade08�� *cascade08
�� ��*cascade08
�� �� *cascade08���� *cascade08���� *cascade08
�� ��*cascade08
�� �� *cascade08
�� ��*cascade08�� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08����*cascade08�� *cascade08��*cascade08
�� �� *cascade08
�� �� *cascade08��*cascade08
�� ��*cascade08�� *cascade08��*cascade08���� *cascade08
�� ��*cascade08
�� ��*cascade08
�� �� *cascade08���� *cascade08
�� ��*cascade08�� *cascade08
�� ��*cascade08
�� �� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08�� � �  *cascade08� � � �  *cascade08� � � �  *cascade08� � � �  *cascade08� � � �  *cascade08� � � �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � � �  *cascade08� � � �  *cascade08� � � �  *cascade08� � � �  *cascade08� � � �  *cascade08� � � �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� � � �  *cascade08� � � �  *cascade08� � � �! *cascade08�!�!�!�! *cascade08�!�!*cascade08�!�! *cascade08
�!�! �!�!*cascade08
�!�! �!�!*cascade08�!�! *cascade08
�!�! �!�! *cascade08�!�!�!�! *cascade08
�!�! �!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08
�!�! �!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08�!�!�!�! *cascade08
�!�! �!�!*cascade08�!�! *cascade08�!�!*cascade08�!�! *cascade08�!�"*cascade08�"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08
�"�" �"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08�"�"�"�" *cascade08�"�"�"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08
�"�" �"�"*cascade08�"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08
�"�" �"�"*cascade08
�"�" �"�"*cascade08
�"�" �"�"*cascade08
�"�" �"�#*cascade08�#�# *cascade08�#�#*cascade08�#�# *cascade08�#�#*cascade08�#�# *cascade08�#�#*cascade08
�#�# �#�#*cascade08
�#�# �#�#*cascade08
�#�# �#�# *cascade08�#�#*cascade08�#�# *cascade08�#�#*cascade08
�#�# �#�#*cascade08�#�# *cascade08�#�#*cascade08�#�# *cascade08�#�#*cascade08
�#�# �#�# *cascade08�#�#*cascade08�#�# *cascade08�#�#*cascade08
�#�# �#�# *cascade08�#�#�#�#*cascade08�#�# *cascade08�#�#*cascade08�#�# *cascade08�#�#*cascade08�#�# *cascade08�#�#*cascade08�#�$ *cascade08�$�$*cascade08
�$�$ �$�$*cascade08
�$�$ �$�$*cascade08�$�$ *cascade08�$�$*cascade08
�$�$ �$�$*cascade08�$�$ *cascade08�$�$*cascade08�$�$ *cascade08�$�$*cascade08�$�$ *cascade08�$�$*cascade08�$�$ *cascade08�$�$*cascade08�$�$ *cascade08�$�$*cascade08
�$�$ �$�$*cascade08�$�$ *cascade08�$�$*cascade08�$�$�$�$ *cascade08�$�$*cascade08�$�$ *cascade08�$�$�$�$ *cascade08�$�$*cascade08�$�$�$�%*cascade08�%�% *cascade08�%�%*cascade08�%�%�%�% *cascade08�%�%*cascade08
�%�% �%�%*cascade08
�%�% �%�%*cascade08�%�% *cascade08�%�%*cascade08�%�% *cascade08�%�%�%�% *cascade08�%�%*cascade08
�%�% �%�%*cascade08�%�% *cascade08�%�%*cascade08�%�& *cascade08�&�&�&�& *cascade08
�&�& �&�&*cascade08�&�& *cascade08�&�&*cascade08�&�& *cascade08�&�&*cascade08�&�&�&�&*cascade08�&�& *cascade08�&�&*cascade08�&�& *cascade08�&�&*cascade08�&�& *cascade08�&�&*cascade08�&�& *cascade08�&�&*cascade08�&�& *cascade08�&�&*cascade08�&�& *cascade08�&�&�&�& *cascade08�&�&�&�& *cascade08�&�&*cascade08�&�& *cascade08�&�&�&�' *cascade08�'�'�'�' *cascade08�'�'*cascade08�'�' *cascade08�'�'*cascade08�'�' *cascade08�'�'*cascade08
�'�' �'�' *cascade08�'�'�'�' *cascade08
�'�' �'�'*cascade08�'�' *cascade08
�'�' �'�'*cascade08
�'�' �'�'*cascade08�'�' *cascade08�'�'*cascade08�'�'�'�'*cascade08�'�' *cascade08�'�'*cascade08
�'�' �'�'*cascade08�'�' *cascade08�'�'*cascade08�'�' *cascade08�'�'�'�'*cascade08�'�' *cascade08
�'�' �'�'*cascade08
�'�' �'�' *cascade08�'�'*cascade08
�'�' �'�'*cascade08
�'�' �'�'*cascade08
�'�' �'�'*cascade08
�'�' �'�'*cascade08�'�' *cascade08�'�'*cascade08�'�' *cascade08
�'�' �'�'*cascade08�'�' *cascade08�'�'*cascade08
�'�' �'�'*cascade08�'�' *cascade08�'�(*cascade08
�(�( �(�(*cascade08
�(�( �(�( *cascade08�(�(�(�( *cascade08�(�(�(�( *cascade08�(�(*cascade08�(�( *cascade08
�(�( �(�(*cascade08
�(�( �(�( *cascade08�(�(�(�( *cascade08�(�(�(�( *cascade08�(�(�(�( *cascade08�(�(*cascade08�(�) *cascade08�)�)�)�) *cascade08�)�)*cascade08�)�) *cascade08�)�)*cascade08�)�) *cascade08�)�)*cascade08
�)�) �)�)*cascade08�)�) *cascade08�)�)*cascade08�)�)�)�) *cascade08�)�)*cascade08�)�) *cascade08�)�)*cascade08�)�) *cascade08�)�)*cascade08�)�) *cascade08�)�)*cascade08�)�) *cascade08
�)�) �)�) *cascade08�)�)*cascade08�)�) *cascade08�)�)*cascade08
�)�) �)�)*cascade08�)�) *cascade08�)�)*cascade08�)�) *cascade08�)�)*cascade08�)�) *cascade08�)�)�)�* *cascade08�*�*�*�* *cascade08�*�**cascade08�*�* *cascade08�*�*�*�* *cascade08�*�*�*�* *cascade08�*�**cascade08�*�* *cascade08�*�**cascade08�*�* *cascade08�*�**cascade08�*�* *cascade08�*�**cascade08�*�* *cascade08�*�**cascade08�*�* *cascade08�*�**cascade08�*�* *cascade08�*�**cascade08�*�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+�+�,*cascade08�,�, *cascade08�,�,�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,�,�, *cascade08�,�,�,�, *cascade08�,�,�,�,*cascade08�,�- *cascade08
�-�- �-�-*cascade08
�-�- �-�-*cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�-�-�-*cascade08�-�- *cascade08�-�-*cascade08
�-�- �-�.*cascade08
�.�. �.�.*cascade08�.�. *cascade08�.�.*cascade08�.�. *cascade08�.�.�.�. *cascade08�.�.�.�. *cascade08�.�.*cascade08�.�. *cascade08�.�.*cascade08�.�. *cascade08�.�.*cascade08�.�. *cascade08�.�.*cascade08�.�. *cascade08�.�.*cascade08�.�. *cascade08�.�.*cascade08�.�. *cascade08�.�.*cascade08
�.�. �.�.*cascade08
�.�. �.�. *cascade08�.�/�/�/ *cascade08�/�/*cascade08�/�/ *cascade08�/�/*cascade08�/�/ *cascade08�/�/�/�/ *cascade08
�/�/ �/�/*cascade08�/�/ *cascade08�/�/*cascade08�/�/ *cascade08�/�/*cascade08�/�/�/�/ *cascade08�/�/�/�/ *cascade08�/�/�/�/ *cascade08�/�/*cascade08�/�/ *cascade08�/�/*cascade08�/�/ *cascade08�/�/*cascade08�/�/ *cascade08�/�/�/�/ *cascade08�/�/�/�/ *cascade08�/�/*cascade08�/�/ *cascade08
�/�/ �/�/*cascade08
�/�/ �/�/*cascade08�/�0 *cascade08�0�0*cascade08
�0�0 �0�0 *cascade08
�0�0 �0�0*cascade08
�0�0 �0�0 *cascade08
�0�0 �0�0 *cascade08�0�0*cascade08�0�0 *cascade08�0�0*cascade08�0�0 *cascade08�0�0*cascade08�0�0 *cascade08�0�0�0�0 *cascade08�0�0�0�0 *cascade08�0�0*cascade08
�0�0 �0�0*cascade08
�0�0 �0�0*cascade08
�0�0 �0�0 *cascade08�0�0*cascade08
�0�0 �0�0 *cascade08�0�0*cascade08�0�0 *cascade08�0�0*cascade08
�0�0 �0�0 *cascade08�0�0�0�0 *cascade08�0�0*cascade08�0�0 *cascade08
�0�0 �0�0*cascade08
�0�0 �0�0 *cascade08�0�0*cascade08�0�0 *cascade08�0�0*cascade08�0�0 *cascade08�0�0*cascade08�0�0 *cascade08
�0�0 �0�0*cascade08�0�0 *cascade08�0�0*cascade08�0�0 *cascade08�0�0*cascade08�0�0 *cascade08�0�0*cascade08�0�0 *cascade08�0�1*cascade08�1�1 *cascade08�1�1*cascade08�1�1 *cascade08�1�1*cascade08�1�1 *cascade08�1�1*cascade08�1�1 *cascade08�1�1*cascade08
�1�1 �1�1 *cascade08�1�1*cascade08�1�1 *cascade08�1�1*cascade08�1�1�1�1*cascade08�1�1 *cascade08�1�1*cascade08
�1�1 �1�1*cascade08�1�1 *cascade08�1�1�1�1*cascade08�1�1 *cascade08�1�2*cascade08
�2�2 �2�2*cascade08�2�2 *cascade08
�2�2 �2�2*cascade08
�2�2 �2�2*cascade08
�2�2 �2�2 *cascade08�2�2�2�2 *cascade08�2�2�2�2 *cascade08�2�2*cascade08�2�2 *cascade08�2�2*cascade08�2�2 *cascade08�2�2*cascade08�2�2 *cascade08�2�2*cascade08�2�2 *cascade08�2�2�2�2 *cascade08�2�2*cascade08�2�2 *cascade08�2�2*cascade08�2�2�2�2*cascade08�2�2 *cascade08�2�2*cascade08
�2�2 �2�2*cascade08
�2�2 �2�2 *cascade08�2�2*cascade08�2�2 *cascade08�2�3*cascade08
�3�3 �3�3 *cascade08�3�3�3�3 *cascade08�3�3�3�3 *cascade08�3�3�3�3 *cascade08�3�3�3�3 *cascade08�3�3�3�3 *cascade08�3�3*cascade08
�3�3 �3�3*cascade08�3�3 *cascade08�3�3*cascade08�3�3 *cascade08�3�3*cascade08�3�3 *cascade08�3�3*cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08�3�3 *cascade08�3�3*cascade08�3�3 *cascade08�3�3*cascade08�3�3 *cascade08�3�3*cascade08
�3�3 �3�3*cascade08�3�3 *cascade08�3�3*cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08�3�3 *cascade08
�3�3 �3�3*cascade08
�3�3 �3�3 *cascade08�3�3*cascade08�3�3 *cascade08�3�3*cascade08
�3�3 �3�3*cascade08�3�3 *cascade08�3�3*cascade08�3�3 *cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08�3�3 *cascade08�3�3*cascade08
�3�3 �3�3*cascade08�3�4 *cascade08
�4�4 �4�4*cascade08�4�4 *cascade08
�4�4 �4�4 *cascade08�4�4*cascade08�4�4 *cascade08�4�4*cascade08�4�4 *cascade08�4�4*cascade08�4�4 *cascade08�4�4*cascade08�4�4 *cascade08�4�4*cascade08
�4�4 �4�4*cascade08�4�4 *cascade08�4�4*cascade08�4�4 *cascade08�4�4*cascade08�4�4 *cascade08�4�4*cascade08�4�4 *cascade08�4�4*cascade082Jfile:///C:/xampp/htdocs/wordpress/wp-content/themes/academy/front-page.php
