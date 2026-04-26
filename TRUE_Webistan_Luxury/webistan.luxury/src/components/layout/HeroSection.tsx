'use client';
import {
motion, useScroll, useTransform 
}
from 'framer-motion';
import {
useTranslations 
}
from 'next-intl';
import {
ArrowRight 
}
from 'lucide-react';
import {
useRef 
}
from 'react';
import {
LuxuryButton 
}
from '@/components/ui/LuxuryButton';
export const HeroSection = () => {
const t = useTranslations('Index.hero');
const containerRef = useRef(null);
const {
scrollY 
}
= useScroll();
const y1 = useTransform(scrollY, [0, 800], [0, 250]);
const opacityHero = useTransform(scrollY, [0, 600], [1, 0]);
const containerVariants = {
hidden: {
opacity: 0 }, visible: {
opacity: 1, transition: {
staggerChildren: 0.2, delayChildren: 0.5 
}
}
}
const itemVariants = {
hidden: {
opacity: 0, y: 40, filter: 'blur(15px)' }, visible: {
opacity: 1, y: 0, filter: 'blur(0px)', transition: {
duration: 1.8, ease: [0.16, 1, 0.3, 1] as const 
}
}
};
return ( <section id="home" ref={containerRef
}
className="relative min-h-screen flex items-center justify-center py-[125px] overflow-hidden bg-background">
<motion.div style={{
y: y1, opacity: opacityHero }
}
className="absolute inset-0 pointer-events-none" >
<div className="absolute top-[10%] left-1/2 -translate-x-1/2 w-[70%] h-[50%] bg-accent/3 blur-[160px] rounded-full" />
</motion.div>
<div className="container mx-auto px-6 relative z-10 max-w-7xl flex flex-col items-center">
<motion.div variants={containerVariants
}
initial="hidden" animate="visible" className="max-w-4xl w-full mx-auto text-center flex flex-col items-center" >
<motion.div variants={itemVariants
}
className="flex flex-col items-center text-center mb-16 select-none w-full" > {

}
<span className="text-sm md:text-lg font-display font-extralight tracking-[1.05em] text-foreground/80 uppercase block leading-none -mr-[1.05em] mb-[30px]"> {t('upper')
}
</span> {

}
<div className="flex items-center justify-center w-full mb-[30px]">
<span className="text-2xl md:text-6xl uppercase tracking-[0.2em] font-medium leading-none -mr-[0.2em] hero-shimmer"> {t('middle')
}
</span>
</div> {

}
<div className="flex flex-col items-center mt-[5px]">
<h1 className="relative text-4xl md:text-7xl font-display font-bold tracking-[0.05em] leading-none uppercase -mr-[0.05em]">
<span className="relative z-10 hero-shimmer"> {t('base')
}
</span>
</h1> {

}
<div className="w-full max-w-4xl h-[0.5px] bg-gradient-to-r from-transparent via-accent/50 to-transparent mt-[25px] mb-10" />
</div>
<motion.p variants={itemVariants
}
className="text-lg md:text-xl font-sans text-foreground/30 max-w-2xl mx-auto mb-6 leading-relaxed font-light text-center" > {t('description')
}
</motion.p>
<motion.div variants={itemVariants
}
className="flex flex-col sm:flex-row items-center justify-center gap-8 w-full mt-12" >
<LuxuryButton width="w-full sm:w-[450px]" onClick={() => document.getElementById('contact')?.scrollIntoView({
behavior: 'smooth' })}> {t('cta1')
}
</LuxuryButton>
<LuxuryButton width="w-full sm:w-[450px]" onClick={() => document.getElementById('portfolio')?.scrollIntoView({
behavior: 'smooth' })}> {t('cta2')
}
</LuxuryButton>
</motion.div>
</motion.div>
</motion.div>
</div>
<motion.div initial={{
opacity: 0 }
}
animate={{
opacity: 0.2 }
}
transition={{
delay: 2, duration: 2 }
}
className="absolute bottom-12 left-1/2 -translate-x-1/2 w-px h-24 bg-gradient-to-b from-accent to-transparent" />
</section> );
};
