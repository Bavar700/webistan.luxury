const puppeteer = require('puppeteer');

async function run() {
    console.log('Launching browser...');
    const browser = await puppeteer.launch({
        headless: true,
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

    console.log('Page loaded. Checking for error display...');
    
    // Check if auth overlay is visible
    const authOverlayStatus = await page.evaluate(() => {
        const auth = document.getElementById('auth-overlay');
        if (!auth) return 'not found';
        const isHidden = auth.classList.contains('hidden');
        return isHidden ? 'hidden' : 'visible';
    });
    console.log(`Auth overlay status: ${authOverlayStatus}`);

    // Wait 5 seconds to let any initialization run and watch console
    console.log('Waiting 5s for any startup console messages...');
    await new Promise(r => setTimeout(r, 5000));

    await browser.close();
    console.log('Done.');
}

run().catch(console.error);
