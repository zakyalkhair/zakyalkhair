{{-- resources/views/portfolio/projects/powerbi.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power BI KPI Dashboard — Portfolio Project</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=DM+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --white: #ffffff;
            --ink: #15202b;
            --muted: rgba(255, 255, 255, .88);
            --glass: rgba(20, 28, 38, .62);
            --glass-strong: rgba(20, 28, 38, .80);
            --line: rgba(255, 255, 255, .16);
            --accent: #f6cf61;
            --accent-strong: #ffcf24;
            --accent-soft: rgba(246, 207, 97, .16);
            --blue-soft: rgba(147, 197, 253, .14);
            --green-soft: rgba(143, 214, 148, .14);
            --navy: #1b3a5c;
            --text-muted: #5a6a7a;
        }

        html {
            min-height: 100%;
            scroll-behavior: smooth;
            overflow-x: hidden;
            font-family: 'DM Sans', sans-serif;
        }

        body {
            min-height: 100%;
            overflow-x: hidden;
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            background:
                linear-gradient(rgba(0, 0, 0, .54), rgba(0, 0, 0, .66)),
                url("{{ asset('images/background.webp') }}") center / cover fixed no-repeat;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(circle at 17% 18%, rgba(246, 207, 97, .18), transparent 28%),
                radial-gradient(circle at 84% 24%, rgba(147, 197, 253, .14), transparent 25%),
                radial-gradient(circle at 52% 94%, rgba(143, 214, 148, .12), transparent 31%);
        }

        .grain {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            opacity: .15;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.45'/%3E%3C/svg%3E");
        }

        .dynamic-background {
            position: fixed;
            inset: 0;
            z-index: 1;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        #backgroundCanvas {
            display: block;
            width: 100%;
            height: 100%;
        }

        main,
        .project-topbar {
            position: relative;
            z-index: 2;
        }

        /* =========================
           TOP BAR
        ========================= */
        .project-topbar {
            position: fixed;
            top: 22px;
            left: 50%;
            z-index: 1000;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            width: max-content;
            max-width: calc(100% - 32px);
            padding: 7px;

            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, .16);
            background: rgba(20, 28, 38, .34);
            box-shadow:
                0 18px 48px rgba(0, 0, 0, .20),
                inset 0 1px 0 rgba(255, 255, 255, .10);

            transform: translateX(-50%);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .home-button,
        .prev-arrow,
        .next-arrow {
            height: 42px;
            border-radius: 999px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            color: var(--white);
            text-decoration: none;

            border: 1px solid rgba(255, 255, 255, .14);
            background: rgba(255, 255, 255, .08);

            transition:
                color .2s ease,
                background .2s ease,
                border-color .2s ease,
                box-shadow .2s ease,
                transform .2s ease;
        }

        .home-button {
            padding: 0 20px;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .01em;
            white-space: nowrap;
        }

        .prev-arrow,
        .next-arrow {
            width: 42px;
            flex: 0 0 42px;
        }

        .prev-arrow svg,
        .next-arrow svg {
            width: 21px;
            height: 21px;
            display: block;
        }

        .prev-arrow path,
        .next-arrow path {
            fill: none;
            stroke: currentColor;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .home-button:hover,
        .prev-arrow:hover,
        .next-arrow:hover {
            color: #1b2a34;
            background: var(--accent);
            border-color: rgba(246, 207, 97, .70);
            box-shadow: 0 12px 28px rgba(246, 207, 97, .18);
        }

        .home-button:active,
        .prev-arrow:active,
        .next-arrow:active {
            transform: scale(.96);
        }

        section {
            width: 100%;
            padding: 40px 72px;
        }

        .container {
            width: min(1180px, 100%);
            margin: 0 auto;
        }

        .spotlight-card {
            position: relative;
            overflow: hidden;
            --mouse-x: 50%;
            --mouse-y: 50%;
            --spotlight-color: rgba(246, 207, 97, .12);
        }

        .spotlight-card::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(circle 520px at var(--mouse-x) var(--mouse-y),
                    var(--spotlight-color),
                    rgba(246, 207, 97, .045) 36%,
                    transparent 78%);
            opacity: 0;
            pointer-events: none;
            transition: opacity .38s ease;
        }

        .spotlight-card:hover::before,
        .spotlight-card:focus-within::before {
            opacity: .75;
        }

        .spotlight-card>* {
            position: relative;
            z-index: 1;
        }

        .hero {
            min-height: 100vh;
            display: grid;
            align-items: center;
            padding-top: 132px;
            padding-bottom: 90px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: minmax(0, .92fr) minmax(420px, 1fr);
            gap: clamp(42px, 5vw, 72px);
            align-items: center;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 18px;
            color: rgba(255, 255, 255, .82);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .eyebrow::before {
            content: "";
            width: 34px;
            height: 2px;
            border-radius: 999px;
            background: var(--accent);
        }

        h1 {
            max-width: 720px;
            font-size: clamp(3rem, 4.3vw, 3.2rem);
            line-height: .98;
            letter-spacing: -.055em;
        }

        .hero h1 span {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            letter-spacing: -.045em;
            color: var(--accent);
        }

        .lead {
            max-width: 640px;
            margin-top: 22px;
            color: rgba(255, 255, 255, .91);
            font-size: clamp(15.5px, 1.25vw, 17px);
            line-height: 1.72;
        }

        .tag-row {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 24px;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 32px;
            padding: 0 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .10);
            color: rgba(255, 255, 255, .92);
            font-size: 11.5px;
            font-weight: 800;
            white-space: nowrap;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .btn,
        .open-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 48px;
            padding: 0 19px;
            border-radius: 999px;
            color: var(--white);
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, .20);
            background: rgba(255, 255, 255, .10);
            font-family: inherit;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition:
                transform .22s ease,
                background .22s ease,
                border-color .22s ease,
                box-shadow .22s ease;
        }

        .btn:hover,
        .open-btn:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, .16);
            border-color: rgba(255, 255, 255, .30);
            box-shadow: 0 14px 32px rgba(0, 0, 0, .18);
        }

        .btn-primary,
        .open-btn {
            color: #1b2a34;
            background: var(--accent);
            border-color: transparent;
        }

        .btn-primary:hover,
        .open-btn:hover {
            background: #ffdc72;
            border-color: transparent;
            box-shadow: 0 14px 32px rgba(246, 207, 97, .22);
        }

        aside {
            border-radius: 40px;
        }

        .hero-panel {
            position: relative;
            min-height: 520px;
            border-radius: 40px;
            padding: 18px;
            overflow: visible;
            border: 1px solid rgba(255, 255, 255, .18);
            background:
                linear-gradient(150deg, rgba(255, 255, 255, .18), rgba(255, 255, 255, .06));
            box-shadow: 0 26px 80px rgba(0, 0, 0, .35);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .hero-panel::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background:
                linear-gradient(130deg, rgba(246, 207, 97, .16), transparent 30%),
                linear-gradient(330deg, rgba(147, 197, 253, .16), transparent 34%);
            pointer-events: none;
            z-index: 0;
        }

        .mock-window {
            position: relative;
            z-index: 1;
            height: 100%;
            min-height: 484px;
            border-radius: 30px;
            overflow: hidden;
            background: rgba(13, 18, 24, .78);
            border: 1px solid rgba(255, 255, 255, .12);
        }

        .window-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            min-height: 46px;
            padding: 0 17px;
            border-bottom: 1px solid rgba(255, 255, 255, .10);
            background: rgba(255, 255, 255, .06);
        }

        .window-dots {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .32);
        }

        .window-label {
            color: rgba(255, 255, 255, .70);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .window-content {
            padding: clamp(20px, 3vw, 28px);
        }

        .dashboard-preview {
            display: grid;
            gap: 16px;
        }

        .preview-header {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 14px;
            align-items: center;
            padding: 22px;
            border-radius: 24px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .10);
        }

        .preview-header p {
            color: rgba(255, 255, 255, .74);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .10em;
            text-transform: uppercase;
        }

        .preview-header strong {
            display: block;
            margin-top: 8px;
            font-size: clamp(1.4rem, 2vw, 2rem);
            line-height: 1.08;
        }

        .score-pill {
            min-width: 96px;
            min-height: 96px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: #1b2a34;
            background: var(--accent);
            font-size: 26px;
            font-weight: 900;
            box-shadow: 0 18px 34px rgba(246, 207, 97, .20);
        }

        .mini-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .mini-card {
            min-height: 116px;
            padding: 18px;
            border-radius: 22px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .10);
        }

        .mini-card span {
            color: rgba(255, 255, 255, .72);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .mini-card strong {
            display: block;
            margin-top: 10px;
            font-size: 28px;
        }

        .bar-list {
            padding: 22px;
            border-radius: 24px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .10);
        }

        .mini-title {
            margin-bottom: 18px;
            color: rgba(255, 255, 255, .82);
            font-size: 12.5px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .bar-row {
            display: grid;
            grid-template-columns: 150px 1fr 48px;
            gap: 12px;
            align-items: center;
            margin-bottom: 14px;
            color: rgba(255, 255, 255, .92);
            font-size: 13px;
        }

        .bar-row:last-child {
            margin-bottom: 0;
        }

        .bar-track {
            height: 12px;
            overflow: hidden;
            border-radius: 999px;
            background: rgba(255, 255, 255, .10);
        }

        .bar-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--accent), #f59e0b);
        }

        .floating-resource-stack {
            position: absolute;
            right: -24px;
            bottom: 30px;
            z-index: 5;
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 10px;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, .16);
            background: linear-gradient(160deg, rgba(255, 255, 255, .14), rgba(255, 255, 255, .06));
            box-shadow:
                0 20px 50px rgba(0, 0, 0, .24),
                inset 0 1px 0 rgba(255, 255, 255, .10);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .floating-resource-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 54px;
            height: 54px;
            border-radius: 18px;
            text-decoration: none;
            color: rgba(255, 255, 255, .90);
            border: 1px solid rgba(255, 255, 255, .14);
            background: rgba(255, 255, 255, .10);
            transition:
                transform .22s ease,
                background .22s ease,
                border-color .22s ease,
                box-shadow .22s ease,
                color .22s ease;
        }

        .floating-resource-btn svg {
            width: 21px;
            height: 21px;
        }

        .floating-resource-btn:hover {
            transform: translateY(-3px) scale(1.03);
            color: #1b2a34;
            background: var(--accent);
            border-color: transparent;
            box-shadow: 0 14px 32px rgba(246, 207, 97, .22);
        }

        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 30px;
        }

        .section-heading h2 {
            max-width: 720px;
            font-size: clamp(3rem, 4vw, 3rem);
            line-height: 1;
            letter-spacing: -.045em;
        }

        .section-heading p {
            max-width: 560px;
            color: rgba(255, 255, 255, .86);
            line-height: 1.7;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .metric-card,
        .step-card,
        .takeaway-card,
        .visual-card {
            border: 1px solid rgba(255, 255, 255, .14);
            background: var(--glass);
            box-shadow: 0 20px 60px rgba(0, 0, 0, .22);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            transition:
                border-color .22s ease,
                box-shadow .22s ease,
                background .22s ease;
        }

        .metric-card:hover,
        .step-card:hover,
        .takeaway-card:hover,
        .visual-card:hover {
            border-color: rgba(255, 255, 255, .22);
            box-shadow: 0 24px 68px rgba(0, 0, 0, .26);
        }

        .metric-card {
            min-height: 178px;
            padding: 24px;
            border-radius: 30px;
        }

        .metric-card span {
            display: block;
            margin-bottom: 22px;
            color: rgba(255, 255, 255, .78);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .metric-card strong {
            display: block;
            margin-bottom: 8px;
            color: var(--white);
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            line-height: 1;
        }

        .metric-card p {
            color: rgba(255, 255, 255, .86);
            font-size: 14px;
            line-height: 1.55;
        }

        .pipeline-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .step-card {
            position: relative;
            min-height: 250px;
            padding: 28px;
            border-radius: 32px;
        }

        .step-card::after {
            content: attr(data-step);
            position: absolute;
            top: 18px;
            right: 22px;
            color: rgba(255, 255, 255, .12);
            font-size: 52px;
            font-weight: 800;
            line-height: 1;
            z-index: 1;
        }

        .step-card h3 {
            max-width: 290px;
            margin-bottom: 14px;
            font-size: 24px;
            line-height: 1.12;
        }

        .step-card p {
            color: rgba(255, 255, 255, .88);
            line-height: 1.68;
            font-size: 15px;
        }

        .gallery-layout {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 22px;
            align-items: start;
        }

        .gallery-tabs {
            display: grid;
            gap: 12px;
            position: sticky;
            top: 110px;
        }

        .tab-button {
            position: relative;
            width: 100%;
            padding: 18px 18px 18px 22px;
            border: 1px solid rgba(255, 255, 255, .14);
            border-radius: 22px;
            background: rgba(20, 28, 38, .56);
            color: rgba(255, 255, 255, .86);
            text-align: left;
            font-family: inherit;
            cursor: pointer;
            overflow: hidden;
            transition:
                transform .22s ease,
                background .22s ease,
                color .22s ease,
                border-color .22s ease,
                box-shadow .22s ease;
        }

        .tab-button::before {
            content: "";
            position: absolute;
            top: 18px;
            left: 0;
            width: 4px;
            height: calc(100% - 36px);
            border-radius: 0 999px 999px 0;
            background: var(--accent);
            opacity: 0;
            transform: scaleY(.45);
            transform-origin: center;
            transition:
                opacity .22s ease,
                transform .22s ease;
        }

        .tab-button:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, .11);
            color: var(--white);
            border-color: rgba(255, 255, 255, .22);
            box-shadow: 0 14px 32px rgba(0, 0, 0, .18);
        }

        .tab-button.active {
            transform: translateY(-3px);
            background: linear-gradient(135deg, rgba(246, 207, 97, .18), rgba(255, 255, 255, .10));
            color: var(--white);
            border-color: rgba(246, 207, 97, .36);
            box-shadow:
                0 16px 36px rgba(0, 0, 0, .22),
                inset 0 1px 0 rgba(255, 255, 255, .10);
        }

        .tab-button.active::before {
            opacity: 1;
            transform: scaleY(1);
        }

        .tab-button:active {
            transform: translateY(0) scale(.985);
            box-shadow: 0 8px 20px rgba(0, 0, 0, .18);
        }

        .tab-button strong {
            position: relative;
            z-index: 1;
            display: block;
            margin-bottom: 6px;
            color: inherit;
            font-size: 15px;
            font-weight: 800;
        }

        .tab-button span {
            position: relative;
            z-index: 1;
            display: block;
            color: rgba(255, 255, 255, .82);
            font-size: 13px;
            line-height: 1.5;
        }

        .visual-card {
            min-height: 650px;
            padding: 24px;
            border-radius: 38px;
            background: rgba(20, 28, 38, .66);
        }

        .visual-frame {
            overflow: hidden;
            border-radius: 28px;
            background: rgba(255, 255, 255, .90);
            border: 1px solid rgba(255, 255, 255, .14);
        }

        .visual-frame img {
            display: block;
            width: 100%;
            height: 548px;
            object-fit: contain;
            background: #f7f7f7;
            cursor: zoom-in;
            transition:
                transform .22s ease,
                filter .22s ease;
        }

        .visual-frame img:hover {
            transform: scale(1.012);
            filter: brightness(.96);
        }

        .visual-caption {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 18px;
            align-items: center;
            margin-top: 18px;
        }

        .visual-caption h3 {
            margin-bottom: 8px;
            font-size: 26px;
        }

        .visual-caption p {
            color: rgba(255, 255, 255, .88);
            line-height: 1.65;
        }

        .takeaway-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .takeaway-card {
            padding: 34px;
            border-radius: 36px;
        }

        .takeaway-card h3 {
            margin-bottom: 14px;
            font-size: 26px;
        }

        .takeaway-card p,
        .takeaway-card li {
            color: rgba(255, 255, 255, .88);
            line-height: 1.7;
        }

        .takeaway-card ul {
            padding-left: 20px;
        }

        .takeaway-card li {
            margin-bottom: 10px;
        }

        .image-modal {
            position: fixed;
            inset: 0;
            z-index: 500;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: rgba(0, 0, 0, .76);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .image-modal.active {
            display: flex;
        }

        .modal-inner {
            position: relative;
            width: min(1120px, 100%);
            max-height: 92vh;
            overflow: hidden;
            border-radius: 28px;
            background: #f7f7f7;
        }

        .modal-inner img {
            display: block;
            width: 100%;
            max-height: 88vh;
            object-fit: contain;
        }

        .modal-close {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 42px;
            height: 42px;
            border: 0;
            border-radius: 999px;
            color: var(--white);
            background: rgba(20, 28, 38, .80);
            cursor: pointer;
            font-size: 20px;
            transition:
                transform .22s ease,
                background .22s ease,
                box-shadow .22s ease;
        }

        .modal-close:hover {
            transform: translateY(-3px);
            background: rgba(20, 28, 38, .94);
            box-shadow: 0 14px 32px rgba(0, 0, 0, .22);
        }

        @media (max-width: 1080px) {
            section {
                padding-inline: 28px;
            }

            .hero-grid,
            .gallery-layout,
            .takeaway-grid {
                grid-template-columns: 1fr;
            }

            .hero-panel {
                max-width: 720px;
            }

            .floating-resource-stack {
                right: 18px;
                bottom: 18px;
            }

            .metrics-grid,
            .pipeline-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .gallery-tabs {
                position: static;
            }
        }

        @media (max-width: 720px) {
            body {
                background:
                    linear-gradient(rgba(0, 0, 0, .62), rgba(0, 0, 0, .70)),
                    url("{{ asset('images/background.jpg') }}") center / cover fixed no-repeat;
            }

            .project-topbar {
                top: 16px;
                padding: 6px;
            }

            .home-button {
                height: 38px;
                padding: 0 17px;
                font-size: 13px;
            }

            .project-arrow {
                width: 38px;
                height: 38px;
                flex-basis: 38px;
            }

            .project-arrow svg {
                width: 19px;
                height: 19px;
            }

            section {
                padding: 64px 20px;
            }

            .hero {
                padding-top: 104px;
                padding-bottom: 70px;
            }

            .hero-grid {
                gap: 28px;
            }

            h1 {
                font-size: clamp(2.55rem, 12vw, 3.65rem);
                line-height: 1;
            }

            .lead {
                margin-top: 18px;
                font-size: 15px;
                line-height: 1.68;
            }

            .hero-actions {
                margin-top: 26px;
            }

            .hero-panel {
                min-height: auto;
                padding: 14px;
                border-radius: 30px;
            }

            .mock-window {
                min-height: auto;
                border-radius: 24px;
            }

            .window-content {
                padding: 18px;
            }

            .preview-header,
            .mini-grid,
            .metrics-grid,
            .pipeline-grid {
                grid-template-columns: 1fr;
            }

            .score-pill {
                width: 86px;
                height: 86px;
                min-width: 86px;
                min-height: 86px;
            }

            .bar-row {
                grid-template-columns: 96px 1fr 42px;
                font-size: 12px;
            }

            .floating-resource-stack {
                right: 14px;
                bottom: 14px;
                gap: 8px;
                padding: 8px;
                border-radius: 20px;
            }

            .floating-resource-btn {
                width: 48px;
                height: 48px;
                border-radius: 15px;
            }

            .visual-card {
                min-height: auto;
                padding: 16px;
                border-radius: 28px;
            }

            .visual-frame img {
                height: 320px;
            }

            .visual-caption {
                grid-template-columns: 1fr;
            }

            .section-heading {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 420px) {
            .hero-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .btn,
            .open-btn {
                width: 100%;
            }

            .floating-resource-stack {
                flex-direction: row;
                right: 50%;
                bottom: 12px;
                transform: translateX(50%);
            }

            .tag {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
    <div class="grain" aria-hidden="true"></div>

    <div class="dynamic-background" aria-hidden="true">
        <canvas id="backgroundCanvas"></canvas>
    </div>

    <div class="project-topbar" aria-label="Project navigation">
        <a class="prev-arrow" href="{{ url('alfagift') }}" aria-label="Previous project">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M15 5l-7 7 7 7" />
            </svg>
        </a>

        <a class="home-button" href="{{ url('/') }}" aria-label="Back to portfolio">
            Home
        </a>

        <a class="next-arrow" href="" aria-label="Next project">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>

    <main>
        <section id="overview" class="hero">
            <div class="container hero-grid">
                <div class="hero-copy">
                    <h1>Power BI KPI Dashboard for <span>Company Performance</span></h1>

                    <p class="lead">
                        A performance dashboard prototype that translates IT Balanced Scorecard indicators into a clear,
                        interactive monitoring experience. The dashboard helps compare corporate contribution, customer
                        orientation, operational excellence, and future orientation through structured KPI pages,
                        slicers, score cards, trends, and target-based visuals.
                    </p>

                    <div class="tag-row">
                        <span class="tag">Power BI</span>
                        <span class="tag">KPI Dashboard</span>
                        <span class="tag">IT Balanced Scorecard</span>
                        <span class="tag">Excel Dataset</span>
                        <span class="tag">Data Modeling</span>
                        <span class="tag">Performance Analytics</span>
                    </div>

                    <div class="hero-actions">
                        <a class="btn btn-primary" href="#visuals">View Dashboard Screens</a>
                        <a class="btn" href="#process">See Design Process</a>
                    </div>
                </div>

                <aside class="hero-panel" aria-label="Power BI project preview">
                    <div class="mock-window">
                        <div class="window-bar">
                            <div class="window-dots" aria-hidden="true">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </div>
                            <span class="window-label">Power BI Prototype</span>
                        </div>

                        <div class="window-content">
                            <div class="dashboard-preview">
                                <div class="preview-header spotlight-card">
                                    <div>
                                        <p>Dashboard Scope</p>
                                        <strong>IT Balanced Scorecard Performance Control</strong>
                                    </div>
                                    <div class="score-pill">4</div>
                                </div>

                                <div class="mini-grid">
                                    <div class="mini-card spotlight-card">
                                        <span>KPI Groups</span>
                                        <strong>4</strong>
                                    </div>

                                    <div class="mini-card spotlight-card">
                                        <span>Dashboard Levels</span>
                                        <strong>2</strong>
                                    </div>
                                </div>

                                <div class="bar-list spotlight-card">
                                    <p class="mini-title">Perspective Coverage</p>

                                    <div class="bar-row">
                                        <span>Corporate Contribution</span>
                                        <div class="bar-track">
                                            <div class="bar-fill" style="width: 92%"></div>
                                        </div>
                                        <strong>CC</strong>
                                    </div>

                                    <div class="bar-row">
                                        <span>Customer Orientation</span>
                                        <div class="bar-track">
                                            <div class="bar-fill" style="width: 84%"></div>
                                        </div>
                                        <strong>CO</strong>
                                    </div>

                                    <div class="bar-row">
                                        <span>Operational Excellence</span>
                                        <div class="bar-track">
                                            <div class="bar-fill" style="width: 88%"></div>
                                        </div>
                                        <strong>OE</strong>
                                    </div>

                                    <div class="bar-row">
                                        <span>Future Orientation</span>
                                        <div class="bar-track">
                                            <div class="bar-fill" style="width: 80%"></div>
                                        </div>
                                        <strong>FO</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="floating-resource-stack" aria-label="Project resources">
                        <a class="floating-resource-btn" href="LINK_GITHUB_KAMU" target="_blank" rel="noopener"
                            aria-label="Open GitHub repository">
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M12 .5A12 12 0 0 0 8.2 23.9c.6.1.8-.2.8-.6v-2.1c-3.3.7-4-1.4-4-1.4-.5-1.3-1.2-1.7-1.2-1.7-1-.7.1-.7.1-.7 1.1.1 1.7 1.2 1.7 1.2 1 1.7 2.6 1.2 3.4 1 .1-.7.4-1.2.7-1.5-2.6-.3-5.4-1.3-5.4-5.9 0-1.3.5-2.4 1.2-3.2-.1-.3-.5-1.6.1-3.2 0 0 1-.3 3.3 1.2a11.4 11.4 0 0 1 6 0c2.3-1.5 3.3-1.2 3.3-1.2.6 1.6.2 2.9.1 3.2.8.8 1.2 1.9 1.2 3.2 0 4.6-2.8 5.6-5.4 5.9.4.4.8 1.1.8 2.2v3.2c0 .4.2.7.8.6A12 12 0 0 0 12 .5Z" />
                            </svg>
                        </a>

                        <a class="floating-resource-btn" href="LINK_LAPORAN_KAMU" target="_blank" rel="noopener"
                            aria-label="Open project report">
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M7 3.5h7.2L19 8.3v12.2H7V3.5Z" stroke="currentColor" stroke-width="1.8"
                                    stroke-linejoin="round" />
                                <path d="M14 3.5V9h5" stroke="currentColor" stroke-width="1.8"
                                    stroke-linejoin="round" />
                                <path d="M9.7 13h6.6M9.7 16h6.6" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" />
                            </svg>
                        </a>
                    </div>
                </aside>
            </div>
        </section>

        <section aria-label="Project summary">
            <div class="container">
                <div class="section-heading">
                    <h2>What this dashboard solves.</h2>
                    <p>
                        The project turns scattered KPI definitions and representative data into a dashboard structure
                        that is easier to monitor, compare, and explain for management-level performance evaluation.
                    </p>
                </div>

                <div class="metrics-grid">
                    <article class="metric-card spotlight-card">
                        <span>Framework</span>
                        <strong>IT-BSC</strong>
                        <p>Uses IT Balanced Scorecard perspectives to connect digital initiatives with business impact.
                        </p>
                    </article>

                    <article class="metric-card spotlight-card">
                        <span>Data Source</span>
                        <strong>Excel</strong>
                        <p>Built from structured KPI tables and mockup performance data prepared for dashboard modeling.
                        </p>
                    </article>

                    <article class="metric-card spotlight-card">
                        <span>Tool</span>
                        <strong>Power BI</strong>
                        <p>Designed with slicers, cards, line charts, column charts, gauge visuals, and page navigation.
                        </p>
                    </article>

                    <article class="metric-card spotlight-card">
                        <span>Output</span>
                        <strong>2 Levels</strong>
                        <p>Includes a central dashboard view and branch-level dashboard views for more contextual
                            analysis.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="process">
            <div class="container">
                <div class="section-heading">
                    <h2>From KPI structure to dashboard experience.</h2>
                    <p>
                        The workflow focuses on making the dashboard practical: define the right indicators, prepare the
                        dataset, transform the data, then design a visual flow that guides users from overview to
                        detail.
                    </p>
                </div>

                <div class="pipeline-grid">
                    <article class="step-card spotlight-card" data-step="01">
                        <h3>KPI Definition</h3>
                        <p>
                            Mapped KPI indicators into four IT-BSC perspectives: Corporate Contribution, Customer
                            Orientation, Operational Excellence, and Future Orientation.
                        </p>
                        <div class="tag-row">
                            <span class="tag">KPI Mapping</span>
                            <span class="tag">IT-BSC</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="02">
                        <h3>Dataset Preparation</h3>
                        <p>
                            Organized mockup KPI data in Excel so each indicator had the needed period, target, score,
                            branch, and measurement fields for visualization.
                        </p>
                        <div class="tag-row">
                            <span class="tag">Excel</span>
                            <span class="tag">Mockup Data</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="03">
                        <h3>ETL & Data Modeling</h3>
                        <p>
                            Cleaned, transformed, and connected the data inside Power BI so dashboard visuals could read
                            consistent KPI values across multiple pages.
                        </p>
                        <div class="tag-row">
                            <span class="tag">Power Query</span>
                            <span class="tag">Data Model</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="04">
                        <h3>Dashboard Wireframe</h3>
                        <p>
                            Planned a navigation-first layout with a main overview page, perspective pages, year
                            slicers,
                            KPI score panels, and target comparison areas.
                        </p>
                        <div class="tag-row">
                            <span class="tag">Figma</span>
                            <span class="tag">Layout</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="05">
                        <h3>Visual Development</h3>
                        <p>
                            Built charts based on KPI behavior: cards for summary numbers, line charts for trends,
                            column charts for comparison, and gauges for target status.
                        </p>
                        <div class="tag-row">
                            <span class="tag">Charts</span>
                            <span class="tag">Targets</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="06">
                        <h3>Interpretation</h3>
                        <p>
                            Framed each dashboard page so users can quickly identify which indicators are on target,
                            below target, or showing important performance movement.
                        </p>
                        <div class="tag-row">
                            <span class="tag">Insights</span>
                            <span class="tag">Monitoring</span>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section id="visuals">
            <div class="container">
                <div class="section-heading">
                    <h2>Dashboard screens and interaction flow.</h2>
                    <p>
                        Each screen is structured around a specific decision-making need, from executive context to KPI
                        monitoring by perspective.
                    </p>
                </div>

                <div class="gallery-layout">
                    <div class="gallery-tabs" role="tablist" aria-label="Dashboard screens">
                        <button class="tab-button active" type="button" data-title="Main Dashboard"
                            data-desc="Introduces the dashboard context, company values, vision, and mission before users explore KPI performance pages."
                            data-img="{{ asset('images/projects/powerbi/dashboard-main.png') }}">
                            <strong>Main Dashboard</strong>
                            <span>Opening screen for context and navigation.</span>
                        </button>

                        <button class="tab-button" type="button" data-title="Corporate Contribution"
                            data-desc="Shows the contribution of digital initiatives through KPI scores, ROI cards, revenue movement, strategic alliance performance, and budget utilization."
                            data-img="{{ asset('images/projects/powerbi/corporate-contribution.png') }}">
                            <strong>Corporate Contribution</strong>
                            <span>Business contribution and digital value indicators.</span>
                        </button>

                        <button class="tab-button" type="button" data-title="Customer Orientation"
                            data-desc="Tracks digital customer experience through satisfaction, complaints, active users, completion time, and customer data security trust."
                            data-img="{{ asset('images/projects/powerbi/customer-orientation.png') }}">
                            <strong>Customer Orientation</strong>
                            <span>Customer-facing service and experience metrics.</span>
                        </button>

                        <button class="tab-button" type="button" data-title="Operational Excellence"
                            data-desc="Monitors operational reliability through system downtime, cost efficiency, website uptime, incident ratio, and UT Connect uptime."
                            data-img="{{ asset('images/projects/powerbi/operational-excellence.png') }}">
                            <strong>Operational Excellence</strong>
                            <span>System stability, downtime, and incident indicators.</span>
                        </button>

                        <button class="tab-button" type="button" data-title="Future Orientation"
                            data-desc="Highlights digital readiness through implemented innovations, audit completion, approval rate, legacy modernization, and IT employee certification."
                            data-img="{{ asset('images/projects/powerbi/future-orientation.png') }}">
                            <strong>Future Orientation</strong>
                            <span>Innovation, modernization, and capability growth.</span>
                        </button>
                    </div>

                    <article class="visual-card spotlight-card">
                        <div class="visual-frame">
                            <img id="visualImage" src="{{ asset('images/projects/powerbi/dashboard-main.png') }}"
                                alt="Main Dashboard visual">
                        </div>

                        <div class="visual-caption">
                            <div>
                                <h3 id="visualTitle">Main Dashboard</h3>
                                <p id="visualDesc">
                                    Introduces the dashboard context, company values, vision, and mission before users
                                    explore KPI performance pages.
                                </p>
                            </div>

                            <button class="open-btn" type="button" id="openImage">Open Image</button>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section id="takeaways">
            <div class="container">
                <div class="section-heading">
                    <h2>What this project demonstrates.</h2>
                    <p>
                        Beyond making charts, this project shows how dashboard design can make complex performance data
                        easier to read, compare, and discuss.
                    </p>
                </div>

                <div class="takeaway-grid">
                    <article class="takeaway-card spotlight-card">
                        <h3>Analytical Value</h3>
                        <p>
                            The dashboard gives users a structured way to monitor digital performance across multiple
                            perspectives. Instead of reading KPI tables one by one, users can immediately see trends,
                            target achievement, and performance gaps from one visual interface.
                        </p>
                    </article>

                    <article class="takeaway-card spotlight-card">
                        <h3>Technical Strength</h3>
                        <ul>
                            <li>Translated KPI documents into a dashboard-ready data model.</li>
                            <li>Designed a multi-page Power BI dashboard with clear navigation and visual hierarchy.
                            </li>
                            <li>Matched chart types to KPI behavior so each metric is easier to interpret.</li>
                            <li>Used target lines, score cards, slicers, and summary panels to support quick monitoring.
                            </li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <div class="image-modal" id="imageModal" aria-hidden="true">
        <div class="modal-inner">
            <button class="modal-close" type="button" id="closeModal" aria-label="Close image preview">×</button>
            <img id="modalImage" src="{{ asset('images/projects/powerbi/dashboard-main.png') }}"
                alt="Expanded dashboard visual">
        </div>
    </div>

    <script>
        const backgroundCanvas = document.getElementById('backgroundCanvas');
        const backgroundCtx = backgroundCanvas.getContext('2d');

        let backgroundParticles = [];
        let backgroundMouse = {
            x: null,
            y: null
        };

        const backgroundSettings = {
            count: 180,
            color: '255, 255, 255',
            speed: 0.45,
            baseSize: 2.8,
            hoverDistance: 280,
            hoverForce: 2.4
        };

        function resizeBackgroundCanvas() {
            backgroundCanvas.width = window.innerWidth;
            backgroundCanvas.height = window.innerHeight;
            createBackgroundParticles();
        }

        function createBackgroundParticles() {
            backgroundParticles = [];

            for (let i = 0; i < backgroundSettings.count; i++) {
                backgroundParticles.push({
                    x: Math.random() * backgroundCanvas.width,
                    y: Math.random() * backgroundCanvas.height,
                    vx: (Math.random() - 0.5) * backgroundSettings.speed,
                    vy: (Math.random() - 0.5) * backgroundSettings.speed,
                    size: Math.random() * backgroundSettings.baseSize + 0.6,
                    alpha: Math.random() * 0.45 + 0.22
                });
            }
        }

        function drawBackgroundParticles() {
            backgroundCtx.clearRect(0, 0, backgroundCanvas.width, backgroundCanvas.height);

            backgroundParticles.forEach(particle => {
                const dx = backgroundMouse.x - particle.x;
                const dy = backgroundMouse.y - particle.y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (backgroundMouse.x !== null && distance < backgroundSettings.hoverDistance && distance > 0) {
                    const force = (backgroundSettings.hoverDistance - distance) / backgroundSettings.hoverDistance;

                    particle.x -= (dx / distance) * force * backgroundSettings.hoverForce;
                    particle.y -= (dy / distance) * force * backgroundSettings.hoverForce;
                }

                particle.x += particle.vx;
                particle.y += particle.vy;

                if (particle.x < 0) particle.x = backgroundCanvas.width;
                if (particle.x > backgroundCanvas.width) particle.x = 0;
                if (particle.y < 0) particle.y = backgroundCanvas.height;
                if (particle.y > backgroundCanvas.height) particle.y = 0;

                backgroundCtx.beginPath();
                backgroundCtx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
                backgroundCtx.fillStyle = `rgba(${backgroundSettings.color}, ${particle.alpha})`;
                backgroundCtx.fill();
            });

            requestAnimationFrame(drawBackgroundParticles);
        }

        window.addEventListener('resize', resizeBackgroundCanvas);

        window.addEventListener('mousemove', event => {
            backgroundMouse.x = event.clientX;
            backgroundMouse.y = event.clientY;
        });

        window.addEventListener('mouseleave', () => {
            backgroundMouse.x = null;
            backgroundMouse.y = null;
        });

        resizeBackgroundCanvas();
        drawBackgroundParticles();

        const spotlightCards = document.querySelectorAll('.spotlight-card');

        spotlightCards.forEach(card => {
            card.style.setProperty('--spotlight-color', 'rgba(246, 207, 97, .13)');

            card.addEventListener('mousemove', event => {
                const rect = card.getBoundingClientRect();
                const x = event.clientX - rect.left;
                const y = event.clientY - rect.top;

                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);
            });
        });

        const tabButtons = document.querySelectorAll('.tab-button');
        const visualImage = document.getElementById('visualImage');
        const visualTitle = document.getElementById('visualTitle');
        const visualDesc = document.getElementById('visualDesc');
        const imageModal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const openImage = document.getElementById('openImage');
        const closeModal = document.getElementById('closeModal');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                tabButtons.forEach(tab => tab.classList.remove('active'));
                button.classList.add('active');

                const image = button.dataset.img;
                const title = button.dataset.title;
                const desc = button.dataset.desc;

                visualImage.src = image;
                visualImage.alt = `${title} visual`;
                visualTitle.textContent = title;
                visualDesc.textContent = desc;
            });
        });

        function showModal() {
            modalImage.src = visualImage.src;
            modalImage.alt = visualImage.alt;
            imageModal.classList.add('active');
            imageModal.setAttribute('aria-hidden', 'false');
        }

        function hideModal() {
            imageModal.classList.remove('active');
            imageModal.setAttribute('aria-hidden', 'true');
        }

        visualImage.addEventListener('click', showModal);
        openImage.addEventListener('click', showModal);
        closeModal.addEventListener('click', hideModal);

        imageModal.addEventListener('click', event => {
            if (event.target === imageModal) hideModal();
        });

        window.addEventListener('keydown', event => {
            if (event.key === 'Escape') hideModal();
        });
    </script>
</body>

</html>
