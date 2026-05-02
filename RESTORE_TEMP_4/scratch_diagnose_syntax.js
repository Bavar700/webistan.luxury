const fs = require('fs');
const path = require('path');
const { parse } = require('acorn');

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
    
    // Quick and dirty TSX to JS conversion for acorn (acorn doesn't support JSX/TSX out of the box)
    // We'll just try to find obvious things like unclosed braces or semicolons in bad places.
    
    // Better: let's look for common "mangled" patterns we know
    if (content.includes('; const') && !content.includes('export const')) {
        // This might be a false positive but let's check
    }
    
    // Let's look for any line that has code AFTER a // comment (on the same line)
    // Wait, I removed almost all // comments.
    
    // Let's look for any line that starts with a lowercase word that isn't a keyword but ends in ;
    // e.g. "infinity path;"
    const lines = content.split('\n');
    lines.forEach((line, i) => {
        if (line.match(/^[a-z].*;$/i) && !line.match(/^(const|let|var|import|export|return|yield|break|continue|debugger|throw|if|else|for|while|do|switch|case|default|try|catch|finally|function|class|interface|type|enum|as|is|keyof|typeof|readonly|private|protected|public|abstract|declare|module|namespace|global|require|module.exports|exports|this|super|delete|void|new|await|async|static|get|set)/)) {
             console.log(`Potential Syntax Error in ${filePath} at line ${i+1}: ${line}`);
        }
    });
  }
});
