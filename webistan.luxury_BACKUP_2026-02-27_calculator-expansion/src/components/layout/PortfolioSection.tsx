'use client';

import { motion } from 'framer-motion';

export const PortfolioSection = () => {
    return (
        <section id="portfolio" className="py-[125px] bg-background relative overflow-hidden">
            <div className="container mx-auto px-6 max-w-7xl relative z-10">
                <div className="max-w-4xl mx-auto text-center mb-24 flex flex-col items-center">
                    {/* Architectural Cascade Title */}
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 1.5 }}
                        className="flex flex-col items-center gap-8"
                    >
                        <span className="text-sm md:text-lg font-display font-medium tracking-[1.1em] text-foreground/70 uppercase block leading-none -mr-[1.1em]">
                            THE SELECTION
                        </span>

                        <span className="text-3xl md:text-6xl uppercase tracking-[0.4em] text-[#E5D5B0]/70 font-light leading-none -mr-[0.4em]">
                            FUTURE
                        </span>

                        <div className="flex flex-col items-center">
                            <h2 className="text-5xl md:text-8xl font-display font-bold tracking-[0.1em] leading-none uppercase -mr-[0.1em]">
                                <span className="bg-gradient-to-r from-[#C0A080] via-[#FFF5E6] via-[#FFD700] via-[#FFF5E6] to-[#C0A080] bg-[length:200%_auto] bg-clip-text text-transparent animate-shimmer inline-block pb-4">
                                    LEGACIES
                                </span>
                            </h2>
                            <div className="w-64 h-[0.5px] bg-gradient-to-r from-transparent via-accent/40 to-transparent mt-4" />
                        </div>
                    </motion.div>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
                    {[
                        { title: 'YOUR VISION', desc: 'Secure the foundation of our first flagship production cycle.' },
                        { title: 'RESERVED SLOT', desc: 'Accepting a limited number of foundation partners this quarter.' }
                    ].map((s, i) => (
                        <motion.div
                            key={i}
                            initial={{ opacity: 0, y: 30 }}
                            whileInView={{ opacity: 1, y: 0 }}
                            viewport={{ once: true }}
                            transition={{ duration: 1.5, delay: i * 0.2 }}
                            className="group relative bg-white/[0.01] p-16 hover:bg-white/[0.02] transition-all duration-1000 overflow-hidden"
                        >
                            {/* Glass Shine effect */}
                            <div className="absolute inset-0 w-full h-full bg-gradient-to-br from-transparent via-accent/[0.03] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1500 ease-in-out" />

                            {/* Precision Markers - All four corners */}
                            <div className="absolute top-0 left-0 w-8 h-8 border-t-[0.5px] border-l-[0.5px] border-accent/10 group-hover:border-accent group-hover:w-12 group-hover:h-12 transition-all duration-1000" />
                            <div className="absolute top-0 right-0 w-8 h-8 border-t-[0.5px] border-r-[0.5px] border-accent/10 group-hover:border-accent group-hover:w-12 group-hover:h-12 transition-all duration-1000" />
                            <div className="absolute bottom-0 left-0 w-8 h-8 border-b-[0.5px] border-l-[0.5px] border-accent/10 group-hover:border-accent group-hover:w-12 group-hover:h-12 transition-all duration-1000" />
                            <div className="absolute bottom-0 right-0 w-8 h-8 border-b-[0.5px] border-r-[0.5px] border-accent/10 group-hover:border-accent group-hover:w-12 group-hover:h-12 transition-all duration-1000" />

                            <div className="relative z-10 text-center flex flex-col items-center">
                                <div className="space-y-4 w-full">
                                    <span className="text-[10px] font-display uppercase tracking-[0.6em] text-accent/80 block italic -mr-[0.6em] font-bold animate-pulse">Protocol 0{i + 1}</span>
                                    <h3 className="text-xl md:text-3xl font-display font-light group-hover:text-[#E5D5B0] transition-all duration-1000 tracking-[0.2em] uppercase leading-none">
                                        {s.title}
                                    </h3>
                                </div>
                                <p className="font-sans text-base text-foreground/30 leading-relaxed font-light mt-8 max-w-sm italic">
                                    {s.desc}
                                </p>
                            </div>
                        </motion.div>
                    ))}
                </div>
            </div>

            <div className="absolute bottom-12 left-1/2 -translate-x-1/2 opacity-60 pointer-events-none w-full text-center">
                <span className="text-[10px] uppercase tracking-[1.25em] text-accent/80 font-bold -mr-[1.25em]">GENESIS PRODUCTION PROTOCOL_TX-90</span>
            </div>
        </section>
    );
};
