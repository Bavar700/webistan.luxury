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
      transition: {
        staggerChildren: 0.2,
        delayChildren: 0.5
      }
    }
  };

  const itemVariants = {
    hidden: { opacity: 0, y: 40, filter: 'blur(15px)' },
    visible: {
      opacity: 1,
      y: 0,
      filter: 'blur(0px)',
      transition: {
        duration: 1.8,
        ease: [0.16, 1, 0.3, 1] as const
      }
    }
  };

  return (
    <div 
      id="home" 
      ref={containerRef}
      className="relative flex items-center justify-center overflow-hidden bg-background !pt-[120px] md:!pt-[180px] !pb-[100px] md:!pb-[160px]"
    >
      {/* Decorative Background Blur Removed for Perfect White */}
      <motion.div 
        style={{ y: y1, opacity: opacityHero }}
        className="absolute inset-0 pointer-events-none"
      >
        {/* No gradient or blur here to maintain pure white */}
      </motion.div>

      <div className="container mx-auto px-6 relative z-10 max-w-7xl flex flex-col items-center">
        <motion.div 
          variants={containerVariants}
          initial="hidden"
          animate="visible"
          className="max-w-4xl w-full mx-auto text-center flex flex-col items-center"
        >
          {/* Main Title Group with Equal Spacing */}
          <motion.div variants={itemVariants} className="flex flex-col items-center text-center w-full">
            
            {/* 1. UPPER TEXT */}
            <span className="text-xs md:text-lg font-display font-extralight tracking-[1.05em] text-foreground/80 uppercase block leading-none -mr-[1.05em] mb-[30px]">
              {t('upper')}
            </span>

            {/* 2. MIDDLE TEXT */}
            <div className="flex items-center justify-center w-full mb-[30px]">
              <span className="text-5xl md:text-6xl uppercase tracking-[0.2em] font-medium leading-none -mr-[0.2em] hero-shimmer">
                {t('middle')}
              </span>
            </div>

            {/* 3. BASE TITLE */}
            <h1 className="relative text-6xl sm:text-7xl md:text-8xl font-display font-bold tracking-[0.05em] leading-none uppercase -mr-[0.05em] mb-[30px]">
              <span className="relative z-10 hero-shimmer">
                {t('base')}
              </span>
            </h1>

            {/* 4. SEPARATOR LINE (RESTORED) */}
            <div className="w-full max-w-4xl h-[0.5px] bg-gradient-to-r from-transparent via-accent/50 to-transparent mb-[40px]" />

            {/* DESCRIPTION */}
            <motion.p 
              variants={itemVariants}
              className="text-[13px] md:text-[17px] font-sans text-foreground/60 max-w-2xl mx-auto mb-20 leading-relaxed font-light text-center px-4"
            >
              {t('description')}
            </motion.p>

            {/* BUTTONS */}
            <motion.div 
              variants={itemVariants}
              className="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8 w-full"
            >
              <LuxuryButton 
                width="w-full sm:w-[450px]" 
                onClick={() => document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth' })}
              >
                {t('cta1')}
              </LuxuryButton>
              <LuxuryButton 
                width="w-full sm:w-[450px]" 
                onClick={() => document.getElementById('portfolio')?.scrollIntoView({ behavior: 'smooth' })}
              >
                {t('cta2')}
              </LuxuryButton>
            </motion.div>
          </motion.div>
        </motion.div>
      </div>

    </div>
  );
};
