const fs = require('fs');
const path = require('path');

const keys = {
    'errorLabel': {'tg': 'Хатогӣ:', 'en': 'Error:', 'ru': 'Ошибка:', 'uz': 'Xato:', 'kk': 'Қателік:', 'ky': 'Ката:', 'tk': 'Ýalňyşlyk:'},
    'send': {'tg': 'Фиристодан', 'en': 'Send', 'ru': 'Отправить', 'uz': 'Yuborish', 'kk': 'Жіберу', 'ky': 'Жөнөтүү', 'tk': 'Iber'},
    'profileNotSelected': {'tg': 'Профил интихоб нашудааст', 'en': 'Profile not selected', 'ru': 'Профиль не выбран', 'uz': 'Profil tanlanmagan', 'kk': 'Профиль таңдалмады', 'ky': 'Профиль тандалган жок', 'tk': 'Profil saýlanmady'},
    'selectProfile': {'tg': 'Интихоби Профил', 'en': 'Select Profile', 'ru': 'Выбрать профиль', 'uz': 'Profilni tanlang', 'kk': 'Профильді таңдаңыз', 'ky': 'Профильди тандаңыз', 'tk': 'Profil saýlaň'},
    'myTasksList': {'tg': 'Вазифаҳои ман', 'en': 'My Tasks', 'ru': 'Мои задачи', 'uz': 'Mening vazifalarim', 'kk': 'Менің тапсырмаларым', 'ky': 'Менин тапшырмаларым', 'tk': 'Meniň wezipelerim'},
    'parentsNotCreatedTasks': {'tg': 'Волидайн ҳанӯз вазифа эҷод накардаанд.', 'en': 'Parents have not created tasks yet.', 'ru': 'Родители еще не создали задачи.', 'uz': 'Ota-onalar hali vazifalarni yaratishmagan.', 'kk': 'Ата-аналар әлі тапсырмалар жасамаған.', 'ky': 'Ата-энелер тапшырмаларды түзө элек.', 'tk': 'Ene-atalar entek wezipe döretmediler.'},
    'taskApproved': {'tg': 'Тасдиқ шуд!', 'en': 'Approved!', 'ru': 'Утверждено!', 'uz': 'Tasdiqlandi!', 'kk': 'Бекітілді!', 'ky': 'Бекитилди!', 'tk': 'Tassyklanyldy!'},
    'pointsText': {'tg': 'хол', 'en': 'points', 'ru': 'баллов', 'uz': 'ball', 'kk': 'ұпай', 'ky': 'балл', 'tk': 'bal'},
    'todayPlans': {'tg': 'Нақшаҳои имрӯза', 'en': 'Today\'s Plans', 'ru': 'Планы на сегодня', 'uz': 'Bugungi rejalar', 'kk': 'Бүгінгі жоспарлар', 'ky': 'Бүгүнкү пландар', 'tk': 'Şu günki meýilnamalar'},
    'tasksSubtitle': {'tg': 'Вазифаҳоро иҷро кун ва холҳо гир!', 'en': 'Complete tasks and earn points!', 'ru': 'Выполняй задачи и получай баллы!', 'uz': 'Vazifalarni bajaring va ball oling!', 'kk': 'Тапсырмаларды орындап, ұпай жинаңыз!', 'ky': 'Тапшырмаларды аткарып, балл алыңыз!', 'tk': 'Wezipeleri ýerine ýetiriň we bal gazanyň!'},
    'wishlistSubtitle': {'tg': 'Рӯйхати орзуҳои ту', 'en': 'Your wishlist', 'ru': 'Твой список желаний', 'uz': 'Sizning orzularingiz', 'kk': 'Сіздің тілектеріңіз', 'ky': 'Сенин каалоолоруң', 'tk': 'Siziň arzuwlaryňyz'},
    'walletSubtitle': {'tg': 'Таърихи холҳо ва мукофотҳо', 'en': 'History of points and rewards', 'ru': 'История баллов и наград', 'uz': 'Ballar va mukofotlar tarixi', 'kk': 'Ұпайлар мен марапаттар тарихы', 'ky': 'Баллдардын жана сыйлыктардын тарыхы', 'tk': 'Ballaryň we baýraklaryň taryhy'},
    'activeBadge': {'tg': 'фаъол', 'en': 'active', 'ru': 'активно', 'uz': 'faol', 'kk': 'белсенді', 'ky': 'активдүү', 'tk': 'işjeň'},
    'pendingBadge': {'tg': 'интизорӣ', 'en': 'pending', 'ru': 'в ожидании', 'uz': 'kutilmoqda', 'kk': 'күтуде', 'ky': 'күтүүдө', 'tk': 'garaşylýar'},
    'transactionsBadge': {'tg': 'Муомилот', 'en': 'Transactions', 'ru': 'Транзакции', 'uz': 'Tranzaksiyalar', 'kk': 'Транзакциялар', 'ky': 'Транзакциялар', 'tk': 'Geleşikler'},
    'todayHero': {'tg': 'Имрӯз ҳам қаҳрамон бош!', 'en': 'Be a hero today too!', 'ru': 'Будь героем и сегодня!', 'uz': 'Bugun ham qahramon bo\'l!', 'kk': 'Бүгін де батыр бол!', 'ky': 'Бүгүн да баатыр бол!', 'tk': 'Şu gün hem gahryman bol!'},
    'pendingApprovalBadge': {'tg': 'Дар интизори тасдиқи волидайн...', 'en': 'Waiting for parent approval...', 'ru': 'Ожидает подтверждения родителя...', 'uz': 'Ota-ona tasdiqlashini kutmoqda...', 'kk': 'Ата-ананың растауын күтуде...', 'ky': 'Ата-эненин ырастоосун күтүүдө...', 'tk': 'Ene-atanyň tassyklamagyna garaşylýar...'},
    'selectChild': {'tg': '👦 Интихоби Кӯдак', 'en': '👦 Select Child', 'ru': '👦 Выбор ребенка', 'uz': '👦 Bola tanlash', 'kk': '👦 Баланы таңдау', 'ky': '👦 Баланы тандоо', 'tk': '👦 Çagany saýla'},
    'noChildrenAdded': {'tg': 'Ҳанӯз кӯдаке илова нашудааст.\nАввал дар реҷаи волидайн кӯдак илова кунед.', 'en': 'No children added yet.\nFirst add a child in parent mode.', 'ru': 'Дети еще не добавлены.\nСначала добавьте ребенка в режиме родителя.', 'uz': 'Hali bolalar qo\'shilmagan.\nAvval ota-ona rejimida bola qo\'shing.', 'kk': 'Әлі балалар қосылған жоқ.\nАлдымен ата-ана режимінде бала қосыңыз.', 'ky': 'Балдар кошула элек.\nАлгач ата-эне режиминде бала кошуңуз.', 'tk': 'Entek çagalar goşulmady.\nIlki bilen ene-ata reňkinde çaga goşuň.'},
    'welcomeTitle': {'tg': 'Хуш омадед! 👋', 'en': 'Welcome! 👋', 'ru': 'Добро пожаловать! 👋', 'uz': 'Xush kelibsiz! 👋', 'kk': 'Қош келдіңіз! 👋', 'ky': 'Кош келиңиз! 👋', 'tk': 'Hoş geldiňiz! 👋'},
    'whoIsEntering': {'tg': 'Кӣ ворид мешавад?', 'en': 'Who is entering?', 'ru': 'Кто входит?', 'uz': 'Kim kiryapti?', 'kk': 'Кім кіруде?', 'ky': 'Ким кирип жатат?', 'tk': 'Kim girýär?'},
    'parentModeDesc': {'tg': 'Назорат, вазифаҳо, мукофот ва танзим', 'en': 'Control, tasks, rewards, and settings', 'ru': 'Контроль, задачи, награды и настройки', 'uz': 'Nazorat, vazifalar, mukofotlar va sozlamalar', 'kk': 'Бақылау, тапсырмалар, марапаттар және параметрлер', 'ky': 'Көзөмөл, тапшырмалар, сыйлыктар жана жөндөөлөр', 'tk': 'Gözegçilik, wezipeler, sylaglar we sazlamalar'},
    'childModeDesc': {'tg': 'Вазифаҳо, ситораҳо ва орзуҳо!', 'en': 'Tasks, stars, and wishes!', 'ru': 'Задачи, звезды и мечты!', 'uz': 'Vazifalar, yulduzlar va orzular!', 'kk': 'Тапсырмалар, жұлдыздар және армандар!', 'ky': 'Тапшырмалар, жылдыздар жана каалоолор!', 'tk': 'Wezipeler, ýyldyzlar we arzuwlar!'},
    'selectLanguage': {'tg': '🌍 Интихоби Забон', 'en': '🌍 Select Language', 'ru': '🌍 Выбор языка', 'uz': '🌍 Tilni tanlang', 'kk': '🌍 Тілді таңдау', 'ky': '🌍 Тилди тандоо', 'tk': '🌍 Dili saýla'},
    'language': {'tg': 'Забон', 'en': 'Language', 'ru': 'Язык', 'uz': 'Til', 'kk': 'Тіл', 'ky': 'Тил', 'tk': 'Dil'}
};

const dir = 'lib/l10n';
const files = fs.readdirSync(dir).filter(f => f.endsWith('.arb'));

for (const file of files) {
    const lang = file.split('_')[1].split('.')[0];
    const filepath = path.join(dir, file);
    
    let data = JSON.parse(fs.readFileSync(filepath, 'utf8'));
    let changed = false;
    for (const [key, translations] of Object.entries(keys)) {
        if (!data[key]) {
            data[key] = translations[lang] || translations['en'];
            changed = true;
        }
    }
    if (changed) {
        fs.writeFileSync(filepath, JSON.stringify(data, null, 2), 'utf8');
        console.log('Updated ' + file);
    }
}
