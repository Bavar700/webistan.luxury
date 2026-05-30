// Build trigger: 2026-05-06 03:34
import createNextIntlPlugin from 'next-intl/plugin';
import type { NextConfig } from "next";

const withNextIntl = createNextIntlPlugin('./i18n/request.ts');

const nextConfig: NextConfig = {
  images: {
    unoptimized: true,
  }
};

export default withNextIntl(nextConfig);
