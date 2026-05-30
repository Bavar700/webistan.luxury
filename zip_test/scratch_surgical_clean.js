const fs = require('fs');
const path = require('path');

function walkDir(dir, callback) {
  fs.readdirSync(dir).forEach(f => {
    let dirPath = path.join(dir, f);
    let isDirectory = fs.statSync(dirPath).isDirectory();
    isDirectory ? walkDir(dirPath, callback) : callback(path.join(dir, f));
  });
}

const targetDir = 'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src';

walkDir(targetDir, function(filePath) {
  if (filePath.endsWith('.tsx') || filePath.endsWith('.ts')) {
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;
    
    // Fix "if (...);" -> "if (...)"
    content = content.replace(/if\s*\((.*?)\);/g, 'if ($1)');
    
    // Fix missing newlines between blocks and keywords
    content = content.replace(/}\s*const/g, '}\nconst');
    content = content.replace(/]\s*const/g, ']\nconst');
    content = content.replace(/\)\s*const/g, ')\nconst');
    content = content.replace(/}\s*return/g, '}\nreturn');
    content = content.replace(/}\s*export/g, '}\nexport');
    
    // Fix "export; const" once and for all
    content = content.replace(/export;\s+const/g, 'export const');
    
    // Fix accidental semicolons after function signatures in interfaces
    content = content.replace(/=>;\s*void/g, '=> void');

    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Surgically Cleaned:', filePath);
    }
  }
});
