'use client';

import { useRef } from 'react';
import { motion } from 'framer-motion';
import { useTranslations } from 'next-intl';
import { useCalculatorStore } from '@/store/useCalculatorStore';
import { Send, MapPin, Mail } from 'lucide-react';
import { LuxuryButton } from '@/components/ui/LuxuryButton';

export const ContactForm = () => {
    const t = useTranslations('Contact');
    const ta = useTranslations('Addons');
    const tcalc = useTranslations('Calculator');

    const { projectType, totalPrice, addons, languages } = useCalculatorStore();
    const support = useCalculatorStore(state => state.support);
    const momentum = useCalculatorStore(state => state.momentum);

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        console.log("Transmission initialized:", { projectType, totalPrice, addons, languages });
    };

    const activeAddons = Object.entries(addons)
        .filter(([, v]) => v)
        .map(([k]) => ta(`${k}.label` as any));

    const itemVariants = {
        hidden: { opacity: 0, y: 30 },
        visible: {
            opacity: 1,
            y: 0,
            transition: { duration: 1.8, ease: [0.16, 1, 0.3, 1] as const }
        }
    };

    return (
        <section id="contact" className="py-[125px] bg-background relative overflow-hidden">
            <div className="absolute top-0 right-0 w-[800px] h-[800px] bg-accent/[0.02] blur-[150px] rounded-full pointer-events-none" />

            <div className="container mx-auto px-6 relative z-10 max-w-7xl">
                <div className="max-w-4xl mx-auto text-center mb-24 flex flex-col items-center">
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 1.5 }}
                        className="flex flex-col items-center gap-8"
                    >
                        <span className="text-sm md:text-lg font-display font-medium tracking-[0.8em] text-foreground/70 uppercase block leading-none -mr-[0.8em]">
                            {t('subheading')}
                        </span>

                        <span className="text-3xl md:text-5xl uppercase tracking-[0.4em] text-accent/70 font-light leading-none -mr-[0.4em]">
                            {t('title_part1')}
                        </span>

                        <div className="flex flex-col items-center">
                            <h2 className="text-5xl md:text-7xl font-display font-bold tracking-[0.1em] leading-none uppercase -mr-[0.1em]">
                                <span className="bg-gradient-to-r from-accent via-[#FFF5E6] via-accent-gold via-[#FFF5E6] to-accent bg-[length:200%_auto] bg-clip-text text-transparent animate-shimmer inline-block pb-4">
                                    {t('title_part2')}
                                </span>
                            </h2>
                            <div className="w-48 h-[0.5px] bg-gradient-to-r from-transparent via-accent/40 to-transparent mt-4" />
                        </div>
                        <p className="text-foreground/30 text-lg font-sans font-light max-w-2xl italic leading-relaxed mt-8 text-center">
                            {t('desc')}
                        </p>
                    </motion.div>
                </div>

                <div className="mx-auto max-w-4xl">
                    <motion.div
                        variants={itemVariants}
                        initial="hidden"
                        whileInView="visible"
                        viewport={{ once: true }}
                        className="w-full"
                    >
                        <div className="bg-white/[0.01] p-12 md:p-24 relative group/form overflow-hidden transition-all duration-1000">
                            <form onSubmit={handleSubmit} className="space-y-16">

                                {/* Transmission_Protocol Panel */}
                                <div className="p-10 bg-white/[0.01] mb-20 relative overflow-hidden group/plate transition-all duration-1000">
                                    <div className="absolute top-0 left-0 w-4 h-4 border-t-[0.5px] border-l-[0.5px] border-accent/0 group-hover/plate:border-accent/40 transition-colors" />
                                    <div className="absolute top-0 right-0 w-4 h-4 border-t-[0.5px] border-r-[0.5px] border-accent/0 group-hover/plate:border-accent/40 transition-colors" />
                                    <div className="absolute bottom-0 left-0 w-4 h-4 border-b-[0.5px] border-l-[0.5px] border-accent/0 group-hover/plate:border-accent/40 transition-colors" />
                                    <div className="absolute bottom-0 right-0 w-4 h-4 border-b-[0.5px] border-r-[0.5px] border-accent/0 group-hover/plate:border-accent/40 transition-colors" />

                                    <h4 className="text-accent/40 font-display italic text-[13px] uppercase tracking-[0.5em] mb-10">{t('transmission')}:</h4>

                                    {/* Core Config Row */}
                                    <div className="grid grid-cols-2 lg:grid-cols-4 gap-8 pb-8 border-b border-accent/5">
                                        {[
                                            { label: t('arch_form'), value: tcalc(`types.${projectType.toLowerCase()}` as any) },
                                            { label: t('lang_units'), value: t('locales', { count: languages }) },
                                            { label: t('support_proto'), value: tcalc(`support_levels.${support}`) },
                                            { label: t('momentum'), value: tcalc(`momentum.${momentum.toLowerCase() === 'fast' ? 'fast' : momentum.toLowerCase()}` as any) },
                                        ].map((item, id) => (
                                            <div key={id} className="space-y-2 border-l-[0.5px] border-accent/5 pl-4">
                                                <span className="text-[9px] font-display uppercase tracking-[0.2em] opacity-30 block">{item.label}</span>
                                                <span className="text-[11px] font-display uppercase tracking-[0.3em] text-foreground/60">{item.value}</span>
                                            </div>
                                        ))}
                                    </div>

                                    {/* Active Addons */}
                                    {activeAddons.length > 0 && (
                                        <div className="pt-8 space-y-4">
                                            <span className="text-[9px] font-display uppercase tracking-[0.2em] opacity-30 block">{t('expansion')}</span>
                                            <div className="flex flex-wrap gap-3">
                                                {activeAddons.map((label) => (
                                                    <span key={label} className="text-[9px] uppercase tracking-[0.2em] text-accent/70 border-[0.5px] border-accent/20 px-3 py-1.5 font-bold">
                                                        {label}
                                                    </span>
                                                ))}
                                            </div>
                                        </div>
                                    )}

                                    {/* Valuation */}
                                    <div className="pt-8 flex items-end justify-between gap-4 flex-wrap border-t border-accent/5 mt-8">
                                        <div className="space-y-1">
                                            <span className="text-[9px] font-display uppercase tracking-[0.2em] opacity-30 block">{t('standard_val')}</span>
                                            <span className="text-[13px] font-display uppercase tracking-[0.3em] text-accent/50">{totalPrice.toLocaleString()} TJS</span>
                                        </div>
                                        <div className="space-y-1 text-right">
                                            <span className="text-[9px] font-display uppercase tracking-[0.2em] text-accent/50 block animate-pulse">{t('partner_rate')}</span>
                                            <span className="text-[15px] font-display uppercase tracking-[0.3em] text-accent">{Math.round(totalPrice * 0.7).toLocaleString()} TJS</span>
                                        </div>
                                    </div>
                                </div>

                                <div className="grid grid-cols-1 md:grid-cols-2 gap-20">
                                    <div className="space-y-6 relative group/input p-8 bg-white/[0.01] transition-all duration-1000 hover:bg-white/[0.02]">
                                        <span className="text-[11px] font-display uppercase tracking-[0.5em] text-accent/60 italic block uppercase leading-none font-bold">{t('name_label')}</span>
                                        <input
                                            type="text" required placeholder={t('name_placeholder')}
                                            className="w-full bg-transparent py-2 outline-none transition-all duration-1000 font-display text-[10px] tracking-[0.2em] font-light placeholder:text-foreground/20 uppercase"
                                        />
                                    </div>
                                    <div className="space-y-6 relative group/input p-8 bg-white/[0.01] transition-all duration-1000 hover:bg-white/[0.02]">
                                        <span className="text-[11px] font-display uppercase tracking-[0.5em] text-accent/60 italic block uppercase leading-none font-bold">{t('channel_label')}</span>
                                        <input
                                            type="email" required placeholder={t('channel_placeholder')}
                                            className="w-full bg-transparent py-2 outline-none transition-all duration-1000 font-display text-[10px] tracking-[0.2em] font-light placeholder:text-foreground/20 uppercase"
                                        />
                                    </div>
                                </div>

                                <div className="space-y-6 relative group/input p-8 bg-white/[0.01] transition-all duration-1000 hover:bg-white/[0.02]">
                                    <span className="text-[11px] font-display uppercase tracking-[0.5em] text-accent/60 italic block uppercase leading-none font-bold">{t('brief_label')}</span>
                                    <textarea
                                        rows={5} required placeholder={t('brief_placeholder')}
                                        className="w-full bg-transparent py-2 outline-none transition-all duration-1000 font-display text-[10px] tracking-[0.2em] font-light placeholder:text-foreground/20 resize-none uppercase"
                                    />
                                </div>

                                <div className="pt-8">
                                    <LuxuryButton
                                        type="submit"
                                        height="h-[72px]"
                                    >
                                        <span className="flex items-center gap-6">
                                            {t('submit')}
                                            <Send size={14} strokeWidth={1} className="group-hover:translate-x-4 transition-transform duration-1000" />
                                        </span>
                                    </LuxuryButton>
                                </div>
                            </form>
                        </div>
                    </motion.div>
                </div>
            </div>

            <div className="absolute bottom-12 left-1/2 -translate-x-1/2 opacity-60 pointer-events-none w-full text-center">
                <span className="text-[10px] uppercase tracking-[1.25em] text-accent/80 font-bold -mr-[1.25em]">{t('footer_tag')}</span>
            </div>

            <div className="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[0.5px] bg-gradient-to-r from-transparent via-accent/20 to-transparent" />
        </section>
    );
};