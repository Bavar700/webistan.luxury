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
    
    // Fix broken operators: ===;  !==;  ==;  !=;
    content = content.replace(/===\s*;/g, '===');
    content = content.replace(/!==\s*;/g, '!==');
    content = content.replace(/==\s*;/g, '==');
    content = content.replace(/!=\s*;/g, '!=');
    
    // Also check for logical operators
    content = content.replace(/&&\s*;/g, '&&');
    content = content.replace(/\|\|\s*;/g, '||');

    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Fixed Broken Operators:', filePath);
    }
  }
});
