const LOADER_ID = 'clinic-page-loader';
const MIN_VISIBLE_MS = 500;
const MAX_WAIT_MS = 12000;

let shownAt = 0;
let hideGeneration = 0;

function getLoader() {
    return document.getElementById(LOADER_ID);
}

function sleep(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
}

export function showPageLoader() {
    const el = getLoader();
    if (!el) {
        return;
    }

    hideGeneration += 1;
    shownAt = Date.now();
    el.classList.remove('is-hidden');
    el.setAttribute('aria-busy', 'true');
    el.setAttribute('aria-hidden', 'false');
    document.documentElement.classList.add('clinic-is-loading');
}

export async function hidePageLoader() {
    const el = getLoader();
    if (!el) {
        return;
    }

    const generation = ++hideGeneration;

    try {
        await Promise.race([waitForPageReady(), sleep(MAX_WAIT_MS)]);
    } catch {
        /* continuar y ocultar igualmente */
    }

    const visibleFor = Date.now() - shownAt;
    const remaining = Math.max(0, MIN_VISIBLE_MS - visibleFor);
    if (remaining > 0) {
        await sleep(remaining);
    }

    if (generation !== hideGeneration) {
        return;
    }

    el.classList.add('is-hidden');
    el.setAttribute('aria-busy', 'false');
    el.setAttribute('aria-hidden', 'true');
    document.documentElement.classList.remove('clinic-is-loading');
}

async function waitForPageReady() {
    if (document.readyState !== 'complete') {
        await new Promise((resolve) => {
            window.addEventListener('load', resolve, { once: true });
        });
    }

    if (document.fonts?.ready) {
        await document.fonts.ready;
    }

    if (typeof window.initClinicaDataTable === 'function') {
        await window.initClinicaDataTable();
    }

    await new Promise((resolve) => {
        requestAnimationFrame(() => requestAnimationFrame(resolve));
    });

    await sleep(120);
}

function bindPageLoader() {
    const el = getLoader();
    if (!el) {
        return;
    }

    showPageLoader();

    if (document.readyState === 'complete') {
        hidePageLoader();
    } else {
        window.addEventListener('load', () => hidePageLoader(), { once: true });
    }

    document.addEventListener('livewire:navigate', () => showPageLoader());
    document.addEventListener('livewire:navigated', () => hidePageLoader());
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bindPageLoader);
} else {
    bindPageLoader();
}
