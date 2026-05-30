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
    
    // Fix "export;\nconst" -> "export const"
    content = content.replace(/export;\s*\n\s*const/g, 'export const');
    content = content.replace(/export;\s*\n\s*function/g, 'export function');
    content = content.replace(/export;\s*\n\s*async/g, 'export async');

    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Fixed export syntax error in:', filePath);
    }
  }
});
