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
    
    // Replace backdrop-blur-md and shadow-sm with variables
    content = content.replace(/backdrop-blur-md/g, '[backdrop-filter:blur(var(--btn-blur))]');
    content = content.replace(/shadow-sm/g, '[box-shadow:var(--btn-shadow)]');
    
    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Polished edges:', filePath);
    }
  }
});
