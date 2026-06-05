const puppeteer = require('puppeteer');

async function run() {
    console.log('Launching Edge...');
    const browser = await puppeteer.launch({
        headless: true,
        executablePath: 'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe',
        args: [
            '--no-sandbox',
            '--disable-setuid-sandbox',
            '--disable-gpu',
            '--disable-software-rasterizer',
            '--disable-dev-shm-usage',
            '--no-zygote'
        ]
    });
    const page = await browser.newPage();

    // Listen for console logs and errors
    page.on('console', msg => {
        console.log(`[BROWSER CONSOLE] ${msg.type().toUpperCase()}: ${msg.text()}`);
    });

    page.on('pageerror', err => {
        console.log(`[BROWSER PAGEERROR]: ${err.toString()}`);
    });

    console.log('Navigating to website...');
    await page.goto('https://well-done-kids.vercel.app', { waitUntil: 'networkidle2' });

    // Click local storage reset to clear state
    await page.evaluate(() => {
        localStorage.clear();
        sessionStorage.clear();
    });
    await page.reload({ waitUntil: 'networkidle2' });

    console.log('Page loaded. Checking for early error displays...');
    const hasEarlyError = await page.evaluate(() => {
        const errDiv = document.getElementById('early-error-display');
        return errDiv ? errDiv.innerHTML : null;
    });

    if (hasEarlyError) {
        console.log('⚠️ EARLY ERROR DETECTED:\n', hasEarlyError);
    } else {
        console.log('No early error display found.');
    }

    // Click English language, then click Start
    console.log('Selecting English...');
    await page.click('#welcome-btn-en');
    console.log('Tapping Start...');
    await page.click('#welcome-start-btn');
    await new Promise(r => setTimeout(r, 1500));

    // Try logging in using a test account (or check auth overlay elements)
    const title = await page.evaluate(() => {
        return document.getElementById('auth-title')?.textContent;
    });
    console.log('Auth title:', title);

    await browser.close();
    console.log('Done.');
}

run().catch(console.error);
