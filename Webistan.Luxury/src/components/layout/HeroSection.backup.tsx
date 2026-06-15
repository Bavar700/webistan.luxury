'use client';

import { motion, useScroll, useTransform } from 'framer-motion';
import { useTranslations } from 'next-intl';
import { ArrowRight } from 'lucide-react';
import { useRef } from 'react';
import { LuxuryButton } from '@/components/ui/LuxuryButton';

export const HeroSection = () => {
    const t = useTranslations('Index.hero');
    const containerRef = useRef(null);
    const { scrollY } = useScroll();

    const y1 = useTransform(scrollY, [0, 800], [0, 250]);
    const opacityHero = useTransform(scrollY, [0, 600], [1, 0]);

    const containerVariants = {
        hidden: { opacity: 0 },
        visible: {
            opacity: 1,
            transition: { staggerChildren: 0.2, delayChildren: 0.5 }
        }
    };

    const itemVariants = {
        hidden: { opacity: 0, y: 40, filter: 'blur(15px)' },
        visible: {
            opacity: 1,
            y: 0,
            filter: 'blur(0px)',
            transition: { duration: 1.8, ease: [0.16, 1, 0.3, 1] as const }
        }
    };

    return (
        <section id="home" ref={containerRef} className="relative min-h-screen flex items-center justify-center py-[125px] overflow-hidden bg-background">
            <motion.div
                style={{ y: y1, opacity: opacityHero }}
                className="absolute inset-0 pointer-events-none"
            >
                <div className="absolute top-[10%] left-1/2 -translate-x-1/2 w-[70%] h-[50%] bg-accent/3 blur-[160px] rounded-full" />
            </motion.div>

            <div className="container mx-auto px-6 relative z-10 max-w-7xl flex flex-col items-center">
                <motion.div
                    variants={containerVariants}
                    initial="hidden"
                    animate="visible"
                    className="max-w-4xl w-full mx-auto flex flex-col items-center gap-12"
                >
                    {/* Promotion Block (Блок акции) */}
                    <motion.div
                        variants={itemVariants}
                        className="group relative w-full p-8 md:p-12 bg-white/[0.01] overflow-hidden flex flex-col items-center text-center transition-all duration-700 hover:bg-white/[0.02]"
                    >


                        {/* Top bar inside the promotion block */}
                        <div className="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-6 mb-6 border-b border-accent/10 pb-4 text-[10px] md:text-xs font-mono tracking-widest text-accent/60 uppercase w-full">
                            <span className="flex items-center gap-2">
                                <span className="relative flex h-2 w-2">
                                    <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span className="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </span>
                                {t('protocol_status')}
                            </span>
                            <span className="hidden sm:inline text-accent/20">|</span>
                            <span>{t('node_status')}</span>
                        </div>

                        {/* Protocol Header */}
                        <span className="text-xs md:text-sm font-display font-light tracking-[0.25em] text-accent uppercase block leading-none mb-4 text-center">
                            {t('protocol_title')}
                        </span>

                        {/* Protocol Details */}
                        <p className="text-lg md:text-2xl font-sans font-light tracking-wide leading-relaxed text-foreground/80 text-center max-w-3xl mx-auto">
                            {t.rich('protocol_body', {
                                highlight: (chunks) => (
                                    <span className="bg-gradient-to-r from-accent via-[#FFF5E6] via-accent-gold to-accent bg-clip-text text-transparent font-medium inline-block">
                                        {chunks}
                                    </span>
                                )
                            })}
                        </p>
                    </motion.div>

                    {/* CTA Buttons */}
                    <motion.div
                        variants={itemVariants}
                        className="flex flex-col sm:flex-row items-center justify-center gap-8 w-full mt-4"
                    >
                        <LuxuryButton width="w-full sm:w-[450px]" onClick={() => document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth' })}>
                            {t('cta1')}
                        </LuxuryButton>
                        <LuxuryButton width="w-full sm:w-[450px]" onClick={() => document.getElementById('portfolio')?.scrollIntoView({ behavior: 'smooth' })}>
                            {t('cta2')}
                        </LuxuryButton>
                    </motion.div>
                </motion.div>
            </div>

            <motion.div
                initial={{ opacity: 0 }}
                animate={{ opacity: 0.2 }}
                transition={{ delay: 2, duration: 2 }}
                className="absolute bottom-12 left-1/2 -translate-x-1/2 w-px h-24 bg-gradient-to-b from-accent to-transparent"
            />
        </section>
    );
};
