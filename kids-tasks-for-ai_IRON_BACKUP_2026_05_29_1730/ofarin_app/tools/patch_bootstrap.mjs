import { readFileSync, writeFileSync } from 'fs';
import { join, dirname } from 'path';
import { fileURLToPath } from 'url';

const __dirname = dirname(fileURLToPath(import.meta.url));
const projectRoot = join(__dirname, '..');
const bootstrapPath = join(projectRoot, 'build', 'web', 'flutter_bootstrap.js');

try {
  let content = readFileSync(bootstrapPath, 'utf-8');
  
  // Replace the load call to include config: { renderer: 'html' }
  // From: _flutter.loader.load({\n  serviceWorkerSettings...
  // To:   _flutter.loader.load({\n    config: { renderer: 'html' },\n  serviceWorkerSettings...
  const modified = content.replace(
    /(_flutter\.loader\.load\(\{)\s*(serviceWorkerSettings:)/,
    '$1\n  config: { renderer: \'html\' },\n  $2'
  );
  
  if (modified === content) {
    console.error('Warning: Could not find the load() call pattern in flutter_bootstrap.js');
    process.exit(1);
  }
  
  writeFileSync(bootstrapPath, modified, 'utf-8');
  console.log('✅ Patched flutter_bootstrap.js with HTML renderer config');
} catch (e) {
  console.error('Failed to patch flutter_bootstrap.js:', e.message);
  process.exit(1);
}
