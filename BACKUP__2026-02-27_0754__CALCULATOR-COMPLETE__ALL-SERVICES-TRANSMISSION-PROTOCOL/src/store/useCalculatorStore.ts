import { create } from 'zustand';

export type ProjectType = 'Landing' | 'Corporate' | 'Ecommerce' | 'Portal' | 'SaaS' | 'Immersive' | 'Sovereign';
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
        branding: boolean;
        infrastructure: boolean;
        ads: boolean;
        smm: boolean;
        adsense: boolean;
        maps: boolean;
        narrative: boolean;
        kinetic: boolean;
        linguistic: boolean;
        velocity: boolean;
    };
    totalPrice: number;

    setProjectType: (type: ProjectType) => void;
    setLanguages: (count: number) => void;
    setSupport: (level: SupportLevel) => void;
    setMomentum: (protocol: MomentumProtocol) => void;
    setBillingCycle: (cycle: BillingCycle) => void;
    toggleAddon: (addon: 'seo' | 'ai' | 'branding' | 'infrastructure' | 'ads' | 'smm' | 'adsense' | 'maps' | 'narrative' | 'kinetic' | 'linguistic' | 'velocity') => void;
    calculate: () => void;
}

const BASE_PRICES: Record<ProjectType, number> = {
    Landing: 7500,
    Corporate: 17500,
    Ecommerce: 32500,
    Portal: 45000,
    SaaS: 60000,
    Immersive: 40000,
    Sovereign: 12000,
};

const SUPPORT_PRICES: Record<SupportLevel, number> = {
    None: 0,
    Standard: 1000, // Monthly TJS
    Elite: 3000,    // Monthly TJS
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
        branding: false,
        infrastructure: false,
        ads: false,
        smm: false,
        adsense: false,
        maps: false,
        narrative: false,
        kinetic: false,
        linguistic: false,
        velocity: false,
    },
    totalPrice: 7500,

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
        if (addons.seo) total += 2000;           // Search Architecture
        if (addons.ai) total += 3750;            // Neural Protocol
        if (addons.branding) total += 3000;      // Visual Identity (updated)
        if (addons.infrastructure) total += 1000; // Digital Real Estate
        if (addons.ads) total += 3000;           // Market Penetration
        if (addons.smm) total += 2500;           // Social Audit
        if (addons.adsense) total += 1500;       // Monetization Engine
        if (addons.maps) total += 1000;          // Interactive Geolocation
        if (addons.narrative) total += 3000;     // Narrative Architecture (midpoint 2500-4000)
        if (addons.kinetic) total += 2500;       // Kinetic Elegance
        if (addons.velocity) total += 1750;      // Performance Velocity Tuning (midpoint)

        // Linguistic Expansion: +27.5% on current total (before support)
        if (addons.linguistic) total *= 1.275;

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
