/**
 * Офарин / Молодец — Kids Task Manager
 * Data management module
 */

const STORAGE_KEY = 'kids_tasks_app';
const DEFAULT_PIN = '0000';

const DEFAULT_TASKS = [
    { id: 'wash', name: 'Шустушӯи дасту рӯй', duration: 10, order: 1, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1, 2, 3, 4, 5, 6, 0], startTime: '12:00' },
    { id: 'exercise', name: 'Машқи ҷисмонӣ', duration: 10, order: 2, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1, 2, 3, 4, 5, 6, 0], startTime: '12:00' },
    { id: 'bible', name: 'Хондани Китоби Муқаддас ва дуо', duration: 20, order: 3, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1, 2, 3, 4, 5, 6, 0], startTime: '12:00' },
    { id: 'solfeggio', name: 'Сольфеджио (нотаҳо)', duration: 20, order: 4, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1, 2, 3, 4, 5, 6, 0], startTime: '12:00' },
    { id: 'piano', name: 'Машқи фортопиано', duration: 20, order: 5, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1, 2, 3, 4, 5, 6, 0], startTime: '12:00' },
    { id: 'calligraphy', name: 'Машқи ҳусни хат', duration: 20, order: 6, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1, 2, 3, 4, 5, 6, 0], startTime: '12:00' },
    { id: 'mult', name: 'Ҷадвали зарб', duration: 20, order: 7, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1, 2, 3, 4, 5, 6, 0], startTime: '12:00' }
];

const ACHIEVEMENTS = [
    { id: 'first_task', name: '🌟 Супориши аввал', icon: '🎯', desc: 'Иҷрои 3 супориши аввал' },
    { id: 'all_today', name: '⭐ Ҳамаи супоришҳо', icon: '⭐', desc: 'Иҷрои ҳамаи супоришҳои имрӯз' },
    { id: 'week_streak', name: '🔥 Ҳафтаи пурра', icon: '🔥', desc: '7 рӯз пай дар пай' },
    { id: 'month_streak', name: '🏆 Моҳи тиллоӣ', icon: '🏆', desc: '30 рӯз пай дар пай' },
    { id: 'perfect_zeroes', name: '💯 Сифрҳои комил', icon: '💯', desc: '30 рӯз бе ҷарима' },
    { id: 'fast_worker', name: '⚡ Зудамал', icon: '⚡', desc: '30 рӯз бе деркунӣ' },
    { id: 'early_bird', name: '🌅 Саҳархез', icon: '🌅', desc: '30 рӯз оғози супоришҳо то соати 7:00' },
    { id: 'helper', name: '🤝 Дастёр', icon: '🤝', desc: 'Иҷрои 10 супориши бонусӣ' },
    { id: 'marksman', name: '🎯 Ҳадафрас', icon: '🎯', desc: '50 супориш дар умум' },
    { id: 'test_9', name: '📚 Донишманд', icon: '📚', desc: '9 аз 10 дар санҷиш' },
    { id: 'bonus_3', name: '🦁 Шуҷоъ', icon: '🦁', desc: 'Иҷрои 10 супориши бонусӣ 3 🪙' },
    { id: 'bonus_5', name: '🦸 Қаҳрамон', icon: '🦸', desc: 'Иҷрои 10 супориши бонусӣ 5 🪙' },
    { id: 'bonus_10', name: '🧙 Афсонавӣ', icon: '🧙', desc: 'Иҷрои 10 супориши бонусӣ 10 🪙' },
    { id: 'savings_100', name: '🪙 Сарфакор', icon: '🪙', desc: 'Ҷамъ кардани 100 🪙' },
    { id: 'savings_50', name: '💰 Сарватманд', icon: '💰', desc: 'Ҷамъ кардани 500 🪙' }
];

const MOTIVATIONAL_QUOTES_TG = [
    'Тарбия — беҳтарин сармояест, ки падару модар ба фарзанди худ медиҳад. 💫',
    'Кӯшиш кардан — аллакай муваффақият аст! 🚀',
    'Ҳар як рӯз имконияти наве барои беҳтар шудан аст. 🌅',
    'Илм — чароғи роҳи зиндагӣ аст. 📚',
    'Бо меҳнат ва сабр ба ҳар ҳадаф расидан мумкин аст. 🎯',
    'Парвардигоро, илму ҳикмат ба ман ато фармо! 🤲',
    'Китоб — беҳтарин дӯсти инсон аст. 📖',
    'Вақт — тиллост, онро беҳуда сарф накун! ⏰',
    'Ҳар як кори хуб — садақа аст. 💝',
    'Бо тартиб ва интизом ба муваффақият мерасӣ! 📋',
    'Дониш — қудрат аст! 💪',
    'Имрӯз кӯшиш кун, то фардо беҳтар гардӣ. 🌟',
    'Аз хатоҳо омӯз, лекин ҳеҷ гоҳ таслим нашав! 🔥',
    'Пайвастагӣ калиди муваффақият аст. 🔑',
    'Тан дароз, ақл солим! 🏃',
    'Мусиқӣ — ғизои рӯҳ аст. 🎵',
    'Хатти зебо — ойинаи фикри соф аст. ✍️',
    'Риёзиёт — асоси ҳамаи илмҳост. 🔢',
    'Дуо — қувваи рӯҳонист. 🙏',
    'Агар хоҳӣ, ки ҷаҳон тағйир ёбад, аз худат сар кун! 🌍'
];

const MOTIVATIONAL_QUOTES_RU = [
    'Воспитание — лучшее богатство, которое родители дарят своему ребёнку. 💫',
    'Попробовать — уже успех! 🚀',
    'Каждый день — новая возможность стать лучше. 🌅',
    'Знания — свет в пути жизни. 📚',
    'Трудом и терпением можно достичь любой цели. 🎯',
    'Господи, даруй мне знания и мудрость! 🤲',
    'Книга — лучший друг человека. 📖',
    'Время — золото, не трать его напрасно! ⏰',
    'Каждое доброе дело — милостыня. 💝',
    'Порядок и дисциплина ведут к успеху! 📋',
    'Знание — сила! 💪',
    'Старайся сегодня, чтобы завтра стало лучше. 🌟',
    'Учись на ошибках, но никогда не сдавайся! 🔥',
    'Постоянство — ключ к успеху. 🔑',
    'В здоровом теле — здоровый дух! 🏃',
    'Музыка — пища для души. 🎵',
    'Красивый почерк — зеркало чистой мысли. ✍️',
    'Математика — основа всех наук. 🔢',
    'Молитва — духовная сила. 🙏',
    'Хочешь изменить мир — начни с себя! 🌍'
];

function getQuotes() {
    return currentLang === 'ru' ? MOTIVATIONAL_QUOTES_RU : MOTIVATIONAL_QUOTES_TG;
}

const BONUS_TASK_EXAMPLES = [
    { name: 'Тоза кардани ҳуҷра', emoji: '🧹' },
    { name: 'Шустани зарфҳо', emoji: '🍽️' },
    { name: 'Кӯмак ба модар', emoji: '👩‍👦' },
    { name: 'Об додан ба гулҳо', emoji: '🌺' },
    { name: 'Хондани китоби иловагӣ', emoji: '📕' },
    { name: 'Ёд гирифтани оят', emoji: '📜' },
    { name: 'Расм кашидан', emoji: '🎨' },
    { name: 'Тартиб додани китобҳо', emoji: '📚' }
];

// ===== STATE =====
let state = null;
let currentChildId = null;
let currentPage = 'dashboard';

// ===== DATA FUNCTIONS =====

function generateId() {
    return Date.now().toString(36) + Math.random().toString(36).substr(2, 5);
}

function loadState() {
    try {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (saved) {
            state = JSON.parse(saved);
            // Set language if saved
            if (state.language) {
                setLanguage(state.language);
            }
            // Migrate old data: add deadline, rewardType, stars fields if missing
            state.children.forEach(child => {
                if (!child.rewardType) child.rewardType = 'money';
                if (child.stars === undefined) child.stars = 0;
                if (child.totalStars === undefined) child.totalStars = 0;
                if (child.achievements === undefined) child.achievements = [];
                if (!child.withdrawals) child.withdrawals = [];
                
                const migrateTask = (t, isBonusDefault) => {
                    if (t.deadline === undefined) t.deadline = '';
                    if (t.type === undefined) t.type = t.isBonus ? 'bonus' : 'daily';
                    if (t.rewardGold === undefined) t.rewardGold = t.bonusPrice || (isBonusDefault ? 3 : 1);
                    if (t.rewardStars === undefined) t.rewardStars = isBonusDefault ? 0 : 1;
                    if (t.useTimer === undefined) t.useTimer = true;
                    if (t.days === undefined) t.days = [1, 2, 3, 4, 5, 6, 0];
                    if (t.startTime === undefined) t.startTime = '12:00';
                };

                child.tasks.forEach(t => migrateTask(t, false));
                child.bonusTasks.forEach(t => migrateTask(t, true));
            });
            return;
        }
    } catch (e) {
        console.warn('Failed to load state:', e);
    }
    // First launch — show welcome screen
    window._isFirstLaunch = true;

    // Create default state
    state = {
        pin: DEFAULT_PIN,
        language: 'tg',
        children: [{
            id: 'yusufkhuja',
            name: 'Юсуфхӯҷа',
            emoji: '👦',
            color: '#6C63FF',
            rewardType: 'both',
            tasks: JSON.parse(JSON.stringify(DEFAULT_TASKS)),
            bonusTasks: [],
            dailyLogs: {},
            tenDayTests: [],
            balance: 0,
            stars: 0,
            totalEarned: 0,
            totalDeducted: 0,
            totalStars: 0,
            withdrawals: []
        }]
    };
    currentChildId = 'yusufkhuja';
    setLanguage('tg');
    saveState();
}

function saveState() {
    try {
        state.language = getLanguage();
        localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
    } catch (e) {
        console.warn('Failed to save state:', e);
    }
}

function getChild(id) {
    return state.children.find(c => c.id === id);
}

function getCurrentChild() {
    if (!currentChildId && state && state.children && state.children.length > 0) {
        currentChildId = state.children[0].id;
    }
    return getChild(currentChildId);
}

function getToday() {
    return new Date().toISOString().split('T')[0];
}

function formatDate(dateStr) {
    const d = new Date(dateStr + 'T12:00:00');
    return `${d.getDate()} ${__month(d.getMonth())}`;
}

// ===== REWARD TYPE HELPERS =====

function getRewardSymbol(child) {
    const rt = child.rewardType || 'money';
    if (rt === 'stars') return '⭐';
    if (rt === 'both') return '💰';
    return '💰';
}

function formatBalanceAmount(child, amount) {
    const rt = child.rewardType || 'money';
    if (rt === 'money') return `${amount} ${__('balance.currency.sm')}`;
    if (rt === 'stars') return `${amount} ⭐`;
    return `${amount} ${__('balance.currency.sm')}`;
}

function formatBalanceFull(child) {
    const rt = child.rewardType || 'money';
    if (rt === 'money') return `${child.balance} 🪙`;
    if (rt === 'stars') return `${child.stars || 0} ⭐`;
    return `${child.balance} 🪙 | ${child.stars || 0} ⭐`;
}

function getDailyRewardAmounts(child) {
    const rt = child.rewardType || 'money';
    if (rt === 'money') return { main: 1, deduct: -1 };
    if (rt === 'stars') return { main: 1, deduct: -1 }; // 1 star for all done, -1 star for not
    return { main: 1, deduct: -1, starMain: 1, starDeduct: -1 };
}

function getTestRewardAmounts(child, score) {
    const rt = child.rewardType || 'money';
    let moneyReward = 0;
    let starReward = 0;
    if (score === 10) { moneyReward = 2; starReward = 2; }
    else if (score === 9) { moneyReward = 1; starReward = 1; }

    if (rt === 'money') return { text: `${moneyReward} ${__('balance.currency.sm')}`, money: moneyReward, stars: 0 };
    if (rt === 'stars') return { text: `${starReward} ⭐`, money: 0, stars: starReward };
    return { text: `${moneyReward} ${__('balance.currency.sm')} + ${starReward} ⭐`, money: moneyReward, stars: starReward };
}

// ===== DAILY LOGS =====

function getOrCreateDailyLog(childId) {
    const child = getChild(childId);
    const today = getToday();
    if (!child.dailyLogs[today]) {
        // Clean up completed one-time tasks from active list
        const completedOneTimeIds = [];
        child.tasks.forEach(t => {
            if (t.type === 'one-time') {
                for (const dateStr in child.dailyLogs) {
                    const log = child.dailyLogs[dateStr];
                    if (log.tasks && log.tasks[t.id]) {
                        if (log.tasks[t.id].status === 'completed' && log.tasks[t.id].confirmed) {
                            completedOneTimeIds.push(t.id);
                            break;
                        }
                    }
                }
            }
        });
        if (completedOneTimeIds.length > 0) {
            child.tasks = child.tasks.filter(t => !completedOneTimeIds.includes(t.id));
        }

        child.dailyLogs[today] = {
            tasks: {},
            allCompleted: false,
            partiallyCompleted: false,
            excused: false,
            excuseReason: '',
            rewardApplied: false
        };
        syncDailyLogTasks(child, today);
        saveState();
    } else {
        syncDailyLogTasks(child, today);
    }
    return child.dailyLogs[today];
}

function syncDailyLogTasks(child, dateStr) {
    const log = child.dailyLogs[dateStr];
    if (!log) return;

    const allTasks = [...child.tasks, ...child.bonusTasks];
    allTasks.forEach(t => {
        if (!log.tasks[t.id]) {
            log.tasks[t.id] = {
                status: 'pending',
                confirmed: false,
                timeSpent: 0,
                startedAt: null,
                photo: null,
                explanation: ''
            };
        }
    });

    const validTaskIds = new Set(allTasks.map(t => t.id));
    Object.keys(log.tasks).forEach(taskId => {
        if (!validTaskIds.has(taskId)) {
            delete log.tasks[taskId];
        }
    });

    saveState();
}

function getDailyLog(childId, date) {
    const child = getChild(childId);
    return child.dailyLogs[date] || null;
}

// ===== ACCOUNTING =====

function calculateDailyReward(childId, date) {
    const child = getChild(childId);
    const log = child.dailyLogs[date];
    if (!log) return { reward: 0, reason: 'no_log', starReward: 0 };
    if (log.excused) return { reward: 0, reason: 'excused', starReward: 0 };
    if (log.rewardApplied) return { reward: 0, reason: 'already_applied', starReward: 0 };

    const todayDay = new Date(date + 'T12:00:00').getDay();
    const regularTasks = child.tasks.filter(t => !t.isBonus && (t.type !== 'daily' || !t.days || t.days.includes(todayDay)));
    let completedCount = 0;
    let totalCount = regularTasks.length;

    let regularGold = 0;
    let regularStars = 0;
    let regularMedals = 0;

    regularTasks.forEach(t => {
        const taskLog = log.tasks[t.id];
        if (taskLog && taskLog.status === 'completed' && taskLog.confirmed) {
            completedCount++;
            regularGold += parseInt(t.rewardGold !== undefined ? t.rewardGold : 1) || 0;
            regularStars += parseInt(t.rewardStars !== undefined ? t.rewardStars : 1) || 0;
            regularMedals += parseInt(t.rewardMedals !== undefined ? t.rewardMedals : 0) || 0;
        }
    });

    // Count bonus tasks separately
    let bonusGold = 0;
    let bonusStars = 0;
    let bonusMedals = 0;
    child.bonusTasks.forEach(t => {
        const taskLog = log.tasks[t.id];
        if (taskLog && taskLog.status === 'completed' && taskLog.confirmed) {
            bonusGold += parseInt(t.rewardGold !== undefined ? t.rewardGold : (t.bonusPrice || 0)) || 0;
            bonusStars += parseInt(t.rewardStars !== undefined ? t.rewardStars : 0) || 0;
            bonusMedals += parseInt(t.rewardMedals !== undefined ? t.rewardMedals : 0) || 0;
        }
    });

    if (completedCount === 0 && bonusGold === 0 && bonusStars === 0 && bonusMedals === 0) {
        return { reward: 0, reason: 'none_done', starReward: 0, medalReward: 0 };
    } else if (completedCount < totalCount) {
        return {
            reward: regularGold + bonusGold,
            reason: 'partial',
            starReward: regularStars + bonusStars,
            medalReward: regularMedals + bonusMedals
        };
    } else {
        return {
            reward: regularGold + bonusGold,
            reason: 'all_done',
            starReward: regularStars + bonusStars,
            medalReward: regularMedals + bonusMedals
        };
    }
}

function applyDailyReward(childId, date) {
    const child = getChild(childId);
    const log = child.dailyLogs[date];
    if (!log || log.rewardApplied) return;

    const result = calculateDailyReward(childId, date);

    if (result.reward > 0) {
        child.balance += result.reward;
        child.totalEarned += result.reward;
    } else if (result.reward < 0) {
        child.totalDeducted += Math.abs(result.reward);
    }
    
    if (result.starReward > 0) {
        if (!child.stars) child.stars = 0;
        child.stars += result.starReward;
        child.totalStars = (child.totalStars || 0) + result.starReward;
    }
    
    if (result.medalReward > 0) {
        if (!child.medals) child.medals = 0;
        child.medals += result.medalReward;
        child.totalMedals = (child.totalMedals || 0) + result.medalReward;
    }
    
    log.rewardApplied = true;
    saveState();
}

// ===== 10-DAY TEST =====

function checkAndCreateTest(childId) {
    const child = getChild(childId);
    const logs = child.dailyLogs;
    const dates = Object.keys(logs).sort().reverse();

    const lastTest = child.tenDayTests.length > 0
        ? child.tenDayTests[child.tenDayTests.length - 1]
        : null;

    const today = getToday();
    const todayDate = new Date(today + 'T12:00:00');

    let countDays = 0;
    let lastTestDate = lastTest ? new Date(lastTest.date + 'T12:00:00') : null;

    for (const date of dates) {
        const d = new Date(date + 'T12:00:00');
        if (lastTestDate && d <= lastTestDate) break;
        if (d > todayDate) continue;
        const log = logs[date];
        if (log && !log.excused) {
            countDays++;
        }
    }

    const hasTestToday = child.tenDayTests.some(t => t.date === today);

    if (countDays >= 10 && !hasTestToday) {
        const test = {
            id: generateId(),
            date: today,
            completed: false,
            scores: {},
            totalScore: 0,
            reward: 0,
            starReward: 0
        };
        child.tasks.forEach(t => {
            test.scores[t.id] = -1;
        });
        child.tenDayTests.push(test);
        saveState();
        return test;
    }
    return null;
}

function evaluateTest(childId, testId, scores) {
    const child = getChild(childId);
    const test = child.tenDayTests.find(t => t.id === testId);
    if (!test) return;

    test.scores = scores;
    let total = 0;
    Object.values(scores).forEach(s => { total += s; });
    test.totalScore = total;

    const rt = child.rewardType || 'money';
    let reward = 0;
    let starReward = 0;
    if (total === 10) { reward = 2; starReward = 2; }
    else if (total === 9) { reward = 1; starReward = 1; }

    test.reward = reward;
    test.starReward = starReward;
    test.completed = true;

    if (reward > 0 && (rt === 'money' || rt === 'both')) {
        child.balance += reward;
        child.totalEarned += reward;
    }
    if (starReward > 0 && (rt === 'stars' || rt === 'both')) {
        if (!child.stars) child.stars = 0;
        child.stars += starReward;
        child.totalStars = (child.totalStars || 0) + starReward;
    }

    saveState();
}

// ===== ACHIEVEMENTS =====

function getAchievementProgress(child, id) {
    if (!child) return { current: 0, target: 1, formatted: '0 / 1' };
    
    child.achievementTier = child.achievementTier || 0;
    const m = Math.pow(2, Math.min(2, child.achievementTier));
    const earned = child.achievements ? child.achievements.includes(id) : false;
    
    if (earned) {
        let target = 1;
        if (id === 'week_streak') target = 7 * m;
        else if (id === 'month_streak') target = 30 * m;
        else if (id === 'perfect_zeroes') target = 30 * m;
        else if (id === 'fast_worker') target = 30 * m;
        else if (id === 'helper') target = 10 * m;
        else if (id === 'marksman') target = 50 * m;
        else if (id === 'savings_100') target = 100 * m;
        else if (id === 'savings_50') target = 500 * m;
        return { current: target, target: target, formatted: `${target} / ${target}` };
    }
    
    switch (id) {
        case 'first_task': {
            let totalCompleted = 0;
            Object.values(child.dailyLogs).forEach(log => {
                Object.values(log.tasks).forEach(t => {
                    if (t.status === 'completed' && t.confirmed) {
                        totalCompleted++;
                    }
                });
            });
            return { current: Math.min(3, totalCompleted), target: 3, formatted: `${Math.min(3, totalCompleted)} / 3` };
        }
        case 'all_today': {
            const todayLog = child.dailyLogs[getToday()];
            if (!todayLog) return { current: 0, target: 1, formatted: '0 / 1' };
            const allTasks = child.tasks.filter(t => !t.isBonus);
            if (allTasks.length === 0) return { current: 0, target: 1, formatted: '0 / 1' };
            const doneCount = allTasks.filter(t => {
                const tl = todayLog.tasks[t.id];
                return tl && tl.status === 'completed' && tl.confirmed;
            }).length;
            return { current: doneCount, target: allTasks.length, formatted: `${doneCount} / ${allTasks.length}` };
        }
        case 'week_streak':
        case 'month_streak':
        case 'perfect_zeroes':
        case 'fast_worker': {
            const dates = Object.keys(child.dailyLogs).sort().reverse();
            let currentStreak = 0;
            let onTimeStreak = 0;
            let onTimeStreakBroken = false;
            let noPenaltyStreak = 0;
            let noPenaltyStreakBroken = false;
            const todayStr = getToday();
            const todayD = new Date(todayStr + 'T12:00:00');

            for (let i = 0; i < dates.length; i++) {
                const d = new Date(dates[i] + 'T12:00:00');
                const expected = new Date(todayD);
                expected.setDate(expected.getDate() - i);
                if (d.toDateString() === expected.toDateString()) {
                    const log = child.dailyLogs[dates[i]];
                    if (log && !log.excused && log.rewardApplied) {
                        const result = calculateDailyReward(child.id, dates[i]);
                        if (result.reward >= 0) {
                            currentStreak++;
                            if (!onTimeStreakBroken) {
                                const missedAny = Object.values(log.tasks).some(t => t.status === 'completed' && t.missedDeadline);
                                if (!missedAny) onTimeStreak++;
                                else onTimeStreakBroken = true;
                            }
                            if (!noPenaltyStreakBroken) {
                                const penaltyAny = Object.values(log.tasks).some(t => t.penaltyApplied && (t.penaltyApplied.stars > 0 || t.penaltyApplied.gold > 0));
                                if (!penaltyAny) noPenaltyStreak++;
                                else noPenaltyStreakBroken = true;
                            }
                        } else { break; }
                    } else if (log && log.excused) {
                        continue;
                    } else { break; }
                } else { break; }
            }
            
            const daysText = __('achievement_modal.days_suffix') || 'рӯз';
            if (id === 'week_streak') {
                const target = 7 * m;
                return { current: currentStreak, target: target, formatted: `${currentStreak} / ${target} ${daysText}` };
            }
            if (id === 'month_streak') {
                const target = 30 * m;
                return { current: currentStreak, target: target, formatted: `${currentStreak} / ${target} ${daysText}` };
            }
            if (id === 'fast_worker') {
                const target = 30 * m;
                return { current: onTimeStreak, target: target, formatted: `${onTimeStreak} / ${target} ${daysText}` };
            }
            if (id === 'perfect_zeroes') {
                const target = 30 * m;
                return { current: noPenaltyStreak, target: target, formatted: `${noPenaltyStreak} / ${target} ${daysText}` };
            }
            break;
        }
        case 'early_bird': {
            const morningStreak = calculateBlockStreak(child, 'morning');
            const target = 7;
            const daysText = __('achievement_modal.days_suffix') || 'рӯз';
            return { current: morningStreak, target: target, formatted: `${morningStreak} / ${target} ${daysText}` };
        }
        case 'helper':
        case 'marksman': {
            let totalTasksCompleted = 0;
            let bonusCount = 0;
            Object.values(child.dailyLogs).forEach(log => {
                Object.entries(log.tasks).forEach(([taskId, taskLog]) => {
                    if (taskLog.status === 'completed' && taskLog.confirmed) {
                        totalTasksCompleted++;
                        const bonusTask = child.bonusTasks.find(t => t.id === taskId);
                        if (bonusTask) {
                            bonusCount++;
                        }
                    }
                });
            });
            
            if (id === 'marksman') {
                const target = 50 * m;
                return { current: totalTasksCompleted, target: target, formatted: `${totalTasksCompleted} / ${target}` };
            }
            if (id === 'helper') {
                const target = 10 * m;
                return { current: bonusCount, target: target, formatted: `${bonusCount} / ${target}` };
            }
            break;
        }
        case 'test_9': {
            let maxScore = 0;
            child.tenDayTests.forEach(t => {
                if (t.completed && t.totalScore > maxScore) {
                    maxScore = t.totalScore;
                }
            });
            return { current: maxScore, target: 9, formatted: `${maxScore} / 9` };
        }
        case 'bonus_3':
        case 'bonus_5':
        case 'bonus_10': {
            let targetPrice = id === 'bonus_3' ? 3 : (id === 'bonus_5' ? 5 : 10);
            let completionsCount = 0;
            Object.values(child.dailyLogs).forEach(log => {
                Object.entries(log.tasks).forEach(([taskId, taskLog]) => {
                    if (taskLog.status === 'completed' && taskLog.confirmed) {
                        const bonusTask = child.bonusTasks.find(t => t.id === taskId);
                        if (bonusTask && bonusTask.bonusPrice === targetPrice) {
                            completionsCount++;
                        }
                    }
                });
            });
            const target = 10 * m;
            return { current: completionsCount, target: target, formatted: `${completionsCount} / ${target}` };
        }
        case 'savings_100': {
            const target = 100 * m;
            const current = Math.floor(child.totalEarned);
            const goldText = __('currency.gold') || 'тилло';
            return { current: current, target: target, formatted: `${current} / ${target} ${goldText}` };
        }
        case 'savings_50': {
            const target = 500 * m;
            const current = Math.floor(child.totalEarned);
            const goldText = __('currency.gold') || 'тилло';
            return { current: current, target: target, formatted: `${current} / ${target} ${goldText}` };
        }
    }
    
    return { current: 0, target: 1, formatted: '0 / 1' };
}

function checkAchievements(childId) {
    const child = getChild(childId);
    const unlocked = [];

    child.achievementTier = child.achievementTier || 0;
    const m = Math.pow(2, Math.min(2, child.achievementTier));

    if (!child.achievements) child.achievements = [];

    let totalCompleted = 0;
    Object.values(child.dailyLogs).forEach(log => {
        Object.values(log.tasks).forEach(t => {
            if (t.status === 'completed' && t.confirmed) {
                totalCompleted++;
            }
        });
    });
    if (totalCompleted >= 3 && !child.achievements.includes('first_task')) {
        child.achievements.push('first_task');
        unlocked.push(__('achievement.first_task'));
    }

    const todayLog = getOrCreateDailyLog(childId);
    const allDone = child.tasks.every(t => {
        const tl = todayLog.tasks[t.id];
        return tl && tl.status === 'completed' && tl.confirmed;
    });
    if (allDone && !child.achievements.includes('all_today')) {
        child.achievements.push('all_today');
        unlocked.push(__('achievement.all_today'));
    }

    // Check streaks
    const dates = Object.keys(child.dailyLogs).sort().reverse();
    let currentStreak = 0;
    let onTimeStreak = 0;
    let onTimeStreakBroken = false;
    let noPenaltyStreak = 0;
    let noPenaltyStreakBroken = false;
    const todayStr = getToday();
    const todayD = new Date(todayStr + 'T12:00:00');

    for (let i = 0; i < dates.length; i++) {
        const d = new Date(dates[i] + 'T12:00:00');
        const expected = new Date(todayD);
        expected.setDate(expected.getDate() - i);
        if (d.toDateString() === expected.toDateString()) {
            const log = child.dailyLogs[dates[i]];
            if (log && !log.excused && log.rewardApplied) {
                const result = calculateDailyReward(childId, dates[i]);
                if (result.reward >= 0) {
                    currentStreak++;
                    if (!onTimeStreakBroken) {
                        const missedAny = Object.values(log.tasks).some(t => t.status === 'completed' && t.missedDeadline);
                        if (!missedAny) onTimeStreak++;
                        else onTimeStreakBroken = true;
                    }
                    if (!noPenaltyStreakBroken) {
                        const penaltyAny = Object.values(log.tasks).some(t => t.penaltyApplied && (t.penaltyApplied.stars > 0 || t.penaltyApplied.gold > 0));
                        if (!penaltyAny) noPenaltyStreak++;
                        else noPenaltyStreakBroken = true;
                    }
                } else { break; }
            } else if (log && log.excused) {
                continue;
            } else { break; }
        } else { break; }
    }

    if (currentStreak >= (7 * m) && !child.achievements.includes('week_streak')) {
        child.achievements.push('week_streak');
        unlocked.push(__('achievement.week_streak'));
    }
    if (currentStreak >= (30 * m) && !child.achievements.includes('month_streak')) {
        child.achievements.push('month_streak');
        unlocked.push(__('achievement.month_streak'));
    }
    if (onTimeStreak >= (30 * m) && !child.achievements.includes('fast_worker')) {
        child.achievements.push('fast_worker');
        unlocked.push(__('achievement.fast_worker'));
    }
    if (noPenaltyStreak >= (30 * m) && !child.achievements.includes('perfect_zeroes')) {
        child.achievements.push('perfect_zeroes');
        unlocked.push(__('achievement.perfect_zeroes'));
    }

    // Check early bird using 7-day morning streak
    const morningStreak = calculateBlockStreak(child, 'morning');
    if (morningStreak >= 7 && !child.achievements.includes('early_bird')) {
        child.achievements.push('early_bird');
        unlocked.push(__('achievement.early_bird'));
    }

    // test achievements
    child.tenDayTests.forEach(t => {
        if (t.completed && t.totalScore === 9 && !child.achievements.includes('test_9')) {
            child.achievements.push('test_9');
            unlocked.push(__('achievement.test_9'));
        }
    });

    // savings
    if (child.totalEarned >= (100 * m) && !child.achievements.includes('savings_100')) {
        child.achievements.push('savings_100');
        unlocked.push(__('achievement.savings_100'));
    }
    if (child.totalEarned >= (500 * m) && !child.achievements.includes('savings_50')) {
        child.achievements.push('savings_50');
        unlocked.push(__('achievement.savings_50'));
    }

    // bonus task achievements and total tasks
    let totalTasksCompleted = 0;
    let bonusCount = 0;
    let bonus3Count = 0;
    let bonus5Count = 0;
    let bonus10Count = 0;
    Object.values(child.dailyLogs).forEach(log => {
        Object.entries(log.tasks).forEach(([taskId, taskLog]) => {
            if (taskLog.status === 'completed' && taskLog.confirmed) {
                totalTasksCompleted++;
                const bonusTask = child.bonusTasks.find(t => t.id === taskId);
                if (bonusTask) {
                    bonusCount++;
                    if (bonusTask.bonusPrice === 3) {
                        bonus3Count++;
                    }
                    if (bonusTask.bonusPrice === 5) {
                        bonus5Count++;
                    }
                    if (bonusTask.bonusPrice === 10) {
                        bonus10Count++;
                    }
                }
            }
        });
    });

    if (bonus3Count >= (10 * m) && !child.achievements.includes('bonus_3')) {
        child.achievements.push('bonus_3');
        unlocked.push(__('achievement.bonus_3'));
    }
    if (bonus5Count >= (10 * m) && !child.achievements.includes('bonus_5')) {
        child.achievements.push('bonus_5');
        unlocked.push(__('achievement.bonus_5'));
    }
    if (bonus10Count >= (10 * m) && !child.achievements.includes('bonus_10')) {
        child.achievements.push('bonus_10');
        unlocked.push(__('achievement.bonus_10'));
    }
    if (totalTasksCompleted >= (50 * m) && !child.achievements.includes('marksman')) {
        child.achievements.push('marksman');
        unlocked.push(__('achievement.marksman'));
    }
    if (bonusCount >= (10 * m) && !child.achievements.includes('helper')) {
        child.achievements.push('helper');
        unlocked.push(__('achievement.helper'));
    }

    let prestigeTriggered = false;
    let newTier = child.achievementTier;
    let goldPrize = 0;
    let starPrize = 0;

    // Check if ALL achievements are unlocked
    if (child.achievements.length >= ACHIEVEMENTS.length) {
        prestigeTriggered = true;
        
        const t = child.achievementTier || 0;
        goldPrize = 200 + 100 * t;
        starPrize = 200 + 100 * t;
        
        child.balance += goldPrize;
        child.totalEarned += goldPrize;
        child.stars = (child.stars || 0) + starPrize;
        child.totalStars = (child.totalStars || 0) + starPrize;
        
        child.achievementTier += 1;
        newTier = child.achievementTier;
        child.achievements = []; // Reset achievements
    }

    saveState();
    return { unlocked, prestigeTriggered, newTier, goldPrize, starPrize };
}

// ===== DAY CYCLE STREAKS HELPERS =====
function getBlockTasks(child, blockType, dateDayOfWeek) {
    return child.tasks.filter(t => {
        if (t.type && t.type !== 'daily') return false; // only daily routine tasks
        if (t.days && !t.days.includes(dateDayOfWeek)) return false;
        const time = t.startTime || '12:00';
        const hour = parseInt(time.split(':')[0]);
        if (blockType === 'morning') return hour >= 5 && hour < 12;
        if (blockType === 'afternoon') return hour >= 12 && hour < 18;
        if (blockType === 'evening') return hour >= 18 || hour < 5;
        return false;
    });
}

function isBlockCompleted(child, blockType, dateStr) {
    const log = child.dailyLogs[dateStr];
    if (!log) return false;
    if (log.excused) return true; // excused days don't break streak

    const dateDayOfWeek = new Date(dateStr + 'T12:00:00').getDay();
    const blockTasks = getBlockTasks(child, blockType, dateDayOfWeek);
    if (blockTasks.length === 0) return true; // no tasks scheduled = completed

    return blockTasks.every(t => {
        const tl = log.tasks[t.id];
        return tl && tl.status === 'completed' && tl.confirmed;
    });
}

function isMorningBlockStreakCompleted(child, dateStr) {
    const log = child.dailyLogs[dateStr];
    if (!log) return false;
    if (log.excused) return true;

    const dateDayOfWeek = new Date(dateStr + 'T12:00:00').getDay();
    const morningTasks = getBlockTasks(child, 'morning', dateDayOfWeek);
    if (morningTasks.length === 0) return true;

    return morningTasks.every(t => {
        const tl = log.tasks[t.id];
        if (!tl || tl.status !== 'completed' || !tl.confirmed) return false;
        const compDate = tl.completedAt ? new Date(tl.completedAt) : (tl.startedAt ? new Date(tl.startedAt) : null);
        if (!compDate) return false;
        return compDate.getHours() < 7;
    });
}

function calculateBlockStreak(child, blockType) {
    const todayStr = getToday();
    const todayD = new Date(todayStr + 'T12:00:00');
    
    // Check if child has any tasks configured in this block
    const anyTasks = child.tasks.some(t => {
        if (t.type && t.type !== 'daily') return false;
        const time = t.startTime || '12:00';
        const hour = parseInt(time.split(':')[0]);
        if (blockType === 'morning') return hour >= 5 && hour < 12;
        if (blockType === 'afternoon') return hour >= 12 && hour < 18;
        if (blockType === 'evening') return hour >= 18 || hour < 5;
        return false;
    });
    if (!anyTasks) return 0;

    let streak = 0;
    
    // First, check if today's block is completed
    let completedToday = false;
    if (blockType === 'morning') {
        completedToday = isMorningBlockStreakCompleted(child, todayStr);
    } else {
        completedToday = isBlockCompleted(child, blockType, todayStr);
    }

    if (completedToday) {
        streak = 1;
    } else {
        // Today is not completed. Check if it's already failed.
        const now = new Date();
        const currentHour = now.getHours();
        let failedToday = false;
        if (blockType === 'morning' && currentHour >= 7) failedToday = true;
        if (blockType === 'afternoon' && currentHour >= 18) failedToday = true;
        if (blockType === 'evening' && currentHour >= 5 && currentHour < 18) failedToday = true;
        
        if (failedToday) {
            return 0; // failed, streak is broken
        } else {
            streak = 0; // not failed yet, streak is yesterday's streak
        }
    }

    // Now loop back for previous days
    let dayOffset = 1;
    while (true) {
        const prevD = new Date(todayD);
        prevD.setDate(prevD.getDate() - dayOffset);
        const prevStr = prevD.toISOString().split('T')[0];
        
        const log = child.dailyLogs[prevStr];
        if (!log) {
            break;
        }
        
        if (log.excused) {
            dayOffset++;
            continue; // skip excused days
        }
        
        let completed = false;
        if (blockType === 'morning') {
            completed = isMorningBlockStreakCompleted(child, prevStr);
        } else {
            completed = isBlockCompleted(child, blockType, prevStr);
        }
        
        if (completed) {
            streak++;
            dayOffset++;
        } else {
            break;
        }
    }

    return streak;
}
