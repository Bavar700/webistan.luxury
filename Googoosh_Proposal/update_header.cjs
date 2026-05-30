const fs = require('fs');
const path = 'c:\\Users\\alaco\\Academy_Webistan\\Googoosh_Proposal\\googoosh_proposal_clean.html';
let html = fs.readFileSync(path, 'utf8');

// 1. Remove the subtitle ""GOOGOOSH STUDIO" - Webistan.Luxury"
html = html.replace(/<div class="muted" style="margin-bottom: 8mm;">"GOOGOOSH STUDIO" - Webistan\.Luxury<\/div>/, '');

// 2. Change the header logo from "Googoosh Studio" to "WEBISTAN.LUXURY"
html = html.replace(/<div class="header-logo">Googoosh <span class="highlight">Studio<\/span><\/div>/, '<div class="header-logo">WEBISTAN<span class="highlight">.LUXURY</span></div>');

fs.writeFileSync(path, html, 'utf8');
console.log('Header and subtitle updated.');
