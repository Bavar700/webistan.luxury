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
    
    // Remove 'italic' class
    // Target both 'italic' and ' italic' and 'italic '
    content = content.replace(/\bitalic\b/g, '');
    
    // Clean up double spaces that might be left behind
    content = content.replace(/\s\s+/g, ' ');
    
    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Removed italics:', filePath);
    }
  }
});
