const puppeteer = require('puppeteer');
const fs = require('fs');

async function run() {
    let chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
    if (!fs.existsSync(chromePath)) {
        chromePath = 'C:\\Program Files (x86)\\Google\\Chrome\\Application\\chrome.exe';
    }
    
    console.log('Using Chrome path:', chromePath);
    console.log('Launching browser...');
    
    const browser = await puppeteer.launch({
        headless: true,
        executablePath: fs.existsSync(chromePath) ? chromePath : undefined,
        args: ['--no-sandbox', '--disable-setuid-sandbox']
    });
    
    const page = await browser.newPage();

    page.on('console', msg => {
        console.log(`[BROWSER CONSOLE] ${msg.type().toUpperCase()}: ${msg.text()}`);
    });

    page.on('pageerror', err => {
        console.log(`[BROWSER PAGEERROR]: ${err.toString()}`);
    });

    console.log('Navigating to website...');
    await page.goto('https://well-done-kids.vercel.app', { waitUntil: 'networkidle2' });

    console.log('Page loaded. Checking welcome screen...');
    
    // Tap English language button
    console.log('Tapping English language button on welcome screen...');
    await page.click('#welcome-btn-en');
    
    // Tap Start button
    console.log('Tapping Start button...');
    await page.click('#welcome-start-btn');
    
    // Wait for auth overlay to show
    await new Promise(r => setTimeout(r, 1000));
    
    const isAuthVisible = await page.evaluate(() => {
        const auth = document.getElementById('auth-overlay');
        return auth && !auth.classList.contains('hidden');
    });
    console.log('Auth overlay is visible:', isAuthVisible);

    if (isAuthVisible) {
        console.log('Typing email...');
        await page.type('#auth-email', 'test_auth_check_123@example.com');
        console.log('Typing password...');
        await page.type('#auth-password', 'password123');
        
        console.log('Submitting login form...');
        await page.click('#btn-auth-submit');
        
        console.log('Waiting 5 seconds for response...');
        await new Promise(r => setTimeout(r, 5000));
        
        const errorText = await page.evaluate(() => {
            const errDiv = document.getElementById('auth-error');
            return errDiv ? errDiv.textContent : 'No error div';
        });
        console.log('Error text displayed on UI:', errorText);
        
        // Let's try to switch to registration
        console.log('Tapping toggle to Registration...');
        await page.click('#auth-toggle-link');
        await new Promise(r => setTimeout(r, 500));
        
        // Accept privacy if checkbox exists
        await page.evaluate(() => {
            const cb = document.getElementById('auth-privacy-checkbox');
            if (cb) cb.checked = true;
        });
        
        console.log('Submitting registration form...');
        await page.click('#btn-auth-submit');
        
        console.log('Waiting 5 seconds for registration response...');
        await new Promise(r => setTimeout(r, 5000));
        
        const registerErrorText = await page.evaluate(() => {
            const errDiv = document.getElementById('auth-error');
            return errDiv ? errDiv.textContent : 'No error div';
        });
        console.log('Error text displayed on UI after registration attempt:', registerErrorText);
    }

    await browser.close();
    console.log('Done.');
}

run().catch(console.error);
