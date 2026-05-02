import { setRequestLocale } from 'next-intl/server';

export function generateStaticParams() {
    return [{ locale: 'en' }, { locale: 'ru' }, { locale: 'tj' }];
}

export default async function Index({ params }: { params: Promise<{ locale: string }> }) {
    const { locale } = await params;
    setRequestLocale(locale);

    return (
        <div style={{ padding: '100px', textAlign: 'center', color: 'gold', background: 'black', minHeight: '100vh' }}>
            <h1>Webistan Luxury - {locale.toUpperCase()}</h1>
            <p>System Online. Localization Active.</p>
        </div>
    );
}
