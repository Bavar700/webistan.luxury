const fs = require('fs');
const path = 'c:\\Users\\alaco\\Academy_Webistan\\Googoosh_Proposal\\googoosh_proposal.html';
let html = fs.readFileSync(path, 'utf8');

// 1. Replace Pricing
html = html.replace(/4 718/g, '7 648');
html = html.replace(/4&nbsp;718/g, '7&nbsp;648');
html = html.replace(/3 000/g, '5 000');
html = html.replace(/3&nbsp;000/g, '5&nbsp;000');
html = html.replace(/3000/g, '5000');

// 2. Replace ROI specifics (braces -> beauty services)
html = html.replace(/установку брекетов/g, 'премиум-услуги (например, сложное окрашивание)');
html = html.replace(/3 500 сомони/g, '1 000 сомони');
html = html.replace(/Брекеты, средний чек 3500/g, 'Премиум-услуги, средний чек 1000');

// 3. Fix JS calculator values inside HTML
html = html.replace(/17 500/g, '5 000');
html = html.replace(/\* 3500/g, '* 1000');

// 4. Ensure CRM is mentioned prominently if not already (it was added in the previous block, but let's make sure it's emphasized)
if (!html.includes('Интеграция Telegram-CRM')) {
    html = html.replace(/<\/h1>/i, `</h1>\n<p style="font-size:18px; color:#C5A059;"><strong>🔥 Включена эксклюзивная система CRM:</strong> все заявки с сайта мгновенно приходят к вам в Telegram!</p>`);
}

fs.writeFileSync(path, html, 'utf8');
console.log('Pricing and ROI successfully updated.');
