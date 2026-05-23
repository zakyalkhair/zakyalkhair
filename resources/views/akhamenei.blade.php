{{-- resources/views/portfolio/projects/khamenei.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Sentiment Analysis — Zaky</title>

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
            --glass-strong: rgba(20, 28, 38, .78);
            --line: rgba(255, 255, 255, .16);
            --accent: #f6cf61;
            --accent-soft: rgba(246, 207, 97, .18);
            --green: #8fd694;
            --blue: #93c5fd;
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
                linear-gradient(rgba(0, 0, 0, .52), rgba(0, 0, 0, .66)),
                url("{{ asset('images/background.webp') }}") center / cover fixed no-repeat;
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

        .prev-arrow:hover {
            transform: translateX(-2px);
        }

        .home-button:hover {
            transform: translateY(-2px);
        }

        .next-arrow:hover {
            transform: translateX(2px);
        }

        .home-button:active,
        .prev-arrow:active,
        .next-arrow:active {
            transform: scale(.96);
        }

        section {
            width: 100%;
            padding: 74px 72px;
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
            --spotlight-color: rgba(246, 207, 97, .13);
        }

        .spotlight-card::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(circle 520px at var(--mouse-x) var(--mouse-y),
                    var(--spotlight-color),
                    rgba(246, 207, 97, .04) 38%,
                    transparent 78%);
            opacity: 0;
            pointer-events: none;
            transition: opacity .38s ease;
        }

        .spotlight-card:hover::before,
        .spotlight-card:focus-within::before {
            opacity: 1;
        }

        .spotlight-card > * {
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
            margin-bottom: 18px;
            color: var(--accent);
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        h1 {
            max-width: 720px;
            font-size: clamp(3rem, 4.3vw, 3.2rem);
            line-height: .98;
            letter-spacing: -.055em;
        }

        h1 span {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            letter-spacing: -.045em;
            color: var(--accent);
        }

        .lead {
            max-width: 640px;
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

        .btn-primary {
            color: #1b2a34;
            background: var(--accent);
            border-color: transparent;
        }

        .hero-panel {
            position: relative;
            min-height: 500px;
            border-radius: 40px;
            padding: 18px;
            border: 1px solid rgba(255, 255, 255, .18);
            background: linear-gradient(150deg, rgba(255, 255, 255, .18), rgba(255, 255, 255, .06));
            box-shadow: 0 26px 80px rgba(0, 0, 0, .35);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .mock-window {
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

        .news-preview {
            display: grid;
            gap: 14px;
        }

        .preview-header,
        .sentiment-card,
        .keyword-card {
            border-radius: 24px;
            padding: 20px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .10);
        }

        .preview-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .preview-header p,
        .sentiment-card span,
        .keyword-card span {
            color: rgba(255, 255, 255, .68);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .preview-header strong {
            display: block;
            max-width: 310px;
            margin-top: 8px;
            font-size: 22px;
            line-height: 1.15;
        }

        .score-pill {
            width: 64px;
            height: 64px;
            flex: 0 0 64px;
            border-radius: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #1b2a34;
            background: var(--accent);
            font-size: 24px;
            font-weight: 900;
        }

        .sentiment-bars {
            margin-top: 18px;
            display: grid;
            gap: 14px;
        }

        .bar-row {
            display: grid;
            grid-template-columns: 92px 1fr 42px;
            gap: 12px;
            align-items: center;
            color: rgba(255, 255, 255, .92);
            font-size: 13px;
            font-weight: 700;
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

        .keyword-list {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 14px;
        }

        .keyword-list small {
            padding: 8px 11px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .10);
            color: rgba(255, 255, 255, .88);
            font-size: 12px;
            font-weight: 800;
        }

        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 30px;
        }

        .section-heading h2 {
            max-width: 740px;
            font-size: clamp(2.3rem, 4vw, 4rem);
            line-height: 1;
            letter-spacing: -.045em;
        }

        .section-heading p {
            max-width: 440px;
            color: rgba(255, 255, 255, .86);
            line-height: 1.7;
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
            transition: border-color .22s ease, box-shadow .22s ease, background .22s ease;
        }

        .metric-card:hover,
        .step-card:hover,
        .takeaway-card:hover,
        .visual-card:hover {
            border-color: rgba(255, 255, 255, .22);
            box-shadow: 0 24px 68px rgba(0, 0, 0, .26);
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
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
            transition: transform .22s ease, background .22s ease, color .22s ease, border-color .22s ease, box-shadow .22s ease;
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
            transition: opacity .22s ease, transform .22s ease;
        }

        .tab-button:hover,
        .tab-button.active {
            transform: translateY(-3px);
            color: var(--white);
            border-color: rgba(246, 207, 97, .36);
            box-shadow: 0 16px 36px rgba(0, 0, 0, .22);
        }

        .tab-button.active {
            background: linear-gradient(135deg, rgba(246, 207, 97, .18), rgba(255, 255, 255, .10));
        }

        .tab-button.active::before {
            opacity: 1;
            transform: scaleY(1);
        }

        .tab-button strong {
            position: relative;
            z-index: 1;
            display: block;
            margin-bottom: 6px;
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
            transition: transform .22s ease, filter .22s ease;
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
            transition: transform .22s ease, background .22s ease, box-shadow .22s ease;
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
            }

            .home-button,
            .prev-arrow,
            .next-arrow {
                height: 38px;
            }

            .home-button {
                padding: 0 18px;
                font-size: 13px;
            }

            .prev-arrow,
            .next-arrow {
                width: 38px;
                flex-basis: 38px;
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

            .bar-row {
                grid-template-columns: 84px 1fr 36px;
                font-size: 12px;
            }

            .metrics-grid,
            .pipeline-grid {
                grid-template-columns: 1fr;
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
    </style>
</head>

<body>
    <div class="grain" aria-hidden="true"></div>

    <div class="dynamic-background" aria-hidden="true">
        <canvas id="backgroundCanvas"></canvas>
    </div>

    <nav class="project-topbar" aria-label="Project navigation">
        <a class="prev-arrow" href="{{ url('powerbi') }}" aria-label="Previous project">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M15 5l-7 7 7 7" />
            </svg>
        </a>

        <a class="home-button" href="{{ url('/') }}#projects" aria-label="Back to portfolio">
            Home
        </a>

        <a class="next-arrow" href="" aria-label="Next project">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </nav>

    <main>
        <section id="overview" class="hero">
            <div class="container hero-grid">
                <div class="hero-copy">
                    <h1>Sentiment Analysis of <span>Indonesian News</span>.</h1>

                    <p class="lead">
                        A text analytics project that analyzes Indonesian online news responses related to Ali
                        Khamenei’s reported death issue. The project focuses on collecting article-based text data,
                        cleaning Indonesian language content, extracting meaningful terms, and classifying sentiment
                        patterns to understand how media narratives are formed.
                    </p>

                    <div class="tag-row">
                        <span class="tag">Python</span>
                        <span class="tag">NLP</span>
                        <span class="tag">Indonesian Text</span>
                        <span class="tag">Text Preprocessing</span>
                        <span class="tag">TF-IDF</span>
                        <span class="tag">Sentiment Analysis</span>
                    </div>

                    <div class="hero-actions">
                        <a class="btn btn-primary" href="#visuals">View Analysis Visuals</a>
                        <a class="btn" href="#process">See Workflow</a>
                    </div>
                </div>

                <aside class="hero-panel spotlight-card" aria-label="News sentiment analysis preview">
                    <div class="mock-window">
                        <div class="window-bar">
                            <div class="window-dots" aria-hidden="true">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </div>
                            <span class="window-label">News Sentiment Lab</span>
                        </div>

                        <div class="window-content">
                            <div class="news-preview">
                                <div class="preview-header spotlight-card">
                                    <div>
                                        <p>Analysis Scope</p>
                                        <strong>Indonesian media sentiment and narrative pattern review</strong>
                                    </div>
                                    <div class="score-pill">NLP</div>
                                </div>

                                <div class="sentiment-card spotlight-card">
                                    <span>Sentiment Distribution Preview</span>

                                    <div class="sentiment-bars">
                                        <div class="bar-row">
                                            <span>Neutral</span>
                                            <div class="bar-track">
                                                <div class="bar-fill" style="width: 72%"></div>
                                            </div>
                                            <strong>72</strong>
                                        </div>

                                        <div class="bar-row">
                                            <span>Negative</span>
                                            <div class="bar-track">
                                                <div class="bar-fill" style="width: 54%"></div>
                                            </div>
                                            <strong>54</strong>
                                        </div>

                                        <div class="bar-row">
                                            <span>Positive</span>
                                            <div class="bar-track">
                                                <div class="bar-fill" style="width: 38%"></div>
                                            </div>
                                            <strong>38</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="keyword-card spotlight-card">
                                    <span>Dominant News Terms</span>

                                    <div class="keyword-list">
                                        <small>iran</small>
                                        <small>khamenei</small>
                                        <small>konflik</small>
                                        <small>timur tengah</small>
                                        <small>politik</small>
                                        <small>media</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </section>

        <section aria-label="Project summary">
            <div class="container">
                <div class="section-heading">
                    <h2>Turning news text into readable insight.</h2>
                    <p>
                        This project transforms unstructured news text into structured sentiment patterns, helping show
                        how Indonesian media frames a sensitive international political issue.
                    </p>
                </div>

                <div class="metrics-grid">
                    <article class="metric-card spotlight-card">
                        <span>Data Source</span>
                        <strong>News</strong>
                        <p>Article text from Indonesian online media sources.</p>
                    </article>

                    <article class="metric-card spotlight-card">
                        <span>Task</span>
                        <strong>NLP</strong>
                        <p>Cleaning, processing, and representing Indonesian text data.</p>
                    </article>

                    <article class="metric-card spotlight-card">
                        <span>Method</span>
                        <strong>TF-IDF</strong>
                        <p>Extracts important terms from article content for analysis.</p>
                    </article>

                    <article class="metric-card spotlight-card">
                        <span>Output</span>
                        <strong>Insight</strong>
                        <p>Sentiment distribution, keyword patterns, and narrative interpretation.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="process">
            <div class="container">
                <div class="section-heading">
                    <h2>Designed as a clear analysis workflow.</h2>
                    <p>
                        The process is structured so the project feels easy to follow, from raw article collection to
                        visual interpretation.
                    </p>
                </div>

                <div class="pipeline-grid">
                    <article class="step-card spotlight-card" data-step="01">
                        <h3>Article Collection</h3>
                        <p>
                            Gathered article-based text data from Indonesian news sources and organized it into a clean
                            dataset for analysis.
                        </p>
                    </article>

                    <article class="step-card spotlight-card" data-step="02">
                        <h3>Text Cleaning</h3>
                        <p>
                            Removed noise, symbols, duplicated content, and irrelevant characters to make the text
                            consistent.
                        </p>
                    </article>

                    <article class="step-card spotlight-card" data-step="03">
                        <h3>Preprocessing</h3>
                        <p>
                            Applied case folding, tokenization, stopword handling, and Indonesian text normalization.
                        </p>
                    </article>

                    <article class="step-card spotlight-card" data-step="04">
                        <h3>Feature Extraction</h3>
                        <p>
                            Converted text into weighted numerical representation using TF-IDF to identify important
                            terms.
                        </p>
                    </article>

                    <article class="step-card spotlight-card" data-step="05">
                        <h3>Sentiment Mapping</h3>
                        <p>
                            Categorized article tone into sentiment groups and compared how narratives differ across
                            texts.
                        </p>
                    </article>

                    <article class="step-card spotlight-card" data-step="06">
                        <h3>Visual Interpretation</h3>
                        <p>
                            Summarized findings through distribution charts, word cloud, and keyword-based explanation.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <section id="visuals">
            <div class="container">
                <div class="section-heading">
                    <h2>Visual evidence from the analysis.</h2>
                    <p>
                        Each visual helps explain one part of the analysis: sentiment pattern, word importance, keyword
                        dominance, and final interpretation.
                    </p>
                </div>

                <div class="gallery-layout">
                    <div class="gallery-tabs" role="tablist" aria-label="Analysis visuals">
                        <button class="tab-button active" type="button"
                            data-title="Sentiment Distribution"
                            data-desc="Shows the overall sentiment composition found in the collected Indonesian news articles."
                            data-img="{{ asset('images/projects/khamenei/sentiment-distribution.png') }}">
                            <strong>Sentiment Distribution</strong>
                            <span>Overview of positive, neutral, and negative article tone.</span>
                        </button>

                        <button class="tab-button" type="button"
                            data-title="Top TF-IDF Terms"
                            data-desc="Highlights the most important words detected after TF-IDF feature extraction."
                            data-img="{{ asset('images/projects/khamenei/top-tfidf.png') }}">
                            <strong>Top TF-IDF Terms</strong>
                            <span>Important weighted terms from the article corpus.</span>
                        </button>

                        <button class="tab-button" type="button"
                            data-title="Word Cloud"
                            data-desc="Provides a readable overview of terms that frequently appear across news content."
                            data-img="{{ asset('images/projects/khamenei/wordcloud.png') }}">
                            <strong>Word Cloud</strong>
                            <span>Dominant vocabulary from Indonesian media coverage.</span>
                        </button>

                        <button class="tab-button" type="button"
                            data-title="Keyword Frequency"
                            data-desc="Shows repeated keywords and how often they appear in the analyzed news text."
                            data-img="{{ asset('images/projects/khamenei/keyword-frequency.png') }}">
                            <strong>Keyword Frequency</strong>
                            <span>Repeated terms that shape the media narrative.</span>
                        </button>
                    </div>

                    <article class="visual-card spotlight-card">
                        <div class="visual-frame">
                            <img id="visualImage"
                                src="{{ asset('images/projects/khamenei/sentiment-distribution.png') }}"
                                alt="Sentiment Distribution visual">
                        </div>

                        <div class="visual-caption">
                            <div>
                                <h3 id="visualTitle">Sentiment Distribution</h3>
                                <p id="visualDesc">
                                    Shows the overall sentiment composition found in the collected Indonesian news
                                    articles.
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
                        This project shows technical NLP execution while still keeping the analysis readable for a
                        non-technical audience.
                    </p>
                </div>

                <div class="takeaway-grid">
                    <article class="takeaway-card spotlight-card">
                        <h3>Analytical Value</h3>
                        <p>
                            The project helps identify how Indonesian news media frames an international political issue
                            through repeated terms, sentiment composition, and dominant article tone.
                        </p>
                    </article>

                    <article class="takeaway-card spotlight-card">
                        <h3>Technical Strength</h3>
                        <ul>
                            <li>Processed Indonesian-language news text into a clean analysis-ready dataset.</li>
                            <li>Used text preprocessing and TF-IDF to extract meaningful language patterns.</li>
                            <li>Translated numerical text outputs into visual and narrative insights.</li>
                            <li>Designed the final page as a portfolio case study, not just a notebook result.</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <div class="image-modal" id="imageModal" aria-hidden="true">
        <div class="modal-inner">
            <button class="modal-close" type="button" id="closeModal" aria-label="Close image preview">×</button>
            <img id="modalImage"
                src="{{ asset('images/projects/khamenei/sentiment-distribution.png') }}"
                alt="Expanded analysis visual">
        </div>
    </div>

    <script>
        const backgroundCanvas = document.getElementById('backgroundCanvas');
        const backgroundCtx = backgroundCanvas.getContext('2d');

        let backgroundParticles = [];
        let backgroundMouse = { x: null, y: null };

        const backgroundSettings = {
            count: 150,
            color: '255, 255, 255',
            speed: 0.42,
            baseSize: 2.6,
            hoverDistance: 280,
            hoverForce: 2.2
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
                    alpha: Math.random() * 0.42 + 0.22
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