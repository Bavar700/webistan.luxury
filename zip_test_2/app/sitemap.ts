import { MetadataRoute } from 'next';
 
export default function sitemap(): MetadataRoute.Sitemap {
  const locales = ['en', 'ru', 'tj'];
  const baseUrl = 'https://webistan.luxury';
 
  const routes = locales.map((locale) => ({
    url: `${baseUrl}/${locale}`,
    lastModified: new Date(),
    changeFrequency: 'weekly' as const,
    priority: 1,
  }));
 
  return routes;
}
