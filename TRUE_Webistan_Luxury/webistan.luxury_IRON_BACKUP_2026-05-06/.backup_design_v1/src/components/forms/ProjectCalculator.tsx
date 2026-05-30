'use client';

import { motion, AnimatePresence } from 'framer-motion';
import { useCalculatorStore, ProjectType, SupportLevel, MomentumProtocol, BillingCycle } from '@/store/useCalculatorStore';
import { ChevronDown, Globe, Layout, Server, ShoppingCart, Layers, Settings, X, Clock, Zap, Shield, Sparkles } from 'lucide-react';
import { useState, useRef } from 'react';
import { LuxuryButton } from '@/components/ui/LuxuryButton';

export const ProjectCalculator = () => {
    const projectType = useCalculatorStore(state => state.projectType);
    const setProjectType = useCalculatorStore(state => state.setProjectType);
    const setLanguages = useCalculatorStore(state => state.setLanguages);
    const support = useCalculatorStore(state => state.support);
    const setSupport = useCalculatorStore(state => state.setSupport);
    const momentum = useCalculatorStore(state => state.momentum);
    const setMomentum = useCalculatorStore(state => state.setMomentum);
    const billingCycle = useCalculatorStore(state => state.billingCycle);
    const setBillingCycle = useCalculatorStore(state => state.setBillingCycle);
    const totalPrice = useCalculatorStore(state => state.totalPrice);

    const [isDropdownOpen, setIsDropdownOpen] = useState(false);

    const types: { id: ProjectType; label: string; icon: any }[] = [
        { id: 'Landing', label: 'Landing Page', icon: Layout },
        { id: 'Corporate', label: 'Corporate Platform', icon: Server },
        { id: 'Ecommerce', label: 'Digital Store', icon: ShoppingCart },
        { id: 'Portal', label: 'Enterprise Portal', icon: Globe },
        { id: 'SaaS', label: 'SaaS Architecture', icon: Layers },
        { id: 'Immersive', label: 'Immersive Experience', icon: Settings },
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
        <section id="calculator" className="py-[125px] bg-background relative overflow-hidden">
            <div className="container mx-auto px-6 max-w-7xl relative z-10">
                {/* Architectural Cascade Header */}
                <div className="max-w-4xl mx-auto text-center mb-24 flex flex-col items-center">
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 1.5 }}
                        className="flex flex-col items-center gap-8"
                    >
                        <span className="text-sm md:text-lg font-display font-extralight tracking-[1.05em] text-foreground/40 uppercase block leading-none -mr-[1.05em]">
                            PRECISION CALIBRATION
                        </span>
                        <span className="text-3xl md:text-6xl uppercase tracking-[0.4em] text-[#E5D5B0]/70 font-light leading-none -mr-[0.4em]">
                            INVESTMENT
                        </span>
                        <div className="flex flex-col items-center">
                            <h2 className="text-5xl md:text-8xl font-display font-bold tracking-[0.1em] leading-none uppercase -mr-[0.1em]">
                                <span className="bg-gradient-to-r from-[#C0A080] via-[#FFF5E6] via-[#FFD700] via-[#FFF5E6] to-[#C0A080] bg-[length:200%_auto] bg-clip-text text-transparent animate-shimmer inline-block pb-4">
                                    BLUEPRINT
                                </span>
                            </h2>
                            <div className="w-80 h-[0.5px] bg-gradient-to-r from-transparent via-accent/40 to-transparent mt-4" />
                        </div>
                    </motion.div>
                </div>

                <div className="max-w-4xl mx-auto bg-white/[0.01] p-10 md:p-20 space-y-32 relative">
                    {/* 01. Architecture */}
                    <div className="space-y-12 relative z-50">
                        <div className="flex flex-col gap-4">
                            <span className="text-[10px] uppercase tracking-[0.4em] text-accent/50 font-light italic">System 01__</span>
                            <h3 className="text-xl md:text-2xl font-display font-light text-[#E5D5B0] tracking-[0.3em] uppercase leading-none">CHOOSE ARCHITECTURAL FORM</h3>
                            <p className="text-[11px] text-foreground/40 leading-relaxed max-w-2xl italic tracking-wide">
                                Select the foundational structure for your digital asset, from immersive experiences to enterprise-grade portals.
                            </p>
                        </div>
                        <div className="relative">
                            <LuxuryButton
                                onClick={() => setIsDropdownOpen(!isDropdownOpen)}
                                height="h-[80px]"
                                className="group/drop"
                            >
                                <div className="flex items-center justify-between w-full px-8">
                                    <span className="text-lg font-display font-light tracking-[0.2em] uppercase -mr-[0.2em]">
                                        {types.find(t => t.id === projectType)?.label}
                                    </span>
                                    <ChevronDown className={`transition-transform duration-700 ${isDropdownOpen ? 'rotate-180' : ''}`} size={16} strokeWidth={1} />
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
                                                <span className={`text-sm font-display tracking-[0.2em] uppercase ${projectType === type.id ? 'text-accent' : 'text-foreground/40'}`}>{type.label}</span>
                                                {projectType === type.id && <div className="w-1.5 h-1.5 bg-accent" />}
                                            </button>
                                        ))}
                                    </motion.div>
                                )}
                            </AnimatePresence>
                        </div>
                    </div>

                    {/* 02. Scalability */}
                    <div className="space-y-12">
                        <div className="flex flex-col gap-4">
                            <span className="text-[10px] uppercase tracking-[0.4em] text-accent/50 font-light italic">System 02__</span>
                            <div className="flex flex-col md:flex-row md:items-end justify-between gap-6">
                                <div className="space-y-2">
                                    <h3 className="text-xl md:text-2xl font-display font-light text-[#E5D5B0] tracking-[0.3em] uppercase leading-none">LANGUAGE ARCHITECTURE</h3>
                                    <p className="text-[11px] text-foreground/40 leading-relaxed italic tracking-wide">
                                        Expand your global Reach | +20% per additional localization unit.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div className="bg-background/20 p-8 relative overflow-hidden group/lang">
                            {/* Precision Corners for Container */}
                            <div className="absolute top-0 left-0 w-4 h-4 border-t-[0.5px] border-l-[0.5px] border-accent/20" />
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
                                        <div className={`absolute top-0 left-0 w-1.5 h-1.5 border-t-[0.5px] border-l-[0.5px] transition-colors duration-500 ${item.active ? 'border-accent/60' : 'border-accent/10 group-hover/lang-item:border-accent/30'}`} />
                                        <div className={`absolute bottom-0 right-0 w-1.5 h-1.5 border-b-[0.5px] border-r-[0.5px] transition-colors duration-500 ${item.active ? 'border-accent/60' : 'border-accent/10 group-hover/lang-item:border-accent/30'}`} />

                                        {item.type === 'custom' && (
                                            <div className="absolute top-1 right-1 p-1 opacity-0 group-hover/lang-item:opacity-100 transition-opacity z-10">
                                                <X size={8} />
                                            </div>
                                        )}
                                        <Globe size={14} strokeWidth={1} className={item.active ? 'opacity-100' : 'opacity-20'} />
                                        <span className="text-[9px] uppercase tracking-[0.2em]">{item.label}</span>
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
                                        placeholder="INPUT CUSTOM UNIT NORM..."
                                        className="w-full bg-accent/2 px-6 py-5 text-[11px] uppercase tracking-[0.3em] text-accent focus:outline-none placeholder:text-foreground/5 transition-all"
                                    />
                                    <div className="absolute bottom-0 left-0 w-full h-[0.5px] bg-accent/10 group-focus-within/input:bg-accent/40 transition-colors duration-700" />
                                    {/* Small markers for input */}
                                    <div className="absolute top-0 left-0 w-2 h-2 border-t-[0.5px] border-l-[0.5px] border-accent/5 group-focus-within/input:border-accent/20 transition-colors" />
                                    <div className="absolute bottom-0 right-0 w-2 h-2 border-b-[0.5px] border-r-[0.5px] border-accent/5 group-focus-within/input:border-accent/20 transition-colors" />
                                </div>

                                <LuxuryButton
                                    onClick={addCustomLang}
                                    width="px-12"
                                    height="h-[56px]"
                                >
                                    APPEND UNIT
                                </LuxuryButton>
                            </div>
                        </div>
                    </div>

                    {/* 03. Velocity */}
                    <div className="space-y-12">
                        <div className="flex flex-col gap-4">
                            <span className="text-[10px] uppercase tracking-[0.4em] text-accent/50 font-light italic">System 03__</span>
                            <h3 className="text-xl md:text-2xl font-display font-light text-[#E5D5B0] tracking-[0.3em] uppercase leading-none">CHOOSE YOUR MOMENTUM</h3>
                            <p className="text-[11px] text-foreground/40 leading-relaxed max-w-2xl italic tracking-wide">
                                Standard architectural cycle is 21–30 business days. Select a high-velocity protocol to prioritize your market entry.
                            </p>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {[
                                {
                                    id: 'Standard' as MomentumProtocol,
                                    label: 'Standard',
                                    icon: Clock,
                                    duration: '21–30 DAYS',
                                    cost: 'BASE VALUE',
                                    desc: 'Standard architectural cycle. Optimal for balanced production queues.'
                                },
                                {
                                    id: 'Fast' as MomentumProtocol,
                                    label: 'Accelerated',
                                    icon: Zap,
                                    duration: '10–14 DAYS',
                                    cost: '+20% INVEST',
                                    desc: 'Priority resource allocation. Surgical focus on faster market entry.'
                                },
                                {
                                    id: 'Ultra' as MomentumProtocol,
                                    label: 'Ultra-Velocity',
                                    icon: Sparkles,
                                    duration: '5–7 DAYS',
                                    cost: '+50% INVEST',
                                    desc: 'Absolute priority. 24/7 dedicated architectural sprint for immediate deployment.'
                                }
                            ].map((mode) => (
                                <button
                                    key={mode.id}
                                    onClick={() => setMomentum(mode.id)}
                                    className={`group relative p-10 text-left transition-all duration-1000 overflow-hidden ${momentum === mode.id ? 'bg-accent/[0.05]' : 'bg-background hover:bg-white/[0.01]'}`}
                                >
                                    {/* Glass Shine */}
                                    <div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.05] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out" />

                                    {/* Corner Markers */}
                                    <div className={`absolute top-0 left-0 w-2 h-2 border-t-[0.5px] border-l-[0.5px] transition-colors duration-500 ${momentum === mode.id ? 'border-accent' : 'border-accent/10 group-hover:border-accent/40'}`} />
                                    <div className={`absolute bottom-0 right-0 w-2 h-2 border-b-[0.5px] border-r-[0.5px] transition-colors duration-500 ${momentum === mode.id ? 'border-accent' : 'border-accent/10 group-hover:border-accent/40'}`} />

                                    <div className="relative z-10 flex flex-col gap-8">
                                        <div className="flex items-center justify-between">
                                            <div className={`p-3 ${momentum === mode.id ? 'bg-accent/20 text-accent' : 'bg-white/5 text-foreground/20'}`}>
                                                <mode.icon size={16} strokeWidth={1} />
                                            </div>
                                            <span className={`text-[9px] uppercase tracking-[0.2em] font-bold ${momentum === mode.id ? 'text-accent' : 'text-foreground/20'}`}>
                                                {mode.cost}
                                            </span>
                                        </div>

                                        <div className="space-y-2">
                                            <span className={`block text-[11px] uppercase tracking-[0.3em] font-medium ${momentum === mode.id ? 'text-accent' : 'text-foreground/60'}`}>
                                                {mode.label}
                                            </span>
                                            <div className="flex items-center gap-2">
                                                <div className="w-1 h-1 bg-accent/40 rounded-full" />
                                                <span className="text-[10px] uppercase tracking-widest text-accent font-display">{mode.duration}</span>
                                            </div>
                                        </div>

                                        <p className="text-[10px] text-foreground/30 font-light leading-relaxed tracking-wider italic">
                                            {mode.desc}
                                        </p>
                                    </div>
                                    {momentum === mode.id && <motion.div layoutId="momentum-active" className="absolute inset-0 bg-accent/[0.02]" />}
                                </button>
                            ))}
                        </div>
                    </div>

                    {/* 04. Support */}
                    <div className="space-y-20">
                        <div className="flex flex-col gap-4">
                            <span className="text-[10px] uppercase tracking-[0.4em] text-accent/50 font-light italic">System 04__</span>
                            <h3 className="text-xl md:text-2xl font-display font-light text-[#E5D5B0] tracking-[0.3em] uppercase leading-none">SELECT SUPPORT PROTOCOL</h3>
                            <p className="text-[11px] text-foreground/40 leading-relaxed max-w-2xl italic tracking-wide">
                                Strategic maintenance tiers for long-term digital stability. Essential for evolving architectural integrity.
                            </p>
                        </div>

                        {/* Billing Protocol Selector - Architectural Style */}
                        <div className="flex items-center gap-4">
                            <span className="text-[9px] uppercase tracking-[0.3em] text-foreground/30 italic">Cycle Selection:</span>
                            <div className="flex gap-4">
                                {(['Monthly', 'Yearly'] as BillingCycle[]).map((cycle) => (
                                    <button
                                        key={cycle}
                                        onClick={() => setBillingCycle(cycle)}
                                        className={`group relative px-8 h-[48px] transition-all duration-700 hover:scale-[1.02] overflow-hidden ${billingCycle === cycle ? 'bg-accent/[0.08]' : 'bg-white/[0.01]'}`}
                                    >
                                        {/* Glass Shine Animation */}
                                        <div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.07] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out" />

                                        {/* Corner Markers */}
                                        <div className={`absolute top-0 left-0 w-2 h-2 border-t-[0.5px] border-l-[0.5px] transition-colors duration-500 ${billingCycle === cycle ? 'border-accent' : 'border-accent/40 group-hover:border-accent'}`} />
                                        <div className={`absolute top-0 right-0 w-2 h-2 border-t-[0.5px] border-r-[0.5px] transition-colors duration-500 ${billingCycle === cycle ? 'border-accent' : 'border-accent/40 group-hover:border-accent'}`} />
                                        <div className={`absolute bottom-0 left-0 w-2 h-2 border-b-[0.5px] border-l-[0.5px] transition-colors duration-500 ${billingCycle === cycle ? 'border-accent' : 'border-accent/40 group-hover:border-accent'}`} />
                                        <div className={`absolute bottom-0 right-0 w-2 h-2 border-b-[0.5px] border-r-[0.5px] transition-colors duration-500 ${billingCycle === cycle ? 'border-accent' : 'border-accent/40 group-hover:border-accent'}`} />

                                        <div className={`relative z-10 flex flex-col items-center transition-all duration-700 ${billingCycle === cycle ? 'text-foreground' : 'text-foreground/40'}`}>
                                            <span className="text-[10px] uppercase tracking-[0.4em] mb-0.5">
                                                {cycle}
                                            </span>
                                            {cycle === 'Yearly' && (
                                                <span className={`text-[8px] uppercase tracking-widest ${billingCycle === cycle ? 'text-accent' : 'text-accent/40'}`}>-30% SAVING_</span>
                                            )}
                                        </div>
                                    </button>
                                ))}
                            </div>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {[
                                {
                                    level: 'None' as SupportLevel,
                                    cost: '0',
                                    limit: 'ON-DEMAND',
                                    features: ['On-Demand Access Protocol', 'Basic Vulnerability Scan', 'Pay-per-hour Fixes']
                                },
                                {
                                    level: 'Standard' as SupportLevel,
                                    cost: billingCycle === 'Yearly' ? '140' : '200',
                                    limit: '08H / MONTHLY',
                                    features: ['8h Maintenance Sprint', '48h Guaranteed Response', 'Base Protection Layer', 'Uptime Monitoring 24/7']
                                },
                                {
                                    level: 'Elite' as SupportLevel,
                                    cost: billingCycle === 'Yearly' ? '420' : '600',
                                    limit: '24H / MONTHLY',
                                    features: ['24h Dedicated Support', '04h Priority Response', 'Total Security Protocol', 'Architectural Advisory']
                                }
                            ].map((item) => {
                                const isActive = support === item.level;

                                return (
                                    <button
                                        key={item.level}
                                        onClick={() => setSupport(item.level)}
                                        className={`group relative p-12 text-left transition-all duration-1000 flex flex-col items-start gap-12 overflow-hidden ${isActive ? 'bg-accent/[0.04]' : 'bg-background hover:bg-white/[0.01]'}`}
                                    >
                                        {/* Glass Shine */}
                                        <div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.03] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out" />

                                        {/* Precision Markers */}
                                        <div className={`absolute top-0 left-0 w-3 h-3 border-t-[0.5px] border-l-[0.5px] transition-colors duration-500 ${isActive ? 'border-accent' : 'border-accent/10 group-hover:border-accent/40'}`} />
                                        <div className={`absolute bottom-0 right-0 w-3 h-3 border-b-[0.5px] border-r-[0.5px] transition-colors duration-500 ${isActive ? 'border-accent' : 'border-accent/10 group-hover:border-accent/40'}`} />

                                        <div className="flex flex-col gap-8 relative z-10 w-full">
                                            <div className="flex items-center justify-between">
                                                <Shield
                                                    size={24}
                                                    strokeWidth={1}
                                                    className={`transition-all duration-1000 ${isActive ? 'text-accent fill-accent' : 'text-foreground/10'}`}
                                                />
                                                <span className={`text-[11px] uppercase tracking-[0.3em] transition-all duration-700 font-display ${isActive ? 'text-accent' : 'text-foreground/40'}`}>
                                                    {item.level} PROTOCOL
                                                </span>
                                            </div>

                                            <div className="space-y-6">
                                                <div className="flex flex-col">
                                                    <div className="flex items-start gap-1">
                                                        <span className="text-[14px] text-accent/30 mt-2 font-display">$</span>
                                                        <span className="text-6xl font-display text-[#E5D5B0] tracking-tighter leading-none">{item.cost}</span>
                                                        <div className="flex flex-col self-end mb-1 translate-y-1">
                                                            <span className="text-[9px] text-accent/40 uppercase tracking-widest italic">/mo_</span>
                                                            <span className="text-[7px] text-foreground/20 uppercase tracking-tighter italic">recurring</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div className="flex items-center gap-3">
                                                    <div className="w-1 h-1 bg-accent/40 rounded-full" />
                                                    <p className="text-[10px] uppercase tracking-[0.2em] text-accent/50 font-light italic font-display">{item.limit} ALLOCATION</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div className="w-full space-y-5 relative z-10">
                                            {item.features.map((feature, fIdx) => (
                                                <div key={fIdx} className="flex items-center gap-4">
                                                    <div className={`w-2 h-[0.5px] transition-all duration-1000 ${isActive ? 'bg-accent' : 'bg-accent/10'}`} />
                                                    <span className={`text-[10px] uppercase tracking-[0.15em] font-light transition-all max-w-[calc(100%-24px)] break-words ${isActive ? 'text-foreground/80' : 'text-foreground/20'}`}>
                                                        {feature}
                                                    </span>
                                                </div>
                                            ))}
                                        </div>
                                        {isActive && <motion.div layoutId="support-active" className="absolute inset-0 bg-accent/[0.015]" />}
                                    </button>
                                );
                            })}
                        </div>
                    </div>

                    {/* Price Display */}
                    <div className="pt-24 border-t-[0.5px] border-accent/10 flex flex-col items-center gap-20 relative">
                        <div className="text-center">
                            <span className="text-[10px] uppercase tracking-[1em] text-foreground/30 block mb-10">EST. ASSET VALUE_</span>
                            <AnimatePresence mode="wait">
                                <motion.div
                                    key={totalPrice}
                                    initial={{ opacity: 0, y: 10 }}
                                    animate={{ opacity: 1, y: 0 }}
                                    transition={{ duration: 1 }}
                                    className="text-7xl md:text-9xl font-display font-extralight text-[#E5D5B0] tracking-tighter"
                                >
                                    ${totalPrice.toLocaleString()}
                                </motion.div>
                            </AnimatePresence>
                        </div>

                        <LuxuryButton
                            onClick={handleProceed}
                            height="h-[72px]"
                            className="max-w-lg"
                        >
                            INITIALIZE PROTOCOL
                        </LuxuryButton>
                    </div>
                </div>
            </div>

            <div className="absolute bottom-12 left-1/2 -translate-x-1/2 opacity-20 pointer-events-none w-full text-center">
                <span className="text-[9px] uppercase tracking-[1em] text-accent/60 font-light -mr-[1em]">PROPRIETARY ALGORITHMIC INVESTMENT ANALYSIS v8.7</span>
            </div>
        </section>
    );
};