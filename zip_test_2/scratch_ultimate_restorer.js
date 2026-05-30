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
    
    // Fix cases where keywords are preceded by alphanumeric chars without semicolon/newline
    // e.g. "999 const" -> "999; const"
    // e.g. "return const" -> "return; const"
    
    const keywords = ['const', 'let', 'var', 'return', 'if', 'for', 'while', 'switch', 'export', 'import', 'async', 'try', 'throw'];
    keywords.forEach(kw => {
        // Regex: (alphanumeric or quote or closing paren) followed by whitespace followed by keyword
        const regex = new RegExp('([a-zA-Z0-9\'"\\)])(\\s+)(' + kw + ')\\b', 'g');
        content = content.replace(regex, (match, p1, p2, p3) => {
            // Exceptions: "async function", "export const", "export function", "export async"
            if (p3 === 'const' && p1 === 't' && content.substring(content.indexOf(match)-6, content.indexOf(match)).includes('export')) return match;
            if (p3 === 'async' && p1 === 't' && content.substring(content.indexOf(match)-6, content.indexOf(match)).includes('export')) return match;
            
            // Special case for 'return' followed by code on same line (bad)
            if (p1.match(/[a-zA-Z0-9]/) && p3 === 'const') return p1 + ';\n' + p3;
            
            return p1 + ';\n' + p3;
        });
    });

    // Fix specific Starfield.tsx return issues
    content = content.replace(/return\s+const/g, 'return; const');
    content = content.replace(/return\s+let/g, 'return; let');

    // Fix WebistanSymbol specifically
    content = content.replace(/"\s+const pathLength/g, '";\nconst pathLength');
    content = content.replace(/104\s+const duration/g, '104;\nconst duration');

    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Ultimate Restored:', filePath);
    }
  }
});
