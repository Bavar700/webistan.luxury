'use client';

import { motion } from 'framer-motion';
import { useTranslations } from 'next-intl';
import { Cpu, Globe, Layout, Zap, ArrowUpRight, ShoppingCart } from 'lucide-react';

export const ServicesSection = () => {
    const t = useTranslations('Services');

    const services = [
        { key: 'web3', icon: Globe, color: 'from-accent/5' },
        { key: 'ai', icon: Cpu, color: 'from-accent/5' },
        { key: 'identity', icon: Layout, color: 'from-accent/5' },
        { key: 'perf', icon: Zap, color: 'from-accent/5' }
    ];

    const containerVariants = {
        hidden: { opacity: 0 },
        visible: {
            opacity: 1,
            transition: { staggerChildren: 0.2 }
        }
    };

    const cardVariants = {
        hidden: { opacity: 0, y: 30 },
        visible: {
            opacity: 1,
            y: 0,
            transition: { duration: 1.5, ease: [0.16, 1, 0.3, 1] as const }
        }
    };

    return (
        <section id="services" className="py-[125px] bg-background relative overflow-hidden">
            <div className="container mx-auto px-6 relative z-10 max-w-7xl">
                <div className="max-w-4xl mx-auto text-center mb-24 flex flex-col items-center">
                    {/* Architectural Cascade Title */}
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 1.5 }}
                        className="flex flex-col items-center gap-8"
                    >
                        <span className="text-sm md:text-lg font-display font-extralight tracking-[1.05em] text-foreground/40 uppercase block leading-none -mr-[1.05em]">
                            THE EXPERTISE
                        </span>

                        <span className="text-3xl md:text-6xl uppercase tracking-[0.4em] text-[#E5D5B0]/70 font-light leading-none -mr-[0.4em]">
                            DIGITAL
                        </span>

                        <div className="flex flex-col items-center">
                            <h2 className="text-5xl md:text-8xl font-display font-bold tracking-[0.1em] leading-none uppercase -mr-[0.1em]">
                                <span className="bg-gradient-to-r from-[#C0A080] via-[#FFF5E6] via-[#FFD700] via-[#FFF5E6] to-[#C0A080] bg-[length:200%_auto] bg-clip-text text-transparent animate-shimmer inline-block pb-4">
                                    SOLUTIONS
                                </span>
                            </h2>
                            <div className="w-64 h-[0.5px] bg-gradient-to-r from-transparent via-accent/40 to-transparent mt-4" />
                        </div>
                    </motion.div>
                </div>

                <motion.div
                    variants={containerVariants}
                    initial="hidden"
                    whileInView="visible"
                    viewport={{ once: true, amount: 0.1 }}
                    className="grid grid-cols-1 md:grid-cols-2 gap-[100px] max-w-6xl mx-auto"
                >
                    {[
                        { title: 'HIGH-CONVERSION NODES', desc: 'Surgical design focused on singular objective completion.', icon: Layout },
                        { title: 'DIGITAL HEADQUARTERS', desc: 'Fundamental infrastructure for global enterprise presence.', icon: Globe },
                        { title: 'REVENUE ENGINES', desc: 'Complex transactional systems built for scale and speed.', icon: ShoppingCart },
                        { title: 'ENTERPRISE ECOSYSTEMS', desc: 'Unified digital environments for intensive operational flow.', icon: Cpu }
                    ].map((s, i) => (
                        <motion.div
                            key={i}
                            variants={cardVariants}
                            className="group relative bg-background p-16 hover:bg-white/[0.01] transition-all duration-1000 overflow-hidden"
                        >
                            {/* Glass Shine effect */}
                            <div className="absolute inset-0 w-full h-full bg-gradient-to-br from-transparent via-accent/[0.03] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1500 ease-in-out" />

                            {/* Precision Markers - All four corners */}
                            <div className="absolute top-0 left-0 w-4 h-4 border-t-[0.5px] border-l-[0.5px] border-accent/20 group-hover:border-accent/40 transition-colors" />
                            <div className="absolute top-0 right-0 w-4 h-4 border-t-[0.5px] border-r-[0.5px] border-accent/20 group-hover:border-accent/40 transition-colors" />
                            <div className="absolute bottom-0 left-0 w-4 h-4 border-b-[0.5px] border-l-[0.5px] border-accent/20 group-hover:border-accent/40 transition-colors" />
                            <div className="absolute bottom-0 right-0 w-4 h-4 border-b-[0.5px] border-r-[0.5px] border-accent/20 group-hover:border-accent/40 transition-colors" />

                            <div className="relative z-10 flex justify-between items-start mb-24">
                                <div className="p-4 relative bg-white/[0.01]">
                                    <s.icon size={22} strokeWidth={1} className="text-accent/60 group-hover:text-accent transition-colors duration-700" />
                                </div>
                                <div className="w-10 h-10 relative flex items-center justify-center text-foreground/20 group-hover:text-accent group-hover:bg-accent/[0.03] transition-all duration-1000">
                                    <ArrowUpRight size={14} strokeWidth={1} />
                                </div>
                            </div>

                            <div className="relative z-10 text-center flex flex-col items-center">
                                <div className="space-y-4 w-full">
                                    <span className="text-[10px] font-display uppercase tracking-[0.6em] text-accent/40 block italic -mr-[0.6em]">Layer 0{i + 1}</span>
                                    <h3 className="text-xl md:text-2xl font-display font-light group-hover:text-accent transition-all duration-1000 tracking-[0.15em] uppercase leading-none whitespace-nowrap overflow-hidden text-ellipsis">
                                        {s.title}
                                    </h3>
                                </div>
                                <p className="font-sans text-base text-foreground/30 leading-relaxed font-light mt-8 max-w-sm italic">
                                    {s.desc}
                                </p>
                            </div>
                        </motion.div>
                    ))}
                </motion.div>
            </div>

            <div className="absolute bottom-12 left-1/2 -translate-x-1/2 opacity-20 pointer-events-none w-full text-center">
                <span className="text-[9px] uppercase tracking-[1em] text-accent/60 font-light -mr-[1em]">Strategic Architecture Layer</span>
            </div>
        </section>
    );
};
