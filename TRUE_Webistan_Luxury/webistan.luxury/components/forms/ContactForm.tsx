'use client';
import { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { useTranslations } from 'next-intl';
import { useCalculatorStore } from '@/store/useCalculatorStore';
import { Send, CheckCircle2, Loader2 } from 'lucide-react';
import { LuxuryButton } from '@/components/ui/LuxuryButton';

export const ContactForm = () => {
  const t = useTranslations('Contact');
  const ta = useTranslations('Addons');
  const tcalc = useTranslations('Calculator');
  const [status, setStatus] = useState<'idle' | 'sending' | 'success'>('idle');
  
  const { projectType, totalPrice, addons, languages } = useCalculatorStore();
  const support = useCalculatorStore(state => state.support);
  const momentum = useCalculatorStore(state => state.momentum);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setStatus('sending');
    
    // Simulate high-end transmission delay
    await new Promise(resolve => setTimeout(resolve, 2000));
    
    // Log for verification in local development
    console.log("Transmission initialized to webistan.tech@gmail.com", {
      projectType, totalPrice, addons, languages, support, momentum 
    });
    
    setStatus('success');
  };

  const activeAddons = Object.entries(addons)
    .filter(([, v]) => v)
    .map(([k]) => ta(`${k}.label` as any));

  const itemVariants = {
    hidden: { opacity: 0, y: 30 },
    visible: { opacity: 1, y: 0, transition: { duration: 1.8, ease: [0.16, 1, 0.3, 1] as const } }
  };

  return (
    <div id="contact" className="relative overflow-hidden">
      <div className="absolute top-0 right-0 w-[800px] h-[800px] bg-accent/[0.02] blur-[150px] rounded-full pointer-events-none" />
      <div className="container mx-auto px-6 max-w-7xl relative z-10">
        <div className="w-full relative group/calc rounded-xl overflow-hidden bg-transparent min-h-[600px] flex flex-col justify-center">
          <AnimatePresence mode="wait">
            {status === 'success' ? (
              <motion.div 
                key="success"
                initial={{ opacity: 0, scale: 0.95 }}
                animate={{ opacity: 1, scale: 1 }}
                className="p-10 md:p-20 text-center space-y-8"
              >
                <div className="flex justify-center">
                  <div className="w-20 h-20 rounded-full border border-accent/30 flex items-center justify-center bg-accent/5">
                    <CheckCircle2 className="text-accent w-10 h-10" strokeWidth={1} />
                  </div>
                </div>
                <div className="space-y-4">
                  <h3 className="text-3xl md:text-5xl font-display uppercase tracking-[0.2em] text-accent">
                    {t('transmission_complete')}
                  </h3>
                  <p className="text-foreground/60 uppercase tracking-widest text-[11px] max-w-md mx-auto leading-relaxed">
                    {t.rich('success_message', {
                      br: () => <br />
                    })}
                  </p>
                </div>
                <button 
                  onClick={() => setStatus('idle')}
                  className="text-[10px] uppercase tracking-[0.4em] text-accent/50 hover:text-accent transition-colors border-b border-accent/10 hover:border-accent pb-1"
                >
                  {t('back_to_form')}
                </button>
              </motion.div>
            ) : (
              <motion.div 
                key="form"
                initial={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                className="p-4 sm:p-8 md:p-16 lg:p-20 space-y-12 md:space-y-20"
              >
                <div className="space-y-12">
                  <motion.div initial={{ opacity: 0, y: 30, filter: 'blur(8px)' }} whileInView={{ opacity: 1, y: 0, filter: 'blur(0px)' }} viewport={{ once: true, margin: "-50px" }} transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }} className="flex items-center gap-6" >
                    <div className="w-14 h-14 flex-shrink-0 rounded-full border-2 flex items-center justify-center font-display text-base relative overflow-hidden group" style={{ borderColor: 'var(--calc-step-border-color)', color: 'var(--calc-step-num-color)' }}>
                      <div className="absolute inset-0 bg-accent/10 animate-pulse" /> 06 </div>
                    <div>
                      <h3 className="text-sm md:text-2xl font-display font-medium tracking-[0.2em] uppercase leading-tight group-hover:text-accent transition-colors duration-700" style={{ color: 'var(--calc-title-color)' }}>{t('initiation_title')}</h3>
                      <p className="text-[10px] md:text-[10px] mt-1 tracking-wider uppercase font-medium opacity-80" style={{ color: 'var(--calc-desc-color)' }}>{t('initiation_desc')}</p>
                    </div>
                  </motion.div>

                  <motion.div variants={itemVariants} initial="hidden" whileInView="visible" viewport={{ once: true }} className="w-full" >
                    <form onSubmit={handleSubmit} className="space-y-16">
                      <div className="p-6 sm:p-8 md:p-10 bg-btn-bg [backdrop-filter:blur(var(--btn-blur))] [box-shadow:var(--btn-shadow)] hover:bg-btn-hover-bg transition-all duration-700 text-btn-text border-[length:var(--btn-border-width)] border-white/10 relative overflow-hidden">
                        <div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.05] to-transparent -translate-x-full group-hover/plate:translate-x-full transition-transform duration-1500 ease-in-out" />
                        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8 pb-8 border-b border-accent/5">
                          {[
                            { label: t('arch_form'), value: tcalc(`types.${projectType.toLowerCase()}` as any) },
                            { label: t('lang_units'), value: t('locales', { count: languages }) },
                            { label: t('support_proto'), value: tcalc(`support_levels.${support}`) },
                            { label: t('momentum'), value: tcalc(`momentum.${momentum.toLowerCase() === 'fast' ? 'fast' : momentum.toLowerCase()}` as any) },
                          ].map((item, id) => (
                            <div key={id} className="space-y-2 border-b sm:border-b-0 border-l-[0.5px] border-accent/5 pl-4 pb-4 sm:pb-0">
                              <span className="text-[11px] font-display uppercase tracking-[0.2em] opacity-80 block">{item.label}</span>
                              <span className="text-[11px] font-display uppercase tracking-[0.3em] text-foreground/50">{item.value}</span>
                            </div>
                          ))}
                        </div>
                        {activeAddons.length > 0 && (
                          <div className="pt-8 space-y-4">
                            <div className="flex flex-wrap gap-3">
                              {activeAddons.map((label) => (
                                <span key={label} className="text-[11px] uppercase tracking-[0.2em] text-accent/70 border-[0.5px] border-accent/20 px-3 py-1.5 font-bold">
                                  {label}
                                </span>
                              ))}
                            </div>
                          </div>
                        )}

                        <div className="pt-10 flex flex-col md:flex-row items-end justify-between gap-6 border-t border-accent/10 mt-12">
                          <div className="space-y-1">
                            <span className="text-[10px] md:text-[11px] font-display uppercase tracking-[0.4em] text-accent font-bold block leading-none">
                              {tcalc('initial_investment_label')}
                            </span>
                          </div>
                          <div className="space-y-1 text-right">
                            <div className="flex items-baseline justify-end gap-2">
                              <span className="text-3xl md:text-5xl font-display uppercase tracking-[0.1em] text-foreground hero-shimmer leading-none whitespace-nowrap">
                                {totalPrice.toLocaleString()}
                              </span>
                              <span className="text-2xl md:text-3xl font-display text-accent font-bold opacity-100">
                                TJS
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div className="space-y-6 relative group/input p-6 md:p-8 bg-btn-bg [backdrop-filter:blur(var(--btn-blur))] [box-shadow:var(--btn-shadow)] hover:bg-btn-hover-bg transition-all duration-700 text-btn-text overflow-hidden">
                          <div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent-champagne/40 to-transparent -translate-x-full group-hover/input:translate-x-full transition-transform duration-1500 ease-in-out" />
                          <input 
                            type="text" 
                            required 
                            placeholder={t('name_placeholder')} 
                            onInvalid={(e) => (e.target as HTMLInputElement).setCustomValidity(t('field_required'))}
                            onInput={(e) => (e.target as HTMLInputElement).setCustomValidity('')}
                            className="w-full bg-transparent py-2 outline-none transition-all duration-1000 font-display text-[10px] tracking-[0.2em] font-light placeholder:text-foreground/50 uppercase relative z-10" 
                          />
                        </div>
                        <div className="space-y-6 relative group/input p-6 md:p-8 bg-btn-bg [backdrop-filter:blur(var(--btn-blur))] [box-shadow:var(--btn-shadow)] hover:bg-btn-hover-bg transition-all duration-700 text-btn-text overflow-hidden">
                          <div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent-champagne/40 to-transparent -translate-x-full group-hover/input:translate-x-full transition-transform duration-1500 ease-in-out" />
                          <input 
                            type="email" 
                            required 
                            placeholder={t('channel_placeholder')} 
                            onInvalid={(e) => {
                              const target = e.target as HTMLInputElement;
                              if (target.validity.valueMissing) {
                                target.setCustomValidity(t('field_required'));
                              } else {
                                target.setCustomValidity(t('email_invalid'));
                              }
                            }}
                            onInput={(e) => (e.target as HTMLInputElement).setCustomValidity('')}
                            className="w-full bg-transparent py-2 outline-none transition-all duration-1000 font-display text-[10px] tracking-[0.2em] font-light placeholder:text-foreground/50 uppercase relative z-10" 
                          />
                        </div>
                      </div>

                      <div className="space-y-6 relative group/input p-6 md:p-8 bg-btn-bg [backdrop-filter:blur(var(--btn-blur))] [box-shadow:var(--btn-shadow)] hover:bg-btn-hover-bg transition-all duration-700 text-btn-text overflow-hidden">
                        <div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent-champagne/40 to-transparent -translate-x-full group-hover/input:translate-x-full transition-transform duration-1500 ease-in-out" />
                        <textarea 
                          rows={5} 
                          required 
                          placeholder={t('brief_placeholder')} 
                          onInvalid={(e) => (e.target as HTMLTextAreaElement).setCustomValidity(t('field_required'))}
                          onInput={(e) => (e.target as HTMLTextAreaElement).setCustomValidity('')}
                          className="w-full bg-transparent py-2 outline-none transition-all duration-1000 font-display text-[10px] tracking-[0.2em] font-light placeholder:text-foreground/50 resize-none uppercase relative z-10" 
                        />
                      </div>

                      <div className="pt-8">
                        <LuxuryButton type="submit" height="h-[72px]" disabled={status === 'sending'}>
                          <span className="flex items-center gap-6 uppercase tracking-[0.3em]">
                            {status === 'sending' ? (
                              <>
                                <span>{t('initializing_transmission')}</span>
                                <Loader2 size={14} className="animate-spin text-accent" />
                              </>
                            ) : (
                              <>
                                <span>{t('submit')}</span>
                                <Send size={14} strokeWidth={1} className="group-hover:translate-x-4 transition-transform duration-1000" />
                              </>
                            )}
                          </span>
                        </LuxuryButton>
                      </div>
                    </form>
                  </motion.div>
                </div>
              </motion.div>
            )}
          </AnimatePresence>
        </div>
      </div>
      <div className="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[0.5px] bg-gradient-to-r from-transparent via-accent/20 to-transparent" />
    </div>
  );
};
