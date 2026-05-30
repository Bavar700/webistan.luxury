const fs = require('fs');
const path = require('path');

const targetFiles = [
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\forms\\ProjectCalculator.tsx',
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\forms\\ContactForm.tsx',
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\layout\\HeroSection.tsx',
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\layout\\ServicesSection.tsx',
  'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components\\layout\\PortfolioSection.tsx'
];

targetFiles.forEach(filePath => {
  if (fs.existsSync(filePath)) {
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;
    
    // Bump opacities for "almost black" look in light mode
    // (Note: this only affects the light theme since we are working on it now, 
    // and the dark theme uses foreground which is already light)
    
    // Wait, in dark mode, foreground is #F1F1F3. 90% opacity is still light.
    // So this change is safe for both themes as per the "foreground" variable logic.
    
    content = content.replace(/text-white\/70/g, 'text-white/90');
    content = content.replace(/text-foreground\/40/g, 'text-foreground/80');
    content = content.replace(/text-foreground\/60/g, 'text-foreground/90');
    content = content.replace(/text-foreground\/70/g, 'text-foreground/95');
    
    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Deepened text color:', filePath);
    }
  }
});
