'use client';
import {
motion 
}
from 'framer-motion';
import {
useTranslations 
}
from 'next-intl';
import {
Cpu, Globe, Layout, Zap, ArrowUpRight, ShoppingCart 
}
from 'lucide-react';
export const ServicesSection = () => {
const t = useTranslations('Services');
const services = [ {
key: 'web3', icon: Globe, color: 'from-accent/5' }, {
key: 'ai', icon: Cpu, color: 'from-accent/5' }, {
key: 'identity', icon: Layout, color: 'from-accent/5' }, {
key: 'perf', icon: Zap, color: 'from-accent/5' 
}
];
const containerVariants = {
hidden: {
opacity: 0 }, visible: {
opacity: 1, transition: {
staggerChildren: 0.2 
}
}
}
const cardVariants = {
hidden: {
opacity: 0, y: 30 }, visible: {
opacity: 1, y: 0, transition: {
duration: 1.5, ease: [0.16, 1, 0.3, 1] as const 
}
}
};
return ( <section id="services" className="py-[125px] bg-white/5 backdrop-blur-sm relative overflow-hidden scroll-mt-32">
<div className="container mx-auto px-6 relative z-10 max-w-7xl">
<div className="max-w-4xl mx-auto text-center mb-24 flex flex-col items-center"> {

}
<motion.div initial={{
opacity: 0, y: 20 }
}
whileInView={{
opacity: 1, y: 0 }
}
viewport={{
once: true }
}
transition={{
duration: 1.5 }
}
className="flex flex-col items-center gap-8" >
<span className="text-sm md:text-lg font-display font-medium tracking-[1.05em] text-white/90 uppercase block leading-none -mr-[1.05em]"> {t('subheading')
}
</span>
<span className="text-3xl md:text-6xl uppercase tracking-[0.4em] text-accent/70 font-light leading-none -mr-[0.4em]"> {t('heading_digital')
}
</span>
<div className="flex flex-col items-center">
<h2 className="text-5xl md:text-8xl font-display font-bold tracking-[0.1em] leading-none uppercase -mr-[0.1em]">
<span className="bg-gradient-to-r from-accent via-[#FFF5E6] via-accent-gold via-[#FFF5E6] to-accent bg-[length:200%_auto] bg-clip-text text-transparent animate-shimmer inline-block pb-4"> {t('heading_solutions')
}
</span>
</h2>
<div className="w-64 h-[0.5px] bg-gradient-to-r from-transparent via-accent/40 to-transparent mt-4" />
</div>
</motion.div>
</div>
<motion.div variants={containerVariants
}
initial="hidden" whileInView="visible" viewport={{
once: true, amount: 0.1 }
}
className="grid grid-cols-1 md:grid-cols-2 gap-[100px] max-w-7xl mx-auto" > {[ {
key: 'nodes', icon: Layout }, {
key: 'headquarters', icon: Globe }, {
key: 'revenue', icon: ShoppingCart }, {
key: 'ecosystems', icon: Cpu 
}
].map((s, i) => ( <motion.div key={i
}
variants={cardVariants
}
className="group relative bg-card-bg text-card-text p-12 hover:bg-surface/80 transition-all duration-1000 overflow-hidden shadow-xl rounded-lg border border-white/5" > {

}
<div className="absolute inset-0 w-full h-full bg-gradient-to-br from-transparent via-accent/[0.03] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1500 ease-in-out" /> {

}
<div className="absolute top-0 left-0 w-6 h-6 border-t-[0.5px] border-l-[0.5px] border-accent/10 group-hover:border-accent/80 transition-all duration-1000" />
<div className="absolute top-0 right-0 w-6 h-6 border-t-[0.5px] border-r-[0.5px] border-accent/10 group-hover:border-accent/80 transition-all duration-1000" />
<div className="absolute bottom-0 left-0 w-6 h-6 border-b-[0.5px] border-l-[0.5px] border-accent/10 group-hover:border-accent/80 transition-all duration-1000" />
<div className="absolute bottom-0 right-0 w-6 h-6 border-b-[0.5px] border-r-[0.5px] border-accent/10 group-hover:border-accent/80 transition-all duration-1000" />
<div className="relative z-10 flex justify-between items-start mb-24">
<div className="p-4 relative bg-btn-bg backdrop-blur-sm">
<s.icon size={22
}
strokeWidth={1
}
className="text-accent/60 group-hover:text-accent transition-colors duration-700" />
</div>
<div className="w-10 h-10 relative flex items-center justify-center text-white/20 group-hover:text-accent group-hover:bg-accent/[0.03] transition-all duration-1000">
<ArrowUpRight size={14
}
strokeWidth={1
}
/>
</div>
</div>
<div className="relative z-10 text-center flex flex-col items-center">
<div className="space-y-4 w-full">
<span className="text-[9px] md:text-[10px] font-display uppercase tracking-[0.6em] text-accent/80 block -mr-[0.6em] font-bold animate-pulse">{t('layer_label')
}
0{i + 1}</span>
<h3 className="text-xl md:text-2xl font-display font-light group-hover:text-accent transition-all duration-1000 tracking-[0.1em] uppercase leading-tight pb-2"> {t(`items.${s.key}.title`)
}
</h3>
</div>
<p className="font-sans text-base text-white/30 leading-relaxed font-light mt-8 max-w-sm "> {t(`items.${s.key}.desc`)
}
</p>
</div>
</motion.div> ))
}
</motion.div>
</div>
<div className="absolute bottom-12 left-1/2 -translate-x-1/2 opacity-60 pointer-events-none w-full text-center">
<span className="text-[10px] uppercase tracking-[1.25em] text-accent/80 font-bold -mr-[1.25em]">{t('bottom_label')}</span>
</div>
</section> );
};
