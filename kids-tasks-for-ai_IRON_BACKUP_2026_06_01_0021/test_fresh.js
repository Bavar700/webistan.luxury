const fs = require('fs');
const jsdom = require('jsdom');
const { JSDOM } = jsdom;

const html = fs.readFileSync('index_test.html', 'utf8');

const virtualConsole = new jsdom.VirtualConsole();
virtualConsole.on('error', (err) => console.error('BROWSER ERROR:', err));
virtualConsole.on('jsdomError', (err) => console.error('JSDOM ERROR:', err));

const dom = new JSDOM(html, { 
    runScripts: 'dangerously', 
    resources: 'usable',
    virtualConsole,
    url: `file://${__dirname}/index_test.html`,
    beforeParse(window) {
        const storage = {};
        Object.defineProperty(window, 'localStorage', {
            value: {
                getItem: (key) => storage[key] || null,
                setItem: (key, val) => { storage[key] = String(val); },
                removeItem: (key) => { delete storage[key]; },
                clear: () => { for (let k in storage) delete storage[k]; }
            },
            writable: true,
            configurable: true
        });
    }
});

setTimeout(() => {
    try {
        console.log('App loaded.');
        
        dom.window.loadState();
        dom.window.initApp();
        
        const state = dom.window.eval('state');
        console.log('Init done. Children:', state.children.length);
        
        // Go to balance page
        dom.window.document.querySelector('.nav-btn[data-page="balance"]').click();
        
        // Click withdraw button
        console.log('Clicking btn-withdraw...');
        const btn = dom.window.document.getElementById('btn-withdraw');
        btn.click();
        
        console.log('Modal hidden:', dom.window.document.getElementById('withdraw-modal').classList.contains('hidden'));
        
        process.exit(0);
    } catch(e) {
        console.error('TEST EXCEPTION:', e.name, e.message, e.stack);
    }
}, 2000);
