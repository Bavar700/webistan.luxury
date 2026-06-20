const fs = require('fs');
const path = require('path');

const filePath = path.join(__dirname, '..', 'js', 'translations.js');
let content = fs.readFileSync(filePath, 'utf8');

const newTranslations = {
    tg: {
        'onboarding.slide1.title': 'Рӯзмарраро ба бозӣ табдил диҳед! 🎮',
        'onboarding.slide1.text': 'Офарин! ба кӯдакон кӯмак мекунад, ки вазифаҳои ҳаррӯзаро бо шавқ иҷро кунанд. Онҳо тилло ҷамъ мекунанд, шумо бошед аз мустақилияти онҳо лаззат мебаред.',
        'onboarding.slide2.title': 'Шумо супориш медиҳед, кӯдак иҷро мекунад 📝',
        'onboarding.slide2.text': 'Вазифаҳо эҷод кунед, ҳисоботи аксӣ талаб кунед ва онҳоро бо PIN-коди махфии худ тасдиқ кунед. Мукофот танҳо пас аз тасдиқи шумо дода мешавад!',
        'onboarding.slide2.default_pin': 'PIN: 0000',
        'onboarding.slide3.title': 'Ҳолати бехатари кӯдакон 🛡️',
        'onboarding.slide3.text': 'Дар телефони онҳо "Ҳолати кӯдакон"-ро фаъол кунед. Танзимоти волидайн бехатар баста мешавад.',
        'onboarding.slide4.title': 'Мукофотҳои воқеӣ 🎁',
        'onboarding.slide4.text': 'Кӯдакон тангаҳои ҷамъкардаро ба тӯҳфаҳои воқеӣ иваз мекунанд. Ҳавасмандии олӣ барои вазифаҳои ҳаррӯза!',
        'onboarding.btn.skip': 'Гузаштан',
        'onboarding.btn.next': 'Баъдӣ',
        'onboarding.btn.get_started': 'Оғоз'
    },
    ru: {
        'onboarding.slide1.title': 'Превратите рутину в игру! 🎮',
        'onboarding.slide1.text': 'Офарин! помогает детям выполнять ежедневные задачи с интересом. Они собирают золото и звезды, а вы наслаждаетесь их самостоятельностью.',
        'onboarding.slide2.title': 'Вы поручаете, ребенок выполняет 📝',
        'onboarding.slide2.text': 'Создавайте задачи, требуйте фотоотчеты и одобряйте их своим секретным PIN-кодом. Награды выдаются только после вашего одобрения!',
        'onboarding.slide2.default_pin': 'PIN: 0000',
        'onboarding.slide3.title': 'Безопасный детский режим 🛡️',
        'onboarding.slide3.text': 'Включите «Детский режим» на их телефоне. Все родительские настройки будут надежно заблокированы.',
        'onboarding.slide4.title': 'Реальные награды 🎁',
        'onboarding.slide4.text': 'Дети обменивают собранные монеты на реальные подарки. Отличная мотивация для выполнения ежедневных задач!',
        'onboarding.btn.skip': 'Пропустить',
        'onboarding.btn.next': 'Далее',
        'onboarding.btn.get_started': 'Начать'
    },
    en: {
        'onboarding.slide1.title': 'Turn routine into a game! 🎮',
        'onboarding.slide1.text': 'Well Done! helps children complete daily tasks with interest. They collect gold and stars while you enjoy their independence.',
        'onboarding.slide2.title': 'You assign, the child completes 📝',
        'onboarding.slide2.text': 'Create tasks, require photo reports, and approve them using your secret PIN. Rewards are given only after your approval!',
        'onboarding.slide2.default_pin': 'PIN: 0000',
        'onboarding.slide3.title': 'Safe kids mode 🛡️',
        'onboarding.slide3.text': 'Turn on "Kids mode" on their phone. All parent settings will be securely locked.',
        'onboarding.slide4.title': 'Real rewards 🎁',
        'onboarding.slide4.text': 'Children exchange collected coins for real gifts. A great motivation for daily tasks!',
        'onboarding.btn.skip': 'Skip',
        'onboarding.btn.next': 'Next',
        'onboarding.btn.get_started': 'Get Started'
    },
    uz: {
        'onboarding.slide1.title': 'Kundalik ishlarni o\'yinga aylantiring! 🎮',
        'onboarding.slide1.text': 'Ofarin bolalarga kundalik vazifalarni qiziqish bilan bajarishga yordam beradi. Ular oltin va yulduzlar yig\'ishadi, siz esa ularning mustaqilligidan zavqlanasiz.',
        'onboarding.slide2.title': 'Siz topshirasiz, bola bajaradi 📝',
        'onboarding.slide2.text': 'Vazifalar yarating, foto hisobotlarni talab qiling va ularni maxfiy PIN-kodingiz bilan tasdiqlang. Mukofotlar faqat sizning tasdiqingizdan keyin beriladi!',
        'onboarding.slide2.default_pin': 'PIN: 0000',
        'onboarding.slide3.title': 'Xavfsiz bolalar rejimi 🛡️',
        'onboarding.slide3.text': 'Ularning telefonida "Bolalar rejimi"ni yoqing. Barcha ota-ona sozlamalari ishonchli tarzda qulflanadi.',
        'onboarding.slide4.title': 'Haqiqiy mukofotlar 🎁',
        'onboarding.slide4.text': 'Bolalar yig\'ilgan tangalarni haqiqiy sovg\'alarga almashtiradilar. Kundalik vazifalar uchun ajoyib motivatsiya!',
        'onboarding.btn.skip': 'O\'tkazib yuborish',
        'onboarding.btn.next': 'Keyingi',
        'onboarding.btn.get_started': 'Boshlash'
    },
    kk: {
        'onboarding.slide1.title': 'Күнделікті істерді ойынға айналдырыңыз! 🎮',
        'onboarding.slide1.text': 'Офарин балаларға күнделікті тапсырмаларды қызығушылықпен орындауға көмектеседі. Олар алтын мен жұлдыздар жинайды, ал сіз олардың тәуелсіздігінен ләззат аласыз.',
        'onboarding.slide2.title': 'Сіз тапсырасыз, бала орындайды 📝',
        'onboarding.slide2.text': 'Тапсырмалар жасаңыз, фото есептерді талап етіңіз және оларды құпия PIN-кодпен растаңыз. Марапаттар тек сіздің растауыңыздан кейін беріледі!',
        'onboarding.slide2.default_pin': 'PIN: 0000',
        'onboarding.slide3.title': 'Қауіпсіз балалар режимі 🛡️',
        'onboarding.slide3.text': 'Олардың телефонында "Балалар режимін" қосыңыз. Ата-аналардың барлық параметрлері сенімді түрде құлыпталады.',
        'onboarding.slide4.title': 'Нағыз марапаттар 🎁',
        'onboarding.slide4.text': 'Балалар жиналған монеталарды нағыз сыйлықтарға алмастырады. Күнделікті тапсырмалар үшін тамаша мотивация!',
        'onboarding.btn.skip': 'Өткізіп жіберу',
        'onboarding.btn.next': 'Келесі',
        'onboarding.btn.get_started': 'Бастау'
    },
    ky: {
        'onboarding.slide1.title': 'Күнүмдүк иштерди оюнга айландырыңыз! 🎮',
        'onboarding.slide1.text': 'Офарин балдарга күнүмдүк тапшырмаларды кызыгуу менен аткарууга жардам берет. Алар алтын жана жылдыздарды чогултат, ал эми сиз алардын өз алдынчалыгынан ырахат аласыз.',
        'onboarding.slide2.title': 'Сиз тапшырасыз, бала аткарат 📝',
        'onboarding.slide2.text': 'Тапшырмаларды түзүңүз, сүрөт отчетторун талап кылыңыз жана аларды жашыруун PIN-кодуңуз менен ырастаңыз. Сыйлыктар сиздин ырастооңуздан кийин гана берилет!',
        'onboarding.slide2.default_pin': 'PIN: 0000',
        'onboarding.slide3.title': 'Коопсуз балдар режими 🛡️',
        'onboarding.slide3.text': 'Алардын телефонунда "Балдар режимин" күйгүзүңүз. Бардык ата-эне орнотуулары ишенимдүү кулпуланат.',
        'onboarding.slide4.title': 'Чыныгы сыйлыктар 🎁',
        'onboarding.slide4.text': 'Балдар чогултулган тыйындарды чыныгы белектерге алмаштырышат. Күнүмдүк тапшырмалар үчүн сонун мотивация!',
        'onboarding.btn.skip': 'Өткөрүп жиберүү',
        'onboarding.btn.next': 'Кийинки',
        'onboarding.btn.get_started': 'Баштоо'
    },
    tk: {
        'onboarding.slide1.title': 'Wezipeleri oýuna öwrüň! 🎮',
        'onboarding.slide1.text': 'Berekella çagalara gündelik wezipeleri höwes bilen ýerine ýetirmäge kömek edýär. Olar altyn we ýyldyz ýygnaýarlar, siz bolsa olaryň garaşsyzlygyna begenersiňiz.',
        'onboarding.slide2.title': 'Siz tabşyrýarsyňyz, çaga ýerine ýetirýär 📝',
        'onboarding.slide2.text': 'Wezipeler dörediň, surat hasabatlaryny talap ediň we olary gizlin PIN-kodyňyz bilen tassyklaň. Sylaglar diňe siziň tassyklamagyňyzdan soň berilýär!',
        'onboarding.slide2.default_pin': 'PIN: 0000',
        'onboarding.slide3.title': 'Howpsuz çagalar tertibi 🛡️',
        'onboarding.slide3.text': 'Olaryň telefonynda "Çagalar tertibini" işlediň. Ähli ene-ata sazlamalary ynamly gulplanar.',
        'onboarding.slide4.title': 'Hakyky sylaglar 🎁',
        'onboarding.slide4.text': 'Çagalar ýygnalan teňňeleri hakyky sowgatlaryna çalşyrýarlar. Gündelik wezipeler üçin ajaýyp höwes!',
        'onboarding.btn.skip': 'Geçir',
        'onboarding.btn.next': 'Indiki',
        'onboarding.btn.get_started': 'Başla'
    }
};

const langs = ['tg', 'ru', 'en', 'uz', 'kk', 'ky', 'tk'];

for (const lang of langs) {
    const searchString = `${lang}: {`;
    const langIndex = content.indexOf(searchString);
    if (langIndex !== -1) {
        const insertPosition = langIndex + searchString.length;
        const newBlock = '\n' + Object.entries(newTranslations[lang]).map(([k, v]) => `        '${k}': '${v.replace(/'/g, "\\'")}',`).join('\n') + '\n';
        content = content.substring(0, insertPosition) + newBlock + content.substring(insertPosition);
    }
}

fs.writeFileSync(filePath, content, 'utf8');
console.log('Translations inserted right after language key.');
