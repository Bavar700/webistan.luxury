'use client';

import { useEffect, useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { useTranslations } from 'next-intl';
import { WebistanSymbol } from '@/components/ui/WebistanSymbol';

export const SplashScreen = () => {
    const t = useTranslations('Common');
    const [visible, setVisible] = useState(true);

    useEffect(() => {
        const timer = setTimeout(() => setVisible(false), 2400);
        return () => clearTimeout(timer);
    }, []);

    return (
        <AnimatePresence>
            {visible && (
                <motion.div
                    key="splash"
                    initial={{ opacity: 1 }}
                    exit={{ opacity: 0 }}
                    transition={{ duration: 0.9, ease: [0.16, 1, 0.3, 1] }}
                    className="fixed inset-0 z-[200] flex flex-col items-center justify-center bg-[#000000]"
                >
                    {/* Ambient glow behind symbol */}
                    <motion.div
                        initial={{ opacity: 0, scale: 0.6 }}
                        animate={{ opacity: 1, scale: 1 }}
                        transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }}
                        className="absolute w-[280px] h-[280px] rounded-full"
                        style={{
                            background: 'radial-gradient(circle, rgba(184,134,11,0.12) 0%, transparent 70%)',
                        }}
                    />

                    {/* Symbol */}
                    <motion.div
                        initial={{ opacity: 0, scale: 0.7 }}
                        animate={{ opacity: 1, scale: 1 }}
                        transition={{ duration: 1.4, ease: [0.16, 1, 0.3, 1], delay: 0.1 }}
                        className="relative z-10"
                    >
                        <WebistanSymbol className="w-[80px] h-[40px]" />
                    </motion.div>

                    {/* Logo text */}
                    <motion.div
                        initial={{ opacity: 0, y: 12 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1], delay: 0.4 }}
                        className="relative z-10 mt-6 flex items-center tracking-[0.25em] uppercase font-display font-bold text-[13px]"
                    >
                        <span className="text-[#F1F1F3]">WEBISTAN</span>
                        <span className="hero-shimmer">.LUXURY</span>
                    </motion.div>

                    {/* Thin separator line */}
                    <motion.div
                        initial={{ scaleX: 0, opacity: 0 }}
                        animate={{ scaleX: 1, opacity: 1 }}
                        transition={{ duration: 1.0, ease: [0.16, 1, 0.3, 1], delay: 0.7 }}
                        className="relative z-10 mt-5 w-[120px] h-[0.5px] bg-gradient-to-r from-transparent via-accent/60 to-transparent origin-center"
                    />

                    {/* Tagline */}
                    <motion.p
                        initial={{ opacity: 0, y: 8 }}
                        animate={{ opacity: 0.45, y: 0 }}
                        transition={{ duration: 1.0, ease: [0.16, 1, 0.3, 1], delay: 0.9 }}
                        className="relative z-10 mt-4 text-[9px] uppercase tracking-[0.45em] text-[#F1F1F3] font-light -mr-[0.45em]"
                    >
                        {t('splash_tagline')}
                    </motion.p>
                </motion.div>
            )}
        </AnimatePresence>
    );
};
