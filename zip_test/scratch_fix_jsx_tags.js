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
    
    // Fix broken JSX tags with accidental semicolons
    // e.g. <input;  or <LuxuryButton;
    content = content.replace(/<([a-zA-Z0-9.]+);/g, '<$1');
    
    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Fixed JSX Tags:', filePath);
    }
  }
});
