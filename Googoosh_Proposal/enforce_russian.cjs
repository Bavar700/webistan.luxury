const fs = require('fs');
const path = 'c:\\Users\\alaco\\Academy_Webistan\\Googoosh_Proposal\\googoosh_proposal.html';
let html = fs.readFileSync(path, 'utf8');

// 1. Remove the language switcher HTML completely
// We can use a regex that matches <div class="lang-switcher">...</div>
// Since it might span multiple lines, we'll match up to its closing tag.
html = html.replace(/<div class="lang-switcher">[\s\S]*?<\/div>\s*<\/div>/, '</div>'); // It's usually inside <div class="nav-controls">

// Alternative safer approach: just hide it via CSS
html = html.replace(/<\/style>/, '.lang-switcher { display: none !important; }\n  </style>');

// 2. Force body to always be Russian
html = html.replace(/<body[^>]*>/, '<body class="lang-ru">');

// 3. Remove JS that switches languages (if any, so it doesn't accidentally revert)
html = html.replace(/function switchLang[\s\S]*?}/g, '');
html = html.replace(/document\.querySelectorAll\('\.lang-btn'\)[\s\S]*?\}\);/g, '');

fs.writeFileSync(path, html, 'utf8');
console.log('Forced Russian version only.');
