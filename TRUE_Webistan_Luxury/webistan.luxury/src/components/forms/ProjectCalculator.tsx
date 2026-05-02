'use client';
import {
useState, useRef, useEffect 
}
from 'react';
import {
motion, AnimatePresence 
}
from 'framer-motion';
import {
Layout, Globe, ShoppingCart, Layers, Settings, Lock, ArrowRight, Check, Cpu, Zap, Shield, Clock, BarChart3, Server, Search, Brain, Rocket, CreditCard, Headphones, Plus, X, ChevronDown, Sparkles 
}
from 'lucide-react';
import {
useTranslations 
}
from 'next-intl';
import {
useCalculatorStore, ProjectType, SupportLevel, MomentumProtocol, BillingCycle 
}
from '@/store/useCalculatorStore';
import {
LuxuryButton 
}
from '@/components/ui/LuxuryButton';
export const ProjectCalculator = () => {
const t = useTranslations('Calculator');
const ta = useTranslations('Addons');
const projectType = useCalculatorStore(state => state.projectType);
const setProjectType = useCalculatorStore(state => state.setProjectType);
const setLanguages = useCalculatorStore(state => state.setLanguages);
const support = useCalculatorStore(state => state.support);
const setSupport = useCalculatorStore(state => state.setSupport);
const momentum = useCalculatorStore(state => state.momentum);
const setMomentum = useCalculatorStore(state => state.setMomentum);
const billingCycle = useCalculatorStore(state => state.billingCycle);
const setBillingCycle = useCalculatorStore(state => state.setBillingCycle);
const addons = useCalculatorStore(state => state.addons);
const toggleAddon = useCalculatorStore(state => state.toggleAddon);
const totalPrice = useCalculatorStore(state => state.totalPrice);
const originalPrice = useCalculatorStore(state => state.originalPrice);
const monthlyTotal = useCalculatorStore(state => state.monthlyTotal);
const isFounderRateActive = useCalculatorStore(state => state.isFounderRateActive);
const setFounderRateActive = useCalculatorStore(state => state.setFounderRateActive);
const [isDropdownOpen, setIsDropdownOpen] = useState(false);
const [isDrawerOpen, setIsDrawerOpen] = useState(false);
const types: {
id: ProjectType;
label: string;
icon: any;
badge?: string }[] = [ {
id: 'landing', label: t('types.landing'), icon: Layout }, {
id: 'promo', label: t('types.promo'), icon: Layers }, {
id: 'corporate', label: t('types.corporate'), icon: Server }, {
id: 'ecommerce', label: t('types.ecommerce'), icon: ShoppingCart }, {
id: 'portal', label: t('types.portal'), icon: Globe }, {
id: 'saas', label: t('types.saas'), icon: Settings }, {
id: 'immersive', label: t('types.immersive'), icon: Settings }, {
id: 'sovereign', label: t('types.sovereign'), icon: Lock, badge: 'WEB3' }, ];
const presetLangs = [ {
id: 'en', label: 'English' }, {
id: 'ru', label: 'Russian' }, {
id: 'tj', label: 'Tajik' }, {
id: 'de', label: 'German' }, {
id: 'ar', label: 'Arabic' }, {
id: 'zh', label: 'Chinese' 
}
];
const [selectedPresets, setSelectedPresets] = useState<string[]>(['en']);
const [customLangs, setCustomLangs] = useState<string[]>([]);
const [otherInput, setOtherInput] = useState('');
const togglePreset = (id: string) => {
const newPresets = selectedPresets.includes(id) ? selectedPresets.filter(p => p !== id) : [...selectedPresets, id];
if (newPresets.length === 0 && customLangs.length === 0) return;
setSelectedPresets(newPresets);
setLanguages(newPresets.length + customLangs.length);
}
const addCustomLang = () => {
if (otherInput.trim() && !customLangs.includes(otherInput.trim())) {
const newList = [...customLangs, otherInput.trim()];
setCustomLangs(newList);
setLanguages(selectedPresets.length + newList.length);
setOtherInput('');
}
}
const handleProceed = () => {
const contactSection = document.getElementById('contact');
if (contactSection) {
contactSection.scrollIntoView({
behavior: 'smooth' });
}
}
const activePresets = presetLangs.filter(pl => selectedPresets.includes(pl.id));
const inactivePresets = presetLangs.filter(pl => !selectedPresets.includes(pl.id));
const displayItems = [ ...activePresets.map(p => ({
...p,
type: 'preset' as const, active: true })), ...customLangs.map(c => ({
id: c, label: c,
type: 'custom' as const, active: true })), ];
const minSlots = 6;
const slotsNeeded = Math.max(minSlots, displayItems.length) - displayItems.length;
const fillingItems = inactivePresets.slice(0, slotsNeeded).map(p => ({
...p,
type: 'preset' as const, active: false }));
const finalGridItems = [...displayItems, ...fillingItems];
  return (
    <>
      <section id="calculator" className="relative overflow-hidden">
        <div className="group/promo w-screen relative left-1/2 -translate-x-1/2 py-[120px] overflow-hidden" style={{backgroundColor: '#000000'}}>
          <div className="max-w-6xl mx-auto relative border-[0.5px] border-accent/20 hover:border-accent/80 transition-colors duration-700 bg-black/40 backdrop-blur-sm px-6 py-32 md:px-12 text-center flex flex-col items-center justify-center">
            
            {/* Architectural Ribbon Anchor */}
            <div className="absolute top-0 right-0 w-[200px] h-[200px] overflow-hidden z-50 pointer-events-none">
              <div
                className="absolute top-[45px] right-[-55px] w-[280px] py-[12px] text-center shadow-[0_10px_30px_rgba(0,0,0,0.5)] overflow-hidden"
                style={{
                  background: 'linear-gradient(135deg, #8B6B23 0%, #D4AF37 50%, #8B6B23 100%)',
                  color: '#000000',
                  transform: 'rotate(45deg)',
                  borderTop: '1px solid rgba(255,255,255,0.4)',
                  borderBottom: '1px solid rgba(0,0,0,0.2)',
                  pointerEvents: 'auto'
                }}
              >
                <motion.div
                  initial={{ x: '-100%' }}
                  animate={{ x: '100%' }}
                  transition={{ duration: 3, repeat: Infinity, ease: "linear", repeatDelay: 0.5 }}
                  className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/40 to-transparent skew-x-[-20deg] z-10"
                />
                <span className="font-black text-[13px] tracking-[0.4em] uppercase block relative z-20" style={{ color: '#000000' }}>
                  {t('ribbon_label')}
                </span>
              </div>
            </div>

            <motion.div
              initial={{ opacity: 0, scale: 0.98 }}
              whileInView={{ opacity: 1, scale: 1 }}
              viewport={{ once: true }}
              transition={{ duration: 1.5, ease: [0.16, 1, 0.3, 1] }}
              className="relative z-10 flex flex-col items-center gap-6 md:gap-8 w-full"
            >
              <div className="flex items-center gap-6">
                <div className="w-16 h-[0.5px] bg-gradient-to-r from-transparent to-accent/50" />
                <Sparkles className="w-8 h-8 md:w-10 md:h-10 text-accent animate-pulse" strokeWidth={1.5} />
                <div className="w-16 h-[0.5px] bg-gradient-to-l from-transparent to-accent/50" />
              </div>
              <div className="space-y-4 md:space-y-6">
                <span className="text-[10px] md:text-[12px] uppercase tracking-[0.3em] md:tracking-[0.5em] text-accent font-display font-medium block">
                  {t('foundational_partner_protocol')}
                </span>
                <h3 className="text-[11px] md:text-[16px] uppercase tracking-normal md:tracking-wider text-white/80 font-light leading-snug mx-auto drop-shadow-md max-w-5xl">
                  {t.rich('discount_text', {
                    accent: (chunks) => (
                      <span className="font-bold text-transparent bg-clip-text bg-gradient-to-r from-accent via-[#FFF5E6] to-accent animate-shimmer whitespace-nowrap drop-shadow-[0_0_8px_rgba(184,134,11,0.5)]">
                        {chunks}
                      </span>
                    )
                  })}
                  <br />
                  {t.rich('discount_text_2', {
                    accent: (chunks) => (
                      <span className="font-bold text-transparent bg-clip-text bg-gradient-to-r from-accent via-[#FFF5E6] to-accent animate-shimmer whitespace-nowrap drop-shadow-[0_0_8px_rgba(184,134,11,0.5)]">
                        {chunks}
                      </span>
                    )
                  })}
                </h3>
              </div>
            </motion.div>
          </div>
        </div>

        <div className="w-full flex justify-center mb-[120px] relative z-20">
          <div className="w-full max-w-4xl h-[0.5px] bg-gradient-to-r from-transparent via-accent/50 to-transparent" />
        </div>

        <div className="relative group/block max-w-[1600px] mx-auto w-full">
          <div className="absolute top-0 left-0 w-8 h-8 border-t-[0.5px] border-l-[0.5px] border-accent/30 group-hover/block:border-accent group-hover/block:w-12 group-hover/block:h-12 transition-all duration-700" />
          <div className="absolute top-0 right-0 w-8 h-8 border-t-[0.5px] border-r-[0.5px] border-accent/30 group-hover/block:border-accent group-hover/block:w-12 group-hover/block:h-12 transition-all duration-700" />
          <div className="absolute bottom-0 left-0 w-8 h-8 border-b-[0.5px] border-l-[0.5px] border-accent/30 group-hover/block:border-accent group-hover/block:w-12 group-hover/block:h-12 transition-all duration-700" />
          <div className="absolute bottom-0 right-0 w-8 h-8 border-b-[0.5px] border-r-[0.5px] border-accent/30 group-hover/block:border-accent group-hover/block:w-12 group-hover/block:h-12 transition-all duration-700" />
          
          <div className="bg-background">
            <div className="container mx-auto px-6 max-w-7xl relative z-10">
              <div className="w-full relative group/calc shadow-2xl rounded-xl overflow-hidden bg-background">
                <div className="p-6 sm:p-8 md:p-16 lg:p-20 space-y-20">
                  {/* STEP 01 */}
                  <div className="space-y-12">
                    <motion.div initial={{ opacity: 0, y: 30, filter: 'blur(8px)' }} whileInView={{ opacity: 1, y: 0, filter: 'blur(0px)' }} viewport={{ once: true, margin: "-50px" }} transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }} className="flex items-center gap-6" >
                      <div className="w-14 h-14 flex-shrink-0 rounded-full border-2 flex items-center justify-center font-display text-base relative overflow-hidden group" style={{ borderColor: 'var(--calc-step-border-color)', color: 'var(--calc-step-num-color)' }}>
                        <div className="absolute inset-0 bg-accent/10 animate-pulse" /> 01 </div>
                      <div>
                        <h3 className="text-xl md:text-2xl font-display font-medium tracking-[0.2em] uppercase leading-tight group-hover:text-accent transition-colors duration-700" style={{ color: 'var(--calc-title-color)' }}>{t('system01.title')}</h3>
                        <p className="text-[10px] md:text-[10px] mt-1 tracking-wider uppercase font-medium opacity-60" style={{ color: 'var(--calc-desc-color)' }}>{t('system01.desc')}</p>
                      </div>
                    </motion.div>
                    <div className="relative">
                      <LuxuryButton onClick={() => setIsDropdownOpen(!isDropdownOpen)} showCorners={false} height="h-[90px]" width="w-full" className="group/drop" style={{ color: 'var(--calc-title-color)' }}>
                        <div className="flex items-center justify-between w-full px-10">
                          <span className="text-base md:text-lg font-display font-light tracking-[0.2em] uppercase -mr-[0.2em] truncate pr-4 text-white/50"> 
                            {types.find(t => t.id === projectType)?.label}
                          </span>
                          <ChevronDown className={`transition-transform duration-700 flex-shrink-0 ${isDropdownOpen ? 'rotate-180' : ''}`} size={16} strokeWidth={1} />
                        </div>
                      </LuxuryButton>
                      <AnimatePresence> 
                        {isDropdownOpen && ( 
                          <motion.div initial={{ opacity: 0, y: 10 }} animate={{ opacity: 1, y: 0 }} exit={{ opacity: 0, y: 10 }} className="absolute top-full left-0 w-full mt-2 border-none overflow-hidden shadow-2xl z-[60] bg-[#111111]" > 
                            {types.map((type) => ( 
                              <button key={type.id} onClick={() => { setProjectType(type.id); setIsDropdownOpen(false); }} className="w-full text-left p-3 hover:bg-white/[0.03] transition-all duration-500 flex items-center justify-between group/item" >
                                <div className="flex items-center gap-3 transition-all duration-500 group-hover/item:translate-x-2">
                                  <span className={`text-xs md:text-sm font-display tracking-[0.2em] uppercase transition-all duration-500 ${projectType === type.id ? 'text-accent font-bold opacity-100' : 'text-white/30 group-hover/item:text-accent group-hover/item:opacity-100'}`}>
                                    {type.label}
                                  </span> 
                                  {type.badge && ( 
                                    <span className="text-[10px] uppercase tracking-[0.3em] font-black text-accent/80 border-[0.5px] border-accent/40 px-1.5 py-0.5 animate-pulse">
                                      {type.badge}
                                    </span> 
                                  )}
                                </div> 
                                {projectType === type.id && <div className="w-1.5 h-1.5 bg-accent" />}
                              </button> 
                            ))}
                          </motion.div> 
                        )}
                      </AnimatePresence>
                    </div>
                  </div>

                  {/* STEP 02 */}
                  <div className="space-y-12 mb-36">
                    <motion.div initial={{ opacity: 0, y: 30, filter: 'blur(8px)' }} whileInView={{ opacity: 1, y: 0, filter: 'blur(0px)' }} viewport={{ once: true, margin: "-50px" }} transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }} className="flex items-center gap-6" >
                      <div className="w-14 h-14 flex-shrink-0 rounded-full border-2 flex items-center justify-center font-display text-base relative overflow-hidden group" style={{ borderColor: 'var(--calc-step-border-color)', color: 'var(--calc-step-num-color)' }}>
                        <div className="absolute inset-0 bg-accent/10 animate-pulse" /> 02 </div>
                      <div>
                        <h3 className="text-xl md:text-2xl font-display font-medium tracking-[0.2em] uppercase leading-tight group-hover:text-accent transition-colors duration-700" style={{ color: 'var(--calc-title-color)' }}>{t('system02.title')}</h3>
                        <p className="text-[10px] md:text-[10px] mt-1 tracking-wider uppercase font-medium opacity-60" style={{ color: 'var(--calc-desc-color)' }}>{t('system02.desc')}</p>
                      </div>
                    </motion.div>
                    <div className="relative overflow-hidden group/lang">
                      <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4"> {finalGridItems.map((item, idx) => ( <button key={`${item.type}-${item.id}-${idx}`} onClick={() => { if (item.type === 'preset') togglePreset(item.id); else { const newList = customLangs.filter(l => l !== item.id); setCustomLangs(newList); setLanguages(selectedPresets.length + newList.length); } }} className={`p-4 transition-all duration-500 flex flex-col items-center gap-3 relative group/lang-item ${item.active ? 'bg-accent/[0.05] text-accent' : 'bg-btn-bg backdrop-blur-sm hover:bg-btn-hover-bg'}`} style={{ color: item.active ? 'var(--accent)' : 'var(--calc-desc-color)' }} >
                        <div className={`absolute top-0 left-0 w-1.5 h-1.5 border-t-[0.5px] border-l-[0.5px] transition-all duration-700 ${item.active ? 'border-accent/80' : 'border-accent/0 group-hover/lang-item:border-accent/80'}`} />
                        <div className={`absolute top-0 right-0 w-1.5 h-1.5 border-t-[0.5px] border-r-[0.5px] transition-all duration-700 ${item.active ? 'border-accent/80' : 'border-accent/0 group-hover/lang-item:border-accent/80'}`} />
                        <div className={`absolute bottom-0 left-0 w-1.5 h-1.5 border-b-[0.5px] border-l-[0.5px] transition-all duration-700 ${item.active ? 'border-accent/80' : 'border-accent/0 group-hover/lang-item:border-accent/80'}`} />
                        <div className={`absolute bottom-0 right-0 w-1.5 h-1.5 border-b-[0.5px] border-r-[0.5px] transition-all duration-700 ${item.active ? 'border-accent/80' : 'border-accent/0 group-hover/lang-item:border-accent/80'}`} />
                        <Globe size={14} strokeWidth={1.5} className={item.active ? 'opacity-100' : 'opacity-60'} style={{ color: item.active ? 'var(--accent)' : 'var(--calc-desc-color)' }} />
                        <span className="text-[10.5px] uppercase tracking-[0.2em] truncate w-full text-center font-bold" style={{ color: item.active ? 'var(--accent)' : 'var(--calc-desc-color)' }}>{item.label}</span>
                      </button> ))}
                      </div>
                      <div className="mt-12 flex flex-col sm:flex-row items-stretch gap-6">
                        <div className="flex-1 relative group/input">
                          <input type="text" value={otherInput} onChange={(e) => setOtherInput(e.target.value)} onKeyDown={(e) => e.key === 'Enter' && addCustomLang()} placeholder={t('input_custom_norm')} className="w-full px-6 py-5 text-[10px] md:text-[11px] uppercase tracking-[0.3em] text-white/50 focus:outline-none placeholder:text-white/30 transition-all font-light bg-btn-bg" />
                          <div className="absolute bottom-0 left-0 w-full h-[0.5px] bg-accent/10 group-focus-within/input:bg-accent/40 transition-colors duration-700" />
                        </div>
                        <LuxuryButton onClick={addCustomLang} width="px-12" height="h-[56px]" style={{ backgroundColor: 'var(--calc-section-bg)', color: 'var(--calc-title-color)' }}>
                          <span className="text-[10px] md:text-sm">{t('append_unit')}</span>
                        </LuxuryButton>
                      </div>
                    </div>
                  </div>

                  {/* STEP 03 */}
                  <div className="space-y-12 mb-36">
                    <motion.div initial={{ opacity: 0, y: 30, filter: 'blur(8px)' }} whileInView={{ opacity: 1, y: 0, filter: 'blur(0px)' }} viewport={{ once: true, margin: "-50px" }} transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }} className="flex items-center gap-6" >
                      <div className="w-14 h-14 flex-shrink-0 rounded-full border-2 flex items-center justify-center font-display text-base relative overflow-hidden group" style={{ borderColor: 'var(--calc-step-border-color)', color: 'var(--calc-step-num-color)' }}>
                        <div className="absolute inset-0 bg-accent/10 animate-pulse" /> 03 </div>
                      <div>
                        <h3 className="text-xl md:text-2xl font-display font-medium tracking-[0.2em] uppercase leading-tight group-hover:text-accent transition-colors duration-700" style={{ color: 'var(--calc-title-color)' }}>{t('system03.title')}</h3>
                        <p className="text-[10px] md:text-[10px] mt-1 tracking-wider uppercase font-medium opacity-60" style={{ color: 'var(--calc-desc-color)' }}>{t('system03.desc')}</p>
                      </div>
                    </motion.div>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8"> {[ { id: 'standard' as MomentumProtocol, label: t('momentum.standard'), icon: Clock, duration: t('duration.standard'), cost: 'BASE VALUE', desc: t('momentum_std_desc') }, { id: 'fast' as MomentumProtocol, label: t('momentum.fast'), icon: Zap, duration: t('duration.fast'), cost: '+20% INVEST', desc: t('momentum_fast_desc') }, { id: 'ultra' as MomentumProtocol, label: t('momentum.ultra'), icon: Rocket, duration: t('duration.ultra'), cost: '+50% INVEST', desc: t('momentum_ultra_desc') } ].map((mode) => ( <button key={mode.id} onClick={() => setMomentum(mode.id)} className={`group relative p-6 sm:p-8 md:p-10 text-left transition-all duration-1000 overflow-hidden min-h-[220px] flex flex-col justify-between ${momentum === mode.id ? 'bg-accent/[0.05]' : 'bg-btn-bg [backdrop-filter:blur(var(--btn-blur))] [box-shadow:var(--btn-shadow)] hover:bg-btn-hover-bg text-black'}`} >
                      <div className={`absolute top-0 left-0 w-1.5 h-1.5 border-t-[0.5px] border-l-[0.5px] transition-all duration-700 ${momentum === mode.id ? 'border-accent/80 w-2 h-2' : 'border-accent/0 group-hover:border-accent/80 group-hover:w-2 group-hover:h-2'}`} />
                      <div className={`absolute top-0 right-0 w-1.5 h-1.5 border-t-[0.5px] border-r-[0.5px] transition-all duration-700 ${momentum === mode.id ? 'border-accent/80 w-2 h-2' : 'border-accent/0 group-hover:border-accent/80 group-hover:w-2 group-hover:h-2'}`} />
                      <div className={`absolute bottom-0 left-0 w-1.5 h-1.5 border-b-[0.5px] border-l-[0.5px] transition-all duration-700 ${momentum === mode.id ? 'border-accent/80 w-2 h-2' : 'border-accent/0 group-hover:border-accent/80 group-hover:w-2 group-hover:h-2'}`} />
                      <div className={`absolute bottom-0 right-0 w-1.5 h-1.5 border-b-[0.5px] border-r-[0.5px] transition-all duration-700 ${momentum === mode.id ? 'border-accent/80 w-2 h-2' : 'border-accent/0 group-hover:border-accent/80 group-hover:w-2 group-hover:h-2'}`} />
                      <div className="relative z-10 flex flex-col gap-6 h-full">
                        <div className="flex items-center justify-between">
                          <div className={`p-3 ${momentum === mode.id ? 'bg-btn-bg0 text-accent' : 'bg-card-bg'}`} style={{ color: momentum === mode.id ? 'var(--accent)' : 'var(--calc-desc-color)' }}>
                            <mode.icon size={16} strokeWidth={1} />
                          </div>
                          <span className="text-[10px] md:text-[11px] uppercase tracking-[0.2em] font-bold transition-all duration-500" style={{ color: momentum === mode.id ? 'var(--accent)' : 'var(--calc-desc-color)', opacity: momentum === mode.id ? 1 : 0.2 }}>{mode.cost}</span>
                        </div>
                        <div className="space-y-2">
                          <span className="block text-[10px] md:text-[11px] uppercase tracking-[0.3em] font-medium leading-tight transition-all duration-500" style={{ color: momentum === mode.id ? 'var(--accent)' : 'var(--calc-title-color)', opacity: momentum === mode.id ? 1 : 0.3 }}>{mode.label}</span>
                          <span className="text-[11px] md:text-[10px] uppercase tracking-widest text-accent font-display transition-all duration-500" style={{ opacity: momentum === mode.id ? 1 : 0.15 }}>{mode.duration}</span>
                        </div>
                        <p className="text-[11px] font-medium mt-auto leading-relaxed transition-all duration-500" style={{ color: 'var(--calc-desc-color)', opacity: momentum === mode.id ? 0.7 : 0.2 }}>{mode.desc}</p>
                      </div>
                    </button> ))}
                    </div>
                  </div>

                  {/* STEP 04 */}
                  <div className="space-y-12 mb-36">
                    <motion.div initial={{ opacity: 0, y: 30, filter: 'blur(8px)' }} whileInView={{ opacity: 1, y: 0, filter: 'blur(0px)' }} viewport={{ once: true, margin: "-50px" }} transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }} className="flex items-center gap-6" >
                      <div className="w-14 h-14 flex-shrink-0 rounded-full border-2 flex items-center justify-center font-display text-base relative overflow-hidden group" style={{ borderColor: 'var(--calc-step-border-color)', color: 'var(--calc-step-num-color)' }}>
                        <div className="absolute inset-0 bg-accent/10 animate-pulse" /> 04 </div>
                      <div>
                        <h3 className="text-xl md:text-2xl font-display font-medium tracking-[0.2em] uppercase leading-tight group-hover:text-accent transition-colors duration-700" style={{ color: 'var(--calc-title-color)' }}>{t('system04.title')}</h3>
                        <p className="text-[10px] md:text-[10px] mt-1 tracking-wider uppercase font-medium opacity-60" style={{ color: 'var(--calc-desc-color)' }}>{t('system04.desc')}</p>
                      </div>
                    </motion.div>
                    <div className="flex justify-center w-full">
                      <div className="flex gap-6"> {(['monthly', 'yearly'] as BillingCycle[]).map((cycle) => ( <button key={cycle} onClick={() => setBillingCycle(cycle)} className={`group relative w-40 md:w-48 h-[54px] md:h-[60px] transition-all duration-700 ${billingCycle === cycle ? 'bg-accent/[0.05]' : 'bg-btn-bg backdrop-blur-sm'}`} >
                        <div className="relative z-10 flex flex-col items-center justify-center h-full">
                          <span className="text-[10px] md:text-[12px] uppercase tracking-[0.4em] font-black" style={{ color: billingCycle === cycle ? 'var(--accent)' : 'var(--calc-desc-color)', opacity: billingCycle === cycle ? 1 : 0.6 }}> {cycle === 'monthly' ? t('billing.monthly') : t('billing.yearly')}
                          </span> {cycle === 'yearly' && <span className={`text-[10px] md:text-[11px] uppercase tracking-[0.2em] font-bold mt-1 transition-all duration-500 ${billingCycle === cycle ? 'text-accent' : 'text-accent/30'}`}>{t('save_30')}</span>}
                        </div> 
                        <div className={`absolute top-0 left-0 w-1.5 h-1.5 border-t-[0.5px] border-l-[0.5px] transition-all duration-700 ${billingCycle === cycle ? 'border-accent/80' : 'border-accent/0 group-hover:border-accent/80'}`} />
                        <div className={`absolute top-0 right-0 w-1.5 h-1.5 border-t-[0.5px] border-r-[0.5px] transition-all duration-700 ${billingCycle === cycle ? 'border-accent/80' : 'border-accent/0 group-hover:border-accent/80'}`} />
                        <div className={`absolute bottom-0 left-0 w-1.5 h-1.5 border-b-[0.5px] border-l-[0.5px] transition-all duration-700 ${billingCycle === cycle ? 'border-accent/80' : 'border-accent/0 group-hover:border-accent/80'}`} />
                        <div className={`absolute bottom-0 right-0 w-1.5 h-1.5 border-b-[0.5px] border-r-[0.5px] transition-all duration-700 ${billingCycle === cycle ? 'border-accent/80' : 'border-accent/0 group-hover:border-accent/80'}`} />
                      </button> ))}
                      </div>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8"> {[ { level: 'none' as SupportLevel, name: 'None', cost: '0', limit: 'ON-DEMAND', features: [t('support_features.on_demand_access'), t('support_features.basic_scan')] }, { level: 'standard' as SupportLevel, name: 'Standard', cost: billingCycle === 'yearly' ? '210' : '300', limit: '08H / MONTHLY', features: [t('support_features.maintenance_8h'), t('support_features.weekly_backups'), t('support_features.base_cyber_defense')] }, { level: 'elite' as SupportLevel, name: 'Elite', cost: billingCycle === 'yearly' ? '630' : '900', limit: '24H / MONTHLY', features: [t('support_features.support_24h'), t('support_features.daily_backups'), t('support_features.neural_cyber_defense')] } ].map((item) => ( <button key={item.level} onClick={() => setSupport(item.level)} className={`group relative p-6 sm:p-8 md:p-10 lg:p-12 text-left transition-all duration-1000 flex flex-col gap-8 md:gap-12 ${support === item.level ? 'bg-accent/[0.05]' : 'bg-btn-bg [backdrop-filter:blur(var(--btn-blur))] [box-shadow:var(--btn-shadow)] hover:bg-btn-hover-bg text-black'}`} >
                      <div className={`absolute inset-0 transition-opacity duration-700 ${support === item.level ? 'opacity-100' : 'opacity-0 group-hover:opacity-100'}`}>
                        <div className="absolute top-0 left-0 w-1.5 h-1.5 border-t-[0.5px] border-l-[0.5px] border-accent" />
                        <div className="absolute top-0 right-0 w-1.5 h-1.5 border-t-[0.5px] border-r-[0.5px] border-accent" />
                        <div className="absolute bottom-0 left-0 w-1.5 h-1.5 border-b-[0.5px] border-l-[0.5px] border-accent" />
                        <div className="absolute bottom-0 right-0 w-1.5 h-1.5 border-b-[0.5px] border-r-[0.5px] border-accent" />
                        <div className="absolute inset-0 border border-accent/10" />
                      </div>
                      <div className="flex flex-col gap-8 md:gap-10 relative z-10 w-full">
                        <span className="text-[10px] md:text-[12px] uppercase tracking-[0.3em] font-black" style={{ color: support === item.level ? 'var(--accent)' : 'var(--calc-desc-color)', opacity: support === item.level ? 1 : 0.4 }}>{t(`support_levels.${item.level}`)}</span>
                        <div className="flex items-baseline gap-1">
                          <span className={`text-3xl md:text-4xl font-display transition-all duration-500 ${support === item.level ? 'text-accent' : 'text-white/20'}`}>{item.cost}</span>
                          <span className="text-[11px] md:text-[10px] text-accent/40 uppercase tracking-widest leading-none">{t('tjs_mo')}</span>
                        </div>
                        <div className="space-y-4 pt-6 border-t border-black/5"> {item.features.map((f, i) => ( <div key={i} className="flex items-start gap-3">
                          <div className={`mt-1 w-1 h-1 flex-shrink-0 ${support === item.level ? 'bg-accent' : 'bg-black/10'}`} />
                          <span className="text-[10.5px] md:text-[11px] uppercase tracking-wide leading-relaxed font-medium" style={{ color: support === item.level ? 'var(--calc-title-color)' : 'var(--calc-desc-color)', opacity: support === item.level ? 1 : 0.7 }}>{f}</span>
                        </div> ))}
                        </div>
                      </div>
                    </button> ))}
                    </div>
                  </div>

                  {/* STEP 05 */}
                  <div className="space-y-12">
                    <motion.div initial={{ opacity: 0, y: 30, filter: 'blur(8px)' }} whileInView={{ opacity: 1, y: 0, filter: 'blur(0px)' }} viewport={{ once: true, margin: "-50px" }} transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }} className="flex items-center gap-6" >
                      <div className="w-14 h-14 flex-shrink-0 rounded-full border-2 flex items-center justify-center font-display text-base relative overflow-hidden group" style={{ borderColor: 'var(--calc-step-border-color)', color: 'var(--calc-step-num-color)' }}>
                        <div className="absolute inset-0 bg-accent/10 animate-pulse" /> 05 </div>
                      <div>
                        <h3 className="text-xl md:text-2xl font-display font-medium tracking-[0.2em] uppercase leading-tight group-hover:text-accent transition-colors duration-700" style={{ color: 'var(--calc-title-color)' }}>{t('system05.title')}</h3>
                        <p className="text-[10px] md:text-[10px] mt-1 tracking-wider uppercase font-medium opacity-60" style={{ color: 'var(--calc-desc-color)' }}>{t('system05.desc')}</p>
                      </div>
                    </motion.div>
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"> {[ { id: 'branding' as const, cost: '800 TJS' }, { id: 'infrastructure' as const, cost: '300 TJS' }, { id: 'seo' as const, cost: '500 TJS' }, { id: 'ai' as const, cost: '1,500 TJS' }, { id: 'ads' as const, cost: '500 TJS' }, { id: 'smm' as const, cost: '700 TJS' }, { id: 'adsense' as const, cost: '500 TJS' }, { id: 'maps' as const, cost: '300 TJS' }, { id: 'narrative' as const, cost: '500 TJS' }, { id: 'kinetic' as const, cost: '800 TJS' }, { id: 'localpay' as const, cost: '1,200 TJS' }, { id: 'velocity' as const, cost: '600 TJS' } ].map((addon) => { return ( <button key={addon.id} onClick={() => toggleAddon(addon.id)} className={`group relative p-5 md:p-6 text-left transition-all duration-1000 overflow-hidden min-h-[180px] flex flex-col justify-between ${addons[addon.id] ? 'bg-accent/[0.08]' : 'bg-btn-bg [backdrop-filter:blur(var(--btn-blur))] [box-shadow:var(--btn-shadow)] hover:bg-btn-hover-bg text-black'}`} >
                      <div className={`absolute top-0 left-0 w-1.5 h-1.5 border-t-[0.5px] border-l-[0.5px] transition-all duration-700 ${addons[addon.id] ? 'border-accent/80 w-2 h-2' : 'border-accent/0 group-hover:border-accent/80 group-hover:w-2 group-hover:h-2'}`} />
                      <div className={`absolute top-0 right-0 w-1.5 h-1.5 border-t-[0.5px] border-r-[0.5px] transition-all duration-700 ${addons[addon.id] ? 'border-accent/80 w-2 h-2' : 'border-accent/0 group-hover:border-accent/80 group-hover:w-2 group-hover:h-2'}`} />
                      <div className={`absolute bottom-0 left-0 w-1.5 h-1.5 border-b-[0.5px] border-l-[0.5px] transition-all duration-700 ${addons[addon.id] ? 'border-accent/80 w-2 h-2' : 'border-accent/0 group-hover:border-accent/80 group-hover:w-2 group-hover:h-2'}`} />
                      <div className={`absolute bottom-0 right-0 w-1.5 h-1.5 border-b-[0.5px] border-r-[0.5px] transition-all duration-700 ${addons[addon.id] ? 'border-accent/80 w-2 h-2' : 'border-accent/0 group-hover:border-accent/80 group-hover:w-2 group-hover:h-2'}`} />
                      <div className="relative z-10 space-y-4 w-full h-full flex flex-col justify-between">
                        <div className="flex justify-between items-start gap-3 w-full">
                          <span className="text-[11.5px] md:text-[10.5px] uppercase tracking-[0.2em] font-black leading-tight flex items-start gap-2 max-w-[90%] transition-all duration-500" style={{ color: addons[addon.id] ? 'var(--accent)' : 'var(--calc-title-color)', opacity: addons[addon.id] ? 1 : 0.3 }}>
                            <span className="break-words">{ta(`${addon.id}.label`)}</span>
                          </span>
                          <div className={`w-1.5 h-1.5 rounded-full transition-all flex-shrink-0 duration-700 ${addons[addon.id] ? 'bg-accent shadow-[0_0_10px_rgba(192,160,128,0.5)] animate-pulse' : 'bg-black/10'}`} />
                        </div>
                        <div className="space-y-4">
                          <p className="text-[10px] font-light leading-relaxed mt-1 transition-all duration-500" style={{ color: 'var(--calc-desc-color)', opacity: addons[addon.id] ? 0.6 : 0.15 }}>{ta(`${addon.id}.desc`)}</p>
                          <span className="block text-[11px] font-bold tracking-[0.1em] transition-all duration-500" style={{ color: addons[addon.id] ? 'var(--accent)' : 'var(--calc-desc-color)', opacity: addons[addon.id] ? 1 : 0.15 }}>{addon.cost}</span>
                        </div>
                      </div>
                    </button> ); })}
                    </div>
                    <div className="flex justify-center mt-12">
                      <button onClick={() => setIsDrawerOpen(true)} className="text-[10px] md:text-[11px] uppercase tracking-widest text-accent/60 hover:text-accent border-b border-accent/20 hover:border-accent transition-colors pb-1"> {t('details_drawer_trigger')}
                      </button>
                    </div>
                  </div>

                  {/* FINAL PRICING SECTION */}
                  <div className="flex flex-col items-center gap-12 w-full max-w-3xl mx-auto pt-24 border-t-[0.5px] border-accent/10 mt-12">
                    <div className="w-full space-y-8">
                      {/* 1. PRICE DISPLAY (BASE FOR NON-LANDING, ACCENT FOR LANDING) */}
                      <div className={`flex justify-between items-end border-b pb-4 ${projectType === 'landing' ? 'border-accent/20' : 'border-white/5'}`}>
                        <div className="space-y-1">
                          <span className={`text-[10px] md:text-[11px] uppercase tracking-[0.4em] block ${projectType === 'landing' ? 'text-accent font-black' : 'text-white/40'}`}>
                            {t('work_label')} ({t(`momentum_labels.${momentum}`)})
                          </span>
                        </div>
                        <div className={`font-display tracking-widest whitespace-nowrap ${projectType === 'landing' ? 'text-4xl md:text-6xl text-white hero-shimmer' : 'text-xl md:text-2xl text-white/40'}`}>
                          {originalPrice.toLocaleString()} <span className={`inline-block ${projectType === 'landing' ? 'text-xl text-white/40 ml-2' : ''}`}>TJS</span>
                        </div>
                      </div>

                      {/* 2. PRICE WITH DISCOUNT (ONLY FOR NON-LANDING) */}
                      {isFounderRateActive && projectType !== 'landing' && (
                        <div className="flex justify-between items-end border-b border-accent/20 pb-4">
                          <div className="space-y-1">
                            <span className="text-[10px] md:text-[11px] uppercase tracking-[0.4em] text-accent font-black block">{t('work_label')} ({t('founder_rate_label')})</span>
                          </div>
                          <div className="text-3xl md:text-5xl font-display text-white tracking-widest hero-shimmer whitespace-nowrap">
                            {totalPrice.toLocaleString()} <span className="text-xl text-white/40 ml-2 inline-block">TJS</span>
                          </div>
                        </div>
                      )}

                      {/* 3. SUPPORT PRICE */}
                      {monthlyTotal > 0 && (
                        <div className="flex flex-col space-y-2">
                          <div className="flex justify-between items-end border-b border-white/10 pb-2">
                            <div className="space-y-1">
                              <span className="text-[10px] md:text-[11px] uppercase tracking-[0.4em] text-accent/60 font-bold block">
                                {billingCycle === 'yearly' ? t('support_annual') : t('support_monthly')}
                              </span>
                              <p className="text-[11px] uppercase tracking-[0.2em] text-white/20">
                                {billingCycle === 'yearly' ? t('billing_cycle_yearly') : t('billing_cycle_monthly')}
                              </p>
                            </div>
                            <div className="text-2xl md:text-3xl font-display text-white tracking-widest whitespace-nowrap">
                              {billingCycle === 'yearly' ? (monthlyTotal * 12).toLocaleString() : monthlyTotal.toLocaleString()} 
                              <span className="text-sm text-white/40 ml-2 uppercase inline-block">
                                {billingCycle === 'yearly' ? t('tjs_yr') : t('tjs_mo')}
                              </span>
                            </div>
                          </div>
                          <p className="text-[10px] md:text-[11px] text-white/30 uppercase tracking-[0.2em] leading-relaxed italic">
                            {t('support_disclaimer')}
                          </p>
                        </div>
                      )}
                    </div>

                    <div className="flex flex-col items-center gap-8 w-full">
                      <p className="text-[11px] md:text-[10px] uppercase tracking-[0.15em] text-white/40 max-w-xs text-center">
                        {!isFounderRateActive || projectType === 'landing' ? t('landing_no_discount') : t('promo_disclaimer')}
                      </p>

                      <button 
                        onClick={() => { if (projectType !== 'landing') setFounderRateActive(!isFounderRateActive); }}
                        disabled={projectType === 'landing'}
                        className={`group/founder relative flex items-center gap-3 px-6 py-3 transition-all duration-500 bg-btn-bg [backdrop-filter:blur(var(--btn-blur))] border-[length:var(--btn-border-width)] border-white/10 [box-shadow:var(--btn-shadow)] overflow-hidden ${projectType === 'landing' ? 'opacity-50 cursor-not-allowed' : isFounderRateActive ? 'bg-accent/[0.05]' : 'hover:bg-btn-hover-bg'}`}
                      >
                        <div className={`w-3 h-3 border-[0.5px] flex items-center justify-center ${isFounderRateActive && projectType !== 'landing' ? 'border-accent bg-accent' : 'border-white/20'}`}> 
                          {isFounderRateActive && projectType !== 'landing' && <Check size={8} className="text-background" strokeWidth={3} />}
                        </div>
                        <span className={`text-[11px] md:text-[10px] uppercase tracking-[0.2em] font-bold relative z-10 ${isFounderRateActive && projectType !== 'landing' ? 'text-accent' : 'text-white/60'}`}>Founder Rate (-30%)</span>
                      </button>
                    </div>

                    <div className="w-full flex flex-col items-center gap-16 mt-8">
                      <div className="group/disc w-full max-w-2xl mx-auto p-8 relative overflow-hidden bg-btn-bg/30">
                        <p className="text-[11px] md:text-xs text-white/90 font-medium leading-relaxed uppercase tracking-wider relative z-10 text-center">{t('disclaimer_note')}</p>
                      </div>
                      <LuxuryButton width="w-full sm:w-[500px]" onClick={handleProceed}>
                        <span className="text-[12px] md:text-base">{t('cta')}</span>
                      </LuxuryButton>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <AnimatePresence>
        {isDrawerOpen && (
          <div className="fixed inset-0 z-[100] flex justify-end">
            <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }} className="absolute inset-0 bg-background/80 backdrop-blur-sm" onClick={() => setIsDrawerOpen(false)} />
            <motion.div initial={{ x: '100%' }} animate={{ x: 0 }} exit={{ x: '100%' }} transition={{ type: 'spring', damping: 25, stiffness: 200 }} className="relative w-full max-w-md h-full bg-background backdrop-blur-sm border-l-[0.5px] border-accent/20 overflow-y-auto" >
              <div className="sticky top-0 bg-background backdrop-blur-md z-10 px-6 md:px-8 py-5 md:py-6 border-b-[0.5px] border-accent/10 flex items-center justify-between gap-4">
                <h3 className="text-[11px] md:text-xs uppercase tracking-[0.3em] text-accent font-black truncate">{t('details_drawer_title')}</h3>
                <button onClick={() => setIsDrawerOpen(false)} className="flex-shrink-0 text-white/40 hover:text-accent transition-colors flex items-center gap-2">
                  <span className="text-[11px] uppercase tracking-widest">{t('details_drawer_close')}</span>
                  <X size={16} strokeWidth={1} />
                </button>
              </div>
              <div className="p-6 md:p-8 space-y-10">
                <div className="space-y-4">
                  <h4 className="text-[14px] md:text-[18px] font-display text-white tracking-[0.1em] uppercase border-l-2 border-accent pl-4">{t('drawer_content.title')}</h4>
                  <p className="text-[12px] text-white/70 leading-relaxed font-light">{t('drawer_content.intro')}</p>
                </div>
                <div className="space-y-6">
                  <h5 className="text-[11px] md:text-[12px] font-black uppercase tracking-[0.2em] text-accent flex items-center gap-3">
                    <span className="w-8 h-[1px] bg-accent/30" />
                    {t('drawer_content.base_works_title')}
                  </h5>
                  <ul className="space-y-4">
                    <li className="text-[12px] text-white/80 leading-relaxed pl-4 border-l border-white/5" dangerouslySetInnerHTML={{ __html: t.raw('drawer_content.base_works.dev') }} />
                    <li className="text-[12px] text-white/80 leading-relaxed pl-4 border-l border-white/5" dangerouslySetInnerHTML={{ __html: t.raw('drawer_content.base_works.lang') }} />
                  </ul>
                </div>
                <div className="space-y-6">
                  <h5 className="text-[11px] md:text-[12px] font-black uppercase tracking-[0.2em] text-accent flex items-center gap-3">
                    <span className="w-8 h-[1px] bg-accent/30" />
                    {t('drawer_content.modules_title')}
                  </h5>
                  <ul className="space-y-5">
                    {['localpay', 'ads', 'infrastructure', 'ai', 'seo', 'narrative', 'branding'].map((module) => (
                      <li key={module} className="text-[12px] text-white/80 leading-relaxed pl-4 border-l border-white/5 hover:border-accent/30 transition-colors" dangerouslySetInnerHTML={{ __html: t.raw(`drawer_content.modules.${module}`) }} />
                    ))}
                  </ul>
                </div>
                <div className="mt-12 p-6 bg-accent/[0.03] border-[0.5px] border-accent/20 rounded-sm">
                  <h5 className="text-[10px] font-black uppercase tracking-[0.2em] text-accent mb-3 flex items-center gap-2">
                    <span className="w-1.5 h-1.5 bg-accent rounded-full animate-pulse" />
                    {t('drawer_content.note_title')}
                  </h5>
                  <p className="text-[11px] text-white/70 leading-relaxed font-light italic">{t('drawer_content.note_text')}</p>
                </div>
              </div>
            </motion.div>
          </div>
        )}
      </AnimatePresence>
    </>
  );
};
