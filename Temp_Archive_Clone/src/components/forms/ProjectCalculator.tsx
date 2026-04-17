'use client';

import { useState, useRef, useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import {
    Layout,
    Globe,
    ShoppingCart,
    Layers,
    Settings,
    Lock,
    ArrowRight,
    Check,
    Cpu,
    Zap,
    Shield,
    Clock,
    BarChart3,
    Server,
    Search,
    Brain,
    Rocket,
    CreditCard,
    Headphones,
    Plus,
    X,
    ChevronDown,
    Sparkles
} from 'lucide-react';
import { useTranslations } from 'next-intl';
import { useCalculatorStore, ProjectType, SupportLevel, MomentumProtocol, BillingCycle } from '@/store/useCalculatorStore';
import { LuxuryButton } from '@/components/ui/LuxuryButton';

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

    const [isDropdownOpen, setIsDropdownOpen] = useState(false);

    const types: { id: ProjectType; label: string; icon: any; badge?: string }[] = [
        { id: 'Landing', label: t('types.landing'), icon: Layout },
        { id: 'Corporate', label: t('types.corporate'), icon: Server },
        { id: 'Ecommerce', label: t('types.ecommerce'), icon: ShoppingCart },
        { id: 'Portal', label: t('types.portal'), icon: Globe },
        { id: 'SaaS', label: t('types.saas'), icon: Layers },
        { id: 'Immersive', label: t('types.immersive'), icon: Settings },
        { id: 'Sovereign', label: t('types.sovereign'), icon: Lock, badge: 'WEB3' },
    ];

    const presetLangs = [
        { id: 'en', label: 'English' },
        { id: 'ru', label: 'Russian' },
        { id: 'tj', label: 'Tajik' },
        { id: 'de', label: 'German' },
        { id: 'ar', label: 'Arabic' },
        { id: 'zh', label: 'Chinese' }
    ];

    const [selectedPresets, setSelectedPresets] = useState<string[]>(['en']);
    const [customLangs, setCustomLangs] = useState<string[]>([]);
    const [otherInput, setOtherInput] = useState('');

    const togglePreset = (id: string) => {
        const newPresets = selectedPresets.includes(id)
            ? selectedPresets.filter(p => p !== id)
            : [...selectedPresets, id];

        if (newPresets.length === 0 && customLangs.length === 0) return;

        setSelectedPresets(newPresets);
        setLanguages(newPresets.length + customLangs.length);
    };

    const addCustomLang = () => {
        if (otherInput.trim() && !customLangs.includes(otherInput.trim())) {
            const newList = [...customLangs, otherInput.trim()];
            setCustomLangs(newList);
            setLanguages(selectedPresets.length + newList.length);
            setOtherInput('');
        }
    };

    const handleProceed = () => {
        const contactSection = document.getElementById('contact');
        if (contactSection) {
            contactSection.scrollIntoView({ behavior: 'smooth' });
        }
    };

    // Grid logical preparation
    const activePresets = presetLangs.filter(pl => selectedPresets.includes(pl.id));
    const inactivePresets = presetLangs.filter(pl => !selectedPresets.includes(pl.id));

    const displayItems = [
        ...activePresets.map(p => ({ ...p, type: 'preset' as const, active: true })),
        ...customLangs.map(c => ({ id: c, label: c, type: 'custom' as const, active: true })),
    ];

    const minSlots = 6;
    const slotsNeeded = Math.max(minSlots, displayItems.length) - displayItems.length;
    const fillingItems = inactivePresets.slice(0, slotsNeeded).map(p => ({ ...p, type: 'preset' as const, active: false }));
    const finalGridItems = [...displayItems, ...fillingItems];

    return (
        <section id="calculator" className="relative overflow-hidden">
            <div className="container mx-auto px-6 max-w-7xl relative z-10">
                {/* Elite Promo Banner */}
                <div className="max-w-7xl mx-auto mb-24 text-center px-6">
                    <motion.div
                        initial={{ opacity: 0, scale: 0.98 }}
                        whileInView={{ opacity: 1, scale: 1 }}
                        viewport={{ once: true }}
                        transition={{ duration: 1.5, ease: [0.16, 1, 0.3, 1] }}
                        className="relative group/promo"
                    >
                        {/* Identical Momentum Unselected Card Style */}
                        <div className="group relative bg-background border-[0.5px] border-white/5 p-20 md:p-32 transition-all duration-1000 hover:bg-white/[0.01] overflow-hidden">
                            {/* Shimmer Effect */}
                            <div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.05] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1500 ease-in-out" />

                            <div className="relative z-10 flex flex-col items-center gap-6 md:gap-8">
                                <div className="flex items-center gap-6">
                                    <div className="w-16 h-[0.5px] bg-gradient-to-r from-transparent to-accent/50" />
                                    <Sparkles className="w-4 h-4 md:w-5 md:h-5 text-accent animate-pulse" strokeWidth={1.5} />
                                    <div className="w-16 h-[0.5px] bg-gradient-to-l from-transparent to-accent/50" />
                                </div>

                                <div className="space-y-4 md:space-y-6">
                                    <span className="text-[10px] md:text-[12px] uppercase tracking-[0.5em] md:tracking-[0.8em] text-accent font-display font-medium block">
                                        {t('foundational_partner_protocol')}
                                    </span>
                                    <h3 className="text-[12px] md:text-[16px] uppercase tracking-[0.2em] md:tracking-[0.3em] text-foreground/80 font-light leading-loose max-w-4xl mx-auto drop-shadow-md text-balance">
                                        {t.rich('discount_text', {
                                            discount: (chunks) => (
                                                <span className="font-bold text-transparent bg-clip-text bg-gradient-to-r from-accent via-[#FFF5E6] to-accent animate-shimmer whitespace-nowrap">
                                                    {chunks}
                                                </span>
                                            )
                                        })}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </motion.div>
                </div>

                <div className="max-w-4xl mx-auto bg-white/[0.01] p-10 md:p-20 space-y-16 relative group/calc">
                    {/* System 01: The Shell */}
                    <div className="space-y-12 mb-36">
                        <motion.div
                            initial={{ opacity: 0, y: 30, filter: 'blur(8px)' }}
                            whileInView={{ opacity: 1, y: 0, filter: 'blur(0px)' }}
                            viewport={{ once: true, margin: "-50px" }}
                            transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }}
                            className="flex items-center gap-6"
                        >
                            <div className="w-12 h-12 flex-shrink-0 rounded-full border border-accent/20 flex items-center justify-center text-accent/60 font-display text-sm relative overflow-hidden group">
                                <div className="absolute inset-0 bg-accent/5 animate-pulse" />
                                01
                            </div>
                            <div>
                                <h3 className="text-xl md:text-2xl font-display font-medium tracking-[0.2em] uppercase leading-tight group-hover:text-accent transition-colors duration-700">{t('system01.title')}</h3>
                                <p className="text-[11px] md:text-[13px] text-foreground/70 mt-1 tracking-wider uppercase font-medium">{t('system01.desc')}</p>
                            </div>
                        </motion.div>
                        <div className="relative">
                            <LuxuryButton
                                onClick={() => setIsDropdownOpen(!isDropdownOpen)}
                                height="h-[80px]"
                                className="group/drop"
                            >
                                <div className="flex items-center justify-between w-full px-8">
                                    <span className="text-base md:text-lg font-display font-light tracking-[0.2em] uppercase -mr-[0.2em] truncate pr-4">
                                        {types.find(t => t.id === projectType)?.label}
                                    </span>
                                    <ChevronDown className={`transition-transform duration-700 flex-shrink-0 ${isDropdownOpen ? 'rotate-180' : ''}`} size={16} strokeWidth={1} />
                                </div>
                            </LuxuryButton>
                            <AnimatePresence>
                                {isDropdownOpen && (
                                    <motion.div
                                        initial={{ opacity: 0, y: 10 }}
                                        animate={{ opacity: 1, y: 0 }}
                                        exit={{ opacity: 0, y: 10 }}
                                        className="absolute top-full left-0 w-full mt-2 bg-background border-[0.5px] border-accent/20 overflow-hidden shadow-2xl z-[60]"
                                    >
                                        {types.map((type) => (
                                            <button
                                                key={type.id}
                                                onClick={() => {
                                                    setProjectType(type.id);
                                                    setIsDropdownOpen(false);
                                                }}
                                                className="w-full text-left p-6 hover:bg-accent/5 transition-colors flex items-center justify-between group"
                                            >
                                                <div className="flex items-center gap-3">
                                                    <span className={`text-xs md:text-sm font-display tracking-[0.2em] uppercase ${projectType === type.id ? 'text-accent' : 'text-foreground/40'}`}>{type.label}</span>
                                                    {type.badge && (
                                                        <span className="text-[8px] uppercase tracking-[0.3em] font-black text-accent/80 border-[0.5px] border-accent/40 px-1.5 py-0.5 animate-pulse">{type.badge}</span>
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

                    {/* System 02: Linguistic Architecture */}
                    <div className="space-y-12 mb-36">
                        <motion.div
                            initial={{ opacity: 0, y: 30, filter: 'blur(8px)' }}
                            whileInView={{ opacity: 1, y: 0, filter: 'blur(0px)' }}
                            viewport={{ once: true, margin: "-50px" }}
                            transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }}
                            className="flex items-center gap-6"
                        >
                            <div className="w-12 h-12 flex-shrink-0 rounded-full border border-accent/20 flex items-center justify-center text-accent/60 font-display text-sm relative overflow-hidden group">
                                <div className="absolute inset-0 bg-accent/5 animate-pulse" />
                                02
                            </div>
                            <div>
                                <h3 className="text-xl md:text-2xl font-display font-medium tracking-[0.2em] uppercase leading-tight group-hover:text-accent transition-colors duration-700">{t('system02.title')}</h3>
                                <p className="text-[11px] md:text-[13px] text-foreground/70 mt-1 tracking-wider uppercase font-medium">{t('system02.desc')}</p>
                            </div>
                        </motion.div>

                        <div className="bg-background/20 p-8 relative overflow-hidden group/lang">
                            <div className="absolute top-0 left-0 w-4 h-4 border-t-[0.5px] border-l-[0.5px] border-accent/20" />
                            <div className="absolute top-0 right-0 w-4 h-4 border-t-[0.5px] border-r-[0.5px] border-accent/20" />
                            <div className="absolute bottom-0 left-0 w-4 h-4 border-b-[0.5px] border-l-[0.5px] border-accent/20" />
                            <div className="absolute bottom-0 right-0 w-4 h-4 border-b-[0.5px] border-r-[0.5px] border-accent/20" />

                            <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                                {finalGridItems.map((item, idx) => (
                                    <button
                                        key={`${item.type}-${item.id}-${idx}`}
                                        onClick={() => {
                                            if (item.type === 'preset') togglePreset(item.id);
                                            else {
                                                const newList = customLangs.filter(l => l !== item.id);
                                                setCustomLangs(newList);
                                                setLanguages(selectedPresets.length + newList.length);
                                            }
                                        }}
                                        className={`p-4 transition-all duration-500 flex flex-col items-center gap-3 relative group/lang-item ${item.active ? 'bg-accent/[0.05] text-accent' : 'text-foreground/20 hover:bg-white/[0.02]'}`}
                                    >
                                        {item.active && (
                                            <>
                                                <div className="absolute top-0 left-0 w-1.5 h-1.5 border-t-[0.5px] border-l-[0.5px] border-accent/60" />
                                                <div className="absolute top-0 right-0 w-1.5 h-1.5 border-t-[0.5px] border-r-[0.5px] border-accent/60" />
                                                <div className="absolute bottom-0 left-0 w-1.5 h-1.5 border-b-[0.5px] border-l-[0.5px] border-accent/60" />
                                                <div className="absolute bottom-0 right-0 w-1.5 h-1.5 border-b-[0.5px] border-r-[0.5px] border-accent/60" />
                                            </>
                                        )}
                                        <Globe size={14} strokeWidth={1.5} className={item.active ? 'opacity-100' : 'opacity-40'} />
                                        <span className={`text-[8.5px] uppercase tracking-[0.2em] truncate w-full text-center font-bold ${item.active ? 'text-accent' : 'text-foreground/60'}`}>{item.label}</span>
                                    </button>
                                ))}
                            </div>

                            <div className="mt-12 flex flex-col sm:flex-row items-stretch gap-6">
                                <div className="flex-1 relative group/input">
                                    <input
                                        type="text"
                                        value={otherInput}
                                        onChange={(e) => setOtherInput(e.target.value)}
                                        onKeyDown={(e) => e.key === 'Enter' && addCustomLang()}
                                        placeholder={t('input_custom_norm')}
                                        className="w-full bg-accent/2 px-6 py-5 text-[10px] md:text-[11px] uppercase tracking-[0.3em] text-accent focus:outline-none placeholder:text-foreground/40 transition-all font-light"
                                    />
                                    <div className="absolute bottom-0 left-0 w-full h-[0.5px] bg-accent/10 group-focus-within/input:bg-accent/40 transition-colors duration-700" />
                                </div>
                                <LuxuryButton onClick={addCustomLang} width="px-12" height="h-[56px]">
                                    <span className="text-[10px] md:text-sm">{t('append_unit')}</span>
                                </LuxuryButton>
                            </div>
                        </div>
                    </div>

                    {/* System 03: Momentum */}
                    <div className="space-y-12 mb-36">
                        <motion.div
                            initial={{ opacity: 0, y: 30, filter: 'blur(8px)' }}
                            whileInView={{ opacity: 1, y: 0, filter: 'blur(0px)' }}
                            viewport={{ once: true, margin: "-50px" }}
                            transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }}
                            className="flex items-center gap-6"
                        >
                            <div className="w-12 h-12 flex-shrink-0 rounded-full border border-accent/20 flex items-center justify-center text-accent/60 font-display text-sm relative overflow-hidden group">
                                <div className="absolute inset-0 bg-accent/5 animate-pulse" />
                                03
                            </div>
                            <div>
                                <h3 className="text-xl md:text-2xl font-display font-medium tracking-[0.2em] uppercase leading-tight group-hover:text-accent transition-colors duration-700">{t('system03.title')}</h3>
                                <p className="text-[11px] md:text-[13px] text-foreground/70 mt-1 tracking-wider uppercase font-medium">{t('system03.desc')}</p>
                            </div>
                        </motion.div>

                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {[
                                { id: 'Standard' as MomentumProtocol, label: t('momentum.standard'), icon: Clock, duration: t('duration.standard'), cost: 'BASE VALUE', desc: t('momentum_std_desc') },
                                { id: 'Accelerated' as MomentumProtocol, label: t('momentum.fast'), icon: Zap, duration: t('duration.fast'), cost: '+20% INVEST', desc: t('momentum_fast_desc') },
                                { id: 'Ultra' as MomentumProtocol, label: t('momentum.ultra'), icon: Rocket, duration: t('duration.ultra'), cost: '+50% INVEST', desc: t('momentum_ultra_desc') }
                            ].map((mode) => (
                                <button
                                    key={mode.id}
                                    onClick={() => setMomentum(mode.id)}
                                    className={`group relative p-8 md:p-10 text-left transition-all duration-1000 overflow-hidden min-h-[220px] flex flex-col justify-between ${momentum === mode.id ? 'bg-accent/[0.05]' : 'bg-background hover:bg-white/[0.01]'}`}
                                >
                                    <div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.05] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out" />
                                    {momentum === mode.id && (
                                        <div className="absolute inset-0">
                                            {/* Single Frame Corners */}
                                            <div className="absolute top-0 left-0 w-1.5 h-1.5 border-t-[0.5px] border-l-[0.5px] border-accent" />
                                            <div className="absolute top-0 right-0 w-1.5 h-1.5 border-t-[0.5px] border-r-[0.5px] border-accent" />
                                            <div className="absolute bottom-0 left-0 w-1.5 h-1.5 border-b-[0.5px] border-l-[0.5px] border-accent" />
                                            <div className="absolute bottom-0 right-0 w-1.5 h-1.5 border-b-[0.5px] border-r-[0.5px] border-accent" />
                                            <div className="absolute inset-0 border border-accent/10" />
                                        </div>
                                    )}
                                    <div className="relative z-10 flex flex-col gap-6 h-full">
                                        <div className="flex items-center justify-between">
                                            <div className={`p-3 ${momentum === mode.id ? 'bg-accent/20 text-accent' : 'bg-white/5 text-foreground/20'}`}>
                                                <mode.icon size={16} strokeWidth={1} />
                                            </div>
                                            <span className={`text-[8px] md:text-[9px] uppercase tracking-[0.2em] font-bold ${momentum === mode.id ? 'text-accent' : 'text-foreground/20'}`}>{mode.cost}</span>
                                        </div>
                                        <div className="space-y-2">
                                            <span className={`block text-[10px] md:text-[11px] uppercase tracking-[0.3em] font-medium leading-tight ${momentum === mode.id ? 'text-accent' : 'text-foreground/60'}`}>{mode.label}</span>
                                            <span className="text-[9px] md:text-[10px] uppercase tracking-widest text-accent font-display">{mode.duration}</span>
                                        </div>
                                        <p className="text-[9px] text-foreground/60 font-medium italic mt-auto leading-relaxed">{mode.desc}</p>
                                    </div>
                                </button>
                            ))}
                        </div>
                    </div>

                    {/* System 04: Support Protocols */}
                    <div className="space-y-12 mb-36">
                        <motion.div
                            initial={{ opacity: 0, y: 30, filter: 'blur(8px)' }}
                            whileInView={{ opacity: 1, y: 0, filter: 'blur(0px)' }}
                            viewport={{ once: true, margin: "-50px" }}
                            transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }}
                            className="flex items-center gap-6"
                        >
                            <div className="w-12 h-12 flex-shrink-0 rounded-full border border-accent/20 flex items-center justify-center text-accent/60 font-display text-sm relative overflow-hidden group">
                                <div className="absolute inset-0 bg-accent/5 animate-pulse" />
                                04
                            </div>
                            <div>
                                <h3 className="text-xl md:text-2xl font-display font-medium tracking-[0.2em] uppercase leading-tight group-hover:text-accent transition-colors duration-700">{t('system04.title')}</h3>
                                <p className="text-[11px] md:text-[13px] text-foreground/70 mt-1 tracking-wider uppercase font-medium">{t('system04.desc')}</p>
                            </div>
                        </motion.div>

                        <div className="flex justify-center w-full">
                            <div className="flex gap-6">
                                {(['Monthly', 'Yearly'] as BillingCycle[]).map((cycle) => (
                                    <button
                                        key={cycle}
                                        onClick={() => setBillingCycle(cycle)}
                                        className={`group relative w-40 md:w-48 h-[54px] md:h-[60px] transition-all duration-700 ${billingCycle === cycle ? 'bg-accent/[0.12]' : 'bg-white/[0.01]'}`}
                                    >
                                        <div className="relative z-10 flex flex-col items-center justify-center h-full">
                                            <span className={`text-[10px] md:text-[12px] uppercase tracking-[0.4em] font-black ${billingCycle === cycle ? 'text-accent' : 'text-foreground/40'}`}>
                                                {cycle === 'Monthly' ? t('billing.monthly') : t('billing.yearly')}
                                            </span>
                                            {cycle === 'Yearly' && <span className="text-[8px] md:text-[9px] uppercase tracking-[0.2em] text-accent font-bold mt-1">{t('save_30')}</span>}
                                        </div>
                                        {billingCycle === cycle && (
                                            <div className="absolute inset-0">
                                                {/* Single Frame Corners */}
                                                <div className="absolute top-0 left-0 w-1.5 h-1.5 border-t-[0.5px] border-l-[0.5px] border-accent" />
                                                <div className="absolute top-0 right-0 w-1.5 h-1.5 border-t-[0.5px] border-r-[0.5px] border-accent" />
                                                <div className="absolute bottom-0 left-0 w-1.5 h-1.5 border-b-[0.5px] border-l-[0.5px] border-accent" />
                                                <div className="absolute bottom-0 right-0 w-1.5 h-1.5 border-b-[0.5px] border-r-[0.5px] border-accent" />
                                                <div className="absolute inset-0 border border-accent/10" />
                                            </div>
                                        )}
                                    </button>
                                ))}
                            </div>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {[
                                { level: 'None' as SupportLevel, name: 'None', cost: '0', limit: 'ON-DEMAND', features: [t('support_features.on_demand_access'), t('support_features.basic_scan')] },
                                { level: 'Standard' as SupportLevel, name: 'Standard', cost: billingCycle === 'Yearly' ? '700' : '1000', limit: '08H / MONTHLY', features: [t('support_features.maintenance_8h'), t('support_features.weekly_backups'), t('support_features.base_cyber_defense')] },
                                { level: 'Elite' as SupportLevel, name: 'Elite', cost: billingCycle === 'Yearly' ? '2100' : '3000', limit: '24H / MONTHLY', features: [t('support_features.support_24h'), t('support_features.daily_backups'), t('support_features.neural_cyber_defense')] }
                            ].map((item) => (
                                <button
                                    key={item.level}
                                    onClick={() => setSupport(item.level)}
                                    className={`group relative p-10 md:p-12 text-left transition-all duration-1000 flex flex-col gap-8 md:gap-12 ${support === item.level ? 'bg-accent/[0.05]' : 'bg-background hover:bg-white/[0.01]'}`}
                                >
                                    {support === item.level && (
                                        <div className="absolute inset-0">
                                            {/* Single Frame Corners */}
                                            <div className="absolute top-0 left-0 w-1.5 h-1.5 border-t-[0.5px] border-l-[0.5px] border-accent" />
                                            <div className="absolute top-0 right-0 w-1.5 h-1.5 border-t-[0.5px] border-r-[0.5px] border-accent" />
                                            <div className="absolute bottom-0 left-0 w-1.5 h-1.5 border-b-[0.5px] border-l-[0.5px] border-accent" />
                                            <div className="absolute bottom-0 right-0 w-1.5 h-1.5 border-b-[0.5px] border-r-[0.5px] border-accent" />
                                            <div className="absolute inset-0 border border-accent/10" />
                                        </div>
                                    )}
                                    <div className="flex flex-col gap-8 md:gap-10 relative z-10 w-full">
                                        <span className={`text-[10px] md:text-[12px] uppercase tracking-[0.3em] font-black ${support === item.level ? 'text-accent' : 'text-foreground/20'}`}>{t(`support_levels.${item.level}`)}</span>
                                        <div className="flex items-baseline gap-1">
                                            <span className="text-3xl md:text-4xl font-display text-accent">{item.cost}</span>
                                            <span className="text-[9px] md:text-[10px] text-accent/40 uppercase tracking-widest leading-none">{t('tjs_mo')}</span>
                                        </div>
                                        <div className="space-y-4 pt-6 border-t border-white/5">
                                            {item.features.map((f, i) => (
                                                <div key={i} className="flex items-start gap-3">
                                                    <div className={`mt-1 w-1 h-1 flex-shrink-0 ${support === item.level ? 'bg-accent' : 'bg-white/10'}`} />
                                                    <span className={`text-[8.5px] md:text-[9px] uppercase tracking-wide leading-relaxed font-medium ${support === item.level ? 'text-foreground' : 'text-foreground/60'}`}>{f}</span>
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                </button>
                            ))}
                        </div>
                    </div>

                    {/* System 05: Expansion Modules */}
                    <div className="space-y-12 mb-36">
                        <motion.div
                            initial={{ opacity: 0, y: 30, filter: 'blur(8px)' }}
                            whileInView={{ opacity: 1, y: 0, filter: 'blur(0px)' }}
                            viewport={{ once: true, margin: "-50px" }}
                            transition={{ duration: 1.2, ease: [0.16, 1, 0.3, 1] }}
                            className="flex items-center gap-6"
                        >
                            <div className="w-12 h-12 flex-shrink-0 rounded-full border border-accent/20 flex items-center justify-center text-accent/60 font-display text-sm relative overflow-hidden group">
                                <div className="absolute inset-0 bg-accent/5 animate-pulse" />
                                05
                            </div>
                            <div>
                                <h3 className="text-xl md:text-2xl font-display font-medium tracking-[0.2em] uppercase leading-tight group-hover:text-accent transition-colors duration-700">{t('system05.title')}</h3>
                                <p className="text-[11px] md:text-[13px] text-foreground/70 mt-1 tracking-wider uppercase font-medium">{t('system05.desc')}</p>
                            </div>
                        </motion.div>

                        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                            {[
                                { id: 'branding' as const, cost: '3,000 TJS' },
                                { id: 'infrastructure' as const, cost: '1,000 TJS' },
                                { id: 'seo' as const, cost: '2,000 TJS' },
                                { id: 'ai' as const, cost: '3,750 TJS' },
                                { id: 'ads' as const, cost: '3,000 TJS' },
                                { id: 'smm' as const, cost: '2,500 TJS' },
                                { id: 'adsense' as const, cost: '1,500 TJS' },
                                { id: 'maps' as const, cost: '1,000 TJS' },
                                { id: 'narrative' as const, cost: '2,500–4,000' },
                                { id: 'kinetic' as const, cost: '2,500 TJS' },
                                { id: 'linguistic' as const, cost: '+27% of dev' },
                                { id: 'velocity' as const, cost: '1,500–2,000' },
                            ].map((addon) => {
                                return (
                                    <button
                                        key={addon.id}
                                        onClick={() => toggleAddon(addon.id)}
                                        className={`group relative p-8 text-left transition-all duration-1000 overflow-hidden min-h-[180px] flex flex-col justify-between ${addons[addon.id] ? 'bg-accent/[0.08]' : 'bg-background hover:bg-white/[0.01]'}`}
                                    >
                                        <div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.05] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1500 ease-in-out" />
                                        
                                        {addons[addon.id] && (
                                            <div className="absolute inset-0">
                                                {/* Single Frame Corners */}
                                                <div className="absolute top-0 left-0 w-1.5 h-1.5 border-t-[0.5px] border-l-[0.5px] border-accent" />
                                                <div className="absolute top-0 right-0 w-1.5 h-1.5 border-t-[0.5px] border-r-[0.5px] border-accent" />
                                                <div className="absolute bottom-0 left-0 w-1.5 h-1.5 border-b-[0.5px] border-l-[0.5px] border-accent" />
                                                <div className="absolute bottom-0 right-0 w-1.5 h-1.5 border-b-[0.5px] border-r-[0.5px] border-accent" />
                                                <div className="absolute inset-0 border border-accent/10" />
                                            </div>
                                        )}

                                        <div className="relative z-10 space-y-4 w-full h-full flex flex-col justify-between">
                                            <div className="flex justify-between items-start gap-3">
                                                <span className={`text-[9.5px] md:text-[10.5px] uppercase tracking-[0.2em] font-black leading-tight ${addons[addon.id] ? 'text-accent' : 'text-foreground/80'}`}>
                                                    {ta(`${addon.id}.label`)}
                                                </span>
                                                <div className={`w-1.5 h-1.5 rounded-full transition-all duration-700 ${addons[addon.id] ? 'bg-accent shadow-[0_0_10px_rgba(192,160,128,0.5)]' : 'bg-white/10'}`} />
                                            </div>
                                            
                                            <div className="space-y-4">
                                                <p className="text-[9px] text-foreground/40 font-medium italic leading-relaxed line-clamp-2">{ta(`${addon.id}.desc`)}</p>
                                                <span className={`block text-[9px] font-bold tracking-[0.1em] ${addons[addon.id] ? 'text-accent' : 'text-accent/30'}`}>{addon.cost}</span>
                                            </div>
                                        </div>
                                    </button>
                                );
                            })}
                        </div>
                    </div>

                    {/* Finalization */}
                    <div className="pt-24 border-t-[0.5px] border-accent/10 flex flex-col items-center gap-20">
                        <div className="text-center space-y-8">
                            <div className="flex flex-col items-center">
                                <span className="text-[9px] md:text-[10px] uppercase tracking-[1em] text-accent/60 font-bold block mb-8 -mr-[1em]">{t('valuation_asset')}</span>
                                <div className="text-5xl md:text-9xl font-display font-extralight text-accent tracking-tighter flex items-center justify-center gap-4">
                                    {totalPrice.toLocaleString()} <span className="text-2xl md:text-6xl text-accent/30">TJS</span>
                                </div>
                            </div>
                            <div className="flex flex-col items-center gap-2">
                                <span className="text-[9px] md:text-[10px] uppercase tracking-[0.4em] text-accent font-black animate-pulse -mr-[0.4em] mb-2">{t('access_rate')}</span>
                                <span className="text-2xl md:text-5xl font-display text-accent tracking-[0.2em]">{Math.round(totalPrice * 0.7).toLocaleString()} TJS</span>
                                <p className="text-[9px] md:text-[10px] uppercase tracking-[0.15em] text-foreground/40 italic mt-4 max-w-xs">{t('promo_disclaimer')}</p>
                            </div>
                        </div>

                        <LuxuryButton width="w-full sm:w-[500px]" onClick={handleProceed}>
                            <span className="text-[12px] md:text-base">{t('cta')}</span>
                        </LuxuryButton>
                    </div>
                </div>
            </div>


        </section>
    );
};
