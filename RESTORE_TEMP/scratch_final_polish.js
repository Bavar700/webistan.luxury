const fs = require('fs');
const path = require('path');

const targetFiles = [
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\forms\\ProjectCalculator.tsx',
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\forms\\ContactForm.tsx',
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\layout\\ServicesSection.tsx',
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\layout\\PortfolioSection.tsx'
];

targetFiles.forEach(filePath => {
  if (fs.existsSync(filePath)) {
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;
    
    // Replace any remaining dark mode glasses with white glass for the dark cards
    content = content.replace(/bg-white\/\[0\.01\]/g, 'bg-white/10 backdrop-blur-sm');
    content = content.replace(/bg-white\/\[0\.02\]/g, 'bg-white/15 backdrop-blur-sm');
    
    // Bump text-foreground/x to text-white/x
    content = content.replace(/text-foreground/g, 'text-white');
    
    // Placeholder bump
    content = content.replace(/placeholder:text-white\/20/g, 'placeholder:text-white/40');
    content = content.replace(/placeholder:text-white\/30/g, 'placeholder:text-white/40');
    
    // Background blocks (like the language box or inputs)
    content = content.replace(/bg-background\/20/g, 'bg-white/15');
    
    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Final Polish:', filePath);
    }
  }
});
