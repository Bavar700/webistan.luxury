'use client';
import {
motion 
}
from 'framer-motion';
import {
useTranslations 
}
from 'next-intl';
export const PortfolioSection = () => {
const t = useTranslations('Portfolio');
return ( <section id="portfolio" className="relative overflow-hidden">
<div className="container mx-auto px-6 max-w-7xl relative z-10">
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
className="flex flex-col items-center" >
<span className="text-[11px] md:text-[13px] font-display font-medium tracking-[1em] text-foreground/30 uppercase block mb-6 -mr-[1em]"> {t('subheading')
}
</span>
<div className="flex flex-col items-center">
<h2 className="text-4xl md:text-7xl font-display font-light tracking-[0.25em] leading-none uppercase -mr-[0.25em] text-foreground/90"> {t('legacies')
}
</h2>
<div className="w-24 h-[0.5px] bg-accent/30 mt-10" />
</div>
</motion.div>
</div>
<div className="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto"> {[ {
title: t('slot1.title'), desc: t('slot1.desc') }, {
title: t('slot2.title'), desc: t('slot2.desc') 
}
].map((s, i) => ( <motion.div key={i
}
initial={{
opacity: 0, y: 30 }
}
whileInView={{
opacity: 1, y: 0 }
}
viewport={{
once: true }
}
transition={{
duration: 1.5, delay: i * 0.2 }
}
className="group relative bg-btn-bg [backdrop-filter:blur(var(--btn-blur))] [box-shadow:var(--btn-shadow)] text-card-text p-16 hover:bg-btn-hover-bg transition-all duration-1000 overflow-hidden rounded-none border border-white/5" >
    <div className="absolute inset-0 transition-opacity duration-700 opacity-0 group-hover:opacity-100">
      <div className="absolute top-0 left-0 w-1.5 h-1.5 border-t-[0.5px] border-l-[0.5px] border-accent" />
      <div className="absolute top-0 right-0 w-1.5 h-1.5 border-t-[0.5px] border-r-[0.5px] border-accent" />
      <div className="absolute bottom-0 left-0 w-1.5 h-1.5 border-b-[0.5px] border-l-[0.5px] border-accent" />
      <div className="absolute bottom-0 right-0 w-1.5 h-1.5 border-b-[0.5px] border-r-[0.5px] border-accent" />
      <div className="absolute inset-0 border border-accent/10" />
    </div>
<div className="relative z-10 text-center flex flex-col items-center">
<div className="space-y-4 w-full">
<span className="text-[11px] md:text-[10px] font-display uppercase tracking-[0.6em] text-foreground/40 block -mr-[0.6em] font-medium">Portfolio_Ref 0{i + 1}</span>
<h3 className="text-xl md:text-3xl font-display font-light group-hover:text-accent transition-all duration-1000 tracking-[0.2em] uppercase leading-none"> {s.title.toLowerCase().includes('yaghnob.com') ? ( <a href="https://yaghnob.com" target="_blank" rel="noopener noreferrer" className="hover:underline decoration-accent/30 underline-offset-8" > {s.title
}
</a> ) : ( s.title )
}
</h3>
</div>
<p className="font-sans text-base text-foreground/30 leading-relaxed font-light mt-8 max-w-sm "> {s.desc
}
</p>
</div>
</motion.div> ))
}
</div>
</div>
</section> );
};
