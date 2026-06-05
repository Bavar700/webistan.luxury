/**
 * Офарин / Молодец — Kids Task Manager
 * Main application logic
 */

// ===== INITIALIZATION =====
document.addEventListener('DOMContentLoaded', () => {
    loadState();
    if (state.children.length > 0) {
        currentChildId = state.children[0].id;
    }
    initApp();
});

function initApp() {
    // Check if first launch — show welcome screen
    if (window._isFirstLaunch) {
        showWelcomeScreen();
        return;
    }

    renderChildTabs();
    setupEventListeners();
    navigateTo('dashboard');
    updateUI();
    updateLanguageUI();
    showDailyQuote();

    // Check for 10-day test
    const test = checkAndCreateTest(currentChildId);
    if (test) {
        setTimeout(() => showTestModal(test), 500);
    }
}

// ===== LANGUAGE =====
function updateLanguageUI() {
    // Update document lang
    document.documentElement.lang = currentLang;
    // Update title
    document.title = __('app.title');
    document.getElementById('app-title').textContent = __('app.name');
    // Apply static translations
    applyStaticTranslations();
    // Initialize or re-initialize Flatpickr with correct language
    initFlatpickr();
    // Re-render current page
    updateUI();
}

let fpDatePickers = [];
let fpTimePickers = [];

function initFlatpickr() {
    if (!window.flatpickr) return;

    // Define Tajik locale if not defined
    if (!window.flatpickr.l10ns.tg) {
        window.flatpickr.l10ns.tg = {
            weekdays: {
                shorthand: ["Як", "Дш", "Сш", "Чш", "Пш", "Ҷм", "Шн"],
                longhand: ["Якшанбе", "Душанбе", "Сешанбе", "Чоршанбе", "Панҷшанбе", "Ҷумъа", "Шанбе"]
            },
            months: {
                shorthand: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
                longhand: ["Январ", "Феврал", "Март", "Апрел", "Май", "Июн", "Июл", "Август", "Сентябр", "Октябр", "Ноябр", "Декабр"]
            },
            firstDayOfWeek: 1,
            rangeSeparator: " то ",
            time_24hr: true
        };
    }

    // Destroy existing instances
    fpDatePickers.forEach(p => p.destroy());
    fpTimePickers.forEach(p => p.destroy());
    fpDatePickers = [];
    fpTimePickers = [];

    const lang = currentLang === 'ru' ? 'ru' : 'tg';

    // Date pickers
    document.querySelectorAll('.flatpickr-date').forEach(el => {
        fpDatePickers.push(flatpickr(el, {
            locale: lang,
            disableMobile: true, // Force custom UI to keep language
            dateFormat: "Y-m-d", // value format
            altInput: true,
            altFormat: "d.m.Y"   // display format
        }));
    });

    // Time pickers
    document.querySelectorAll('.flatpickr-time').forEach(el => {
        fpTimePickers.push(flatpickr(el, {
            locale: lang,
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            disableMobile: true // Force custom UI
        }));
    });
}

/**
 * Apply translations to all static HTML elements with data-i18n attribute
 */
function applyStaticTranslations() {
    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.dataset.i18n;
        if (key) {
            el.textContent = __(key);
        }
    });

    // Update stat-stars label separately (dynamic content)
    const starStat = document.getElementById('stat-stars');
    if (starStat && starStat.style.display !== 'none') {
        const child = getCurrentChild();
        if (child) {
            const rt = child.rewardType || 'money';
            if (rt === 'stars' || rt === 'both') {
                starStat.querySelector('.stat-label').textContent = `⭐ ${__('balance.stars')}`;
            }
        }
    }

    // Confirm modal header
    const confirmHeader = document.querySelector('#confirm-modal .modal-header h3');
    if (confirmHeader) {
        confirmHeader.innerHTML = `<svg class="icon-svg" aria-hidden="true" style="color:var(--success);"><use href="#icon-check"/></svg> ${__('confirm.title')}`;
    }

    // Excuse modal header
    const excuseHeader = document.querySelector('#excuse-modal .modal-header h3');
    if (excuseHeader) {
        excuseHeader.textContent = __('excuse.title');
    }

    // PIN modal header and text
    const pinHeader = document.querySelector('#pin-modal .modal-header h3');
    if (pinHeader) {
        pinHeader.innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-shield"/></svg> ${__('pin.title')}`;
    }
    const pinInstruction = document.querySelector('#pin-modal .modal-body p');
    if (pinInstruction) {
        pinInstruction.textContent = __('pin.instruction');
    }
    const pinSubmit = document.getElementById('pin-submit');
    if (pinSubmit) {
        pinSubmit.textContent = __('confirm');
    }

    // Balance section header
    const pageBalanceHeader = document.querySelector('#page-balance .page-header h2 span');
    if (pageBalanceHeader) {
        pageBalanceHeader.textContent = __('nav.balance');
    }

    // Calendar section header
    const pageCalendarHeader = document.querySelector('#page-calendar .page-header h2 span');
    if (pageCalendarHeader) {
        pageCalendarHeader.textContent = __('calendar.title');
    }

    // Dashboard section header
    const pageDashboardHeader = document.querySelector('#page-dashboard .page-header h2 span');
    if (pageDashboardHeader) {
        pageDashboardHeader.textContent = __('routine.title');
    }

    // Settings section header
    const pageSettingsHeader = document.querySelector('#page-settings .page-header h2 span');
    if (pageSettingsHeader) {
        pageSettingsHeader.textContent = __('settings.title');
    }

    // Dashboard hint
    const dashboardHint = document.getElementById('dashboard-add-hint');
    if (dashboardHint) {
        dashboardHint.textContent = __('parent.add_task_hint');
    }

    // Balance card withdraw button
    const withdrawBtn = document.getElementById('btn-withdraw');
    if (withdrawBtn && withdrawBtn.style.display !== 'none') {
        withdrawBtn.innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-wallet"/></svg> ${__('balance.withdraw_title')}`;
    }

    // Task form labels (update on language change)
    updateTaskFormLabels();
}

// ===== NAVIGATION =====
function navigateTo(page) {
    currentPage = page;

    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    document.getElementById(`page-${page}`).classList.add('active');

    document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
    document.querySelector(`.nav-btn[data-page="${page}"]`).classList.add('active');

    // Hide today-bar, quote-bar, and daily-progress everywhere
    const todayBar = document.querySelector('.today-bar');
    if (todayBar) {
        todayBar.classList.add('hidden');
    }

    const quoteBar = document.querySelector('.quote-bar');
    if (quoteBar) {
        quoteBar.classList.add('hidden');
    }

    const dailyProgress = document.getElementById('daily-progress');
    if (dailyProgress) {
        dailyProgress.classList.add('hidden');
    }

    // Hide/show floating settings FAB based on page
    var settingsFab = document.getElementById('parent-settings-fab');
    var settingsModal = document.getElementById('parent-settings-modal');
    if (page !== 'parent') {
        if (settingsFab) settingsFab.style.display = 'none';
        if (settingsModal) settingsModal.style.display = 'none';
    } else {
        if (settingsFab) settingsFab.style.display = '';
    }

    switch (page) {
        case 'dashboard': renderRoutine(); break;
        case 'dream': renderDreams(); break;
        case 'routine': renderTasks(); break;
        case 'balance': renderBalance(); break;
        case 'parent': showParentPin(); break;
    }

    
    // Update the UI header elements based on the new page
    updateUI();
}

function getMedalDisplay(child) {
    const tier = child.achievementTier || 0;
    if (tier === 0) return '';
    if (tier === 1) return ' 🏅 IV';
    if (tier === 2) return ' 🏅 III';
    if (tier === 3) return ' 🏅 II';
    return ' 🏅 I';
}

// ===== CHILD TABS =====
function renderChildTabs() {
    const child = getCurrentChild();
    if (!child) return;

    // Update selector button
    const emojiEl = document.getElementById('cs-emoji');
    const nameEl = document.getElementById('cs-name');
    const balanceEl = document.getElementById('cs-balance');

    if (emojiEl) emojiEl.textContent = child.emoji;
    if (nameEl) nameEl.textContent = child.name;

    if (balanceEl) {
        const rt = child.rewardType || 'money';
        let txt = '';
        if (rt === 'stars') txt = `⭐ ${child.stars || 0}`;
        else if (rt === 'both') txt = `⭐ ${child.stars || 0}   🪙 ${child.balance}`;
        else txt = `🪙 ${child.balance}`;
        txt += getMedalDisplay(child);
        balanceEl.textContent = txt;
    }

    // Build picker list
    renderChildPicker();
}

function renderChildPicker() {
    const container = document.getElementById('child-picker-list');
    if (!container) return;
    container.innerHTML = '';

    state.children.forEach(c => {
        const item = document.createElement('div');
        item.className = 'child-picker-item';
        if (c.id === currentChildId) {
            item.style.background = '#EDE9FE';
        }

        const rt = c.rewardType || 'money';
        let balanceText = '';
        if (rt === 'stars') balanceText = `⭐ ${c.stars || 0}`;
        else if (rt === 'both') balanceText = `⭐ ${c.stars || 0}   🪙 ${c.balance}`;
        else balanceText = `🪙 ${c.balance}`;
        balanceText += getMedalDisplay(c);

        item.innerHTML = `
            <span class="cpi-emoji">${c.emoji}</span>
            <span class="cpi-info">
                <span class="cpi-name">${c.name}</span>
                <span class="cpi-balance">${balanceText}</span>
            </span>
            <span class="cpi-check${c.id === currentChildId ? ' active-child' : ''}">${c.id === currentChildId ? '✓' : ''}</span>
        `;

        item.addEventListener('click', () => {
            closeChildPicker();
            if (c.id !== currentChildId) {
                switchChild(c.id);
            }
        });

        container.appendChild(item);
    });

    // Add child row
    const addItem = document.createElement('div');
    addItem.className = 'child-picker-item cpi-add';
    addItem.innerHTML = `
        <span class="cpi-emoji">+</span>
        <span>${__('settings.add_child')}</span>
    `;
    addItem.addEventListener('click', () => {
        closeChildPicker();
        showChildModal();
    });
    container.appendChild(addItem);
}

function toggleChildPicker() {
    const picker = document.getElementById('child-picker');
    const btn = document.getElementById('child-selector-btn');
    if (picker.classList.contains('hidden')) {
        renderChildPicker();
        picker.classList.remove('hidden');
        btn.classList.add('open');
    } else {
        closeChildPicker();
    }
}

function closeChildPicker() {
    const picker = document.getElementById('child-picker');
    const btn = document.getElementById('child-selector-btn');
    picker.classList.add('hidden');
    btn.classList.remove('open');
}

function switchChild(childId) {
    if (childId === currentChildId) return;
    currentChildId = childId;
    renderChildTabs();
    updateUI();

    // Re-render current page to refresh elements for the new child
    switch (currentPage) {
        case 'dashboard': renderRoutine(); break;
        case 'dream': renderDreams(); break;
        case 'routine': renderTasks(); break;
        case 'balance': renderBalance(); break;
        case 'parent': showParentPin(); break;
    }

    const test = checkAndCreateTest(currentChildId);
    if (test) {
        setTimeout(() => showTestModal(test), 500);
    }
}

// ===== PROGRESS BAR =====
function updateProgressBar() {
    const child = getCurrentChild();
    if (!child) return;
    const today = getToday();
    const log = child.dailyLogs[today] || getOrCreateDailyLog(child.id);

    const titleEl = document.getElementById('progress-title');
    const textEl = document.getElementById('progress-text');
    const fillEl = document.getElementById('progress-fill');
    if (!titleEl || !textEl || !fillEl) return;

    if (log.excused) {
        titleEl.textContent = currentLang === 'ru' ? 'Статус сегодня' : 'Ҳолати имрӯз';
        textEl.textContent = currentLang === 'ru' ? 'Уважительная причина' : 'Рӯзи узрнок';
        fillEl.style.width = '100%';
        fillEl.style.background = 'linear-gradient(135deg, #F59E0B, #D97706)';
        return;
    }

    // Default styling in CSS might be green, let's restore it
    titleEl.textContent = __('progress.title') || 'Пешрафти имрӯз';
    fillEl.style.background = ''; // reset to CSS default

    const todayDay = new Date().getDay();
    const activeTasks = [
        ...child.tasks.filter(t => t.type !== 'daily' || !t.days || t.days.includes(todayDay)),
        ...child.bonusTasks
    ];

    let confirmedCount = 0;
    activeTasks.forEach(t => {
        const tl = log.tasks[t.id];
        if (tl && tl.status === 'completed' && tl.confirmed) confirmedCount++;
    });

    const totalTasks = activeTasks.length;
    textEl.textContent = `${confirmedCount}/${totalTasks}`;
    const pct = totalTasks > 0 ? (confirmedCount / totalTasks) * 100 : 0;
    fillEl.style.width = `${Math.min(pct, 100)}%`;
}

// ===== UI UPDATE =====
function updateUI() {
    const child = getCurrentChild();
    if (!child) return;

    updateProgressBar();

    // Header logic toggle
    const selector = document.getElementById('header-child-selector');
    const headerTop = document.querySelector('.header-top');
    const title = document.getElementById('app-title');
    const headerBalance = document.getElementById('header-child-balance');
    const balanceText = document.getElementById('greeting-balance-text');

    if (currentPage === 'parent') {
        selector.classList.remove('hidden');
        headerTop.classList.add('hidden');
        headerBalance.classList.add('hidden');
    } else {
        selector.classList.add('hidden');
        headerTop.classList.remove('hidden');
        title.textContent = __('app.name') + ', ' + child.name + '!';
        headerBalance.classList.remove('hidden');
        
        const rt = child.rewardType || 'money';
        let txt = '';
        if (rt === 'stars') txt = `⭐ ${child.stars || 0}`;
        else if (rt === 'both') txt = `⭐ ${child.stars || 0}   🪙 ${child.balance}`;
        else txt = `🪙 ${child.balance}`;
        txt += getMedalDisplay(child);
        balanceText.textContent = txt;
    }

    const now = new Date();
    const dow = __weekday(now.getDay());
    const mon = __month(now.getMonth());
    const day = now.getDate();
    const year = now.getFullYear();
    if (currentLang === 'ru') {
        // Russian: "Пятница, 26 Мая 2026"
        // Generate proper Russian genitive month via locale only for Russian (which is well supported)
        const ruOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        try {
            document.getElementById('today-date').textContent = now.toLocaleDateString('ru-RU', ruOptions);
        } catch (e) {
            document.getElementById('today-date').textContent = `${dow}, ${day} ${mon} ${year}`;
        }
    } else {
        // Tajik: "Ҷумъа, 26 Май 2026" — use own translation
        document.getElementById('today-date').textContent = `${dow}, ${day} ${mon} ${year}`;
    }
    const dateBadgeText = `${__weekday(now.getDay())}, ${now.getDate()} ${__month(now.getMonth())} ${now.getFullYear()}`;
    document.getElementById('date-badge').textContent = dateBadgeText;
    const tasksDateBadge = document.getElementById('tasks-date-badge');
    if (tasksDateBadge) {
        tasksDateBadge.textContent = dateBadgeText;
    }

    // Balance
    const rtLabel = child.rewardType || 'money';
    const balanceAmount = document.getElementById('balance-amount');
    balanceAmount.textContent = child.balance;
    // Update balance currency span separately
    const balanceCurrency = document.querySelector('.balance-display .balance-currency');
    if (balanceCurrency) {
        if (rtLabel === 'stars') balanceCurrency.textContent = '⭐';
        else if (rtLabel === 'both') balanceCurrency.textContent = __('balance.stars_and_money');
        else balanceCurrency.textContent = __('balance.currency.sm');
    }
    // Update balance label
    const balanceLabel = document.querySelector('.balance-display .balance-label');
    if (balanceLabel) balanceLabel.textContent = __('balance.label');
    const balanceBig = document.getElementById('balance-big');
    if (balanceBig) balanceBig.textContent = child.balance;
    const statEarned = document.getElementById('stat-earned');
    if (statEarned) statEarned.textContent = child.totalEarned;
    const statDeducted = document.getElementById('stat-deducted');
    if (statDeducted) statDeducted.textContent = child.totalDeducted;

    // Star stats for balance page
    const starStat = document.getElementById('stat-stars');
    if (starStat) {
        const rt = child.rewardType || 'money';
        if (rt === 'stars' || rt === 'both') {
            starStat.style.display = 'block';
            starStat.querySelector('.stat-value').textContent = child.stars || 0;
            starStat.querySelector('.stat-label').textContent = `⭐ ${__('balance.stars')}`;
        } else {
            starStat.style.display = 'none';
        }
    }

    if (!child.withdrawals) child.withdrawals = [];
    const totalWithdrawn = child.withdrawals.reduce((sum, w) => sum + w.amount, 0);
    const statWithdrawn = document.getElementById('stat-withdrawn');
    if (statWithdrawn) statWithdrawn.textContent = totalWithdrawn;

    // Update currency labels (big balance)
    const rt = child.rewardType || 'money';
    const bigCurrencyEls = document.querySelectorAll('.balance-big-currency');
    bigCurrencyEls.forEach(el => {
        if (rt === 'stars') el.textContent = '⭐';
        else if (rt === 'both') el.textContent = __('balance.stars_and_money');
        else el.textContent = __('balance.currency.sm');
    });

    // Update static translations
    applyStaticTranslations();

    // Update nav labels
    updateNavLabels();

    renderChildTabs();
    if (currentPage === 'dashboard') renderRoutine();
    else if (currentPage === 'dream') renderDreams();
    else if (currentPage === 'routine') renderTasks();
    else if (currentPage === 'balance') {
        renderWithdrawalHistory();
        renderTestHistory();
        renderAchievements();
    }
    else if (currentPage === 'parent') renderParentDashboard();
}

function updateNavLabels() {
    const todayEl = document.querySelector('.nav-btn[data-page="dashboard"] .nav-label');
    if (todayEl) todayEl.textContent = __('nav.routine');
    
    const dreamEl = document.querySelector('.nav-btn[data-page="dream"] .nav-label');
    if (dreamEl) dreamEl.textContent = __('nav.dream');
    
    const balanceEl = document.querySelector('.nav-btn[data-page="balance"] .nav-label');
    if (balanceEl) balanceEl.textContent = __('nav.balance');
    
    const routineEl = document.querySelector('.nav-btn[data-page="routine"] .nav-label');
    if (routineEl) routineEl.textContent = __('nav.tasks');
    
    const parentBtn = document.querySelector('.nav-btn[data-page="parent"] .nav-label');
    if (parentBtn) parentBtn.textContent = __('nav.parent');
}

// ===== QUOTE OF THE DAY =====
function showDailyQuote() {
    const quoteBar = document.querySelector('.today-bar');
    const dayOfYear = Math.floor((Date.now() - new Date(new Date().getFullYear(), 0, 0)) / 86400000);
    const quotes = getQuotes();
    const quoteIdx = dayOfYear % quotes.length;
    const quote = quotes[quoteIdx];

    // Remove old quote bar if exists
    const oldQuote = document.querySelector('.quote-bar');
    if (oldQuote) oldQuote.remove();

    const quoteDiv = document.createElement('div');
    quoteDiv.className = 'quote-bar';
    quoteDiv.innerHTML = `<div class="quote-text"><span class="quote-emoji">💬</span> ${quote}</div>`;

    quoteBar.parentNode.insertBefore(quoteDiv, quoteBar.nextSibling);
}

// ===== DEADLINE HELPERS =====
function getDeadlineInfo(task) {
    if (task.hasDeadline) {
        if (!task.deadlineDate || !task.deadlineTime) return null;
        const now = new Date();
        const deadlineDateStr = task.deadlineDate;
        const deadlineTimeStr = task.deadlineTime;
        const deadlineDate = new Date(`${deadlineDateStr}T${deadlineTimeStr}:00`);
        
        const diffMs = deadlineDate.getTime() - now.getTime();
        const diffMins = Math.floor(diffMs / 60000);
        
        if (diffMins < 0) {
            return { text: `Мӯҳлат гузашт: ${deadlineTimeStr}`, urgent: true, past: true, type: 'strict' };
        } else if (diffMins <= 60) {
            return { text: `Мӯҳлат ба наздикӣ: ${deadlineTimeStr} (${diffMins} дақиқа монд)`, urgent: true, past: false, type: 'strict' };
        } else {
            return { text: `То ${deadlineDateStr} ${deadlineTimeStr}`, urgent: false, past: false, type: 'strict' };
        }
    }

    // Fallback to old deadline logic if needed
    if (!task.deadline) return null;
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const deadline = new Date(task.deadline + 'T12:00:00');
    const diffTime = deadline.getTime() - today.getTime();
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    if (diffDays < 0) {
        return { text: __('task.deadline_passed'), urgent: true, past: true };
    } else if (diffDays === 0) {
        return { text: __('task.deadline_today'), urgent: true, past: false };
    } else if (diffDays <= 3) {
        return { text: `${formatDate(task.deadline)} (${diffDays} ${__('task.deadline_days_remaining')})`, urgent: true, past: false };
    }
    return { text: `${formatDate(task.deadline)} (${diffDays} ${__('task.deadline_days_remaining')})`, urgent: false, past: false };
}

// ===== TASKS RENDERING =====
function renderTasks() {
    const container = document.getElementById('tasks-container');
    const child = getCurrentChild();
    if (!child) return;

    const today = getToday();
    const log = getOrCreateDailyLog(currentChildId);

    // Update progress based on tasks active today
    const todayDay = new Date().getDay();
    const activeTasks = [
        ...child.tasks.filter(t => t.type !== 'daily' || !t.days || t.days.includes(todayDay)),
        ...child.bonusTasks
    ];
    
    let confirmedCount = 0;
    activeTasks.forEach(t => {
        const tl = log.tasks[t.id];
        if (tl && tl.status === 'completed' && tl.confirmed) confirmedCount++;
    });

    const totalTasks = activeTasks.length;
    updateProgressBar();

    if (log.excused) {
        container.innerHTML = `
            <div class="task-card" style="text-align:center;padding:40px 20px;display:block;">
                <div style="font-size:64px;margin-bottom:16px;">🙏</div>
                <h3 style="font-size:18px;margin-bottom:8px;">${__('excused_day.title')}</h3>
                <p style="color:var(--text-light);font-size:14px;">${__('excused_day.reason')} ${log.excuseReason}</p>
            </div>
        `;
        renderCalendar();
        return;
    }

    const regularTasks = child.tasks.filter(t => !t.isBonus && (t.type !== 'daily' || !t.days || t.days.includes(todayDay)));
    const allRegularDone = regularTasks.every(t => {
        const tl = log.tasks[t.id];
        return tl && tl.status === 'completed' && tl.confirmed;
    });

    const allResolved = regularTasks.every(t => {
        const tl = log.tasks[t.id];
        return tl && (tl.status === 'completed' && tl.confirmed || tl.status === 'skipped');
    });

    let activeTaskId = null;
    activeTasks.forEach(t => {
        const tl = log.tasks[t.id];
        if (tl && tl.status === 'in-progress') {
            activeTaskId = t.id;
        }
    });

    container.innerHTML = '';

    // Regular tasks
    child.tasks.sort((a, b) => a.order - b.order).forEach(task => {
        const tl = log.tasks[task.id];
        if (!tl) return;
        if (task.type === 'daily' && task.days && !task.days.includes(todayDay)) return;
        container.appendChild(createTaskCard(task, tl, log, child, false));
    });

    // Bonus tasks
    child.bonusTasks.forEach(task => {
        const tl = log.tasks[task.id];
        if (!tl) return;
        container.appendChild(createTaskCard(task, tl, log, child, true));
    });

    if (allRegularDone && totalTasks > 0) {
        const doneDiv = document.createElement('div');
        doneDiv.className = 'task-card all-done-card';
        doneDiv.innerHTML = `
            <span class="done-icon">🎉</span>
            <div class="done-title">${__('task.all_done')}</div>
            <p class="done-msg">${child.name}, ${__('task.all_done_msg')}</p>
        `;
        container.appendChild(doneDiv);

        applyDailyReward(currentChildId, today);

        const test = checkAndCreateTest(currentChildId);
        if (test) {
            setTimeout(() => showTestModal(test), 800);
        }
    } else if (allResolved && !log.rewardApplied && totalTasks > 0) {
        applyDailyReward(currentChildId, today);
    }

    if (activeTaskId) {
        const timerModal = document.getElementById('timer-modal');
        // Only auto-show timer if the modal isn't already open
        if (timerModal.classList.contains('hidden')) {
            const activeTask = activeTasks.find(t => t.id === activeTaskId);
            if (activeTask) {
                showTimer(currentChildId, activeTask);
            }
        }
    }
    
    // Auto-render calendar at the bottom of the dashboard
    renderCalendar();
}

function createTaskCard(task, tl, log, child, isBonus = false) {
    const card = document.createElement('div');
    card.className = `task-card status-${tl.status}${isBonus ? ' bonus-task' : ''}`;
    card.dataset.taskId = task.id;

    const statusLabels = {
        'pending': __('status.pending'),
        'in-progress': __('status.in-progress'),
        'awaiting-confirm': __('status.awaiting-confirm'),
        'completed': __('status.completed'),
        'skipped': __('status.skipped')
    };

    let durationText = `<span class="task-duration">⏱ ${task.duration} ${__('task.minutes')}</span>`;
    if (task.type === 'one-time') {
        durationText += ` <span class="task-duration" style="background: rgba(147, 51, 234, 0.1); color: rgb(147, 51, 234); border: 1px solid rgba(147, 51, 234, 0.2); font-weight: 500;">📅 ${__('task_form.type_one_time')}</span>`;
    } else if (task.type === 'exam') {
        durationText += ` <span class="task-duration" style="background: rgba(239, 68, 68, 0.1); color: rgb(239, 68, 68); border: 1px solid rgba(239, 68, 68, 0.2); font-weight: 500;">🎓 ${__('task_form.type_exam')}</span>`;
    } else if (task.type === 'bonus') {
        durationText += ` <span class="task-duration" style="background: rgba(16, 185, 129, 0.1); color: rgb(16, 185, 129); border: 1px solid rgba(16, 185, 129, 0.2); font-weight: 500;">🎁 ${__('task_form.type_bonus')}</span>`;
    } else {
        durationText += ` <span class="task-duration" style="background: rgba(59, 130, 246, 0.1); color: rgb(59, 130, 246); border: 1px solid rgba(59, 130, 246, 0.2); font-weight: 500;">🔄 ${__('task_form.type_daily')}</span>`;
    }

    if (task.startTime || task.startDate) {
        let displayStart = '';
        if (task.startDate) {
            displayStart += task.startDate + ' ';
        }
        if (task.startTime) {
            displayStart += task.startTime;
        }
        durationText += ` <span class="task-duration" style="background: rgba(107, 114, 128, 0.1); color: rgb(107, 114, 128); border: 1px solid rgba(107, 114, 128, 0.2); font-weight: 500;">🕒 ${displayStart.trim()}</span>`;
    }

    const gold = task.rewardGold !== undefined ? task.rewardGold : (task.bonusPrice || 0);
    const stars = task.rewardStars || 0;
    let rewardsText = `🪙 ${gold} ⭐ ${stars}`;
    durationText += ` <span class="task-duration" style="background: rgba(245, 158, 11, 0.1); color: rgb(245, 158, 11); border: 1px solid rgba(245, 158, 11, 0.2); font-weight: 500;">${rewardsText}</span>`;

    // Days of the Week for Daily tasks
    if (task.type === 'daily' && task.days && task.days.length > 0) {
        let daysDisplay = '';
        if (task.days.length === 7) {
            daysDisplay = __('task_badge.every_day');
        } else {
            daysDisplay = task.days.map(d => __weekday(d)).join(', ');
        }
        durationText += ` <span class="task-duration" style="background: rgba(139, 92, 246, 0.1); color: rgb(139, 92, 246); border: 1px solid rgba(139, 92, 246, 0.2); font-weight: 500;">${__('task_badge.days')} ${daysDisplay}</span>`;
    }

    // Has Test badge
    if (task.hasTest) {
        durationText += ` <span class="task-duration" style="background: rgba(239, 68, 68, 0.1); color: rgb(239, 68, 68); border: 1px solid rgba(239, 68, 68, 0.2); font-weight: 500;">${__('task_badge.has_test')}</span>`;
    }

    // Photo Required badge
    if (task.photoRequired) {
        durationText += ` <span class="task-duration" style="background: rgba(59, 130, 246, 0.1); color: rgb(59, 130, 246); border: 1px solid rgba(59, 130, 246, 0.2); font-weight: 500;">${__('task_badge.photo_required')}</span>`;
    }

    // Has Penalty badge
    if (task.hasPenalty) {
        let penaltyParts = [];
        if (task.penaltyGold > 0) penaltyParts.push(`🪙 ${task.penaltyGold}`);
        if (task.penaltyStars > 0) penaltyParts.push(`⭐ ${task.penaltyStars}`);
        const penaltyText = penaltyParts.length > 0 ? ' ' + penaltyParts.join(' ') : '';
        durationText += ` <span class="task-duration" style="background: rgba(220, 38, 38, 0.1); color: rgb(220, 38, 38); border: 1px solid rgba(220, 38, 38, 0.2); font-weight: 500;">${__('task_badge.penalty')}${penaltyText}</span>`;
    }

    if (task.hasTest && tl.status === 'completed' && tl.score !== undefined) {
        durationText += ` <span class="task-duration" style="background: rgba(16, 185, 129, 0.1); color: rgb(16, 185, 129); border: 1px solid rgba(16, 185, 129, 0.2); font-weight: 500;">💯 Баҳо: ${tl.score}/10</span>`;
    }

    if (task.isStreak) {
        const current = task.currentStreak || 0;
        const target = task.streakTarget || 5;
        durationText += ` <span class="task-duration" style="background: rgba(236, 72, 153, 0.1); color: rgb(236, 72, 153); border: 1px solid rgba(236, 72, 153, 0.2); font-weight: 500;">🔥 Марафон: Рӯзи ${current} аз ${target}</span>`;
    }

    // Deadline info
    const deadlineInfo = getDeadlineInfo(task);
    if (deadlineInfo) {
        let deadlineColorStyle = 'background: rgba(107, 114, 128, 0.1); color: rgb(107, 114, 128); border: 1px solid rgba(107, 114, 128, 0.2);';
        if (deadlineInfo.urgent) {
            deadlineColorStyle = 'background: rgba(220, 38, 38, 0.1); color: rgb(220, 38, 38); border: 1px solid rgba(220, 38, 38, 0.2);';
        }
        durationText += ` <span class="task-duration" style="${deadlineColorStyle} font-weight: 500;">📅 ${deadlineInfo.text}</span>`;
    }

    let iconName = 'icon-clock';
    if (task.type === 'one-time') iconName = 'icon-calendar';
    else if (task.type === 'exam') iconName = 'icon-book';
    else if (task.type === 'bonus') iconName = 'icon-gift';

    card.innerHTML = `
        <div class="task-info">
            <div class="task-name">${task.name}</div>
            <div class="task-meta">${durationText}</div>
        </div>
        <div class="task-right-actions">
            ${tl.status === 'pending' ? `
                
                <button class="task-btn task-btn-start" data-action="start" title="${__('task.start')}"><svg class="icon-svg" aria-hidden="true"><use href="#icon-play"/></svg></button>
                <button class="task-btn task-btn-skip" data-action="skip" title="${__('task.skip')}"><svg class="icon-svg" aria-hidden="true"><use href="#icon-x"/></svg></button>
            ` : ''}
            ${tl.status === 'in-progress' ? `
                <div class="task-status-badge status-in-progress">${statusLabels['in-progress']}</div>
                <button class="task-btn task-btn-done" data-action="finish" title="${__('task.finish')}" style="animation:pulse 1.5s ease-in-out infinite;"><svg class="icon-svg" aria-hidden="true"><use href="#icon-stop"/></svg></button>
            ` : ''}
            ${tl.status === 'awaiting-confirm' ? `
                <div class="task-status-badge status-awaiting-confirm">${statusLabels['awaiting-confirm']}</div>
                <button class="task-btn task-btn-confirm" data-action="confirm" title="${__('task.confirm')}"><svg class="icon-svg" aria-hidden="true"><use href="#icon-check"/></svg></button>
            ` : ''}
            ${tl.status === 'completed' ? `
                <div class="task-status-badge status-completed">${statusLabels.completed}</div>
            ` : ''}
            ${tl.status === 'skipped' ? `
                <div class="task-status-badge status-skipped">${statusLabels.skipped}</div>
            ` : ''}
        </div>
    `;

    card.querySelectorAll('[data-action]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const action = btn.dataset.action;
            if (action === 'start') {
                showTimer(currentChildId, task);
            } else if (action === 'confirm') {
                showConfirmModal(task);
            } else if (action === 'finish') {
                if (timerInterval && timerTaskId === task.id) {
                    showToast('⏱️', __('timer.finish_hint'));
                    return;
                }
                showTimer(currentChildId, task);
                completeTimer();
            } else if (action === 'skip') {
                showSkipModal(task);
            }
        });
    });

    return card;
}

// ===== TIMER =====
let timerInterval = null;
let timerRemaining = 0;
let timerTaskId = null;

function showTimer(childId, task) {
    // Guard: prevent re-opening if timer modal is already showing for this task
    const modal = document.getElementById('timer-modal');
    if (!modal.classList.contains('hidden') && timerTaskId === task.id) {
        return;
    }

    const child = getChild(childId);
    const today = getToday();
    const log = child.dailyLogs[today];
    const tl = log.tasks[task.id];

    // Mixed Scenario Validation: Deadline + Timer
    if (task.hasDeadline && task.useTimer !== false) {
        if (task.deadlineDate && task.deadlineTime) {
            const now = new Date();
            const deadlineDate = new Date(`${task.deadlineDate}T${task.deadlineTime}:00`);
            const remainingMins = Math.floor((deadlineDate.getTime() - now.getTime()) / 60000);
            if (remainingMins < task.duration) {
                showToast('⚠️', `Вақти кофӣ барои анҷом додани таймер (${task.duration} дақ) то мӯҳлат (${task.deadlineTime}) намондааст!`);
                return; // Block start
            }
        }
    }

    tl.status = 'in-progress';
    saveState();

    document.getElementById('timer-task-name').innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-clock"/></svg> ${task.name}`;
    document.getElementById('timer-emoji').textContent = '⏳';

    // Instructions rendering
    const instContainer = document.getElementById('timer-task-instructions-container');
    const instText = document.getElementById('timer-task-instructions-text');
    const instImgContainer = document.getElementById('timer-task-instructions-image-container');
    const instImg = document.getElementById('timer-task-instructions-img');

    if (task.instructions || task.instructionImage) {
        instContainer.classList.remove('hidden');
        if (task.instructions) {
            instText.textContent = task.instructions;
            instText.classList.remove('hidden');
        } else {
            instText.classList.add('hidden');
        }

        if (task.instructionImage) {
            instImg.src = task.instructionImage;
            instImgContainer.classList.remove('hidden');
        } else {
            instImgContainer.classList.add('hidden');
        }
    } else {
        instContainer.classList.add('hidden');
    }

    const durationSeconds = task.duration * 60;
    timerRemaining = durationSeconds;
    timerTaskId = task.id;
    updateTimerDisplay();
    updateTimerCircle(100);

    document.getElementById('timer-status').textContent = __('timer.status_ready');
    document.getElementById('timer-start-btn').classList.remove('hidden');
    document.getElementById('timer-pause-btn').classList.add('hidden');
    document.getElementById('timer-start-btn').disabled = false;
    document.getElementById('timer-start-btn').textContent = __('timer.start');

    // Reset cancel UI so it's ready for next open
    document.getElementById('timer-cancel-pin-group').classList.add('hidden');
    document.getElementById('timer-cancel-btn').classList.remove('hidden');
    document.getElementById('timer-cancel-error').classList.add('hidden');
    document.getElementById('timer-cancel-pin').value = '';

    const countdownContainer = document.getElementById('timer-countdown-container');
    if (countdownContainer) {
        if (task.useTimer === false) {
            countdownContainer.classList.add('hidden');
            document.getElementById('timer-start-btn').classList.add('hidden');
            document.getElementById('timer-pause-btn').classList.add('hidden');
        } else {
            countdownContainer.classList.remove('hidden');
        }
    }

    modal.classList.remove('hidden');

    // Re-render tasks to show updated status (safe: no recursion due to guards)
    renderTasks();

    if (task.useTimer === false) {
        completeTimer();
    }
}

function startTimer() {
    if (timerInterval) return;

    // Set startedAt only when user actually starts the timer
    const child = getCurrentChild();
    if (child && timerTaskId) {
        const today = getToday();
        const log = child.dailyLogs[today];
        const tl = log.tasks[timerTaskId];
        if (tl) {
            tl.startedAt = new Date().toISOString();
            saveState();
        }
    }

    document.getElementById('timer-start-btn').classList.add('hidden');
    document.getElementById('timer-pause-btn').classList.remove('hidden');
    document.getElementById('timer-pause-btn').textContent = __('timer.pause');
    document.getElementById('timer-status').textContent = __('timer.status_working');

    timerInterval = setInterval(() => {
        timerRemaining--;
        updateTimerDisplay();

        const task = getCurrentChild().tasks.find(t => t.id === timerTaskId)
            || getCurrentChild().bonusTasks.find(t => t.id === timerTaskId);
        const totalSeconds = task ? task.duration * 60 : 1;
        const pct = (timerRemaining / totalSeconds) * 100;
        updateTimerCircle(pct);

        if (timerRemaining <= 0) {
            clearInterval(timerInterval);
            timerInterval = null;
            completeTimer();
        }
    }, 1000);
}

function pauseTimer() {
    if (timerInterval) {
        clearInterval(timerInterval);
        timerInterval = null;
        document.getElementById('timer-pause-btn').textContent = __('timer.resume');
        document.getElementById('timer-status').textContent = __('timer.status_paused');
    } else {
        startTimer();
    }
}

function completeTimer() {
    const child = getCurrentChild();
    const today = getToday();
    const log = child.dailyLogs[today];
    const tl = log.tasks[timerTaskId];

    if (tl) {
        tl.status = 'awaiting-confirm';
        const task = child.tasks.find(t => t.id === timerTaskId)
            || child.bonusTasks.find(t => t.id === timerTaskId);
        tl.timeSpent = task ? task.duration : 0;
        tl.completedAt = new Date().toISOString();
        saveState();
    }

    document.getElementById('timer-emoji').textContent = '🎉';
    document.getElementById('timer-status').textContent = __('timer.status_done');
    document.getElementById('timer-pause-btn').classList.add('hidden');
    document.getElementById('timer-start-btn').classList.add('hidden');

    // Show proof section
    const proofSection = document.getElementById('timer-proof-section');
    proofSection.classList.remove('hidden');
    document.getElementById('proof-label').textContent = __('proof.label');
    document.getElementById('proof-explanation').placeholder = __('proof.explanation_placeholder');
    document.getElementById('proof-photo-btn').innerHTML = `<svg class="icon-svg" aria-hidden="true" style="width:16px;height:16px;"><use href="#icon-plus"/></svg> <span>${__('proof.add_photo')}</span>`;
    document.getElementById('proof-submit-btn').innerHTML = `<svg class="icon-svg" aria-hidden="true" style="width:14px;height:14px;"><use href="#icon-check"/></svg> ${__('proof.submit')}`;

    // Reset proof fields
    document.getElementById('proof-photo-preview').classList.add('hidden');
    document.getElementById('proof-explanation').value = '';
}

function submitProof() {
    const child = getCurrentChild();
    const today = getToday();
    const log = child.dailyLogs[today];
    const tl = log.tasks[timerTaskId];

    if (!tl) return;

    const task = child.tasks.find(t => t.id === timerTaskId) || child.bonusTasks.find(t => t.id === timerTaskId);
    const photoImg = document.getElementById('proof-photo-img');
    const photoAttached = photoImg.src && photoImg.src.startsWith('data:');
    
    if (task && task.photoRequired && !photoAttached) {
        showToast('📸', __('proof.photo_required_error') || 'Акс дар ҷавоб ҳатмӣ аст!');
        return;
    }

    // Save photo (base64) and explanation
    if (photoAttached) {
        tl.photo = photoImg.src;
    }
    tl.explanation = document.getElementById('proof-explanation').value.trim();
    saveState();

    showToast('📸', __('proof.submitted'));
    closeTimer();
    renderTasks();
    updateUI();
}

function handlePhotoUpload(event) {
    const file = event.target.files[0];
    if (!file) return;

    // Compress image to max 300KB before storing
    const reader = new FileReader();
    reader.onload = function(e) {
        const img = new Image();
        img.onload = function() {
            const canvas = document.createElement('canvas');
            let w = img.width;
            let h = img.height;
            const maxDim = 800;
            if (w > maxDim || h > maxDim) {
                if (w > h) {
                    h = h * maxDim / w;
                    w = maxDim;
                } else {
                    w = w * maxDim / h;
                    h = maxDim;
                }
            }
            canvas.width = w;
            canvas.height = h;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, w, h);
            const compressed = canvas.toDataURL('image/jpeg', 0.7);
            document.getElementById('proof-photo-img').src = compressed;
            document.getElementById('proof-photo-preview').classList.remove('hidden');
            document.getElementById('proof-photo-btn').classList.add('hidden');
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

function handleWithdrawPhotoUpload(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        const img = new Image();
        img.onload = function() {
            const canvas = document.createElement('canvas');
            let w = img.width;
            let h = img.height;
            const maxDim = 800;
            if (w > maxDim || h > maxDim) {
                if (w > h) { h = h * maxDim / w; w = maxDim; }
                else { w = w * maxDim / h; h = maxDim; }
            }
            canvas.width = w;
            canvas.height = h;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, w, h);
            const compressed = canvas.toDataURL('image/jpeg', 0.7);
            document.getElementById('withdraw-photo-img').src = compressed;
            document.getElementById('withdraw-photo-preview').classList.remove('hidden');
            document.getElementById('withdraw-photo-btn').classList.add('hidden');
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

function handleInstructionPhotoUpload(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        const img = new Image();
        img.onload = function() {
            const canvas = document.createElement('canvas');
            let w = img.width;
            let h = img.height;
            const maxDim = 800;
            if (w > maxDim || h > maxDim) {
                if (w > h) {
                    h = h * maxDim / w;
                    w = maxDim;
                } else {
                    w = w * maxDim / h;
                    h = maxDim;
                }
            }
            canvas.width = w;
            canvas.height = h;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, w, h);
            const compressed = canvas.toDataURL('image/jpeg', 0.7);
            document.getElementById('task-inst-image-img').src = compressed;
            document.getElementById('task-inst-image-preview').classList.remove('hidden');
            document.getElementById('task-inst-image-btn').classList.add('hidden');
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

function closeTimer() {
    if (timerInterval) {
        clearInterval(timerInterval);
        timerInterval = null;
    }
    document.getElementById('timer-modal').classList.add('hidden');
    document.getElementById('timer-start-btn').disabled = false;
    document.getElementById('timer-start-btn').textContent = __('timer.start');
    document.getElementById('timer-cancel-pin-group').classList.add('hidden');
    document.getElementById('timer-cancel-btn').classList.remove('hidden');
    document.getElementById('timer-cancel-error').classList.add('hidden');
    document.getElementById('timer-proof-section').classList.add('hidden');
    document.getElementById('proof-photo-preview').classList.add('hidden');
    document.getElementById('proof-photo-img').src = '';
    document.getElementById('proof-photo-btn').classList.remove('hidden');
    document.getElementById('proof-explanation').value = '';
    timerTaskId = null;
}

function updateTimerDisplay() {
    const mins = Math.floor(timerRemaining / 60);
    const secs = timerRemaining % 60;
    document.getElementById('timer-display').textContent =
        `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
}

function updateTimerCircle(pct) {
    const circle = document.getElementById('timer-circle');
    const circumference = 2 * Math.PI * 54;
    const offset = circumference - (pct / 100) * circumference;
    circle.style.strokeDashoffset = offset;
}

// ===== CONFIRM MODAL =====
let confirmTaskId = null;

function showConfirmModal(task) {
    confirmTaskId = task.id;
    document.getElementById('confirm-task-name').innerHTML =
        __('confirm.question', { emoji: task.emoji, name: task.name });
    document.getElementById('confirm-pin').value = '';
    document.getElementById('confirm-error').classList.add('hidden');

    const scoreGroup = document.getElementById('confirm-exam-score-group');
    if (scoreGroup) {
        const scoreLabel = document.getElementById('confirm-exam-score-label');
        if (scoreLabel) scoreLabel.textContent = __('confirm.exam_score') || 'Баҳо (1-10):';
        scoreGroup.classList.toggle('hidden', !task.hasTest);
    }

    // Show child's photo and explanation if available
    const child = getCurrentChild();
    const today = getToday();
    const log = child.dailyLogs[today];
    const tl = log.tasks[task.id];

    const confirmProof = document.getElementById('confirm-proof');
    const confirmPhoto = document.getElementById('confirm-proof-photo');
    const confirmExplanation = document.getElementById('confirm-proof-explanation');

    let hasProof = false;

    if (tl && tl.photo) {
        document.getElementById('confirm-proof-img').src = tl.photo;
        confirmPhoto.classList.remove('hidden');
        hasProof = true;
    } else {
        confirmPhoto.classList.add('hidden');
    }

    if (tl && tl.explanation) {
        document.getElementById('confirm-proof-text').textContent = tl.explanation;
        confirmExplanation.classList.remove('hidden');
        hasProof = true;
    } else {
        confirmExplanation.classList.add('hidden');
    }

    if (hasProof) {
        confirmProof.classList.remove('hidden');
    } else {
        confirmProof.classList.add('hidden');
    }

    document.getElementById('confirm-modal').classList.remove('hidden');
    document.getElementById('confirm-pin').focus();
}

function submitConfirm() {
    const pin = document.getElementById('confirm-pin').value;
    if (pin !== state.pin) {
        document.getElementById('confirm-error').classList.remove('hidden');
        return;
    }

    const child = getCurrentChild();
    const today = getToday();
    const log = child.dailyLogs[today];
    const tl = log.tasks[confirmTaskId];

    if (tl) {
        tl.status = 'completed';
        tl.confirmed = true;
        
        const task = child.tasks.find(t => t.id === confirmTaskId) || child.bonusTasks.find(t => t.id === confirmTaskId);
        if (task) {
            if (task.hasTest) {
                tl.score = parseInt(document.getElementById('confirm-exam-score').value) || 10;
            }
            if (task.isStreak) {
                task.currentStreak = (task.currentStreak || 0) + 1;
                if (task.currentStreak > task.streakTarget) {
                    task.currentStreak = task.streakTarget; // cap it
                }
            }
            if (task.deadline) {
                const [h, m] = task.deadline.split(':');
                const deadlineD = new Date();
                deadlineD.setHours(parseInt(h), parseInt(m), 0);
                const checkTime = tl.completedAt ? new Date(tl.completedAt) : new Date();
                if (checkTime > deadlineD) {
                    tl.missedDeadline = true;
                }
            }
        }

        saveState();

        const result = checkAchievements(currentChildId);
        if (result.unlocked.length > 0) {
            showToast('🎉', result.unlocked.join(', '));
            launchConfetti();
        } else {
            showToast('✅', __('confirm.success'));
        }
        
        if (result.prestigeTriggered) {
            showPrestigeModal(result.newTier, result.goldPrize, result.starPrize);
        }

        const allTasks = child.tasks.filter(t => !t.isBonus);
        const allDone = allTasks.every(t => {
            const tl2 = log.tasks[t.id];
            return tl2 && tl2.status === 'completed' && tl2.confirmed;
        });

        if (allDone) {
            applyDailyReward(currentChildId, today);
            setTimeout(() => launchConfetti(), 300);

            const test = checkAndCreateTest(currentChildId);
            if (test) {
                setTimeout(() => showTestModal(test), 1000);
            }
        } else {
            const allResolved = allTasks.every(t => {
                const tl2 = log.tasks[t.id];
                return tl2 && (tl2.status === 'completed' && tl2.confirmed || tl2.status === 'skipped');
            });
            if (allResolved) {
                applyDailyReward(currentChildId, today);
            }
        }
    }

    document.getElementById('confirm-modal').classList.add('hidden');
    renderTasks();
    updateUI();
}

// ===== SKIP MODAL =====
let skipTaskId = null;

function showSkipModal(task) {
    skipTaskId = task.id;
    document.getElementById('skip-reason').value = '';
    document.getElementById('skip-modal').classList.remove('hidden');
    document.getElementById('skip-reason').focus();
}

function submitSkip() {
    const reason = document.getElementById('skip-reason').value.trim();
    const child = getCurrentChild();
    const today = getToday();
    const log = child.dailyLogs[today];
    const tl = log.tasks[skipTaskId];

    if (tl) {
        tl.status = 'skipped';
        tl.confirmed = true;
        tl.skipReason = reason; // Save the reason

        // Apply penalty if task has one
        const allTasks = [...child.tasks, ...child.bonusTasks];
        const skippedTask = allTasks.find(t => t.id === skipTaskId);
        if (skippedTask && skippedTask.hasPenalty) {
            const pStars = parseInt(skippedTask.penaltyStars) || 0;
            const pGold  = parseInt(skippedTask.penaltyGold)  || 0;
            if (pStars > 0) {
                child.stars = Math.max(0, (child.stars || 0) - pStars);
                child.totalDeducted = (child.totalDeducted || 0) + pStars;
            }
            if (pGold > 0) {
                child.balance = Math.max(0, (child.balance || 0) - pGold);
                child.totalDeducted = (child.totalDeducted || 0) + pGold;
            }
            // Record penalty in the log entry for audit
            tl.penaltyApplied = { stars: pStars, gold: pGold };
        }

        saveState();
        renderTasks();
        updateUI();
    }
    document.getElementById('skip-modal').classList.add('hidden');
}

// ===== CALENDAR =====
let calendarMonth = new Date().getMonth();
let calendarYear = new Date().getFullYear();

function renderCalendar() {
    const grid = document.getElementById('calendar-grid');
    if (!grid) return;
    const child = getCurrentChild();
    if (!child) return;

    document.getElementById('cal-month-year').textContent =
        `${__month(calendarMonth)} ${calendarYear}`;

    let firstDay = new Date(calendarYear, calendarMonth, 1).getDay() - 1;
    if (firstDay < 0) firstDay = 6;
    const daysInMonth = new Date(calendarYear, calendarMonth + 1, 0).getDate();
    const today = getToday();

    grid.innerHTML = '';

    // Headers
    for (let i = 0; i < 7; i++) {
        const header = document.createElement('div');
        header.className = 'calendar-header';
        header.textContent = __weekday((i + 1) % 7);
        grid.appendChild(header);
    }

    // Empty cells before first day
    for (let i = 0; i < firstDay; i++) {
        const empty = document.createElement('div');
        empty.className = 'calendar-day';
        grid.appendChild(empty);
    }

    // Day cells
    for (let day = 1; day <= daysInMonth; day++) {
        const dateStr = `${calendarYear}-${String(calendarMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const cell = document.createElement('div');
        cell.className = 'calendar-day';

        if (dateStr === today) {
            cell.classList.add('today');
        }

        const log = child.dailyLogs[dateStr];
        if (log) {
            if (log.excused) {
                cell.classList.add('excused');
            } else {
                const allTasks = child.tasks.filter(t => !t.isBonus);
                const allDone = allTasks.every(t => {
                    const tl = log.tasks[t.id];
                    return tl && (tl.status === 'completed' || tl.status === 'skipped');
                });
                const anyDone = allTasks.some(t => {
                    const tl = log.tasks[t.id];
                    return tl && tl.status === 'completed' && tl.confirmed;
                });

                if (allDone) {
                    cell.classList.add('completed');
                } else if (anyDone) {
                    cell.classList.add('incomplete');
                }
            }
        }

        const isTestDay = child.tenDayTests.some(t => t.date === dateStr);
        if (isTestDay) {
            cell.classList.add('test-day');
        }

        cell.textContent = day;
        cell.addEventListener('click', () => showDayDetails(dateStr));
        grid.appendChild(cell);
    }
}

function showDayDetails(dateStr) {
    const child = getCurrentChild();
    const log = child.dailyLogs[dateStr];
    if (!log) {
        showToast('📅', __('calendar.no_data'));
        return;
    }

    let msg = `📅 ${formatDate(dateStr)}\n`;
    if (log.excused) {
        msg += `${__('daydetails.excused')} ${log.excuseReason}\n`;
    } else {
        let done = 0;
        let total = 0;
        const allTasks = [...child.tasks, ...child.bonusTasks];
        allTasks.forEach(t => {
            const tl = log.tasks[t.id];
            if (tl) {
                total++;
                if (tl.status === 'completed' && tl.confirmed) done++;
                msg += `${t.emoji} ${t.name}: ${tl.status === 'completed' && tl.confirmed ? '✅' : tl.status === 'skipped' ? '❌' : tl.status === 'in-progress' ? '⏳' : '⬜'}\n`;
            }
        });
        msg += `\n${__('calendar.result')} ${done}/${total}`;
    }
    alert(msg);
}

// ===== BALANCE =====
function renderBalance() {
    const child = getCurrentChild();
    if (!child) return;
    const rt = child.rewardType || 'money';

    // Withdrawal history
    if (!child.withdrawals) child.withdrawals = [];
    const histContainer = document.getElementById('withdrawal-history');
    if (histContainer) {
        if (child.withdrawals.length === 0) {
            histContainer.innerHTML = `<p class="empty-state">${__('balance.no_withdrawals')}</p>`;
        } else {
            histContainer.innerHTML = child.withdrawals.slice().reverse().map(w => {
                const sym = w.type === 'stars' ? '⭐' : '🪙';
                const status = w.status || 'approved';
                let badgeStyle = '', badgeText = '';
                if (status === 'pending') {
                    badgeStyle = 'background: rgba(245, 158, 11, 0.15); color: #F59E0B;';
                    badgeText = __('balance.status.pending') || 'Дар интизор';
                } else if (status === 'rejected') {
                    badgeStyle = 'background: rgba(239, 68, 68, 0.15); color: #EF4444;';
                    badgeText = __('balance.status.rejected') || 'Рад шуд';
                } else {
                    badgeStyle = 'background: rgba(16, 185, 129, 0.15); color: #10B981;';
                    badgeText = __('balance.status.approved') || 'Тасдиқ шуд';
                }
                let commentHtml = '';
                if (status === 'rejected' && w.parentComment) {
                    commentHtml = `<div style="font-size:12px;margin-top:6px;color:#F87171;border-left:2px solid #EF4444;padding-left:8px;">💬 ${w.parentComment}</div>`;
                }
                return `<div style="padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.05);">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-size:13px;opacity:0.7;">${formatDate(w.date)}</span>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <span style="font-weight:700;">-${w.amount} ${sym}</span>
                            <span style="font-size:11px;font-weight:600;padding:2px 8px;border-radius:9999px;${badgeStyle}">${badgeText}</span>
                        </div>
                    </div>${commentHtml}
                </div>`;
            }).join('');
        }
    }

    // Test history
    const testContainer = document.getElementById('test-history');
    if (testContainer) {
        const tests = child.tenDayTests || [];
        if (tests.length === 0) {
            testContainer.innerHTML = `<p class="empty-state">${__('balance.no_tests')}</p>`;
        } else {
            let html = '';
            tests.slice().reverse().forEach(t => {
                const resultClass = t.totalScore === 10 ? 'good' : t.totalScore >= 9 ? 'ok' : 'bad';
                let rewardStr = '';
                if (t.reward > 0 || t.starReward > 0) {
                    if (rt === 'stars') rewardStr = `(+${t.starReward}⭐)`;
                    else if (rt === 'both') rewardStr = `(+${t.reward}🪙 +${t.starReward}⭐)`;
                    else rewardStr = `(+${t.reward}🪙)`;
                }
                html += `<div class="test-history-item">
                    <span class="test-info">📝 ${formatDate(t.date)}</span>
                    <span class="test-result ${resultClass}">${t.totalScore}/10 ${rewardStr}</span>
                </div>`;
            });
            testContainer.innerHTML = html;
        }
    }

    // Update balance display
    const balanceBig = document.querySelector('.balance-big');
    if (balanceBig) {
        if (rt === 'stars') {
            balanceBig.innerHTML = `<span class="balance-icon">⭐</span><span class="balance-big-amount" id="balance-big">${child.stars || 0}</span>`;
        } else if (rt === 'both') {
            balanceBig.innerHTML = `<span class="balance-icon">💰</span><span class="balance-big-amount" id="balance-big">${child.balance}</span><span style="font-size:24px;margin:0 8px;opacity:0.5;">|</span><span class="balance-icon">⭐</span><span class="balance-big-amount" style="font-size:36px;">${child.stars || 0}</span>`;
        } else {
            balanceBig.innerHTML = `<span class="balance-icon">💰</span><span class="balance-big-amount" id="balance-big">${child.balance}</span>`;
        }
    }

    // Withdraw button
    const withdrawBtn = document.getElementById('btn-withdraw');
    if (withdrawBtn) {
        withdrawBtn.style.display = 'inline-flex';
        withdrawBtn.innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-wallet"/></svg> ${__('balance.withdraw_title')}`;
    }

    renderAchievements();
}

function renderAchievements() {
    const container = document.getElementById('achievements-container');
    const child = getCurrentChild();
    if (!child) return;

    if (!child.achievements) child.achievements = [];
    child.achievementTier = child.achievementTier || 0;

    const earned = child.achievements;
    
    let tierClass = '';
    let tierName = '';
    if (child.achievementTier === 0) {
        tierClass = 'tier-silver';
        tierName = __('tier.silver');
    } else if (child.achievementTier === 1) {
        tierClass = 'tier-gold';
        tierName = __('tier.gold');
    } else {
        tierClass = 'tier-diamond';
        tierName = __('tier.diamond');
    }

    const titleEl = document.querySelector('[data-i18n="achievements.title"]');
    if (titleEl) {
        titleEl.innerHTML = `${__('achievements.title')} <span class="tier-badge ${tierClass}">(${tierName})</span>`;
        // Remove data-i18n so applyStaticTranslations doesn't override the HTML content
        titleEl.removeAttribute('data-i18n');
    }

    container.className = `achievements-grid ${tierClass}`;

    container.innerHTML = ACHIEVEMENTS.map(a => {
        const unlocked = earned.includes(a.id);
        const nameKey = `achievement.${a.id}`;
        const displayName = __(nameKey);
        return `<div class="achievement-item ${unlocked ? 'unlocked' : 'locked'}" onclick="showAchievementDetails('${a.id}')" style="cursor: pointer;">
            <span class="achievement-icon">${a.icon}</span>
            <span class="achievement-name">${displayName}</span>
        </div>`;
    }).join('');

    // Render Grand Prize Banner
    const banner = document.getElementById('grand-prize-banner');
    if (banner) {
        const totalCount = ACHIEVEMENTS.length;
        const currentCount = child.achievements.length;
        const t = child.achievementTier || 0;
        const goldPrizeValue = 200 + 100 * t;
        const starPrizeValue = 200 + 100 * t;
        const pct = totalCount > 0 ? (currentCount / totalCount) * 100 : 0;
        
        banner.innerHTML = `
            <div class="grand-prize-card" style="
                background: linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, rgba(218, 165, 32, 0.15) 100%);
                border: 2px dashed rgba(255, 215, 0, 0.4);
                border-radius: 16px;
                padding: 20px;
                text-align: center;
                position: relative;
                overflow: hidden;
                box-shadow: 0 8px 32px rgba(218, 165, 32, 0.08);
                transition: all 0.3s ease;
                margin-top: 15px;
            ">
                <!-- Decorative background elements -->
                <div style="
                    position: absolute;
                    top: -50px;
                    right: -50px;
                    width: 120px;
                    height: 120px;
                    background: radial-gradient(circle, rgba(255,215,0,0.2) 0%, transparent 70%);
                    pointer-events: none;
                "></div>
                
                <div style="font-size: 48px; margin-bottom: 12px; animation: float 3s ease-in-out infinite;">👑</div>
                <h3 style="
                    font-size: 36px; 
                    font-weight: 800; 
                    background: linear-gradient(to right, #FFD700, #FFA500, #FF8C00);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    margin-bottom: 8px; 
                    text-align: center;
                    letter-spacing: 1px;
                    display: block;
                ">
                    ${__('achievements.grand_prize') || 'Шоҳҷоиза'}
                </h3>
                <p style="font-size: 13px; color: var(--text-secondary); margin-bottom: 16px; padding: 0 10px; line-height: 1.4;">
                    ${__('achievements.grand_prize_desc', { total: totalCount }) || `Барои ба даст овардани ҳамаи ${totalCount} муваффақият дода мешавад.`}
                </p>
                
                <!-- Progress bar -->
                <div style="margin-bottom: 16px; padding: 0 10px;">
                    <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; margin-bottom: 6px;">
                        <span style="color: var(--text-secondary);">${__('achievement_modal.progress_label') || 'Пешрафт:'}</span>
                        <span style="color: #DAA520;">${currentCount} / ${totalCount}</span>
                    </div>
                    <div class="progress-bar" style="background: rgba(255, 255, 255, 0.1); border-radius: 10px; height: 8px; overflow: hidden; border: 1px solid rgba(255,215,0,0.1);">
                        <div class="progress-fill" style="width: ${pct}%; background: linear-gradient(90deg, #FFD700 0%, #FFA500 100%); border-radius: 10px; transition: width 0.5s ease;"></div>
                    </div>
                </div>
                
                <div class="grand-prize-badge" style="
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    background: rgba(255, 215, 0, 0.2);
                    padding: 8px 16px;
                    border-radius: 20px;
                    border: 1px solid rgba(255, 215, 0, 0.3);
                    font-weight: 800;
                    color: #DAA520;
                    font-size: 16px;
                    box-shadow: 0 4px 12px rgba(255, 215, 0, 0.1);
                ">
                    <span style="font-size: 13px; font-weight: 600; color: var(--text-secondary);">${__('achievements.grand_prize_prize') || 'Ҷоиза:'}</span>
                    <span style="display: flex; gap: 6px; align-items: center;">+${goldPrizeValue} 🪙 <span style="color: var(--text-secondary); font-weight: normal; font-size: 12px;">|</span> +${starPrizeValue} ⭐</span>
                </div>
            </div>
        `;
    }
}

function showAchievementDetails(id) {
    const a = ACHIEVEMENTS.find(item => item.id === id);
    if (!a) return;
    
    const child = getCurrentChild();
    const earned = child && child.achievements ? child.achievements.includes(id) : false;
    
    const displayName = __(`achievement.${id}`) || a.name;
    const displayDesc = __(`achievement.desc.${id}`) || a.desc;
    
    document.getElementById('achievement-modal-title').textContent = __('achievement_modal.title') || 'Муваффақият';
    document.getElementById('achievement-modal-icon').textContent = a.icon;
    document.getElementById('achievement-modal-name').textContent = displayName;
    
    const progress = getAchievementProgress(child, id);
    
    const descBox = document.getElementById('achievement-modal-desc-box');
    if (descBox) {
        descBox.innerHTML = `
            <p style="font-weight: 500; font-size: 13px; color: var(--text-secondary); margin-bottom: 5px;">${__('achievement_modal.condition_label') || 'Шарти муваффақият:'}</p>
            <p style="font-size: 15px; font-weight: 600; color: var(--text); margin-bottom: 12px; line-height: 1.4;">${displayDesc}</p>
            <p style="font-weight: 500; font-size: 12px; color: var(--text-secondary);">${__('achievement_modal.progress_label') || 'Пешрафт:'} <span style="font-weight: 700; color: var(--primary); font-size: 13px; margin-left: 4px;">${progress.formatted}</span></p>
        `;
    }
    
    const statusEl = document.getElementById('achievement-modal-status');
    if (statusEl) {
        if (earned) {
            statusEl.textContent = __('achievement_modal.status_unlocked') || 'Ба даст оварда шуд 🎉';
            statusEl.className = 'badge';
            statusEl.style.background = 'rgba(16, 185, 129, 0.1)';
            statusEl.style.color = '#10b981';
            statusEl.style.border = '1px solid rgba(16, 185, 129, 0.2)';
        } else {
            statusEl.textContent = __('achievement_modal.status_locked') || 'Қулф аст 🔒';
            statusEl.className = 'badge';
            statusEl.style.background = 'rgba(107, 114, 128, 0.1)';
            statusEl.style.color = '#6b7280';
            statusEl.style.border = '1px solid rgba(107, 114, 128, 0.2)';
        }
    }
    
    document.getElementById('achievement-modal').classList.remove('hidden');
}

function closeAchievementModal() {
    document.getElementById('achievement-modal').classList.add('hidden');
}

// ===== SETTINGS =====
let settingsPinVerified = false;
let parentPinVerified = false;

function showSettingsPin() {
    if (settingsPinVerified) {
        renderSettings();
        return;
    }
    document.getElementById('settings-pin-modal').classList.remove('hidden');
    document.getElementById('settings-pin-input').value = '';
    document.getElementById('settings-pin-error').classList.add('hidden');
    document.getElementById('settings-pin-input').focus();
    document.querySelector('#settings-pin-modal .modal-header h3').innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-shield"/></svg> ${__('pin.settings_title')}`;
    document.querySelector('#settings-pin-modal .modal-body p').textContent = __('pin.settings_instruction');
    document.getElementById('settings-pin-submit').textContent = __('pin.settings_enter');
}

function verifySettingsPin() {
    const pin = document.getElementById('settings-pin-input').value;
    if (pin !== state.pin) {
        document.getElementById('settings-pin-error').classList.remove('hidden');
        document.getElementById('settings-pin-error').textContent = __('pin.error');
        return;
    }
    settingsPinVerified = true;
    document.getElementById('settings-pin-modal').classList.add('hidden');
    navigateTo('settings');
}

function renderSettings() {
    const container = document.getElementById('settings-content');
    const child = getCurrentChild();
    if (!child) return;

    container.innerHTML = `
        <div class="settings-panel active" id="ssettings">
            <div class="settings-group">
                <h3><svg class="icon-svg" aria-hidden="true" style="width:18px;height:18px;color:var(--text-secondary);"><use href="#icon-settings"/></svg> ${__('settings.app_settings')}</h3>            <div class="settings-card">
                    <div class="settings-item" id="btn-change-pin">
                        <span class="settings-item-left">
                            <svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-shield"/></svg>
                            <span class="settings-item-label">${__('settings.change_pin')}</span>
                        </span>
                        <span class="settings-item-arrow">›</span>
                    </div>
                    <div class="settings-item" id="btn-language-setting">
                        <span class="settings-item-left">
                            <svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-flag"/></svg>
                            <span class="settings-item-label">${__('settings.language')}: ${currentLang === 'ru' ? __('settings.language_ru') : __('settings.language_tg')}</span>
                        </span>
                        <span class="settings-item-arrow">${currentLang === 'ru' ? '🇷🇺' : '🇹🇯'}</span>
                    </div>
                    <div class="settings-item" id="btn-reset-data">
                        <span class="settings-item-left">
                            <svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-skip"/></svg>
                            <span class="settings-item-label">${__('settings.reset_data')}</span>
                        </span>
                        <span class="settings-item-arrow">›</span>
                    </div>
                </div>
            </div>
            <div class="settings-group">
                <h3><svg class="icon-svg" aria-hidden="true" style="width:18px;height:18px;color:var(--text-secondary);"><use href="#icon-book"/></svg> ${__('settings.data_info')}</h3>
                <div class="settings-card">
                    <div class="settings-item">
                        <span class="settings-item-left">
                            <svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-book"/></svg>
                            <span class="settings-item-label">${__('settings.data_size')}</span>
                        </span>
                        <span class="settings-item-arrow">${Math.round(JSON.stringify(state).length / 1024)} KB</span>
                    </div>
                    <div class="settings-item" id="btn-export-data">
                        <span class="settings-item-left">
                            <svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-arrow-up"/></svg>
                            <span class="settings-item-label">${__('settings.export')}</span>
                        </span>
                        <span class="settings-item-arrow">›</span>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Settings actions
    document.getElementById('btn-change-pin').addEventListener('click', () => {
        const newPin = prompt(__('settings.change_pin_prompt'));
        if (newPin && /^\d{4}$/.test(newPin)) {
            state.pin = newPin;
            saveState();
            showToast('✅', __('settings.change_pin_success'));
        } else if (newPin) {
            showToast('❌', __('settings.change_pin_error'));
        }
    });

    // Language toggle in settings
    document.getElementById('btn-language-setting').addEventListener('click', () => {
        if (currentLang === 'ru') {
            setLanguage('tg');
        } else {
            setLanguage('ru');
        }
        saveState();
        settingsPinVerified = false;
        updateLanguageUI();
        // Re-render settings in new language
        renderSettings();
    });

    document.getElementById('btn-reset-data').addEventListener('click', () => {
        if (confirm(__('settings.reset_data_confirm'))) {
            localStorage.removeItem(STORAGE_KEY);
            location.reload();
        }
    });

    document.getElementById('btn-export-data').addEventListener('click', () => {
        const dataStr = JSON.stringify(state, null, 2);
        const blob = new Blob([dataStr], { type: 'application/json' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `kids_tasks_backup_${getToday()}.json`;
        a.click();
        URL.revokeObjectURL(url);
        showToast('📤', __('settings.export_success'));
    });
}

// ===== TASK MODAL =====
let editingTaskId = null;
let editingIsBonus = false;

function setFlatpickrValue(id, value) {
    const el = document.getElementById(id);
    if (!el) return;
    if (el._flatpickr) {
        el._flatpickr.setDate(value);
    } else {
        el.value = value;
    }
}

function hideAllModals() {
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        if (overlay.id !== 'timer-modal' || timerInterval === null) {
            overlay.classList.add('hidden');
        }
    });
}

function showTaskModal(task = null, forceBonus = false) {
    hideAllModals();
    console.trace("showTaskModal called with task:", task, "forceBonus:", forceBonus);
    const modal = document.getElementById('task-modal');
    const title = document.getElementById('task-modal-title');

    if (task && task.id) {
        title.textContent = __('task_form.title_edit');
        document.getElementById('task-name').value = task.name;
        const duration = task.duration || 20;
        document.getElementById('task-duration-hours').value = Math.floor(duration / 60);
        document.getElementById('task-duration-minutes').value = duration % 60;
        document.getElementById('task-instructions').value = task.instructions || '';
        
        const preview = document.getElementById('task-inst-image-preview');
        const img = document.getElementById('task-inst-image-img');
        const btn = document.getElementById('task-inst-image-btn');
        if (task.instructionImage) {
            img.src = task.instructionImage;
            preview.classList.remove('hidden');
            btn.classList.add('hidden');
        } else {
            img.src = '';
            preview.classList.add('hidden');
            btn.classList.remove('hidden');
        }
        
        let typeVal = task.type || (task.isBonus ? 'bonus' : 'daily');
        document.getElementById('task-type').value = typeVal;
        
        setFlatpickrValue('task-start-date', task.startDate || '');
        setFlatpickrValue('task-start-time', task.startTime || '12:00');
        document.getElementById('task-use-timer').checked = (task.useTimer !== false);
        document.getElementById('task-has-test').checked = (task.hasTest === true);
        setFlatpickrValue('task-test-date', task.testDate || '');
        setFlatpickrValue('task-test-time', task.testTime || '');
        document.getElementById('task-photo-required').checked = (task.photoRequired === true);
        document.getElementById('task-has-penalty').checked = (task.hasPenalty === true);
        document.getElementById('task-penalty-stars').value = task.penaltyStars || 0;
        document.getElementById('task-penalty-gold').value = task.penaltyGold || 0;
        document.getElementById('task-has-deadline').checked = (task.hasDeadline === true);
        setFlatpickrValue('task-deadline-date', task.deadlineDate || '');
        setFlatpickrValue('task-deadline-time', task.deadlineTime || '18:00');
        
        document.getElementById('task-has-strict-deadline').checked = (task.hasStrictDeadline === true);
        setFlatpickrValue('task-strict-deadline-date', task.strictDeadlineDate || '');
        setFlatpickrValue('task-strict-deadline-time', task.strictDeadlineTime || '18:00');
        
        document.getElementById('task-is-streak').checked = (task.isStreak === true);
        document.getElementById('task-streak-target').value = task.streakTarget || 5;
        
        const days = task.days || [1, 2, 3, 4, 5, 6, 0];
        const checkboxes = document.querySelectorAll('input[name="task-days"]');
        checkboxes.forEach(cb => {
            cb.checked = days.includes(parseInt(cb.value));
        });

        document.getElementById('task-reward-gold').value = task.rewardGold !== undefined ? task.rewardGold : (task.bonusPrice || 0);
        document.getElementById('task-reward-stars').value = task.rewardStars || 0;

        editingTaskId = task.id;
        editingIsBonus = (typeVal === 'bonus');
    } else {
        title.textContent = forceBonus
            ? __('task_form.title_new_bonus')
            : __('task_form.title_new');
        document.getElementById('task-name').value = '';
        document.getElementById('task-duration-hours').value = 0;
        document.getElementById('task-duration-minutes').value = 20;
        setFlatpickrValue('task-deadline-date', '');
        setFlatpickrValue('task-deadline-time', '18:00');
        
        setFlatpickrValue('task-strict-deadline-date', '');
        setFlatpickrValue('task-strict-deadline-time', '18:00');
        document.getElementById('task-instructions').value = '';
        
        const preview = document.getElementById('task-inst-image-preview');
        const img = document.getElementById('task-inst-image-img');
        const btn = document.getElementById('task-inst-image-btn');
        img.src = '';
        preview.classList.add('hidden');
        btn.classList.remove('hidden');
        
        const typeVal = forceBonus ? 'bonus' : 'one-time';
        document.getElementById('task-type').value = typeVal;
        setFlatpickrValue('task-start-date', '');
        setFlatpickrValue('task-start-time', '12:00');
        document.getElementById('task-use-timer').checked = false;
        document.getElementById('task-has-test').checked = false;
        setFlatpickrValue('task-test-date', '');
        setFlatpickrValue('task-test-time', '');
        document.getElementById('task-photo-required').checked = false;
        document.getElementById('task-has-penalty').checked = false;
        document.getElementById('task-penalty-stars').value = 0;
        document.getElementById('task-penalty-gold').value = 0;
        
        document.getElementById('task-has-deadline').checked = false;
        document.getElementById('task-has-strict-deadline').checked = false;
        document.getElementById('task-is-streak').checked = false;
        document.getElementById('task-streak-target').value = 5;

        const checkboxes = document.querySelectorAll('input[name="task-days"]');
        checkboxes.forEach(cb => {
            cb.checked = true;
        });

        document.getElementById('task-reward-gold').value = 0;
        document.getElementById('task-reward-stars').value = 0;

        editingTaskId = null;
        editingIsBonus = forceBonus;
    }

    updateTaskFieldsVisibility();
    updateTaskFormLabels();
    modal.classList.remove('hidden');
}

function updateTaskFormLabels() {
    const nameInput = document.getElementById('task-name');
    if (nameInput) nameInput.placeholder = __('task_form.name');

    const durationInput = document.getElementById('task-duration');
    if (durationInput) durationInput.placeholder = __('task_form.duration');

    const instTextarea = document.getElementById('task-instructions');
    if (instTextarea) instTextarea.placeholder = __('task_form.instructions_placeholder');

    const goldInput = document.getElementById('task-reward-gold');
    if (goldInput) goldInput.placeholder = '0';

    const starsInput = document.getElementById('task-reward-stars');
    if (starsInput) starsInput.placeholder = '0';

    // Reward labels — emoji only, no text
    const goldLabel = document.getElementById('task-reward-gold-label');
    if (goldLabel) goldLabel.innerHTML = '🪙';

    const starsLabel = document.getElementById('task-reward-stars-label');
    if (starsLabel) starsLabel.innerHTML = '⭐';

    const penaltyLabel = document.getElementById('task-has-penalty-label');
    if (penaltyLabel) penaltyLabel.textContent = __('task_form.has_penalty');
    const penaltyStarsLabel = document.getElementById('task-penalty-stars-label');
    if (penaltyStarsLabel) penaltyStarsLabel.innerHTML = '⭐';
    const penaltyGoldLabel = document.getElementById('task-penalty-gold-label');
    if (penaltyGoldLabel) penaltyGoldLabel.innerHTML = '🪙';

    const deadlineLabel = document.getElementById('task-deadline-label');
    if (deadlineLabel) deadlineLabel.textContent = `📅 ${__('task_form.deadline')}`;
    
    // Translate instructions labels
    const instImageLabel = document.getElementById('task-inst-image-label');
    if (instImageLabel) instImageLabel.textContent = __('task_form.inst_image');
    const instImageBtn = document.getElementById('task-inst-image-btn');
    if (instImageBtn) {
        instImageBtn.innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-plus"/></svg><span>${__('task_form.add_photo')}</span>`;
    }

    // Translate task type options
    const typeLabel = document.getElementById('task-type-label');
    if (typeLabel) typeLabel.textContent = __('task_form.type');
    const optDaily = document.getElementById('task-type-option-daily');
    if (optDaily) optDaily.textContent = __('task_form.type_daily');
    const optOneTime = document.getElementById('task-type-option-one-time');
    if (optOneTime) optOneTime.textContent = __('task_form.type_one_time');
    const optExam = document.getElementById('task-type-option-exam');
    if (optExam) optExam.textContent = __('task_form.type_exam');
    const optBonus = document.getElementById('task-type-option-bonus');
    if (optBonus) optBonus.textContent = __('task_form.type_bonus');

    // Translate scheduler labels
    const startTimeLabel = document.getElementById('task-start-time-label');
    if (startTimeLabel) startTimeLabel.textContent = __('task_form.start_time');
    const daysLabel = document.getElementById('task-days-label');
    if (daysLabel) daysLabel.textContent = __('task_form.days');
    const useTimerLabel = document.getElementById('task-use-timer-label');
    if (useTimerLabel) useTimerLabel.textContent = __('task_form.use_timer');
    const hasTestLabel = document.getElementById('task-has-test-label');
    if (hasTestLabel) hasTestLabel.textContent = __('task_form.has_test');
    const photoRequiredLabel = document.getElementById('task-photo-required-label');
    if (photoRequiredLabel) photoRequiredLabel.textContent = __('task_form.photo_required');
}

function updateTaskFieldsVisibility() {
    const typeVal = document.getElementById('task-type').value;
    const daysGroup = document.getElementById('task-days-group');
    const startDateContainer = document.getElementById('task-start-date-container');
    
    if (daysGroup) {
        daysGroup.classList.toggle('hidden', typeVal !== 'daily');
    }
    if (startDateContainer) {
        startDateContainer.classList.toggle('hidden', typeVal === 'daily');
    }
    // Progressive Disclosure Toggles
    const hasDeadline = document.getElementById('task-has-deadline')?.checked;
    const deadlineGroup = document.getElementById('task-deadline-group');
    if (deadlineGroup) deadlineGroup.classList.toggle('hidden', !hasDeadline);
    
    const hasStrictDeadline = document.getElementById('task-has-strict-deadline')?.checked;
    const strictDeadlineGroup = document.getElementById('task-strict-deadline-group');
    if (strictDeadlineGroup) strictDeadlineGroup.classList.toggle('hidden', !hasStrictDeadline);
    
    const useTimer = document.getElementById('task-use-timer')?.checked;
    const timerGroup = document.getElementById('task-timer-group');
    if (timerGroup) timerGroup.classList.toggle('hidden', !useTimer);
    
    const isStreak = document.getElementById('task-is-streak')?.checked;
    const streakGroup = document.getElementById('task-streak-group');
    if (streakGroup) streakGroup.classList.toggle('hidden', !isStreak);
    
    const hasTest = document.getElementById('task-has-test')?.checked;
    const testGroup = document.getElementById('task-test-group');
    if (testGroup) testGroup.classList.toggle('hidden', !hasTest);

    const hasPenalty = document.getElementById('task-has-penalty')?.checked;
    const penaltyGroup = document.getElementById('task-penalty-group');
    if (penaltyGroup) penaltyGroup.classList.toggle('hidden', !hasPenalty);
}

function saveTask() {
    const child = getCurrentChild();
    const name = document.getElementById('task-name').value.trim();
    const durationHours = parseInt(document.getElementById('task-duration-hours').value) || 0;
    const durationMinutes = parseInt(document.getElementById('task-duration-minutes').value) || 0;
    let duration = (durationHours * 60) + durationMinutes;
    if (duration === 0) duration = 20; // fallback default
    
    const typeVal = document.getElementById('task-type').value;
    const isBonus = (typeVal === 'bonus');
    
    const startDate = document.getElementById('task-start-date').value || '';
    const startTime = document.getElementById('task-start-time').value || '12:00';
    const useTimer = document.getElementById('task-use-timer').checked;
    const hasTest = document.getElementById('task-has-test').checked;
    const testDate = document.getElementById('task-test-date')?.value || '';
    const testTime = document.getElementById('task-test-time')?.value || '';
    const photoRequired = document.getElementById('task-photo-required').checked;
    const hasPenalty = document.getElementById('task-has-penalty').checked;
    const penaltyStars = parseInt(document.getElementById('task-penalty-stars').value) || 0;
    const penaltyGold = parseInt(document.getElementById('task-penalty-gold').value) || 0;
    
    const checkboxes = document.querySelectorAll('input[name="task-days"]');
    const days = Array.from(checkboxes).filter(cb => cb.checked).map(cb => parseInt(cb.value));

    const rewardGold = parseInt(document.getElementById('task-reward-gold').value) || 0;
    const rewardStars = parseInt(document.getElementById('task-reward-stars').value) || 0;
    const rewardMedals = 0;
    
    const instructions = document.getElementById('task-instructions').value.trim();
    const instImg = document.getElementById('task-inst-image-img');
    const instructionImage = (instImg.src && instImg.src.startsWith('data:')) ? instImg.src : '';

    if (!name) {
        showToast('❌', __('task_form.error_name'));
        return;
    }

    const hasDeadline = document.getElementById('task-has-deadline')?.checked || false;
    const deadlineDate = document.getElementById('task-deadline-date')?.value || '';
    const deadlineTime = document.getElementById('task-deadline-time')?.value || '18:00';
    
    const hasStrictDeadline = document.getElementById('task-has-strict-deadline')?.checked || false;
    const strictDeadlineDate = document.getElementById('task-strict-deadline-date')?.value || '';
    const strictDeadlineTime = document.getElementById('task-strict-deadline-time')?.value || '18:00';
    
    const isStreak = document.getElementById('task-is-streak')?.checked || false;
    const streakTarget = parseInt(document.getElementById('task-streak-target')?.value) || 5;

    const taskData = {
        name,
        duration,
        hasDeadline,
        deadlineDate,
        deadlineTime,
        hasStrictDeadline,
        strictDeadlineDate,
        strictDeadlineTime,
        isBonus,
        type: typeVal,
        startDate,
        startTime,
        useTimer,
        hasTest,
        testDate,
        testTime,
        photoRequired,
        hasPenalty,
        penaltyStars,
        penaltyGold,
        isStreak,
        streakTarget,
        currentStreak: 0,
        days,
        rewardGold,
        rewardStars,
        rewardMedals,
        instructions,
        instructionImage
    };

    if (editingTaskId) {
        const targetList = editingIsBonus ? child.bonusTasks : child.tasks;
        const taskIndex = targetList.findIndex(t => t.id === editingTaskId);
        if (taskIndex !== -1) {
            const task = targetList[taskIndex];
            Object.assign(task, taskData);
            
            // Move between lists if type changed to/from bonus
            if (editingIsBonus !== isBonus) {
                targetList.splice(taskIndex, 1);
                if (isBonus) {
                    child.bonusTasks.push(task);
                } else {
                    child.tasks.push(task);
                }
            }
        }
    } else {
        const newTask = Object.assign({
            id: generateId(),
            order: child.tasks.length + 1
        }, taskData);
        if (isBonus) {
            child.bonusTasks.push(newTask);
        } else {
            child.tasks.push(newTask);
        }
    }

    saveState();
    document.getElementById('task-modal').classList.add('hidden');
    if (currentPage === 'parent') {
        renderParentDashboard();
    } else {
        renderSettings();
    }
    updateUI();
}

// ===== CHILD MODAL =====
let editingChildId = null;

function showChildModal(childId = null) {
    hideAllModals();
    console.trace("showChildModal called with childId:", childId);
    const modal = document.getElementById('child-modal');
    const title = modal.querySelector('.modal-header h3');

    if (childId) {
        const child = getChild(childId);
        title.textContent = __('child_form.title_edit');
        document.getElementById('child-name').value = child.name;
        document.getElementById('child-emoji').value = child.emoji;
        document.getElementById('child-color').value = child.color;
        document.getElementById('child-reward-type').value = child.rewardType || 'money';
        editingChildId = childId;
        document.getElementById('child-delete-btn').classList.remove('hidden');
    } else {
        title.textContent = __('child_form.title_new');
        document.getElementById('child-name').value = '';
        document.getElementById('child-emoji').value = '👦';
        document.getElementById('child-color').value = '#6C63FF';
        document.getElementById('child-reward-type').value = 'money';
        editingChildId = null;
        document.getElementById('child-delete-btn').classList.add('hidden');
    }

    // Update labels for current language
    document.getElementById('child-name-label').textContent = __('child_form.name');
    document.getElementById('reward-type-label').textContent = `👑 ${__('reward.type')}`;
    const rtSelect = document.getElementById('child-reward-type');
    rtSelect.options[0].textContent = __('reward.money');
    rtSelect.options[1].textContent = __('reward.stars');
    rtSelect.options[2].textContent = __('reward.both');

    // Force DOM reposition to fix Safari/Mobile glitches
    document.body.appendChild(modal);
    
    // Force styles
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    modal.style.zIndex = '999999';
    modal.style.opacity = '1';
    modal.style.visibility = 'visible';
}

function saveChild() {
    const name = document.getElementById('child-name').value.trim();
    const emoji = document.getElementById('child-emoji').value.trim() || '👦';
    const color = document.getElementById('child-color').value;
    const rewardType = document.getElementById('child-reward-type').value;

    if (!name) {
        showToast('❌', __('child_form.error_name'));
        return;
    }

    if (editingChildId) {
        const child = getChild(editingChildId);
        if (child) {
            child.name = name;
            child.emoji = emoji;
            child.color = color;
            child.rewardType = rewardType;
        }
    } else {
        const newChild = {
            id: generateId(),
            name,
            emoji,
            color,
            rewardType: rewardType,
            tasks: [],
            bonusTasks: [],
            dailyLogs: {},
            tenDayTests: [],
            balance: 0,
            stars: 0,
            totalEarned: 0,
            totalDeducted: 0,
            totalStars: 0,
            withdrawals: []
        };
        state.children.push(newChild);
    }

    saveState();
    document.getElementById('child-modal').classList.add('hidden');
    renderChildTabs();
    renderSettings();
    updateUI();
}

function deleteChild() {
    if (!editingChildId) return;
    const child = getChild(editingChildId);
    if (!child) return;
    
    // Use confirm for safety, but since we don't have a custom confirm modal yet, use native confirm
    if (confirm("Шумо мутмаин ҳастед, ки мехоҳед профили кӯдакро пурра нест кунед? Ҳамаи маълумот ва супоришҳои ӯ тоза мешаванд.")) {
        state.children = state.children.filter(c => c.id !== editingChildId);
        if (currentChildId === editingChildId) {
            currentChildId = state.children.length > 0 ? state.children[0].id : null;
        }
        saveState();
        document.getElementById('child-modal').classList.add('hidden');
        renderChildTabs();
        renderSettings();
        updateUI();
    }
}

// ===== DREAMS =====
// ===== DREAM MODAL HANDLERS =====
let dreamPhotoData = null;
let parentDreamPhotoData = null;

function openDreamModal() {
    const modal = document.getElementById('dream-modal');
    if (!modal) return;
    // Reset fields
    const nameInput = document.getElementById('dream-name-input');
    const descInput = document.getElementById('dream-desc-input');
    const photoInput = document.getElementById('dream-photo-input');
    const photoPreview = document.getElementById('dream-photo-preview');
    const photoBtn = document.getElementById('dream-photo-btn');
    if (nameInput) nameInput.value = '';
    if (descInput) descInput.value = '';
    if (photoInput) photoInput.value = '';
    if (photoPreview) photoPreview.classList.add('hidden');
    if (photoBtn) photoBtn.classList.remove('hidden');
    dreamPhotoData = null;
    modal.classList.remove('hidden');
}

function closeDreamModal() {
    const modal = document.getElementById('dream-modal');
    if (modal) modal.classList.add('hidden');
    dreamPhotoData = null;
}

function handleDreamPhoto(file) {
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const img = new Image();
        img.onload = function() {
            const canvas = document.createElement('canvas');
            let w = img.width, h = img.height;
            const maxDim = 800;
            if (w > maxDim || h > maxDim) {
                if (w > h) {
                    h = h * maxDim / w;
                    w = maxDim;
                } else {
                    w = w * maxDim / h;
                    h = maxDim;
                }
            }
            canvas.width = w;
            canvas.height = h;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, w, h);
            dreamPhotoData = canvas.toDataURL('image/jpeg', 0.7);
            const imgEl = document.getElementById('dream-photo-img');
            if (imgEl) imgEl.src = dreamPhotoData;
            const preview = document.getElementById('dream-photo-preview');
            if (preview) preview.classList.remove('hidden');
            const btn = document.getElementById('dream-photo-btn');
            if (btn) btn.classList.add('hidden');
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

function submitDreamModal() {
    const nameInput = document.getElementById('dream-name-input');
    const descInput = document.getElementById('dream-desc-input');
    if (!nameInput) return;
    const name = nameInput.value.trim();
    if (!name) {
        showToast('⚠️', currentLang === 'ru' ? 'Введите название мечты' : 'Номи орзуро нависед');
        return;
    }
    const desc = descInput ? descInput.value.trim() : '';
    const child = getCurrentChild();
    if (!child) return;
    if (!child.dreams) child.dreams = [];
    child.dreams.push({
        id: 'dream_' + Date.now(),
        name: name,
        description: desc,
        photo: dreamPhotoData || null,
        costGold: 0,
        costStars: 0,
        achieved: false,
        approved: false,
        createdAt: new Date().toISOString()
    });
    saveState();
    showToast('✨', __('dream.add_success'));
    closeDreamModal();
    renderDreams();
}

function renderDreams() {
    const child = getCurrentChild();
    if (!child) return;
    if (!child.dreams) child.dreams = [];

    const listContainer = document.getElementById('dreams-list');
    if (!listContainer) return;

    // Update placeholders with translations
    const nameInput = document.getElementById('dream-input-name');
    if (nameInput) nameInput.placeholder = __('dream.new');

    // Setup add dream button
    const addBtn = document.getElementById('btn-add-dream');
    if (addBtn && !addBtn._bound) {
        addBtn._bound = true;
        addBtn.addEventListener('click', function() {
            const nameEl = document.getElementById('dream-input-name');
            if (!nameEl) return;
            const name = nameEl.value.trim();
            if (!name) return;

            const goldEl = document.getElementById('dream-input-gold');
            const starsEl = document.getElementById('dream-input-stars');
            const costGold = goldEl ? (parseInt(goldEl.value) || 0) : 0;
            const costStars = starsEl ? (parseInt(starsEl.value) || 0) : 0;

            const child = getCurrentChild();
            if (!child.dreams) child.dreams = [];
            child.dreams.push({
                id: 'dream_' + Date.now(),
                name: name,
                costGold: costGold,
                costStars: costStars,
                achieved: false,
                approved: (costGold > 0 || costStars > 0),
                createdAt: new Date().toISOString()
            });
            saveState();
            showToast('✨', __('dream.add_success'));
            if (nameEl) nameEl.value = '';
            if (goldEl) goldEl.value = '';
            if (starsEl) starsEl.value = '';
            renderDreams();
        });
    }

    // Render dreams list
    if (child.dreams.length === 0) {
        listContainer.innerHTML = `
            <div class="section-card" style="text-align: center; padding: 30px 20px;">
                <div style="font-size: 48px; margin-bottom: 12px;">🌟</div>
                <p style="color: var(--text-light); font-size: 14px;">${__('dream.list_empty')}</p>
            </div>
        `;
        return;
    }

    let html = '';
    const activeDreams = child.dreams.filter(d => !d.achieved);
    const achievedDreams = child.dreams.filter(d => d.achieved);

    activeDreams.forEach(dream => {
        const isApproved = dream.approved === true;
        
        let progressHtml = '';
        let canAchieve = false;
        
        if (dream.approved === 'rejected') {
            progressHtml = `
                <div style="font-size: 12px; color: var(--danger); font-style: italic; margin-top: 4px; display: flex; align-items: center; gap: 4px; font-weight: 500;">
                    ❌ ${currentLang === 'ru' ? 'Отклонено' : 'Рад карда шуд'} (${currentLang === 'ru' ? 'Причина' : 'Сабаб'}: ${dream.parentComment || (currentLang === 'ru' ? 'без причины' : 'бидуни сабаб')})
                </div>
            `;
        } else if (!isApproved) {
            progressHtml = `
                <div style="font-size: 12px; color: var(--warning); font-style: italic; margin-top: 4px; display: flex; align-items: center; gap: 4px;">
                    ⏳ ${__('dream.pending_pricing')}
                </div>
            `;
        } else {
            const goldProgress = dream.costGold > 0 ? Math.min(100, (child.balance / dream.costGold) * 100) : 100;
            const starsProgress = dream.costStars > 0 ? Math.min(100, ((child.stars || 0) / dream.costStars) * 100) : 100;
            canAchieve = (dream.costGold <= 0 || child.balance >= dream.costGold) && (dream.costStars <= 0 || (child.stars || 0) >= dream.costStars);
            
            progressHtml = `
                ${dream.costGold > 0 ? `
                    <div style="margin-bottom: 4px;">
                        <div style="display: flex; justify-content: space-between; font-size: 12px; color: var(--text-light); margin-bottom: 2px;">
                            <span>🪙 ${child.balance} / ${dream.costGold}</span>
                            <span>${Math.round(goldProgress)}%</span>
                        </div>
                        <div style="height: 6px; background: rgba(0,0,0,0.1); border-radius: 3px; overflow: hidden;">
                            <div style="height: 100%; width: ${goldProgress}%; background: linear-gradient(90deg, #F59E0B, #FCD34D); border-radius: 3px; transition: width 0.3s;"></div>
                        </div>
                    </div>
                ` : ''}
                ${dream.costStars > 0 ? `
                    <div style="margin-bottom: 4px;">
                        <div style="display: flex; justify-content: space-between; font-size: 12px; color: var(--text-light); margin-bottom: 2px;">
                            <span>⭐ ${child.stars || 0} / ${dream.costStars}</span>
                            <span>${Math.round(starsProgress)}%</span>
                        </div>
                        <div style="height: 6px; background: rgba(0,0,0,0.1); border-radius: 3px; overflow: hidden;">
                            <div style="height: 100%; width: ${starsProgress}%; background: linear-gradient(90deg, #8B5CF6, #C4B5FD); border-radius: 3px; transition: width 0.3s;"></div>
                        </div>
                    </div>
                ` : ''}
            `;
        }

        const dreamPhotoHtml = dream.photo ? `
            <div style="margin-top: 8px; border-radius: var(--radius-sm); overflow: hidden; max-height: 120px;">
                <img src="${dream.photo}" alt="${dream.name}" style="width: 100%; height: 120px; object-fit: cover; border-radius: var(--radius-sm);">
            </div>
        ` : '';
        const dreamDescHtml = dream.description ? `
            <div style="font-size: 12px; color: var(--text-light); margin-top: 4px; line-height: 1.4;">${dream.description}</div>
        ` : '';

        html += `
            <div class="section-card dream-card" style="margin-bottom: 12px; padding: 14px; border-radius: var(--radius-md); ${canAchieve ? 'border: 1px solid rgba(16, 185, 129, 0.4); box-shadow: 0 0 12px rgba(16, 185, 129, 0.15);' : ''}">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
                    <div style="flex: 1;">
                        <div style="font-weight: 600; font-size: 15px; margin-bottom: 4px;">🌟 ${dream.name}${isApproved ? `<span style="display:inline-block;font-size:10px;background:rgba(16,185,129,0.15);color:var(--success);padding:2px 8px;border-radius:10px;font-weight:600;margin-left:6px;">🤝 ${currentLang === 'ru' ? 'Обещано' : 'Ваъда шуд'}</span>` : ''}</div>
                        ${dreamDescHtml}
                        ${dreamPhotoHtml}
                        <div style="margin-top: 6px;">${progressHtml}</div>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 6px; align-items: flex-end;">
                        ${canAchieve ? `<button class="btn btn-primary btn-small dream-achieve-btn" data-dream-id="${dream.id}" style="font-size: 12px; padding: 6px 12px; white-space: nowrap;">🎉 ${__('dream.achieve_success').split('!')[0]}!</button>` : ''}
                        <button class="dream-delete-btn" data-dream-id="${dream.id}" style="background: none; border: none; color: var(--danger); cursor: pointer; font-size: 16px; padding: 4px;" title="${__('delete')}">🗑️</button>
                    </div>
                </div>
            </div>
        `;
    });

    // Achieved dreams
    if (achievedDreams.length > 0) {
        html += `<div style="margin-top: 16px;"><h4 style="font-size: 13px; color: var(--text-light); margin-bottom: 8px;">✅ ${currentLang === 'ru' ? 'Исполненные мечты' : 'Орзуҳои иҷрошуда'}</h4>`;
        achievedDreams.forEach(dream => {
            html += `
                <div class="section-card" style="margin-bottom: 8px; padding: 10px 14px; opacity: 0.7; border-radius: var(--radius-sm);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="text-decoration: line-through; font-size: 13px;">🌟 ${dream.name}</span>
                        <span style="font-size: 11px; color: var(--success);">✅</span>
                    </div>
                </div>
            `;
        });
        html += `</div>`;
    }

    listContainer.innerHTML = html;

    // Achieve dream handlers
    listContainer.querySelectorAll('.dream-achieve-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const dreamId = this.dataset.dreamId;
            const child = getCurrentChild();
            const dream = child.dreams.find(d => d.id === dreamId);
            if (!dream) return;

            if (dream.costGold > 0 && child.balance < dream.costGold) {
                showToast('❌', __('dream.not_enough'));
                return;
            }
            if (dream.costStars > 0 && (child.stars || 0) < dream.costStars) {
                showToast('❌', __('dream.not_enough'));
                return;
            }

            // Deduct
            if (dream.costGold > 0) child.balance -= dream.costGold;
            if (dream.costStars > 0) child.stars = (child.stars || 0) - dream.costStars;
            dream.achieved = true;
            dream.achievedAt = new Date().toISOString();
            saveState();
            showToast('🎉', __('dream.achieve_success'));
            launchConfetti();
            renderDreams();
            renderChildTabs();
        });
    });

    // Delete dream handlers
    listContainer.querySelectorAll('.dream-delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const dreamId = this.dataset.dreamId;
            const child = getCurrentChild();
            const idx = child.dreams.findIndex(d => d.id === dreamId);
            if (idx !== -1) {
                const title = currentLang === 'ru' ? 'Введите причину удаления мечты:' : 'Сабаби нест кардани орзуро нависед:';
                const placeholder = currentLang === 'ru' ? 'Введите причину...' : 'Сабабро нависед...';
                showCustomPrompt(title, placeholder).then(reason => {
                    if (reason === null) return; // User cancelled
                    const trimmedReason = reason.trim();
                    if (trimmedReason === '') {
                        showToast('⚠️', currentLang === 'ru' ? 'Причина обязательна!' : 'Сабаб албатта лозим аст!');
                        return;
                    }
                    child.dreams.splice(idx, 1);
                    saveState();
                    showToast('🗑️', currentLang === 'ru' ? 'Мечта удалена' : 'Орзу нест карда шуд');
                    renderDreams();
                });
            }
        });
    });
}

// ===== DAILY ROUTINE =====
function renderRoutine() {
    const child = getCurrentChild();
    if (!child) return;

    const container = document.getElementById('routine-timeline-list');
    if (!container) return;

    const todayDay = new Date().getDay();
    const now = new Date();
    const currentMinutes = now.getHours() * 60 + now.getMinutes();

    // Get all active tasks for today
    const todayTasks = [
        ...child.tasks.filter(t => t.type !== 'daily' || !t.days || t.days.includes(todayDay)),
        ...child.bonusTasks
    ];

    // Sort by start time
    todayTasks.sort((a, b) => {
        const aTime = a.startTime ? parseInt(a.startTime.split(':')[0]) * 60 + parseInt(a.startTime.split(':')[1]) : 9999;
        const bTime = b.startTime ? parseInt(b.startTime.split(':')[0]) * 60 + parseInt(b.startTime.split(':')[1]) : 9999;
        return aTime - bTime;
    });

    if (todayTasks.length === 0) {
        container.innerHTML = `
            <div style="text-align: center; padding: 30px 20px;">
                <div style="font-size: 48px; margin-bottom: 12px;">📋</div>
                <p style="color: var(--text-light); font-size: 14px;">${__('routine.no_tasks')}</p>
            </div>
        `;
        return;
    }

    const today = getToday();
    const log = getOrCreateDailyLog(currentChildId);

    if (log.excused) {
        container.innerHTML = `
            <div class="task-card" style="text-align:center;padding:40px 20px;display:block;border-left:3px solid var(--warning);">
                <div style="font-size:64px;margin-bottom:16px;">🙏</div>
                <h3 style="font-size:18px;margin-bottom:8px;">${__('excused_day.title')}</h3>
                <p style="color:var(--text-light);font-size:14px;">${__('excused_day.reason')} ${log.excuseReason}</p>
            </div>
        `;
        return;
    }

    let html = '';

    todayTasks.forEach((task, idx) => {
        const tl = log.tasks[task.id];
        const status = tl ? tl.status : 'pending';
        const startTime = task.startTime || '--:--';
        const taskMinutes = task.startTime ? parseInt(task.startTime.split(':')[0]) * 60 + parseInt(task.startTime.split(':')[1]) : null;
        
        // Determine if this is past, current, or future
        let timeState = 'future';
        if (status === 'completed' && tl && tl.confirmed) {
            timeState = 'completed';
        } else if (status === 'skipped') {
            timeState = 'skipped';
        } else if (status === 'in-progress') {
            timeState = 'current';
        } else if (status === 'awaiting-confirm') {
            timeState = 'awaiting';
        } else if (taskMinutes !== null && currentMinutes >= taskMinutes) {
            timeState = 'current';
        }

        let dotColor = 'var(--text-light)';
        let dotIcon = '';
        let cardBg = '';
        if (timeState === 'completed') {
            dotColor = 'var(--success)';
            dotIcon = '✓';
            cardBg = 'background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(16, 185, 129, 0.03) 100%); border-left: 3px solid var(--success);';
        } else if (timeState === 'skipped') {
            dotColor = 'var(--danger)';
            dotIcon = '✕';
            cardBg = 'opacity: 0.6; border-left: 3px solid var(--danger);';
        } else if (timeState === 'current' || timeState === 'awaiting') {
            dotColor = 'var(--primary)';
            dotIcon = '▶';
            cardBg = 'background: linear-gradient(135deg, rgba(124, 58, 237, 0.08) 0%, rgba(124, 58, 237, 0.03) 100%); border-left: 3px solid var(--primary); box-shadow: 0 0 8px rgba(124, 58, 237, 0.15);';
        } else {
            cardBg = 'border-left: 3px solid var(--border);';
        }

        const gold = task.rewardGold !== undefined ? task.rewardGold : (task.bonusPrice || 0);
        const stars = task.rewardStars || 0;
        const isBonus = task.isBonus || task.type === 'bonus';

        const statusLabels = {
            'pending': __('status.pending'),
            'in-progress': __('status.in-progress'),
            'awaiting-confirm': __('status.awaiting-confirm'),
            'completed': __('status.completed'),
            'skipped': __('status.skipped')
        };

        html += `
            <div class="routine-item" style="display: flex; align-items: flex-start; gap: 12px;">
                <div style="display: flex; flex-direction: column; align-items: center; min-width: 40px; padding-top: 2px;">
                    <div style="font-size: 11px; font-weight: 700; color: ${dotColor}; margin-bottom: 4px;">${startTime}</div>
                    <div style="width: 18px; height: 18px; border-radius: 50%; background: ${dotColor}; display: flex; align-items: center; justify-content: center; font-size: 9px; color: white; font-weight: 700;">
                        ${dotIcon}
                    </div>
                </div>
                <div class="section-card" style="flex: 1; padding: 10px 14px; border-radius: var(--radius-sm); ${cardBg} margin-bottom: 0;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">
                                ${isBonus ? '🎁 ' : ''}${task.name}
                            </div>
                            <div style="display: flex; gap: 6px; flex-wrap: wrap; font-size: 11px;">
                                <span style="background: rgba(0,0,0,0.05); padding: 2px 6px; border-radius: 4px;">⏱ ${task.duration} ${__('task.minutes')}</span>
                                <span style="background: rgba(245, 158, 11, 0.1); color: rgb(245, 158, 11); padding: 2px 6px; border-radius: 4px;">🪙 ${gold} ⭐ ${stars}</span>
                            </div>
                        </div>
                        <div style="font-size: 11px; padding: 2px 8px; border-radius: 4px; font-weight: 600;
                            ${timeState === 'completed' ? 'background: rgba(16, 185, 129, 0.15); color: var(--success);' : 
                              timeState === 'skipped' ? 'background: rgba(239, 68, 68, 0.15); color: var(--danger);' :
                              timeState === 'current' || timeState === 'awaiting' ? 'background: rgba(124, 58, 237, 0.15); color: var(--primary);' :
                              'background: rgba(0,0,0,0.05); color: var(--text-light);'}
                        ">
                            ${statusLabels[status] || statusLabels['pending']}
                        </div>
                    </div>
                </div>
            </div>
        `;
    });

    container.innerHTML = html;
}

// ===== PARENT DASHBOARD =====
function showParentPin() {
    if (parentPinVerified) {
        renderParentDashboard();
        return;
    }
    document.getElementById('pin-modal').classList.remove('hidden');
    document.getElementById('pin-input').value = '';
    document.getElementById('pin-error').classList.add('hidden');
    document.getElementById('pin-input').focus();
    var h3 = document.querySelector('#pin-modal .modal-header h3');
    h3.innerHTML = "<svg class='icon-svg' aria-hidden='true'><use href='#icon-shield'/></svg> " + __('pin.parent_title');
    document.querySelector('#pin-modal .modal-body p').textContent = __('pin.parent_instruction');
    document.getElementById('pin-submit').textContent = __('confirm');
    window.__pendingParentAuth = true;
}

function renderParentDashboard() {
    parentDreamPhotoData = null;
    var container = document.getElementById("parent-content");
    if (!container) return;
    
    if (state.children.length === 0) {
        container.innerHTML = "<div class='parent-overview'><div class='empty-state'>" + __('parent.no_children') + "</div></div>";
        return;
    }

    // Use the currently selected child for task management
    var selectedChild = getCurrentChild();
    if (!selectedChild) {
        selectedChild = state.children[0];
    }

    var html = "<div class='parent-overview'>";

    // Top action buttons in 2x2 grid
    html += "<div class='section-card' style='margin-bottom:15px;'>";
    html += "<div style='display: grid; grid-template-columns: 1fr 1fr; gap: 8px;'>";
    html += "  <button class='btn btn-primary btn-parent-add-task' style='height: 40px; display: flex; align-items: center; justify-content: center; gap: 6px; font-weight: 600; font-size: 13px;'>";
    html += "    <svg class='icon-svg' style='width:14px;height:14px;' aria-hidden='true'><use href='#icon-plus'/></svg> " + __('settings.add_task') + "</button>";
    html += "  <button class='btn btn-secondary btn-parent-manage-routine' style='height: 40px; display: flex; align-items: center; justify-content: center; gap: 6px; font-weight: 600; font-size: 13px; background: rgba(59, 130, 246, 0.1); color: var(--primary); border: 1px solid rgba(59, 130, 246, 0.2);'>";
    html += "    <svg class='icon-svg' style='width:14px;height:14px;fill:currentColor;' aria-hidden='true'><use href='#icon-clock'/></svg> " + __('parent.manage_routine') + "</button>";
    html += "  <button class='btn btn-outline btn-parent-excuse-day' style='height: 40px; display: flex; align-items: center; justify-content: center; gap: 6px; font-weight: 600; font-size: 13px; border-color: rgba(245, 158, 11, 0.3); color: var(--warning);'>";
    html += "    <svg class='icon-svg' style='width:14px;height:14px;' aria-hidden='true'><use href='#icon-skip'/></svg> " + __('excuse.title') + "</button>";
    html += "  <button class='btn btn-secondary btn-parent-add-dream' style='height: 40px; display: flex; align-items: center; justify-content: center; gap: 6px; font-weight: 600; font-size: 13px; background: rgba(124, 58, 237, 0.1); color: var(--primary); border: 1px solid rgba(124, 58, 237, 0.2);'>";
    html += "    <svg class='icon-svg' style='width:14px;height:14px;' aria-hidden='true'><use href='#icon-plus'/></svg> " + (currentLang === 'ru' ? 'Мечта от родителей' : 'Орзу аз волидон') + "</button>";
    html += "</div>";
    html += "</div>";

    // ---- Task Management Section ----
    html += "<div class='parent-task-section'>";

    // Regular tasks - render only if count > 0
    if (selectedChild.tasks.length > 0) {
        html += "<div class='section-card'><h4>" + __('settings.daily_tasks') + "</h4>";
        html += "<ul class='item-list'>";
        selectedChild.tasks.sort(function(a, b) { return a.order - b.order; }).forEach(function(task) {
            var iconName = 'icon-clock';
            if (task.type === 'one-time') iconName = 'icon-calendar';
            else if (task.type === 'exam') iconName = 'icon-book';
            else if (task.type === 'bonus') iconName = 'icon-gift';

            var typeBadge = "";
            if (task.type === 'one-time') {
                typeBadge = " <span style='font-size:10px;background:rgba(147, 51, 234, 0.1);color:rgb(147, 51, 234);padding:1px 4px;border-radius:4px;margin-left:4px;'>" + __('task_form.type_one_time') + "</span>";
            } else if (task.type === 'exam') {
                typeBadge = " <span style='font-size:10px;background:rgba(239, 68, 68, 0.1);color:rgb(239, 68, 68);padding:1px 4px;border-radius:4px;margin-left:4px;'>" + __('task_form.type_exam') + "</span>";
            } else {
                typeBadge = " <span style='font-size:10px;background:rgba(59, 130, 246, 0.1);color:rgb(59, 130, 246);padding:1px 4px;border-radius:4px;margin-left:4px;'>" + __('task_form.type_daily') + "</span>";
            }

            var gold = task.rewardGold !== undefined ? task.rewardGold : 0;
            var stars = task.rewardStars || 0;
            var rewardsBadge = " <span style='font-size:10px;background:rgba(245, 158, 11, 0.1);color:rgb(245, 158, 11);padding:1px 4px;border-radius:4px;margin-left:4px;'>🪙 " + gold + " ⭐ " + stars;
            rewardsBadge += "</span>";

            html += "<li>";
            html += "<span class='item-emoji' style='color:var(--primary);display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;'><svg class='icon-svg' style='width:16px;height:16px;' aria-hidden='true'><use href='#" + iconName + "'/></svg></span>";
            html += "<span class='item-text'>" + task.name + typeBadge + rewardsBadge + " <span class='item-meta'>⏱ " + task.duration + " " + __('task.minutes') + "</span></span>";
            html += "<span class='item-actions'>";
            html += "<button class='edit-btn' data-task-id='" + task.id + "' data-is-bonus='false' title='" + __('edit') + "'>✏️</button>";
            html += "<button class='delete-btn' data-task-id='" + task.id + "' data-is-bonus='false' title='" + __('edit') + "'>🗑️</button>";
            html += "</span></li>";
        });
        html += "</ul>";
        html += "</div>";
    }

    // Bonus tasks - render only if count > 0
    if (selectedChild.bonusTasks.length > 0) {
        html += "<div class='section-card'><h4>" + __('settings.bonus_tasks') + "</h4>";
        html += "<ul class='item-list'>";
        selectedChild.bonusTasks.forEach(function(task) {
            var iconName = 'icon-gift';
            var gold = task.rewardGold !== undefined ? task.rewardGold : (task.bonusPrice || 0);
            var stars = task.rewardStars || 0;
            var rewardsBadge = " <span style='font-size:10px;background:rgba(245, 158, 11, 0.1);color:rgb(245, 158, 11);padding:1px 4px;border-radius:4px;margin-left:4px;'>🪙 " + gold + " ⭐ " + stars;
            rewardsBadge += "</span>";

            html += "<li>";
            html += "<span class='item-emoji' style='color:var(--primary);display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;'><svg class='icon-svg' style='width:16px;height:16px;' aria-hidden='true'><use href='#" + iconName + "'/></svg></span>";
            html += "<span class='item-text'>" + task.name + rewardsBadge + "</span>";
            html += "<span class='item-actions'>";
            html += "<button class='edit-btn' data-task-id='" + task.id + "' data-is-bonus='true' title='" + __('edit') + "'>✏️</button>";
            html += "<button class='delete-btn' data-task-id='" + task.id + "' data-is-bonus='true' title='" + __('edit') + "'>🗑️</button>";
            html += "</span></li>";
        });
        html += "</ul>";
        html += "</div>";
    }

    // Pending Withdrawal Requests Section - render only if count > 0
    if (!selectedChild.withdrawals) selectedChild.withdrawals = [];
    var pendingReqs = selectedChild.withdrawals.filter(function(w) { return w.status === 'pending'; });
    
    if (pendingReqs.length > 0) {
        html += "<div class='section-card' style='background: linear-gradient(135deg, rgba(124,58,237,0.05) 0%, rgba(76,29,149,0.05) 100%); border: 1px solid rgba(124,58,237,0.15); margin-top: 15px;'>";
        html += "<h4 style='display:flex;align-items:center;gap:6px;'><svg class='icon-svg' aria-hidden='true' style='width:16px;height:16px;'><use href='#icon-wallet'/></svg> " + __('parent.withdraw_requests') + "</h4>";
        html += "<ul class='item-list' style='margin-top:10px;list-style:none;padding:0;'>";
        pendingReqs.forEach(function(req) {
            var sym = req.type === 'stars' ? '⭐' : '🪙';
            html += "<li style='display:flex; flex-direction:column; padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.05);'>";
            html += "<div style='display:flex; justify-content:space-between; align-items:center; width:100%;'>";
            html += "<span>⏱ " + formatDate(req.date) + " — <strong style='font-size:16px;color:#FCD34D;'>" + req.amount + " " + sym + "</strong></span>";
            html += "<div style='display:flex; gap:6px;'>";
            html += "<button class='parent-approve-btn' data-req-id='" + req.id + "' style='padding:6px 12px; font-size:12px; background:#10B981; border:none; color:white; border-radius:6px; cursor:pointer; font-weight:600;'>" + __('parent.approve') + "</button>";
            html += "<button class='parent-reject-btn' data-req-id='" + req.id + "' style='padding:6px 12px; font-size:12px; background:#EF4444; border:none; color:white; border-radius:6px; cursor:pointer; font-weight:600;'>" + __('parent.reject') + "</button>";
            html += "</div></div>";
            if (req.reason || req.photo) {
                html += "<div style='margin-top:8px; font-size:13px; color:var(--text-secondary); background: rgba(0,0,0,0.1); padding: 8px; border-radius: 6px;'>";
                if (req.reason) html += "<div style='margin-bottom:4px;'><strong style='color:var(--text);'>📝 Сабаб:</strong> " + req.reason + "</div>";
                if (req.photo) html += "<img src='" + req.photo + "' style='max-width:150px; border-radius:6px; margin-top:4px; display:block; cursor:zoom-in;' onclick='openImageZoomModal(\"" + req.photo + "\")'>";
                html += "</div>";
            }
            html += "</li>";
        });
        html += "</ul>";
        html += "</div>";
    }

    // ---- Dreams Management Section - render only if child has written dreams ----
    if (!selectedChild.dreams) selectedChild.dreams = [];
    
    if (selectedChild.dreams.length > 0) {
        html += "<div class='section-card' style='margin-top: 15px;'>";
        html += "<h4 style='display:flex;align-items:center;gap:6px;'><svg class='icon-svg' aria-hidden='true' style='width:16px;height:16px;color:var(--secondary);'><use href='#icon-sparkle'/></svg> Идораи орзуҳо</h4>";
        html += "<ul class='item-list' style='margin-top:10px;list-style:none;padding:0;'>";
        selectedChild.dreams.forEach(function(dream) {
            var isApproved = dream.approved !== false && (dream.costGold > 0 || dream.costStars > 0);
            
            html += "<li style='display:flex; flex-direction:column; padding:10px 0; border-bottom:1px solid rgba(0,0,0,0.05);'>";
            html += "<div style='display:flex; justify-content:space-between; align-items:center; width:100%;'>";
            html += "<span>🌟 <strong>" + dream.name + "</strong>" + (dream.achieved ? " (✅ Иҷро шуд)" : "") + "</span>";
            html += "<div style='display:flex; gap:6px;'>";
            html += "<button class='parent-delete-dream-btn' data-dream-id='" + dream.id + "' style='background:none; border:none; cursor:pointer;'>🗑️</button>";
            html += "</div></div>";
            
            if (dream.description) {
                html += "<div style='font-size:12px; color:var(--text-light); margin-top:2px; line-height:1.4;'>" + dream.description + "</div>";
            }
            if (dream.photo) {
                html += "<div style='margin-top:6px; border-radius:6px; overflow:hidden; max-height:80px; width:fit-content; cursor:zoom-in;' onclick='openImageZoomModal(\"" + dream.photo + "\")'>";
                html += "<img src='" + dream.photo + "' style='max-height:80px; border-radius:6px; object-fit:cover;'>";
                html += "</div>";
            }
            
            if (dream.approved === 'rejected') {
                html += "<div style='font-size: 12px; color: var(--danger); font-style: italic; margin-top: 4px; font-weight: 500;'>";
                html += "❌ Рад шуд (Сабаб: " + (dream.parentComment || 'сабаб нишон дода нашудааст') + ")";
                html += "</div>";
            }

            if (!dream.achieved) {
                var btnLabel = 'Захира';
                var showReject = false;
                if (dream.approved === false) {
                    btnLabel = 'Тасдиқ кардан';
                    showReject = true;
                } else if (dream.approved === 'rejected') {
                    btnLabel = 'Тасдиқ кардан';
                }

                html += "<div style='margin-top:8px; display:flex; gap:8px; align-items:center; flex-wrap:wrap;'>";
                html += "<div style='position: relative; display: inline-block; width: 75px;'>";
                html += "<input type='number' class='dream-gold-cost-input' data-dream-id='" + dream.id + "' placeholder='0' value='" + (dream.costGold || '') + "' style='width: 100%; padding: 4px 22px 4px 6px; border: 1px solid var(--border); border-radius: 6px; font-size: 12px; height: 30px; box-sizing: border-box;'>";
                html += "<span style='position: absolute; right: 6px; top: 50%; transform: translateY(-50%); pointer-events: none; font-size: 12px;'>🪙</span>";
                html += "</div>";
                html += "<div style='position: relative; display: inline-block; width: 75px;'>";
                html += "<input type='number' class='dream-stars-cost-input' data-dream-id='" + dream.id + "' placeholder='0' value='" + (dream.costStars || '') + "' style='width: 100%; padding: 4px 22px 4px 6px; border: 1px solid var(--border); border-radius: 6px; font-size: 12px; height: 30px; box-sizing: border-box;'>";
                html += "<span style='position: absolute; right: 6px; top: 50%; transform: translateY(-50%); pointer-events: none; font-size: 12px;'>⭐</span>";
                html += "</div>";
                html += "<button class='parent-save-dream-price-btn btn btn-primary' data-dream-id='" + dream.id + "' style='padding:4px 8px; font-size:12px; height:30px; line-height:20px;'>" + btnLabel + "</button>";
                if (showReject) {
                    html += "<button class='parent-reject-dream-btn btn btn-danger' data-dream-id='" + dream.id + "' style='padding:4px 8px; font-size:12px; height:30px; line-height:20px;'>Рад кардан</button>";
                }
                html += "</div>";
            } else {
                html += "<div style='margin-top:4px; font-size:12px; color:var(--text-light);'>Арзиш: 🪙 " + dream.costGold + ", ⭐ " + dream.costStars + "</div>";
            }
            
            html += "</li>";
        });
        html += "</ul>";
        html += "</div>";
    }

    html += "</div>"; // close parent-task-section
    html += "</div>"; // close parent-overview

    container.innerHTML = html;

    // ---- Floating Settings FAB + Bottom-Sheet Modal ----
    var pageParent = document.getElementById('page-parent');
    // Remove stale FAB/modal from previous renders
    var _oldFab = document.getElementById('parent-settings-fab');
    if (_oldFab) _oldFab.remove();
    var _oldModal = document.getElementById('parent-settings-modal');
    if (_oldModal) _oldModal.remove();

    // Create FAB
    var fabEl = document.createElement('div');
    fabEl.id = 'parent-settings-fab';
    fabEl.style.cssText = 'position:fixed;bottom:82px;right:16px;z-index:200;';
    fabEl.innerHTML =
        '<button id="parent-settings-fab-btn" title="' + (currentLang === 'ru' ? 'Настройки' : 'Танзимот') + '" ' +
        'style="width:50px;height:50px;border-radius:50%;background:linear-gradient(135deg,#7C3AED,#4C1D95);' +
        'border:none;color:white;cursor:pointer;box-shadow:0 4px 20px rgba(124,58,237,0.45);' +
        'transition:all 0.25s ease;display:flex;align-items:center;justify-content:center;">' +
        '<svg style="width:22px;height:22px;" aria-hidden="true"><use href="#icon-settings"></use></svg>' +
        '</button>';
    pageParent.appendChild(fabEl);

    // Create bottom-sheet modal
    var modalEl = document.createElement('div');
    modalEl.id = 'parent-settings-modal';
    modalEl.style.cssText = 'display:none;position:fixed;inset:0;background:rgba(0,0,0,0.55);' +
        'z-index:250;align-items:flex-end;justify-content:center;backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);';
    modalEl.innerHTML =
        '<div style="position:absolute;bottom:0;left:50%;transform:translateX(-50%);width:100%;max-width:480px;' +
        'background:var(--bg-card);border-radius:20px 20px 0 0;padding:20px 20px 36px;box-shadow:0 -8px 32px rgba(0,0,0,0.25);">' +
        '<div style="width:40px;height:4px;background:rgba(128,128,128,0.25);border-radius:2px;margin:0 auto 18px;"></div>' +
        '<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">' +
        '<h4 style="font-size:16px;font-weight:700;margin:0;display:flex;align-items:center;gap:8px;">' +
        '<svg class="icon-svg" aria-hidden="true" style="width:18px;height:18px;"><use href="#icon-settings"></use></svg> ' +
        __('settings.app_settings') + '</h4>' +
        '<button id="parent-settings-modal-close" style="background:rgba(128,128,128,0.12);border:none;cursor:pointer;' +
        'color:var(--text-secondary);width:32px;height:32px;border-radius:50%;display:flex;align-items:center;' +
        'justify-content:center;font-size:16px;transition:all 0.2s;">✕</button>' +
        '</div>' +
        '<div class="settings-card">' +
        '<div class="settings-item parent-settings-pin" style="cursor:pointer;">' +
        '<span class="settings-item-left"><svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-shield"/></svg>' +
        '<span class="settings-item-label">' + __('settings.change_pin') + '</span></span>' +
        '<span class="settings-item-arrow">›</span></div>' +
        '<div class="settings-item parent-settings-lang" style="cursor:pointer;">' +
        '<span class="settings-item-left"><svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-flag"/></svg>' +
        '<span class="settings-item-label">' + __('settings.language') + ': ' + (currentLang === 'ru' ? __('settings.language_ru') : __('settings.language_tg')) + '</span></span>' +
        '<span class="settings-item-arrow">' + (currentLang === 'ru' ? '🇷🇺' : '🇹🇯') + '</span></div>' +
        '<div class="settings-item parent-settings-export" style="cursor:pointer;">' +
        '<span class="settings-item-left"><svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-arrow-up"/></svg>' +
        '<span class="settings-item-label">' + __('settings.export') + '</span></span>' +
        '<span class="settings-item-arrow">' + Math.round(JSON.stringify(state).length / 1024) + ' KB</span></div>' +
        '<div class="settings-item parent-settings-reset" style="cursor:pointer;">' +
        '<span class="settings-item-left"><svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-skip"/></svg>' +
        '<span class="settings-item-label">' + __('settings.reset_data') + '</span></span>' +
        '<span class="settings-item-arrow">›</span></div>' +
        '</div></div>';
    pageParent.appendChild(modalEl);

    // FAB: open modal
    document.getElementById('parent-settings-fab-btn').addEventListener('click', function() {
        document.getElementById('parent-settings-modal').style.display = 'flex';
    });
    // Close button
    document.getElementById('parent-settings-modal-close').addEventListener('click', function() {
        document.getElementById('parent-settings-modal').style.display = 'none';
    });
    // Tap backdrop to close
    modalEl.addEventListener('click', function(e) {
        if (e.target === modalEl) modalEl.style.display = 'none';
    });

    // ---- Attach event listeners ----

    // Add task
    container.querySelector('.btn-parent-add-task').addEventListener('click', function() {
        showTaskModal(null, false);
    });

    // Edit task
    container.querySelectorAll('.edit-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var taskId = this.dataset.taskId;
            var isBonus = this.dataset.isBonus === 'true';
            var taskList = isBonus ? selectedChild.bonusTasks : selectedChild.tasks;
            var task = taskList.find(function(t) { return t.id === taskId; });
            if (task) showTaskModal(task, isBonus);
        });
    });

    // Delete task
    container.querySelectorAll('.delete-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (!confirm(__('settings.delete_task_confirm'))) return;
            var taskId = this.dataset.taskId;
            var isBonus = this.dataset.isBonus === 'true';
            var taskList = isBonus ? selectedChild.bonusTasks : selectedChild.tasks;
            var idx = taskList.findIndex(function(t) { return t.id === taskId; });
            if (idx !== -1) {
                taskList.splice(idx, 1);
                saveState();
                renderParentDashboard();
                updateUI();
            }
        });
    });

    // Bonus example chips
    container.querySelectorAll('.bonus-example-chip').forEach(function(chip) {
        chip.addEventListener('click', function() {
            showTaskModal(null, true);
            // Pre-fill name and emoji after modal opens
            document.getElementById('task-name').value = this.dataset.name;
            document.getElementById('task-emoji').value = this.dataset.emoji;
        });
    });

    // Approve withdraw request
    container.querySelectorAll('.parent-approve-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var reqId = this.dataset.reqId;
            var child = getCurrentChild();
            var req = child.withdrawals.find(function(w) { return w.id === reqId; });
            if (!req) return;

            // Perform actual deduction
            if (req.type === 'stars') {
                child.stars = (child.stars || 0) - req.amount;
            } else {
                child.balance -= req.amount;
            }

            req.status = 'approved';
            saveState();
            showToast('✅', __('confirm'));
            renderParentDashboard();
            updateUI();
        });
    });

    // Reject withdraw request
    container.querySelectorAll('.parent-reject-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var reqId = this.dataset.reqId;
            var child = getCurrentChild();
            var req = child.withdrawals.find(function(w) { return w.id === reqId; });
            if (!req) return;

            showCustomPrompt(__('parent.reject_reason_prompt')).then(function(reason) {
                if (reason === null) return; // parent cancelled prompt
                
                req.status = 'rejected';
                req.parentComment = reason.trim();
                saveState();
                showToast('❌', __('confirm'));
                renderParentDashboard();
                updateUI();
            });
        });
    });

    // Excuse day button
    var excuseBtn = container.querySelector('.btn-parent-excuse-day');
    if (excuseBtn) {
        excuseBtn.addEventListener('click', function() {
            showExcuseModal();
        });
    }

    // Settings: Change PIN (now in modal — use document.querySelector)
    var pinItem = document.querySelector('.parent-settings-pin');
    if (pinItem) {
        pinItem.addEventListener('click', function() {
            document.getElementById('parent-settings-modal').style.display = 'none';
            var newPin = prompt(__('settings.change_pin_prompt'));
            if (newPin && /^\d{4}$/.test(newPin)) {
                state.pin = newPin;
                saveState();
                showToast('✅', __('settings.change_pin_success'));
            } else if (newPin) {
                showToast('❌', __('settings.change_pin_error'));
            }
        });
    }

    // Settings: Language Toggle
    var langItem = document.querySelector('.parent-settings-lang');
    if (langItem) {
        langItem.addEventListener('click', function() {
            document.getElementById('parent-settings-modal').style.display = 'none';
            if (currentLang === 'ru') {
                setLanguage('tg');
            } else {
                setLanguage('ru');
            }
            saveState();
            parentPinVerified = true;
            updateLanguageUI();
            renderParentDashboard();
        });
    }

    // Settings: Export Data
    var exportItem = document.querySelector('.parent-settings-export');
    if (exportItem) {
        exportItem.addEventListener('click', function() {
            var dataStr = JSON.stringify(state, null, 2);
            var blob = new Blob([dataStr], { type: 'application/json' });
            var url = URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'kids_tasks_backup_' + getToday() + '.json';
            a.click();
            URL.revokeObjectURL(url);
            showToast('📤', __('settings.export_success'));
        });
    }

    // Dreams: Save Dream Price
    container.querySelectorAll('.parent-save-dream-price-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var dreamId = this.dataset.dreamId;
            var goldInput = container.querySelector(".dream-gold-cost-input[data-dream-id='" + dreamId + "']");
            var starsInput = container.querySelector(".dream-stars-cost-input[data-dream-id='" + dreamId + "']");
            
            var goldCost = parseInt(goldInput.value) || 0;
            var starsCost = parseInt(starsInput.value) || 0;
            
            if (goldCost <= 0 && starsCost <= 0) {
                showToast('⚠️', currentLang === 'ru' ? 'Цена не определена!' : 'Нарх муайян карда нашуд!');
                return;
            }
            
            var dream = selectedChild.dreams.find(function(d) { return d.id === dreamId; });
            if (dream) {
                dream.costGold = goldCost;
                dream.costStars = starsCost;
                dream.approved = true;
                saveState();
                showToast('✨', 'Нархи орзу муайян карда шуд!');
                renderParentDashboard();
            }
        });
    });

    // Dreams: Reject Dream
    container.querySelectorAll('.parent-reject-dream-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var dreamId = this.dataset.dreamId;
            showCustomPrompt(currentLang === 'ru' ? 'Введите причину отклонения:' : 'Сабаби радкуниро ворид кунед:').then(function(reason) {
                if (reason === null) return; // parent cancelled prompt
                
                var dream = selectedChild.dreams.find(function(d) { return d.id === dreamId; });
                if (dream) {
                    dream.approved = 'rejected';
                    dream.parentComment = reason.trim();
                    saveState();
                    showToast('❌', 'Орзу рад карда шуд!');
                    renderParentDashboard();
                }
            });
        });
    });

    // Dreams: Delete Dream
    container.querySelectorAll('.parent-delete-dream-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var dreamId = this.dataset.dreamId;
            var idx = selectedChild.dreams.findIndex(function(d) { return d.id === dreamId; });
            if (idx !== -1) {
                selectedChild.dreams.splice(idx, 1);
                saveState();
                showToast('🗑️', 'Орзу нест карда шуд!');
                renderParentDashboard();
            }
        });
    });

    // Dreams: Add dream via modal
    var parentAddDreamBtn = container.querySelector('.btn-parent-add-dream');
    if (parentAddDreamBtn) {
        parentAddDreamBtn.addEventListener('click', function() {
            showParentAddDreamModal();
        });
    }

    // Daily Routine: Manage routine via modal
    var parentManageRoutineBtn = container.querySelector('.btn-parent-manage-routine');
    if (parentManageRoutineBtn) {
        parentManageRoutineBtn.addEventListener('click', function() {
            showParentRoutineModal();
        });
    }

    // Settings: Reset Data
    var resetItem = document.querySelector('.parent-settings-reset');
    if (resetItem) {
        resetItem.addEventListener('click', function() {
            document.getElementById('parent-settings-modal').style.display = 'none';
            if (confirm(__('settings.reset_data_confirm'))) {
                localStorage.removeItem(STORAGE_KEY);
                location.reload();
            }
        });
    }
}

// ===== EXCUSE DAY =====
let selectedExcuseReason = null;

function showExcuseModal() {
    selectedExcuseReason = null;
    document.getElementById('custom-excuse-group').classList.add('hidden');
    document.getElementById('excuse-pin').value = '';
    document.getElementById('excuse-error').classList.add('hidden');
    document.getElementById('excuse-modal').classList.remove('hidden');

    document.querySelectorAll('.excuse-btn').forEach(b => b.classList.remove('selected'));

    // Update labels
    document.querySelector('#excuse-modal .modal-header h3').textContent = __('excuse.title');
    document.querySelector('#excuse-modal .modal-body p').textContent = __('excuse.choose_reason');
    document.querySelector('.excuse-btn[data-reason="беморӣ"]').textContent = __('excuse.sickness');
    document.querySelector('.excuse-btn[data-reason="меҳмонӣ"]').textContent = __('excuse.visit');
    document.querySelector('.excuse-btn[data-reason="сафар"]').textContent = __('excuse.travel');
    document.querySelector('.excuse-btn[data-reason="дигар"]').textContent = __('excuse.other');
    document.getElementById('custom-excuse').placeholder = __('excuse.custom_placeholder');
    document.getElementById('excuse-submit').textContent = __('confirm');
}

function submitExcuse() {
    const pin = document.getElementById('excuse-pin').value;
    if (pin !== state.pin) {
        document.getElementById('excuse-error').classList.remove('hidden');
        document.getElementById('excuse-error').textContent = __('pin.error');
        return;
    }

    let reason = selectedExcuseReason;
    if (reason === 'дигар') {
        reason = document.getElementById('custom-excuse').value.trim();
        if (!reason) {
            showToast('❌', __('excuse.error_empty'));
            return;
        }
    }

    const child = getCurrentChild();
    const today = getToday();
    const log = getOrCreateDailyLog(currentChildId);
    log.excused = true;
    log.excuseReason = reason;
    Object.keys(log.tasks).forEach(taskId => {
        log.tasks[taskId].status = 'completed';
        log.tasks[taskId].confirmed = true;
    });
    log.rewardApplied = true;
    saveState();

    document.getElementById('excuse-modal').classList.add('hidden');
    showToast('🙏', __('excuse.success'));
    renderTasks();
    updateUI();
}

// ===== WITHDRAWAL =====
function showWithdrawModal() {
    const child = getCurrentChild();
    const rt = child.rewardType || 'money';

    // Allow modal to open even if 0 balance, so user sees it works

    const typeGroup = document.getElementById('withdraw-type-group');
    const typeSelect = document.getElementById('withdraw-currency-type');
    
    if (rt === 'both') {
        typeGroup.classList.remove('hidden');
        typeSelect.innerHTML = '';
        if (child.balance > 0) {
            typeSelect.innerHTML += `<option value="money">🪙 (${child.balance})</option>`;
        }
        if ((child.stars || 0) > 0) {
            typeSelect.innerHTML += `<option value="stars">⭐ Ситорача (${child.stars || 0})</option>`;
        }
        if (typeSelect.options.length === 0) {
            typeSelect.innerHTML = `<option value="money">🪙 (0)</option><option value="stars">⭐ Ситорача (0)</option>`;
        }
        typeSelect.selectedIndex = 0;
    } else {
        typeGroup.classList.add('hidden');
        typeSelect.innerHTML = rt === 'stars' 
            ? `<option value="stars">⭐ Ситорача</option>` 
            : `<option value="money">🪙</option>`;
        typeSelect.value = rt;
    }

    // Safely update withdraw modal elements
    const withdrawModal = document.getElementById('withdraw-modal');
    if (!withdrawModal) { console.error('withdraw-modal not found'); return; }

    const withdrawBalanceEl = document.getElementById('withdraw-balance');
    if (withdrawBalanceEl) withdrawBalanceEl.textContent = formatBalanceFull(child);

    const withdrawAmountEl = document.getElementById('withdraw-amount');
    if (withdrawAmountEl) {
        withdrawAmountEl.value = '';
        withdrawAmountEl.placeholder = __('balance.withdraw_amount') || 'Миқдор...';
    }

    // Show the modal
    withdrawModal.classList.remove('hidden');

    const modalHeader = withdrawModal.querySelector('.modal-header h3');
    if (modalHeader) modalHeader.innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-wallet"/></svg> ${__('balance.withdraw_title') || 'Ихроҷ'}`;
    
    const modalBodyP = withdrawModal.querySelector('.modal-body p');
    if (modalBodyP) modalBodyP.textContent = __('balance.withdraw_how_much') || 'Чӣ қадар мехоҳед ихроҷ кунед?';
    
    const withdrawInfo = withdrawModal.querySelector('.withdraw-info');
    if (withdrawInfo) withdrawInfo.innerHTML = `${__('balance.withdraw_current') || 'Тавозуни ҷорӣ:'} <strong>${formatBalanceFull(child)}</strong>`;
}

function submitWithdraw() {
    const amount = parseInt(document.getElementById('withdraw-amount').value);
    const child = getCurrentChild();
    const withdrawType = document.getElementById('withdraw-currency-type').value;
    const reasonEl = document.getElementById('withdraw-reason');
    const reason = reasonEl ? reasonEl.value : '';
    const photoImg = document.getElementById('withdraw-photo-img');
    const photo = (photoImg && photoImg.src && photoImg.src.startsWith('data:')) ? photoImg.src : null;

    if (!amount || amount <= 0) {
        showToast('❌', __('balance.withdraw_error_amount'));
        return;
    }

    // Check if balance is sufficient
    if (withdrawType === 'stars') {
        const currentStars = child.stars || 0;
        if (amount > currentStars) {
            showToast('❌', __('balance.withdraw_error_balance') || 'Маблағ кофӣ нест!');
            return;
        }
    } else {
        const currentGold = child.balance || 0;
        if (amount > currentGold) {
            showToast('❌', __('balance.withdraw_error_balance') || 'Маблағ кофӣ нест!');
            return;
        }
    }

    if (!child.withdrawals) child.withdrawals = [];
    child.withdrawals.push({
        id: 'req_' + Date.now() + '_' + Math.floor(Math.random() * 1000),
        date: getToday(),
        amount: amount,
        type: withdrawType,
        reason: reason,
        photo: photo,
        status: 'pending',
        parentComment: ''
    });

    saveState();

    // Reset fields for next time
    if (reasonEl) reasonEl.value = '';
    if (photoImg) photoImg.src = '';
    const photoPreview = document.getElementById('withdraw-photo-preview');
    if (photoPreview) photoPreview.classList.add('hidden');
    const photoBtn = document.getElementById('withdraw-photo-btn');
    if (photoBtn) photoBtn.classList.remove('hidden');

    document.getElementById('withdraw-modal').classList.add('hidden');
    showToast('🚀', __('balance.withdraw_sent'));
    renderBalance();
    updateUI();
}

function renderWithdrawalHistory() {
    const child = getCurrentChild();
    const container = document.getElementById('withdrawal-history');
    if (!container) return;

    if (!child.withdrawals || child.withdrawals.length === 0) {
        container.innerHTML = `<p class="empty-state" style="color:var(--text-muted);font-size:14px;">${__('balance.no_withdrawals') || 'Таърихи ихроҷ холӣ аст'}</p>`;
        return;
    }

    let html = `<h4 style="margin-bottom:12px;display:flex;align-items:center;gap:6px;"><svg class="icon-svg" aria-hidden="true" style="width:16px;height:16px;"><use href="#icon-wallet"/></svg> Таърихи ихроҷ</h4>`;
    html += `<ul class="item-list" style="list-style:none;padding:0;">`;
    
    const sorted = [...child.withdrawals].sort((a, b) => b.id.localeCompare(a.id));
    
    sorted.forEach((req, index) => {
        let sym = req.type === 'stars' ? '⭐' : '🪙';
        let statusBadge = '';
        if (req.status === 'pending') {
            statusBadge = `<span style="font-size:11px;background:rgba(245,158,11,0.1);color:#F59E0B;padding:2px 6px;border-radius:4px;">Дар интизор</span>`;
        } else if (req.status === 'approved') {
            statusBadge = `<span style="font-size:11px;background:rgba(16,185,129,0.1);color:#10B981;padding:2px 6px;border-radius:4px;">Тасдиқ шуд</span>`;
        } else {
            statusBadge = `<span style="font-size:11px;background:rgba(239,68,68,0.1);color:#EF4444;padding:2px 6px;border-radius:4px;">Рад шуд</span>`;
        }

        let hiddenClass = index >= 5 ? ' hidden extra-withdrawal' : '';
        html += `<li class="withdrawal-item${hiddenClass}" style="display:flex; flex-direction:column; padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.05);">`;
        html += `<div style="display:flex; justify-content:space-between; align-items:center; width:100%;">`;
        html += `<span>⏱ ${formatDate(req.date)} — <strong style="font-size:15px;color:#FCD34D;">${req.amount} ${sym}</strong></span>`;
        html += `<div>${statusBadge}</div>`;
        html += `</div>`;
        if (req.reason || req.photo) {
            html += `<div style="margin-top:8px; font-size:13px; color:var(--text-secondary); background: rgba(0,0,0,0.1); padding: 8px; border-radius: 6px;">`;
            if (req.reason) html += `<div style="margin-bottom:4px;"><strong style="color:var(--text);">📝 Сабаб:</strong> ${req.reason}</div>`;
            if (req.photo) html += `<img src="${req.photo}" style="max-width:150px; border-radius:6px; margin-top:4px; display:block; cursor:zoom-in;" onclick="openImageZoomModal('${req.photo}')">`;
            html += `</div>`;
        }
        html += `</li>`;
    });
    
    html += `</ul>`;
    
    if (sorted.length > 5) {
        html += `<button class="btn btn-secondary btn-full" id="toggle-withdrawals-btn" style="margin-top:10px; background:transparent; border:1px solid rgba(255,255,255,0.1); color:var(--text-secondary);">Нишон додани ҳама</button>`;
    }
    
    container.innerHTML = html;

    const toggleBtn = document.getElementById('toggle-withdrawals-btn');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            const extraItems = container.querySelectorAll('.extra-withdrawal');
            if (!extraItems.length) return;
            const isHidden = extraItems[0].classList.contains('hidden');
            extraItems.forEach(item => {
                if (isHidden) item.classList.remove('hidden');
                else item.classList.add('hidden');
            });
            toggleBtn.textContent = isHidden ? 'Пинҳон кардан' : 'Нишон додани ҳама';
        });
    }
}

function renderTestHistory() {
    const child = getCurrentChild();
    const container = document.getElementById('test-history');
    if (!container) return;
    
    if (!child.tenDayTests || child.tenDayTests.length === 0) {
        container.innerHTML = `<p class="empty-state" style="color:var(--text-muted);font-size:14px;">${__('balance.no_tests') || 'Таърихи санҷишҳо холӣ аст'}</p>`;
        return;
    }

    let html = `<h4 style="margin-bottom:12px;display:flex;align-items:center;gap:6px;"><svg class="icon-svg" aria-hidden="true" style="width:16px;height:16px;"><use href="#icon-edit"/></svg> ${__('test.history') || 'Таърихи санҷишҳо'}</h4>`;
    html += `<ul class="item-list" style="list-style:none;padding:0;">`;
    
    // Show newest first
    const sorted = [...child.tenDayTests].sort((a, b) => b.id.localeCompare(a.id));
    
    sorted.forEach(test => {
        let total = Object.values(test.scores).reduce((sum, s) => sum + s, 0);
        let max = Object.keys(test.scores).length;
        let badgeColor = total === max ? '#10B981' : (total >= max/2 ? '#F59E0B' : '#EF4444');
        let badgeBg = total === max ? 'rgba(16,185,129,0.1)' : (total >= max/2 ? 'rgba(245,158,11,0.1)' : 'rgba(239,68,68,0.1)');
        
        html += `<li style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.05);">`;
        html += `<span>⏱ ${formatDate(test.date)}</span>`;
        html += `<div><span style="font-size:13px;background:${badgeBg};color:${badgeColor};padding:3px 8px;border-radius:4px;font-weight:600;">${total} / ${max}</span></div>`;
        html += `</li>`;
    });
    
    html += `</ul>`;
    container.innerHTML = html;
}

// ===== 10-DAY TEST =====
let currentTestId = null;

function showTestModal(test) {
    const child = getCurrentChild();
    const modal = document.getElementById('test-modal');
    const list = document.getElementById('test-tasks-list');
    currentTestId = test.id;

    document.querySelector('#test-modal .modal-header h3').innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-edit"/></svg> ${__('test.title')}`;
    document.querySelector('#test-modal .modal-body p').textContent = __('test.instruction');

    list.innerHTML = '';
    let totalScore = 0;

    child.tasks.sort((a, b) => a.order - b.order).forEach(task => {
        const score = test.scores[task.id] !== undefined ? test.scores[task.id] : -1;
        const item = document.createElement('div');
        item.className = 'test-task-item';
        item.innerHTML = `
            <span class="test-task-name">${task.emoji} ${task.name}</span>
            <div class="test-task-score">
                <button class="test-score-btn ${score === 0 ? 'fail' : ''}" data-score="0">0</button>
                <button class="test-score-btn ${score === 1 ? 'pass' : ''}" data-score="1">1</button>
            </div>
        `;

        item.querySelectorAll('.test-score-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const s = parseInt(btn.dataset.score);
                test.scores[task.id] = s;
                item.querySelectorAll('.test-score-btn').forEach(b => {
                    b.className = 'test-score-btn';
                    if (parseInt(b.dataset.score) === s) {
                        b.classList.add(s === 1 ? 'pass' : 'fail');
                    }
                });
                updateTestScore(test);
            });
        });

        list.appendChild(item);
    });

    updateTestScore(test);

    document.getElementById('test-pin').value = '';
    document.getElementById('test-error').classList.add('hidden');
    document.querySelector('#test-modal .test-total span:first-child').textContent = __('test.total');
    document.getElementById('test-submit').textContent = __('confirm');
    modal.classList.remove('hidden');
}

function updateTestScore(test) {
    let total = 0;
    Object.values(test.scores).forEach(s => { if (s >= 0) total += s; });
    test.totalScore = total;
    document.getElementById('test-score').textContent = total;

    const child = getCurrentChild();
    const rt = child ? child.rewardType || 'money' : 'money';

    let rewardText;
    const rewardAmounts = getTestRewardAmounts(child, total);
    if (total === 10 || total === 9) {
        rewardText = `🎉 ${__('test.reward')} ${rewardAmounts.text}`;
    } else {
        rewardText = __('test.no_reward');
    }

    document.getElementById('test-reward-info').textContent = rewardText;
}

function submitTest() {
    const pin = document.getElementById('test-pin').value;
    if (pin !== state.pin) {
        document.getElementById('test-error').classList.remove('hidden');
        document.getElementById('test-error').textContent = __('pin.error');
        return;
    }

    const child = getCurrentChild();
    const test = child.tenDayTests.find(t => t.id === currentTestId);
    if (!test) return;

    const allEvaluated = Object.values(test.scores).every(s => s >= 0);
    if (!allEvaluated) {
        showToast('❌', __('test.evaluate_all'));
        return;
    }

    evaluateTest(currentChildId, test.id, test.scores);
    document.getElementById('test-modal').classList.add('hidden');

    const rt = child.rewardType || 'money';
    if (test.totalScore >= 9) {
        let rewardStr;
        if (rt === 'stars') rewardStr = `${test.starReward} ⭐`;
        else if (rt === 'both') rewardStr = `${test.reward}${__('balance.currency.sm')} + ${test.starReward}⭐`;
        else rewardStr = `${test.reward}${__('balance.currency.sm')}`;

        showToast('🎉', `${test.totalScore}/10 — ${rewardStr}!`);
        launchConfetti();
    } else {
        showToast('📝', __('test.result', { score: test.totalScore }));
    }

    const result = checkAchievements(currentChildId);
    if (result.prestigeTriggered) {
        showPrestigeModal(result.newTier, result.goldPrize, result.starPrize);
    }
    updateUI();
}

// ===== TOAST NOTIFICATIONS =====
let toastTimeout = null;

function showToast(emoji, message) {
    const toast = document.getElementById('toast');
    document.getElementById('toast-emoji').textContent = emoji;
    document.getElementById('toast-message').textContent = message;

    if (toastTimeout) clearTimeout(toastTimeout);

    toast.classList.remove('hidden');
    // Re-trigger animation
    toast.style.animation = 'none';
    toast.offsetHeight;
    toast.style.animation = '';

    toastTimeout = setTimeout(() => {
        toast.classList.add('hidden');
    }, 3000);
}

// ===== CONFETTI =====
function launchConfetti() {
    const canvas = document.getElementById('confetti-canvas');
    canvas.classList.remove('hidden');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const ctx = canvas.getContext('2d');
    const particles = [];
    const colors = ['#FF6B6B', '#FFD93D', '#6BCB77', '#45AAF2', '#6C63FF', '#FF8A5C', '#FF4757'];

    for (let i = 0; i < 150; i++) {
        particles.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height - canvas.height,
            w: Math.random() * 10 + 5,
            h: Math.random() * 6 + 3,
            color: colors[Math.floor(Math.random() * colors.length)],
            vx: (Math.random() - 0.5) * 4,
            vy: Math.random() * 3 + 2,
            rot: Math.random() * 360,
            rotSpeed: (Math.random() - 0.5) * 10
        });
    }

    let frame = 0;
    function animate() {
        frame++;
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        particles.forEach(p => {
            p.x += p.vx;
            p.vy += 0.05;
            p.y += p.vy;
            p.rot += p.rotSpeed;

            ctx.save();
            ctx.translate(p.x, p.y);
            ctx.rotate((p.rot * Math.PI) / 180);
            ctx.fillStyle = p.color;
            ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
            ctx.restore();
        });

        if (frame < 200) {
            requestAnimationFrame(animate);
        } else {
            canvas.classList.add('hidden');
        }
    }

    animate();
}

// ===== WELCOME SCREEN =====
let welcomeSelectedLang = null;

function showWelcomeScreen() {
    const overlay = document.getElementById('welcome-screen');
    overlay.classList.remove('hidden');
    welcomeSelectedLang = null;

    const startBtn = document.getElementById('welcome-start-btn');
    startBtn.classList.remove('active');

    // Language button selection
    document.querySelectorAll('.welcome-lang-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.welcome-lang-btn').forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            welcomeSelectedLang = btn.dataset.lang;
            startBtn.classList.add('active');

            // Update welcome text in the selected language
            setLanguage(welcomeSelectedLang);
            document.getElementById('welcome-greeting').textContent = __('welcome.title');
            document.getElementById('welcome-subtitle').textContent = __('welcome.subtitle');
            document.getElementById('welcome-lang-label').textContent = __('welcome.select_language');
            document.getElementById('welcome-name-tg').textContent = __('welcome.tg');
            document.getElementById('welcome-name-ru').textContent = __('welcome.ru');
            document.getElementById('welcome-start-text').textContent = __('welcome.start');
            document.getElementById('welcome-title').textContent = __('app.name');

            // Also update the app title
            document.title = __('app.title');
        });
    });

    // Start button
    startBtn.addEventListener('click', () => {
        if (!welcomeSelectedLang) return;

        // Set the language permanently
        setLanguage(welcomeSelectedLang);
        state.language = welcomeSelectedLang;
        saveState();

        // Hide welcome, start the app
        overlay.classList.add('hidden');
        window._isFirstLaunch = false;
        initApp();
    });
}

// ===== EVENT LISTENERS =====
function setupEventListeners() {
    // Navigation
    document.querySelectorAll('.nav-btn').forEach(btn => {
        btn.addEventListener('click', () => navigateTo(btn.dataset.page));
    });

    // Child selector (dropdown picker)
    document.getElementById('child-selector-btn').addEventListener('click', (e) => {
        e.stopPropagation();
        toggleChildPicker();
    });
    
    document.getElementById('header-edit-child-btn').addEventListener('click', (e) => {
        e.stopPropagation();
        e.preventDefault();
        const activeChild = getCurrentChild();
        if (activeChild) {
            hideAllModals(); // force hide anything else
            showChildModal(activeChild.id);
        } else {
            console.error("No active child found when clicking edit child button!");
        }
    });

    // Close picker on click outside
    document.addEventListener('click', (e) => {
        const picker = document.getElementById('child-picker');
        const btn = document.getElementById('child-selector-btn');
        if (!picker.classList.contains('hidden')) {
            const wrapper = document.querySelector('.child-selector-wrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                closeChildPicker();
            }
        }
    });

    // Language settings (in settings page, not header)
    // Language toggle is handled via settings page only

    // Calendar nav
    document.getElementById('cal-prev').addEventListener('click', () => {
        calendarMonth--;
        if (calendarMonth < 0) { calendarMonth = 11; calendarYear--; }
        renderCalendar();
    });
    document.getElementById('cal-next').addEventListener('click', () => {
        calendarMonth++;
        if (calendarMonth > 11) { calendarMonth = 0; calendarYear++; }
        renderCalendar();
    });

    // Timer
    document.getElementById('timer-start-btn').addEventListener('click', startTimer);
    document.getElementById('timer-pause-btn').addEventListener('click', pauseTimer);

    // Photo upload
    document.getElementById('proof-photo-btn').addEventListener('click', () => {
        document.getElementById('proof-photo-input').click();
    });
    document.getElementById('proof-photo-input').addEventListener('change', handlePhotoUpload);
    document.getElementById('proof-photo-remove').addEventListener('click', () => {
        document.getElementById('proof-photo-preview').classList.add('hidden');
        document.getElementById('proof-photo-img').src = '';
        document.getElementById('proof-photo-input').value = '';
        document.getElementById('proof-photo-btn').classList.remove('hidden');
    });

    // Instructions photo upload
    document.getElementById('task-inst-image-btn').addEventListener('click', () => {
        document.getElementById('task-inst-image-input').click();
    });
    document.getElementById('task-inst-image-input').addEventListener('change', handleInstructionPhotoUpload);
    document.getElementById('task-inst-image-remove').addEventListener('click', () => {
        document.getElementById('task-inst-image-preview').classList.add('hidden');
        document.getElementById('task-inst-image-img').src = '';
        document.getElementById('task-inst-image-input').value = '';
        document.getElementById('task-inst-image-btn').classList.remove('hidden');
    });
    document.getElementById('proof-submit-btn').addEventListener('click', submitProof);

    // Withdraw photo upload
    const withdrawPhotoBtn = document.getElementById('withdraw-photo-btn');
    if (withdrawPhotoBtn) {
        withdrawPhotoBtn.addEventListener('click', () => {
            document.getElementById('withdraw-photo-input').click();
        });
        document.getElementById('withdraw-photo-input').addEventListener('change', handleWithdrawPhotoUpload);
        document.getElementById('withdraw-photo-remove').addEventListener('click', () => {
            document.getElementById('withdraw-photo-preview').classList.add('hidden');
            document.getElementById('withdraw-photo-img').src = '';
            document.getElementById('withdraw-photo-input').value = '';
            document.getElementById('withdraw-photo-btn').classList.remove('hidden');
        });
    }

    // Timer cancel: close directly if not actively counting; require PIN if running
    document.getElementById('timer-cancel-btn').addEventListener('click', () => {
        // If timer is not actively counting down (not started, paused, or completed), close directly
        if (timerInterval === null) {
            // Revert task status back to pending so it doesn't re-open
            // Only revert if still 'in-progress' (not if timer completed naturally to 'awaiting-confirm')
            const child = getCurrentChild();
            if (child && timerTaskId) {
                const today = getToday();
                const log = child.dailyLogs[today];
                const tl = log && log.tasks[timerTaskId];
                if (tl && tl.status === 'in-progress') {
                    tl.status = 'pending';
                    saveState();
                }
            }
            closeTimer();
            renderTasks();
            updateUI();
            return;
        }
        // Timer IS actively running — show PIN input to cancel
        document.getElementById('timer-cancel-pin').value = '';
        document.getElementById('timer-cancel-error').classList.add('hidden');
        const group = document.getElementById('timer-cancel-pin-group');
        group.classList.toggle('hidden');
        if (!group.classList.contains('hidden')) {
            document.getElementById('timer-cancel-pin').focus();
            document.querySelector('#timer-cancel-pin-group p').textContent = __('timer.cancel_hint');
        }
    });
    document.getElementById('timer-cancel-submit').addEventListener('click', () => {
        const pin = document.getElementById('timer-cancel-pin').value;
        if (pin !== state.pin) {
            document.getElementById('timer-cancel-error').classList.remove('hidden');
            document.getElementById('timer-cancel-error').textContent = __('pin.error');
            return;
        }
        // Revert task status when canceling with PIN
        // Only revert if still 'in-progress'
        const child = getCurrentChild();
        if (child && timerTaskId) {
            const today = getToday();
            const log = child.dailyLogs[today];
            const tl = log && log.tasks[timerTaskId];
            if (tl && tl.status === 'in-progress') {
                tl.status = 'pending';
                saveState();
            }
        }
        closeTimer();
        document.getElementById('timer-cancel-pin-group').classList.add('hidden');
        document.getElementById('timer-cancel-btn').classList.remove('hidden');
        renderTasks();
        updateUI();
    });
    document.getElementById('timer-cancel-pin').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            document.getElementById('timer-cancel-submit').click();
        }
    });

    // Confirm modal
    document.getElementById('confirm-submit').addEventListener('click', submitConfirm);
    document.getElementById('confirm-pin').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') submitConfirm();
    });
    document.getElementById('confirm-close').addEventListener('click', () => {
        document.getElementById('confirm-modal').classList.add('hidden');
    });

    // Skip modal
    document.getElementById('skip-submit-btn').addEventListener('click', submitSkip);
    document.getElementById('skip-close').addEventListener('click', () => {
        document.getElementById('skip-modal').classList.add('hidden');
    });

    // Excuse buttons
    document.querySelectorAll('.excuse-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.excuse-btn').forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            selectedExcuseReason = btn.dataset.reason;
            document.getElementById('custom-excuse-group').classList.toggle('hidden', selectedExcuseReason !== 'дигар');
        });
    });
    document.getElementById('excuse-submit').addEventListener('click', submitExcuse);
    document.getElementById('excuse-pin').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') submitExcuse();
    });
    document.getElementById('excuse-close').addEventListener('click', () => {
        document.getElementById('excuse-modal').classList.add('hidden');
    });

    // Withdraw
    document.getElementById('btn-withdraw').addEventListener('click', showWithdrawModal);
    document.getElementById('withdraw-submit').addEventListener('click', submitWithdraw);
    document.getElementById('withdraw-amount').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') submitWithdraw();
    });
    document.getElementById('withdraw-close').addEventListener('click', () => {
        document.getElementById('withdraw-modal').classList.add('hidden');
    });

    // Test modal
    document.getElementById('test-submit').addEventListener('click', submitTest);
    document.getElementById('test-pin').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') submitTest();
    });
    document.getElementById('test-close').addEventListener('click', () => {
        document.getElementById('test-modal').classList.add('hidden');
    });

    // Dream modal
    const dreamOpenBtn = document.getElementById('btn-open-dream-modal');
    if (dreamOpenBtn) {
        dreamOpenBtn.addEventListener('click', openDreamModal);
    }
    const dreamCloseBtn = document.getElementById('dream-modal-close');
    if (dreamCloseBtn) {
        dreamCloseBtn.addEventListener('click', closeDreamModal);
    }
    const dreamSubmitBtn = document.getElementById('dream-modal-submit');
    if (dreamSubmitBtn) {
        dreamSubmitBtn.addEventListener('click', submitDreamModal);
    }
    const dreamPhotoBtn = document.getElementById('dream-photo-btn');
    if (dreamPhotoBtn) {
        dreamPhotoBtn.addEventListener('click', () => {
            document.getElementById('dream-photo-input').click();
        });
    }
    const dreamPhotoInput = document.getElementById('dream-photo-input');
    if (dreamPhotoInput) {
        dreamPhotoInput.addEventListener('change', (e) => {
            if (e.target.files && e.target.files[0]) {
                handleDreamPhoto(e.target.files[0]);
            }
        });
    }
    const dreamPhotoRemove = document.getElementById('dream-photo-remove');
    if (dreamPhotoRemove) {
        dreamPhotoRemove.addEventListener('click', () => {
            dreamPhotoData = null;
            const imgEl = document.getElementById('dream-photo-img');
            if (imgEl) imgEl.src = '';
            const preview = document.getElementById('dream-photo-preview');
            if (preview) preview.classList.add('hidden');
            const btn = document.getElementById('dream-photo-btn');
            if (btn) btn.classList.remove('hidden');
            const input = document.getElementById('dream-photo-input');
            if (input) input.value = '';
        });
    }

    // Parent add dream modal
    const parentDreamCloseBtn = document.getElementById('parent-add-dream-close');
    if (parentDreamCloseBtn) {
        parentDreamCloseBtn.addEventListener('click', closeParentAddDreamModal);
    }
    const parentDreamSubmitBtn = document.getElementById('parent-modal-dream-submit');
    if (parentDreamSubmitBtn) {
        parentDreamSubmitBtn.addEventListener('click', submitParentAddDreamModal);
    }
    const parentDreamPhotoBtn = document.getElementById('parent-modal-dream-photo-btn');
    if (parentDreamPhotoBtn) {
        parentDreamPhotoBtn.addEventListener('click', () => {
            document.getElementById('parent-modal-dream-photo-input').click();
        });
    }
    const parentDreamPhotoInput = document.getElementById('parent-modal-dream-photo-input');
    if (parentDreamPhotoInput) {
        parentDreamPhotoInput.addEventListener('change', (e) => {
            if (e.target.files && e.target.files[0]) {
                handleParentDreamModalPhoto(e.target.files[0]);
            }
        });
    }
    const parentDreamPhotoRemove = document.getElementById('parent-modal-dream-photo-remove');
    if (parentDreamPhotoRemove) {
        parentDreamPhotoRemove.addEventListener('click', () => {
            parentDreamPhotoData = null;
            const imgEl = document.getElementById('parent-modal-dream-photo-img');
            if (imgEl) imgEl.src = '';
            const preview = document.getElementById('parent-modal-dream-photo-preview');
            if (preview) preview.classList.add('hidden');
            const btn = document.getElementById('parent-modal-dream-photo-btn');
            if (btn) btn.classList.remove('hidden');
            const input = document.getElementById('parent-modal-dream-photo-input');
            if (input) input.value = '';
        });
    }

    // Parent manage routine modal
    const parentRoutineCloseBtn = document.getElementById('parent-routine-modal-close');
    if (parentRoutineCloseBtn) {
        parentRoutineCloseBtn.addEventListener('click', closeParentRoutineModal);
    }
    const parentRoutineCancelBtn = document.getElementById('parent-routine-modal-cancel');
    if (parentRoutineCancelBtn) {
        parentRoutineCancelBtn.addEventListener('click', closeParentRoutineModal);
    }
    const parentRoutineSaveBtn = document.getElementById('parent-routine-modal-save');
    if (parentRoutineSaveBtn) {
        parentRoutineSaveBtn.addEventListener('click', submitParentRoutineModal);
    }
    const parentRoutineAddBtn = document.getElementById('btn-add-routine-row');
    if (parentRoutineAddBtn) {
        parentRoutineAddBtn.addEventListener('click', addRoutineRowFromInputs);
    }
    const routineModalEl = document.getElementById('parent-routine-modal');
    if (routineModalEl) {
        routineModalEl.addEventListener('click', function(e) {
            if (e.target === routineModalEl) closeParentRoutineModal();
        });
    }
    const routineListEl = document.getElementById('parent-routine-list');
    if (routineListEl) {
        routineListEl.addEventListener('click', function(e) {
            const deleteBtn = e.target.closest('.btn-delete-routine-row');
            if (deleteBtn) {
                const row = deleteBtn.closest('.routine-row');
                if (row) row.remove();
            }
        });
    }

    // Task modal
    document.getElementById('task-save-btn').addEventListener('click', saveTask);
    document.getElementById('task-type').addEventListener('change', updateTaskFieldsVisibility);
    document.getElementById('task-has-deadline')?.addEventListener('change', updateTaskFieldsVisibility);
    document.getElementById('task-has-strict-deadline')?.addEventListener('change', updateTaskFieldsVisibility);
    document.getElementById('task-use-timer')?.addEventListener('change', updateTaskFieldsVisibility);
    document.getElementById('task-is-streak')?.addEventListener('change', updateTaskFieldsVisibility);
    document.getElementById('task-has-test')?.addEventListener('change', updateTaskFieldsVisibility);
    document.getElementById('task-has-penalty')?.addEventListener('change', updateTaskFieldsVisibility);
    const modalCancelBtn = document.getElementById('task-modal-cancel');
    if (modalCancelBtn) {
        modalCancelBtn.addEventListener('click', () => {
            document.getElementById('task-modal').classList.add('hidden');
        });
    }

    // Child modal
    document.getElementById('child-save-btn').addEventListener('click', saveChild);
    document.getElementById('child-delete-btn').addEventListener('click', deleteChild);
    document.getElementById('child-close').addEventListener('click', () => {
        const childModal = document.getElementById('child-modal');
        childModal.classList.add('hidden');
        childModal.style.display = ''; // Clear any inline styles
    });

    // Emoji suggestion grids logic
    document.querySelectorAll('#child-emoji-suggestions span').forEach(span => {
        span.addEventListener('click', () => {
            document.getElementById('child-emoji').value = span.textContent;
        });
    });

    // Settings PIN
    document.getElementById('settings-pin-submit').addEventListener('click', verifySettingsPin);
    document.getElementById('settings-pin-input').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') verifySettingsPin();
    });
    document.getElementById('settings-pin-close').addEventListener('click', () => {
        document.getElementById('settings-pin-modal').classList.add('hidden');
    });

    // PIN modal
    document.getElementById('pin-submit').addEventListener('click', () => {
        if (window.__pendingParentAuth) {
            var pin = document.getElementById('pin-input').value;
            if (pin === state.pin) {
                parentPinVerified = true;
                window.__pendingParentAuth = false;
                document.getElementById('pin-modal').classList.add('hidden');
                navigateTo('parent');
            } else {
                document.getElementById('pin-error').classList.remove('hidden');
                document.getElementById('pin-error').textContent = __('pin.error');
            }
        } else {
            document.getElementById('pin-modal').classList.add('hidden');
        }
    });
    document.getElementById('pin-close').addEventListener('click', () => {
        document.getElementById('pin-modal').classList.add('hidden');
    });

    // Enter key for task name
    document.getElementById('task-name').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') saveTask();
    });

    // Close modals on overlay click
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                if (overlay.id === 'timer-modal') {
                    // If timer is not actively counting down, close directly
                    if (timerInterval === null) {
                        // Revert task status when closing via overlay click
                        // Only revert if still 'in-progress'
                        const child = getCurrentChild();
                        if (child && timerTaskId) {
                            const today = getToday();
                            const log = child.dailyLogs[today];
                            const tl = log && log.tasks[timerTaskId];
                            if (tl && tl.status === 'in-progress') {
                                tl.status = 'pending';
                                saveState();
                            }
                        }
                        closeTimer();
                        renderTasks();
                        updateUI();
                    }
                    // If timer IS running, clicking outside does nothing (PIN required via X button)
                    return;
                }
                overlay.classList.add('hidden');
            }
        });
    });

    // Auto submit on 4 digits
    document.querySelectorAll('.pin-input').forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.length === 4) {
                if (this.id === 'confirm-pin') submitConfirm();
                else if (this.id === 'settings-pin-input') verifySettingsPin();
                else if (this.id === 'pin-input') document.getElementById('pin-submit').click();
            }
        });
    });

    const promptSubmitBtn = document.getElementById('prompt-modal-submit-btn');
    if (promptSubmitBtn) {
        promptSubmitBtn.addEventListener('click', submitCustomPrompt);
    }
    const promptInput = document.getElementById('prompt-modal-input');
    if (promptInput) {
        promptInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                submitCustomPrompt();
            }
        });
    }
}

// ===== PRESTIGE MODAL =====
function showPrestigeModal(newTier, goldPrize, starPrize) {
    const modal = document.getElementById('prestige-modal');
    if (!modal) return;
    
    let tierName = '';
    if (newTier === 1) tierName = __('tier.gold') || 'Даври Тилло';
    else if (newTier >= 2) tierName = __('tier.diamond') || 'Даври Алмос';
    else tierName = 'Даври Нав';

    const tNameEl = document.getElementById('prestige-tier-name');
    if(tNameEl) tNameEl.textContent = tierName;
    
    const pAmtEl = document.getElementById('prestige-prize-amount');
    if(pAmtEl) pAmtEl.textContent = goldPrize;

    const pStarAmtEl = document.getElementById('prestige-stars-amount');
    if(pStarAmtEl) pStarAmtEl.textContent = starPrize;

    // Show medal unlocked grade
    const medalNotifEl = document.getElementById('prestige-medal-notification');
    if (medalNotifEl) {
        let grade = '';
        if (newTier === 1) grade = 'IV';
        else if (newTier === 2) grade = 'III';
        else if (newTier === 3) grade = 'II';
        else if (newTier >= 4) grade = 'I';
        
        if (grade) {
            medalNotifEl.textContent = __('prestige.medal_unlocked', { grade: grade }) || `Шумо соҳиби Медали дараҷаи ${grade} гардидед! 🏅`;
            medalNotifEl.style.display = 'block';
        } else {
            medalNotifEl.style.display = 'none';
        }
    }

    modal.classList.remove('hidden');
    launchConfetti();
    setTimeout(launchConfetti, 1000);
    setTimeout(launchConfetti, 2000);
}

function closePrestigeModal() {
    document.getElementById('prestige-modal').classList.add('hidden');
    updateUI();
}

function openImageZoomModal(src) {
    var modal = document.getElementById('image-zoom-modal');
    var img = document.getElementById('image-zoom-img');
    if (modal && img) {
        img.src = src;
        modal.classList.remove('hidden');
    }
}

function closeImageZoomModal() {
    var modal = document.getElementById('image-zoom-modal');
    if (modal) {
        modal.classList.add('hidden');
    }
}

var currentPromptResolver = null;

function showCustomPrompt(title, placeholder) {
    return new Promise(function(resolve) {
        currentPromptResolver = resolve;
        document.getElementById('prompt-modal-title').textContent = title;
        var input = document.getElementById('prompt-modal-input');
        input.value = '';
        input.placeholder = placeholder || (currentLang === 'ru' ? 'Введите причину...' : 'Сабабро нависед...');
        
        var modal = document.getElementById('prompt-modal');
        modal.classList.remove('hidden');
        input.focus();
    });
}

function submitCustomPrompt() {
    var input = document.getElementById('prompt-modal-input').value;
    closeCustomPrompt();
    if (currentPromptResolver) {
        currentPromptResolver(input);
        currentPromptResolver = null;
    }
}

function closeCustomPrompt() {
    var modal = document.getElementById('prompt-modal');
    if (modal) {
        modal.classList.add('hidden');
    }
    if (currentPromptResolver) {
        currentPromptResolver(null);
        currentPromptResolver = null;
    }
}

// ===== PARENT ADD DREAM MODAL =====
function showParentAddDreamModal() {
    const modal = document.getElementById('parent-add-dream-modal');
    if (!modal) return;
    
    // Reset inputs
    const nameInput = document.getElementById('parent-modal-dream-name');
    const descInput = document.getElementById('parent-modal-dream-desc');
    const goldInput = document.getElementById('parent-modal-dream-gold');
    const starsInput = document.getElementById('parent-modal-dream-stars');
    const photoInput = document.getElementById('parent-modal-dream-photo-input');
    const photoPreview = document.getElementById('parent-modal-dream-photo-preview');
    const photoBtn = document.getElementById('parent-modal-dream-photo-btn');
    const imgEl = document.getElementById('parent-modal-dream-photo-img');

    if (nameInput) nameInput.value = '';
    if (descInput) descInput.value = '';
    if (goldInput) goldInput.value = '';
    if (starsInput) starsInput.value = '';
    if (photoInput) photoInput.value = '';
    if (imgEl) imgEl.src = '';
    if (photoPreview) photoPreview.classList.add('hidden');
    if (photoBtn) photoBtn.classList.remove('hidden');
    
    parentDreamPhotoData = null;
    modal.classList.remove('hidden');
}

function closeParentAddDreamModal() {
    const modal = document.getElementById('parent-add-dream-modal');
    if (modal) {
        modal.classList.add('hidden');
    }
    parentDreamPhotoData = null;
}

function handleParentDreamModalPhoto(file) {
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const img = new Image();
        img.onload = function() {
            const canvas = document.createElement('canvas');
            let w = img.width, h = img.height;
            const maxDim = 800;
            if (w > maxDim || h > maxDim) {
                if (w > h) {
                    h = h * maxDim / w;
                    w = maxDim;
                } else {
                    w = w * maxDim / h;
                    h = maxDim;
                }
            }
            canvas.width = w;
            canvas.height = h;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, w, h);
            parentDreamPhotoData = canvas.toDataURL('image/jpeg', 0.7);
            const imgEl = document.getElementById('parent-modal-dream-photo-img');
            if (imgEl) imgEl.src = parentDreamPhotoData;
            const preview = document.getElementById('parent-modal-dream-photo-preview');
            if (preview) preview.classList.remove('hidden');
            const btn = document.getElementById('parent-modal-dream-photo-btn');
            if (btn) btn.classList.add('hidden');
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

function submitParentAddDreamModal() {
    const nameInput = document.getElementById('parent-modal-dream-name');
    const descInput = document.getElementById('parent-modal-dream-desc');
    const goldInput = document.getElementById('parent-modal-dream-gold');
    const starsInput = document.getElementById('parent-modal-dream-stars');

    if (!nameInput) return;
    const name = nameInput.value.trim();
    if (!name) {
        showToast('⚠️', currentLang === 'ru' ? 'Введите название мечты' : 'Номи орзуро нависед');
        return;
    }

    const description = descInput ? descInput.value.trim() : '';
    const costGold = goldInput ? (parseInt(goldInput.value) || 0) : 0;
    const costStars = starsInput ? (parseInt(starsInput.value) || 0) : 0;

    const child = getCurrentChild();
    if (!child) return;
    if (!child.dreams) child.dreams = [];

    child.dreams.push({
        id: 'dream_' + Date.now(),
        name: name,
        description: description,
        photo: parentDreamPhotoData || null,
        costGold: costGold,
        costStars: costStars,
        achieved: false,
        approved: true, // Pre-approved as it is directly added by a parent
        createdAt: new Date().toISOString()
    });

    saveState();
    showToast('✨', __('dream.add_success'));
    closeParentAddDreamModal();
    renderParentDashboard();
}

// ===== PARENT MANAGE ROUTINE MODAL =====
function escapeHtmlAttr(str) {
    if (!str) return '';
    return str.toString()
        .replace(/&/g, '&amp;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
}

function initRoutineFlatpickr() {
    if (!window.flatpickr) return;
    const lang = currentLang === 'ru' ? 'ru' : 'tg';
    document.querySelectorAll('#parent-routine-modal .flatpickr-time').forEach(function(el) {
        if (el._flatpickr) el._flatpickr.destroy();
        flatpickr(el, {
            locale: lang,
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            disableMobile: true
        });
    });
}

function showParentRoutineModal() {
    const modal = document.getElementById('parent-routine-modal');
    if (!modal) return;

    // Reset new row inputs
    const newTime = document.getElementById('new-routine-time');
    const newName = document.getElementById('new-routine-name');
    const newDuration = document.getElementById('new-routine-duration');
    const newGold = document.getElementById('new-routine-gold');
    const newStars = document.getElementById('new-routine-stars');

    if (newTime) newTime.value = '';
    if (newName) newName.value = '';
    if (newDuration) newDuration.value = '';
    if (newGold) newGold.value = '';
    if (newStars) newStars.value = '';

    const child = getCurrentChild();
    if (!child) return;

    // Filter daily tasks (type === 'daily' or type undefined)
    const dailyTasks = child.tasks.filter(t => t.type === 'daily' || !t.type);
    
    // Sort chronologically by startTime
    dailyTasks.sort((a, b) => {
        const timeA = a.startTime || '12:00';
        const timeB = b.startTime || '12:00';
        return timeA.localeCompare(timeB);
    });

    renderParentRoutineList(dailyTasks);
    modal.classList.remove('hidden');
    initRoutineFlatpickr();
}

function renderParentRoutineList(tasks) {
    const list = document.getElementById('parent-routine-list');
    if (!list) return;

    let html = '';
    tasks.forEach(task => {
        html += `<div class="routine-row" data-task-id="${task.id}">`;
        html += `  <input type="text" class="flatpickr-time routine-start-time" value="${task.startTime || '12:00'}">`;
        html += `  <input type="text" class="routine-task-name" value="${escapeHtmlAttr(task.name)}" placeholder="${currentLang === 'ru' ? 'Название действия...' : 'Номи фаъолият...'}">`;
        html += `  <input type="number" class="routine-task-duration" value="${task.duration || 10}" placeholder="${currentLang === 'ru' ? 'Мин' : 'Дақ'}" min="1">`;
        html += `  <div style="display: flex; gap: 4px; align-items: center;">`;
        html += `    <input type="number" class="routine-task-gold" value="${task.rewardGold !== undefined ? task.rewardGold : 1}" min="0">`;
        html += `    <input type="number" class="routine-task-stars" value="${task.rewardStars || 0}" min="0">`;
        html += `  </div>`;
        html += `  <button class="btn-delete-routine-row" title="${currentLang === 'ru' ? 'Удалить' : 'Нест кардан'}">🗑️</button>`;
        html += `</div>`;
    });

    list.innerHTML = html;
}

function addRoutineRowFromInputs() {
    const newTimeEl = document.getElementById('new-routine-time');
    const newNameEl = document.getElementById('new-routine-name');
    const newDurationEl = document.getElementById('new-routine-duration');
    const newGoldEl = document.getElementById('new-routine-gold');
    const newStarsEl = document.getElementById('new-routine-stars');

    const name = newNameEl ? newNameEl.value.trim() : '';
    if (!name) {
        showToast('⚠️', __('parent.routine_validation_error'));
        return;
    }

    const time = newTimeEl && newTimeEl.value ? newTimeEl.value.trim() : '08:00';
    const duration = newDurationEl ? (parseInt(newDurationEl.value) || 10) : 10;
    const gold = newGoldEl ? (parseInt(newGoldEl.value) || 0) : 1;
    const stars = newStarsEl ? (parseInt(newStarsEl.value) || 0) : 0;
    const newId = 'task_gen_' + Date.now() + '_' + Math.floor(Math.random() * 1000);

    const list = document.getElementById('parent-routine-list');
    if (list) {
        const row = document.createElement('div');
        row.className = 'routine-row';
        row.dataset.taskId = newId;
        
        let html = '';
        html += `  <input type="text" class="flatpickr-time routine-start-time" value="${time}">`;
        html += `  <input type="text" class="routine-task-name" value="${escapeHtmlAttr(name)}" placeholder="${currentLang === 'ru' ? 'Название действия...' : 'Номи фаъолият...'}">`;
        html += `  <input type="number" class="routine-task-duration" value="${duration}" placeholder="${currentLang === 'ru' ? 'Мин' : 'Дақ'}" min="1">`;
        html += `  <div style="display: flex; gap: 4px; align-items: center;">`;
        html += `    <input type="number" class="routine-task-gold" value="${gold}" min="0">`;
        html += `    <input type="number" class="routine-task-stars" value="${stars}" min="0">`;
        html += `  </div>`;
        html += `  <button class="btn-delete-routine-row" title="${currentLang === 'ru' ? 'Удалить' : 'Нест кардан'}">🗑️</button>`;
        row.innerHTML = html;
        list.appendChild(row);

        // Clear inputs
        if (newNameEl) newNameEl.value = '';
        if (newDurationEl) newDurationEl.value = '';
        if (newGoldEl) newGoldEl.value = '';
        if (newStarsEl) newStarsEl.value = '';

        // Re-initialize Flatpickr for the new row timepicker
        initRoutineFlatpickr();

        // Scroll to bottom
        const container = document.getElementById('parent-routine-list-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    }
}

function submitParentRoutineModal() {
    const child = getCurrentChild();
    if (!child) return;

    const list = document.getElementById('parent-routine-list');
    if (!list) return;

    const rows = list.querySelectorAll('.routine-row');
    const updatedDailyTasks = [];
    let isValid = true;

    rows.forEach(row => {
        const taskId = row.dataset.taskId;
        const timeVal = row.querySelector('.routine-start-time').value.trim();
        const nameVal = row.querySelector('.routine-task-name').value.trim();
        const durationVal = parseInt(row.querySelector('.routine-task-duration').value) || 10;
        const goldVal = parseInt(row.querySelector('.routine-task-gold').value) || 0;
        const starsVal = parseInt(row.querySelector('.routine-task-stars').value) || 0;

        if (!nameVal) {
            isValid = false;
            return;
        }

        // Preserve original properties (e.g. completion status, custom instruction photos/logs)
        const originalTask = child.tasks.find(t => t.id === taskId);
        const taskObj = originalTask ? Object.assign({}, originalTask) : {
            id: taskId,
            type: 'daily',
            days: [1, 2, 3, 4, 5, 6, 0],
            useTimer: true,
            isBonus: false,
            deadline: ''
        };

        taskObj.name = nameVal;
        taskObj.startTime = timeVal;
        taskObj.duration = durationVal;
        taskObj.rewardGold = goldVal;
        taskObj.rewardStars = starsVal;
        
        updatedDailyTasks.push(taskObj);
    });

    if (!isValid) {
        showToast('⚠️', __('parent.routine_validation_error'));
        return;
    }

    // Sort chronologically by startTime before setting order
    updatedDailyTasks.sort((a, b) => {
        const timeA = a.startTime || '12:00';
        const timeB = b.startTime || '12:00';
        return timeA.localeCompare(timeB);
    });

    // Set chronological order
    updatedDailyTasks.forEach((task, idx) => {
        task.order = idx + 1;
    });

    // Replace only tasks of type 'daily' or tasks that don't have type (default daily)
    const nonDailyTasks = child.tasks.filter(t => t.type && t.type !== 'daily');
    child.tasks = nonDailyTasks.concat(updatedDailyTasks);

    saveState();
    showToast('✨', __('parent.routine_save_success'));
    closeParentRoutineModal();
    renderParentDashboard();
    updateUI();
}

function closeParentRoutineModal() {
    const modal = document.getElementById('parent-routine-modal');
    if (modal) {
        modal.classList.add('hidden');
    }
}

// ===== EXPORT =====
window.TASK_APP = {
    navigateTo,
    switchChild,
    showTimer,
    closeTimer,
    showToast,
    launchConfetti
};
