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
return ( <section ref={containerRef
}
className="relative min-h-screen flex items-center justify-center pt-32 pb-64 overflow-hidden bg-background">
<motion.div style={{
y: y1, opacity: opacityHero }
}
className="absolute inset-0 pointer-events-none" >
<div className="absolute top-[5%] left-[15%] w-[70%] h-[50%] bg-accent/3 blur-[160px] rounded-full" />
</motion.div>
<div className="container mx-auto px-6 relative z-10">
<motion.div variants={containerVariants
}
initial="hidden" animate="visible" className="max-w-4xl mx-auto text-center" >
<motion.div variants={itemVariants
}
className="inline-flex items-center gap-4 mb-14" >
<div className="w-12 h-px bg-accent/20" />
<span className="text-[13px] uppercase tracking-[0.6em] text-foreground/50 font-light "> {t('statement') || 'The Digital Artisan Strategy'
}
</span>
<div className="w-12 h-px bg-accent/20" />
</motion.div>
<motion.h1 variants={itemVariants
}
className="text-[clamp(2.5rem,7vw,5.5rem)] font-display font-light leading-[1.1] mb-14 tracking-tight" > Architecting <span className="text-accent ">Bespoke_</span>
<br />
<span className="opacity-80">Refined Simplicity.</span>
</motion.h1>
<motion.p variants={itemVariants
}
className="text-lg md:text-xl font-sans text-foreground/40 max-w-2xl mx-auto mb-20 leading-relaxed font-light " > {t('subtitle') || 'We engineer high-stakes digital environments;
for those who value exclusivity over excess.'
}
</motion.p>
<motion.div variants={itemVariants
}
className="flex flex-col sm:flex-row items-center justify-center gap-12" >
<button className="group px-14 py-5 bg-foreground text-background rounded-full font-sans font-light text-[11px] uppercase tracking-[0.4em] transition-all duration-1000 hover:bg-accent hover:shadow-[0_20px_40px_rgba(192,160,128,0.15)]"> Initiate Inquiry </button>
<button className="group flex items-center gap-3 text-[11px] font-light uppercase tracking-[0.4em] text-foreground/40 hover:text-accent transition-all duration-700"> The Archive <ArrowRight size={12
}
strokeWidth={1
}
className="group-hover:translate-x-2 transition-transform duration-700" />
</button>
</motion.div>
</motion.div>
</div> {

}
<motion.div initial={{
opacity: 0 }
}
animate={{
opacity: 0.3 }
}
transition={{
delay: 3, duration: 2 }
}
className="absolute bottom-16 left-1/2 -translate-x-1/2" >
<div className="w-[1px] h-24 bg-gradient-to-b from-accent/40 to-transparent" />
</motion.div>
</section> );
};
