{{-- resources/views/portfolio/project-gallery.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Gallery</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
            --white: #ffffff;
            --muted-white: rgba(255, 255, 255, 0.72);
            --soft-white: rgba(255, 255, 255, 0.14);
            --soft-white-2: rgba(255, 255, 255, 0.22);

            --accent: #ffd400;
            --accent-soft: rgba(255, 212, 0, 0.82);
            --accent-hover: rgba(255, 212, 0, 0.28);
            --accent-border: rgba(255, 212, 0, 0.42);

            --dark: rgba(4, 10, 20, 0.74);
            --dark-soft: rgba(7, 14, 28, 0.56);
            --card-border: rgba(255, 255, 255, 0.16);

            --soft-glass: rgba(255, 255, 255, 0.14);
            --text-muted: rgba(255, 255, 255, 0.72);
            --navy: var(--accent);

            --section-x: clamp(20px, 5vw, 64px);
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
            scroll-behavior: smooth;
        }


        body {
            overflow-x: hidden;
            color: var(--white);
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background-color: #111827;
        }

        img {
            max-width: 100%;
        }

        a {
            color: inherit;
            text-decoration: none;
            -webkit-tap-highlight-color: transparent;
        }

        button,
        input {
            font: inherit;
        }

        .bg-fixed {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(circle at 18% 18%, rgba(246, 207, 97, .46), transparent 40%),
                radial-gradient(circle at 82% 24%, rgba(147, 197, 253, .43), transparent 40%),
                radial-gradient(circle at 50% 92%, rgba(143, 214, 148, .42), transparent 40%);
        }

        .bg-fixed::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 1;
            background:
                linear-gradient(180deg, rgba(0, 0, 0, 0.26), rgba(0, 0, 0, 0.54)),
                radial-gradient(circle at 22% 18%, rgba(255, 212, 0, 0.26), transparent 34%),
                radial-gradient(circle at 78% 22%, rgba(255, 255, 255, 0.12), transparent 28%);
        }

        .page {
            position: relative;
            z-index: 2;
            min-height: 100vh;
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
           GALLERY SECTION
        ========================= */
        .gallery-section {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            padding: 110px var(--section-x) 90px;
            border-top: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0);
            box-shadow: 0 -40px 80px rgba(0, 0, 0, 0.26);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);

        }

        .section-heading {
            display: grid;
            grid-template-columns: minmax(0, 0.95fr) minmax(280px, 0.75fr);
            align-items: end;
            gap: 28px;
            max-width: 1280px;
            margin: 0 auto 34px;
        }

        .section-kicker {
            margin-bottom: 12px;
            color: rgba(255, 255, 255, 0.58);
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .section-title {
            font-size: clamp(34px, 5vw, 62px);
            font-weight: 800;
            line-height: 1.04;
            letter-spacing: -0.045em;
        }

        .section-desc {
            color: rgba(255, 255, 255);
            font-size: 15px;
            line-height: 1.75;
        }

        .gallery-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            max-width: 1280px;
            margin: 0 auto 28px;
        }

        .category-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .category-tab {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 15px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.10);
            color: rgba(255, 255, 255);
            cursor: pointer;
            transition: background 0.25s ease, transform 0.25s ease, color 0.25s ease, border-color 0.25s ease;
        }

        .category-tab:hover {
            transform: translateY(-2px);
            background: var(--accent-hover);
            border-color: var(--accent-border);
            color: var(--white);
        }

        .category-tab.active {
            background: var(--accent-soft);
            color: #111827;
            border-color: var(--accent-border);
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.14);
        }

        .search-box {
            position: relative;
            flex: 0 1 330px;
        }

        .search-box i {
            position: absolute;
            top: 50%;
            left: 16px;
            color: rgb(255, 255, 255);
            transform: translateY(-50%);
        }

        .search-box input {
            width: 100%;
            min-height: 46px;
            padding: 0 16px 0 44px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 999px;
            outline: none;
            background: rgba(255, 255, 255, 0.10);
            color: var(--white);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            transition: border-color 0.25s ease, background 0.25s ease;
        }

        .search-box input:focus {
            border-color: var(--accent-border);
            background: rgba(255, 255, 255, 0.14);
        }

        .search-box input::placeholder {
            color: rgba(255, 255, 255);
        }

        .project-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
            max-width: 1280px;
            margin: 0 auto;
        }

        .project-card {
            position: relative;
            cursor: pointer;
            overflow: hidden;
            min-height: 470px;
            border: 1px solid var(--card-border);
            border-radius: 30px;
            background: rgba(5, 12, 24, 0.58);
            box-shadow: 0 28px 70px rgba(0, 0, 0, 0.28);
            transition: opacity 0.35s ease, transform 0.35s ease, border-color 0.35s ease, background 0.35s ease;
        }

        .project-card:hover {
            transform: translateY(-8px);
            border-color: var(--accent-border);
            background: rgba(5, 12, 24, 0.72);
        }

        .project-card.is-hidden {
            display: none;
        }

        .project-image {
            position: relative;
            height: 235px;
            overflow: hidden;
            background:
                linear-gradient(135deg, rgba(255, 212, 0, 0.32), rgba(255, 255, 255, 0.10)),
                rgba(255, 255, 255, 0.08);
        }

        .project-image img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.45s ease;
        }

        .project-card:hover .project-image img {
            transform: scale(1.055);
        }

        .project-category {
            position: absolute;
            top: 16px;
            left: 16px;
            z-index: 2;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 999px;
            background: rgba(4, 10, 20, 0.48);
            color: rgba(255, 255, 255);
            font-size: 12px;
            font-weight: 800;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .project-body {
            padding: 24px;
        }

        .project-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 14px;
        }

        .project-meta span {
            display: inline-flex;
            align-items: center;
            min-height: 28px;
            padding: 0 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.10);
            color: rgba(255, 255, 255);
            font-size: 12px;
            font-weight: 700;
        }

        .project-title {
            margin-bottom: 12px;
            font-size: clamp(20px, 2vw, 26px);
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -0.03em;
        }

        .project-desc {
            min-height: 78px;
            color: rgba(255, 255, 255);
            font-size: 14px;
            line-height: 1.65;
        }

        .project-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-top: 22px;
        }

        .project-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 40px;
            padding: 0 14px;
            border-radius: 12px;
            background: var(--accent-soft);
            color: #111827;
            font-size: 13px;
            font-weight: 800;
            transition: transform 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
        }

        .project-link:hover {
            transform: translateY(-2px);
            background: var(--accent);
            box-shadow: 0 12px 28px rgba(255, 212, 0, 0.22);
        }

        .project-year {
            color: rgba(255, 255, 255);
            font-size: 13px;
            font-weight: 800;
        }

        .empty-state {
            display: none;
            max-width: 1280px;
            margin: 28px auto 0;
            padding: 28px;
            border: 1px dashed rgba(255, 255, 255, 0.24);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255);
            text-align: center;
        }

        .empty-state.show {
            display: block;
        }

        /* =========================
           ASSET NOTE SECTION
        ========================= */
        .asset-section {
            padding: 80px var(--section-x) 100px;
            background: rgba(4, 10, 20, 0.46);
        }

        .asset-card {
            max-width: 1280px;
            margin: 0 auto;
            padding: clamp(24px, 4vw, 38px);
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 32px;
            background: rgba(255, 255, 255, 0.10);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .asset-card h2 {
            margin-bottom: 14px;
            font-size: clamp(26px, 3.4vw, 42px);
            line-height: 1.1;
            letter-spacing: -0.035em;
        }

        .asset-card p {
            max-width: 820px;
            color: rgba(255, 255, 255, 0.72);
            font-size: 15px;
            line-height: 1.75;
        }

        .asset-list {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .asset-list span {
            padding: 14px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.10);
            color: rgba(255, 255, 255, 0.72);
            font-size: 13px;
            font-weight: 700;
        }

        /* =========================
           ANIMATION
        ========================= */
        .reveal {
            opacity: 0;
            transform: translateY(26px);
            transition: opacity 0.62s ease, transform 0.62s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-1 {
            transition-delay: 0.06s;
        }

        .delay-2 {
            transition-delay: 0.12s;
        }

        .delay-3 {
            transition-delay: 0.18s;
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
            }

            .reveal {
                opacity: 1 !important;
                transform: none !important;
            }
        }

        /* =========================
           RESPONSIVE
        ========================= */
        @media (max-width: 1180px) {
            .project-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .asset-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 900px) {
            nav {
                top: 18px;
                width: calc(100% - 32px);
                max-width: calc(100% - 32px);
                justify-content: flex-start;
                gap: 18px;
                padding: 12px 18px;
                overflow-x: auto;
                scrollbar-width: none;
            }

            nav::-webkit-scrollbar {
                display: none;
            }

            nav a {
                white-space: nowrap;
                font-size: 13px;
            }

            .section-heading {
                grid-template-columns: 1fr;
            }

            .gallery-toolbar {
                align-items: stretch;
                flex-direction: column;
            }

            .search-box {
                flex-basis: auto;
            }
        }

        @media (max-width: 720px) {
            .gallery-section {
                padding: 86px 18px 72px;
            }

            .project-grid {
                grid-template-columns: 1fr;
            }

            .project-card {
                min-height: auto;
                border-radius: 24px;
            }

            .project-image {
                height: 220px;
            }

            .project-desc {
                min-height: auto;
            }

            .project-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .project-link {
                width: 100%;
                justify-content: center;
            }

            .asset-section {
                padding: 64px 18px 78px;
            }

            .asset-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="bg-fixed" aria-hidden="true"></div>

    <nav aria-label="Main navigation">
        <a href="{{ url('/') }}#about">About</a>
        <a href="{{ url('/') }}#skills">Skills</a>
        <a href="{{ url('/') }}#experiences">Experiences</a>
        <a class="active" href="{{ route('galeri') }}">Projects</a>
    </nav>

    <main class="page">
        <section class="gallery-section" id="gallery">
            <div class="section-heading reveal">
                <div>
                    <p class="section-kicker">Zaky Al Khair</p>
                    <h2 class="section-title">Portfolio</h2>
                </div>

                <p class="section-desc">
                    Pilih kategori untuk menampilkan project yang paling relevan dengan posisi yang sedang direview.
                    Card bisa diarahkan ke halaman detail project, GitHub, laporan, atau demo.
                </p>
            </div>

            <div class="gallery-toolbar reveal delay-1">
                <div class="category-tabs" aria-label="Project category filter">
                    <button class="category-tab active" type="button" data-filter="all">
                        <i class="fa-solid fa-border-all"></i>
                        All
                    </button>
                    <button class="category-tab" type="button" data-filter="data">
                        <i class="fa-solid fa-chart-line"></i>
                        Data
                    </button>
                    <button class="category-tab" type="button" data-filter="software">
                        <i class="fa-solid fa-code"></i>
                        Software
                    </button>
                    <button class="category-tab" type="button" data-filter="bi">
                        <i class="fa-solid fa-chart-pie"></i>
                        BI Dashboard
                    </button>
                    <button class="category-tab" type="button" data-filter="ml">
                        <i class="fa-solid fa-brain"></i>
                        ML / NLP
                    </button>
                </div>

                <label class="search-box" for="projectSearch">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input id="projectSearch" type="search" placeholder="Search project, tools, or keyword...">
                </label>
            </div>

            <div class="project-grid" id="projectGrid">
                <article class="project-card reveal delay-2" data-category="data ml"
                    data-url="{{ route('projects.alfagift') }}"
                    data-keywords="sentiment analysis alfagift google play reviews python nlp classification machine learning">
                    <div class="project-image">
                        <span class="project-category">
                            <i class="fa-solid fa-brain"></i>
                            ML / NLP
                        </span>
                        <img src="{{ asset('images/project1.webp') }}" alt="Sentiment Analysis of Alfagift project"
                            loading="lazy" decoding="async">
                    </div>

                    <div class="project-body">
                        <div class="project-meta">
                            <span>Python</span>
                            <span>NLP</span>
                            <span>Classification</span>
                        </div>

                        <h3 class="project-title">Sentiment Analysis of Alfagift Reviews.</h3>
                        <p class="project-desc">
                            Analisis sentimen ulasan Google Play untuk memahami persepsi pengguna terhadap aplikasi
                            Alfagift dan mengubah review menjadi insight yang lebih mudah dibaca.
                        </p>

                        <div class="project-footer">
                            <a href="{{ route('projects.alfagift') }}" class="project-link">
                                View Project
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <span class="project-year">2026</span>
                        </div>
                    </div>
                </article>

                <article class="project-card reveal delay-1" data-category="bi data"
                    data-url="{{ route('projects.powerbi') }}"
                    data-keywords="power bi dashboard it balanced scorecard kpi etl business intelligence data visualization">
                    <div class="project-image">
                        <span class="project-category">
                            <i class="fa-solid fa-chart-pie"></i>
                            BI Dashboard
                        </span>
                        <img src="{{ asset('images/project2.webp') }}" alt="IT Balanced Scorecard Dashboard project"
                            loading="lazy" decoding="async">
                    </div>

                    <div class="project-body">
                        <div class="project-meta">
                            <span>Power BI</span>
                            <span>ETL</span>
                            <span>KPI</span>
                        </div>

                        <h3 class="project-title">Power BI KPI Dashboard for Company Performance</h3>
                        <p class="project-desc">
                            Dashboard monitoring performa berbasis IT Balanced Scorecard untuk membantu membaca KPI,
                            perspektif bisnis, dan evaluasi performa perusahaan secara lebih terstruktur.
                        </p>

                        <div class="project-footer">
                            <a href="{{ route('projects.powerbi') }}" class="project-link">
                                View Project
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <span class="project-year">2026</span>
                        </div>
                    </div>
                </article>

                <article class="project-card reveal delay-2" data-category="data"
                    data-url="{{ url('/projects/data-lakehouse') }}"
                    data-keywords="data warehouse data lakehouse mysql python etl kimball medallion architecture data engineering">
                    <div class="project-image">
                        <span class="project-category">
                            <i class="fa-solid fa-database"></i>
                            Data Engineering
                        </span>
                        <img src="{{ asset('images/project5.webp') }}"
                            alt="Data warehouse and lakehouse design project" loading="lazy" decoding="async">
                    </div>

                    <div class="project-body">
                        <div class="project-meta">
                            <span>MySQL</span>
                            <span>Python</span>
                            <span>ETL</span>
                        </div>

                        <h3 class="project-title">Data Lakehouse Design</h3>
                        <p class="project-desc">
                            Desain arsitektur data lakehouse dengan pipeline ETL, dimensional modeling, dan pengelolaan
                            data akademik untuk kebutuhan analitik.
                        </p>

                        <div class="project-footer">
                            <a href="" class="project-link">
                                View Project
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <span class="project-year">2025</span>
                        </div>
                    </div>
                </article>


                <article class="project-card reveal delay-3" data-category="data ml"
                    data-url="{{ route('projects.khamenei') }}"
                    data-keywords="sentiment analysis news media indonesian nlp indobert entity extraction python">
                    <div class="project-image">
                        <span class="project-category">
                            <i class="fa-solid fa-newspaper"></i>
                            Data / NLP
                        </span>
                        <img src="{{ asset('images/project3.webp') }}"
                            alt="Indonesian news sentiment analysis project" loading="lazy" decoding="async">
                    </div>

                    <div class="project-body">
                        <div class="project-meta">
                            <span>IndoBERT</span>
                            <span>Python</span>
                            <span>NER</span>
                        </div>

                        <h3 class="project-title">Analisis Sentimen Kematian Ali Khamenei.</h3>
                        <p class="project-desc">
                            Pipeline NLP untuk mengolah artikel berita, melakukan sentiment analysis, dan mengekstrak
                            entitas penting dari media berita Indonesia.
                        </p>

                        <div class="project-footer">
                            <a href="{{ route('projects.khamenei') }}" class="project-link">
                                View Project
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <span class="project-year">2025</span>
                        </div>
                    </div>
                </article>





                <article class="project-card reveal delay-3" data-category="data ml"
                    data-url="{{ route('projects.clustering') }}"
                    data-keywords="clustering kmeans rstudio health burden south korea data science silhouette elbow method">
                    <div class="project-image">
                        <span class="project-category">
                            <i class="fa-solid fa-chart-simple"></i>
                            Data Science
                        </span>
                        <img src="{{ asset('images/project4.webp') }}" alt="Health burden clustering project"
                            loading="lazy" decoding="async">
                    </div>

                    <div class="project-body">
                        <div class="project-meta">
                            <span>RStudio</span>
                            <span>K-Means</span>
                            <span>Clustering</span>
                        </div>

                        <h3 class="project-title">Clustering Health Burden in South Korea.</h3>
                        <p class="project-desc">
                            Clustering data health burden Korea Selatan untuk melihat pola variasi penyakit, mortalitas,
                            dan beban kesehatan menggunakan K-Means.
                        </p>

                        <div class="project-footer">
                            <a href="{{ route('projects.clustering') }}" class="project-link">
                                View Project
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <span class="project-year">2025</span>
                        </div>
                    </div>
                </article>



                <article class="project-card reveal delay-1" data-category="software"
                    data-url="{{ url('/projects/personal-portfolio') }}"
                    data-keywords="portfolio website frontend html css javascript laravel responsive ui ux software development">
                    <div class="project-image">
                        <span class="project-category">
                            <i class="fa-solid fa-laptop-code"></i>
                            Frontend
                        </span>
                        <img src="{{ asset('images/gallery-software-1.webp') }}"
                            alt="Portfolio website frontend project" loading="lazy" decoding="async">
                    </div>

                    <div class="project-body">
                        <div class="project-meta">
                            <span>HTML</span>
                            <span>CSS</span>
                            <span>JavaScript</span>
                        </div>

                        <h3 class="project-title">Personal Portfolio Website</h3>
                        <p class="project-desc">
                            Website portfolio personal dengan responsive layout, project detail page, animated section,
                            dan struktur navigasi yang memudahkan reviewer melihat karya.
                        </p>

                        <div class="project-footer">
                            <a href="{{ url('/projects/personal-portfolio') }}" class="project-link">
                                View Project
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <span class="project-year">2026</span>
                        </div>
                    </div>
                </article>

                <article class="project-card reveal delay-2" data-category="software data"
                    data-url="{{ url('/projects/mentor-mentee-platform') }}"
                    data-keywords="mentor mentee application ux design web application information system software data education platform">
                    <div class="project-image">
                        <span class="project-category">
                            <i class="fa-solid fa-diagram-project"></i>
                            Software / UX
                        </span>
                        <img src="{{ asset('images/gallery-software-2.webp') }}" alt="Mentor mentee platform project"
                            loading="lazy" decoding="async">
                    </div>

                    <div class="project-body">
                        <div class="project-meta">
                            <span>UX Design</span>
                            <span>Web App</span>
                            <span>Prototype</span>
                        </div>

                        <h3 class="project-title">Mentor-Mentee Platform</h3>
                        <p class="project-desc">
                            Konsep platform mentor-mentee untuk membantu mahasiswa mencari mentor berdasarkan bidang
                            seperti bisnis, programming, data, dan mata kuliah tertentu.
                        </p>

                        <div class="project-footer">
                            <a href="{{ url('/projects/mentor-mentee-platform') }}" class="project-link">
                                View Project
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <span class="project-year">2025</span>
                        </div>
                    </div>
                </article>
            </div>

            <div class="empty-state" id="emptyState">
                Project tidak ditemukan. Coba gunakan kategori lain atau hapus keyword pencarian.
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.category-tab');
            const cards = document.querySelectorAll('.project-card');
            const searchInput = document.getElementById('projectSearch');
            const emptyState = document.getElementById('emptyState');
            const revealElements = document.querySelectorAll('.reveal');

            cards.forEach((card) => {
                const targetUrl = card.dataset.url;
                const projectLink = card.querySelector('.project-link');

                if (targetUrl && projectLink) {
                    projectLink.href = targetUrl;
                }

                card.addEventListener('click', (event) => {
                    if (!targetUrl) return;
                    if (event.target.closest('a, button, input')) return;

                    window.location.href = targetUrl;
                });
            });

            let activeFilter = 'all';

            function normalizeText(value) {
                return value.toLowerCase().trim();
            }

            function filterProjects() {
                const keyword = normalizeText(searchInput?.value || '');
                let visibleCount = 0;

                cards.forEach((card) => {
                    const categories = card.dataset.category || '';
                    const keywords = normalizeText(card.dataset.keywords || '');
                    const title = normalizeText(card.querySelector('.project-title')?.textContent || '');
                    const description = normalizeText(card.querySelector('.project-desc')?.textContent ||
                        '');
                    const searchableText = `${keywords} ${title} ${description}`;

                    const matchCategory = activeFilter === 'all' || categories.includes(activeFilter);
                    const matchSearch = keyword === '' || searchableText.includes(keyword);
                    const shouldShow = matchCategory && matchSearch;

                    card.classList.toggle('is-hidden', !shouldShow);

                    if (shouldShow) {
                        visibleCount += 1;
                    }
                });

                emptyState?.classList.toggle('show', visibleCount === 0);
            }

            tabs.forEach((tab) => {
                tab.addEventListener('click', () => {
                    activeFilter = tab.dataset.filter || 'all';

                    tabs.forEach((item) => item.classList.remove('active'));
                    tab.classList.add('active');

                    filterProjects();
                });
            });

            searchInput?.addEventListener('input', filterProjects);

            function initRevealAnimation() {
                if (!revealElements.length) return;

                if (!('IntersectionObserver' in window)) {
                    revealElements.forEach((element) => element.classList.add('is-visible'));
                    return;
                }

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.14,
                    rootMargin: '0px 0px -70px 0px'
                });

                revealElements.forEach((element) => observer.observe(element));
            }

            initRevealAnimation();
            filterProjects();
        });
    </script>
</body>

</html>
