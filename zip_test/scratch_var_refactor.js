const fs = require('fs');
const path = require('path');

const targetFiles = [
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\forms\\ProjectCalculator.tsx',
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\forms\\ContactForm.tsx',
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\layout\\ServicesSection.tsx',
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\layout\\PortfolioSection.tsx',
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\ui\\LuxuryButton.tsx'
];

targetFiles.forEach(filePath => {
  if (fs.existsSync(filePath)) {
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;
    
    // 1. LuxuryButton refactor
    if (filePath.includes('LuxuryButton.tsx')) {
        content = content.replace(/bg-white\/40 backdrop-blur-md border border-white\/50 shadow-sm text-foreground hover:bg-surface hover:text-white/g, 'bg-btn-bg backdrop-blur-md border border-white/10 shadow-sm text-btn-text hover:bg-btn-hover-bg hover:text-btn-hover-text');
    }

    // 2. Card refactor
    content = content.replace(/bg-surface text-white/g, 'bg-card-bg text-card-text');
    
    // 3. Choice/Interaction block refactor
    // Previously used bg-white/40 backdrop-blur-md shadow-sm hover:bg-surface transition-all duration-700 text-foreground group-hover:text-white
    content = content.replace(/bg-white\/40 backdrop-blur-md shadow-sm hover:bg-surface transition-all duration-700 text-foreground group-hover:text-white/g, 'bg-btn-bg backdrop-blur-md shadow-sm hover:bg-btn-hover-bg transition-all duration-700 text-btn-text group-hover:text-btn-hover-text');
    
    // 4. Input background refactor
    content = content.replace(/bg-white\/10/g, 'bg-btn-bg');
    content = content.replace(/bg-white\/15/g, 'bg-btn-bg');
    
    // 5. General text fix
    // My previous script was too aggressive with text-white replacement.
    // I'll change text-white back to var-based text colors where appropriate, 
    // but in many places text-card-text is already set on the parent.
    
    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Refactored to variables:', filePath);
    }
  }
});
