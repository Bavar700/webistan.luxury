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
    // Re-render current page
    updateUI();
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
        if (rt === 'stars') {
            balanceEl.textContent = `⭐ ${child.stars || 0}`;
        } else if (rt === 'both') {
            balanceEl.textContent = `💰 ${child.balance} ${__('balance.currency.sm')} | ⭐ ${child.stars || 0}`;
        } else {
            balanceEl.textContent = `💰 ${child.balance} ${__('balance.currency.sm')}`;
        }
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
        let balanceText;
        if (rt === 'stars') balanceText = `⭐ ${c.stars || 0}`;
        else if (rt === 'both') balanceText = `💰 ${c.balance} | ⭐ ${c.stars || 0}`;
        else balanceText = `💰 ${c.balance} ${__('balance.currency.sm')}`;

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
        if (rt === 'stars') {
            balanceText.textContent = `⭐ ${child.stars || 0}`;
        } else if (rt === 'both') {
            balanceText.textContent = `💰 ${child.balance}   ⭐ ${child.stars || 0}`;
        } else {
            balanceText.textContent = `💰 ${child.balance} ${__('balance.currency.sm')}`;
        }
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

    // Update progress
    const allTasks = [...child.tasks, ...child.bonusTasks];
    let confirmedCount = 0;
    allTasks.forEach(t => {
        const tl = log.tasks[t.id];
        if (tl && tl.status === 'completed' && tl.confirmed) confirmedCount++;
    });

    const totalTasks = child.tasks.length + child.bonusTasks.length;
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

    const regularTasks = child.tasks.filter(t => !t.isBonus);
    const allRegularDone = regularTasks.every(t => {
        const tl = log.tasks[t.id];
        return tl && tl.status === 'completed' && tl.confirmed;
    });

    const allResolved = regularTasks.every(t => {
        const tl = log.tasks[t.id];
        return tl && (tl.status === 'completed' && tl.confirmed || tl.status === 'skipped');
    });

    let activeTaskId = null;
    allTasks.forEach(t => {
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
        container.appendChild(createTaskCard(task, tl, log, child, false));
    });

    // Bonus tasks
    child.bonusTasks.forEach(task => {
        const tl = log.tasks[task.id];
        if (!tl) return;
        container.appendChild(createTaskCard(task, tl, log, child, true));
    });

    if (allRegularDone) {
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
    } else if (allResolved && !log.rewardApplied) {
        applyDailyReward(currentChildId, today);
    }

    if (activeTaskId) {
        const timerModal = document.getElementById('timer-modal');
        // Only auto-show timer if the modal isn't already open
        if (timerModal.classList.contains('hidden')) {
            const activeTask = allTasks.find(t => t.id === activeTaskId);
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

    // Duration or bonus text
    let durationText;
    if (isBonus) {
        const rt = child.rewardType || 'money';
        if (rt === 'stars') {
            durationText = `<span class="task-bonus-badge">🎁 +${task.bonusPrice} ⭐</span>`;
        } else {
            durationText = `<span class="task-bonus-badge">🎁 +${task.bonusPrice} ${__('balance.currency.sm')}</span>`;
        }
    } else {
        durationText = `<span class="task-duration">⏱ ${task.duration} ${__('task.minutes')}</span>`;
    }

    // Deadline info
    const deadlineInfo = getDeadlineInfo(task);
    let deadlineHtml = '';
    if (deadlineInfo) {
        const urgentClass = deadlineInfo.urgent ? 'deadline-urgent' : '';
        const pastClass = deadlineInfo.past ? 'deadline-past' : '';
        deadlineHtml = `<div class="task-deadline ${urgentClass} ${pastClass}">📅 ${deadlineInfo.text}</div>`;
    }

    card.innerHTML = `
        <div class="task-emoji">${task.emoji}</div>
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
                tl.status = 'awaiting-confirm';
                tl.timeSpent = task.duration;
                if (timerInterval) {
                    clearInterval(timerInterval);
                    timerInterval = null;
                    closeTimer();
                }
                saveState();
                renderTasks();
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

    tl.status = 'in-progress';
    saveState();

    document.getElementById('timer-task-name').innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-clock"/></svg> ${task.name}`;
    document.getElementById('timer-emoji').textContent = task.emoji;

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

    modal.classList.remove('hidden');

    // Re-render tasks to show updated status (safe: no recursion due to guards)
    renderTasks();
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
        tl.timeSpent = child.tasks.find(t => t.id === timerTaskId)
            ? child.tasks.find(t => t.id === timerTaskId).duration
            : child.bonusTasks.find(t => t.id === timerTaskId).duration;
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
    document.getElementById('proof-photo-btn').innerHTML = `<svg class="icon-svg" aria-hidden="true" style="width:16px;height:16px;"><use href="#icon-plus"/></svg> ${__('proof.add_photo')}`;
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

    // Save photo (base64) and explanation
    const photoImg = document.getElementById('proof-photo-img');
    if (photoImg.src && photoImg.src.startsWith('data:')) {
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

function showTaskModal(task = null, forceBonus = false) {
    const modal = document.getElementById('task-modal');
    const title = document.getElementById('task-modal-title');

    if (task && task.id) {
        title.innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-edit"/></svg> ${__('task_form.title_edit')}`;
        document.getElementById('task-name').value = task.name;
        document.getElementById('task-duration').value = task.duration || 10;
        document.getElementById('task-emoji').value = task.emoji || '📋';
        document.getElementById('task-deadline').value = task.deadline || '';
        document.getElementById('task-is-bonus').checked = task.isBonus || forceBonus;
        document.getElementById('bonus-price').value = task.bonusPrice || 3;
        editingTaskId = task.id;
        editingIsBonus = task.isBonus || forceBonus;
    } else {
        title.innerHTML = forceBonus
            ? `<svg class="icon-svg" aria-hidden="true"><use href="#icon-gift"/></svg> ${__('task_form.title_new_bonus')}`
            : `<svg class="icon-svg" aria-hidden="true"><use href="#icon-plus"/></svg> ${__('task_form.title_new')}`;
        document.getElementById('task-name').value = '';
        document.getElementById('task-duration').value = 10;
        document.getElementById('task-emoji').value = '📋';
        document.getElementById('task-deadline').value = '';
        document.getElementById('task-is-bonus').checked = forceBonus;
        document.getElementById('bonus-price').value = 3;
        editingTaskId = null;
        editingIsBonus = forceBonus;
    }

    updateBonusPriceVisibility();
    updateTaskFormLabels();
    modal.classList.remove('hidden');
}

function updateTaskFormLabels() {
    const child = getCurrentChild();
    const rt = child ? child.rewardType || 'money' : 'money';

    document.getElementById('task-deadline-label').textContent = `📅 ${__('task_form.deadline')}`;
    document.getElementById('task-is-bonus-label').textContent = __('task_form.is_bonus');

    if (rt === 'stars') {
        document.getElementById('bonus-price-label').textContent = __('task_form.bonus_price_stars');
        document.querySelectorAll('#bonus-price option').forEach(o => {
            o.textContent = `${o.value} ⭐`;
        });
    } else {
        document.getElementById('bonus-price-label').textContent = __('task_form.bonus_price');
        document.querySelectorAll('#bonus-price option').forEach(o => {
            o.textContent = `${o.value} ${__('balance.currency.sm')}`;
        });
    }
}

function updateBonusPriceVisibility() {
    const isBonus = document.getElementById('task-is-bonus').checked;
    document.getElementById('bonus-price-group').classList.toggle('hidden', !isBonus);
}

function saveTask() {
    const child = getCurrentChild();
    const name = document.getElementById('task-name').value.trim();
    const duration = parseInt(document.getElementById('task-duration').value) || 10;
    const emoji = document.getElementById('task-emoji').value.trim() || '📋';
    const deadline = document.getElementById('task-deadline').value || '';
    const isBonus = document.getElementById('task-is-bonus').checked;
    const bonusPrice = isBonus ? parseInt(document.getElementById('bonus-price').value) || 3 : 0;

    if (!name) {
        showToast('❌', __('task_form.error_name'));
        return;
    }

    if (editingTaskId) {
        const targetList = editingIsBonus ? child.bonusTasks : child.tasks;
        const task = targetList.find(t => t.id === editingTaskId);
        if (task) {
            task.name = name;
            task.duration = duration;
            task.emoji = emoji;
            task.deadline = deadline;
            task.isBonus = editingIsBonus;
            if (editingIsBonus) task.bonusPrice = bonusPrice;
        }
    } else {
        const newTask = {
            id: generateId(),
            name,
            duration,
            emoji,
            deadline,
            order: child.tasks.length + 1,
            isBonus,
            bonusPrice
        };
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
    const modal = document.getElementById('child-modal');
    const title = modal.querySelector('.modal-header h3');

    if (childId) {
        const child = getChild(childId);
        title.innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-edit"/></svg> ${__('child_form.title_edit')}`;
        document.getElementById('child-name').value = child.name;
        document.getElementById('child-emoji').value = child.emoji;
        document.getElementById('child-color').value = child.color;
        document.getElementById('child-reward-type').value = child.rewardType || 'money';
        editingChildId = childId;
        document.getElementById('child-delete-btn').classList.remove('hidden');
    } else {
        title.innerHTML = `<svg class="icon-svg" aria-hidden="true"><use href="#icon-user"/></svg> ${__('child_form.title_new')}`;
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
            html += "<li>";
            html += "<span class='item-emoji'>" + task.emoji + "</span>";
            html += "<span class='item-text'>" + task.name + " <span class='item-meta'>⏱ " + task.duration + " " + __('task.minutes') + "</span></span>";
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
            var priceStr = (selectedChild.rewardType === 'stars') ? task.bonusPrice + " ⭐" : task.bonusPrice + " " + __('balance.currency.sm');
            html += "<li>";
            html += "<span class='item-emoji'>" + task.emoji + "</span>";
            html += "<span class='item-text'>" + task.name + " <span class='item-meta'>🎁 +" + priceStr + "</span></span>";
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
    
    document.getElementById('header-edit-child-btn').addEventListener('click', () => {
        if (currentChildId) {
            showChildModal(currentChildId);
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
    document.getElementById('task-is-bonus').addEventListener('change', updateBonusPriceVisibility);
    document.getElementById('task-modal-close').addEventListener('click', () => {
        document.getElementById('task-modal').classList.add('hidden');
    });

    // Child modal
    document.getElementById('child-save-btn').addEventListener('click', saveChild);
    document.getElementById('child-delete-btn').addEventListener('click', deleteChild);
    document.getElementById('child-close').addEventListener('click', () => {
        document.getElementById('child-modal').classList.add('hidden');
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
