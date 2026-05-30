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
return ( <> <nav className={`fixed top-0 w-full z-[100] transition-all duration-700 py-4 bg-[#000000] backdrop-blur-md shadow-lg border-b border-white/5`}>
<div className="container mx-auto px-6 max-w-7xl flex items-center justify-between box-border"> {

}
<Link href="/" className="relative z-[110] flex items-center gap-[2px] group brand-logo text-[#F1F1F3]">
<WebistanSymbol className="w-[20px] h-[10px] md:w-[24px] md:h-[12px] opacity-90 group-hover:opacity-100 transition-opacity duration-700" />
<div className="flex items-center tracking-[0.05em] uppercase font-display font-bold text-[14px] md:text-[16px] leading-none">
<span>&nbsp;</span>
<span className="text-[#F1F1F3] transition-all duration-700">WEBISTAN</span>
<span className="hero-shimmer">.LUXURY</span>
</div>
</Link>
      <div className="hidden lg:flex items-center gap-2"> {navLinks.map((link) => ( <a key={link.name
}
href={link.href
}
className="px-5 py-2 text-[11px] font-medium uppercase tracking-[0.3em] text-[#F1F1F3]/90 hover:text-accent transition-all duration-500" > {link.name
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
</button>
<div className="flex items-center gap-6 ml-8 px-6 py-2 relative group/lang bg-[#000000]">
<div className="absolute top-0 left-0 w-2 h-2 border-t-[0.5px] border-l-[0.5px] border-accent/30 group-hover/lang:border-accent group-hover/lang:w-3 group-hover/lang:h-3 transition-all duration-700" />
<div className="absolute top-0 right-0 w-2 h-2 border-t-[0.5px] border-r-[0.5px] border-accent/30 group-hover/lang:border-accent group-hover/lang:w-3 group-hover/lang:h-3 transition-all duration-700" />
<div className="absolute bottom-0 left-0 w-2 h-2 border-b-[0.5px] border-l-[0.5px] border-accent/30 group-hover/lang:border-accent group-hover/lang:w-3 group-hover/lang:h-3 transition-all duration-700" />
<div className="absolute bottom-0 right-0 w-2 h-2 border-b-[0.5px] border-r-[0.5px] border-accent/30 group-hover/lang:border-accent group-hover/lang:w-3 group-hover/lang:h-3 transition-all duration-700" /> {['EN', 'RU', 'TJ'].map((lang) => ( <Link key={lang
}
href={`/${lang.toLowerCase()}`
}
className={`text-[10px] font-bold uppercase tracking-[0.4em] transition-all duration-700 ${locale === lang.toLowerCase() ? 'text-accent' : 'text-[#F1F1F3]/40 hover:text-accent' }`
}
> {lang
}
</Link> ))
}
</div>
</div>
<button onClick={() => setIsOpen(!isOpen)
}
className="lg:hidden p-2 text-[#F1F1F3]/60" > {isOpen ? <X size={20
}
/> : <Menu size={20
}
/>
}
</button>
</div> {

}
<motion.div initial={false} animate={{ opacity: scrolled ? 1 : 0, width: scrolled ? '100%' : '0%' }} transition={{ duration: 1.2, ease: [0.22, 1, 0.36, 1] }} className="absolute bottom-0 left-1/2 -translate-x-1/2 h-[0.5px] bg-gradient-to-r from-transparent via-accent/30 to-transparent" />
</nav>

<AnimatePresence> {isOpen && ( <motion.div initial={{
opacity: 0, y: -20 }
}
animate={{
opacity: 1, y: 0 }
}
exit={{
opacity: 0, y: -20 }
}
className="fixed top-[72px] right-0 bottom-0 left-0 bg-background z-[95] flex flex-col items-center justify-start pt-16 lg:hidden shadow-2xl border-t border-accent/10" >
<div className="flex flex-col items-center gap-8 w-full px-6"> {navLinks.map((link, i) => ( <motion.a key={link.name
}
href={link.href
}
onClick={() => setIsOpen(false)
}
initial={{
opacity: 0, y: 10 }
}
animate={{
opacity: 1, y: 0 }
}
transition={{
delay: i * 0.1 }
}
className="text-2xl font-display font-medium text-foreground/70 hover:text-accent tracking-[0.4em] uppercase text-center" > {link.name
}
</motion.a> ))
}
              <div className="flex flex-col items-center gap-6 mt-8">
                <div className="flex items-center gap-4 px-6 py-3 bg-btn-bg border border-accent/20 rounded-sm">
                  {['EN', 'RU', 'TJ'].map((lang) => (
                    <Link
                      key={lang}
                      href={`/${lang.toLowerCase()}`}
                      onClick={() => setIsOpen(false)}
                      className={`text-[11px] font-bold uppercase tracking-[0.3em] transition-all duration-500 ${
                        locale === lang.toLowerCase() ? 'text-accent' : 'text-foreground/50 hover:text-accent'
                      }`}
                    >
                      {lang}
                    </Link>
                  ))}
                </div>

                {/* Theme Toggle for Mobile */}
                <button 
                  onClick={() => {
                    toggleTheme();
                    setIsOpen(false);
                  }}
                  className="flex items-center justify-center gap-3 px-8 py-3 border border-accent/20 text-accent hover:bg-accent/5 transition-all duration-500 rounded-sm"
                >
                  {theme === 'dark' ? <Sun size={16} /> : <Moon size={16} />}
                  <span className="text-[10px] uppercase tracking-[0.3em] font-medium">{theme === 'dark' ? 'Light Mode' : 'Dark Mode'}</span>
                </button>
              </div>
</div>
</motion.div> )
}
</AnimatePresence> 
</> );
};
