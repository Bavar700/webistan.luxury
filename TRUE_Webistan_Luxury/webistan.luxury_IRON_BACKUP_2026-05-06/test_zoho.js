const nodemailer = require('nodemailer');
require('dotenv').config({ path: '.env.local' });

async function test() {
    console.log('Testing Zoho connection...');
    console.log('Email:', process.env.ZOHO_EMAIL);
    
    if (!process.env.ZOHO_APP_PASSWORD) {
        console.error('Error: ZOHO_APP_PASSWORD is not set in .env.local');
        return;
    }

    const transporter = nodemailer.createTransport({
        host: 'smtp.zoho.eu',
        port: 465,
        secure: true,
        auth: {
            user: process.env.ZOHO_EMAIL,
            pass: process.env.ZOHO_APP_PASSWORD,
        },
    });

    try {
        await transporter.verify();
        console.log('✅ Success! Zoho connection is working.');
        
        await transporter.sendMail({
            from: process.env.ZOHO_EMAIL,
            to: process.env.ZOHO_EMAIL,
            subject: 'Test Connection',
            text: 'Zoho connection test successful.'
        });
        console.log('✅ Test email sent successfully.');
    } catch (error) {
        console.error('❌ Error:', error.message);
        if (error.message.includes('Invalid login')) {
            console.error('Hint: Make sure you are using an APP PASSWORD, not your regular password.');
        }
    }
}

test();
