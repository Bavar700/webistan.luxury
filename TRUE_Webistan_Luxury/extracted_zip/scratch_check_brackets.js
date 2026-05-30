const fs = require('fs');
const path = require('path');

function checkBrackets(filePath) {
  const content = fs.readFileSync(filePath, 'utf8');
  const stack = [];
  const brackets = {
    '{': '}',
    '[': ']',
    '(': ')'
  };
  const closeBrackets = new Set(['}', ']', ')']);
  
  // Basic tokenizer to skip strings and comments
  let isString = false;
  let stringChar = '';
  let isComment = false;
  let isMultilineComment = false;
  
  for (let i = 0; i < content.length; i++) {
    const char = content[i];
    const nextChar = content[i+1];
    
    if (isComment) {
      if (char === '\n') isComment = false;
      continue;
    }
    if (isMultilineComment) {
      if (char === '*' && nextChar === '/') {
        isMultilineComment = false;
        i++;
      }
      continue;
    }
    if (isString) {
      if (char === stringChar && content[i-1] !== '\\') isString = false;
      continue;
    }
    
    if (char === '/' && nextChar === '/') {
      isComment = true;
      i++;
      continue;
    }
    if (char === '/' && nextChar === '*') {
      isMultilineComment = true;
      i++;
      continue;
    }
    if (char === "'" || char === '"' || char === '`') {
      isString = true;
      stringChar = char;
      continue;
    }
    
    if (brackets[char]) {
      stack.push({ char, line: content.substring(0, i).split('\n').length });
    } else if (closeBrackets.has(char)) {
      if (stack.length === 0) {
        return `Extra closing bracket '${char}' at line ${content.substring(0, i).split('\n').length}`;
      }
      const last = stack.pop();
      if (brackets[last.char] !== char) {
        return `Mismatched bracket: expected '${brackets[last.char]}' for '${last.char}' from line ${last.line}, but found '${char}' at line ${content.substring(0, i).split('\n').length}`;
      }
    }
  }
  
  if (stack.length > 0) {
    const last = stack[stack.length - 1];
    return `Unclosed bracket '${last.char}' from line ${last.line}`;
  }
  return null;
}

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
    const error = checkBrackets(filePath);
    if (error) {
      console.log(`Error in ${filePath}: ${error}`);
    }
  }
});
