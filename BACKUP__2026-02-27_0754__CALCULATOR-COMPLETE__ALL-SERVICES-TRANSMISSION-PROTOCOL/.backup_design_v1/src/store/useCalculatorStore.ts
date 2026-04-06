import { create } from 'zustand';

export type ProjectType = 'Landing' | 'Corporate' | 'Ecommerce' | 'Portal' | 'SaaS' | 'Immersive';
export type SupportLevel = 'None' | 'Standard' | 'Elite';
export type MomentumProtocol = 'Standard' | 'Fast' | 'Ultra';
export type BillingCycle = 'Monthly' | 'Yearly';

interface CalculatorState {
    projectType: ProjectType;
    languages: number;
    support: SupportLevel;
    momentum: MomentumProtocol;
    billingCycle: BillingCycle;
    addons: {
        seo: boolean;
        ai: boolean;
    };
    totalPrice: number;

    setProjectType: (type: ProjectType) => void;
    setLanguages: (count: number) => void;
    setSupport: (level: SupportLevel) => void;
    setMomentum: (protocol: MomentumProtocol) => void;
    setBillingCycle: (cycle: BillingCycle) => void;
    toggleAddon: (addon: 'seo' | 'ai') => void;
    calculate: () => void;
}

const BASE_PRICES: Record<ProjectType, number> = {
    Landing: 1500,
    Corporate: 3500,
    Ecommerce: 6500,
    Portal: 9000,
    SaaS: 12000,
    Immersive: 8000,
};

const SUPPORT_PRICES: Record<SupportLevel, number> = {
    None: 0,
    Standard: 200, // Monthly
    Elite: 600,    // Monthly
};

export const useCalculatorStore = create<CalculatorState>((set, get) => ({
    projectType: 'Landing',
    languages: 1,
    support: 'None',
    momentum: 'Standard',
    billingCycle: 'Monthly',
    addons: {
        seo: false,
        ai: false,
    },
    totalPrice: 1500,

    setProjectType: (projectType) => {
        set({ projectType });
        get().calculate();
    },
    setLanguages: (languages) => {
        set({ languages });
        get().calculate();
    },
    setSupport: (support) => {
        set({ support });
        get().calculate();
    },
    setMomentum: (momentum) => {
        set({ momentum });
        get().calculate();
    },
    setBillingCycle: (billingCycle) => {
        set({ billingCycle });
        get().calculate();
    },
    toggleAddon: (addon) => {
        set((state) => ({
            addons: { ...state.addons, [addon]: !state.addons[addon] },
        }));
        get().calculate();
    },

    calculate: () => {
        const { projectType, languages, support, momentum, billingCycle, addons } = get();

        let total = BASE_PRICES[projectType];

        // Add-ons
        if (addons.seo) total += 800;
        if (addons.ai) total += 1500;

        // Locales (+20% for each extra language beyond the first)
        const languageMultiplier = 1 + (Math.max(0, languages - 1) * 0.20);
        total *= languageMultiplier;

        // Support calculation
        let supportCost = SUPPORT_PRICES[support];
        if (billingCycle === 'Yearly') {
            supportCost = supportCost * 0.7; // 30% discount
        }
        total += supportCost;

        // Momentum Multiplier
        if (momentum === 'Fast') total *= 1.2;
        if (momentum === 'Ultra') total *= 1.5;

        set({ totalPrice: Math.round(total) });
    },
}));
