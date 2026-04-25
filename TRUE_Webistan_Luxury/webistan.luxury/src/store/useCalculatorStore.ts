import { create } from 'zustand';

export type ProjectType = 'landing' | 'promo' | 'corporate' | 'ecommerce' | 'portal' | 'saas' | 'immersive' | 'sovereign';
export type SupportLevel = 'none' | 'standard' | 'elite';
export type MomentumProtocol = 'standard' | 'fast' | 'ultra';
export type BillingCycle = 'monthly' | 'yearly';

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
    };
    totalPrice: number;
    originalPrice: number;
    monthlyTotal: number;
    isFounderRateActive: boolean;

    setProjectType: (type: ProjectType) => void
    setLanguages: (count: number) => void
    setSupport: (level: SupportLevel) => void
    setMomentum: (protocol: MomentumProtocol) => void
    setBillingCycle: (cycle: BillingCycle) => void
    setFounderRateActive: (active: boolean) => void
    toggleAddon: (addon: 'seo' | 'ai' | 'branding' | 'infrastructure' | 'ads' | 'smm' | 'adsense' | 'maps' | 'narrative' | 'kinetic' | 'localpay' | 'velocity') => void
    calculate: () => void
}
const BASE_PRICES: Record<ProjectType, number> = {
    landing: 999,
    promo: 2499,
    corporate: 4999,
    ecommerce: 9999,
    immersive: 12000,
    sovereign: 15000,
    portal: 19999,
    saas: 29999,
}
const SUPPORT_PRICES: Record<SupportLevel, number> = {
    none: 0,
    standard: 300,
    elite: 900,
};

export const useCalculatorStore = create<CalculatorState>((set, get) => ({
    projectType: 'landing',
    languages: 1,
    support: 'none',
    momentum: 'standard',
    billingCycle: 'monthly',
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
let localeBase = base + (addons.narrative ? 500 : 0);
let extraLangs = Math.max(0, languages - 1);
let total = localeBase * (1 + (extraLangs * 0.3));

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

        if (momentum === 'fast') total *= 1.2;
        if (momentum === 'ultra') total *= 1.5;
let originalTotal = total;

        if (isFounderRateActive && projectType !== 'landing') {
            total *= 0.7;
        }

        let supportCost = SUPPORT_PRICES[support];
        if (billingCycle === 'yearly') {
            supportCost = supportCost * 0.7; 
        }

        set({ 
            totalPrice: Math.round(total),
            originalPrice: Math.round(originalTotal),
            monthlyTotal: Math.round(supportCost)
        });
    },
}));
