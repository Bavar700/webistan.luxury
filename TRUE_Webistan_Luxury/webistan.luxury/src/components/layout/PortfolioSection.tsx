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
<span className="text-[11px] md:text-[13px] font-display font-medium tracking-[1em] text-white/30 uppercase block mb-6 -mr-[1em]"> {t('subheading')
}
</span>
<div className="flex flex-col items-center">
<h2 className="text-4xl md:text-7xl font-display font-light tracking-[0.25em] leading-none uppercase -mr-[0.25em] text-white/90"> {t('legacies')
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
className="group relative bg-card-bg text-card-text p-16 hover:bg-surface/80 transition-all duration-1000 overflow-hidden shadow-xl rounded-lg border border-white/5" > {

}
<div className="absolute inset-0 w-full h-full bg-gradient-to-br from-transparent via-accent/[0.03] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1500 ease-in-out" /> {

}
<div className="absolute top-0 left-0 w-6 h-6 border-t-[0.5px] border-l-[0.5px] border-accent/20 group-hover:border-accent/80 group-hover:w-8 group-hover:h-8 transition-all duration-1000" />
<div className="absolute top-0 right-0 w-6 h-6 border-t-[0.5px] border-r-[0.5px] border-accent/20 group-hover:border-accent/80 group-hover:w-8 group-hover:h-8 transition-all duration-1000" />
<div className="absolute bottom-0 left-0 w-6 h-6 border-b-[0.5px] border-l-[0.5px] border-accent/20 group-hover:border-accent/80 group-hover:w-8 group-hover:h-8 transition-all duration-1000" />
<div className="absolute bottom-0 right-0 w-6 h-6 border-b-[0.5px] border-r-[0.5px] border-accent/20 group-hover:border-accent/80 group-hover:w-8 group-hover:h-8 transition-all duration-1000" />
<div className="relative z-10 text-center flex flex-col items-center">
<div className="space-y-4 w-full">
<span className="text-[9px] md:text-[10px] font-display uppercase tracking-[0.6em] text-white/40 block -mr-[0.6em] font-medium">Portfolio_Ref 0{i + 1}</span>
<h3 className="text-xl md:text-3xl font-display font-light group-hover:text-accent transition-all duration-1000 tracking-[0.2em] uppercase leading-none"> {s.title.toLowerCase().includes('yaghnob.com') ? ( <a href="https://yaghnob.com" target="_blank" rel="noopener noreferrer" className="hover:underline decoration-accent/30 underline-offset-8" > {s.title
}
</a> ) : ( s.title )
}
</h3>
</div>
<p className="font-sans text-base text-white/30 leading-relaxed font-light mt-8 max-w-sm "> {s.desc
}
</p>
</div>
</motion.div> ))
}
</div>
</div>
</section> );
};
