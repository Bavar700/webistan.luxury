import { Inter, Cormorant_Garamond } from 'next/font/google';

const inter = Inter({
    subsets: ['latin', 'cyrillic'], // Важно для таджикского и русского
    variable: '--font-inter'
});

const cormorant = Cormorant_Garamond({
    subsets: ['latin', 'cyrillic'],
    weight: ['300', '400', '500', '600', '700'],
    variable: '--font-cormorant'
});

export default function RootLayout({
    children,
}: {
    children: React.ReactNode;
}) {
    return children;
}
