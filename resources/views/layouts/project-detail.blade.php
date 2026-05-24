<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portfolio Project — Zaky')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=DM+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/project-detail.css', 'resources/js/project-detail.js'])
</head>

<body class="project-detail-page @yield('bodyClass')" data-particles="@yield('enableParticles', 'false')">
    <div class="grain" aria-hidden="true"></div>

    @if (trim($__env->yieldContent('enableParticles', 'false')) === 'true')
        <div class="particles-container" aria-hidden="true">
            <canvas id="particlesCanvas"></canvas>
        </div>
    @endif

    <x-back-button />

    <main>
        @yield('content')
    </main>

</body>

</html>