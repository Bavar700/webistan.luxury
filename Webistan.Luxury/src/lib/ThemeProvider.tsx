'use client';

import { createContext, useContext, useEffect } from 'react';

type Theme = 'dark';

interface ThemeContextType {
    theme: Theme;
    toggleTheme: () => void;
}

const ThemeContext = createContext<ThemeContextType | undefined>(undefined);

export function ThemeProvider({ children }: { children: React.ReactNode }) {
    useEffect(() => {
        document.documentElement.setAttribute('data-theme', 'dark');
        // Clear any previously saved light theme preference
        localStorage.removeItem('theme');
    }, []);

    return (
        <ThemeContext.Provider value={{ theme: 'dark', toggleTheme: () => {} }}>
            {children}
        </ThemeContext.Provider>
    );
}

export const useTheme = () => {
    const context = useContext(ThemeContext);
    if (!context) throw new Error('useTheme must be used within ThemeProvider');
    return context;
};
