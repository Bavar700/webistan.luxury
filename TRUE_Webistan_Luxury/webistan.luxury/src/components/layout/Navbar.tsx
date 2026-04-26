'use client';
import {
useState, useEffect 
}
from 'react';
import {
motion, AnimatePresence 
}
from 'framer-motion';
import {
useTranslations, useLocale 
}
from 'next-intl';
import {
Menu, X, Sun, Moon, ArrowRight 
}
from 'lucide-react';
import {
useTheme 
}
from '@/lib/ThemeProvider';
import {
WebistanSymbol 
}
from '@/components/ui/WebistanSymbol';
import Link from 'next/link';
export const Navbar = () => {
const tn = useTranslations('Navigation');
const locale = useLocale();
const [isOpen, setIsOpen] = useState(false);
const [scrolled, setScrolled] = useState(false);
const {
theme, toggleTheme 
}
= useTheme();
useEffect(() => {
const handleScroll = () => setScrolled(window.scrollY > 20);
window.addEventListener('scroll', handleScroll);
return () => window.removeEventListener('scroll', handleScroll);
}, []);
const navLinks = [ {
name: tn('portfolio'), href: '#portfolio' }, {
name: tn('calculator'), href: '#calculator' }, {
name: tn('contact'), href: '#contact' }, ];
return ( <nav className={`fixed top-0 w-full z-[100] transition-all duration-700 py-4 bg-header-bg/95 backdrop-blur-md shadow-lg border-b border-white/5`}>
<div className="container mx-auto px-6 max-w-7xl flex items-center justify-between box-border"> {

}
<Link href="/" className="relative z-[110] flex items-center gap-[2px] group brand-logo text-white">
<WebistanSymbol className="w-[20px] h-[10px] md:w-[24px] md:h-[12px] opacity-90 group-hover:opacity-100 transition-opacity duration-700" />
<div className="flex items-center tracking-[0.05em] uppercase font-display font-bold text-[14px] md:text-[16px] leading-none">
<span>&nbsp;</span>
<span className="hero-shimmer transition-all duration-700">WEBISTAN</span>
<span className="hero-shimmer">.LUXURY</span>
</div>
</Link> {

}
<div className="hidden lg:flex items-center gap-2"> {navLinks.map((link) => ( <a key={link.name
}
href={link.href
}
className="px-5 py-2 text-[11px] font-medium uppercase tracking-[0.3em] text-white/90 hover:text-accent transition-all duration-500" > {link.name
}
</a> ))
}
<div className="w-[0.5px] h-4 bg-accent mx-4" />
<button onClick={toggleTheme
}
className="p-2 text-accent hover:scale-110 transition-all duration-500" > {theme === 'dark' ? <Sun size={18
}
strokeWidth={2
}
className="text-accent" /> : <Moon size={17
}
strokeWidth={1.5
}
className="text-accent" />
}
</button> {

}
<div className="flex items-center gap-6 ml-8 px-6 py-2 relative group/lang"> {

}
<div className="absolute top-0 left-0 w-2 h-2 border-t-[1px] border-l-[1px] border-accent transition-colors duration-500" />
<div className="absolute top-0 right-0 w-2 h-2 border-t-[1px] border-r-[1px] border-accent transition-colors duration-500" />
<div className="absolute bottom-0 left-0 w-2 h-2 border-b-[1px] border-l-[1px] border-accent transition-colors duration-500" />
<div className="absolute bottom-0 right-0 w-2 h-2 border-b-[1px] border-r-[1px] border-accent transition-colors duration-500" /> {['EN', 'RU', 'TJ'].map((lang) => ( <Link key={lang
}
href={`/${lang.toLowerCase()}`
}
className={`text-[10px] font-bold uppercase tracking-[0.4em] transition-all duration-700 ${locale === lang.toLowerCase() ? 'text-accent' : 'text-white/80 hover:text-accent' }`
}
> {lang
}
</Link> ))
}
</div>
</div> {

}
<button onClick={() => setIsOpen(!isOpen)
}
className="lg:hidden p-2 text-foreground/60" > {isOpen ? <X size={20
}
/> : <Menu size={20
}
/>
}
</button>
</div> {

}
<AnimatePresence> {isOpen && ( <motion.div initial={{
opacity: 0, y: -20 }
}
animate={{
opacity: 1, y: 0 }
}
exit={{
opacity: 0, y: -20 }
}
className="fixed inset-0 bg-background z-[105] flex flex-col items-center justify-center lg:hidden" >
<div className="flex flex-col items-end gap-10 pr-12 w-full"> {navLinks.map((link, i) => ( <motion.a key={link.name
}
href={link.href
}
onClick={() => setIsOpen(false)
}
initial={{
opacity: 0, x: 20 }
}
animate={{
opacity: 1, x: 0 }
}
transition={{
delay: i * 0.1 }
}
className="text-2xl font-display font-light text-foreground/40 hover:text-accent tracking-[0.4em] uppercase" > {link.name
}
</motion.a> ))
}
{

}
<div className="flex items-center gap-8 mt-12 px-8 py-3 bg-accent/5 border border-accent/10 rounded-full backdrop-blur-sm"> {['EN', 'RU', 'TJ'].map((lang) => ( <Link key={lang
}
href={`/${lang.toLowerCase()}`
}
onClick={() => setIsOpen(false)
}
className={`text-[11px] font-light uppercase tracking-[0.3em] transition-all duration-500 ${locale === lang.toLowerCase() ? 'text-accent font-medium' : 'text-foreground/40 hover:text-accent' }`
}
> {lang
}
</Link> ))
}
</div>
</div>
</motion.div> )
}
</AnimatePresence> {

}
<motion.div initial={false
}
animate={{
opacity: scrolled ? 1 : 0, width: scrolled ? '100%' : '0%' }
}
transition={{
duration: 1.2, ease: [0.22, 1, 0.36, 1] }
}
className="absolute bottom-0 left-1/2 -translate-x-1/2 h-[0.5px] bg-gradient-to-r from-transparent via-accent/30 to-transparent" />
</nav> );
};
