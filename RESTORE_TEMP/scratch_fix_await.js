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
    
    // Fix broken await: await; -> await
    content = content.replace(/await\s*;/g, 'await');
    
    // Also check for any other keywords that might have been broken
    const keywords = ['await', 'async', 'typeof', 'delete', 'void'];
    keywords.forEach(kw => {
        const regex = new RegExp(kw + '\\s*\\n?\\s*;', 'g');
        content = content.replace(regex, kw);
    });

    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Fixed Broken Keywords:', filePath);
    }
  }
});
