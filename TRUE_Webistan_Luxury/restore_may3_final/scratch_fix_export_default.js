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
    
    // Fix "export default;" -> "export default"
    content = content.replace(/export\s+default;\s*\n\s*async\s+function/g, 'export default async function');
    content = content.replace(/export\s+default;\s+async\s+function/g, 'export default async function');
    content = content.replace(/export\s+default;\s*\n\s*function/g, 'export default function');
    content = content.replace(/export\s+default;\s+function/g, 'export default function');
    
    // Fix general "export default;" cases
    content = content.replace(/export\s+default;/g, 'export default');

    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Fixed Export Default:', filePath);
    }
  }
});
