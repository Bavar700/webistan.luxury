const fs = require('fs');
const path = 'c:\\Users\\alaco\\Academy_Webistan\\Googoosh_Proposal\\googoosh_proposal.html';
let html = fs.readFileSync(path, 'utf8');

// Fix colors
html = html.replace(/--navy:\s*#[a-fA-F0-9]+;/g, '--navy: #1A1A1A;');
html = html.replace(/--navy-light:\s*#[a-fA-F0-9]+;/g, '--navy-light: #2A2A2A;');
html = html.replace(/--cyan:\s*#[a-fA-F0-9]+;/g, '--cyan: #C5A059;');
html = html.replace(/--cyan-hover:\s*#[a-fA-F0-9]+;/g, '--cyan-hover: #D4AF37;');
html = html.replace(/--cyan-light:\s*rgba\([^)]+\);/g, '--cyan-light: rgba(197, 160, 89, 0.1);');

// Change generic blue tags to gold for better aesthetics
html = html.replace(/rgba\(0,\s*180,\s*216,\s*0\.3\)/g, 'rgba(197, 160, 89, 0.3)');
html = html.replace(/rgba\(0,\s*180,\s*216,\s*0\.15\)/g, 'rgba(197, 160, 89, 0.15)');

// Add Social Links
const socialsText = `<li><strong>Интеграция с картами и соцсетями:</strong> Мы добавили прямые переходы на ваш <strong>Instagram</strong>, <strong>Facebook</strong>, а также маршрутизацию через <strong>2GIS</strong> и <strong>Google Maps</strong> — всё в едином премиальном стиле.</li>`;

if (!html.includes('2GIS')) {
    html = html.replace(/(<li><strong>QR-код:<\/strong>.*?<\/li>)/, `$1\n      ${socialsText}`);
}

fs.writeFileSync(path, html, 'utf8');
console.log('Theme styling and social integrations successfully updated.');
