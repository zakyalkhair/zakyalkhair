{{-- resources/views/portfolio/projects/alfagift.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfagift Sentiment Analysis — Zaky</title>

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
            --paper: #f5f1e7;
            --ink: #15202b;
            --muted: rgba(255, 255, 255, .88);
            --glass: rgba(20, 28, 38, .62);
            --glass-strong: rgba(20, 28, 38, .78);
            --line: rgba(255, 255, 255, .16);
            --accent: #f6cf61;
            --accent-soft: rgba(246, 207, 97, .18);
            --green: #8fd694;
            --blue: #93c5fd;

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
                linear-gradient(rgba(0, 0, 0, .50), rgba(0, 0, 0, .62)),
                url("{{ asset('images/background.jpg') }}") center / cover fixed no-repeat;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(circle at 18% 18%, rgba(246, 207, 97, .16), transparent 26%),
                radial-gradient(circle at 82% 24%, rgba(147, 197, 253, .13), transparent 25%),
                radial-gradient(circle at 50% 92%, rgba(143, 214, 148, .12), transparent 30%);
        }

        .grain {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            opacity: .16;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.45'/%3E%3C/svg%3E");
        }

        main,
        .project-nav {
            position: relative;
            z-index: 2;
        }

        .project-nav {
            position: fixed;
            top: 22px;
            left: 50%;
            z-index: 1000;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 48px;

            width: fit-content;
            max-width: calc(100% - 32px);
            padding: 18px 46px;

            border-radius: 999px;
            background: rgba(232, 237, 244, 0.85);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);

            transform: translateX(-50%);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .project-nav a {
            color: var(--text-muted);
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.01em;
            text-decoration: none;
            white-space: nowrap;
            transition:
                color .22s ease,
                font-weight .22s ease;
        }

        .project-nav a:hover,
        .project-nav a.active {
            color: var(--navy);
            font-weight: 700;
        }

        section {
            width: 100%;
            padding: 110px 72px;
        }

        .container {
            width: min(1180px, 100%);
            margin: 0 auto;
        }

        /* =========================
           SPOTLIGHT EFFECT
           Blade-friendly version of React Bits SpotlightCard
        ========================= */
        /* =========================
   SPOTLIGHT EFFECT
   Blade-friendly version of React Bits SpotlightCard
========================= */
        .spotlight-card {
            position: relative;
            overflow: hidden;
            --mouse-x: 50%;
            --mouse-y: 50%;
            --spotlight-color: #1b3a5c;
        }

        .spotlight-card::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 0;

            background:
                radial-gradient(circle 520px at var(--mouse-x) var(--mouse-y),
                    var(--spotlight-color),
                    rgba(246, 207, 97, .06) 38%,
                    transparent 78%);

            opacity: 0;
            pointer-events: none;
            transition: opacity .38s ease;
        }

        .spotlight-card:hover::before,
        .spotlight-card:focus-within::before {
            opacity: .85;
        }

        .spotlight-card>* {
            position: relative;
            z-index: 1;
        }

        /* =========================
           HERO
        ========================= */
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

        .hero-copy {
            max-width: 660px;
        }

        h1 {
            max-width: 660px;
            font-size: clamp(3rem, 5vw, 4.75rem);
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
            max-width: 610px;
            margin-top: 22px;
            color: rgba(255, 255, 255, .90);
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

        .tag img {
            width: 15px;
            height: 15px;
            object-fit: contain;
            display: block;
            flex-shrink: 0;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
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

            font-size: 14px;
            font-weight: 800;

            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            transition:
                transform .22s ease,
                background .22s ease,
                border-color .22s ease,
                box-shadow .22s ease;
        }

        .btn:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, .16);
            border-color: rgba(255, 255, 255, .30);
            box-shadow: 0 14px 32px rgba(0, 0, 0, .18);
        }

        .btn-primary {
            color: #1b2a34;
            background: var(--accent);
            border-color: transparent;
        }

        .btn-primary:hover {
            background: #ffdc72;
            border-color: transparent;
            box-shadow: 0 14px 32px rgba(246, 207, 97, .22);
        }

        aside {
            border-radius: 40px;
        }

        .hero-panel {
            position: relative;
            min-height: 500px;
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
            min-height: 464px;
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

        .window-label {
            color: rgba(255, 255, 255, .70);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .32);
        }

        .window-content {
            padding: clamp(20px, 3vw, 28px);
        }

        .chart-card {
            border-radius: 24px;
            padding: 22px;
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
            grid-template-columns: 112px 1fr 52px;
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
            background: linear-gradient(90deg, var(--accent), var(--green));
        }

        .panel-note {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin-top: 14px;
        }

        .note-box {
            border-radius: 20px;
            padding: 18px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .10);
        }

        .note-box strong {
            display: block;
            margin-bottom: 8px;
            font-size: 22px;
        }

        .note-box span {
            color: rgba(255, 255, 255, .82);
            font-size: 13px;
            line-height: 1.5;
        }

        /* floating stacked resources */
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
            background: rgba(20, 28, 38, .82);

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

        .floating-resource-btn.github,
        .floating-resource-btn.report {
            color: rgba(255, 255, 255, .88);
            background: rgba(255, 255, 255, .10);
        }

        .floating-resource-btn:hover {
            transform: translateY(-3px) scale(1.03);
            border-color: rgba(255, 255, 255, .28);
            box-shadow: 0 14px 32px rgba(0, 0, 0, .18);
        }

        .floating-resource-btn.github:hover,
        .floating-resource-btn.report:hover {
            color: #1b2a34;
            background: var(--accent);
            border-color: transparent;
            box-shadow: 0 14px 32px rgba(246, 207, 97, .22);
        }

        /* =========================
           SECTIONS
        ========================= */
        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 30px;
        }

        .section-heading h2 {
            max-width: 720px;
            font-size: clamp(2.3rem, 4vw, 4rem);
            line-height: 1;
            letter-spacing: -.045em;
        }

        .section-heading p {
            max-width: 420px;
            color: rgba(255, 255, 255, .86);
            line-height: 1.7;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .metric-card {
            min-height: 170px;
            padding: 24px;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, .14);
            background: var(--glass);
            box-shadow: 0 20px 60px rgba(0, 0, 0, .22);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);

            transition:
                background .22s ease,
                border-color .22s ease,
                box-shadow .22s ease;
        }

        .metric-card:hover {
            border-color: rgba(255, 255, 255, .20);
            box-shadow: 0 24px 68px rgba(0, 0, 0, .26);
        }

        .metric-card span {
            display: block;
            margin-bottom: 22px;
            color: rgba(255, 255, 255, .78);
            font-size: 12px;
            font-weight: 700;
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
            min-height: 240px;
            padding: 28px;
            border-radius: 32px;
            border: 1px solid rgba(255, 255, 255, .14);
            background: var(--glass);
            box-shadow: 0 20px 60px rgba(0, 0, 0, .22);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);

            transition:
                background .22s ease,
                border-color .22s ease,
                box-shadow .22s ease;
        }

        .step-card:hover {
            border-color: rgba(255, 255, 255, .20);
            box-shadow: 0 24px 68px rgba(0, 0, 0, .26);
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
            background:
                linear-gradient(135deg, rgba(246, 207, 97, .18), rgba(255, 255, 255, .10));
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

        .tab-button.active span {
            color: rgba(255, 255, 255, .90);
        }

        .visual-card {
            min-height: 620px;
            padding: 24px;
            border-radius: 38px;
            border: 1px solid rgba(255, 255, 255, .14);
            background: rgba(20, 28, 38, .66);
            box-shadow: 0 26px 80px rgba(0, 0, 0, .30);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
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
            height: 520px;
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

        .open-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 48px;
            padding: 0 19px;
            border: 0;
            border-radius: 999px;

            color: #1b2a34;
            background: var(--accent);
            font-family: inherit;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;

            transition:
                transform .22s ease,
                background .22s ease,
                box-shadow .22s ease;
        }

        .open-btn:hover {
            transform: translateY(-3px);
            background: #ffdc72;
            box-shadow: 0 14px 32px rgba(246, 207, 97, .22);
        }

        .takeaway-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .takeaway-card {
            padding: 34px;
            border-radius: 36px;
            border: 1px solid rgba(255, 255, 255, .14);
            background: var(--glass);
            box-shadow: 0 20px 60px rgba(0, 0, 0, .22);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);

            transition:
                background .22s ease,
                border-color .22s ease,
                box-shadow .22s ease;
        }

        .takeaway-card:hover {
            border-color: rgba(255, 255, 255, .20);
            box-shadow: 0 24px 68px rgba(0, 0, 0, .26);
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

        /* =========================
           RESPONSIVE
        ========================= */
        @media (max-width: 1080px) {
            section {
                padding-inline: 28px;
            }

            .hero-grid,
            .gallery-layout,
            .takeaway-grid,
            .cta-card {
                grid-template-columns: 1fr;
            }

            .hero-grid {
                gap: 34px;
            }

            .hero-copy {
                max-width: 760px;
            }

            .hero-panel {
                max-width: 680px;
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

            .cta-actions {
                justify-content: flex-start;
            }
        }

        @media (max-width: 720px) {
            .project-nav {
                justify-content: flex-start;
                overflow-x: auto;
                padding: 12px 16px;
                gap: 18px;
                scrollbar-width: none;
            }

            .project-nav::-webkit-scrollbar {
                display: none;
            }

            .project-nav a {
                font-size: 15px;
            }

            section {
                padding: 30px 20px;
            }

            .hero {
                padding-top: 104px;
                padding-bottom: 70px;
            }

            .hero-grid {
                gap: 28px;
            }

            .hero-copy {
                max-width: 100%;
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

            .panel-note,
            .metrics-grid,
            .pipeline-grid {
                grid-template-columns: 1fr;
            }

            .bar-row {
                grid-template-columns: 84px 1fr 46px;
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

            .floating-resource-btn svg {
                width: 19px;
                height: 19px;
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

            .cta-card {
                padding: 26px;
                border-radius: 30px;
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

    <nav class="project-nav" aria-label="Project navigation">
        <a class="back-link" href="{{ url('/') }}#projects">← Portfolio</a>
        <a class="active" href="#overview">Overview</a>
        <a href="#process">Process</a>
        <a href="#visuals">Visuals</a>
        <a href="#takeaways">Takeaways</a>
    </nav>

    <main>
        <section id="overview" class="hero">
            <div class="container hero-grid">
                <div class="hero-copy">
                    <h1>Sentiment Analysis of <span>Alfagift</span> Reviews.</h1>

                    <p class="lead">
                        An end-to-end sentiment analysis project that turns Alfagift Google Play reviews into clearer
                        customer signals.
                        The workflow cleans Indonesian review text, converts it with TF-IDF, trains sentiment models,
                        and summarizes which parts of the app experience users praise or complain about most.
                    </p>

                    <div class="tag-row">
                        <span class="tag">Python</span>

                        <span class="tag">Pandas</span>

                        <span class="tag">Sastrawi</span>
                        <span class="tag">TF-IDF</span>
                        <span class="tag">Scikit-learn</span>
                        <span class="tag">LightGBM</span>
                    </div>

                    <div class="hero-actions">
                        <a class="btn btn-primary" href="#visuals">View Analysis Visuals</a>
                        <a class="btn btn-primary" href="#process">See Workflow</a>
                    </div>
                </div>

                <aside class="hero-panel" data-spotlight-color="rgba(246, 207, 97, .14)"
                    aria-label="Project dashboard preview">
                    <div class="mock-window">
                        <div class="window-bar">
                            <div class="window-dots">
                            </div>
                        </div>

                        <div class="window-content">
                            <div class="chart-card spotlight-card" data-spotlight-color="rgba(143, 214, 148, .16)">
                                <p class="mini-title">Review Signal Preview</p>

                                <div class="bar-row">
                                    <span>App Flow</span>
                                    <div class="bar-track">
                                        <div class="bar-fill" style="width: 88%"></div>
                                    </div>
                                    <strong>High</strong>
                                </div>

                                <div class="bar-row">
                                    <span>Login</span>
                                    <div class="bar-track">
                                        <div class="bar-fill" style="width: 76%"></div>
                                    </div>
                                    <strong>Med</strong>
                                </div>

                                <div class="bar-row">
                                    <span>Promo</span>
                                    <div class="bar-track">
                                        <div class="bar-fill" style="width: 70%"></div>
                                    </div>
                                    <strong>Med</strong>
                                </div>

                                <div class="bar-row">
                                    <span>Checkout</span>
                                    <div class="bar-track">
                                        <div class="bar-fill" style="width: 82%"></div>
                                    </div>
                                    <strong>High</strong>
                                </div>
                            </div>

                            <div class="panel-note">
                                <div class="note-box spotlight-card" data-spotlight-color="rgba(246, 207, 97, .16)">
                                    <strong>TF-IDF</strong>
                                    <span>
                                        Weighted text features used to capture important review terms.
                                    </span>
                                </div>

                                <div class="note-box spotlight-card" data-spotlight-color="rgba(143, 214, 148, .16)">
                                    <strong>3-Class</strong>
                                    <span>
                                        Feedback grouped into positive, neutral, and negative sentiment.
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="floating-resource-stack" aria-label="Project resources">
                        <a class="floating-resource-btn github"
                            href="https://github.com/zakyalkhair/alfagift-sentiment-analysis" target="_blank"
                            rel="noopener" aria-label="Open GitHub repository">
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M12 .5A12 12 0 0 0 8.2 23.9c.6.1.8-.2.8-.6v-2.1c-3.3.7-4-1.4-4-1.4-.5-1.3-1.2-1.7-1.2-1.7-1-.7.1-.7.1-.7 1.1.1 1.7 1.2 1.7 1.2 1 .1.6 2.8 3.4 2 .1-.7.4-1.2.7-1.5-2.6-.3-5.4-1.3-5.4-5.9 0-1.3.5-2.4 1.2-3.2-.1-.3-.5-1.6.1-3.2 0 0 1-.3 3.3 1.2a11.4 11.4 0 0 1 6 0c2.3-1.5 3.3-1.2 3.3-1.2.6 1.6.2 2.9.1 3.2.8.8 1.2 1.9 1.2 3.2 0 4.6-2.8 5.6-5.4 5.9.4.4.8 1.1.8 2.2v3.2c0 .4.2.7.8.6A12 12 0 0 0 12 .5Z" />
                            </svg>
                        </a>

                        <a class="floating-resource-btn report" href="LINK_LAPORAN_KAMU" target="_blank" rel="noopener"
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
                    <h2>What this project is about.</h2>
                    <p>
                        This project starts from raw app reviews and ends with a simple question: what are Alfagift
                        users actually feeling,
                        and which issues appear often enough to deserve attention?
                    </p>
                </div>

                <div class="metrics-grid">
                    <article class="metric-card spotlight-card" data-spotlight-color="rgba(246, 207, 97, .16)">
                        <span>Dataset</span>
                        <strong>Google Play</strong>
                        <p>User feedback collected from Alfagift reviews on Google Play.</p>
                    </article>

                    <article class="metric-card spotlight-card" data-spotlight-color="rgba(143, 214, 148, .16)">
                        <span>Problem</span>
                        <strong>Sentiment</strong>
                        <p>Separating positive, neutral, and negative reviews so the feedback is easier to read at
                            scale.</p>
                    </article>

                    <article class="metric-card spotlight-card" data-spotlight-color="rgba(147, 197, 253, .16)">
                        <span>Method</span>
                        <strong>TF-IDF</strong>
                        <p>Transforming cleaned review text into weighted features that machine learning models can
                            understand.</p>
                    </article>

                    <article class="metric-card spotlight-card" data-spotlight-color="rgba(255, 255, 255, .14)">
                        <span>Output</span>
                        <strong>Insights</strong>
                        <p>Charts and explanations that connect model output with product-level user feedback.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="process">
            <div class="container">
                <div class="section-heading">
                    <h2>How the review data was processed.</h2>
                    <p>
                        The analysis follows a practical NLP workflow: collect the reviews, clean the text, build
                        features, train the model,
                        then interpret the prediction results in a way that is useful for product evaluation.
                    </p>
                </div>

                <div class="pipeline-grid">
                    <article class="step-card spotlight-card" data-step="01">
                        <h3>Scraping & Dataset Preparation</h3>
                        <p>
                            Collected Alfagift reviews from Google Play, stored the review text and metadata, then
                            organized the dataset so it was ready for cleaning and analysis.
                        </p>
                        <div class="tag-row">
                            <span class="tag">Scraping</span>
                            <span class="tag">CSV</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="02">
                        <h3>Text Preprocessing</h3>
                        <p>
                            Prepared Indonesian review text by removing noise, normalizing words, filtering stopwords,
                            applying stemming, and shaping the labels for training.
                        </p>
                        <div class="tag-row">
                            <span class="tag">Cleaning</span>
                            <span class="tag">Sastrawi</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="03">
                        <h3>Feature Engineering</h3>
                        <p>
                            Converted each review into TF-IDF features so frequent and meaningful terms could be used as
                            model input, while still keeping the result interpretable.
                        </p>
                        <div class="tag-row">
                            <span class="tag">TF-IDF</span>
                            <span class="tag">Top Terms</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="04">
                        <h3>Model Comparison</h3>
                        <p>
                            Tested several algorithms and compared their evaluation results to choose the sentiment
                            classifier with the most stable performance.
                        </p>
                        <div class="tag-row">
                            <span class="tag">SVM</span>
                            <span class="tag">LR</span>
                            <span class="tag">LightGBM</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="05">
                        <h3>Model Improvement</h3>
                        <p>
                            Refined the selected pipeline through tuning and review of evaluation results before using
                            it for final prediction.
                        </p>
                        <div class="tag-row">
                            <span class="tag">Tuning</span>
                            <span class="tag">Evaluation</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="06">
                        <h3>Inference & Interpretation</h3>
                        <p>
                            Applied the trained model to predict sentiment, checked confidence patterns, and turned the
                            results into insights about user experience.
                        </p>
                        <div class="tag-row">
                            <span class="tag">Prediction</span>
                            <span class="tag">Confidence</span>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section id="visuals">
            <div class="container">
                <div class="section-heading">
                    <h2>Analysis visuals and interpretation.</h2>
                    <p>
                        The visuals below show how the text data behaves, how the model performs, and which review
                        patterns are most useful to explain the final sentiment results.
                    </p>
                </div>

                <div class="gallery-layout">
                    <div class="gallery-tabs" role="tablist" aria-label="Analysis visuals">

                        <button class="tab-button active" type="button" data-title="Model Comparison"
                            data-desc="Compares baseline and candidate models to determine the most reliable sentiment classifier."
                            data-img="{{ asset('images/projects/alfagift/model_comparison.png') }}">
                            <strong>Model Comparison</strong>
                            <span>Performance comparison across candidate algorithms.</span>
                        </button>

                        <button class="tab-button" type="button" data-title="Best Model Confusion Matrix"
                            data-desc="Shows which sentiment classes are predicted correctly and where the model still makes mistakes."
                            data-img="{{ asset('images/projects/alfagift/best_model_test_cm.png') }}">
                            <strong>Confusion Matrix</strong>
                            <span>Class-level view of correct and incorrect predictions.</span>
                        </button>

                        <button class="tab-button" type="button" data-title="TF-IDF Top Terms"
                            data-desc="Highlights the strongest TF-IDF terms, making it easier to understand which words shape the sentiment signal."
                            data-img="{{ asset('images/projects/alfagift/top20_tfidf.png') }}">
                            <strong>Top TF-IDF Terms</strong>
                            <span>Key review terms that influence the text features.</span>
                        </button>

                        <button class="tab-button" type="button" data-title="Word Cloud"
                            data-desc="Summarizes frequent words from user reviews, giving a quick sense of what users talk about most."
                            data-img="{{ asset('images/projects/alfagift/wordcloud_tfidf.png') }}">
                            <strong>Word Cloud</strong>
                            <span>Fast overview of common words in the reviews.</span>
                        </button>

                        <button class="tab-button" type="button" data-title="Inference Confidence"
                            data-desc="Shows the model confidence during inference, helping check whether the predictions are strong or uncertain."
                            data-img="{{ asset('images/projects/alfagift/inference_confidence.png') }}">
                            <strong>Inference Confidence</strong>
                            <span>Confidence pattern of the final sentiment predictions.</span>
                        </button>
                    </div>

                    <article class="visual-card spotlight-card" data-spotlight-color="rgba(246, 207, 97, .12)">
                        <div class="visual-frame">
                            <img id="visualImage" src="{{ asset('images/projects/alfagift/model_improvement.png') }}"
                                alt="Model Improvement visual">
                        </div>

                        <div class="visual-caption">
                            <div>
                                <h3 id="visualTitle">Model Improvement</h3>
                                <p id="visualDesc">
                                    Shows how the selected model improves after refinement, so the final prediction
                                    pipeline is easier to trust.
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
                    <h2>What this project shows.</h2>
                    <p>The goal is not only to build a classifier, but also to make the review data easier to understand
                        and act on.</p>
                </div>

                <div class="takeaway-grid">
                    <article class="takeaway-card spotlight-card" data-spotlight-color="rgba(246, 207, 97, .15)">
                        <h3>Analytical Value</h3>
                        <p>
                            This project helps translate long, scattered user reviews into sentiment groups and
                            recurring feedback themes, so product teams can quickly see what users appreciate and what
                            still creates friction.
                        </p>
                    </article>

                    <article class="takeaway-card spotlight-card" data-spotlight-color="rgba(143, 214, 148, .15)">
                        <h3>Technical Strength</h3>
                        <ul>
                            <li>Built a complete Indonesian text-processing workflow, from raw reviews to sentiment
                                prediction.</li>
                            <li>Used preprocessing and TF-IDF to make user comments usable for machine learning.</li>
                            <li>Explained the result through evaluation charts, important terms, and inference
                                confidence.</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>

    </main>

    <div class="image-modal" id="imageModal" aria-hidden="true">
        <div class="modal-inner">
            <button class="modal-close" type="button" id="closeModal" aria-label="Close image preview">×</button>
            <img id="modalImage" src="{{ asset('images/projects/alfagift/model_improvement.png') }}"
                alt="Expanded analysis visual">
        </div>
    </div>

    <script>
        const navLinks = document.querySelectorAll('.project-nav a[href^="#"]');
        const sections = document.querySelectorAll('main section[id]');

        function setActiveNav() {
            const scrollPosition = window.scrollY + 180;

            sections.forEach(section => {
                const top = section.offsetTop;
                const height = section.offsetHeight;
                const id = section.getAttribute('id');

                if (scrollPosition >= top && scrollPosition < top + height) {
                    navLinks.forEach(link => {
                        link.classList.toggle('active', link.getAttribute('href') === `#${id}`);
                    });
                }
            });
        }

        window.addEventListener('scroll', setActiveNav);
        window.addEventListener('load', setActiveNav);

        const spotlightCards = document.querySelectorAll('.spotlight-card');

        spotlightCards.forEach(card => {
            const spotlightColor = 'rgba(246, 207, 97, .16)';
            card.style.setProperty('--spotlight-color', spotlightColor);

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
