<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
get_header(); ?>

<main class="error-page">
    <section class="error-hero" style="min-height: 85vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 120px 20px; background: radial-gradient(circle at center, rgba(0, 68, 204, 0.05) 0%, transparent 70%); overflow: hidden; position: relative;">
        
        <!-- Background Elements -->
        <div style="position: absolute; top: 20%; left: 10%; width: 300px; height: 300px; background: var(--nk-blue); filter: blur(150px); opacity: 0.03; z-index: 0;"></div>
        <div style="position: absolute; bottom: 10%; right: 10%; width: 400px; height: 400px; background: var(--nk-blue); filter: blur(180px); opacity: 0.03; z-index: 0;"></div>

        <div class="nx-container" style="position: relative; z-index: 1;">
            <div class="error-visual" style="position: relative; margin-bottom: 20px;">
                <!-- Large Decorative Number -->
                <div style="font-size: clamp(150px, 30vw, 320px); font-weight: 900; color: var(--nk-blue); opacity: 0.04; letter-spacing: -10px; line-height: 0.8; user-select: none;">
                    404
                </div>
                
                <!-- Main Header -->
                <div style="margin-top: -40px;">
                    <h1 style="font-size: clamp(36px, 6vw, 56px); font-family: var(--font-display); color: var(--nk-gray-900); margin-bottom: 24px; font-weight: 700;">
                        Страница не найдена
                    </h1>
                </div>
            </div>
            
            <!-- Description -->
            <p style="font-size: clamp(16px, 2vw, 20px); color: var(--nk-gray-600); max-width: 640px; margin: 0 auto 56px; line-height: 1.7; font-weight: 400;">
                К сожалению, запрашиваемый ресурс был перемещен или никогда не существовал в нашей системе координат.
            </p>
            
            <!-- Action Button -->
            <div style="display: flex; justify-content: center;">
                <a href="<?php echo home_url(); ?>" class="cta-crystal__btn" style="display: inline-flex; width: auto; padding: 0 48px; height: 64px; text-decoration: none; align-items: center; gap: 12px; transition: transform 0.3s ease;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="transform: rotate(0deg);"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                    <span>Вернуться на главную</span>
                </a>
            </div>
            
            <!-- Minimal Grid Decoration -->
            <div style="margin-top: 80px; opacity: 0.1;">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="currentColor" style="color: var(--nk-blue);">
                    <path d="M20 0V40M0 20H40" stroke-width="0.5"/>
                </svg>
            </div>
        </div>
    </section>
</main>

<style>
    .error-hero .cta-crystal__btn:hover {
        transform: translateX(-5px);
    }
</style>

<?php get_footer(); ?>
