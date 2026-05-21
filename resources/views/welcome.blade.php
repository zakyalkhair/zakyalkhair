{{-- resources/views/portfolio/about.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaky — Portfolio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">


    <style>
        /* PARTICLES BACKGROUND */
        .particles-container {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        #particlesCanvas {
            width: 100%;
            height: 100%;
            display: block;
        }

        /* pastikan semua section tetap di atas particles */
        nav,
        section {
            position: relative;
            z-index: 2;
        }

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
            --dark-glass: rgba(44, 44, 44, 0.42);
        }

        html {
            height: 100%;
            scroll-behavior: smooth;
            font-family: 'DM Sans', sans-serif;
            overflow-x: hidden;
        }

        body {
            position: relative;
            min-height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: url("{{ asset('images/background.jpg') }}") center/cover no-repeat fixed;
            color: var(--text);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }

        section {
            position: relative;
            width: 100%;
        }

        /* NAVIGATION */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 22px 72px;
            display: flex;
            gap: 40px;
            align-items: center;
            background: rgba(232, 237, 244, .85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        nav a {
            font-size: 15px;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            letter-spacing: .01em;
            transition: color .2s ease, font-weight .2s ease;
        }

        nav a.active,
        nav a:hover {
            color: var(--navy);
            font-weight: 700;
        }

        /* HERO */
        .hero-section {
            min-height: 100vh;
            padding: 100px 72px 60px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            justify-items: center;
        }

        .card-wrapper {
            position: relative;
            width: 780px;
            height: 760px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeUp .7s ease both;
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
            width: 100%;
            height: 100%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .card-name {
            padding-left: 40px;
            margin-bottom: 20px;
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: clamp(3rem, 3.5vw, 3.4rem);
            line-height: 1.15;
            color: var(--navy);
        }

        .card-bio {
            max-width: 480px;
            margin-bottom: 30px;
            padding-left: 20px;
            font-size: 20px;
            line-height: 1.78;
            font-weight: 300;
            color: var(--text);
        }

        .card-bio strong {
            font-weight: 600;
        }

        .socials {
            display: flex;
            gap: 40px;
            justify-content: center;
        }

        .socials a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            border-radius: 10px;
            text-decoration: none;
            transition: transform .2s ease;
        }

        .socials a:hover {
            transform: translateY(-3px);
        }

        .socials img {
            width: 64px;
            height: 64px;
            object-fit: contain;
        }

        /* PHOTO COLLAGE */
        .photo-collage {
            position: relative;
            width: 660px;
            height: 720px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeUp .7s .15s ease both;
        }

        .polaroid {
            position: absolute;
            overflow: hidden;
            border-radius: 8px;
            background: var(--white);
            box-shadow: 0 12px 40px rgba(27, 58, 92, .22);
            transition: transform .35s ease;
        }

        .polaroid img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .polaroid-1 {
            width: 520px;
            height: 580px;
            padding: 20px 20px 64px;
            transform: rotate(-5deg) translate(-160px, -94px);
            z-index: 1;
        }

        .polaroid-2 {
            width: 520px;
            height: 600px;
            padding: 20px 20px 64px;
            transform: rotate(4deg) translate(142px, 58px);
            z-index: 2;
        }

        .polaroid-1:hover {
            transform: rotate(-5deg) translate(-220px, -94px);
        }

        .polaroid-2:hover {
            transform: rotate(4deg) translate(202px, 58px);
        }

        /* SCROLL INDICATOR */
        .scroll-indicator {
            position: absolute;
            bottom: 50px;
            left: 50%;
            z-index: 20;
            transform: translateX(-50%);
        }

        .scroll-indicator a {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.88);
            font-size: 14px;
            font-weight: 400;
            letter-spacing: .08em;
            text-decoration: none;
            text-transform: uppercase;
            transition: opacity .3s ease;
        }

        .scroll-indicator a:hover {
            opacity: .7;
        }

        .scroll-indicator svg {
            animation: bounce 1.8s infinite;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, .2));
        }

        /* PROJECTS */
        .projects-section {
            min-height: 100vh;
            padding: 140px 72px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .projects-header {
            margin-bottom: 285px;
            text-align: center;
        }

        .projects-header h2,
        .skills-header h2 {
            font-size: clamp(3rem, 5vw, 4rem);
            color: var(--white);
        }

        .projects-folder-wrapper {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .projects-folder {
            position: relative;
            top: -160px;
            width: 420px;
            height: 320px;
        }

        .folder-shell {
            position: absolute;
            inset: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity .45s ease, transform .45s ease;
        }

        .folder-shell img {
            width: 850px;
            height: auto;
            object-fit: contain;
        }

        .projects-folder:hover .folder-shell,
        .projects-folder.mobile-open .folder-shell {
            opacity: 0;
            transform: scale(.85);
        }

        .project-card {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 580px;
            aspect-ratio: 16 / 9;
            overflow: hidden;
            border-radius: 24px;
            opacity: 0;
            pointer-events: none;
            transform: translate(-50%, -50%) scale(.7);
            box-shadow: 0 10px 40px rgba(0, 0, 0, .2);
            transition:
                transform .5s cubic-bezier(.2, .8, .2, 1),
                opacity .4s ease;
        }

        .project-card a {
            position: relative;
            display: block;
            width: 100%;
            height: 100%;
            color: var(--white);
            text-decoration: none;
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
            padding: 12px 18px;
            margin: 0;
            border-radius: 12px;
            background: var(--dark-glass);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            box-shadow: 0 12px 34px rgba(0, 0, 0, 0.26);
            color: var(--white);
            font-size: 20px;
            font-weight: 500;
            line-height: 1.25;
            text-shadow: 0 3px 14px rgba(0, 0, 0, 0.35);
        }

        .projects-folder:hover .project-card,
        .projects-folder.mobile-open .project-card {
            opacity: 1;
            pointer-events: auto;
        }

        .projects-folder:hover .project-card-1,
        .projects-folder.mobile-open .project-card-1 {
            transform: translate(-900px, -280px) rotate(-22deg);
        }

        .projects-folder:hover .project-card-2,
        .projects-folder.mobile-open .project-card-2 {
            transform: translate(-700px, 20px) rotate(-8deg);
        }

        .projects-folder:hover .project-card-3,
        .projects-folder.mobile-open .project-card-3 {
            transform: translate(-300px, -240px) rotate(0deg);
        }

        .projects-folder:hover .project-card-4,
        .projects-folder.mobile-open .project-card-4 {
            transform: translate(80px, 30px) rotate(8deg);
        }

        .projects-folder:hover .project-card-5,
        .projects-folder.mobile-open .project-card-5 {
            transform: translate(310px, -290px) rotate(20deg);
        }

        /* SKILLS */
        .skills-section {
            min-height: 100vh;
            padding: 140px 72px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .skills-header {
            max-width: 720px;
            margin-bottom: 70px;
            text-align: center;
        }

        .skills-header h2 {
            margin-bottom: 18px;
        }

        .skills-header p {
            font-size: 17px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.78);
        }

        .skills-grid {
            width: 100%;
            max-width: 1180px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .skill-card {
            min-height: 320px;
            padding: 34px;
            overflow: hidden;
            border-radius: 28px;
            background: rgba(20, 28, 38, 0.58);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            transition: transform .3s ease, background .3s ease;
        }

        .skill-card:hover {
            transform: translateY(-8px);
            background: rgba(20, 28, 38, 0.68);
        }

        .skill-card h3 {
            margin-bottom: 28px;
            color: var(--white);
            font-size: 24px;
        }

        .skill-list {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .skill-list span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 18px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            color: var(--white);
            font-size: 14px;
            font-weight: 500;
        }

        /* EXPERIENCES */
        .experiences-section {
            min-height: 100vh;
            padding: 140px 72px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .experiences-header {
            max-width: 760px;
            margin: 0 auto 70px;
            text-align: center;
        }

        .experiences-header h2 {
            margin-bottom: 18px;
            font-size: clamp(3rem, 5vw, 4rem);
            color: var(--white);
        }

        .experiences-header p {
            font-size: 17px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.78);
        }

        /* HORIZONTAL SCROLL */
        .experiences-horizontal {
            display: grid;
            grid-auto-flow: column;
            grid-auto-columns: minmax(520px, 680px);
            gap: 28px;

            overflow-x: auto;
            overflow-y: hidden;

            padding: 12px 0 34px;
            scroll-snap-type: x mandatory;
            scroll-padding-inline: 72px;

            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.35) transparent;
        }

        .experiences-horizontal::-webkit-scrollbar {
            height: 8px;
        }

        .experiences-horizontal::-webkit-scrollbar-track {
            background: transparent;
        }

        .experiences-horizontal::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.28);
            border-radius: 999px;
        }

        .experience-card {
            scroll-snap-align: center;

            min-height: 430px;
            padding: 42px;
            border-radius: 36px;

            background: rgba(20, 28, 38, 0.62);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);

            color: var(--white);
            box-shadow: 0 18px 55px rgba(0, 0, 0, .32);

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            transition: transform .3s ease, background .3s ease;
        }

        .experience-card:hover {
            transform: translateY(-8px);
            background: rgba(20, 28, 38, 0.72);
        }

        .experience-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 80px;
        }

        .experience-period {
            display: inline-flex;
            padding: 9px 18px;
            border-radius: 999px;

            background: rgba(255, 255, 255, 0.14);
            color: rgba(255, 255, 255, 0.9);

            font-size: 13px;
            font-weight: 600;
        }

        .experience-number {
            font-size: 46px;
            font-weight: 700;
            line-height: 1;
            color: rgba(255, 255, 255, 0.18);
        }

        .experience-company {
            margin-bottom: 12px;

            font-size: 15px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;

            color: rgba(255, 255, 255, 0.68);
        }

        .experience-main h3 {
            max-width: 560px;
            margin-bottom: 20px;

            font-size: clamp(2rem, 3vw, 3rem);
            line-height: 1.08;
            color: var(--white);
        }

        .experience-description {
            max-width: 560px;

            font-size: 16px;
            line-height: 1.75;
            color: rgba(255, 255, 255, 0.78);
        }

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

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(8px);
            }
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .hero-section {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .projects-folder {
                transform: scale(.75);
            }
        }

        @media (max-width: 960px) {
            nav {
                padding: 18px 28px;
                gap: 24px;
            }

            .hero-section,
            .projects-section,
            .skills-section {
                padding-inline: 28px;
            }

            .card-wrapper {
                width: min(100%, 620px);
                height: 620px;
            }

            .card-name {
                padding-left: 20px;
            }

            .card-bio {
                padding-left: 10px;
                font-size: 17px;
            }

            .photo-collage {
                width: min(100%, 520px);
                height: 580px;
            }

            .polaroid-1,
            .polaroid-2 {
                width: 380px;
                height: 460px;
            }

            .projects-header {
                margin-bottom: 120px;
            }

            .projects-folder {
                top: 0;
                width: 100%;
                height: auto;
                transform: none;
                display: grid;
                gap: 22px;
            }

            .folder-shell {
                position: relative;
                min-height: 240px;
            }

            .folder-shell img {
                width: min(100%, 420px);
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
                max-width: 580px;
                margin: 0 auto;
                opacity: 1;
                pointer-events: auto;
                transform: none;
            }

            .skills-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>


<body>
    <div class="particles-container">
        <canvas id="particlesCanvas"></canvas>
    </div>
    <nav>
        <a class="active" href="#about">About</a>
        <a href="#projects">Projects</a>
        <a href="#skills">Skills</a>
        <a href="#experiences">Experiences</a>
    </nav>


    <section id="about" class="hero-section">
        <div class="card-wrapper">
            <img class="card-bg" src="{{ asset('images/card-stack.png') }}" alt="" aria-hidden="true">

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
                    <a href="mailto:your@email.com" aria-label="Gmail">
                        <img src="{{ asset('icons/gmail.png') }}" alt="Gmail">
                    </a>

                    <a href="https://linkedin.com/in/yourprofile" target="_blank" rel="noopener" aria-label="LinkedIn">
                        <img src="{{ asset('icons/linkedin.png') }}" alt="LinkedIn">
                    </a>

                    <a href="https://github.com/yourusername" target="_blank" rel="noopener" aria-label="GitHub">
                        <img src="{{ asset('icons/github.png') }}" alt="GitHub">
                    </a>
                </div>
            </div>
        </div>

        <div class="photo-collage" aria-label="Foto Zaky">
            <div class="polaroid polaroid-1">
                <img src="{{ asset('images/about1.jpg') }}" alt="Zaky presenting at ANFORCOM 2024" loading="lazy">
            </div>

            <div class="polaroid polaroid-2">
                <img src="{{ asset('images/about2.jpg') }}" alt="Zaky presenting in front of a whiteboard"
                    loading="lazy">
            </div>
        </div>

        <div class="scroll-indicator">
            <a href="#projects">
                <span>My Projects</span>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M6 9L12 15L18 9" stroke="white" stroke-width="8" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </section>

    <section id="projects" class="projects-section">
        <div class="projects-header">
            <h2>My Projects</h2>
        </div>

        <div class="projects-folder-wrapper">
            <div class="projects-folder" id="projectsFolder">
                <div class="folder-shell">
                    <img src="{{ asset('images/folder.png') }}" alt="Folder">
                </div>

                {{-- PROJECT CARDS --}}
                <div class="project-card project-card-1">
                    <a href="#">

                        <div class="project-image">
                            <img src="{{ asset('images/project1.png') }}" alt="Project 1">
                        </div>

                        <div class="project-content">
                            <h3>Sentiment Analysis of Alfagift on Google Play Reviews</h3>

                        </div>

                    </a>
                </div>

                <div class="project-card project-card-2">
                    <a href="#">

                        <div class="project-image">
                            <img src="{{ asset('images/project2.png') }}" alt="Project 2">
                        </div>

                        <div class="project-content">
                            <h3>IT Balanced Scorecard Dashboard Development for Company Performance Monitoring</h3>
                        </div>

                    </a>
                </div>

                <div class="project-card project-card-3">
                    <a href="#">

                        <div class="project-image">
                            <img src="{{ asset('images/project3.png') }}" alt="Project 4">
                        </div>

                        <div class="project-content">
                            <h3>Sentiment Analysis of Ali Khamenei's Death on Indonesian News Media</h3>
                        </div>

                    </a>
                </div>

                <div class="project-card project-card-4">
                    <a href="#">

                        <div class="project-image">
                            <img src="{{ asset('images/project4.png') }}" alt="Project 4">
                        </div>

                        <div class="project-content">
                            <h3>Health Burden Clustering in South Korea Using K-Means</h3>
                        </div>

                    </a>
                </div>

                <div class="project-card project-card-5">
                    <a href="#">

                        <div class="project-image">
                            <img src="{{ asset('images/project5.png') }}" alt="Project 5">
                        </div>

                        <div class="project-content">
                            <h3>Data Warehouse Design for Information System Academic</h3>
                        </div>

                    </a>
                </div>
            </div>
        </div>

        <div class="scroll-indicator">
            <a href="#skills">
                <span>Skills & Tools</span>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M6 9L12 15L18 9" stroke="white" stroke-width="8" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </section>

    <section id="skills" class="skills-section">
        <div class="skills-header">
            <h2>Skills & Tools</h2>
            <p>A collection of tools and technologies I use for data analysis, visualization, and web development.</p>
        </div>

        <div class="skills-grid">
            <div class="skill-card">
                <h3>Data Analytics</h3>
                <div class="skill-list">
                    <span>Python</span>
                    <span>Pandas</span>
                    <span>NumPy</span>
                    <span>Scikit-learn</span>
                    <span>R Studio</span>
                </div>
            </div>

            <div class="skill-card">
                <h3>Data Visualization</h3>
                <div class="skill-list">
                    <span>Power BI</span>
                    <span>Tableau</span>
                    <span>Matplotlib</span>
                    <span>Seaborn</span>
                </div>
            </div>

            <div class="skill-card">
                <h3>Web Development</h3>
                <div class="skill-list">
                    <span>Laravel</span>
                    <span>HTML</span>
                    <span>CSS</span>
                    <span>JavaScript</span>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <a href="#experiences">
                <span>Experiences</span>

                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M6 9L12 15L18 9" stroke="white" stroke-width="8" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </section>

    <section id="experiences" class="experiences-section">

        <div class="experiences-header">
            <h2>Experiences</h2>
        </div>

        <div class="experiences-horizontal">

            <article class="experience-card">
                <div class="experience-top">
                    <span class="experience-period">2025 — Present</span>
                    <span class="experience-number">01</span>
                </div>

                <div class="experience-main">
                    <p class="experience-company">Company Name</p>
                    <h3>Position Name</h3>
                    <p class="experience-description">
                        Briefly describe your responsibilities, contributions, and achievements in this role. Focus on
                        what you did, what tools you used, and the impact of your work.
                    </p>
                </div>
            </article>

            <article class="experience-card">
                <div class="experience-top">
                    <span class="experience-period">2024 — 2025</span>
                    <span class="experience-number">02</span>
                </div>

                <div class="experience-main">
                    <p class="experience-company">Company Name</p>
                    <h3>Position Name</h3>
                    <p class="experience-description">
                        Briefly describe your role, team contribution, project involvement, or leadership experience.
                        Keep it concise but strong for portfolio readability.
                    </p>
                </div>
            </article>

            <article class="experience-card">
                <div class="experience-top">
                    <span class="experience-period">2024</span>
                    <span class="experience-number">03</span>
                </div>

                <div class="experience-main">
                    <p class="experience-company">Organization Name</p>
                    <h3>Position Name</h3>
                    <p class="experience-description">
                        Briefly explain your responsibilities, events handled, analysis performed, or collaboration
                        experience that demonstrates your professional growth.
                    </p>
                </div>
            </article>

            <article class="experience-card">
                <div class="experience-top">
                    <span class="experience-period">2023 — 2024</span>
                    <span class="experience-number">04</span>
                </div>

                <div class="experience-main">
                    <p class="experience-company">Organization Name</p>
                    <h3>Position Name</h3>
                    <p class="experience-description">
                        Describe your contribution in a clear and outcome-oriented way. Mention relevant skills such as
                        communication, data analysis, project management, or teamwork.
                    </p>
                </div>
            </article>

        </div>

    </section>

    <script>
        const projectsFolder = document.getElementById('projectsFolder');

        if (projectsFolder) {
            projectsFolder.addEventListener('click', () => {
                if (window.innerWidth <= 960) {
                    projectsFolder.classList.toggle('mobile-open');
                }
            });
        }
    </script>
    <script>
        const canvas = document.getElementById('particlesCanvas');
        const ctx = canvas.getContext('2d');

        let particles = [];
        let mouse = {
            x: null,
            y: null
        };

        const particleSettings = {
            count: 200,
            color: '255, 255, 255',
            speed: 0.25,
            baseSize: 1.8,
            spread: 1.2,
            hoverDistance: 120,
            hoverForce: 0.8
        };

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            createParticles();
        }

        function createParticles() {
            particles = [];

            for (let i = 0; i < particleSettings.count; i++) {
                particles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    vx: (Math.random() - 0.5) * particleSettings.speed,
                    vy: (Math.random() - 0.5) * particleSettings.speed,
                    size: Math.random() * particleSettings.baseSize + 0.6,
                    alpha: Math.random() * 0.45 + 0.25
                });
            }
        }

        function drawParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            particles.forEach(particle => {
                const dx = mouse.x - particle.x;
                const dy = mouse.y - particle.y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (mouse.x !== null && distance < particleSettings.hoverDistance) {
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

            requestAnimationFrame(drawParticles);
        }

        window.addEventListener('resize', resizeCanvas);

        window.addEventListener('mousemove', e => {
            mouse.x = e.clientX;
            mouse.y = e.clientY;
        });

        window.addEventListener('mouseleave', () => {
            mouse.x = null;
            mouse.y = null;
        });

        resizeCanvas();
        drawParticles();
    </script>
</body>

</html>
