const puppeteer = require('puppeteer');

(async () => {
    console.log('Launching browser...');
    const browser = await puppeteer.launch({
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox']
    });
    const page = await browser.newPage();

    page.on('console', msg => console.log('BROWSER CONSOLE:', msg.text()));
    page.on('pageerror', err => console.error('BROWSER PAGE ERROR:', err.toString()));
    page.on('requestfailed', request => console.log('BROWSER REQUEST FAILED:', request.url(), request.failure().errorText));

    console.log('Navigating to page...');
    await page.goto('https://well-done-kids.vercel.app', { waitUntil: 'networkidle2' });

    console.log('Waiting 5 seconds...');
    await new Promise(resolve => setTimeout(resolve, 5000));

    console.log('Taking screenshot...');
    await page.screenshot({ path: 'c:/Users/alaco/Academy_Webistan/kids-tasks-diamond-extracted/screenshot.png' });

    console.log('Closing browser...');
    await browser.close();
    console.log('Done!');
})().catch(err => {
    console.error('Test script failed:', err);
});
