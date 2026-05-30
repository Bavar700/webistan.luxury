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
    
    // Fix text color for light silver buttons
    content = content.replace(/text-white'}\`/g, "text-foreground group-hover:text-white transition-colors duration-700'}`");
    content = content.replace(/text-white border-white\/10/g, "text-foreground group-hover:text-white transition-colors duration-700 border-white/10");
    
    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Fixed text contrast:', filePath);
    }
  }
});
