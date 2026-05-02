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
    
    // 1. Fix the broken void in types: "() =>; void;" -> "() => void;"
    content = content.replace(/\(\)\s*=>;\s*void;/g, '() => void;');
    
    // 2. Fix broken keywords that shouldn't have a semicolon before them
    // Join lines that start with 'from', 'void', 'as', 'const' if they look broken
    content = content.replace(/;\s*\n\s*from/g, ' from');
    content = content.replace(/;\s*\n\s*void/g, ' void');
    content = content.replace(/;\s*\n\s*as/g, ' as');
    
    // 3. Fix the "export; const" remnants again just in case
    content = content.replace(/export;\s*\n\s*const/g, 'export const');

    // 4. Fix any other weird semicolon injections before keywords
    const keywords = ['const', 'let', 'var', 'from', 'void', 'as', 'in'];
    keywords.forEach(kw => {
        const regex = new RegExp(';\\s*\\n\\s*' + kw + '\\b', 'g');
        content = content.replace(regex, ' ' + kw);
    });

    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Repaired Syntax:', filePath);
    }
  }
});
