<?php wp_body_open(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Inter:wght@300;400;500;600;700;800;900&family=Mr+Dafoe&display=swap" rel="stylesheet">
    <style>
        /* ============================================================
           NEKSOZ.LUXURY — Premium Corporate Design System v2
           Built around logo geometry: angular lines, red/blue gradients
           ============================================================ */

        :root {
            /* ── Logo-Derived Palette ── */
            --nk-red: #E30613;
            --nk-red-dark: #B50510;
            --nk-red-bright: #FF1A2D;
            --nk-blue: #0044CC;
            --nk-blue-light: #1166FF;
            --nk-blue-bright: #3388FF;
            --nk-blue-deep: #001A66;
            --nk-navy: #000D33;

            /* ── Gradients (matching logo brush strokes) ── */
            --nk-grad-red: linear-gradient(135deg, #E30613 0%, #FF3344 100%);
            --nk-grad-blue: linear-gradient(135deg, #0044CC 0%, #2277FF 100%);
            --nk-grad-brand: linear-gradient(135deg, #E30613 0%, #CC0033 25%, #0044CC 75%, #2277FF 100%);
            --nk-grad-hero: linear-gradient(160deg, #000D33 0%, #001A66 40%, #002288 100%);
            --nk-grad-dark: linear-gradient(180deg, #000D33 0%, #001133 100%);
            --nk-grad-subtle: linear-gradient(135deg, rgba(0,68,204,0.04) 0%, rgba(227,6,19,0.03) 100%);

            /* ── Neutrals ── */
            --nk-white: #FFFFFF;
            --nk-off-white: #F7F8FA;
            --nk-gray-50: #F2F4F7;
            --nk-gray-100: #E4E7EC;
            --nk-gray-200: #C8CDD6;
            --nk-gray-400: #8892A4;
            --nk-gray-600: #4B5468;
            --nk-gray-800: #1D2939;
            --nk-gray-900: #101828;

            /* ── Typography ── */
            --font-display: 'Noto Serif', serif;
            --font-body: 'Montserrat', sans-serif;

            /* ── Geometry ── */
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 16px;
            --radius-xl: 24px;

            /* ── Motion ── */
            --ease: cubic-bezier(0.16, 1, 0.3, 1);
            --ease-out: cubic-bezier(0, 0, 0.2, 1);
            --duration: 0.4s;
        }

        /* ── Reset ── */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        body {
            font-family: var(--font-body);
            font-size: 16px;
            line-height: 1.65;
            color: var(--nk-gray-800);
            background: var(--nk-white);
            overflow-x: hidden;
        }
        img { max-width: 100%; height: auto; display: block; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }

        /* ── Container ── */
        .container { max-width: 100% !important; margin: 0 auto !important; padding: 0 40px !important; }

        /* ============================================================
           HEADER — Premium Fixed Bar
           ============================================================ */
        .ceo-editorial__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .ceo-editorial__circle-frame {
            border-radius: 50%;
            border: 8px solid var(--nk-red);
            padding: 4px;
            background: var(--nk-white);
            box-shadow: 0 20px 40px rgba(227,6,19,0.15);
            flex-shrink: 0;
            overflow: hidden;
        }

        .ceo-editorial__avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 100;
            height: 77px;
            display: flex;
            align-items: center;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            transition: all 0.3s var(--ease);
        }

        .header__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .header__logo-link {
            display: inline-block;
            position: relative;
            overflow: hidden;
            border-radius: var(--radius-sm);
        }

        .header__logo-link::after {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 150%;
            height: 100%;
            background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.4) 30%, rgba(255,255,255,0.95) 50%, rgba(255,255,255,0.4) 70%, rgba(255,255,255,0) 100%);
            transform: skewX(-25deg);
            animation: shimmer 5s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }

        @keyframes shimmer {
            0% { left: -150%; }
            35% { left: 150%; }
            100% { left: 150%; }
        }

        .header__logo {
            height: 38px;
            width: auto;
            display: block;
        }

        .header__nav {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .header__nav a {
            padding: 8px 18px;
            font-family: var(--font-display);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.04em;
            color: var(--nk-gray-600);
            border-radius: var(--radius-md);
            transition: all 0.25s var(--ease);
        }

        .header__nav a:hover {
            color: var(--nk-blue);
            background: rgba(0,68,204,0.06);
        }

        .header__actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
        }

        .header__icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: var(--radius-md);
            transition: all 0.3s var(--ease);
            text-decoration: none;
        }

        .header__icon svg {
            width: 24px;
            height: 24px;
            fill: currentColor;
        }

        /* Telegram */
        .header__icon--tg {
            color: #0088cc;
            background: rgba(0, 136, 204, 0.08);
        }
        .header__icon--tg:hover {
            background: #0088cc;
            color: var(--nk-white);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 136, 204, 0.3);
        }

        /* WhatsApp */
        .header__icon--wa {
            color: #25D366;
            background: rgba(37, 211, 102, 0.08);
        }
        .header__icon--wa:hover {
            background: #25D366;
            color: var(--nk-white);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        }

        /* Phone (Accent Red) */
        .header__icon--phone {
            color: var(--nk-red);
            background: rgba(227, 6, 19, 0.08);
        }
        .header__icon--phone:hover {
            background: var(--nk-red);
            color: var(--nk-white);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(227, 6, 19, 0.3);
        }

        /* ── Language Switcher — Premium Oval Design ── */
        .lang-switcher {
            display: flex;
            align-items: center;
            background: rgba(0, 13, 51, 0.03);
            border-radius: 100px;
            padding: 3px;
            gap: 1px;
            border: 1px solid rgba(0, 0, 0, 0.02);
            margin-left: auto;
        }

        .lang-switcher__item {
            font-family: var(--font-display);
            font-size: 11px;
            font-weight: 700;
            color: var(--nk-gray-400);
            padding: 8px 14px;
            border-radius: 100px;
            transition: all 0.3s var(--ease);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            text-decoration: none;
        }

        .lang-switcher__item:hover {
            color: var(--nk-blue);
        }

        .lang-switcher__item.is-active {
            background: var(--nk-white);
            color: var(--nk-red);
            font-weight: 900;
            box-shadow: none;
        }

        /* ============================================================
           HERO — Dark Corporate with Angular Geometry
           ============================================================ */
        .hero {
            position: relative;
            min-height: 60vh !important;
            display: flex !important;
            align-items: flex-start !important;
            background: var(--nk-grad-hero);
            overflow: hidden;
            padding-top: 160px !important;
            padding-bottom: 80px !important;
        }

        .hero--internal {
            min-height: 60vh !important;
            padding-top: 160px !important;
            padding-bottom: 80px !important;
            align-items: flex-start !important;
        }

        /* Hero styles are now unified across all pages */

        /* Angular geometric shapes echoing logo */
        .hero__geo {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .hero__geo::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -5%;
            width: 700px;
            height: 700px;
            background: linear-gradient(135deg, rgba(227,6,19,0.08) 0%, rgba(227,6,19,0.02) 100%);
            transform: rotate(45deg);
            border-radius: 0;
        }

        .hero__geo::after {
            content: '';
            position: absolute;
            bottom: -15%;
            right: 20%;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, rgba(0,68,204,0.12) 0%, rgba(34,119,255,0.04) 100%);
            transform: rotate(30deg);
            border-radius: 0;
        }

        /* Red diagonal accent line (like logo's angular slash) */
        .hero__accent-line {
            position: absolute;
            top: 0;
            right: 30%;
            width: 2px;
            height: 120%;
            background: linear-gradient(180deg, transparent 0%, rgba(227,6,19,0.3) 30%, rgba(227,6,19,0.1) 70%, transparent 100%);
            transform: rotate(-15deg);
            transform-origin: top center;
        }

        .hero__accent-line-2 {
            position: absolute;
            top: -10%;
            right: 28%;
            width: 1px;
            height: 120%;
            background: linear-gradient(180deg, transparent 0%, rgba(0,68,204,0.2) 40%, rgba(0,68,204,0.05) 80%, transparent 100%);
            transform: rotate(-15deg);
            transform-origin: top center;
        }

        /* Subtle grid pattern */
        .hero__grid-pattern {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 80px 80px;
            pointer-events: none;
        }

        .hero__content { position: relative; z-index: 2; max-width: 100% !important; }

        .hero__badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            font-family: var(--font-display);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 100px;
            margin-bottom: 32px;
            backdrop-filter: blur(8px);
            background: rgba(255,255,255,0.03);
        }

        .hero__badge::before {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--nk-red);
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(227,6,19,0.6);
            animation: pulse-dot 1s infinite alternate;
        }

        @keyframes pulse-dot {
            0% { 
                opacity: 0.3; 
                transform: scale(0.9); 
                box-shadow: 0 0 2px rgba(227,6,19,0.3); 
            }
            100% { 
                opacity: 1; 
                transform: scale(1.2); 
                box-shadow: 0 0 12px rgba(227,6,19,0.9); 
            }
        }

        .hero__title {
            font-family: var(--font-display);
            font-size: clamp(3rem, 8vw, 5.5rem); /* Reduced to match About Us style */
            font-weight: 800; /* Reverted to 800 from 900 for cleaner look */
            line-height: 1.1;
            color: var(--nk-white);
            margin-bottom: 24px; /* Synchronized with Vacancies page distance */
            letter-spacing: -0.015em;
            text-transform: none;
        }

        .hero__title em {
            font-style: normal;
            position: relative;
            color: var(--nk-white);
        }

        .hero__desc {
            font-size: 0.9rem; /* Further reduced as requested for sleek professional look */
            line-height: 1.7;
            color: rgba(255,255,255,0.8);
            margin-bottom: 0;
            max-width: 650px;
            font-weight: 500;
            opacity: 0.9;
        }

        .hero__container {
            display: flex !important;
            flex-direction: row !important;
            align-items: flex-end !important;
            justify-content: space-between !important;
            width: 100% !important;
            gap: 40px !important;
            position: relative;
            z-index: 5;
        }

        .hero__actions--right { 
            display: flex !important; 
            flex-direction: row !important; 
            flex-wrap: nowrap !important; 
            gap: 15px !important; 
            align-items: flex-end !important; 
            margin: 0 !important;
            padding: 0 0 15px 0 !important; /* Final adjustment to guarantee buttons are on or above text baseline */
            justify-content: flex-end !important;
            flex-shrink: 0 !important;
        }
        .hero__actions--right .btn {
            width: auto !important;
            display: inline-flex !important;
            white-space: nowrap !important;
            padding: 12px 28px !important; /* Small button style like About page */
            font-size: 11px !important;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }


        .btn-animated {
            animation: pulse-primary 3s infinite;
            transition: all 0.4s var(--ease) !important;
        }
        .btn-animated:hover {
            transform: translateY(-4px) scale(1.02) !important;
            box-shadow: 0 15px 40px rgba(227,6,19,0.3) !important;
        }
        @keyframes pulse-primary {
            0% { box-shadow: 0 0 0 0 rgba(227,6,19,0.5); }
            70% { box-shadow: 0 0 0 20px rgba(227,6,19,0); }
            100% { box-shadow: 0 0 0 0 rgba(227,6,19,0); }
        }

        .btn-animated-light {
            animation: pulse-light 3s infinite;
            animation-delay: 1.5s;
            transition: all 0.4s var(--ease) !important;
        }
        .btn-animated-light:hover {
            transform: translateY(-4px) scale(1.02) !important;
            box-shadow: 0 15px 40px rgba(255,255,255,0.2) !important;
            background: #FFFFFF !important;
            color: var(--nk-blue) !important;
        }
        @keyframes pulse-light {
            0% { box-shadow: 0 0 0 0 rgba(255,255,255,0.3); }
            70% { box-shadow: 0 0 0 20px rgba(255,255,255,0); }
            100% { box-shadow: 0 0 0 0 rgba(255,255,255,0); }
        }

        }

        /* Subtlest background tint to define the ribbon */
        .stats-ribbon__inner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(0,68,204,0.02), rgba(227,6,19,0.01));
            z-index: 0;
            pointer-events: none;
        }

        .stats-card {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            padding: 0 24px;
            border-right: 1px solid rgba(0, 68, 204, 0.03);
            transition: all 0.4s var(--ease);
            z-index: 1;
        }
        .stats-card:last-child { border-right: none; }

        .stats-card:hover {
            background: rgba(255, 255, 255, 1);
            transform: scale(1.02);
            box-shadow: inset 0 0 40px rgba(0,68,204,0.02);
        }

        .stats-card__icon-box {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--nk-gray-50);
            color: var(--nk-gray-900);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s var(--ease);
            flex-shrink: 0;
        }

        .stats-card:hover .stats-card__icon-box {
            background: var(--nk-white);
            box-shadow: 0 8px 24px rgba(0,68,204,0.12);
            color: var(--nk-blue);
        }

        .stats-card__value {
            font-family: var(--font-display);
            font-size: 2.8rem;
            font-weight: 700; /* Increased size significantly for visibility */
            font-weight: 900;
            color: var(--nk-gray-900);
            line-height: 1;
            letter-spacing: -0.02em;
        }
        
        .stats-card__label {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--nk-gray-400); /* Slightly darker for better visibility */
            line-height: 1.2;
            max-width: 100px;
        }

        .stats-card__value span { color: var(--nk-red); margin-left: 2px; }
        .stats-card:nth-child(even) .stats-card__value span { color: var(--nk-blue); }
        
        .stats-card__label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--nk-gray-400);
            line-height: 1.2;
            max-width: 60px; /* Force small two-line text if needed */
        }

        /* Unique Animation: Soft Neon Glow Pulse on Hover */
        .stats-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; width: 100%; height: 3px;
            background: var(--nk-grad-brand);
            transform: scaleX(0);
            transition: transform 0.4s var(--ease);
            transform-origin: center;
        }
        .stats-card:hover::after { transform: scaleX(1); }
        .stats-card__value span { color: var(--nk-red); }
        .stats-card:nth-child(even) .stats-card__value span { color: var(--nk-blue); }
        
        .stats-card__label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--nk-gray-400);
            margin-top: 2px;
        }
        .stats-card__value span { color: var(--nk-red); margin-left: 2px; }
        .stats-card:nth-child(even) .stats-card__value span { color: var(--nk-blue); }
        
        .stats-card:hover .stats-card__label { color: var(--nk-gray-900); }
        .stats-card__line { display: none; }

        /* ── Stats Ribbon: Subtle Background Shimmer ── */
        .stats-ribbon-block .service-card {
            isolation: isolate;
        }
        .stats-ribbon-block .service-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(0, 68, 204, 0.06) 0%,
                transparent 40%,
                transparent 60%,
                rgba(227, 6, 19, 0.04) 100%
            );
            background-size: 250% 250%;
            animation: stats-shimmer 6s ease-in-out infinite alternate;
            pointer-events: none;
            border-radius: inherit;
            z-index: 0;
        }
        .stats-ribbon-block .service-card--alt::after {
            background: linear-gradient(
                135deg,
                rgba(227, 6, 19, 0.05) 0%,
                transparent 40%,
                transparent 60%,
                rgba(0, 68, 204, 0.04) 100%
            );
            background-size: 250% 250%;
            animation: stats-shimmer-alt 7s ease-in-out infinite alternate;
        }
        @keyframes stats-shimmer {
            0%   { background-position: 0% 0%; opacity: 0.6; }
            50%  { background-position: 100% 100%; opacity: 1; }
            100% { background-position: 0% 100%; opacity: 0.7; }
        }
        @keyframes stats-shimmer-alt {
            0%   { background-position: 100% 0%; opacity: 0.7; }
            50%  { background-position: 0% 100%; opacity: 1; }
            100% { background-position: 100% 100%; opacity: 0.6; }
        }


        .text-gradient {
            background: var(--nk-grad-brand);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: inline-block;
        }

        .section__label--pulse::before {
            animation: width-pulse 2.5s infinite alternate ease-in-out;
            max-width: 100%;
        }

        @keyframes width-pulse {
            0% { width: 12px; opacity: 0.5; }
            100% { width: 48px; opacity: 1; }
        }

        .section__subtitle--free {
            font-size: 1.15rem;
            color: var(--nk-gray-600);
            max-width: 100% !important;
            margin: 24px auto 0;
            line-height: 1.6;
        }

        .section__subtitle--free strong {
            color: var(--nk-gray-900);
            font-weight: 700;
        }

        /* ============================================================
           BUTTONS
           ============================================================ */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 36px;
            font-family: var(--font-display);
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.02em;
            border-radius: var(--radius-md);
            border: none;
            cursor: pointer;
            transition: all 0.3s var(--ease);
            text-decoration: none;
        }

        .btn--primary {
            background: var(--nk-red);
            color: var(--nk-white);
            box-shadow: 0 2px 8px rgba(227,6,19,0.25);
        }

        .btn--primary:hover {
            background: var(--nk-red-bright);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(227,6,19,0.35);
        }

        .btn--outline-light {
            background: transparent;
            color: rgba(255,255,255,0.7);
            border: 1.5px solid rgba(255,255,255,0.15);
        }

        .btn--outline-light:hover {
            color: var(--nk-white);
            border-color: rgba(255,255,255,0.35);
            background: rgba(255,255,255,0.05);
        }

        .btn--blue {
            background: var(--nk-blue);
            color: var(--nk-white);
        }

        .btn--blue:hover {
            background: var(--nk-blue-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,68,204,0.3);
        }

        .btn--ghost {
            background: transparent;
            color: var(--nk-blue);
            border: 1.5px solid var(--nk-gray-100);
        }

        .btn--ghost:hover {
            border-color: var(--nk-blue);
            background: rgba(0,68,204,0.04);
        }

        .btn__arrow {
            transition: transform 0.3s var(--ease);
        }

        .btn:hover .btn__arrow {
            transform: translateX(3px);
        }

        /* ============================================================
           SECTION SYSTEM
           ============================================================ */
        .section {
            padding: 120px 0;
            position: relative;
        }

        .section--gray { background: var(--nk-gray-50); }

        .section--dark {
            background: var(--nk-grad-dark);
            color: var(--nk-white);
        }

        .section__label {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 8px 24px;
            font-family: var(--font-display);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--nk-gray-900);
            background: var(--nk-white);
            border: 1px solid var(--nk-gray-200);
            border-radius: 100px;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        .section__label::before {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--nk-red);
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(227,6,19,0.5);
            animation: pulse-dot 1s infinite alternate;
        }

        .section__title {
            font-family: var(--font-display);
            font-size: clamp(2rem, 4vw, 2.75rem);
            font-weight: 800;
            color: var(--nk-gray-900);
            line-height: 1.2;
            margin-bottom: 16px;
            letter-spacing: -0.01em;
        }
        
        .section__title--huge {
            font-size: clamp(2.5rem, 6vw, 4rem);
            margin-bottom: 32px;
            line-height: 1.25;
            letter-spacing: -0.01em;
            font-weight: 900;
        }

        .section__subtitle { font-size: 1.05rem; color: var(--nk-gray-400); max-width: 100% !important; line-height: 1.65; font-weight: 400; }

        .section__header {
            margin-bottom: 64px;
        }

        .section__header--center {
            text-align: center;
        }

        .section__header--center .section__label { margin: 0 auto 24px auto; }
        .section__header--center .section__subtitle { font-size: 1.05rem; color: var(--nk-gray-400); max-width: 100% !important; line-height: 1.65; font-weight: 400; }

        /* ============================================================
           SERVICE CARDS — Angular Corporate Style
           ============================================================ */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }

        /* ============================================================
           UNIVERSAL CARD ALIGNMENT (FORCE PARALLEL & WHITE THEME)
           ============================================================ */
        .service-card {
            background: #ffffff !important;
            padding: 40px !important;
            display: flex !important;
            flex-direction: column !important;
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02) !important;
            height: 100% !important;
            position: relative !important;
            border-radius: 20px !important;
        }

        .service-card__header {
            display: flex !important;
            align-items: flex-start !important;
            gap: 20px !important;
            margin-bottom: 24px !important;
            min-height: 60px !important;
        }

        .service-card__icon {
            width: 60px !important;
            height: 60px !important;
            margin-bottom: 0 !important;
            background: rgba(0, 13, 51, 0.03) !important;
            border-radius: 16px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0 !important;
        }

        .service-card__title {
            margin: 0 !important;
            line-height: 1.2 !important;
            font-size: 1.5rem !important;
            font-family: var(--font-display) !important;
            font-weight: 800 !important;
            color: var(--nk-gray-900) !important;
            display: block !important;
            flex: 1 !important;
        }

        .stat-icon {
            position: absolute !important;
            top: 24px !important;
            right: 24px !important;
            margin-bottom: 0 !important;
        }

        .service-card__text {
            font-size: 0.95rem;
            color: var(--nk-gray-600);
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .service-card__tasks {
            margin-bottom: 40px;
            flex-grow: 1;
        }

        .service-card__tasks-title {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--nk-gray-400);
            margin-bottom: 24px;
            display: block;
        }

        .service-card__list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .service-card__list li {
            position: relative;
            padding-left: 28px;
            margin-bottom: 14px;
            font-size: 0.9rem;
            color: var(--nk-gray-800);
            line-height: 1.6;
            font-weight: 500;
        }

        .service-card__list li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 10px;
            width: 8px;
            height: 2px;
            background: var(--nk-blue);
            border-radius: 2px;
            transition: all 0.3s var(--ease);
        }

        .service-card--alt .service-card__list li::before { background: var(--nk-red); }

        .service-card:hover .service-card__list li::before {
            width: 18px;
        }

        .service-card__link {
            font-family: var(--font-display);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--nk-blue);
            display: inline-flex;
            align-items: center;
            gap: 12px;
            transition: all 0.4s var(--ease);
            margin-top: auto;
            text-decoration: none;
        }

        .service-card--alt .service-card__link { color: var(--nk-red); }

        .service-card__link:hover {
            gap: 20px;
            opacity: 0.7;
        }



        /* ============================================================
           ABOUT / CEO EDITORIAL SECTION
           ============================================================ */
        .about {
            background: var(--nk-gray-50);
            position: relative;
            overflow: hidden;
            padding: 120px 0;
        }

        .about::before {
            content: '';
            position: absolute;
            top: -200px;
            right: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0,68,204,0.04) 0%, transparent 70%);
            pointer-events: none;
        }
        .about::after {
            content: '';
            position: absolute;
            bottom: -200px;
            left: -200px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(227,6,19,0.03) 0%, transparent 70%);
            pointer-events: none;
        }

        .ceo-editorial {
            width: 100%;
            margin: 120px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent;
            position: relative;
        }

        .ceo-editorial.fade-up {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }

        .ceo-editorial__photo-col {
            position: relative;
        }

        .ceo-editorial__frame {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: visible;
            padding: 12px;
            transition: transform 0.8s var(--ease), box-shadow 0.8s var(--ease);
            transform: rotateY(10deg) translateX(-20px);
            opacity: 0;
        }

        .ceo-editorial.is-visible .ceo-editorial__frame {
            transform: rotateY(0) translateX(0);
            opacity: 1;
        }

        /* Connecting visual bridge (accent line) handled below */

        .ceo-editorial__frame:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 40px 80px rgba(0,13,51,0.15);
        }

        .ceo-editorial__frame img {
            width: 100%;
            height: auto;
            display: block;
            aspect-ratio: 3/4;
            object-fit: cover;
            border-radius: var(--radius-lg);
            position: relative;
            z-index: 2;
            box-shadow:
                0 24px 48px rgba(0,13,51,0.1),
                0 8px 16px rgba(0,13,51,0.06);
        }

        /* Accent Corners */
        .ceo-corner {
            position: absolute;
            width: 48px;
            height: 48px;
            z-index: 1;
            pointer-events: none;
            transition: all 0.5s var(--ease);
        }
        .ceo-corner--tl {
            top: 0; left: 0;
            border-top: 3px solid var(--nk-red);
            border-left: 3px solid var(--nk-red);
            border-top-left-radius: var(--radius-md);
        }
        .ceo-corner--tr {
            top: 0; right: 0;
            border-top: 3px solid var(--nk-blue);
            border-right: 3px solid var(--nk-blue);
            border-top-right-radius: var(--radius-md);
            transform: translate(-20px, 20px);
            opacity: 0;
            transition: all 1.2s var(--ease);
            transition-delay: 0.6s;
        }
        .is-visible .ceo-corner--tr {
            transform: translate(0, 0);
            opacity: 1;
        }

        /* Bottom-left — Blue */
        .ceo-corner--bl {
            bottom: 0;
            left: 0;
            border-bottom: 3px solid var(--nk-blue);
            border-left: 3px solid var(--nk-blue);
            border-bottom-left-radius: var(--radius-md);
            transform: translate(20px, -20px);
            opacity: 0;
            transition: all 1.2s var(--ease);
            transition-delay: 0.6s;
        }
        .is-visible .ceo-corner--bl {
            transform: translate(0, 0);
            opacity: 1;
        }

        /* Bottom-right — Red */
        .ceo-corner--br {
            bottom: 0;
            right: 0;
            border-bottom: 3px solid var(--nk-red);
            border-right: 3px solid var(--nk-red);
            border-bottom-right-radius: var(--radius-md);
            transform: translate(-20px, -20px);
            opacity: 0;
            transition: all 1.2s var(--ease);
            transition-delay: 0.6s;
        }
        .is-visible .ceo-corner--br {
            transform: translate(0, 0);
            opacity: 1;
        }
        .ceo-editorial__frame:hover .ceo-corner--tl {
            width: 64px; height: 64px;
            box-shadow: -4px -4px 16px rgba(227,6,19,0.15);
        }
        .ceo-editorial__frame:hover .ceo-corner--tr {
            width: 64px; height: 64px;
            box-shadow: 4px -4px 16px rgba(0,68,204,0.15);
        }
        .ceo-editorial__frame:hover .ceo-corner--bl {
            width: 64px; height: 64px;
            box-shadow: -4px 4px 16px rgba(0,68,204,0.15);
        }
        .ceo-editorial__frame:hover .ceo-corner--br {
            width: 64px; height: 64px;
            box-shadow: 4px 4px 16px rgba(227,6,19,0.15);
        }

        /* Connecting visual bridge (accent line) */
        .ceo-editorial__bridge {
            position: absolute;
            top: 50%;
            left: 10%;
            width: 80%;
            height: 2px;
            background: linear-gradient(to right, transparent, var(--nk-red) 30%, var(--nk-blue) 70%, transparent);
            transform: translateY(-50%) skewX(-20deg);
            z-index: 1;
            opacity: 0;
            transition: opacity 2s var(--ease);
            transition-delay: 0.8s;
        }

        .ceo-editorial__frame::after {
            content: '';
            position: absolute;
            bottom: 16px; left: 16px; right: 16px;
            height: 40%;
            background: linear-gradient(to top, rgba(0,13,51,0.55) 0%, transparent 100%);
            pointer-events: none;
            z-index: 3;
            border-bottom-left-radius: var(--radius-lg);
            border-bottom-right-radius: var(--radius-lg);
        }

        .ceo-editorial__badge {
            position: absolute;
            bottom: 36px; left: 36px;
            z-index: 4;
        }
        .ceo-editorial__badge-role {
            padding: 8px 24px;
            background: var(--nk-grad-brand);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: none;
            border-radius: 2px;
            font-family: var(--font-display);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--nk-white);
            box-shadow: 0 4px 15px rgba(227,6,19,0.3);
        }

        /* Elegant Quote Card */
        .ceo-editorial__content-col {
            display: flex;
            align-items: center;
        }
        .ceo-editorial__quote-card {
            padding: 80px;
            background: #FFFFFF;
            position: relative;
            box-shadow: 0 40px 80px rgba(0,0,0,0.05);
            border-radius: var(--radius-xl);
            border: 1px solid var(--nk-gray-100);
            text-align: center; /* Center all elements */
        }

        .ceo-editorial__signature {
            font-family: 'Mr Dafoe', cursive;
            font-size: 3.5rem;
            font-weight: 400;
            color: #001A4D; 
            margin: 20px 0;
            transform: rotate(-1.5deg);
            opacity: 0.95;
            letter-spacing: 0px;
        }
        .is-visible .ceo-editorial__quote-card {
            transform: none;
            opacity: 1;
        }

        .ceo-editorial.is-visible .ceo-editorial__quote-card {
            transform: translateX(0);
            opacity: 1;
        }
        .ceo-editorial__quote-card::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 240px; height: 240px;
            background: rgba(227,6,19,0.06);
            transform: rotate(45deg);
            pointer-events: none;
        }
        .ceo-editorial__quote-card::after {
            content: '';
            position: absolute;
            bottom: -40px; left: -40px;
            width: 160px; height: 160px;
            background: rgba(0,68,204,0.08);
            transform: rotate(30deg);
            pointer-events: none;
        }
        .ceo-editorial__quote-open {
            font-family: 'Georgia', serif;
            font-size: 80px;
            font-weight: 400;
            line-height: 0.6;
            color: var(--nk-blue);
            opacity: 0.1;
            position: relative;
            z-index: 1;
            margin-bottom: 0;
            user-select: none;
        }
        .ceo-editorial__quote-text {
            font-family: var(--font-display);
            font-size: 2.25rem;
            line-height: 1.25;
            color: var(--nk-dark);
            font-weight: 900;
            margin-bottom: 20px;
            letter-spacing: -0.05em;
            text-transform: uppercase;
            text-align: center;
        }
        
        .ceo-editorial__quote-text span {
            color: var(--nk-red);
        }
        .ceo-editorial__quote-close { display: none; }
        .ceo-editorial__author {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            margin-top: 40px;
        }
        .cea-editorial__author-info { 
            margin: 0;
            text-align: center;
        }
        .ceo-editorial__circle-frame {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: none;
            background: var(--nk-white);
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .ceo-editorial__avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        .ceo-editorial__author-avatar {
            width: 56px; height: 56px;
            border-radius: 50%;
            background: var(--nk-gray-100);
            border: 2px solid var(--nk-white);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--nk-blue);
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            position: relative;
        }
        .ceo-editorial__author-avatar::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            border: 1px solid var(--nk-blue);
            opacity: 0.3;
            animation: pulse-ring 2s infinite;
        }
        @keyframes pulse-ring {
            0% { transform: scale(1); opacity: 0.5; }
            100% { transform: scale(1.4); opacity: 0; }
        }
        .cea-editorial__author-info { margin-left: 4px; }
        .ceo-editorial__author-line {
            width: 32px; height: 1.5px;
            background: var(--nk-grad-brand);
            border-radius: 2px;
            flex-shrink: 0;
            opacity: 0.8;
        }

        .ceo-editorial__footer {
            margin-top: 56px;
            padding-top: 32px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .ceo-editorial__team-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            font-family: var(--font-display);
            font-size: 14px;
            font-weight: 800;
            color: var(--nk-white);
            letter-spacing: 0.1em;
            transition: all 0.4s var(--ease);
            text-decoration: none;
            text-transform: uppercase;
            margin-top: 64px;
            padding: 24px 60px;
            background: linear-gradient(135deg, var(--nk-blue) 0%, #002266 100%);
            border-radius: 50px;
            box-shadow: 0 20px 40px rgba(0,68,204,0.2);
        }

        .ceo-editorial__team-link:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(0,68,204,0.3);
            background: linear-gradient(135deg, var(--nk-red) 0%, #990000 100%);
        }

        .ceo-editorial__team-link svg {
            transition: transform 0.3s var(--ease);
            color: var(--nk-red);
        }

        .ceo-editorial__team-link:hover svg {
            transform: translateX(4px);
            color: var(--nk-blue);
        }
        .cta-crystal__field input,
        .cta-crystal__field select,
        .cta-crystal__field textarea {
            width: 100%;
            padding: 22px 36px;
            background: rgba(253, 253, 255, 0.7); /* Breathable Glassy background */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid transparent; 
            border-radius: 100px; 
            font-family: var(--font-display);
            font-size: 14px;
            font-weight: 700;
            color: var(--nk-gray-900);
            transition: all 0.4s var(--ease);
            outline: none; /* No blue focus corners */
            resize: none;
            appearance: none;
            -webkit-appearance: none;
            box-shadow: 0 10px 40px rgba(0, 13, 51, 0.04);
            line-height: 1.6;
        }

        .cta-crystal__field select {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%234B5468' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 30px center;
            background-size: 16px;
        }

        .cta-crystal__field select:focus {
            background-color: #FFFFFF;
            box-shadow: 0 20px 60px rgba(0, 13, 51, 0.08);
            outline: none; /* Crucial to remove native blue focus */
        }

        .cta-crystal__field select option {
            background: #FFFFFF;
            color: var(--nk-gray-900);
            padding: 10px;
        }

        .cta-crystal__field label {
            position: absolute;
            left: 36px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
            color: var(--nk-gray-400);
            pointer-events: none;
            transition: all 0.4s var(--ease);
            z-index: 5;
            font-family: var(--font-display);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }

        .cta-crystal__field input:focus ~ label,
        .cta-crystal__field input:not(:placeholder-shown) ~ label,
        .cta-crystal__field textarea:focus ~ label,
        .cta-crystal__field textarea:not(:placeholder-shown) ~ label,
        .cta-crystal__field select:valid ~ label {
            top: -12px;
            left: 36px;
            font-size: 10px;
            color: var(--nk-blue);
            background: #FFFFFF;
            padding: 2px 14px;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        /* Remove Blue focus from and add Soft Glow */
        .cta-crystal__field input:focus,
        .cta-crystal__field textarea:focus {
            background: #FFFFFF;
            border: 1px solid rgba(0, 68, 204, 0.05);
            box-shadow: 0 20px 60px rgba(0, 68, 204, 0.1);
            outline: none;
        }

        .cta-crystal__field input:focus,
        .cta-crystal__field select:focus,
        .cta-crystal__field textarea:focus {
            border-color: var(--nk-blue);
            background: #FFFFFF;
            box-shadow: 0 8px 24px rgba(0,68,204,0.08);
        }
        .ceo-editorial__author-name {
            font-family: var(--font-display);
            font-size: 22px;
            font-weight: 800;
            color: var(--nk-gray-900);
            letter-spacing: 0.02em;
            margin-bottom: 4px;
        }
        .ceo-editorial__author-title {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--nk-gray-400);
        }

        /* Homepage-specific mission quote size increase (+2px) */
        .home .ceo-editorial__quote-text {
            font-size: 1.8rem !important;
        }

        /* ── Responsive Overhaul for CEO Section ── */
        @media (max-width: 1100px) {
            .ceo-editorial {
                flex-direction: column !important;
                padding-bottom: 20px;
                text-align: center;
            }
            .ceo-editorial__frame {
                transform: none !important;
                margin-bottom: -60px;
                max-width: 100%;
                padding: 0;
            }
            .ceo-editorial__quote-card {
                margin-left: 0 !important;
                margin-top: 0 !important;
                padding: 48px 24px !important;
                width: 100% !important;
                max-width: 100% !important;
                border-radius: var(--radius-lg) !important;
            }
            .ceo-editorial__author {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }
            .ceo-editorial__author-line { display: none; }
        }

        /* ── Animations ── */
        .fade-up {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s var(--ease-out), transform 0.7s var(--ease-out);
        }
        .fade-up.is-visible { opacity: 1; transform: translateY(0); }

        .fade-up-delay-1 { transition-delay: 0.1s; }
        .fade-up-delay-2 { transition-delay: 0.2s; }
        .fade-up-delay-3 { transition-delay: 0.3s; }
    

<?php wp_head(); ?>
    <style>
        /* FINAL OVERRIDES - Ensuring changes win against all external files */
        .ceo-editorial__circle-frame {
            width: 320px !important;
            height: 320px !important;
            flex: 0 0 320px !important;
        }
        
        .ceo-editorial__team-link {
            margin-top: 10px !important;
        }
        
        .home .ceo-editorial__quote-text {
            font-size: 20px !important;
        }
        
        .ceo-editorial__author {
            margin-top: 80px !important;
        }

        /* [PRISM PLATINUM] Stats Ribbon — Inner Alignment Correction */
        .stats-ribbon__inner {
            display: grid !important;
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 0 !important;
            max-width: var(--container-width) !important;
            margin: 0 auto !important;
            height: 400px !important;
            position: relative !important;
            z-index: 5 !important;
            border: 1px solid rgba(0, 13, 51, 0.05) !important;
            border-bottom: none !important; /* Seamless flow to grid below */
            border-right: none !important;
        }
        .cta-crystal__field input,
        .cta-crystal__field select,
        .cta-crystal__field textarea {
            width: 100% !important;
            padding: 20px 30px !important;
            background: #FFFFFF !important;
            border: 2px solid rgba(0, 13, 51, 0.08) !important; 
            border-radius: 8px !important;
            font-family: var(--font-display) !important;
            font-size: 16px !important;
            font-weight: 600 !important;
            color: var(--nk-gray-900) !important;
            outline: none !important; /* Removes blue lines forever */
            transition: all 0.3s var(--ease) !important;
            appearance: none !important;
            -webkit-appearance: none !important;
            box-shadow: none !important;
        }

        /* Dropdown Logic Sync */
        .cta-crystal__field select {
            cursor: pointer !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%234B5468' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 30px center !important;
            background-size: 16px !important;
            padding-right: 70px !important;
        }

        /* Slate-Grey Subtle Focus (No Blue) */
        .cta-crystal__field input:focus,
        .cta-crystal__field select:focus,
        .cta-crystal__field textarea:focus {
            border-color: rgba(0, 13, 51, 0.15) !important;
            background: #FDFDFF !important;
            box-shadow: 0 10px 40px rgba(0, 13, 51, 0.03) !important;
        }

        .cta-crystal__field label {
            position: absolute !important;
            left: 30px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            font-family: var(--font-display) !important;
            font-weight: 700 !important;
            color: var(--nk-gray-400) !important;
            pointer-events: none !important;
            transition: all 0.3s var(--ease) !important;
            z-index: 10 !important;
            font-size: 14px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
        }

        .cta-crystal__field input:focus ~ label,
        .cta-crystal__field input:not(:placeholder-shown) ~ label,
        .cta-crystal__field textarea:focus ~ label,
        .cta-crystal__field textarea:not(:placeholder-shown) ~ label,
        .cta-crystal__field select:valid ~ label {
            top: -12px !important;
            left: 24px !important;
            font-size: 11px !important;
            font-weight: 800 !important;
            color: var(--nk-gray-800) !important; /* No Blue Label */
            background: #FFFFFF !important;
            padding: 0 12px !important;
            border-radius: 4px !important;
        }
        /* Mobile Toggle Styles */
        .nk-mobile-toggle {
            display: none;
            flex-direction: column;
            justify-content: center; /* Centered for better touch */
            gap: 6px;
            width: 44px; /* Standard Touch Target */
            height: 44px; /* Standard Touch Target */
            background: rgba(0, 13, 51, 0.03);
            border: 1px solid rgba(0, 13, 51, 0.05);
            border-radius: 8px;
            cursor: pointer;
            padding: 10px;
            z-index: 110;
        }

        .nk-mobile-toggle span {
            width: 100%;
            height: 2px;
            background: var(--nk-gray-900);
            border-radius: 10px;
            transition: all 0.3s var(--ease);
        }

        @media (max-width: 1024px) {
            .header__nav {
                position: fixed;
                top: 0;
                right: -100%;
                width: 300px;
                height: 100vh;
                background: white;
                flex-direction: column;
                align-items: flex-start;
                padding: 100px 40px;
                box-shadow: -10px 0 30px rgba(0,0,0,0.1);
                transition: right 0.4s var(--ease);
                gap: 20px;
            }
            .header__nav.is-open {
                right: 0;
            }
            .nk-mobile-toggle {
                display: flex;
            }
            .nk-mobile-toggle.is-active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
            .nk-mobile-toggle.is-active span:nth-child(2) { opacity: 0; }
            .nk-mobile-toggle.is-active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }
        }

        /* ── Global Responsive Audit Fixes ── */
        @media (max-width: 991px) {
            .services-grid { grid-template-columns: 1fr !important; gap: 30px !important; }
            .stats-ribbon__inner { grid-template-columns: repeat(2, 1fr) !important; height: auto !important; padding: 40px 0 !important; }
            .stats-card { border-right: none !important; border-bottom: 1px solid rgba(0, 13, 51, 0.05); padding: 30px !important; }
            .stats-card:nth-child(2n) { border-right: none !important; }
            .hero__container { flex-direction: column !important; align-items: flex-start !important; gap: 30px !important; }
            .hero__actions--right { justify-content: flex-start !important; padding-left: 0 !important; }
        }

        @media (max-width: 768px) {
            .hero__title { font-size: 2.8rem !important; }
            .container { padding: 0 20px !important; }
            .section { padding: 80px 0 !important; }
            .cta-crystal__grid { grid-template-columns: 1fr !important; gap: 15px !important; }
            .ceo-editorial__circle-frame { width: 240px !important; height: 240px !important; flex: 0 0 240px !important; }
        }

        @media (max-width: 480px) {
            .hero__title { font-size: 2.2rem !important; }
            .stats-ribbon__inner { grid-template-columns: 1fr !important; }
            .lang-switcher { display: none !important; } /* Hide on mobile if overlap */
            .header__nav { width: 100% !important; }
        }
    </style>
</head>

<body <?php body_class(); ?>>

<!-- ═══════════ HEADER ═══════════ -->
<header class="header">
    <div class="container header__inner">
        <a href="<?php echo nk_link('/', $current_lang); ?>" class="header__logo-link">
            <img src='<?php echo get_template_directory_uri(); ?>/assets/images/logo.png' alt="NEKSOZ" class="header__logo">
        </a>
        <?php
        // Use the centralized language detection from functions.php
        $current_lang = function_exists('nk_get_current_lang') ? nk_get_current_lang() : 'ru';

        $nav_texts = [
            'ru' => [__('Главная', 'neksoz'), __('Услуги', 'neksoz'), __('О компании', 'neksoz'), __('Новости', 'neksoz'), __('Вакансии', 'neksoz'), __('Контакты', 'neksoz')],
            'tj' => [__('Асосӣ', 'neksoz'), __('Хидмат', 'neksoz'), __('Дар бораи мо', 'neksoz'), __('Ахбор', 'neksoz'), __('Ҷойҳои корӣ', 'neksoz'), __('Тамос', 'neksoz')],
            'en' => [__('Home', 'neksoz'), __('Services', 'neksoz'), __('About us', 'neksoz'), __('News', 'neksoz'), __('Careers', 'neksoz'), __('Contacts', 'neksoz')]
        ];
        $texts = $nav_texts[$current_lang] ?? $nav_texts['ru'];
        ?>
        <nav class="header__nav">
            <?php 
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'fallback_cb' => false
                )); 
            } else {
                // FALLBACK: Show original hardcoded links if no WP menu is set
                ?>
                <a href="<?php echo nk_link('/', $current_lang); ?>"><?php echo esc_html($texts[0]); ?></a>
                <a href="<?php echo nk_link('/services', $current_lang); ?>"><?php echo esc_html($texts[1]); ?></a>
                <a href="<?php echo nk_link('/about', $current_lang); ?>"><?php echo esc_html($texts[2]); ?></a>
                <a href="<?php echo nk_link('/news', $current_lang); ?>"><?php echo esc_html($texts[3]); ?></a>
                <a href="<?php echo nk_link('/vacancies', $current_lang); ?>"><?php echo esc_html($texts[4]); ?></a>
                <a href="<?php echo nk_link('/contacts', $current_lang); ?>"><?php echo esc_html($texts[5]); ?></a>
                <?php
            }
            ?>
        </nav>
        <div class="header__actions">
            <!-- Intelligent Language Switcher -->
            <div class="lang-switcher">
                <?php
                global $wp;
                $current_slug = trim(parse_url(add_query_arg(array(), $wp->request), PHP_URL_PATH), '/');

                // ── Centralized language detection ──────────────────────────────
                $current_lang = function_exists('nk_get_current_lang') ? nk_get_current_lang() : 'ru';

                ?>
                <a href="<?php echo nk_get_switcher_link('en', $current_slug); ?>" class="lang-switcher__item <?php echo $current_lang == 'en' ? 'is-active' : ''; ?>">EN</a>
                <a href="<?php echo nk_get_switcher_link('tj', $current_slug); ?>" class="lang-switcher__item <?php echo $current_lang == 'tj' ? 'is-active' : ''; ?>">TJ</a>
                <a href="<?php echo nk_get_switcher_link('ru', $current_slug); ?>" class="lang-switcher__item <?php echo $current_lang == 'ru' ? 'is-active' : ''; ?>">RU</a>
            </div>
            
            <!-- Mobile Toggle -->
            <button class="nk-mobile-toggle" aria-label="<?php esc_attr_e('Menu', 'neksoz'); ?>" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>
