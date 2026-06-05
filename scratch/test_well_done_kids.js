const puppeteer = require('puppeteer');

(async () => {
    console.log('Launching browser...');
    const browser = await puppeteer.launch({
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox']
    });
    const page = await browser.newPage();
    
    page.on('console', msg => console.log('PAGE LOG:', msg.text()));
    page.on('pageerror', err => console.error('PAGE ERROR:', err.message));
    
    console.log('Navigating to https://well-done-kids.vercel.app...');
    try {
        await page.goto('https://well-done-kids.vercel.app', { waitUntil: 'networkidle2', timeout: 30000 });
        const title = await page.title();
        console.log('Page Title:', title);
        
        const content = await page.content();
        console.log('HTML Length:', content.length);
        
        await page.screenshot({ path: 'c:/Users/alaco/Academy_Webistan/scratch/screenshot.png' });
        console.log('Screenshot saved successfully.');
    } catch (e) {
        console.error('Navigation failed:', e);
    }
    
    await browser.close();
})();
