/**
 * Офарин / Молодец — Kids Task Manager
 * Main application logic
 */

// ===== GLOBAL ERROR LOGGER FOR DEBUGGING =====
window.onerror = function (message, source, lineno, colno, error) {
    const errorDiv = document.createElement('div');
    errorDiv.style.position = 'fixed';
    errorDiv.style.bottom = '10px';
    errorDiv.style.left = '10px';
    errorDiv.style.right = '10px';
    errorDiv.style.background = '#fee2e2';
    errorDiv.style.border = '2px solid #ef4444';
    errorDiv.style.color = '#991b1b';
    errorDiv.style.padding = '12px';
    errorDiv.style.borderRadius = '8px';
    errorDiv.style.zIndex = '999999';
    errorDiv.style.fontSize = '12px';
    errorDiv.style.fontFamily = 'monospace';
    errorDiv.style.maxHeight = '200px';
    errorDiv.style.overflowY = 'auto';
    errorDiv.style.boxShadow = '0 10px 25px rgba(0,0,0,0.2)';
    errorDiv.innerHTML = `<strong>JS Error:</strong> ${message}<br><small>at ${source}:${lineno}:${colno}</small>`;
    document.body.appendChild(errorDiv);
    return false;
};

window.addEventListener('unhandledrejection', function (event) {
    const errorDiv = document.createElement('div');
    errorDiv.style.position = 'fixed';
    errorDiv.style.bottom = '10px';
    errorDiv.style.left = '10px';
    errorDiv.style.right = '10px';
    errorDiv.style.background = '#fee2e2';
    errorDiv.style.border = '2px solid #ef4444';
    errorDiv.style.color = '#991b1b';
    errorDiv.style.padding = '12px';
    errorDiv.style.borderRadius = '8px';
    errorDiv.style.zIndex = '999999';
    errorDiv.style.fontSize = '12px';
    errorDiv.style.fontFamily = 'monospace';
    errorDiv.style.maxHeight = '200px';
    errorDiv.style.overflowY = 'auto';
    errorDiv.style.boxShadow = '0 10px 25px rgba(0,0,0,0.2)';
    errorDiv.innerHTML = `<strong>Unhandled Promise Rejection:</strong> ${event.reason}`;
    document.body.appendChild(errorDiv);
});

// ===== INITIALIZATION & LOADING HELPER =====

function hideLoadingScreen() {
    const loadingScreen = document.getElementById('app-loading-screen');
    if (loadingScreen) {
        loadingScreen.style.opacity = '0';
        loadingScreen.style.visibility = 'hidden';
        setTimeout(() => {
            if (loadingScreen.parentNode) {
                loadingScreen.parentNode.removeChild(loadingScreen);
            }
        }, 400);
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    loadState();
    currentChildId = getStoredOrFirstChildId();

    initSupabase();

    // Safety timeout: hide loading screen after 2.5s anyway to ensure offline access works
    const loadingTimer = setTimeout(hideLoadingScreen, 2500);

    // Try to get existing session (with timeout)
    let activeSession = null;
    if (supabaseClient) {
        try {
            const { data: { session } } = await promiseWithTimeout(
                supabaseClient.auth.getSession(), 5000, 'getSession'
            );
            activeSession = session;
            window.supabaseSession = session;
        } catch(e) {
            console.log('Session check failed:', e.message);
        }
    }

    if (activeSession) {
        // Already logged in — skip welcome and auth, go straight to app
        let deviceRole = safeStorage.getItem('kids_tasks_device_role');
        if (!state || !state.children || state.children.length === 0) {
            deviceRole = 'parent';
            safeStorage.setItem('kids_tasks_device_role', 'parent');
        }
        if (!deviceRole) {
            clearTimeout(loadingTimer);
            hideLoadingScreen();
            showRoleOverlay();
            return;
        }
        await fetchRemoteState();
        currentChildId = getStoredOrFirstChildId();
        applyDeviceRoleUI();
        initApp();
        setupRealtimeSubscription(activeSession.user.id);
        clearTimeout(loadingTimer);
        hideLoadingScreen();
    } else {
        // No active session — show welcome first if they haven't completed onboarding
        clearTimeout(loadingTimer);
        hideLoadingScreen();
        if (safeStorage.getItem('kids_tasks_has_seen_onboarding') || safeStorage.getItem('hasSeenOnboarding')) {
            initSupabase();
            checkAuthAndSetup();
        } else {
            showWelcomeScreen();
        }
    }
});

async function checkAuthAndSetup() {
    const config = getSupabaseConfig();
    if (!config.url || !config.key || !supabaseClient) {
        // Supabase not configured — still show auth overlay, just with an error
        showAuthOverlay();
        return;
    }
    
    try {
        const { data: { session } } = await promiseWithTimeout(supabaseClient.auth.getSession(), 5000, 'getSession');
        window.supabaseSession = session;
        
        if (!session) {
            showAuthOverlay();
            return;
        }
        
        // Session exists — check device role
        let deviceRole = safeStorage.getItem('kids_tasks_device_role');
        if (!state || !state.children || state.children.length === 0) {
            deviceRole = 'parent';
            safeStorage.setItem('kids_tasks_device_role', 'parent');
        }
        if (!deviceRole) {
            showRoleOverlay();
            return;
        }
        
        hideAuthOverlay();
        hideRoleOverlay();
        
        await fetchRemoteState();
        currentChildId = getStoredOrFirstChildId();
        
        applyDeviceRoleUI();
        initApp();
        
        setupRealtimeSubscription(session.user.id);
        
    } catch (err) {
        console.error('Auth check failed:', err);
        // On timeout/network error — still show auth overlay
        showAuthOverlay();
    }
}


function applyDeviceRoleUI() {
    let role = safeStorage.getItem('kids_tasks_device_role') || 'parent';
    if (!state || !state.children || state.children.length === 0) {
        role = 'parent';
        safeStorage.setItem('kids_tasks_device_role', 'parent');
    }
    const parentBtn = document.querySelector('.nav-btn[data-page="parent"]');
    const settingsBtn = document.querySelector('.nav-btn[data-page="settings"]');
    
    if (parentBtn && settingsBtn) {
        if (role === 'child') {
            parentBtn.style.display = 'none';
            settingsBtn.style.display = 'none';
        } else {
            parentBtn.style.display = '';
            settingsBtn.style.display = '';
        }
    }
    const editChildBtn = document.getElementById('header-edit-child-btn');
    if (editChildBtn) {
        if (role === 'child') {
            editChildBtn.style.display = 'none';
        } else {
            editChildBtn.style.display = '';
        }
    }
}

let _authEventsSetupDone = false;
let authMode = 'login'; // Keep track of auth mode globally/in file scope

function showAuthOverlay() {
    hideLoadingScreen();
    applyStaticTranslations();
    document.getElementById('auth-overlay').classList.remove('hidden');
    authMode = 'login'; // Reset to login mode every time overlay opens
    
    // Reset inputs, error and submit button status
    const errorMsg = document.getElementById('auth-error');
    if (errorMsg) errorMsg.classList.add('hidden');
    
    const privacyGroup = document.getElementById('auth-privacy-group');
    const privacyCheckbox = document.getElementById('auth-privacy-checkbox');
    if (privacyGroup) privacyGroup.style.display = 'none';
    if (privacyCheckbox) privacyCheckbox.required = false;
    
    const emailInput = document.getElementById('auth-email');
    const passInput = document.getElementById('auth-password');
    if (emailInput) emailInput.value = '';
    if (passInput) passInput.value = '';

    const title = document.getElementById('auth-title');
    const btnText = document.getElementById('auth-btn-text');
    const toggleText = document.getElementById('auth-toggle-text');
    const link = document.getElementById('auth-toggle-link');
    const submitBtn = document.getElementById('btn-auth-submit');
    if (submitBtn) submitBtn.disabled = false;

    if (title) {
        title.textContent = __('auth.login_title');
        title.style.display = 'none';
    }
    if (btnText) btnText.textContent = __('auth.login_btn');
    if (toggleText) toggleText.textContent = __('auth.no_account');
    if (link) link.textContent = __('auth.register_title');

    const localText = document.getElementById('auth-local-text');
    if (localText) {
        localText.textContent = __('auth.login_offline');
    }

    if (!_authEventsSetupDone) {
        setupAuthOverlayEvents();
        _authEventsSetupDone = true;
    }
}

function hideAuthOverlay() {
    document.getElementById('auth-overlay').classList.add('hidden');
}

function hideRoleOverlay() {
    const overlay = document.getElementById('role-overlay');
    if (overlay) {
        overlay.classList.add('hidden');
    }
}

function showRoleOverlay() {
    hideLoadingScreen();
    document.getElementById('role-overlay').classList.remove('hidden');
    setupRoleOverlayEvents();
}

function translateSupabaseError(msg) {
    if (!msg) return '';
    const msgLower = msg.toLowerCase();
    
    if (msgLower.includes('user already registered') || msgLower.includes('user_already_exists')) {
        return __('auth.error_already_registered');
    }
    if (msgLower.includes('invalid login credentials') || msgLower.includes('invalid_credentials')) {
        return __('auth.error_invalid_credentials');
    }
    if (msgLower.includes('email link is invalid') || msgLower.includes('email link expired') || msgLower.includes('invalid_grant')) {
        return __('auth.error_email_link_invalid');
    }
    if (msgLower.includes('password should be at least')) {
        return __('auth.error_password_too_short');
    }
    if (msgLower.includes('invalid email') || msgLower.includes('email_address_invalid')) {
        return __('auth.error_invalid_email');
    }
    
    return msg;
}

function setupAuthOverlayEvents() {
    const form = document.getElementById('auth-form');
    const link = document.getElementById('auth-toggle-link');
    const toggleText = document.getElementById('auth-toggle-text');
    const title = document.getElementById('auth-title');
    const errorMsg = document.getElementById('auth-error');
    const submitBtn = document.getElementById('btn-auth-submit');
    const btnText = document.getElementById('auth-btn-text');
    
    // Set initial login labels in current language
    if (title) {
        title.textContent = __('auth.login_title');
        title.style.display = 'none';
    }
    if (btnText) btnText.textContent = __('auth.login_btn');
    if (toggleText) toggleText.textContent = __('auth.no_account');
    if (link) link.textContent = __('auth.register_title');

    const privacyGroup = document.getElementById('auth-privacy-group');
    const privacyCheckbox = document.getElementById('auth-privacy-checkbox');

    link.addEventListener('click', (e) => {
        e.preventDefault();
        errorMsg.classList.add('hidden');
        if (authMode === 'login') {
            authMode = 'register';
            if (title) {
                title.textContent = __('auth.register_title');
                title.style.display = 'block';
            }
            if (btnText) btnText.textContent = __('auth.register_btn');
            if (toggleText) toggleText.textContent = __('auth.has_account');
            link.textContent = __('auth.login_btn');
            if (privacyGroup) privacyGroup.style.display = 'flex';
            if (privacyCheckbox) privacyCheckbox.required = true;
        } else {
            authMode = 'login';
            if (title) {
                title.textContent = __('auth.login_title');
                title.style.display = 'none';
            }
            if (btnText) btnText.textContent = __('auth.login_btn');
            if (toggleText) toggleText.textContent = __('auth.no_account');
            link.textContent = __('auth.register_title');
            if (privacyGroup) privacyGroup.style.display = 'none';
            if (privacyCheckbox) privacyCheckbox.required = false;
        }
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('auth-email').value.trim();
        const password = document.getElementById('auth-password').value.trim();
        
        errorMsg.classList.add('hidden');
        
        // Custom validation
        if (!email) {
            errorMsg.textContent = __('auth.email_required');
            errorMsg.classList.remove('hidden');
            return;
        }
        if (!password || password.length < 6) {
            errorMsg.textContent = __('auth.password_length_error');
            errorMsg.classList.remove('hidden');
            return;
        }

        submitBtn.disabled = true;
        if (btnText) btnText.textContent = __('auth.wait');
        
        if (!supabaseClient) {
            errorMsg.textContent = 'Supabase is not initialized. Please reload the page.';
            errorMsg.classList.remove('hidden');
            submitBtn.disabled = false;
            if (btnText) btnText.textContent = __('auth.login_btn');
            return;
        }
        
        try {
            if (authMode === 'login') {
                const { data, error } = await supabaseClient.auth.signInWithPassword({ email, password });
                if (error) throw error;
                window.supabaseSession = data.session;
                showToast('🔑', __('auth.success'));
                await checkAuthAndSetup();
            } else {
                if (privacyCheckbox && !privacyCheckbox.checked) {
                    throw new Error(__('auth.privacy_required'));
                }
                const redirectToUrl = window.location.origin;
                const { data, error } = await supabaseClient.auth.signUp({ 
                    email, 
                    password, 
                    options: { redirectTo: redirectToUrl } 
                });
                if (error) throw error;
                
                if (!data.session) {
                    showToast('✉️', __('auth.confirm_email'));
                    submitBtn.disabled = false;
                    if (btnText) btnText.textContent = __('auth.login_btn');
                    errorMsg.textContent = __('auth.confirm_email');
                    errorMsg.classList.remove('hidden');
                    return;
                }
                
                window.supabaseSession = data.session;
                await saveRemoteState();
                showToast('🎉', __('auth.success'));
                await checkAuthAndSetup();
            }
        } catch (err) {
            console.error(err);
            errorMsg.textContent = translateSupabaseError(err.message || 'Ошибка аутентификации');
            errorMsg.classList.remove('hidden');
            submitBtn.disabled = false;
            if (btnText) btnText.textContent = authMode === 'login' ? __('auth.login_btn') : __('auth.register_btn');
        }
    });

    const localBtn = document.getElementById('btn-auth-local');
    if (localBtn) {
        localBtn.addEventListener('click', () => {
            hideAuthOverlay();
            updateSyncStatus('offline');
            if (!state || !state.children || state.children.length === 0) {
                safeStorage.setItem('kids_tasks_device_role', 'parent');
            }
            applyDeviceRoleUI();
            initApp();
        });
    }

    // Password eye toggle
    const eyeBtn = document.getElementById('auth-toggle-pass');
    const passInput = document.getElementById('auth-password');
    if (eyeBtn && passInput) {
        eyeBtn.addEventListener('click', () => {
            const isHidden = passInput.type === 'password';
            passInput.type = isHidden ? 'text' : 'password';
            const icon = document.getElementById('auth-eye-icon');
            if (icon) {
                icon.innerHTML = isHidden
                    ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`
                    : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
            }
        });
    }
}



function setupRoleOverlayEvents() {
    document.getElementById('btn-role-child').addEventListener('click', () => {
        safeStorage.setItem('kids_tasks_device_role', 'child');
        hideRoleOverlay();
        location.reload();
    });
    
    document.getElementById('btn-role-parent').addEventListener('click', () => {
        safeStorage.setItem('kids_tasks_device_role', 'parent');
        hideRoleOverlay();
        location.reload();
    });
}

function initApp() {
    // Check if first launch — show welcome screen
    if (window._isFirstLaunch) {
        showWelcomeScreen();
        return;
    }

    renderChildTabs();
    setupEventListeners();
    if (!state || !state.children || state.children.length === 0) {
        navigateTo('parent');
    } else {
        navigateTo('routine');
    }
    updateUI();
    updateLanguageUI();
    showDailyQuote();

    // Check for 10-day test
    const test = checkAndCreateTest(currentChildId);
    if (test) {
        setTimeout(() => showTestModal(test), 500);
    }

    // Sync immediately on tab focus / wake up
    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'visible') {
            console.log('App became visible, checking remote state...');
            if (window.supabaseSession && window.supabaseSession.user) {
                fetchRemoteState().then((remoteState) => {
                    if (remoteState) {
                        const remoteVersion = Number(remoteState.version) || 0;
                        const localVersion = Number(state.version) || 0;
                        const remoteTime = Number(remoteState.lastUpdated) || 0;
                        const localTime = Number(state.lastUpdated) || 0;
                        let isRemoteNewer = false;
                        if (remoteVersion > localVersion) {
                            isRemoteNewer = true;
                        } else if (remoteVersion === localVersion && remoteTime > localTime) {
                            isRemoteNewer = true;
                        }
                        if (isRemoteNewer) {
                            migrateState(remoteState);
                            state = remoteState;
                            safeStorage.setItem(STORAGE_KEY, JSON.stringify(state));
                            updateUI();
                        }
                    }
                });
                setupRealtimeSubscription(window.supabaseSession.user.id);
            }
        }
    });

    // Start gentle nudge checker
    if (!window._nudgeInterval) {
        window._nudgeInterval = setInterval(checkGentleNudges, 10000);
    }
    checkGentleNudges();
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

// Convert AM/PM time string to 24h for storage (EN only)
function to24h(t) {
    if (!t) return t;
    var m = t.match(/^(\d{1,2}):(\d{2})\s*(AM|PM)$/i);
    if (!m) return t;
    var h = parseInt(m[1], 10), min = m[2], p = m[3].toUpperCase();
    if (p === 'PM' && h !== 12) h += 12;
    if (p === 'AM' && h === 12) h = 0;
    return h.toString().padStart(2,'0') + ':' + min;
}

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

    const lang = currentLang;

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
    document.querySelectorAll('.flatpickr-time-input').forEach(el => {
        const isInline = (el.id === 'task-daily-start-time' || el.id === 'task-daily-end-time');
        fpTimePickers.push(flatpickr(el, {
            locale: lang,
            enableTime: true,
            noCalendar: true,
            dateFormat: currentLang === 'en' ? 'h:i K' : 'H:i',
            time_24hr: currentLang !== 'en',
            inline: isInline,
            disableMobile: true, // Force custom UI
            onReady: function(selectedDates, dateStr, instance) {
                // Prevent mobile keyboard from popping up on time numbers
                const hourInput = instance.calendarContainer.querySelector('.flatpickr-hour');
                const minuteInput = instance.calendarContainer.querySelector('.flatpickr-minute');
                if (hourInput) {
                    hourInput.setAttribute('readonly', 'readonly');
                    hourInput.setAttribute('inputmode', 'none');
                }
                if (minuteInput) {
                    minuteInput.setAttribute('readonly', 'readonly');
                    minuteInput.setAttribute('inputmode', 'none');
                }
            }
        }));
    });
}

/**
 * Apply translations to all static HTML elements with data-i18n attribute
 */
function applyStaticTranslations() {
    document.querySelectorAll('[data-i18n]').forEach(el => {
        const val = __(el.dataset.i18n);
        if (val) el.textContent = val;
    });
    document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
        const val = __(el.dataset.i18nPlaceholder);
        if (val) el.placeholder = val;
    });
    document.querySelectorAll('[data-i18n-title]').forEach(el => {
        const val = __(el.dataset.i18nTitle);
        if (val) el.title = val;
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
    const activeNavBtn = document.querySelector(`.nav-btn[data-page="${page}"]`);
    if (activeNavBtn) activeNavBtn.classList.add('active');

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


    switch (page) {
        case 'dashboard': renderRoutine(); break;
        case 'dream': renderDreams(); break;
        case 'routine':
            renderTasks();
            showDailyQuote();
            break;
        case 'balance': renderBalance(); break;
        case 'parent': showParentPin(); break;
        case 'settings': showSettingsPin(); break;
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

    // Add child row (only for parent role)
    const deviceRole = safeStorage.getItem('kids_tasks_device_role') || 'parent';
    if (deviceRole === 'parent') {
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
    safeStorage.setItem('kids_tasks_active_child_id', childId);
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
        titleEl.textContent = __('calendar.today_status');
        textEl.textContent = __('excused_day.title_short');
        fillEl.style.width = '100%';
        fillEl.style.background = 'linear-gradient(135deg, #F59E0B, #D97706)';
        return;
    }

    // Default styling in CSS might be green, let's restore it
    titleEl.textContent = __('progress.title') || 'Пешрафти имрӯз';
    fillEl.style.background = ''; // reset to CSS default

    const todayDay = new Date(today + 'T12:00:00').getDay();
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

    // Hide calendar card on Today page if no child is configured
    const calCard = document.getElementById('dashboard-calendar-card');
    if (calCard) {
        calCard.style.display = child ? 'block' : 'none';
    }

    // Apply translations and navigation labels so the pages render in selected language
    applyStaticTranslations();
    updateNavLabels();

    if (!child) {
        // If there's no child, we still want to render the parent page so they can create one!
        if (currentPage === 'parent') {
            renderParentDashboard();
        }
        return;
    }

    updateProgressBar();

    // Check achievements automatically
    const achResult = checkAchievements(child.id);
    if (achResult.unlocked && achResult.unlocked.length > 0) {
        showToast('🎉', achResult.unlocked.join(', '));
        launchConfetti();
    }
    if (achResult.prestigeTriggered) {
        showPrestigeModal(achResult.newTier, achResult.goldPrize, achResult.starPrize);
    }

    // Header logic toggle
    const selector = document.getElementById('header-child-selector');
    const headerTop = document.querySelector('.header-top');
    const title = document.getElementById('app-title');
    const headerBalance = document.getElementById('header-child-balance');
    const balanceText = document.getElementById('greeting-balance-text');

    const deviceRole = safeStorage.getItem('kids_tasks_device_role') || 'parent';

    if (!child) {
        if (selector) selector.classList.add('hidden');
        if (headerTop) headerTop.classList.remove('hidden');
        if (headerBalance) headerBalance.classList.add('hidden');
    } else {
        if (currentPage === 'parent') {
            if (selector) selector.classList.remove('hidden');
            if (headerBalance) headerBalance.classList.add('hidden');
            if (headerTop) headerTop.classList.add('hidden');
        } else {
            if (selector) selector.classList.add('hidden');
            if (headerBalance) headerBalance.classList.remove('hidden');
            if (headerTop) headerTop.classList.remove('hidden');
            if (title) title.textContent = __('app.name') + ', ' + child.name + '!';
        }
        
        if (balanceText) {
            const rt = child.rewardType || 'money';
            let txt = '';
            if (rt === 'stars') txt = `⭐ ${child.stars || 0}`;
            else if (rt === 'both') txt = `⭐ ${child.stars || 0}   🪙 ${child.balance}`;
            else txt = `🪙 ${child.balance}`;
            txt += getMedalDisplay(child);
            balanceText.textContent = txt;
        }
    }

    const now = new Date();
    const dow = __weekday(now.getDay());
    const mon = __month(now.getMonth());
    const day = now.getDate();
    const year = now.getFullYear();
    // Format date using browser locale when available, fallback to translation keys
    const localeMap = { ru: 'ru-RU', en: 'en-US', tg: null };
    const browserLocale = localeMap[currentLang];
    if (browserLocale) {
        try {
            document.getElementById('today-date').textContent = now.toLocaleDateString(browserLocale, { weekday:'long', year:'numeric', month:'long', day:'numeric' });
        } catch(e) {
            document.getElementById('today-date').textContent = `${dow}, ${day} ${mon} ${year}`;
        }
    } else {
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
    
    // Call diagnostics renderer
    if (typeof renderDiagnostics === 'function') {
        renderDiagnostics();
    }
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
            return { text: `${__('task.deadline_passed')}: ${deadlineTimeStr}`, urgent: true, past: true, type: 'strict' };
        } else if (diffMins <= 60) {
            return { text: `${__('task.deadline_soon')}: ${deadlineTimeStr} (${diffMins} ${__('task.mins_left')})`, urgent: true, past: false, type: 'strict' };
        } else {
            return { text: __('task.until_template', { dateTime: `${deadlineDateStr} ${deadlineTimeStr}` }), urgent: false, past: false, type: 'strict' };
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
    const todayDay = new Date(today + 'T12:00:00').getDay();
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
                <p style="color:var(--text-light);font-size:14px;">${__('excused_day.reason')} ${translateExcuseReason(log.excuseReason)}</p>
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
    renderRewardsPunishments(container, child);

    // Group daily tasks by day cycles
    const morningTasks = [];
    const afternoonTasks = [];
    const eveningTasks = [];
    const specialTasks = []; // one-time and exam tasks

    child.tasks.forEach(task => {
        const tl = log.tasks[task.id];
        if (!tl) return;
        if (task.type === 'daily' && task.days && !task.days.includes(todayDay)) return;

        if (task.type === 'daily' || !task.type) {
            const time = task.startTime || '12:00';
            const hour = parseInt(time.split(':')[0]);
            if (hour >= 5 && hour < 12) {
                morningTasks.push({ task, tl });
            } else if (hour >= 12 && hour < 18) {
                afternoonTasks.push({ task, tl });
            } else {
                eveningTasks.push({ task, tl });
            }
        } else {
            specialTasks.push({ task, tl });
        }
    });

    // Helper function to sort tasks by startTime chronologically
    const sortTasksByTime = (arr) => {
        arr.sort((a, b) => {
            const timeA = a.task.startTime || '12:00';
            const timeB = b.task.startTime || '12:00';
            return timeA.localeCompare(timeB);
        });
    };

    sortTasksByTime(morningTasks);
    sortTasksByTime(afternoonTasks);
    sortTasksByTime(eveningTasks);

    // Calculate streaks for the blocks
    const morningStreak = calculateBlockStreak(child, 'morning');
    const afternoonStreak = calculateBlockStreak(child, 'afternoon');
    const eveningStreak = calculateBlockStreak(child, 'evening');

    // Function to render a day cycle block with a timeline
    const renderBlock = (blockId, title, icon, streak, taskList) => {
        if (taskList.length === 0) return;

        // Block Header
        const header = document.createElement('div');
        header.className = 'timeline-block-header';
        
        let streakBadgeHtml = '';
        if (streak > 0) {
            streakBadgeHtml = `
                <span class="block-streak-badge">
                    <span>🔥</span> 
                    <span>${__('routine.streak_count', { count: streak })}</span>
                </span>
            `;
        }

        header.innerHTML = `
            <span class="block-icon-title">${icon} ${title}</span>
            ${streakBadgeHtml}
        `;
        container.appendChild(header);

        // Timeline Container
        const tlContainer = document.createElement('div');
        tlContainer.className = 'timeline-container';
        taskList.forEach(item => {
            tlContainer.appendChild(createTaskCard(item.task, item.tl, log, child, false));
        });
        container.appendChild(tlContainer);
    };

    // Render blocks
    renderBlock('morning', __('routine.morning'), '☀️', morningStreak, morningTasks);
    renderBlock('afternoon', __('routine.afternoon'), '🌤️', afternoonStreak, afternoonTasks);
    renderBlock('evening', __('routine.evening'), '🌙', eveningStreak, eveningTasks);

    // Render Special Tasks (if any)
    if (specialTasks.length > 0) {
        const specialHeader = document.createElement('h3');
        specialHeader.style.marginTop = '24px';
        specialHeader.style.marginBottom = '12px';
        specialHeader.style.fontSize = '15px';
        specialHeader.style.fontWeight = '700';
        specialHeader.style.color = 'var(--text)';
        specialHeader.textContent = '🎯 ' + __('routine.special_tasks');
        container.appendChild(specialHeader);

        const specialContainer = document.createElement('div');
        specialContainer.style.display = 'flex';
        specialContainer.style.flexDirection = 'column';
        specialContainer.style.gap = '12px';
        specialTasks.forEach(item => {
            specialContainer.appendChild(createTaskCard(item.task, item.tl, log, child, false));
        });
        container.appendChild(specialContainer);
    }

    // Render Bonus tasks (if any)
    const bonusTasks = child.bonusTasks.map(task => ({ task, tl: log.tasks[task.id] })).filter(item => !!item.tl);
    if (bonusTasks.length > 0) {
        const bonusHeader = document.createElement('h3');
        bonusHeader.style.marginTop = '24px';
        bonusHeader.style.marginBottom = '12px';
        bonusHeader.style.fontSize = '15px';
        bonusHeader.style.fontWeight = '700';
        bonusHeader.style.color = 'var(--text)';
        bonusHeader.textContent = '🎁 ' + __('routine.bonus_tasks');
        container.appendChild(bonusHeader);

        const bonusContainer = document.createElement('div');
        bonusContainer.style.display = 'flex';
        bonusContainer.style.flexDirection = 'column';
        bonusContainer.style.gap = '12px';
        bonusTasks.forEach(item => {
            bonusContainer.appendChild(createTaskCard(item.task, item.tl, log, child, true));
        });
        container.appendChild(bonusContainer);
    }

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

    if (totalTasks === 0) {
        const emptyDiv = document.createElement('div');
        emptyDiv.innerHTML = getEmptyStateHTML('📋', __('empty_state.child_no_tasks'));
        container.appendChild(emptyDiv);
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
    attachRewardsPunishmentsListeners(container);
}

function getEmptyStateHTML(emoji, text, ctaHTML = '') {
    return `
        <div class="empty-state-card">
            <div class="empty-state-emoji">${emoji}</div>
            <div class="empty-state-text">${text}</div>
            ${ctaHTML ? `<div class="empty-state-cta">${ctaHTML}</div>` : ''}
        </div>
    `;
}

function getTaskMetaBadgesHTML(task, tl = null) {
    let html = '';
    
    // 1. Timer / Duration (only if useTimer is true or default true)
    if (task.useTimer !== false) {
        html += `<span class="task-duration">⏱ ${task.duration || 20} ${__('task.minutes')}</span>`;
    }
    
    // 2. Task Type Badge
    if (task.type === 'one-time') {
        html += ` <span class="task-duration" style="background: rgba(147, 51, 234, 0.1); color: rgb(147, 51, 234); border: 1px solid rgba(147, 51, 234, 0.2); font-weight: 500;">📅 ${__('task_form.type_one_time')}</span>`;
    } else if (task.type === 'exam') {
        html += ` <span class="task-duration" style="background: rgba(239, 68, 68, 0.1); color: rgb(239, 68, 68); border: 1px solid rgba(239, 68, 68, 0.2); font-weight: 500;">🎓 ${__('task_form.type_exam')}</span>`;
    } else if (task.type === 'bonus') {
        html += ` <span class="task-duration" style="background: rgba(16, 185, 129, 0.1); color: rgb(16, 185, 129); border: 1px solid rgba(16, 185, 129, 0.2); font-weight: 500;">🎁 ${__('task_form.type_bonus')}</span>`;
    } else {
        html += ` <span class="task-duration" style="background: rgba(59, 130, 246, 0.1); color: rgb(59, 130, 246); border: 1px solid rgba(59, 130, 246, 0.2); font-weight: 500;">🔄 ${__('task_form.type_daily')}</span>`;
    }
    
    // 3. Time Schedule / Range (if exists)
    if (task.startTime || task.startDate) {
        let displayStart = '';
        if (task.startDate) {
            displayStart += task.startDate + ' ';
        }
        if (task.startTime) {
            displayStart += task.startTime;
        }
        
        const endTimeVal = task.endTime || (task.hasDeadline ? task.deadlineTime : '');
        const endDateVal = task.hasDeadline ? task.deadlineDate : '';
        
        if (endTimeVal || endDateVal) {
            displayStart += ' – ';
            if (endDateVal) {
                displayStart += endDateVal + ' ';
            }
            if (endTimeVal) {
                displayStart += endTimeVal;
            }
        }
        html += ` <span class="task-duration" style="background: rgba(107, 114, 128, 0.1); color: rgb(107, 114, 128); border: 1px solid rgba(107, 114, 128, 0.2); font-weight: 500;">🕒 ${displayStart.trim()}</span>`;
    }
    
    // 4. Rewards (Gold / Stars)
    const gold = task.rewardGold !== undefined ? task.rewardGold : (task.bonusPrice || 0);
    const stars = task.rewardStars || 0;
    if (gold > 0 || stars > 0) {
        let rewardsText = '';
        if (gold > 0) rewardsText += `🪙 ${gold}`;
        if (stars > 0) rewardsText += (rewardsText ? ' ' : '') + `⭐ ${stars}`;
        html += ` <span class="task-duration" style="background: rgba(245, 158, 11, 0.1); color: rgb(245, 158, 11); border: 1px solid rgba(245, 158, 11, 0.2); font-weight: 500;">${rewardsText}</span>`;
    }
    
    // 5. Days of Week for Daily tasks
    if (task.type === 'daily' && task.days && task.days.length > 0) {
        let daysDisplay = '';
        if (task.days.length === 7) {
            daysDisplay = __('task_badge.every_day');
        } else {
            daysDisplay = task.days.map(d => __weekday(d)).join(', ');
        }
        html += ` <span class="task-duration" style="background: rgba(139, 92, 246, 0.1); color: rgb(139, 92, 246); border: 1px solid rgba(139, 92, 246, 0.2); font-weight: 500;">${__('task_badge.days')} ${daysDisplay}</span>`;
    }
    
    // 6. Test Badge
    if (task.hasTest) {
        html += ` <span class="task-duration" style="background: rgba(239, 68, 68, 0.1); color: rgb(239, 68, 68); border: 1px solid rgba(239, 68, 68, 0.2); font-weight: 500;">${__('task_badge.has_test')}</span>`;
    }
    
    // 7. Photo Required Badge
    if (task.photoRequired) {
        html += ` <span class="task-duration" style="background: rgba(59, 130, 246, 0.1); color: rgb(59, 130, 246); border: 1px solid rgba(59, 130, 246, 0.2); font-weight: 500;">${__('task_badge.photo_required')}</span>`;
    }
    
    // 8. Penalty Badge
    if (task.hasPenalty) {
        let penaltyParts = [];
        if (task.penaltyGold > 0) penaltyParts.push(`🪙 ${task.penaltyGold}`);
        if (task.penaltyStars > 0) penaltyParts.push(`⭐ ${task.penaltyStars}`);
        const penaltyText = penaltyParts.length > 0 ? ' ' + penaltyParts.join(' ') : '';
        html += ` <span class="task-duration" style="background: rgba(220, 38, 38, 0.1); color: rgb(220, 38, 38); border: 1px solid rgba(220, 38, 38, 0.2); font-weight: 500;">${__('task_badge.penalty')}${penaltyText}</span>`;
    }
    
    // 9. Streak Badge
    if (task.isStreak) {
        const current = task.currentStreak || 0;
        const target = task.streakTarget || 5;
        html += ` <span class="task-duration" style="background: rgba(236, 72, 153, 0.1); color: rgb(236, 72, 153); border: 1px solid rgba(236, 72, 153, 0.2); font-weight: 500;">🔥 ${__('task.marathon_day_label')} ${current} ${__('common.of')} ${target}</span>`;
    }
    
    // 10. Deadline Badge
    const deadlineInfo = getDeadlineInfo(task);
    if (deadlineInfo) {
        let deadlineColorStyle = 'background: rgba(107, 114, 128, 0.1); color: rgb(107, 114, 128); border: 1px solid rgba(107, 114, 128, 0.2);';
        if (deadlineInfo.urgent) {
            deadlineColorStyle = 'background: rgba(220, 38, 38, 0.1); color: rgb(220, 38, 38); border: 1px solid rgba(220, 38, 38, 0.2);';
        }
        html += ` <span class="task-duration" style="${deadlineColorStyle} font-weight: 500;">📅 ${deadlineInfo.text}</span>`;
    }
    
    // 11. Test Score Badge (from tl log if finished)
    if (tl && task.hasTest && tl.status === 'completed' && tl.score !== undefined) {
        html += ` <span class="task-duration" style="background: rgba(16, 185, 129, 0.1); color: rgb(16, 185, 129); border: 1px solid rgba(16, 185, 129, 0.2); font-weight: 500;">${__('task.score_label')}: ${tl.score}/10</span>`;
    }
    
    return html;
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
        'skipped': __('status.skipped'),
        'excused': __('status.excused')
    };

    let durationText = getTaskMetaBadgesHTML(task, tl);

    let iconName = 'icon-clock';
    if (task.type === 'one-time') iconName = 'icon-calendar';
    else if (task.type === 'exam') iconName = 'icon-book';
    else if (task.type === 'bonus') iconName = 'icon-gift';

    card.innerHTML = `
        <div class="task-info">
            <div class="task-name">${task.name}</div>
            <div class="task-meta">${durationText}</div>
            ${(tl.status === 'pending' && tl.rejectReason) ? `
                <div class="task-card-warning" style="margin-top: 8px;">
                    <span>${__('task.rejected_feedback')} "${tl.rejectReason}"</span>
                    ${tl.rejectPhoto ? `
                        <button type="button" class="view-reject-photo-btn" data-photo="${encodeURIComponent(tl.rejectPhoto)}" style="background: none; border: none; color: var(--primary); font-weight: 600; text-decoration: underline; margin-left: 6px; font-size: 11px; cursor: pointer; padding: 0;">🖼️ Акс</button>
                    ` : ''}
                </div>
            ` : ''}
            ${(tl.status === 'pending' && tl.parentReply) ? `
                <div class="task-card-warning" style="margin-top: 8px; border-color: var(--primary); background: rgba(124, 58, 237, 0.05);">
                    <span style="color: var(--primary); font-weight: 600;">${__('task.parent_reply') || '💬 Ҷавоби волид:'}</span>
                    <span style="display: block; margin-top: 2px;">"${tl.parentReply}"</span>
                    ${tl.parentReplyPhoto ? `
                        <button type="button" class="view-parent-reply-photo-btn" data-photo="${encodeURIComponent(tl.parentReplyPhoto)}" style="background: none; border: none; color: var(--primary); font-weight: 600; text-decoration: underline; margin-top: 4px; font-size: 11px; cursor: pointer; padding: 0;">🖼️ Акс</button>
                    ` : ''}
                </div>
            ` : ''}
            ${tl.status === 'excused' ? `
                <div class="task-card-warning" style="margin-top: 8px; border-color: #d97706; background: rgba(245, 158, 11, 0.05);">
                    <span style="color: #d97706; font-weight: 600;">🙏 ${__('status.excused') || 'Узрнок'}:</span>
                    <span>"${tl.excuseReason || ''}"</span>
                </div>
            ` : ''}
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
                <button class="task-btn" data-action="undo-complete" title="${__('confirm.undo') || 'Иваз кардан'}" style="background:rgba(239,68,68,0.1); color:var(--danger,#EF4444); border:1px solid rgba(239,68,68,0.3); border-radius:var(--radius-xs); padding:4px 8px; font-size:11px; cursor:pointer; margin-left:4px; flex-shrink:0;">↩️</button>
            ` : ''}
            ${tl.status === 'skipped' ? `
                <div class="task-status-badge status-skipped">${statusLabels.skipped}</div>
                ${tl.skipReason ? `
                    <div class="task-card-warning" style="margin-top: 8px; width: 100%; border-color: var(--danger, #EF4444); background: rgba(239, 68, 68, 0.05);">
                        <span>📝 ${__('common.reason') || 'Сабаб'}: ${tl.skipReason}</span>
                        ${tl.skipPhoto ? `
                            <button type="button" class="view-skip-photo-btn" data-photo="${encodeURIComponent(tl.skipPhoto)}" style="background: none; border: none; color: var(--danger, #EF4444); font-weight: 600; text-decoration: underline; margin-left: 6px; font-size: 11px; cursor: pointer; padding: 0;">📸 Акс</button>
                        ` : ''}
                    </div>
                ` : ''}
            ` : ''}
            ${tl.status === 'excused' ? `
                <div class="task-status-badge status-excused" style="background: rgba(245, 158, 11, 0.12); color: #d97706; border: 1px solid rgba(245, 158, 11, 0.25);">${statusLabels.excused}</div>
            ` : ''}
        </div>
    `;

    const viewRejectPhotoBtn = card.querySelector('.view-reject-photo-btn');
    if (viewRejectPhotoBtn) {
        viewRejectPhotoBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const photoUrl = decodeURIComponent(viewRejectPhotoBtn.dataset.photo);
            showImagePreview(photoUrl);
        });
    }

    const viewSkipPhotoBtn = card.querySelector('.view-skip-photo-btn');
    if (viewSkipPhotoBtn) {
        viewSkipPhotoBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const photoUrl = decodeURIComponent(viewSkipPhotoBtn.dataset.photo);
            showImagePreview(photoUrl);
        });
    }

    const viewParentReplyPhotoBtn = card.querySelector('.view-parent-reply-photo-btn');
    if (viewParentReplyPhotoBtn) {
        viewParentReplyPhotoBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const photoUrl = decodeURIComponent(viewParentReplyPhotoBtn.dataset.photo);
            showImagePreview(photoUrl);
        });
    }

    card.querySelectorAll('[data-action]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const action = btn.dataset.action;
            if (action === 'start') {
                showTimer(currentChildId, task);
            } else if (action === 'confirm') {
                showConfirmModal(task);
            } else if (action === 'undo-complete') {
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
                showToast('⚠️', __('timer.not_enough_time', { duration: task.duration, deadline: task.deadlineTime }));
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
        tl.completedBeforeTimerExpired = (timerRemaining > 0);
        saveState();
    }

    document.getElementById('timer-emoji').textContent = '🎉';
    document.getElementById('timer-status').textContent = __('timer.status_done');
    document.getElementById('timer-pause-btn').classList.add('hidden');
    document.getElementById('timer-start-btn').classList.add('hidden');

    // Show proof section
    const proofSection = document.getElementById('timer-proof-section');
    proofSection.classList.remove('hidden');
    document.getElementById('proof-explanation').placeholder = __('proof.explanation_placeholder');
    document.getElementById('proof-photo-btn').innerHTML = `<svg class="icon-svg" aria-hidden="true" style="width:16px;height:16px;"><use href="#icon-plus"/></svg> <span>${__('common.photo_short')}</span>`;
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
    
    // Clear past reject reasons upon resubmission
    delete tl.rejectReason;
    delete tl.rejectPhoto;

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

function handleSkipPhotoUpload(event) {
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
            document.getElementById('skip-photo-img').src = compressed;
            document.getElementById('skip-photo-preview').classList.remove('hidden');
            document.getElementById('skip-photo-btn').classList.add('hidden');
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

function handleParentReplyPhotoUpload(event) {
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
            document.getElementById('parent-reply-photo-img').src = compressed;
            document.getElementById('parent-reply-photo-preview').classList.remove('hidden');
            document.getElementById('parent-reply-photo-btn').classList.add('hidden');
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

function handleBadgeRevokePhotoUpload(event) {
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
            document.getElementById('badge-revoke-photo-img').src = compressed;
            document.getElementById('badge-revoke-photo-preview').classList.remove('hidden');
            document.getElementById('badge-revoke-photo-btn').classList.add('hidden');
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

function handleConfirmRejectPhotoUpload(event) {
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
            document.getElementById('confirm-reject-photo-img').src = compressed;
            document.getElementById('confirm-reject-photo-preview').classList.remove('hidden');
            document.getElementById('confirm-reject-photo-btn').classList.add('hidden');
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
    const pinInput = document.getElementById('confirm-pin');
    if (pinInput) {
        pinInput.value = '';
        pinInput.style.display = parentPinVerified ? 'none' : 'block';
    }
    document.getElementById('confirm-error').classList.add('hidden');

    const confirmHeader = document.querySelector('#confirm-modal .modal-header h3');
    if (confirmHeader) {
        confirmHeader.innerHTML = `<svg class="icon-svg" aria-hidden="true" style="color:var(--success);"><use href="#icon-check"/></svg> ${__('confirm.title')}`;
    }

    // Reset parent reject section
    document.getElementById('confirm-reject-section').classList.add('hidden');
    document.getElementById('confirm-reject-reason').value = '';
    document.getElementById('confirm-reject-photo-input').value = '';
    document.getElementById('confirm-reject-photo-img').src = '';
    document.getElementById('confirm-reject-photo-preview').classList.add('hidden');
    document.getElementById('confirm-reject-photo-btn').classList.remove('hidden');
    document.getElementById('confirm-submit').classList.remove('hidden');
    
    const rejectBtn = document.getElementById('confirm-reject');
    rejectBtn.innerHTML = `<svg class="icon-svg" aria-hidden="true" style="width: 14px; height: 14px; fill: currentColor;"><use href="#icon-x"/></svg> <span>${__('confirm.submit_no') || 'Рад кардан'}</span>`;

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
    if (!parentPinVerified) {
        const pin = document.getElementById('confirm-pin').value;
        if (pin !== state.pin) {
            document.getElementById('confirm-error').classList.remove('hidden');
            return;
        }
    }

    const child = getCurrentChild();
    const today = getToday();
    const log = child.dailyLogs[today];
    const tl = log.tasks[confirmTaskId];

    if (tl) {
        tl.status = 'completed';
        tl.confirmed = true;
        tl.confirmedAt = new Date().toISOString();
        
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

            // Award individual task reward immediately upon confirmation if not already rewarded
            if (!tl.rewardPaid) {
                const isBonus = child.bonusTasks.some(t => t.id === confirmTaskId);
                const goldReward  = parseInt(task.rewardGold  !== undefined ? task.rewardGold  : (isBonus ? (task.bonusPrice || 0) : 1)) || 0;
                const starsReward = parseInt(task.rewardStars !== undefined ? task.rewardStars : 1) || 0;
                const medalsReward = parseInt(task.rewardMedals !== undefined ? task.rewardMedals : 0) || 0;

                child.balance = (child.balance || 0) + goldReward;
                child.totalEarned = (child.totalEarned || 0) + goldReward;
                child.stars = (child.stars || 0) + starsReward;
                child.totalStars = (child.totalStars || 0) + starsReward;
                child.medals = (child.medals || 0) + medalsReward;
                child.totalMedals = (child.totalMedals || 0) + medalsReward;

                tl.rewardPaid = true;
                tl.paidGold = goldReward;
                tl.paidStars = starsReward;
                tl.paidMedals = medalsReward;
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

        const todayDay = new Date(today + 'T12:00:00').getDay();
        const activeRegularTasks = child.tasks.filter(t => t.type !== 'bonus' && t.type !== 'optional' && !t.isBonus && (t.type !== 'daily' || !t.days || t.days.includes(todayDay)));
        const allDone = activeRegularTasks.length > 0 && activeRegularTasks.every(t => {
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
            const allResolved = activeRegularTasks.length > 0 && activeRegularTasks.every(t => {
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

// ===== REJECT CONFIRM (reset task back to pending) =====
function submitReject() {
    const rejectSection = document.getElementById('confirm-reject-section');
    const submitBtn = document.getElementById('confirm-submit');
    const rejectBtn = document.getElementById('confirm-reject');

    // First click: expand reject reason form and change button text
    if (rejectSection.classList.contains('hidden')) {
        rejectSection.classList.remove('hidden');
        submitBtn.classList.add('hidden');
        rejectBtn.textContent = __('confirm.reject_confirm_btn') || 'Тасдиқи радкунӣ';
        rejectBtn.style.background = '#EF4444';
        return;
    }

    // Second click: perform validations and verify PIN
    const reason = document.getElementById('confirm-reject-reason').value.trim();
    const photoImg = document.getElementById('confirm-reject-photo-img');
    const photoAttached = photoImg.src && photoImg.src.startsWith('data:');

    // Validation: must write a reason OR upload a photo
    if (!reason && !photoAttached) {
        showToast('⚠️', __('confirm.validation_error') || 'Лутфан сабабро нависед ё акс бор кунед!');
        return;
    }

    if (!parentPinVerified) {
        const pin = document.getElementById('confirm-pin').value;
        if (pin !== state.pin) {
            document.getElementById('confirm-error').classList.remove('hidden');
            return;
        }
    }

    const child = getCurrentChild();
    const today = getToday();
    const log = child.dailyLogs[today];
    const tl = log.tasks[confirmTaskId];

    if (tl) {
        // Find the task definition to know streak or other details
        const task = child.tasks.find(t => t.id === confirmTaskId)
                  || child.bonusTasks.find(t => t.id === confirmTaskId);

        // Deduct task-specific rewards paid upon confirmation
        if (tl.rewardPaid) {
            const goldBack   = parseInt(tl.paidGold) || 0;
            const starsBack  = parseInt(tl.paidStars) || 0;
            const medalsBack = parseInt(tl.paidMedals) || 0;

            if (goldBack > 0) {
                child.balance     = Math.max(0, (child.balance || 0) - goldBack);
                child.totalEarned = Math.max(0, (child.totalEarned || 0) - goldBack);
            }
            if (starsBack > 0) {
                child.stars       = Math.max(0, (child.stars || 0) - starsBack);
                child.totalStars  = Math.max(0, (child.totalStars || 0) - starsBack);
            }
            if (medalsBack > 0) {
                child.medals      = Math.max(0, (child.medals || 0) - medalsBack);
                child.totalMedals = Math.max(0, (child.totalMedals || 0) - medalsBack);
            }

            tl.rewardPaid = false;
            delete tl.paidGold;
            delete tl.paidStars;
            delete tl.paidMedals;
        }

        // Deduct daily completion bonus (+10 stars) if it was applied for today
        if (log.rewardApplied && log.completionBonusPaid) {
            child.stars      = Math.max(0, (child.stars || 0) - 10);
            child.totalStars = Math.max(0, (child.totalStars || 0) - 10);
            log.completionBonusPaid = false;
            log.rewardApplied = false;
        } else {
            log.rewardApplied = false;
        }

        // Undo streak increment if applicable
        if (task && task.isStreak && task.currentStreak > 0) {
            task.currentStreak = Math.max(0, task.currentStreak - 1);
        }

        // Reset task log entry back to pending
        tl.status = 'pending';
        tl.confirmed = false;
        
        // Save reject reason and photo
        tl.rejectReason = reason;
        if (photoAttached) {
            tl.rejectPhoto = photoImg.src;
        } else {
            delete tl.rejectPhoto;
        }

        delete tl.completedAt;
        delete tl.confirmedAt;
        delete tl.photo;
        delete tl.explanation;
        delete tl.score;
        delete tl.missedDeadline;

        saveState();
        showToast('❌', __('confirm.rejected'));
    }

    document.getElementById('confirm-modal').classList.add('hidden');
    renderTasks();
    updateUI();
}

function showImagePreview(src) {
    const modal = document.getElementById('image-preview-modal');
    const content = document.getElementById('image-preview-content');
    if (modal && content) {
        content.src = src;
        modal.classList.remove('hidden');
    }
}

// ===== SKIP MODAL =====
let skipTaskId = null;

function showSkipModal(task) {
    skipTaskId = task.id;
    document.getElementById('skip-reason').value = '';
    
    // Reset photo upload state
    document.getElementById('skip-photo-input').value = '';
    document.getElementById('skip-photo-img').src = '';
    document.getElementById('skip-photo-preview').classList.add('hidden');
    document.getElementById('skip-photo-btn').classList.remove('hidden');
    
    document.getElementById('skip-modal').classList.remove('hidden');
    document.getElementById('skip-reason').focus();
}

function submitSkip() {
    const reason = document.getElementById('skip-reason').value.trim();
    const photoImg = document.getElementById('skip-photo-img');
    const photoAttached = photoImg.src && photoImg.src.startsWith('data:');

    // Validation: must provide either reason OR photo
    if (!reason && !photoAttached) {
        showToast('⚠️', __('skip.validation_error') || 'Лутфан сабабро нависед ё акс бор кунед!');
        return;
    }

    const child = getCurrentChild();
    const today = getToday();
    const log = child.dailyLogs[today];
    const tl = log.tasks[skipTaskId];

    if (tl) {
        tl.status = 'skipped';
        tl.confirmed = true;
        tl.skipReason = reason; // Save the reason
        if (photoAttached) {
            tl.skipPhoto = photoImg.src; // Save the base64 photo
        } else {
            delete tl.skipPhoto;
        }

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

let parentReplyTaskId = null;

function showParentReplyModal(task) {
    parentReplyTaskId = task.id;
    document.getElementById('parent-reply-text').value = '';
    
    // Reset photo upload state
    document.getElementById('parent-reply-photo-input').value = '';
    document.getElementById('parent-reply-photo-img').src = '';
    document.getElementById('parent-reply-photo-preview').classList.add('hidden');
    document.getElementById('parent-reply-photo-btn').classList.remove('hidden');
    
    document.getElementById('parent-reply-modal').classList.remove('hidden');
    document.getElementById('parent-reply-text').focus();
}

function submitParentReply() {
    const replyText = document.getElementById('parent-reply-text').value.trim();
    const photoImg = document.getElementById('parent-reply-photo-img');
    const photoAttached = photoImg.src && photoImg.src.startsWith('data:');

    // Validation: must provide either text OR photo
    if (!replyText && !photoAttached) {
        showToast('⚠️', __('skip.validation_error') || 'Лутфан ҷавобро нависед ё акс бор кунед!');
        return;
    }

    const selectedChild = getCurrentChild();
    if (!selectedChild) return;

    const task = selectedChild.tasks.find(t => t.id === parentReplyTaskId) || selectedChild.bonusTasks.find(t => t.id === parentReplyTaskId);
    if (!task) return;

    const log = getOrCreateDailyLog(selectedChild.id);
    const tl = log.tasks[task.id];
    if (tl) {
        // Refund penalty if applied
        if (tl.penaltyApplied) {
            if (tl.penaltyApplied.stars > 0) {
                selectedChild.stars = (selectedChild.stars || 0) + tl.penaltyApplied.stars;
                selectedChild.totalDeducted = Math.max(0, (selectedChild.totalDeducted || 0) - tl.penaltyApplied.stars);
            }
            if (tl.penaltyApplied.gold > 0) {
                selectedChild.balance = (selectedChild.balance || 0) + tl.penaltyApplied.gold;
                selectedChild.totalDeducted = Math.max(0, (selectedChild.totalDeducted || 0) - tl.penaltyApplied.gold);
            }
            delete tl.penaltyApplied;
        }

        tl.status = 'pending';
        tl.confirmed = false;
        tl.parentReply = replyText;
        if (photoAttached) {
            tl.parentReplyPhoto = photoImg.src; // Save the base64 photo
        } else {
            delete tl.parentReplyPhoto;
        }

        saveState();
        showToast('🎉', __('parent.restored_toast') || 'Супориш барқарор карда шуд!');
        document.getElementById('parent-reply-modal').classList.add('hidden');
        renderParentDashboard();
        updateUI();
    }
}

function confirmTaskDirectly(taskId) {
    const child = getCurrentChild();
    if (!child) return;
    const today = getToday();
    const log = child.dailyLogs[today] || getOrCreateDailyLog(child.id);
    const tl = log.tasks[taskId];
    if (tl) {
        tl.status = 'completed';
        tl.confirmed = true;
        tl.confirmedAt = new Date().toISOString();
        
        const task = child.tasks.find(t => t.id === taskId) || child.bonusTasks.find(t => t.id === taskId);
        if (task) {
            if (task.isStreak) {
                task.currentStreak = (task.currentStreak || 0) + 1;
                task.lastStreakUpdate = today;
            }
            
            // Apply rewards
            const rt = child.rewardType || 'money';
            const goldReward = parseInt(task.rewardGold !== undefined ? task.rewardGold : 1) || 0;
            const starsReward = parseInt(task.rewardStars !== undefined ? task.rewardStars : 1) || 0;
            const medalsReward = parseInt(task.rewardMedals !== undefined ? task.rewardMedals : 0) || 0;
            
            if (!tl.rewardPaid) {
                if (goldReward > 0 && (rt === 'money' || rt === 'both')) {
                    child.balance = (child.balance || 0) + goldReward;
                    child.totalEarned = (child.totalEarned || 0) + goldReward;
                }
                if (starsReward > 0 && (rt === 'stars' || rt === 'both')) {
                    child.stars = (child.stars || 0) + starsReward;
                    child.totalStars = (child.totalStars || 0) + starsReward;
                }
                if (medalsReward > 0) {
                    child.medals = (child.medals || 0) + medalsReward;
                    child.totalMedals = (child.totalMedals || 0) + medalsReward;
                }
                tl.rewardPaid = true;
                tl.paidGold = goldReward;
                tl.paidStars = starsReward;
                tl.paidMedals = medalsReward;
            }
        }
        
        saveState();
        
        const result = checkAchievements(child.id);
        if (result.unlocked.length > 0) {
            showToast('🎉', result.unlocked.join(', '));
            launchConfetti();
        } else {
            showToast('✅', __('confirm.success') || 'Супориш тасдиқ шуд!');
        }
        if (result.prestigeTriggered) {
            showPrestigeModal(result.newTier, result.goldPrize, result.starPrize);
        }
        
        // Handle routine completions / daily reward
        const todayDay = new Date(today + 'T12:00:00').getDay();
        const activeRegularTasks = child.tasks.filter(t => t.type !== 'bonus' && t.type !== 'optional' && !t.isBonus && (t.type !== 'daily' || !t.days || t.days.includes(todayDay)));
        const allDone = activeRegularTasks.length > 0 && activeRegularTasks.every(t => {
            const tl2 = log.tasks[t.id];
            return tl2 && tl2.status === 'completed' && tl2.confirmed;
        });

        if (allDone) {
            applyDailyReward(child.id, today);
            setTimeout(() => launchConfetti(), 300);
            const test = checkAndCreateTest(child.id);
            if (test) {
                setTimeout(() => showTestModal(test), 1000);
            }
        } else {
            const allResolved = activeRegularTasks.length > 0 && activeRegularTasks.every(t => {
                const tl2 = log.tasks[t.id];
                return tl2 && (tl2.status === 'completed' && tl2.confirmed || tl2.status === 'skipped');
            });
            if (allResolved) {
                applyDailyReward(child.id, today);
            }
        }
        
        renderParentDashboard();
        updateUI();
    }
}

function showParentRejectModal(task) {
    const confirmHeader = document.querySelector('#confirm-modal .modal-header h3');
    if (confirmHeader) {
        confirmHeader.innerHTML = `<svg class="icon-svg" aria-hidden="true" style="color:var(--danger);"><use href="#icon-x"/></svg> ${__('parent.reject_task_title')}`;
    }

    confirmTaskId = task.id;
    const taskNameText = __('parent.reject_task_confirm', { taskName: `${task.emoji ? task.emoji + ' ' : ''}${task.name}` });
    document.getElementById('confirm-task-name').innerHTML = taskNameText;
    
    // Hide PIN input
    const pinInput = document.getElementById('confirm-pin');
    if (pinInput) pinInput.style.display = 'none';
    document.getElementById('confirm-error').classList.add('hidden');

    // Show parent reject section immediately
    document.getElementById('confirm-reject-section').classList.remove('hidden');
    document.getElementById('confirm-reject-reason').value = '';
    document.getElementById('confirm-reject-photo-input').value = '';
    document.getElementById('confirm-reject-photo-img').src = '';
    document.getElementById('confirm-reject-photo-preview').classList.add('hidden');
    document.getElementById('confirm-reject-photo-btn').classList.remove('hidden');
    
    // Hide standard confirm button
    document.getElementById('confirm-submit').classList.add('hidden');
    
    // Show reject button and configure text to "Тасдиқи радкунӣ"
    const rejectBtn = document.getElementById('confirm-reject');
    rejectBtn.innerHTML = `<svg class="icon-svg" aria-hidden="true" style="width: 14px; height: 14px; fill: currentColor;"><use href="#icon-x"/></svg> <span>${__('confirm.reject_confirm_btn') || 'Тасдиқи радкунӣ'}</span>`;
    rejectBtn.style.background = '#EF4444';
    
    // Hide score group
    const scoreGroup = document.getElementById('confirm-exam-score-group');
    if (scoreGroup) scoreGroup.classList.add('hidden');

    // Show child proof details
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
}

let badgeRevokeId = null;
let badgeRevokeSuccessCallback = null;

function showBadgeRevokeModal(id, successCallback) {
    const a = ACHIEVEMENTS.find(item => item.id === id);
    if (!a) return;

    badgeRevokeId = id;
    badgeRevokeSuccessCallback = successCallback;

    const displayName = __(`achievement.${id}`) || a.name;
    document.getElementById('badge-revoke-reason').value = '';
    
    // Reset photo upload state
    document.getElementById('badge-revoke-photo-input').value = '';
    document.getElementById('badge-revoke-photo-img').src = '';
    document.getElementById('badge-revoke-photo-preview').classList.add('hidden');
    document.getElementById('badge-revoke-photo-btn').classList.remove('hidden');

    document.getElementById('badge-revoke-modal').classList.remove('hidden');
    document.getElementById('badge-revoke-reason').focus();
}

function submitBadgeRevoke() {
    const reason = document.getElementById('badge-revoke-reason').value.trim();
    const photoImg = document.getElementById('badge-revoke-photo-img');
    const photoAttached = photoImg.src && photoImg.src.startsWith('data:');

    // Validation: must write a reason OR upload a photo
    if (!reason && !photoAttached) {
        showToast('⚠️', __('confirm.validation_error') || 'Лутфан сабабро нависед ё акс бор кунед!');
        return;
    }

    const selectedChild = getCurrentChild();
    if (!selectedChild) return;

    if (!Array.isArray(selectedChild.revokedAchievements)) {
        selectedChild.revokedAchievements = [];
    }
    if (!selectedChild.revokedAchievements.includes(badgeRevokeId)) {
        selectedChild.revokedAchievements.push(badgeRevokeId);
    }
    
    // Save revocation details
    selectedChild.revokedAchievementsDetails = selectedChild.revokedAchievementsDetails || {};
    selectedChild.revokedAchievementsDetails[badgeRevokeId] = {
        reason: reason,
        photo: photoAttached ? photoImg.src : null,
        timestamp: Date.now()
    };

    selectedChild.achievements = (selectedChild.achievements || []).filter(a => a !== badgeRevokeId);
    
    saveState();
    showToast('❌', __('dream.rejected_short') || 'Рад шуд');
    document.getElementById('badge-revoke-modal').classList.add('hidden');

    if (badgeRevokeSuccessCallback) {
        badgeRevokeSuccessCallback();
    }
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

        const log = (child.dailyLogs || {})[dateStr];
        if (log) {
            if (log.excused) {
                cell.classList.add('excused');
            } else {
                const dateDayOfWeek = new Date(dateStr + 'T12:00:00').getDay();
                const activeRegularTasks = (child.tasks || []).filter(t => t.type !== 'bonus' && t.type !== 'optional' && !t.isBonus && (t.type !== 'daily' || !t.days || t.days.includes(dateDayOfWeek)));
                const allDone = activeRegularTasks.length > 0 && activeRegularTasks.every(t => {
                    const tl = log.tasks[t.id];
                    return tl && (tl.status === 'completed' || tl.status === 'skipped');
                });
                const anyDone = activeRegularTasks.some(t => {
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

        const isTestDay = (child.tenDayTests || []).some(t => t.date === dateStr);
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

    // Remove existing panel
    const existing = document.getElementById('day-details-panel');
    if (existing) existing.remove();

    const allTasks = [...(child.tasks || []), ...(child.bonusTasks || [])];
    let doneCount = 0;
    let totalCount = 0;
    let tasksHTML = '';

    if (log.excused) {
        tasksHTML = `<div style="text-align:center; padding:16px; color:var(--text-secondary); font-size:14px;">
            🙏 ${__('daydetails.excused') || 'Рӯзи узрнок'} — ${translateExcuseReason(log.excuseReason)}
        </div>`;
    } else {
        allTasks.forEach(t => {
            const tl = log.tasks ? log.tasks[t.id] : null;
            if (!tl) return;
            totalCount++;
            const isDone = tl.status === 'completed' && tl.confirmed;
            const isSkipped = tl.status === 'skipped';
            const isFailed = tl.status === 'failed';
            const isExcused = tl.status === 'excused';
            const isInProgress = tl.status === 'in-progress';
            if (isDone || isExcused) doneCount++;

            const statusIcon = isDone ? '✅' : isExcused ? '🙏' : (isSkipped || isFailed) ? '❌' : isInProgress ? '⏳' : '⬜';
            const emoji = (t.emoji && t.emoji !== 'undefined') ? t.emoji : '📌';

            let detailsHTML = '';
            if (isSkipped) {
                if (tl.skipReason) detailsHTML += `<div style="font-size:12px; color:var(--text-secondary); margin-top:4px;">💬 ${__('common.reason') || 'Сабаб'}: ${tl.skipReason}</div>`;
                if (tl.skipPhoto) {
                    detailsHTML += `<div style="margin-top:6px;"><button type="button" class="view-calendar-photo-btn" data-photo="${encodeURIComponent(tl.skipPhoto)}" style="background:none; border:none; color:var(--primary); font-size:11px; font-weight:600; text-decoration:underline; cursor:pointer; padding:0;">🖼️ ${__('common.photo_short') || 'Акс'}</button></div>`;
                }
            } else if (isFailed) {
                let failText = __('status.failed') || 'Иҷро нашуд';
                if (tl.penaltyApplied) {
                    let penaltyParts = [];
                    if (tl.penaltyApplied.stars > 0) penaltyParts.push(`⭐ ${tl.penaltyApplied.stars}`);
                    if (tl.penaltyApplied.gold > 0) penaltyParts.push(`🪙 ${tl.penaltyApplied.gold}`);
                    if (penaltyParts.length > 0) {
                        failText += ` (${__('task_badge.penalty') || 'Ҷарима'}: ${penaltyParts.join(' ')})`;
                    }
                }
                detailsHTML += `<div style="font-size:12px; color:#EF4444; margin-top:4px;">⚠️ ${failText}</div>`;
            } else if (isExcused) {
                detailsHTML += `<div style="font-size:12px; color:#d97706; margin-top:4px;">🙏 ${__('status.excused') || 'Узрнок'}${tl.excuseReason ? ': ' + tl.excuseReason : ''}</div>`;
            } else if (isDone) {
                if (tl.explanation) detailsHTML += `<div style="font-size:12px; color:var(--text-secondary); margin-top:4px;">💬 ${tl.explanation}</div>`;
                if (tl.photo) {
                    detailsHTML += `<div style="margin-top:6px;"><button type="button" class="view-calendar-photo-btn" data-photo="${encodeURIComponent(tl.photo)}" style="background:none; border:none; color:var(--primary); font-size:11px; font-weight:600; text-decoration:underline; cursor:pointer; padding:0;">🖼️ ${__('common.photo_short') || 'Акс'}</button></div>`;
                }
            }

            let actionButtonsHTML = '';
            if (parentPinVerified) {
                if (!isDone || isExcused) {
                    actionButtonsHTML += `<div style="margin-left:38px; margin-top:8px; display:flex; flex-wrap:wrap; gap:8px;">`;
                    actionButtonsHTML += `<button type="button" class="complete-calendar-task-btn" data-task-id="${t.id}" data-date="${dateStr}" style="padding:4px 10px; font-size:11px; font-weight:600; border-radius:6px; border:1px solid rgba(16,185,129,0.3); color:var(--success); background:rgba(16,185,129,0.05); cursor:pointer; white-space:normal; text-align:center; box-sizing:border-box;">✅ ${__('parent.complete_title') || 'Иҷро шуд'}</button>`;
                    if (!isExcused) {
                        actionButtonsHTML += `<button type="button" class="excuse-calendar-task-btn" data-task-id="${t.id}" data-date="${dateStr}" style="padding:4px 10px; font-size:11px; font-weight:600; border-radius:6px; border:1px solid rgba(245,158,11,0.3); color:#d97706; background:rgba(245,158,11,0.05); cursor:pointer; white-space:normal; text-align:center; box-sizing:border-box;">🙏 ${__('parent.excuse_title') || 'Узрнок'}</button>`;
                    }
                    actionButtonsHTML += `</div>`;
                }
            }

            tasksHTML += `
                <div style="display:flex; flex-direction:column; padding:10px 0; border-bottom:1px solid var(--border);">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <span style="font-size:20px; flex-shrink:0; width:28px; text-align:center;">${emoji}</span>
                        <span style="flex:1; font-size:14px; font-weight:500; color:var(--text); min-width:0; word-break:break-word;">${t.name}</span>
                        <span style="font-size:18px; flex-shrink:0;">${statusIcon}</span>
                    </div>
                    ${detailsHTML ? `<div style="margin-left:38px;">${detailsHTML}</div>` : ''}
                    ${actionButtonsHTML}
                </div>`;
        });

        if (tasksHTML === '') {
            tasksHTML = `<div style="text-align:center; padding:16px; color:var(--text-secondary); font-size:13px;">—</div>`;
        }
    }

    const progressPct = totalCount > 0 ? Math.round((doneCount / totalCount) * 100) : 0;
    const progressBar = totalCount > 0 ? `
        <div style="margin-bottom:14px;">
            <div style="display:flex; justify-content:space-between; font-size:12px; color:var(--text-secondary); margin-bottom:4px;">
                <span>${__('calendar.result') || 'Натиҷа'}</span>
                <span style="font-weight:700; color:var(--primary);">${doneCount}/${totalCount} (${progressPct}%)</span>
            </div>
            <div style="height:6px; background:var(--border); border-radius:4px; overflow:hidden;">
                <div style="height:100%; width:${progressPct}%; background:linear-gradient(90deg,var(--primary),var(--secondary,#ec4899)); border-radius:4px; transition:width .4s;"></div>
            </div>
        </div>` : '';

    let bonusPaidHTML = '';
    if (log && log.completionBonusPaid) {
        bonusPaidHTML = `
            <div style="
                margin-bottom: 12px;
                background: rgba(245, 158, 11, 0.08);
                border: 1.5px solid rgba(245, 158, 11, 0.25);
                border-radius: 10px;
                padding: 8px 12px;
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 13px;
                font-weight: 600;
                color: #d97706;
            ">
                <span style="font-size:16px;">🔥</span>
                <span>+10 ${__('reward_type.stars') || 'ситора'} (${__('achievements.completion_bonus') || 'бонуси пайдарҳамӣ'})</span>
            </div>
        `;
    }

    // Outer wrapper — full-width fixed, used as centering container
    const wrapper = document.createElement('div');
    wrapper.id = 'day-details-panel';
    wrapper.style.cssText = `
        position:fixed; bottom:0; left:0; right:0; z-index:1100;
        display:flex; justify-content:center; align-items:flex-end;
        pointer-events:none;`;

    const panel = document.createElement('div');
    panel.style.cssText = `
        width:100%; max-width:480px; pointer-events:all;
        box-sizing:border-box;
        background:var(--bg-card); border-radius:20px 20px 0 0;
        box-shadow:0 -8px 32px rgba(0,0,0,0.22);
        padding:0 0 env(safe-area-inset-bottom,0);
        max-height:75vh; display:flex; flex-direction:column;
        animation: slideUp 0.28s cubic-bezier(0.34,1.56,0.64,1);`;

    panel.innerHTML = `
        <div style="display:flex; align-items:center; justify-content:space-between; padding:16px 18px 12px; border-bottom:1px solid var(--border); flex-shrink:0;">
            <div>
                <div style="font-size:13px; color:var(--text-secondary); margin-bottom:2px;">📅 ${formatDate(dateStr)}</div>
                <div style="font-size:16px; font-weight:700; color:var(--text);">${log.excused ? ('🙏 ' + (__('excuse.title') || 'Узрнок')) : doneCount + '/' + totalCount + ' ' + (__('status.completed') || 'иҷро шуд')}</div>
            </div>
            <button onclick="document.getElementById('day-details-panel').remove(); document.getElementById('day-details-backdrop').remove();" style="background:var(--bg); border:none; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:18px; display:flex; align-items:center; justify-content:center; color:var(--text-secondary);">✕</button>
        </div>
        <div style="overflow-y:auto; padding:14px 18px; flex:1;">
            ${progressBar}
            ${bonusPaidHTML}
            ${tasksHTML}
        </div>`;

    wrapper.appendChild(panel);

    panel.querySelectorAll('.view-calendar-photo-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const photoUrl = decodeURIComponent(btn.dataset.photo);
            showImagePreview(photoUrl);
        });
    });

    panel.querySelectorAll('.complete-calendar-task-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const taskId = btn.dataset.taskId;
            const dateStr = btn.dataset.date;
            completePastTask(child.id, dateStr, taskId);
        });
    });

    panel.querySelectorAll('.excuse-calendar-task-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const taskId = btn.dataset.taskId;
            const dateStr = btn.dataset.date;
            showCustomPrompt(
                __('parent.excuse_title') || 'Узрнок',
                __('parent.excuse_reason_prompt') || 'Сабаби узрнокро ворид кунед (Уважительная причина):'
            ).then(result => {
                if (result === null) return;
                const text = (result.text || '').trim();
                const photo = result.photo || null;
                if (!text) {
                    showToast('⚠️', 'Лутфан сабаби узрнокро нависед!');
                    return;
                }
                excusePastTask(child.id, dateStr, taskId, text, photo);
            });
        });
    });

    // Backdrop
    const backdrop = document.createElement('div');
    backdrop.id = 'day-details-backdrop';
    backdrop.style.cssText = `position:fixed; inset:0; z-index:1099; background:rgba(0,0,0,0.6);`;
    backdrop.addEventListener('click', () => { wrapper.remove(); backdrop.remove(); });

    document.body.appendChild(backdrop);
    document.body.appendChild(wrapper);
}

// ===== BALANCE =====
function renderBalance() {
    const child = getCurrentChild();
    if (!child) return;
    const rt = child.rewardType || 'money';



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
        tierName = __('tier.silver') || 'Даври Нуқра';
    } else if (child.achievementTier === 1) {
        tierClass = 'tier-gold';
        tierName = __('tier.gold') || 'Даври Тилло';
    } else if (child.achievementTier === 2) {
        tierClass = 'tier-platinum';
        tierName = __('tier.platinum') || 'Даври Платина';
    } else {
        tierClass = 'tier-diamond';
        tierName = __('tier.diamond') || 'Даври Алмос';
    }

    const titleEl = document.getElementById('achievements-title');
    if (titleEl) {
        titleEl.innerHTML = `<h2 class="prestige-era-title ${tierClass}-text">${tierName}</h2>`;
        titleEl.removeAttribute('data-i18n');
    }

    const cardEl = document.getElementById('achievements-card');
    if (cardEl) {
        cardEl.className = 'achievements-board-card ' + tierClass;
    }

    container.className = `achievements-grid ${tierClass}`;

    let fillColor = '#94a3b8';
    if (child.achievementTier === 1) fillColor = '#F59E0B';
    else if (child.achievementTier === 2) fillColor = '#6366F1';
    else if (child.achievementTier >= 3) fillColor = '#3B82F6';

    container.innerHTML = ACHIEVEMENTS.map(a => {
        const unlocked = earned.includes(a.id);
        const progress = getAchievementProgress(child, a.id);
        const pct = progress.target > 0 ? Math.min(100, (progress.current / progress.target) * 100) : 0;
        const nameKey = `achievement.${a.id}`;
        const displayName = __(nameKey) || a.name;
        
        let progressHtml = '';
        if (unlocked) {
            progressHtml = `
                <div class="achievement-progress-text" style="font-size: 10px; font-weight: 700; color: #10B981; margin-top: 6px; display: flex; align-items: center; justify-content: center; gap: 3px;">
                    <span>✅ ${__('achievement_modal.status_unlocked') || 'Ба даст оварда шуд'}</span>
                </div>
            `;
        } else {
            progressHtml = `
                <div class="achievement-progress-wrapper" style="width: 100%; margin-top: 6px;">
                    <div class="achievement-progress-text" style="display: flex; justify-content: space-between; font-size: 9px; font-weight: 600; color: var(--text-secondary); margin-bottom: 3px;">
                        <span>${progress.current} / ${progress.target}</span>
                        <span>${Math.round(pct)}%</span>
                    </div>
                    <div class="achievement-progress-bar" style="background: rgba(0, 0, 0, 0.05); border-radius: 4px; height: 5px; overflow: hidden; width: 100%;">
                        <div class="achievement-progress-fill" style="width: ${pct}%; background: ${fillColor}; height: 100%; border-radius: 4px; transition: width 0.3s ease;"></div>
                    </div>
                </div>
            `;
        }

        return `<div class="achievement-item ${unlocked ? 'unlocked' : 'locked'}" onclick="showAchievementDetails('${a.id}')" style="cursor: pointer;">
            <span class="achievement-icon" style="font-size: 28px; margin-bottom: 4px;">${a.icon}</span>
            <span class="achievement-name" style="font-size: 11px; font-weight: 700; display: block; margin-bottom: 2px;">${displayName}</span>
            ${progressHtml}
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
        
        const tierThemes = [
            { // 0: Silver
                bgGradient: 'rgba(203, 213, 225, 0.1) 0%, rgba(148, 163, 184, 0.15) 100%',
                border: 'rgba(148, 163, 184, 0.4)',
                shadow: 'rgba(148, 163, 184, 0.08)',
                radial: 'rgba(203, 213, 225, 0.2)',
                progressBorder: 'rgba(148, 163, 184, 0.2)',
                progressFill: 'linear-gradient(90deg, #e2e8f0 0%, #94a3b8 100%)',
                badgeBg: 'rgba(203, 213, 225, 0.2)',
                badgeBorder: 'rgba(148, 163, 184, 0.3)',
                textColor: '#64748b',
                titleGradient: 'linear-gradient(120deg, #94a3b8 20%, #cbd5e1 40%, #ffffff 50%, #cbd5e1 60%, #94a3b8 80%)',
                titleShadow: '0 0 10px rgba(148, 163, 184, 0.15)'
            },
            { // 1: Gold
                bgGradient: 'rgba(255, 215, 0, 0.1) 0%, rgba(218, 165, 32, 0.15) 100%',
                border: 'rgba(255, 215, 0, 0.4)',
                shadow: 'rgba(218, 165, 32, 0.08)',
                radial: 'rgba(255,215,0,0.2)',
                progressBorder: 'rgba(255,215,0,0.1)',
                progressFill: 'linear-gradient(90deg, #FFD700 0%, #FFA500 100%)',
                badgeBg: 'rgba(255, 215, 0, 0.2)',
                badgeBorder: 'rgba(255, 215, 0, 0.3)',
                textColor: '#DAA520',
                titleGradient: 'linear-gradient(120deg, #FFD700 0%, #FFA500 35%, #ffffff 50%, #FFA500 65%, #FF8C00 100%)',
                titleShadow: '0 0 10px rgba(255, 215, 0, 0.15)'
            },
            { // 2: Platinum
                bgGradient: 'rgba(99, 102, 241, 0.1) 0%, rgba(67, 56, 202, 0.15) 100%',
                border: 'rgba(99, 102, 241, 0.4)',
                shadow: 'rgba(67, 56, 202, 0.08)',
                radial: 'rgba(99, 102, 241, 0.2)',
                progressBorder: 'rgba(99, 102, 241, 0.2)',
                progressFill: 'linear-gradient(90deg, #818cf8 0%, #4f46e5 100%)',
                badgeBg: 'rgba(99, 102, 241, 0.15)',
                badgeBorder: 'rgba(99, 102, 241, 0.3)',
                textColor: '#4f46e5',
                titleGradient: 'linear-gradient(120deg, #6366f1 20%, #a5b4fc 40%, #ffffff 50%, #a5b4fc 60%, #4338ca 80%)',
                titleShadow: '0 0 10px rgba(99, 102, 241, 0.15)'
            },
            { // 3: Diamond
                bgGradient: 'rgba(56, 189, 248, 0.1) 0%, rgba(3, 105, 161, 0.15) 100%',
                border: 'rgba(56, 189, 248, 0.4)',
                shadow: 'rgba(3, 105, 161, 0.08)',
                radial: 'rgba(56, 189, 248, 0.2)',
                progressBorder: 'rgba(56, 189, 248, 0.2)',
                progressFill: 'linear-gradient(90deg, #7dd3fc 0%, #0284c7 100%)',
                badgeBg: 'rgba(56, 189, 248, 0.15)',
                badgeBorder: 'rgba(56, 189, 248, 0.3)',
                textColor: '#0284c7',
                titleGradient: 'linear-gradient(120deg, #0284c7 20%, #38bdf8 40%, #ffffff 50%, #38bdf8 60%, #0369a1 80%)',
                titleShadow: '0 0 10px rgba(56, 189, 248, 0.15)'
            }
        ];
        
        const tierIdx = Math.min(3, t);
        const theme = tierThemes[tierIdx];

        banner.innerHTML = `
            <div class="grand-prize-card" style="
                background: linear-gradient(135deg, ${theme.bgGradient});
                border: 2px dashed ${theme.border};
                border-radius: 16px;
                padding: 20px;
                text-align: center;
                position: relative;
                overflow: hidden;
                box-shadow: 0 8px 32px ${theme.shadow};
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
                    background: radial-gradient(circle, ${theme.radial} 0%, transparent 70%);
                    pointer-events: none;
                "></div>
                
                <div style="font-size: 48px; margin-bottom: 12px; animation: float 3s ease-in-out infinite;">👑</div>
                <h3 class="grand-prize-title-text" style="background-image: ${theme.titleGradient} !important; text-shadow: ${theme.titleShadow} !important;">
                    ${__('achievements.grand_prize') || 'Шоҳҷоиза'}
                </h3>
                <p style="font-size: 13px; color: var(--text-secondary); margin-bottom: 16px; padding: 0 10px; line-height: 1.4;">
                    ${__('achievements.grand_prize_desc', { total: totalCount }) || `Барои ба даст овардани ҳамаи ${totalCount} муваффақият дода мешавад.`}
                </p>
                
                <!-- Progress bar -->
                <div style="margin-bottom: 16px; padding: 0 10px;">
                    <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; margin-bottom: 6px;">
                        <span style="color: var(--text-secondary);">${__('achievement_modal.progress_label') || 'Пешрафт:'}</span>
                        <span style="color: ${theme.textColor};">${currentCount} / ${totalCount}</span>
                    </div>
                    <div class="progress-bar" style="background: rgba(255, 255, 255, 0.1); border-radius: 10px; height: 8px; overflow: hidden; border: 1px solid ${theme.progressBorder};">
                        <div class="progress-fill" style="width: ${pct}%; background: ${theme.progressFill}; border-radius: 10px; transition: width 0.5s ease;"></div>
                    </div>
                </div>
                
                <div class="grand-prize-badge" style="
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    background: ${theme.badgeBg};
                    padding: 8px 16px;
                    border-radius: 20px;
                    border: 1px solid ${theme.badgeBorder};
                    font-weight: 800;
                    color: ${theme.textColor};
                    font-size: 16px;
                    box-shadow: 0 4px 12px ${theme.shadow};
                ">
                    <span style="font-size: 13px; font-weight: 600; color: var(--text-secondary);">${__('achievements.grand_prize_prize') || 'Ҷоиза:'}</span>
                    <span style="display: flex; gap: 6px; align-items: center;">+${goldPrizeValue} 🪙 <span style="color: var(--text-secondary); font-weight: normal; font-size: 12px;">|</span> +${starPrizeValue} ⭐</span>
                </div>
            </div>
        `;
    }

    const revokedContainer = document.getElementById('revoked-achievements-container');
    if (revokedContainer) {
        let revokedHtml = '';
        if (child.revokedAchievements && child.revokedAchievements.length > 0 && child.revokedAchievementsDetails) {
            revokedHtml += `<h4 style="margin-top: 20px; color: var(--danger); font-size: 14px; font-weight: 700; margin-bottom: 8px;">`;
            revokedHtml += `  <svg class="icon-svg" aria-hidden="true" style="width:14px;height:14px;color:var(--danger);vertical-align:middle;margin-right:4px;"><use href="#icon-x"/></svg>`;
            revokedHtml += `  ${__('achievements.revoked_title') || 'Нишонҳои радшуда'}</h4>`;
            revokedHtml += `<div style="display: flex; flex-direction: column; gap: 8px;">`;
            
            child.revokedAchievements.forEach(badgeId => {
                const a = ACHIEVEMENTS.find(item => item.id === badgeId);
                if (!a) return;
                const details = child.revokedAchievementsDetails[badgeId] || {};
                const displayName = __(`achievement.${badgeId}`) || a.name;
                const reasonText = details.reason || 'Сабаб навишта нашудааст';
                
                revokedHtml += `<div class="task-card-warning" style="display: block; margin-top: 0; border-color: var(--danger); background: rgba(239, 68, 68, 0.03); padding: 10px 14px; border-radius: var(--radius-sm);">`;
                revokedHtml += `  <div style="display: flex; justify-content: space-between; align-items: center; font-weight: 700; color: var(--danger); margin-bottom: 4px;">`;
                revokedHtml += `    <span>${a.icon} ${displayName}</span>`;
                revokedHtml += `    <span style="font-size: 10px; font-weight: normal; color: var(--text-light);">${details.timestamp ? new Date(details.timestamp).toLocaleDateString() : ''}</span>`;
                revokedHtml += `  </div>`;
                revokedHtml += `  <div style="font-size: 12px; color: var(--text-secondary); line-height: 1.4;">"${reasonText}"</div>`;
                if (details.photo) {
                    revokedHtml += `  <div style="margin-top: 6px;"><button type="button" class="view-revoked-badge-photo-btn" data-photo="${encodeURIComponent(details.photo)}" style="background: none; border: none; color: var(--danger); font-weight: 600; text-decoration: underline; font-size: 11px; cursor: pointer; padding: 0;">📸 Аксро дидан</button></div>`;
                }
                revokedHtml += `</div>`;
            });
            revokedHtml += `</div>`;
        }
        revokedContainer.innerHTML = revokedHtml;
        
        // Attach click listeners for revoked badge photos
        revokedContainer.querySelectorAll('.view-revoked-badge-photo-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const photoUrl = decodeURIComponent(btn.dataset.photo);
                showImagePreview(photoUrl);
            });
        });
    }
}

function showAchievementDetails(id) {
    const a = ACHIEVEMENTS.find(item => item.id === id);
    if (!a) return;
    
    const child = getCurrentChild();
    const earned = child && child.achievements ? child.achievements.includes(id) : false;
    const progress = getAchievementProgress(child, id);
    
    const displayName = __(`achievement.${id}`) || a.name;
    let displayDesc = __(`achievement.desc.${id}`) || a.desc;
    displayDesc = displayDesc.replace(/N/g, progress.target);
    
    document.getElementById('achievement-modal-title').textContent = __('achievement_modal.title') || 'Муваффақият';
    document.getElementById('achievement-modal-icon').textContent = a.icon;
    document.getElementById('achievement-modal-name').textContent = displayName;
    
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

    let revokeBtn = document.getElementById('achievement-revoke-btn');
    if (!revokeBtn) {
        revokeBtn = document.createElement('button');
        revokeBtn.id = 'achievement-revoke-btn';
        revokeBtn.className = 'btn btn-danger';
        revokeBtn.style.marginTop = '15px';
        revokeBtn.style.width = '100%';
        revokeBtn.textContent = __('parent.reject') || 'Рад кардан';
        document.getElementById('achievement-modal').querySelector('.modal-body').appendChild(revokeBtn);
    }
    
    if (earned && parentPinVerified) {
        revokeBtn.style.display = 'block';
        revokeBtn.onclick = function() {
            showBadgeRevokeModal(id, function() {
                closeAchievementModal();
                renderAchievements();
            });
        };
    } else {
        revokeBtn.style.display = 'none';
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

function recoverPin() {
    // Forgot-PIN flow: verify recovery code, then allow setting a new PIN
    if (!state.pinRecovery) {
        showToast('❌', __('settings.no_recovery') || 'Резервный код не задан. Восстановление невозможно.');
        return;
    }
    const entered = prompt(__('settings.enter_recovery') || 'Введите резервный код:');
    if (entered === null) return;
    if (entered.trim() !== state.pinRecovery) {
        showToast('❌', __('settings.recovery_wrong') || 'Неверный резервный код');
        return;
    }
    const newPin = prompt(__('settings.change_pin_prompt'));
    if (newPin && /^\d{4}$/.test(newPin)) {
        state.pin = newPin;
        saveState();
        showToast('✅', __('settings.change_pin_success'));
    } else if (newPin) {
        showToast('❌', __('settings.change_pin_error'));
    }
}

function renderSettings() {
    const container = document.getElementById('settings-content');
    if (!container) return;

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
                    <div class="settings-item" id="btn-how-it-works" style="cursor: pointer;">
                        <span class="settings-item-left">
                            <svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-sparkle"/></svg>
                            <span class="settings-item-label">${__('settings.how_it_works')}</span>
                        </span>
                        <span class="settings-item-arrow">›</span>
                    </div>
                    <div class="settings-item settings-lang-row">
                        <div class="lang-dropdown" id="lang-dropdown">
                            ${(() => {
                                const langs = [['tg','🇹🇯','Тоҷикӣ'],['ru','🇷🇺','Русский'],['en','🇬🇧','English'],['uz','🇺🇿',"O'zbek"],['kk','🇰🇿','Қазақша'],['ky','🇰🇬','Кыргызча'],['tk','🇹🇲','Türkmen']];
                                const cur = langs.find(l => l[0] === currentLang) || langs[0];
                                return `
                                <button type="button" class="lang-dropdown-trigger" id="lang-dropdown-trigger" aria-haspopup="listbox" aria-expanded="false">
                                    <svg class="icon-svg lang-dd-globe" aria-hidden="true"><use href="#icon-flag"/></svg>
                                    <span class="lang-dd-label">${__('settings.language')}</span>
                                    <span class="lang-dd-current"><span class="lang-dd-flag">${cur[1]}</span><span class="lang-dd-name">${cur[2]}</span></span>
                                    <svg class="icon-svg lang-dd-chevron" aria-hidden="true"><use href="#icon-chevron-down"/></svg>
                                </button>
                                <div class="lang-dropdown-menu" id="lang-dropdown-menu" role="listbox">
                                    ${langs.map(([lang,flag,name]) =>
                                        `<button type="button" class="lang-dropdown-option${currentLang===lang?' selected':''}" data-lang="${lang}" role="option">
                                            <span class="lang-dd-flag">${flag}</span>
                                            <span class="lang-dd-name">${name}</span>
                                            ${currentLang===lang?'<svg class="icon-svg lang-dd-check" aria-hidden="true"><use href="#icon-check"/></svg>':''}
                                        </button>`
                                    ).join('')}
                                </div>`;
                            })()}
                        </div>
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
                    ${(() => {
                        const usedKB = Math.round(JSON.stringify(state).length / 1024);
                        const LIMIT_KB = 5120; // ~5MB typical localStorage limit
                        const pct = Math.min(100, Math.round((usedKB / LIMIT_KB) * 100));
                        const barColor = pct > 85 ? '#EF4444' : (pct > 60 ? '#F59E0B' : 'var(--primary)');
                        const warn = pct > 85 ? `<div class="storage-warn">${__('settings.storage_warning') || '⚠️ Хотира қариб пур аст. Маълумотро содир кунед ва аксҳои кӯҳнаро тоза кунед.'}</div>` : '';
                        return `
                    <div class="settings-item">
                        <span class="settings-item-left">
                            <svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-book"/></svg>
                            <span class="settings-item-label">${__('settings.data_size')}</span>
                        </span>
                        <span class="settings-item-arrow">${usedKB} KB / ~${Math.round(LIMIT_KB/1024)} MB</span>
                    </div>
                    <div class="storage-bar-wrap"><div class="storage-bar" style="width:${pct}%;background:${barColor};"></div></div>
                    ${warn}`;
                    })()}
                    <div class="settings-item" id="btn-export-data">
                        <span class="settings-item-left">
                            <svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-arrow-up"/></svg>
                            <span class="settings-item-label">${__('settings.export')}</span>
                        </span>
                        <span class="settings-item-arrow">${(() => {
                            if (!state.lastExport) return `<span class="backup-due">${__('settings.backup_never') || 'Ҳеҷ гоҳ'}</span>`;
                            const days = Math.floor((Date.now() - new Date(state.lastExport).getTime()) / 86400000);
                            if (days >= 14) return `<span class="backup-due">${days} ${__('achievement_modal.days_suffix') || 'рӯз'} ⚠️</span>`;
                            return `${days} ${__('achievement_modal.days_suffix') || 'рӯз'}`;
                        })()}</span>
                    </div>
                </div>
            </div>
            <div class="settings-group">
                <h3><svg class="icon-svg" aria-hidden="true" style="width:18px;height:18px;color:var(--text-secondary);"><use href="#icon-shield"/></svg> ${__('settings.sync_title')}</h3>
                <div class="settings-card">
                    <div class="settings-item" id="btn-supabase-config" style="cursor: pointer; display: none;">
                        <span class="settings-item-left">
                            <svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-settings"/></svg>
                            <span class="settings-item-label">Танзимоти Supabase / Настройки Supabase</span>
                        </span>
                        <span class="settings-item-arrow">›</span>
                    </div>
                    <div class="settings-item" id="btn-change-device-role" style="cursor: pointer;">
                        <span class="settings-item-left">
                            <svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-user"/></svg>
                            <span class="settings-item-label">${__('settings.device_mode', { mode: safeStorage.getItem('kids_tasks_device_role') === 'child' ? __('settings.role_child') : __('settings.role_parent') })}</span>
                        </span>
                        <span class="settings-item-arrow">›</span>
                    </div>
                    ${window.supabaseSession ? `
                    <div class="settings-item" id="btn-logout-supabase" style="color: #ef4444; cursor: pointer;">
                        <span class="settings-item-left">
                            <svg class="icon-svg settings-item-icon" aria-hidden="true" style="color: #ef4444;"><use href="#icon-x"/></svg>
                            <span class="settings-item-label">${__('settings.logout')}</span>
                        </span>
                        <span class="settings-item-arrow">›</span>
                    </div>` : ''}
                </div>
            </div>
            <div class="settings-group">
                <h3><svg class="icon-svg" aria-hidden="true" style="width:18px;height:18px;color:var(--text-secondary);"><use href="#icon-book"/></svg> <span data-i18n="help.modal_title">${__('help.modal_title')}</span></h3>
                <div class="settings-card">
                    <div class="settings-item" id="btn-show-help" style="cursor: pointer;">
                        <span class="settings-item-left">
                            <svg class="icon-svg settings-item-icon" aria-hidden="true"><use href="#icon-book"/></svg>
                            <span class="settings-item-label" data-i18n="settings.user_guide">${__('settings.user_guide')}</span>
                        </span>
                        <span class="settings-item-arrow">›</span>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Supabase config and auth actions
    document.getElementById('btn-supabase-config').addEventListener('click', () => {
        const config = getSupabaseConfig();
        const newUrl = prompt('Введите Supabase URL (например: https://xxxx.supabase.co):', config.url);
        if (newUrl === null) return;
        const newKey = prompt('Введите Supabase Anon Key:', config.key);
        if (newKey === null) return;
        
        safeStorage.setItem('supabase_url', newUrl.trim());
        safeStorage.setItem('supabase_key', newKey.trim());
        showToast('💾', 'Настройки Supabase сохранены. Перезагрузка...');
        setTimeout(() => location.reload(), 1000);
    });

    document.getElementById('btn-change-device-role').addEventListener('click', () => {
        const currentRole = safeStorage.getItem('kids_tasks_device_role') || 'parent';
        const newRole = currentRole === 'child' ? 'parent' : 'child';
        const confirmMsg = currentRole === 'child' ? 
            __('settings.confirm_switch_parent'):
            __('settings.confirm_switch_child');
        if (confirm(confirmMsg)) {
            safeStorage.setItem('kids_tasks_device_role', newRole);
            showToast('🔄', __('settings.device_role_changed'));
            setTimeout(() => location.reload(), 800);
        }
    });

    const logoutBtn = document.getElementById('btn-logout-supabase');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', async () => {
            if (confirm(__('settings.confirm_logout'))) {
                if (supabaseClient) {
                    await supabaseClient.auth.signOut();
                }
                window.supabaseSession = null;
                showToast('👋', __('settings.logout_success'));
                setTimeout(() => location.reload(), 1000);
            }
        });
    }

    // Settings actions
    document.getElementById('btn-how-it-works').addEventListener('click', () => {
        showOnboardingCarousel(true);
    });

    document.getElementById('btn-change-pin').addEventListener('click', () => {
        const newPin = prompt(__('settings.change_pin_prompt'));
        if (newPin && /^\d{4}$/.test(newPin)) {
            state.pin = newPin;
            // Offer to set a recovery code
            const recovery = prompt(__('settings.set_recovery_prompt') || 'Резервный код для восстановления PIN (минимум 6 символов, запишите его!):');
            if (recovery && recovery.trim().length >= 6) {
                state.pinRecovery = recovery.trim();
                showToast('🔑', __('settings.recovery_set') || 'Резервный код сохранён');
            }
            saveState();
            showToast('✅', __('settings.change_pin_success'));
        } else if (newPin) {
            showToast('❌', __('settings.change_pin_error'));
        }
    });

    // Custom language dropdown in settings
    var langTrigger = document.getElementById('lang-dropdown-trigger');
    var langMenu = document.getElementById('lang-dropdown-menu');
    var langDropdown = document.getElementById('lang-dropdown');
    if (langTrigger && langMenu && langDropdown) {
        langTrigger.addEventListener('click', function(e) {
            e.stopPropagation();
            var isOpen = langDropdown.classList.toggle('open');
            langTrigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
        // Close on outside click
        document.addEventListener('click', function closeLangMenu(e) {
            if (langDropdown && !langDropdown.contains(e.target)) {
                langDropdown.classList.remove('open');
                if (langTrigger) langTrigger.setAttribute('aria-expanded', 'false');
            }
        });
        langMenu.querySelectorAll('.lang-dropdown-option').forEach(function(opt) {
            opt.addEventListener('click', function() {
                var lang = this.dataset.lang;
                langDropdown.classList.remove('open');
                setLanguage(lang);
                localizeDefaultTaskNames();
                saveState();
                updateLanguageUI();
                applyStaticTranslations();
                updateUI();
                showDailyQuote();
                renderSettings();
            });
        });
    }

    document.getElementById('btn-reset-data').addEventListener('click', () => {
        if (confirm(__('settings.reset_data_confirm'))) {
            safeStorage.removeItem(STORAGE_KEY);
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
        state.lastExport = new Date().toISOString();
        saveState();
        showToast('📤', __('settings.export_success'));
        renderSettings();
    });

    const helpBtn = document.getElementById('btn-show-help');
    if (helpBtn) {
        helpBtn.addEventListener('click', () => {
            const modal = document.getElementById('help-modal');
            if (modal) {
                modal.classList.remove('hidden');
                applyStaticTranslations();
            }
        });
    }
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
        el.value = value || '';
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
    const title = document.getElementById('task-modal-title-text');

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
        setFlatpickrValue('task-daily-start-time', task.startTime || '12:00');
        setFlatpickrValue('task-daily-end-time', task.endTime || '');
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
        setFlatpickrValue('task-daily-start-time', '12:00');
        setFlatpickrValue('task-daily-end-time', '');
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

    // Force flatpickr redraw after modal is visible to recalculate dimensions
    setTimeout(() => {
        fpTimePickers.forEach(fp => {
            if (fp.config && fp.config.inline) {
                fp.redraw();
            }
        });
    }, 50);
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
    const optOptional = document.getElementById('task-type-option-optional');
    if (optOptional) optOptional.textContent = __('task_form.type_optional');

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
    const dailyTimeGroup = document.getElementById('task-daily-time-group');
    if (dailyTimeGroup) {
        const isDaily = (typeVal === 'daily');
        dailyTimeGroup.classList.toggle('hidden', !isDaily);
        if (isDaily) {
            setTimeout(() => {
                fpTimePickers.forEach(fp => {
                    if (fp.config && fp.config.inline) {
                        fp.redraw();
                    }
                });
            }, 50);
        }
    }
    
    // Gold reward container — visible for all task types
    const goldContainer = document.getElementById('task-reward-gold-container');
    if (goldContainer) {
        goldContainer.classList.remove('hidden');
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
    const MAX_VAL = 9999; // sane upper bound for rewards/penalties
    const clamp = (v) => Math.min(MAX_VAL, Math.max(0, parseInt(v) || 0));
    const name = document.getElementById('task-name').value.trim().slice(0, 80);
    const durationHours = Math.min(23, Math.max(0, parseInt(document.getElementById('task-duration-hours').value) || 0));
    const durationMinutes = Math.min(59, Math.max(0, parseInt(document.getElementById('task-duration-minutes').value) || 0));
    let duration = (durationHours * 60) + durationMinutes;
    if (duration === 0) duration = 20; // fallback default
    
    const typeVal = document.getElementById('task-type').value;
    const isBonus = (typeVal === 'bonus');
    
    const startDate = document.getElementById('task-start-date').value || '';
    let startTime = '';
    let endTime = '';
    if (typeVal === 'daily') {
        startTime = to24h(document.getElementById('task-daily-start-time').value || '12:00');
        endTime = to24h(document.getElementById('task-daily-end-time').value || '');
    } else {
        startTime = to24h(document.getElementById('task-start-time').value || '12:00');
    }
    const useTimer = document.getElementById('task-use-timer').checked;
    const hasTest = document.getElementById('task-has-test').checked;
    const testDate = document.getElementById('task-test-date')?.value || '';
    const testTime = to24h(document.getElementById('task-test-time')?.value || '');
    const photoRequired = document.getElementById('task-photo-required').checked;
    const hasPenalty = document.getElementById('task-has-penalty').checked;
    const penaltyStars = clamp(document.getElementById('task-penalty-stars').value);
    const penaltyGold = clamp(document.getElementById('task-penalty-gold').value);
    
    const checkboxes = document.querySelectorAll('input[name="task-days"]');
    const days = Array.from(checkboxes).filter(cb => cb.checked).map(cb => parseInt(cb.value));
    let finalDays = days;
    if (typeVal === 'daily' && days.length === 0) {
        finalDays = [1, 2, 3, 4, 5, 6, 0];
    }

    const rewardGold = clamp(document.getElementById('task-reward-gold').value);
    const rewardStars = clamp(document.getElementById('task-reward-stars').value);
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
    const deadlineTime = to24h(document.getElementById('task-deadline-time')?.value || '18:00');
    
    const hasStrictDeadline = document.getElementById('task-has-strict-deadline')?.checked || false;
    const strictDeadlineDate = document.getElementById('task-strict-deadline-date')?.value || '';
    const strictDeadlineTime = to24h(document.getElementById('task-strict-deadline-time')?.value || '18:00');
    
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
        endTime,
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
        days: finalDays,
        rewardGold,
        rewardStars,
        rewardMedals,
        instructions,
        instructionImage
    };

    if (editingTaskId) {
        let targetList = child.tasks;
        let taskIndex = targetList.findIndex(t => t.id === editingTaskId);
        let wasBonus = false;
        if (taskIndex === -1) {
            targetList = child.bonusTasks;
            taskIndex = targetList.findIndex(t => t.id === editingTaskId);
            wasBonus = true;
        }

        if (taskIndex !== -1) {
            const task = targetList[taskIndex];
            Object.assign(task, taskData);
            
            // Move between lists if type changed to/from bonus
            if (wasBonus !== isBonus) {
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

    if (typeof syncDailyLogTasks === 'function') {
        syncDailyLogTasks(child, getToday());
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
    rtSelect.options[0].textContent = __('reward_type.money');
    rtSelect.options[1].textContent = __('reward_type.stars');
    rtSelect.options[2].textContent = __('reward_type.both');

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
    const name = document.getElementById('child-name').value.trim().slice(0, 40);
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
    if (confirm(__('parent.delete_child_confirm'))) {
        state.children = state.children.filter(c => c.id !== editingChildId);
        if (currentChildId === editingChildId) {
            currentChildId = state.children.length > 0 ? state.children[0].id : null;
            if (currentChildId) {
                safeStorage.setItem('kids_tasks_active_child_id', currentChildId);
            } else {
                safeStorage.removeItem('kids_tasks_active_child_id');
            }
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
        showToast('⚠️', __('dream.name_required'));
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
            const name = nameEl.value.trim().slice(0, 80);
            if (!name) return;

            const goldEl = document.getElementById('dream-input-gold');
            const starsEl = document.getElementById('dream-input-stars');
            const costGold = Math.min(9999, Math.max(0, goldEl ? (parseInt(goldEl.value) || 0) : 0));
            const costStars = Math.min(9999, Math.max(0, starsEl ? (parseInt(starsEl.value) || 0) : 0));

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
        const ctaBtn = `<button class="btn btn-primary" id="btn-empty-add-dream" style="padding: 8px 16px; font-size: 13px;">${__('empty_state.child_no_dreams_cta')}</button>`;
        listContainer.innerHTML = getEmptyStateHTML('🌟', __('empty_state.child_no_dreams'), ctaBtn);
        const focusBtn = document.getElementById('btn-empty-add-dream');
        if (focusBtn) {
            focusBtn.addEventListener('click', () => {
                const nameEl = document.getElementById('dream-input-name');
                if (nameEl) {
                    nameEl.focus();
                    nameEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        }
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
                    ❌ ${__('dream.rejected_short')} (${__('common.reason')}: ${dream.parentComment || (__('common.no_reason'))})
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
                        <div style="font-weight: 600; font-size: 15px; margin-bottom: 4px;">🌟 ${dream.name}${isApproved ? `<span style="display:inline-block;font-size:10px;background:rgba(16,185,129,0.15);color:var(--success);padding:2px 8px;border-radius:10px;font-weight:600;margin-left:6px;">🤝 ${__('dream.promised')}</span>` : ''}</div>
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
        html += `<div style="margin-top: 16px;"><h4 style="font-size: 13px; color: var(--text-light); margin-bottom: 8px;">✅ ${__('dream.achieved_section')}</h4>`;
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
                const title = __('dream.delete_prompt');
                const placeholder = __('common.reason_placeholder');
                showCustomPrompt(title, placeholder).then(result => {
                    if (result === null) return; // User cancelled
                    const trimmedReason = (result.text || '').trim();
                    if (trimmedReason === '') {
                        showToast('⚠️', __('common.reason_required'));
                        return;
                    }
                    child.dreams.splice(idx, 1);
                    saveState();
                    showToast('🗑️', __('dream.deleted'));
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
    const toMin = (s) => {
        if (!s) return 9999;
        const p = s.split(':');
        return parseInt(p[0]) * 60 + parseInt(p[1] || '0');
    };

    // Routine = recurring DAILY items only. One-off / bonus quests live on the Tasks page.
    const routineTasks = child.tasks
        .filter(t => (t.type === 'daily' || !t.type) && (!t.days || t.days.includes(todayDay)))
        .sort((a, b) => toMin(a.startTime) - toMin(b.startTime));

    if (routineTasks.length === 0) {
        container.innerHTML = `
            <div style="text-align: center; padding: 30px 20px;">
                <div style="font-size: 48px; margin-bottom: 12px;">📋</div>
                <p style="color: var(--text-light); font-size: 14px;">${__('routine.no_tasks')}</p>
            </div>
        `;
        return;
    }

    const log = getOrCreateDailyLog(currentChildId);

    if (log.excused) {
        container.innerHTML = `
            <div class="task-card" style="text-align:center;padding:40px 20px;display:block;border-left:3px solid var(--warning);">
                <div style="font-size:64px;margin-bottom:16px;">🙏</div>
                <h3 style="font-size:18px;margin-bottom:8px;">${__('excused_day.title')}</h3>
                <p style="color:var(--text-light);font-size:14px;">${__('excused_day.reason')} ${translateExcuseReason(log.excuseReason)}</p>
            </div>
        `;
        return;
    }

    // ---- Progress + streak summary ----
    const doneCount = routineTasks.filter(t => {
        const tl = log.tasks[t.id];
        return tl && tl.status === 'completed' && tl.confirmed;
    }).length;
    const total = routineTasks.length;
    const pct = total ? Math.round((doneCount / total) * 100) : 0;
    const allDone = doneCount === total;
    const streak = (typeof calculateRoutineStreak === 'function') ? calculateRoutineStreak(child) : 0;
    const streakText = __('routine.streak_count', { count: streak });

    let html = '';
    html += `
        <div class="section-card" style="margin-bottom:4px; padding:14px 16px; border-radius:var(--radius-md); background:linear-gradient(135deg, rgba(124,58,237,0.08) 0%, rgba(236,72,153,0.06) 100%); border:1px solid rgba(124,58,237,0.15);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                <span style="font-weight:700; font-size:14px;">${allDone ? '🎉 ' : ''}${doneCount}/${total} ✓</span>
                <span style="font-weight:700; font-size:14px; color:${streak > 0 ? '#f59e0b' : 'var(--text-light)'};">
                    ${streak > 0 ? '🔥 ' + streakText : '🌱'}
                </span>
            </div>
            <div style="height:8px; background:rgba(0,0,0,0.06); border-radius:6px; overflow:hidden;">
                <div style="height:100%; width:${pct}%; border-radius:6px; transition:width .4s ease; background:linear-gradient(90deg, var(--primary), var(--secondary, #ec4899));"></div>
            </div>
        </div>
    `;

    // ---- Day-part blocks (Timeline) ----
    const blocks = [
        { label: __('routine.morning'),   emoji: '☀️', items: [] },
        { label: __('routine.afternoon'), emoji: '🌤️', items: [] },
        { label: __('routine.evening'),   emoji: '🌙', items: [] }
    ];
    routineTasks.forEach(task => {
        const hour = task.startTime ? parseInt(task.startTime.split(':')[0]) : 12;
        if (hour >= 5 && hour < 12) blocks[0].items.push(task);
        else if (hour >= 12 && hour < 18) blocks[1].items.push(task);
        else blocks[2].items.push(task);
    });

    const statusLabels = {
        'pending': __('status.pending'),
        'in-progress': __('status.in-progress'),
        'awaiting-confirm': __('status.awaiting-confirm'),
        'completed': __('status.completed'),
        'skipped': __('status.skipped')
    };

    blocks.forEach(block => {
        if (block.items.length === 0) return;
        html += `
            <div style="display:flex; align-items:center; gap:8px; margin:14px 0 4px; padding-left:2px;">
                <span style="font-size:18px;">${block.emoji}</span>
                <span style="font-weight:700; font-size:13px; letter-spacing:.3px; color:var(--text);">${block.label}</span>
                <span style="flex:1; height:1px; background:var(--border); opacity:.6;"></span>
            </div>
        `;

        block.items.forEach(task => {
            const tl = log.tasks[task.id];
            const status = tl ? tl.status : 'pending';
            const startTime = task.startTime || '--:--';
            const taskMinutes = task.startTime ? toMin(task.startTime) : null;

            let timeState = 'future';
            if (status === 'completed' && tl && tl.confirmed) timeState = 'completed';
            else if (status === 'skipped') timeState = 'skipped';
            else if (status === 'in-progress') timeState = 'current';
            else if (status === 'awaiting-confirm') timeState = 'awaiting';
            else if (taskMinutes !== null && currentMinutes >= taskMinutes) timeState = 'current';

            let dotColor = 'var(--text-light)';
            let dotIcon = '';
            let cardBg = 'border-left: 3px solid var(--border);';
            if (timeState === 'completed') {
                dotColor = 'var(--success)'; dotIcon = '✓';
                cardBg = 'background: linear-gradient(135deg, rgba(16,185,129,0.08), rgba(16,185,129,0.03)); border-left: 3px solid var(--success);';
            } else if (timeState === 'skipped') {
                dotColor = 'var(--danger)'; dotIcon = '✕';
                cardBg = 'opacity: 0.6; border-left: 3px solid var(--danger);';
            } else if (timeState === 'current' || timeState === 'awaiting') {
                dotColor = 'var(--primary)'; dotIcon = '▶';
                cardBg = 'background: linear-gradient(135deg, rgba(124,58,237,0.08), rgba(124,58,237,0.03)); border-left: 3px solid var(--primary); box-shadow: 0 0 8px rgba(124,58,237,0.15);';
            }

            const stars = task.rewardStars || 0;
            const tappable = (timeState !== 'completed' && timeState !== 'skipped');

            html += `
                <div class="routine-item" data-task-id="${task.id}" style="display:flex; align-items:flex-start; gap:12px; ${tappable ? 'cursor:pointer;' : ''}">
                    <div style="display:flex; flex-direction:column; align-items:center; min-width:40px; padding-top:2px;">
                        <div style="font-size:11px; font-weight:700; color:${dotColor}; margin-bottom:4px;">${startTime}</div>
                        <div style="width:18px; height:18px; border-radius:50%; background:${dotColor}; display:flex; align-items:center; justify-content:center; font-size:9px; color:#fff; font-weight:700;">${dotIcon}</div>
                    </div>
                    <div class="section-card" style="flex:1; padding:10px 14px; border-radius:var(--radius-sm); ${cardBg} margin-bottom:0;">
                        <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:8px;">
                            <div>
                                <div style="font-weight:600; font-size:14px; margin-bottom:4px;">${task.name}</div>
                                ${(tl && tl.parentReply && status === 'pending') ? `
                                    <div style="margin-top:4px; font-size:12px; color:var(--primary); background:rgba(124,58,237,0.05); padding:6px; border-radius:4px; border-left: 2px solid var(--primary); width: fit-content;">
                                        <strong>${__('task.parent_reply') || '💬 Ҷавоби волид:'}</strong> "${tl.parentReply}"
                                        ${tl.parentReplyPhoto ? `<br><button type="button" class="view-parent-reply-photo-btn" data-photo="${encodeURIComponent(tl.parentReplyPhoto)}" style="background: none; border: none; color: var(--primary); font-weight: 600; text-decoration: underline; margin-top: 4px; font-size: 11px; cursor: pointer; padding: 0;">🖼️ Акс</button>` : ''}
                                    </div>
                                ` : ''}
                                <div style="display:flex; gap:6px; flex-wrap:wrap; font-size:11px;">
                                    ${task.endTime
                                        ? `<span style="background:rgba(107,114,128,0.12); color:rgb(75,85,99); padding:2px 6px; border-radius:4px;">🕒 ${task.startTime || '--:--'}–${task.endTime}</span>`
                                        : (task.useTimer !== false ? `<span style="background:rgba(0,0,0,0.05); padding:2px 6px; border-radius:4px;">⏱ ${task.duration} ${__('task.minutes')}</span>` : '')}
                                    <span style="background:rgba(245,158,11,0.12); color:rgb(217,119,6); padding:2px 6px; border-radius:4px;">⭐ ${stars}</span>
                                </div>
                            </div>
                            <div style="font-size:11px; padding:2px 8px; border-radius:4px; font-weight:600; white-space:nowrap;
                                ${timeState === 'completed' ? 'background:rgba(16,185,129,0.15); color:var(--success);' :
                                  timeState === 'skipped' ? 'background:rgba(239,68,68,0.15); color:var(--danger);' :
                                  timeState === 'current' || timeState === 'awaiting' ? 'background:rgba(124,58,237,0.15); color:var(--primary);' :
                                  'background:rgba(0,0,0,0.05); color:var(--text-light);'}">
                                ${statusLabels[status] || statusLabels['pending']}
                            </div>
                        </div>
                        ${(timeState === 'skipped' && tl && tl.skipReason) ? `
                            <div style="margin-top:8px; font-size:12px; color:var(--text-secondary); background:rgba(239,68,68,0.05); padding:6px; border-radius:4px; border-left: 2px solid var(--danger);">
                                📝 ${__('common.reason') || 'Сабаб'}: ${tl.skipReason}
                                ${tl.skipPhoto ? `<br><button type="button" class="view-skip-photo-btn" data-photo="${encodeURIComponent(tl.skipPhoto)}" style="background: none; border: none; color: var(--danger, #EF4444); font-weight: 600; text-decoration: underline; margin-top: 4px; font-size: 11px; cursor: pointer; padding: 0;">📸 Акс</button>` : ''}
                            </div>
                        ` : ''}
                    </div>
                </div>
            `;
        });
    });

    container.innerHTML = html;

    container.querySelectorAll('.view-skip-photo-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const photoUrl = decodeURIComponent(btn.dataset.photo);
            showImagePreview(photoUrl);
        });
    });

    container.querySelectorAll('.view-parent-reply-photo-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const photoUrl = decodeURIComponent(btn.dataset.photo);
            showImagePreview(photoUrl);
        });
    });

    // Tap a pending/active routine item → reuse the existing, proven completion flow.
    container.querySelectorAll('.routine-item[data-task-id]').forEach(el => {
        el.addEventListener('click', () => {
            const task = child.tasks.find(t => t.id === el.dataset.taskId);
            if (!task) return;
            const tl = log.tasks[task.id];
            const status = tl ? tl.status : 'pending';
            if (status === 'completed' || status === 'skipped') return;
            if (status === 'awaiting-confirm') {
                showConfirmModal(task);
            } else {
                showTimer(currentChildId, task);
            }
        });
    });
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
        const ctaBtn = `
            <button class="btn btn-primary" id="btn-parent-add-child-first" style="width: 100%; max-width: 260px; height: 44px; display: flex; align-items: center; justify-content: center; gap: 8px; font-weight: 600; font-size: 14px;">
                <svg class="icon-svg" style="width:16px;height:16px;" aria-hidden="true"><use href="#icon-plus"/></svg>
                ${__('empty_state.parent_no_children_cta')}
            </button>
        `;
        container.innerHTML = `
            <div class="parent-overview" style="padding: 20px;">
                ${getEmptyStateHTML('👋', __('empty_state.parent_no_children'), ctaBtn)}
            </div>
        `;
        const addBtn = document.getElementById('btn-parent-add-child-first');
        if (addBtn) {
            addBtn.addEventListener('click', () => {
                showChildModal();
            });
        }
        return;
    }

    // Use the currently selected child for task management
    var selectedChild = getCurrentChild();
    if (!selectedChild) {
        selectedChild = state.children[0];
    }

    var html = "<div class='parent-overview'>";

    // Header removed or replaced with simple margin
    html += "<div style='margin-top:10px;'></div>";

    // Top action buttons in 2x2 grid
    html += "<div class='section-card' style='margin-bottom:15px;'>";
    html += "<div class='parent-actions-grid'>";
    html += "  <button class='btn btn-primary btn-parent-add-task w-full' style='min-height: 40px; display: flex; align-items: center; justify-content: center; gap: 6px; font-weight: 600; font-size: 13px; padding: 8px 12px; white-space: normal; text-align: center;'>";
    html += "    <svg class='icon-svg' style='width:14px;height:14px;' aria-hidden='true'><use href='#icon-plus'/></svg> " + __('settings.add_task') + "</button>";
    html += "  <button class='btn btn-outline btn-parent-excuse-day w-full' style='min-height: 40px; display: flex; align-items: center; justify-content: center; gap: 6px; font-weight: 600; font-size: 13px; border-color: rgba(245, 158, 11, 0.3); color: var(--warning); padding: 8px 12px; white-space: normal; text-align: center;'>";
    html += "    <svg class='icon-svg' style='width:14px;height:14px;' aria-hidden='true'><use href='#icon-skip'/></svg> " + __('excuse.title') + "</button>";
    html += "  <button class='btn btn-secondary btn-parent-add-dream w-full' style='min-height: 40px; display: flex; align-items: center; justify-content: center; gap: 6px; font-weight: 600; font-size: 13px; background: rgba(124, 58, 237, 0.1); color: var(--primary); border: 1px solid rgba(124, 58, 237, 0.2); padding: 8px 12px; white-space: normal; text-align: center;'>";
    html += "    <svg class='icon-svg' style='width:14px;height:14px;' aria-hidden='true'><use href='#icon-plus'/></svg> " + (__('parent.add_dream_title_btn')) + "</button>";
    html += "  <button class='btn btn-secondary btn-parent-add-rev-pun w-full' style='min-height: 40px; display: flex; align-items: center; justify-content: center; gap: 6px; font-weight: 600; font-size: 13px; background: rgba(16, 185, 129, 0.1); color: var(--success); border: 1px solid rgba(16, 185, 129, 0.2); padding: 8px 12px; white-space: normal; text-align: center;'>";
    html += "    <svg class='icon-svg' style='width:14px;height:14px;' aria-hidden='true'><use href='#icon-scale'/></svg> " + __('parent.add_rev_pun_btn') + "</button>";
    html += "</div>";
    html += "</div>";

    // ---- Task Management Section ----
    html += "<div class='parent-task-section'>";

    // Skipped and Awaiting Tasks Review
    const log = getOrCreateDailyLog(selectedChild.id);
    const reviewTaskEntries = Object.entries(log.tasks).filter(([taskId, tl]) => tl.status === 'awaiting-confirm' || tl.status === 'skipped' || tl.status === 'failed' || (tl.status === 'pending' && tl.rejectReason));
    if (reviewTaskEntries.length > 0) {
        html += `<div class='section-card' style='margin-bottom:16px; border-left: 3px solid var(--warning); padding: 14px 16px;'>`;
        html += `<h4 style='margin: 0 0 12px 0; font-size: 13px; font-weight: 700; color: var(--text-light); text-transform: uppercase; letter-spacing: 0.5px;'>${__('parent.review_tasks') || 'Назорати супоришҳои имрӯза'}</h4>`;
        html += `<div style='display: flex; flex-direction: column; gap: 12px;'>`;
        reviewTaskEntries.forEach(([taskId, tl]) => {
            const task = selectedChild.tasks.find(t => t.id === taskId) || selectedChild.bonusTasks.find(t => t.id === taskId);
            if (!task) return;

            if (tl.status === 'skipped') {
                html += `
                <div style='background: rgba(239,68,68,0.05); border: 1px solid rgba(239,68,68,0.18); border-radius: 12px; padding: 14px; display: flex; flex-direction: column; gap: 10px;'>
                    <div style='display: flex; align-items: center; justify-content: space-between; gap: 8px;'>
                        <div style='font-weight: 700; font-size: 14px; color: var(--text);'>${task.emoji ? task.emoji + ' ' : ''}${task.name}</div>
                        <span style='display: inline-flex; align-items: center; gap: 4px; background: rgba(239,68,68,0.12); color: var(--danger, #ef4444); font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px; white-space: nowrap;'>${__('status.skipped') || '❌ Сарфи назар'}</span>
                    </div>
                    ${tl.skipReason ? `
                    <div style='background: var(--card-bg, rgba(255,255,255,0.04)); border-left: 3px solid rgba(239,68,68,0.5); padding: 8px 12px; border-radius: 0 8px 8px 0;'>
                        <div style='font-size: 11px; color: var(--text-light); font-weight: 600; margin-bottom: 3px;'>📝 ${__('common.reason') || 'Сабаб'}</div>
                        <div style='font-size: 13px; color: var(--text);'>${tl.skipReason}</div>
                    </div>` : ''}
                    ${tl.skipPhoto ? `
                    <div>
                        <button class="parent-view-skip-photo-btn" data-photo="${encodeURIComponent(tl.skipPhoto)}" style="display: inline-flex; align-items: center; gap: 6px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25); color: var(--danger, #ef4444); font-size: 12px; font-weight: 600; padding: 6px 14px; border-radius: 8px; cursor: pointer;">📸 ${__('common.photo_short') || 'Акс'}</button>
                    </div>` : ''}
                    <div style='display: flex; gap: 8px; flex-wrap: wrap; margin-top: 4px;'>
                        <button class='btn btn-primary parent-approve-skip-btn' data-task-id='${task.id}' style='flex: 1 1 calc(33% - 6px); min-width: 80px; padding: 9px 10px; font-size: 13px; font-weight: 600; border-radius: 10px; white-space: normal; text-align: center;'>✅ ${__('parent.approve') || 'Одобрить'}</button>
                        <button class='btn btn-danger parent-reject-skip-btn' data-task-id='${task.id}' style='flex: 1 1 calc(33% - 6px); min-width: 80px; padding: 9px 10px; font-size: 13px; font-weight: 600; border-radius: 10px; background: var(--danger, #EF4444); border: none; color: white; white-space: normal; text-align: center;'>✕ ${__('parent.reject') || 'Отклонить'}</button>
                        <button class='btn btn-outline parent-complete-today-task-btn' data-task-id='${task.id}' style='flex: 1 1 calc(33% - 6px); min-width: 80px; padding: 9px 10px; font-size: 13px; font-weight: 600; color: var(--success); border-color: rgba(16,185,129,0.35); background: rgba(16,185,129,0.07); border-radius: 10px; white-space: normal; text-align: center;'>✨ ${__('parent.complete_title') || 'Сделано'}</button>
                    </div>
                </div>`;

            } else if (tl.status === 'awaiting-confirm') {
                html += `
                <div style='background: rgba(245,158,11,0.05); border: 1px solid rgba(245,158,11,0.2); border-radius: 12px; padding: 14px; display: flex; flex-direction: column; gap: 10px;'>
                    <div style='display: flex; align-items: center; justify-content: space-between; gap: 8px;'>
                        <div style='font-weight: 700; font-size: 14px; color: var(--text);'>${task.emoji ? task.emoji + ' ' : ''}${task.name}</div>
                        <span style='display: inline-flex; align-items: center; gap: 4px; background: rgba(245,158,11,0.12); color: var(--warning, #f59e0b); font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px; white-space: nowrap;'>⏳ Интизор</span>
                    </div>
                    ${tl.explanation ? `
                    <div style='background: var(--card-bg, rgba(255,255,255,0.04)); border-left: 3px solid rgba(245,158,11,0.5); padding: 8px 12px; border-radius: 0 8px 8px 0;'>
                        <div style='font-size: 11px; color: var(--text-light); font-weight: 600; margin-bottom: 3px;'>💬 Шарҳ</div>
                        <div style='font-size: 13px; color: var(--text);'>${tl.explanation}</div>
                    </div>` : ''}
                    ${tl.photo ? `
                    <div>
                        <button class="parent-view-skip-photo-btn" data-photo="${encodeURIComponent(tl.photo)}" style="display: inline-flex; align-items: center; gap: 6px; background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.25); color: var(--warning, #f59e0b); font-size: 12px; font-weight: 600; padding: 6px 14px; border-radius: 8px; cursor: pointer;">📸 ${__('common.photo_short') || 'Акс'}</button>
                    </div>` : ''}
                    <div style='display: flex; gap: 8px; flex-wrap: wrap; margin-top: 2px;'>
                        <button class='btn btn-primary parent-direct-confirm-task-btn' data-task-id='${task.id}' style='flex: 1 1 calc(50% - 4px); min-width: 100px; padding: 9px 10px; font-size: 13px; font-weight: 600; border-radius: 10px; white-space: normal; text-align: center;'>✅ ${__('parent.approve') || 'Тасдиқ'}</button>
                        <button class='btn btn-danger parent-direct-reject-task-btn' data-task-id='${task.id}' style='flex: 1 1 calc(50% - 4px); min-width: 100px; padding: 9px 10px; font-size: 13px; font-weight: 600; border-radius: 10px; background: var(--danger, #EF4444); border: none; color: white; white-space: normal; text-align: center;'>✕ ${__('parent.reject') || 'Рад'}</button>
                    </div>
                </div>`;

            } else if (tl.status === 'pending' && tl.rejectReason) {
                html += `
                <div style='background: rgba(239,68,68,0.05); border: 1px solid rgba(239,68,68,0.18); border-radius: 12px; padding: 14px; display: flex; flex-direction: column; gap: 10px;'>
                    <div style='display: flex; align-items: center; justify-content: space-between; gap: 8px;'>
                        <div style='font-weight: 700; font-size: 14px; color: var(--text);'>${task.emoji ? task.emoji + ' ' : ''}${task.name}</div>
                        <span style='display: inline-flex; align-items: center; gap: 4px; background: rgba(239,68,68,0.12); color: var(--danger, #ef4444); font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px; white-space: nowrap;'>❌ Рад шуд</span>
                    </div>
                    <div style='background: var(--card-bg, rgba(255,255,255,0.04)); border-left: 3px solid rgba(239,68,68,0.5); padding: 8px 12px; border-radius: 0 8px 8px 0;'>
                        <div style='font-size: 11px; color: var(--text-light); font-weight: 600; margin-bottom: 3px;'>📝 Сабаби радкунӣ</div>
                        <div style='font-size: 13px; color: var(--text);'>${tl.rejectReason}</div>
                    </div>
                    ${tl.rejectPhoto ? `
                    <div>
                        <button class="parent-view-skip-photo-btn" data-photo="${encodeURIComponent(tl.rejectPhoto)}" style="display: inline-flex; align-items: center; gap: 6px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25); color: var(--danger, #ef4444); font-size: 12px; font-weight: 600; padding: 6px 14px; border-radius: 8px; cursor: pointer;">📸 ${__('common.photo_short') || 'Акс'}</button>
                    </div>` : ''}
                </div>`;
            } else if (tl.status === 'failed') {
                const badgeText = __('status.failed') || '⚠️ Иҷро нашуд';
                let penaltyHTML = '';
                if (tl.penaltyApplied) {
                    let penaltyParts = [];
                    if (tl.penaltyApplied.stars > 0) penaltyParts.push(`⭐ ${tl.penaltyApplied.stars}`);
                    if (tl.penaltyApplied.gold > 0) penaltyParts.push(`🪙 ${tl.penaltyApplied.gold}`);
                    if (penaltyParts.length > 0) {
                        penaltyHTML = `<div style='font-size: 12px; color: var(--text-secondary);'>
                            ${__('task_badge.penalty') || 'Ҷарима'}: <strong style="color: var(--danger);">${penaltyParts.join(' ')}</strong>
                        </div>`;
                    }
                }
                html += `
                <div style='background: rgba(239,68,68,0.05); border: 1px solid rgba(239,68,68,0.18); border-radius: 12px; padding: 14px; display: flex; flex-direction: column; gap: 10px;'>
                    <div style='display: flex; align-items: center; justify-content: space-between; gap: 8px;'>
                        <div style='font-weight: 700; font-size: 14px; color: var(--text);'>${task.emoji ? task.emoji + ' ' : ''}${task.name}</div>
                        <span style='display: inline-flex; align-items: center; gap: 4px; background: rgba(239,68,68,0.12); color: var(--danger, #ef4444); font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px; white-space: nowrap;'>${badgeText}</span>
                    </div>
                    ${tl.missedDeadline ? `
                    <div style='font-size: 12px; color: var(--text-light);'>
                        ${__('status.missed_deadline') || '⏰ Гузаштани мӯҳлат'}
                    </div>` : ''}
                    ${penaltyHTML}
                    <div style='display: flex; gap: 8px; flex-wrap: wrap;'>
                        <button class='btn btn-outline parent-complete-today-task-btn' data-task-id='${task.id}' style='flex: 1 1 calc(50% - 4px); min-width: 100px; padding: 9px 10px; font-size: 13px; font-weight: 600; color: var(--success); border-color: rgba(16,185,129,0.35); background: rgba(16,185,129,0.07); border-radius: 10px; white-space: normal; text-align: center;'>✅ ${__('parent.complete_title') || 'Иҷро шуд'}</button>
                        <button class='btn btn-outline parent-excuse-today-task-btn' data-task-id='${task.id}' style='flex: 1 1 calc(50% - 4px); min-width: 100px; padding: 9px 10px; font-size: 13px; font-weight: 600; color: #d97706; border-color: rgba(245,158,11,0.35); background: rgba(245,158,11,0.07); border-radius: 10px; white-space: normal; text-align: center;'>🙏 ${__('parent.excuse_title') || 'Узрнок'}</button>
                    </div>
                </div>`;
            }
        });
        html += `</div></div>`;
    }

    // Achievements Review
    if (selectedChild.achievements && selectedChild.achievements.length > 0) {
        html += "<div class='section-card'><h4>" + (__('achievements.title') || 'Дастовардҳо') + "</h4>";
        html += "<div style='display: flex; flex-wrap: wrap; gap: 8px;'>";
        selectedChild.achievements.forEach(id => {
            const a = ACHIEVEMENTS.find(item => item.id === id);
            if (!a) return;
            const displayName = __(`achievement.${id}`) || a.name;
            html += `<div style="background: rgba(124, 58, 237, 0.1); padding: 6px 12px; border-radius: 16px; font-size: 12px; display: flex; align-items: center; gap: 6px; border: 1px solid rgba(124,58,237,0.2);">`;
            html += `<span>${a.icon} ${displayName}</span>`;
            html += `<button class="parent-revoke-badge-btn" data-id="${id}" style="background:none; border:none; color:var(--danger); cursor:pointer; font-size:16px; margin-left:4px; line-height: 1;" title="${__('parent.reject') || 'Рад кардан'}">×</button>`;
            html += `</div>`;
        });
        html += "</div></div>";
    }

    // Regular tasks
    html += "<div class='section-card'><h4>" + __('settings.daily_tasks') + "</h4>";
    if (selectedChild.tasks.length > 0) {
        html += "<ul class='item-list'>";
        selectedChild.tasks.sort(function(a, b) { return a.order - b.order; }).forEach(function(task) {
            var iconName = 'icon-clock';
            if (task.type === 'one-time') iconName = 'icon-calendar';
            else if (task.type === 'exam') iconName = 'icon-book';
            else if (task.type === 'bonus') iconName = 'icon-gift';

            html += "<li style='display: flex; align-items: flex-start; justify-content: space-between; padding: 10px; gap: 8px; border-bottom: 1px solid var(--border);'>";
            html += "  <span class='item-emoji' style='color:var(--primary); display:inline-flex; align-items:center; justify-content:center; width:24px; height:24px; flex-shrink: 0; margin-top: 2px;'><svg class='icon-svg' style='width:16px;height:16px;' aria-hidden='true'><use href='#" + iconName + "'/></svg></span>";
            html += "  <div style='display: flex; flex-direction: column; gap: 6px; flex: 1; min-width: 0;'>";
            html += "    <span style='font-weight: 600; font-size: 13px; color: var(--text); word-break: break-word; line-height: 1.4;'>" + task.name + "</span>";
            html += "    <div style='display: flex; flex-wrap: wrap; gap: 4px; align-items: center;'>" + getTaskMetaBadgesHTML(task) + "</div>";
            html += "  </div>";
            html += "  <span class='item-actions' style='margin-top: 2px;'>";
            html += "    <button class='edit-btn' data-task-id='" + task.id + "' data-is-bonus='false' title='" + __('edit') + "'>✏️</button>";
            html += "    <button class='delete-btn' data-task-id='" + task.id + "' data-is-bonus='false' title='" + __('edit') + "'>🗑️</button>";
            html += "  </span>";
            html += "</li>";
        });
        html += "</ul>";
    } else {
        const ctaBtn = `<button class="btn btn-primary btn-empty-parent-add-task" style="padding: 8px 16px; font-size: 13px;">${__('empty_state.parent_no_tasks_cta')}</button>`;
        html += getEmptyStateHTML('📋', __('empty_state.parent_no_tasks'), ctaBtn);
    }
    html += "</div>";

    // Bonus tasks - render only if count > 0
    if (selectedChild.bonusTasks.length > 0) {
        html += "<div class='section-card'><h4>" + __('settings.bonus_tasks') + "</h4>";
        html += "<ul class='item-list'>";
        selectedChild.bonusTasks.forEach(function(task) {
            var iconName = 'icon-gift';

            html += "<li style='display: flex; align-items: flex-start; justify-content: space-between; padding: 10px; gap: 8px; border-bottom: 1px solid var(--border);'>";
            html += "  <span class='item-emoji' style='color:var(--primary); display:inline-flex; align-items:center; justify-content:center; width:24px; height:24px; flex-shrink: 0; margin-top: 2px;'><svg class='icon-svg' style='width:16px;height:16px;' aria-hidden='true'><use href='#" + iconName + "'/></svg></span>";
            html += "  <div style='display: flex; flex-direction: column; gap: 6px; flex: 1; min-width: 0;'>";
            html += "    <span style='font-weight: 600; font-size: 13px; color: var(--text); word-break: break-word; line-height: 1.4;'>" + task.name + "</span>";
            html += "    <div style='display: flex; flex-wrap: wrap; gap: 4px; align-items: center;'>" + getTaskMetaBadgesHTML(task) + "</div>";
            html += "  </div>";
            html += "  <span class='item-actions' style='margin-top: 2px;'>";
            html += "    <button class='edit-btn' data-task-id='" + task.id + "' data-is-bonus='true' title='" + __('edit') + "'>✏️</button>";
            html += "    <button class='delete-btn' data-task-id='" + task.id + "' data-is-bonus='true' title='" + __('edit') + "'>🗑️</button>";
            html += "  </span>";
            html += "</li>";
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
                if (req.reason) html += "<div style='margin-bottom:4px;'><strong style='color:var(--text);'>📝 " + (__('common.reason')) + ":</strong> " + req.reason + "</div>";
                if (req.photo) html += "<img src='" + req.photo + "' style='max-width:150px; border-radius:6px; margin-top:4px; display:block; cursor:zoom-in;' onclick='openImageZoomModal(\"" + req.photo + "\")'>";
                html += "</div>";
            }
            html += "</li>";
        });
        html += "</ul>";
        html += "</div>";
    }

    // ---- Dreams Management Section ----
    if (!selectedChild.dreams) selectedChild.dreams = [];
    
    html += "<div class='section-card' style='margin-top: 15px;'>";
    html += "<h4 style='display:flex;align-items:center;gap:6px;'><svg class='icon-svg' aria-hidden='true' style='width:16px;height:16px;color:var(--secondary);'><use href='#icon-sparkle'/></svg> " + __('dream.manage_title') + "</h4>";
    if (selectedChild.dreams.length > 0) {
        html += "<ul class='item-list' style='margin-top:10px;list-style:none;padding:0;'>";
        selectedChild.dreams.forEach(function(dream) {
            var isApproved = dream.approved !== false && (dream.costGold > 0 || dream.costStars > 0);
            
            html += "<li style='display:flex; flex-direction:column; padding:10px 0; border-bottom:1px solid rgba(0,0,0,0.05);'>";
            html += "<div style='display:flex; justify-content:space-between; align-items:center; width:100%;'>";
            html += "<span>🌟 <strong>" + dream.name + "</strong>" + (dream.achieved ? " (✅ " + __('dream.achieved_label') + ")" : "") + "</span>";
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
                html += "❌ " + __('dream.rejected_short') + ' (' + __('common.reason') + ': ' + (dream.parentComment || __('common.not_specified')) + ")";
                html += "</div>";
            }

            if (!dream.achieved) {
                var btnLabel = __('task_form.save');
                var showReject = false;
                if (dream.approved === false) {
                    btnLabel = __('parent.approve_btn');
                    showReject = true;
                } else if (dream.approved === 'rejected') {
                    btnLabel = __('parent.approve_btn');
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
                    html += "<button class='parent-reject-dream-btn btn btn-danger' data-dream-id='" + dream.id + "' style='padding:4px 8px; font-size:12px; height:30px; line-height:20px;'>" + (__('parent.reject')) + "</button>";
                }
                html += "</div>";
            } else {
                html += "<div style='margin-top:4px; font-size:12px; color:var(--text-light);'>" + __('dream.cost_label') + " 🪙 " + dream.costGold + ", ⭐ " + dream.costStars + "</div>";
            }
            
            html += "</li>";
        });
        html += "</ul>";
    } else {
        const ctaBtn = `<button class="btn btn-secondary btn-empty-parent-add-dream" style="padding: 8px 16px; font-size: 13px; background: rgba(124, 58, 237, 0.1); color: var(--primary); border: 1px solid rgba(124, 58, 237, 0.2);">${__('empty_state.parent_no_dreams_cta')}</button>`;
        html += getEmptyStateHTML('🌟', __('empty_state.parent_no_dreams'), ctaBtn);
    }
    html += "</div>";

    // Rewards & Punishments Section
    if (!selectedChild.rewardsPunishments) selectedChild.rewardsPunishments = [];
    if (selectedChild.rewardsPunishments.length > 0) {
        html += "<div class='section-card' style='margin-top:15px;'>";
        html += "<h4 style='display:flex;align-items:center;gap:6px;'><svg class='icon-svg' aria-hidden='true' style='width:16px;height:16px;color:var(--primary);'><use href='#icon-gift'/></svg> " + (__('parent.revpun_title') || 'Таърихи мукофот ва ҷаримаҳо') + "</h4>";
        html += "<ul class='item-list' style='margin-top:10px;list-style:none;padding:0;'>";
        // Sort: pending & disputed first, then accepted, then by timestamp descending
        const sortedRevPuns = [...selectedChild.rewardsPunishments].sort((a, b) => {
            if (a.status !== 'accepted' && b.status === 'accepted') return -1;
            if (a.status === 'accepted' && b.status !== 'accepted') return 1;
            return b.timestamp - a.timestamp;
        });

        sortedRevPuns.forEach(function(item) {
            const isReward = item.type === 'reward';
            const sym = isReward ? '🟢' : '🔴';
            const statusLabel = item.status === 'pending' 
                ? `<span style='color:var(--text-light); font-weight:600;'>⌛ Интизор</span>` 
                : item.status === 'disputed' 
                    ? `<span style='color:var(--warning); font-weight:700;'>⚠️ Баҳс</span>` 
                    : `<span style='color:var(--success); font-weight:600;'>✅ Қабул шуд</span>`;

            const typeLabel = isReward ? (__('revpun.reward_label') || 'Мукофот') : (__('revpun.punish_label') || 'Ҷарима');
            const starsText = item.stars > 0 ? `⭐ ${isReward ? '+' : '-'}${item.stars} ` : '';
            const goldText = item.gold > 0 ? `🪙 ${isReward ? '+' : '-'}${item.gold}` : '';
            const valueText = `${starsText}${goldText}`.trim();

            html += "<li style='display:flex; flex-direction:column; padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.05);'>";
            html += "<div style='display:flex; justify-content:space-between; align-items:center; width:100%; gap: 8px;'>";
            html += "<span>" + sym + " <strong>" + item.title + "</strong> (" + typeLabel + ")</span>";
            html += "<div style='display:flex; align-items:center; gap:8px;'>";
            html += statusLabel;
            html += "<button class='parent-delete-revpun-btn' data-id='" + item.id + "' style='background:none; border:none; cursor:pointer;' title='Нез'>🗑️</button>";
            html += "</div></div>";

            if (item.description) {
                html += "<div style='font-size:12px; color:var(--text-light); margin-top:2px; line-height:1.4;'>" + item.description + "</div>";
            }
            if (valueText) {
                html += "<div style='font-size:12px; color:var(--text-secondary); margin-top:4px;'>Таъсир: <strong style='color: " + (isReward ? 'var(--success)' : 'var(--danger)') + ";'>" + valueText + "</strong></div>";
            }
            if (item.photo) {
                html += "<div style='margin-top:6px; border-radius:6px; overflow:hidden; max-height:80px; width:fit-content; cursor:zoom-in;' onclick='openImageZoomModal(\"" + item.photo + "\")'>";
                html += "<img src='" + item.photo + "' style='max-height:80px; border-radius:6px; object-fit:cover;'>";
                html += "</div>";
            }

            if (item.status === 'disputed') {
                html += "<div style='font-size: 12px; color: var(--warning); font-style: italic; margin-top: 6px; font-weight: 500; background: rgba(245, 158, 11, 0.08); padding: 6px; border-radius: 6px; border-left: 3px solid var(--warning);'>";
                html += "💬 Сабаби баҳс: " + item.disputeReason;
                html += "</div>";
            }

            if (item.status === 'pending' || item.status === 'disputed') {
                html += "<div style='margin-top:8px; display:flex; gap:8px;'>";
                html += "<button class='parent-enforce-revpun-btn btn btn-primary' data-id='" + item.id + "' style='padding:4px 8px; font-size:12px; height:28px; line-height:18px;'>⚖️ Татбиқ кардан</button>";
                html += "<button class='parent-cancel-revpun-btn btn btn-danger' data-id='" + item.id + "' style='padding:4px 8px; font-size:12px; height:28px; line-height:18px;'>❌ Бекор кардан</button>";
                html += "</div>";
            }

            html += "</li>";
        });
        html += "</ul>";
        html += "</div>";
    }

    html += "</div>"; // close parent-task-section

    // Bottom Exit Button
    html += "<div style='margin-top: 24px; display: flex; justify-content: center; padding-bottom: 24px;'>";
    html += "  <button class='btn btn-outline' id='btn-exit-parent' style='width: 100%; max-width: 260px; height: 44px; display: flex; align-items: center; justify-content: center; gap: 8px; color: var(--danger); border-color: var(--danger); font-weight: 600; font-size: 14px;'>";
    html += "    <svg class='icon-svg' style='width:14px;height:14px;' aria-hidden='true'><use href='#icon-x'/></svg> " + (__('parent.exit') || 'Баромадан') + "</button>";
    html += "</div>";

    html += "</div>"; // close parent-overview

    container.innerHTML = html;

    // ---- Floating Settings FAB + Bottom-Sheet Modal ----
    var pageParent = document.getElementById('page-parent');
    // Remove stale FAB/modal from previous renders

    // ---- Attach event listeners ----

    // Exit Parent Dashboard
    var exitBtn = container.querySelector('#btn-exit-parent');
    if (exitBtn) {
        exitBtn.addEventListener('click', function() {
            parentPinVerified = false;
            navigateTo('routine');
        });
    }

    // Confirm awaiting tasks (Approve)
    container.querySelectorAll('.parent-direct-confirm-task-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var taskId = this.dataset.taskId;
            var task = selectedChild.tasks.find(t => t.id === taskId) || selectedChild.bonusTasks.find(t => t.id === taskId);
            if (task) {
                if (task.hasTest) {
                    showConfirmModal(task);
                } else {
                    confirmTaskDirectly(taskId);
                }
            }
        });
    });

    // Reject awaiting tasks (Reject)
    container.querySelectorAll('.parent-direct-reject-task-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var taskId = this.dataset.taskId;
            var task = selectedChild.tasks.find(t => t.id === taskId) || selectedChild.bonusTasks.find(t => t.id === taskId);
            if (task) {
                showParentRejectModal(task);
            }
        });
    });

    // Approve skip request
    container.querySelectorAll('.parent-approve-skip-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var taskId = this.dataset.taskId;
            approveSkipRequest(selectedChild.id, taskId);
        });
    });

    // Reject skip request
    container.querySelectorAll('.parent-reject-skip-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var taskId = this.dataset.taskId;
            rejectSkipRequest(selectedChild.id, taskId);
        });
    });

    // View skip photo
    container.querySelectorAll('.parent-view-skip-photo-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var photoUrl = decodeURIComponent(this.dataset.photo);
            showImagePreview(photoUrl);
        });
    });

    // Revoke badge
    container.querySelectorAll('.parent-revoke-badge-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var id = this.dataset.id;
            showBadgeRevokeModal(id, function() {
                renderParentDashboard();
            });
        });
    });

    // Add task
    container.querySelector('.btn-parent-add-task').addEventListener('click', function() {
        showTaskModal(null, false);
    });

    const emptyAddTaskBtn = container.querySelector('.btn-empty-parent-add-task');
    if (emptyAddTaskBtn) {
        emptyAddTaskBtn.addEventListener('click', function() {
            showTaskModal(null, false);
        });
    }

    const emptyAddDreamBtn = container.querySelector('.btn-empty-parent-add-dream');
    if (emptyAddDreamBtn) {
        emptyAddDreamBtn.addEventListener('click', function() {
            showParentAddDreamModal();
        });
    }

    // Add reward/punishment
    const addRevPunBtn = container.querySelector('.btn-parent-add-rev-pun');
    if (addRevPunBtn) {
        addRevPunBtn.addEventListener('click', function() {
            showParentRevPunModal();
        });
    }

    // Complete today's failed/missed tasks directly
    container.querySelectorAll('.parent-complete-today-task-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var taskId = this.dataset.taskId;
            completePastTask(selectedChild.id, getToday(), taskId);
        });
    });

    // Excuse today's tasks
    container.querySelectorAll('.parent-excuse-today-task-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var taskId = this.dataset.taskId;
            showCustomPrompt(
                __('parent.excuse_title') || 'Узрнок',
                __('parent.excuse_reason_prompt') || 'Сабаби узрнокро ворид кунед (Уважительная причина):'
            ).then(result => {
                if (result === null) return;
                const text = (result.text || '').trim();
                const photo = result.photo || null;
                if (!text) {
                    showToast('⚠️', 'Лутфан сабаби узрнокро нависед!');
                    return;
                }
                excusePastTask(selectedChild.id, getToday(), taskId, text, photo);
            });
        });
    });

    // Rewards & Punishments Enforce/Cancel/Delete listeners
    container.querySelectorAll('.parent-enforce-revpun-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var id = this.dataset.id;
            enforceRewardPunishment(id);
        });
    });

    container.querySelectorAll('.parent-cancel-revpun-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var id = this.dataset.id;
            cancelRewardPunishment(id);
        });
    });

    container.querySelectorAll('.parent-delete-revpun-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (confirm('Оё мехоҳед ин амалро нест кунед?')) {
                var id = this.dataset.id;
                cancelRewardPunishment(id);
            }
        });
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
                if (typeof syncDailyLogTasks === 'function') {
                    syncDailyLogTasks(selectedChild, getToday());
                }
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
            var child = selectedChild;
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
            showToast('✅', __('balance.status.approved') || 'Тасдиқ шуд');
            renderParentDashboard();
            updateUI();
        });
    });

    // Reject withdraw request
    container.querySelectorAll('.parent-reject-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var reqId = this.dataset.reqId;
            var child = selectedChild;
            var req = child.withdrawals.find(function(w) { return w.id === reqId; });
            if (!req) return;

            showCustomPrompt(__('parent.reject_withdraw_title') || 'Рад кардани ихроҷ').then(function(result) {
                if (result === null) return; // parent cancelled prompt
                req.status = 'rejected';
                req.parentComment = (result.text || '').trim();
                if (result.photo) req.parentPhoto = result.photo;
                saveState();
                showToast('❌', __('balance.status.rejected') || 'Рад шуд');
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
            const langs = ['tg','ru','en','uz','kk','ky','tk'];
            const next = langs[(langs.indexOf(currentLang) + 1) % langs.length];
            setLanguage(next);
            localizeDefaultTaskNames();
            saveState();
            parentPinVerified = true;
            updateLanguageUI();
            applyStaticTranslations();
            updateUI();
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
                showToast('⚠️', __('dream.price_not_set'));
                return;
            }
            
            var dream = selectedChild.dreams.find(function(d) { return d.id === dreamId; });
            if (dream) {
                dream.costGold = goldCost;
                dream.costStars = starsCost;
                dream.approved = true;
                saveState();
                showToast('✨', __('dream.price_set_toast'));
                renderParentDashboard();
            }
        });
    });

    // Dreams: Reject Dream
    container.querySelectorAll('.parent-reject-dream-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var dreamId = this.dataset.dreamId;
            showCustomPrompt(__('parent.reject_reason_prompt_btn')).then(function(result) {
                if (result === null) return;
                var dream = selectedChild.dreams.find(function(d) { return d.id === dreamId; });
                if (dream) {
                    dream.approved = 'rejected';
                    dream.parentComment = (result.text || '').trim();
                    if (result.photo) dream.parentPhoto = result.photo;
                    saveState();
                    showToast('❌', __('dream.rejected_toast'));
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
                showToast('🗑️', __('dream.deleted')+'!');
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


    // Settings: Reset Data
    var resetItem = document.querySelector('.parent-settings-reset');
    if (resetItem) {
        resetItem.addEventListener('click', function() {
            document.getElementById('parent-settings-modal').style.display = 'none';
            if (confirm(__('settings.reset_data_confirm'))) {
                safeStorage.removeItem(STORAGE_KEY);
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
            typeSelect.innerHTML += `<option value="money">${__('reward_type.money')} (${child.balance})</option>`;
        }
        if ((child.stars || 0) > 0) {
            typeSelect.innerHTML += `<option value="stars">${__('reward_type.stars')} (${child.stars || 0})</option>`;
        }
        if (typeSelect.options.length === 0) {
            typeSelect.innerHTML = `<option value="money">${__('reward_type.money')} (0)</option><option value="stars">${__('reward_type.stars')} (0)</option>`;
        }
        typeSelect.selectedIndex = 0;
    } else {
        typeGroup.classList.add('hidden');
        typeSelect.innerHTML = rt === 'stars' 
            ? `<option value="stars">${__('reward_type.stars')}</option>` 
            : `<option value="money">${__('reward_type.money')}</option>`;
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
        const ctaBtn = `<button class="btn btn-primary" id="btn-empty-view-tasks" style="padding: 8px 16px; font-size: 13px;">${__('empty_state.child_no_withdrawals_cta')}</button>`;
        container.innerHTML = getEmptyStateHTML('🪙', __('empty_state.child_no_withdrawals'), ctaBtn);
        const routeBtn = document.getElementById('btn-empty-view-tasks');
        if (routeBtn) {
            routeBtn.addEventListener('click', () => {
                navigateTo('routine');
            });
        }
        return;
    }

    let html = '';
    html += `<ul class="item-list" style="list-style:none;padding:0;">`;
    
    const sorted = [...child.withdrawals].sort((a, b) => b.id.localeCompare(a.id));
    
    sorted.forEach((req, index) => {
        let sym = req.type === 'stars' ? '⭐' : '🪙';
        let statusBadge = '';
        let isRejected = req.status === 'rejected';
        
        if (req.status === 'pending') {
            statusBadge = `<span style="font-size:11px;background:rgba(245,158,11,0.1);color:#F59E0B;padding:2px 6px;border-radius:4px;">${__('balance.status.pending')}</span>`;
        } else if (req.status === 'approved') {
            statusBadge = `<span style="font-size:11px;background:rgba(16,185,129,0.1);color:#10B981;padding:2px 6px;border-radius:4px;">${__('balance.status.approved')}</span>`;
        } else {
            statusBadge = `<span style="font-size:11px;background:rgba(239,68,68,0.1);color:#EF4444;padding:2px 6px;border-radius:4px;">${__('balance.status.rejected')}</span>`;
        }

        let hiddenClass = index >= 5 ? ' hidden extra-withdrawal' : '';
        
        if (isRejected) {
            html += `<li class="withdrawal-item${hiddenClass}" style="background: rgba(239, 68, 68, 0.04); border: 1.5px solid rgba(239, 68, 68, 0.15); border-radius: 12px; padding: 12px; margin-bottom: 10px; display: flex !important; flex-direction: column !important; align-items: stretch !important; justify-content: flex-start !important;">`;
            html += `<div style="display:flex; justify-content:space-between; align-items:center; width:100%; gap: 12px; margin-bottom: 8px;">`;
            html += `<span>⏱ ${formatDate(req.date)} — <strong style="font-size:15px;color:#FCD34D;">${req.amount} ${sym}</strong></span>`;
            html += `<div style="display:flex; align-items:center; gap:8px;">`;
            html += `${statusBadge}`;
            html += `<button class="delete-rejected-withdraw-btn" data-req-id="${req.id}" style="background: rgba(255,255,255,0.05); border: none; color: var(--text-secondary); font-size: 13px; cursor: pointer; padding: 4px 8px; border-radius: 6px; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.color='var(--danger)'; this.style.background='rgba(239,68,68,0.1)'" onmouseout="this.style.color='var(--text-secondary)'; this.style.background='rgba(255,255,255,0.05)'">✕</button>`;
            html += `</div>`;
            html += `</div>`;
            if (req.reason || req.photo || req.parentComment) {
                html += `<div style="margin-top:2px; font-size:13px; color:var(--text-secondary); background: rgba(0,0,0,0.15); padding: 8px; border-radius: 6px; word-break: break-word; line-height: 1.4;">`;
                if (req.reason) html += `<div style="margin-bottom:4px;"><strong style="color:var(--text);">📝 ${__('common.reason') || 'Сабаб'}:</strong> ${req.reason}</div>`;
                if (req.parentComment) {
                    html += `<div style="margin-bottom:4px; color:#EF4444;"><strong style="color:#EF4444;">${__('task.parent_reply') || '💬 Ҷавоби волидон:'}</strong> ${req.parentComment}</div>`;
                }
                if (req.photo) html += `<img src="${req.photo}" style="max-width:150px; border-radius:6px; margin-top:4px; display:block; cursor:zoom-in;" onclick="openImageZoomModal('${req.photo}')">`;
                html += `</div>`;
            }
            html += `</li>`;
        } else {
            html += `<li class="withdrawal-item${hiddenClass}" style="display:flex; flex-direction:column; padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.05); margin-bottom: 5px;">`;
            html += `<div style="display:flex; justify-content:space-between; align-items:center; width:100%;">`;
            html += `<span>⏱ ${formatDate(req.date)} — <strong style="font-size:15px;color:#FCD34D;">${req.amount} ${sym}</strong></span>`;
            html += `<div>${statusBadge}</div>`;
            html += `</div>`;
            if (req.reason || req.photo) {
                html += `<div style="margin-top:8px; font-size:13px; color:var(--text-secondary); background: rgba(0,0,0,0.1); padding: 8px; border-radius: 6px;">`;
                if (req.reason) html += `<div style="margin-bottom:4px;"><strong style="color:var(--text);">📝 ${__('common.reason') || 'Сабаб'}:</strong> ${req.reason}</div>`;
                if (req.photo) html += `<img src="${req.photo}" style="max-width:150px; border-radius:6px; margin-top:4px; display:block; cursor:zoom-in;" onclick="openImageZoomModal('${req.photo}')">`;
                html += `</div>`;
            }
            html += `</li>`;
        }
    });
    
    html += `</ul>`;
    
    if (sorted.length > 5) {
        html += `<button class="btn btn-secondary btn-full" id="toggle-withdrawals-btn" style="margin-top:10px; background:transparent; border:1px solid rgba(255,255,255,0.1); color:var(--text-secondary);">${__('common.show_all')}</button>`;
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
            toggleBtn.textContent = isHidden ? (__('common.hide')) : (__('common.show_all'));
        });
    }

    // Attach delete rejected withdrawal listeners
    container.querySelectorAll('.delete-rejected-withdraw-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const reqId = this.dataset.reqId;
            const child = getCurrentChild();
            const idx = child.withdrawals.findIndex(w => w.id === reqId);
            if (idx !== -1) {
                if (confirm(__('withdraw.delete_confirm') || 'Оё мехоҳед ин таърихи радшударо нест кунед?')) {
                    child.withdrawals.splice(idx, 1);
                    saveState();
                    renderWithdrawalHistory();
                }
            }
        });
    });
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
    hideLoadingScreen();
    const overlay = document.getElementById('welcome-screen');
    overlay.classList.remove('hidden');

    const startBtn = document.getElementById('welcome-start-btn');

    // Pre-select saved language, or default to English
    const savedLang = (state && state.language && state.language !== 'en' && state.language !== '') 
        ? state.language 
        : (window._isFirstLaunch ? 'en' : (state && state.language) || 'en');
    welcomeSelectedLang = savedLang;
    setLanguage(savedLang);
    applyStaticTranslations();
    startBtn.classList.add('active');
    document.querySelectorAll('.welcome-lang-btn').forEach(b => b.classList.remove('selected'));
    const savedBtn = document.getElementById('welcome-btn-' + savedLang);
    if (savedBtn) savedBtn.classList.add('selected');

    // Update welcome screen text to saved/default language
    document.getElementById('welcome-greeting').textContent = __('welcome.title');
    document.getElementById('welcome-subtitle').textContent = __('welcome.subtitle');
    document.getElementById('welcome-lang-label').textContent = __('welcome.select_language');
    document.getElementById('welcome-start-text').textContent = __('welcome.start');
    document.getElementById('welcome-title').textContent = __('app.name');
    document.title = __('app.title');

    // Language button selection
    document.querySelectorAll('.welcome-lang-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.welcome-lang-btn').forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            welcomeSelectedLang = btn.dataset.lang;
            startBtn.classList.add('active');

            // Immediately save selection to localStorage
            safeStorage.setItem('kids_tasks_onboarding_lang', welcomeSelectedLang);
            if (state) {
                state.language = welcomeSelectedLang;
                saveState(false);
            }

            // Update welcome UI text in the selected language (but keep native names on buttons)
            setLanguage(welcomeSelectedLang);
            applyStaticTranslations();
            document.getElementById('welcome-greeting').textContent = __('welcome.title');
            document.getElementById('welcome-subtitle').textContent = __('welcome.subtitle');
            document.getElementById('welcome-lang-label').textContent = __('welcome.select_language');
            document.getElementById('welcome-start-text').textContent = __('welcome.start');
            document.getElementById('welcome-title').textContent = __('app.name');
            document.title = __('app.title');
        });
    });

    // Start button
    startBtn.addEventListener('click', async () => {
        if (!welcomeSelectedLang) return;

        // Set the language permanently
        setLanguage(welcomeSelectedLang);
        state.language = welcomeSelectedLang;
        saveState();

        // Hide welcome screen
        overlay.classList.add('hidden');
        window._isFirstLaunch = false;
        
        // Always route to onboarding carousel first
        showOnboardingCarousel(false);
    });
}

// ===== ONBOARDING CAROUSEL =====
let currentOnboardingSlide = 0;

function showOnboardingCarousel(isReplay = false) {
    const screen = document.getElementById('onboarding-screen');
    if (!screen) return;

    screen.classList.remove('hidden');
    currentOnboardingSlide = 0;
    updateOnboardingSlide(isReplay);

    // Get buttons
    const nextBtn = document.getElementById('onboarding-next-btn');
    const skipBtn = document.getElementById('onboarding-skip-btn');

    // Re-bind click handlers by cloning to clean up old event listeners
    const newNextBtn = nextBtn.cloneNode(true);
    nextBtn.parentNode.replaceChild(newNextBtn, nextBtn);
    const newSkipBtn = skipBtn.cloneNode(true);
    skipBtn.parentNode.replaceChild(newSkipBtn, skipBtn);

    newNextBtn.addEventListener('click', () => {
        if (currentOnboardingSlide < 3) {
            currentOnboardingSlide++;
            updateOnboardingSlide(isReplay);
        } else {
            closeOnboarding(isReplay, true);
        }
    });

    newSkipBtn.addEventListener('click', () => {
        closeOnboarding(isReplay, false);
    });

    // Handle dots click
    document.querySelectorAll('.onboarding-dot').forEach((dot, idx) => {
        const newDot = dot.cloneNode(true);
        dot.parentNode.replaceChild(newDot, dot);
        newDot.addEventListener('click', () => {
            currentOnboardingSlide = idx;
            updateOnboardingSlide(isReplay);
        });
    });
}

function updateOnboardingSlide(isReplay) {
    const slides = document.querySelectorAll('.onboarding-slide');
    const dots = document.querySelectorAll('.onboarding-dot');

    slides.forEach((slide, idx) => {
        slide.classList.remove('active', 'prev-slide');
        if (idx === currentOnboardingSlide) {
            slide.classList.add('active');
            slide.scrollTop = 0; // Reset scroll position to top when slide becomes active
        } else if (idx < currentOnboardingSlide) {
            slide.classList.add('prev-slide');
        }
    });

    dots.forEach((dot, idx) => {
        if (idx === currentOnboardingSlide) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });

    const nextText = document.getElementById('onboarding-next-text');
    if (nextText) {
        if (currentOnboardingSlide === 3) {
            nextText.textContent = __('onboarding.btn.get_started');
        } else {
            nextText.textContent = __('onboarding.btn.next');
        }
    }
}

function closeOnboarding(isReplay, didComplete = false) {
    const screen = document.getElementById('onboarding-screen');
    if (screen) {
        screen.classList.add('hidden');
    }
    if (!isReplay) {
        if (didComplete) {
            safeStorage.setItem('kids_tasks_has_seen_onboarding', 'true');
            safeStorage.setItem('hasSeenOnboarding', 'true');
        }
        initSupabase();
        checkAuthAndSetup();
    }
}


// ===== EVENT LISTENERS =====
function setupEventListeners() {
    // 5-click logo gesture for Parent settings on Child device
    let logoClicks = 0;
    let logoClickTimer = null;
    const headerLogo = document.querySelector('.logo') || document.getElementById('app-title');
    if (headerLogo) {
        headerLogo.style.cursor = 'pointer';
        headerLogo.addEventListener('click', () => {
            logoClicks++;
            clearTimeout(logoClickTimer);
            logoClickTimer = setTimeout(() => { logoClicks = 0; }, 3000);
            
            if (logoClicks === 5) {
                window.__pendingParentAuth = true;
                const pinModal = document.getElementById('pin-modal');
                if (pinModal) {
                    pinModal.classList.remove('hidden');
                    const pinInput = document.getElementById('pin-input');
                    if (pinInput) {
                        pinInput.value = '';
                        pinInput.focus();
                    }
                    const pinError = document.getElementById('pin-error');
                    if (pinError) pinError.classList.add('hidden');
                }
            } else if (logoClicks >= 10) {
                logoClicks = 0;
                if (confirm('Сбросить все данные и перезагрузить? / Тоза кардани кэш ва маълумот?')) {
                    safeStorage.clear();
                    safeSessionStorage.clear();
                    location.reload();
                }
            }
        });
    }
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

    // Skip photo upload
    document.getElementById('skip-photo-btn').addEventListener('click', () => {
        document.getElementById('skip-photo-input').click();
    });
    document.getElementById('skip-photo-input').addEventListener('change', handleSkipPhotoUpload);
    document.getElementById('skip-photo-remove').addEventListener('click', () => {
        document.getElementById('skip-photo-preview').classList.add('hidden');
        document.getElementById('skip-photo-img').src = '';
        document.getElementById('skip-photo-input').value = '';
        document.getElementById('skip-photo-btn').classList.remove('hidden');
    });

    // Confirm reject photo upload
    document.getElementById('confirm-reject-photo-btn').addEventListener('click', () => {
        document.getElementById('confirm-reject-photo-input').click();
    });
    document.getElementById('confirm-reject-photo-input').addEventListener('change', handleConfirmRejectPhotoUpload);
    document.getElementById('confirm-reject-photo-remove').addEventListener('click', () => {
        document.getElementById('confirm-reject-photo-preview').classList.add('hidden');
        document.getElementById('confirm-reject-photo-img').src = '';
        document.getElementById('confirm-reject-photo-input').value = '';
        document.getElementById('confirm-reject-photo-btn').classList.remove('hidden');
    });

    // Parent reply photo upload
    document.getElementById('parent-reply-photo-btn').addEventListener('click', () => {
        document.getElementById('parent-reply-photo-input').click();
    });
    document.getElementById('parent-reply-photo-input').addEventListener('change', handleParentReplyPhotoUpload);
    document.getElementById('parent-reply-photo-remove').addEventListener('click', () => {
        document.getElementById('parent-reply-photo-preview').classList.add('hidden');
        document.getElementById('parent-reply-photo-img').src = '';
        document.getElementById('parent-reply-photo-input').value = '';
        document.getElementById('parent-reply-photo-btn').classList.remove('hidden');
    });

    // Prompt-modal photo upload
    document.getElementById('prompt-modal-photo-btn').addEventListener('click', () => {
        document.getElementById('prompt-modal-photo-input').click();
    });
    document.getElementById('prompt-modal-photo-input').addEventListener('change', handleGenericPhotoUpload(
        'prompt-modal-photo-img', 'prompt-modal-photo-preview', 'prompt-modal-photo-btn', 'prompt-modal-photo-input'
    ));
    document.getElementById('prompt-modal-photo-remove').addEventListener('click', () => {
        document.getElementById('prompt-modal-photo-preview').classList.add('hidden');
        document.getElementById('prompt-modal-photo-img').src = '';
        document.getElementById('prompt-modal-photo-input').value = '';
        document.getElementById('prompt-modal-photo-btn').classList.remove('hidden');
    });

    // Restore-skip-modal photo upload
    document.getElementById('restore-skip-photo-btn').addEventListener('click', () => {
        document.getElementById('restore-skip-photo-input').click();
    });
    document.getElementById('restore-skip-photo-input').addEventListener('change', handleGenericPhotoUpload(
        'restore-skip-photo-img', 'restore-skip-photo-preview', 'restore-skip-photo-btn', 'restore-skip-photo-input'
    ));
    document.getElementById('restore-skip-photo-remove').addEventListener('click', () => {
        document.getElementById('restore-skip-photo-preview').classList.add('hidden');
        document.getElementById('restore-skip-photo-img').src = '';
        document.getElementById('restore-skip-photo-input').value = '';
        document.getElementById('restore-skip-photo-btn').classList.remove('hidden');
    });

    // Parent reply modal close
    document.getElementById('parent-reply-close').addEventListener('click', () => {
        document.getElementById('parent-reply-modal').classList.add('hidden');
    });
    document.getElementById('parent-reply-submit-btn').addEventListener('click', submitParentReply);

    // Badge revoke photo upload
    document.getElementById('badge-revoke-photo-btn').addEventListener('click', () => {
        document.getElementById('badge-revoke-photo-input').click();
    });
    document.getElementById('badge-revoke-photo-input').addEventListener('change', handleBadgeRevokePhotoUpload);
    document.getElementById('badge-revoke-photo-remove').addEventListener('click', () => {
        document.getElementById('badge-revoke-photo-preview').classList.add('hidden');
        document.getElementById('badge-revoke-photo-img').src = '';
        document.getElementById('badge-revoke-photo-input').value = '';
        document.getElementById('badge-revoke-photo-btn').classList.remove('hidden');
    });

    // Badge revoke modal close
    document.getElementById('badge-revoke-close').addEventListener('click', () => {
        document.getElementById('badge-revoke-modal').classList.add('hidden');
    });
    document.getElementById('badge-revoke-submit-btn').addEventListener('click', submitBadgeRevoke);


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
    document.getElementById('confirm-reject').addEventListener('click', submitReject);
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

    // Image preview modal close
    document.getElementById('image-preview-close').addEventListener('click', () => {
        document.getElementById('image-preview-modal').classList.add('hidden');
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
    const clearEndBtn = document.getElementById('clear-daily-end-time');
    if (clearEndBtn) {
        clearEndBtn.addEventListener('click', () => {
            setFlatpickrValue('task-daily-end-time', '');
        });
    }

    const modalCancelBtn = document.getElementById('task-modal-cancel');
    if (modalCancelBtn) {
        modalCancelBtn.addEventListener('click', () => {
            document.getElementById('task-modal').classList.add('hidden');
        });
    }
    const taskModalCloseBtn = document.getElementById('task-modal-close');
    if (taskModalCloseBtn) {
        taskModalCloseBtn.addEventListener('click', () => {
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
    var forgotBtn = document.getElementById('settings-pin-forgot');
    if (forgotBtn) forgotBtn.addEventListener('click', recoverPin);
    document.getElementById('settings-pin-input').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') verifySettingsPin();
    });
    document.getElementById('settings-pin-close').addEventListener('click', () => {
        document.getElementById('settings-pin-modal').classList.add('hidden');
    });

    // User Guide Help Modal Close & Tabs
    const helpCloseBtn = document.getElementById('help-modal-close');
    if (helpCloseBtn) {
        helpCloseBtn.addEventListener('click', () => {
            document.getElementById('help-modal').classList.add('hidden');
        });
    }

    document.querySelectorAll('.help-tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.help-tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.help-tab-content').forEach(c => c.classList.remove('active'));
            
            btn.classList.add('active');
            const tabId = btn.getAttribute('data-tab');
            const content = document.getElementById(tabId);
            if (content) {
                content.classList.add('active');
            }
        });
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

    // Auto submit on 4 digits — confirm-pin excluded (has both confirm and reject buttons)
    document.querySelectorAll('.pin-input').forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.length === 4) {
                if (this.id === 'settings-pin-input') verifySettingsPin();
                else if (this.id === 'pin-input') document.getElementById('pin-submit').click();
                // confirm-pin: do NOT auto-submit — user must click confirm or reject manually
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

    // Gentle Nudge start button
    const nudgeStartBtn = document.getElementById('nudge-start-btn');
    if (nudgeStartBtn) {
        nudgeStartBtn.addEventListener('click', () => {
            const task = window._activeNudgeTask;
            if (task && currentChildId) {
                closeNudgeModal();
                showTimer(currentChildId, task);
            }
        });
    }

    // Parent Reward/Punishment Modal Event Listeners
    const btnReward = document.getElementById('parent-rev-pun-type-reward');
    const btnPunish = document.getElementById('parent-rev-pun-type-punish');
    if (btnReward && btnPunish) {
        btnReward.addEventListener('click', () => {
            parentRevPunType = 'reward';
            btnReward.className = 'btn btn-primary';
            btnReward.style.background = '';
            btnReward.style.borderColor = '';
            btnReward.style.color = '';
            
            btnPunish.className = 'btn btn-outline';
            btnPunish.style.background = 'transparent';
            btnPunish.style.borderColor = 'var(--danger)';
            btnPunish.style.color = 'var(--danger)';

            const sInput = document.getElementById('parent-rev-pun-stars');
            const gInput = document.getElementById('parent-rev-pun-gold');
            if (sInput) {
                sInput.classList.remove('punish-input-mode');
                sInput.placeholder = '0';
            }
            if (gInput) {
                gInput.classList.remove('punish-input-mode');
                gInput.placeholder = '0';
            }
            const sSym = document.getElementById('parent-rev-pun-stars-sym');
            const gSym = document.getElementById('parent-rev-pun-gold-sym');
            if (sSym) {
                sSym.textContent = '⭐';
                sSym.style.color = '';
            }
            if (gSym) {
                gSym.textContent = '🪙';
                gSym.style.color = '';
            }
        });
        btnPunish.addEventListener('click', () => {
            parentRevPunType = 'punish';
            btnPunish.className = 'btn btn-danger';
            btnPunish.style.background = 'var(--danger)';
            btnPunish.style.borderColor = 'var(--danger)';
            btnPunish.style.color = '#fff';
            
            btnReward.className = 'btn btn-outline';
            btnReward.style.background = 'transparent';
            btnReward.style.borderColor = 'var(--success)';
            btnReward.style.color = 'var(--success)';

            const sInput = document.getElementById('parent-rev-pun-stars');
            const gInput = document.getElementById('parent-rev-pun-gold');
            if (sInput) {
                sInput.classList.add('punish-input-mode');
                sInput.placeholder = '-0';
            }
            if (gInput) {
                gInput.classList.add('punish-input-mode');
                gInput.placeholder = '-0';
            }
            const sSym = document.getElementById('parent-rev-pun-stars-sym');
            const gSym = document.getElementById('parent-rev-pun-gold-sym');
            if (sSym) {
                sSym.textContent = '-⭐';
                sSym.style.color = 'var(--danger)';
            }
            if (gSym) {
                gSym.textContent = '-🪙';
                gSym.style.color = 'var(--danger)';
            }
        });
    }

    const rpClose = document.getElementById('parent-rev-pun-close');
    if (rpClose) rpClose.addEventListener('click', closeParentRevPunModal);

    const rpPhotoBtn = document.getElementById('parent-rev-pun-photo-btn');
    if (rpPhotoBtn) {
        rpPhotoBtn.addEventListener('click', () => {
            document.getElementById('parent-rev-pun-photo-input').click();
        });
    }

    const rpPhotoInput = document.getElementById('parent-rev-pun-photo-input');
    if (rpPhotoInput) {
        rpPhotoInput.addEventListener('change', (e) => {
            if (e.target.files && e.target.files[0]) {
                handleParentRevPunModalPhoto(e.target.files[0]);
            }
        });
    }

    const rpPhotoRemove = document.getElementById('parent-rev-pun-photo-remove');
    if (rpPhotoRemove) {
        rpPhotoRemove.addEventListener('click', () => {
            parentRevPunPhotoData = null;
            const imgEl = document.getElementById('parent-rev-pun-photo-img');
            if (imgEl) imgEl.src = '';
            const preview = document.getElementById('parent-rev-pun-photo-preview');
            if (preview) preview.classList.add('hidden');
            const btn = document.getElementById('parent-rev-pun-photo-btn');
            if (btn) btn.classList.remove('hidden');
            const input = document.getElementById('parent-rev-pun-photo-input');
            if (input) input.value = '';
        });
    }

    const rpSubmit = document.getElementById('parent-rev-pun-submit-btn');
    if (rpSubmit) rpSubmit.addEventListener('click', submitParentRevPun);
}

// ===== PRESTIGE MODAL =====
function triggerConfettiBurst(container) {
    const colors = ['#FFD700', '#FFA500', '#FF8C00', '#A5B4FC', '#6366F1', '#60A5FA', '#3B82F6', '#818CF8', '#10B981', '#34D399'];
    for (let i = 0; i < 80; i++) {
        const p = document.createElement('div');
        p.style.cssText = 'position: absolute; left: 50%; top: 50%; width: ' + (Math.random() * 8 + 6) + 'px; height: ' + (Math.random() * 8 + 6) + 'px; background-color: ' + colors[Math.floor(Math.random() * colors.length)] + '; border-radius: ' + (Math.random() > 0.5 ? '50%' : '2px') + '; opacity: 0.85; pointer-events: none; transform: translate(-50%, -50%) rotate(' + (Math.random() * 360) + 'deg);';
        container.appendChild(p);

        const angle = Math.random() * Math.PI * 2;
        const velocity = Math.random() * 260 + 80;
        const xTarget = Math.cos(angle) * velocity;
        const yTarget = Math.sin(angle) * velocity - 60;
        
        p.animate([
            { transform: 'translate(-50%, -50%) translate(0, 0) rotate(0deg)', opacity: 1 },
            { transform: 'translate(-50%, -50%) translate(' + xTarget + 'px, ' + yTarget + 'px) rotate(' + (Math.random() * 720) + 'deg)', opacity: 0 }
        ], {
            duration: Math.random() * 1200 + 800,
            easing: 'cubic-bezier(0.25, 1, 0.50, 1)',
            fill: 'forwards'
        });
    }
}

function triggerRainingPrizes(container) {
    const symbols = ['🪙', '⭐', '✨', '🎉'];
    const interval = setInterval(() => {
        if (!document.getElementById('epic-prestige-overlay')) {
            clearInterval(interval);
            return;
        }
        
        const p = document.createElement('div');
        p.textContent = symbols[Math.floor(Math.random() * symbols.length)];
        p.style.cssText = 'position: absolute; top: -20px; left: ' + (Math.random() * 100) + '%; font-size: ' + (Math.random() * 16 + 16) + 'px; pointer-events: none; z-index: 4; opacity: 0.8;';
        container.appendChild(p);
        
        p.animate([
            { transform: 'translateY(0) rotate(0deg)', opacity: 0.8 },
            { transform: 'translateY(105vh) rotate(' + (Math.random() * 360) + 'deg)', opacity: 0 }
        ], {
            duration: Math.random() * 3000 + 2000,
            easing: 'linear',
            fill: 'forwards'
        });
        
        setTimeout(() => p.remove(), 5000);
    }, 120);
}

function triggerFlyingCoinsAndStars(goldAmount, starAmount, sourceElement) {
    const targetElement = document.getElementById('greeting-balance-text') || document.getElementById('cs-balance');
    let targetX = window.innerWidth / 2;
    let targetY = 50;
    
    if (targetElement) {
        const rect = targetElement.getBoundingClientRect();
        targetX = rect.left + rect.width / 2;
        targetY = rect.top + rect.height / 2;
    }
    
    const sourceRect = sourceElement.getBoundingClientRect();
    const sourceX = sourceRect.left + sourceRect.width / 2;
    const sourceY = sourceRect.top + sourceRect.height / 2;

    const count = 12;
    
    const spawnParticle = (symbol, color) => {
        const p = document.createElement('div');
        p.textContent = symbol;
        p.style.cssText = 'position: fixed; left: ' + sourceX + 'px; top: ' + sourceY + 'px; font-size: 24px; z-index: 100000; pointer-events: none; text-shadow: 0 0 8px ' + color + '; transform: translate(-50%, -50%);';
        document.body.appendChild(p);

        const explodeAngle = Math.random() * Math.PI * 2;
        const explodeDist = Math.random() * 50 + 20;
        const midX = sourceX + Math.cos(explodeAngle) * explodeDist;
        const midY = sourceY + Math.sin(explodeAngle) * explodeDist - 40;

        const anim = p.animate([
            { left: sourceX + 'px', top: sourceY + 'px', transform: 'translate(-50%, -50%) scale(0.5)', opacity: 0 },
            { left: midX + 'px', top: midY + 'px', transform: 'translate(-50%, -50%) scale(1.3)', opacity: 1, offset: 0.25 },
            { left: targetX + 'px', top: targetY + 'px', transform: 'translate(-50%, -50%) scale(0.9)', opacity: 0.9, offset: 0.9 },
            { left: targetX + 'px', top: targetY + 'px', transform: 'translate(-50%, -50%) scale(0.3)', opacity: 0 }
        ], {
            duration: Math.random() * 600 + 800,
            easing: 'cubic-bezier(0.25, 1, 0.50, 1)',
            fill: 'forwards'
        });

        anim.onfinish = () => {
            p.remove();
            if (targetElement) {
                targetElement.animate([
                    { transform: 'scale(1)' },
                    { transform: 'scale(1.15)', textShadow: '0 0 15px ' + color },
                    { transform: 'scale(1)' }
                ], { duration: 150 });
            }
        };
    };

    for (let i = 0; i < count; i++) {
        setTimeout(() => spawnParticle('🪙', '#F59E0B'), i * 70);
    }
    for (let i = 0; i < count; i++) {
        setTimeout(() => spawnParticle('⭐', '#FCD34D'), i * 70 + 200);
    }
}

function showPrestigeModal(newTier, goldPrize, starPrize) {
    const oldModal = document.getElementById('prestige-modal');
    if (oldModal) oldModal.classList.add('hidden');

    const overlay = document.createElement('div');
    overlay.id = 'epic-prestige-overlay';
    overlay.style.cssText = 'position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: radial-gradient(circle at center, #111827 0%, #030712 100%); z-index: 99999; display: flex; flex-direction: column; align-items: center; justify-content: center; overflow: hidden; font-family: inherit;';

    const starburst = document.createElement('div');
    starburst.className = 'prestige-starburst';
    overlay.appendChild(starburst);

    const header = document.createElement('div');
    header.style.cssText = 'text-align: center; color: white; z-index: 10; margin-bottom: 20px; animation: fadeInDown 0.8s ease; padding: 0 15px;';
    
    let tierName = '';
    let tierColor = '#FFD700';
    if (newTier === 1) { tierName = __('tier.gold') || 'Даври Тилло'; tierColor = '#FFD700'; }
    else if (newTier === 2) { tierName = __('tier.platinum') || 'Даври Платина'; tierColor = '#818CF8'; }
    else if (newTier >= 3) { tierName = __('tier.diamond') || 'Даври Алмос'; tierColor = '#60A5FA'; }
    else { tierName = 'Даври Нав'; tierColor = '#10B981'; }

    header.innerHTML = '<h1 style="font-size: 32px; font-weight: 800; margin-bottom: 8px; text-shadow: 0 0 15px rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 1.5px; display: block;">👑 ' + (__('prestige.title') || 'Қаҳрамони мутлақ!') + '</h1>' +
        '<p style="font-size: 16px; opacity: 0.9; margin: 0; max-width: 440px; line-height: 1.4; display: block;">' +
        (newTier === 1 
            ? 'Шумо ҳамаи муваффақиятҳоро ба даст овардед ва ба <strong style="color: ' + tierColor + '; text-shadow: 0 0 10px ' + tierColor + '80;">' + tierName + '</strong> гузаштед!'
            : 'Поздравляем! Вы заработали все достижения текущей лиги и перешли на <strong style="color: ' + tierColor + '; text-shadow: 0 0 10px ' + tierColor + '80;">' + tierName + '</strong>!') +
        '</p>';
    overlay.appendChild(header);

    const chestBox = document.createElement('div');
    chestBox.className = 'prestige-chest-box locked';
    chestBox.style.cursor = 'pointer';
    chestBox.innerHTML = '<div class="prestige-light-beam"></div>' +
        '<div class="chest-lid">🎁</div>' +
        '<div class="chest-base">🧰</div>' +
        '<div class="chest-lock">🔒</div>' +
        '<div class="chest-click-prompt" style="color: white; font-weight: 800; font-size: 14px; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">' + (__('prestige.click_to_unlock') || 'Барои кушодан клик кунед!') + '</div>';
    overlay.appendChild(chestBox);

    const prizeContainer = document.createElement('div');
    prizeContainer.className = 'prestige-prize-box hidden';
    prizeContainer.style.cssText = 'text-align: center; color: white; z-index: 10; margin-top: 30px; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.12); padding: 18px 30px; border-radius: 24px; backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); transform: scale(0.8); opacity: 0; transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1); box-shadow: 0 12px 36px rgba(0,0,0,0.4);';
    
    let grade = '';
    if (newTier === 1) grade = 'IV';
    else if (newTier === 2) grade = 'III';
    else if (newTier === 3) grade = 'II';
    else if (newTier >= 4) grade = 'I';

    const medalNotif = grade ? '<p style="font-weight: 700; color: #10B981; font-size: 15px; margin-top: 10px; text-shadow: 0 0 10px rgba(16,185,129,0.3);">' + (__('prestige.medal_unlocked', { grade: grade }) || ('Шумо соҳиби Медали дараҷаи ' + grade + ' гардидед! 🏅')) + '</p>' : '';

    prizeContainer.innerHTML = '<span style="font-size: 12px; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.6); font-weight: 700;">' + (__('achievements.grand_prize_prize') || 'Ҷоиза:') + '</span>' +
        '<h2 style="font-size: 32px; font-weight: 900; color: #FCD34D; text-shadow: 0 0 12px rgba(252,211,77,0.4); margin: 6px 0; display: flex; align-items: center; justify-content: center; gap: 18px;">' +
            '<span>+' + goldPrize + ' 🪙</span>' +
            '<span>+' + starPrize + ' ⭐</span>' +
        '</h2>' +
        medalNotif;
    overlay.appendChild(prizeContainer);

    const closeBtn = document.createElement('button');
    closeBtn.className = 'btn btn-primary hidden';
    closeBtn.style.cssText = 'margin-top: 25px; z-index: 10; width: 240px; opacity: 0; transform: translateY(20px); transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1); box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4); font-weight: 800; font-size: 15px; padding: 12px 24px; border-radius: 14px;';
    closeBtn.textContent = __('prestige.continue_btn') || 'Аъло! Давом медиҳем';
    closeBtn.onclick = function() {
        overlay.style.transition = 'opacity 0.5s ease';
        overlay.style.opacity = '0';
        setTimeout(() => {
            overlay.remove();
            if (typeof closePrestigeModal === 'function') closePrestigeModal();
        }, 500);
    };
    overlay.appendChild(closeBtn);

    document.body.appendChild(overlay);

    const particleContainer = document.createElement('div');
    particleContainer.style.cssText = 'position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 5;';
    overlay.appendChild(particleContainer);

    chestBox.onclick = function() {
        if (!chestBox.classList.contains('locked')) return;
        
        chestBox.classList.remove('locked');
        chestBox.classList.add('unlocking');

        setTimeout(() => {
            chestBox.classList.remove('unlocking');
            chestBox.classList.add('opened');
            
            triggerConfettiBurst(particleContainer);
            triggerRainingPrizes(particleContainer);
            
            prizeContainer.classList.remove('hidden');
            setTimeout(() => {
                prizeContainer.style.transform = 'scale(1)';
                prizeContainer.style.opacity = '1';
            }, 50);

            setTimeout(() => {
                triggerFlyingCoinsAndStars(goldPrize, starPrize, chestBox);
            }, 600);

            setTimeout(() => {
                closeBtn.classList.remove('hidden');
                setTimeout(() => {
                    closeBtn.style.opacity = '1';
                    closeBtn.style.transform = 'translateY(0)';
                }, 50);
            }, 1800);

        }, 1200);
    };
    
    launchConfetti();
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

// ===== GENERIC PHOTO UPLOAD HELPER =====
function handleGenericPhotoUpload(imgId, previewId, btnId, inputId) {
    return function(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.onload = function() {
                const canvas = document.createElement('canvas');
                let w = img.width, h = img.height;
                const maxDim = 800;
                if (w > maxDim || h > maxDim) {
                    if (w > h) { h = h * maxDim / w; w = maxDim; }
                    else { w = w * maxDim / h; h = maxDim; }
                }
                canvas.width = w; canvas.height = h;
                canvas.getContext('2d').drawImage(img, 0, 0, w, h);
                const compressed = canvas.toDataURL('image/jpeg', 0.7);
                document.getElementById(imgId).src = compressed;
                document.getElementById(previewId).classList.remove('hidden');
                document.getElementById(btnId).classList.add('hidden');
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    };
}

function showCustomPrompt(title, placeholder) {
    return new Promise(function(resolve) {
        currentPromptResolver = resolve;
        document.getElementById('prompt-modal-title').textContent = title;
        var input = document.getElementById('prompt-modal-input');
        input.value = '';
        input.placeholder = placeholder || (__('common.reason_placeholder'));
        // Reset photo each time
        var photoImg = document.getElementById('prompt-modal-photo-img');
        var photoPreview = document.getElementById('prompt-modal-photo-preview');
        var photoBtn = document.getElementById('prompt-modal-photo-btn');
        var photoInput = document.getElementById('prompt-modal-photo-input');
        if (photoImg) photoImg.src = '';
        if (photoPreview) photoPreview.classList.add('hidden');
        if (photoBtn) photoBtn.classList.remove('hidden');
        if (photoInput) photoInput.value = '';

        var modal = document.getElementById('prompt-modal');
        modal.classList.remove('hidden');
        input.focus();
    });
}

function submitCustomPrompt() {
    var text = document.getElementById('prompt-modal-input').value;
    var photoImg = document.getElementById('prompt-modal-photo-img');
    var photo = (photoImg && photoImg.src && photoImg.src.startsWith('data:')) ? photoImg.src : null;
    var resolver = currentPromptResolver;
    currentPromptResolver = null;

    var modal = document.getElementById('prompt-modal');
    if (modal) modal.classList.add('hidden');

    if (resolver) resolver({ text: text, photo: photo });
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
        showToast('⚠️', __('dream.name_required'));
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
    const lang = currentLang;
    document.querySelectorAll('#parent-routine-modal .flatpickr-time-input').forEach(function(el) {
        if (el._flatpickr) el._flatpickr.destroy();
        flatpickr(el, {
            locale: lang,
            enableTime: true,
            noCalendar: true,
            dateFormat: currentLang === 'en' ? 'h:i K' : 'H:i',
            time_24hr: currentLang !== 'en',
            disableMobile: true,
            onReady: function(selectedDates, dateStr, instance) {
                const hourInput = instance.calendarContainer.querySelector('.flatpickr-hour');
                const minuteInput = instance.calendarContainer.querySelector('.flatpickr-minute');
                if (hourInput) {
                    hourInput.setAttribute('readonly', 'readonly');
                    hourInput.setAttribute('inputmode', 'none');
                }
                if (minuteInput) {
                    minuteInput.setAttribute('readonly', 'readonly');
                    minuteInput.setAttribute('inputmode', 'none');
                }
            }
        });
    });
}

function showParentRoutineModal() {
    const modal = document.getElementById('parent-routine-modal');
    if (!modal) return;

    // Reset new row inputs
    const newTime = document.getElementById('new-routine-time');
    const newEnd = document.getElementById('new-routine-end-time');
    const newName = document.getElementById('new-routine-name');
    const newDuration = document.getElementById('new-routine-duration');
    const newStars = document.getElementById('new-routine-stars');

    if (newTime) newTime.value = '';
    if (newEnd) newEnd.value = '';
    if (newName) newName.value = '';
    if (newDuration) newDuration.value = '';
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
        html += `  <input type="text" class="flatpickr-time-input routine-start-time" readonly value="${task.startTime || '12:00'}" style="width:64px; text-align:center; font-size:13px; padding:4px; border:1px solid var(--border); border-radius:var(--radius-md);">`;
        html += `  <span style="color:var(--text-light); font-weight:700;">→</span>`;
        html += `  <input type="text" class="flatpickr-time-input routine-end-time" readonly value="${task.endTime || ''}" placeholder="--:--" style="width:64px; text-align:center; font-size:13px; padding:4px; border:1px solid var(--border); border-radius:var(--radius-md);">`;
        html += `  <input type="text" class="routine-task-name" value="${escapeHtmlAttr(task.name)}" placeholder="${__('routine.activity_name_placeholder')}">`;
        html += `  <input type="number" class="routine-task-duration" value="${task.duration || 10}" placeholder="${__('task_form.minutes_placeholder')}" min="1">`;
        html += `  <div style="display: flex; gap: 4px; align-items: center;">`;
        html += `    <input type="number" class="routine-task-stars" value="${task.rewardStars || 0}" min="0" style="width: 60px; text-align: center; font-size: 13px; padding: 4px; border: 1px solid var(--border); border-radius: var(--radius-md);">`;
        html += `  </div>`;
        html += `  <button class="btn-delete-routine-row" title="${__('common.delete_short')}">🗑️</button>`;
        html += `</div>`;
    });

    list.innerHTML = html;
}

function addRoutineRowFromInputs() {
    const newTimeEl = document.getElementById('new-routine-time');
    const newEndEl = document.getElementById('new-routine-end-time');
    const newNameEl = document.getElementById('new-routine-name');
    const newDurationEl = document.getElementById('new-routine-duration');
    const newStarsEl = document.getElementById('new-routine-stars');

    const name = newNameEl ? newNameEl.value.trim() : '';
    if (!name) {
        showToast('⚠️', __('parent.routine_validation_error'));
        return;
    }

    const time = newTimeEl && newTimeEl.value ? newTimeEl.value.trim() : '08:00';
    const endTime = newEndEl && newEndEl.value ? newEndEl.value.trim() : '';
    const duration = newDurationEl ? (parseInt(newDurationEl.value) || 10) : 10;
    const stars = newStarsEl ? (parseInt(newStarsEl.value) || 0) : 0;
    const newId = 'task_gen_' + Date.now() + '_' + Math.floor(Math.random() * 1000);

    const list = document.getElementById('parent-routine-list');
    if (list) {
        const row = document.createElement('div');
        row.className = 'routine-row';
        row.dataset.taskId = newId;
        
        let html = '';
        html += `  <input type="text" class="flatpickr-time-input routine-start-time" readonly value="${time}" style="width:64px; text-align:center; font-size:13px; padding:4px; border:1px solid var(--border); border-radius:var(--radius-md);">`;
        html += `  <span style="color:var(--text-light); font-weight:700;">→</span>`;
        html += `  <input type="text" class="flatpickr-time-input routine-end-time" readonly value="${endTime}" placeholder="--:--" style="width:64px; text-align:center; font-size:13px; padding:4px; border:1px solid var(--border); border-radius:var(--radius-md);">`;
        html += `  <input type="text" class="routine-task-name" value="${escapeHtmlAttr(name)}" placeholder="${__('routine.activity_name_placeholder')}">`;
        html += `  <input type="number" class="routine-task-duration" value="${duration}" placeholder="${__('task_form.minutes_placeholder')}" min="1">`;
        html += `  <div style="display: flex; gap: 4px; align-items: center;">`;
        html += `    <input type="number" class="routine-task-stars" value="${stars}" min="0" style="width: 60px; text-align: center; font-size: 13px; padding: 4px; border: 1px solid var(--border); border-radius: var(--radius-md);">`;
        html += `  </div>`;
        html += `  <button class="btn-delete-routine-row" title="${__('common.delete_short')}">🗑️</button>`;
        row.innerHTML = html;
        list.appendChild(row);

        // Clear inputs
        if (newNameEl) newNameEl.value = '';
        if (newEndEl) newEndEl.value = '';
        if (newDurationEl) newDurationEl.value = '';
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
        const endEl = row.querySelector('.routine-end-time');
        let endVal = endEl ? endEl.value.trim() : '';
        if (endVal && !/^\d{1,2}:\d{2}$/.test(endVal)) endVal = '';
        const nameVal = row.querySelector('.routine-task-name').value.trim();
        const durationVal = parseInt(row.querySelector('.routine-task-duration').value) || 10;
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
        taskObj.endTime = endVal;
        taskObj.duration = durationVal;
        taskObj.rewardGold = 0; // Routines do not reward money
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

    if (typeof syncDailyLogTasks === 'function') {
        syncDailyLogTasks(child, getToday());
    }
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

// ===== GENTLE NUDGES =====
window._nudgedTasks = {};

function checkStrictDeadlines() {
    if (!state || !state.children || state.children.length === 0) return;

    const GRACE_MINUTES = 15; // 15-minute grace period after deadline
    const today = getToday();
    const now = new Date();
    const todayDay = now.getDay();
    const currentMinutes = now.getHours() * 60 + now.getMinutes();
    let stateChanged = false;

    // Check ALL children, not just the currently viewed one
    for (const child of state.children) {
        const log = child.dailyLogs ? child.dailyLogs[today] : null;
        if (!log || log.excused) continue;
        if (!log.tasks) continue;

        for (const taskId in log.tasks) {
            const tl = log.tasks[taskId];
            if (!tl) continue;

            // Skip completed, failed, or already confirmed tasks
            if (tl.status === 'completed' || tl.status === 'failed' || tl.confirmed || tl.deadlineBypassed) continue;

            // RULE 1: If child submitted ("awaiting-confirm"), do NOT auto-fail — wait for parent
            if (tl.status === 'awaiting-confirm') continue;

            // Find task definition in regular tasks or bonus tasks
            const allTasks = [...(child.tasks || []), ...(child.bonusTasks || [])];
            const task = allTasks.find(t => t.id === taskId);
            if (!task) continue;

            let isPastDeadline = false;
            let deadlineTimeStr = '';

            // Case 1: Strict deadline (task.hasDeadline is true)
            if (task.hasDeadline) {
                if (task.deadlineDate === today && task.deadlineTime) {
                    deadlineTimeStr = task.deadlineTime;
                    const deadlineMin = timeToMinutes(task.deadlineTime);
                    // RULE 2: Add 15-minute grace period
                    if (deadlineMin !== null && currentMinutes > (deadlineMin + GRACE_MINUTES)) {
                        isPastDeadline = true;
                    }
                }
            }
            // Case 2: Daily task end time (task.endTime exists)
            else if (task.endTime) {
                // Check if task is active today
                const isActiveToday = !task.days || task.days.includes(todayDay);
                if (isActiveToday) {
                    deadlineTimeStr = task.endTime;
                    const endMin = timeToMinutes(task.endTime);
                    // RULE 2: Add 15-minute grace period
                    if (endMin !== null && currentMinutes > (endMin + GRACE_MINUTES)) {
                        isPastDeadline = true;
                    }
                }
            }

            if (isPastDeadline) {
                tl.status = 'failed';
                tl.confirmed = true;
                tl.missedDeadline = true;

                // Process penalty if enabled and not already applied
                if (task.hasPenalty && !tl.penaltyApplied) {
                    const pStars = parseInt(task.penaltyStars) || 0;
                    const pGold  = parseInt(task.penaltyGold)  || 0;
                    if (pStars > 0) {
                        child.stars = Math.max(0, (child.stars || 0) - pStars);
                        child.totalDeducted = (child.totalDeducted || 0) + pStars;
                    }
                    if (pGold > 0) {
                        child.balance = Math.max(0, (child.balance || 0) - pGold);
                        child.totalDeducted = (child.totalDeducted || 0) + pGold;
                    }
                    tl.penaltyApplied = { stars: pStars, gold: pGold };
                }

                stateChanged = true;
                console.log(`[Deadline] Child "${child.name}" — Task "${task.name}" (${taskId}) → FAILED (after ${GRACE_MINUTES}min grace). Deadline/endTime: ${deadlineTimeStr}`);
            }
        }
    }

    if (stateChanged) {
        saveState();
        if (typeof renderTasks === 'function') {
            renderTasks();
        }
        if (typeof updateUI === 'function') {
            updateUI();
        }
    }
}


function timeToMinutes(timeStr) {
    if (!timeStr) return null;
    const parts = timeStr.split(':');
    if (parts.length < 2) return null;
    const hrs = parseInt(parts[0], 10);
    const mins = parseInt(parts[1], 10);
    if (isNaN(hrs) || isNaN(mins)) return null;
    return hrs * 60 + mins;
}

function checkGentleNudges() {
    checkStrictDeadlines();

    // Periodic Background Sync check (every 20 seconds) and WebSocket health check
    window._syncCounter = (window._syncCounter || 0) + 1;
    if (window._syncCounter >= 2) {
        window._syncCounter = 0;
        if (window.supabaseSession && window.supabaseSession.user) {
            fetchRemoteState().then((remoteState) => {
                if (remoteState) {
                    const remoteVersion = Number(remoteState.version) || 0;
                    const localVersion = Number(state.version) || 0;
                    const remoteTime = Number(remoteState.lastUpdated) || 0;
                    const localTime = Number(state.lastUpdated) || 0;
                    let isRemoteNewer = false;
                    if (remoteVersion > localVersion) {
                        isRemoteNewer = true;
                    } else if (remoteVersion === localVersion && remoteTime > localTime) {
                        isRemoteNewer = true;
                    }
                    if (isRemoteNewer) {
                        console.log('Periodic sync found newer state. Applying...');
                        migrateState(remoteState);
                        state = remoteState;
                        safeStorage.setItem(STORAGE_KEY, JSON.stringify(state));
                        updateUI();
                    }
                }
            });

            // WebSocket Connection Health check
            if (!window.supabaseRealtimeChannel || window.supabaseRealtimeChannel.state !== 'joined') {
                console.log('Real-time connection inactive. Reconnecting...');
                setupRealtimeSubscription(window.supabaseSession.user.id);
            }
        }
    }

    if (!currentChildId) return;
    const child = getChild(currentChildId);
    if (!child) return;

    const todayDate = getToday();
    const log = getOrCreateDailyLog(currentChildId);
    if (log.excused) return;

    const todayDay = new Date().getDay();
    const now = new Date();
    const currentMinutes = now.getHours() * 60 + now.getMinutes();

    // Loop through child's routine tasks (daily type)
    const dailyTasks = child.tasks.filter(t => t.type === 'daily');
    
    for (const task of dailyTasks) {
        // If task is not active today, skip
        if (task.days && !task.days.includes(todayDay)) continue;
        
        // If no start time, skip
        if (!task.startTime) continue;

        // Parse start time
        const [startHour, startMin] = task.startTime.split(':').map(Number);
        const startMinutes = startHour * 60 + startMin;

        // Trigger nudge if:
        // 1. Current time is past/at start time, but not too late (within 30 minutes)
        // 2. Task status is pending in today's log
        // 3. Task has not been nudged yet today
        const key = `${currentChildId}_${task.id}_${todayDate}`;
        const tl = log.tasks[task.id];
        const isPending = tl ? tl.status === 'pending' : true;
        
        if (currentMinutes >= startMinutes && currentMinutes < startMinutes + 30) {
            if (isPending && !window._nudgedTasks[key]) {
                // If another nudge modal is currently active, don't overlap. Just queue/wait.
                const modal = document.getElementById('nudge-modal');
                if (modal && !modal.classList.contains('hidden')) {
                    continue; 
                }
                
                window._nudgedTasks[key] = true;
                showGentleNudge(task);
                break; // Show one nudge at a time
            }
        }
    }
}

function showGentleNudge(task) {
    window._activeNudgeTask = task;
    const modal = document.getElementById('nudge-modal');
    const msgEl = document.getElementById('nudge-modal-message');
    if (modal && msgEl) {
        msgEl.textContent = __('routine.nudge_message', { taskName: task.name });
        
        // Translate labels inside the modal
        const titleEl = modal.querySelector('[data-i18n="routine.nudge_title"]');
        if (titleEl) titleEl.textContent = __('routine.nudge_title');
        
        const cancelBtn = modal.querySelector('[data-i18n="cancel"]');
        if (cancelBtn) cancelBtn.textContent = __('cancel');
        
        const startBtn = document.getElementById('nudge-start-btn');
        if (startBtn) startBtn.textContent = __('routine.nudge_start');

        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        modal.style.zIndex = '999999';
    }
}

function closeNudgeModal() {
    const modal = document.getElementById('nudge-modal');
    if (modal) {
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }
    window._activeNudgeTask = null;
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


// ===== SUPABASE REALTIME SYNC =====
function setupRealtimeSubscription(userId) {
    if (!supabaseClient) return;
    
    if (window.supabaseRealtimeChannel) {
        window.supabaseRealtimeChannel.unsubscribe();
    }
    
    const channel = supabaseClient
        .channel('family-state-changes')
        .on(
            'postgres_changes',
            { event: '*', schema: 'public', table: 'family_states', filter: `id=eq.${userId}` },
            (payload) => {
                console.log('Real-time update received:', payload);
                if (payload.new && payload.new.state) {
                    const remoteState = payload.new.state;
                    const remoteVersion = Number(remoteState.version) || 0;
                    const localVersion = Number(state.version) || 0;
                    const remoteTime = Number(remoteState.lastUpdated) || 0;
                    const localTime = Number(state.lastUpdated) || 0;
                    
                    let isRemoteNewer = false;
                    if (remoteVersion > localVersion) {
                        isRemoteNewer = true;
                    } else if (remoteVersion === localVersion && remoteTime > localTime) {
                        isRemoteNewer = true;
                    }
                    
                    if (isRemoteNewer) {
                        console.log('Applying real-time update. Versions: remote=', remoteVersion, ', local=', localVersion);
                        const oldLang = currentLang;
                        migrateState(remoteState);
                        state = remoteState;
                        safeStorage.setItem(STORAGE_KEY, JSON.stringify(state));
                        
                        if (state.language) {
                            setLanguage(state.language);
                        }
                        
                        if (state.children.length > 0) {
                            if (!state.children.some(c => c.id === currentChildId)) {
                                currentChildId = getStoredOrFirstChildId();
                            }
                        }
                        
                        if (state.language && state.language !== oldLang) {
                            updateLanguageUI();
                        } else {
                            updateUI();
                        }
                        if (currentPage === 'settings' && typeof renderSettings === 'function') {
                            renderSettings();
                        }
                        // showToast('🔄', ...); // Removed to avoid annoying popups
                    }
                }
            }
        )
        .subscribe((status) => {
            console.log('Realtime subscription status:', status);
            if (status === 'SUBSCRIBED') {
                updateSyncStatus('online');
            } else if (status === 'CLOSED' || status === 'CHANNEL_ERROR') {
                updateSyncStatus('offline');
            }
        });
        
    window.supabaseRealtimeChannel = channel;
}

// ===== INLINE DIAGNOSTICS WIDGET =====
// renderDiagnostics removed — debug widget disabled
function renderDiagnostics() { return; // disabled
    let diag = document.getElementById('app-diagnostics');
    if (!diag) {
        diag = document.createElement('div');
        diag.id = 'app-diagnostics';
        diag.style.position = 'fixed';
        diag.style.bottom = '80px';
        diag.style.right = '10px';
        diag.style.background = 'rgba(15, 23, 42, 0.9)';
        diag.style.color = '#e2e8f0';
        diag.style.padding = '8px 12px';
        diag.style.borderRadius = '8px';
        diag.style.zIndex = '99999';
        diag.style.fontSize = '10px';
        diag.style.fontFamily = 'monospace';
        diag.style.boxShadow = '0 4px 12px rgba(0,0,0,0.3)';
        diag.style.cursor = 'pointer';
        diag.style.border = '1px solid rgba(255,255,255,0.1)';
        diag.addEventListener('click', () => {
            const panel = document.getElementById('app-diagnostics-panel');
            if (panel) panel.classList.toggle('hidden');
        });
        document.body.appendChild(diag);
        
        const panel = document.createElement('div');
        panel.id = 'app-diagnostics-panel';
        panel.className = 'hidden';
        panel.style.position = 'fixed';
        panel.style.bottom = '115px';
        panel.style.right = '10px';
        panel.style.background = 'rgba(15, 23, 42, 0.95)';
        panel.style.color = '#e2e8f0';
        panel.style.padding = '12px';
        panel.style.borderRadius = '8px';
        panel.style.zIndex = '99999';
        panel.style.fontSize = '11px';
        panel.style.fontFamily = 'monospace';
        panel.style.width = '240px';
        panel.style.boxShadow = '0 4px 12px rgba(0,0,0,0.3)';
        panel.style.border = '1px solid rgba(255,255,255,0.15)';
        document.body.appendChild(panel);
    }
    
    diag.innerHTML = `🛠️ Diagnostics`;
    
    const role = safeStorage.getItem('kids_tasks_device_role') || 'not set';
    const sub = typeof supabase !== 'undefined' ? 'Loaded' : 'FAILED';
    const client = supabaseClient ? 'Init OK' : 'Null';
    const session = window.supabaseSession ? `User: ${window.supabaseSession.user.email}` : 'None';
    const kids = state && state.children ? state.children.length : '0';
    const currKid = currentChildId || 'Null';
    
    document.getElementById('app-diagnostics-panel').innerHTML = `
        <strong>System Status</strong><hr style="opacity:0.2;margin:4px 0;">
        - Supabase: ${sub}<br>
        - Client: ${client}<br>
        - Session: ${session}<br>
        - Role: ${role}<br>
        - Kids Count: ${kids}<br>
        - Child ID: ${currKid}<br>
        - Page: ${currentPage}<br>
        <button style="margin-top:10px; width:100%; font-size:10px; font-weight:bold; background:#ef4444; color:white; border:none; padding:6px; border-radius:4px; cursor:pointer;" onclick="if(confirm('Сбросить все данные и перезагрузить?')){safeStorage.clear(); safeSessionStorage.clear(); location.reload();}">СБРОСИТЬ КЭШ И ДАННЫЕ</button>
    `;
}

// Clear parent auth on background
document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
        parentPinVerified = false;
        settingsPinVerified = false;
    }
});

// ===== REWARDS & PUNISHMENTS SYSTEM =====
let parentRevPunPhotoData = null;
let parentRevPunType = 'reward'; // 'reward' | 'punish'

function showParentRevPunModal() {
    parentRevPunPhotoData = null;
    parentRevPunType = 'reward';
    
    // Reset buttons
    const btnReward = document.getElementById('parent-rev-pun-type-reward');
    const btnPunish = document.getElementById('parent-rev-pun-type-punish');
    if (btnReward) {
        btnReward.className = 'btn btn-primary';
        btnReward.style.background = '';
        btnReward.style.borderColor = '';
        btnReward.style.color = '';
    }
    if (btnPunish) {
        btnPunish.className = 'btn btn-outline';
        btnPunish.style.background = '';
        btnPunish.style.borderColor = 'var(--danger)';
        btnPunish.style.color = 'var(--danger)';
    }

    // Reset fields & styling
    document.getElementById('parent-rev-pun-name').value = '';
    document.getElementById('parent-rev-pun-desc').value = '';
    
    const starsInput = document.getElementById('parent-rev-pun-stars');
    const goldInput = document.getElementById('parent-rev-pun-gold');
    const starsSym = document.getElementById('parent-rev-pun-stars-sym');
    const goldSym = document.getElementById('parent-rev-pun-gold-sym');
    
    if (starsInput) {
        starsInput.value = '';
        starsInput.classList.remove('punish-input-mode');
        starsInput.placeholder = '0';
    }
    if (goldInput) {
        goldInput.value = '';
        goldInput.classList.remove('punish-input-mode');
        goldInput.placeholder = '0';
    }
    if (starsSym) {
        starsSym.textContent = '⭐';
        starsSym.style.color = '';
    }
    if (goldSym) {
        goldSym.textContent = '🪙';
        goldSym.style.color = '';
    }
    
    // Reset photo upload state
    document.getElementById('parent-rev-pun-photo-input').value = '';
    document.getElementById('parent-rev-pun-photo-img').src = '';
    document.getElementById('parent-rev-pun-photo-preview').classList.add('hidden');
    document.getElementById('parent-rev-pun-photo-btn').classList.remove('hidden');
    
    document.getElementById('parent-rev-pun-modal').classList.remove('hidden');
    document.getElementById('parent-rev-pun-name').focus();
}

function closeParentRevPunModal() {
    document.getElementById('parent-rev-pun-modal').classList.add('hidden');
}

function handleParentRevPunModalPhoto(file) {
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
            parentRevPunPhotoData = canvas.toDataURL('image/jpeg', 0.7);
            const imgEl = document.getElementById('parent-rev-pun-photo-img');
            if (imgEl) imgEl.src = parentRevPunPhotoData;
            const preview = document.getElementById('parent-rev-pun-photo-preview');
            if (preview) preview.classList.remove('hidden');
            const btn = document.getElementById('parent-rev-pun-photo-btn');
            if (btn) btn.classList.add('hidden');
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

function submitParentRevPun() {
    const title = document.getElementById('parent-rev-pun-name').value.trim();
    const desc = document.getElementById('parent-rev-pun-desc').value.trim();
    const stars = Math.abs(parseInt(document.getElementById('parent-rev-pun-stars').value) || 0);
    const gold = Math.abs(parseFloat(document.getElementById('parent-rev-pun-gold').value) || 0);
    
    if (!title) {
        showToast('⚠️', 'Лутфан номи амалро нависед!');
        return;
    }
    if (stars <= 0 && gold <= 0) {
        showToast('⚠️', 'Лутфан миқдори ситора ё тиллоро ворид кунед!');
        return;
    }

    const selectedChild = getCurrentChild();
    if (!selectedChild) return;

    selectedChild.rewardsPunishments = selectedChild.rewardsPunishments || [];
    const item = {
        id: generateId(),
        type: parentRevPunType,
        title: title,
        description: desc,
        photo: parentRevPunPhotoData,
        stars: stars,
        gold: gold,
        status: 'pending',
        disputeReason: '',
        timestamp: Date.now()
    };

    selectedChild.rewardsPunishments.push(item);
    saveState();
    showToast('✉️', 'Амал ба кӯдак фиристода шуд!');
    closeParentRevPunModal();
    renderParentDashboard();
    updateUI();
}

function acceptRewardPunishment(id) {
    const child = getCurrentChild();
    if (!child || !child.rewardsPunishments) return;

    const item = child.rewardsPunishments.find(x => x.id === id);
    if (!item) return;

    // Apply the rewards or punishments
    if (item.type === 'reward') {
        child.stars = (child.stars || 0) + (item.stars || 0);
        child.totalStars = (child.totalStars || 0) + (item.stars || 0);
        child.balance = (child.balance || 0) + (item.gold || 0);
        child.totalEarned = (child.totalEarned || 0) + (item.gold || 0);
        showToast('🎁', __('revpun.success_reward') || 'Мукофот қабул шуд! Ташаккур! 🎉');
    } else {
        child.stars = Math.max(0, (child.stars || 0) - (item.stars || 0));
        child.balance = Math.max(0, (child.balance || 0) - (item.gold || 0));
        child.totalDeducted = (child.totalDeducted || 0) + (item.stars || 0) + (item.gold || 0);
        showToast('😔', __('revpun.success_punish') || 'Танбеҳ қабул шуд.');
    }

    item.status = 'accepted';
    item.resolvedAt = Date.now();

    saveState();
    renderTasks();
    updateUI();
}

function disputeRewardPunishment(id) {
    const child = getCurrentChild();
    if (!child || !child.rewardsPunishments) return;

    const item = child.rewardsPunishments.find(x => x.id === id);
    if (!item) return;

    showCustomPrompt('Сабаби баҳс (Несогласие)', 'Чаро шумо норозӣ ҳастед?').then(result => {
        if (result === null) return; // cancelled
        const text = (result.text || '').trim();
        if (!text) {
            showToast('⚠️', 'Лутфан сабаби баҳсро нависед!');
            return;
        }

        item.status = 'disputed';
        item.disputeReason = text;
        if (result.photo) item.disputePhoto = result.photo;

        saveState();
        showToast('⚖️', __('revpun.disputed_toast') || 'Баҳс фиристода шуд ба волидон.');
        renderTasks();
        updateUI();
    });
}

function enforceRewardPunishment(id) {
    const child = getCurrentChild();
    if (!child || !child.rewardsPunishments) return;

    const item = child.rewardsPunishments.find(x => x.id === id);
    if (!item) return;

    // Apply the rewards or punishments immediately
    if (item.type === 'reward') {
        child.stars = (child.stars || 0) + (item.stars || 0);
        child.totalStars = (child.totalStars || 0) + (item.stars || 0);
        child.balance = (child.balance || 0) + (item.gold || 0);
        child.totalEarned = (child.totalEarned || 0) + (item.gold || 0);
    } else {
        child.stars = Math.max(0, (child.stars || 0) - (item.stars || 0));
        child.balance = Math.max(0, (child.balance || 0) - (item.gold || 0));
        child.totalDeducted = (child.totalDeducted || 0) + (item.stars || 0) + (item.gold || 0);
    }

    item.status = 'accepted';
    item.resolvedAt = Date.now();

    saveState();
    showToast('⚖️', __('revpun.enforced_toast') || 'Амал маҷбурӣ татбиқ карда шуд.');
    renderParentDashboard();
    updateUI();
}

function cancelRewardPunishment(id) {
    const child = getCurrentChild();
    if (!child || !child.rewardsPunishments) return;

    child.rewardsPunishments = child.rewardsPunishments.filter(x => x.id !== id);

    saveState();
    showToast('❌', __('revpun.cancelled_toast') || 'Амал бекор карда шуд.');
    renderParentDashboard();
    updateUI();
}

function restorePastTask(childId, dateStr, taskId) {
    const child = getChild ? getChild(childId) : state.children.find(c => c.id === childId);
    if (!child) return;
    const log = child.dailyLogs[dateStr];
    if (!log || !log.tasks) return;
    const tl = log.tasks[taskId];
    if (!tl) return;

    // Refund penalty if applied
    if (tl.penaltyApplied) {
        if (tl.penaltyApplied.stars > 0) {
            child.stars = (child.stars || 0) + tl.penaltyApplied.stars;
            child.totalDeducted = Math.max(0, (child.totalDeducted || 0) - tl.penaltyApplied.stars);
        }
        if (tl.penaltyApplied.gold > 0) {
            child.balance = (child.balance || 0) + tl.penaltyApplied.gold;
            child.totalDeducted = Math.max(0, (child.totalDeducted || 0) - tl.penaltyApplied.gold);
        }
        delete tl.penaltyApplied;
    }

    tl.status = 'pending';
    tl.confirmed = false;
    tl.deadlineBypassed = true;
    delete tl.missedDeadline;
    delete tl.skipReason;
    delete tl.skipPhoto;
    delete tl.rejectReason;
    delete tl.rejectPhoto;

    saveState();
    showToast('🎉', __('parent.restored_toast') || 'Супориш барқарор карда шуд!');
    
    // Close day details popup
    const p = document.getElementById('day-details-panel');
    const b = document.getElementById('day-details-backdrop');
    if (p) p.remove();
    if (b) b.remove();

    if (typeof renderTasks === 'function') renderTasks();
    if (typeof renderCalendar === 'function') renderCalendar();
    if (typeof updateUI === 'function') updateUI();
}

function completePastTask(childId, dateStr, taskId) {
    const child = getChild ? getChild(childId) : state.children.find(c => c.id === childId);
    if (!child) return;
    const log = child.dailyLogs[dateStr];
    if (!log || !log.tasks) return;
    const tl = log.tasks[taskId];
    if (!tl) return;

    // Refund penalty if applied
    if (tl.penaltyApplied) {
        if (tl.penaltyApplied.stars > 0) {
            child.stars = (child.stars || 0) + tl.penaltyApplied.stars;
            child.totalDeducted = Math.max(0, (child.totalDeducted || 0) - tl.penaltyApplied.stars);
        }
        if (tl.penaltyApplied.gold > 0) {
            child.balance = (child.balance || 0) + tl.penaltyApplied.gold;
            child.totalDeducted = Math.max(0, (child.totalDeducted || 0) - tl.penaltyApplied.gold);
        }
        delete tl.penaltyApplied;
    }

    tl.status = 'completed';
    tl.confirmed = true;
    tl.confirmedAt = new Date().toISOString();
    delete tl.missedDeadline;
    delete tl.skipReason;
    delete tl.skipPhoto;
    delete tl.rejectReason;
    delete tl.rejectPhoto;

    // Apply rewards
    const task = child.tasks.find(t => t.id === taskId) || child.bonusTasks.find(t => t.id === taskId);
    if (task && !tl.rewardPaid) {
        const rt = child.rewardType || 'money';
        const goldReward = parseInt(task.rewardGold !== undefined ? task.rewardGold : 1) || 0;
        const starsReward = parseInt(task.rewardStars !== undefined ? task.rewardStars : 1) || 0;
        const medalsReward = parseInt(task.rewardMedals !== undefined ? task.rewardMedals : 0) || 0;

        if (goldReward > 0 && (rt === 'money' || rt === 'both')) {
            child.balance = (child.balance || 0) + goldReward;
            child.totalEarned = (child.totalEarned || 0) + goldReward;
        }
        if (starsReward > 0 && (rt === 'stars' || rt === 'both')) {
            child.stars = (child.stars || 0) + starsReward;
            child.totalStars = (child.totalStars || 0) + starsReward;
        }
        if (medalsReward > 0) {
            child.medals = (child.medals || 0) + medalsReward;
            child.totalMedals = (child.totalMedals || 0) + medalsReward;
        }
        tl.rewardPaid = true;
        tl.paidGold = goldReward;
        tl.paidStars = starsReward;
        tl.paidMedals = medalsReward;
    }

    saveState();
    
    if (typeof checkAchievements === 'function') {
        checkAchievements(child.id);
    }

    showToast('🎉', __('parent.completed_toast') || 'Супориш ҳамчун иҷрошуда қайд карда шуд!');
    
    // Close day details popup
    const p = document.getElementById('day-details-panel');
    const b = document.getElementById('day-details-backdrop');
    if (p) p.remove();
    if (b) b.remove();

    if (typeof renderTasks === 'function') renderTasks();
    if (typeof renderCalendar === 'function') renderCalendar();
    if (typeof renderParentDashboard === 'function') renderParentDashboard();
    if (typeof updateUI === 'function') updateUI();
}

function excusePastTask(childId, dateStr, taskId, reason, photo) {
    const child = getChild ? getChild(childId) : state.children.find(c => c.id === childId);
    if (!child) return;
    const log = child.dailyLogs[dateStr];
    if (!log || !log.tasks) return;
    const tl = log.tasks[taskId];
    if (!tl) return;

    // Refund penalty if applied
    if (tl.penaltyApplied) {
        if (tl.penaltyApplied.stars > 0) {
            child.stars = (child.stars || 0) + tl.penaltyApplied.stars;
            child.totalDeducted = Math.max(0, (child.totalDeducted || 0) - tl.penaltyApplied.stars);
        }
        if (tl.penaltyApplied.gold > 0) {
            child.balance = (child.balance || 0) + tl.penaltyApplied.gold;
            child.totalDeducted = Math.max(0, (child.totalDeducted || 0) - tl.penaltyApplied.gold);
        }
        delete tl.penaltyApplied;
    }

    tl.status = 'excused';
    tl.confirmed = true;
    tl.excuseReason = reason || '';
    if (photo) {
        tl.excusePhoto = photo;
    } else {
        delete tl.excusePhoto;
    }
    
    delete tl.missedDeadline;
    delete tl.skipReason;
    delete tl.skipPhoto;
    delete tl.rejectReason;
    delete tl.rejectPhoto;

    saveState();
    showToast('🙏', __('parent.excused_toast') || 'Супориш узрнок ҳисоб карда шуд!');
    
    // Close day details popup
    const p = document.getElementById('day-details-panel');
    const b = document.getElementById('day-details-backdrop');
    if (p) p.remove();
    if (b) b.remove();

    if (typeof renderTasks === 'function') renderTasks();
    if (typeof renderCalendar === 'function') renderCalendar();
    if (typeof renderParentDashboard === 'function') renderParentDashboard();
    if (typeof updateUI === 'function') updateUI();
}

function renderRewardsPunishments(container, child) {
    // 1. Render Rejected Withdrawals
    const rejectedWithdrawals = (child.withdrawals || []).filter(w => w.status === 'rejected' && !w.acknowledged);
    rejectedWithdrawals.forEach(req => {
        const sym = req.type === 'stars' ? '⭐' : '🪙';
        const cardStyle = "background: linear-gradient(135deg, rgba(239, 68, 68, 0.08) 0%, rgba(220, 38, 38, 0.08) 100%); border: 1.5px solid rgba(239, 68, 68, 0.3); color: var(--text);";
        const badgeText = `❌ ${__('parent.reject_withdraw_title') || 'Рад кардани ихроҷ'}`;
        
        let parentCommentHTML = '';
        if (req.parentComment) {
            parentCommentHTML = `<div style="margin-top:4px; color:#EF4444;"><strong style="color:#EF4444;">${__('task.parent_reply') || '💬 Ҷавоби волидон:'}</strong> ${req.parentComment}</div>`;
        }

        let reasonHTML = '';
        if (req.reason) {
            reasonHTML = `<div style="margin-bottom:4px;"><strong style="color:var(--text);">📝 ${__('common.reason') || 'Сабаб'}:</strong> ${req.reason}</div>`;
        }

        let photoHTML = '';
        if (req.photo) {
            photoHTML = `<div style="margin-top: 10px; max-height: 150px; overflow: hidden; border-radius: 8px; cursor: zoom-in;" onclick="openImageZoomModal('${req.photo}')">
                <img src="${req.photo}" style="width: 100%; height: auto; max-height: 150px; object-fit: cover;">
            </div>`;
        }

        const descText = __('balance.reject_withdrawal_desc', { amount: req.amount, sym: sym });

        const div = document.createElement('div');
        div.className = 'task-card';
        div.style.cssText = `display: flex; flex-direction: column; padding: 16px; border-radius: 16px; margin-bottom: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); ${cardStyle}`;
        div.innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">${badgeText}</span>
                <span style="font-size: 10px; color: var(--text-light);">${formatDate(req.date)}</span>
            </div>
            <h3 style="font-size: 16px; font-weight: 700; margin: 0 0 6px 0; color: var(--text);">${__('balance.status.rejected') || 'Рад шуд'}</h3>
            <p style="font-size: 13px; color: var(--text-secondary); margin: 0 0 8px 0; line-height: 1.4;">${descText}</p>
            ${reasonHTML}
            ${parentCommentHTML}
            ${photoHTML}
            <div style="display: flex; gap: 10px; margin-top: 12px; width: 100%;">
                <button class="btn btn-primary child-acknowledge-withdraw-btn" data-id="${req.id}" style="flex: 1; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center; font-size: 13px; background: var(--danger); border-color: var(--danger);">Ҳамааш хуб, қабул мекунам</button>
            </div>
        `;
        container.appendChild(div);
    });

    // 2. Render Rewards & Punishments
    child.rewardsPunishments = child.rewardsPunishments || [];
    const pendingRevPun = child.rewardsPunishments.filter(item => item.status === 'pending' || item.status === 'disputed');
    
    pendingRevPun.forEach(item => {
        const isReward = item.type === 'reward';
        const isDisputed = item.status === 'disputed';
        const cardStyle = isReward 
            ? "background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(5, 150, 105, 0.08) 100%); border: 1.5px solid rgba(16, 185, 129, 0.3); color: var(--text);"
            : "background: linear-gradient(135deg, rgba(239, 68, 68, 0.08) 0%, rgba(220, 38, 38, 0.08) 100%); border: 1.5px solid rgba(239, 68, 68, 0.3); color: var(--text);";
        
        const badgeText = isReward 
            ? `🟢 ${__('revpun.reward_label') || 'Мукофот аз волид'}` 
            : `🔴 ${__('revpun.punish_label') || 'Ҷарима аз волид'}`;
        
        const starsText = item.stars > 0 ? `⭐ +${item.stars} ` : '';
        const goldText = item.gold > 0 ? `🪙 +${item.gold}` : '';
        const valueText = isReward 
            ? `${starsText}${goldText}`.trim()
            : `⭐ -${item.stars} 🪙 -${item.gold}`.trim();
        
        let photoHTML = '';
        if (item.photo) {
            photoHTML = `<div style="margin-top: 10px; max-height: 150px; overflow: hidden; border-radius: 8px; cursor: zoom-in;" onclick="openImageZoomModal('${item.photo}')">
                <img src="${item.photo}" style="width: 100%; height: auto; max-height: 150px; object-fit: cover;">
            </div>`;
        }

        let disputeStatusHTML = '';
        if (isDisputed) {
            disputeStatusHTML = `<div style="font-size:12px; font-weight:700; color:var(--warning); margin-top:8px;">⚠️ Шумо инро баҳс кардед (Сабаб: "${item.disputeReason}")</div>`;
        }

        let buttonsHTML = '';
        if (!isDisputed) {
            buttonsHTML = `
            <div style="display: flex; gap: 10px; margin-top: 12px; width: 100%;">
                <button class="btn btn-primary child-accept-revpun-btn" data-id="${item.id}" style="flex: 1; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center; font-size: 13px; background: ${isReward ? 'var(--success)' : 'var(--danger)'}; border-color: ${isReward ? 'var(--success)' : 'var(--danger)'};">Қабул кардан</button>
                <button class="btn btn-outline child-dispute-revpun-btn" data-id="${item.id}" style="flex: 1; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center; font-size: 13px; color: var(--warning); border-color: rgba(245, 158, 11, 0.4);">Баҳс кардан</button>
            </div>`;
        } else {
            buttonsHTML = `
            <div style="display: flex; gap: 10px; margin-top: 12px; width: 100%;">
                <button class="btn btn-primary child-accept-revpun-btn" data-id="${item.id}" style="flex: 1; height: 36px; padding: 0; display: flex; align-items: center; justify-content: center; font-size: 13px; background: ${isReward ? 'var(--success)' : 'var(--danger)'}; border-color: ${isReward ? 'var(--success)' : 'var(--danger)'};">Ҳамааш хуб, қабул мекунам</button>
            </div>`;
        }

        const div = document.createElement('div');
        div.className = 'task-card';
        div.style.cssText = `display: flex; flex-direction: column; padding: 16px; border-radius: 16px; margin-bottom: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); ${cardStyle}`;
        div.innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">${badgeText}</span>
                <span style="font-size: 10px; color: var(--text-light);">${formatDate(item.timestamp)}</span>
            </div>
            <h3 style="font-size: 16px; font-weight: 700; margin: 0 0 6px 0; color: var(--text);">${item.title}</h3>
            ${item.description ? `<p style="font-size: 13px; color: var(--text-secondary); margin: 0 0 8px 0; line-height: 1.4;">${item.description}</p>` : ''}
            <div style="font-size: 15px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                <span>Таъсир:</span> <span style="color: ${isReward ? 'var(--success)' : 'var(--danger)'}; background: rgba(255,255,255,0.15); padding: 2px 8px; border-radius: 20px;">${valueText}</span>
            </div>
            ${photoHTML}
            ${disputeStatusHTML}
            ${buttonsHTML}
        `;
        container.appendChild(div);
    });
}

function attachRewardsPunishmentsListeners(container) {
    container.querySelectorAll('.child-accept-revpun-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const id = this.dataset.id;
            acceptRewardPunishment(id);
        });
    });
    container.querySelectorAll('.child-dispute-revpun-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const id = this.dataset.id;
            disputeRewardPunishment(id);
        });
    });
    container.querySelectorAll('.child-acknowledge-withdraw-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const id = this.dataset.id;
            acknowledgeRejectedWithdrawal(id);
        });
    });
}

function acknowledgeRejectedWithdrawal(id) {
    const child = getCurrentChild();
    if (!child || !child.withdrawals) return;
    const req = child.withdrawals.find(w => w.id === id);
    if (req) {
        req.acknowledged = true;
        saveState();
        if (typeof renderTasks === 'function') renderTasks();
        if (typeof updateUI === 'function') updateUI();
    }
}

function approveSkipRequest(childId, taskId) {
    const child = getChild ? getChild(childId) : state.children.find(c => c.id === childId);
    if (!child) return;
    const today = getToday();
    const log = child.dailyLogs[today] || getOrCreateDailyLog(child.id);
    const tl = log.tasks[taskId];
    if (!tl) return;

    // Refund penalty if applied
    if (tl.penaltyApplied) {
        if (tl.penaltyApplied.stars > 0) {
            child.stars = (child.stars || 0) + tl.penaltyApplied.stars;
            child.totalDeducted = Math.max(0, (child.totalDeducted || 0) - tl.penaltyApplied.stars);
        }
        if (tl.penaltyApplied.gold > 0) {
            child.balance = (child.balance || 0) + tl.penaltyApplied.gold;
            child.totalDeducted = Math.max(0, (child.totalDeducted || 0) - tl.penaltyApplied.gold);
        }
        delete tl.penaltyApplied;
    }

    tl.status = 'excused';
    tl.confirmed = true;
    tl.excuseReason = tl.skipReason || '';
    if (tl.skipPhoto) {
        tl.excusePhoto = tl.skipPhoto;
    }
    
    delete tl.missedDeadline;
    delete tl.skipReason;
    delete tl.skipPhoto;
    delete tl.rejectReason;
    delete tl.rejectPhoto;

    saveState();
    showToast('🙏', __('parent.excused_toast') || 'Супориш узрнок ҳисоб карда шуд!');
    
    if (typeof renderTasks === 'function') renderTasks();
    if (typeof renderCalendar === 'function') renderCalendar();
    if (typeof renderParentDashboard === 'function') renderParentDashboard();
    if (typeof updateUI === 'function') updateUI();
}

function rejectSkipRequest(childId, taskId) {
    const child = getChild ? getChild(childId) : state.children.find(c => c.id === childId);
    if (!child) return;
    const today = getToday();
    const log = child.dailyLogs[today] || getOrCreateDailyLog(child.id);
    const tl = log.tasks[taskId];
    if (!tl) return;

    showCustomPrompt(
        __('parent.reject_title') || 'Рад кардани супориш',
        __('parent.reject_reason_prompt') || 'Сабаби радкуниро ворид кунед:'
    ).then(result => {
        if (result === null) return;
        const text = (result.text || '').trim();
        
        tl.status = 'failed';
        tl.confirmed = true;
        tl.rejectReason = text;
        if (result.photo) {
            tl.rejectPhoto = result.photo;
        }

        delete tl.missedDeadline;
        delete tl.skipReason;
        delete tl.skipPhoto;

        // Apply penalty
        const task = child.tasks.find(t => t.id === taskId) || child.bonusTasks.find(t => t.id === taskId);
        if (task && task.hasPenalty && !tl.penaltyApplied) {
            const starsPenalty = parseInt(task.penaltyStars !== undefined ? task.penaltyStars : 1) || 0;
            const goldPenalty = parseInt(task.penaltyGold !== undefined ? task.penaltyGold : 1) || 0;
            
            tl.penaltyApplied = { stars: 0, gold: 0 };
            if (starsPenalty > 0) {
                child.stars = Math.max(0, (child.stars || 0) - starsPenalty);
                child.totalDeducted = (child.totalDeducted || 0) + starsPenalty;
                tl.penaltyApplied.stars = starsPenalty;
            }
            if (goldPenalty > 0) {
                child.balance = Math.max(0, (child.balance || 0) - goldPenalty);
                child.totalDeducted = (child.totalDeducted || 0) + goldPenalty;
                tl.penaltyApplied.gold = goldPenalty;
            }
        }

        saveState();
        showToast('❌', __('parent.rejected_toast') || 'Дархости узрнок рад карда шуд!');
        
        if (typeof renderTasks === 'function') renderTasks();
        if (typeof renderCalendar === 'function') renderCalendar();
        if (typeof renderParentDashboard === 'function') renderParentDashboard();
        if (typeof updateUI === 'function') updateUI();
    });
}
