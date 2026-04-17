'use client';

import { useState, useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { useTranslations, useLocale } from 'next-intl';
import { Menu, X, Sun, Moon, ArrowRight } from 'lucide-react';
import { useTheme } from '@/lib/ThemeProvider';
import { WebistanSymbol } from '@/components/ui/WebistanSymbol';
import Link from 'next/link';

export const Navbar = () => {
    const tn = useTranslations('Navigation');
    const locale = useLocale();
    const [isOpen, setIsOpen] = useState(false);
    const [scrolled, setScrolled] = useState(false);
    const { theme, toggleTheme } = useTheme();

    useEffect(() => {
        const handleScroll = () => setScrolled(window.scrollY > 20);
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    const navLinks = [
        { name: tn('services'), href: '#services' },
        { name: tn('portfolio'), href: '#portfolio' },
        { name: tn('calculator'), href: '#calculator' },
        { name: tn('contact'), href: '#contact' },
    ];

    return (
        <nav className={`fixed top-0 w-full z-[100] transition-all duration-700 ${scrolled ? 'py-4 bg-background/80 backdrop-blur-xl' : 'py-8'}`}>
            <div className="container mx-auto px-6 max-w-7xl flex items-center justify-between box-border">

                {/* Logo - Restored Branding Style */}
                <Link href="/" className="relative z-[110] flex items-center gap-[2px] group brand-logo text-foreground">
                    <WebistanSymbol className="w-[30px] h-[15px] opacity-90 group-hover:opacity-100 transition-opacity duration-700" />

                    <div className="flex items-center tracking-[0.05em] uppercase font-display font-bold text-[18px] leading-none">
                        <span>&nbsp;</span>
                        <span className="text-foreground transition-all duration-700">WEBISTAN</span>
                        <span className="text-accent">.LUXURY</span>
                    </div>
                </Link>

                {/* Desktop Nav */}
                <div className="hidden lg:flex items-center gap-2">
                    {navLinks.map((link) => (
                        <a
                            key={link.name}
                            href={link.href}
                            className="px-5 py-2 text-[10px] font-light uppercase tracking-[0.3em] text-foreground/40 hover:text-accent transition-all duration-500"
                        >
                            {link.name}
                        </a>
                    ))}

                    <div className="w-[0.5px] h-4 bg-accent/20 mx-4" />

                    <button
                        onClick={toggleTheme}
                        className="p-2 text-accent/60 hover:text-accent transition-colors duration-500"
                    >
                        {theme === 'dark' ? <Sun size={15} strokeWidth={1.5} className="text-accent" /> : <Moon size={14} strokeWidth={1} />}
                    </button>

                    {/* Language Switcher - Precision Box */}
                    <div className="flex items-center gap-6 ml-8 px-6 py-2 bg-accent/[0.03] relative group/lang">
                        {/* Precision Corners */}
                        <div className="absolute top-0 left-0 w-2 h-2 border-t-[0.5px] border-l-[0.5px] border-accent/20 transition-colors duration-500 group-hover/lang:border-accent/40" />
                        <div className="absolute top-0 right-0 w-2 h-2 border-t-[0.5px] border-r-[0.5px] border-accent/20 transition-colors duration-500 group-hover/lang:border-accent/40" />
                        <div className="absolute bottom-0 left-0 w-2 h-2 border-b-[0.5px] border-l-[0.5px] border-accent/20 transition-colors duration-500 group-hover/lang:border-accent/40" />
                        <div className="absolute bottom-0 right-0 w-2 h-2 border-b-[0.5px] border-r-[0.5px] border-accent/20 transition-colors duration-500 group-hover/lang:border-accent/40" />

                        {['EN', 'RU', 'TJ'].map((lang) => (
                            <Link
                                key={lang}
                                href={`/${lang.toLowerCase()}`}
                                className={`text-[8px] font-light uppercase tracking-[0.4em] transition-all duration-700 ${locale === lang.toLowerCase() ? 'text-accent' : 'text-foreground/20 hover:text-accent'
                                    }`}
                            >
                                {lang}
                            </Link>
                        ))}
                    </div>
                </div>

                {/* Mobile Toggle */}
                <button
                    onClick={() => setIsOpen(!isOpen)}
                    className="lg:hidden p-2 text-foreground/60"
                >
                    {isOpen ? <X size={20} /> : <Menu size={20} />}
                </button>
            </div>

            {/* Mobile Menu Overlay */}
            <AnimatePresence>
                {isOpen && (
                    <motion.div
                        initial={{ opacity: 0, y: -20 }}
                        animate={{ opacity: 1, y: 0 }}
                        exit={{ opacity: 0, y: -20 }}
                        className="fixed inset-0 bg-background z-[105] flex flex-col items-center justify-center lg:hidden"
                    >
                        <div className="flex flex-col items-end gap-10 pr-12 w-full">
                            {navLinks.map((link, i) => (
                                <motion.a
                                    key={link.name}
                                    href={link.href}
                                    onClick={() => setIsOpen(false)}
                                    initial={{ opacity: 0, x: 20 }}
                                    animate={{ opacity: 1, x: 0 }}
                                    transition={{ delay: i * 0.1 }}
                                    className="text-2xl font-display font-light text-foreground/40 hover:text-accent tracking-[0.4em] uppercase"
                                >
                                    {link.name}
                                </motion.a>
                            ))}
                            {/* Mobile Language Switchers - Oval Niche */}
                            <div className="flex items-center gap-8 mt-12 px-8 py-3 bg-accent/5 border border-accent/10 rounded-full backdrop-blur-sm">
                                {['EN', 'RU', 'TJ'].map((lang) => (
                                    <Link
                                        key={lang}
                                        href={`/${lang.toLowerCase()}`}
                                        onClick={() => setIsOpen(false)}
                                        className={`text-[11px] font-light uppercase tracking-[0.3em] transition-all duration-500 ${locale === lang.toLowerCase() ? 'text-accent font-medium' : 'text-foreground/40 hover:text-accent'
                                            }`}
                                    >
                                        {lang}
                                    </Link>
                                ))}
                            </div>
                        </div>
                    </motion.div>
                )}
            </AnimatePresence>

            {/* Exquisite Scroll Line */}
            <motion.div
                initial={false}
                animate={{
                    opacity: scrolled ? 1 : 0,
                    width: scrolled ? '100%' : '0%'
                }}
                transition={{ duration: 1.2, ease: [0.22, 1, 0.36, 1] }}
                className="absolute bottom-0 left-1/2 -translate-x-1/2 h-[0.5px] bg-gradient-to-r from-transparent via-accent/30 to-transparent"
            />
        </nav>
    );
};
