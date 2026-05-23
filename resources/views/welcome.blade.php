{{-- resources/views/portfolio/about.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaky</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=DM+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        /* =========================
           BASE
        ========================= */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --navy: #1b3a5c;
            --white: #ffffff;
            --text: #2c3e50;
            --text-muted: #5a6a7a;
            --dark-glass: rgba(20, 28, 38, 0.62);
            --dark-glass-2: rgba(20, 28, 38, 0.72);
            --soft-glass: rgba(232, 237, 244, 0.85);
            --gold: #e4d994;
            --section-x: clamp(28px, 5vw, 72px);
            --nav-height-offset: 108px;
        }

        html {
            min-height: 100%;
            scroll-behavior: smooth;
            scroll-padding-top: var(--nav-height-offset);
            overflow-x: hidden;
            font-family: 'DM Sans', sans-serif;
        }

        body {
            position: relative;
            min-height: 100%;
            overflow-x: hidden;
            background: url("{{ asset('images/background.webp') }}") center/cover no-repeat fixed;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: -1;
            background: rgba(0, 0, 0, 0.4);
        }

        section {
            position: relative;
            z-index: 2;
            width: 100%;
        }

        img {
            max-width: 100%;
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }

        .section-title {
            color: var(--white);
            font-size: clamp(2.35rem, 4vw, 3.5rem);
            line-height: 1.08;
            text-align: center;
        }

        /* =========================
           PARTICLES BACKGROUND
        ========================= */
        .particles-container {
            position: fixed;
            inset: 0;
            z-index: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        #particlesCanvas {
            display: block;
            width: 100%;
            height: 100%;
        }

        /* =========================
           NAVIGATION
        ========================= */
        nav {
            position: fixed;
            top: 22px;
            left: 50%;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: clamp(24px, 3vw, 48px);
            width: fit-content;
            max-width: calc(100% - 32px);
            padding: 18px 46px;
            border-radius: 999px;
            background: var(--soft-glass);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
            transform: translateX(-50%);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        nav a {
            flex: 0 0 auto;
            color: var(--text-muted);
            font-size: clamp(15px, 1.2vw, 18px);
            font-weight: 600;
            letter-spacing: 0.01em;
            text-decoration: none;
            transition: color 0.2s ease, font-weight 0.2s ease;
        }

        nav a:hover,
        nav a.active {
            color: var(--navy);
            font-weight: 700;
        }

        /* =========================
           HERO
        ========================= */
        .hero-section {
            display: grid;
            grid-template-columns: minmax(0, 0.95fr) minmax(0, 1.05fr);
            align-items: center;
            justify-items: center;
            min-height: 100svh;
            padding: 105px var(--section-x) 45px;
            column-gap: clamp(10px, 3vw, 44px);
        }

        .card-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: min(560px, 42vw);
            min-width: 440px;
            aspect-ratio: 56 / 55;
            animation: fadeUp 0.7s ease both;
        }

        .card-bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            pointer-events: none;
            user-select: none;
        }

        .card-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            padding: clamp(24px, 3vw, 32px);
            text-align: center;
        }

        .card-name {
            margin-bottom: 14px;
            padding-left: 22px;
            color: var(--navy);
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.05rem, 2.5vw, 2.65rem);
            font-style: italic;
            line-height: 1.12;
        }

        .card-bio {
            max-width: 360px;
            margin-bottom: 20px;
            padding-left: 10px;
            color: var(--text);
            font-size: clamp(14px, 1.05vw, 15.5px);
            font-weight: 300;
            line-height: 1.58;
        }

        .card-bio strong {
            font-weight: 600;
        }

        .socials {
            display: flex;
            justify-content: center;
            gap: 24px;
        }

        .socials a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 10px;
            text-decoration: none;
            transition: transform 0.2s ease;
        }

        .socials a:hover {
            transform: translateY(-3px);
        }

        .socials img {
            width: 46px;
            height: 46px;
            object-fit: contain;
        }

        /* =========================
           PHOTO COLLAGE
        ========================= */
        .photo-collage {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: min(480px, 39vw);
            min-width: 380px;
            aspect-ratio: 8 / 9;
            animation: fadeUp 0.7s 0.15s ease both;
        }

        .polaroid {
            position: absolute;
            overflow: hidden;
            border-radius: 8px;
            background: var(--white);
            box-shadow: 0 12px 40px rgba(27, 58, 92, 0.22);
            transition: transform 0.35s ease;
        }

        .polaroid img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .polaroid-1 {
            z-index: 1;
            width: 75%;
            height: 79.6%;
            padding: 16px 16px 48px;
            transform: rotate(-5deg) translate(-29%, -16%);
        }

        .polaroid-2 {
            z-index: 2;
            width: 75%;
            height: 81.5%;
            padding: 16px 16px 48px;
            transform: rotate(4deg) translate(27%, 9%);
        }

        .polaroid-1:hover {
            transform: rotate(-5deg) translate(-37%, -16%);
        }

        .polaroid-2:hover {
            transform: rotate(4deg) translate(35%, 9%);
        }

        /* =========================
           PROJECTS
        ========================= */
        .projects-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 80svh;
            padding: 40px var(--section-x) 20px;
        }

        .projects-header {
            margin-bottom: 265px;
            text-align: center;
        }

        .projects-folder-wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .projects-folder {
            position: relative;
            top: -105px;
            width: 420px;
            height: 320px;
        }

        .folder-shell {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.45s ease, transform 0.45s ease;
        }

        .folder-shell img {
            width: 650px;
            max-width: none;
            height: auto;
            object-fit: contain;
        }

        .projects-folder:hover .folder-shell,
        .projects-folder.mobile-open .folder-shell {
            opacity: 0;
            transform: scale(0.85);
        }

        .project-card {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 560px;
            aspect-ratio: 16 / 9;
            overflow: hidden;
            border-radius: 24px;
            opacity: 0;
            pointer-events: none;
            transform: translate(-50%, -50%) scale(0.7);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            transition:
                transform 0.5s cubic-bezier(0.2, 0.8, 0.2, 1),
                opacity 0.4s ease,
                box-shadow 0.25s ease;
        }

        .project-card a {
            position: relative;
            display: block;
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: inherit;
            color: var(--white);
            text-decoration: none;
            transition: transform 0.14s ease;
        }

        .project-card a::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 1;
            background: rgba(0, 0, 0, 0);
            pointer-events: none;
            transition: background 0.25s ease;
        }

        .project-card:hover {
            box-shadow: 0 18px 55px rgba(0, 0, 0, 0.38);
        }

        .project-card:hover a::after {
            background: rgba(0, 0, 0, 0.28);
        }

        .project-card:active a {
            transform: scale(0.965);
        }

        .project-card:active a::after {
            background: rgba(0, 0, 0, 0.42);
        }

        .project-image,
        .project-image img,
        .project-content {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .project-image img {
            display: block;
            object-fit: cover;
        }

        .project-content {
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            text-align: center;
        }

        .project-content h3 {
            max-width: 75%;
            margin: 0;
            padding: 12px 18px;
            border-radius: 12px;
            background: var(--dark-glass);
            box-shadow: 0 12px 34px rgba(0, 0, 0, 0.26);
            color: var(--white);
            font-size: 16px;
            font-weight: 500;
            line-height: 1.25;
            text-shadow: 0 3px 14px rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .projects-folder:hover .project-card,
        .projects-folder.mobile-open .project-card {
            opacity: 1;
            pointer-events: auto;
        }

        .projects-folder:hover .project-card-1,
        .projects-folder.mobile-open .project-card-1 {
            transform: translate(-800px, -320px) rotate(-17deg);
        }

        .projects-folder:hover .project-card-2,
        .projects-folder.mobile-open .project-card-2 {
            transform: translate(-700px, -20px) rotate(-8deg);
        }

        .projects-folder:hover .project-card-3,
        .projects-folder.mobile-open .project-card-3 {
            transform: translate(-300px, -220px);
        }

        .projects-folder:hover .project-card-4,
        .projects-folder.mobile-open .project-card-4 {
            transform: translate(80px, -25px) rotate(8deg);
        }

        .projects-folder:hover .project-card-5,
        .projects-folder.mobile-open .project-card-5 {
            transform: translate(240px, -330px) rotate(16deg);
        }

        /* =========================
           SKILLS
        ========================= */
        .skills-section {
            min-height: 60svh;
            padding: 40px var(--section-x);
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
        }

        .skills-header {
            max-width: 790px;
            margin: 0 auto 22px;
            text-align: center;
        }

        .section-kicker {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            padding: 8px 15px;
            border-radius: 999px;
            color: rgba(255, 255, 255, 0.9);
            background: rgba(255, 255, 255, 0.11);
            border: 1px solid rgba(255, 255, 255, 0.14);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        .skills-header p {
            max-width: 730px;
            margin: 18px auto 0;
            color: rgba(255, 255, 255, 0.82);
            font-size: clamp(14px, 1.25vw, 17px);
            line-height: 1.75;
        }

        .skills-marquee-shell {
            position: relative;
            width: min(1220px, 100%);
            height: 160px;
            margin: 0 auto;
            display: grid;
            gap: 18px;
            background: transparent;
            border: 0;
            box-shadow: none;
        }

        .skills-marquee-shell::before {
            display: none;
        }

        .skills-marquee {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding-block: 10px;
            margin-block: -10px;
            border-radius: 999px;

            mask-image: linear-gradient(90deg,
                    transparent 0%,
                    #000 9%,
                    #000 91%,
                    transparent 100%);
            -webkit-mask-image: linear-gradient(90deg,
                    transparent 0%,
                    #000 9%,
                    #000 91%,
                    transparent 100%);
        }

        .skills-track {
            display: flex;
            align-items: center;
            width: max-content;
            gap: 14px;
            padding-block: 10px;
            animation: skillMarqueeLeft 34s linear infinite;
            will-change: transform;
        }

        .skills-marquee.reverse .skills-track {
            animation-name: skillMarqueeRight;
            animation-duration: 38s;
        }


        .skill-pill {
            flex: 0 0 auto;
    min-width: 156px;
    height: 58px;
    padding: 0 22px;
    border-radius: 999px;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 11px;

    color: rgba(255, 255, 255, 0.92);
    background: var(--dark-glass);
    border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: none;

            font-size: 17px;
            font-weight: 800;
            white-space: nowrap;

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            transition:
                transform 0.25s ease,
                color 0.25s ease,
                background 0.25s ease,
                border-color 0.25s ease;
        }

        .skill-pill:hover {
            transform: translateY(-5px) scale(1.025);
            color: var(--white);
            background: linear-gradient(135deg,
                    rgba(228, 217, 148, 0.22),
                    rgba(255, 255, 255, 0.10));
            border-color: rgba(228, 217, 148, 0.42);
        }

        .skill-pill img {
            width: 28px;
            height: 28px;
            object-fit: contain;
            filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.22));
        }


        @keyframes skillMarqueeLeft {
            from {
                transform: translate3d(0, 0, 0);
            }

            to {
                transform: translate3d(-50%, 0, 0);
            }
        }

        @keyframes skillMarqueeRight {
            from {
                transform: translate3d(-50%, 0, 0);
            }

            to {
                transform: translate3d(0, 0, 0);
            }
        }

        /* =========================
           EXPERIENCES
        ========================= */
        .experiences-section {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            min-height: 100svh;
            padding: 70px 64px;
        }

        .experiences-header {
            max-width: 760px;
            margin: 0 auto 24px;
            text-align: center;
        }

        .experiences-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 28px;
            width: 100%;
            max-width: 1580px;
            margin: 0 auto;
        }

        .experience-card {
            position: relative;
            display: grid;
            grid-template-columns: minmax(150px, 190px) minmax(0, 1fr);
            align-items: start;
            gap: clamp(18px, 2vw, 30px);
            min-height: 325px;
            height: auto;
            overflow: hidden;
            padding: clamp(22px, 2vw, 28px);
            border-radius: 36px;
            background: var(--dark-glass);
            box-shadow: 0 18px 55px rgba(0, 0, 0, 0.32);
            color: var(--white);
            transition: transform 0.3s ease, background 0.3s ease;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        .experience-card:hover {
            background: var(--dark-glass-2);
            transform: translateY(-8px);
        }

        .experience-photo {
            width: 100%;
            aspect-ratio: 3 / 4;
            overflow: hidden;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 14px 35px rgba(0, 0, 0, 0.24);
        }

        .experience-photo img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .experience-content {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            height: 100%;
            padding-top: 4px;
        }

        .experience-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 26px;
            padding-right: 54px;
        }

        .experience-period {
            display: inline-flex;
            padding: 8px 18px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            color: rgba(255, 255, 255, 0.9);
            font-size: 12px;
            font-weight: 600;
        }

        .experience-number {
            position: absolute;
            top: 24px;
            right: 24px;
            color: rgba(255, 255, 255, 0.18);
            font-size: 42px;
            font-weight: 700;
            line-height: 1;
        }

        .experience-company {
            margin-bottom: 10px;
            color: rgba(255, 255, 255, 0.68);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .experience-main h3 {
            max-width: 560px;
            margin-bottom: 14px;
            color: var(--white);
            font-size: clamp(1.35rem, 2vw, 2rem);
            line-height: 1.12;
        }

        .experience-description {
            max-width: 560px;
            padding-left: 18px;
            color: rgba(255, 255, 255, 0.78);
            font-size: 14px;
            line-height: 1.65;
        }

        .experience-description li:not(:last-child) {
            margin-bottom: 8px;
        }

        /* =========================
           ANIMATIONS
        ========================= */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(28px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 1440px) {
            .experiences-section {
                padding-top: 60px;
            }

            .experiences-grid {
                max-width: 1220px;
            }

            .experience-card {
                grid-template-columns: minmax(140px, 165px) minmax(0, 1fr);
                min-height: 345px;
                border-radius: 32px;
            }

            .experience-top {
                margin-bottom: 22px;
                padding-right: 46px;
            }

            .experience-period {
                padding: 8px 14px;
                font-size: 12px;
                line-height: 1.2;
            }

            .experience-number {
                top: 22px;
                right: 22px;
                font-size: 40px;
            }

            .experience-company {
                font-size: 12px;
                line-height: 1.35;
            }

            .experience-main h3 {
                font-size: clamp(1.35rem, 2.05vw, 1.75rem);
            }

            .experience-description {
                font-size: 13.5px;
                line-height: 1.6;
            }
        }

        /* =========================
           RESPONSIVE - LARGE LAPTOP / TABLET LANDSCAPE
        ========================= */
        @media (max-width: 1280px) {
            .hero-section {
                grid-template-columns: 1fr;
                gap: 24px;
                padding-top: 112px;
                padding-bottom: 60px
            }

            .card-wrapper {
                width: min(560px, 90vw);
                min-width: 0;
            }

            .photo-collage {
                width: min(460px, 86vw);
                min-width: 0;
                height: auto;
            }

            .projects-section {
                min-height: auto;
                padding-top: 110px;
            }

            .projects-header {
                margin-bottom: 36px;
            }

            .projects-folder-wrapper {
                display: block;
            }

            .projects-folder {
                top: 0;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 24px;
                width: 100%;
                max-width: 1040px;
                height: auto;
                margin: 0 auto;
            }

            .folder-shell {
                display: none;
            }

            .project-card,
            .projects-folder:hover .project-card,
            .projects-folder.mobile-open .project-card,
            .projects-folder:hover .project-card-1,
            .projects-folder:hover .project-card-2,
            .projects-folder:hover .project-card-3,
            .projects-folder:hover .project-card-4,
            .projects-folder:hover .project-card-5,
            .projects-folder.mobile-open .project-card-1,
            .projects-folder.mobile-open .project-card-2,
            .projects-folder.mobile-open .project-card-3,
            .projects-folder.mobile-open .project-card-4,
            .projects-folder.mobile-open .project-card-5 {
                position: relative;
                top: auto;
                left: auto;
                width: 100%;
                max-width: none;
                margin: 0;
                opacity: 1;
                pointer-events: auto;
                transform: none;
            }

            .experiences-grid {
                grid-template-columns: 1fr;
                max-width: 760px;
            }

            .experience-card {
                grid-template-columns: 180px minmax(0, 1fr);
                min-height: auto;
            }
        }

        /* =========================
           RESPONSIVE - TABLET / MOBILE
        ========================= */
        @media (max-width: 960px) {
            .particles-container {
                display: none;
            }

            :root {
                --section-x: 28px;
                --nav-height-offset: 92px;
            }

            body {
                background-image: none;
                background-color: #7fb8df;
            }

            body::after {
                content: "";
                position: fixed;
                inset: 0;
                z-index: -2;
                background-image: url("{{ asset('images/mobilebg.webp') }}");
                background-position: center top;
                background-size: cover;
                background-repeat: no-repeat;
                pointer-events: none;
                transform: translateZ(0);
                will-change: transform;
            }

            body::before {
                z-index: -1;
                background:
                    linear-gradient(to bottom,
                        rgba(0, 0, 0, 0.36),
                        rgba(0, 0, 0, 0.54));
            }

            nav {
                top: 14px;
                justify-content: flex-start;
                gap: 18px;
                width: max-content;
                max-width: calc(100% - 24px);
                padding: 12px 18px;
                overflow-x: auto;
                scrollbar-width: none;
            }

            nav::-webkit-scrollbar {
                display: none;
            }

            nav a {
                font-size: 15px;
                white-space: nowrap;
            }

            .section-title {
                font-size: clamp(2.15rem, 8vw, 3rem);
            }

            .hero-section {
                min-height: auto;
                padding-top: 104px;
                padding-bottom: 52px;
                gap: 30px;
            }

            .card-wrapper {
                width: min(100%, 460px);
                aspect-ratio: 1 / 1;
            }

            .card-content {
                padding: 26px;
            }

            .card-name {
                padding-left: 12px;
                font-size: 2.05rem;
            }

            .card-bio {
                max-width: 320px;
                padding-left: 6px;
                font-size: 14px;
                line-height: 1.55;
            }

            .socials {
                gap: 20px;
            }

            .socials a,
            .socials img {
                width: 42px;
                height: 42px;
            }

            .photo-collage {
                width: min(100%, 390px);
                aspect-ratio: 39 / 44;
            }

            .polaroid-1 {
                padding: 13px 13px 40px;
                transform: rotate(-5deg) translate(-22%, -13%);
            }

            .polaroid-2 {
                padding: 13px 13px 40px;
                transform: rotate(4deg) translate(22%, 8%);
            }

            .polaroid-1:hover {
                transform: rotate(-5deg) translate(-22%, -13%);
            }

            .polaroid-2:hover {
                transform: rotate(4deg) translate(22%, 8%);
            }

            .projects-section,
            .skills-section,
            .experiences-section {
                min-height: auto;
                padding-top: 20px;
                padding-bottom: 56px;
            }

            .projects-folder {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .project-card {
                border-radius: 22px;
            }

            .project-content {
                padding: 18px;
            }

            .project-content h3 {
                max-width: 86%;
                font-size: 14.5px;
            }

            .skills-section {
                padding-top: 92px;
                padding-bottom: 64px;
            }

            .skills-header {
                margin-bottom: 34px;
            }

            .skills-marquee-shell {
                gap: 14px;
            }

            .skill-pill {
                min-width: 146px;
                height: 54px;
                padding: 0 18px;
                font-size: 15px;
            }

            .skill-pill img {
                width: 25px;
                height: 25px;
            }

            .skills-focus-row {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 24px 18px;
            }

            .experiences-section {
                padding-inline: var(--section-x);
            }

            .experiences-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .experience-card {
                grid-template-columns: 1fr;
                gap: 20px;
                height: auto;
                min-height: auto;
                padding: 24px;
                border-radius: 28px;
                overflow: visible;
            }

            .experience-photo {
                display: none;
            }

            .experience-top {
                align-items: flex-start;
                margin-bottom: 20px;
                padding-right: 52px;
            }

            .experience-period {
                max-width: calc(100% - 56px);
                padding: 8px 14px;
                font-size: 11.5px;
                line-height: 1.2;
            }

            .experience-number {
                top: 24px;
                right: 24px;
                font-size: 36px;
            }

            .experience-company {
                font-size: 12px;
                line-height: 1.45;
            }

            .experience-main h3 {
                font-size: clamp(1.35rem, 7vw, 2rem);
            }

            .experience-description {
                font-size: 13.5px;
                line-height: 1.65;
            }
        }

        /* =========================
           RESPONSIVE - SMALL PHONE
        ========================= */
        @media (max-width: 560px) {
            :root {
                --section-x: 18px;
                --nav-height-offset: 84px;
            }

            nav {
                top: 10px;
                max-width: calc(100% - 16px);
                padding: 10px 14px;
                gap: 14px;
            }

            nav a {
                font-size: 14px;
            }

            .hero-section {
                padding-top: 86px;
                gap: 22px;
            }

            .card-wrapper {
                width: min(100%, 350px);
            }

            .card-content {
                padding: 22px;
            }

            .card-name {
                margin-bottom: 10px;
                padding-left: 8px;
                font-size: 1.72rem;
            }

            .card-bio {
                max-width: 240px;
                margin-bottom: 7px;
                margin-top: 7px;
                padding-left: 2px;
                font-size: 11px;
                line-height: 1.48;
            }

            .socials {
                gap: 14px;
            }

            .socials a,
            .socials img {
                width: 34px;
                height: 34px;
            }

            .photo-collage {
                width: min(100%, 310px);
            }

            .polaroid-1,
            .polaroid-2 {
                padding: 10px 10px 32px;
            }

            .section-title {
                font-size: clamp(2rem, 10vw, 2.65rem);
            }

            .projects-section,
            .experiences-section {
                padding-top: 78px;
                padding-bottom: 46px;
            }

            .projects-header,
            .experiences-header {
                margin-bottom: 20px;
            }

            .project-card {
                border-radius: 18px;
            }

            .project-content h3 {
                max-width: 90%;
                padding: 10px 13px;
                font-size: 13px;
            }

            .skills-section {
                padding-top: 88px;
                padding-bottom: 58px;
            }

            .skills-header p {
                font-size: 14px;
                line-height: 1.65;
            }

            .skills-marquee-shell {
                width: calc(100% + 36px);
                margin-left: -18px;
            }

            .skills-marquee {
                border-radius: 0;
            }

            .skills-track {
                gap: 10px;
                animation-duration: 26s;
            }

            .skills-marquee.reverse .skills-track {
                animation-duration: 30s;
            }

            .skill-pill {
                min-width: 128px;
                height: 50px;
                padding: 0 15px;
                gap: 8px;
                font-size: 13.5px;
            }

            .skill-pill img {
                width: 23px;
                height: 23px;
            }

            .skills-focus-row {
                grid-template-columns: 1fr;
                margin-top: 32px;
                gap: 20px;
            }

            .skill-focus-item p {
                max-width: 92%;
            }

            .experience-card {
                padding: 20px;
                border-radius: 24px;
            }

            .experience-top {
                margin-bottom: 18px;
                padding-right: 44px;
            }

            .experience-period {
                max-width: calc(100% - 44px);
                padding: 7px 12px;
                font-size: 10.8px;
            }

            .experience-number {
                top: 20px;
                right: 20px;
                font-size: 31px;
            }

            .experience-main h3 {
                margin-bottom: 12px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>
    <div class="particles-container">
        <canvas id="particlesCanvas"></canvas>
    </div>

    <nav aria-label="Main navigation">
        <a class="active" href="#about">About</a>
        <a href="#skills">Skills</a>
        <a href="#experiences">Experiences</a>
        <a href="{{ route('galeri') }}">Projects</a>
    </nav>

    <section id="about" class="hero-section">
        <div class="card-wrapper">
            <img class="card-bg" src="{{ asset('images/card-stack.webp') }}" alt="" aria-hidden="true"
                decoding="async">

            <div class="card-content">
                <h1 class="card-name">Hi, I'm Zaky</h1>

                <p class="card-bio">
                    A third-year <strong>Information Systems</strong> student with a strong interest in
                    <strong>data analytics</strong> and <strong>business development.</strong>
                    Currently developing skills in relational and graph <strong>databases</strong>,
                    <strong>natural language processing</strong>, and <strong>machine learning</strong>
                    through academic and project-based work. Passionate about transforming data into
                    actionable insights to support decision-making. Actively involved in IT competitions
                    and student organizations.
                </p>

                <div class="socials">
                    <a href="mailto:alzakykhair@email.com" aria-label="Gmail">
                        <img src="{{ asset('icons/gmail.png') }}" alt="Gmail" loading="lazy" decoding="async">
                    </a>

                    <a href="https://linkedin.com/in/zakyalkhair/" target="_blank" rel="noopener" aria-label="LinkedIn">
                        <img src="{{ asset('icons/linkedin.png') }}" alt="LinkedIn" loading="lazy" decoding="async">
                    </a>

                    <a href="https://github.com/zakyalkhair" target="_blank" rel="noopener" aria-label="GitHub">
                        <img src="{{ asset('icons/github.png') }}" alt="GitHub" loading="lazy" decoding="async">
                    </a>
                </div>
            </div>
        </div>

        <div class="photo-collage" aria-label="Foto Zaky">
            <div class="polaroid polaroid-1">
                <img src="{{ asset('images/about1.jpg') }}" alt="Zaky presenting at ANFORCOM 2024" loading="lazy"
                    decoding="async">
            </div>

            <div class="polaroid polaroid-2">
                <img src="{{ asset('images/about2.jpg') }}" alt="Zaky presenting in front of a whiteboard"
                    loading="lazy" decoding="async">
            </div>
        </div>
    </section>

    <section id="skills" class="skills-section">
        <div class="skills-header">
            <h2 class="section-title">Skills & Tools</h2>
        </div>

        @php
            $skillRowOne = [
                ['name' => 'Python', 'icon' => 'python.png'],
                ['name' => 'Pandas', 'icon' => 'pandas.png'],
                ['name' => 'NumPy', 'icon' => 'numpy.png'],
                ['name' => 'Scikit-learn', 'icon' => 'scikitlearn.png'],
                ['name' => 'Power BI', 'icon' => 'powerbi.png'],
                ['name' => 'Tableau', 'icon' => 'tableau.png'],
                ['name' => 'MySQL', 'icon' => 'mysql.png'],
                ['name' => 'Neo4j', 'icon' => 'neo4j.png'],
            ];

            $skillRowTwo = [
                ['name' => 'Laravel', 'icon' => 'laravel.png'],
                ['name' => 'HTML5', 'icon' => 'html.png'],
                ['name' => 'CSS3', 'icon' => 'css.png'],
                ['name' => 'JavaScript', 'icon' => 'javascript.png'],
                ['name' => 'Git', 'icon' => 'git.png'],
                ['name' => 'Supabase', 'icon' => 'supabase.png'],
                ['name' => 'R Studio', 'icon' => 'r.png'],
                ['name' => 'Figma', 'icon' => 'figma.png'],
            ];
        @endphp

        <div class="skills-marquee-shell" aria-label="Technology stack marquee">
            <div class="skills-marquee">
                <div class="skills-track">
                    @foreach (array_merge($skillRowOne, $skillRowOne) as $skill)
                        <div class="skill-pill">
                            <img src="{{ asset('icons/' . $skill['icon']) }}" alt="{{ $skill['name'] }}" loading="lazy"
                                decoding="async">
                            <span>{{ $skill['name'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="skills-marquee reverse">
                <div class="skills-track">
                    @foreach (array_merge($skillRowTwo, $skillRowTwo) as $skill)
                        <div class="skill-pill">
                            <img src="{{ asset('icons/' . $skill['icon']) }}" alt="{{ $skill['name'] }}"
                                loading="lazy" decoding="async">
                            <span>{{ $skill['name'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>

    <section id="experiences" class="experiences-section">
        <div class="experiences-header">
            <h2 class="section-title">Experiences</h2>
        </div>

        <div class="experiences-grid">
            <article class="experience-card">
                <div class="experience-photo">
                    <img src="{{ asset('images/astra.png') }}" alt="Astra Infra Toll Road Tangerang-Merak"
                        loading="lazy" decoding="async">
                </div>

                <div class="experience-content">
                    <div class="experience-top">
                        <span class="experience-period">January 2026 — February 2026</span>
                        <span class="experience-number">01</span>
                    </div>

                    <div class="experience-main">
                        <p class="experience-company">Astra Infra Toll Road Tangerang-Merak</p>
                        <h3>Information Technology Intern</h3>

                        <ul class="experience-description">
                            <li>Developed IT Asset Management application using PHP Laravel and JWT authentication.</li>
                            <li>Created 5 system architecture diagrams and helped writing company agreement
                                documentations.</li>
                        </ul>
                    </div>
                </div>
            </article>

            <article class="experience-card">
                <div class="experience-photo">
                    <img src="{{ asset('images/hmsi.png') }}" alt="Himpunan Sistem Informasi ITS" loading="lazy"
                        decoding="async">
                </div>

                <div class="experience-content">
                    <div class="experience-top">
                        <span class="experience-period">March 2025 — Desember 2025</span>
                        <span class="experience-number">02</span>
                    </div>

                    <div class="experience-main">
                        <p class="experience-company">Himpunan Mahasiswa Sistem Informasi ITS</p>
                        <h3>Internal Affair Staff</h3>

                        <ul class="experience-description">
                            <li>Oversaw financial planning, transaction documentation, and transparent reporting for the
                                132nd Graduation Ceremony.</li>
                            <li>Assisted in planning and coordinating the event series for Dies Natalis HMSI 2025.</li>
                        </ul>
                    </div>
                </div>
            </article>

            <article class="experience-card">
                <div class="experience-photo">
                    <img src="{{ asset('images/ise.png') }}" alt="ISE! 2025" loading="lazy" decoding="async">
                </div>

                <div class="experience-content">
                    <div class="experience-top">
                        <span class="experience-period">April 2025 — Desember 2025</span>
                        <span class="experience-number">03</span>
                    </div>

                    <div class="experience-main">
                        <p class="experience-company">ISE! 2025</p>
                        <h3>Marketing Expert Staff</h3>

                        <ul class="experience-description">
                            <li>Guided marketing team to creating digital marketing content on instagram and tiktok that
                                achieved 10M+ total views and increased audience engagement by more than 100% across
                                platforms.</li>
                        </ul>
                    </div>
                </div>
            </article>

            <article class="experience-card">
                <div class="experience-photo">
                    <img src="{{ asset('images/asdos.png') }}" alt="Departemen Sistem Informasi ITS" loading="lazy"
                        decoding="async">
                </div>

                <div class="experience-content">
                    <div class="experience-top">
                        <span class="experience-period">August 2025 — Oktober 2025</span>
                        <span class="experience-number">04</span>
                    </div>

                    <div class="experience-main">
                        <p class="experience-company">Departemen Sistem Informasi</p>
                        <h3>Enterprise System Teaching Assistant</h3>

                        <ul class="experience-description">
                            <li>Developed Odoo learning modules for Sales, Procurement, Material Management, Point of
                                Sale (PoS), and Finance.</li>
                            <li>Taught and conducted final assessments for Information Systems students using Odoo
                                modules.</li>
                        </ul>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <section id="projects" class="projects-section">
        <div class="projects-header">
            <h2 class="section-title">My Projects</h2>
        </div>

        <div class="projects-folder-wrapper">
            <div class="projects-folder" id="projectsFolder">
                <div class="folder-shell">
                    <img src="{{ asset('images/folder.webp') }}" alt="Folder" loading="lazy" decoding="async">
                </div>

                <div class="project-card project-card-1">
                    <a href="{{ route('galeri') }}">
                        <div class="project-image">
                            <img src="{{ asset('images/project1.webp') }}"
                                alt="Sentiment Analysis of Alfagift project" loading="lazy" decoding="async">
                        </div>

                        <div class="project-content">
                            <h3>Sentiment Analysis of Alfagift on Google Play Reviews</h3>
                        </div>
                    </a>
                </div>

                <div class="project-card project-card-2">
                    <a href="{{ route('galeri') }}">
                        <div class="project-image">
                            <img src="{{ asset('images/project2.webp') }}"
                                alt="IT Balanced Scorecard Dashboard project" loading="lazy" decoding="async">
                        </div>

                        <div class="project-content">
                            <h3>IT Balanced Scorecard Dashboard Development for Company Performance Monitoring</h3>
                        </div>
                    </a>
                </div>

                <div class="project-card project-card-3">
                    <a href="{{ route('galeri') }}">
                        <div class="project-image">
                            <img src="{{ asset('images/project3.webp') }}"
                                alt="Ali Khamenei sentiment analysis project" loading="lazy" decoding="async">
                        </div>

                        <div class="project-content">
                            <h3>Sentiment Analysis of Ali Khamenei's Death on Indonesian News Media</h3>
                        </div>
                    </a>
                </div>

                <div class="project-card project-card-4">
                    <a href="{{ route('galeri') }}">
                        <div class="project-image">
                            <img src="{{ asset('images/project4.webp') }}" alt="Health Burden Clustering project"
                                loading="lazy" decoding="async">
                        </div>

                        <div class="project-content">
                            <h3>Health Burden Clustering in South Korea Using K-Means</h3>
                        </div>
                    </a>
                </div>

                <div class="project-card project-card-5">
                    <a href="{{ route('galeri') }}">
                        <div class="project-image">
                            <img src="{{ asset('images/project5.webp') }}" alt="Data Warehouse Design project"
                                loading="lazy" decoding="async">
                        </div>

                        <div class="project-content">
                            <h3>Data Warehouse Design for Information System Academic</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        const projectsFolder = document.getElementById('projectsFolder');
        const navLinks = document.querySelectorAll('nav a');
        const sections = document.querySelectorAll('section[id]');
        const revealElements = document.querySelectorAll('.reveal');
        const canvas = document.getElementById('particlesCanvas');
        const ctx = canvas?.getContext('2d');

        let particles = [];
        let animationFrameId = null;
        let lastFrameTime = 0;
        let isParticlesRunning = false;
        let navTicking = false;

        const mouse = {
            x: null,
            y: null
        };

        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
        const mobileViewport = window.matchMedia('(max-width: 960px)');

        const shouldRunParticles = () => {
            return canvas && ctx && !mobileViewport.matches && !prefersReducedMotion.matches;
        };

        const getParticleCount = () => {
            if (window.innerWidth <= 1280) return 190;
            return 220;
        };

        const particleSettings = {
            color: '255, 255, 255',
            speed: 0.6,
            baseSize: 3,
            hoverDistance: 300,
            hoverForce: 2.8,
            fps: 36
        };

        if (projectsFolder) {
            projectsFolder.addEventListener('click', event => {
                if (window.innerWidth <= 1280 && event.target.closest('.folder-shell')) {
                    projectsFolder.classList.toggle('mobile-open');
                }
            });
        }

        function setActiveNav() {
            const scrollPosition = window.scrollY + 180;

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionBottom = sectionTop + section.offsetHeight;
                const sectionId = section.getAttribute('id');

                if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                    navLinks.forEach(link => {
                        link.classList.toggle('active', link.getAttribute('href') === `#${sectionId}`);
                    });
                }
            });
        }

        function requestNavUpdate() {
            if (navTicking) return;

            navTicking = true;

            requestAnimationFrame(() => {
                setActiveNav();
                navTicking = false;
            });
        }

        function initRevealAnimation() {
            if (!revealElements.length) return;

            if (!('IntersectionObserver' in window)) {
                revealElements.forEach(element => {
                    element.classList.add('is-visible');
                });
                return;
            }

            const revealObserver = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.16,
                rootMargin: '0px 0px -80px 0px'
            });

            revealElements.forEach(element => {
                revealObserver.observe(element);
            });
        }

        function createParticles() {
            if (!canvas) return;

            particles = Array.from({
                length: getParticleCount()
            }, () => ({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                vx: (Math.random() - 0.5) * particleSettings.speed,
                vy: (Math.random() - 0.5) * particleSettings.speed,
                size: Math.random() * particleSettings.baseSize + 0.5,
                alpha: Math.random() * 0.38 + 0.22
            }));
        }

        function resizeCanvas() {
            if (!canvas || !shouldRunParticles()) return;

            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            createParticles();
        }

        function drawParticles(timestamp = 0) {
            if (!shouldRunParticles() || !isParticlesRunning) {
                animationFrameId = null;
                return;
            }

            const frameInterval = 1000 / particleSettings.fps;

            if (timestamp - lastFrameTime < frameInterval) {
                animationFrameId = requestAnimationFrame(drawParticles);
                return;
            }

            lastFrameTime = timestamp;
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            particles.forEach(particle => {
                const dx = mouse.x - particle.x;
                const dy = mouse.y - particle.y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (mouse.x !== null && distance > 0 && distance < particleSettings.hoverDistance) {
                    const force = (particleSettings.hoverDistance - distance) / particleSettings.hoverDistance;
                    particle.x -= (dx / distance) * force * particleSettings.hoverForce;
                    particle.y -= (dy / distance) * force * particleSettings.hoverForce;
                }

                particle.x += particle.vx;
                particle.y += particle.vy;

                if (particle.x < 0) particle.x = canvas.width;
                if (particle.x > canvas.width) particle.x = 0;
                if (particle.y < 0) particle.y = canvas.height;
                if (particle.y > canvas.height) particle.y = 0;

                ctx.beginPath();
                ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(${particleSettings.color}, ${particle.alpha})`;
                ctx.fill();
            });

            animationFrameId = requestAnimationFrame(drawParticles);
        }

        function startParticles() {
            if (!shouldRunParticles() || isParticlesRunning) return;

            isParticlesRunning = true;
            resizeCanvas();
            animationFrameId = requestAnimationFrame(drawParticles);
        }

        function stopParticles() {
            isParticlesRunning = false;

            if (animationFrameId) {
                cancelAnimationFrame(animationFrameId);
                animationFrameId = null;
            }

            if (ctx && canvas) {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            }
        }

        window.addEventListener('scroll', requestNavUpdate, {
            passive: true
        });

        window.addEventListener('load', () => {
            setActiveNav();
            initRevealAnimation();
            startParticles();
        });

        window.addEventListener('resize', () => {
            stopParticles();
            startParticles();
        }, {
            passive: true
        });

        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                stopParticles();
            } else {
                startParticles();
            }
        });

        window.addEventListener('mousemove', event => {
            mouse.x = event.clientX;
            mouse.y = event.clientY;
        }, {
            passive: true
        });

        window.addEventListener('mouseleave', () => {
            mouse.x = null;
            mouse.y = null;
        });

        mobileViewport.addEventListener('change', () => {
            stopParticles();
            startParticles();
        });
    </script>
</body>

</html>
