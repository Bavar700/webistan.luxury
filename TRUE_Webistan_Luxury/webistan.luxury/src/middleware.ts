import createMiddleware from 'next-intl/middleware';

export default createMiddleware({
    // A list of all locales that are supported
    locales: ['en', 'ru', 'tj'],

    // Used when no locale matches
    defaultLocale: 'en',

    // Custom prefix for Tajik locale
    localePrefix: 'always'
});

export const config = {
    // Match all pathnames except for
    // - /api (API routes)
    // - /_next (Next.js internals)
    // - /_vercel (Vercel internals)
    // - all root files inside /public (e.g. /favicon.ico)
    matcher: ['/((?!api|_next|_vercel|.*\\..*).*)']
};
