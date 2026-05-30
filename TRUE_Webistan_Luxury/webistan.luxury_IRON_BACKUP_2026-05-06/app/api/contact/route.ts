import { NextResponse } from 'next/server';
import nodemailer from 'nodemailer';

export async function POST(req: Request) {
  try {
    const body = await req.json();
    const { name, email, brief, calculatorData } = body;

    const zohoUser = process.env.ZOHO_EMAIL || 'director@webistan.luxury';
    const zohoPass = process.env.ZOHO_APP_PASSWORD;

    if (!zohoPass) {
      console.error('Missing ZOHO_APP_PASSWORD');
      return NextResponse.json({ error: 'Server configuration error' }, { status: 500 });
    }

    const transporter = nodemailer.createTransport({
      host: 'smtp.zoho.eu',
      port: 465,
      secure: true,
      auth: {
        user: zohoUser,
        pass: zohoPass,
      },
    });

    // Safety checks for calculatorData fields
    const data = {
      projectType: calculatorData?.projectType || 'N/A',
      totalPrice: calculatorData?.totalPrice || 0,
      languages: calculatorData?.languages || 1,
      support: calculatorData?.support || 'N/A',
      momentum: calculatorData?.momentum || 'N/A',
      activeAddons: Array.isArray(calculatorData?.activeAddons) ? calculatorData.activeAddons.join(', ') : 'None'
    };

    const mailOptions = {
      from: `Webistan Luxury <${zohoUser}>`,
      to: zohoUser,
      replyTo: email || zohoUser,
      subject: `[ЗАЯВКА] ${name || 'Инкогнито'}`,
      text: `
Новая заявка с сайта Webistan.Luxury

КЛИЕНТ:
Имя/Компания: ${name || 'N/A'}
Email для связи: ${email || 'N/A'}

ДЕТАЛИ ПРОЕКТА:
Тип: ${data.projectType}
Инвестиция: ${data.totalPrice} TJS
Языки: ${data.languages}
Поддержка: ${data.support}
Скорость: ${data.momentum}

ДОПОЛНИТЕЛЬНО:
${data.activeAddons}

БРИФ:
${brief || 'Нет описания'}
      `,
      html: `
        <div style="font-family: sans-serif; max-width: 600px; border: 1px solid #eee; padding: 20px;">
          <h2 style="color: #B8860B;">Новая заявка: Webistan Luxury</h2>
          <hr />
          <p><strong>Имя/Компания:</strong> ${name || 'N/A'}</p>
          <p><strong>Email для связи:</strong> ${email || 'N/A'}</p>
          <br />
          <h3 style="color: #666;">Детали проекта:</h3>
          <ul style="list-style: none; padding: 0;">
            <li><strong>Тип:</strong> ${data.projectType}</li>
            <li><strong>Инвестиция:</strong> <span style="font-size: 1.2em; color: #B8860B;">${data.totalPrice} TJS</span></li>
            <li><strong>Языки:</strong> ${data.languages}</li>
            <li><strong>Поддержка:</strong> ${data.support}</li>
            <li><strong>Скорость:</strong> ${data.momentum}</li>
          </ul>
          <p><strong>Доп. модули:</strong> ${data.activeAddons}</p>
          <br />
          <h3 style="color: #666;">Краткое видение:</h3>
          <div style="background: #f9f9f9; padding: 15px; border-radius: 5px;">
            ${(brief || 'Нет описания').replace(/\n/g, '<br>')}
          </div>
        </div>
      `,
    };

    await transporter.sendMail(mailOptions);
    return NextResponse.json({ success: true });
  } catch (error: any) {
    console.error('Email sending error:', error);
    return NextResponse.json({ 
      error: 'Failed to send email', 
      details: error.message 
    }, { status: 500 });
  }
}
