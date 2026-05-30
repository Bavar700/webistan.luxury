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
    
    // Fix "as; const" -> "as const"
    content = content.replace(/as;\s*const/g, 'as const');
    content = content.replace(/as;\n\s*const/g, 'as const');
    
    // Also fix similar cases like "as; any" if they exist
    content = content.replace(/as;\s*any/g, 'as any');

    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Fixed "as const" Breakage:', filePath);
    }
  }
});
