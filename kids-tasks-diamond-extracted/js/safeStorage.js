/**
 * Safe Storage Wrapper
 * Prevents SecurityError / QuotaExceededError exceptions in private/incognito mode
 * or when cookies and local storage are disabled by the browser.
 */

window.safeStorage = {
    _inMemory: {},
    getItem(key) {
        try {
            return localStorage.getItem(key);
        } catch (e) {
            console.warn(`safeStorage.getItem failed for key "${key}", using fallback memory:`, e);
            return this._inMemory[key] !== undefined ? this._inMemory[key] : null;
        }
    },
    setItem(key, value) {
        try {
            localStorage.setItem(key, value);
        } catch (e) {
            console.warn(`safeStorage.setItem failed for key "${key}", using fallback memory:`, e);
            this._inMemory[key] = String(value);
        }
    },
    removeItem(key) {
        try {
            localStorage.removeItem(key);
        } catch (e) {
            console.warn(`safeStorage.removeItem failed for key "${key}", using fallback memory:`, e);
            delete this._inMemory[key];
        }
    },
    clear() {
        try {
            localStorage.clear();
        } catch (e) {
            console.warn("safeStorage.clear failed, clearing fallback memory:", e);
            this._inMemory = {};
        }
    }
};

window.safeSessionStorage = {
    _inMemory: {},
    getItem(key) {
        try {
            return sessionStorage.getItem(key);
        } catch (e) {
            console.warn(`safeSessionStorage.getItem failed for key "${key}", using fallback memory:`, e);
            return this._inMemory[key] !== undefined ? this._inMemory[key] : null;
        }
    },
    setItem(key, value) {
        try {
            sessionStorage.setItem(key, value);
        } catch (e) {
            console.warn(`safeSessionStorage.setItem failed for key "${key}", using fallback memory:`, e);
            this._inMemory[key] = String(value);
        }
    },
    removeItem(key) {
        try {
            sessionStorage.removeItem(key);
        } catch (e) {
            console.warn(`safeSessionStorage.removeItem failed for key "${key}", using fallback memory:`, e);
            delete this._inMemory[key];
        }
    },
    clear() {
        try {
            sessionStorage.clear();
        } catch (e) {
            console.warn("safeSessionStorage.clear failed, clearing fallback memory:", e);
            this._inMemory = {};
        }
    }
};
