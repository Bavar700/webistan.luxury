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
    
    // Fix "export; const" -> "export const"
    content = content.replace(/export;\s+const/g, 'export const');
    
    // Remove "infinity path;"
    content = content.replace(/infinity path;/g, '');
    
    // Remove "this specific geometry is ~104;"
    content = content.replace(/this specific geometry is ~104;/g, '');
    
    // Remove "Grid logical preparation;"
    content = content.replace(/Grid logical preparation;/g, '');
    
    // Remove "Elite Promo Banner;"
    content = content.replace(/Elite Promo Banner;/g, '');
    
    // Remove "Identical Momentum Unselected Card Style;"
    content = content.replace(/Identical Momentum Unselected Card Style;/g, '');
    
    // Remove "Shimmer Effect;"
    content = content.replace(/Shimmer Effect;/g, '');

    // Remove empty comments {} left in JSX
    content = content.replace(/{ \n }/g, '');
    content = content.replace(/{\n}/g, '');
    
    if (original !== content) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log('Super Cleaned:', filePath);
    }
  }
});
