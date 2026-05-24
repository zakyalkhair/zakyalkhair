document.addEventListener('DOMContentLoaded', () => {
    initSpotlightCards();
    initVisualGalleries();
    initParticles();
});

function initSpotlightCards() {
    const spotlightCards = document.querySelectorAll('.spotlight-card');

    spotlightCards.forEach((card) => {
        const spotlightColor = card.dataset.spotlightColor || 'rgba(246, 207, 97, .16)';
        card.style.setProperty('--spotlight-color', spotlightColor);

        card.addEventListener('mousemove', (event) => {
            const rect = card.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;

            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        }, { passive: true });
    });
}

function initVisualGalleries() {
    const galleries = document.querySelectorAll('[data-project-gallery]');

    galleries.forEach((gallery) => {
        const tabButtons = gallery.querySelectorAll('.tab-button');
        const visualImage = gallery.querySelector('.visual-image');
        const visualTitle = gallery.querySelector('.visual-title');
        const visualDesc = gallery.querySelector('.visual-desc');
        const openImage = gallery.querySelector('.open-btn');
        const section = gallery.closest('section');
        const modal = section?.querySelector('.image-modal') || document.querySelector('.image-modal');
        const modalImage = modal?.querySelector('.modal-image');
        const closeModal = modal?.querySelector('.modal-close');

        if (!tabButtons.length || !visualImage || !visualTitle || !visualDesc) return;

        tabButtons.forEach((button) => {
            button.addEventListener('click', () => {
                tabButtons.forEach((tab) => tab.classList.remove('active'));
                button.classList.add('active');

                const image = button.dataset.img || '';
                const title = button.dataset.title || '';
                const desc = button.dataset.desc || '';

                visualImage.src = image;
                visualImage.alt = `${title} visual`;
                visualTitle.textContent = title;
                visualDesc.textContent = desc;
            });
        });

        if (!modal || !modalImage || !openImage || !closeModal) return;

        const showModal = () => {
            modalImage.src = visualImage.src;
            modalImage.alt = visualImage.alt;
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
        };

        const hideModal = () => {
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
        };

        visualImage.addEventListener('click', showModal);
        openImage.addEventListener('click', showModal);
        closeModal.addEventListener('click', hideModal);

        modal.addEventListener('click', (event) => {
            if (event.target === modal) hideModal();
        });

        window.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') hideModal();
        });
    });
}

function initParticles() {
    const enableParticles = document.body.dataset.particles === 'true';
    const canvas = document.getElementById('particlesCanvas');

    if (!enableParticles || !canvas) return;

    const ctx = canvas.getContext('2d', { alpha: true });
    if (!ctx) return;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const mobileViewport = window.matchMedia('(max-width: 720px)');

    const mouse = { x: null, y: null };
    const settings = {
        color: '255, 255, 255',
        speed: 0.45,
        baseSize: 2.4,
        hoverDistance: 240,
        hoverForce: 1.8,
        fps: 30,
    };

    let particles = [];
    let animationFrameId = null;
    let lastFrameTime = 0;
    let isRunning = false;
    let resizeTimer = null;
    let canvasWidth = 0;
    let canvasHeight = 0;

    const shouldRun = () => !mobileViewport.matches && !prefersReducedMotion.matches;
    const getParticleCount = () => (window.innerWidth <= 1280 ? 95 : 130);

    function createParticles() {
        particles = Array.from({ length: getParticleCount() }, () => ({
            x: Math.random() * canvasWidth,
            y: Math.random() * canvasHeight,
            vx: (Math.random() - 0.5) * settings.speed,
            vy: (Math.random() - 0.5) * settings.speed,
            size: Math.random() * settings.baseSize + 0.5,
            alpha: Math.random() * 0.34 + 0.18,
        }));
    }

    function resizeCanvas() {
        if (!shouldRun()) return;

        const dpr = Math.min(window.devicePixelRatio || 1, 1.5);
        canvasWidth = window.innerWidth;
        canvasHeight = window.innerHeight;

        canvas.width = Math.floor(canvasWidth * dpr);
        canvas.height = Math.floor(canvasHeight * dpr);
        canvas.style.width = `${canvasWidth}px`;
        canvas.style.height = `${canvasHeight}px`;

        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        createParticles();
    }

    function drawParticles(timestamp = 0) {
        if (!shouldRun() || !isRunning) {
            animationFrameId = null;
            return;
        }

        const frameInterval = 1000 / settings.fps;
        if (timestamp - lastFrameTime < frameInterval) {
            animationFrameId = requestAnimationFrame(drawParticles);
            return;
        }

        lastFrameTime = timestamp;
        ctx.clearRect(0, 0, canvasWidth, canvasHeight);

        const hoverDistanceSquared = settings.hoverDistance * settings.hoverDistance;

        particles.forEach((particle) => {
            if (mouse.x !== null) {
                const dx = mouse.x - particle.x;
                const dy = mouse.y - particle.y;
                const distanceSquared = dx * dx + dy * dy;

                if (distanceSquared > 0 && distanceSquared < hoverDistanceSquared) {
                    const distance = Math.sqrt(distanceSquared);
                    const force = (settings.hoverDistance - distance) / settings.hoverDistance;

                    particle.x -= (dx / distance) * force * settings.hoverForce;
                    particle.y -= (dy / distance) * force * settings.hoverForce;
                }
            }

            particle.x += particle.vx;
            particle.y += particle.vy;

            if (particle.x < 0) particle.x = canvasWidth;
            if (particle.x > canvasWidth) particle.x = 0;
            if (particle.y < 0) particle.y = canvasHeight;
            if (particle.y > canvasHeight) particle.y = 0;

            ctx.beginPath();
            ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(${settings.color}, ${particle.alpha})`;
            ctx.fill();
        });

        animationFrameId = requestAnimationFrame(drawParticles);
    }

    function startParticles() {
        if (!shouldRun() || isRunning) return;
        isRunning = true;
        resizeCanvas();
        animationFrameId = requestAnimationFrame(drawParticles);
    }

    function stopParticles() {
        isRunning = false;

        if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
            animationFrameId = null;
        }

        ctx.clearRect(0, 0, canvasWidth, canvasHeight);
    }

    function restartParticles() {
        stopParticles();
        startParticles();
    }

    window.addEventListener('resize', () => {
        window.clearTimeout(resizeTimer);
        resizeTimer = window.setTimeout(restartParticles, 160);
    }, { passive: true });

    document.addEventListener('visibilitychange', () => {
        document.hidden ? stopParticles() : startParticles();
    });

    window.addEventListener('pointermove', (event) => {
        if (!shouldRun()) return;
        mouse.x = event.clientX;
        mouse.y = event.clientY;
    }, { passive: true });

    window.addEventListener('pointerleave', () => {
        mouse.x = null;
        mouse.y = null;
    });

    mobileViewport.addEventListener('change', restartParticles);
    prefersReducedMotion.addEventListener('change', restartParticles);

    startParticles();
}
