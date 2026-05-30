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
      <div className="flex flex-col">






        <ProjectCalculator />


        <ContactForm />

        {/* Global Footer */}
      </div>
      <footer className="py-24 bg-[#020202] relative overflow-hidden border-t-[0.5px] border-accent/20">
        <div className="container mx-auto px-8 md:px-16 relative z-10 max-w-7xl">
          <div className="flex flex-col items-center">
            {/* Core Branding - Full Brillance */}
            <Link href="/" className="group mb-16 inline-block text-center">
              <div className="flex flex-col items-center gap-6">
                <WebistanSymbol className="w-14 h-7 opacity-100 transition-all duration-1000" />
                <div className="flex items-center tracking-[0.4em] uppercase font-display font-medium text-[24px] md:text-[36px] leading-none transition-all duration-1000 group-hover:tracking-[0.5em] -mr-[0.4em] group-hover:-mr-[0.5em]">
                  <span className="text-foreground">WEBISTAN</span>
                  <span className="text-accent font-bold">.LUXURY</span>
                </div>
              </div>
            </Link>

            {/* Strategic Tagline */}
            <div className="flex items-center gap-4 mb-24">
              <div className="h-[0.5px] w-8 bg-accent/30" />
              <span className="text-[10px] uppercase tracking-[1em] text-accent/60 font-display font-medium -mr-[1em]">
                {tCommon('footer.tagline')}
              </span>
              <div className="h-[0.5px] w-8 bg-accent/30" />
            </div>

            {/* Navigation - High Visibility */}
            <div className="flex flex-wrap justify-center gap-x-12 gap-y-4 mb-32">
              {[
                { name: tNav('services'), id: 'services' },
                { name: tNav('portfolio'), id: 'portfolio' },
                { name: tNav('calculator'), id: 'calculator' },
                { name: tNav('contact'), id: 'contact' }
              ].map(l => (
                <a key={l.id} href={`#${l.id}`} className="text-[11px] font-display font-medium uppercase tracking-[0.3em] text-foreground/40 hover:text-accent transition-all duration-700 italic -mr-[0.3em]">
                  {l.name}_
                </a>
              ))}
            </div>

            {/* Technical Metadata - Consolidated & Prominent */}
            <div className="w-full pt-24 border-t-[0.5px] border-accent/10 grid grid-cols-1 md:grid-cols-3 gap-10 items-center text-center">
              <div className="flex flex-col gap-1.5 md:text-left">
                <a href="mailto:info@webistan.luxury" className="text-[9px] font-display font-medium uppercase tracking-[0.15em] text-foreground/60 hover:text-accent transition-colors duration-700">info@webistan.luxury</a>
              </div>

              <div className="flex flex-col items-center gap-1.5">
                <span className="text-[9px] font-display font-bold uppercase tracking-[0.25em] text-foreground/80 leading-none whitespace-nowrap">
                  © 2026 <a href="https://webistan.luxury" target="_blank" rel="noopener noreferrer" className="hover:text-accent transition-colors duration-500 lowercase">webistan.luxury</a> • {tCommon('footer.rights')}
                </span>
              </div>

              <div className="flex flex-col gap-1.5 md:text-right">
                <p className="text-[9px] font-display font-medium uppercase tracking-[0.15em] text-foreground/60">{tCommon('footer.global_node')}</p>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </main>
  );
}
