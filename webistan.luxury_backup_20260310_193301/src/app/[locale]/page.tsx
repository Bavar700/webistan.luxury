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

        <HeroSection />

        {/* Trust Line - Strategic Neural Alignment */}
        <section className="py-[125px] relative overflow-hidden bg-white/[0.01]">
          {/* Architectural Infrastructure Grid */}
          <div className="absolute inset-x-0 top-0 h-[0.5px] bg-gradient-to-r from-transparent via-accent/30 to-transparent" />
          <div className="absolute inset-x-0 bottom-0 h-[0.5px] bg-gradient-to-r from-transparent via-accent/30 to-transparent" />

          <div className="absolute inset-0 opacity-[0.05] pointer-events-none"
            style={{ backgroundImage: 'radial-gradient(circle at 2px 2px, #C0A080 1px, transparent 0)', backgroundSize: '60px 60px' }} />

          <div className="container mx-auto px-6 max-w-[1600px] relative">
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
              {[
                { id: '01', status: tTrust('status.active'), label: tTrust('s01.label'), trait: tTrust('s01.trait') },
                { id: '02', status: tTrust('status.encrypted'), label: tTrust('s02.label'), trait: tTrust('s02.trait') },
                { id: '03', status: tTrust('status.stable'), label: tTrust('s03.label'), trait: tTrust('s03.trait') },
                { id: '04', status: tTrust('status.synced'), label: tTrust('s04.label'), trait: tTrust('s04.trait') }
              ].map((item, idx) => (
                <div key={idx} className="relative group p-8 h-[240px] flex flex-col justify-between transition-all duration-1000">
                  {/* Architectural Hover Frame */}
                  <div className="absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-700 pointer-events-none">
                    <div className="absolute top-0 left-0 w-4 h-4 border-t-[0.5px] border-l-[0.5px] border-accent/20 group-hover:border-accent transition-all duration-700" />
                    <div className="absolute top-0 right-0 w-4 h-4 border-t-[0.5px] border-r-[0.5px] border-accent/20 group-hover:border-accent transition-all duration-700" />
                    <div className="absolute bottom-0 left-0 w-4 h-4 border-b-[0.5px] border-l-[0.5px] border-accent/20 group-hover:border-accent transition-all duration-700" />
                    <div className="absolute bottom-0 right-0 w-4 h-4 border-b-[0.5px] border-r-[0.5px] border-accent/20 group-hover:border-accent transition-all duration-700" />
                    <div className="absolute inset-0 bg-accent/[0.02]" />
                  </div>

                  <div className="relative z-10 h-full flex flex-col justify-between">
                    {/* Line 1: Header */}
                    <div className="flex items-center gap-4">
                      <span className="text-[10px] md:text-[12px] font-display text-accent leading-none tracking-[0.2em] font-light">{tTrust('prot')} {item.id}</span>
                      <div className="flex items-center gap-2">
                        <div className="w-1 h-1 bg-accent/60 animate-pulse" />
                        <span className="text-[10px] font-display text-accent/50 tracking-[0.1em]">{item.status}</span>
                      </div>
                    </div>

                    {/* Line 2: Body */}
                    <h3 className="text-[14px] md:text-[15px] font-display font-light text-foreground/70 group-hover:text-[#E5D5B0] transition-all duration-700 tracking-[0.1em] uppercase -mr-[0.1em] leading-snug whitespace-pre-line">
                      {item.label}
                    </h3>

                    {/* Lines 3 & 4: Protocol ID */}
                    <div className="space-y-1">
                      <div className="w-full h-[0.5px] bg-accent/10 overflow-hidden mb-3">
                        <div className="w-1/3 h-full bg-accent/40 group-hover:w-full transition-all duration-1500 ease-out" />
                      </div>
                      <>
                        <span className="text-[9px] font-display uppercase tracking-[0.3em] text-accent/80 block italic font-bold">{tTrust('protocol_label_1')}</span>
                        <span className="text-[9px] font-display uppercase tracking-[0.3em] text-accent/80 block italic font-bold animate-pulse">{tTrust('protocol_label_2')}{item.id}</span>
                      </>
                    </div>
                  </div>
                </div>
              ))}
            </div>

            {/* Corner Precision Markers */}
            <div className="absolute -top-12 -left-4 w-12 h-12 border-t-[0.5px] border-l-[0.5px] border-accent/20 group-hover:border-accent transition-colors duration-1000" />
            <div className="absolute -bottom-12 -right-4 w-12 h-12 border-b-[0.5px] border-r-[0.5px] border-accent/20 group-hover:border-accent transition-colors duration-1000" />
          </div>
        </section>

        <ServicesSection />

        <ProjectCalculator />

        <PortfolioSection />

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
                <span className="text-[8px] font-display font-bold uppercase tracking-[0.5em] text-accent/80 italic">{tCommon('footer.correspondence')}_</span>
                <p className="text-[9px] font-display font-medium uppercase tracking-[0.15em] text-foreground/60 hover:text-accent transition-colors duration-700">info@webistan.luxury</p>
              </div>

              <div className="flex flex-col items-center gap-1.5">
                <span className="text-[9px] font-display font-bold uppercase tracking-[0.25em] text-foreground/80 leading-none whitespace-nowrap">
                  © 2026 WEBISTAN LUXURY • {tCommon('footer.rights')}
                </span>
                <span className="text-[9px] font-display font-black uppercase tracking-[0.25em] text-accent/80 leading-none whitespace-nowrap">
                  {tCommon('footer.slogan')}_v8.8
                </span>
              </div>

              <div className="flex flex-col gap-1.5 md:text-right">
                <span className="text-[8px] font-display font-bold uppercase tracking-[0.5em] text-accent/80 italic">{tCommon('footer.headquarters')}_</span>
                <p className="text-[9px] font-display font-medium uppercase tracking-[0.15em] text-foreground/60">{tCommon('footer.global_node')}</p>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </main>
  );
}
