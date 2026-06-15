import { create } from 'zustand';

export type ProjectType = 'Landing' | 'Promo' | 'Corporate' | 'Ecommerce' | 'Portal' | 'SaaS' | 'Immersive' | 'Sovereign';
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
        localpay: boolean;
        velocity: boolean;
        crm: boolean;
        telegram: boolean;
        security: boolean;
        erp: boolean;
    };
    totalPrice: number;
    originalPrice: number;
    monthlyTotal: number;
    isFounderRateActive: boolean;

    setProjectType: (type: ProjectType) => void;
    setLanguages: (count: number) => void;
    setSupport: (level: SupportLevel) => void;
    setMomentum: (protocol: MomentumProtocol) => void;
    setBillingCycle: (cycle: BillingCycle) => void;
    setFounderRateActive: (active: boolean) => void;
    toggleAddon: (addon: 'seo' | 'ai' | 'branding' | 'infrastructure' | 'ads' | 'smm' | 'adsense' | 'maps' | 'narrative' | 'kinetic' | 'localpay' | 'velocity' | 'crm' | 'telegram' | 'security' | 'erp') => void;
    calculate: () => void;
}

const BASE_PRICES: Record<ProjectType, number> = {
    Landing: 999,
    Promo: 2499,
    Corporate: 4999,
    Ecommerce: 9999,
    Immersive: 12000,
    Sovereign: 15000,
    Portal: 19999,
    SaaS: 29999,
};

const SUPPORT_PRICES: Record<SupportLevel, number> = {
    None: 0,
    Standard: 300,
    Elite: 900,
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
        localpay: false,
        velocity: false,
        crm: false,
        telegram: false,
        security: false,
        erp: false,
    },
    totalPrice: 999,
    originalPrice: 999,
    monthlyTotal: 0,
    isFounderRateActive: true,

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
    setFounderRateActive: (isFounderRateActive) => {
        set({ isFounderRateActive });
        get().calculate();
    },
    toggleAddon: (addon) => {
        set((state) => ({
            addons: { ...state.addons, [addon]: !state.addons[addon] },
        }));
        get().calculate();
    },

    calculate: () => {
        const { projectType, languages, support, momentum, billingCycle, addons, isFounderRateActive } = get();

        let base = BASE_PRICES[projectType];
        // Narrative: added to base
        let localeBase = base + (addons.narrative ? 500 : 0);
        
        // Locales (+30% for each extra language beyond the first)
        let extraLangs = Math.max(0, languages - 1);
        let total = localeBase * (1 + (extraLangs * 0.3));

        // Add-ons
        if (addons.ads) total += 500;
        if (addons.infrastructure) total += 300;
        if (addons.seo) total += 500;
        if (addons.ai) total += 1500;
        if (addons.branding) total += 800;
        if (addons.smm) total += 700;
        if (addons.adsense) total += 500;
        if (addons.maps) total += 300;
        if (addons.kinetic) total += 800;
        if (addons.localpay) total += 1200;
        if (addons.velocity) total += 600;
        if (addons.crm) total += 900;
        if (addons.telegram) total += 800;
        if (addons.security) total += 1000;
        if (addons.erp) total += 1500;

        // Momentum Multiplier (applied only to development cost)
        if (momentum === 'Fast') total *= 1.2;
        if (momentum === 'Ultra') total *= 1.5;

        let originalTotal = total;

        // Founder Rate (-30% discount), does NOT apply to Landing
        if (isFounderRateActive && projectType !== 'Landing') {
            total *= 0.7;
        }

        // Support calculation (billed separately)
        let supportCost = SUPPORT_PRICES[support];
        if (billingCycle === 'Yearly' && projectType !== 'Landing') {
            supportCost = supportCost * 0.7; // 30% discount
        }

        set({ 
            totalPrice: Math.round(total),
            originalPrice: Math.round(originalTotal),
            monthlyTotal: Math.round(supportCost)
        });
    },
}));
