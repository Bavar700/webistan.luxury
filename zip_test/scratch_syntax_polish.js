const fs = require('fs');
const path = require('path');

function walkDir(dir, callback) {
  fs.readdirSync(dir).forEach(f => {
    let dirPath = path.join(dir, f);
    let isDirectory = fs.statSync(dirPath).isDirectory();
    isDirectory ? walkDir(dirPath, callback) : callback(path.join(dir, f));
  });
}

const targetDir = 'C:\\Users\\alaco\\Academy_Webistan\\TRUE_Webistan_Luxury\\webistan.luxury\\src\\components';

walkDir(targetDir, function(filePath) {
  if (filePath.endsWith('.tsx')) {
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;
    
    // Fix "as; const" -> "as const"
    content = content.replace(/as;\s+const/g, 'as const');
    
    // Fix ",;" -> ","
    content = content.replace(/,;/g, ',');
    
    // Fix "as; const" variants
    content = content.replace(/as;\nconst/g, 'as const');
    content = content.replace(/as const,/g, 'as const,'); // safe
    
    // Fix the displayItems mess
    content = content.replace(/type: 'preset' as const,/g, "type: 'preset' as const,"); // fix any breakage there
    
    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Polished Syntax:', filePath);
    }
  }
});
