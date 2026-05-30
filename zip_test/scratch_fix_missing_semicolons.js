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
    
    // Fix cases where a keyword follows code without a semicolon
    // e.g. "] let" -> "]; let"
    // e.g. "base let" -> "base; let"
    
    const keywords = ['const', 'let', 'var', 'if', 'return', 'export', 'import'];
    keywords.forEach(kw => {
        const regex = new RegExp('([a-zA-Z0-9\'"\\]\\)])(\\s+)(' + kw + ')\\b', 'g');
        content = content.replace(regex, (match, p1, p2, p3) => {
            // Exceptions
            if (p3 === 'const' && p1 === 't' && content.includes('export')) {
                 // Check if it's "export const"
                 const start = content.indexOf(match);
                 if (content.substring(start-7, start).includes('export')) return match;
            }
            return p1 + ';\n' + p3;
        });
    });

    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Fixed Missing Semicolons:', filePath);
    }
  }
});
