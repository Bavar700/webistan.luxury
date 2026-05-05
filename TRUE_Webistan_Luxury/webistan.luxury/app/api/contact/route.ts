import { NextResponse } from 'next/server';
import nodemailer from 'nodemailer';

export async function POST(req: Request) {
  try {
    const body = await req.json();
    const { name, email, brief, calculatorData } = body;

    const transporter = nodemailer.createTransport({
      host: 'smtp.zoho.eu',
      port: 465,
      secure: true, // true for 465, false for other ports
      auth: {
        user: process.env.ZOHO_EMAIL,
        pass: process.env.ZOHO_APP_PASSWORD,
      },
    });

    const mailOptions = {
      from: `Webistan Luxury <${process.env.ZOHO_EMAIL}>`,
      to: process.env.ZOHO_EMAIL,
      replyTo: email,
      subject: `[НОВАЯ ЗАЯВКА] ${name}`,
      text: `
Новая заявка с сайта Webistan.Luxury

КЛИЕНТ:
Имя/Компания: ${name}
Email для связи: ${email}

ДЕТАЛИ ПРОЕКТА:
Тип: ${calculatorData.projectType}
Инвестиция: ${calculatorData.totalPrice} TJS
Языки: ${calculatorData.languages}
Поддержка: ${calculatorData.support}
Скорость: ${calculatorData.momentum}

ДОПОЛНИТЕЛЬНО:
${calculatorData.activeAddons.join(', ')}

БРИФ:
${brief}
      `,
      html: `
        <div style="font-family: sans-serif; max-width: 600px; border: 1px solid #eee; padding: 20px;">
          <h2 style="color: #B8860B;">Новая заявка: Webistan Luxury</h2>
          <hr />
          <p><strong>Имя/Компания:</strong> ${name}</p>
          <p><strong>Email для связи:</strong> ${email}</p>
          <br />
          <h3 style="color: #666;">Детали проекта:</h3>
          <ul style="list-style: none; padding: 0;">
            <li><strong>Тип:</strong> ${calculatorData.projectType}</li>
            <li><strong>Инвестиция:</strong> <span style="font-size: 1.2em; color: #B8860B;">${calculatorData.totalPrice} TJS</span></li>
            <li><strong>Языки:</strong> ${calculatorData.languages}</li>
            <li><strong>Поддержка:</strong> ${calculatorData.support}</li>
            <li><strong>Скорость:</strong> ${calculatorData.momentum}</li>
          </ul>
          <p><strong>Доп. модули:</strong> ${calculatorData.activeAddons.join(', ') || 'Нет'}</p>
          <br />
          <h3 style="color: #666;">Краткое видение:</h3>
          <div style="background: #f9f9f9; padding: 15px; border-radius: 5px;">
            ${brief.replace(/\n/g, '<br>')}
          </div>
        </div>
      `,
    };

    await transporter.sendMail(mailOptions);

    return NextResponse.json({ success: true });
  } catch (error) {
    console.error('Email sending error:', error);
    return NextResponse.json({ error: 'Failed to send email' }, { status: 500 });
  }
}
