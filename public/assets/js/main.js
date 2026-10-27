const menuToggle = document.querySelector('.menu-toggle');
const navigation = document.querySelector('#primary-navigation');

if (menuToggle instanceof HTMLButtonElement && navigation instanceof HTMLElement) {
    menuToggle.addEventListener('click', () => {
        const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', String(!isExpanded));
        navigation.classList.toggle('is-open', !isExpanded);
    });

    navigation.addEventListener('click', (event) => {
        if (event.target instanceof HTMLAnchorElement) {
            menuToggle.setAttribute('aria-expanded', 'false');
            navigation.classList.remove('is-open');
        }
    });
}

const siteHeader = document.querySelector('.site-header');
let headerScrollTicking = false;

const updateStickyHeader = () => {
    if (!(siteHeader instanceof HTMLElement)) {
        return;
    }

    siteHeader.classList.toggle('is-sticky', window.scrollY > 40);
    headerScrollTicking = false;
};

window.addEventListener('scroll', () => {
    if (!headerScrollTicking) {
        window.requestAnimationFrame(updateStickyHeader);
        headerScrollTicking = true;
    }
}, { passive: true });

updateStickyHeader();

const heroVideo = document.querySelector('.hero-video');
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const saveData = 'connection' in navigator && navigator.connection?.saveData === true;

if (heroVideo instanceof HTMLVideoElement && !prefersReducedMotion && !saveData) {
    const videoSource = heroVideo.dataset.src;

    if (videoSource) {
        heroVideo.addEventListener('error', () => {
            heroVideo.classList.add('is-unavailable');
        }, { once: true });

        heroVideo.src = videoSource;
        heroVideo.load();

        const playback = heroVideo.play();
        if (playback instanceof Promise) {
            playback.catch(() => {
                heroVideo.classList.add('is-unavailable');
            });
        }
    }
}

const serviceCards = document.querySelectorAll('[data-card-effect]');
const canUseCardEffects = window.matchMedia('(hover: hover) and (pointer: fine)').matches
    && !window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (canUseCardEffects) {
    serviceCards.forEach((card) => {
        if (!(card instanceof HTMLElement)) {
            return;
        }

        card.addEventListener('pointermove', (event) => {
            const bounds = card.getBoundingClientRect();
            const x = (event.clientX - bounds.left) / bounds.width;
            const y = (event.clientY - bounds.top) / bounds.height;

            card.style.setProperty('--pointer-x', `${(x * 100).toFixed(1)}%`);
            card.style.setProperty('--pointer-y', `${(y * 100).toFixed(1)}%`);
        });

        card.addEventListener('pointerleave', () => {
            card.style.removeProperty('--pointer-x');
            card.style.removeProperty('--pointer-y');
        });
    });
}
