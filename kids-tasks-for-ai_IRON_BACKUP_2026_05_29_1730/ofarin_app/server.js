const http = require('http');
const fs = require('fs');
const path = require('path');
const mime = {
  '.html':'text/html','.js':'text/javascript','.css':'text/css',
  '.png':'image/png','.json':'application/json','.svg':'image/svg+xml',
  '.ico':'image/x-icon','.wasm':'application/wasm','.otf':'font/otf'
};
const dir = path.join(__dirname, 'build', 'web');
http.createServer((req, res) => {
  let file = req.url === '/' ? '/index.html' : req.url;
  let fp = path.join(dir, file);
  fs.readFile(fp, (err, data) => {
    if (err) { res.writeHead(404); res.end('404'); return; }
    let ext = path.extname(fp);
    res.writeHead(200, {
      'Content-Type': mime[ext] || 'application/octet-stream',
      'Access-Control-Allow-Origin': '*'
    });
    res.end(data);
  });
}).listen(8082, () => console.log('SERVER_READY on http://localhost:8082'));
