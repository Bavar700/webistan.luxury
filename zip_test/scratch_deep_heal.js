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
    
    // 1. Remove all remnants of mangled comments and "swallowed" text
    // Look for /* ... */ and delete them if they seem to have swallowed code, 
    // or just delete them to be safe since they are mostly descriptive.
    content = content.replace(/\/\*[\s\S]*?\*\//g, '\n');
    
    // 2. Fix the "swallowed" keywords that my previous script left behind
    // e.g. "infinity path const pathD"
    // We'll look for keywords and ensure they start on a new line if they have junk before them.
    const keywords = ['const', 'let', 'var', 'function', 'return', 'export', 'import', 'if', 'else', 'for', 'switch', 'try', 'interface', 'type', 'class', 'break', 'continue', 'default', 'case', 'new', 'this', 'throw', 'delete', 'typeof', 'void', 'in', 'instanceof', 'yield', 'await', 'async', 'static', 'get', 'set', 'readonly', 'private', 'protected', 'public', 'abstract', 'declare'];
    keywords.forEach(kw => {
        const regex = new RegExp('([^\\s;{}(])(\\s+)(' + kw + ')\\b', 'g');
        content = content.replace(regex, '$1;\n$3');
    });

    // 3. Fix the specific cases like "infinity path const"
    // Basically, if there's non-whitespace before a keyword that isn't a valid JS char, break it.
    // This is hard to do generically without a full parser.
    
    // Let's try to just fix the known ones.
    content = content.replace(/infinity path const/g, 'const');
    content = content.replace(/Path length of this specific geometry is ~104 const/g, 'const');
    content = content.replace(/Grid logical preparation const/g, 'const');
    content = content.replace(/Elite Promo Banner const/g, 'const');
    content = content.replace(/Identical Momentum Unselected Card Style const/g, 'const');
    content = content.replace(/Shimmer Effect const/g, 'const');
    
    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Deep Healed:', filePath);
    }
  }
});
