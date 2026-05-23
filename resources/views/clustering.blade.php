{{-- resources/views/portfolio/projects/clustering.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>South Korea Health Clustering — Zaky</title>

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
            --violet: #c4b5fd;
            --red: #fca5a5;
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
                linear-gradient(rgba(0, 0, 0, .50), rgba(0, 0, 0, .64)),
                url("{{ asset('images/background.webp') }}") center / cover fixed no-repeat;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(circle at 16% 18%, rgba(246, 207, 97, .18), transparent 28%),
                radial-gradient(circle at 82% 24%, rgba(147, 197, 253, .13), transparent 25%),
                radial-gradient(circle at 54% 88%, rgba(143, 214, 148, .12), transparent 31%);
        }

        .grain {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            opacity: .16;
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
            padding: 48px 72px;
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
            --spotlight-color: rgba(246, 207, 97, .16);
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
            min-height: 34px;
            padding: 0 13px;
            margin-bottom: 18px;
            border-radius: 999px;
            color: rgba(255, 255, 255, .88);
            background: rgba(255, 255, 255, .09);
            border: 1px solid rgba(255, 255, 255, .13);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .eyebrow::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 18px rgba(246, 207, 97, .68);
        }

        .hero-copy {
            max-width: 680px;
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
            max-width: 630px;
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

        .cluster-card {
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

        .cluster-map {
            position: relative;
            height: 250px;
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .10);
            background:
                linear-gradient(rgba(255, 255, 255, .05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, .05) 1px, transparent 1px),
                radial-gradient(circle at 22% 22%, rgba(147, 197, 253, .22), transparent 28%),
                radial-gradient(circle at 70% 28%, rgba(246, 207, 97, .22), transparent 28%),
                radial-gradient(circle at 48% 76%, rgba(143, 214, 148, .22), transparent 28%),
                rgba(255, 255, 255, .06);
            background-size: 34px 34px, 34px 34px, auto, auto, auto, auto;
        }

        .cluster-dot {
            position: absolute;
            width: 9px;
            height: 9px;
            border-radius: 999px;
            background: var(--dot-color);
            opacity: .92;
            box-shadow: 0 0 20px color-mix(in srgb, var(--dot-color) 55%, transparent);
            animation: floatDot 5s ease-in-out infinite alternate;
        }

        @keyframes floatDot {
            from {
                transform: translate3d(0, 0, 0);
            }

            to {
                transform: translate3d(5px, -7px, 0);
            }
        }

        .cluster-stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 14px;
        }

        .cluster-stat {
            border-radius: 18px;
            padding: 16px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .10);
        }

        .cluster-stat strong {
            display: block;
            margin-bottom: 7px;
            font-size: 21px;
            line-height: 1;
        }

        .cluster-stat span {
            color: rgba(255, 255, 255, .80);
            font-size: 12px;
            line-height: 1.45;
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
        .takeaway-card {
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

        .metric-card:hover,
        .step-card:hover,
        .takeaway-card:hover {
            border-color: rgba(255, 255, 255, .20);
            box-shadow: 0 24px 68px rgba(0, 0, 0, .26);
        }

        .metric-card {
            min-height: 172px;
            padding: 24px;
            border-radius: 30px;
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
            font-size: clamp(1.75rem, 3vw, 2.45rem);
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
            min-height: 248px;
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
            max-width: 300px;
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
            min-height: 626px;
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
            background: rgba(255, 255, 255, .92);
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
            z-index: 2000;
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

            .hero-grid {
                gap: 34px;
            }

            .hero-copy {
                max-width: 760px;
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
            .project-topbar {
                top: 16px;
                padding: 6px;
            }

            .home-button {
                height: 38px;
                padding: 0 17px;
                font-size: 13px;
            }

            .prev-arrow,
            .next-arrow {
                width: 38px;
                height: 38px;
                flex-basis: 38px;
            }

            .prev-arrow svg,
            .next-arrow svg {
                width: 19px;
                height: 19px;
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

            .cluster-stat-grid,
            .metrics-grid,
            .pipeline-grid {
                grid-template-columns: 1fr;
            }

            .cluster-map {
                height: 220px;
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

            .dynamic-background {
                opacity: .45;
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

        <a class="next-arrow" href="{{ url('/powerbi') }}" aria-label="Next project">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>

    <main>
        <section id="overview" class="hero">
            <div class="container hero-grid">
                <div class="hero-copy">
                    <h1>Clustering Health Burden in <span>South Korea</span>.</h1>

                    <p class="lead">
                        A K-Means clustering project that analyzes disease prevalence, mortality rate, healthcare
                        access, doctors availability, and hospital bed capacity in South Korea 2022. The workflow turns
                        complex health indicators into three interpretable clusters to highlight differences in health
                        burden and access to medical resources.
                    </p>

                    <div class="tag-row">
                        <span class="tag">R</span>
                        <span class="tag">K-Means</span>
                        <span class="tag">PCA</span>
                        <span class="tag">Elbow Method</span>
                        <span class="tag">Silhouette Score</span>
                        <span class="tag">Health Analytics</span>
                    </div>

                    <div class="hero-actions">
                        <a class="btn btn-primary" href="#visuals">View Cluster Visuals</a>
                        <a class="btn" href="#process">See Workflow</a>
                    </div>
                </div>

                <aside class="hero-panel" aria-label="Project clustering preview">
                    <div class="mock-window">
                        <div class="window-content">
                            <div class="cluster-card spotlight-card" data-spotlight-color="rgba(246, 207, 97, .16)">
                                <p class="mini-title">Three-Cluster Health Pattern</p>

                                <div class="cluster-map" aria-hidden="true">
                                    <span class="cluster-dot" style="--dot-color: #93c5fd; left: 15%; top: 36%;"></span>
                                    <span class="cluster-dot"
                                        style="--dot-color: #93c5fd; left: 21%; top: 48%; animation-delay: .3s;"></span>
                                    <span class="cluster-dot"
                                        style="--dot-color: #93c5fd; left: 28%; top: 55%; animation-delay: .7s;"></span>
                                    <span class="cluster-dot"
                                        style="--dot-color: #93c5fd; left: 33%; top: 42%; animation-delay: 1.1s;"></span>
                                    <span class="cluster-dot"
                                        style="--dot-color: #f6cf61; left: 62%; top: 26%; animation-delay: .2s;"></span>
                                    <span class="cluster-dot"
                                        style="--dot-color: #f6cf61; left: 70%; top: 32%; animation-delay: .8s;"></span>
                                    <span class="cluster-dot"
                                        style="--dot-color: #f6cf61; left: 78%; top: 23%; animation-delay: 1.3s;"></span>
                                    <span class="cluster-dot"
                                        style="--dot-color: #f6cf61; left: 67%; top: 43%; animation-delay: .5s;"></span>
                                    <span class="cluster-dot"
                                        style="--dot-color: #8fd694; left: 42%; top: 70%; animation-delay: .4s;"></span>
                                    <span class="cluster-dot"
                                        style="--dot-color: #8fd694; left: 52%; top: 74%; animation-delay: .9s;"></span>
                                    <span class="cluster-dot"
                                        style="--dot-color: #8fd694; left: 58%; top: 63%; animation-delay: 1.4s;"></span>
                                    <span class="cluster-dot"
                                        style="--dot-color: #8fd694; left: 47%; top: 58%; animation-delay: .6s;"></span>
                                </div>
                            </div>

                            <div class="cluster-stat-grid">
    <div class="cluster-stat spotlight-card"
        data-spotlight-color="rgba(246, 207, 97, .14)">
        <strong>3</strong>
        <span>groups formed from similar burden and healthcare access patterns.</span>
    </div>

    <div class="cluster-stat spotlight-card"
        data-spotlight-color="rgba(143, 214, 148, .14)">
        <strong>PCA</strong>
        <span>Reduced indicators into a clearer two-dimensional visualization space.</span>
    </div>

    <div class="cluster-stat spotlight-card"
        data-spotlight-color="rgba(147, 197, 253, .14)">
        <strong>K-Means</strong>
        <span>Used to group records based on normalized health-related indicators.</span>
    </div>
</div>
                        </div>
                    </div>

                    <div class="floating-resource-stack" aria-label="Project resources">
                        <a class="floating-resource-btn" href="LINK_GITHUB_KAMU" target="_blank" rel="noopener"
                            aria-label="Open GitHub repository">
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M12 .5A12 12 0 0 0 8.2 23.9c.6.1.8-.2.8-.6v-2.1c-3.3.7-4-1.4-4-1.4-.5-1.3-1.2-1.7-1.2-1.7-1-.7.1-.7.1-.7 1.1.1 1.7 1.2 1.7 1.2 1 .1.6 2.8 3.4 2 .1-.7.4-1.2.7-1.5-2.6-.3-5.4-1.3-5.4-5.9 0-1.3.5-2.4 1.2-3.2-.1-.3-.5-1.6.1-3.2 0 0 1-.3 3.3 1.2a11.4 11.4 0 0 1 6 0c2.3-1.5 3.3-1.2 3.3-1.2.6 1.6.2 2.9.1 3.2.8.8 1.2 1.9 1.2 3.2 0 4.6-2.8 5.6-5.4 5.9.4.4.8 1.1.8 2.2v3.2c0 .4.2.7.8.6A12 12 0 0 0 12 .5Z" />
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
                    <h2>What this project is about.</h2>
                    <p>
                        The analysis focuses on grouping health conditions by similarity, so disease burden and medical
                        access patterns can be read faster than looking at raw indicators one by one.
                    </p>
                </div>

                <div class="metrics-grid">
                    <article class="metric-card spotlight-card" data-spotlight-color="rgba(246, 207, 97, .16)">
                        <span>Dataset</span>
                        <strong>South Korea</strong>
                        <p>Filtered Global Health Statistics data for South Korea in 2022.</p>
                    </article>

                    <article class="metric-card spotlight-card" data-spotlight-color="rgba(147, 197, 253, .16)">
                        <span>Focus</span>
                        <strong>Health Access</strong>
                        <p>Uses prevalence, mortality, healthcare access, doctors, and hospital beds indicators.</p>
                    </article>

                    <article class="metric-card spotlight-card" data-spotlight-color="rgba(143, 214, 148, .16)">
                        <span>Method</span>
                        <strong>K-Means</strong>
                        <p>Groups data points after scaling and dimensionality reduction with PCA.</p>
                    </article>

                    <article class="metric-card spotlight-card" data-spotlight-color="rgba(255, 255, 255, .14)">
                        <span>Result</span>
                        <strong>3 Clusters</strong>
                        <p>Chosen as the most balanced cluster structure using Elbow and Silhouette validation.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="process">
            <div class="container">
                <div class="section-heading">
                    <h2>How the health data was analyzed.</h2>
                    <p>
                        The workflow is designed to keep the clustering result explainable: start from focused data
                        selection, make the scale fair, reduce dimensions, compare cluster options, then interpret the
                        selected cluster profile.
                    </p>
                </div>

                <div class="pipeline-grid">
                    <article class="step-card spotlight-card" data-step="01">
                        <h3>Dataset Filtering</h3>
                        <p>
                            Selected South Korea records from 2022 and kept only variables related to disease burden and
                            healthcare service availability.
                        </p>
                        <div class="tag-row">
                            <span class="tag">Country Filter</span>
                            <span class="tag">2022</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="02">
                        <h3>Preparation & Encoding</h3>
                        <p>
                            Checked data structure, converted categorical values into numeric format, and prepared all
                            selected columns for statistical processing.
                        </p>
                        <div class="tag-row">
                            <span class="tag">Encoding</span>
                            <span class="tag">R</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="03">
                        <h3>Outlier Cleaning</h3>
                        <p>
                            Used the IQR approach to reduce the effect of extreme values, so the clustering process is
                            not dominated by unusual records.
                        </p>
                        <div class="tag-row">
                            <span class="tag">IQR</span>
                            <span class="tag">Cleaning</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="04">
                        <h3>Min-Max Scaling</h3>
                        <p>
                            Normalized numeric indicators into the same 0 to 1 range, making prevalence, mortality, and
                            health facility metrics comparable.
                        </p>
                        <div class="tag-row">
                            <span class="tag">Scaling</span>
                            <span class="tag">0–1 Range</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="05">
                        <h3>PCA Reduction</h3>
                        <p>
                            Reduced the dataset into two principal components to simplify visualization while retaining
                            meaningful variation from the original indicators.
                        </p>
                        <div class="tag-row">
                            <span class="tag">PCA</span>
                            <span class="tag">PC1 & PC2</span>
                        </div>
                    </article>

                    <article class="step-card spotlight-card" data-step="06">
                        <h3>Cluster Validation</h3>
                        <p>
                            Compared K-Means with 3, 4, and 5 clusters, then selected three clusters based on Elbow and
                            Silhouette Score interpretation.
                        </p>
                        <div class="tag-row">
                            <span class="tag">Elbow</span>
                            <span class="tag">Silhouette</span>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section id="visuals">
            <div class="container">
                <div class="section-heading">
                    <h2>Clustering visuals and interpretation.</h2>
                    <p>
                        These visuals show the important checkpoints: dataset preparation, PCA result, cluster
                        comparison, validation method, and the final cluster profile.
                    </p>
                </div>

                <div class="gallery-layout">
                    <div class="gallery-tabs" role="tablist" aria-label="Clustering visuals">
                        <button class="tab-button active" type="button" data-title="K-Means with 3 Clusters"
                            data-desc="The selected clustering structure. Three clusters provide the clearest balance between separation and interpretability for the PCA-reduced health data."
                            data-img="{{ asset('images/projects/clustering/kmeans-3-clusters.webp') }}">
                            <strong>3-Cluster Result</strong>
                            <span>Final cluster option used for interpretation.</span>
                        </button>

                        <button class="tab-button" type="button" data-title="Elbow Method"
                            data-desc="The WCSS curve drops sharply until around k=3, then becomes flatter. This supports three clusters as a balanced choice."
                            data-img="{{ asset('images/projects/clustering/elbow-method.webp') }}">
                            <strong>Elbow Method</strong>
                            <span>Checks the cluster count from WCSS reduction.</span>
                        </button>

                        <button class="tab-button" type="button" data-title="Silhouette Score"
                            data-desc="The highest average Silhouette pattern appears at k=3, showing that this cluster count gives the strongest separation compared with other tested options."
                            data-img="{{ asset('images/projects/clustering/silhouette-score.webp') }}">
                            <strong>Silhouette Score</strong>
                            <span>Validates how well-separated the clusters are.</span>
                        </button>

                        <button class="tab-button" type="button" data-title="PCA Summary"
                            data-desc="PCA reduces the health indicators into PC1 and PC2, making the clustering result easier to visualize and compare."
                            data-img="{{ asset('images/projects/clustering/pca-result.webp') }}">
                            <strong>PCA Result</strong>
                            <span>Shows the reduced feature space used for clustering.</span>
                        </button>

                        <button class="tab-button" type="button" data-title="Cluster Mean Profile"
                            data-desc="The average PC values help explain how each cluster differs in disease burden and healthcare service capacity."
                            data-img="{{ asset('images/projects/clustering/cluster-mean.webp') }}">
                            <strong>Cluster Mean</strong>
                            <span>Summarizes the center tendency of each cluster.</span>
                        </button>

                        <button class="tab-button" type="button" data-title="Healthcare Access Distribution"
                            data-desc="Before modeling, distribution plots are used to understand the spread of each selected health indicator."
                            data-img="{{ asset('images/projects/clustering/distribution-healthcare-access.webp') }}">
                            <strong>Data Distribution</strong>
                            <span>Explores selected indicator spread before clustering.</span>
                        </button>
                    </div>

                    <article class="visual-card spotlight-card" data-spotlight-color="rgba(246, 207, 97, .12)">
                        <div class="visual-frame">
                            <img id="visualImage"
                                src="{{ asset('images/projects/clustering/kmeans-3-clusters.webp') }}"
                                alt="K-Means with 3 clusters visual">
                        </div>

                        <div class="visual-caption">
                            <div>
                                <h3 id="visualTitle">K-Means with 3 Clusters</h3>
                                <p id="visualDesc">
                                    The selected clustering structure. Three clusters provide the clearest balance
                                    between
                                    separation and interpretability for the PCA-reduced health data.
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
                    <p>
                        The final output is not just a cluster plot, but a clearer way to read which health groups may
                        require different resource planning or policy attention.
                    </p>
                </div>

                <div class="takeaway-grid">
                    <article class="takeaway-card spotlight-card" data-spotlight-color="rgba(246, 207, 97, .15)">
                        <h3>Analytical Value</h3>
                        <p>
                            Three clusters help separate health conditions into groups with different burden and access
                            patterns. This makes it easier to identify where medical resource distribution may need more
                            attention instead of treating all records as one general population.
                        </p>
                    </article>

                    <article class="takeaway-card spotlight-card" data-spotlight-color="rgba(143, 214, 148, .15)">
                        <h3>Technical Strength</h3>
                        <ul>
                            <li>Built an end-to-end clustering workflow using R, from filtering to interpretation.</li>
                            <li>Applied Min-Max scaling and PCA so K-Means can work on comparable, lower-dimensional
                                data.</li>
                            <li>Validated the number of clusters using Elbow Method and Silhouette Score before
                                explaining the result.</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <div class="image-modal" id="imageModal" aria-hidden="true">
        <div class="modal-inner">
            <button class="modal-close" type="button" id="closeModal" aria-label="Close image preview">×</button>
            <img id="modalImage" src="{{ asset('images/projects/clustering/kmeans-3-clusters.webp') }}"
                alt="Expanded clustering visual">
        </div>
    </div>

    <script>
        const spotlightCards = document.querySelectorAll('.spotlight-card');

        spotlightCards.forEach(card => {
            spotlightCards.forEach(card => {
                const spotlightColor = card.dataset.spotlightColor || 'rgba(246, 207, 97, .16)';
                card.style.setProperty('--spotlight-color', spotlightColor);

                card.addEventListener('mousemove', event => {
                    const rect = card.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;

                    card.style.setProperty('--mouse-x', `${x}px`);
                    card.style.setProperty('--mouse-y', `${y}px`);
                });
            });
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

    <script>
        const backgroundCanvas = document.getElementById('backgroundCanvas');
        const backgroundCtx = backgroundCanvas.getContext('2d');

        let backgroundParticles = [];
        let backgroundMouse = {
            x: null,
            y: null
        };

        const backgroundSettings = {
            count: window.innerWidth < 720 ? 70 : 145,
            color: '255, 255, 255',
            speed: 0.32,
            baseSize: 2.4,
            hoverDistance: 250,
            hoverForce: 1.8
        };

        function resizeBackgroundCanvas() {
            backgroundCanvas.width = window.innerWidth;
            backgroundCanvas.height = window.innerHeight;
            backgroundSettings.count = window.innerWidth < 720 ? 70 : 145;
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
                    alpha: Math.random() * 0.35 + 0.18
                });
            }
        }

        function drawBackgroundParticles() {
            backgroundCtx.clearRect(0, 0, backgroundCanvas.width, backgroundCanvas.height);

            backgroundParticles.forEach(particle => {
                const dx = backgroundMouse.x - particle.x;
                const dy = backgroundMouse.y - particle.y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (backgroundMouse.x !== null && distance < backgroundSettings.hoverDistance) {
                    const force = (backgroundSettings.hoverDistance - distance) / backgroundSettings.hoverDistance;

                    if (distance > 0) {
                        particle.x -= (dx / distance) * force * backgroundSettings.hoverForce;
                        particle.y -= (dy / distance) * force * backgroundSettings.hoverForce;
                    }
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
    </script>
</body>

</html>
