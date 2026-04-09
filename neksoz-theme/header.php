<?php wp_body_open(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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
            --font-display: 'Montserrat', sans-serif;
            --font-body: 'Inter', sans-serif;

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
            width: 160px;
            height: 160px;
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
            margin-left: 24px;
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

        /* ============================================================
           HERO — Dark Corporate with Angular Geometry
           ============================================================ */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: var(--nk-grad-hero);
            overflow: hidden;
            padding-top: 77px;
        }

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
            font-size: clamp(4rem, 10vw, 7.5rem);
            font-weight: 900;
            line-height: 0.95;
            color: var(--nk-white);
            margin-bottom: 32px;
            letter-spacing: -0.05em;
            text-transform: none;
        }

        .hero__title em {
            font-style: normal;
            position: relative;
            color: var(--nk-white);
        }

        .hero__desc {
            font-size: 1.25rem;
            line-height: 1.8;
            color: rgba(255,255,255,0.7);
            margin-bottom: 48px;
            max-width: 700px;
            font-weight: 500;
        }

        .hero__container {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            width: 100%;
            gap: 40px;
        }

        
        .hero__actions--right { 
            display: flex !important; 
            flex-direction: row !important; 
            flex-wrap: nowrap !important; 
            gap: 20px !important; 
            align-items: center !important; 
            margin-top: 35px !important;
            justify-content: flex-start !important;
        }
        .hero__actions--right .btn {
            width: auto !important;
            display: inline-flex !important;
            white-space: nowrap !important;
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
            font-size: 2.2rem; /* Increased size significantly for visibility */
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
            color: var(--nk-gray-500); /* Slightly darker for better visibility */
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
            border-bottom: 2px solid rgba(227, 6, 19, 0.2);
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
            line-height: 1.15;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }
        
        .section__title--huge {
            font-size: clamp(2.5rem, 6vw, 3.8rem);
            margin-bottom: 24px;
            line-height: 1.1;
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

        .service-card {
            background: var(--nk-white);
            padding: 50px 40px;
            border-radius: 20px;
            border: 1px solid rgba(0, 13, 51, 0.05);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 13, 51, 0.015);
            isolation: isolate;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(0, 13, 51, 0.06);
            border-color: rgba(0, 68, 204, 0.15);
        }

        .service-card--alt:hover {
            border-color: rgba(227, 6, 19, 0.15);
        }

        /* ─── Universal Icon (Footer Social Style) ────────────────────── */
        .service-card__icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 68, 204, 0.06);
            color: var(--nk-blue);
            border: 1px solid rgba(0, 68, 204, 0.1);
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            z-index: 2;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .service-card__icon::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--nk-blue);
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .service-card__icon svg {
            width: 22px;
            height: 22px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
            position: relative;
            z-index: 2;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .service-card:hover .service-card__icon {
            border-color: transparent;
            transform: translateY(-3px);
        }

        .service-card:hover .service-card__icon::before { opacity: 1; }

        .service-card:hover .service-card__icon svg {
            color: #ffffff;
            transform: scale(1.1);
        }

        .service-card--alt .service-card__icon {
            background: rgba(227, 6, 19, 0.06);
            color: var(--nk-red);
            border-color: rgba(227, 6, 19, 0.1);
        }

        .service-card--alt .service-card__icon::before { background: var(--nk-red); }

        /* Stat ribbon: pin to top-right */
        .stat-icon {
            position: absolute !important;
            top: 24px !important;
            right: 24px !important;
            margin-bottom: 0 !important;
        }

        .service-card__title {
            font-family: var(--font-display);
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--nk-gray-900);
            margin-bottom: 20px;
            letter-spacing: -0.01em;
            line-height: 1.2;
        }

        .service-card__text {
            font-size: 1.1rem;
            color: var(--nk-gray-600);
            line-height: 1.65;
            margin-bottom: 35px;
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
            padding-left: 32px;
            margin-bottom: 18px;
            font-size: 1rem;
            color: var(--nk-gray-800);
            line-height: 1.6;
            font-weight: 500;
        }

        .service-card__list li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 11px;
            width: 10px;
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
            font-family: 'Rock Salt', cursive;
            font-size: 2rem;
            color: #001A4D; 
            margin: 20px 0;
            transform: rotate(-2deg);
            opacity: 0.9;
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
            justify-content: space-between;
            width: 30px;
            height: 20px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
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
            .nk-mobile-toggle.is-active span:nth-child(1) { transform: translateY(9px) rotate(45deg); }
            .nk-mobile-toggle.is-active span:nth-child(2) { opacity: 0; }
            .nk-mobile-toggle.is-active span:nth-child(3) { transform: translateY(-9px) rotate(-45deg); }
        }
    </style>
</head>

<body <?php body_class(); ?>>

<!-- ═══════════ HEADER ═══════════ -->
<header class="header">
    <div class="container header__inner">
        <a href="<?php echo home_url('/'); ?>" class="header__logo-link">
            <img src='<?php echo get_template_directory_uri(); ?>/assets/images/logo.png' alt="NEKSOZ" class="header__logo">
        </a>
        <nav class="header__nav">
            <a href="<?php echo home_url('/'); ?>">Главная</a>
            <a href="<?php echo home_url('/#services'); ?>">Услуги</a>
            <a href="<?php echo home_url('/about'); ?>">О компании</a>
            <a href="<?php echo home_url('/news'); ?>">Новости</a>
            <a href="<?php echo home_url('/vacancies'); ?>">Вакансии</a>
            <a href="<?php echo home_url('/contacts'); ?>">Контакты</a>
        </nav>
        <div class="header__actions">
            <!-- Telegram -->
            <a href="#" target="_blank" class="header__icon header__icon--tg" aria-label="Telegram">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69.01-.03.01-.14-.07-.19-.08-.05-.19-.02-.27 0-.11.03-1.9 1.21-5.36 3.55-.51.35-.97.52-1.38.51-.45-.01-1.31-.25-1.95-.46-.79-.26-1.41-.4-1.36-.84.03-.22.34-.44.93-.68 3.62-1.58 6.04-2.62 7.25-3.13 3.45-1.44 4.16-1.69 4.63-1.69.1 0 .32.02.46.12.12.09.15.21.16.3z"/></svg>
            </a>
            <!-- WhatsApp -->
            <a href="#" target="_blank" class="header__icon header__icon--wa" aria-label="WhatsApp">
                <svg viewBox="0 0 24 24"><path d="M12.031 2C6.495 2 2 6.494 2 12.031c0 1.764.464 3.486 1.348 5.006L2 22l5.109-1.332A9.971 9.971 0 0012.03 22c5.536 0 10.031-4.494 10.031-10.03v-.004C22.062 6.494 17.568 2 12.031 2zm5.795 14.18c-.244.686-1.42 1.3-1.966 1.353-.513.048-1.167.316-3.832-.727-3.411-1.336-5.61-4.852-5.783-5.083-.172-.232-1.38-1.841-1.38-3.513 0-1.671.867-2.5 1.185-2.836.317-.335.69-.42 1.94-.01.25.08.572.639.882 1.402.316.76.545 1.487.676 1.705.132.221.222.474.072.768-.148.291-.222.473-.443.727-.221.254-.464.55-.664.747-.221.221-.453.465-.198.887.254.42 1.135 1.86 2.43 3.02 1.676 1.5 3.084 1.965 3.484 2.14.398.175.632.148.868-.113.235-.262.998-1.162 1.266-1.564.267-.402.532-.335.888-.201.356.133 2.25 1.062 2.632 1.252.383.19.638.283.731.442.093.158.093.916-.15 1.602z"/></svg>
            </a>
            <!-- Phone -->
            <a href="tel:+992446000000" class="header__icon header__icon--phone" aria-label="Call">
                <svg viewBox="0 0 24 24"><path d="M20 15.5c-1.2 0-2.4-.2-3.6-.6-.3-.1-.7 0-1 .2l-2.2 2.2c-2.8-1.4-5.1-3.8-6.6-6.6l2.2-2.2c.3-.3.4-.7.2-1C8.8 6.4 8.6 5.2 8.6 4c0-.6-.4-1-1-1H4c-.6 0-1 .4-1 1 0 9.4 7.6 17 17 17 .6 0 1-.4 1-1v-3.5c0-.6-.4-1-1-1z"/></svg>
            </a>
            
            <!-- Mobile Toggle -->
            <button class="nk-mobile-toggle" aria-label="Menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>
