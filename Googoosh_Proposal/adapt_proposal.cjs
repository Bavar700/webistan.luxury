const fs = require('fs');

const path = 'c:\\Users\\alaco\\Academy_Webistan\\Googoosh_Proposal\\googoosh_proposal.html';
let html = fs.readFileSync(path, 'utf8');

// Basic replacements
html = html.replace(/Dandoni Solim/g, 'Googoosh Studio');
html = html.replace(/Dandoni/g, 'Googoosh');
html = html.replace(/dandoni/g, 'googoosh');
html = html.replace(/Стоматология/g, 'Салон Красоты');
html = html.replace(/стоматология/g, 'салон красоты');
html = html.replace(/стоматологической клиники/g, 'премиального салона красоты');
html = html.replace(/стоматологическую клинику/g, 'премиальный салон красоты');
html = html.replace(/клиники/g, 'салона');
html = html.replace(/клинику/g, 'салон');
html = html.replace(/клиника/g, 'салон');
html = html.replace(/пациентов/g, 'клиентов');
html = html.replace(/пациент/g, 'клиент');
html = html.replace(/врачу/g, 'мастеру');
html = html.replace(/врачей/g, 'мастеров');
html = html.replace(/лечение зубов/g, 'премиум-услуги');
html = html.replace(/лечение/g, 'бьюти-услуги');
html = html.replace(/здоровья/g, 'красоты');
html = html.replace(/улыбок/g, 'образов');

// Specific injections for Googoosh based on prompt instructions
// The user asked to explicitly mention the domain and all features we did.
// We can insert a new block or append it to the Executive Summary section.

// Let's add a custom section replacing one of the text blocks if possible, or just prepend to a known section.
// A common word in business proposals is "Введение" or "Задачи".
const customGoogooshFeatures = `
  <div style="background: rgba(197,160,89,0.1); padding: 30px; border-left: 4px solid #C5A059; margin-bottom: 40px; border-radius: 8px;">
    <h3 style="color: #C5A059; margin-top: 0; font-family: 'Cormorant', serif; font-size: 24px;">Эксклюзивно для Уважаемой Гугуш</h3>
    <p style="color: #ffffff; line-height: 1.6; font-size: 16px;">
      Мы проделали огромную работу, чтобы цифровой облик <strong>Googoosh Studio</strong> полностью соответствовал вашему высокому статусу. Вот что мы уже реализовали:
    </p>
    <ul style="color: #ffffff; line-height: 1.8; font-size: 16px; margin-top: 15px; list-style-type: disc; padding-left: 20px;">
      <li><strong>Премиальный домен:</strong> Официально выкуплен и настроен домен <span style="color: #C5A059; font-weight: bold;">www.googoosh.tj</span>. Ваш бренд теперь звучит престижно.</li>
      <li><strong>Мультиязычность:</strong> Сайт мгновенно переключается между таджикским, русским и английским языками без перезагрузки страницы (моментальный UX).</li>
      <li><strong>Интеграция Telegram-CRM:</strong> Все записи от клиентов (нажатие кнопок "Записаться") моментально и безопасно приходят напрямую в ваш Telegram, обеспечивая молниеносную реакцию.</li>
      <li><strong>Адаптивный High-End дизайн:</strong> Безупречная работа как на больших мониторах, так и на экранах смартфонов. Для мобильной версии мы разработали отдельную логику меню и прайс-листа.</li>
      <li><strong>Глобальная инфраструктура (Vercel):</strong> Сайт развернут на передовых edge-серверах Vercel, что гарантирует мгновенную загрузку из любой точки мира.</li>
      <li><strong>QR-код:</strong> Внедрен эстетичный QR-код для быстрой связи клиентов с салоном, отцентрированный для мобильных пользователей.</li>
    </ul>
  </div>
`;

// Insert after the main <h1> or a prominent place
html = html.replace(/(<\/h1>)/i, `$1\n\n${customGoogooshFeatures}\n\n`);

fs.writeFileSync(path, html, 'utf8');
console.log('Proposal adapted for Googoosh.');
