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
    
    // 1. Fix // comments that swallowed code
    // Convert // ... <keyword> to /* ... */ <keyword>
    // We assume keywords follow the comment text.
    const keywords = ['const', 'let', 'var', 'function', 'return', 'export', 'import', 'if', 'else', 'for', 'switch', 'try', 'interface', 'type', 'class', '<', '>', '{', '}'];
    const keywordRegex = new RegExp('(\\s)(' + keywords.join('|') + ')\\b', 'g');
    
    content = content.replace(/\/\/ (.*?)(\s+)(const|let|var|function|return|export|import|if|else|for|switch|try|interface|type|class|return|break|continue|default|case|new|this|throw|delete|typeof|void|in|instanceof|yield|await|async|static|get|set|readonly|private|protected|public|abstract|declare|module|namespace|global|require|module.exports|exports)/g, '/* $1 */ \n $3');
    
    // 2. Add newlines after common structural points to break the mega-line
    content = content.replace(/; /g, ';\n');
    content = content.replace(/{ /g, '{\n');
    content = content.replace(/} /g, '\n}\n');
    content = content.replace(/> </g, '>\n<');
    
    // 3. Fix double newlines
    content = content.replace(/\n\s*\n/g, '\n');
    
    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Healed:', filePath);
    }
  }
});
