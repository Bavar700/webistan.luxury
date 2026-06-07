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

      <HeroSection />
      
      <div className="flex flex-col space-y-[120px] pb-[120px]">
        <ProjectCalculator />
        <PortfolioSection />
        <ContactForm />
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
            <a href="mailto:info@webistan.luxury" className="text-[9px] font-display uppercase tracking-[0.15em] text-foreground/50 hover:text-accent transition-colors">info@webistan.luxury</a>
            <span className="text-[9px] font-display uppercase tracking-[0.15em] text-foreground/50">
              © 2026 <a href="https://webistan.luxury" target="_blank" rel="noopener noreferrer" className="hover:text-accent transition-colors lowercase">webistan.luxury</a>
            </span>
          </div>
        </div>
      </footer>
    </main>
  );
}
