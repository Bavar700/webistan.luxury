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
        
        dom.window.eval('state.children[0].balance = 50;');
        dom.window.eval('state.children[0].stars = 50;');
        
        // 1. Click withdraw button
        console.log('Clicking btn-withdraw...');
        const btn = dom.window.document.getElementById('btn-withdraw');
        btn.click();
        
        setTimeout(() => {
            // 2. Submit withdraw
            console.log('Child balance:', dom.window.eval('getCurrentChild().balance'));
            console.log('Child stars:', dom.window.eval('getCurrentChild().stars'));
            console.log('withdraw-amount value:', dom.window.document.getElementById('withdraw-amount').value);
            console.log('withdraw-currency-type value:', dom.window.document.getElementById('withdraw-currency-type').value);
            
            console.log('Submitting withdraw...');
            dom.window.document.getElementById('withdraw-amount').value = '10';
            dom.window.document.getElementById('withdraw-submit').click();
            
            console.log('Withdrawals length:', dom.window.eval('getCurrentChild().withdrawals.length'));
            
            // 3. Go to parent dashboard
            console.log('Navigating to parent...');
            dom.window.navigateTo('parent');
            console.log('Current page after navigating:', dom.window.eval('currentPage'));
            console.log('Is pin-modal visible:', !dom.window.document.getElementById('pin-modal').classList.contains('hidden'));
            
            // 4. Enter pin
            console.log('Entering PIN...');
            dom.window.document.getElementById('pin-input').value = dom.window.eval('state.pin');
            dom.window.document.getElementById('pin-submit').click();
            
            console.log('Current page after pin-submit:', dom.window.eval('currentPage'));
            
            // 5. Approve withdraw
            const approveBtns = dom.window.document.querySelectorAll('.parent-approve-btn');
            console.log('Approve buttons found:', approveBtns.length);
            if(approveBtns.length > 0) {
                approveBtns[0].click();
                console.log('Withdrawal status:', dom.window.eval('getCurrentChild().withdrawals[0].status'));
            }
            
            console.log('DONE');
            process.exit(0);
        }, 500);
    } catch(e) {
        console.error('TEST EXCEPTION:', e);
    }
}, 2000);
