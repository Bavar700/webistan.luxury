import { HeroSection } from '@/components/layout/HeroSection';
import { ProjectCalculator } from '@/components/forms/ProjectCalculator';
import { Navbar } from '@/components/layout/Navbar';
import { ContactForm } from '@/components/forms/ContactForm';
import { ServicesSection } from '@/components/layout/ServicesSection';
import { PortfolioSection } from '@/components/layout/PortfolioSection';
import { SplashScreen } from '@/components/ui/SplashScreen';
import { WebistanSymbol } from '@/components/ui/WebistanSymbol';
import { setRequestLocale, getTranslations } from 'next-intl/server';
import Link from 'next/link';

export function generateStaticParams() {
  return [{ locale: 'en' }, { locale: 'ru' }, { locale: 'tj' }];
}

export async function generateMetadata({ params }: { params: Promise<{ locale: string }> }) {
  const { locale } = await params;
  const t = await getTranslations({ locale, namespace: 'Index' });

  return {
    title: t('title'),
    description: t('hero.description'),
    metadataBase: new URL('https://webistan.luxury'),
    alternates: {
      canonical: `/${locale}`,
      languages: {
        'en-US': '/en',
        'ru-RU': '/ru',
        'tg-TJ': '/tj',
      },
    },
    openGraph: {
      title: t('title'),
      description: t('hero.description'),
      url: `https://webistan.luxury/${locale}`,
      siteName: 'Webistan Luxury',
      locale: locale === 'ru' ? 'ru_RU' : locale === 'tj' ? 'tg_TJ' : 'en_US',
      type: 'website',
    },
    twitter: {
      card: 'summary_large_image',
      title: t('title'),
      description: t('hero.description'),
    },
  };
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
      {/* Splash screen — shown only on first load, fades out automatically */}
      <SplashScreen />

      <Navbar />

      <HeroSection />

      <div className="flex flex-col px-6 mb-[120px] gap-[120px]">
        <ProjectCalculator />

        <div className="relative group/block max-w-[1600px] mx-auto w-full py-[60px]">
          <PortfolioSection />
        </div>

        <div className="relative group/block max-w-[1600px] mx-auto w-full">
          <ContactForm />
        </div>
      </div>

      <footer className="py-6 border-t-[0.5px] border-accent/20 bg-[#000000] backdrop-blur-md">
        <div className="container mx-auto px-6 min-[1200px]:px-0 max-w-6xl flex flex-col md:flex-row justify-between items-center gap-4">
          <Link href="/" className="flex items-center gap-2 group">
            <WebistanSymbol className="w-4 h-2 opacity-80 group-hover:opacity-100 transition-opacity" />
            <div className="text-[10px] md:text-[11px] tracking-[0.2em] font-display font-medium uppercase text-foreground/80 group-hover:text-foreground transition-colors">
              <span className="hero-shimmer">WEBISTAN<span className="text-accent">.LUXURY</span></span>
            </div>
          </Link>

          <div className="flex flex-col md:flex-row items-center gap-3 md:gap-8">
            <span className="text-[11px] font-display uppercase tracking-[0.15em] text-white/50">
              © 2026{' '}
              <a
                href="https://webistan.luxury"
                target="_blank"
                rel="noopener noreferrer"
                className="hover:text-accent transition-colors lowercase"
              >
                webistan.luxury
              </a>
            </span>
            <span className="text-[9px] font-display uppercase tracking-[0.2em] text-white/20">v2.1</span>
          </div>
        </div>
      </footer>
    </main>
  );
}
