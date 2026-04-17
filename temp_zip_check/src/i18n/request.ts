import { getRequestConfig } from 'next-intl/server';

export default getRequestConfig(async ({ locale }) => {
  const resolvedLocale = locale || 'en';
  let messages;
  switch (resolvedLocale) {
    case 'ru':
      messages = (await import('../messages/ru.json')).default;
      break;
    case 'tj':
      messages = (await import('../messages/tj.json')).default;
      break;
    default:
      messages = (await import('../messages/en.json')).default;
  }

  return {
    locale: resolvedLocale,
    messages
  };
});
