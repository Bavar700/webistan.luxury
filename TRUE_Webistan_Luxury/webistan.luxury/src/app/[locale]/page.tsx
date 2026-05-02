import { HeroSection } from '@/components/layout/HeroSection';
import { ProjectCalculator } from '@/components/forms/ProjectCalculator';
import { Navbar } from '@/components/layout/Navbar';
import { ContactForm } from '@/components/forms/ContactForm';
import { ServicesSection } from '@/components/layout/ServicesSection';
import { PortfolioSection } from '@/components/layout/PortfolioSection';
import { WebistanSymbol } from '@/components/ui/WebistanSymbol';
import { setRequestLocale, getTranslations } from 'next-intl/server';
import Link from 'next/link';

export function generateStaticParams() {
  return [{ locale: 'en' }, { locale: 'ru' }, { locale: 'tj' }];
}
export default async function Index({
  params
}: {
  params: Promise<{ locale: string }>;
}) {
  const { locale } = await params;
  setRequestLocale(locale);
const tTrust = await getTranslations('Trust');
const tNav = await getTranslations('Navigation');
const tCommon = await getTranslations('Common');

  return (
    <main className="relative flex flex-col bg-background selection:bg-accent/10 selection:text-foreground">
      <Navbar />

      <HeroSection id="home" />
      
      {/* 120px gap is maintained by Hero's pb-[120px] */}
      <div className="flex flex-col px-6 md:px-12 lg:px-20 mb-[120px] gap-[120px]">
        {/* Calculator Block */}
        <ProjectCalculator />
        
        {/* Portfolio Block with Accent Corners */}
        <div className="relative group/block max-w-[1600px] mx-auto w-full py-[60px]">
          <PortfolioSection />
        </div>

        {/* Contact Block with Accent Corners */}
        <div className="relative group/block max-w-[1600px] mx-auto w-full">
          <div className="absolute top-0 left-0 w-8 h-8 border-t-[0.5px] border-l-[0.5px] border-accent/30 group-hover/block:border-accent group-hover/block:w-12 group-hover/block:h-12 transition-all duration-700" />
          <div className="absolute top-0 right-0 w-8 h-8 border-t-[0.5px] border-r-[0.5px] border-accent/30 group-hover/block:border-accent group-hover/block:w-12 group-hover/block:h-12 transition-all duration-700" />
          <div className="absolute bottom-0 left-0 w-8 h-8 border-b-[0.5px] border-l-[0.5px] border-accent/30 group-hover/block:border-accent group-hover/block:w-12 group-hover/block:h-12 transition-all duration-700" />
          <div className="absolute bottom-0 right-0 w-8 h-8 border-b-[0.5px] border-r-[0.5px] border-accent/30 group-hover/block:border-accent group-hover/block:w-12 group-hover/block:h-12 transition-all duration-700" />
          
          <ContactForm />
        </div>
      </div>

      {/* Ultra Minimal, Compact Footer */}
      <footer className="py-6 border-t-[0.5px] border-accent/20 bg-[#020202]/50 backdrop-blur-md">
        <div className="container mx-auto px-6 max-w-7xl flex flex-col md:flex-row justify-between items-center gap-4">
          <Link href="/" className="flex items-center gap-2 group">
            <WebistanSymbol className="w-4 h-2 opacity-80 group-hover:opacity-100 transition-opacity" />
            <div className="text-[10px] md:text-[11px] tracking-[0.2em] font-display font-medium uppercase text-foreground/80 group-hover:text-foreground transition-colors">
              WEBISTAN<span className="text-accent">.LUXURY</span>
            </div>
          </Link>

          <div className="flex flex-col md:flex-row items-center gap-3 md:gap-8">
            <span className="text-[11px] font-display uppercase tracking-[0.15em] text-foreground/50">
              © 2026 <a href="https://webistan.luxury" target="_blank" rel="noopener noreferrer" className="hover:text-accent transition-colors lowercase">webistan.luxury</a>
            </span>
          </div>
        </div>
      </footer>
    </main>
  );
}
