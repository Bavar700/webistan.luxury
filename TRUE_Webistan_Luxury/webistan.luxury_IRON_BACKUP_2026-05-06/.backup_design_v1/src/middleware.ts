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
    // Match only internationalized pathnames
    matcher: ['/', '/(en|ru|tj)/:path*']
};
