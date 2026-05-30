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
    
    // 1. Text on dark (Platinum/Header) should be white
    content = content.replace(/text-foreground/g, 'text-white');
    
    // 2. Input/Choice areas should be slightly lighter than the card background
    // Card background is bg-surface (#374151). Lighter choice: bg-white/5
    content = content.replace(/bg-background\/20/g, 'bg-white/10');
    content = content.replace(/bg-background/g, 'bg-white/5 backdrop-blur-sm');
    content = content.replace(/bg-accent\/2/g, 'bg-white/10');
    content = content.replace(/bg-accent\/5/g, 'bg-white/20');
    
    // 3. Fix placeholder colors on dark inputs
    content = content.replace(/placeholder:text-white\/40/g, 'placeholder:text-white/30');
    
    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Polished:', filePath);
    }
  }
});
