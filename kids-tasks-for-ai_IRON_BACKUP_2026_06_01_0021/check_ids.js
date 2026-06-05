const fs = require('fs');
const code = fs.readFileSync('js/app.js', 'utf8');
const match = code.match(/function setupEventListeners\(\) \{([\s\S]*?)\n\}\n/);
if (!match) { console.log('not found'); process.exit(1); }
const ids = [...match[1].matchAll(/getElementById\(['"]([^'"]+)['"]\)/g)].map(m => m[1]);
const html = fs.readFileSync('index.html', 'utf8');
const missing = ids.filter(id => !html.includes('id="' + id + '"') && !html.includes("id='" + id + "'"));
console.log('Missing IDs:', missing);
