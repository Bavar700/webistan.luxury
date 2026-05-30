import { HeroSection } from '@/components/layout/HeroSection';
import { ProjectCalculator } from '@/components/forms/ProjectCalculator';
import { Navbar } from '@/components/layout/Navbar';
import { ContactForm } from '@/components/forms/ContactForm';
import { ServicesSection } from '@/components/layout/ServicesSection';
import { PortfolioSection } from '@/components/layout/PortfolioSection';
import { WebistanSymbol } from '@/components/ui/WebistanSymbol';
import { setRequestLocale } from 'next-intl/server';
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

          <div className="container mx-auto px-6 max-w-7xl relative">
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16">
              {[
                { id: '01', status: 'ACTIVE', label: 'SWISS ARCHITECTURE', trait: 'Precision' },
                { id: '02', status: 'ENCRYPTED', label: 'GLOBAL INFRASTRUCTURE', trait: 'Security' },
                { id: '03', status: 'STABLE', label: 'ENTERPRISE STACK', trait: 'Performance' },
                { id: '04', status: 'SYNCED', label: 'CULTURAL ALIGNMENT', trait: 'Strategy' }
              ].map((item, idx) => (
                <div key={idx} className="relative group p-8 min-h-[180px] flex flex-col justify-center transition-all duration-1000">
                  {/* Architectural Hover Frame */}
                  <div className="absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-700 pointer-events-none">
                    <div className="absolute top-0 left-0 w-4 h-4 border-t-[0.5px] border-l-[0.5px] border-accent/20 group-hover:border-accent transition-all duration-700" />
                    <div className="absolute top-0 right-0 w-4 h-4 border-t-[0.5px] border-r-[0.5px] border-accent/20 group-hover:border-accent transition-all duration-700" />
                    <div className="absolute bottom-0 left-0 w-4 h-4 border-b-[0.5px] border-l-[0.5px] border-accent/20 group-hover:border-accent transition-all duration-700" />
                    <div className="absolute bottom-0 right-0 w-4 h-4 border-b-[0.5px] border-r-[0.5px] border-accent/20 group-hover:border-accent transition-all duration-700" />
                    <div className="absolute inset-0 bg-accent/[0.02]" />
                  </div>

                  <div className="relative z-10 space-y-6">
                    <div className="flex items-center gap-4">
                      <span className="text-[12px] font-display text-accent leading-none tracking-[0.2em] font-light">PROT {item.id}</span>
                      <div className="flex items-center gap-2">
                        <div className="w-1 h-1 bg-accent/60 animate-pulse" />
                        <span className="text-[10px] font-display text-accent/50 tracking-[0.1em]">{item.status}</span>
                      </div>
                    </div>

                    <div className="flex flex-col justify-center">
                      <h3 className="text-[15px] font-display font-light text-foreground/70 group-hover:text-[#E5D5B0] transition-all duration-700 tracking-[0.25em] uppercase -mr-[0.25em] leading-tight">
                        {item.label}
                      </h3>
                      <span className="text-[11px] font-display text-accent/30 uppercase tracking-[0.6em] mt-3 italic">{item.trait}</span>
                    </div>

                    <div className="w-full h-[1px] bg-accent/10 overflow-hidden">
                      <div className="w-1/3 h-full bg-accent/40 group-hover:w-full transition-all duration-1500 ease-out" />
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
      <footer className="py-[125px] bg-background relative overflow-hidden border-t-[0.5px] border-accent/10">
        <div className="container mx-auto px-6 text-center relative z-10 max-w-7xl">
          <Link href="/" className="inline-block mb-32 group brand-logo">
            <div className="flex flex-col items-center gap-4 p-8 border-[0.5px] border-accent/10 bg-white/[0.01] relative">
              <div className="absolute top-0 left-0 w-2 h-2 border-t-[0.5px] border-l-[0.5px] border-accent/30" />
              <div className="absolute bottom-0 right-0 w-2 h-2 border-b-[0.5px] border-r-[0.5px] border-accent/30" />

              <WebistanSymbol className="w-16 h-8 opacity-40 group-hover:opacity-80 transition-opacity duration-1000" />
              <div className="flex items-center tracking-[0.2em] uppercase font-display font-bold text-[24px] leading-none transition-all duration-1000 group-hover:tracking-[0.3em]">
                <span className="text-foreground">WEBISTAN</span>
                <span className="text-accent">.LUXURY</span>
              </div>
            </div>
          </Link>

          <div className="flex flex-col items-center gap-16 mb-32">
            <span className="text-[10px] uppercase tracking-[1.5em] text-accent/50 font-display font-extralight -mr-[1.5em]">SILENT POWER. REFINED LOGIC._</span>
            <div className="flex flex-wrap justify-center gap-x-16 gap-y-8">
              {['Services', 'Archive', 'Calculator', 'Contact'].map(l => (
                <a key={l} href={`#${l.toLowerCase()}`} className="text-[11px] font-display font-light uppercase tracking-[0.5em] text-foreground/20 hover:text-accent transition-all duration-1000 italic -mr-[0.5em]">
                  {l}
                </a>
              ))}
            </div>
          </div>

          <div className="max-w-4xl mx-auto pt-32 border-t-[0.5px] border-accent/10 grid grid-cols-1 md:grid-cols-3 gap-12 items-center text-center">
            <p className="text-[9px] font-display font-light uppercase tracking-[0.8em] text-foreground/20 -mr-[0.8em]">
              DUSHANBE / GLOBAL
            </p>
            <div className="w-1 h-1 bg-accent/20 mx-auto hidden md:block" />
            <p className="text-[9px] font-display font-light uppercase tracking-[0.4em] text-foreground/10 leading-relaxed -mr-[0.4em]">
              © 2026 WEBISTAN LUXURY • ALL RIGHTS RESERVED. BESPOKE DIGITAL CRAFTSMANSHIP.
            </p>
          </div>
        </div>
      </footer>
    </main>
  );
}
