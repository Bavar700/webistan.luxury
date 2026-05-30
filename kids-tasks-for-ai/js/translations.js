/**
 * Офарин / Молодец — Translation System
 * Бо забонҳои тоҷикӣ ва русӣ
 */

const TRANSLATIONS = {
    tg: {
        // App
        'app.name': 'Офарин',
        'app.name.ru': 'Офарин',
        'app.title': 'Офарин — Вазифаҳои ман 🎯',

        // Navigation
        'nav.today': 'Имрӯз',
        'nav.calendar': 'Тақвим',
        'nav.balance': 'Ҳисоб',
        'nav.settings': 'Танзимот',
        'nav.parent': 'Волидайн',

        // Common
        'save': '💾 Сабт кардан',
        'cancel': 'Бекор кардан',
        'close': 'Пӯшидан',
        'confirm': 'Тасдиқ',
        'submit': 'Пешниҳод',
        'edit': 'Тағйир',
        'delete': 'Нест кардан',
        'add': 'Илова кардан',
        'yes': 'Ҳа',
        'no': 'Не',

        // Balance
        'balance.label': 'Тавозун:',
        'balance.currency.sm': 'тилло',
        'balance.currency.somoni': 'тилло',
        'balance.star': 'ситорача',
        'balance.stars': 'ситорача',
        'balance.income': 'Даромад',
        'balance.deducted': 'Тарҳ',
        'balance.withdrawn': 'Бароварда',
        'balance.no_withdrawals': 'Ҳанӯз тилло бароварда нашудааст',
        'balance.no_tests': 'Ҳанӯз санҷише гузаронида нашудааст',
        'balance.not_enough': 'Барои баровардан тилло кофӣ нест!',
        'balance.withdraw_success': 'тилло бароварда шуд!',
        'balance.withdraw_title': 'Баровардани тилло',
        'balance.withdraw_how_much': 'Чанд тилло мехоҳед бароред?',
        'balance.withdraw_current': 'Тавозуни ҷорӣ:',
        'balance.withdraw_amount': 'Миқдор...',
        'balance.withdraw_error_amount': 'Миқдори дурустро ворид кунед!',
        'balance.withdraw_error_balance': 'Тиллои кофӣ нест!',
        'balance.stars_only': 'Ситорачаҳо',
        'balance.stars_and_money': 'Тилло ва ситорача',

        // Reward type
        'reward.type': 'Намуди мукофот',
        'reward.money': '🪙 Тилло',
        'reward.stars': '⭐ Ситорача',
        'reward.both': '🌟 Ҳарду',

        // Daily Progress
        'progress.title': 'Пешрафти имрӯз',

        // Task Status
        'status.pending': 'Интизорӣ',
        'status.in-progress': 'Дар ҷараён...',
        'status.awaiting-confirm': 'Интизори тасдиқ ⏳',
        'status.completed': '✅ Иҷро шуд',
        'status.skipped': '❌ Сарфи назар',

        // Task Card
        'task.start': '▶ Оғоз',
        'task.finish': '⏹ Тайёр',
        'task.confirm': '✅ Тасдиқ',
        'task.skip': '✕ Сарфи назар',
        'task.duration': 'дақ',
        'task.minutes': 'дақ',
        'task.bonus': '🎁 Бонус',
        'task.deadline': 'Мӯҳлат:',
        'task.deadline_days_remaining': 'рӯз монда',
        'task.deadline_today': 'Имрӯз мӯҳлат!',
        'task.deadline_passed': 'Мӯҳлат гузашт!',
        'task.deadline_no': 'Мӯҳлат нест',
        'task.all_done': '🎉 Табрик! Вазифаҳо иҷро шуданд!',
        'task.all_done_msg': 'Хуб кор кардӣ! Дар ин роҳ давом деҳ!',
        'task.skip_confirm': 'Оё шумо боварӣ доред, ки аз ин вазифа сарфи назар кардан мехоҳед?',
        'skip.title': 'Сарфи назар кардан',
        'skip.prompt': 'Сабаби сарфи назар кардани вазифаро нависед:',
        'skip.submit': 'Тасдиқ',

        // Timer
        'timer.start': '▶ Оғоз',
        'timer.pause': '⏸ Таваққуф',
        'timer.resume': '▶ Давом',
        'timer.status_working': '⏳ Кор карда истодаед...',
        'timer.status_paused': '⏸ Таваққуф карда шуд',
        'timer.status_done': 'Вазифа иҷро шуд! Волидайн тасдиқ кунад.',
        'timer.status_ready': 'Ба кор шурӯъ кунед...',
        'timer.cancel_hint': 'Барои боздоштани таймер рамзи PIN-ро ворид кунед:',
        'timer.finish_hint': 'Лутфан таймерро истифода баред ё онро боздоред',
        'timer.completed': '✅ Ба анҷом расид',

        // Confirm Modal
        'confirm.title': 'Тасдиқи вазифа',
        'confirm.question': 'Оё вазифаи {name} иҷро шудааст?',
        'confirm.pin_placeholder': '****',
        'confirm.pin_error': 'Рамзи PIN нодуруст аст!',
        'confirm.success': 'Вазифа тасдиқ шуд!',
        'confirm.exam_score': 'Баҳодиҳии имтиҳон (1-10):',

        // Excuse Day
        'excuse.title': '🙏 Рӯзи узрнок',
        'excuse.choose_reason': 'Сабаби узрнокро интихоб кунед:',
        'excuse.sickness': '🤒 Беморӣ',
        'excuse.visit': '🎉 Меҳмонӣ',
        'excuse.travel': '🚗 Сафар',
        'excuse.other': '📝 Дигар',
        'excuse.custom_placeholder': 'Сабабро нависед...',
        'excuse.error_empty': 'Сабабро ворид кунед!',
        'excuse.success': 'Рӯзи узрнок сабт шуд!',

        // PIN
        'pin.title': 'Тасдиқи волидайн',
        'pin.instruction': 'Барои тасдиқи амалиёт рамзи PIN-ро ворид кунед:',
        'pin.placeholder': '****',
        'pin.error': 'Рамзи PIN нодуруст аст!',
        'pin.settings_title': 'Ворид шавед',
        'pin.settings_instruction': 'Барои ворид шудан ба танзимот рамзи PIN-ро ворид кунед:',
        'pin.settings_enter': 'Ворид',
        'pin.parent_title': 'Тасдиқи волидайн',
        'pin.parent_instruction': 'Барои ворид шудан ба панели волидайн PIN-кодро дохил кунед:',

        // Parent page
        'parent.no_children': 'Ҳеҷ кӯдаке вуҷуд надорад',
        'parent.task_management': 'Идоракунии вазифаҳо',
        'parent.add_task_hint': 'Вазифаҳоро волидайн илова мекунад',

        // Calendar
        'calendar.title': 'Тақвим',
        'calendar.legend_completed': 'Иҷро шуда',
        'calendar.legend_incomplete': 'Иҷро нашуда',
        'calendar.legend_excused': 'Узрнок',
        'calendar.legend_pending': 'Интизорӣ',
        'calendar.no_data': 'Барои ин рӯз маълумот нест',
        'calendar.result': 'Натиҷа:',
        'calendar.test_day': 'Рӯзи санҷиш',

        'weekday.sun': 'Якш',
        'weekday.mon': 'Душ',
        'weekday.tue': 'Сеш',
        'weekday.wed': 'Чор',
        'weekday.thu': 'Пан',
        'weekday.fri': 'Ҷум',
        'weekday.sat': 'Шан',

        'month.0': 'Январ',
        'month.1': 'Феврал',
        'month.2': 'Март',
        'month.3': 'Апрел',
        'month.4': 'Май',
        'month.5': 'Июн',
        'month.6': 'Июл',
        'month.7': 'Август',
        'month.8': 'Сентябр',
        'month.9': 'Октябр',
        'month.10': 'Ноябр',
        'month.11': 'Декабр',

        // Settings
        'settings.title': 'Танзимот',
        'settings.tasks': '📋 Вазифаҳо',
        'settings.bonus': '🎁 Бонусӣ',
        'settings.children': '👶 Кӯдакон',
        'settings.settings': '⚙️ Танзимот',
        'settings.daily_tasks': '📋 Вазифаҳои ҳаррӯза',
        'settings.bonus_tasks': '🎁 Вазифаҳои бонусӣ',
        'settings.no_bonus': 'Ҳанӯз вазифаи бонусӣ нест',
        'settings.add_task': 'Вазифаи нав',
        'settings.bonus_examples': '💡 Намунаҳои вазифаҳои бонусӣ',
        'settings.children_title': '👶 Кӯдакон',
        'settings.add_child': '👶 Иловаи кӯдак',
        'settings.app_settings': 'Танзимоти барнома',
        'settings.change_pin': 'Тағйири рамзи PIN',
        'settings.change_pin_prompt': 'Рамзи PIN-и навро ворид кунед (4 рақам):',
        'settings.change_pin_error': 'Рамзи PIN бояд 4 рақам бошад!',
        'settings.change_pin_success': 'Рамзи PIN тағйир ёфт!',
        'settings.reset_data': 'Азнавсозии маълумот',
        'settings.reset_data_confirm': 'Оё шумо боварӣ доред, ки тамоми маълумотро нест кардан мехоҳед? Ин амал баргардонида намешавад!',
        'settings.data_info': 'Маълумот',
        'settings.data_size': 'Ҳаҷми маълумот',
        'settings.export': 'Содироти маълумот',
        'settings.export_success': 'Маълумот содир шуд!',
        'settings.delete_task_confirm': 'Оё шумо боварӣ доред, ки ин вазифаро нест кардан мехоҳед?',
        'settings.delete_child_confirm': 'Оё шумо боварӣ доред, ки ин кӯдакро нест кардан мехоҳед? Ҳамаи маълумоташ нест мешавад!',
        'settings.language': 'Забон',
        'settings.language_tg': 'Тоҷикӣ',
        'settings.language_ru': 'Русский',

        // Task Form
        'task_form.title_new': 'Супориши нав',
        'task_form.title_edit': 'Тағйири супориш',
        'task_form.title_new_bonus': 'Супориши бонусии нав',
        'task_form.name': 'Номи супориш',
        'task_form.name_placeholder': 'Номи супоришро ворид кунед',
        'task_form.duration': 'Давомнокӣ (дақиқа)',
        'task_form.type': 'Намуди супориш',
        'task_form.type_daily': 'Ҳаррӯза',
        'task_form.type_one_time': 'Якдафъаина',
        'task_form.type_exam': 'Санҷиш / Имтиҳон',
        'task_form.type_bonus': 'Бо подош (бонус)',
        'task_form.bonus_price': 'Нарх (сомонӣ)',
        'task_form.deadline': 'Мӯҳлат (ихтиёрӣ)',
        'task_form.deadline_none': 'Мӯҳлат надорад',
        'task_form.error_name': 'Номи супоришро ворид кунед!',
        'task_form.bonus_price_stars': 'Нарх (ситорача)',
        'task_form.instructions': 'Дастур',
        'task_form.instructions_placeholder': 'Дастур',
        'task_form.inst_image': 'Акси дастур (ихтиёрӣ)',
        'task_form.add_photo': 'Иловаи акс',
        'task_form.start_time': 'Вақти оғоз',
        'task_form.days': 'Рӯзҳои ҳафта',
        'task_form.use_timer': 'Истифодаи таймер',
        'task_form.reward_gold': 'Подош (Тилло)',
        'task_form.reward_stars': 'Подош (Ситорача)',

        // Child Form
        'child_form.title_new': '👶 Иловаи кӯдаки нав',
        'child_form.title_edit': '✏️ Тағйири кӯдак',
        'child_form.name': 'Ном',
        'child_form.name_placeholder': 'Номи кӯдак',
        'child_form.emoji': 'Эмодзи',
        'child_form.color': 'Ранг',
        'child_form.error_name': 'Номи кӯдакро ворид кунед!',

        // 10-Day Test
        'test.title': '📝 Санҷиши 10-рӯза',
        'test.instruction': 'Ба ҳар як вазифа хол диҳед (аз 0 то 1):',
        'test.total': 'Ҳамагӣ:',
        'test.reward': 'Мукофот:',
        'test.no_reward': 'Мукофот нест',
        'test.reward_amount': 'Мукофот: {amount} сомонӣ',
        'test.reward_amount_stars': 'Мукофот: {amount} ситорача',
        'test.evaluate_all': 'Лутфан ба ҳамаи вазифаҳо хол диҳед!',
        'test.result': 'Натиҷа: {score}/10',
        'test.result_reward': '{score}/10 — Мукофот: {reward} сомонӣ!',
        'test.result_reward_stars': '{score}/10 — Мукофот: {reward} ⭐!',

        // Achievements
        'achievements.title': 'Муваффақиятҳо ва нишонҳо 🏆',
        'achievement.first_task': '🌟 Вазифаи аввал',
        'achievement.desc.first_task': 'Иҷрои вазифаи аввал',
        'achievement.all_today': '⭐ Ҳамаи вазифаҳо',
        'achievement.desc.all_today': 'Иҷрои ҳамаи вазифаҳои имрӯз',
        'achievement.week_streak': '🔥 Ҳафтаи пурра',
        'achievement.desc.week_streak': '7 рӯз пай дар пай',
        'achievement.month_streak': '🏆 Моҳи тиллоӣ',
        'achievement.desc.month_streak': '30 рӯз пай дар пай',
        'achievement.test_10': '💯 Нолҳои комил',
        'achievement.desc.test_10': '10 аз 10 дар санҷиш',
        'achievement.test_9': '📚 Донишманд',
        'achievement.desc.test_9': '9 аз 10 дар санҷиш',
        'achievement.bonus_3': '🦁 Шуҷоъ',
        'achievement.desc.bonus_3': 'Иҷрои вазифаи бонусӣ 3 смн',
        'achievement.bonus_5': '🦸 Қаҳрамон',
        'achievement.desc.bonus_5': 'Иҷрои вазифаи бонусӣ 5 смн',
        'achievement.bonus_10': '🧙 Афсонавӣ',
        'achievement.desc.bonus_10': 'Иҷрои вазифаи бонусӣ 10 смн',
        'achievement.savings_10': '🐷 Сарфаҷӯ',
        'achievement.desc.savings_10': 'Ҷамъ кардани 10 сомонӣ',
        'achievement.savings_50': '👑 Сарватманд',
        'achievement.desc.savings_50': 'Ҷамъ кардани 50 сомонӣ',

        // Withdrawal history
        'withdraw.history': 'Таърихи баровардан',
        'withdraw.test_history': 'Санҷишҳои 10-рӯза 📝',

        // Day details
        'daydetails.excused': '🙏 Узрнок:',

        // Excused day view
        'excused_day.title': '🙏 Рӯзи узрнок',
        'excused_day.reason': 'Сабаб:',

        // Slogan
        'slogan': 'Ту метавонӣ!',
        'greeting.well_done': 'Офарин, {name}! Ту метавонӣ!',

        // Welcome screen
        'welcome.title': 'Хуш омадед!',
        'welcome.subtitle': 'Ба барномаи идоракунии вазифаҳои кӯдакон хуш омадед!',
        'welcome.select_language': 'Забонро интихоб кунед:',
        'welcome.tg': '🇹🇯 Тоҷикӣ',
        'welcome.ru': '🇷🇺 Русский',
        'welcome.start': 'Оғоз',

        // Proof (photo + explanation)
        'proof.label': '📸 Ба кор андешидани акс ва тавсиф:',
        'proof.add_photo': 'Акс гирифтан',
        'proof.explanation_placeholder': 'Нависед, ки чӣ кор карда шуд...',
        'proof.submit': 'Фиристодан барои тасдиқ',
        'proof.submitted': 'Акс ва тавсиф фиристода шуд! Волидайн тасдиқ мекунад.',

        // Toast messages
        'toast.saved': '💾 Сабт шуд!',
    },

    ru: {
        // App
        'app.name': 'Молодец',
        'app.name.ru': 'Молодец',
        'app.title': 'Молодец — Мои задания 🎯',

        // Navigation
        'nav.today': 'Сегодня',
        'nav.calendar': 'Календарь',
        'nav.balance': 'Счёт',
        'nav.settings': 'Настройки',
        'nav.parent': 'Родитель',

        // Common
        'save': '💾 Сохранить',
        'cancel': 'Отмена',
        'close': 'Закрыть',
        'confirm': 'Подтвердить',
        'submit': 'Отправить',
        'edit': 'Изменить',
        'delete': 'Удалить',
        'add': 'Добавить',
        'yes': 'Да',
        'no': 'Нет',

        // Balance
        'balance.label': 'Баланс:',
        'balance.currency.sm': 'зол.',
        'balance.currency.somoni': 'золото',
        'balance.star': 'звезда',
        'balance.stars': 'звёзд',
        'balance.income': 'Доход',
        'balance.deducted': 'Вычет',
        'balance.withdrawn': 'Снято',
        'balance.no_withdrawals': 'Ещё не было снятий',
        'balance.no_tests': 'Ещё не было тестов',
        'balance.not_enough': 'Недостаточно золота для снятия!',
        'balance.withdraw_success': 'золота выведено!',
        'balance.withdraw_title': 'Вывод золота',
        'balance.withdraw_how_much': 'Сколько золота хотите вывести?',
        'balance.withdraw_current': 'Текущий баланс:',
        'balance.withdraw_amount': 'Количество...',
        'balance.withdraw_error_amount': 'Введите правильное количество!',
        'balance.withdraw_error_balance': 'Недостаточно золота!',
        'balance.stars_only': 'Звёзды',
        'balance.stars_and_money': 'Золото и звёзды',

        // Reward type
        'reward.type': 'Тип награды',
        'reward.money': '🪙 Золото',
        'reward.stars': '⭐ Звёзды',
        'reward.both': '🌟 И то и другое',

        // Daily Progress
        'progress.title': 'Прогресс дня',

        // Task Status
        'status.pending': 'Ожидание',
        'status.in-progress': 'В процессе...',
        'status.awaiting-confirm': 'Ожидает подтверждения ⏳',
        'status.completed': '✅ Выполнено',
        'status.skipped': '❌ Пропущено',

        // Task Card
        'task.start': '▶ Начать',
        'task.finish': '⏹ Готово',
        'task.confirm': '✅ Подтвердить',
        'task.skip': '✕ Пропустить',
        'task.duration': 'мин',
        'task.minutes': 'мин',
        'task.bonus': '🎁 Бонус',
        'task.deadline': 'Срок:',
        'task.deadline_days_remaining': 'дн. осталось',
        'task.deadline_today': 'Сегодня срок!',
        'task.deadline_passed': 'Срок прошёл!',
        'task.deadline_no': 'Без срока',
        'task.all_done': '🎉 Поздравляю! Задания выполнены!',
        'task.all_done_msg': 'Молодец! Так держать!',
        'task.skip_confirm': 'Вы уверены, что хотите пропустить это задание?',
        'skip.title': 'Пропуск задания',
        'skip.prompt': 'Напишите причину, почему вы пропускаете это задание:',
        'skip.submit': 'Отправить',

        // Timer
        'timer.start': '▶ Старт',
        'timer.pause': '⏸ Пауза',
        'timer.resume': '▶ Продолжить',
        'timer.status_working': '⏳ Выполняется...',
        'timer.status_paused': '⏸ На паузе',
        'timer.status_done': 'Задание выполнено! Родитель должен подтвердить.',
        'timer.status_ready': 'Начинайте работу...',
        'timer.cancel_hint': 'Введите PIN-код для остановки таймера:',
        'timer.finish_hint': 'Пожалуйста, используйте таймер или остановите его',
        'timer.completed': '✅ Завершено',

        // Confirm Modal
        'confirm.title': 'Подтверждение задания',
        'confirm.question': 'Задание {name} выполнено?',
        'confirm.pin_placeholder': '****',
        'confirm.pin_error': 'Неверный PIN-код!',
        'confirm.success': 'Задание подтверждено!',
        'confirm.exam_score': 'Оценка за экзамен (1-10):',

        // Excuse Day
        'excuse.title': '🙏 Уважительная причина',
        'excuse.choose_reason': 'Выберите причину:',
        'excuse.sickness': '🤒 Болезнь',
        'excuse.visit': '🎉 Гости',
        'excuse.travel': '🚗 Поездка',
        'excuse.other': '📝 Другое',
        'excuse.custom_placeholder': 'Напишите причину...',
        'excuse.error_empty': 'Введите причину!',
        'excuse.success': 'Уважительная причина записана!',

        // PIN
        'pin.title': 'Подтверждение родителя',
        'pin.instruction': 'Введите PIN-код для подтверждения:',
        'pin.placeholder': '****',
        'pin.error': 'Неверный PIN-код!',
        'pin.settings_title': 'Войти',
        'pin.settings_instruction': 'Введите PIN-код для входа в настройки:',
        'pin.settings_enter': 'Войти',
        'pin.parent_title': 'Подтверждение родителя',
        'pin.parent_instruction': 'Введите PIN-код для входа в панель родителя:',

        // Parent page
        'parent.no_children': 'Нет добавленных детей',
        'parent.task_management': 'Управление заданиями',
        'parent.add_task_hint': 'Задания добавляет родитель',

        // Calendar
        'calendar.title': 'Календарь',
        'calendar.legend_completed': 'Выполнено',
        'calendar.legend_incomplete': 'Не выполнено',
        'calendar.legend_excused': 'Уваж. причина',
        'calendar.legend_pending': 'Ожидание',
        'calendar.no_data': 'Нет данных за этот день',
        'calendar.result': 'Результат:',
        'calendar.test_day': 'День теста',

        'weekday.sun': 'Вс',
        'weekday.mon': 'Пн',
        'weekday.tue': 'Вт',
        'weekday.wed': 'Ср',
        'weekday.thu': 'Чт',
        'weekday.fri': 'Пт',
        'weekday.sat': 'Сб',

        'month.0': 'Январь',
        'month.1': 'Февраль',
        'month.2': 'Март',
        'month.3': 'Апрель',
        'month.4': 'Май',
        'month.5': 'Июнь',
        'month.6': 'Июль',
        'month.7': 'Август',
        'month.8': 'Сентябрь',
        'month.9': 'Октябрь',
        'month.10': 'Ноябрь',
        'month.11': 'Декабрь',

        // Settings
        'settings.title': 'Настройки',
        'settings.tasks': '📋 Задания',
        'settings.bonus': '🎁 Бонусные',
        'settings.children': '👶 Дети',
        'settings.settings': '⚙️ Настройки',
        'settings.daily_tasks': '📋 Ежедневные задания',
        'settings.bonus_tasks': '🎁 Бонусные задания',
        'settings.no_bonus': 'Бонусных заданий пока нет',
        'settings.add_task': 'Новое задание',
        'settings.bonus_examples': '💡 Примеры бонусных заданий',
        'settings.children_title': '👶 Дети',
        'settings.add_child': '👶 Добавить ребёнка',
        'settings.app_settings': 'Настройки приложения',
        'settings.change_pin': 'Изменить PIN-код',
        'settings.change_pin_prompt': 'Введите новый PIN-код (4 цифры):',
        'settings.change_pin_error': 'PIN-код должен состоять из 4 цифр!',
        'settings.change_pin_success': 'PIN-код изменён!',
        'settings.reset_data': 'Сбросить данные',
        'settings.reset_data_confirm': 'Вы уверены, что хотите удалить все данные? Это действие нельзя отменить!',
        'settings.data_info': 'Данные',
        'settings.data_size': 'Размер данных',
        'settings.export': 'Экспорт данных',
        'settings.export_success': 'Данные экспортированы!',
        'settings.delete_task_confirm': 'Вы уверены, что хотите удалить это задание?',
        'settings.delete_child_confirm': 'Вы уверены, что хотите удалить этого ребёнка? Все данные будут удалены!',
        'settings.language': 'Язык',
        'settings.language_tg': 'Тоҷикӣ',
        'settings.language_ru': 'Русский',

        // Task Form
        'task_form.title_new': '➕ Новое задание',
        'task_form.title_edit': '✏️ Изменить задание',
        'task_form.title_new_bonus': '🎁 Новое бонусное задание',
        'task_form.name': 'Название задания',
        'task_form.name_placeholder': 'Введите название задания',
        'task_form.duration': 'Длительность (минуты)',
        'task_form.type': 'Тип задания',
        'task_form.type_daily': 'Ежедневное',
        'task_form.type_one_time': 'Одноразовое',
        'task_form.type_exam': 'Тест / Экзамен',
        'task_form.type_bonus': 'С наградой (бонус)',
        'task_form.bonus_price': 'Цена (сомони)',
        'task_form.deadline': 'Срок (необязательно)',
        'task_form.deadline_none': 'Без срока',
        'task_form.error_name': 'Введите название задания!',
        'task_form.bonus_price_stars': 'Цена (звёзды)',
        'task_form.instructions': 'Инструкция',
        'task_form.instructions_placeholder': 'Инструкция',
        'task_form.inst_image': 'Фото инструкции (необязательно)',
        'task_form.add_photo': 'Добавить фото',
        'task_form.start_time': 'Время начала',
        'task_form.days': 'Дни недели',
        'task_form.use_timer': 'Использовать таймер',
        'task_form.reward_gold': 'Награда (Золото)',
        'task_form.reward_stars': 'Награда (Звёзды)',

        // Child Form
        'child_form.title_new': '👶 Добавить ребёнка',
        'child_form.title_edit': '✏️ Изменить ребёнка',
        'child_form.name': 'Имя',
        'child_form.name_placeholder': 'Имя ребёнка',
        'child_form.emoji': 'Эмодзи',
        'child_form.color': 'Цвет',
        'child_form.error_name': 'Введите имя ребёнка!',

        // 10-Day Test
        'test.title': '📝 10-дневный тест',
        'test.instruction': 'Оцените каждое задание (от 0 до 1):',
        'test.total': 'Всего:',
        'test.reward': 'Награда:',
        'test.no_reward': 'Нет награды',
        'test.reward_amount': 'Награда: {amount} сомони',
        'test.reward_amount_stars': 'Награда: {amount} ⭐',
        'test.evaluate_all': 'Пожалуйста, оцените все задания!',
        'test.result': 'Результат: {score}/10',
        'test.result_reward': '{score}/10 — Награда: {reward} сомони!',
        'test.result_reward_stars': '{score}/10 — Награда: {reward} ⭐!',

        // Achievements
        'achievements.title': 'Достижения и награды 🏆',
        'achievement.first_task': '🌟 Первое задание',
        'achievement.desc.first_task': 'Выполнение первого задания',
        'achievement.all_today': '⭐ Все задания',
        'achievement.desc.all_today': 'Выполнение всех заданий дня',
        'achievement.week_streak': '🔥 Целая неделя',
        'achievement.desc.week_streak': '7 дней подряд',
        'achievement.month_streak': '🏆 Золотой месяц',
        'achievement.desc.month_streak': '30 дней подряд',
        'achievement.test_10': '💯 Идеальный тест',
        'achievement.desc.test_10': '10 из 10 в тесте',
        'achievement.test_9': '📚 Знаток',
        'achievement.desc.test_9': '9 из 10 в тесте',
        'achievement.bonus_3': '🦁 Храбрец',
        'achievement.desc.bonus_3': 'Выполнение бонуса 3 сомони',
        'achievement.bonus_5': '🦸 Герой',
        'achievement.desc.bonus_5': 'Выполнение бонуса 5 сомони',
        'achievement.bonus_10': '🧙 Волшебник',
        'achievement.desc.bonus_10': 'Выполнение бонуса 10 сомони',
        'achievement.savings_10': '🐷 Копилка',
        'achievement.desc.savings_10': 'Накопить 10 сомони',
        'achievement.savings_50': '👑 Богач',
        'achievement.desc.savings_50': 'Накопить 50 сомони',

        // Withdrawal history
        'withdraw.history': 'История снятий',
        'withdraw.test_history': '10-дневные тесты 📝',

        // Day details
        'daydetails.excused': '🙏 Причина:',

        // Excused day view
        'excused_day.title': '🙏 Уважительная причина',
        'excused_day.reason': 'Причина:',

        // Slogan
        'slogan': 'Ты сможешь!',
        'greeting.well_done': 'Молодец, {name}! Ты можешь!',

        // Welcome screen
        'welcome.title': 'Добро пожаловать!',
        'welcome.subtitle': 'Добро пожаловать в приложение для управления детскими заданиями!',
        'welcome.select_language': 'Выберите язык:',
        'welcome.tg': '🇹🇯 Тоҷикӣ',
        'welcome.ru': '🇷🇺 Русский',
        'welcome.start': 'Начать',

        // Proof (photo + explanation)
        'proof.label': '📸 Прикрепить фото и описание:',
        'proof.add_photo': 'Сделать фото',
        'proof.explanation_placeholder': 'Напишите, что сделано...',
        'proof.submit': 'Отправить на подтверждение',
        'proof.submitted': 'Фото и описание отправлены! Родитель подтвердит.',

        // Toast messages
        'toast.saved': '💾 Сохранено!',
    }
};

/**
 * Қадамҳои моҳ / Месяцы
 */
const LANG_MONTHS = {
    tg: [
        'Январ', 'Феврал', 'Март', 'Апрел', 'Май', 'Июн',
        'Июл', 'Август', 'Сентябр', 'Октябр', 'Ноябр', 'Декабр'
    ],
    ru: [
        'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
        'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
    ]
};

const LANG_WEEKDAYS = {
    tg: ['Якш', 'Душ', 'Сеш', 'Чор', 'Пан', 'Ҷум', 'Шан'],
    ru: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб']
};

// Current language
let currentLang = 'tg';

function setLanguage(lang) {
    if (lang === 'tg' || lang === 'ru') {
        currentLang = lang;
    }
}

function getLanguage() {
    return currentLang;
}

/**
 * Get translated string by key
 * Supports {variable} placeholders
 * Usage: __('task.deadline') or __('test.result_reward', {score: 10, reward: 2})
 */
function __(key, params = null) {
    const langData = TRANSLATIONS[currentLang];
    let value = langData[key];

    // Fallback to Tajik if not found in Russian
    if (!value && currentLang === 'ru') {
        value = TRANSLATIONS.tg[key];
    }

    if (!value) {
        console.warn(`Translation key not found: "${key}" for language "${currentLang}"`);
        return key;
    }

    if (params) {
        Object.keys(params).forEach(k => {
            value = value.replace(`{${k}}`, params[k]);
        });
    }

    return value;
}

/**
 * Get month name in current language
 */
function __month(index) {
    return LANG_MONTHS[currentLang][index] || LANG_MONTHS.tg[index] || '';
}

/**
 * Get weekday name in current language
 */
function __weekday(index) {
    return LANG_WEEKDAYS[currentLang][index] || LANG_WEEKDAYS.tg[index] || '';
}
