const fs = require('fs');
const langs = {
  tg: { appName: 'Офарин! Ту метавонӣ!', appSlogan: 'Омӯз, бозӣ кун, комёб шав!', continue: 'Идома додан', email: 'Почтаи электронӣ', password: 'Рамз', login: 'Вуруд', register: 'Бақайдгирӣ', no_account: 'Ҳисоб надоред? Сабти ном', have_account: 'Ҳисоб доред? Вуруд', auth_title: 'Хуш омадед! 👋', auth_subtitle: 'Барои идома ворид шавед ё сабти ном кунед' },
  ru: { appName: 'Молодец! Ты сможешь!', appSlogan: 'Учись, играй, достигай!', continue: 'Продолжить', email: 'Электронная почта', password: 'Пароль', login: 'Войти', register: 'Регистрация', no_account: 'Нет аккаунта? Создать', have_account: 'Есть аккаунт? Войти', auth_title: 'Добро пожаловать! 👋', auth_subtitle: 'Войдите или зарегистрируйтесь для продолжения' },
  en: { appName: 'Well Done! You Can Do It!', appSlogan: 'Learn, play, achieve!', continue: 'Continue', email: 'Email', password: 'Password', login: 'Login', register: 'Register', no_account: 'No account? Sign up', have_account: 'Have an account? Log in', auth_title: 'Welcome! 👋', auth_subtitle: 'Sign in or register to continue' },
  uz: { appName: 'Barakalla! Sen uddalaysan!', appSlogan: 'O\'rgan, o\'yna, erish!', continue: 'Davom etish', email: 'Elektron pochta', password: 'Parol', login: 'Tizimga kirish', register: 'Ro\'yxatdan o\'tish', no_account: 'Hisobingiz yo\'qmi? Ro\'yxatdan o\'ting', have_account: 'Hisobingiz bormi? Tizimga kiring', auth_title: 'Xush kelibsiz! 👋', auth_subtitle: 'Davom etish uchun kiring yoki ro\'yxatdan o\'ting' },
  kk: { appName: 'Жарайсың! Қолыңнан келеді!', appSlogan: 'Үйрен, ойна, жет!', continue: 'Жалғастыру', email: 'Электрондық пошта', password: 'Құпия сөз', login: 'Кіру', register: 'Тіркелу', no_account: 'Аккаунтыңыз жоқ па? Тіркелу', have_account: 'Аккаунтыңыз бар ма? Кіру', auth_title: 'Қош келдіңіз! 👋', auth_subtitle: 'Жалғастыру үшін кіріңіз немесе тіркеліңіз' },
  ky: { appName: 'Азамат! Колуңдан келет!', appSlogan: 'Үйрөн, ойно, жет!', continue: 'Улантуу', email: 'Электрондук почта', password: 'Сыр сөз', login: 'Кирүү', register: 'Каттоо', no_account: 'Аккаунтуңуз жокпу? Каттоо', have_account: 'Аккаунтуңуз барбы? Кирүү', auth_title: 'Кош келиңиз! 👋', auth_subtitle: 'Улантуу үчүн кириңиз же катталыңыз' },
  tk: { appName: 'Berekella! Başararsyň!', appSlogan: 'Öwren, oýna, gazan!', continue: 'Dowam et', email: 'E-poçta', password: 'Açar sözi', login: 'Giriş', register: 'Hasaba alynmak', no_account: 'Hasabyňyz ýokmy? Hasaba alynmak', have_account: 'Hasabyňyz barmy? Giriş', auth_title: 'Hoş geldiňiz! 👋', auth_subtitle: 'Dowam etmek üçin giriň ýa-da hasaba alnyň' }
};

for (const [code, data] of Object.entries(langs)) {
  fs.writeFileSync(`assets/translations/${code}.json`, JSON.stringify(data, null, 2));
}
console.log('JSON files generated.');
