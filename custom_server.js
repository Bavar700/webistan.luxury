const http = require('http');
const fs = require('fs');
const path = require('path');

const PORT = 8000;
const BASE_DIR = 'c:\\Users\\alaco\\Academy_Webistan\\Khalif.Dental';

const MIME_TYPES = {
    '.html': 'text/html; charset=utf-8',
    '.css': 'text/css; charset=utf-8',
    '.js': 'application/javascript; charset=utf-8',
    '.json': 'application/json; charset=utf-8',
    '.png': 'image/png',
    '.jpg': 'image/jpeg',
    '.jpeg': 'image/jpeg',
    '.gif': 'image/gif',
    '.svg': 'image/svg+xml',
    '.ico': 'image/x-icon',
    '.pdf': 'application/pdf'
};

const server = http.createServer((req, res) => {
    let safeUrl = decodeURIComponent(req.url.split('?')[0]);
    if (safeUrl === '/' || safeUrl === '') {
        safeUrl = '/index.html';
    }

    const filePath = path.join(BASE_DIR, safeUrl);

    // Safety check
    if (!filePath.startsWith(BASE_DIR)) {
        res.statusCode = 403;
        res.end('Forbidden');
        return;
    }

    fs.readFile(filePath, (err, data) => {
        if (err) {
            res.statusCode = 404;
            res.end('Not Found');
            return;
        }

        const ext = path.extname(filePath).toLowerCase();
        const contentType = MIME_TYPES[ext] || 'application/octet-stream';
        
        res.writeHead(200, { 
            'Content-Type': contentType,
            'Cache-Control': 'no-store'
        });
        res.end(data);
    });
});

server.listen(PORT, '0.0.0.0', () => {
    console.log(`Pristine HTTP Static Server running at http://localhost:${PORT}`);
});
