�3<?php
/**
 * The template for displaying the front page.
 * (Premium Redesign: PINNED VERSION)
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- HERO SECTION: PINNED VERSION -->
    <section class="hero-section py-24 relative overflow-hidden bg-slate-950 border-b border-slate-900 min-h-[70vh] flex items-center">
        <!-- Manuscript Overlay (Heritage Texture) -->
        <div class="absolute inset-0 opacity-10 pointer-events-none mix-blend-overlay"
            style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/manuscript.jpg'); background-size: cover; background-position: center;">
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <span class="hero-label inline-block px-4 py-2 rounded bg-gold/10 text-gold text-[10px] font-black tracking-[0.4em] mb-10 uppercase border border-gold/20 animate-fade-in-down">
                    Scientific Archive & Cultural Heritage
                </span>
                
                <h1 class="text-white text-5xl md:text-7xl font-serif font-bold leading-tight mb-8 animate-fade-in">
                    <?php echo academy_t(array(
                        'en' => 'Preserving the Living <span class="italic text-gold">Sogdian</span> Heritage.',
                        'tj' => 'Ҳифзи мероси зиндаи <span class="italic text-gold">суғдӣ</span>.',
                        'yg' => 'Preserving the Living Sogdian Heritage.'
                    )); ?>
                </h1>
                
                <p class="text-slate-400 text-lg md:text-xl leading-relaxed mb-12 max-w-3xl mx-auto animate-fade-in" style="animation-delay: 0.2s;">
                    <?php echo academy_t(array(
                        'en' => 'Our mission is the systematic documentation and preservation of the Yaghnobi language and its ancestral connections to the Sogdian civilization.',
                        'tj' => 'Вазифаи мо ҳуҷҷатгузории мунтазам ва ҳифзи забони яғнобӣ ва иртиботи аҷдодии он бо тамаддуни суғдӣ мебошад.'
                    )); ?>
                </p>
                
                <div class="flex flex-col sm:flex-row gap-6 justify-center animate-fade-in" style="animation-delay: 0.4s;">
                    <a href="#archives" class="btn btn-gold bg-gold text-white px-10 py-5 font-bold uppercase tracking-widest text-[10px] hover:bg-white hover:text-ink transition-all">
                        Enter Archive
                    </a>
                    <a href="#mission" class="btn border border-white/20 text-white px-10 py-5 font-bold uppercase tracking-widest text-[10px] hover:bg-white hover:text-ink transition-all">
                        About Project
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ARCHIVES GRID -->
    <section id="archives" class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-baseline mb-20 gap-8">
                <div class="max-w-2xl">
                    <h2 class="text-4xl font-serif font-bold text-ink mb-4">Core Research</h2>
                    <p class="text-slate-500 italic">Systematic digitization of the valley's unique linguistic and cultural strata.</p>
                </div>
                <a href="#" class="text-ink font-bold text-[10px] uppercase tracking-widest border-b-2 border-gold pb-1 hover:text-gold transition-colors">
                    View All Collections
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
                    <div class="group relative p-10 border border-slate-100 flex flex-col hover:border-gold transition-all <?php echo isset($c['featured']) ? 'bg-ink text-white' : 'bg-white'; ?>">
                        <span class="text-gold text-[10px] font-black uppercase tracking-widest mb-10"><?php echo $c['label']; ?></span>
                        <h3 class="text-2xl font-serif font-bold mb-4 <?php echo isset($c['featured']) ? 'text-white' : 'text-ink'; ?>"><?php echo academy_t($c['title']); ?></h3>
                        <p class="text-sm leading-relaxed mb-12 flex-grow <?php echo isset($c['featured']) ? 'text-slate-400' : 'text-slate-600'; ?>">
                            <?php echo academy_t($c['text']); ?>
                        </p>
                        <a href="#" class="font-bold text-[10px] uppercase tracking-widest border-b border-slate-100 w-fit pb-1 group-hover:border-gold transition-colors">
                            Explore Archive →
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- MISSION STATEMENT -->
    <section id="mission" class="py-32 bg-slate-50 relative overflow-hidden">
        <div class="container mx-auto px-6 text-center max-w-4xl relative z-10">
            <div class="w-12 h-1 bg-gold mx-auto mb-16"></div>
            <p class="text-3xl md:text-5xl font-serif font-bold italic text-ink leading-tight mb-16">
                <?php echo academy_t("We do not just archive data; we safeguard the heartbeat of a civilization that has survived in these mountains since the fall of Panjakent."); ?>
            </p>
            <span class="block text-gold font-bold uppercase tracking-[0.3em] text-xs">Digital Heritage Foundation</span>
        </div>
    </section>

</main>

<?php get_footer(); ?>
 *cascade08*cascade08 *cascade08*cascade08 *cascade08*cascade08 *cascade08 *cascade08*cascade08  *cascade08 $*cascade08$& *cascade08&'*cascade08'( (**cascade08*+ *cascade08+6*cascade0867 78*cascade0889 *cascade089:*cascade08:? *cascade08?G*cascade08GH *cascade08HI*cascade08IL *cascade08La*cascade08aw *cascade08wx*cascade08x� *cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08
�� ��*cascade08��*cascade08��*cascade08��*cascade08��*cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08���� *cascade08���� *cascade08���� *cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08����*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08���� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08��	*cascade08
�	�	 �	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	*cascade08
�	�	 �	�	 *cascade08�	�	*cascade08�	�	 *cascade08�	�	*cascade08
�	�	 �	�	*cascade08�	�	 *cascade08�	�	 *cascade08�	�
*cascade08�
�
*cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
*cascade08�
�
*cascade08�
�
 *cascade08�
�
 *cascade08�
�
�
�
 *cascade08�
�
 *cascade08�
�
 *cascade08�
�
�
�
 *cascade08�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
*cascade08�
�
 *cascade08�
�
�
�
 *cascade08�
�
�
�
 *cascade08�
�
 *cascade08
�
�
 �
�
 *cascade08�
� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08����*cascade08�� *cascade08�� *cascade08���� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08����*cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��
*cascade08�
�
 *cascade08�
�
*cascade08�
�
 *cascade08�
�
*cascade08
�
�
 �
�
*cascade08
�
�
 �
�
*cascade08
�
�
 �
�
*cascade08
�
�
 �
�
*cascade08
�
�
 �
�
*cascade08
�
�
 �
�
*cascade08
�
�
 �
�
*cascade08
�
�
 �
�
*cascade08
�
�
 �
�
*cascade08�
�
 *cascade08�
�
 *cascade08�
�
*cascade08
�
�
 �
�
*cascade08
�
�
 �
�
*cascade08�
�
 *cascade08�
�
*cascade08
�
�
 �
�
 *cascade08�
�*cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08���� *cascade08���� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08��*cascade08��*cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08�� *cascade08���� *cascade08���� *cascade08��*cascade08�� *cascade08�� *cascade08���� *cascade08���� *cascade08�� *cascade08���� *cascade08���� *cascade08�� *cascade08���� *cascade08��*cascade08
�� ��*cascade08
�� �� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08���� *cascade08���� *cascade08��*cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08���� *cascade08�� *cascade08�� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� �� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08�� *cascade08����*cascade08��*cascade08���� *cascade08�� *cascade08���� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08���� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08���� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08��*cascade08��*cascade08�� *cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08���� *cascade08���� *cascade08���� *cascade08�� *cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08
�� �� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08
�� �� *cascade08���� *cascade08���� *cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08��*cascade08���� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08
�� ��*cascade08
�� �� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08
�� ��*cascade08��*cascade08��*cascade08
�� �� *cascade08��*cascade08�� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08��*cascade08��*cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08���� *cascade08��*cascade08�� *cascade08
�� ��*cascade08
�� �� *cascade08����*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08
�� ��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08���� *cascade08��*cascade08�� *cascade08���� *cascade08���� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08
�� �� *cascade08�� *cascade08���� *cascade08�� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� �� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
�� �� *cascade08�� *cascade08�� *cascade08���� *cascade08���� *cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08��*cascade08
�� ��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08����*cascade08�� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08
�� ��*cascade08
�� ��*cascade08��*cascade08
�� ��*cascade08�� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08
�� �� *cascade08��*cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08��*cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08�� *cascade08
�� �� *cascade08���� *cascade08
�� �� *cascade08�� *cascade08���� *cascade08�� *cascade08�� *cascade08�� *cascade08�� *cascade08���� *cascade08���� *cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08�� *cascade08��*cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08
�� �� *cascade08���� *cascade08
�� ��*cascade08
�� ��*cascade08
�� ��*cascade08
�� �� *cascade08
�� �� *cascade08��*cascade08�� *cascade08���� *cascade08��*cascade08��*cascade08�� *cascade08�� *cascade08���� *cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08��*cascade08�� *cascade08
�� ��*cascade08
�� �� *cascade08���� *cascade08���� *cascade08���� *cascade08����*cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08���� *cascade08
��  � �  *cascade08� �  *cascade08� �  *cascade08� � � �  *cascade08� �  *cascade08� � � �  *cascade08� � � �  *cascade08� � *cascade08� �  *cascade08� �  *cascade08� �  *cascade08
� �  � � *cascade08
� �  � � *cascade08� �  *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � *cascade08
� �  � � *cascade08
� �  � � *cascade08
� �  � � *cascade08� �  *cascade08� � *cascade08
� �  � � *cascade08� � � �  *cascade08� �  *cascade08� �  *cascade08� �  *cascade08� �  *cascade08� �  *cascade08� � � �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� � *cascade08� �  *cascade08� �!*cascade08
�!�! �!�!*cascade08�!�! *cascade08�!�!*cascade08�!�! *cascade08�!�!*cascade08
�!�! �!�!*cascade08
�!�! �!�!*cascade08�!�! *cascade08�!�!*cascade08�!�! *cascade08�!�!*cascade08
�!�! �!�!*cascade08
�!�! �!�!*cascade08
�!�! �!�! *cascade08�!�!*cascade08
�!�! �!�!*cascade08
�!�! �!�!*cascade08
�!�! �!�!*cascade08
�!�! �!�!*cascade08�!�! *cascade08�!�!*cascade08�!�! *cascade08�!�!*cascade08
�!�! �!�!*cascade08
�!�! �!�!*cascade08
�!�! �!�!*cascade08
�!�! �!�!*cascade08
�!�! �!�!*cascade08
�!�! �!�! *cascade08
�!�! �!�! *cascade08
�!�! �!�! *cascade08�!�!*cascade08�!�! *cascade08�!�!*cascade08
�!�! �!�!*cascade08
�!�! �!�! *cascade08�!�"*cascade08
�"�" �"�" *cascade08�"�"*cascade08�"�" *cascade08
�"�" �"�" *cascade08�"�"*cascade08
�"�" �"�"*cascade08�"�" *cascade08
�"�" �"�" *cascade08�"�"*cascade08�"�" *cascade08
�"�" �"�"*cascade08
�"�" �"�" *cascade08�"�"*cascade08
�"�" �"�"*cascade08�"�" *cascade08
�"�" �"�"*cascade08
�"�" �"�"*cascade08�"�" *cascade08�"�"*cascade08�"�" *cascade08�"�"*cascade08
�"�" 
�"�" �"�" *cascade08�"�"*cascade08
�"�" �"�"*cascade08
�"�" �"�"*cascade08�"�" *cascade08�"�"�"�" *cascade08�"�"�"�" *cascade08�"�"
�"�" �"�"*cascade08�"�"*cascade08�"�"*cascade08�"�"*cascade08
�"�" �"�"*cascade08
�"�" �"�" *cascade08�"�"*cascade08
�"�" �"�"*cascade08�"�" *cascade08
�"�" �"�"*cascade08
�"�" �"�#*cascade08�#�# *cascade08�#�# *cascade08�#�#*cascade08�#�# *cascade08�#�#�#�# *cascade08
�#�# �#�#*cascade08
�#�# �#�#*cascade08
�#�# �#�#*cascade08
�#�# �#�#*cascade08
�#�# �#�#*cascade08
�#�# �#�#*cascade08
�#�# �#�#*cascade08
�#�# �#�#*cascade08
�#�# �#�#*cascade08�#�# *cascade08�#�#*cascade08�#�# *cascade08�#�#*cascade08
�#�# �#�#*cascade08
�#�# �#�#*cascade08
�#�# �#�$*cascade08
�$�$ �$�$*cascade08
�$�$ �$�$*cascade08
�$�$ �$�$*cascade08
�$�$ �$�$*cascade08
�$�$ �$�$*cascade08
�$�$ �$�$*cascade08
�$�$ �$�$*cascade08
�$�$ �$�$*cascade08
�$�$ �$�$*cascade08
�$�$ �$�$*cascade08
�$�$ �$�$*cascade08�$�$*cascade08
�$�$ �$�$*cascade08
�$�$ �$�$*cascade08�$�$�$�$ *cascade08�$�$ *cascade08�$�$*cascade08
�$�$ �$�$*cascade08
�$�$ �$�$ *cascade08�$�% *cascade08�%�%�%�% *cascade08�%�%*cascade08
�%�% �%�%*cascade08
�%�% �%�%*cascade08�%�% *cascade08�%�%*cascade08
�%�% �%�%*cascade08�%�% *cascade08�%�%*cascade08�%�% *cascade08�%�%*cascade08�%�% *cascade08�%�%*cascade08�%�% *cascade08�%�%*cascade08
�%�% �%�%*cascade08
�%�% �%�%*cascade08
�%�% �%�% *cascade08�%�%*cascade08�%�% *cascade08�%�&*cascade08�&�& *cascade08�&�&*cascade08�&�& *cascade08�&�&*cascade08�&�& *cascade08�&�&*cascade08�&�&�&�&*cascade08�&�& *cascade08�&�&*cascade08�&�& *cascade08�&�&*cascade08�&�& *cascade08�&�&*cascade08�&�&�&�& *cascade08�&�'*cascade08�'�' *cascade08�'�'*cascade08�'�' *cascade08�'�'*cascade08�'�' *cascade08�'�'*cascade08�'�' *cascade08�'�'*cascade08�'�'*cascade08�'�'�'�' *cascade08�'�'*cascade08
�'�' �'�' *cascade08�'�'�'�' *cascade08
�'�' �'�'�'�' *cascade08�'�' *cascade08�'�' *cascade08�'�' *cascade08�'�'*cascade08�'�' *cascade08�'�' *cascade08
�'�' �'�' *cascade08
�'�' �'�'*cascade08�'�' *cascade08�'�'�'�( *cascade08�(�(*cascade08�(�( *cascade08�(�(*cascade08�(�( *cascade08�(�(*cascade08�(�( *cascade08�(�(*cascade08�(�( *cascade08�(�(*cascade08�(�( *cascade08�(�(*cascade08�(�( *cascade08�(�( *cascade08�(�(*cascade08�(�( *cascade08�(�(*cascade08�(�( *cascade08�(�( *cascade08�(�(*cascade08�(�(*cascade08�(�( *cascade08�(�(*cascade08�(�( *cascade08�(�( *cascade08�(�(*cascade08�(�(*cascade08�(�(*cascade08
�(�( �(�(*cascade08�(�( *cascade08�(�( *cascade08�(�(*cascade08
�(�( �(�(*cascade08�(�( *cascade08�(�( *cascade08�(�(*cascade08�(�( *cascade08�(�( *cascade08�(�(*cascade08
�(�( �(�( *cascade08�(�(*cascade08�(�( *cascade08�(�(*cascade08
�(�( �(�(*cascade08�(�( *cascade08�(�(*cascade08
�(�( 
�(�( �(�(*cascade08
�(�( 
�(�( �(�)*cascade08�)�) *cascade08�)�)*cascade08�)�) *cascade08�)�)*cascade08�)�) *cascade08�)�) *cascade08�)�) *cascade08�)�)�)�) *cascade08�)�) *cascade08�)�) *cascade08�)�)*cascade08�)�)*cascade08�)�) *cascade08�)�) *cascade08�)�) *cascade08�)�) *cascade08�)�) *cascade08�)�) *cascade08�)�)*cascade08�)�) *cascade08�)�)*cascade08�)�) *cascade08�)�) *cascade08�)�) *cascade08�)�)*cascade08�)�) *cascade08�)�)*cascade08
�)�) �)�)*cascade08
�)�) �)�)*cascade08�)�) *cascade08�)�) *cascade08�)�)*cascade08
�)�) �)�)*cascade08
�)�) �)�)*cascade08
�)�) �)�)*cascade08
�)�) �)�)*cascade08
�)�) �)�)*cascade08
�)�) �)�)*cascade08
�)�) �)�**cascade08
�*�* �*�**cascade08�*�* *cascade08�*�**cascade08
�*�* �*�**cascade08�*�**cascade08
�*�* �*�**cascade08�*�* *cascade08�*�**cascade08�*�* *cascade08�*�**cascade08
�*�* �*�**cascade08
�*�* �*�**cascade08
�*�* �*�**cascade08
�*�* �*�**cascade08
�*�* �*�**cascade08
�*�* �*�**cascade08
�*�* �*�**cascade08
�*�* �*�**cascade08
�*�* �*�* *cascade08�*�* *cascade08
�*�* �*�* *cascade08�*�**cascade08�*�* *cascade08�*�**cascade08�*�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+*cascade08�+�+*cascade08�+�+ *cascade08�+�+*cascade08�+�+ *cascade08�+�,*cascade08�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,*cascade08�,�, *cascade08�,�,*cascade08�,�- *cascade08�-�-*cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�- *cascade08�-�- *cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08
�-�- �-�- *cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�- *cascade08�-�- *cascade08�-�- *cascade08�-�- *cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�-*cascade08�-�- *cascade08�-�- *cascade08�-�- *cascade08�-�-*cascade08�-�. *cascade08�.�. *cascade08
�.�. �.�.*cascade08
�.�. �.�.*cascade08
�.�. �.�.*cascade08
�.�. �.�.*cascade08
�.�. �.�.*cascade08
�.�. �.�.*cascade08
�.�. �.�.*cascade08
�.�. �.�.*cascade08
�.�. �.�.*cascade08�.�. *cascade08�.�.*cascade08�.�. *cascade08
�.�/ �/�/*cascade08
�/�/ �/�/*cascade08
�/�/ �/�/*cascade08
�/�/ �/�/*cascade08�/�/ *cascade08�/�/*cascade08
�/�/ �/�/ *cascade08
�/�/ �/�/*cascade08
�/�/ �/�0*cascade08
�0�0 �0�0*cascade08
�0�0 �0�0*cascade08�0�0*cascade08�0�0*cascade08�0�0 *cascade08�0�0*cascade08
�0�0 �0�0*cascade08�0�0*cascade08
�0�0 �0�0*cascade08
�0�0 �0�0*cascade08�0�0 *cascade08�0�0*cascade08
�0�0 �0�0*cascade08
�0�0 �0�0*cascade08
�0�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�1 �1�1*cascade08
�1�2 �2�2*cascade08
�2�2 �2�2*cascade08
�2�2 �2�2*cascade08
�2�2 �2�2*cascade08
�2�2 �2�2*cascade08�2�2 *cascade08�2�2*cascade08�2�2 *cascade08�2�2*cascade08
�2�2 �2�2*cascade08
�2�2 �2�2*cascade08
�2�2 �2�2*cascade08
�2�2 �2�2*cascade08�2�2*cascade08�2�2*cascade08
�2�2 �2�2*cascade08
�2�2 �2�2 *cascade08�2�2*cascade08�2�2 *cascade08
�2�2 �2�2*cascade08�2�2*cascade08�2�2*cascade08
�2�2 �2�2*cascade08
�2�2 �2�3*cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08
�3�3 �3�3*cascade08�3�3 *cascade08�3�3*cascade08�3�3 *cascade08�3�3 *cascade08�3�3 *cascade08�3�3*cascade08�3�3 *cascade08�3�3*cascade08�3�3 *cascade0826file:///c:/Users/alaco/Academy_Webistan/front-page.php
