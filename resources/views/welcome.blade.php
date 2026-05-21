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

        .section-title {
            font-size: clamp(2.8rem, 4vw, 3.5rem);
            line-height: 1.1;
            color: var(--white);
            text-align: center;
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
            top: 22px;
            left: 50%;
            right: auto;
            transform: translateX(-50%);
            z-index: 100;
            padding: 18px 46px;
            display: flex;
            gap: 48px;
            align-items: center;
            justify-content: center;
            width: fit-content;
            background: rgba(232, 237, 244, .85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 999px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, .12);
        }

        nav a {
            font-size: 18px;
            font-weight: 600;
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
            padding: 105px 72px 45px;
            display: grid;
            grid-template-columns: 0.95fr 1.05fr;
            align-items: center;
            justify-items: center;
            column-gap: 10px;
        }

        .card-wrapper {
            position: relative;
            width: 560px;
            height: 550px;
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
            padding: 32px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .card-name {
            padding-left: 22px;
            margin-bottom: 14px;
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: clamp(2.2rem, 2.6vw, 2.65rem);
            line-height: 1.12;
            color: var(--navy);
        }

        .card-bio {
            max-width: 360px;
            margin-bottom: 20px;
            padding-left: 10px;
            font-size: 15.5px;
            line-height: 1.58;
            font-weight: 300;
            color: var(--text);
        }

        .card-bio strong {
            font-weight: 600;
        }

        .socials {
            display: flex;
            gap: 24px;
            justify-content: center;
        }

        .socials a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 10px;
            text-decoration: none;
            transition: transform .2s ease;
        }

        .socials a:hover {
            transform: translateY(-3px);
        }

        .socials img {
            width: 46px;
            height: 46px;
            object-fit: contain;
        }

        /* PHOTO COLLAGE */
        .photo-collage {
            position: relative;
            width: 480px;
            height: 540px;
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
            width: 360px;
            height: 430px;
            padding: 16px 16px 48px;
            transform: rotate(-5deg) translate(-105px, -68px);
            z-index: 1;
        }

        .polaroid-2 {
            width: 360px;
            height: 440px;
            padding: 16px 16px 48px;
            transform: rotate(4deg) translate(96px, 38px);
            z-index: 2;
        }

        .polaroid-1:hover {
            transform: rotate(-5deg) translate(-135px, -68px);
        }

        .polaroid-2:hover {
            transform: rotate(4deg) translate(126px, 38px);
        }

        /* PROJECTS */
        .projects-section {
            min-height: 80vh;
            padding: 110px 72px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .projects-header {
            margin-bottom: 265px;
            text-align: center;
        }

        .projects-folder-wrapper {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .projects-folder {
            position: relative;
            top: -175px;
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
            width: 750px;
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
            width: 560px;
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
            font-size: 16px;
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
            transform: translate(-800px, -320px) rotate(-17deg);
        }

        .projects-folder:hover .project-card-2,
        .projects-folder.mobile-open .project-card-2 {
            transform: translate(-700px, -20px) rotate(-8deg);
        }

        .projects-folder:hover .project-card-3,
        .projects-folder.mobile-open .project-card-3 {
            transform: translate(-300px, -220px) rotate(0deg);
        }

        .projects-folder:hover .project-card-4,
        .projects-folder.mobile-open .project-card-4 {
            transform: translate(80px, -25px) rotate(8deg);
        }

        .projects-folder:hover .project-card-5,
        .projects-folder.mobile-open .project-card-5 {
            transform: translate(240px, -330px) rotate(16deg);
        }

        /* SKILLS */
        .skills-section {
            min-height: 100vh;
            padding: 110px 72px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .skills-header {
            max-width: 720px;
            margin-bottom: 24px;
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
            min-height: 180px;
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
            margin-bottom: 16px;
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
            padding: 110px 64px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .experiences-header {
            max-width: 760px;
            margin: 0 auto 24px;
            text-align: center;
        }

        .experiences-header h2 {
            margin-bottom: 12px;
        }

        .experiences-grid {
            width: 100%;
            max-width: 1580px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 28px;
        }

        .experience-card {
            position: relative;
            min-height: 325px;
            height: 325px;
            padding: 28px;
            border-radius: 36px;
            background: rgba(20, 28, 38, 0.62);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            color: var(--white);
            box-shadow: 0 18px 55px rgba(0, 0, 0, .32);
            display: grid;
            grid-template-columns: 190px 1fr;
            gap: 30px;
            align-items: start;
            overflow: hidden;
            transition: transform .3s ease, background .3s ease;
        }

        .experience-card:hover {
            transform: translateY(-8px);
            background: rgba(20, 28, 38, 0.72);
        }

        .experience-photo {
            width: 100%;
            aspect-ratio: 3 / 4;
            align-self: start;
            border-radius: 22px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 14px 35px rgba(0, 0, 0, .24);
        }

        .experience-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .experience-content {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding-top: 4px;
        }

        .experience-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 26px;
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
            font-size: 42px;
            font-weight: 700;
            line-height: 1;
            color: rgba(255, 255, 255, 0.18);
        }

        .experience-company {
            margin-bottom: 10px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.68);
        }

        .experience-main h3 {
            max-width: 560px;
            margin-bottom: 14px;
            font-size: clamp(1.35rem, 2vw, 2rem);
            line-height: 1.12;
            color: var(--white);
        }

        .experience-description {
            max-width: 560px;
            padding-left: 18px;
            font-size: 14px;
            line-height: 1.65;
            color: rgba(255, 255, 255, 0.78);
        }

        .experience-description li {
            margin-bottom: 8px;
        }

        .experience-description li:last-child {
            margin-bottom: 0;
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
                padding: 14px 22px;
                gap: 22px;
                max-width: calc(100% - 32px);
                overflow-x: auto;
            }

            nav a {
                font-size: 15px;
                white-space: nowrap;
            }

            .section-title {
                font-size: clamp(2.2rem, 8vw, 3rem);
            }

            .hero-section,
            .projects-section,
            .skills-section,
            .experiences-section {
                padding-inline: 28px;
            }

            .card-wrapper {
                width: min(100%, 460px);
                height: 460px;
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
                width: min(100%, 380px);
                height: 440px;
            }

            .polaroid-1,
            .polaroid-2 {
                width: 280px;
                height: 350px;
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

            .skills-grid,
            .experiences-grid {
                grid-template-columns: 1fr;
            }

            .experience-card {
                height: auto;
                min-height: 420px;
                grid-template-columns: 1fr;
                padding: 28px;
            }

            .experience-photo {
                width: 180px;
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
                    <a href="mailto:alzakykhair@email.com" aria-label="Gmail">
                        <img src="{{ asset('icons/gmail.png') }}" alt="Gmail">
                    </a>

                    <a href="https://linkedin.com/in/zakyalkhair/" target="_blank" rel="noopener" aria-label="LinkedIn">
                        <img src="{{ asset('icons/linkedin.png') }}" alt="LinkedIn">
                    </a>

                    <a href="https://github.com/zakyalkhair" target="_blank" rel="noopener" aria-label="GitHub">
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
    </section>

    <section id="projects" class="projects-section">
        <div class="projects-header">
            <h2 class="section-title">My Projects</h2>
        </div>

        <div class="projects-folder-wrapper">
            <div class="projects-folder" id="projectsFolder">
                <div class="folder-shell">
                    <img src="{{ asset('images/folder.png') }}" alt="Folder">
                </div>

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
                            <img src="{{ asset('images/project3.png') }}" alt="Project 3">
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
    </section>

    <section id="skills" class="skills-section">
        <div class="skills-header">
            <h2 class="section-title">Skills & Tools</h2>
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
    </section>

    <section id="experiences" class="experiences-section">
        <div class="experiences-header">
            <h2 class="section-title">Experiences</h2>
        </div>

        <div class="experiences-grid">
            <article class="experience-card">
                <div class="experience-photo">
                    <img src="{{ asset('images/astra.png') }}" alt="Astra Infra Toll Road Tangerang-Merak">
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
                    <img src="{{ asset('images/hmsi.png') }}" alt="Himpunan Sistem Informasi ITS">
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
                    <img src="{{ asset('images/ise.png') }}" alt="ISE! 2025">
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
                    <img src="{{ asset('images/asdos.png') }}" alt="Departemen Sistem Informasi ITS">
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
        const navLinks = document.querySelectorAll('nav a');
        const sections = document.querySelectorAll('section[id]');

        function setActiveNav() {
            const scrollPosition = window.scrollY + 180;

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                const sectionId = section.getAttribute('id');

                if (
                    scrollPosition >= sectionTop &&
                    scrollPosition < sectionTop + sectionHeight
                ) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');

                        if (link.getAttribute('href') === `#${sectionId}`) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }

        window.addEventListener('scroll', setActiveNav);
        window.addEventListener('load', setActiveNav);

        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                navLinks.forEach(nav => nav.classList.remove('active'));
                link.classList.add('active');
            });
        });
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
            speed: 0.6,
            baseSize: 3.0,
            spread: 2.8,
            hoverDistance: 300,
            hoverForce: 2.8
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
