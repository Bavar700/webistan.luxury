'use client';
import {
useRef 
}
from 'react';
import {
motion 
}
from 'framer-motion';
import {
useTranslations 
}
from 'next-intl';
import {
useCalculatorStore 
}
from '@/store/useCalculatorStore';
import {
Send, MapPin, Mail 
}
from 'lucide-react';
import {
LuxuryButton 
}
from '@/components/ui/LuxuryButton';
export const ContactForm = () => {
const t = useTranslations('Contact');
const ta = useTranslations('Addons');
const tcalc = useTranslations('Calculator');
const {
projectType, totalPrice, addons, languages 
}
= useCalculatorStore();
const support = useCalculatorStore(state => state.support);
const momentum = useCalculatorStore(state => state.momentum);
const handleSubmit = (e: React.FormEvent) => {
e.preventDefault();
console.log("Transmission initialized:", {
projectType, totalPrice, addons, languages });
}
const activeAddons = Object.entries(addons) .filter(([, v]) => v) .map(([k]) => ta(`${k}.label` as any));
const itemVariants = {
hidden: {
opacity: 0, y: 30 }, visible: {
opacity: 1, y: 0, transition: {
duration: 1.8, ease: [0.16, 1, 0.3, 1] as const 
}
}
};
return ( <section id="contact" className="relative overflow-hidden bg-background">
<div className="absolute top-0 right-0 w-[800px] h-[800px] bg-accent/[0.02] blur-[150px] rounded-full pointer-events-none" />
<div className="container mx-auto px-6 relative z-10 max-w-7xl">
<div className="w-full space-y-12 mb-36">
<div className="p-4 sm:p-8 md:p-16 lg:p-20 relative group/form overflow-hidden transition-all duration-700 rounded-xl border border-accent/10 bg-background">
<div className="space-y-16">
<motion.div initial={{
opacity: 0, y: 30, filter: 'blur(8px)' }
}
whileInView={{
opacity: 1, y: 0, filter: 'blur(0px)' }
}
viewport={{
once: true, margin: "-50px" }
}
transition={{
duration: 1.2, ease: [0.16, 1, 0.3, 1] }
}
className="flex items-center gap-6" >
<div className="w-12 h-12 flex-shrink-0 rounded-full border border-accent/20 flex items-center justify-center text-accent/60 font-display text-sm relative overflow-hidden group">
<div className="absolute inset-0 bg-accent/5 animate-pulse" /> 06 </div>
<div>
<h3 className="text-xl md:text-2xl font-display font-medium tracking-[0.2em] uppercase leading-tight group-hover:text-accent transition-colors duration-700" style={{ color: 'var(--calc-title-color)' }}>{t('initiation_title')}</h3>
<p className="text-[11px] md:text-[13px] mt-1 tracking-wider uppercase font-medium opacity-60" style={{ color: 'var(--calc-title-color)' }}>{t('initiation_desc')}</p>
</div>
</motion.div>
<motion.div variants={itemVariants
}
initial="hidden" whileInView="visible" viewport={{
once: true }
}
className="w-full" >
<form onSubmit={handleSubmit
}
className="space-y-16"> {

}
<div className="group relative p-6 sm:p-8 md:p-10 border border-accent/10 transition-all duration-700 hover:scale-[1.01] overflow-hidden bg-background" style={{ color: 'var(--calc-title-color)' }}>
<div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.08] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out" />
<div className="absolute top-0 left-0 w-3 h-3 border-t-[0.5px] border-l-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<div className="absolute top-0 right-0 w-3 h-3 border-t-[0.5px] border-r-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<div className="absolute bottom-0 left-0 w-3 h-3 border-b-[0.5px] border-l-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<div className="absolute bottom-0 right-0 w-3 h-3 border-b-[0.5px] border-r-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<h4 className="text-accent/60 font-display text-[13px] uppercase tracking-[0.5em] mb-10">{t('transmission')}:</h4> {

}
<div className="grid grid-cols-2 lg:grid-cols-4 gap-8 pb-8 border-b border-accent/10"> {[ {
label: t('arch_form'), value: tcalc(`types.${projectType.toLowerCase()}` as any) }, {
label: t('lang_units'), value: t('locales', {
count: languages }) }, {
label: t('support_proto'), value: tcalc(`support_levels.${support}`) }, {
label: t('momentum'), value: tcalc(`momentum.${momentum.toLowerCase() === 'fast' ? 'fast' : momentum.toLowerCase()}` as any) }, ].map((item, id) => ( <div key={id
}
className="space-y-2 border-l-[0.5px] border-accent/10 pl-4">
<span className="text-[9px] font-display uppercase tracking-[0.2em] opacity-30 block">{item.label}</span>
<span className="text-[11px] font-display uppercase tracking-[0.3em] opacity-80" style={{ color: 'var(--calc-title-color)' }}>{item.value}</span>
</div> ))
}
</div> {

}
{activeAddons.length > 0 && ( <div className="pt-8 space-y-4">
<span className="text-[9px] font-display uppercase tracking-[0.2em] opacity-30 block">{t('expansion')}</span>
<div className="flex flex-wrap gap-3"> {activeAddons.map((label) => ( <span key={label
}
className="text-[9px] uppercase tracking-[0.2em] text-accent/70 border-[0.5px] border-accent/20 px-3 py-1.5 font-bold"> {label
}
</span> ))
}
</div>
</div> )
}
<div className="pt-8 flex items-end justify-between gap-4 flex-wrap border-t border-accent/10 mt-8">
<div className="space-y-1">
<span className="text-[9px] font-display uppercase tracking-[0.2em] opacity-30 block">{t('standard_val')}</span>
<span className="text-[13px] font-display uppercase tracking-[0.3em] text-accent/50">{totalPrice.toLocaleString()
}
TJS</span>
</div>
<div className="space-y-1 text-right">
<span className="text-[9px] font-display uppercase tracking-[0.2em] text-accent/50 block animate-pulse">{t('partner_rate')}</span>
<span className="text-[15px] font-display uppercase tracking-[0.3em] text-accent">{Math.round(totalPrice * 0.7).toLocaleString()
}
TJS</span>
</div>
</div>
</div>
<div className="grid grid-cols-1 md:grid-cols-2 gap-8">
<div className="group relative space-y-6 p-6 md:p-8 border border-accent/10 transition-all duration-700 hover:scale-[1.02] overflow-hidden bg-background" style={{ color: 'var(--calc-title-color)' }}>
<div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.05] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out" />
<div className="absolute top-0 left-0 w-3 h-3 border-t-[0.5px] border-l-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<div className="absolute top-0 right-0 w-3 h-3 border-t-[0.5px] border-r-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<div className="absolute bottom-0 left-0 w-3 h-3 border-b-[0.5px] border-l-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<div className="absolute bottom-0 right-0 w-3 h-3 border-b-[0.5px] border-r-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<span className="text-[11px] font-display uppercase tracking-[0.5em] text-accent/60 block uppercase leading-none font-bold relative z-10">{t('name_label')}</span>
<input
type="text" required placeholder={t('name_placeholder')
}
className="w-full bg-transparent py-2 outline-none transition-all duration-1000 font-display text-[10px] tracking-[0.2em] font-light placeholder:text-accent/20 uppercase relative z-10" style={{ color: 'var(--calc-title-color)' }} />
</div>
<div className="group relative space-y-6 p-6 md:p-8 border border-accent/10 transition-all duration-700 hover:scale-[1.02] overflow-hidden bg-background" style={{ color: 'var(--calc-title-color)' }}>
<div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.05] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out" />
<div className="absolute top-0 left-0 w-3 h-3 border-t-[0.5px] border-l-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<div className="absolute top-0 right-0 w-3 h-3 border-t-[0.5px] border-r-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<div className="absolute bottom-0 left-0 w-3 h-3 border-b-[0.5px] border-l-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<div className="absolute bottom-0 right-0 w-3 h-3 border-b-[0.5px] border-r-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<span className="text-[11px] font-display uppercase tracking-[0.5em] text-accent/60 block uppercase leading-none font-bold relative z-10">{t('channel_label')}</span>
<input
type="email" required placeholder={t('channel_placeholder')
}
className="w-full bg-transparent py-2 outline-none transition-all duration-1000 font-display text-[10px] tracking-[0.2em] font-light placeholder:text-accent/20 uppercase relative z-10" style={{ color: 'var(--calc-title-color)' }} />
</div>
</div>
<div className="group relative space-y-6 p-6 md:p-8 border border-accent/10 transition-all duration-700 hover:scale-[1.02] overflow-hidden bg-background" style={{ color: 'var(--calc-title-color)' }}>
<div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.05] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out" />
<div className="absolute top-0 left-0 w-3 h-3 border-t-[0.5px] border-l-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<div className="absolute top-0 right-0 w-3 h-3 border-t-[0.5px] border-r-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<div className="absolute bottom-0 left-0 w-3 h-3 border-b-[0.5px] border-l-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<div className="absolute bottom-0 right-0 w-3 h-3 border-b-[0.5px] border-r-[0.5px] border-accent opacity-0 group-hover:opacity-100 transition-all duration-700" />
<span className="text-[11px] font-display uppercase tracking-[0.5em] text-accent/60 block uppercase leading-none font-bold relative z-10">{t('brief_label')}</span>
<textarea rows={5
}
required placeholder={t('brief_placeholder')
}
className="w-full bg-transparent py-2 outline-none transition-all duration-1000 font-display text-[10px] tracking-[0.2em] font-light placeholder:text-accent/20 resize-none uppercase relative z-10" style={{ color: 'var(--calc-title-color)' }} />
</div>
<div className="pt-8">
<LuxuryButton
type="submit" height="h-[72px]" >
<span className="flex items-center gap-6"> {t('submit')
}
<Send size={14
}
strokeWidth={1
}
className="group-hover:translate-x-4 transition-transform duration-1000" />
</span>
</LuxuryButton>
</div>
</form>
</motion.div>
</div>
</div>
</div>
</div>
<div className="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[0.5px] bg-gradient-to-r from-transparent via-accent/20 to-transparent" />
</section> );
};