const fs = require('fs');
const path = require('path');

const targetFiles = [
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\forms\\ProjectCalculator.tsx',
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\forms\\ContactForm.tsx'
];

targetFiles.forEach(filePath => {
  if (fs.existsSync(filePath)) {
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;
    
    // Replace hardcoded borders with theme-aware variable borders for buttons/choice blocks
    // Note: I only want to target button borders, not layout borders.
    // Usually these are combined with bg-btn-bg.
    
    content = content.replace(/border-\[0\.5px\] border-white\/5/g, 'border-[length:var(--btn-border-width)] border-white/5');
    content = content.replace(/border-white\/10/g, 'border-[length:var(--btn-border-width)] border-white/10');
    
    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Refactored borders:', filePath);
    }
  }
});
