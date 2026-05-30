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
        pageDashboardHeader.textContent = __('nav.today');
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

    // Hide today-bar: show only on balance page
    const todayBar = document.querySelector('.today-bar');
    if (todayBar) {
        todayBar.classList.toggle('hidden', page !== 'balance');
    }

    // Quote bar: show only on dashboard (child's page)
    const quoteBar = document.querySelector('.quote-bar');
    if (quoteBar) {
        quoteBar.classList.toggle('hidden', page !== 'dashboard');
    }

    switch (page) {
        case 'dashboard': renderTasks(); break;
        case 'calendar': renderCalendar(); break;
        case 'balance': renderBalance(); break;
        case 'settings': showSettingsPin(); break;
        case 'parent': showParentPin(); break;
    }
    
    // Update the UI header elements based on the new page
    updateUI();
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
        txt += `   🏅 ${child.medals || 0}`;
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
        else if (rt === 'both') balanceText = `⭐ ${c.stars || 0}   💰 ${c.balance}`;
        else balanceText = `💰 ${c.balance} ${__('balance.currency.sm')}`;
        balanceText += `   🏅 ${c.medals || 0}`;

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

    const test = checkAndCreateTest(currentChildId);
    if (test) {
        setTimeout(() => showTestModal(test), 500);
    }
}

// ===== UI UPDATE =====
function updateUI() {
    const child = getCurrentChild();
    if (!child) return;

    // Header logic toggle
    const selector = document.getElementById('header-child-selector');
    const headerTop = document.querySelector('.header-top');
    const title = document.getElementById('app-title');
    const headerBalance = document.getElementById('header-child-balance');
    const balanceText = document.getElementById('greeting-balance-text');

    if (currentPage === 'parent' || currentPage === 'settings') {
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
        else if (rt === 'both') txt = `⭐ ${child.stars || 0}   💰 ${child.balance}`;
        else txt = `💰 ${child.balance} ${__('balance.currency.sm')}`;
        txt += `   🏅 ${child.medals || 0}`;
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
    document.getElementById('date-badge').textContent =
        `${__weekday(now.getDay())}, ${now.getDate()} ${__month(now.getMonth())}`;

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
    document.getElementById('balance-big').textContent = child.balance;
    document.getElementById('stat-earned').textContent = child.totalEarned;
    document.getElementById('stat-deducted').textContent = child.totalDeducted;

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

    const totalWithdrawn = child.withdrawals.reduce((sum, w) => sum + w.amount, 0);
    document.getElementById('stat-withdrawn').textContent = totalWithdrawn;

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
    if (currentPage === 'dashboard') renderTasks();
    else if (currentPage === 'calendar') renderCalendar();
    else if (currentPage === 'balance') {
        renderWithdrawalHistory();
        renderTestHistory();
        renderAchievements();
    }
    else if (currentPage === 'parent') renderParentDashboard();
}

function updateNavLabels() {
    document.querySelector('.nav-btn[data-page="dashboard"] .nav-label').textContent = __('nav.today');
    document.querySelector('.nav-btn[data-page="calendar"] .nav-label').textContent = __('nav.calendar');
    document.querySelector('.nav-btn[data-page="balance"] .nav-label').textContent = __('nav.balance');
    document.querySelector('.nav-btn[data-page="settings"] .nav-label').textContent = __('nav.settings');
    var parentBtn = document.querySelector('.nav-btn[data-page="parent"] .nav-label');
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
    document.getElementById('progress-text').textContent = `${confirmedCount}/${totalTasks}`;
    const pct = totalTasks > 0 ? (confirmedCount / totalTasks) * 100 : 0;
    document.getElementById('progress-fill').style.width = `${Math.min(pct, 100)}%`;

    if (log.excused) {
        container.innerHTML = `
            <div class="task-card" style="text-align:center;padding:40px 20px;display:block;">
                <div style="font-size:64px;margin-bottom:16px;">🙏</div>
                <h3 style="font-size:18px;margin-bottom:8px;">${__('excused_day.title')}</h3>
                <p style="color:var(--text-light);font-size:14px;">${__('excused_day.reason')} ${log.excuseReason}</p>
            </div>
        `;
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
    const medals = task.rewardMedals || 0;
    let rewardsText = `🪙 ${gold} ⭐ ${stars}`;
    if (medals > 0) rewardsText += ` 🏅 ${medals}`;
    durationText += ` <span class="task-duration" style="background: rgba(245, 158, 11, 0.1); color: rgb(245, 158, 11); border: 1px solid rgba(245, 158, 11, 0.2); font-weight: 500;">${rewardsText}</span>`;

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
    let deadlineHtml = '';
    if (deadlineInfo) {
        const urgentClass = deadlineInfo.urgent ? 'deadline-urgent' : '';
        const pastClass = deadlineInfo.past ? 'deadline-past' : '';
        deadlineHtml = `<div class="task-deadline ${urgentClass} ${pastClass}">📅 ${deadlineInfo.text}</div>`;
    }

    let iconName = 'icon-clock';
    if (task.type === 'one-time') iconName = 'icon-calendar';
    else if (task.type === 'exam') iconName = 'icon-book';
    else if (task.type === 'bonus') iconName = 'icon-gift';

    card.innerHTML = `
        <div class="task-emoji" style="color: var(--primary); background: var(--primary-light);">
            <svg class="icon-svg" style="width: 20px; height: 20px;" aria-hidden="true"><use href="#${iconName}"/></svg>
        </div>
        <div class="task-info">
            <div class="task-name">${task.name}</div>
            <div class="task-meta">${durationText}</div>
            ${deadlineHtml}
        </div>
        <div class="task-status-badge status-${tl.status}">${statusLabels[tl.status] || __('status.pending')}</div>
        <div class="task-actions">
            ${tl.status === 'pending' ? `
                <button class="task-btn task-btn-start" data-action="start" title="${__('task.start')}"><svg class="icon-svg" aria-hidden="true"><use href="#icon-play"/></svg></button>
            ` : ''}
            ${tl.status === 'awaiting-confirm' ? `
                <button class="task-btn task-btn-confirm" data-action="confirm" title="${__('task.confirm')}"><svg class="icon-svg" aria-hidden="true"><use href="#icon-check"/></svg></button>
            ` : ''}
            ${tl.status === 'in-progress' ? `
                <button class="task-btn task-btn-done" data-action="finish" title="${__('task.finish')}" style="animation:pulse 1.5s ease-in-out infinite;"><svg class="icon-svg" aria-hidden="true"><use href="#icon-stop"/></svg></button>
            ` : ''}
            ${tl.status === 'pending' ? `
                <button class="task-btn task-btn-skip" data-action="skip" title="${__('task.skip')}"><svg class="icon-svg" aria-hidden="true"><use href="#icon-x"/></svg></button>
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
        }

        saveState();

        const unlocked = checkAchievements(currentChildId);
        if (unlocked.length > 0) {
            showToast('🎉', unlocked.join(', '));
            launchConfetti();
        } else {
            showToast('✅', __('confirm.success'));
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
        header.textContent = __weekday(i);
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
    const histContainer = document.getElementById('withdrawal-history');
    if (child.withdrawals.length === 0) {
        histContainer.innerHTML = `<p class="empty-state">${__('balance.no_withdrawals')}</p>`;
    } else {
        histContainer.innerHTML = child.withdrawals.slice().reverse().map(w =>
            `<div class="withdrawal-item">
                <span class="withdrawal-date">${formatDate(w.date)}</span>
                <span class="withdrawal-amount">-${w.amount} ${__('balance.currency.sm')}</span>
            </div>`
        ).join('');
    }

    // Test history
    const testContainer = document.getElementById('test-history');
    const tests = child.tenDayTests;
    if (tests.length === 0) {
        testContainer.innerHTML = `<p class="empty-state">${__('balance.no_tests')}</p>`;
    } else {
        let html = '';
        tests.slice().reverse().forEach(t => {
            const resultClass = t.totalScore === 10 ? 'good' : t.totalScore >= 9 ? 'ok' : 'bad';
            const rt = child.rewardType || 'money';
            let rewardStr = '';
            if (t.reward > 0 || t.starReward > 0) {
                if (rt === 'stars') rewardStr = `(+${t.starReward}⭐)`;
                else if (rt === 'both') rewardStr = `(+${t.reward}${__('balance.currency.sm')} +${t.starReward}⭐)`;
                else rewardStr = `(+${t.reward}${__('balance.currency.sm')})`;
            }
            html += `<div class="test-history-item">
                <span class="test-info">📝 ${formatDate(t.date)}</span>
                <span class="test-result ${resultClass}">${t.totalScore}/10 ${rewardStr}</span>
            </div>`;
        });
        testContainer.innerHTML = html;
    }

    // Update balance display with stars info
    const balanceBig = document.querySelector('.balance-big');
    if (rt === 'stars') {
        balanceBig.innerHTML = `
            <span class="balance-icon">⭐</span>
            <span class="balance-big-amount">${child.stars || 0}</span>
            <span class="balance-big-currency">${__('balance.stars_only')}</span>
        `;
    } else if (rt === 'both') {
        balanceBig.innerHTML = `
            <span class="balance-icon">💰</span>
            <span class="balance-big-amount">${child.balance}</span>
            <span class="balance-big-currency">${__('balance.currency.sm')}</span>
            <span style="font-size:24px;margin:0 8px;opacity:0.5;">|</span>
            <span class="balance-icon">⭐</span>
            <span class="balance-big-amount" style="font-size:36px;">${child.stars || 0}</span>
        `;
    } else {
        balanceBig.innerHTML = `
            <span class="balance-icon">💰</span>
            <span class="balance-big-amount">${child.balance}</span>
            <span class="balance-big-currency">${__('balance.currency.somoni')}</span>
        `;
    }

    // Withdraw button - only for money/both modes
    const withdrawBtn = document.getElementById('btn-withdraw');
    if (rt === 'stars') {
        withdrawBtn.style.display = 'none';
    } else {
        withdrawBtn.style.display = 'flex';
        withdrawBtn.innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-wallet"/></svg> ${__('balance.withdraw_title')}`;
    }

    renderAchievements();
}

function renderAchievements() {
    const container = document.getElementById('achievements-container');
    const child = getCurrentChild();
    if (!child) return;

    if (!child.achievements) child.achievements = [];

    const earned = child.achievements;

    container.innerHTML = ACHIEVEMENTS.map(a => {
        const unlocked = earned.includes(a.id);
        const nameKey = `achievement.${a.id}`;
        const displayName = __(nameKey);
        return `<div class="achievement-item ${unlocked ? 'unlocked' : 'locked'}">
            <span class="achievement-icon">${a.icon}</span>
            <span class="achievement-name">${displayName}</span>
        </div>`;
    }).join('');
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
    renderSettings();
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

function showTaskModal(task = null, forceBonus = false) {
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
        document.getElementById('task-reward-medals').value = task.rewardMedals || 0;

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
        document.getElementById('task-reward-medals').value = 0;

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
    const rewardMedals = parseInt(document.getElementById('task-reward-medals').value) || 0;
    
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

    modal.classList.remove('hidden');
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
    if (confirm("Шумо мутмаин ҳастед, ки мехоҳед профили кӯдакро пурра нест кунед? Ҳамаи маълумот ва вазифаҳои ӯ тоза мешаванд.")) {
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

    // ---- Task Management Section ----
    html += "<div class='parent-task-section'>";

    // Regular tasks
    html += "<div class='section-card'><h4>" + __('settings.daily_tasks') + "</h4>";
    if (selectedChild.tasks.length === 0) {
        html += "<p class='empty-state'>—</p>";
    } else {
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
            var medals = task.rewardMedals || 0;
            var rewardsBadge = " <span style='font-size:10px;background:rgba(245, 158, 11, 0.1);color:rgb(245, 158, 11);padding:1px 4px;border-radius:4px;margin-left:4px;'>🪙 " + gold + " ⭐ " + stars;
            if (medals > 0) rewardsBadge += " 🏅 " + medals;
            rewardsBadge += "</span>";

            html += "<li>";
            html += "<span class='item-emoji' style='color:var(--primary);display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;'><svg class='icon-svg' style='width:16px;height:16px;' aria-hidden='true'><use href='#" + iconName + "'/></svg></span>";
            html += "<span class='item-text'>" + task.name + typeBadge + rewardsBadge + " <span class='item-meta'>⏱ " + task.duration + " " + __('task.minutes') + "</span></span>";
            html += "<span class='item-actions'>";
            html += "<button class='edit-btn' data-task-id='" + task.id + "' data-is-bonus='false' title='" + __('edit') + "'>✏️</button>";
            html += "<button class='delete-btn' data-task-id='" + task.id + "' data-is-bonus='false' title='" + __('delete') + "'>🗑️</button>";
            html += "</span></li>";
        });
        html += "</ul>";
    }
    html += "</div>";

    // Bonus tasks
    html += "<div class='section-card'><h4>" + __('settings.bonus_tasks') + "</h4>";
    if (selectedChild.bonusTasks.length === 0) {
        html += "<p class='empty-state'>" + __('settings.no_bonus') + "</p>";
    } else {
        html += "<ul class='item-list'>";
        selectedChild.bonusTasks.forEach(function(task) {
            var iconName = 'icon-gift';
            var gold = task.rewardGold !== undefined ? task.rewardGold : (task.bonusPrice || 0);
            var stars = task.rewardStars || 0;
            var medals = task.rewardMedals || 0;
            var rewardsBadge = " <span style='font-size:10px;background:rgba(245, 158, 11, 0.1);color:rgb(245, 158, 11);padding:1px 4px;border-radius:4px;margin-left:4px;'>🪙 " + gold + " ⭐ " + stars;
            if (medals > 0) rewardsBadge += " 🏅 " + medals;
            rewardsBadge += "</span>";

            html += "<li>";
            html += "<span class='item-emoji' style='color:var(--primary);display:inline-flex;align-items:center;justify-content:center;width:24px;height:24px;'><svg class='icon-svg' style='width:16px;height:16px;' aria-hidden='true'><use href='#" + iconName + "'/></svg></span>";
            html += "<span class='item-text'>" + task.name + rewardsBadge + "</span>";
            html += "<span class='item-actions'>";
            html += "<button class='edit-btn' data-task-id='" + task.id + "' data-is-bonus='true' title='" + __('edit') + "'>✏️</button>";
            html += "<button class='delete-btn' data-task-id='" + task.id + "' data-is-bonus='true' title='" + __('delete') + "'>🗑️</button>";
            html += "</span></li>";
        });
        html += "</ul>";
    }
    html += "</div>";

    // Add Task Button (moved here and made larger)
    html += "<div style='margin-top: 15px;'>";
    html += "<button class='btn btn-primary btn-large btn-full btn-parent-add-task'>" +
        "<svg class='icon-svg' aria-hidden='true'><use href='#icon-plus'/></svg> " +
        __('settings.add_task') + "</button>";
    html += "</div>";

    html += "</div>"; // close parent-task-section
    html += "</div>"; // close parent-overview

    container.innerHTML = html;

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

    // In stars mode, allow withdrawal if child has stars
    if (child.balance <= 0 && (rt !== 'stars' || (child.stars || 0) <= 0)) {
        showToast('❌', __('balance.not_enough'));
        return;
    }

    document.getElementById('withdraw-balance').textContent = formatBalanceFull(child);
    document.getElementById('withdraw-amount').value = '';
    document.getElementById('withdraw-pin').value = '';
    document.getElementById('withdraw-error').classList.add('hidden');
    document.getElementById('withdraw-modal').classList.remove('hidden');

    document.querySelector('#withdraw-modal .modal-header h3').innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-wallet"/></svg> ${__('balance.withdraw_title')}`;
    document.querySelector('#withdraw-modal .modal-body p').textContent = __('balance.withdraw_how_much');
    document.querySelector('#withdraw-modal .withdraw-info').innerHTML = `${__('balance.withdraw_current')} <strong>${formatBalanceFull(child)}</strong>`;
    document.getElementById('withdraw-amount').placeholder = __('balance.withdraw_amount');
}

function submitWithdraw() {
    const pin = document.getElementById('withdraw-pin').value;
    if (pin !== state.pin) {
        document.getElementById('withdraw-error').classList.remove('hidden');
        document.getElementById('withdraw-error').textContent = __('pin.error');
        return;
    }

    const amount = parseInt(document.getElementById('withdraw-amount').value);
    const child = getCurrentChild();
    const rt = child.rewardType || 'money';

    if (!amount || amount <= 0) {
        showToast('❌', __('balance.withdraw_error_amount'));
        return;
    }

    if (amount > child.balance && (rt === 'money' || rt === 'both')) {
        showToast('❌', __('balance.withdraw_error_balance'));
        return;
    }

    child.balance -= amount;
    child.withdrawals.push({
        date: getToday(),
        amount: amount
    });
    saveState();

    document.getElementById('withdraw-modal').classList.add('hidden');
    showToast('🏦', `${amount} ${__('balance.withdraw_success')}`);
    renderBalance();
    updateUI();
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

    checkAchievements(currentChildId);
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
        console.log("header-edit-child-btn clicked! Active child:", activeChild);
        if (activeChild) {
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
    document.getElementById('withdraw-pin').addEventListener('keydown', (e) => {
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
        document.getElementById('child-modal').classList.add('hidden');
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
                renderParentDashboard();
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
